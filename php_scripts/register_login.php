<?php

echo '<script>console.log("[DEBUG]Password:';
echo session_id();
echo '")</script>';  
echo '<script>console.log("[DEBUG]TEST?")</script>';

$nameErr = $emailErr = $passwordErr = $createErr = $loginEmailErr = $loginPasswordErr = "";
// If user posts a request.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//if login button is clicked
if (!empty($_POST['login'])){
  $check = true;
  if (empty($_POST["username"])) {
    $loginusernameErr = "* Please enter username";
    $check = False;
  } else {
    $username = trim_input($_POST["username"]);
  }

  if (empty($_POST["password"])) {
    $loginPasswordErr = "* Please enter password";
    $check = False;
  } else {
    $password = trim_input($_POST["password"]);
  }


  if($check == True){
    // Create connection
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
      echo "connection error";
      die("Connection failed: " . $conn->connect_error);
    }else{
      $sql = "select * from User where username = '$username' AND password ='$password'";
      // if query checks out
      if ($conn->query($sql) !== FALSE) {
        echo '<script>console.log("[DEBUG]Found you")</script>';
        echo '<script>alert("';
        echo session_id();
        echo '");</script>';
        session_start();
        $_SESSION["username"] = $username;
        header("Location: http://localhost/alvin-chanchan/profilepage.php");
      } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        echo '<script>console.log("[DEBUG]SQL Staement:';
        echo $error;
        echo '")</script>';  
      }
    // Close connection
      $conn->close();
    }//end of insert
  }
} 

// if register button is clicked
if (!empty($_POST["register"])){ 
  $check = True;
  if (empty($_POST["name"])) {
    $nameErr = "Username is required";
    $check = False;
  } else {
    $name = trim_input($_POST["name"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $check = False;
  } else {
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $check = False;
    }else{
      $email = trim_input($_POST["email"]);
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
    $check = False;
  } else {
    $password = trim_input($_POST["password"]);
  }


  if($check == True){
    if(CheckValid($name, $email)){
    // Create connection
      $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
      if ($conn->connect_error) {
        echo "connection error";
        die("Connection failed: " . $conn->connect_error);
      }else{
        $sql = "INSERT INTO User (username, email, password)
        VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
          echo '<script>console.log("[DEBUG]New record created successfully")</script>';
        } else {
          $error = "Error: " . $sql . "<br>" . $conn->error;
          echo '<script>console.log("[DEBUG]Password:';
          echo $error;
          echo '")</script>';  
        }
    // Close connection
        $conn->close();
    }//end of insert
  }else{
    $createErr = "Email/Username already exists";
    }//end of check valid
    }//end of ($check==true)
    }// end of post request
  } 

  function trim_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

//checks if username / email had been used already
  function CheckValid($username, $email){
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    //checks connection
    if ($conn->connect_error){
     die("Connection failed: " . $conn->connect_error);
   }else{
    $sql = "select * from User where username = '$username' OR email ='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
      echo '<script>console.log("[DEBUG]Existing username/email.")</script>';
      return false;
    }else{
      return true;
    }
  }
  $conn->close();
}

?>
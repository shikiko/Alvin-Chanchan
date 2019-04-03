<?php
require_once("../php_scripts/functions.php");
require_once("../php_scripts/verifyEmail.php");
$nameErr = $emailErr = $passwordErr = $createErr = $loginEmailErr = $loginPasswordErr = $successfulRegister = $error = "";
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
  if (!$conn) {
        header("Location: ../error/500.php");
        die("Connection failed: " . $conn->connect_error);
      }else{
      $sql = "select * from User where username = '$username' AND password ='$password'";
      $query = mysqli_query($conn, $sql);
      // if query checks out (successful login)
      if (mysqli_num_rows($query) > 0) {
          echo '<script>console.log("[DEBUG]Found you")</script>';
          session_start();
          $_SESSION["username"] = $username;
          $_SESSION["current_user"] = $username;
            header("Refresh:0");
      } else { // wrong password
        $error = True;
      }
    //Close connection
      $conn->close();
    }//end of insert
  }//end of $check = true
}//end of !empty post login

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
  if (!$conn) {
        header("Location: ../error/500.php");
        die("Connection failed: " . $conn->connect_error);
      }else{
        $hash = md5(rand(0,1000));
        $sql = "INSERT INTO User (username, email, password,hash,admin)
        VALUES ('$name', '$email', '$password', '$hash','0')";
        //If registration is successful
        if ($conn->query($sql) === TRUE) {
          echo '<script>console.log("[DEBUG]New record created successfully")</script>';
          $successfulRegister = true;
          //Generates md5 hash
          SendVerficationEmail($email, $hash);
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

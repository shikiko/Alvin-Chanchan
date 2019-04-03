<?php
require_once("../php_scripts/functions.php");
$revCommErr = $successfulRev    = "";
$username = $_SESSION["username"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$reviewer = trim_input($_SESSION["username"]);
$revDate = date("Y-m-d");
$revRate = trim_input($_POST["rating"]);
$targetuser = trim_input($_POST["retrievedtarget"]);

if (!empty($_POST["review"])){ 
  $check = True;

  if (empty($_POST["revComm"])) {
    $itemnameErr = "Type something for your review!";
    $check = False;
  } else {
    $revComm = trim_input($_POST["revComm"]);
  }
  if(CheckVerified($reviewer)){
    if($check == True){
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
          header("Location: ../error/500.php");
          die("Connection failed: " . $conn->connect_error);
        }else{
          $sql = "INSERT INTO review (reviewer,comment,targetuser,revDate,rating)
          VALUES ('$reviewer','$revComm' ,'$targetuser', '$revDate', $revRate)";
          if ($conn->query($sql) === TRUE) {
            echo '<script>console.log("[DEBUG]New record created successfully")</script>';
            $successfulRev = true;
          } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
            echo '<script>console.log("[DEBUG]Password:';
            echo $error;
            echo '")</script>';  
          }
          $conn->close();
          $URL="../pages/profile.php?username=$targetuser";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="3;URL=' . $URL . '">';
        }//else $conn->connect_error
      }//$check = true
  }else{
    echo "You are not verified, Please verify first";
  }//if checkVerified
  }
}
?>
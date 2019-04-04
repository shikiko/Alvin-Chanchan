<?php
  	require_once("../private/config.php");
  	require_once("../php_scripts/functions.php");

  	$phone = $email = $gender = $profilepic = $verified = "";
    define('username',$_GET['username']);
    $username = $_GET['username'];
    if(Exists($username)){
    	GetData($username);
    }else{
    	GetData($username);
    }

    function GetData($username){
    	global $phone, $email,$gender,$profilepic, $verified;
	   	// Create connection
	    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	    // Check connection
	    if (!$conn) {
	      header("Location: ../error/500.php");
	      die("Connection failed: " . $conn->connect_error);
	    }else{
	      $sql = "select * from User where username = '$username'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    	$phone = $row["ContactNumber"];
			    	$gender = $row["Gender"];
			    	$email = $row["Email"];
			    	$profilepic = $row["ProfilePicture"];
			    	$verified = $row["verified"];
			    }
			} else {
			    header("Location: ../error/404.php");
			}
	    //Close connection
	      $conn->close();
	    }//end of select
    }
?>
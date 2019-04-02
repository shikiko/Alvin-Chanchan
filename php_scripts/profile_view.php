<?php
  	require_once("../private/config.php");
  	$phone = $email = $gender = $profilepic = "";
    define('username',$_GET['username']);
    $username = $_GET['username'];
    GetData($username);

    function GetData($username){
    	global $phone, $email,$gender,$profilepic;
	   	// Create connection
	    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	    // Check connection
	    if ($conn->connect_error) {
	      echo "connection error";
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
			    }
			} else {
			    echo "0 results";
			}
	    //Close connection
	      $conn->close();
	    }//end of select
    }
?>
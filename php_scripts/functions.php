<?php
require_once("../private/config.php");

function trim_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function CheckVerified($username){
		$verified = "";
		// Create connection
	    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	    // Check connection
	if (!$conn) {
	      header("Location: ../error/500.php");
	      die("Connection failed: " . $conn->connect_error);
	    }else{
	      $sql = "select verified from User where username = '$username' limit 1";
    	$query= mysqli_query($conn,$sql);
		while($conn = mysqli_fetch_row($query))
		{
		    $verified = $conn[0];
		}
		
	    if($verified == 1){
	    	return true;
	    }else{
	    	return false;
	    }
	    //Close connection
	      $conn->close();
	    }//end of select
}

function CheckAdmin($username){
	$admin = "";
	// Create connection
	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	// Check connection
	if (!$conn) {
	      header("Location: ../error/500.php");
	      die("Connection failed: " . $conn->connect_error);
	    }else{
	      $sql = "select admin from User where username = '$username' limit 1";
    	$query= mysqli_query($conn,$sql);
		while($conn = mysqli_fetch_row($query))
		{
		    $admin = $conn[0];
		}
		
	    if($admin == 1){
	    	return true;
	    }else{
	    	return false;
	    }
	    //Close connection
	      $conn->close();
	    }//end of select
	}



?>
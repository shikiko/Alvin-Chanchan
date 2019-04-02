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
	    if ($conn->connect_error) {
	      echo "connection error";
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
?>

<!-- 
$name = $_GET["username"];
$sql = "SELECT id FROM Users WHERE username='$name' limit 1";
$result = mysql_query($sql);
$value = mysql_fetch_object($result); -->
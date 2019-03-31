<?php
require_once("../php_scripts/functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//if login button is clicked
	if (!empty($_POST['login_modal'])){	
			echo '<script>console.log("[DEBUG]Login Modal Post?")</script>';

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
			    $_SESSION["username"] = $username;
        		header("Refresh:0");
		  	}else{
			    $error = "Error: " . $sql . "<br>" . $conn->error;
			    echo '<script>console.log("[DEBUG]SQL Staement:';
			    echo $error;
			    echo '")</script>';  
		  		}
			// Close connection
		  	$conn->close();
			}//end of insert
		}//end of $check = true
	}//end of !empty post login_modal
}//end of post request 


?>
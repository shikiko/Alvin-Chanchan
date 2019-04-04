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
			if (!$conn) {
			      header("Location: ../error/500.php");
			      die("Connection failed: " . $conn->connect_error);
			    }else{
		      $sql = "select * from User where username = '$username' AND password ='$password'";
		      $query = mysqli_query($conn, $sql);
		      // if query checks out (successful login)
		      if (mysqli_num_rows($query) > 0) {
		          session_start();
		          $_SESSION["username"] = $username;
		          $_SESSION["current_user"] = $username;
		            header("Refresh:0");
		      } else { // wrong password
		        $modalErr = True;
		      }
			// Close connection
		  	$conn->close();
			}//end of insert
		}//end of $check = true
	}//end of !empty post login_modal
}//end of post request 


?>
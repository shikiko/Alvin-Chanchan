<?php
$error = $success ="";
require_once("../php_scripts/functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!empty($_POST["edit_modal"])){

		$gender = trim_input($_POST['gender']);
		$username = $_POST["username"];
		//checks if phone input is empty
		if (!empty($_POST["Contact"])){
			//checks if input is numeric
			if(is_numeric($_POST["Contact"])){
				$phone = trim_input($_POST["Contact"]);
				UploadTelephone($phone, $username);
			}else{
				$phone = NULL;
				$error = ' Please enter a valid phone number';
			}
	  	}else{
	  		$phone =NULL;
	  		UploadTelephone($phone, $username);
	  	}
	  	if(!empty($_POST["gender"])){
	  		$gender = trim_input($_POST["gender"]);
	  		UploadGender($gender, $username);
	  	}

	  	if (!empty($_POST["email"])){
			//checks if input is numeric
			$email = trim_input($_POST["email"]);
			if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		      $error = "Invalid email format";
		    }else{
		      $email = trim_input($_POST["email"]);
		      UploadEmail($email, $username);
		    }
	  	}else{
	  		$error ="Email cannot be null";
	  	}
	}//END OF EDIT MODAL
	if(!empty($_POST["delete"])){
			$username = $_POST["username"];
			Delete($username);
		}

}

function UploadEmail($email, $username){
	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	//$username = $_GET["username"];
	//Checks if connections exists
	if ($conn->connect_error) {
      echo "connection error";
      die("Connection failed: " . $conn->connect_error);
      return false;
    }else{
		$sql = "Update user set Email ='$email' where username='$username'";
		//checks if record is successful (true = successful)
		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		    $conn->close();
		    return true;
		} else {
		    //echo "Error updating record: " . $conn->error;
		    $conn->close();
		    return false;
		}
    //Close connection
	}//end of else
}

function UploadTelephone($phone, $username){
	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	//Checks if connections exists
	if ($conn->connect_error) {
      echo "connection error";
      die("Connection failed: " . $conn->connect_error);
      return false;
    }else{
		$sql = "Update user set ContactNumber ='$phone' where username='$username'";
		//checks if record is successful (true = successful)
		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		    $conn->close();
		    return true;
		} else {
		    //echo "Error updating record: " . $conn->error;
		    $conn->close();
		    return false;
		}
    //Close connection
	}//end of else
}

function UploadGender($gender, $username){
	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	$username = $_SESSION["username"];
	//Checks if connections exists
	if ($conn->connect_error) {
      echo "connection error";
      die("Connection failed: " . $conn->connect_error);
      return false;
    }else{
		$sql = "Update user set Gender ='$gender' where username='$username'";
		//checks if record is successful (true = successful)
		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		    $conn->close();
		    return true;
		} else {
		    //echo "Error updating record: " . $conn->error;
		    $conn->close();
		    return false;
		}
    //Close connection
	}//end of else
}

function Delete($username){

	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	//Checks if connections exists
	if ($conn->connect_error) {
      echo "connection error";
      die("Connection failed: " . $conn->connect_error);
      return false;
    }else{
		$sql = "Delete from user where username='$username'";
		//checks if record is successful (true = successful)
		if ($conn->query($sql) === TRUE) {
		    $conn->close();
		    return true;
		} else {
			header("Location: ../error/500.php");
		    $conn->close();
		    return false;
		}
    //Close connection
	}//end of else

}

function GetData(){
   	// Create connection
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if (!$conn) {
      header("Location: ../error/500.php");
      die("Connection failed: " . $conn->connect_error);
    }else{
      $sql = "select * from User";
		$result = $conn->query($sql);
		// if ($result->num_rows > 0) {
		//     // output data of each row
		//     while($row = $result->fetch_assoc()) {
		//     	$phone = $row["ContactNumber"];
		//     	$gender = $row["Gender"];
		//     	$email = $row["Email"];
		//     	$profilepic = $row["ProfilePicture"];
		//     }
		// }
    //Close connection
      $conn->close();
      return $result;
    }//end of select
}



?>
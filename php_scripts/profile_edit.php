<?php
$passwordErr = "";
require_once("../php_scripts/functions.php");
$password_oldErr = $passwordNewErr  = $passwordVerifyErr = $successfully= $imageErr = $successfulUpdate= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(!empty($_POST["save_new_password"])){ 
		$check = True;
		if (empty($_POST["password_old"])){
			$password_oldErr = "* Please enter current password";
	  	}else{
	  	 	$password_old = trim_input($_POST["password_old"]);
	  	}
	  	if(empty($_POST["password_1"])){
	    	$passwordNewErr = " Please enter password";
	    	$check = False;
	  	}else{
	    	$password_1 = trim_input($_POST["password_1"]);
	  	}
	  	if(empty($_POST["password_2"])) {
	    	$passwordNewErr = " Please enter password";
	    	$check = False;
	  	}else{
	    	$password_2 = trim_input($_POST["password_2"]);
	  	}

	  	if($check == True){
	  		if($password_1 === $password_2){
		  		if(ValidatePassword($password_old)){
		  			if(UpdatePassword($password_1)){
		  				$successfulUpdate = true;
		  				$successfully = true;
		  			}
		  		}else{
		  			$password_oldErr = "Wrong password";
		  		}
	  		}else{
	  			$passwordNewErr = " Passwords do not match";
	  		}
	  	}
	}// end of change password post

	if(!empty($_POST["personal"])){
		$phoneErr = $imageErr= "";
		$gender = trim_input($_POST['gender']);
		//checks if phone input is empty
		if (!empty($_POST["phone"])){
			//checks if input is numeric
			if(is_numeric($_POST["phone"])){
				$phone = trim_input($_POST["phone"]);
				UploadTelephone($phone);
			}else{
				$phone = 'NULL';
				$phoneErr = ' Please enter a valid phone number';
			}
	  	}else{
	  		$phone ='NULL';
	  	}
	  	if(!empty($_POST["gender"])){
	  		$gender = trim_input($_POST["gender"]);
	  		UploadGender($gender);
	  	}
	  	//Checks if upload image is empty.hi
		if (!empty(basename($_FILES["fileToUpload"]["name"]))){
			$image = basename($_FILES["fileToUpload"]["name"]);
			$imagename = UploadImage($image);
			if($imagename != "False"){
				UploadPathToDB($imagename);
				$successfulUpdate = true;
			}
	  	}else{
	  		$image ='NULL';
	  	}
	}
}

function ValidatePassword($password_old){
	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	$username = $_SESSION["username"];
	//Checks if connections exists
	if (!$conn) {
	      header("Location: ../error/500.php");
	      die("Connection failed: " . $conn->connect_error);
	    }else{
    	//select query to get password
    	$sql = "select password from User where username = '$username'";
    	$query= mysqli_query($conn,$sql);
		while($conn = mysqli_fetch_row($query))
		{
		    $password = $conn[0];
		}
    //Close connection
    	$query->close();
	}//end of else

	//compares password from db to one typed
	if($password === $password_old){
		return true;
	}else{
		echo '<script>console.log("[DEBUG]Wrong Password");</script>';
		return false;
	}
}//end of ValidatePassword

function UpdatePassword($password_new){
	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	$username = $_SESSION["username"];
	//Checks if connections exists
	if (!$conn) {
	      header("Location: ../error/500.php");
	      die("Connection failed: " . $conn->connect_error);
	    }else{
		$sql = "Update user set password ='$password_new' where username='$username'";
		//checks if record is successful (true = successful)
		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		    $conn->close();
		    return true;
		} else {
		    //echo "Error updating record: " . $conn->error;
		   	header("Location: ../error/500.php");
		    $conn->close();
		    return false;
		}
    //Close connection
	}//end of else
}

function UploadImage($image){
	global $imageErr;
	$target_dir = "../img/profilepictures/";
	$name = randomNumber(12);
	$target_file = $target_dir.$image;
	$target_name = $target_dir.$name;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["personal"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        $imageErr = "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    $imageErr = "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 9437184) {
	    $imageErr = "Sorry, your file is too large. Please upload images up to 9MB";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $imageErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// if everything is ok, try to upload file
	if ($uploadOk != 0){
	 	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_name.'.'.$imageFileType)) {
	        $imageErr = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	        return  $target_name.'.'.$imageFileType;
	    } else {
	        $imageErr = "Sorry, there was an error uploading your file.";
	    }
	}else{
		return 'False';
	}
}

//generates random number to save as file name
function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

function UploadPathToDB($imagename){
	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	$username = $_SESSION["username"];
	//Checks if connections exists
	if (!$conn) {
	      header("Location: ../error/500.php");
	      die("Connection failed: " . $conn->connect_error);
	    }else{
		$sql = "Update user set ProfilePicture ='$imagename' where username='$username'";
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

function UploadTelephone($phone){
	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	$username = $_SESSION["username"];
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

function UploadGender($gender){
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



?>
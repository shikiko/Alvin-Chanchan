<?php
  	require_once("../private/config.php");

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
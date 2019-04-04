<?php
require_once("../php_scripts/functions.php");
$itemnameErr = $itempriceErr=$itemdurErr = $tradelocErr = $createErr = $successfulUpload =$imageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$seller = trim_input($_SESSION["username"]);
$itemcat = trim_input($_POST["itemcat"]);
$itemdesc = trim_input($_POST["itemdesc"]);
$targetitem = trim_input($_POST["targetitem"]);
if (!empty(basename($_FILES["fileToUpload"]["name"]))){
			$image = basename($_FILES["fileToUpload"]["name"]);
			$imagename = UploadImage($image);
                            if ($imagename == False){
                                $imagename = '';
                            }
	  	}else{
	  		$imagename = NULL;
	  	}
if (!empty($_POST["upload"])){ 
  $check = True;
  if (empty($_POST["itemname"])) {
    $itemnameErr = "Item Name is required";
    $check = False;
  } else {
    $itemname = trim_input($_POST["itemname"]);
  }
  if (empty($_POST["itemprice"])) {
    $itempriceErr = "Price is required";
    $check = False;
  } else {
    $itemprice = trim_input($_POST["itemprice"]);
  }
  if (empty($_POST["tradeloc"])) {
    $tradelocErr = "Location is required";
    $check = False;
  } else {
    $tradeloc = trim_input($_POST["tradeloc"]);
  }
  if(isset($_POST["markSold"])){
      $sold=1;
  }else{
      $sold=0;
  }
  
  if(CheckVerified($seller)){
    if($check == True){
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
          header("Location: ../error/500.php");
          die("Connection failed: " . $conn->connect_error);
        }else{
            if($imagename=='' ||$imagename==NULL){
                $sql= "UPDATE items SET itemName = '$itemname',Description ='$itemdesc',Price = $itemprice,Category = '$itemcat',"
                        . "TradingLocation ='$tradeloc',Sold =$sold WHERE itemId=$targetitem";
            }else{
          $sql = "UPDATE items SET itemName = '$itemname',Description ='$itemdesc',Price = $itemprice,Category = '$itemcat',"
                        . "TradingLocation ='$tradeloc',Sold =$sold,itemPicture='$imagename' WHERE itemId=$targetitem";
            }
          if ($conn->query($sql) === TRUE) {
            echo '<script>console.log("[DEBUG]New record created successfully")</script>';
            $successfulUpload = true;
          } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
            echo '<script>console.log("[DEBUG]Password:';
            echo $error;
            echo '")</script>';  
            
          }
          $conn->close();
//          $URL="../pages/listing.php?id=$targetitem";
//            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
//            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        }//else $conn->connect_error
      }//$check = true
  }else{
    echo "You are not verified, Please verify first";
  }//if checkVerified
  }
}

function UploadImage($image){
	global $imageErr;
	$target_dir = "../img/itempictures/";
	$name = randomNumber(12);
	$target_file = $target_dir.$image;
	$target_name = $target_dir.$name;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["upload"])) {
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

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
  ?>
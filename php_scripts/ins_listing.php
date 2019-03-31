<?php
require_once("../php_scripts/functions.php");
$itemnameErr = $itempriceErr = $tradelocErr = $createErr ="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$itemcond = trim_input($_POST["itemcond"]);
$itemcat = trim_input($_POST["itemcat"]);
$itemdesc = trim_input($_POST["itemdesc"]);
$itempic = trim_input($_POST["itempic"]);
$itempicname = $_POST["itempic"]["name"];
$itempic = addslashes(file_get_contents($_POST['itempic']['tmp_name']));
$listdate = date("Y-m-d");
$Seller = trim_input($_POST["sellerid"]);

if (!empty($_POST["upload"])){ 
  $check = True;
  if (empty($_POST["itemname"])) {
    $itemnameErr = "Item Name is required";
    $check = False;
  } else {
    $itemname = trim_input($_POST["name"]);
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
  if($check == True){
      $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
      if ($conn->connect_error) {
        echo '<script>console.log("';
        echo 'connection error';
        echo '")</script>';
        die("Connection failed: " . $conn->connect_error);
      }else{
        $sql = "INSERT INTO items (itemName,Price,Category,itemCond,TradingLocation,itemPicture,Active,Sold,ListDate,Seller)
        VALUES ('$itemname', '$itemprice', '$itemcat', '$itemcond','$tradeloc','$itempic',1,0,'$listdate','$Seller')";
        $conn->close();
    }
    }
    }
}
  ?>
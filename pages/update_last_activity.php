<?php

//update_last_activity.php

require_once("../private/config.php");

session_start();

$query = "
UPDATE user
SET last_activity = now() 
WHERE Username = '".$_SESSION["username"]."'
";

$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
// Check connection
if (!$connect) {
  header("Location: ../error/500.php");
  die("Connection failed: " . $connect->connect_error);
}
$statement = $connect->prepare($query);

$statement->execute();

?>

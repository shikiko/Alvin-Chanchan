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
$statement = $connect->prepare($query);

$statement->execute();

?>

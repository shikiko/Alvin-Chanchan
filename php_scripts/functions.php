<?php

function trim_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function error_found(){
  exit(header("Location: 404.php"));
}


?>

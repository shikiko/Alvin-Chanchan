<?php
if(!isset($_SESSION["username"])){
    session_start(); 
}

//fetch_seller.php
require_once("../php_scripts/functions.php");
require_once("../private/config.php");
$Seller = $_SESSION['seller'];
$check = ($_SESSION['username']!=$Seller);

if (!empty($_SESSION['username'])){
    $Username = $_SESSION['username'];
    if ($_SESSION['username']!=$Seller){
    if(CheckVerified($Username)){
    $query = "
    SELECT * FROM user 
    WHERE Username = '".$Seller."' 
    ";
    $connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

    $output = '

    ';
    foreach($result as $row)
    {
     $status = '';
     date_default_timezone_set('Asia/Singapore');
     $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 7 second');
     $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);

     $output .= '
      <button type="button" class="btn btn-template-outlined start_chat" data-touserid="'.$row['Username'].'" data-tousername="'.$row['Username'].'"><i class="fa fa-shopping-cart"></i>Chat Now</button>
     ';
    }

    $output .= '</table>';
    echo $output;
    }
}else{
    $Username = '';
}
}
?>
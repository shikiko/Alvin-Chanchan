<?php
if(!isset($_SESSION["username"])){
    session_start(); 
}

//fetch_user.php
require_once("../private/config.php");

function count_unseen_message($from_user_id, $to_user_id)
{
$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
 $query = "
 SELECT * FROM `system` 
 WHERE `From` = '$from_user_id' 
 AND `To` = '$to_user_id' 
 AND `status` = '1'";

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
 $count = count($result);

 $output = '';
 if($count > 0)
 {
  $output = '<span class="badge badge-info">'.$count.'</span>';
 }
 return $output;
}

function fetch_user_last_activity($Username, $connect)
{
 $query = "
 SELECT * FROM user
 WHERE Username = '".$Username."' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
 foreach($result as $row)
 {
  return $row['last_activity'];
  return $Username;
 }
}
$Username = $_SESSION['username'];
$query = "
SELECT * FROM user 
WHERE Username != '".$Username."' 
";
$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

$output = '
<table class="table table-bordered table-striped">
 <tr>
  <td>Username</td>
  <td>Status</td>
  <td>Action</td>
 </tr>
';
foreach($result as $row)
{
 $status = '';
 date_default_timezone_set('Asia/Singapore');
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 7 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['Username'], $connect);

 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="badge badge-success">Online</span>';
 }
 else
 {
  $status = '<span class="badge badge-danger">Offline</span>';
 }
 $output .= '
 <tr>
  <td>'.$row['Username'].' '.count_unseen_message($row['Username'], $_SESSION['username']).'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['Username'].'" data-tousername="'.$row['Username'].'">Start Chat</button></td>
 </tr>
 ';
}

$output .= '</table>';

echo $output;

?>
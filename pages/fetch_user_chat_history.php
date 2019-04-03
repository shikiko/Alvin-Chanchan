<?php

//fetch_user_chat_history.php

require_once("../private/config.php");

session_start();
$Username = $_SESSION['username'];

function fetch_user_chat_history($from_user_id, $to_user_id)
{
 $connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
 $query = "
 SELECT * FROM `system`
 WHERE (`From` = '".$from_user_id."' 
 AND `To` = '".$to_user_id."') 
 OR (`From` = '".$to_user_id."' 
 AND `To` = '".$from_user_id."') 
 ORDER BY `timestamp` DESC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["From"] == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['From']).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["Body"].'
    <div align="right">
     - <small><em>'.$row['Timestamp'].'</em></small>
    </div>
   </p>
   
  </li>
  ';
 }
 
 $output .= '</ul>';
 $query = "
 UPDATE `system` 
 SET `status` = '0' 
 WHERE `From` = '".$to_user_id."' 
 AND `To` = '".$from_user_id."' 
 AND `status` = '1'
 ";
 $statement1 = $connect->prepare($query);
 $statement1->execute();
 return $output;
}

function get_user_name($user_id)
{
 $connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
 $query = "SELECT `Username` FROM `user` WHERE Username = '$user_id'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);;
 foreach($result as $row)
 {
  return $row['Username'];
 }
}

echo fetch_user_chat_history($Username, $_POST['to_user_id']);
?>

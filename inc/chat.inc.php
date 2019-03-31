
<?php
// simple chat class
class SimpleChat {
    // DB variables
    var $DBHOST;
    var $DBNAME;
    var $DBUSER;
    var $DBPASS;

    // constructor
    function SimpleChat() {
        
        require_once("../private/config.php");
    }
    // adding to DB table posted message
    
    function acceptMessages() {
        //if ($_COOKIE['member_name']) {
            if(isset($_POST['s_say']) && $_POST['s_message']) {
                $sUsername = $_SESSION["username"];

                //the host, name, and password for your mysql
                $vLink = new mysqli(DBHOST, DBUSER, DBPASS,DBNAME);

                $merSQL="SELECT Seller FROM items where ItemID =1";
                if($merresult= mysqli_query($vLink,$merSQL)){
                    while ($row = mysqli_fetch_assoc($merresult)) {
                      $Seller = $row['Seller'];
                    }
                }

                $sMessage = mysqli_real_escape_string($vLink, $_POST['s_message']);
                if ($sMessage != '') {
                    date_default_timezone_set("Asia/Singapore");
                    $date = date('Y-m-d H:i:s');
                    mysqli_query($vLink, "INSERT INTO `system` SET `From`='{$sUsername}', `To`='{$Seller}', `Body`='{$sMessage}', `createDate`='{$date}'");
                }
                mysqli_close($vLink);
            }
        }
    
    function getMessages() {
        $vLink = new mysqli(DBHOST, DBUSER, DBPASS,DBNAME);
        
        $vRes = mysqli_query($vLink, "SELECT * FROM `system` ORDER BY `MessageID`");
        $sMessages = '';
       
        // collecting list of messages 
        if ($vRes) {
            while($aMessages = mysqli_fetch_array($vRes)) {
                $sMessages .= '<div class="message">' . $aMessages['From'] . ': ' . $aMessages['Body'] . '<span>(' . $aMessages['createDate'] . ')</span></div>';
            }
        } else {
            $sMessages = 'DB error, create SQL table before';
        }
        mysqli_close($vLink);
        echo $sMessages;   
    }
}
?>

<?php

if(isset($_POST['Csubmit'])){
    $ContactSuccess = true;
    require_once("../thirdpartyvendors/Exception.php");
    require_once("../thirdpartyvendors/PHPMailer.php");
    require_once("../thirdpartyvendors/SMTP.php");

    $CFname = $_POST['CFname'];
    $CLname = $_POST['CLname']."\n";
    $Cemail = $_POST['Cemail']."\n";
    $Csubject = 'Contact us: '.$_POST['Csubject'];
    $Cmessage = 'Message: '.$_POST['Cmessage']."\n\nRegards,\n";
    $CFmessage = $Cmessage.$CFname.$CLname.$Cemail;

    $Cmail = new PHPMailer\PHPMailer\PHPMailer();
    $Cmail->IsSMTP();
    $Cmail->Host = 'smtp.gmail.com';
    $Cmail->Port = 465;
    $Cmail->SMTPSecure = 'ssl';
    $Cmail->SMTPAuth = true;
    $Cmail->Username = "OGFastTrade@gmail.com";
    $Cmail->Password = "P@ssword1234";
    $Cmail->SetFrom("OGFastTrade@gmail.com", "Fast Trade");
    $Cmail->addAddress("OGFastTrade@gmail.com");
    $Cmail->Subject = $Csubject;
    $Cmail->Body = $CFmessage;

    if(!$Cmail->Send()) {
            echo '<script>console.log("mail failed to send reason:';
            echo $Cmail->ErrorInfo;
            echo '")</script>';
        return false;
    } else {
            echo '<script>console.log("Mail successfully sent")</script>';
        return true;
    }
}
else {
    $ContactSuccess = false;
}

?>

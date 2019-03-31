<?php 

function SendVerficationEmail($email,$hash){
require_once("../thirdpartyvendors/Exception.php");
require_once("../thirdpartyvendors/PHPMailer.php");
require_once("../thirdpartyvendors/SMTP.php");

echo '<script>console.log("[DEBUG]Sending Email")</script>';
$to = $email;
$subject = '[FastTrade]Email Verification'; // Give the email a subject 

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; 
$mail->Username = "OGFastTrade@gmail.com";
$mail->Password = "P@ssword1234  ";           
$mail->SetFrom("OGFastTrade@gmail.com", "Fast Trade");
$mail->Subject = $subject;
$mail->Body = SetMessage($hash);
$mail->AddAddress($to);
$mail->isHTML(true);
if(!$mail->Send()) {
	echo '<script>console.log("mail failed to send reason:';
	echo $mail->ErrorInfo;
	echo '")</script>';
    return false;
} else {
	echo '<script>console.log("Mail successfully sent")</script>';
    return true;
}

}

function SetMessage($hash){
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$link = str_replace("register.php","verify.php", $actual_link);
	$message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta name="viewport" content="width=device-width, initial-scale=1.0" /> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <title>Verify your email address</title> <style type="text/css" rel="stylesheet" media="all"> /* Base ------------------------------ */ *:not(br):not(tr):not(html) { font-family: Arial, Helvetica, sans-serif; -webkit-box-sizing: border-box; box-sizing: border-box; } body { width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F5F7F9; color: #839197; -webkit-text-size-adjust: none; } a { color: #414EF9; } /* Layout ------------------------------ */ .email-wrapper { width: 100%; margin: 0; padding: 0; background-color: #F5F7F9; } .email-content { width: 100%; margin: 0; padding: 0; } /* Masthead ----------------------- */ .email-masthead { padding: 25px 0; text-align: center; } .email-masthead_logo { max-width: 400px; border: 0; } .email-masthead_name { font-size: 16px; font-weight: bold; color: #839197; text-decoration: none; text-shadow: 0 1px 0 white; } /* Body ------------------------------ */ .email-body { width: 100%; margin: 0; padding: 0; border-top: 1px solid #E7EAEC; border-bottom: 1px solid #E7EAEC; background-color: #FFFFFF; } .email-body_inner { width: 570px; margin: 0 auto; padding: 0; } .email-footer { width: 570px; margin: 0 auto; padding: 0; text-align: center; } .email-footer p { color: #839197; } .body-action { width: 100%; margin: 30px auto; padding: 0; text-align: center; } .body-sub { margin-top: 25px; padding-top: 25px; border-top: 1px solid #E7EAEC; } .content-cell { padding: 35px; } .align-right { text-align: right; } /* Type ------------------------------ */ h1 { margin-top: 0; color: #292E31; font-size: 19px; font-weight: bold; text-align: left; } h2 { margin-top: 0; color: #292E31; font-size: 16px; font-weight: bold; text-align: left; } h3 { margin-top: 0; color: #292E31; font-size: 14px; font-weight: bold; text-align: left; } p { margin-top: 0; color: #839197; font-size: 16px; line-height: 1.5em; text-align: left; } p.sub { font-size: 12px; } p.center { text-align: center; } /* Buttons ------------------------------ */ .button { display: inline-block; width: 200px; background-color: #414EF9; border-radius: 3px; color: #ffffff !important; font-size: 15px; line-height: 45px; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; mso-hide: all; } .button--green { background-color: #28DB67; } .button--red { background-color: #FF3665; } .button--blue { background-color: #414EF9; } /*Media Queries ------------------------------ */ @media only screen and (max-width: 600px) { .email-body_inner, .email-footer { width: 100% !important; } } @media only screen and (max-width: 500px) { .button { width: 100% !important; } } </style></head><body> <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <table class="email-content" width="100%" cellpadding="0" cellspacing="0"> <!-- Logo --> <tr> <td class="email-masthead"> <a class="email-masthead_name">FastTrade</a> </td> </tr> <!-- Email Body --> <tr> <td class="email-body" width="100%"> <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"> <!-- Body content --> <tr> <td class="content-cell"> <h1>Verify your email address</h1> <p>Thanks for signing up for FastTrade! We are excited to have you as an user.</p> <!-- Action --> <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <div> <a href="'.$link.'?hash='.$hash.'" class="button button--blue">Verify Email</a> </div> </td> </tr> </table> <p>Thanks,<br>The FastTrade Team</p> <!-- Sub copy --> <table class="body-sub"> <tr> <td> <p class="sub">If you are having trouble clicking the button, copy and paste the URL below into your web browser. </p> <p class="sub"><a href="'.$link.'?hash='.$hash.'">'.$link.'?hash='.$hash.'</a></p> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table></body></html>';

	return $message;
}

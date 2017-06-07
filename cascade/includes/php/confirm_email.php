<?php
error_reporting(0);
//lets add header 
if (trim($ecomL) !=''){
   	$ecomL1='<br><br>List Comments:<br>' . $ecomL;
   	$ecomL2='\r\n\r\nList Comments:\r\n' . $ecomL;
}	

if (trim($ecomD) !=''){
   	$ecomD1='<br><br>DP Comments:<br>' . $ecomD;
   	$ecomD2='\r\n\r\nDP Comments:\r\n' . $ecomD;
}	

if (trim($ecomA) !=''){
   	$ecomA1='<br><br>Accounting Comments:<br>' . $ecomA;
   	$ecomA2='\r\n\r\nAccounting Comments:\r\n' . $ecomA;
}	



require("phpmailer/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();                                   // send via SMTP
$mail->Host     = "mail.cisdirect.com"; // SMTP servers
$mail->Port     = "25";
$mail->SMTPAuth = false;     // turn on SMTP authentication
//$mail->Username = "";  // SMTP username
//$mail->Password = ""; // SMTP password

$mail->From     = "stephen@cisdirect.com";
$mail->FromName = "Admin";


$mail->AddAddress($msession[13],$msession[4]); 
$mail->AddAddress("stephen@cisdirect.com","Stephen");

$mail->AddReplyTo($msession[13],$msession[4]);

$mail->WordWrap = 50;                              // set word wrap
//$mail->AddAttachment("/dir/filename.txt");      // attachment
//$mail->AddAttachment("/dir/image.jpg", "new.jpg"); 
$mail->IsHTML(true);                               // send as HTML

$mail->Subject  =  "CC Account has been loaded.";
$mail->Body     =  "Account <b>$s[0]</b> has been set up  by $msession[4] for <b>$newname</b> and name and password is <b>$s[97]/$s[98]</b> <br><br>$msession[4]'s email is $msession[13]<br>Location: $s[3],$s[4] $s[5]<br> <br>$ecomL1 $ecomD1 $ecomA1";
$mail->AltBody  =  "\r\n Account $s[0] has been set up by $msession[4] for $newname and the user name and password is $s[97]/$s[98] \r\n \r\n$msession[4]'s email is $msession[13]\r\nLocation: $s[3],$s[4] $s[5]\r\n \r\n$ecomL2 $ecomD2 $ecomA2";

if(!$mail->Send())
{
   echo "Message was not sent <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "This ";














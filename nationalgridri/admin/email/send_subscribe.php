<?
print("start");
include("../database.php");
set_time_limit(0);
#$addr=array("George Roberts"=>"george@crucialnetworking.com","John Meagle"=>"jmeagle@creativepartners.com","Barbara Maryak"=>"barbara@bridgeport.edu","Bryan Gross"=>"bgross@bridgeport.edu","Brian Solomon"=>"brians@bridgeport.edu","David Teo"=>"teopl@bridgeport.edu","John Meagle"=>"jmeagle@creativepartners.com","Larry Orman"=>"lorman@bridgeport.edu");

#$addr=array("George Roberts"=>"george@crucialnetworking.com");
$From="info@myspiritofgolf.com";


#send e-mail to requester
include_once('class.phpmailer.php');
$email=$_SESSION['email'];
include("email_subscribe.php");	
#grab list	
	#create new instance of phpmailer
	$mail= new PHPMailer();
	$mail->From     = "info@myspiritofgolf.com";
	$mail->FromName = "Spirit of Golf";
	#subject
	$mail->Subject = "Thank you for subscribing";
	//$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, 
	$mail->MsgHTML($body);
	$mail->AddAddress($email);
	if(!$mail->Send()) {
	 # echo 'Failed to send mail';
	} else {
	  #echo 'Mail sent';
	}
	#end requester email
?>

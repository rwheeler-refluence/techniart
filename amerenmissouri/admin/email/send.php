<?
include("../database.php");
set_time_limit(0);
$ID=$_GET['ID'];
$sql="select * from tblEmail where emailID='$ID'";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$subject=stripslashes($row['subject']);
	$extra1=stripslashes($row['extra']);
	if($extra1){
		$extra=$extra1."<br>";
	}
	$thought=stripslashes($row['thought']);
	$message=$extra.$thought;
	$month=strftime("%B",$row['date']);
	$day=strftime("%e",$row['date']);
	$year=strftime("%Y",$row['date']);
}
#$addr=array("George Roberts"=>"george@crucialnetworking.com","John Meagle"=>"jmeagle@creativepartners.com","Barbara Maryak"=>"barbara@bridgeport.edu","Bryan Gross"=>"bgross@bridgeport.edu","Brian Solomon"=>"brians@bridgeport.edu","David Teo"=>"teopl@bridgeport.edu","John Meagle"=>"jmeagle@creativepartners.com","Larry Orman"=>"lorman@bridgeport.edu");

#$addr=array("George Roberts"=>"george@crucialnetworking.com");
$From="info@myspiritofgolf.com";


#send e-mail to requester
include_once('class.phpmailer.php');
$type="email";
include("email.php");	
print("beginning send<br>");
flush();
sleep(1);
#grab list	
$sqllist="select * from tblSubscribersTest order by subscriberID asc";
$resultlist=db_query($sqllist);
while($rowlist=mysql_fetch_array($resultlist)){
	$email="";
	$fname="";
	$email=$rowlist['email'];
	$fname=$rowlist['fname'];

	#create new instance of phpmailer
	$mail= new PHPMailer();
	$mail->From     = "info@myspiritofgolf.com";
	$mail->FromName = "Spirit of Golf";
	#subject
	$mail->Subject = $subject;
	//$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, 
	$mail->MsgHTML($body);
	$mail->AddAddress($email);
	if(!$mail->Send()) {
	 # echo 'Failed to send mail';
	} else {
	  #echo 'Mail sent';
	}
	#end requester email
	print("email sent to ".$email."<br>");
	flush();
	sleep(2);
}
print("done");
?>

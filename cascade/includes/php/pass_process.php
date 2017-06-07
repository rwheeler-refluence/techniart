<?PHP
// PREVENT CACHING FIRST BEFORE ANYTHING ELSE!
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
error_reporting(0);
include("ADODB/adodb.inc.php");
include("functions.php"); 
require("phpmailer/class.phpmailer.php");



$ms = $_GET['mform'];
$ms=str_replace("zpos","''",$ms);
$ms = explode(",",$ms);

include("mysqlcust.con");

$sqldb=mysql_select_db("nyserda_garycardil610729",$sqlconnect);

// trim here once customer saves
$s = trim_array($ms);

//check for qualified
$sql="SELECT * FROM cwa.cascade_users where email='". $s[0] . "'";

$res= mysql_query($sql,$sqlconnect) or die('Could Not open cust database');

$trec=mysql_num_rows($res);
if ($trec < 1){
	die('Invalid Cascade member.');
} else {
	
	  $pass="";
      $cascade_acct="";
      
	  while($row = mysql_fetch_array($res)){
	    $cascade_acct=$cascade_acct . trim($row['cascade_acct']);
        $pass=$pass . trim($row['pass']);
        break;
	  }
	
}


mysql_close($sqlconnect);

 
	  $thebody = "<html><body>";
	  $thebody = $thebody . '<table style="font: 12px Arial, Helvetica;width:650px;line-height: 14px;">';
	  $thebody = $thebody . "You recently visited out website's online store and requested your log in information be emailed to you. If you did not make this request please disregard this email.<br><br> Acct # " . $cascade_acct . "<br>Password: " . $pass . "<br><br>";		  		
	  $thebody = $thebody . "<b>Cascade Water Alliance</b><br>520 112th Ave. NE Suite 400<br>Bellevue, WA 98004<br>425.453.0930<br>http://www.CascadeWater.org<br><br>";
				  
				  
      $thebody = $thebody . "</table>";
	  $thebody = $thebody . "</body></html>";
	  $thebody= str_replace("\n", "<br>", $thebody);
	  $body2= str_replace("<br>", "\r\n", $thebody);
	
	  $mail = new PHPMailer();

	  $mail->IsSMTP();                                   // send via SMTP
	  $mail->Host     = "mail.cisdirect.com"; // SMTP servers
	  $mail->Port     = "587";
	  $mail->SMTPAuth = false;     // turn on SMTP authentication
	
	  $mail->From     = "stephen@cisdirect.com";
	  $mail->FromName = "Admin";
 	  $mail->AddAddress($s[0]);               // optional name
      $mail->AddBCC("stephen@cisdirect.com"); 
	   
	  $mail->AddReplyTo("stephen@cisdirect.com","Site Administration");
	
	  $mail->WordWrap = 50;                              // set word wrap
	  $mail->IsHTML(true);                               // send as HTML

	  $mail->Subject  =  "Cascade water Alliance Login Information";
	
	  $mail->IsHTML(true);
	  $mail->AddEmbeddedImage('images/logo.png', 'thelogoimg', 'logo.png'); // attach file logo.jpg, and later link to it using identfier logoimg
	  $mail->Body =  "<BR><p><img src=\"cid:thelogoimg\" alt=\"Cascade Water Alliance log-in information\" /></p><br>$thebody<BR><BR>";

	  $mail->AltBody  =  "\r\n$body2\r\n";

	  if(!$mail->Send()) {
		    die("Error sending email " . $mail->ErrorInfo);
	  } else {
		    //$errorMsg=$errorMsg . "Email sent without error";
	  }			 
			   

echo "Email with information has been sent to this email address."; 

?>

<? include("database.php"); ?>
<?
$user=$_POST['user'];
$password=(md5($_POST['password']));
$access_company=$_POST['access_company'];
$company_city=$_POST['company_city'];
$company_zip=$_POST['company_zip'];
$company_address=$_POST['company_address'];
$company_owner=$_POST['company_owner'];
$owner_phone=$_POST['owner_phone'];
$owner_email=$_POST['owner_email'];
$admin_name=$_POST['admin_name'];
$admin_phone=$_POST['admin_phone'];
$admin_email=$_POST['admin_email'];
?>
<? #echo($user);?>
<? #echo($password);?>
<?

$chosen=$_POST['chosen'];
$security=md5($_POST['security']);
$security_array=array("1"=>"zz9n7bR","2"=>"iE9Ur3b","3"=>"tB4x6gg","4"=>"9lH233b","5"=>"c16N5Q","6"=>"mY3h2ix","7"=>"aV3rr8z");

if($security!==md5($security_array[$chosen])){
	header("location: sign-up.php?msg=security");
}else{

	$from = '<' . stripslashes($_POST['email']) . '>';
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: " . stripslashes($_POST['email']) . "\r\n";


		$To="".$email."";
		$subject="PSE Home Energy Assessment Contractor Sign-Up";
		$body.="Company: ".$access_company."\n";
		$body.="Name: " . stripslashes($_POST['admin_name']) . " \n";
		$body.="User name: ".$user."\n";
		$body.="Email: ".$admin_email."\n";
		$body.="Phone: ".$admin_phone."\n\n";
		$body.="Thank you for signing up for the PSE commercial contractor site. 
		Please use your username, ".$user.", in conjuction with your password to log-in to the site.
		If you forget your password, please contact webmaster@techniart.com to have your password reset.
  
Sincerely,

TechniArt Inc.";

	//	mail($To,$subject,$body,"From: $email");
	//	mail($To, $subject, $body, $headers);
		$sql="insert into tblCSDAccess values('','$user','$password','$access_company','$company_address','$company_city','$company_zip','$company_owner','$owner_phone', '$owner_email','$admin_name','$admin_phone','$admin_email','$delivery','$delivery_day','$delivery_time','$dock')";
		$result=db_query($sql);
		$next=mysql_insert_id();

	}

?>
<? 		echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Your account has been created.')
		window.location.href='index.php'
        </SCRIPT>
        ";
		?>
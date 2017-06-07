<? include("database.php"); ?>
<?
$referer=$_SERVER['HTTP_REFERER'];
$email=$_POST['email'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$address=$_POST['address'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$phone=$_POST['phone'];
$best_time=$_POST['best_time'];
$notes=$_POST['notes'];
$interested=$_POST['interested'];

$_SESSION['s_fname']=$fname;
$_SESSION['s_email']=$email;
$_SESSION['s_lname']=$lname;
$_SESSION['s_address']=$address;
$_SESSION['s_address2']=$address2;
$_SESSION['s_city']=$city;
$_SESSION['s_state']=$state;
$_SESSION['s_zip']=$zip;
$_SESSION['s_phone']=$phone;
$_SESSION['s_best_time']=$best_time;
$_SESSION['s_notes']=$notes;

$refsplit=explode("?",$referer);
#if($refsplit[0]=='http://www.crucialnetworking.com/contact.php'){

$chosen=$_POST['chosen'];
$security=md5($_POST['security']);
$security_array=array("1"=>"zz9n7bR","2"=>"iE9Ur3b","3"=>"tB4x6gg","4"=>"9lH233b","5"=>"c16N5Q","6"=>"mY3h2ix","7"=>"aV3rr8z");

if($security!==md5($security_array[$chosen])){
	header("location: contact-entry.php?msg=security");
}else{

	if (!isset($_POST['submit'])) {
	  # echo "<h1>Error</h1>\n<p>Accessing this page directly is not allowed.</p>";
	  # exit;
	}

	function cleanUp($data) {
	   $data = trim(strip_tags(htmlspecialchars($data)));
	   return $data;
	}

	$aa=$_POST['aa'];
	if($aa=='contactpage'){
	$notes=cleanUp($notes);

	#check for valid e-mail address
	if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*$",$email)) {
		 die("Invalid Email Address.  Email will not be sent");
	}

	#die if there are line returns in the name or e-mail field
	if (eregi("\r",$email) || eregi("\n",$email) || eregi("\r",$fname) || eregi("\n",$fname) || eregi("\r",$lname) || eregi("\n",$name) || eregi("\r",$address) || eregi("\n",$address) || eregi("\r",$address2) || eregi("\n",$address2) || eregi("\r",$city) || eregi("\n",$city) || eregi("\r",$state) || eregi("\n",$state) || eregi("\r",$zip) || eregi("\n",$zip) || eregi("\r",$phone) || eregi("\n",$phone) || eregi("\r",$best_time) || eregi("\n",$best_time)){
		 die("Why ?? :(");
	}

	#replace manual line returns in e-mail field
	$email = preg_replace("([\r\n])", "", $email);

	#prevent BCC
	$find = "[content-type|Content-Type|bcc:|cc:|viagra|levitra|pariscialis|angelfire|freewebpages|xxx|gay|sluts|incest|hardcore|anal|freeweb]";
	#$find2 = "[http:]";
	if (preg_match($find, $fname) || preg_match($find, $email) || preg_match($find, $lname) || preg_match($find, $address) || preg_match($find, $address2) || preg_match($find, $phone) || preg_match($find, $city) || preg_match($find, $state) || preg_match($find, $zip)) {
		  print("<p>No meta/header injections, please.  E-mail will not be sent.</p>");
	   exit;
	}

	function checkit($name) {
		return(str_replace(array("\r", "\n", "%OA", "%oa", "%OD", "%od", "Content-Type:","BCC:","bcc:"), "", $name));
	}

	$from = '"' . stripslashes(checkit($_POST['fname'])) . ' ' . stripslashes(checkit($_POST['lname'])) . '" <' . stripslashes(checkit($_POST['email'])) . '>';
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: " . stripslashes(checkit($_POST['email'])) . "\r\n";


		$To="customerservice@techniart.com";
		$subject="Submission from Duke Energy Progress Web Store - techniart.us/dukeenergy";
		$body.="Name: " . stripslashes(checkit($_POST['fname'])) . " " . stripslashes(checkit($_POST['lname'])) . "\n";
		$body.="Address: ".$address." ".$address2."\n";
		$body.="City, State Zip: ".$city.",".$state." ".$zip."\n";
		$body.="Email: $email\n";
		$body.="Phone: $phone\n";
		$body.="\n\n";
		$body.="" . stripslashes(checkit($_POST['notes'])) . "";
	//	mail($To,$subject,$body,"From: $email");
		@mail($To, $subject, $body, $headers);
		$stamp=mktime();
		$sql="insert into tblContact values ('','$fname','$lname','$address','$address2','$city','$state','$zip','$email','$phone','$best_time','$interested','$notes','$stamp')";
		$result=db_query($sql);
		}
}

?>
<script>
		window.alert("Your contact email has been submitted.");
		window.location.href='http://www.techniart.us/dukeenergy'
</script>
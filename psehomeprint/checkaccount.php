<? include("database.php");?>
<?
include("ship_class.php");
$ship_format=$ship;
$otsID=$_POST['otsID'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$ship_fname=$_POST['ship_fname'];
$ship_lname=$_POST['ship_lname'];
$ship_address1=$_POST['ship_address1'];
$ship_address2=$_POST['ship_address2'];
$ship_city=$_POST['ship_city'];
$ship_state=$_POST['ship_state'];
$ship_zip=$_POST['ship_zip'];
$bill_country=$_POST['country'];
$ship_country=$_POST['ship_country'];
$amount=$_POST['amount'];
$name=$_POST['firstName'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$nmsplit=explode(" ",$name);
$firstName=$_POST['firstName'];
$ship_option=$_SESSION["shipping"]["option"];
$lastName=$_POST['lastName'];
$creditCardType=$_POST['creditCardType'];
$creditCardNumber=$_POST['creditCardNumber'];
$len=strlen($creditCardNumber);
$minus=$len-4;
$obscure=substr($creditCardNumber,$minus,$len);
if($creditCartType=='Amex'){
	$cardnumobscure="XXXX-XXXX-XXX-".$obscure;
}else{
	$cardnumobscure="XXXX-XXXX-XXXX-".$obscure;
}

$expDateMonth=$_POST['expDateMonth'];
$expDateYear=$_POST['expDateYear'];
$cvv2Number=$_POST['cvv2Number'];
$instr=$_POST['instr'];
?>
<?
$account=$_POST['account'];
$_SESSION['acct']=$account;
$sql="select * from tblAccount where account='$account'";
#print("".$sql."<br>");
$result=db_query($sql);
$countzip=mysql_num_rows($result);
if($countzip>0){header("location:confirm-pre.php");	
}else{header ("location:orderform1.php");}
?>
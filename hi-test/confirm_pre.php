<? include("database.php"); ?>
<?
$otsID=$_POST['otsID'];
$amount=$_POST['amount'];
$people=$_POST['people'];
$water=$_POST['water'];
$island=$_POST['island'];
$ship_fname=$_POST['ship_fname'];
$ship_lname=$_POST['ship_lname'];
$ship_address1=$_POST['ship_address1'];
$ship_address2=$_POST['ship_address2'];
$ship_city=$_POST['ship_city'];
$ship_state=$_POST['ship_state'];
$ship_zip=$_POST['ship_zip'];
$email=$_POST['email'];
$account=$_POST['account'];
$email_opt=$_POST['email_opt'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];

$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$creditCardType=$_POST['creditCardType'];
$creditCardNumber=$_POST['creditCardNumber'];
$len=strlen($creditCardNumber);
$minus=$len-4;
$fname = str_replace("'", "&#39;", $fname);
$lname = str_replace("'", "&#39;", $lname);
$ddress1 = str_replace("'", "&#39;", $address1);
$city = str_replace("'", "&#39;", $city);
$ship_fname = str_replace("'", "&#39;", $ship_fname);
$ship_lname = str_replace("'", "&#39;", $ship_lname);
$ship_address1 = str_replace("'", "&#39;", $ship_address1);
$ship_city = str_replace("'", "&#39;", $ship_city);
$fname = str_replace("&#699;", "&#39;", $fname);
$lname = str_replace("&#699;", "&#39;", $lname);
$address1 = str_replace("&#699;", "&#39;", $address1);
$city = str_replace("&#699;", "&#39;", $city);
$ship_fname = str_replace("&#699;", "&#39;", $ship_fname);
$ship_lname = str_replace("&#699;", "&#39;", $ship_lname);
$ship_address1 = str_replace("&#699;", "&#39;", $ship_address1);
$ship_city = str_replace("&#699;", "&#39;", $ship_city);



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
$order=$ship_fname . ',' . $ship_lname . ',' . $ship_address1 . ',' . $ship_address2 . ',' . $ship_city . ',' . $ship_state . ',' . $ship_zip . ',' . $fname . ',' . $lname . ',' . $address1 . ',' . $address2 . ',' . $city . ',' . $state . ',' . $zip . ',' . $island . ',' . $email_opt . ',' . $email . ',' . $water . ',' . $people . ',' . $otsID;
?>

<?
$ship_zip=$_POST['ship_zip'];
$sql="select * from tblTerritory where zip='$ship_zip'";
#print("".$sql."<br>");
$result=db_query($sql);
$countzip=mysql_num_rows($result);
if($countzip<1){echo "<SCRIPT LANGUAGE='JavaScript'>
	window.alert('The shipping zip code you entered does not qualify!')
		window.location.href='orderform.php'
        </SCRIPT>
        ";
		die();}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Marketing The Future</title>


<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>

<BODY onLoad='document.form1.submit();'>

<?
$o=$_SESSION['otsID'];
if(!$o){
	$o=$_POST['otsID'];
}
$_SESSION['otsID']=$o;
$_COOKIE['otsID']=$o;
	$sql21="update tblotsdetail set orderinfo='$order' where otsID='$o'";
$result21=mysql_query($sql21);
$sql="select * from tblotsdetail where otsID='$o'";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
if(!$count){
}else{
	while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
		$tot1=number_format($qty*$price, 2, '.', ',');
		$tot=$qty*$price;
		$carttot+=$tot;
		$itemNo=$row['itemNo'];
		$productDesc=$row['productDesc'];
		$lbl="";
		#check for free shipping
		$free_ship="";
		$lbl="";
		$sqlfreeship="select free_ship,ct_tax_exempt,weight from tblProducts where productID='$itemNo'";

	}
?>
<form action="confirm.php" name="form1" id="form1" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type="hidden" name="amount" value="<? echo($totformat); ?>">
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>">
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>">
<input type=hidden name="ship_address1" value="<? echo($ship_address1); ?>"> 
<input type=hidden name="ship_address2" value="<? echo($ship_address2); ?>">
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>">
<input type=hidden name="city" value="<? echo($city); ?>">
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="account" value="<? echo($account); ?>" />
<input type=hidden name="email_opt" value="<? echo($email_opt); ?>" />
<input type=hidden name="fname" value="<? echo($fname); ?>" />
<input type=hidden name="lname" value="<? echo($lname); ?>" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="firstName" value="<? echo($firstName); ?>" />
<input type=hidden name="lastName" value="<? echo($lastName); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type=hidden name="island" value="<? echo($island); ?>">
<input type=hidden name="people" value="<? echo($people); ?>">
<input type=hidden name="water" value="<? echo($water); ?>">

</form>
<?}?>
</body>

</html>
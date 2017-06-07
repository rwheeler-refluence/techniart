<? include("database.php"); ?>
<?
$otsID=$_POST['otsID'];
$amount=$_POST['amount'];
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
$sfname=$_POST['sfname'];
$slname=$_POST['slname'];
$saddress1=$_POST['saddress1'];
$saddress2=$_POST['saddress2'];
$scity=$_POST['scity'];
$sstate=$_POST['sstate'];
$szip=$_POST['szip'];
$water=$_POST['water'];
$firstName=$_POST['firstName'];
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
$order=$ship_fname . ',' . $ship_lname . ',' . $ship_address1 . ',' . $ship_address2 . ',' . $ship_city . ',' . $ship_state . ',' . $ship_zip . ', '. $fname . ',' . $lname . ',' . $address1 . ',' . $address2 . ',' . $city . ',' . $state . ',' . $zip . ', '. $sfname . ',' . $slname . ',' . $saddress1 . ',' . $saddress2 . ',' . $scity . ',' . $sstate . ',' . $szip . ', ' . $email;
?>
<?
#print $order;
if(!$email){echo "<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Please enter a valid email address to continue!')
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
$o=$_POST['otsID'];
$sql2="update tblotsdetail3 set orderinfo='$order' where otsID='$o'";
	$result2=db_query($sql2);
	#print $sql2;
$sql="select * from tblotsdetail3 where otsID='$o'";
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
<input type=hidden name="fname" value="<? echo($fname); ?>" />
<input type=hidden name="lname" value="<? echo($lname); ?>" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="sfname" value="<? echo($sfname); ?>" />
<input type=hidden name="slname" value="<? echo($slname); ?>" />
<input type=hidden name="saddress1" value="<? echo($saddress1); ?>" />
<input type=hidden name="saddress2" value="<? echo($saddress2); ?>" />
<input type=hidden name="scity" value="<? echo($scity); ?>" />
<input type=hidden name="sstate" value="<? echo($sstate); ?>" />
<input type=hidden name="szip" value="<? echo($szip); ?>" />
<input type=hidden name="firstName" value="<? echo($firstName); ?>" />
<input type=hidden name="lastName" value="<? echo($lastName); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="instr" value="<? echo($instr); ?>">
</form>
<?}?>
</body>

</html>
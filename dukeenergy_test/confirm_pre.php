<? include("database.php"); ?>
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
$amount=$_POST['amount'];
$name=$_POST['firstName'];
$email=$_POST['email'];
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
$ship_zip=$_POST['ship_zip'];
$_SESSION['zip_check']=$ship_zip;
$sql="select * from tblTerritory where zip='$ship_zip'";
#print("".$sql."<br>");
$result=db_query($sql);
$countzip=mysql_num_rows($result);
if($countzip<1){echo "<SCRIPT LANGUAGE='JavaScript'>
	window.alert('The shipping zip code you entered does not qualify!')
		window.location.href='https://www.techniart.com/dukeenergy/orderform.php'
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
$sql="select * from tblotsdetail_1 where otsID='$o'";
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
		if ($tot>25){
		$rate=0;
		}
		$itemNo=$row['itemNo'];
		$productDesc=$row['productDesc'];
		$lbl="";
		#check for free shipping
		$free_ship="";
		$lbl="";
		$sqlfreeship="select free_ship,ct_tax_exempt,weight from tblProducts where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$free_ship=$rowfreeship['free_ship'];
			$ct_tax_exempt=$rowfreeship['ct_tax_exempt'];
			if($ct_tax_exempt=='No'){
				$sales_tax_tot+=$tot;
			}
			$weight1=$rowfreeship['weight'];
			$weight1=str_replace("-","",$weight1);
			$weight1=str_replace(" lbs.","",$weight1);
			$weight1=$weight1*$qty;
			$weight+=$weight1;
		}
		if($free_ship=='Yes'){
			$lbl="<br><span style=\"color:RED\">* - This product qualifies for free shipping</span>";
		}

#		print("weight:".$weight."<br>");
		
		#check for discounts based on zip if they haven't already entered it.
		if(!$_SESSION['zip']){
			$zz=$_POST['ship_zip'];
			$sqlz="select * from tblDiscounts LEFT OUTER JOIN tblProducts on tblDiscounts.item_no=tblProducts.modelNumber where tblProducts.productID='$itemNo' && zip='$zz'";
			#print($sqlz);
			$resultz=db_query($sqlz);
			$countz=mysql_num_rows($resultz);
			if($countz>0){
				while($rowz=mysql_fetch_array($resultz)){
					$disct_price=$rowz['disct_price'];
					$sqlu="update tblotsdetail_1 set price='$disct_price' where otsdetailID='$otsdetailID'";
					#print($sqlu);
					$resultu=db_query($sqlu);
					$lbl.="<br><span style=\"color:RED\">* - Note: Based on your zip code you are eligible for discounted pricing on this item.  The reduced price has automatically been applied to your order.</span>\n";
				}
			}
		}
		#end discount check
	
	if($state=='CT' || $state=='NJ'){
		$sales_tax_tot=$sales_tax_tot+$_SESSION['ship'];
		switch($state){
			case "CT":
				$taxamt=$sales_tax_tot*.06;
			break;
			case "NJ":
				$taxamt=$sales_tax_tot*.07;
			break;
		}
		$taxformat=number_format($taxamt, 2, '.', ',');
		$finaltot=$carttot+$taxamt;
	}else{
		$finaltot=$carttot;
	}
	}?>
<form action="confirm.php" name="form1" id="form1" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="description" value="<? echo(date("m/d/Y")); ?> order from techniart.com" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="fname" value="<? echo($fname); ?>" />
<input type=hidden name="lname" value="<? echo($lname); ?>" />
<input type=hidden name="firstName" value="<? echo($firstName); ?>" />
<input type=hidden name="lastName" value="<? echo($lastName); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>">
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>">
<input type=hidden name="ship_address1" value="<? echo($ship_address1); ?>"> 
<input type=hidden name="ship_address2" value="<? echo($ship_address2); ?>">
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>">
<input type=hidden name="city" value="<? echo($city); ?>">
<input type=hidden name="tax" value="<? echo($taxformat); ?>">
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>">
<input type=hidden name="ship_option" value="<? echo($ship_option); ?>">
<input type=hidden name="ship_price" value="<? echo($_SESSION['ship']); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type="hidden" name="amount" value="<? echo($totformat); ?>">
</form>
<?}?>
</body>
</html>
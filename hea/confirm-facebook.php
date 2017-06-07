<? include("database.php"); ?>
<?
include("ship_class.php");
	require("ups_extended.php");
$ship_format=$ship;
$otsID=$_POST['otsID'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$company=$_POST['company'];
$zip=$_POST['zip'];
$fname=$_POST['firstName'];
$lname=$_POST['lastName'];
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
$email_opt=$_POST['email_opt'];
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<link rel="icon" 
      type="image/png" 
      href="icon.png">
<title>TechniArt - Order Confirmation</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #F0F0F0;
}
-->
</style></head>

<BODY><?php include("bluebar.php") ?><br>


<center><div align="center" class="fbwhitebox"><?php include("header.php") ?>
<?php include_once("analyticstracking.php") ?><table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="bkg_body-main">
  <tr valign="top">

<td width="760"><div id="main_content_ip" align="left">

<p class="body_content_style1">
<?
print("<div style=\"padding-left:55px;\"><p class=\"body_content_style1\">");
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail_facebook_test where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
if(!$count){
	print("<b>Your cart is empty</b><br />\n");
}else{
	print("<b>Your cart contains the following:</b></p></div><br />\n");
	print("<table width=\"700\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td><span class=\"section_heading_style1\"><b>Qty</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Item</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Price</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Total</b></span></td>\n");
	print("</tr>\n");
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
		$sqlfreeship="select free_ship,ct_tax_exempt,weight from tblProducts_facebook where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$free_ship=$rowfreeship['free_ship'];
			$ct_tax_exempt=$rowfreeship['ct_tax_exempt'];
			if($ct_tax_exempt!=='Yes'){
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

		#check for discounts based on zip if they haven't already entered it.
		if(!$_SESSION['zip']){
			$zz=$_POST['ship_zip'];
			$sqlz="select * from tblDiscounts LEFT OUTER JOIN tblProducts_facebook on tblDiscounts.item_no=tblProducts_facebook.modelNumber where tblProducts_facebook.productID='$itemNo' && zip='$zz'";
			#print($sqlz);
			$resultz=db_query($sqlz);
			$countz=mysql_num_rows($resultz);
			if($countz>0){
				while($rowz=mysql_fetch_array($resultz)){
					$disct_price=$rowz['disct_price'];
					$sqlu="update tblotsdetail_facebook_test set price='$disct_price' where otsdetailID='$otsdetailID'";
					#print($sqlu);
					$resultu=db_query($sqlu);
					$lbl.="<br><span style=\"color:RED\">* - Note: Based on your zip code you are eligible for discounted pricing on this item.  The reduced price has automatically been applied to your order.</span>\n";
				}
			}
		}
		#end discount check
	
		print("<tr valign=\"top\" bgcolor=\"#ffffff\">\n");
		print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">".$productDesc."".$lbl."</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".$tot1."</span></td>\n");
		print("</tr>\n");
	}
#	print("weight: ".$weight."<br>");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");
	if($state=='CT' || $state=='RI' || $state=='ME' || $state=='MA'){
		$sales_tax_tot=$sales_tax_tot+$_SESSION['ship'];
		switch($state){
			case "CT":
				$taxamt=$sales_tax_tot*.0635;
			break;
			case "RI":
				$taxamt=$sales_tax_tot*.07;
			break;
			case "ME":
				$taxamt=$sales_tax_tot*.055;
			break;

			case "MA":
				$taxamt=$sales_tax_tot*.0625;
			break;
		}
		$taxformat=number_format($taxamt, 2, '.', ',');
		$finaltot=$carttot+$taxamt;
		print("<tr bgcolor=\"#ffffff\">\n");
		print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>");
		if($state=='CT' || $state=='RI' || $state=='ME' || $state=='MA'){
			print(strtoupper($state)." ");
		}
		print("State Sales Tax:</b>&nbsp;</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".$taxformat."</span></td>\n");
		print("</tr>\n");
	}else{
		$finaltot=$carttot;
	}
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$");
	#ship($weight,$otsID,$ship_zip,$finaltot);
	$service = '03';
	$length = '20';
	$width = '10';
	$height = '10';
	$weight = $weight;
	if($weight==0){
		$quote="0.00";
		$_SESSION['ship']=$quote;
	}else{
		if(!$weight){
			$weight=".50";
		}
	}
	$dest_zip = $zip;


	$rate = ups($dest_zip,$service,$weight,$length,$width,$height);
	if($rate<1){
		$rate1=ceil($tot*.00);
		$rate=number_format($rate1+$additl, 2, '.', '');
	}
	$ship=$rate;
	print("".$rate."\n");
	$_SESSION['ship']=$rate;
	print("<input type=\"hidden\" name=\"ship\" value=\"".$rate."\">\n");

	print("</span></td>\n");
	print("</tr>\n");
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\">");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Totals:</b>&nbsp;</span></td>\n");
	$totformat=number_format($finaltot+$_SESSION['ship'], 2, '.', ',');
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".$totformat."</span></td>\n");
	print("</tr>\n");
	
?>
<form action="process-facebook.php" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="ship" value="<? echo($rate);?>">
<input type=hidden name="description" value="<? echo(date("m/d/Y")); ?> order from techniart.com" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="company" value="<? echo($company); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="email_opt" value="<? echo($email_opt); ?>" />
<input type=hidden name="country" value="<? echo($country); ?>" />
<input type=hidden name="firstName" value="<? echo($fname); ?>" />
<input type=hidden name="lastName" value="<? echo($lname); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>">
<input type=hidden name="ship_country" value="<? echo($ship_country); ?>">
<input type=hidden name="bill_country" value="<? echo($bill_country); ?>">
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
<!--<span class="body_content_style1"><b>Shipping Method Chosen:</b><br><? echo($_SESSION["shipping"]["option"]);?></span></td>-->
<center>
<a class="body_content_style1" href="orderform.php?ID=<? echo($otsID); ?>&state=<? echo($ship_state); ?>"><span class="body_content_style1">&lt;Go back and make changes</span></a>
<table width="480" cellpadding="1" cellspacing="1"><tr valign="top">
<td width="235" align="left">
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Shipping Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><? echo($ship_fname); ?> <? echo($ship_lname); ?><br><? echo($ship_address1); ?> <? echo($ship_address2); ?><br>
<? echo($city); ?>, <? echo($ship_state); ?><br><? echo($ship_zip); ?><br><br></span></td>
</tr></table>
</span></td>
<td width="10">&nbsp;</span></td>
<td width="235" align="left">
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Billing Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><? echo($fname); ?> <? echo($lname); ?><br><? echo($address1); ?> <? echo($address2); ?><br>
<? echo($city); ?>, <? echo($state); ?><br><? echo($zip); ?>
<br><br>
<b>Email:</b> <? echo($email); ?>
<br><br>
<b>MassSave Email Opt-In:</b> <? echo($ship_country); ?>
<br><br>
<b>Utility Company:</b> <? echo($company); ?>
</span></td>
</tr></table>
</span></td>
</tr><tr valign="top">
<td class="body_content_style1" colspan="3" align="left">
<img src="pix/pix_trans.gif" width="1" height="10"><br>
<span class="body_content_style1"><h2>Payment Info:</h2></span>
<table>
<input type="hidden" name="amount" value="<? echo($totformat); ?>">
<!--<tr valign="top">
<td><span class="body_content_style1">Amount:</span></td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</span></td>
</tr>--><tr valign="top">
<td><span class="body_content_style1">Name: (as it appears on credit card)</span></td>
<td><span class="body_content_style1"><? echo($firstName); ?> <? echo($lastName); ?></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Type:</span></td>
<td><span class="body_content_style1"><? echo($creditCardType); ?></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Number:</span></td>
<td><span class="body_content_style1"><? echo($cardnumobscure); ?></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Expiration Date:</span></td>
<td><span class="body_content_style1"><? echo($expDateMonth); ?>/<? echo($expDateYear); ?></span></td>
</span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Verification Number:</span></td>
<td><span class="body_content_style1"><? echo($cvv2Number); ?></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Special Instructions:</span></td>
<td><span class="body_content_style1"><? echo($instr); ?></span></td>
</tr><tr valign="top">
<td colspan="2" align="center"><img src="pix/pix_trans.gif" width="1" height="10"><br><div align="center"><input type="button" value ="Place Order" onClick="this.form.submit();" /></div><br><strong class="body_content_events-private">Please click the process button once to avoid duplicate charges.</strong></span></td>
</tr></table>
</span></td></tr></table>
</form>
<?}?>
</p></td>
</tr></table></td>
</tr></table>
<table width="760" height="15"border="0" align="center" cellpadding="0" cellspacing="0" background="back-bottom.jpg">
  <tr>
    <td></td>
  </tr>
</table>
  <?php include_once("footer.php") ?>
</div></center>
</body>
</html>


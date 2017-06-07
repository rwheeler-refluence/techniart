<? include("database.php"); ?>
<?
include("ship_class.php");
	require("ups_extended.php");
$ship_format=$ship;
$zipcheck=($_SESSION['zip']);
$discount=($_SESSION['discount']);
$otsID=$_POST['otsID'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$bill_zip=$_POST['bill_zip'];
$fname=$_POST['firstName'];
$lname=$_POST['lastName'];
$ship_fname=$_POST['ship_fname'];
$ship_lname=$_POST['ship_lname'];
$ship_address1=$_POST['ship_address1'];
$ship_address2=$_POST['ship_address2'];
$ship_city=$_POST['ship_city'];
$ship_state=$_POST['ship_state'];
$ship_zip=$_POST['ship_zip'];
$bill_county=$_POST['county'];
$ship_county=$_POST['ship_county'];
$amount=$_POST['amount'];
$name=$_POST['firstName'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$nmsplit=explode(" ",$name);
$firstName=$_POST['firstName'];
$ship_option=$_SESSION["shipping"]["option"];
$lastName=$_POST['lastName'];
$company=("Entrust Energy - ".$_SESSION['rep']."");
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
<title>TechniArt - Marketing The Future</title>

<meta name="robots" content="index,follow" />
<meta name="author" content="TechniArt" />
<meta name="publisher" content="techniart.com" />
<meta name="copyright" content="Copyright 2008 TechniArt. All Rights Reserved" />
<meta http-equiv="content-language" content="EN" />
<meta name="content-language" content="EN" />
<meta name="rating" content="All" />
<meta name="audience" content="General" />
<meta name="distribution" content="Global" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<? if($_SESSION['rep']=="CNP"){?><link rel="STYLESHEET" type="text/css" href="cnp.css"><?;}?>
<? if($_SESSION['rep']=="AEP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="TMNP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="NQ"){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
<? if($_SESSION['rep']==""){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
</head>
<BODY>
<?php include_once("analyticstracking.php") ?>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->
<center><div class="rcorners2">
<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div id="title_spacer" align="left"><span class="title_main">Confirmation</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style4"><strong>Get $7 flat rate shipping</strong> on all orders over $25!</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="rcorners3"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">

<p class="body_content_style1">
<?
#print ($ship_zip);
#print ("<br>");
#print ($zipcheck);
#print ("<br>");
print("<div style=\"padding-left:55px;\"><p class=\"body_content_style1\">");
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail_entrust where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
if(!$count){
	print("<b>Your cart is empty</b><br />\n");
}else{
	print("<b>Your cart contains the following:</b></p></div><br />\n");
	print("<table width=\"830\" cellpadding=\"4\" cellspacing=\"2\">\n");
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
		$sqlfreeship="select free_ship,ct_tax_exempt,weight from tblProducts where productID='$itemNo'";
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
	
	#if($carttot>=25 && $_SESSION['coupon']){
	#$rate=0;
	#$rate=number_format($rate, 2, '.', ',');
	#print ("".$rate."\n\n");	
	#print ("<br><span class=\"body_content_events-private\">This order qualifies <br>for FREE shipping.</span>");}
	#if($carttot<=$_SESSION['discount'] && $_SESSION['coupon'] && $vendor==30){
	#echo "<SCRIPT LANGUAGE='JavaScript'>
      #  window.alert('The shipping zip code you entered is qualified for FREE shipping.  You must re-fill your order form.')
	#	window.location.href='https://www.techniart.com/amigo/orderform1.php'
    #/SCRIPT>";}
	
	if ($carttot>=25 && !$_SESSION['coupon']){
	$rate=7;
	$rate=number_format($rate, 2, '.', ',');
	print("".$rate."\n");
	print ("<br><span class=\"body_content_events-private\">This order qualifies for <br>flat rate shipping.</span>");
	}else{
	if ($carttot>=25 && $_SESSION['coupon'] && $_SESSION['rep']=="AEP"){
	$rate=7;
	$rate=number_format($rate, 2, '.', ',');
	print("".$rate."\n");
	print ("<br><span class=\"body_content_events-private\">This order qualifies for <br>flat rate shipping.</span>");
	}else{
	if ($carttot>=25 && $_SESSION['coupon'] && $_SESSION['rep']=="NQ"){
	$rate=7;
	$rate=number_format($rate, 2, '.', ',');
	print("".$rate."\n");
	print ("<br><span class=\"body_content_events-private\">This order qualifies for <br>flat rate shipping.</span>");
	}else{
	if ($carttot>=25 && $_SESSION['coupon'] && $_SESSION['rep']==''){
	$rate=7;
	$rate=number_format($rate, 2, '.', ',');
	print("".$rate."\n");
	print ("<br><span class=\"body_content_events-private\">This order qualifies for <br>flat rate shipping.</span>");
	}else{
	if ($carttot>=25 && $_SESSION['coupon'] && $_SESSION['rep']=="CNP"){
	$rate=0;
	$rate=number_format($rate, 2, '.', ',');
	print("".$rate."\n");
	print ("<br><span class=\"body_content_events-private\">This order qualifies for <br>FREE shipping.</span>");
	}else{
	if($carttot<25){print("".$rate."\n");}}}}}}
	$rate=number_format($rate+$_SESSION['ship'], 2, '.', ',');
	print("<input type=\"hidden\" name=\"ship\" value=\"".$rate."\">\n");
	print("</span></td>\n");
	print("</tr>\n");
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\">");
	if($_SESSION['coupon']>0){
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Discount:</b>&nbsp;</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">-".$discount."</span></td>\n");
	print("</tr>\n");}
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Total:</b>&nbsp;</span></td>\n");
	$totformat=number_format($carttot+$rate-$discount, 2, '.', ',');
	if($totformat<0){
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$0.00</span></td>\n");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_ip\"><b>Negative totals default to $0</b>&nbsp;</span></td>\n");
	print("</tr>\n");
	}else{
	
	if($totformat>0){
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".$totformat."</span></td>\n");}
	print("</tr>\n");}
	if($totformat<0){
	print("<form action=\"process-free.php\" method=\"POST\">");
	}else{
	if($totformat>0){
	print("<form action=\"process.php\" method=\"POST\">");}
}?>

<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="ship" value="<? echo($rate);?>">
<input type=hidden name="description" value="<? echo(date("m/d/Y")); ?> order from techniart.com" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($bill_zip); ?>" />
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="county" value="<? echo($county); ?>" />
<input type=hidden name="firstName" value="<? echo($fname); ?>" />
<input type=hidden name="lastName" value="<? echo($lname); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>">
<input type=hidden name="ship_county" value="<? echo($ship_county); ?>">
<input type=hidden name="phone" value="<? echo($phone); ?>">
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>">
<input type=hidden name="ship_address1" value="<? echo($ship_address1); ?>"> 
<input type=hidden name="ship_address2" value="<? echo($ship_address2); ?>">
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>">
<input type=hidden name="coupon" value="<? echo($_SESSION['coupon']); ?>">
<input type=hidden name="discount" value="<? echo($_SESSION['discount']); ?>">
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>">
<input type=hidden name="ship_option" value="<? echo($ship_option); ?>">
<input type=hidden name="ship_price" value="<? echo($rate); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type=hidden name="company" value="<? echo($company); ?>">
<input type=hidden name="rep" value="<? echo($_SESSION['rep']); ?>">
<!--<span class="body_content_style1"><b>Shipping Method Chosen:</b><br><? echo($_SESSION["shipping"]["option"]);?></span></td>-->
<center>
<a class="body_content_style1" href="orderform.php"><span class="body_content_style1">&lt;Go back and make changes</span></a>
<table width="480" cellpadding="1" cellspacing="1"><tr valign="top">
<td width="235" align="left"> 
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Shipping Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><strong>Name:</strong> <? echo($ship_fname); ?> <? echo($ship_lname); ?><br><strong>Address: </strong><? echo($ship_address1); ?> <? echo($ship_address2); ?><br>
<strong>City/State: </strong><? echo($ship_city); ?>, <? echo($ship_state); ?><br><strong>ZIP Code: </strong><? echo($ship_zip); ?><br><strong>County: </strong><? echo($ship_county); ?><br><br>
<strong>Phone number: </strong><? echo($phone); ?>
<br>
<strong>Email: </strong><? echo($email); ?><br>
<? if($_SESSION['coupon']){?><strong>Coupon: </strong><? echo($_SESSION['coupon']);} ?>
<br></span></td>
</tr></table>
</span></td>
<td width="10">&nbsp;</span></td>
<td width="235" align="left">
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Billing Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><strong>Name: </strong><? echo($fname); ?> <? echo($lname); ?><br><strong>Address: </strong><? echo($address1); ?> <? echo($address2); ?><br>
<strong>City/State: </strong><? echo($city); ?>, <? echo($state); ?><strong><br>ZIP Code: </strong><? echo($bill_zip); ?><br>
<strong>County: </strong><? echo($county); ?><br>
<? echo($_SESSION['rep']);?>
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
<td colspan="2" align="center"><img src="pix/pix_trans.gif" width="1" height="10"><br><div align="center"><input type="button" value ="Place Order" class="btn" onClick="this.form.submit();" /></div><br>Please click the Place Order button only once to avoid duplicate charges<br /> If you have a $0 balance, your card will not be charged.</span></td>
</tr></table>
</span></td></tr></table>
</form>
<?}?>
</p><br>


</div></td>
<td></td>
</tr></table>

</div></td>
</tr></table>


<!-- ------------------------------end body------------------------------ -->
</div>
<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
</html>


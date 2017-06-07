<? include("database.php");?>


<?

session_start();

$ship_format=$ship;
$otsID=$_POST['otsID'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
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
$phone=$_POST['phone'];
$ship_country=$_POST['ship_country'];
$amount=$_POST['amount'];
$location=$_POST['location'];
$name=$_POST['firstName'];
$email=$_POST['email'];
$nmsplit=explode(" ",$name);
$firstName=$_POST['firstName'];
$ship_option=$_SESSION["shipping"]["option"];
$lastName=$_POST['lastName'];
$creditCardType=$_POST['creditCardType'];
$creditCardNumber=$_POST['creditCardNumber'];
$company=("Cambridge LTO");
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
<html>
<head>
<title>TechniArt - Confirmation</title>
<!-- ------------------------------end header------------------------------ -->
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<style type="text/css">
<!--
body,td,th {
	color: #000000;
}
a:link {
	color: #FFFFFF;
}
a:visited {
	color: #FFFFFF;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<BODY>
<div align="center"><? include("header.php");?>
<!-- ------------------------------begin header------------------------------ -->
<!-- ------------------------------end header------------------------------ -->
<center><div class="rcorners2">
<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div id="title_spacer" align="left"><span class="title_main">Confirmation</span></div></td>

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
$sql="select * from tblotsdetail where otsID='$o'";
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
			$lbl="<br><span style=\"color:RED\">* - $7 flat rate shipping on packs FREE for the first 150 customers.</span>";
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
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Flat Rate Shipping:</b>&nbsp;</span></td>\n");
	
	$ship = "10";
	$discount = "7";
	$rate =$ship-$discount;
	
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
	if($rate>0){print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$");
			   }else{print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">FREE");}
	$ship=number_format($ship+$_SESSION['ship'], 2, '.', ',');
	print("".$ship."\n");
	
	print("</span></td>\n");
	print("</tr>\n");
	
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\">");
	
	
	$totformat=number_format($carttot+$rate, 2, '.', ',');
$taxamount=.0633;
		#print_r($taxamount);
		$taxamt=$carttot*$taxamount;
		$taxformat=number_format($taxamt, 2, '.', ',');
		$finaltot=number_format($carttot+$taxformat+$rate, 2, '.', ',');
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Sales Tax:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".number_format($taxformat, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Discount:</b><br>
Provided by Cambridge Energy Alliance&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">-$".number_format($discount, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");
		
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Total:</b>&nbsp;</span></td>\n");
	
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".$finaltot."</span></td>\n");
	print("</tr>\n");
		
?>

<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="description" value="<? echo(date("m/d/Y")); ?> order from techniart.com" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="firstName" value="<? echo($fname); ?>" />
<input type=hidden name="lastName" value="<? echo($lname); ?>" />
<input type=hidden name="fname" value="<? echo($fname); ?>" />
<input type=hidden name="lname" value="<? echo($lname); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>">
<input type=hidden name="company" value="<? echo($company); ?>">
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>">
<input type=hidden name="ship_address1" value="<? echo($ship_address1); ?>"> 
<input type=hidden name="ship_address2" value="<? echo($ship_address2); ?>">
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>">
<input type=hidden name="tax" value="<? echo($taxformat); ?>">
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>">
<input type=hidden name="ship_price" value="<? echo($rate); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="instr" value="<? echo($instr); ?>">

<center>
<a class="body_content_style1" href="orderform.php"><span class="body_content_style1">&lt;Go back and make changes</span></a>
<table width="480" cellpadding="1" cellspacing="1"><tr valign="top">
<td width="235" align="left"> 
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Shipping Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><strong>Name:</strong> <? echo($ship_fname); ?> <? echo($ship_lname); ?><br><strong>Address: </strong><? echo($ship_address1); ?> <? echo($ship_address2); ?><br>
<strong>City/State: </strong><? echo($ship_city); ?>, <? echo($ship_state); ?><br><strong>ZIP Code: </strong><? echo($ship_zip); ?><br><br>
<strong>Email: </strong><? echo($email); ?><br><? #echo($rate)?>
<br></span></td>
</tr></table>
</span></td>
<td width="10">&nbsp;</span></td>
<td width="235" align="left">
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Billing Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><strong>Name: </strong><? echo($fname); ?> <? echo($lname); ?><br><strong>Address: </strong><? echo($address1); ?> <? echo($address2); ?><br>
<strong>City/State: </strong><? echo($city); ?>, <? echo($state); ?><strong><br>ZIP Code: </strong><? echo($zip); ?><br>
<br>

</span></td>
</tr></table>
</span></td>
</tr><tr valign="top">
<td class="body_content_style1" colspan="3" align="left">
<img src="pix/pix_trans.gif" width="1" height="10"><br>
<span class="body_content_style1"><h2>Payment Info:</h2></span>
<table>
<input type="hidden" name="amount" value="<? echo($finaltot); ?>">
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
<td colspan="2" align="center"><img src="pix/pix_trans.gif" width="1" height="10"><br><div align="center"><input type="button" value ="Place Order" class="btn" onClick="this.form.submit();" /></div><br><span class="body_content_style1">Please click the Place Order button only once to avoid duplicate charges<br /></span></td>
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
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</body>
</html>


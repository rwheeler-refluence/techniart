<? include("database.php"); ?>
<?
$source=$_SESSION['source'];
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
$water=$_POST['water'];
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$company=("Duke WebStore");
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
include("ship_class.php");
	require("ups_extended.php");
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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">

<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="respond.min.js"></script>

</head><?php include_once("analyticstracking.php") ?><? include("nav.php")?>
<BODY><center><div class="gridContainer clearfix"><div id="LayoutDiv1"><? include("header.php")?>
</div>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="main">
  <tr>
    <td>
<?
print("<div style=\"padding-left:3%;\"><p class=\"cart\">");
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail_1 where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
if(!$count){
	print("<b>Your cart is empty</b><br />\n");
}else{
	print("<b>Your cart contains the following:</b></p></div><br />\n");
	print("<table width=\"95%\" cellpadding=\"4\" cellspacing=\"2\" align=\"center\">\n");
	print("<tr valign=\"top\">\n");
	print("<td><span class=\"cart-header\"><b>Qty</b></span></td>\n");
	print("<td><span class=\"cart-header\"><b>Item</b></span></td>\n");
	print("<td><span class=\"cart-header\"><b>Price</b></span></td>\n");
	print("<td><span class=\"cart-header\"><b>Total</b></span></td>\n");
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
	
		print("<tr valign=\"top\">\n");
		print("<td style=\"padding-left:4px;\"><span class=\"cart\">".$qty."</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"cart\">".$productDesc."".$lbl."</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".$tot1."</span></td>\n");
		print("</tr>\n");
	}
#	print("weight: ".$weight."<br>");
	print("<tr>\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");
	print("<tr>\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart\"><b>Shipping:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$");
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
	if ($carttot>=15){
		$rate='5.00';
	print (''.$rate."\n\n");
	$rate=number_format($rate, 2, '.', ',');
	print ("<br><span class=\"cart-sm\">This order qualifies for <br>$5 flat rate shipping.</span>");
	}else{ 
	print("".$rate."\n");
	$rate=number_format($rate+$_SESSION['ship'], 2, '.', ',');
	print("<input type=\"hidden\" name=\"ship\" value=\"".$rate."\">\n");
}
	print("</span></td>\n");
	print("</tr>\n");
#	print("<tr>\n");
#	print("<td colspan=\"5\" align=\"right\">");
	print("<tr>\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart\"><b>Totals:</b>&nbsp;</span></td>\n");
	$totformat=number_format($carttot+$rate, 2, '.', ',');
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".$totformat."</span></td>\n");
	print("</tr>\n");
	
?>
<form action="process.php" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="ship" value="<? echo($rate);?>">
<input type=hidden name="description" value="<? echo(date("m/d/Y")); ?> order from techniart.com" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="country" value="<? echo($country); ?>" />
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
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>">
<input type=hidden name="ship_option" value="<? echo($ship_option); ?>">
<input type=hidden name="ship" value="<? echo($rate); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type=hidden name="company" value="<? echo($company); ?>">
<center>
<a class="cart" href="orderform.php"><span class="cart">&lt;Go back and make changes</span></a>
<table width="100%" style="margin-left: 3%">
  <tr valign="top">
    <td><span class="cart-header">Shipping Address:</span></td>
  </tr>
  <tr valign="top">
    <td><span class="cart"><? echo($ship_fname); ?> <? echo($ship_lname); ?></span><br>
     <span class="cart"> <? echo($ship_address1); ?>&nbsp;<? echo($ship_address2); ?></span><br>
      <span class="cart"><? echo($ship_city); ?>, <? echo($ship_state); ?> <? echo($ship_zip); ?></span>
    </td>
  </tr>
</table><br>

<table width="100%" style="margin-left: 3%">
  <tr valign="top">
    <td><span class="cart-header">Billing Address:</span></td></tr>
  <tr valign="top">
    <td><span class="cart"><? echo($fname); ?> <? echo($lname); ?></span><br>
      <span class="cart"><? echo($address1); ?>&nbsp;<? echo($address2); ?></span><br>
      <span class="cart"><? echo($city); ?>, <? echo($state); ?> <? echo($zip); ?></span><br>
      <br>
      <span class="cart"><b>Email:</b> <? echo($email); ?></span> <br>
      <? if($account){?><span class="cart"><b>Account:</b> <? echo($account); ?></span><br><?;}?>
     </td>
  </tr>
</table>
<br>

<table width="100%" style="margin-left: 3%">
<tr><td><span class="cart-header">Payment Info:</span></td></tr>
<input type="hidden" name="amount" value="<? echo($totformat); ?>">
<tr valign="top">
<td width="30%"><span class="cart"><b>Name on card:</b></span></td>
<td width="70%" align="left"><span class="cart"><? echo($firstName); ?> <? echo($lastName); ?></span></td>
</tr><tr valign="top">
<td><span class="cart"><b>Card Type:</b></span></td>
<td><span class="cart"><? echo($creditCardType); ?></span></td>
</tr><tr valign="top">
<td><span class="cart"><b>Card Number:</b></span></td>
<td><span class="cart"><? echo($cardnumobscure); ?></span></td>
</tr><tr valign="top">
<td><span class="cart"><b>Expiration Date:</b></span></td>
<td><span class="cart"><? echo($expDateMonth); ?>/<? echo($expDateYear); ?></span></td>
</span></td>
</tr><tr valign="top">
<td><span class="cart"><b>Card Verification Number:</b></span></td>
<td><span class="cart"><? echo($cvv2Number); ?></span></td>
</tr><tr valign="top">
<td><span class="cart"><b>Special Instructions:</b></span></td>
<td><span class="cart"><? echo($instr); ?></span></td>
</tr><tr valign="top">
<td colspan="2" align="left"><br><div align="left"><input type="button" class="btn" value ="Place Order" onClick="this.form.submit();" /></div><br><strong class="cart">Please click the Place Order button once to avoid duplicate charges.</strong></span></td>
</tr></table></form>
<?}?>
</p></td>
</tr></table></td>
</tr></table>

  <?php include_once("footer.php") ?>
</div></div></center>
</body>
</html>


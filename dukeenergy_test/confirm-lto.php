<? include("database1.php"); ?>
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
$company=("Duke LTO");
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

</head><?php include_once("analyticstracking1.php") ?><? include("nav-lto.php")?>
<BODY><center><div class="gridContainer clearfix"><div id="LayoutDiv1"><? include("header-order.php")?>
</div>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="main">
  <tr>
    <td>
<?
print("<div style=\"padding-left:55px;\">");
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
	if(!$count){
	print("<span class=\"cart\">Your cart is empty<br />\n");
}else{
	print("<span class=\"cart\"><b>Your cart contains the following:</b></span></div><br />\n");
	print("<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n");
	print("<tr valign=\"top\">\n");
	print("<td align=\"center\"><span class=\"cart-header\"><b>Qty</b></span></td>\n");
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
		#check for discounts based on zip if they haven't already entered it.

		print("<tr valign=\"top\" bgcolor=\"#cccccc\">\n");
		print("<td align=\"center\"><span class=\"cart\">".$qty."</span></td>\n");
		print("<td><span class=\"cart\">".$productDesc."</span></td>\n");
		print("<td><span class=\"cart\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td><span class=\"cart\">$".$tot1."</span></td>\n");
		print("</tr>\n");
	}
#	print("weight: ".$weight."<br>");
	print("<tr>\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");
	
		#$taxamount=.0633;
		#print_r($taxamount);
		$rate=5;
		$taxamt=$carttot*$taxamount;
		$taxformat=number_format($taxamt, 2, '.', ',');
		$finaltot=$carttot+$taxamt;
		#print("<tr>\n");
		#print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>");
		#print("Sales Tax:</b>&nbsp;</span></td>\n");
		#print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".$taxformat."</span></td>\n");
		#print("</tr>\n");
	print("<tr>\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Shipping:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$5.00");
	#ship($weight,$otsID,$ship_zip,$finaltot);
	print("</span></td>\n");
	print("</tr>\n");
#	print("<tr>\n");
#	print("<td colspan=\"5\" align=\"right\">");
	print("<tr>\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Total:</b>&nbsp;</span></td>\n");
	$totformat=number_format($finaltot+$rate, 2, '.', ',');
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".$totformat."</span></td>\n");
	print("</tr>\n");
	
?>
<form action="process-lto.php" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
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
<input type=hidden name="ship" value="<? echo($rate); ?>" />
<input type=hidden name="firstName" value="<? echo($firstName); ?>" />
<input type=hidden name="lastName" value="<? echo($lastName); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type=hidden name="tax" value="<? echo($taxamt); ?>">
<input type=hidden name="company" value="<? echo($company); ?>">
<input type=hidden name="source" value="<? echo($source); ?>">
<center>
<a class="body_content_style1" href="orderform-lto.php"><span class="cart">&lt;Go back and make changes</span></a>
<table width="100%" style="margin-left: 1%">
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

<table width="100%" style="margin-left: 1%">
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
<table width="100%" style="margin-left: 1%">
 <tr valign="top">
    <td><span class="cart-header">Payment Info:</span></td></tr>
  <tr valign="top">
<input type="hidden" name="amount" value="<? echo($totformat); ?>">
<tr valign="top">
<td width="33%"><span class="cart"><b>Name on card:</b></span></td>
<td width="33%"><span class="cart"><? echo($firstName); ?> <? echo($lastName); ?></span></td>
<td width="33%"><span class="cart"></td>
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
<td colspan="2" align="center"><br><div align="center"><input type="button" class="btn" value ="Place Order" onClick="this.form.submit();" /></div><br><strong class="cart">Please click the Place Order button once to avoid duplicate charges.</strong></span></td>
</tr></table></form>
<?}?>
</p></td>
</tr></table></td>
</tr></table>
<? $sql="select util from tblTerritory where zip='$ship_zip'";
#print("".$sql."<br>");
$result=db_query($sql);
while($rowzip=mysql_fetch_array($result)){
		$util=$rowzip['util'];}
#print $util;
#		print("sess:".$_SESSION['st']."<br>");?>
  <?php include_once("footer-orderform.php") ?>
</div></div></center>
</body>
</html>


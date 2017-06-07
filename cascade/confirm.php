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
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$creditCardType=$_POST['creditCardType'];
$creditCardNumber=$_POST['creditCardNumber'];
$company=("Cascade Free Items");
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
<title>TechniArt - Confirm Order</title>


<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>



<link rel="stylesheet" type="text/css" href="css/main.css"/>

<style type="text/css">





#pleasewait {position: absolute; top: 0px; left:0px; height:2000px; width:100%;font: 12px Archivo Narrow, Arial, Helvetica; visibility:hidden; z-index: 100000; background-color:#eee;filter:alpha(opacity=50); -moz-opacity:0.5 ;opacity: 0.5;}
#checkout a {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#checkout a:hover {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#checkout a:active {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}

#close a {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#close a:hover {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#close a:active {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}


#prods {position: absolute; top: 700px; left:300px; height:2525px; width:975px;display:block;background:#ffffff; border: 0px solid #000000; z-index: 1000; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;}
#register {position: absolute; top: 415px; left:0px; height:1300px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}

#cart {position: absolute; top: 415px; left:0px; height:700px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}
#review_checkout {position: absolute; top: 415px; left:0px; height:700px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}
#forgotpass {position: absolute; top: 185px; left:325px; height:325px; width:585px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 1002; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
#signin {position: absolute; top: 385px; left:250px; height:475px; width:730px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
#messagescr {position: absolute; top: 215px; left:340px; height:450px; width:570px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 10003; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
li~li {
	border-left: 1px solid #ffffff;
}
.content{
	margin-left:50px;
}
</style>
<style>.btn {
  -webkit-border-radius: 10;
  -moz-border-radius: 10;
  border-radius: 10px;
  font-family: Arial;
  color: #ffffff;
  font-size: 12px;
  background: #82b101;
  padding: 10px 10px 10px 10px;
  text-decoration: bold;
  border: none;
}

.btn:hover {
  background: #3daff3;
	cursor: pointer;
  text-decoration: none;
	}</style></head>
<BODY>
<center>
<?php include_once("cart-header.php") ?>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-left:20px">
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
	print("<table width=\"90%\" cellpadding=\"0\" cellspacing=\"0\">\n");
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
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");
	$rate=7;
		$rateformat=number_format($rate, 2, '.', ',');
		$taxamount=.0;
		#print_r($taxamount);
		$taxamt=$carttot*$taxamount;
		$taxformat=number_format($taxamt, 2, '.', ',');
		$finaltot=$carttot+$taxamt+$rate;
		print("<tr bgcolor=\"#ffffff\">\n");
		print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>");
		print("Sales Tax:</b>&nbsp;</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".$taxformat."</span></td>\n");
		print("</tr>\n");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Shipping:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".$rateformat."");
	#ship($weight,$otsID,$ship_zip,$finaltot);
	print("</span></td>\n");
	print("</tr>\n");
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\">");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Total:</b>&nbsp;</span></td>\n");
	$totformat=number_format($finaltot+$_SESSION['ship'], 2, '.', ',');
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".$totformat."</span></td>\n");
	print("</tr>\n");
	
?>
<form action="process.php" method="POST" >
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
<input type=hidden name="fname" value="<? echo($ship_fname); ?>" />
<input type=hidden name="lname" value="<? echo($ship_lname); ?>" />
<input type=hidden name="address1" value="<? echo($ship_address1); ?>" />
<input type=hidden name="address2" value="<? echo($ship_address2); ?>" />
<input type=hidden name="city" value="<? echo($ship_city); ?>" />
<input type=hidden name="state" value="<? echo($ship_state); ?>" />
<input type=hidden name="zip" value="<? echo($ship_zip); ?>" />
<input type=hidden name="water" value="<? echo($water); ?>" />
<input type=hidden name="firstName" value="<? echo($firstName); ?>" />
<input type=hidden name="lastName" value="<? echo($lastName); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type=hidden name="rate" value="<? echo($rate); ?>">
<input type=hidden name="company" value="<? echo($company); ?>">
<center>
<a class="body_content_style1" href="orderform.php"><span class="cart">&lt;Go back and make changes</span></a>
<table width="100%">
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

<span class="cart-header">Payment Info:</span>
<table>
<input type="hidden" name="amount" value="<? echo($totformat); ?>">
<table><tr valign="top">
<td><span class="cart"><b>Name on card:</b></span></td>
<td><span class="cart"><? echo($firstName); ?> <? echo($lastName); ?></span></td>
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
  <?php include_once("footer-cart.php") ?>
</div></div></center>
</body>
</html>


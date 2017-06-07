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
$office=$_POST['office'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$company=("PSE Office");
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
<style type="text/css">
<!--
body {
	background-color: #F0F0F0;
}
-->
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    function close_accordion_section() {
        $('.accordion .accordion-section-title').removeClass('active');
        $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
    }
 
    $('.accordion-section-title').click(function(e) {
        // Grab current anchor value
        var currentAttrValue = $(this).attr('href');
 
        if($(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();
 
            // Add active class to section title
            $(this).addClass('active');
            // Open up the hidden content panel
            $('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
        }
 
        $('accordion div:first a').trigger('click');
});
		
    });
	
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-color: #666666;
}
</style>

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
</head><?php include_once("analyticstracking.php") ?>
<BODY><? include("bluebar.php")?>
<center><div class="gridContainer clearfix"><div id="LayoutDiv1">
</div>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<?
print("<div>");
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail_pse where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
	if(!$count){
	print("<span class=\"cart\">Your cart is empty<br />\n");
}else{
	print("<span class=\"cart-header\">Your cart contains the following:</span></div><br />\n");
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
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");
	
		$sqltax="SELECT zip, MIN(tax) from tblTerritory where zip=".$zip." GROUP BY zip";
	$resulttax=db_query($sqltax);
	while($row=mysql_fetch_array($resulttax)){
		$taxamount=$row['MIN(tax)'];}
		$totaltax=$taxamount[min($resulttax)];
		#print_r($taxamount);
		$taxamt=$carttot*$taxamount;
		$taxformat=number_format($taxamt, 2, '.', ',');
		$finaltot=$carttot+$taxamt+$ship;
		$ship=0;
		$shipformat=number_format($ship, 2, '.', ',');
		print("<tr bgcolor=\"#ffffff\">\n");
		print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>");
		print("Sales Tax:</b>&nbsp;</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".$taxformat."</span></td>\n");
		print("</tr>\n");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Shipping:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">FREE");
	#ship($weight,$otsID,$ship_zip,$finaltot);
	print("</span></td>\n");
	print("</tr>\n");
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\">");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"cart-header\"><b>Total:</b>&nbsp;</span></td>\n");
	$totformat=number_format($finaltot+$ship, 2, '.', ',');
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
<input type=hidden name="office" value="<? echo($office); ?>" />
<input type=hidden name="fname" value="<? echo($fname); ?>" />
<input type=hidden name="lname" value="<? echo($lname); ?>" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="ship" value="<? echo($ship); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
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
<center>
<a class="body_content_style1" href="orderform.php"><span class="cart">&lt;Go back and make changes</span></a>
<table width="100%" align="left">
  <tr valign="top">
    <td align="left"><span class="cart-header">Billing Address:</span></td></tr>
  <tr valign="top">
    <td align="left"><span class="cart"><? echo($fname); ?> <? echo($lname); ?></span><br>
      <span class="cart"><? echo($address1); ?>&nbsp;<? echo($address2); ?></span><br>
      <span class="cart"><? echo($city); ?>, <? echo($state); ?> <? echo($zip); ?></span><br>
      <br>
      <span class="cart"><b>Email:</b> <? echo($email); ?></span> <br>
      <span class="cart"><b>Office Location:</b> <? echo($office); ?></span> <br>
</span></td>
  </tr>
</table>
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>



<table width="100%" align="left">
  <tr valign="top">
    <td align="left"><span class="cart-header">Payment Info:</span></td></tr>
  <tr valign="top">
    <td align="left"><span class="cart"><strong>Name on card:</strong> <? echo($firstName); ?> <? echo($lastName); ?></span><br>
      <span class="cart"><strong>Card type:</strong> <? echo($creditCardType); ?></span><br>
      <span class="cart"><strong>Card number:</strong> <? echo($cardnumobscure); ?></span><br>
      <span class="cart"><b>Expiration date:</b> <? echo($expDateMonth); ?>/<? echo($expDateYear); ?></span> <br>
      <span class="cart"><b>CVV number:</b> <? echo($cvv2Number); ?></span><br>
      <span class="cart"><b>Special instructions:</b> <? echo($instr); ?></span></td>
        </tr>
        <tr valign="top">
<td colspan="2" align="center"><br><div align="center"><input type="hidden" name="amount" value="<? echo($finaltot); ?>"><input type="button" class="btn" value ="Place Order" onClick="this.form.submit();" /></div><br><strong class="cart">Please click the Place Order button once to avoid duplicate charges.</strong></span></td>
</tr></table></form>
<?}?>


</td>
</tr></table>
  <?php include_once("footer.php") ?>
</div></div></center>
</body>
</html>


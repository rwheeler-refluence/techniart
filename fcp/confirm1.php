<? include("database.php"); ?>

<?
$otsID=$_POST['otsID'];
$ship_fname=$_POST['ship_fname'];
$ship_lname=$_POST['ship_lname'];
$ship_address1=$_POST['ship_address1'];
$ship_address2=$_POST['ship_address2'];
$ship_city=$_POST['ship_city'];
$ship_state=$_POST['ship_state'];
$ship_zip=$_POST['ship_zip'];
$ship_county=$_POST['ship_county'];
$amount=$_POST['amount'];
$name=$_POST['firstName'];
$email=$_POST['email'];
$phone=$_POST['phone'];
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
$sql="select * from tblotsdetail_fcp where otsID='$o'";
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
	if($carttot>=25 && $_SESSION['coupon'] && $_SESSION['rep']=="CNP"){
	$rate=0;
	$rate=number_format($rate, 2, '.', ',');
	print ("".$rate."\n\n");	
	print ("<br><span class=\"body_content_events-private\">This order qualifies <br>for FREE shipping.</span>");}
 	if($carttot>=$_SESSION['discount'] && $_SESSION['coupon'] && !$_SESSION['rep']=="CNP"){
	echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('The shipping zip code you entered is not qualified for FREE shipping.  You must re-fill your order form.')
		window.location.href='https://www.techniart.com/amigo/orderform.php'
        </SCRIPT>";}
	if ($carttot>=25 && $_SESSION['coupon'] && $vendor==31){
	$rate=7;
	$rate=number_format($rate, 2, '.', ',');
	print("".$rate."\n");
	print ("<br><span class=\"body_content_events-private\">This order qualifies for <br>flat rate shipping.</span>");
	}else{
	if($carttot<25){print("".$rate."\n");}}
	$rate=number_format($rate+$_SESSION['ship'], 2, '.', ',');
	print("<input type=\"hidden\" name=\"ship\" value=\"".$rate."\">\n");
	print("</span></td>\n");
	print("</tr>\n");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Discount:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$-".number_format($_SESSION['discount'], 2, '.', ',')."</span></td>\n");
	print("</tr>\n");
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\">");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Total:</b>&nbsp;</span></td>\n");
	$totformat=number_format($carttot+$rate-$_SESSION['discount'], 2, '.', ',');
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".$totformat."</span></td>\n");
	print("</tr>\n");

?>
<form action="process-nc.php" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="description" value="<? echo(date("m/d/Y")); ?> order from techniart.com" />
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>">
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>">
<input type=hidden name="ship_address1" value="<? echo($ship_address1); ?>"> 
<input type=hidden name="ship_address2" value="<? echo($ship_address2); ?>">
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>">
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="ship_county" value="<? echo($ship_county); ?>">
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type=hidden name="phone" value="<? echo($phone); ?>">
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="coupon" value="<? echo($_SESSION['coupon']); ?>">
<input type=hidden name="discount" value="<? echo($_SESSION['discount']); ?>">
<input type=hidden name="rep" value="<? echo($_SESSION['rep']); ?>">
<!--<span class="body_content_style1"><b>Shipping Method Chosen:</b><br><? echo($_SESSION["shipping"]["option"]);?></span></td>-->
<center>
<a class="body_content_style1" href="orderform1.php?ID=<? echo($otsID); ?>"><span class="body_content_style1">&lt;Go back and make changes</span></a>
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
<strong>Coupon: </strong><? echo($_SESSION['coupon']); ?></span></td>
</tr></table>
</span></td>
<td width="10">&nbsp;</span></td>
<td width="235" align="left">
<table><tr valign="top">
<td colspan="2"></td>
</tr><tr valign="top">
<td></td>
</tr></table>
</span></td>
</tr><tr valign="top">
<td class="body_content_style1" colspan="3" align="left">
<img src="pix/pix_trans.gif" width="1" height="10"><br>
<table>
<input type="hidden" name="amount" value="<? echo($totformat); ?>">
<!--<tr valign="top">
<td><span class="body_content_style1">Amount:</span></td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</span></td>
</tr>--><tr valign="top">
<td colspan="2" align="center"><img src="pix/pix_trans.gif" width="1" height="10"><br><div align="center"><input type="button" value ="Place Order" class="btn" onClick="this.form.submit();" /></div><br>Please click the Place Order button only once to avoid duplicate charges</span></td>
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

</div>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
</html>


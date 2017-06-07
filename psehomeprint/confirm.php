<? include("database.php"); ?>
<?
include("ship_class.php");
	require("ups_extended.php");
$ship_format=$ship;
$company_name=$_POST['company_name'];
$zipcheck=($_SESSION['zip']);
$otsID=$_POST['otsID'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];

$admin_name=$_POST['admin_name'];
$admin_phone=$_POST['admin_phone'];
$admin_email=$_POST['admin_email'];
$city=$_POST['city'];
$state=$_POST['state'];
$bill_zip=$_POST['bill_zip'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
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
$phone=$_POST['phone'];
$nmsplit=explode(" ",$name);
$firstName=$_POST['firstName'];
$ship_option=$_SESSION["shipping"]["option"];
$lastName=$_POST['lastName'];
$creditCardType=$_POST['creditCardType'];
$creditCardNumber=$_POST['creditCardNumber'];
$company=("PSE Lighting to Go");
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
<meta name="publisher" content="techniart.us" />
<meta name="copyright" content="Copyright 2008 TechniArt. All Rights Reserved" />
<meta http-equiv="content-language" content="EN" />
<meta name="content-language" content="EN" />
<meta name="rating" content="All" />
<meta name="audience" content="General" />
<meta name="distribution" content="Global" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>

<BODY>
<?php include("bluebar.php") ?><center><div class="fbwhitebox"><?php include("header.php") ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div id="title_spacer" align="left"><span class="title_main">Confirmation</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
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
	print("<table width=\"830\" cellpadding=\"2\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td><span class=\"product_title\"><b>Case Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"product_title\"><b>Product Description</b></span></td>\n");
	print("<td align=\"center\"><span class=\"product_title\"><b>Products<br>per Case</b></span></td>\n");
	print("<td align=\"center\"><span class=\"product_title\"><b>Total<br>Products</b></span></td>\n");
	print("<td align=\"center\"><span class=\"product_title\"><b>Total<br>Cost</b></span></td>\n");
	print("</tr>\n");
	while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
		$case_quantity=$row['case_quantity'];
		$prod_tot=$case_quantity*$qty;
		$tot=number_format($prod_tot*$price, 2, '.', ',');
		$tot1=$prod_tot*$price;		
		$carttot+=$tot1;
		$itemNo=$row['itemNo'];
		$productDesc=$row['productDesc'];
		$productDesc2=str_replace("<br>"," - ",$productDesc);
		#check for free shipping
		$free_ship="";
		$lbl="";

	
		print("<tr valign=\"top\" bgcolor=\"#ffffff\">\n");
	print("<tr valign=\"top\" bgcolor=\"#f3fbfe\"><input type=\"hidden\" name=\"qty[]\" value=\"".$qty."\">\n");
		print("<td align=\"center\"><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td><a class=\"product_title1\" href=\"#\" onClick=\"javascript: decision('Are you sure you want to remove this item from your shopping bag?', 'https://www.techniart.us/psehomeprint/remove.php?ID=".$otsdetailID."');\"><span class=\"product_title\">REMOVE?</span></a></td>\n");
		print("<td><span class=\"product_title1\">".$productDesc."".$lbl."</span></td>\n");
		print("<td align=\"center\"><span class=\"product_title1\">".$case_quantity."</span></td>\n");
		print("<td align=\"center\"><span class=\"product_title1\">".$prod_tot."</span></td>\n");
		print("<td align=\"center\"><span class=\"product_title1\">$".$tot."</span></td>\n");
		print("</tr>\n");
	}
#	print("weight: ".$weight."<br>");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"></td>\n");
	print("<td style=\"padding-left:4px;\"></td>\n");
	print("</tr>\n");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">");
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
	
	
	if ($carttot>=25){
		$rate='7.00';
	$ship=$rate;
#	print (''.$rate."\n\n");	
	$rate=number_format($rate, 2, '.', ',');
#	print ("<br><span class=\"body_content_events-private\">This order qualifies for <br>flat rate shipping.</span>");
	}else{ 
#	print("".$rate."\n");
	$rate=number_format($rate+$_SESSION['ship'], 2, '.', ',');
#	print("<input type=\"hidden\" name=\"ship\" value=\"".$rate."\">\n");
}
	print("</span></td>\n");
	print("</tr>\n");
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\">");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"></td>\n");
	$totformat=number_format($carttot+$rate, 2, '.', ',');
	print("<td style=\"padding-left:4px;\"></td>\n");
	print("</tr>\n");

?>
<form action="process.php" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="ship" value="<? echo($rate);?>">
<input type=hidden name="description" value="<? echo(date("m/d/Y")); ?> order from techniart.us" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="email" value="<? echo($email); ?>" />
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
<input type=hidden name="phone" value="<? echo($phone); ?>">
<input type=hidden name="bill_country" value="<? echo($bill_country); ?>">
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>">
<input type=hidden name="ship_address1" value="<? echo($ship_address1); ?>"> 
<input type=hidden name="ship_address2" value="<? echo($ship_address2); ?>">
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>">
<input type=hidden name="city" value="<? echo($city); ?>">
<input type=hidden name="tax" value="<? echo($taxformat); ?>">
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>">
<input type=hidden name="admin_name" value="<? echo($admin_name); ?>">
<input type=hidden name="admin_phone" value="<? echo($admin_phone); ?>">
<input type=hidden name="admin_email" value="<? echo($admin_email); ?>">
<input type=hidden name="ship_option" value="<? echo($ship_option); ?>">
<input type=hidden name="ship_price" value="<? echo($rate); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="facility_name" value="<? echo($facility_name); ?>"> 
<input type=hidden name="facility_contact" value="<? echo($facility_contact); ?>">
<input type=hidden name="facility_address1" value="<? echo($facility_address1); ?>">
<input type=hidden name="facility_address2" value="<? echo($facility_address2); ?>">
<input type=hidden name="facility_city" value="<? echo($facility_city); ?>">
<input type=hidden name="building" value="<? echo($building); ?>">
<input type=hidden name="facility_phone" value="<? echo($facility_phone); ?>">
<input type=hidden name="facility_zip" value="<? echo($facility_zip); ?>">
<input type=hidden name="facility_account" value="<? echo($facility_account); ?>">
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type=hidden name="company" value="<? echo($company); ?>">
<!--<span class="body_content_style1"><b>Shipping Method Chosen:</b><br><? echo($_SESSION["shipping"]["option"]);?></span></td>-->
<center>
<a class="body_content_style1" href="orderform.php"><span class="body_content_style1">&lt;Go back and make changes</span></a>
<table width="480" cellpadding="1" cellspacing="1"><tr valign="top">
<td width="235" align="left">
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Shipping Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><strong>Name:</strong> <? echo($ship_fname); ?> <? echo($ship_lname); ?><br><strong>Address: </strong><? echo($ship_address1); ?> <? echo($ship_address2); ?><br>
<strong>City/State: </strong><? echo($ship_city); ?>, <? echo($ship_state); ?><br><strong>ZIP Code: </strong><? echo($ship_zip); ?><br></h2></span><br />

</td>
</tr></table>
</span></td>
<td width="10">&nbsp;</span></td>
<td width="235" align="left">
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Billing Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><strong>Company Name: </strong><? echo($access_company); ?><br>Admin Name: <? echo($admin_name); ?><br><strong>Address: </strong><? echo($address1); ?> <? echo($address2); ?><br>
<strong>City/State: </strong><? echo($city); ?>, WA<strong><br>ZIP Code: </strong><? echo($zip); ?><br><br>
<strong>Phone number: </strong><? echo($admin_phone); ?><br>
<strong>Email: </strong><? echo($admin_email); ?></span>
</span></td>
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

</tr><tr valign="top">
<td colspan="2" align="center"><img src="pix/pix_trans.gif" width="1" height="10"><br><div align="center"><input type="button" class="btn1" value ="Place Order" onClick="this.form.submit();" /></div><br>Please click the Place Order button only once to avoid duplicate orders</span></td>
</tr></table>
</span></td></tr></table>
</form>
<?}?>
</p><br>


</td>
<td></td>
</tr></table>

</td>
</tr></table>

<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->

</body>
</html>


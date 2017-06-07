<? include("database.php"); ?>
<?
$ship=$_POST['ship'];
if(!$ship){
#	header("location: http://www.cunexttuesday.com/cart.php?msg=ship");
}
$action=$_POST['action'];
switch($action){
	case "add":
		$_SESSION['prn']="";
		$itemNo=$_POST['itemNo'];
		$productTitle=$_POST['productTitle'];
		$productTitle=$_POST['productTitle'];
		$desc="".$productTitle."";
		$type=$_POST['type'];
		$price=$_POST['price'];
		$stamp=mktime();

		#check to see if there is an existing order for this session
		$sqlc="select * from tblorderstosend_centerpoint where sess='$sess' && status='open'";
		$resultc=db_query($sqlc);
		$countc=mysql_num_rows($resultc);
		if(!$countc){
			$sql="insert into tblorderstosend_centerpoint values ('','$sess','','','$stamp','open')";
			$result=db_query($sql);
			$next=mysql_insert_id();
		}else{
			while($rowc=mysql_fetch_array($resultc)){
				$next=$rowc['otsID'];
			}
		}
		$_SESSION['otsID']=$next;
		#add item to cart
		$sqli="select * from tblotsdetail_centerpoint where itemNo='$itemNo' && otsID='$next'";
		#print("".$sqli."<br />");
		$resulti=db_query($sqli);
		$counti=mysql_num_rows($resulti);
		if(!$counti){
			$sql2="insert into tblotsdetail_centerpoint values ('','$next','$itemNo','$quantity','$price','$desc')";
		}else{
			while($rowi=mysql_fetch_array($resulti)){
				$otsdetailID=$rowi['otsdetailID'];
				$qty=$rowi['qty'];
				$newqty=$qty+1;
			}
			$sql2="update tblotsdetail_centerpoint set qty='$newqty' where otsdetailID='$otsdetailID'";
		}
#		print($sql2);
		$result2=db_query($sql2);
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			$sql="update tblotsdetail_centerpoint set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
#print("".$sql."<br />");			
			$result=db_query($sql);
		}
	break;
}
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
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
<SCRIPT LANGUAGE="Javascript">
<!---
function pop(){

document.form1.fname.value=document.form1.ship_fname.value;
document.form1.lname.value=document.form1.ship_lname.value;
document.form1.address1.value=document.form1.ship_address1.value;
document.form1.address2.value=document.form1.ship_address2.value;
document.form1.city.value=document.form1.ship_city.value;
document.form1.state.selectedIndex=document.form1.ship_state.selectedIndex;
document.form1.bill_zip.value=document.form1.ship_zip.value;
document.form1.county.value=document.form1.ship_county.value;

    for (var i = 0;i<51; i++){
        if (document.form1.state[i].selected){
            document.form1.ship_state.options[i].selected = true;
		}
	}
}

// --->
</SCRIPT>	
<script language="javascript">
function unhide(divID) {
  var item = document.getElementById(divID);
  if (item) {
//    item.className=(item.className=='hidden')?'unhidden':'hidden';
    item.className='unhidden';
  }
}
function hide(divID) {
  var item = document.getElementById(divID);
  if (item) {
//    item.className=(item.className=='hidden')?'unhidden':'hidden';
    item.className='hidden';
  }
}

</script>
<script language="javascript" type="text/javascript">
	<!--
		function fVerifyResForm() {
			var oForm = document.form1;	
			var errFlag = 0;
			var errStr = "Oops, looks like you missed a required field.\n";

			if (oForm.fname.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing first name.\n";
			}

			if (oForm.lname.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing last name.\n";
			}

			if (oForm.address1.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing address.\n";
			}

			if (oForm.city.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing city.\n";
			}

			if (oForm.state.value=='') {
				errFlag = 1;
				errStr = errStr + "Please enter your billing state.\n";
			}

			if (oForm.bill_zip.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing zip.\n";
			}

			if (oForm.county.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing county.\n";
			} 

			if (oForm.email.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your email address.\n";
			} else {
				if (!(fCheckEmail(oForm.email.value))) {
					errFlag = 1;
					errStr = errStr + "Please enter a valid email address.\n";
				}
			}

			if (oForm.ship_fname.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping address first name.\n";
			}

			if (oForm.ship_lname.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping address last name.\n";
			}

			if (oForm.ship_address1.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping address.\n";
			}

			if (oForm.ship_city.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping city.\n";
			}

			if (oForm.ship_state.value=='') {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping state.\n";
			}

			if (oForm.ship_zip.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping zip.\n";
			}

			if (oForm.ship_county.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping county.\n";
			}


			if (oForm.firstName.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter the name that appears on your credit card.\n";
			}
			if (oForm.creditCardType[0].checked || oForm.creditCardType[1].checked || oForm.creditCardType[2].checked) {
			}else{
				errFlag = 1;
				errStr = errStr + "Please select a credit card type.\n";
			}
			if (oForm.creditCardNumber.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your credit card number.\n";
			}
			if (oForm.expDateMonth.value== '') {
				errFlag = 1;
				errStr = errStr + "Please enter your credit card expiration month.\n";
			}

			if (oForm.expDateYear.value== '') {
				errFlag = 1;
				errStr = errStr + "Please enter your credit card expiration year.\n";
			}

			if (oForm.cvv2Number.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your credit card verification number.\n";
			}

 
			if (errFlag == 0) {
				return true;
				oForm.submit();
			} else {
				alert(errStr);
				return false;
			}
		}
		
		function fCheckEmail(strEmail) {
			re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
      if (re.test(strEmail)) {
      	return true;
      } else {
      	return false;
      }
		}
	//-->
	</script>
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
</head>

<BODY>
<?php include_once("analyticstracking.php") ?>

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->
<center><div class="rcorners2">
<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"<div id="title_spacer" align="left"><span class="title_main"><br>
&nbsp;&nbsp;Order Form </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style4"><strong>Get $7 flat rate shipping</strong> on all orders over $25!</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="rcorners3"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">

<p class="body_content_style1">
<?
$o=$_GET['ID'];
$state=$_GET['state'];
if(!$state){
	$state=$_POST['state'];
}
		if(!$o){
	$o=$_SESSION['otsID'];
}
$sql="select * from tblotsdetail_centerpoint where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
print("<div>");
if(!$count){
	print("<b>Your shopping cart is empty</b><br />\n");
}else{
	print("<form  method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p class=\"body_content_style1\">\n");
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<b>Your shopping cart contains the following:</b><br />\n");
	print("</p></div>");
	print("<table width=\"830\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td><span class=\"section_heading_style1\"><b>Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Item</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Price</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Total</b></span></td>\n");
	print("</tr>\n");
	$i=1;
	while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
		$tot1=$qty*$price;
		$tot=number_format($qty*$price, 2, '.', ',');
		$carttot+=$tot1;
		$itemNo=$row['itemNo'];
		$productDesc=$row['productDesc'];
		$productDesc2=str_replace("<br>"," - ",$productDesc);
		#check for free shipping
		$free_ship="";
		$lbl="";
		$sqlfreeship="select free_ship from tblProducts where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$free_ship=$rowfreeship['free_ship'];
		}
		if($free_ship=='Yes'){
			$lbl="<br><span style=\"color:RED\">* - This product qualifies for free shipping</span>";
		}

		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr bgcolor=\"#FFFFFF\"><input type=\"hidden\" name=\"qty[]\" value=\"".$qty."\">\n");
		print("<td><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td><a class=\"body_content_style1\" href=\"#\" onClick=\"javascript: decision('Are you sure you want to remove this item from your shopping bag?', 'remove.php?ID=".$otsdetailID."');\"><span class=\"body_content_style1\">REMOVE?</span></a></td>\n");
		print("<td><span class=\"body_content_style1\">".$productDesc."".$lbl."</span></td>\n");
		print("<td><span class=\"body_content_style1\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td><span class=\"body_content_style1\">$".$tot."</span></td>\n");
		print("</tr>\n");
		$i++;
	}
	$ship_format=number_format($ship, 2, '.', ',');
	$paypal.="<input type=\"hidden\" name=\"handling_cart\" id=\"handling_cart\" value=\"".$ship_format."\">\n";

	#print("ship: ".$ship."<br>");
#	if($state=='CT'){
#		$finaltot=$carttot*1.06;
#		$taxamt=$carttot*.06;
#		$taxformat=number_format($taxamt, 2, '.', ',');
#		print("<tr bgcolor=\"#5a0305\">\n");
#		print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>CT State Sales Tax:</b>&nbsp;</span></td>\n");
#		print("<td><span class=\"body_content_style1\">$".$taxformat."</span></td>\n");
#		print("</tr>\n");
#		$paypal.="<input type=\"hidden\" name=\"tax_cart\" value=\"$".$taxformat."\">\n";
 #
#	}else{
#		$finaltot=$carttot;
#	}
#	print("<tr>\n");
#	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b>&nbsp;</span></td>\n");
#	$totformat=number_format($carttot, 2, '.', ',');
#	print("<td align=\"right\"><span class=\"body_content_style1\">$".$ship_format."</span></td>\n");
#	print("</tr>\n");
	/***************** shipping *************************/
	$shiptot=$_SESSION['ship_amt'];
#	print("st:".$shiptot."<br>");
	$fintot=$carttot+$shiptot;
	$ordertot=number_format($fintot, 2, '.', ',');
	/***************** end shipping *************************/
	if($shiprate>0){
		print("<tr bgcolor=\"#FFFFFF\">\n");
		print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b></span></td>");
		print("<td>");
		print("<span class=\"body_content_style1\">$".$shiptot."</span></td>\n");
		print("</tr>");
	}
	print("<tr bgcolor=\"#FFFFFF\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	$totformat=number_format($carttot, 2, '.', ',');
	print("<td align=\"left\"><span class=\"body_content_style1\">$".$totformat."</span></td>\n");
	print("</tr></form>\n");
	if($_SESSION['discount']){
	print("<tr bgcolor=\"#FFFFFF\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Discount:</b>&nbsp;</span></td>\n");
	$discount=number_format($discount, 2, '.', ',');
	print("<td align=\"left\"><span class=\"body_content_style1\">$-".$discount."</span></td>\n");
	print("</tr>\n");}
#	if($carttot>=25 && $_SESSION['coupon']){
#	print("<tr bgcolor=\"#FFFFFF\">\n");
#	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b>&nbsp;</span></td>\n");
#	$shiprate=0;
#	$ship=number_format($shiprate, 2, '.', ',');
#	print("<td align=\"left\"><span class=\"body_content_style1\">$".$ship."</span></td>\n");
#	print("</tr>\n");
#	}else{
	if($carttot>=25 && !$_SESSION['coupon']){
	print("<tr bgcolor=\"#FFFFFF\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b>&nbsp;</span></td>\n");
	$shiprate=7;
	$ship=number_format($shiprate, 2, '.', ',');
		print("<td align=\"left\"><span class=\"body_content_style1\">$".$ship."</span></td>\n");
	print("</tr>\n");}
	if ($carttot >=25 && $_SESSION['coupon'] && $_SESSION['rep']=="CNP"){
		print("<tr bgcolor=\"#FFFFFF\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b>&nbsp;</span></td>\n");
	$shiprate=0;
	$ship=number_format($shiprate, 2, '.', ',');
		print("<td align=\"left\"><span class=\"body_content_style1\">$".$ship."</span></td>\n");
	print("</tr>\n");}
	if ($carttot >=25 && $_SESSION['coupon'] && $_SESSION['rep']=="AEP"){
		print("<tr bgcolor=\"#FFFFFF\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b>&nbsp;</span></td>\n");
	$shiprate=7;
	$ship=number_format($shiprate, 2, '.', ',');
		print("<td align=\"left\"><span class=\"body_content_style1\">$".$ship."</span></td>\n");
	print("</tr>\n");}
if ($carttot >=25 && $_SESSION['coupon'] && $_SESSION['rep']=="NQ"){
		print("<tr bgcolor=\"#FFFFFF\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b>&nbsp;</span></td>\n");
	$shiprate=7;
	$ship=number_format($shiprate, 2, '.', ',');
		print("<td align=\"left\"><span class=\"body_content_style1\">$".$ship."</span></td>\n");
	print("</tr>\n");}
	if ($carttot >=25 && $_SESSION['coupon'] && $_SESSION['rep']==''){
		print("<tr bgcolor=\"#FFFFFF\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b>&nbsp;</span></td>\n");
	$shiprate=7;
	$ship=number_format($shiprate, 2, '.', ',');
		print("<td align=\"left\"><span class=\"body_content_style1\">$".$ship."</span></td>\n");
	print("</tr>\n");}
	
	print("<tr bgcolor=\"#FFFFFF\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Total:</b>&nbsp;</span></td>\n");
	$totformat=number_format($carttot+$ship-$discount, 2, '.', ',');
	print("<td align=\"left\"><span class=\"body_content_style1\">$".$totformat."</span></td>\n");
	print("</tr></form>\n");
	#print("<tr>\n");
	#print("<td colspan=\"5\" align=\"right\"><input type=\"image\" src=\"pix/pix/b_recalculate.gif\" name=\"submit\" alt=\"Recalculate Totals\" border=\"0\" value=\"Recalculate Totals\"></form></td>\n");
	#print("</tr>\n");
	print("<tr>\n");
	print("<td colspan=\"5\" align=\"right\">");
	
?>
<div align="left"><span class="body_content_style1">*Please note: Sales tax will not be charged when shipping to Texas <br>
  If your order is under $25, you will be charged the standard UPS rate (~$13-$20) on the next page.<br>
  If you order is over $25, you will be charged the $7 flat rate shipping.
  <br>
</span></div>
<br>

<!--<form action="DoDirectPaymentReceipt.php" method="POST" >-->
<form name="form1" id="form1" method="post" action="confirm_pre.php" onSubmit="return fVerifyResForm();"><input type="hidden" name="otsID" value="<? echo($o);?>">
<input type=hidden name=paymentType value="<?=$paymentType?>" />
<input type="hidden" name="ship" value="<?=$ship?>" />

<table width="830" align="center" cellpadding="1" cellspacing="1"><tr valign="top">
<td width="415" align="left">
<table width="313" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
<td colspan="2"><span class="section_heading_style2">Shipping Address:</span></td>
</tr><tr valign="top">
<td colspan="2">&nbsp;</td>
</tr><tr valign="top">
<td width="96"><span class="body_content_style1">First Name:</span></td>
<td width="162"><input type="text" size="25" maxlength="100" name="ship_fname" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Last Name:</span></td>
<td><input type="text" size="25" maxlength="100" name="ship_lname" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Address 1:</span></td>
<td><input type="text" size="25" maxlength="100" name="ship_address1" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Address 2:<br>(optional)</span></td>
<td><input type="text" size="25" maxlength="100" name="ship_address2" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">City:</span></td>
<td><input type="text" size="25" maxlength="40" name="ship_city" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">State:</span></td>
<td><select name="ship_state" class="forms2">
<option></option>
<option value="AK">AK</option>
<option value="AL">AL</option>
<option value="AR">AR</option>
<option value="AZ">AZ</option>
<option value="CA">CA</option>
<option value="CO">CO</option>
<option value="CT">CT</option>
<option value="DC">DC</option>
<option value="DE">DE</option>
<option value="FL">FL</option>
<option value="GA">GA</option>
<option value="HI">HI</option>
<option value="IA">IA</option>
<option value="ID">ID</option>
<option value="IL">IL</option>
<option value="IN">IN</option>
<option value="KS">KS</option>
<option value="KY">KY</option>
<option value="LA">LA</option>
<option value="MA">MA</option>
<option value="MD">MD</option>
<option value="ME">ME</option>
<option value="MI">MI</option>
<option value="MN">MN</option>
<option value="MO">MO</option>
<option value="MS">MS</option>
<option value="MT">MT</option>
<option value="NC">NC</option>
<option value="ND">ND</option>
<option value="NE">NE</option>
<option value="NH">NH</option>
<option value="NJ">NJ</option>
<option value="NM">NM</option>
<option value="NV">NV</option>
<option value="NY">NY</option>
<option value="OH">OH</option>
<option value="OK">OK</option>
<option value="OR">OR</option>
<option value="PA">PA</option>
<option value="RI">RI</option>
<option value="SC">SC</option>
<option value="SD">SD</option>
<option value="TN">TN</option>
<option value="TX">TX</option>
<option value="UT">UT</option>
<option value="VA">VA</option>
<option value="VT">VT</option>
<option value="WA">WA</option>
<option value="WI">WI</option>
<option value="WV">WV</option>
<option value="WY">WY</option>
<option value="AA">AA</option>
<option value="AE">AE</option>
<option value="AP">AP</option>
<option value="AS">AS</option>
<option value="FM">FM</option>
<option value="GU">GU</option>
<option value="MH">MH</option>
<option value="MP">MP</option>
<option value="PR">PR</option>
<option value="PW">PW</option>
<option value="VI">VI</option>
</select></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">ZIP Code:</span></td>
<td><span class="body_content_style1"><input type="text" size="10" maxlength="10" name="ship_zip" value="" class="forms2" />
( 5 digit ZIP)</span></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
  <td><span class="body_content_style1">County:</span></td>
  <td><input name="ship_county" id="ship_county" type="text" size="25" value="" class="forms3"></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><span class="body_content_style1">Phone number:</span></td>
  <td><input name="phone" id="phone" type="text" size="12" value="" class="forms3"></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><span class="body_content_style1">Email:</span></td>
  <td><input name="email" id="email" type="text" size="25" value="" class="forms3"></td>
</tr>
</table>

</td>
<!-- <td width="10">&nbsp;</span></td> -->
<td width="415" align="left">

<table border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td colspan="2"><span class="section_heading_style2">Billing Address:</span></td>
</tr><tr valign="top">
<td colspan="2"><span class="body_content_style1"><input type="checkbox" name="same" value="yes" onClick="pop();">Same as Shipping Info:<br /></span></td>
</tr><tr valign="top">
<td width="120"><span class="body_content_style1">First Name:</span></td>
<td width="185"><input type="text" size="25" maxlength="100" name="fname" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Last Name:</span></td>
<td><input type="text" size="25" maxlength="100" name="lname" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Address 1:</span></td>
<td><input type="text" size="25" maxlength="100" name="address1" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Address 2:<br>(optional)</span></td>
<td><input type="text" size="25" maxlength="100" name="address2" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">City:</span></td>
<td><input type="text" size="25" maxlength="40" name="city" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">State:</span></td>
<td><select name="state" class="forms2">
<option></option>
<option value="AK">AK</option>
<option value="AL">AL</option>
<option value="AR">AR</option>
<option value="AZ">AZ</option>
<option value="CA">CA</option>
<option value="CO">CO</option>
<option value="CT">CT</option>
<option value="DC">DC</option>
<option value="DE">DE</option>
<option value="FL">FL</option>
<option value="GA">GA</option>
<option value="HI">HI</option>
<option value="IA">IA</option>
<option value="ID">ID</option>
<option value="IL">IL</option>
<option value="IN">IN</option>
<option value="KS">KS</option>
<option value="KY">KY</option>
<option value="LA">LA</option>
<option value="MA">MA</option>
<option value="MD">MD</option>
<option value="ME">ME</option>
<option value="MI">MI</option>
<option value="MN">MN</option>
<option value="MO">MO</option>
<option value="MS">MS</option>
<option value="MT">MT</option>
<option value="NC">NC</option>
<option value="ND">ND</option>
<option value="NE">NE</option>
<option value="NH">NH</option>
<option value="NJ">NJ</option>
<option value="NM">NM</option>
<option value="NV">NV</option>
<option value="NY">NY</option>
<option value="OH">OH</option>
<option value="OK">OK</option>
<option value="OR">OR</option>
<option value="PA">PA</option>
<option value="RI">RI</option>
<option value="SC">SC</option>
<option value="SD">SD</option>
<option value="TN">TN</option>
<option value="TX">TX</option>
<option value="UT">UT</option>
<option value="VA">VA</option>
<option value="VT">VT</option>
<option value="WA">WA</option>
<option value="WI">WI</option>
<option value="WV">WV</option>
<option value="WY">WY</option>
<option value="AA">AA</option>
<option value="AE">AE</option>
<option value="AP">AP</option>
<option value="AS">AS</option>
<option value="FM">FM</option>
<option value="GU">GU</option>
<option value="MH">MH</option>
<option value="MP">MP</option>
<option value="PR">PR</option>
<option value="PW">PW</option>
<option value="VI">VI</option>
</select></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">ZIP Code:</span></td>
<td><span class="body_content_style1"><input type="text" size="10" maxlength="10" name="bill_zip" value="" class="forms2" />
(5 digit ZIP)</span></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
  <td><span class="body_content_style1">County:</span></td>
  <td><input name="county" id="county" type="text" size="25" value="" class="forms3"></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" alt="" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><? if($_SESSION['coupon']){?><span class="body_content_style1">Coupon:</span><? ;}?></td>
  <td><? echo($_SESSION['coupon']); ?></td>
</tr>
</table>

</td>
</tr><tr valign="top">
<td class="body_content_style1" colspan="3" align="left">
<img src="pix/pix_trans.gif" width="1" height="10"><br>
<span class="section_heading_style2">Payment Info:</span>

<table border="0" cellspacing="0" cellpadding="0">
<!--<tr valign="top">
<td><span class="body_content_style1">Amount:</span></td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</span></td>
</tr>--><tr valign="top">
<td><span class="body_content_style1">Name: (as it appears on credit card)&nbsp;</span></td>
<td><input type="text" size="30" maxlength="32" name="firstName" id="firstName" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<!--<td><span class="body_content_style1">Last Name:</span></td>
<td><input type="text" size="30" maxlength="32" name="lastName" value="Doe" /></span></td>
</tr><tr valign="top">-->						   
<td><span class="body_content_style1">Card Type:</span></td>
<td><input type="radio" id="creditCardType" name="creditCardType" value="Visa"><img src="pix/Visa.gif">&nbsp;&nbsp;
<input type="radio" id="creditCardType" name="creditCardType" value="MasterCard"><img src="pix/Master_Card.gif">&nbsp;&nbsp;
<input type="radio" id="creditCardType" name="creditCardType" value="Discover"><img src="pix/Discover.gif">&nbsp;&nbsp;
</td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Number:</span></td>
<td><input type="text" size="19" maxlength="19" id="creditCardNumber" name="creditCardNumber" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Expiration Date:</span></td>
<td><select name="expDateMonth" id="expDateMonth" class="forms2">
<option value=""></option>
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
<select name="expDateYear" id="expDateYear" class="forms2">
<option value=""></option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
</select></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Verification Number:</span></td>
<td><input type="text" size="3" maxlength="4" name="cvv2Number" id="cvv2Number" class="forms2" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Special Instructions:</span></td>
<td><textarea name="instr" id="instr" rows="5" cols="30" class="forms3" /></textarea></td>
</tr><tr valign="top">
<td class="field"></td>
<td><img src="pix/pix_trans.gif" width="1" height="10"><br>
<input type="submit" class="btn" value="Review Order"></td>
</tr></table>

</td>
</tr></table>
</form>
</td>
</tr></table>
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


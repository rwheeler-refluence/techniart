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
		$sqlc="select * from tblorderstosend_facebook where sess='$sess' && status='open'";
		$resultc=db_query($sqlc);
		$countc=mysql_num_rows($resultc);
		if(!$countc){
			$sql="insert into tblorderstosend_facebook values ('','$sess','','','$stamp','open')";
			$result=db_query($sql);
			$next=mysql_insert_id();
		}else{
			while($rowc=mysql_fetch_array($resultc)){
				$next=$rowc['otsID'];
			}
		}
		$_SESSION['otsID']=$next;
		#add item to cart
		$sqli="select * from tblotsdetail_facebook where itemNo='$itemNo' && otsID='$next'";
		#print("".$sqli."<br />");
		$resulti=db_query($sqli);
		$counti=mysql_num_rows($resulti);
		if(!$counti){
			$sql2="insert into tblotsdetail_facebook values ('','$next','$itemNo','$quantity','$price','$desc')";
		}else{
			while($rowi=mysql_fetch_array($resulti)){
				$otsdetailID=$rowi['otsdetailID'];
				$qty=$rowi['qty'];
				$newqty=$qty+1;
			}
			$sql2="update tblotsdetail_facebook set qty='$newqty' where otsdetailID='$otsdetailID'";
		}
#		print($sql2);
		$result2=db_query($sql2);
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			$sql="update tblotsdetail_facebook set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
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
document.form1.zip.value=document.form1.ship_zip.value;

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

			if (oForm.zip.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing zip.\n";
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: f7f7f7f7;
}
-->
</style></head>
<BODY><div class="blueBar"></div>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="ffffff" align="center"><div class="fbwhitebox1">
<?php include_once("analyticstracking.php") ?>

<table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="34">&nbsp;</td>
    <td width="816"><?php include("header.php") ?>
<table width="760" border="0" cellspacing="0" cellpadding="0" class="bkg_body-main">
  <tr valign="top">

<td width="760"><div id="main_content_ip" align="left">

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
$sql="select * from tblotsdetail_facebook where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
print("<div>");
if(!$count){
	print("<b>Your shopping cart is empty</b><br />\n");
}else{
	print("<form  method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p class=\"title_main_sub\">\n");	
	print("<b>Order Form</b></p>\n");
	print("<p class=\"body_content_style1\">\n");	
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<b>Your shopping cart contains the following:</b><br />\n");
	print("</p></div>");
	print("<table width=\"700\" cellpadding=\"4\" cellspacing=\"2\">\n");
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
		$sqlfreeship="select free_ship from tblProducts_facebook where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$free_ship=$rowfreeship['free_ship'];
		}
		if($free_ship=='Yes'){
			$lbl="<br><span style=\"color:RED\">* - This product qualifies for free shipping</span>";
		}

		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr valign=\"middle\" bgcolor=\"#f3fbfe\"><input type=\"hidden\" name=\"qty[]\" value=\"".$qty."\">\n");
		print("<td><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td align=\"center\"><input type=\"button\" value=\"Go Back\" onclick=\"location.href='cart-facebook.php'\"></td>\n");
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
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Totals:</b>&nbsp;</span></td>\n");
	$totformat=number_format($carttot+$ship+$taxamt, 2, '.', ',');
	print("<td align=\"left\"><span class=\"body_content_style1\">$".$totformat."</span></td>\n");
	print("</tr></form>\n");
	#print("<tr>\n");
	#print("<td colspan=\"5\" align=\"right\"><input type=\"image\" src=\"pix/pix/b_recalculate.gif\" name=\"submit\" alt=\"Recalculate Totals\" border=\"0\" value=\"Recalculate Totals\"></form></td>\n");
	#print("</tr>\n");
	print("<tr>\n");
	print("<td colspan=\"5\" align=\"right\">");
	
?>
<!--<form action="DoDirectPaymentReceipt.php" method="POST" >-->
<form name="form1" id="form1" method="post" action="confirm_pre.php" onSubmit="return fVerifyResForm();"><input type="hidden" name="otsID" value="<? echo($o);?>">
<input type=hidden name=paymentType value="<?=$paymentType?>" />
<input type="hidden" name="ship" value="<?=$ship?>" />

<table width="600" align="center" cellpadding="1" cellspacing="1"><tr valign="top">
<td width="415" align="left">
<table width="276" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
<td colspan="2"><span class="section_heading_style1">Shipping Address:</span></td>
</tr><tr valign="top">
<td colspan="2">&nbsp;</td>
</tr><tr valign="top">
<td width="116"><span class="body_content_style1">First Name:</span></td>
<td width="160"><input type="text" size="25" maxlength="100" name="ship_fname" value="" class="forms3" /></td>
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
<td><span class="body_content_style1"><input type="text" size="10" maxlength="10" name="ship_zip" value="" class="forms2" />(5 or 9 digits)</span></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><span class="body_content_style1">Email:</span></td>
  <td><input name="email" id="email" type="text" size="25" value="" class="forms3"></td>
</tr>
<tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr></table></td>
<!-- <td width="10">&nbsp;</span></td> -->
<td width="415" align="left">

<table border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td colspan="2"><span class="section_heading_style1">Billing Address:</span></td>
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
<td><span class="body_content_style1"><input type="text" size="10" maxlength="10" name="zip" value="" class="forms2" />(5 or 9 digits)</span></td>
</tr></table></td>
</tr>
  <tr valign="top">
    <td class="body_content_style1" colspan="3" align="left"><table width="592" border="0" align="left">
      <tr>
        <td width="298" class="body_content_style1"><div align="left">Would you like to receive emails from Mass Save about special deals and savings? </div></td>
        <td width="12"></td>
        <td width="268"><label>
          <input name="ship_country" type="radio" id="ship_country" tabindex="17" value="Yes" checked>
          <span class="product_title_sm">Yes</span>
          <input name="ship_country" type="radio" id="ship_country" tabindex="18" value="No">
          <span class="product_title_sm">No</span></label></td>
      </tr>
    </table></td>
  </tr>
  <tr valign="top">
<td class="body_content_style1" colspan="3" align="left">
<img src="pix/pix_trans.gif" width="1" height="10"><span class="section_heading_style1">Payment Info:</span>

<table border="0" cellspacing="0" cellpadding="0">
<!--<tr valign="top">
<td><span class="body_content_style1">Amount:</span></td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</span></td>
</tr>-->
<tr valign="top">
<td valign="middle"><span class="body_content_style1">Name: (as it appears on credit card)&nbsp;</span></td>
<td><input type="text" size="30" maxlength="32" name="firstName" id="firstName" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<!--<td><span class="body_content_style1">Last Name:</span></td>
<td><input type="text" size="30" maxlength="32" name="lastName" value="Doe" /></span></td>
</tr><tr valign="top">-->						   
<td valign="middle"><span class="body_content_style1">Card Type:</span></td>
<td><input type="radio" id="creditCardType" name="creditCardType" value="Visa"><img src="pix/Visa.gif">&nbsp;&nbsp;
<input type="radio" id="creditCardType" name="creditCardType" value="MasterCard"><img src="pix/Master_Card.gif">&nbsp;&nbsp;
<input type="radio" id="creditCardType" name="creditCardType" value="Discover"><img src="pix/Discover.gif">&nbsp;&nbsp;</td>
</tr><tr valign="top">
<td valign="middle"><span class="body_content_style1">Card Number:</span></td>
<td><input type="text" size="19" maxlength="19" id="creditCardNumber" name="creditCardNumber" value="" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td valign="middle"><span class="body_content_style1">Expiration Date:</span></td>
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
</select></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td valign="middle"><span class="body_content_style1">Card Verification Number:</span></td>
<td><input type="text" size="3" maxlength="4" name="cvv2Number" id="cvv2Number" class="forms2" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td height="80"><span class="body_content_style1">Special Instructions:</span></td>
<td><textarea name="instr" id="instr" rows="5" cols="30" class="forms3" /></textarea></td>
</tr><tr valign="top">
<td height="24" class="field"></td>
<td><img src="pix/pix_trans.gif" width="1" height="10">
  <input type="submit" value="Confirm Order"></td>
</tr></table></td>
</tr></table>
</form>
</td>
</tr></table>
<?}?>
</p></td>
</tr></table></td>
</tr></table>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="34">&nbsp;</td>
    <td width="816"><table width="760" height="15"border="0" cellpadding="0" cellspacing="0" background="back-bottom.jpg">
  <tr>
    <td></td>
  </tr>
</table>
    </p></td>
  </tr>
</table>
<?php include_once("footer.php") ?>
</body>
</html>


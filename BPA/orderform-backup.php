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
		$sqlc="select * from tblorderstosend where sess='$sess' && status='open'";
		$resultc=db_query($sqlc);
		$countc=mysql_num_rows($resultc);
		if(!$countc){
			$sql="insert into tblorderstosend values ('','$sess','','','$stamp','open')";
			$result=db_query($sql);
			$next=mysql_insert_id();
		}else{
			while($rowc=mysql_fetch_array($resultc)){
				$next=$rowc['otsID'];
			}
		}
		$_SESSION['otsID']=$next;
		#add item to cart
		$sqli="select * from tblotsdetail where itemNo='$itemNo' && otsID='$next'";
		#print("".$sqli."<br />");
		$resulti=db_query($sqli);
		$counti=mysql_num_rows($resulti);
		if(!$counti){
			$sql2="insert into tblotsdetail values ('','$next','$itemNo','$quantity','$price','$desc')";
		}else{
			while($rowi=mysql_fetch_array($resulti)){
				$otsdetailID=$rowi['otsdetailID'];
				$qty=$rowi['qty'];
				$newqty=$qty+1;
			}
			$sql2="update tblotsdetail set qty='$newqty' where otsdetailID='$otsdetailID'";
		}
#		print($sql2);
		$result2=db_query($sql2);
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			$sql="update tblotsdetail set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
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
<link rel="icon" 
      type="image/png" 
      href="icon.png">
<title>TechniArt - Order Form</title>

<SCRIPT LANGUAGE="Javascript">
<!---
function pop(){

document.form1.fname.value=document.form1.ship_fname.value;
document.form1.lname.value=document.form1.ship_lname.value;
document.form1.address1.value=document.form1.ship_address1.value;
document.form1.address2.value=document.form1.ship_address2.value;
document.form1.city.value=document.form1.ship_city.value;
document.form1.state.value=document.form1.ship_state.value;
document.form1.zip.value=document.form1.ship_zip.value;
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

			if (oForm.ship_city.value=='') {
				errFlag = 1;
				errStr = errStr + "Please select your shipping city.\n";
			}
			if (oForm.ship_state.value=='') {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping state.\n";
			}

			if (oForm.ship_zip.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping zip.\n";
			}
			if (oForm.water.value=='') {
				errFlag = 1;
				errStr = errStr + "Please select your hot water heating source.\n";
			}
			
			if (oForm.firstName.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter the first name (or initial) that appears on your credit card.\n";
			}
			if (oForm.lastName.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter the last name that appears on your credit card.\n";
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    	
    /********************************************************************************************************************
    SIMPLE ACCORDIAN STYLE MENU FUNCTION
    ********************************************************************************************************************/    
    jQuery('div.accordionButton').click(function() {
        jQuery('div.accordionContent').slideUp('normal');    
        jQuery(this).next().slideDown('normal');
		
    });
	jQuery('div.accordionButton').first().click();
    /********************************************************************************************************************
    CLOSES ALL DIVS ON PAGE LOAD
    ********************************************************************************************************************/    
    jQuery("div.accordionContent").hide();
	

});
</script>
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
</head><?php include_once("analyticstracking.php") ?>
<BODY><center><div class="gridContainer clearfix"><div id="LayoutDiv1">
<?php include_once("header.php") ?>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<?
$o=$_GET['ID'];
if(!$o){
	$o=$_SESSION['otsID'];
}
$sql="select * from tblotsdetail where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
if(!$count){
	print("<span class=\"cart\"><b>Your shopping cart is empty</b><br />\n");
}else{
	print("<form  method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<span class=\"cart\"><b>Order Form</b></span><br><br>\n");
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<span class=\"cart\"><b>Your shopping cart contains the following:</b><br /><br>\n");
	print("<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n");
	print("<tr valign=\"top\">\n");
	print("<td align=\"center\"><span class=\"cart\"><b>Qty</b></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"cart\"><b>Item</b></td>\n");
	print("<td><span class=\"cart\"><b>Price</b></td>\n");
	print("<td><span class=\"cart\"><b>Total</b></td>\n");
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

		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$modelNumber=$rowfreeship['modelNumber'];}

		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr valign=\"middle\" bgcolor=\"#cccccc\" height=\"15\"><input type=\"hidden\" name=\"qty[]\" value=\"".$qty."\">\n");
		print("<td valign=\"middle\" align=\"center\"><span class=\"cart\">".$qty."</td>\n");
		print("<td align=\"center\"><input type=\"button\" value=\"Go Back\" onClick=\"location.href='cart.php'\" class=\"btn2\"></td>\n");
		print("<td><span class=\"cart\">".$productDesc."".$lbl."</td>\n");
		print("<td><span class=\"cart\">$".number_format($price, 2, '.', ',')."</td>\n");
		print("<td><span class=\"cart\">$".$tot."</td>\n");
		print("</tr>\n");
		
		$i++;
	}
	print("<tr><td></td></tr>\n");
	print("<tr bgcolor=\"#cccccc\">\n");
	print("<td colspan=\"4\" align=\"right\"><br><span class=\"cart\"><b>Subtotal:</b>&nbsp;</td>\n");
	print("<td style=\"padding-left:4px;\"><br><span class=\"cart\">$".number_format($carttot, 2, '.', ',')."</td>\n");
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
<center><div align="center"><span class="body_content_ip"> <br>
  ORDERS WILL ONLY BE SHIPPED TO EVERSOURCE ENERGY CUSTOMERS.<br>
  <br>
</div>
<div class="accordion_new">
    <div class="accordionButton">Shipping Information - Click to slide open</div>
    <div class="accordionContent">
        
        <table width="100%"  align="left" border="0" cellpadding="0" cellspacing="0">
          <tr align="top">
          <td align="left"><span class="footer_content_style1">* Required fields</span></td><td></td></tr>
          <tr valign="top">
             <td height="5" width="40%" align="left"></td>
            <td width="60%" align="left"></td>
          </tr>

          <tr valign="top">
             <td width="40%" align="left"><span class="cart">First Name: *</td>
            <td width="60%" align="left"><input type="text" size="25" maxlength="100" name="ship_fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Last Name: *</td>
            <td align="left"><input type="text" size="25" maxlength="100" name="ship_lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Address Line 1: *</td>
            <td align="left"><input type="text" size="25" maxlength="100" name="ship_address1" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Address Line 2:</td>
            <td align="left"><input type="text" size="25" maxlength="100" name="ship_address2" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">City: *</td>
    <td align="left"><input type="text" name="ship_city" id="ship_city" class="forms10" />
</td>
          </tr>
         <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">State: *</td>
            <td align="left"><select name="ship_state" class="forms10">
             <option value="MA">MA</option>
            </select></td>
          </tr>
         <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">ZIP Code (5 digit): *</td>
            <td align="left">
              <input type="text" size="5" maxlength="5" name="ship_zip" value="" class="forms10" />
              </td>
          </tr>
         <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Email: *</td>
            <td align="left"><input name="email" id="email" type="text" size="25" value="" class="forms10"></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
           <td align="left"><span class="cart">Account Number:</td>
  <td align="left"><input name="account" id="account" type="text" size="25" value="" class="forms10"></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
           <tr valign="top"><td height="39" align="left"><span class="cart">Have you ever used an advanced power strip before?</span></td>
            <td valign="middle" align="left"><input required name="email_opt" type="radio" id="email_opt" tabindex="17" value="Yes">
          <span class="cart">Yes</span>
          <input required name="email_opt" type="radio" id="email_opt" tabindex="18" value="No" checked>
          <span class="cart">No</span></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          </table></div></div></div>
        <br>
       <div class="accordion_new">
    <div class="accordionButton">Billing Information - Click to slide open</div>
    <div class="accordionContent">
        
        <table width="100%" align="left" border="0" cellspacing="0" cellpadding="0">
          <tr align="top">
          <td align="left"><span class="footer_content_style1">* Required fields</span></td><td></td></tr>
          <tr valign="top">
          <tr valign="top">
            <td colspan="2" align="left"><span class="cart">
              <input type="checkbox" name="same" value="yes" onClick="pop();">
              Same as Shipping Info:<br /><br />
              </td>
          </tr>
          <tr valign="top">
            <td width="40%" align="left"><span class="cart">First Name: *</td>
            <td width="60%" align="left"><input type="text" size="25" maxlength="100" name="fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Last Name: *</td>
            <td align="left"><input type="text" size="25" maxlength="100" name="lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Address Line 1: *</td>
            <td align="left"><input type="text" size="25" maxlength="100" name="address1" value="" class="forms10" /></td>
          </tr>
        <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Address Line 2:</td>
            <td align="left"><input type="text" size="25" maxlength="100" name="address2" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">City: *</td>
            <td align="left"><input type="text" size="25" maxlength="40" name="city" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">State: *</td>
            <td align="left"><select name="state" class="forms10">
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
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">ZIP Code (5 digit): *</td>
            <td align="left"><span class="cart">
              <input type="text" size="5" maxlength="5" name="zip" value="" class="forms10" />
              </td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
        </table></div></div></div>
        <br>
        <div class="accordion_new">
    <div class="accordionButton">Payment Information - Click to slide open</div>
    <div class="accordionContent">
        <table width="100%" align="left" border="0" cellspacing="0" cellpadding="0">
          <!--<tr valign="top">
<td><span class="body_content_style1">Amount:</td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</td>
</tr>-->
<tr align="top">
          <td align="left"><span class="footer_content_style1">* Required fields</span></td><td></td></tr>
          <tr valign="top">
          <tr valign="top">
            <td align="left" valign="middle"><span class="cart">Name on card:  *</td>
            <td align="left"><div style="display: inline"><input type="text" maxlength="32" name="firstName" class="forms6" placeholder="First Name"/></div><div style="display: inline"><input type="text" size="30" maxlength="32" name="lastName"  placeholder="Last Name" class="forms6"/></div></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
        <!--  <tr valign="top">
            <td><span class="body_content_style1">Last Name:</td>
<td><input type="text" size="30" maxlength="32" name="lastName" value="" /></td>
</tr>-->
<tr valign="top">
            <td align="left" valign="middle"><span class="cart">Card Type:  *</td>
            <td align="left"><input type="radio" id="creditCardType" name="creditCardType" value="Visa">
              <img src="pix/Visa.gif">&nbsp;&nbsp;
              <input type="radio" id="creditCardType" name="creditCardType" value="MasterCard">
              <img src="pix/Master_Card.gif">&nbsp;&nbsp;
              <input type="radio" id="creditCardType" name="creditCardType" value="Discover">
              <img src="pix/Discover.gif">&nbsp;&nbsp;</td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="cart">Card Number:  *</td>
            <td align="left"><input type="text" size="19" maxlength="19" id="creditCardNumber" name="creditCardNumber" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="cart">Expiration Date:  *</td>
            <td align="left"><select name="expDateMonth" id="expDateMonth" class="forms9">
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
              <select name="expDateYear" id="expDateYear" class="forms9">
                <option value=""></option>
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
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
              </select></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="cart">Card Verification Number:  *</td>
            <td align="left"><input type="text" size="3" maxlength="4" name="cvv2Number" id="cvv2Number" class="forms9" /></td>
          </tr>
         <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td height="80" align="left"><span class="cart">Special Instructions:</td>
            <td align="left"><textarea name="instr" id="instr" rows="5" cols="30" class="forms10" /></textarea></td>
          </tr>
         <tr valign="top">
            <td height="5"></td><td align="left"><input type="submit" class="btn1" value="Review Order"></td>
          </tr></td>
          </tr>
        </table></div></div></div>
     
   

</form>
</td>
</tr></table>
<?}?>
</p></td>
</tr></table></td>
</tr></table>
  <?php include_once("footer.php") ?>
</center>
</body>
</html>


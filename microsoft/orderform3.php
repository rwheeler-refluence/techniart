<? include("database.php"); ?>
<?
session_start();
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
		$sqlc="select * from tblorderstosend_nstar_ed where sess='$sess' && status='open'";
		$resultc=db_query($sqlc);
		$countc=mysql_num_rows($resultc);
		if(!$countc){
			$sql="insert into tblorderstosend_nstar_ed values ('','$sess','','','$stamp','open')";
			$result=db_query($sql);
			$next=mysql_insert_id();
		}else{
			while($rowc=mysql_fetch_array($resultc)){
				$next=$rowc['otsID'];
			}
		}
		$_SESSION['otsID']=$next;
		$_COOKIE['otsID']=$next;
		#add item to cart
		$sqli="select * from tblotsdetail_nstar_ed where itemNo='$itemNo' && otsID='$next'";
		#print("".$sqli."<br />");
		$resulti=db_query($sqli);
		$counti=mysql_num_rows($resulti);
		if(!$counti){
			$sql2="insert into tblotsdetail_nstar_ed values ('','$next','$itemNo','$quantity','$price','$desc')";
		}else{
			while($rowi=mysql_fetch_array($resulti)){
				$otsdetailID=$rowi['otsdetailID'];
				$qty=$rowi['qty'];
				$newqty=$qty+1;
			}
			$sql2="update tblotsdetail_nstar_ed set qty='$newqty' where otsdetailID='$otsdetailID'";
		}
#		print($sql2);
		$result2=db_query($sql2);
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			$sql="update tblotsdetail_nstar_ed set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
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
<title>TechniArt - NSTAR Earth Day Online Sale</title>

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
			
			if (oForm.ship_country.value=='') {
				errFlag = 1;
				errStr = errStr + "Please enter your billing state.\n";
			}

			if (oForm.zip.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing zip.\n";
			}

			if (oForm.phone.value=='') {
				errFlag = 1;
				errStr = errStr + "Please enter your phone number.\n";
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
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Order Form  </span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
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
if(!$o){
	$o=$_POST['otsID'];
}
$_SESSION['otsID']=$o;

$sql="select * from tblotsdetail_nstar_ed where otsID='$o'";
$result=db_query($sql);
#print($sql);
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
		$productDesc2=str_replace("<br>","",$productDesc);
		#check for free shipping
		$free_ship="";
		$lbl="";
		$sqlfreeship="select free_ship from tblProducts_nstar_ed where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$free_ship=$rowfreeship['free_ship'];
		}
		if($free_ship=='Yes'){
			$lbl="<br><span style=\"color:RED\"></span>";
		}

		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr valign=\"top\" bgcolor=\"#f3fbfe\"><input type=\"hidden\" name=\"qty[]\" value=\"".$qty."\">\n");
		print("<td><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td><a class=\"body_content_style1\" href=\"#\" onClick=\"javascript: decision('Are you sure you want to remove this item from your shopping bag?', 'https://secure40.securewebsession.com/techniart.com/raytheon/remove.php?ID=".$otsdetailID."');\"><span class=\"body_content_style1\">REMOVE?</span></a></td>\n");
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
#		$finaltot=$carttot*1`;
#		$taxamt=$carttot*.0625;
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
<div align="left"><span class="body_content_style1">*Please note: Please fill out all fields. Sales tax will be added on the confirmation page.</span></div><br>

<!--<form action="DoDirectPaymentReceipt.php" method="POST" >-->
<form name="form1" id="form1" method="post" action="confirm_pre.php" onSubmit="return fVerifyResForm();"><input type="hidden" name="otsID" value="<? echo($o);?>">
<input type=hidden name=paymentType value="<?=$paymentType?>" />
<input type="hidden" name="ship" value="<?=$ship?>" />

<table width="830" align="center" cellpadding="1" cellspacing="1"><tr valign="top">
<td width="427" align="left">
<table width="399" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
<td colspan="2"><span class="section_heading_style2">Billing Address:</span></td>
</tr><tr valign="top">
<td colspan="2">&nbsp;</td>
</tr>
<tr valign="top">
  <td width="122"><span class="body_content_style1">First Name:</span></td>
  <td width="255"><input type="text" size="25" maxlength="100" name="fname" value="" class="forms3" /></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><span class="body_content_style1">Last Name:</span></td>
  <td><input type="text" size="25" maxlength="100" name="lname" value="" class="forms3" /></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><span class="body_content_style1">Address 1:</span></td>
  <td><input type="text" size="25" maxlength="100" name="address1" value="" class="forms3" /></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><span class="body_content_style1">Address 2:<br>
    (optional)</span></td>
  <td><input type="text" size="25" maxlength="100" name="address2" class="forms3" /></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><span class="body_content_style1">City:</span></td>
  <td><input type="text" size="25" maxlength="40" name="city" value="" class="forms3" /></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
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
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td><span class="body_content_style1">ZIP Code:</span></td>
  <td><span class="body_content_style1">
    <input type="text" size="10" maxlength="10" name="zip" value="" class="forms2" />
    (5 or 9 digits)</span></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
  <td colspan="2">&nbsp;</td>
</tr>
</table></td>
<td width="394" align="left"><table width="399" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td colspan="2"><span class="section_heading_style2">Office Information :</span></td>
  </tr>
  <tr valign="top">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td width="122"><span class="body_content_style1">Office Location:</span></td>
  <td width="255"><select name="ship_country" id="ship_country" value="<? echo($country); ?>" class="forms5">
    <option value=" " selected> </option>
    <option value="Hyde Park">Hyde Park</option>
    <option value="Martha's Vineyard">Martha's Vineyard</option>
    <option value="Mass Ave.">Mass Ave.</option>
    <option value="New Bedford">New Bedford</option>
    <option value="Plymouth">Plymouth</option>
    <option value="Prudential">Prudential</option>
    <option value="Somerville">Somerville</option>
    <option value="Southborough">Southborough</option>
    <option value="Walpole">Walpole</option>
    <option value="Waltham">Waltham</option>
    <option value="Wareham">Wareham</option>
    <option value="Westwood">Westwood</option>
    <option value="Worcester">Worcester</option>
    <option value="Yarmouth">Yarmouth</option>
  </select></td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">Phone Number: </span></td>
    <td><input name="phone" type="text" class="forms3" value="" size="12" maxlength="12"></td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">Email:</span></td>
    <td><input name="email" id="email" type="text" size="25" value="" class="forms3"></td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">Special Instructions:</span></td>
    <td><textarea name="instr" id="instr" rows="5" cols="200" class="forms5" />    </textarea></td>
  </tr>
  <tr valign="top">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr valign="top">
    <td colspan="2">&nbsp;</td>
  </tr>
</table></td>
<!-- <td width="10">&nbsp;</span></td> -->
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
<input type="radio" id="creditCardType" name="creditCardType" value="Discover"><img src="pix/Discover.gif">&nbsp;&nbsp;</td>
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
</select></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Verification Number:</span></td>
<td><input type="text" size="3" maxlength="4" name="cvv2Number" id="cvv2Number" class="forms2" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td class="field"></td>
<td><img src="pix/pix_trans.gif" width="1" height="10"><br>
<input type="submit" value="Confirm Order"></td>
</tr></table></td>
</tr></table>
</form>
</td>
</tr></table>
<?}?>
</p><br>


</div></td>
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="1" border="0"></td>
</tr></table>

</td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><img src="pix/g_body_bot.gif" alt="" width="906" height="12" border="0"></td>
</tr></table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->

<!-- ------------------------------end footer------------------------------ -->

</body>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7592070-3");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>


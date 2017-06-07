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
		$sqlc="select * from tblorderstosend_pse where sess='$sess' && status='open'";
		$resultc=db_query($sqlc);
		$countc=mysql_num_rows($resultc);
		if(!$countc){
			$sql="insert into tblorderstosend_pse values ('','$sess','','','$stamp','open')";
			$result=db_query($sql);
			$next=mysql_insert_id();
		}else{
			while($rowc=mysql_fetch_array($resultc)){
				$next=$rowc['otsID'];
			}
		}
		$_SESSION['otsID']=$next;
		#add item to cart
		$sqli="select * from tblotsdetail_pse where itemNo='$itemNo' && otsID='$next'";
		#print("".$sqli."<br />");
		$resulti=db_query($sqli);
		$counti=mysql_num_rows($resulti);
		if(!$counti){
			$sql2="insert into tblotsdetail_pse values ('','$next','$itemNo','$quantity','$price','$desc')";
		}else{
			while($rowi=mysql_fetch_array($resulti)){
				$otsdetailID=$rowi['otsdetailID'];
				$qty=$rowi['qty'];
				$newqty=$qty+1;
			}
			$sql2="update tblotsdetail_pse set qty='$newqty' where otsdetailID='$otsdetailID'";
		}
#		print($sql2);
		$result2=db_query($sql2);
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			$sql="update tblotsdetail_pse set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
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
 
        
});
		
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
</head><?php include_once("analyticstracking.php") ?><? include("bluebar.php")?>
<BODY><center><div class="gridContainer clearfix"><div id="LayoutDiv1">

<table width="906" border="0" align="center" cellpadding="0" cellspacing="0" class="bkg_body-main">
  <tr valign="top">

<td width="906"><div align="center" class="footer_content_style1"><div id="main_content_ip" align="left">

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
$sql="select * from tblotsdetail_pse where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
print("<div>");
if(!$count){
	print("<p class=\"body_content_style1\"><br /><br />\n");
	print("<p align=\"center\" class=\"body_content_style1\"><b>Your cart is empty.</b></p><br />\n");
	print("<p align=\"center\" class=\"body_content_style1\"><b>Click below to start over.</b></p><br />\n");
	print("<p align=\"center\"><input type=\"button\" class=\"btn\" value=\"Start Over\" onclick=\"location.href='index.php'\">\n");
	print("</tr>\n");
}else{
	
	print("<form  method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p class=\"title_main_sub\">\n");	
	print("<b>Order Form</b></p>\n");
	print("<p class=\"body_content_style1\">\n");	
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<b>Your shopping cart contains the following:</b><br />\n");
	print("</p></div>");
	print("<table width=\"760\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td align=\"center\"><span class=\"section_heading_style1\"><b>Qty</b></span></td>\n");
#	print("<td>&nbsp;</td>\n");
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
		$sqlfreeship="select modelNumber from tblProducts where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$modelNumber=$rowfreeship['modelNumber'];}

		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr valign=\"middle\" bgcolor=\"#ffffff\"><input type=\"hidden\" name=\"qty[]\" value=\"".$qty."\">\n");
		print("<td valign=\"middle\" align=\"center\"><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td align=\"center\"><input type=\"button\" value=\"Go Back\" onClick=\"location.href='cart.php'\" class=\"btn2\"><br /><img src=\"pix/pix_trans.gif\" height=\"1\"><br /><input type=\"button\" class=\"btn2\" value=\"Remove\" onClick=\"location.href='remove.php?ID=".$otsdetailID."'\"></td>\n");
#		print("<td></td>\n");
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
		$taxamt=$carttot*.08;
		$taxformat=number_format($taxamt, 2, '.', ',');
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
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:</b>&nbsp;</span></td>\n");
#	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
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
<?
		$product242 = mysql_query("SELECT qty FROM tblotsdetail_pse WHERE otsID = '$o' && itemNo='242' ");
if (mysql_num_rows($product242)) {
    $P242 = mysql_fetch_assoc($product242);
    $wwlimit=$P242['qty']*1;}
	
			$product243 = mysql_query("SELECT qty FROM tblotsdetail_pse WHERE otsID = '$o' && itemNo='24e' ");
if (mysql_num_rows($product243)) {
    $P243 = mysql_fetch_assoc($product243);
    $cwlimit=$P242['qty']*1;}
$combolimit=$wwlimit+$cwlimit;

if ($combolimit>4){echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You have exceeded the limit of combos allowed.')
		window.location.href='https://www.techniart.us/pseoffice/cart.php'
        </SCRIPT>";}
?>
<center>
<div class="accordion">
    <div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-1">Billing Information - Click to slide open</a>
         
        <div id="accordion-1" class="accordion-section-content">
        <table width="650"  align="left" border="0" cellpadding="0" cellspacing="0">
          <tr valign="top">
            <td width="184" align="left"><span class="product_title_sm">First Name:</span></td>
            <td width="368" align="left"><input type="text" size="25" maxlength="100" name="fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">Last Name:</span></td>
            <td align="left"><input type="text" size="25" maxlength="100" name="lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">Address Line 1:</span></td>
            <td align="left"><input type="text" size="25" maxlength="100" name="address1" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">Address Line 2:<br>
              (optional)</span></td>
            <td align="left"><input type="text" size="25" maxlength="100" name="address2" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" class="product_title_sm">City:</td>
    <td align="left"><input type="text" name="city" id="city" class="forms10" />
</td>
          </tr>
         
                  <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">State:</span></td>
            <td align="left"><select name="state" class="forms9">
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
            </select></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">ZIP Code:</span></td>
            <td align="left"><span class="product_title_sm">
              <input type="text" size="5" maxlength="5" name="zip" value="" class="forms9" />
              (5  digit)</span><br><br>


</td>
          </tr>
          
        </table></div></div></div>
        <br>
        <div class="accordion">
    <div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-2">Delivery Information - Click to slide open</a>
          <div id="accordion-2" class="accordion-section-content">
       
       
        <table width="739" align="left" border="0" cellspacing="0" cellpadding="0">
            <tr valign="top">
            <td align="left"><span class="product_title_sm">Email:</span></td>
            <td align="left"><input type="text" size="25" maxlength="100" name="email" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td width="237" align="left"><span class="product_title_sm">Phone:</span></td>
            <td width="352" align="left"><input type="text" size="25" maxlength="100" name="phone" value="" class="forms10" /></td>
          </tr>
                 <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" alt="" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">Please select your office location:</span></td>
            <td align="left"><select name="office" class="forms10">
 <option value=""></option>
 <option value="Access Center (Bothell)">Access Center (Bothell)</option>
<option value="Baker River Office ">Baker River Office </option>
<option value="Bellingham Business Office">Bellingham Business Office</option>
<option value="Bellingham Service Center">Bellingham Service Center</option>
<option value="Dayton Office">Dayton Office</option>
<option value="Eastside System Operations">Eastside System Operations</option>
<option value="Ellensburg Business Office">Ellensburg Business Office </option>
<option value="Encogen">Encogen</option>
<option value="Enumclaw Service Center">Enumclaw Service Center</option>
<option value="Everett Operating Base">Everett Operating Base</option>
<option value="Factoria Service Center">Factoria Service Center</option>
<option value="Frederickson Combustion Turbine">Frederickson Combustion Turbine</option>
<option value="Fredonia Combustion Turbine">Fredonia Combustion Turbine</option>
<option value="Georgetown Operating Base">Georgetown Operating Base</option>
<option value="Goldendale Generating">Goldendale Generating</option>
<option value="Jackson Prairie">Jackson Prairie</option>
<option value="Kitsap Service Center">Kitsap Service Center</option>
<option value="Kittitas Service Center">Kittitas Service Center</option>
<option value="Lakewood Business Office ">Lakewood Business Office </option>
<option value="Lincoln Executive Center">Lincoln Executive Center</option>
<option value="Mint Farm Generation Plant">Mint Farm Generation Plant</option>
<option value="North Seattle Operations">North Seattle Operations</option>
<option value="Oak Harbor Business Office">Oak Harbor Business Office</option>
<option value="Olympia Business Office">Olympia Business Office </option>
<option value="Pomeroy Office">Pomeroy Office</option>
<option value="Poulsbo Service Center">Poulsbo Service Center</option>
<option value="PSE Building (Bellevue Campus)">PSE Building (Bellevue Campus)</option>
<option value="PSE EST Building (Bellevue Campus)">PSE EST Building (Bellevue Campus) </option>
<option value="Puyallup Service Center ">Puyallup Service Center </option>
<option value="Redmond North">Redmond North</option>
<option value="Redmond West">Redmond West</option>
<option value="Redmond West South">Redmond West South</option>
<option value="Shuffleton">Shuffleton</option>
<option value="Skagit Service Center">Skagit Service Center</option>
<option value="Snoqualmie Conference Center">Snoqualmie Conference Center</option>
<option value="South King Service Center">South King Service Center</option>
<option value="South Whidbey Island Office">South Whidbey Island Office</option>
<option value="Sumas Plant">Sumas Plant</option>
<option value="Tacoma Business Office ">Tacoma Business Office </option>
<option value="Vashon Office">Vashon Office</option>
<option value="Whidbey Service Center">Whidbey Service Center</option>
<option value="White Horn Generator Station">White Horn Generator Station</option>
<option value="Wild Horse Business Office">Wild Horse Business Office</option>
            </select></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" alt="" width="1" height="5"></td>
            </tr>
         
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
        </table></div></div></div>
        <br>
        <div class="accordion">
    <div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-3">Payment Information - Click to slide open</a>
         
        <div id="accordion-3" class="accordion-section-content">
        <table width="550" align="left" border="0" cellspacing="0" cellpadding="0">
          <!--<tr valign="top">
<td><span class="product_title_sm">Amount:</span></td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</span></td>
</tr>-->
          <tr valign="top">
            <td width="316" align="left" valign="middle"><span class="product_title_sm">Name: (as it appears on credit card)&nbsp;</span></td>
            <td width="265" align="left"><input type="text" size="30" maxlength="32" name="firstName" id="firstName" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <!--<td><span class="product_title_sm">Last Name:</span></td>
<td><input type="text" size="30" maxlength="32" name="lastName" value="Doe" /></span></td>
</tr><tr valign="top">-->
            <td align="left" valign="middle"><span class="product_title_sm">Card Type:</span></td>
            <td align="left"><input type="radio" id="creditCardType" name="creditCardType" value="Visa">
              <img src="pix/Visa.gif">&nbsp;&nbsp;
              <input type="radio" id="creditCardType" name="creditCardType" value="MasterCard">
              <img src="pix/Master_Card.gif">&nbsp;&nbsp;
              <input type="radio" id="creditCardType" name="creditCardType" value="Discover">
              <img src="pix/Discover.gif">&nbsp;&nbsp;</td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="product_title_sm">Card Number:</span></td>
            <td align="left"><input type="text" size="19" maxlength="19" id="creditCardNumber" name="creditCardNumber" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="product_title_sm">Expiration Date:</span></td>
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
              <select name="expDateYear" id="expDateYear" class="forms11">
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
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="product_title_sm">Card Verification Number:</span></td>
            <td align="left"><input type="text" size="3" maxlength="4" name="cvv2Number" id="cvv2Number" class="forms9" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td height="80" align="left"><span class="product_title_sm">Special Instructions:</span></td>
            <td align="left"><textarea name="instr" id="instr" rows="5" cols="30" class="forms10" /></textarea></td>
          </tr><br />
          <tr valign="top">
            <td height="24" align="left" class="field"><br /></td>
            <td align="left"><img src="pix/pix_trans.gif" width="1" height="10"><br>
<input type="submit" class="btn" value="Review Order">
<br><br></td>
          </tr>
        </table></div></div></div>
     
   

</form>
</td>
</tr></table>
<?}?>
</p></td>
</tr></table></td>
</tr></table>
  <?php include_once("footer.php") ?></div>
</div></center>
</body>
</html>


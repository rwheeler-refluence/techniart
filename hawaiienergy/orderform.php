<? include("database.php");?>

<html>
<head>
<title>TechniArt - Order Form</title>
<script type="text/javascript">
function loadContent(elementSelector, sourceUrl) {
	$(""+elementSelector+"").load(sourceUrl);
	
}
</script>
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>

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
			if (oForm.phone.value.length == 0) {
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

			if (oForm.pickup.value=='') {
				errFlag = 1;

				errStr = errStr + "Please select your pickup location.\n";
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
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>

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
 
        $('accordion div:first a').trigger('click');
});
		
    });
	
</script>
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
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<style type="text/css">
<!--
body,td,th {
	color: #000000;
}
a:link {
	color: #FFFFFF;
}
a:visited {
	color: #FFFFFF;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<BODY><?php include_once("analyticstracking.php") ?>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<center><div class="rcorners2">
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
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
$sql="select * from tblotsdetail where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
print("<div>");
if(!$count){
	print("<p class=\"body_content_style1\"><br /><br />\n");
	print("<p align=\"center\" class=\"body_content_style1\"><b>Your cart is empty.</b></p><br />\n");
	print("<p align=\"center\" class=\"body_content_style1\"><b>Click below to start over.</b></p><br />\n");
	print("<p align=\"center\"><input type=\"button\" class=\"btn\" value=\"Start Over\" onclick=\"location.href='store.php'\">\n");
	print("</tr>\n");
}else{
	
	print("<form  method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p class=\"title_main_sub\">\n");	
	print("<b>Order Form</b></p>\n");
	print("<p class=\"body_content_style1\">\n");	
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<b>Your shopping cart contains the following:</b><br />\n");
	print("</p></div>");
	print("<table width=\"850\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td align=\"center\"><span class=\"section_heading_style1\"><b>Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	#print("<td>&nbsp;</td>\n");
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
		print("<td align=\"center\"><input type=\"button\" value=\"Go Back\" onClick=\"location.href='http://www.techniart.us/hawaiienergy/cart.php'\" class=\"btn2\"><br /><img src=\"pix/pix_trans.gif\" height=\"1\"><br /><input type=\"button\" class=\"btn2\" value=\"Remove\" onClick=\"location.href='remove.php?ID=".$otsdetailID."'\"></td>\n");
		#print("<td align=\"center\"><img src=\"pix/products/thumbnails/".$modelNumber.".jpg\" width=\"50\"></td>\n");
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
		$taxamt=$carttot*.09;
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
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"4\" align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
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
  ORDERS WILL ONLY BE SHIPPED TO HAWAII ENERGY CUSTOMERS.
  <br>
</div>

       <span class="accordion-section-title"><strong>Shipping Information</strong></span>
        
        
        <table width="100%"  align="left" border="0" cellpadding="0" cellspacing="0">
          <tr align="top">
          <td align="left"><span class="footer_content_style1">* Required fields</span></td><td></td></tr>
          <tr valign="top">
             <td height="5" width="40%" align="left"></td>
            <td width="60%" align="left"></td>
          </tr>

          <tr valign="top">
             <td width="40%" align="left"><span class="cart">First Name: *</td>
            <td width="60%" align="left"><input required type="text" size="25" maxlength="100" name="ship_fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Last Name: *</td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="ship_lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Address Line 1: *</td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="ship_address1" value="" class="forms10" /></td>
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
    <td align="left"><input required type="text" name="ship_city" id="ship_city" class="forms10" />
</td>
          </tr>
         <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">State: *</td>
            <td align="left"><select name="ship_state" class="forms10">
             <option value="HI">HI</option>
            </select></td>
          </tr>
         <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">ZIP Code (5 digit): *</td>
            <td align="left">
              <input required type="text" size="5" maxlength="5" name="ship_zip" value="" class="forms10" />
              </td>
          </tr>
            
         <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Email: *</td>
            <td align="left"><input required name="email" id="email" type="text" size="25" value="" class="forms10"></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          
        <tr valign="top">
           <td align="left"><span class="cart">Island: *</td>
  <td align="left"><select name="island" id="island" class="forms10">
          <option></option>
          <option value="Hawaii">Hawaii</option>
          <option value="Lanai">Lanai</option>
          <option value="Maui">Maui</option>
          <option value="Molokai">Molokai</option>
          <option value="Oahu">Oahu</option></select></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
                   <tr valign="top"><td height="39" align="left"><span class="cart">How many people live in your household (including yourself)?</span></td>
            <td valign="middle" align="left"><select required name="people" id="people" class="forms10">
          <option></option>
          <option value="One">One</option>
          <option value="Two">Two</option>
                    <option value="Three">Three</option>
                              <option value="Four">Four</option>
                                        <option value="Five">Five</option>
                                                  <option value="Six or more">Six or more</option>
</select></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top"><td height="39" align="left"><span class="cart">What type of water heating does your home have?</span></td>
            <td valign="middle" align="left"><select required name="water" id="water" class="forms10">
          <option></option>
          <option value="Standard electric tank">Standard electric tank</option>
          <option value="Electric tankless">Electric tankless</option>
          <option value="Gas">Gas</option>
          <option value="Gas tankless">Gas tankless</option>
          <option value="Heat pump">Heat pump</option>
          <option value="Solar water heating">Solar water heating</option></select></td>
          </tr>
           <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top"><td height="39" align="left"><span class="cart">Would you like to opt-in to receive email communications from Hawaii Energy?</span></td>
            <td valign="middle" align="left"><input required name="email_opt" type="radio" id="email_opt" tabindex="17" value="Yes" checked>
          <span class="cart">Yes</span>
          <input required name="email_opt" type="radio" id="email_opt" tabindex="18" value="No">
          <span class="cart">No</span></td>
          </tr>
         
          </table>
        <br><br>

       

        <span class="accordion-section-title"><strong>Billing Information</strong></span>
      
        
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
            <td width="60%" align="left"><input required type="text" size="25" maxlength="100" name="fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Last Name: *</td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Address Line 1: *</td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="address1" value="" class="forms10" /></td>
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
            <td align="left"><input required type="text" size="25" maxlength="40" name="city" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">State: *</td>
            <td align="left"><select required name="state" class="forms10">
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
              <input required type="text" size="5" maxlength="5" name="zip" value="" class="forms10" />
              </td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr><tr valign="top">
            <td height="5"></td>
          </tr>
        </table>
        <br><br>


        <span class="accordion-section-title"><strong>Payment Information</strong></span>
         

        <table width="100%" align="left" border="0" cellspacing="0" cellpadding="0">
          <!--<tr valign="top">
<td><span class="body_content_style1">Amount:</td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</td>
</tr>-->
<tr align="top">
          <td width="40%" align="left"><span class="footer_content_style1">* Required fields</span></td><td></td></tr>
          <tr valign="top">
          <tr valign="top">
            <td align="left" valign="middle"><span class="cart">Name on card:  *</td>
            <td align="left"><div style="display: inline"><input required type="text" maxlength="32" name="firstName" class="forms10" placeholder="First Name"/></div><div style="display: inline"><input required type="text" size="30" maxlength="32" name="lastName"  placeholder="Last Name" class="forms10"/></div></td>
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
            <td align="left"><input required type="radio" id="creditCardType" name="creditCardType" value="Visa">
              <img src="pix/Visa.gif">&nbsp;&nbsp;
              <input required type="radio" id="creditCardType" name="creditCardType" value="MasterCard">
              <img src="pix/Master_Card.gif">&nbsp;&nbsp;
              <input required type="radio" id="creditCardType" name="creditCardType" value="Discover">
              <img src="pix/Discover.gif">&nbsp;&nbsp;</td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="cart">Card Number:  *</td>
            <td align="left"><input required type="text" size="19" maxlength="19" id="creditCardNumber" name="creditCardNumber" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="cart">Expiration Date:  *</td>
            <td align="left"><select required name="expDateMonth" id="expDateMonth" class="forms9">
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
              <select required name="expDateYear" id="expDateYear" class="forms9">
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
            <td height="5"></td><td align="left"><input type="submit" class="btn" value="Review Order"></td>
          </tr></td>
          </tr>
        </table>
     
   

</form>
</td>
</tr></table>
<?}?>
</p></td>
</tr></table></td>
</tr></table>
</div>
  <?php include_once("footer.php") ?></div>
</div></center>
</body>
</html>


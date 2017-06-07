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
		$sqlc="select * from tblorderstosend_led where sess='$sess' && status='open'";
		$resultc=db_query($sqlc);
		$countc=mysql_num_rows($resultc);
		if(!$countc){
			$sql="insert into tblorderstosend_led values ('','$sess','','','$stamp','open')";
			$result=db_query($sql);
			$next=mysql_insert_id();
		}else{
			while($rowc=mysql_fetch_array($resultc)){
				$next=$rowc['otsID'];
			}
		}
		$_SESSION['otsID']=$next;
		#add item to cart
		$sqli="select * from tblotsdetail_led where itemNo='$itemNo' && otsID='$next'";
		#print("".$sqli."<br />");
		$resulti=db_query($sqli);
		$counti=mysql_num_rows($resulti);
		if(!$counti){
			$sql2="insert into tblotsdetail_led values ('','$next','$itemNo','$quantity','$price','$desc')";
		}else{
			while($rowi=mysql_fetch_array($resulti)){
				$otsdetailID=$rowi['otsdetailID'];
				$qty=$rowi['qty'];
				$newqty=$qty+1;
			}
			$sql2="update tblotsdetail_led set qty='$newqty' where otsdetailID='$otsdetailID'";
		}
#		print($sql2);
		$result2=db_query($sql2);
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			$sql="update tblotsdetail_led set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
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

			
			if (oForm.office.value.length =='') {
				errFlag = 1;
				errStr = errStr + "Please select your office location.\n";
			}

			if (oForm.mailstop.value == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your mail stop.\n";
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #F0F0F0;
}
-->
</style>
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
<BODY><center><div class="gridContainer clearfix"><div id="LayoutDiv1">
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<?
$o=$_GET['ID'];
if(!$o){
	$o=$_SESSION['otsID'];
}
$sql="select * from tblotsdetail_led where otsID='$o'";
$result=db_query($sql);
$count=mysql_num_rows($result);
if(!$count){
	print("<span class=\"cart\"><b>Your shopping cart is empty</b><br />\n");
}else{
	print("<form  method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<br><span class=\"cart\"><b>Order Form</b></span><br><br>\n");
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
		print("<td align=\"center\"><input type=\"button\" value=\"Go Back\" onClick=\"location.href='cart1.php'\" class=\"btn2\"></td>\n");
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
<form name="form1" id="form1" method="post" action="confirm_pre1.php" onSubmit="return fVerifyResForm();"><input type="hidden" name="otsID" value="<? echo($o);?>">
<input type=hidden name=paymentType value="<?=$paymentType?>" />
<input type="hidden" name="ship" value="<?=$ship?>" />
<center><div align="center"><span class="body_content_ip"> <br>
  ORDERS WILL ONLY BE DELIVERED TO SDG&E RESIDENTIAL CUSTOMERS.<br>
  <br>
</div>
        <table width="100%"  align="left" border="0" cellpadding="0" cellspacing="0">
           <tr valign="top">
            <td width="40%" align="left"><span class="cart">First Name:</td>
            <td width="60%" align="left"><input required type="text" size="25" maxlength="100" name="ship_fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Last Name:</td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="ship_lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Address Line 1:</td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="ship_address1" value="" class="forms10" /></td>
          </tr>
        <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">Address Line 2:<br>
              (optional)</td>
            <td align="left"><input type="text" size="25" maxlength="100" name="ship_address2" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">City:</td>
            <td align="left"><input required type="text" size="25" maxlength="40" name="ship_city" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">State:</td>
            <td align="left"><select name="ship_state" class="forms10">
             
              <option value="CA">CA</option>
                         </select></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="cart">ZIP Code(5 digit):</td>
            <td align="left"><span class="cart">
              <input required type="text" size="5" maxlength="5" name="ship_zip" value="" class="forms10" />
              </td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
            <tr valign="top">
            <td align="left"><span class="cart">Email:</td>
            <td align="left"><input required name="email" id="email" type="text" size="25" value="" class="forms10"></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
           <td align="left"><span class="cart">Phone Number:</td>
  <td align="left"><input name="phone" id="phone" type="text" size="25" value="" class="forms10"></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
           <tr valign="top">
            <td height="80" align="left"><span class="cart">Special Instructions:</td>
            <td align="left"><textarea name="instr" id="instr" rows="5" cols="30" class="forms10" /></textarea></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <? if($itemNo==244 && $qty>0){?><tr valign="top">
                      <td height="41" colspan="2" align="left"><input required type="checkbox" name="pledge" id="pledge" value="Checked">&nbsp;&nbsp;I pledge to install the low-flow showerhead and aerators in my home.<br><br>

                      <input required type="checkbox" required name="customer" id="customer" value="Yes">
                      &nbsp;I am a SDG&amp;E residential gas customer. Electric only customers do not qualify.<br>
                      <br>
                      <input required type="checkbox" required name="swear" id="swear" value="Yes">
                      This is my first water and energy savings kit from SDG&amp;E. I understand there is a limit of one kit per household every 10 years.<br></td>
                    </tr><?}?>
                    <tr valign="top">
            <td height="5"></td>
          </tr>
         <tr valign="top">
            <td height="5"></td><td><input type="submit" class="btn1" value="Review Order"></td>
          </tr></td>
          </tr>
          
          </table></div></div></div>
        <br>
       
      
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


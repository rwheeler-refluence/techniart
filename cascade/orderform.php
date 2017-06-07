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
$("div."+config.accordion).first().click();
});
		
    });
	
</script>
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>



<link rel="stylesheet" type="text/css" href="css/main.css"/>

<style type="text/css">





#pleasewait {position: absolute; top: 0px; left:0px; height:2000px; width:100%;font: 12px Archivo Narrow, Arial, Helvetica; visibility:hidden; z-index: 100000; background-color:#eee;filter:alpha(opacity=50); -moz-opacity:0.5 ;opacity: 0.5;}
#checkout a {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#checkout a:hover {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#checkout a:active {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}

#close a {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#close a:hover {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#close a:active {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}


#prods {position: absolute; top: 700px; left:300px; height:2525px; width:975px;display:block;background:#ffffff; border: 0px solid #000000; z-index: 1000; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;}
#register {position: absolute; top: 415px; left:0px; height:1300px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}

#cart {position: absolute; top: 415px; left:0px; height:700px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}
#review_checkout {position: absolute; top: 415px; left:0px; height:700px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}
#forgotpass {position: absolute; top: 185px; left:325px; height:325px; width:585px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 1002; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
#signin {position: absolute; top: 385px; left:250px; height:475px; width:730px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
#messagescr {position: absolute; top: 215px; left:340px; height:450px; width:570px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 10003; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
li~li {
	border-left: 1px solid #ffffff;
}
.content{
	margin-left:50px;
}
</style>
<style>.btn {
  -webkit-border-radius: 10;
  -moz-border-radius: 10;
  border-radius: 10px;
  font-family: Arial;
  color: #ffffff;
  font-size: 12px;
  background: #82b101;
  padding: 10px 10px 10px 10px;
  text-decoration: bold;
  border: none;
}

.btn:hover {
  background: #3daff3;
	cursor: pointer;
  text-decoration: none;
	}</style></head>
<BODY>

<?php include_once("cart-header.php") ?>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-left:20px">
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
	print("<table width=\"90%\" cellpadding=\"0\" cellspacing=\"0\">\n");
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
ORDERS WILL ONLY BE SHIPPED TO RESIDENTIAL CUSTOMERS OF CASCADE WATER.<br>
  <br>
</div>

       <span class="accordion-section-title">Shipping Information</span>
        
        
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
             <option value="WA">WA</option>
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
           <td align="left"><span class="cart">Account Number: *</td>
  <td align="left"><input required name="account" id="account" type="text" size="25" value="" class="forms10"></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          
          </table>
        <br>
       

        
        <br>

        <span class="accordion-section-title">Payment Information</span>
         

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
            <td align="left"><div style="display: inline"><input required type="text" maxlength="32" name="firstName" class="forms6" placeholder="First Name"/></div><div style="display: inline"><input required type="text" size="30" maxlength="32" name="lastName"  placeholder="Last Name" class="forms6"/></div></td>
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
            <td height="5"></td><td align="left"><input type="submit" class="btn1" value="Review Order"></td>
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
  <?php include_once("footer-cart.php") ?>
</center>
</body>
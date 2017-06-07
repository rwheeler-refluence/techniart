<? include("database.php"); ?>
<?
$ship_fname=$_POST['ship_fname'];
$ship_lname=$_POST['ship_lname'];
$ship_address1=$_POST['ship_address1'];
$ship_address2=$_POST['ship_address2'];
$ship_city=$_POST['ship_city'];
$ship_state=$_POST['ship_state'];
$name=$_POST['name'];
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
		$case_quantity=$_POST['case_quantity'];
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
			$sql2="insert into tblotsdetail values ('','$next','$itemNo','$quantity','$price','$case_quantity','$desc','')";
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
<title>PSE HomePrint Order Form</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<script language="javascript">
document.getElementById("ship_form").submit();// Form submission
</script>
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
</head>

<BODY>
<?php include("bluebar.php") ?><center><div class="fbwhitebox"><?php include("header.php") ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div id="title_spacer" align="left"><span class="title_main">Order Form</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1"></td>
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
	print("<b>Your shopping cart is empty</b><br />\n");
}else{
	print("<form  method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p class=\"body_content_style1\">\n");
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<b>Your shopping cart contains the following:</b><br />\n");
	print("</p></div>");
	print("<table width=\"830\" cellpadding=\"2\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td><span class=\"product_title\"><b>Case Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"product_title\"><b>Product Description</b></span></td>\n");
	print("<td align=\"center\"><span class=\"product_title\"><b>Products<br>per Case</b></span></td>\n");
	print("<td align=\"center\"><span class=\"product_title\"><b>Total<br>Products</b></span></td>\n");
	print("<td align=\"center\"><span class=\"product_title\"><b>Total<br>Cost</b></span></td>\n");
	print("</tr>\n");
	$i=1;
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
		$sqlfreeship="select free_ship from tblProducts where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$free_ship=$rowfreeship['free_ship'];
		}
		if($free_ship=='Yes'){
			$lbl="<br><span style=\"color:RED\">* - This product qualifies for free shipping</span>";
		}

		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr valign=\"top\" bgcolor=\"#f3fbfe\"><input type=\"hidden\" name=\"qty[]\" value=\"".$qty."\">\n");
		print("<td align=\"center\"><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td><a class=\"product_title1\" href=\"#\" onClick=\"javascript: decision('Are you sure you want to remove this item from your shopping bag?', 'https://www.techniart.us/psehomeprint/remove.php?ID=".$otsdetailID."');\"><span class=\"product_title\">REMOVE?</span></a></td>\n");
		print("<td><span class=\"product_title1\">".$productDesc."".$lbl."</span></td>\n");
		print("<td align=\"center\"><span class=\"product_title1\">".$case_quantity."</span></td>\n");
		print("<td align=\"center\"><span class=\"product_title1\">".$prod_tot."</span></td>\n");
		print("<td align=\"center\"><span class=\"product_title1\">$".$tot."</span></td>\n");
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
	if($shiptot>0){
		print("<tr>\n");
		print("<td colspan=\"5\" align=\"right\"><span class=\"body_content_style1\"><b>Shipping:</b></span></td>");
		print("<td>");
		print("<span class=\"body_content_style1\">$".$shiptot."</span></td>\n");
		print("</tr>");
	}
	print("<tr>\n");
	print("<td colspan=\"5\" align=\"right\"></td>\n");
	$totformat=number_format($carttot+$ship+$taxamt, 2, '.', ',');
	print("<td align=\"left\"></td>\n");
	print("</tr></form>\n");
	#print("<tr>\n");
	#print("<td colspan=\"5\" align=\"right\"><input type=\"image\" src=\"pix/pix/b_recalculate.gif\" name=\"submit\" alt=\"Recalculate Totals\" border=\"0\" value=\"Recalculate Totals\"></form></td>\n");
	#print("</tr>\n");

	
?>
<div align="left"><span class="body_content_style1">    ALL FIELDS MUST BE FILLED OUT<br>
</span></div>
<br>




<table width="830" align="center" cellpadding="1" cellspacing="1">
  <tr valign="top">
<td width="389" height="291" align="left">
<table width="386" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
<td width="92"><span class="section_heading_style2">Shipping Address:</span> </td>
<td width="294"><form action="ship.php" name="ship_form" id="ship_form" method="post"><select name="name" required class="forms3">
        <option></option>
<?php
$fetch_organization_name = db_query("SELECT DISTINCT name FROM tblShipping where access_company='$access_company' ORDER BY name ASC");
while($throw_organization_name = mysql_fetch_array($fetch_organization_name)) {
echo '<option value="'.$throw_organization_name[0].'">'.$throw_organization_name[0].'</option>';
}
?></select>&nbsp;&nbsp;<input type="button" class="btn2" value="Update" onClick="this.form.submit()"/><input name="company" value="<? echo($access_company);?>" hidden></form></td>
  </tr>
  <tr valign="top">
<td colspan="2"></td>
</tr>
  <tr valign="top">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr valign="top"><form name="form1" id="form1" method="post" action="confirm_pre.php" onSubmit="return fVerifyResForm();"><input type="hidden" name="otsID" value="<? echo($o);?>">
<input type=hidden name=paymentType value="<?=$paymentType?>" />
<input type="hidden" name="ship" value="<?=$ship?>" />
<td width="151"><span class="body_content_style1">Saved Name:</span></td>
<td width="162"><input required type="text" size="25" maxlength="100" name="name" value="<? echo($name);?>" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
<td><span class="body_content_style1">First Name:</span></td>
<td><input required type="text" size="25" maxlength="100" name="ship_fname" value="<? echo($ship_fname);?>" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
<tr valign="top">
<td><span class="body_content_style1">Last Name:</span></td>
<td><input required type="text" size="25" maxlength="100" name="ship_lname" value="<? echo($ship_lname);?>" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Address 1:</span></td>
<td><input required type="text" size="25" maxlength="100" name="ship_address1" value="<? echo($ship_address1);?>" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Address 2:<br>(optional)</span></td>
<td><input type="text" size="25" maxlength="100" name="ship_address2" value="<? echo($ship_address2);?>"class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">City:</span></td>
<td><input required type="text" size="25" maxlength="40" name="ship_city" value="<? echo($ship_city);?>" class="forms3" /></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">State:</span></td>
<td><span class="body_content_style1">WA</span><input type="hidden" name="ship_state" value="WA"></td>
</tr><tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
  <td><span class="body_content_style1">ZIP Code:</span></td>
  <td><span class="body_content_style1"><input required type="text" size="10" maxlength="10" name="ship_zip" value="<? echo($ship_zip);?>" class="forms2" />
    (5 digit ZIP)</span></td>
</tr>
<tr valign="top">
<td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Special Instructions:</span></td>
<td><textarea name="instr" id="instr" rows="5" cols="30" class="forms3" /></textarea></td>
</tr>
<tr valign="top">
  <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
</tr>
</table>
<input type=hidden name="access_company" value="<? echo($access_company); ?>" />
<input type=hidden name="address1" value="<? echo($company_address); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="city" value="<? echo($company_city); ?>" />
<input type=hidden name="state" value="<? echo($company_state); ?>" />
<input type=hidden name="zip" value="<? echo($company_zip); ?>" />

<input type=hidden name="admin_name" value="<? echo($admin_name); ?>">
<input type=hidden name="admin_phone" value="<? echo($admin_phone); ?>">
<input type=hidden name="admin_email" value="<? echo($admin_email); ?>"> 

</td>
<!-- <td width="10">&nbsp;</span></td> -->
<td width="432" align="left"><table width="313" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td colspan="2"><span class="section_heading_style2">Billing Address:</span></td>
  </tr>
  <tr valign="top">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td width="151"><span class="body_content_style1">Company Name:</span></td>
    <td width="162"><span class="body_content_style1"><? echo($access_company);?></td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">Admin Name:</span></td>
    <td><span class="body_content_style1"><? echo($admin_name);?></td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">Address 1:</span></td>
    <td><span class="body_content_style1"><? echo($company_address);?></td>
  </tr>

  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">City:</span></td>
    <td><span class="body_content_style1"><? echo($company_city);?></td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">State:</span></td>
    <td><span class="body_content_style1">WA</span>
      </td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">ZIP Code:</span></td>
    <td><span class="body_content_style1">
      <? echo($company_zip);?></span></td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">Email:</span></td>
    <td><span class="body_content_style1"><? echo($admin_email);?></td>
  </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/pix_trans.gif" width="1" height="5"></td>
  </tr>
  <tr valign="top">
    <td><span class="body_content_style1">Phone:</span></td>
    <td><span class="body_content_style1"><? echo($admin_phone);?></td>
  </tr>
  <tr valign="top">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td colspan="2">&nbsp;</td>
  </tr>
</table></td>
</tr>
  <tr valign="top">
    <td align="left">&nbsp;</td>
    <td align="left"><table border="0" cellspacing="0" cellpadding="0">
      <!--<tr valign="top">
<td><span class="body_content_style1">Amount:</span></td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</span></td>
</tr>-->
      <tr valign="top">
        <td width="10" class="field"></td>
        <td width="142"><img src="pix/pix_trans.gif" width="1" height="10"><br>
          <input type="submit" class="btn1" value="Review Order"></td>
      </tr>
    </table></td>
    </tr>
  <tr valign="top">
<td class="body_content_style1" colspan="3" align="left">
<img src="pix/pix_trans.gif" width="1" height="10"><br></td>
</tr></table>
</form>
</td>
</tr></table>
<?}?>
</p><br>


</td>
<td></td>
</tr></table>

</td>
</tr></table>

<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?></div></div></div>
<!-- ------------------------------end footer------------------------------ -->

</body>
</html>


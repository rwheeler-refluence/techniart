<? include("database.php"); ?>
<? include("header.php");?>

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

		if (oForm.pickup.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your company.\n";
			}
		if (oForm.location.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your floor.\n";
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
		$sqlc="select * from tblorderstosend_foe where sess='$sess' && status='open'";
		$resultc=db_query($sqlc);
		$countc=mysql_num_rows($resultc);
		if(!$countc){
			$sql="insert into tblorderstosend_foe values ('','$sess','','','$stamp','open')";
			$result=db_query($sql);
			$next=mysql_insert_id();
		}else{
			while($rowc=mysql_fetch_array($resultc)){
				$next=$rowc['otsID'];
			}
		}
		$_SESSION['otsID']=$next;
		#add item to cart
		$sqli="select * from tblotsdetail_foe where itemNo='$itemNo' && otsID='$next'";
		#print("".$sqli."<br />");
		$resulti=db_query($sqli);
		$counti=mysql_num_rows($resulti);
		if(!$counti){
			$sql2="insert into tblotsdetail_foe values ('','$next','$itemNo','$quantity','$price','$desc')";
		}else{
			while($rowi=mysql_fetch_array($resulti)){
				$otsdetailID=$rowi['otsdetailID'];
				$qty=$rowi['qty'];
				$newqty=$qty+1;
			}
			$sql2="update tblotsdetail_foe set qty='$newqty' where otsdetailID='$otsdetailID'";
		}
#		print($sql2);
		$result2=db_query($sql2);
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			$sql="update tblotsdetail_foe set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
#print("".$sql."<br />");			
			$result=db_query($sql);
		}
	break;
}
?>

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
$sql="select * from tblotsdetail_foe where otsID='$o'";
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
	print("<table width=\"850\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td align=\"center\"><span class=\"section_heading_style1\"><b>Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
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
		$sqlfreeship="select modelNumber from tblProducts_foe where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$modelNumber=$rowfreeship['modelNumber'];}

		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr valign=\"middle\" bgcolor=\"#ffffff\"><input type=\"hidden\" name=\"qty[]\" value=\"".$qty."\">\n");
		print("<td valign=\"middle\" align=\"center\"><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td align=\"center\"><input type=\"button\" value=\"Go Back\" onClick=\"location.href='cart.php'\" class=\"btn2\"><br /><img src=\"pix/pix_trans.gif\" height=\"1\"><br /><input type=\"button\" class=\"btn2\" value=\"Remove\" onClick=\"location.href='remove.php?ID=".$otsdetailID."'\"></td>\n");
		print("<td align=\"center\"><img src=\"pix/products/thumbnails/".$modelNumber.".jpg\" width=\"50\"></td>\n");
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
	print("<td colspan=\"5\" align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:</b>&nbsp;</span></td>\n");
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
<?
	$product1 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='1' ");
if (mysql_num_rows($product1)) {
    $P1 = mysql_fetch_assoc($product1);
    $PQ1=$P1['qty']*1;}
$product2 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='2' ");
if (mysql_num_rows($product2)) {
    $P2 = mysql_fetch_assoc($product2);
    $PQ2=$P2['qty']*4;}
$product3 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='3' ");
if (mysql_num_rows($product3)) {
    $P3 = mysql_fetch_assoc($product3);
    $PQ3=$P3['qty']*1;}
	$product4 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='4' ");
	if (mysql_num_rows($product4)) {
    $P4 = mysql_fetch_assoc($product4);
    $PQ4=$P4['qty']*6;}
	$product5 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='5' ");
if (mysql_num_rows($product5)) {
    $P7 = mysql_fetch_assoc($product5);
    $PQ5=$P5['qty']*6;}
	$product6 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='6' ");
	if (mysql_num_rows($product6)) {
    $P6 = mysql_fetch_assoc($product6);
    $PQ6=$P6['qty']*1;}
	$product7 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='7' ");
	if (mysql_num_rows($product7)) {
    $P7 = mysql_fetch_assoc($product7);
    $PQ7=$P7['qty']*6;}
	$product8 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='8' ");
	if (mysql_num_rows($product8)) {
    $P8 = mysql_fetch_assoc($product8);
    $PQ8=$P8['qty']*1;}
	$product9 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='9' ");
	if (mysql_num_rows($product9)) {
    $P9 = mysql_fetch_assoc($product9);
    $PQ9=$P9['qty']*1;}
	$product10 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='10' ");
	if (mysql_num_rows($product10)) {
    $P10 = mysql_fetch_assoc($product10);
    $PQ10=$P10['qty']*1;}
	$bulblimit=$PQ1+$PQ2+$PQ3+$PQ4+$PQ5+$PQ6+$PQ7+$PQ8+$PQ9+$PQ10;
	$product13 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='13' ");
	if (mysql_num_rows($product13)) {
    $P13 = mysql_fetch_assoc($product13);
    $PQ13=$P13['qty']*1;}
	$product14 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='14' ");
	if (mysql_num_rows($product14)) {
    $P14 = mysql_fetch_assoc($product14);
    $PQ14=$P14['qty']*1;}
	$product15 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='15' ");
	if (mysql_num_rows($product15)) {
    $P15 = mysql_fetch_assoc($product15);
    $PQ15=$P15['qty']*1;}


	$APSlimit=$PQ13+$PQ14+$PQ15;
		$product242 = mysql_query("SELECT qty FROM tblotsdetail_foe WHERE otsID = '$o' && itemNo='242' ");
if (mysql_num_rows($product242)) {
    $P242 = mysql_fetch_assoc($product242);
    $lamplimit=$P242['qty']*1;}
if ($bulblimit>12){echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You have exceeded the limit of bulbs allowed.')
		window.location.href='cart.php'
        </SCRIPT>";}
if ($APSlimit>5){echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You have exceeded the limit of APS allowed.')
		window.location.href='cart.php'
        </SCRIPT>";}
if ($lamplimit>4){echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You have exceeded the limit of combos allowed.')
		window.location.href='cart.php'
        </SCRIPT>";}
?>


        <a class="accordion-section-title" href="#accordion-1">Billing Information - Click to slide open</a>

        <table width="650"  align="left" border="0" cellpadding="0" cellspacing="0">
          
           <tr valign="top">
            <td width="184" align="left"><span class="product_title_sm">* REQUIRED FIELDS</span></td>
            <td width="368" align="left"></td>
          </tr>
           <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
           <tr valign="top">
            <td width="184" align="left"><span class="product_title_sm">First Name: *</span></td>
            <td width="368" align="left"><input required type="text" size="25" maxlength="100" name="fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">Last Name: *</span></td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">Address Line 1: *</span></td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="address1" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">Address Line 2:<br>
              (optional)</span></td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="address2" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" class="product_title_sm">City: *</td>
    <td align="left"><input required type="text" name="city" id="city" class="forms10" />
</td>
          </tr>
         
                  <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left"><span class="product_title_sm">State: *</span></td>
            <td align="left"><select required name="state" class="forms9">
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
            <td align="left"><span class="product_title_sm">ZIP Code: *</span></td>
            <td align="left"><span class="product_title_sm">
              <input required type="text" size="5" maxlength="5" name="zip" value="" class="forms9" />
              (5  digit)</span>


</td>
          </tr>
       <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
            <tr valign="top">
            <td align="left"><span class="product_title_sm">Email: *</span></td>
            <td align="left"><input required required type="text" size="25" maxlength="100" name="email" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td width="237" align="left"><span class="product_title_sm">Phone: *</span></td>
            <td width="352" align="left"><input required required type="text" size="25" maxlength="100" name="phone" value="" class="forms10" /></td>
          </tr>        <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
             <tr valign="top">
            <td width="237" align="left"><span class="product_title_sm">Employee Number: *</span></td>
            <td width="352" align="left"><input required required type="text" size="25" maxlength="100" name="pickup" value="" class="forms10" /></td>
          </tr> 
                 <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" alt="" width="1" height="5"></td>
          </tr>

        </table></div></div></div>
        <br>
        
 
        <a class="accordion-section-title" href="#accordion-3">Payment Information - Click to slide open</a>
         
        
        <table width="650" align="left" border="0" cellspacing="0" cellpadding="0">
          <!--<tr valign="top">
<td><span class="product_title_sm">Amount:</span></td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</span></td>
</tr>-->
          <tr valign="top">
            <td width="400" align="left" valign="middle"><span class="product_title_sm">Name: (as it appears on credit card) *&nbsp;</span></td>
            <td width="265" align="left"><input required type="text" size="30" maxlength="32" name="firstName" id="firstName" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <!--<td><span class="product_title_sm">Last Name:</span></td>
<td><input type="text" size="30" maxlength="32" name="lastName" value="Doe" /></span></td>
</tr><tr valign="top">-->
            <td align="left" valign="middle"><span class="product_title_sm">Card Type: *</span></td>
            <td align="left"><input required type="radio" id="creditCardType" name="creditCardType" value="Visa">
              <img src="pix/Visa.gif">&nbsp;&nbsp;
              <input type="radio" id="creditCardType" name="creditCardType" value="MasterCard">
              <img src="pix/Master_Card.gif">&nbsp;&nbsp;
              <input type="radio" id="creditCardType" name="creditCardType" value="Discover">
              <img src="pix/Discover.gif">&nbsp;&nbsp;</td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="product_title_sm">Card Number: *</span></td>
            <td align="left"><input required type="text" size="19" maxlength="19" id="creditCardNumber" name="creditCardNumber" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="product_title_sm">Expiration Date: *</span></td>
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
              <select required name="expDateYear" id="expDateYear" class="forms11">
                <option value=""></option>
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
                <option value="2029">2029</option>
                <option value="2030">2030</option>
              </select></td>
          </tr>
          <tr valign="top">
            <td colspan="2" align="left"><img src="pix/pix_trans.gif" width="1" height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left" valign="middle"><span class="product_title_sm">Card Verification Number: *</span></td>
            <td align="left"><input required type="text" size="3" maxlength="4" name="cvv2Number" id="cvv2Number" class="forms9" /></td>
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


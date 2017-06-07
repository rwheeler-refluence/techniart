<? include("header.php"); ?>
<?
session_start();

$ship_format=$ship;
$otsID=$_POST['otsID'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$fname=$_POST['firstName'];
$lname=$_POST['lastName'];
$ship_fname=$_POST['ship_fname'];
$ship_lname=$_POST['ship_lname'];
$ship_address1=$_POST['ship_address1'];
$ship_address2=$_POST['ship_address2'];
$ship_city=$_POST['ship_city'];
$ship_state=$_POST['ship_state'];
$ship_zip=$_POST['ship_zip'];
$bill_country=$_POST['country'];
$pickup=$_POST['pickup'];
$amount=$_POST['amount'];
$location=$_POST['location'];
$name=$_POST['firstName'];
$email=$_POST['email'];
$nmsplit=explode(" ",$name);
$firstName=$_POST['firstName'];
$ship_option=$_SESSION["shipping"]["option"];
$lastName=$_POST['lastName'];
$creditCardType=$_POST['creditCardType'];
$creditCardNumber=$_POST['creditCardNumber'];
$company=("NJ BMS");
$len=strlen($creditCardNumber);
$minus=$len-4;
$obscure=substr($creditCardNumber,$minus,$len);
if($creditCartType=='Amex'){
	$cardnumobscure="XXXX-XXXX-XXX-".$obscure;
}else{
	$cardnumobscure="XXXX-XXXX-XXXX-".$obscure;
}

$expDateMonth=$_POST['expDateMonth'];
$expDateYear=$_POST['expDateYear'];
$cvv2Number=$_POST['cvv2Number'];
$instr=$_POST['instr'];
?>

<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">

<p class="body_content_style1">
<?
print("<div style=\"padding-left:55px;\"><p class=\"body_content_style1\">");
$o=$_SESSION['otsID'];
if(!$o){
	$o=$_POST['otsID'];
}
$sql="select * from tblotsdetail where otsID='$o' ORDER BY ItemNo + 0 ASC";
$result=db_query($sql);
$count=mysql_num_rows($result);
if(!$count){
	print("<b>Your cart is empty</b><br />\n");
}else{
	print("<b>Your cart contains the following:</b></p></div><br />\n");
	print("<table width=\"830\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td align=\"center\"><span class=\"section_heading_style1\"><b>Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Item</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Price</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Total</b></span></td>\n");
	print("</tr>\n");
	while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
		$tot1=number_format($qty*$price, 2, '.', ',');
		$tot=$qty*$price;
		$carttot+=$tot;
		$itemNo=$row['itemNo'];
		$productDesc=$row['productDesc'];
		
		$lbl="";
		#check for free shipping
		$free_ship="";
		$lbl="";
		$sqlfreeship="select modelNumber from tblProducts where productID='$itemNo'";
		$resultfreeship=db_query($sqlfreeship);
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$modelNumber=$rowfreeship['modelNumber'];}
		if($free_ship=='Yes'){
			$lbl="<br><span style=\"color:RED\"></span>";
		}

		#check for discounts based on zip if they haven't already entered it.
		if(!$_SESSION['zip']){
			$zz=$_POST['ship_zip'];
			$sqlz="select * from tblDiscounts LEFT OUTER JOIN tblProducts on tblDiscounts.item_no=tblProducts.modelNumber where tblProducts.productID='$itemNo' && zip='$zz'";
			#print($sqlz);
			$resultz=db_query($sqlz);
			$countz=mysql_num_rows($resultz);
			if($countz>0){
				while($rowz=mysql_fetch_array($resultz)){
					$disct_price=$rowz['disct_price'];
					$sqlu="update tblotsdetail set price='$disct_price' where otsdetailID='$otsdetailID'";
					#print($sqlu);
					$resultu=db_query($sqlu);
					$lbl.="<br><span style=\"color:RED\">* - Note: Based on your zip code you are eligible for discounted pricing on this item.  The reduced price has automatically been applied to your order.</span>\n";
				}
			}
		}
		#end discount check
	
		print("<tr valign=\"top\" bgcolor=\"#ffffff\">\n");
		print("<td valign=\"middle\" align=\"center\"><span class=\"body_content_style1\">".$qty."</span></td>\n");
		print("<td valign=\"middle\" align=\"center\"><input type=\"button\" class=\"btn2\" value=\"Remove\" onClick=\"location.href='remove.php?ID=".$otsdetailID."'\"></td>\n");
		print("<td align=\"center\"><img src=\"pix/products/thumbnails/".$modelNumber.".jpg\" width=\"50\"></td>\n");
		print("<td><span class=\"body_content_style1\">".$productDesc."".$lbl."</span></td>\n");
		print("<td><span class=\"body_content_style1\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td><span class=\"body_content_style1\">$".number_format($tot, 2, '.', ',')."</span></td>\n");
		print("</tr>\n");
	}
#	print("weight: ".$weight."<br>");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"5\" align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
$rate = '0.00';
#$sqltest = "SELECT ItemNo FROM tblotsdetail WHERE otsID='$o' ORDER BY ItemNo + 0 ASC";
#$sqltest = "SELECT ItemNo FROM tblotsdetail WHERE otsID='$o' ORDER BY ItemNo ASC";
#$resulttest = mysql_query($sqltest)
#{ print $itemNoShip . '<br>'; }

	$ship=$rate;
	#print("".$rate."\n");
	$_SESSION['ship']=$rate;
	print("<input type=\"hidden\" name=\"ship\" value=\"".$rate."\">\n");

	print("</span></td>\n");
	print("</tr>\n");
#	print("".$rate."\n");
#	print("<tr bgcolor=\"#ffffff\">\n");
#	print("<td colspan=\"5\" align=\"right\">");
		if($state=='CT' || $state=='NJ' || $state=='WA' || $state=='MA' || $state=='CA'){
		$sales_tax_tot=$carttot;
		switch($state){
			case "CT":
				$taxamt=$sales_tax_tot*.0635;
			break;
			case "NJ":
				$taxamt=$sales_tax_tot*.07;
			break;
			case "WA":
				$taxamt=$sales_tax_tot*.08;
			break;
			case "MA":
				$taxamt=$sales_tax_tot*.0625;
			break;
			case "CA":
				$taxamt=$sales_tax_tot*.075;
			break;
		}
		$taxformat=number_format($taxamt, 2, '.', ',');
		print("<tr bgcolor=\"#ffffff\">\n");
		print("<td colspan=\"5\" align=\"right\"><span class=\"body_content_style1\"><b>");
		if($state=='CT' || $state=='NJ' || $state=='WA' || $state=='MA' || $state=='CA'){
			print(strtoupper($state)." ");
		}
		print("State Sales Tax:</b>&nbsp;</span></td>\n");
		print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".$taxformat."</span></td>\n");
		print("</tr>\n");}
		$finaltot=$carttot+$taxamt;
		
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"5\" align=\"right\"><span class=\"body_content_style1\"><b>Total:</b>&nbsp;</span></td>\n");
	$totformat=number_format($finaltot, 2, '.', ',');
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".$totformat."</span></td>\n");
	print("</tr>\n");
	
?>
<form action="process.php" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="ship" value="<? echo($rate);?>">
<input type=hidden name="description" value="<? echo(date("m/d/Y")); ?> order from techniart.com" />
<input type=hidden name="address1" value="<? echo($address1); ?>" />
<input type=hidden name="address2" value="<? echo($address2); ?>" />
<input type=hidden name="office_location" value="<? echo($office_location); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="phone" value="<? echo($phone); ?>" />
<input type=hidden name="country" value="<? echo($country); ?>" />
<input type=hidden name="firstName" value="<? echo($fname); ?>" />
<input type=hidden name="lastName" value="<? echo($lname); ?>" />
<input type=hidden name="creditCardType" value="<? echo($creditCardType); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="expDateMonth" value="<? echo($expDateMonth); ?>" />
<input type=hidden name="expDateYear" value="<? echo($expDateYear); ?>" />
<input type=hidden name="cvv2Number" value="<? echo($cvv2Number); ?>" />
<input type=hidden name="creditCardNumber" value="<? echo($creditCardNumber); ?>" />
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>">
<input type=hidden name="ship_country" value="<? echo($pickup); ?>">
<input type=hidden name="bill_country" value="<? echo($location); ?>">
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>">
<input type=hidden name="ship_address1" value="<? echo($ship_address1); ?>"> 
<input type=hidden name="ship_address2" value="<? echo($ship_address2); ?>">
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>">
<input type=hidden name="city" value="<? echo($city); ?>">
<input type=hidden name="tax" value="<? echo($taxformat); ?>">
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>">
<input type=hidden name="ship_option" value="<? echo($ship_option); ?>">
<input type=hidden name="ship_price" value="<? echo($_SESSION['ship']); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="instr" value="<? echo($instr); ?>">
<input type=hidden name="company" value="<? echo($company); ?>">
<!--<span class="body_content_style1"><b>Shipping Method Chosen:</b><br><? echo($_SESSION["shipping"]["option"]);?></span></td>-->
<center>
<a class="body_content_style1" href="orderform.php?ID=<? echo($otsID); ?>&state=<? echo($ship_state); ?>"><span class="body_content_style1">&lt;Go back and make changes</span></a>
<table width="600" cellpadding="1" cellspacing="1"><tr valign="top">
<td width="235" align="left">
<table><tr valign="top">
<td colspan="2"><span class="body_content_style1"><h2>Billing Address:</h2></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1"><? echo($fname); ?> <? echo($lname); ?><br><? echo($address1); ?> <? echo($address2); ?><br>
<? echo($city); ?>, <? echo($state); ?>&nbsp;<? echo($zip); ?>
<br><br>
<b>Email:</b> <? echo($email); ?>
<br>
<b>Phone:</b> <? echo($phone); ?>
<br>
<b>Pickup Location:</b> <? echo($pickup); ?>
</span></td>
</tr></table>
</span></td>
<td width="10">&nbsp;</span></td>
<td width="235" align="left">

</span></td>
</tr><tr valign="top">
<td class="body_content_style1" colspan="3" align="left">
<img src="pix/pix_trans.gif" width="1" height="10"><br>
<span class="body_content_style1"><h2>Payment Info:</h2></span>
<table>
<input type="hidden" name="amount" value="<? echo($totformat); ?>">
<!--<tr valign="top">
<td><span class="body_content_style1">Amount:</span></td>
<td><input type="text" size="4" maxlength="7" name="amount" value="1.00" /> USD	</span></td>
</tr>--><tr valign="top">
<td><span class="body_content_style1">Name: (as it appears on credit card)</span></td>
<td><span class="body_content_style1"><? echo($firstName); ?> <? echo($lastName); ?></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Type:</span></td>
<td><span class="body_content_style1"><? echo($creditCardType); ?></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Number:</span></td>
<td><span class="body_content_style1"><? echo($cardnumobscure); ?></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Expiration Date:</span></td>
<td><span class="body_content_style1"><? echo($expDateMonth); ?>/<? echo($expDateYear); ?></span></td>
</span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Card Verification Number:</span></td>
<td><span class="body_content_style1"><? echo($cvv2Number); ?></span></td>
</tr><tr valign="top">
<td><span class="body_content_style1">Special Instructions:</span></td>
<td><span class="body_content_style1"><? echo($instr); ?></span></td>
</tr><tr valign="top">
<td colspan="2" align="center"><img src="pix/pix_trans.gif" width="1" height="10"><br><div align="center"><input type="button" class="btn" value="Place Order" onClick="this.form.submit();" /></div><br><strong>Please click the process button once to avoid duplicate charges.</strong></span></td>
</tr></table>
</span></td></tr></table>
</form>
<?}?>
</p><br>


</div></td>
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="1" border="0"></td>
</tr></table>

</td>
</tr></table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->



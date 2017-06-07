<? include("database.php"); ?>
<?
$action=$_POST['action'];
#print("action: ".$action."<br>");
$s=$_GET['s'];
$z=$_GET['z'];
$c=$_GET['c'];
$opt=$_GET['opt'];
if($s){
	$_SESSION["shipping"]["state"]=$s;
}
if($z){
	$_SESSION["shipping"]["zip"]=$z;
}
if($c){
	$_SESSION["shipping"]["country"]=$c;
}
if($opt){
	$_SESSION["shipping"]["option_name"]=$opt;
}
switch($action){
	case "add":
		$quantity1="";
		$_SESSION['prn']="";
		$itemNo=$_POST['productID'];
		$quantity1="1";
		$productTitle=$_POST['productName'];
		$modelNumber=$_POST['modelNumber'];
		$desc.="".$productTitle."  ".$modelNumber."";
		$price=$_POST['price'];
		$stamp=mktime();

		#check to see if there is an existing order for this session
		$sqlc1="select * from tblorderstosend_1 where sess='$sess' && status='open'";
#print("c1: ".$sqlc1."<br>");
		$resultc1=db_query($sqlc1);
		$countc1=mysql_num_rows($resultc1);
		if($countc1<1){
			$sql="insert into tblorderstosend_1 values ('','$sess','','','$stamp','open')";
#print("c2: ".$sql."<br>");
			$result=db_query($sql);
			$next=mysql_insert_id();
			$_SESSION['otsID']=$next;
#			print("o1: ".$_SESSION['otsID']."<br>");
		}else{
			while($rowc1=mysql_fetch_array($resultc1)){
				$next=$rowc1['otsID'];
				$_SESSION['otsID']=$next;
#				print("o2: ".$_SESSION['otsID']."<br>");
			}
		}
		$sql="";
		$sqlc1="";
		$_SESSION['otsID']=$next;
#print("ots: ".$next."<br>");

		#add item to cart
		$sqli1a="select * from tblotsdetail_1 where itemNo='$itemNo' && otsID='$next'";
#print("".$sqli1a."<br />");
		$resulti1a=db_query($sqli1a);
		$counti1a_g=mysql_num_rows($resulti1a);
#print("counti1: ".$counti1a_g."<br>");
		if($counti1a_g<1){
			$sql21="insert into tblotsdetail_1 values ('','$next','$itemNo','$quantity1','$price','$desc','')";
			$result21=db_query($sql21);
#print("".$sql21."<br>");
		}else{
			while($rowi1a=mysql_fetch_array($resulti1a)){
				$otsdetailID=$rowi1a['otsdetailID'];
				$qty=$rowi1a['qty'];
				$newqty=$_POST['qty'];
				$sql21="update tblotsdetail_1 set qty='$newqty' where otsdetailID='$otsdetailID'";
				$result21=db_query($sql21);	
			}
		}
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			if($qty[$i]==0){
				$sql="delete from tblotsdetail_1 where otsdetailID='$otsdetailID[$i]'";
			}else{
				$sql="update tblotsdetail_1 set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
			}
			$result=db_query($sql);
		}
	break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
<title>TechniArt - Shopping Cart</title>
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

</head><?php include_once("analyticstracking.php") ?><? include("nav.php")?>
<BODY><center><div class="gridContainer clearfix"><div id="LayoutDiv1"><? include("header.php")?>
</div>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="main">
  <tr>
    <td>

<?
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail_1 LEFT OUTER JOIN tblProducts on tblotsdetail_1.itemNo=tblProducts.productID where tblotsdetail_1.otsID='$o'";
#print($sql);
#print($sqlo);
$result=db_query($sql);
$count=mysql_num_rows($result);
print("<div>");
if(!$count){
	print("<br><br><br><p class=\"cart-header\" style=\"padding-left:4%\"><b>Your shopping cart is empty</b></p><br><br><br><br><div id='cssmenu' style='padding-left: 22%'>
<ul>
  
   <li class='has-sub'><a href='http://www.techniart.us/dukeenergy/store-cat.php?cat=General Purpose'><span>General Purpose</span></a></li>
   <li class='last'><a href='http://www.techniart.us/dukeenergy/store-cat.php?cat=Decorative'><span>Decorative</span></a></li>
   <li class='last'><a href='http://www.techniart.us/dukeenergy/store-cat.php?cat=Reflectors'><span>Reflectors</span></a></li>
   <li class='last'><a href='http://www.techniart.us/dukeenergy/store-cat.php?cat=Fixtures'><span>Fixtures</span></a></li>
</ul>
</div><br><br><br><br><br><br><br>\n");
}else{
	print("<form method=\"post\" action=\"".$PHP_SELF."\">\n");
		print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<p class=\"cart-header\" style=\"padding-left=2%\"><b>&nbsp;&nbsp;&nbsp;Your shopping cart contains the following:</b><br /></div>\n");
	print("<table width=\"95%\" cellpadding=\"4\" cellspacing=\"2\" align=\"center\">\n");
	print("<tr valign=\"top\">\n");
	print("<td><span class=\"cart-header\"><b>Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"cart-header\"><b>Item</b></span></td>\n");
	print("<td><span class=\"cart-header\"><b>Price</b></span></td>\n");
	print("<td><span class=\"cart-header\"><b>Total</b></span></td>\n");
	print("</tr>\n");

 while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
		$weight=$row['weight'];
		$tot=number_format($qty*$price, 2, '.', ',');
		$tot1=$qty*$price;
		$carttot+=$tot1;
		$flat_ship=15.00;
		$ship_difference = $flat_ship - $carttot;
		$itemNo=$row['itemNo'];
		$productID=$row['productID'];
		$productDesc=$row['productDesc'];
		#$weight="4.0";
		$calcweight=$qty*$weight;
#		print("".$calcweight."<br>");
		$totcalcweight1+=$calcweight;
		#check for free shipping
		$sqlfreeship="select free_ship from tblProducts where productID='$productID'";
		$resultfreeship=db_query($sqlfreeship);
		$free_ship="";
		$lbl="";
		while($rowfreeship=mysql_fetch_array($resultfreeship)){
			$free_ship=$rowfreeship['free_ship'];
		}
		if($free_ship=='Yes'){
			$lbl="<br><span style=\"color:RED\"></span>";
		}
		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr>\n");
		print("<td><input type=\"text\" name=\"qty[]\" class=\"forms7\" size=\"3\" value=\"".$qty."\"></span></td>\n");
				print("<td><a class=\"cart\" href=\"#\" onClick=\"javascript: decision('Are you sure you want to remove this item from your shopping bag?', 'remove.php?ID=".$otsdetailID."');\"><span class=\"cart-header\">REMOVE?</span></a></td>\n");
		print("<td><span class=\"cart\">".$productDesc."".$lbl."</span></td>\n");
		print("<td><span class=\"cart\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td><span class=\"cart\">$".$tot."</span></td>\n");
		print("</tr>\n");
			$qty="";
}
	$totcalcweight=number_format($totcalcweight1, 1, '.', ',');

	print("</table>\n");
	print("<table width=\"95%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n");
	print("<tr valign=\"top\">\n");
if ($carttot <15){
	print("<td width=\"70%\"><span class=\"cart-header\">To qualify for <strong>$5</strong> flat rate shipping you must spend <strong>$".number_format($ship_difference, 2, '.', ',')."</strong> more.</span></td>\n");}
	#if ($carttot>=25 && $_SESSION['coupon']){
#	print("<td width=\"550\"><span class=\"style6\"><b>You have qualified for FREE shipping.<b></span></td>\n");}
	if ($carttot >=15){
	print("<td width=\"60%\"><span class=\"cart-header\"><b>You have qualified for $5 flat rate shipping.<b></span></td>\n");
	$rate=5;}
	print("<td width=\"60%\"></td>\n");
	print("<td align=\"right\"></b></span></td>\n");
	$totformat=number_format($carttot, 2, '.', ',');
	print("<td align=\"right\"><span class=\"cart-header\"><b>Subtotal:&nbsp;&nbsp;<span class=\"cart-header1\">$".$totformat."</span>&nbsp;&nbsp;&nbsp;</td>\n");
	print("</tr>\n");
	if ($carttot >=15){
	print("<td width=\"60%\"><span class=\"cart-header\"></span></td>\n");
	print("<td width=\"60%\"></td>\n");
	print("<td align=\"right\"></b></span></td>\n");
	$rateformat=number_format($rate, 2, '.', ',');
	print("<td align=\"right\"><span class=\"cart-header\"><b>Shipping:&nbsp;&nbsp;<span class=\"cart-header1\">$".$rateformat."</span>&nbsp;&nbsp;&nbsp;</td>\n");
	print("</tr>\n");}
	
	print("<tr>\n");
	print("<td width=\"60%\"></td>\n");
	print("<td align=\"right\"></b></span></td>\n");
	print("<td align=\"right\"></b></span></td>\n");
	$finaltot=number_format($carttot+$rate, 2, '.', ',');
	print("<td align=\"right\"><span class=\"cart-header\"><b>Total:&nbsp;&nbsp;<span class=\"cart-header1\">$".$finaltot."</span>&nbsp;&nbsp;&nbsp;</td>\n");
	print("</tr>\n");
#5/21
		#shipping actuals
		$sqlship="select * from tblProducts where productID='$itemNo'";
	//	print("".$sqlship."<br>");
		$resultship=db_query($sqlship);
		while($rowship=mysql_fetch_array($resultship)){
			$weight = $rowship['weight'];
			#$width = $rowship['width'];
			#$height = $rowship['height'];
			#$length = $rowship['length'];
			$productID=$rowship['productID'];
			$height="10";
			$width="6";
			$length="6";
			#$weight="4.00";
	
			$cart_product = array('productID'=>$productID,'length'=>$length,'width'=>$width,'height'=>$height,'weight'=>$weight);
			for($aaa=0;$aaa<$qty;$aaa++)
			{
				$shipping_products [] = $cart_product;
				
			}
		}
#	print("<tr>\n");
#	print("<tr>\n");
#	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Totals:</b>&nbsp;</span></td>\n");
#	$totfin=$carttot+$ship;
#	$totfinformat=number_format($totfin, 2, '.', ',');
#	$totformat=number_format($carttot, 2, '.', ',');
#	print("<td align=\"right\"><span class=\"body_content_style1\">$".$totfinformat."</span>&nbsp;&nbsp;&nbsp;</td>\n");
#	print("</tr>\n");

	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn1\" value=\"Recalculate Totals\" onClick=\"this.form.submit();\"></td>\n");
	print("</tr></form>\n");
	print("<tr><td colspan=\"4\" height=\"5\" align=\"right\"></td></tr>\n");
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn1\" value=\"Empty Cart\" onclick=\"location.href='empty.php?otsID=".$o."'\"></td>\n");
	print("</tr>\n");
	print("<tr><td colspan=\"4\" height=\"5\" align=\"right\"></td></tr>\n");
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn1\" value=\"Continue Shopping\" onclick=\"location.href='http://www.techniart.us/dukeenergy/store.php'\"></td>\n");
	print("</tr>\n");
	print("<tr><td colspan=\"4\" height=\"5\" align=\"right\"></td></tr>\n");
print("<tr>\n");
$product2 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='2' ");
if (mysql_num_rows($product2)) {
    $P2 = mysql_fetch_assoc($product2);
    $PQ2=$P2['qty']*1;}
$product3 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='3' ");
if (mysql_num_rows($product3)) {
    $P3 = mysql_fetch_assoc($product3);
    $PQ3=$P3['qty']*1;}
$product4 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='4' ");
if (mysql_num_rows($product4)) {
    $P4 = mysql_fetch_assoc($product4);
    $PQ4=$P4['qty']*1;}
$product5 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='5' ");
if (mysql_num_rows($product5)) {
    $P5 = mysql_fetch_assoc($product5);
    $PQ5=$P5['qty']*6;}
$product6 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='6' ");
if (mysql_num_rows($product6)) {
    $P6 = mysql_fetch_assoc($product6);
    $PQ6=$P6['qty']*6;}
$product7 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='7' ");
if (mysql_num_rows($product7)) {
    $P7 = mysql_fetch_assoc($product7);
    $PQ7=$P7['qty']*1;}
$product8 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='8' ");
if (mysql_num_rows($product8)) {
    $P8 = mysql_fetch_assoc($product8);
    $PQ8=$P8['qty']*1;}
$product9 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='9' ");
if (mysql_num_rows($product9)) {
    $P9 = mysql_fetch_assoc($product9);
    $PQ9=$P9['qty']*1;}
$product10 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='10' ");
if (mysql_num_rows($product10)) {
    $P10 = mysql_fetch_assoc($product10);
    $PQ10=$P10['qty']*1;}
$product11 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='11' ");
if (mysql_num_rows($product11)) {
    $P11 = mysql_fetch_assoc($product11);
    $PQ11=$P11['qty']*1;}
$product12 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='12' ");
if (mysql_num_rows($product12)) {
    $P12 = mysql_fetch_assoc($product12);
    $PQ12=$P12['qty']*1;}	
$product13 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='13' ");
if (mysql_num_rows($product13)) {
    $P13 = mysql_fetch_assoc($product13);
    $PQ13=$P13['qty']*6;}
$product14 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='14' ");
if (mysql_num_rows($product14)) {
    $P14 = mysql_fetch_assoc($product14);
    $PQ14=$P14['qty']*6;}
$product15 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='15' ");
if (mysql_num_rows($product15)) {
    $P15 = mysql_fetch_assoc($product15);
    $PQ15=$P15['qty']*6;}
$product16 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='16' ");
if (mysql_num_rows($product16)) {
    $P16 = mysql_fetch_assoc($product16);
    $PQ16=$P16['qty']*6;}
$product17 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='17' ");
if (mysql_num_rows($product17)) {
    $P17 = mysql_fetch_assoc($product17);
    $PQ17=$P17['qty']*6;}
$product18 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='18' ");
if (mysql_num_rows($product18)) {
    $P18 = mysql_fetch_assoc($product18);
    $PQ18=$P18['qty']*6;}
$product19 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='19' ");
if (mysql_num_rows($product19)) {
    $P19 = mysql_fetch_assoc($product19);
    $PQ19=$P19['qty']*1;}
$product20 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='20' ");
if (mysql_num_rows($product20)) {
    $P20 = mysql_fetch_assoc($product20);
    $PQ20=$P20['qty']*1;}			
$product21 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='21' ");
if (mysql_num_rows($product21)) {
    $P21 = mysql_fetch_assoc($product21);
    $PQ21=$P21['qty']*1;}
	$product22 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='22' ");
if (mysql_num_rows($product22)) {
    $P22 = mysql_fetch_assoc($product22);
    $PQ22=$P22['qty']*1;}
	$product23 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='23' ");
if (mysql_num_rows($product23)) {
    $P23 = mysql_fetch_assoc($product23);
    $PQ23=$P23['qty']*1;}
	$product24 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='24' ");
if (mysql_num_rows($product24)) {
    $P24 = mysql_fetch_assoc($product24);
    $PQ24=$P24['qty']*1;}
	$product25 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='25' ");
if (mysql_num_rows($product25)) {
    $P25 = mysql_fetch_assoc($product25);
    $PQ25=$P25['qty']*1;}
	
	$product26 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='26' ");
if (mysql_num_rows($product26)) {
    $P26 = mysql_fetch_assoc($product26);
    $PQ26=$P26['qty']*1;}
	$product27 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='27' ");
if (mysql_num_rows($product27)) {
    $P27 = mysql_fetch_assoc($product27);
    $PQ27=$P27['qty']*1;}
	$product28 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='28' ");
if (mysql_num_rows($product28)) {
    $P28 = mysql_fetch_assoc($product28);
    $PQ28=$P28['qty']*1;}
	$product29 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='29' ");
if (mysql_num_rows($product29)) {
    $P29 = mysql_fetch_assoc($product29);
    $PQ29=$P29['qty']*6;}
	$product30 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='30' ");
if (mysql_num_rows($product30)) {
    $P30 = mysql_fetch_assoc($product30);
    $PQ30=$P30['qty']*6;}
		$product31 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='31' ");
if (mysql_num_rows($product31)) {
    $P31 = mysql_fetch_assoc($product31);
    $PQ31=$P31['qty']*6;}
		$product32 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='32' ");
if (mysql_num_rows($product32)) {
    $P32 = mysql_fetch_assoc($product32);
    $PQ32=$P32['qty']*1;}
		$product33 = mysql_query("SELECT qty FROM tblotsdetail_1 WHERE otsID = '$o' && itemNo='33' ");
if (mysql_num_rows($product33)) {
    $P33 = mysql_fetch_assoc($product33);
    $PQ33=$P33['qty']*1;}
$limit=$PQ2+$PQ3+$PQ4+$PQ5+$PQ6+$PQ7+$PQ8+$PQ9+$PQ10+$PQ11+$PQ12+$PQ13+$PQ14+$PQ15+$PQ16+$PQ17+$PQ18+$PQ19+$PQ20+$PQ21+$PQ22+$PQ23+$PQ24+$PQ25+$PQ26+$PQ27+$PQ28+$PQ29+$PQ30+$PQ31+$PQ32+$PQ33;
	if($limit > '15'){
	print("<td colspan=\"4\" align=\"right\" class=\"cart\">In order to checkout, please adjust your cart to <b>15 total products</b>.</td>\n");	
	print("</tr>\n");
	print("<tr>\n");
	print("</table>\n");
	}else{
	
	print("<td colspan=\"4\" align=\"right\"><form method=\"post\" action=\"https://www.techniart.us/dukeenergy/orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"hidden\" name=\"ship\" value=\"".$ship."\"><input type=\"hidden\" name=\"state\" value=\"".$_SESSION["shipping"]["state"]."\"><input type=\"submit\" class=\"btn1\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("</table>\n");}

$zero=0;
$coupbalance=number_format($discount-$carttot-$rate, 2, '.', ',');
if($coupbalance<0){$coupbalance=number_format($zero, 2, '.', ',');}

	print("<div class=\"cart-header\"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your cart contains <b>".$limit."</b> of the <b>15</b> products allowed per order.<br><br>");
	

}?>
</div></td>
<td></td>
</tr></table>

</div></td>
</tr></table>


<!-- ------------------------------end body------------------------------ -->
<? #echo($_SESSION['rep']);?>
<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
</html>


<? include("database.php"); ?>
<? $discount=$_SESSION['discount']?>
<?
$rate=7;
session_start();
#print($sess);#session_destroy();
#ini_set('display_errors','On');
#include("ups/utils.php");
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
		$sqlc1="select * from tblorderstosend where sess='$sess' && status='open'";
#print("c1: ".$sqlc1."<br>");
		$resultc1=db_query($sqlc1);
		$countc1=mysql_num_rows($resultc1);
		if($countc1<1){
			$sql="insert into tblorderstosend values ('','$sess','','','$stamp','open')";
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
		$sqli1a="select * from tblotsdetail where itemNo='$itemNo' && otsID='$next'";
#print("".$sqli1a."<br />");
		$resulti1a=db_query($sqli1a);
		$counti1a_g=mysql_num_rows($resulti1a);
#print("counti1: ".$counti1a_g."<br>");
		if($counti1a_g<1){
			$sql21="insert into tblotsdetail values ('','$next','$itemNo','$quantity1','$price','$desc','')";
			$result21=db_query($sql21);
#print("".$sql21."<br>");
		}else{
			while($rowi1a=mysql_fetch_array($resulti1a)){
				$otsdetailID=$rowi1a['otsdetailID'];
				$qty=$rowi1a['qty'];
				$newqty=$_POST['qty'];
				$sql21="update tblotsdetail set qty='$newqty' where otsdetailID='$otsdetailID'";
				$result21=db_query($sql21);	
			}
		}
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			if($qty[$i]==0){
				$sql="delete from tblotsdetail where otsdetailID='$otsdetailID[$i]'";
			}else{
				$sql="update tblotsdetail set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
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
<title>TechniArt - Shopping Cart</title>

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
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<BODY><?php include("analyticstracking.php") ?>

<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Shopping Cart</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? if($_SESSION['coupon']){?><span class="style4"><strong>Get FREE shipping</strong> on all orders over $25!</span><? }else{ ?><span class="style4"><strong>Get $7 flat rate shipping</strong> on all orders over $25!</span></div><?}?>
</td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" bgcolor="#d9d3a4"></td>
<td width="904"><div id="main_content_ip" align="left">

<?
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail LEFT OUTER JOIN tblProducts on tblotsdetail.itemNo=tblProducts.productID where tblotsdetail.otsID='$o'";
$sqlo="select sum(qty) as TotalQuantity from tblotsdetail where tblotsdetail.otsID='$o'";
#print($sql);
#print($sqlo);
$result=db_query($sql);
$resulto=db_query($sqlo);
$count=mysql_num_rows($result);
while($row=mysql_fetch_array($resulto)){
		$limit=$row['TotalQuantity'];
	}
print("<div>");
if(!$count){
	print("<br><br><br><p class=\"product_title\"><b>Your shopping cart is empty</b></p><br><br><br><br><br><br><br><br><br><br><br><br>\n");
}else{
	print("<form method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p class=\"product_title\">");
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<b>Your shopping cart contains the following:</b><br /></div>\n");
	print("<table width=\"830\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td><span class=\"product_title\"><b>Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"product_title\"><b>Item</b></span></td>\n");
	print("<td><span class=\"product_title\"><b>Price</b></span></td>\n");
	print("<td><span class=\"product_title\"><b>Total</b></span></td>\n");
	print("</tr>\n");

 while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
	/*	if(strlen($_SESSION['zip_qualify'])>0){
			$pr=$row['disct_price'];
			if($pr!==$price){
			$sqlu="update tblotsdetail set price='$pr' where otsdetailID='$otsdetailID'";
			$resultu=db_query($sqlu);
		#		print("<script language=\"javascript\">document.location.href='cart.php'</script>");
			}
		}else{
			$pr=$row['MSRP'];
			if($pr!==$price){
				$sqlu="update tblotsdetail set price='$pr' where otsdetailID='$otsdetailID'";
				$resultu=db_query($sqlu);
			#	print("<script language=\"javascript\">document.location.href='cart.php'</script>");
			}
		}*/

		if(strlen($_SESSION['zip_qualify'])>0){
			if($_SESSION['st']=='alt'){
				$sqlprice="select * from tblProductDiscounts where itemNo='$modelNumber' && zip='$_SESSION[zip]'";
			#	print($sqlprice);
				$resultprice=db_query($sqlprice);
				$countprice=mysql_num_rows($resultprice);
				if($countprice<1){
					$pr=number_format($rowp['MSRP'], 2, '.', ',');
				}else{
					while($rowprice=mysql_fetch_array($resultprice)){
						$pr=number_format($rowprice['disct_price'], 2, '.', ',');
					}
				}
			}else{
				if($_SESSION['st']=='NJ'){
					$pr=number_format($rowp['disct_price_nj'], 2, '.', ',');
				}else{
					if($_SESSION['clp']=='yes'){
						$pr=number_format($rowp['disct_price'], 2, '.', ',');
					}else{
						$pr=number_format($rowp['MSRP'], 2, '.', ',');
					}
				}
			}
		}else{
			$pr=number_format($rowp['MSRP'], 2, '.', ',');
		}
			if($pr!==$price){
				$sqlu="update tblotsdetail set price='$pr' where otsdetailID='$otsdetailID'";
		#		$resultu=db_query($sqlu);
			}


		$weight=$row['weight'];
		$tot=number_format($qty*$price, 2, '.', ',');
		$tot1=$qty*$price;
		$carttot+=$tot1;
		$flat_ship=25.00;
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
		print("<tr valign=\"top\" bgcolor=\"#f3fbfe\">\n");
		print("<td><input type=\"text\" name=\"qty[]\" size=\"3\" value=\"".$qty."\"></span></td>\n");
		print("<td><a class=\"product_title1\" href=\"#\" onClick=\"javascript: decision('Are you sure you want to remove this item from your shopping bag?', 'http://www.techniart.com/amigo/remove.php?ID=".$otsdetailID."');\"><span class=\"product_title\">REMOVE?</span></a></td>\n");
		print("<td><span class=\"product_title1\">".$productDesc."".$lbl."</span></td>\n");
		print("<td><span class=\"product_title1\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td><span class=\"product_title1\">$".$tot."</span></td>\n");
		print("</tr>\n");
			$qty="";
}
	$totcalcweight=number_format($totcalcweight1, 1, '.', ',');

	print("</table>\n");
	print("<table width=\"830\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n");
	print("<tr valign=\"top\">\n");
	print("<tr>\n");
	if ($carttot <25 && $_SESSION['coupon']){
	print("<td width=\"550\"><span class=\"style5\">To qualify for <strong>FREE</strong> shipping you must spend <strong>$".number_format($ship_difference, 2, '.', ',')."</strong> more.</span></td>\n");}else
	if ($carttot <25){
	print("<td width=\"550\"><span class=\"style5\">To qualify for <strong>$7</strong> flat rate shipping you must spend <strong>$".number_format($ship_difference, 2, '.', ',')."</strong> more.</span></td>\n");}
			if ($carttot>=25 && $_SESSION['coupon']){
	print("<td width=\"550\"><span class=\"style6\"><b>You have qualified for FREE shipping.<b></span></td>\n");}
	if ($carttot >=25 && $_SESSION['coupon']<1){
	print("<td width=\"550\"><span class=\"style6\"><b>You have qualified for $7 flat rate shipping.<b></span></td>\n");}
	print("<td align=\"right\"></b></span></td>\n");
	$totformat=number_format($carttot, 2, '.', ',');
	print("<td align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:&nbsp;&nbsp;<span class=\"product_title1\">$".$totformat."</span>&nbsp;&nbsp;&nbsp;</td>\n");
	print("</tr>\n");
	if($_SESSION['coupon'] && $carttot>=25){
	$rate=0;}
	if ($carttot >= '25'){
	print("<tr>\n");
	print("<td width=\"550\"></td>\n");
	print("<td align=\"right\"></b></span></td>\n");
	$shiprate=number_format($rate, 2, '.', ',');
	print("<input type=\"hidden\" name=\"shiprate\" value=\"".$shiprate."\">");
	print("<td align=\"right\"><span class=\"body_content_style1\"><b>Shipping:&nbsp;&nbsp;<span class=\"product_title1\">$".$shiprate."</span>&nbsp;&nbsp;&nbsp;</td>\n");
	print("</tr>\n");}
	print("<tr>\n");
	if ($_SESSION['coupon']>'0'){
	print("<td width=\"550\"></td>\n");
	print("<td align=\"right\"></b></span></td>\n");
	$discount=number_format($discount, 2, '.', ',');
	print("<td align=\"right\"><span class=\"body_content_style1\"><b>Discount:&nbsp;&nbsp;<span class=\"product_title1\">$-".$discount."</span>&nbsp;&nbsp;&nbsp;</td>\n");
	print("</tr>\n");
	}else{$discount=0;}
	print("<tr>\n");
	print("<td width=\"550\"></td>\n");
	print("<td align=\"right\"></b></span></td>\n");
	$finaltot=number_format($carttot+$shiprate-$discount, 2, '.', ',');
	print("<td align=\"right\"><span class=\"body_content_style1\"><b>Total:&nbsp;&nbsp;<span class=\"product_title1\">$".$finaltot."</span>&nbsp;&nbsp;&nbsp;</td>\n");
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
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" value=\"Recalculate Totals\" onClick=\"this.form.submit();\"></td>\n");
	print("</tr></form>\n");
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" value=\"Empty Cart\" onclick=\"location.href='empty.php?otsID=".$o."'\"></td>\n");
	print("</tr>\n");
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" value=\"Continue Shopping\" onclick=\"location.href='http://www.techniart.com/amigo/store.php'\"></td>\n");
	print("</tr>\n");
print("<tr>\n");
	$product1 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='1' ");
if (mysql_num_rows($product1)) {
    $P1 = mysql_fetch_assoc($product1);
    $PQ1=$P1['qty']*6;}
$product2 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='2' ");
if (mysql_num_rows($product2)) {
    $P2 = mysql_fetch_assoc($product2);
    $PQ2=$P2['qty']*1;}
$product3 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='3' ");
if (mysql_num_rows($product3)) {
    $P3 = mysql_fetch_assoc($product3);
    $PQ3=$P3['qty']*1;}
$product4 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='4' ");
if (mysql_num_rows($product4)) {
    $P4 = mysql_fetch_assoc($product4);
    $PQ4=$P4['qty']*1;}
$product5 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='5' ");
if (mysql_num_rows($product5)) {
    $P5 = mysql_fetch_assoc($product5);
    $PQ5=$P5['qty']*1;}
$product6 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='6' ");
if (mysql_num_rows($product6)) {
    $P6 = mysql_fetch_assoc($product6);
    $PQ6=$P6['qty']*1;}
$product7 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='7' ");
if (mysql_num_rows($product7)) {
    $P7 = mysql_fetch_assoc($product7);
    $PQ7=$P7['qty']*4;}
$product8 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='8' ");
if (mysql_num_rows($product8)) {
    $P8 = mysql_fetch_assoc($product8);
    $PQ8=$P8['qty']*4;}
$product9 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='9' ");
if (mysql_num_rows($product9)) {
    $P9 = mysql_fetch_assoc($product9);
    $PQ9=$P9['qty']*1;}
$product10 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='10' ");
if (mysql_num_rows($product10)) {
    $P10 = mysql_fetch_assoc($product10);
    $PQ10=$P10['qty']*1;}
$product11 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='11' ");
if (mysql_num_rows($product11)) {
    $P11 = mysql_fetch_assoc($product11);
    $PQ11=$P11['qty']*1;}
$product12 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='12' ");
if (mysql_num_rows($product12)) {
    $P12 = mysql_fetch_assoc($product12);
    $PQ12=$P12['qty']*1;}	
$product13 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='13' ");
if (mysql_num_rows($product13)) {
    $P13 = mysql_fetch_assoc($product13);
    $PQ13=$P13['qty']*1;}
$product14 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='14' ");
if (mysql_num_rows($product14)) {
    $P14 = mysql_fetch_assoc($product14);
    $PQ14=$P14['qty']*1;}
$product15 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='15' ");
if (mysql_num_rows($product15)) {
    $P15 = mysql_fetch_assoc($product15);
    $PQ15=$P15['qty']*5;}
$product16 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='16' ");
if (mysql_num_rows($product16)) {
    $P16 = mysql_fetch_assoc($product16);
    $PQ16=$P16['qty']*1;}
$product17 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='17' ");
if (mysql_num_rows($product17)) {
    $P17 = mysql_fetch_assoc($product17);
    $PQ17=$P17['qty']*1;}
$product18 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='18' ");
if (mysql_num_rows($product18)) {
    $P18 = mysql_fetch_assoc($product18);
    $PQ18=$P18['qty']*6;}
$product19 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='19' ");
if (mysql_num_rows($product19)) {
    $P19 = mysql_fetch_assoc($product19);
    $PQ19=$P19['qty']*4;}
$product20 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='20' ");
if (mysql_num_rows($product20)) {
    $P20 = mysql_fetch_assoc($product20);
    $PQ20=$P20['qty']*4;}			
$product21 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='21' ");
if (mysql_num_rows($product21)) {
    $P21 = mysql_fetch_assoc($product21);
    $PQ21=$P21['qty']*5;}
$limit=$PQ1+$PQ2+$PQ3+$PQ4+$PQ5+$PQ6+$PQ7+$PQ8+$PQ9+$PQ10+$PQ11+$PQ12+$PQ13+$PQ14+$PQ15+$PQ16+$PQ17+$PQ18+$PQ19+$PQ20+$PQ21;
	if($limit > '24'){
	print("<td colspan=\"4\" align=\"right\" class=\"style5\">In order to checkout,<br>please adjust your cart<br>to <b>24 total products</b>.</td>\n");	
	print("</tr>\n");
	print("<tr>\n");
	print("</table>\n");
	}else{
	if($totformat<=25 && $_SESSION['coupon']>0){
		print("<td colspan=\"4\" align=\"right\"><form method=\"post\" action=\"https://www.techniart.com/amigo/orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"hidden\" name=\"ship\" value=\"".$ship."\"><input type=\"hidden\" name=\"state\" value=\"".$_SESSION["shipping"]["state"]."\"><input type=\"submit\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("</table>\n");
	}else{
	print("<td colspan=\"4\" align=\"right\"><form method=\"post\" action=\"https://www.techniart.com/amigo/orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"hidden\" name=\"ship\" value=\"".$ship."\"><input type=\"hidden\" name=\"state\" value=\"".$_SESSION["shipping"]["state"]."\"><input type=\"submit\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("</table>\n");}
}
$zero=0;
$coupbalance=number_format($discount-$carttot, 2, '.', ',');
if($coupbalance<0){$coupbalance=number_format($zero, 2, '.', ',');}

	print("&nbsp;&nbsp;<div class=\"style5\">Your cart contains <b>".$limit."</b> of the <b>24</b> products allowed per order.");
	if($_SESSION['coupon']){
	print("&nbsp;&nbsp;<div class=\"style8\">Your coupon code: <b>".$_SESSION['coupon']."</b>.&nbsp;&nbsp;<input type=\"button\" value=\"Remove Code\" onclick=\"location.href='remove-code.php'\"><br><br>Your coupon has <strong>$".$coupbalance."</strong> left to spend.<br>");}
}
	if($carttot<25){
	print("<span class=\"style5\"><br>Orders under $25 will have shipping calculated after filling out the order form.</span><br>");
	print("<span class=\"style5\"><br>A credit card will be required to checkout. Negative order totals will default to $0.</span>");}
?>
<br><br><form method="post" action="check-code.php">
<? if($coupon<1){
	print("<strong>Coupon code:&nbsp;</strong><input required name=\"coupon\" type=\"text\" size=\"10\" maxlength=\"10\">&nbsp;&nbsp;<input type=\"submit\"></form>");
}?>
</div></td>
<td width="1" bgcolor="#d9d3a4"></td>
</tr></table>
 </div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><img src="pix/g_body_bot.jpg" alt="" width="906" height="15" border="0"></td>
</tr></table>

<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
</html>


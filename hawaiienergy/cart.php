<? include("database.php");?>

<?
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
<meta name="publisher" content="techniart.us" />
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

<BODY>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<center><div class="rcorners2">
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="rcorners3"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">


<?
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail LEFT OUTER JOIN tblProducts on tblotsdetail.itemNo=tblProducts.productID where tblotsdetail.otsID='$o'";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
print("<div>");
if(!$count){
	print("<p class=\"body_content_style1\"><b><br><br>Your shopping cart is empty<br><br><br><br><br><br><br><br></b></p><br />\n");
}else{
	
	print("<form method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p class=\"body_content_style1\">");
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<b>Your shopping cart contains the following:</b><br /></div>\n");
	print("<table width=\"830\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td align=\"center\"><span class=\"section_heading_style1\"><b>Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Item</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Price</b></span></td>\n");
	print("<td><span class=\"section_heading_style1\"><b>Total</b></span></td>\n");
	print("</tr>\n");

	$shipping_products = array();



 while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
		$modelNumber=$row['modelNumber'];
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
		print("<tr valign=\"middle\" bgcolor=\"ffffff\">\n");
        print("<td align=\"center\"><input type=\"text\" class=\"forms8\" name=\"qty[]\" size=\"3\" value=\"".$qty."\"></td>\n");
		print("<td align=\"center\"><input type=\"submit\" value=\" Update \" onClick=\"this.form.submit();\" class=\"btn2\"><br /><img src=\"pix/pix_trans.gif\" height=\"1\"><br /><input type=\"button\" class=\"btn2\" value=\"Remove\" onClick=\"location.href='remove.php?ID=".$otsdetailID."'\"></td>\n");
		print("<td align=\"center\"></td>\n");
#		print("<td align=\"center\"><img src=\"pix/products/thumbnails/".$modelNumber.".jpg\" width=\"50\"></td>\n");
		print("<td><span class=\"body_content_style1\">".$productDesc."</span></td>\n");
		print("<td><span class=\"body_content_style1\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td><span class=\"body_content_style1\">$".$tot."</span></td>\n");
		print("</tr>\n");
			$qty="";
}
	$totcalcweight=number_format($totcalcweight1, 1, '.', ',');

	print("</table>\n");
	print("<table width=\"830\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n");
	print("<tr valign=\"top\" bgcolor=\"#760608\">\n");
	print("<tr>\n");
	print("<td><img src=\"pix/pix_trans.gif\" width=\"300\" height=\"1\"></td>\n");
	print("<td><img src=\"pix/pix_trans.gif\" width=\"10\" height=\"1\"></td>\n");
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
	print("<tr bgcolor=\"\">\n");
	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"body_content_style1\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");

	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn\" value=\"Recalculate Totals\" onClick=\"this.form.submit();\"></td>\n");
	print("</tr></form>\n");
	print("<tr height=\"3\"><td colspan=\"3\" align=\"right\"></td></tr>");
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn\" value=\"Empty Cart\" onclick=\"location.href='empty.php?otsID=".$o."'\"></td>\n");
	print("</tr>\n");
	print("<tr height=\"3\"><td colspan=\"3\" align=\"right\"></td></tr>");
	$product1 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='1' ");
if (mysql_num_rows($product1)) {
    $P1 = mysql_fetch_assoc($product1);
    $PQ1=$P1['qty']*1;}
$product2 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='2' ");
if (mysql_num_rows($product2)) {
    $P2 = mysql_fetch_assoc($product2);
    $PQ2=$P2['qty']*4;}
$product3 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='3' ");
if (mysql_num_rows($product3)) {
    $P3 = mysql_fetch_assoc($product3);
    $PQ3=$P3['qty']*1;}
	$product4 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='4' ");
	if (mysql_num_rows($product4)) {
    $P4 = mysql_fetch_assoc($product4);
    $PQ4=$P4['qty']*4;}
	$product5 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='5' ");
if (mysql_num_rows($product5)) {
    $P7 = mysql_fetch_assoc($product5);
    $PQ5=$P5['qty']*1;}
	$product6 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='6' ");
	if (mysql_num_rows($product6)) {
    $P6 = mysql_fetch_assoc($product6);
    $PQ6=$P6['qty']*3;}
		$bulblimit=$PQ1+$PQ2+$PQ3+$PQ4+$PQ5+$PQ6;
	
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
	
	$product13 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='13' ");
	if (mysql_num_rows($product13)) {
    $P13 = mysql_fetch_assoc($product13);
    $PQ13=$P13['qty']*1;}
	$product14 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='14' ");
	if (mysql_num_rows($product14)) {
    $P14 = mysql_fetch_assoc($product14);
    $PQ14=$P14['qty']*1;}
	$APSlimit=$PQ9+$PQ10+$PQ11+$PQ13+$PQ14;

	
	
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" value=\"Continue Shopping\" class=\"btn\" onclick=\"location.href='store.php'\"></td>\n");
	print("</tr>\n");
	print("<tr height=\"3\"><td colspan=\"3\" align=\"right\"></td></tr>");
	if($bulblimit > '12'){
	print("<td colspan=\"4\" align=\"right\" class=\"style5\">In order to checkout,<br>please adjust your cart<br>to <b>10 total bulbs or less</b>.</td>\n");	
	print("</tr>\n");
	print("</tr>\n");
	print("<tr>\n");
	print("</table>\n");
	}else{
	if($APSlimit > '3'){
	print("<td colspan=\"4\" align=\"right\" class=\"style5\">In order to checkout,<br>please adjust your cart<br>to <b>3 total APS & water devices
 or less</b>.</td>\n");	
	print("</tr>\n");
	print("<tr>\n");
	print("</table>\n");
	}else{
	if($lamplimit > '2'){
	print("<td colspan=\"4\" align=\"right\" class=\"style5\">In order to checkout,<br>please adjust your cart<br>to <b>2 total Packs or less</b>.</td>\n");	
	print("</tr>\n");
	print("<tr>\n");
	print("</table>\n");
	}else{
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><form method=\"post\" action=\"orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"submit\" class=\"btn\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("</table></form>\n");
	}}}}
	if($bulblimit<1){
		$bulblimit='0';}
	if($bulblimit>0){
	print("<span class=\"style5\"><br>You currently have <strong>".$bulblimit."</strong> of the allowed <strong>10</strong> bulbs in your cart.</span><br>
\n");}
	if($bulblimit > '10'){
		print("<span class=\"body_content_ip\">Please adjust your cart so that you have <strong>10</strong> total bulbs or less.</span><br>
<br>
");}
	if($APSlimit<1){
		$APSlimit='0';}
		if($APSlimit>0){
print("<span class=\"style5\"><br>You currently have <strong>".$APSlimit."</strong> of the allowed <strong>3</strong> APS/water devices in your cart.<br>
\n");}
	if($APSlimit > '3'){
		print("<span class=\"body_content_ip\">Please adjust your cart so that you have <strong>3</strong> total APS/water devices or less.</span>");}
		if($lamplimit<1){
		$lamplimit='0';}
if($lamplimit>0){		
print("<span class=\"style5\"><br>You currently have <strong>".$lamplimit."</strong> of the allowed <strong>2</strong> Packs in your cart.<br>
\n");}
	if($lamplimit > '2'){
		print("<span class=\"body_content_ip\">Please adjust your cart so that you have <strong>2</strong> total Packs or less.</span>");}
	?>
<br>
</div></td>
<td></td>
</tr></table>

</td>
	</tr></table></div>
<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
	</body>
</html>

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
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
<title>TechniArt - Shopping Cart</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<? if($_SESSION['rep']=="CNP"){?><link rel="STYLESHEET" type="text/css" href="cnp.css"><?;}?>
<? if($_SESSION['rep']=="AEP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="TNMP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="NQ"){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
<? if($_SESSION['rep']==""){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
</head>
<BODY>
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->
<center><div class="rcorners2">
<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div id="title_spacer" align="left"><span class="title_main">Shopping Cart</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style4"><strong>Get $7 flat rate shipping</strong> on all orders over $15!</span></div> 
</td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="rcorners3"><tr valign="top">
<td></td>
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
		print("<tr valign=\"top\" bgcolor=\"#f3fbfe\">\n");
		print("<td><input type=\"text\" name=\"qty[]\" size=\"3\" value=\"".$qty."\"></span></td>\n");
				print("<td><a class=\"product_title1\" href=\"#\" onClick=\"javascript: decision('Are you sure you want to remove this item from your shopping bag?', 'remove.php?ID=".$otsdetailID."');\"><span class=\"product_title\">REMOVE?</span></a></td>\n");
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
#	if ($carttot <15 && $_SESSION['coupon']){
#	print("<td width=\"550\"><span class=\"style5\">To qualify for <strong>FREE</strong> shipping you must spend <strong>$".number_format($ship_difference, 2, '.', ',')."</strong> more.</span></td>\n");}else
	if ($carttot <15){
	print("<td width=\"550\"><span class=\"style5\">To qualify for <strong>$7</strong> flat rate shipping you must spend <strong>$".number_format($ship_difference, 2, '.', ',')."</strong> more.</span></td>\n");}
	#if ($carttot>=15 && $_SESSION['coupon']){
#	print("<td width=\"550\"><span class=\"style6\"><b>You have qualified for FREE shipping.<b></span></td>\n");}
	if ($carttot >=15){
	print("<td width=\"550\"><span class=\"style6\"><b>You have qualified for $7 flat rate shipping.<b></span></td>\n");
	$rate=7;}

	print("<td align=\"right\"></b></span></td>\n");
	$totformat=number_format($carttot, 2, '.', ',');
	print("<td align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:&nbsp;&nbsp;<span class=\"product_title1\">$".$totformat."</span>&nbsp;&nbsp;&nbsp;</td>\n");
	print("</tr>\n");
	if ($carttot >= '15'){
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
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn2\" value=\"Recalculate Totals\" onClick=\"this.form.submit();\"></td>\n");
	print("</tr></form>\n");
	print("<tr><td colspan=\"4\" height=\"5\" align=\"right\"></td></tr>\n");
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn2\" value=\"Empty Cart\" onclick=\"location.href='empty.php?otsID=".$o."'\"></td>\n");
	print("</tr>\n");
	print("<tr><td colspan=\"4\" height=\"5\" align=\"right\"></td></tr>\n");
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn2\" value=\"Continue Shopping\" onclick=\"location.href='http://www.techniart.us/cpe/store.php'\"></td>\n");
	print("</tr>\n");
	print("<tr><td colspan=\"4\" height=\"5\" align=\"right\"></td></tr>\n");
print("<tr>\n");
	$product1 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='1' ");
if (mysql_num_rows($product1)) {
    $P1 = mysql_fetch_assoc($product1);
    $PQ1=$P1['qty']*1;}
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
    $PQ5=$P5['qty']*6;}
$product6 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='6' ");
if (mysql_num_rows($product6)) {
    $P6 = mysql_fetch_assoc($product6);
    $PQ6=$P6['qty']*15;}
$product7 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='7' ");
if (mysql_num_rows($product7)) {
    $P7 = mysql_fetch_assoc($product7);
    $PQ7=$P7['qty']*1;}
$product8 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='8' ");
if (mysql_num_rows($product8)) {
    $P8 = mysql_fetch_assoc($product8);
    $PQ8=$P8['qty']*1;}
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
    $PQ12=$P12['qty']*6;}	
$product13 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='13' ");
if (mysql_num_rows($product13)) {
    $P13 = mysql_fetch_assoc($product13);
    $PQ13=$P13['qty']*6;}
$product14 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='14' ");
if (mysql_num_rows($product14)) {
    $P14 = mysql_fetch_assoc($product14);
    $PQ14=$P14['qty']*6;}
$product15 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='15' ");
if (mysql_num_rows($product15)) {
    $P15 = mysql_fetch_assoc($product15);
    $PQ15=$P15['qty']*15;}
$product16 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='16' ");
if (mysql_num_rows($product16)) {
    $P16 = mysql_fetch_assoc($product16);
    $PQ16=$P16['qty']*15;}
$product17 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='17' ");
if (mysql_num_rows($product17)) {
    $P17 = mysql_fetch_assoc($product17);
    $PQ17=$P17['qty']*15;}
$product18 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='18' ");
if (mysql_num_rows($product18)) {
    $P18 = mysql_fetch_assoc($product18);
    $PQ18=$P18['qty']*1;}
$product19 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='19' ");
if (mysql_num_rows($product19)) {
    $P19 = mysql_fetch_assoc($product19);
    $PQ19=$P19['qty']*1;}
$product20 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='20' ");
if (mysql_num_rows($product20)) {
    $P20 = mysql_fetch_assoc($product20);
    $PQ20=$P20['qty']*1;}			
$product21 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='21' ");
if (mysql_num_rows($product21)) {
    $P21 = mysql_fetch_assoc($product21);
    $PQ21=$P21['qty']*1;}
	$product22 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='22' ");
if (mysql_num_rows($product22)) {
    $P22 = mysql_fetch_assoc($product22);
    $PQ22=$P22['qty']*1;}
	$product23 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='23' ");
if (mysql_num_rows($product23)) {
    $P23 = mysql_fetch_assoc($product23);
    $PQ23=$P23['qty']*1;}
	$product24 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='24' ");
if (mysql_num_rows($product24)) {
    $P24 = mysql_fetch_assoc($product24);
    $PQ24=$P24['qty']*1;}
	$product25 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='25' ");
if (mysql_num_rows($product25)) {
    $P25 = mysql_fetch_assoc($product25);
    $PQ25=$P25['qty']*1;}
		$product26 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='26' ");
if (mysql_num_rows($product26)) {
    $P26 = mysql_fetch_assoc($product26);
    $PQ26=$P26['qty']*1;}
		$product27 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='27' ");
if (mysql_num_rows($product27)) {
    $P27 = mysql_fetch_assoc($product27);
    $PQ27=$P27['qty']*1;}
		$product28 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='28' ");
if (mysql_num_rows($product28)) {
    $P28 = mysql_fetch_assoc($product28);
    $PQ28=$P28['qty']*1;}
		$product29 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='29' ");
if (mysql_num_rows($product29)) {
    $P29 = mysql_fetch_assoc($product29);
    $PQ29=$P29['qty']*6;}
		$product30 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='30' ");
if (mysql_num_rows($product30)) {
    $P30 = mysql_fetch_assoc($product30);
    $PQ30=$P30['qty']*6;}
		$product31 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='31' ");
if (mysql_num_rows($product31)) {
    $P31 = mysql_fetch_assoc($product31);
    $PQ31=$P31['qty']*6;}
		$product32 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='32' ");
if (mysql_num_rows($product32)) {
    $P32 = mysql_fetch_assoc($product32);
    $PQ32=$P32['qty']*4;}
		$product33 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='33' ");
if (mysql_num_rows($product33)) {
    $P33 = mysql_fetch_assoc($product33);
    $PQ33=$P33['qty']*4;}
		$product34 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='34' ");
if (mysql_num_rows($product34)) {
    $P34 = mysql_fetch_assoc($product34);
    $PQ34=$P34['qty']*4;}
		$product35 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='35' ");
if (mysql_num_rows($product35)) {
    $P35 = mysql_fetch_assoc($product35);
    $PQ35=$P35['qty']*1;}
		$product36 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='36' ");
if (mysql_num_rows($product36)) {
    $P36 = mysql_fetch_assoc($product36);
    $PQ36=$P36['qty']*1;}
		$product37 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='37' ");
if (mysql_num_rows($product37)) {
    $P37 = mysql_fetch_assoc($product37);
    $PQ37=$P37['qty']*1;}
		$product38 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='38' ");
if (mysql_num_rows($product38)) {
    $P38 = mysql_fetch_assoc($product38);
    $PQ38=$P38['qty']*1;}
		$product39 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='39' ");
if (mysql_num_rows($product39)) {
    $P39 = mysql_fetch_assoc($product39);
    $PQ39=$P39['qty']*1;}
		$product40 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='40' ");
if (mysql_num_rows($product40)) {
    $P40 = mysql_fetch_assoc($product40);
    $PQ40=$P40['qty']*6;}
		$product41 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='41' ");
if (mysql_num_rows($product41)) {
    $P41 = mysql_fetch_assoc($product41);
    $PQ41=$P41['qty']*6;}
		$product42 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='42' ");
if (mysql_num_rows($product42)) {
    $P42 = mysql_fetch_assoc($product42);
    $PQ42=$P42['qty']*6;}
		$product43 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='43' ");
if (mysql_num_rows($product43)) {
    $P43 = mysql_fetch_assoc($product43);
    $PQ43=$P43['qty']*6;}
		$product44 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='44' ");
if (mysql_num_rows($product44)) {
    $P44 = mysql_fetch_assoc($product44);
    $PQ44=$P44['qty']*6;}
		$product45 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='45' ");
if (mysql_num_rows($product45)) {
    $P45 = mysql_fetch_assoc($product45);
    $PQ45=$P45['qty']*6;}
		$product46 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='46' ");
if (mysql_num_rows($product46)) {
    $P46 = mysql_fetch_assoc($product46);
    $PQ46=$P46['qty']*6;}
		$product47 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='47' ");
if (mysql_num_rows($product47)) {
    $P47 = mysql_fetch_assoc($product47);
    $PQ47=$P47['qty']*6;}
		$product48 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='48' ");
if (mysql_num_rows($product48)) {
    $P48 = mysql_fetch_assoc($product48);
    $PQ48=$P48['qty']*15;}
		$product49 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='49' ");
if (mysql_num_rows($product49)) {
    $P49 = mysql_fetch_assoc($product49);
    $PQ49=$P49['qty']*15;}
		$product50 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='50' ");
if (mysql_num_rows($product50)) {
    $P50 = mysql_fetch_assoc($product50);
    $PQ50=$P50['qty']*15;}
		$product51 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='51' ");
if (mysql_num_rows($product51)) {
    $P51 = mysql_fetch_assoc($product51);
    $PQ51=$P51['qty']*6;}
		$product52 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='52' ");
if (mysql_num_rows($product52)) {
    $P52 = mysql_fetch_assoc($product52);
    $PQ52=$P52['qty']*6;}
		$product53 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='53' ");
if (mysql_num_rows($product53)) {
    $P53 = mysql_fetch_assoc($product53);
    $PQ53=$P53['qty']*6;}
		$product54 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='54' ");
if (mysql_num_rows($product54)) {
    $P54 = mysql_fetch_assoc($product54);
    $PQ54=$P54['qty']*6;}
		$product55 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='55' ");
if (mysql_num_rows($product55)) {
    $P55 = mysql_fetch_assoc($product55);
    $PQ55=$P55['qty']*6;}
		$product56 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='56' ");
if (mysql_num_rows($product56)) {
    $P56 = mysql_fetch_assoc($product56);
    $PQ56=$P56['qty']*6;}
		$product57 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='57' ");
if (mysql_num_rows($product57)) {
    $P57 = mysql_fetch_assoc($product57);
    $PQ57=$P57['qty']*6;}
		$product58 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='58' ");
if (mysql_num_rows($product58)) {
    $P58 = mysql_fetch_assoc($product58);
    $PQ58=$P58['qty']*6;}
		$product59 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='59' ");
if (mysql_num_rows($product59)) {
    $P59 = mysql_fetch_assoc($product59);
    $PQ59=$P59['qty']*4;}
		$product60 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='60' ");
if (mysql_num_rows($product60)) {
    $P60 = mysql_fetch_assoc($product60);
    $PQ60=$P60['qty']*4;}
		$product61 = mysql_query("SELECT qty FROM tblotsdetail WHERE otsID = '$o' && itemNo='61' ");
if (mysql_num_rows($product61)) {
    $P61 = mysql_fetch_assoc($product61);
    $PQ61=$P61['qty']*4;}
	
$limit=$PQ1+$PQ2+$PQ3+$PQ4+$PQ5+$PQ6+$PQ7+$PQ8+$PQ9+$PQ10+$PQ11+$PQ12+$PQ13+$PQ14+$PQ15+$PQ16+$PQ17+$PQ18+$PQ19+$PQ20+$PQ21+$PQ22+$PQ23+$PQ24+$PQ25+$PQ26+$PQ27+$PQ28+$PQ29+$PQ30+$PQ31+$PQ32+$PQ33+$PQ34+$PQ35+$PQ36+$PQ37+$PQ38+$PQ39+$PQ40+$PQ41+$PQ42+$PQ43+$PQ44+$PQ45+$PQ46+$PQ47+$PQ24+$PQ49+$PQ50+$PQ51+$PQ52+$PQ53+$PQ54+$PQ55+$PQ56+$PQ57+$PQ58+$PQ59+$PQ60+$PQ61;
	if($limit > '24'){
	print("<td colspan=\"4\" align=\"right\" class=\"style5\">In order to checkout,<br>please adjust your cart<br>to <b>24 total products</b>.</td>\n");	
	print("</tr>\n");
	print("<tr>\n");
	print("</table>\n");
	}else{
	if($totformat<15){
		print("<td colspan=\"4\" align=\"right\"><form method=\"post\" action=\"orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"hidden\" name=\"ship\" value=\"".$ship."\"><input type=\"hidden\" name=\"state\" value=\"".$_SESSION["shipping"]["state"]."\"><input type=\"submit\" class=\"btn2\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("</table>\n");
	}else{

	if($finaltot<=0){
		print("<td colspan=\"4\" align=\"right\"><form method=\"post\" action=\"orderform1.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"submit\" class=\"btn2\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("</table>\n");
	}else{
	print("<td colspan=\"4\" align=\"right\"><form method=\"post\" action=\"orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"hidden\" name=\"ship\" value=\"".$ship."\"><input type=\"hidden\" name=\"state\" value=\"".$_SESSION["shipping"]["state"]."\"><input type=\"submit\" class=\"btn2\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("</table>\n");}
}}
$zero=0;
$coupbalance=number_format($discount-$carttot-$rate, 2, '.', ',');
if($coupbalance<0){$coupbalance=number_format($zero, 2, '.', ',');}

	print("&nbsp;&nbsp;<div class=\"style5\">Your cart contains <b>".$limit."</b> of the <b>24</b> products allowed per order.");
	if($_SESSION['coupon']){
	print("&nbsp;&nbsp;<div class=\"style8\">Your coupon code: <b>".$_SESSION['coupon']."</b>.&nbsp;&nbsp;<input class=\"btn2\" type=\"button\" value=\"Remove Code\" onclick=\"location.href='remove-code.php'\"><br><br>Your coupon has <strong>$".$coupbalance."</strong> left to spend.<br>Coupons are <b>one</b> time use only!");}
}
	if($carttot<15){
	print("<span class=\"style5\"><br>Orders under $15 will have shipping calculated after filling out the order form.</span><br>");
	print("<span class=\"style5\"><br>A credit card will be required to checkout. Negative order totals will default to $0.</span>");}
?>
<br><br><form method="post" action="check-code.php">
<? if($coupon<1){
	print("<strong>Coupon code:&nbsp;</strong><input required name=\"coupon\" type=\"text\" size=\"10\" maxlength=\"10\">&nbsp;&nbsp;<input class=\"btn2\" value=\"Submit\" type=\"submit\"></form><br>
<br>
");
}?>
</div></td>
<td></td>
</tr></table>
 </div></td>
</tr></table>
</div>
<!-- ------------------------------end body------------------------------ -->
<? #echo($_SESSION['rep']);?>
<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
</html>


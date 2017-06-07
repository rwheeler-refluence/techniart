<? include("database.php"); ?>
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
		$quantity1=$_POST['qty'];
		$case_quantity=$_POST['case_quantity'];
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
			$sql21="insert into tblotsdetail values ('','$next','$itemNo','$quantity1','$price','$case_quantity','$desc','','','')";
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
<html>
<head>
<title>CASCADE WATER ALLIANCE |  Free Items</title>
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
<?php include("cart-header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<div class="content"><table width="80%" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="100%">
</td>
</tr></table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main">
<tr valign="top">
<td></td>
<td width="99%"><div id="main_content_ip" align="left">

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
	print("<table width=\"85%\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td><span class=\"product_title\"><b>Quantity</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	print("<td><span class=\"product_title\"><b>Product Description</b></span></td>\n");
	print("<td align=\"center\"></span></td>\n");
	print("<td align=\"center\"><span class=\"product_title\"><b>Products</b></span></td>\n");
	print("<td align=\"center\"><span class=\"product_title\"><b>Cost</b></span></td>\n");
	print("</tr>\n");

 while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
		$case_quantity=$row['case_quantity'];
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
		$prod_tot=$qty;
		$tot=number_format($prod_tot*$price, 2, '.', ',');
		$tot1=$qty*$price;		
		$carttot+=$tot1;
		$flat_ship=5.00;
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
		print("<td><input style=\"text-align:center;\" type=\"text\" name=\"qty[]\" size=\"3\" value=\"".$qty."\"></span></td>\n");
		print("<td><a class=\"product_title1\" href=\"#\" onClick=\"javascript: decision('Are you sure you want to remove this item from your shopping bag?', 'https://www.techniart.us/cascade/remove.php?ID=".$otsdetailID."');\"><span class=\"product_title\">REMOVE?</span></a></td>\n");
		print("<td><span class=\"product_title1\">".$productDesc."".$lbl."</span></td>\n");
		print("<td align=\"center\"></td>\n");
		print("<td align=\"center\"><span class=\"product_title1\">".$prod_tot."</span></td>\n");
		print("<td align=\"center\"><span class=\"product_title1\">$".$tot."</span></td>\n");
		print("</tr>\n");
			$qty="";
}
	$totcalcweight=number_format($totcalcweight1, 1, '.', ',');

	print("</table>\n");
	print("<table width=\"830\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n");
	print("<tr valign=\"top\">\n");
	print("<tr>\n");
#		if ($carttot < '50'){
#	print("<td width=\"550\"><span class=\"style5\">To qualify for <strong>$7</strong> flat rate shipping you must spend <strong>$".number_format($ship_difference, 2, '.', ',')."</strong> more.</span></td>\n");}
#			if ($carttot >= '50'){
#	print("<td width=\"550\"><span class=\"style6\"><b>You have qualified for $7 flat rate shipping.<b></span></td>\n");}

	print("<td align=\"right\"></b></span></td>\n");
	$totformat=number_format($carttot, 2, '.', ',');
	#print("<td align=\"right\"><span class=\"body_content_style1\"><b>Subtotal:&nbsp;&nbsp;<span class=\"product_title1\">$".$totformat."</span>&nbsp;&nbsp;&nbsp;</td>\n");
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
	print("<td height =\"35\" colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn\" value=\"Recalculate Totals\" onClick=\"this.form.submit();\"></td>\n");
	print("</tr></form>\n");
	print("<tr>\n");
	print("<td height =\"5\" colspan=\"4\" align=\"right\"></td>\n");
	print("</tr>\n");
	print("<tr>\n");
	print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn\" value=\"Empty Cart\" onclick=\"location.href='http://www.techniart.us/cascade/empty.php?otsID=".$o."'\"></td>\n");
	print("</tr>\n");
		print("<tr>\n");
	print("<td height =\"5\" colspan=\"4\" align=\"right\"></td>\n");
	print("</tr>\n");
	print("<tr>\n");
	print("<td height =\"35\" colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn\" value=\"Continue Shopping\" onclick=\"location.href='https://www.techniart.us/cascade/index.php'\"></td>\n");
	print("</tr>\n");
	print("<tr>\n");
#print("<td colspan=\"4\" align=\"right\">Cart currently under maintenance<br>Please contact our customer service to order<br>customerservice@techniart.com<br>860-693-2003</td>\n");
	print("</tr></form>\n");
	print("</tr>\n");
		print("<tr>\n");
	print("<td height =\"5\" colspan=\"4\" align=\"right\"></td>\n");
	print("</tr>\n");
	print("<tr>\n");
		print("<td colspan=\"4\" align=\"right\"><form method=\"post\" action=\"https://www.techniart.us/cascade/orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"hidden\" name=\"ship\" value=\"".$ship."\"><input type=\"hidden\" name=\"state\" value=\"".$_SESSION["shipping"]["state"]."\"><input type=\"submit\" class=\"btn\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("</table>\n");
}?>
<br>

</td>
<td></td>
</tr></table>

</td>
</tr></table>
</div>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? #include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div></div>
</body>
</html>


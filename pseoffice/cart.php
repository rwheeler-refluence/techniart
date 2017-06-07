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
		$quantity1="1";
		$productTitle=$_POST['productName'];
		$modelNumber=$_POST['modelNumber'];
		$desc.="".$productTitle."";
		$price=$_POST['price'];
		$stamp=mktime();

		#check to see if there is an existing order for this session
		$sqlc1="select * from tblorderstosend_pse where sess='$sess' && status='open'";
#print("c1: ".$sqlc1."<br>");
		$resultc1=db_query($sqlc1);
		$countc1=mysql_num_rows($resultc1);
		if($countc1<1){
			$sql="insert into tblorderstosend_pse values ('','$sess','','','$stamp','open')";
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
		$sqli1a="select * from tblotsdetail_pse where itemNo='$itemNo' && otsID='$next'";
#print("".$sqli1a."<br />");
		$resulti1a=db_query($sqli1a);
		$counti1a_g=mysql_num_rows($resulti1a);
#print("counti1: ".$counti1a_g."<br>");
		if($counti1a_g<1){
			$sql21="insert into tblotsdetail_pse values ('','$next','$itemNo','$quantity1','$price','$desc','')";
			$result21=db_query($sql21);
#print("".$sql21."<br>");
		}else{
			while($rowi1a=mysql_fetch_array($resulti1a)){
				$otsdetailID=$rowi1a['otsdetailID'];
				$qty=$rowi1a['qty'];
				$newqty=$_POST['qty'];
				$sql21="update tblotsdetail_pse set qty='$newqty' where otsdetailID='$otsdetailID'";
				$result21=db_query($sql21);	
			}
		}
	break;

	case "update":
		$otsdetailID=$_POST['otsdetailID'];
		$qty=$_POST['qty'];
		for($i=0;$i<count($otsdetailID);$i++){
			if($qty[$i]==0){
				$sql="delete from tblotsdetail_pse where otsdetailID='$otsdetailID[$i]'";
			}else{
				$sql="update tblotsdetail_pse set qty='$qty[$i]' where otsdetailID='$otsdetailID[$i]'";
			}
			$result=db_query($sql);
		}
	break;
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<title>Special offer from PSE</title>
</head>
<BODY><?php include_once("analyticstracking.php") ?><? include("bluebar.php")?>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"></div>
</div></center>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1">

<?
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail_pse LEFT OUTER JOIN tblProducts on tblotsdetail_pse.itemNo=tblProducts.productID where tblotsdetail_pse.otsID='$o'";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
print("<div>");
if(!$count){
	print("<p class=\"cart\"><b><br><br>Your shopping cart is empty<br><br><input type=\"button\" value=\"Start Over\" class=\"btn\" onclick=\"location.href='select.php'\"></b></p><br />\n");
}else{
	
	print("<form method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p class=\"cart\">");
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<b>Your shopping cart contains the following:</b><br /></div>\n");
	print("<table width=\"100%\" cellpadding=\"4\" cellspacing=\"2\">\n");
	print("<tr valign=\"top\">\n");
	print("<td align=\"center\"><span class=\"cart-header\"><b>Qty</b></span></td>\n");
	print("<td>&nbsp;</td>\n");
	#print("<td>&nbsp;</td>\n");
	print("<td><span class=\"cart-header\"><b>Item</b></span></td>\n");
	print("<td><span class=\"cart-header\"><b>Price</b></span></td>\n");
	print("<td><span class=\"cart-header\"><b>Total</b></span></td>\n");
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
			$sqlu="update tblotsdetail_pse set price='$pr' where otsdetailID='$otsdetailID'";
			$resultu=db_query($sqlu);
		#		print("<script language=\"javascript\">document.location.href='cart.php'</script>");
			}
		}else{
			$pr=$row['MSRP'];
			if($pr!==$price){
				$sqlu="update tblotsdetail_pse set price='$pr' where otsdetailID='$otsdetailID'";
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
				$sqlu="update tblotsdetail_pse set price='$pr' where otsdetailID='$otsdetailID'";
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
        print("<td align=\"center\"><input type=\"text\" class=\"forms7\" name=\"qty[]\" size=\"3\" value=\"".$qty."\"></td>\n");
		print("<td align=\"center\"><input type=\"submit\" value=\" Update \" onClick=\"this.form.submit();\" class=\"btn2\"><br /><img src=\"pix/pix_trans.gif\" height=\"1\"><br /><input type=\"button\" class=\"btn2\" value=\"Remove\" onClick=\"location.href='remove.php?ID=".$otsdetailID."'\"></td>\n");
		#print("<td align=\"center\"><img src=\"pix/products/thumbnails/".$modelNumber.".jpg\" width=\"50\"></td>\n");
		print("<td><span class=\"cart\">".$productDesc."</span></td>\n");
		print("<td><span class=\"cart\">$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td><span class=\"cart\">$".$tot."</span></td>\n");
		print("</tr>\n");
			$qty="";
}
	$totcalcweight=number_format($totcalcweight1, 1, '.', ',');

	print("</table></form>\n");
	print("<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n");
	print("<tr valign=\"top\" bgcolor=\"#760608\">\n");
	print("<tr>\n");
	print("<td></td>\n");
	print("<td></td>\n");
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
	print("<td colspan=\"4\" align=\"right\"><img src=\"pix/pix_trans.gif\" width=\"300\" height=\"1\"><span class=\"cart\"><b>Subtotal:</b>&nbsp;</span></td>\n");
	print("<td style=\"padding-left:4px;\"><span class=\"cart\">$".number_format($carttot, 2, '.', ',')."</span></td>\n");
	print("</tr>\n");

	#print("<tr>\n");
	#print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn1\" value=\"Recalculate Totals\" onClick=\"this.form.submit();\"></td>\n");
	#print("</tr></form>\n");
	#print("<tr height=\"3\"><td colspan=\"3\" align=\"right\"></td></tr>");
	#print("<tr>\n");
	#print("<td colspan=\"4\" align=\"right\"><input type=\"button\" class=\"btn1\" value=\"Empty Cart\" onclick=\"location.href='empty.php?otsID=".$o."'\"></td>\n");
	#print("</tr>\n");
	print("<tr height=\"3\"><td colspan=\"3\" align=\"right\"></td></tr>");
		$product242 = mysql_query("SELECT qty FROM tblotsdetail_pse WHERE otsID = '$o' && itemNo='242' ");
if (mysql_num_rows($product242)) {
    $P242 = mysql_fetch_assoc($product242);
    $wwlimit=$P242['qty']*1;}
	
			$product243 = mysql_query("SELECT qty FROM tblotsdetail_pse WHERE otsID = '$o' && itemNo='24e' ");
if (mysql_num_rows($product243)) {
    $P243 = mysql_fetch_assoc($product243);
    $cwlimit=$P242['qty']*1;}
$combolimit=$wwlimit+$cwlimit;
	
	print("<tr>\n");
	print("<td colspan=\"5\" align=\"right\"><input type=\"button\" value=\"Continue Shopping\" class=\"btn1\" onclick=\"location.href='http://www.techniart.us/pseoffice/select.php'\"></td>\n");
	print("</tr>\n");
	print("<tr height=\"3\"><td colspan=\"3\" align=\"right\"></td></tr>");
	if($combolimit > '2'){
	print("<td colspan=\"5\" align=\"right\" class=\"cart\">In order to checkout,<br>please adjust your cart<br>to <b>2 total kits or less</b>.</td>\n");	
	print("</tr>\n");
	print("<tr>\n");
	print("</table>\n");
	}else{
	
	print("<tr>\n");
	print("<td colspan=\"5\" align=\"right\"><form method=\"post\" action=\"https://www.techniart.us/pseoffice/orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"submit\" class=\"btn1\" value=\"Checkout\"></td>\n");
	print("</tr>\n");
	print("</table>\n");
	}}
	if($PQ1<1){
		$PQ1='0';}
	if($comobolimit>0){
	print("<span class=\"cart\"><br>You currently have <strong>".$combolimit."</strong> of the allowed <strong>2</strong> home efficiency kits in your cart.</span><br>
\n");}
	if($combolimit > '2'){
		print("<span class=\"cart\"><b>Please adjust your cart so that you have <strong>2</strong> total home efficiency kits or less.<b></span><br>
<br>
");}

	?>
<br>
</div></td>
<td></td>
</tr></table>

</td>
</tr></table><br>
<br>

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->

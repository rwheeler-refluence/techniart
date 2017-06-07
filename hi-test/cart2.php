<? include("database.php"); ?>
<?

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
		$productTitle=$_POST['productName'];
		$modelNumber=$_POST['modelNumber'];
		$desc.="".$productTitle."  ".$modelNumber."";
		$price=$_POST['price'];
		$source=$_SESSION['source'];
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
<html>
<head>
<title>TechniArt - Shopping Cart</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.us/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.us/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.us/svn/trunk/html5.js"></script>
<![endif]-->
<script src="respond.min.js"></script>

</head><?php include_once("analyticstracking.php") ?>
<BODY>
<!--Hawaii Energy, Cart Conversion Pixel-->


<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 954339710;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "YLC_CJOohGwQ_qKIxwM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/954339710/?label=YLC_CJOohGwQ_qKIxwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript><center><div class="gridContainer clearfix">

<? $o=$_SESSION['otsID'];
	$sqlo="select sum(qty) as TotalQuantity from tblotsdetail where tblotsdetail.otsID='$o'";
	$resulto=db_query($sqlo);
	while($row=mysql_fetch_array($resulto)){
		$limit=$row['TotalQuantity'];
	}?><? if($limit>1){include_once("header.php");}else{include_once("header2.php");} ?><br>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?

$sql="select * from tblotsdetail LEFT OUTER JOIN tblProducts on tblotsdetail.itemNo=tblProducts.productID where tblotsdetail.otsID='$o'";

#print($sql);
#print($sqlo);
$result=db_query($sql);

$count=mysql_num_rows($result);

print("<div>");
if(!$count){
	print("<br><br><br><p class=\"product_title\"><b>Your shopping cart is empty</b></p><br><br><br><br><br><br><br><br><br><br><br><br>\n");
}else{
print("<form  method=\"post\" action=\"".$PHP_SELF."\">\n");
	
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n");
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
		print("<td align=\"center\"><span class=\"cart\">".$qty."</td>\n");
		print("<td align=\"center\"></td>\n");
		print("<td><span class=\"cart\">".$productDesc."".$lbl."</td>\n");
		print("<td><span class=\"cart\">$".number_format($price, 2, '.', ',')."</td>\n");
		print("<td><span class=\"cart\">$".$tot."</td>\n");
		print("</tr>\n");
		
		$i++;
	}
	print("<tr><td></td></tr>\n");
	print("<tr bgcolor=\"#ffffff\">\n");
	print("<td colspan=\"4\" align=\"right\"><br><span class=\"cart\"><b>Subtotal:</b>&nbsp;</td>\n");
	print("<td style=\"padding-left:4px;\"><br><span class=\"cart\">$".number_format($carttot, 2, '.', ',')."</td>\n");
	print("</tr></form>\n");

#	print("<tr>\n");
#	print("<tr>\n");
#	print("<td colspan=\"3\" align=\"right\"><span class=\"body_content_style1\"><b>Totals:</b>&nbsp;</span></td>\n");
#	$totfin=$carttot+$ship;
#	$totfinformat=number_format($totfin, 2, '.', ',');
#	$totformat=number_format($carttot, 2, '.', ',');
#	print("<td align=\"right\"><span class=\"body_content_style1\">$".$totfinformat."</span>&nbsp;&nbsp;&nbsp;</td>\n");
#	print("</tr>\n");

	print("<tr>\n");
	print("<td colspan=\"5\" align=\"right\"></td>\n");
	print("</tr></form>\n");
	print("<tr>\n");
	print("<td colspan=\"5\" align=\"right\"><input type=\"button\" class=\"btn1\" value=\"Start Over\" onclick=\"location.href='empty.php?otsID=".$o."'\"></td>\n");
	print("</tr>\n");
	
	print("<tr>\n");
	if($limit > '2'){
	print("<td colspan=\"5\" align=\"right\" class=\"style5\">In order to checkout,<br>please adjust your cart<br>to <b>2 total advanced power strips.</b>.</td>\n");	
	print("</tr>\n");
	print("<tr>\n");
	print("</table>\n");
	}else{
	print("<td colspan=\"5\" align=\"right\"><form method=\"post\" action=\"orderform.php\"><input type=\"hidden\" name=\"source\" value=\"".$source."\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"hidden\" name=\"ship\" value=\"".$ship."\"><input type=\"hidden\" name=\"state\" value=\"".$_SESSION["shipping"]["state"]."\"><input type=\"submit\" class=\"btn1\" value=\"Checkout\"></td>\n");
	print("</tr></form>\n");
	print("<tr>\n");
	print("<td colspan=\"5\" align=\"right\"></td>\n");
	print("</tr>\n");
	print("<tr>\n");

	print("</table>\n");
}	
}?>
</td>
  </tr>
</table>
<? include("footer.php");?>
</div></div>
</center>

</body>
</html>


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
			if($qty[$i]>=3){
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
<style type="text/css">
body {
	background-color: #666666;
}
</style>

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
</head><?php include_once("analyticstracking.php") ?>
<BODY><center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"><p>Testing mobile reactiveness</p><img src="SEP_Entrypage_v3.jpg"></div>
</div></center>

<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1">
<center>
<?
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail LEFT OUTER JOIN tblProducts on tblotsdetail.itemNo=tblProducts.productID where tblotsdetail.otsID='$o'";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
print("<div>");
if(!$count){
	print("<p class=\"body_content_style1\"><br /><br />\n");
	print("<p align=\"center\" class=\"body_content_style1\"><b>Only 2 Better Bathroom Kits may be purchased per residential address.</b></p><br />\n");
	print("<p align=\"center\" class=\"body_content_style1\"><b>Duplicate orders may be cancelled at our discretion.</b></p><br />\n");
	print("<p align=\"center\"><input type=\"button\" class=\"btn2\" value=\"Start Over\" onclick=\"location.href='approved-zip.php'\">\n");
	print("\n");
}else{
	while($row=mysql_fetch_array($result)){
		$otsdetailID=$row['otsdetailID'];
		$qty=$row['qty'];
		$type=$row['type'];
		$price=$row['price'];
		$tot=number_format($qty*$price, 2, '.', ',');
		$tot1=$qty*$price;
		$carttot+=$tot1;
		$itemNo=$row['itemNo'];
		$productID=$row['productID'];
		$productDesc=$row['productDesc'];
		$modelNumber=$row['modelNumber'];
	print("<form method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
	print("<p class=\"body_content_style1\">");
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<p align=\"center\" class=\"body_content_style1\"><b>Your shopping cart contains the following:</b><br /><br />\n");
   	print("<b>Qty</b><br /><br /><input type=\"text\" class=\"forms7\" name=\"qty[]\" size=\"3\" value=\"".$qty."\">\n");
	print("<div><br /><input type=\"submit\" value=\"Update\" onClick=\"this.form.submit();\" class=\"btn2\">\n");
	print("<span class=\"section_heading_style1\"><b>Item</b></span>\n");
	print("<span class=\"section_heading_style1\"><b>Price</b></span>\n");
	print("<span class=\"section_heading_style1\"><b>Total</b></span>\n");
	print("<span class=\"body_content_style1\">".$productDesc."</span><span class=\"body_content_style1\">".$productDesc." ".$modelNumber."</span><span class=\"body_content_style1\">$".number_format($price, 2, '.', ',')."</span><span class=\"body_content_style1\">$".$tot."</span>\n");
}
	$totformat=number_format($carttot, 2, '.', ',');
	print("<span class=\"body_content_style1\"><b>Subtotal:</b>$".$totformat."</span>\n");
	print("<td colspan=\"3\" align=\"right\"><form method=\"post\" action=\"https://www.techniart.com/masssave/orderform.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"hidden\" name=\"ship\" value=\"".$ship."\"><input type=\"hidden\" name=\"state\" value=\"".$_SESSION["shipping"]["state"]."\"><input type=\"submit\" value=\"Checkout\" class=\"btn2\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n");
	print("</tr></form>\n");
	print("</table></form>\n");
}	?>
</div></div>
</center>
</div>
</body>
</html>


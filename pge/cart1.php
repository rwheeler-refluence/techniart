<? include("database.php"); ?>
<?
session_start();
#print($sess);#session_destroy();
#ini_set('display_errors','On');
#include("ups/utils.php");
$action=$_POST['action'];
#print("action: ".$action."<br>");
switch($action){
	case "add":
		$quantity1="";
		$_SESSION['prn']="";
		$itemNo=$_POST['productID'];
		$quantity1="";
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
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
<BODY><!-- Google Tag Manager -->
<noscript><iframesrc="//www.googletagmanager.com/ns.html?id=GTM-5R82RN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5R82RN');</script>
<!-- End Google Tag Manager -->
<center><div class="gridContainer clearfix"><div id="LayoutDiv1">
<?php include_once("header.php") ?></div>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?
$o=$_SESSION['otsID'];
$sql="select * from tblotsdetail LEFT OUTER JOIN tblProducts on tblotsdetail.itemNo=tblProducts.productID where tblotsdetail.otsID='$o'";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
	print("<div class=\"gridContainer\"><div id=\"LayoutDiv1\">");
if(!$count){
	print("<br><p align=\"center\"><b>Only 1 Simple Energy Kit may be purchased per residential address.</b></p><br />\n");
	print("<p align=\"center\" ><b>Duplicate orders may be cancelled at our discretion.</b></p>\n");
	print("<p align=\"center\"><input type=\"button\" class=\"btn1\" value=\"Start Over\" onclick=\"location.href='approved-zip.php'\">\n");
	print("</td></tr>\n");
	print("<tr><td><br></td></tr>\n");
}else{
	print("<form method=\"post\" action=\"".$PHP_SELF."\">\n");
	print("<p>");
	print("<input type=\"hidden\" name=\"action\" value=\"update\">\n");
	print("<center><b>Your shopping cart contains:</b><br /><br /></td></tr>\n");
print("<tr><td><table align=\"center\" width=\"100%\" cellpadding=\"1\" cellspacing=\"0\">\n");
	print("<tr valign=\"middle\">\n");
    print("<td align=\"center\"><span class=\"cart\"><b>Qty</b></span></td>\n");
	print("<td><span class=\"cart\"><b>Item</b></span></td>\n");
	print("<td align=\"center\"><span class=\"cart\"><b>Price</b></span></td>\n");
	print("<td align=\"center\"><span class=\"cart\"><b>Total</b></span></td>\n");
	print("</tr>\n");

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
		$modelNumber=$row['modelNumber'];}
		print("<input type=\"hidden\" name=\"otsdetailID[]\" value=\"".$otsdetailID."\">\n");
		print("<tr valign=\"middle\" bgcolor=\"cccccc\">\n");
        print("<td align=\"center\"><span class=\"cart\" >".$qty."</span></td>\n");
		print("<td><span class=\"cart\" >".$productDesc."</span></td>\n");
		print("<td align=\"center\"><span class=\"cart\" >$".number_format($price, 2, '.', ',')."</span></td>\n");
		print("<td align=\"center\"><span class=\"cart\" >$".$tot."</span></td>\n");
		print("</tr>\n");
		print("<tr>\n");
		#print("<td colspan=\"4\" align=\"right\"><br><b>Subtotal:</b>&nbsp;</td>\n");
		$totformat=number_format($carttot, 2, '.', ',');
		#Sprint("<td align=\"left\"><br><span >$".$totformat."</span></td>\n");
		print("</tr>\n");
		print("<tr>\n");
		print("<td></td>\n");
		print("<td></td>\n");
		print("<td></td>\n");
		print("<td align=\"center\"></td></form></tr>\n");
		print("<tr><td><br></td></tr>\n");
		print("<tr>\n");
		print("<td></td>\n");
 	 			print("<td></td>\n");
			print("<td></td>\n");
		print("<td align=\"center\"><form method=\"post\" action=\"https://www.techniart.com/pge/orderform1.php\"><input type=\"hidden\" name=\"otsID\" value=\"".$o."\"><input type=\"submit\" value=\"Checkout\" class=\"btn1\">");
		print("</tr>\n");
		print("<tr><td><br></td></tr>\n");
		print("</table></form>\n");
}	?>
</td>
  </tr>
</table>
<? include("footer.php");?>
</div></div>
</center>

</body>
</html>


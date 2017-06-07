<? include("database.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Techniart, Inc</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
</head>

<BODY>

<!-- ------------------------------begin header------------------------------ -->
<?php include("bluebar.php") ?><center><div class="fbwhitebox"><?php include("header.php") ?>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
<td><span class="title_main_sub"></span>&nbsp;&nbsp;</td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2">

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<? if($myspiritID){
$sql="select * from tblCSDAccess where uaccessID='$myspiritID'";
$result=db_query($sql);
#print($uaccessID);
while($row=mysql_fetch_array($result)){
		$access_company=$row['access_company'];}
		echo $access_company;} print("'s Previous Orders<br>");
		print("<div align=\"right\" style=\"padding-right:20px;\"><a class=\"body_content_style1\" href=\"dl_orders.php?vendorName=".$access_company."\">Download as *.csv</a></div>\n");?>
<?
$page=$_GET['page'];
$limitvalue=200;
if(!$page || $page==1){
	$limit=0;
}else{
	$limit=($page-1)*$limitvalue;
}
	print("<br>");
	$sql="select * from tblOrdersCompleted where access_company ='$access_company' order by completeID desc";
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if(!$count){
		print("No orders in the database<br /><br />\n");
	}else{
		
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td align=\"left\" width=\"100\"><span class=\"body_content\"><b>Order ID</b></span></td>\n");
		print("<td align=\"left\" width=\"200\"><span class=\"body_content\"><b>Ship Name</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Order Date</b></span></td>\n");
		print("<td align=\"center\" width=\"70\"><span class=\"body_content\"><b>Details</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Ship Date</b></span></td>\n");
		print("<td align=\"center\" width=\"70\"><span class=\"body_content\"><b>Tracking</b></span></td>\n");
		print("<td align=\"center\" width=\"70\"><span class=\"body_content\"><b>Print Order</span></td>\n");
		print("</tr>\n");
		
while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$ship_firstname=$row['ship_firstname'];
			$ship_lastname=$row['ship_lastname'];
			$comments=$row['comments'];
			$requestID=$row['requestID'];
			$shipTo_city=$row['shipTo_city'];
			$tracking=$row['tracking'];
			$ship_date=$row['ship_date'];
			$paymentOption=$row['paymentOption'];
			$transactionSignature=$row['transactionSignature'];
			$merchantDefinedData1=$row['merchantDefinedData1'];
			$billTo_city=$row['billTo_city'];
			$orderPage_transactionType=$row['orderPage_transactionType'];
			$billTo_state=$row['billTo_state'];
			$ccAuthReply_reasonCode=$row['ccAuthReply_reasonCode'];
			$shipTo_email=$row['shipTo_email'];
			$shipTo_postalCode=$row['shipTo_postalCode'];
			$ccAuthReply_authorizationCode=$row['ccAuthReply_authorizationCode'];
			$merchantID=$row['merchantID'];
			$card_expirationMonth=$row['card_expirationMonth'];
			$billTo_postalCode=$row['billTo_postalCode'];
			$billTo_country=$row['billTo_country'];
			$orderNumber=$row['orderNumber'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);
			print("<tr valign=\"top\" bgcolor=\"#FFFFFF\">\n");
			print("<td><span class=\"body_content\">".$completeID."</span></td>\n");
			print("<td><span class=\"body_content\">".$ship_firstname." ".$ship_lastname."</span></td>\n");
			print("<td><span class=\"body_content\">".$timestamp."</span></td>\n");
			#print("<td><span class=\"body_content\">$".$orderAmount."</span></td>\n");
#			print("<td><span class=\"body_content\">");
#			$sqlnotify="select * from tblNotify where orderID='$completeID'";
#			$resultnotify=db_query($sqlnotify);
#			while($rownotify=mysql_fetch_array($resultnotify)){
#				$stamp=strftime("%D",$rownotify['stamp']);
#				$notifyID=$rownotify['notifyID'];
#				print("You emailed this customer on ".$stamp." (<a class=\"body_content\" href=\"email.php?ID=".$notifyID."\" target=\"_new\">Read Email</a>)<br>");
#			}
#			print("<a class=\"body_content\" href=\"email_order.php?ID=".$completeID."\" target=\"_new\">Email Customer Shipping Notification</a>");
#			print("</td>\n");
			print("<td align=\"center\"><a class=\"body_content_style1\" href=\"order_detail.php?ID=".$completeID."\">More Info</span></td>\n");
			print("<td align=\"center\"><span class=\"body_content_style1\">".$ship_date."</td>\n");
			print("<td align=\"center\"><span class=\"body_content_style1\">".$tracking."</td>\n");
			print("<td align=\"center\"><span class=\"body_content\"><a class=\"body_content_style1\" href=\"print-order.php?ID=".$completeID."\" target=\"_blank\">Print<br>Order</span></td>\n");
			print("</tr>\n");
			$text1="";
		}
		print("</table>\n");
	}
?>
<span class="body_content">
<?for($i=1;$i<=$numpages;$i++){?>
<a class="body_content" href="show_daily.php?page=<? echo($i);?>">Page <? echo($i);?></a>
<? if($i==1 || $i<$numpages){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?}?>
<?}?>
</span>
<br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("footer.php"); ?>

</body>
</html>
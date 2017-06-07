<? include("database.php"); ?>
<? include("secure.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>TechniArt -- Mass Save Power Savings Pack Orders</title>

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
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main_sub">Mass Save Power Savings Pack:</span>&nbsp;&nbsp;</td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<?
$page=$_GET['page'];
$limitvalue=200;
if(!$page || $page==1){
	$limit=0;
}else{
	$limit=($page-1)*$limitvalue;
}
	print("<br>");
	$sql="select * from tblOrdersCompleted_1_24 order by completeID desc";
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if(!$count){
		print("No orders in the database<br /><br />\n");
	}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Order #</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Name</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Date</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Total</b></span></td>\n");
	#	print("<td>&nbsp;</td>\n");
		print("<td>&nbsp;</td>\n");
		print("<td>&nbsp;</td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$shipTo_state=$row['shipTo_state'];
			$billTo_lastName=$row['bill_lastname'];
			$orderCurrency_publicSignature=$row['orderCurrency_publicSignature'];
			$billTo_email=$row['billTo_email'];
			$shipTo_country=$row['shipTo_country'];
			$orderPage_serialNumber=$row['orderPage_serialNumber'];
			$ccAuthReply_avsCodeRaw=$row['ccAuthReply_avsCodeRaw'];
			$reconciliationID=$row['reconciliationID'];
			$orderAmount_publicSignature=$row['orderAmount_publicSignature'];
			$orderCurrency=$row['orderCurrency'];
			$ccAuthReply_avsCode=$row['ccAuthReply_avsCode'];
			$orderPage_requestToken=$row['orderPage_requestToken'];
			$card_expirationYear=$row['card_expirationYear'];
			$ccAuthReply_amount=$row['ccAuthReply_amount'];
			$ccAuthReply_processorResponse=$row['ccAuthReply_processorResponse'];
			$shipTo_lastName=$row['shipTo_lastName'];
			$card_accountNumber=$row['card_accountNumber'];
			$reasonCode=$row['reasonCode'];
			$decision_publicSignature=$row['decision_publicSignature'];
			$ccAuthReply_authorizedDateTime=$row['ccAuthReply_authorizedDateTime'];
			$billTo_firstName=$row['bill_firstname'];
			$orderAmount=$row['amount'];
			$y=$row['y'];
			$shipTo_street1=$row['shipTo_street1'];
			$signedFields=$row['signedFields'];
			$x=$row['x'];
			$shipTo_firstName=$row['shipTo_firstName'];
			$comments=$row['comments'];
			$requestID=$row['requestID'];
			$orderNumber_publicSignature=$row['orderNumber_publicSignature'];
			$card_cardType=$row['card_cardType'];
			$billTo_street1=$row['billTo_street1'];
			$shipTo_city=$row['shipTo_city'];
			$decision=$row['decision'];
			$paymentOption=$row['paymentOption'];
			$transactionSignature=$row['transactionSignature'];
			$merchantDefinedData1=$row['merchantDefinedData1'];
			$billTo_city=$row['billTo_city'];
			$company=$row['company'];
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
			print("<td><span class=\"body_content\">".$billTo_firstName." ".$billTo_lastName."</span></td>\n");
			print("<td><span class=\"body_content\">".$timestamp."</span></td>\n");
			print("<td><span class=\"body_content\">$".$orderAmount."</span></td>\n");
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
			print("<td><a class=\"body_content\" href=\"order_detail2.php?ID=".$completeID."\">DETAILS</span></td>\n");
            print("<td><a class=\"body_content\" href=\"order_email.php?ID=".$completeID."\" target=\"_blank\">REGENERATE ORDER EMAIL</span></td>\n");
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

<? include("body_bot.php"); ?>

</body>
</html>
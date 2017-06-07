<? include("database.php"); ?>
<? include("secure.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Techniart, Inc.</title>

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
<td><span class="title_main_sub">Order Detail:</span>&nbsp;&nbsp;</td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<a class="body_content" href="javascript:history.go(-1);"><< Back</a><br><br>
<?
$page=$_GET['page'];
$limitvalue=200;
if(!$page || $page==1){
	$limit=0;
}else{
	$limit=($page-1)*$limitvalue;
}
	print("<br>");
	$ID=$_GET['ID'];
	$sql="select * from tblOrdersCompleted where completeID='$ID'";
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if(!$count){
		print("No orders in the database<br /><br />\n");
	}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\">");
		while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$otsID=$row['otsID'];
			$shipTo_state=$row['shipTo_state'];
			$billTo_lastName=$row['bill_lastname'];
			$orderCurrency_publicSignature=$row['orderCurrency_publicSignature'];
			$billTo_email=$row['email'];
			$shipTo_country=$row['ship_country'];
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
			$shipTo_lastName=$row['ship_lastname'];
			$card_accountNumber=$row['card_accountNumber'];
			$reasonCode=$row['reasonCode'];
			$decision_publicSignature=$row['decision_publicSignature'];
			$ccAuthReply_authorizedDateTime=$row['ccAuthReply_authorizedDateTime'];
			$billTo_firstName=$row['bill_firstname'];
			$orderAmount=$row['amount'];
			$y=$row['y'];
			$coupon=$row['coupon'];
			$shipTo_street1=$row['ship_address'];
			$signedFields=$row['signedFields'];
			$x=$row['x'];
			$shipTo_firstName=$row['ship_firstname'];
			$comments=$row['instructions'];
			$requestID=$row['requestID'];
			$orderNumber_publicSignature=$row['orderNumber_publicSignature'];
			$card_cardType=$row['card_cardType'];
			$billTo_street1=$row['bill_address'];
			$shipTo_city=$row['ship_city'];
			$decision=$row['decision'];
			$paymentOption=$row['paymentOption'];
			$transactionSignature=$row['transactionSignature'];
			$merchantDefinedData1=$row['merchantDefinedData1'];
			$billTo_city=$row['bill_city'];
			$orderPage_transactionType=$row['orderPage_transactionType'];
			$billTo_state=$row['bill_state'];
			$ccAuthReply_reasonCode=$row['ccAuthReply_reasonCode'];
			$shipTo_email=$row['ship_email'];
			$shipTo_postalCode=$row['ship_zip'];
			$ccAuthReply_authorizationCode=$row['ccAuthReply_authorizationCode'];
			$merchantID=$row['merchantID'];
			$card_expirationMonth=$row['card_expirationMonth'];
			$billTo_postalCode=$row['bill_zip'];
			$ship_amt=$row['ship_amt'];
			$tax=$row['tax'];
			$billTo_country=$row['bill_country'];
			$orderNumber=$row['orderNumber'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Name</b></span></td>\n");
			print("<td><span class=\"body_content\">".$billTo_firstName." ".$billTo_lastName."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Date</b></span></td>\n");
			print("<td><span class=\"body_content\">".$timestamp."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Total</b></span></td>\n");
			print("<td><span class=\"body_content\">$".$orderAmount."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Shipping</b></span></td>\n");
			print("<td><span class=\"body_content\">$".$ship_amt."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Coupon</b></span></td>\n");
			print("<td><span class=\"body_content\">".$coupon."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Billing Address</b></span></td>\n");
			print("<td><span class=\"body_content\">".$billTo_street1." ".$billTo_street2."<br>".$billTo_city.",".$billTo_state." ".$billTo_postalCode." ".$billTo_country."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Shipping Address</b></span></td>\n");
			print("<td><span class=\"body_content\">".$shipTo_street1." ".$shipTo_street2."<br>".$shipTo_city.",".$shipTo_state." ".$shipTo_postalCode." ".$shipTo_country."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Email</b></span></td>\n");
			print("<td><span class=\"body_content\">".$billTo_email."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Comments</b></span></td>\n");
			print("<td><span class=\"body_content\">".$comments."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Order Contents</b></span></td>\n");
			print("<td><span class=\"body_content\">");
			$sql2="select * from tblotsdetail where otsID='$otsID'";
			$result2=db_query($sql2);
			$count2=mysql_num_rows($result2);
			if($count2){
				$ia=2;
				while($row2=mysql_fetch_array($result2)){
					$otsdetailID=$row2['otsdetailID'];
					$qty=$row2['qty'];
					$price=$row2['price'];
					$productDesc=$row2['productDesc'];
					$productDesc=str_replace("™", "&trade;",$productDesc);
					$sizeDesc=$row2['sizeName'];
					$sizesku=$row2['sizesku'];
					$tot=$price*$qty;
					$sumtot+=$tot;
					$extra=$row2['extra'];
					$extra_amt=$row2['extra_amt'];
					$productID=$row2['productID'];
						$spl=explode("<br>",$productDesc);
						print("Item: ");
						for($s=0;$s<count($spl);$s++){
							print("".$spl[$s]."<br>");
						}
						#print(""Size: ".$sizeDesc."\n";
						print("Qty: ".$qty."<br>");
					    print("Price: $".$price."<br>");
						print("------------------------------------------------------------------------------<br>\n");
				}
			print("Subtotal of Items: $".$sumtot."");
			}
			print("</span></td>\n");
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
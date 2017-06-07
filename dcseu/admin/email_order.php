<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$action=$_POST['action'];
if($action=='update'){
	$to=$_POST['to'];
	$ID=$_POST['ID'];
	$subject=$_POST['subject'];
	$body=$_POST['body'];
	mail($to,$subject,$body,"From:info@myspiritofgolf.com");
	$stamp=mktime();
	$sql="insert into tblNotify values ('','$ID','$to','$subject','$body','$stamp')";
	$result=db_query($sql);
	header("location: email_order.php?ID=".$ID."&msg=Email Sent");
}
$msg=$_GET['msg'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Spirit of Golf</title>

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
<td><span class="title_main_sub">Email Customer Shipping Notification:</span>&nbsp;&nbsp;</td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<a class="body_content" href="javascript:history.go(-1);"><< Back</a><br><br>
<? 
if($msg){
	print("<h2>".$msg."</h2>");
}
?>
<form method="post" action="<? echo($PHP_SELF);?>">
<?	$ID=$_GET['ID'];?>
<input type="hidden" name="action" value="update">
<input type="hidden" name="ID" value="<? echo($ID);?>">
<?
$page=$_GET['page'];
$limitvalue=200;
if(!$page || $page==1){
	$limit=0;
}else{
	$limit=($page-1)*$limitvalue;
}
	print("<br>");
	$sql="select * from tblOrdersCompleted where completeID='$ID'";
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if(!$count){
		print("No orders in the database<br /><br />\n");
	}else{
		while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$shipTo_state=$row['shipTo_state'];
			$billTo_lastName=$row['billTo_lastName'];
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
			$billTo_firstName=$row['billTo_firstName'];
			$orderAmount=$row['orderAmount'];
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
			$timestamp=strftime("%D",$row['timestamp']);			
			$to=$billTo_email;
			$from="info@myspiritofgolf.com";
			$subject="Your order has shipped";
			
			print("<span class=\"body_content\">To: ".$to."<br>");
			print("<input type=\"hidden\" name=\"to\" value=\"".$to."\">\n");
			print("<br>Subject:<br><textarea name=\"subject\" rows=\"5\" cols=\"40\">Your order from myspiritofgolf.com has shipped</textarea><br><br>\n");
			print("Message:<br><textarea name=\"body\" rows=\"35\" cols=\"60\">Dear ".$billTo_firstName.":\nWe are writing to notify you that your order from myspiritofgolf.com has been shipped.\n\nYou Ordered:\n");
			$sql2="select * from tblotsdetail where otsID='$merchantDefinedData1'";
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
						$body."Item: ";
						for($s=0;$s<count($spl);$s++){
							print("".$spl[$s]."\n");
						}
						#print(""Size: ".$sizeDesc."\n";
						print("Qty: ".$qty."\n");

						print("-------------------------------------------\n");
				}
			}
			print("Thank you for your business!\n");
			print("Spirit of Golf");
			print("</textarea><br><br>\n");
			$text1="";
		}
	}
?>
<input type="submit" value="Send Email">
</form></span>
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
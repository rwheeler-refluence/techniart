<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$vendorID=$_GET['vendorID'];
$start=strtotime($_GET['start']);
if(!$_GET['start']){
	$start=strtotime(date("m/1/Y"));
}
$end=strtotime($_GET['end']);
if(!$_GET['end']){
	$end=strtotime(date("m/d/Y"));
}
if($vendorID){
	$sql="select * from tblOrdersCompleted LEFT OUTER JOIN tblTerritory on tblTerritory.zip=tblOrdersCompleted.bill_zip LEFT OUTER JOIN tblVendors on tblTerritory.vendor=tblVendors.vendorID where tblOrdersCompleted.stamp BETWEEN '$start' AND '$end' && tblTerritory.vendor='$vendorID' order by tblOrdersCompleted.completeID desc";
#	print($sql);
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if(!$count){
	}else{
		$out.="\"Name\",\"Date\",\"Total\"\n";
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
			$out.="\"".$billTo_firstName." ".$billTo_lastName."\",\"".$timestamp."\",\"".$orderAmount."\"\n";
		}
}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=ordersbyvendor.csv");
echo $out;
exit;
	
	}

?>
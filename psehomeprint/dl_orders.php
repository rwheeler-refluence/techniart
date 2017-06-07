<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$vendorName=$_GET['vendorName'];
$start=strtotime($_GET['start']);
if(!$_GET['start']){
	$start=strtotime(date("m/1/Y"));
}
$end=strtotime($_GET['end']);
if(!$_GET['end']){
	$end=strtotime(date("m/d/Y"));
}
if($vendorName){
	$sql="select * from tblOrdersCompleted where tblOrdersCompleted.access_company='$vendorName' order by tblOrdersCompleted.completeID desc";
#	print($sql);
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if(!$count){
	}else{
		$out.="\"Date\",\"Name\",\"Address\",\"Address 2\",\"City\",\"State\",\"Zip\",\"Ship Date\",\"Tracking\",\"Received?\",\"A19\",\"Globe\",\"BR30\",\"Bath Aerator\",\"Kitchen Aerator\",\"Showerhead\",\"Handheld\",\n";
		while($row=mysql_fetch_array($result)){
			$otsID=$row['otsID'];
			$completeID=$row['completeID'];
			$shipTo_state=$row['shipTo_state'];
						$ship_firstname=$row['ship_firstname'];
			$ship_lastname=$row['ship_lastname'];
			$ship_address=$row['ship_address'];
			$ship_address2=$row['ship_address2'];
			$ship_city=$row['ship_city'];
			$ship_state=$row['ship_state'];
			$ship_zip=$row['ship_zip'];
			$status=$row['status'];
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
			$tracking=$row['tracking'];
			$ship_date=$row['ship_date'];
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
			$ENL="select qty as ENLQuantity from tblotsdetail where otsID='$otsID' && itemNo='1' && qty>'0'";
$resultENL=db_query($ENL);
$countrows=mysql_num_rows($resultENL);
if($countrows>0){
while($row=mysql_fetch_array($resultENL))
{$ENLlimit=$row['ENLQuantity']*48;}}else{
$ENLlimit='0';}

$DNL="select qty as DNLQuantity from tblotsdetail where otsID='$otsID' && itemNo='2' && qty>'0'";
$resultDNL=db_query($DNL);
$countrows=mysql_num_rows($resultDNL);
if($countrows>0){
while($row=mysql_fetch_array($resultDNL))
{$DNLlimit=$row['DNLQuantity']*24;}}else{
$DNLlimit='0';}

$Candle="select qty as CandleQuantity from tblotsdetail where otsID='$otsID' && itemNo='3' && qty>'0'";
$resultCandle=db_query($Candle);
$countrows=mysql_num_rows($resultCandle);
if($countrows>0){
while($row=mysql_fetch_array($resultCandle))
{$Candlelimit=$row['CandleQuantity']*12;}}else{
$Candlelimit='0';}

$Globe="select qty as GlobeQuantity from tblotsdetail where otsID='$otsID' && itemNo='4' && qty>'0'";
$resultGlobe=db_query($Globe);
$countrows=mysql_num_rows($resultGlobe);
if($countrows>0){
while($row=mysql_fetch_array($resultGlobe))
{$Globelimit=$row['GlobeQuantity']*50;}}else{
$Globelimit='0';}

$MR16="select qty as MR16Quantity from tblotsdetail where otsID='$otsID' && itemNo='5' && qty>'0'";
$resultMR16=db_query($MR16);
$countrows=mysql_num_rows($resultMR16);
if($countrows>0){
while($row=mysql_fetch_array($resultMR16))
{$MR16limit=$row['MR16Quantity']*25;}}else{
$MR16limit='0';}

$Threeway="select qty as ThreewayQuantity from tblotsdetail where otsID='$otsID' && itemNo='6' && qty>'0'";
$resultThreeway=db_query($Threeway);
$countrows=mysql_num_rows($resultThreeway);
if($countrows>0){
while($row=mysql_fetch_array($resultThreeway))
{$Threewaylimit=$row['ThreewayQuantity']*20;}}else{
$Threewaylimit='0';}

$BR20="select qty as BR20Quantity from tblotsdetail where otsID='$otsID' && itemNo='7' && qty>'0'";
$resultBR20=db_query($BR20);
$countrows=mysql_num_rows($resultBR20);
if($countrows>0){
while($row=mysql_fetch_array($resultBR20))
{$BR20limit=$row['BR20Quantity']*12;}}else{
$BR20limit='0';}
			
			$out.="\"".$timestamp."\",\"".$ship_firstname." ".$ship_lastname."\",\"".$ship_address."\",\"".$ship_address2."\",\"".$ship_city."\",\"".$ship_state."\",\"".$ship_zip."\",\"".$ship_date."\",\"".$tracking."\",\"".$status."\",\"".$ENLlimit."\",\"".$DNLlimit."\",\"".$Candlelimit."\",\"".$Globelimit."\",\"".$MR16limit."\",\"".$Threewaylimit."\",\"".$BR20limit."\",\n";
		}
}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename="."$vendorName"."-orders.csv");
echo $out;
exit;
	
	}

?>
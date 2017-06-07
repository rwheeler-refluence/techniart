<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$sql="select * from tblOrdersCompleted";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"Ship First Name\",\"Ship Last Name\",\"Ship Address\",\"Ship Address 2\",\"Ship City\",\"Ship State\",\"Ship Zip\",\"Instructions\",\"First Name\",\"Last Name\",\"Address\",\"Address 2\",\"City\",\"State\",\"Zip\",\"Email\",\"Phone\",\"Tax\",\"Total\",\"Kit\",\"BR30\"\n";
	while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$otsID=$row['otsID'];
			$bill_firstname=$row['bill_firstname'];
			$bill_lastname=$row['bill_lastname'];
			$bill_address=$row['bill_address'];
			$bill_address2=$row['bill_address2'];						
			$bill_city=$row['bill_city'];
			$bill_state=$row['bill_state'];
			$bill_zip=$row['bill_zip'];
			$ship_firstname=$row['ship_firstname'];
			$ship_lastname=$row['ship_lastname'];
			$ship_address=$row['ship_address'];
			$ship_address2=$row['ship_address2'];						
			$ship_city=$row['ship_city'];
			$ship_state=$row['ship_state'];
			$ship_zip=$row['ship_zip'];


			$instructions=$row['instructions'];
			$email=$row['email'];
			$phone=$row['phone'];
			$tax=$row['tax'];
			$amount=$row['amount'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);

$ENL="select qty as ENLQuantity from tblotsdetail where otsID='$otsID' && itemNo='1' && qty>'0'";
$resultENL=db_query($ENL);
$countrows=mysql_num_rows($resultENL);
if($countrows>0){
while($row=mysql_fetch_array($resultENL))
{$ENLlimit=$row['ENLQuantity'];}}else{
$ENLlimit='0';}

$DNL="select qty as DNLQuantity from tblotsdetail where otsID='$otsID' && itemNo='2' && qty>'0'";
$resultDNL=db_query($DNL);
$countrows=mysql_num_rows($resultDNL);
if($countrows>0){
while($row=mysql_fetch_array($resultDNL))
{$DNLlimit=$row['DNLQuantity'];}}else{
$DNLlimit='0';}

$Candle="select qty as CandleQuantity from tblotsdetail where otsID='$otsID' && itemNo='3' && qty>'0'";
$resultCandle=db_query($Candle);
$countrows=mysql_num_rows($resultCandle);
if($countrows>0){
while($row=mysql_fetch_array($resultCandle))
{$Candlelimit=$row['CandleQuantity'];}}else{
$Candlelimit='0';}



#print $combolimit;
		$out.="\"".$completeID."\",\"".$timestamp."\",\"".$ship_firstname."\",\"".$ship_lastname."\",\"".$ship_address."\",\"".$ship_address2."\",\"".$ship_city."\",\"".$ship_state."\",\"".$ship_zip."\",\"".$instructions."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$email."\",\"".$phone."\",\"".$tax."\",\"".$amount."\",\"".$ENLlimit."\",\"".$DNLlimit."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=PGEM-Orders.csv");
echo $out;
exit;
?>

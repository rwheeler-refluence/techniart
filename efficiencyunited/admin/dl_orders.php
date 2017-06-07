<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$discount=25;
$sql="select * from tblOrdersCompleted";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"First Name\",\"Last Name\",\"Address\",\"Address 2\",\"City\",\"State\",\"Zip\",\"Instructions\",\"Ship First Name\",\"Ship Last Name\",\"Ship Address\",\"Ship Address 2\",\"Ship City\",\"Ship State\",\"Ship Zip\",\"Email\",\"Phone\",\"Total\",\"How did you hear?\",\"Future Contact?\",\"Vendor\",\"LED7A19DOD27K\",\"LED10A19DOD27K\",\"LED10A19DOD27K6\",\"LED13A21DOD27K\",\"LED18A21DOD27K\",\"LED10BR30D27K\",\"LED10DR427K\",\"LED12DR5627K\"\n";
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
			$ship_zip=$row['ship_zip'];
			$instructions=$row['instructions'];
			$email=$row['email'];
			$phone=$row['phone'];
			$promo=$row['promo'];
			$amount=$row['amount'];
			$hear=$row['ship_country'];
			$contact=$row['bill_country'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);

$ENL="select qty as ENLQuantity from tblotsdetail where otsID='$otsID' && itemNo='1' && qty>'0'";
$resultENL=db_query($ENL);
$countrows=mysql_num_rows($resultENL);
if($countrows>0){
while($row=mysql_fetch_array($resultENL))
{$ENLlimit=$row['ENLQuantity'];}}else{
$ENLlimit='';}

$DNL="select qty as DNLQuantity from tblotsdetail where otsID='$otsID' && itemNo='2' && qty>'0'";
$resultDNL=db_query($DNL);
$countrows=mysql_num_rows($resultDNL);
if($countrows>0){
while($row=mysql_fetch_array($resultDNL))
{$DNLlimit=$row['DNLQuantity'];}}else{
$DNLlimit='';}

$Globe="select qty as GlobeQuantity from tblotsdetail where otsID='$otsID' && itemNo='4' && qty>'0'";
$resultGlobe=db_query($Globe);
$countrows=mysql_num_rows($resultGlobe);
if($countrows>0){
while($row=mysql_fetch_array($resultGlobe))
{$Globelimit=$row['GlobeQuantity'];}}else{
$Globelimit='';}

$MR16="select qty as MR16Quantity from tblotsdetail where otsID='$otsID' && itemNo='5' && qty>'0'";
$resultMR16=db_query($MR16);
$countrows=mysql_num_rows($resultMR16);
if($countrows>0){
while($row=mysql_fetch_array($resultMR16))
{$MR16limit=$row['MR16Quantity'];}}else{
$MR16limit='';}

$Threeway="select qty as ThreewayQuantity from tblotsdetail where otsID='$otsID' && itemNo='6' && qty>'0'";
$resultThreeway=db_query($Threeway);
$countrows=mysql_num_rows($resultThreeway);
if($countrows>0){
while($row=mysql_fetch_array($resultThreeway))
{$Threewaylimit=$row['ThreewayQuantity'];}}else{
$Threewaylimit='';}

$BR20="select qty as BR20Quantity from tblotsdetail where otsID='$otsID' && itemNo='7' && qty>'0'";
$resultBR20=db_query($BR20);
$countrows=mysql_num_rows($resultBR20);
if($countrows>0){
while($row=mysql_fetch_array($resultBR20))
{$BR20limit=$row['BR20Quantity'];}}else{
$BR20limit='';}

$BR30="select qty as BR30Quantity from tblotsdetail where otsID='$otsID' && itemNo='8' && qty>'0'";
$resultBR30=db_query($BR30);
$countrows=mysql_num_rows($resultBR30);
if($countrows>0){
while($row=mysql_fetch_array($resultBR30))
{$BR30limit=$row['BR30Quantity'];}}else{
$BR30limit='';}

$BR40="select qty as BR40Quantity from tblotsdetail where otsID='$otsID' && itemNo='9' && qty>'0'";
$resultBR40=db_query($BR40);
$countrows=mysql_num_rows($resultBR40);
if($countrows>0){
while($row=mysql_fetch_array($resultBR40))
{$BR40limit=$row['BR40Quantity'];}}else{
$BR40limit='';}
$sqlv="select name from tblTerritory where zip=".$ship_zip."";
			$resultv=db_query($sqlv);
			while($row=mysql_fetch_array($resultv)){
			$vendor=$row['name'];}

#print $combolimit;
		$out.="\"".$completeID."\",\"".$timestamp."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$instructions."\",\"".$ship_firstname."\",\"".$ship_lastname."\",\"".$ship_address."\",\"".$ship_address2."\",\"".$ship_city."\",\"".$ship_state."\",\"".$ship_zip."\",\"".$email."\",\"".$phone."\",\"".$amount."\",\"".$hear."\",\"".$contact."\",\"".$vendor."\",\"".$ENLlimit."\",\"".$DNLlimit."\",\"".$Globelimit."\",\"".$MR16limit."\",\"".$Threewaylimit."\",\"".$BR20limit."\",\"".$BR30limit."\",\"".$BR40limit."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=EU-Orders.csv");
echo $out;
exit;
?>

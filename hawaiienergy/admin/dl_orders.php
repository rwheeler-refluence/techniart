<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$sql="select * from tblOrdersCompleted";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"Ship First Name\",\"Ship Last Name\",\"Ship Address\",\"Ship Address 2\",\"Ship City\",\"Ship State\",\"Ship Zip\",\"Instructions\",\"First Name\",\"Last Name\",\"Address\",\"Address 2\",\"City\",\"State\",\"Zip\",\"Email\",\"Tax\",\"Total\",\"60w A19\",\"60w A19 4-pack\",\"65w BR30\",\"65w BR30 4-pack\",\"Globe\",\"Globe 3-pack\",\"Bath Aerator\",\"Kitchen Aerator\",\"Evolve Showerhead\",\"T1 Trickle\",\"T2 Trickle\"\n";
	while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$otsID=$row['otsID'];
			$ship_firstname=$row['ship_firstname'];
			$ship_lastname=$row['ship_lastname'];
			$ship_address=$row['ship_address'];
			$ship_address2=$row['ship_address2'];
			$ship_city=$row['ship_city'];
			$ship_state=$row['ship_state'];
			$ship_zip=$row['ship_zip'];
			$bill_firstname=$row['bill_firstname'];
			$bill_lastname=$row['bill_lastname'];
			$bill_address=$row['bill_address'];
			$bill_address2=$row['bill_address2'];						
			$bill_city=$row['bill_city'];
			$bill_state=$row['bill_state'];
			$bill_zip=$row['bill_zip'];
			$ship_country=$row['ship_country'];
			$bill_zip=$row['bill_zip'];
			$instructions=$row['instructions'];
			$email=$row['email'];
			$shipping=$row['shipping'];
			$tax=$row['tax'];
			$amount=$row['amount'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);

$Candle="select qty as CandleQuantity from tblotsdetail where otsID='$otsID' && itemNo='1' && qty>'0'";
$resultCandle=db_query($Candle);
$countrows=mysql_num_rows($resultCandle);
if($countrows>0){
while($row=mysql_fetch_array($resultCandle))
{$Candlelimit=$row['CandleQuantity'];}}else{
$Candlelimit='0';}

$Globe="select qty as GlobeQuantity from tblotsdetail where otsID='$otsID' && itemNo='2' && qty>'0'";
$resultGlobe=db_query($Globe);
$countrows=mysql_num_rows($resultGlobe);
if($countrows>0){
while($row=mysql_fetch_array($resultGlobe))
{$Globelimit=$row['GlobeQuantity'];}}else{
$Globelimit='0';}

$Threeway="select qty as ThreewayQuantity from tblotsdetail where otsID='$otsID' && itemNo='3' && qty>'0'";
$resultThreeway=db_query($Threeway);
$countrows=mysql_num_rows($resultThreeway);
if($countrows>0){
while($row=mysql_fetch_array($resultThreeway))
{$Threewaylimit=$row['ThreewayQuantity'];}}else{
$Threewaylimit='0';}

$BR20="select qty as BR20Quantity from tblotsdetail where otsID='$otsID' && itemNo='4' && qty>'0'";
$resultBR20=db_query($BR20);
$countrows=mysql_num_rows($resultBR20);
if($countrows>0){
while($row=mysql_fetch_array($resultBR20))
{$BR20limit=$row['BR20Quantity'];}}else{
$BR20limit='0';}

$BR30="select qty as BR30Quantity from tblotsdetail where otsID='$otsID' && itemNo='5' && qty>'0'";
$resultBR30=db_query($BR30);
$countrows=mysql_num_rows($resultBR30);
if($countrows>0){
while($row=mysql_fetch_array($resultBR30))
{$BR30limit=$row['BR30Quantity'];}}else{
$BR30limit='0';}

$BR40="select qty as BR40Quantity from tblotsdetail where otsID='$otsID' && itemNo='6' && qty>'0'";
$resultBR40=db_query($BR40);
$countrows=mysql_num_rows($resultBR40);
if($countrows>0){
while($row=mysql_fetch_array($resultBR40))
{$BR40limit=$row['BR40Quantity'];}}else{
$BR40limit='0';}

$Par38="select qty as Par38Quantity from tblotsdetail where otsID='$otsID' && itemNo='9' && qty>'0'";
$resultPar38=db_query($Par38);
$countrows=mysql_num_rows($resultPar38);
if($countrows>0){
while($row=mysql_fetch_array($resultPar38))
{$Par38limit=$row['Par38Quantity'];}}else{
$Par38limit='0';}

$Four="select qty as FourQuantity from tblotsdetail where otsID='$otsID' && itemNo='10' && qty>'0'";
$resultFour=db_query($Four);
$countrows=mysql_num_rows($resultFour);
if($countrows>0){
while($row=mysql_fetch_array($resultFour))
{$Fourlimit=$row['FourQuantity'];}}else{
$Fourlimit='0';}

$Six="select qty as SixQuantity from tblotsdetail where otsID='$otsID' && itemNo='11' && qty>'0'";
$resultSix=db_query($Six);
$countrows=mysql_num_rows($resultSix);
if($countrows>0){
while($row=mysql_fetch_array($resultSix))
{$Sixlimit=$row['SixQuantity'];}}else{
$Sixlimit='0';}

$Tiff="select qty as TiffQuantity from tblotsdetail where otsID='$otsID' && itemNo='13' && qty>'0'";
$resultTiff=db_query($Tiff);
$countrows=mysql_num_rows($resultTiff);
if($countrows>0){
while($row=mysql_fetch_array($resultTiff))
{$Tifflimit=$row['TiffQuantity'];}}else{
$Tifflimit='0';}

$WID="select qty as WIDQuantity from tblotsdetail where otsID='$otsID' && itemNo='14' && qty>'0'";
$resultWID=db_query($WID);
$countrows=mysql_num_rows($resultWID);
if($countrows>0){
while($row=mysql_fetch_array($resultWID))
{$WIDlimit=$row['WIDQuantity'];}}else{
$WIDlimit='0';}





#print $combolimit;
		$out.="\"".$completeID."\",\"".$timestamp."\",\"".$ship_firstname."\",\"".$ship_lastname."\",\"".$ship_address."\",\"".$ship_address2."\",\"".$ship_city."\",\"".$ship_state."\",\"".$ship_zip."\",\"".$instructions."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$email."\",\"".$shipping."\",\"".$amount."\",\"".$Candlelimit."\",\"".$Globelimit."\",\"".$Threewaylimit."\",\"".$BR20limit."\",\"".$BR30limit."\",\"".$BR40limit."\",\"".$Par38limit."\",\"".$Fourlimit."\",\"".$Sixlimit."\",\"".$Tifflimit."\",\"".$WIDlimit."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=HI-Store-Orders.csv");
echo $out;
exit;
?>

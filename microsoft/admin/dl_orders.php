<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$sql="select * from tblOrdersCompleted_pse";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"First Name\",\"Last Name\",\"Address\",\"Address 2\",\"City\",\"State\",\"Zip\",\"Office\",\"Mailstop\",\"Instructions\",\"Email\",\"Phone\",\"Tax\",\"Total\",\"Combo\",\"75w A19\",\"100w A19\",\"Candle\",\"Globe\",\"R20\",\"BR30 6-pack\",\"BR40\",\"Par38\",\"4 inch can\",\"6 inch can\",\"Ladybug\",\"Roadrunner\",\"Tricklestrip\",\"T2 Trickle\",\"Emberplug\",\"DNL\",\"DNL 2pack\",\"Black Lamp\",\"White Lamp\"\n";
	while($row=mysql_fetch_array($result)){
			$cpseompleteID=$row['completeID'];
			$otsID=$row['otsID'];
			$bill_firstname=$row['bill_firstname'];
			$bill_lastname=$row['bill_lastname'];
			$bill_address=$row['bill_address'];
			$bill_address2=$row['bill_address2'];						
			$bill_city=$row['bill_city'];
			$bill_state=$row['bill_state'];
			$bill_zip=$row['bill_zip'];
			$ship_country=$row['ship_country'];
			$bill_country=$row['bill_country'];
			$bill_zip=$row['bill_zip'];
			$instructions=$row['instructions'];
			$email=$row['email'];
			$phone=$row['phone'];
			$tax=$row['tax'];
			$amount=$row['amount'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);

$Combo="select qty as ComboQuantity from tblotsdetail_pse where otsID='$otsID' && itemNo='242' && qty>'0'";
$resultCombo=db_query($Combo);
$countrows=mysql_num_rows($resultCombo);
if($countrows>0){
while($row=mysql_fetch_array($resultCombo))
{$Combolimit=$row['ComboQuantity'];}}else{
$Combolimit='0';}

$SevenFive="select qty as SevenFiveQuantity from tblotsdetail_pse where otsID='$otsID' && itemNo='1' && qty>'0'";
$resultSevenFive=db_query($SevenFive);
$countrows=mysql_num_rows($resultSevenFive);
if($countrows>0){
while($row=mysql_fetch_array($resultSevenFive))
{$SevenFivelimit=$row['SevenFiveQuantity'];}}else{
$SevenFivelimit='0';}

$One="select qty as OneQuantity from tblotsdetail_pse where otsID='$otsID' && itemNo='2' && qty>'0'";
$resultOne=db_query($One);
$countrows=mysql_num_rows($resultOne);
if($countrows>0){
while($row=mysql_fetch_array($resultOne))
{$Onelimit=$row['OneQuantity'];}}else{
$Onelimit='0';}

$Candle="select qty as CandleQuantity from tblotsdetail_pse where otsID='$otsID' && itemNo='3' && qty>'0'";
$resultCandle=db_query($Candle);
$countrows=mysql_num_rows($resultCandle);
if($countrows>0){
while($row=mysql_fetch_array($resultCandle))
{$Candlelimit=$row['CandleQuantity'];}}else{
$Candlelimit='0';}

$Globe="select qty as GlobeQuantity from tblotsdetail_pse where otsID='$otsID' && itemNo='4' && qty>'0'";
$resultGlobe=db_query($Globe);
$countrows=mysql_num_rows($resultGlobe);
if($countrows>0){
while($row=mysql_fetch_array($resultGlobe))
{$Globelimit=$row['GlobeQuantity'];}}else{
$Globelimit='0';}


$TrickleT2="select qty as TrickleT2Quantity from tblotsdetail_pse where otsID='$otsID' && itemNo='14' && qty>'0'";
$resultTrickleT2=db_query($TrickleT2);
$countrows=mysql_num_rows($resultTrickleT2);
if($countrows>0){
while($row=mysql_fetch_array($resultTrickleT2))
{$TrickleT2limit=$row['TrickleT2Quantity'];}}else{
$TrickleT2limit='0';}


$Black="select qty as BlackQuantity from tblotsdetail_pse where otsID='$otsID' && itemNo='242' && qty>'0'";
$resultBlack=db_query($Black);
$countrows=mysql_num_rows($resultBlack);
if($countrows>0){
while($row=mysql_fetch_array($resultBlack))
{$Blacklimit=$row['BlackQuantity'];}}else{
$Blacklimit='0';}

$White="select qty as WhiteQuantity from tblotsdetail_pse where otsID='$otsID' && itemNo='243' && qty>'0'";
$resultWhite=db_query($White);
$countrows=mysql_num_rows($resultWhite);
if($countrows>0){
while($row=mysql_fetch_array($resultWhite))
{$Whitelimit=$row['WhiteQuantity'];}}else{
$Whitelimit='0';}

#print $combolimit;	
		$out.="\"".$completeID."\",\"".$timestamp."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$ship_country."\",\"".$bill_country."\",\"".$instructions."\",\"".$email."\",\"".$phone."\",\"".$tax."\",\"".$amount."\",\"".$SevenFivelimit."\",\"".$Onelimit."\",\"".$Candlelimit."\",\"".$Globelimit."\",\"".$TrickleT2limit."\",\"".$Blacklimit."\",\"".$Whitelimit."\",\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=pse-Orders.csv");
echo $out;
exit;
?>
	
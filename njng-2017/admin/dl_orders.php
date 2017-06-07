<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$sql="select * from tblOrdersCompleted";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"First Name\",\"Last Name\",\"Address\",\"Address 2\",\"City\",\"State\",\"Zip\",\"Order Pick-Up Location\",\"Instructions\",\"Email\",\"Phone\",\"Tax\",\"Total\",\"WW Combo\",\"CW Combo\",\"Candle\",\"Globe\",\"BR30WW\",\"BR30CW\",\"75w WW\",\"75w DL\",\"100w WW\",\"100 DL\",\"3way\",\"R20\",\"BR40\",\"Par38\",\"4 inch\",\"6 inch\",\"Trickle\",\"EmberStrip\",\"Emergency NL\",\"DNL\"\n";
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
			$ship_country=$row['ship_country'];
			$bill_zip=$row['bill_zip'];
			$instructions=$row['instructions'];
			$email=$row['email'];
			$phone=$row['phone'];
			$tax=$row['tax'];
			$amount=$row['amount'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);

$a7527k="select qty as a7527kQuantity from tblotsdetail where otsID='$otsID' && itemNo='1' && qty>'0'";
$resulta7527k=db_query($a7527k);
$countrows=mysql_num_rows($resulta7527k);
if($countrows>0){
while($row=mysql_fetch_array($resulta7527k))
{$a7527klimit=$row['a7527kQuantity'];}}else{
$a7527klimit='0';}
		
$a7550k="select qty as a7550kQuantity from tblotsdetail where otsID='$otsID' && itemNo='2' && qty>'0'";
$resulta7550k=db_query($a7550k);
$countrows=mysql_num_rows($resulta7550k);
if($countrows>0){
while($row=mysql_fetch_array($resulta7550k))
{$a7550klimit=$row['a7550kQuantity'];}}else{
$a7550klimit='0';}	
		
$a10027k="select qty as a10027kQuantity from tblotsdetail where otsID='$otsID' && itemNo='3' && qty>'0'";
$resulta10027k=db_query($a10027k);
$countrows=mysql_num_rows($resulta10027k);
if($countrows>0){
while($row=mysql_fetch_array($resulta10027k))
{$a10027klimit=$row['a10027kQuantity'];}}else{
$a10027klimit='0';}
		
$a10050k="select qty as a10050kQuantity from tblotsdetail where otsID='$otsID' && itemNo='4' && qty>'0'";
$resulta10050k=db_query($a10050k);
$countrows=mysql_num_rows($resulta10050k);
if($countrows>0){
while($row=mysql_fetch_array($resulta10050k))
{$a10050klimit=$row['a10050kQuantity'];}}else{
$a10050klimit='0';}				
		
		$Threeway="select qty as ThreewayQuantity from tblotsdetail where otsID='$otsID' && itemNo='5' && qty>'0'";
$resultThreeway=db_query($Threeway);
$countrows=mysql_num_rows($resultThreeway);
if($countrows>0){
while($row=mysql_fetch_array($resultThreeway))
{$Threewaylimit=$row['ThreewayQuantity'];}}else{
$Threewaylimit='0';}
		
		$BR20="select qty as BR20Quantity from tblotsdetail where otsID='$otsID' && itemNo='6' && qty>'0'";
$resultBR20=db_query($BR20);
$countrows=mysql_num_rows($resultBR20);
if($countrows>0){
while($row=mysql_fetch_array($resultBR20))
{$BR20limit=$row['BR20Quantity'];}}else{
$BR20limit='0';}

		$BR40="select qty as BR40Quantity from tblotsdetail where otsID='$otsID' && itemNo='7' && qty>'0'";
$resultBR40=db_query($BR40);
$countrows=mysql_num_rows($resultBR40);
if($countrows>0){
while($row=mysql_fetch_array($resultBR40))
{$BR40limit=$row['BR40Quantity'];}}else{
$BR40limit='0';}
		
		$Par38="select qty as Par38Quantity from tblotsdetail where otsID='$otsID' && itemNo='8' && qty>'0'";
$resultPar38=db_query($Par38);
$countrows=mysql_num_rows($resultPar38);
if($countrows>0){
while($row=mysql_fetch_array($resultPar38))
{$Par38limit=$row['Par38Quantity'];}}else{
$Par38limit='0';}		

		$Four="select qty as FourQuantity from tblotsdetail where otsID='$otsID' && itemNo='9' && qty>'0'";
$resultFour=db_query($Four);
$countrows=mysql_num_rows($resultFour);
if($countrows>0){
while($row=mysql_fetch_array($resultFour))
{$Fourlimit=$row['FourQuantity'];}}else{
$Fourlimit='0';}	
		
		$Six="select qty as SixQuantity from tblotsdetail where otsID='$otsID' && itemNo='10' && qty>'0'";
$resultSix=db_query($Six);
$countrows=mysql_num_rows($resultSix);
if($countrows>0){
while($row=mysql_fetch_array($resultSix))
{$Sixlimit=$row['SixQuantity'];}}else{
$Sixlimit='0';}	
		
		$Trickle="select qty as TrickleQuantity from tblotsdetail where otsID='$otsID' && itemNo='18' && qty>'0'";
$resultTrickle=db_query($Trickle);
$countrows=mysql_num_rows($resultTrickle);
if($countrows>0){
while($row=mysql_fetch_array($resultTrickle))
{$Tricklelimit=$row['TrickleQuantity'];}}else{
$Tricklelimit='0';}		
		
		$Ember="select qty as EmberQuantity from tblotsdetail where otsID='$otsID' && itemNo='19' && qty>'0'";
$resultEmber=db_query($Ember);
$countrows=mysql_num_rows($resultEmber);
if($countrows>0){
while($row=mysql_fetch_array($resultEmber))
{$Emberlimit=$row['EmberQuantity'];}}else{
$Emberlimit='0';}		
		
		$ENL="select qty as ENLQuantity from tblotsdetail where otsID='$otsID' && itemNo='21' && qty>'0'";
$resultENL=db_query($ENL);
$countrows=mysql_num_rows($resultENL);
if($countrows>0){
while($row=mysql_fetch_array($resultENL))
{$ENLlimit=$row['ENLQuantity'];}}else{
$ENLlimit='0';}
		
		$DNL="select qty as DNLQuantity from tblotsdetail where otsID='$otsID' && itemNo='22' && qty>'0'";
$resultDNL=db_query($DNL);
$countrows=mysql_num_rows($resultDNL);
if($countrows>0){
while($row=mysql_fetch_array($resultDNL))
{$DNLlimit=$row['DNLQuantity'];}}else{
$DNLlimit='0';}		
		
		$WWCombo="select qty as WWComboQuantity from tblotsdetail where otsID='$otsID' && itemNo='30' && qty>'0'";
$resultWWCombo=db_query($WWCombo);
$countrows=mysql_num_rows($resultWWCombo);
if($countrows>0){
while($row=mysql_fetch_array($resultWWCombo))
{$WWCombolimit=$row['WWComboQuantity'];}}else{
$WWCombolimit='0';}		
		
		$CWCombo="select qty as CWComboQuantity from tblotsdetail where otsID='$otsID' && itemNo='31' && qty>'0'";
$resultCWCombo=db_query($CWCombo);
$countrows=mysql_num_rows($resultCWCombo);
if($countrows>0){
while($row=mysql_fetch_array($resultCWCombo))
{$CWCombolimit=$row['CWComboQuantity'];}}else{
$CWCombolimit='0';}		

				$Globe="select qty as GlobeQuantity from tblotsdetail where otsID='$otsID' && itemNo='32' && qty>'0'";
$resultGlobe=db_query($Globe);
$countrows=mysql_num_rows($resultGlobe);
if($countrows>0){
while($row=mysql_fetch_array($resultGlobe))
{$Globelimit=$row['GlobeQuantity'];}}else{
$Globelimit='0';}	
		
				$Candle="select qty as CandleQuantity from tblotsdetail where otsID='$otsID' && itemNo='33' && qty>'0'";
$resultCandle=db_query($Candle);
$countrows=mysql_num_rows($resultCandle);
if($countrows>0){
while($row=mysql_fetch_array($resultCandle))
{$Candlelimit=$row['CandleQuantity'];}}else{
$Candlelimit='0';}	
		
						$BR30WW="select qty as BR30WWQuantity from tblotsdetail where otsID='$otsID' && itemNo='34' && qty>'0'";
$resultBR30WW=db_query($BR30WW);
$countrows=mysql_num_rows($resultBR30WW);
if($countrows>0){
while($row=mysql_fetch_array($resultBR30WW))
{$BR30WWlimit=$row['BR30WWQuantity'];}}else{
$BR30WWlimit='0';}		
		
						$BR30CW="select qty as BR30CWQuantity from tblotsdetail where otsID='$otsID' && itemNo='35' && qty>'0'";
$resultBR30CW=db_query($BR30CW);
$countrows=mysql_num_rows($resultBR30CW);
if($countrows>0){
while($row=mysql_fetch_array($resultBR30CW))
{$BR30CWlimit=$row['BR30CWQuantity'];}}else{
$BR30CWlimit='0';}		
		
#print $combolimit;
		$out.="\"".$completeID."\",\"".$timestamp."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$ship_country."\",\"".$instructions."\",\"".$email."\",\"".$phone."\",\"".$tax."\",\"".$amount."\",\"".$WWCombolimit."\",\"".$CWCombolimit."\",\"".$Candlelimit."\",\"".$Globelimit."\",\"".$BR30WWlimit."\",\"".$BR30CWlimit."\",\"".$a7527klimit."\",\"".$a7550klimit."\",\"".$a10027klimit."\",\"".$a10050klimit."\",\"".$Threewaylimit."\",\"".$BR20limit."\",\"".$BR40limit."\",\"".$Par38limit."\",\"".$Fourlimit."\",\"".$Sixlimit."\",\"".$Tricklelimit."\",\"".$Emberlimit."\",\"".$ENLlimit."\",\"".$DNLlimit."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=NJNG-Orders.csv");
echo $out;
exit;
?>

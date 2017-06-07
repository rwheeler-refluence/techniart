<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$sql="select * from tblOrdersCompleted_1";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"Ship First\",\"Ship Last\",\"Ship Address\",\"Ship Address 2\",\"Ship City\",\"Ship State\",\"Ship Zip\",\"Instructions\",\"Bill First\",\"Bill Last\",\"Bill Address\",\"Bill Address 2\",\"Bill City\",\"Bill State\",\"Bill Zip\",\"Subtotal\",\"Ship\",\"Total\",\"Email\",\"Earth 100w\",\"Earth 100w 6pk\",\"Earth 3way\",\"Earth E12 Candle\",\"Earth E12 Candle 6pk\",\"TCP E12 Candle\",\"TCP E12 Candle 6pk\",\"TCP E26 Candle\",\"TCP E26 Candle 6pk\",\"60w Earth Globe\",\"60w Earth Globe 6pk\",\"Earth R20\",\"Earth BR30\",\"Earth BR30 6pk\",\"Earth BR40\",\"Earth Par38\",\"Black Desk\",\"White Desk\"\n";
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
			$email=$row['email'];
			$ship=$row['ship'];
			$amount=$row['amount'];
			$instructions=$row['instructions'];
		$subtotal=$amount-$ship;
			$timestamp=$row['stamp'];
			$str=date('d-m-Y H:i:s',$timestamp);
			
$EB100w="select qty as EB100wQuantity from tblotsdetail_1 where otsID='$otsID' && itemNo='3' && qty>'0'";
$resultEB100w=db_query($EB100w);
$countrows=mysql_num_rows($resultEB100w);
if($countrows>0){
while($row=mysql_fetch_array($resultEB100w))
{$EB100wlimit=$row['EB100wQuantity'];}}else{
$EB100wlimit='0';}	
		
$EB100w6="select qty as EB100w6Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='6' && qty>'0'";
$resultEB100w6=db_query($EB100w6);
$countrows=mysql_num_rows($resultEB100w6);
if($countrows>0){
while($row=mysql_fetch_array($resultEB100w6))
{$EB100w6limit=$row['EB100w6Quantity']*6;}}else{
$EB100w6limit='0';}
		
$eb3way="select qty as eb3wayQuantity from tblotsdetail_1 where otsID='$otsID' && itemNo='4' && qty>'0'";
$resulteb3way=db_query($eb3way);
$countrows=mysql_num_rows($resulteb3way);
if($countrows>0){
while($row=mysql_fetch_array($resulteb3way))
{$eb3waylimit=$row['eb3wayQuantity'];}}else{
$eb3waylimit='0';}				
		
		$ebe12="select qty as ebe12Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='7' && qty>'0'";
$resultebe12=db_query($ebe12);
$countrows=mysql_num_rows($resultebe12);
if($countrows>0){
while($row=mysql_fetch_array($resultebe12))
{$ebe12limit=$row['ebe12Quantity'];}}else{
$ebe12limit='0';}
		
		$ebe126="select qty as ebe126Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='14' && qty>'0'";
$resultebe126=db_query($ebe126);
$countrows=mysql_num_rows($resultebe126);
if($countrows>0){
while($row=mysql_fetch_array($resultebe126))
{$ebe126limit=$row['ebe126Quantity']*6;}}else{
$ebe126limit='0';}

		$tcpe12="select qty as tcpe12Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='9' && qty>'0'";
$resulttcpe12=db_query($tcpe12);
$countrows=mysql_num_rows($resulttcpe12);
if($countrows>0){
while($row=mysql_fetch_array($resulttcpe12))
{$tcpe12limit=$row['tcpe12Quantity'];}}else{
$tcpe12limit='0';}
		
		$tcpe126="select qty as tcpe126Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='16' && qty>'0'";
$resulttcpe126=db_query($tcpe126);
$countrows=mysql_num_rows($resulttcpe126);
if($countrows>0){
while($row=mysql_fetch_array($resulttcpe126))
{$tcpe126limit=$row['tcpe126Quantity']*6;}}else{
$tcpe126limit='0';}		
				$tcpe26="select qty as tcpe26Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='10' && qty>'0'";
$resulttcpe26=db_query($tcpe26);
$countrows=mysql_num_rows($resulttcpe26);
if($countrows>0){
while($row=mysql_fetch_array($resulttcpe26))
{$tcpe26limit=$row['tcpe26Quantity'];}}else{
$tcpe26limit='0';}
		
		$tcpe266="select qty as tcpe266Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='17' && qty>'0'";
$resulttcpe266=db_query($tcpe266);
$countrows=mysql_num_rows($resulttcpe266);
if($countrows>0){
while($row=mysql_fetch_array($resulttcpe266))
{$tcpe266limit=$row['tcpe266Quantity']*6;}}else{
$tcpe266limit='0';}	

		$ebglobe="select qty as ebglobeQuantity from tblotsdetail_1 where otsID='$otsID' && itemNo='12' && qty>'0'";
$resultebglobe=db_query($ebglobe);
$countrows=mysql_num_rows($resultebglobe);
if($countrows>0){
while($row=mysql_fetch_array($resultebglobe))
{$ebglobelimit=$row['ebglobeQuantity'];}}else{
$ebglobelimit='0';}	
		
		$ebglobe6="select qty as ebglobe6Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='18' && qty>'0'";
$resultebglobe6=db_query($ebglobe6);
$countrows=mysql_num_rows($resultebglobe6);
if($countrows>0){
while($row=mysql_fetch_array($resultebglobe6))
{$ebglobe6limit=$row['ebglobe6Quantity']*6;}}else{
$ebglobe6limit='0';}	
		
		$r20="select qty as r20Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='19' && qty>'0'";
$resultr20=db_query($r20);
$countrows=mysql_num_rows($resultr20);
if($countrows>0){
while($row=mysql_fetch_array($resultr20))
{$r20limit=$row['r20Quantity'];}}else{
$r20limit='0';}		
		
		$ebbr30="select qty as ebbr30Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='21' && qty>'0'";
$resultebbr30=db_query($ebbr30);
$countrows=mysql_num_rows($resultebbr30);
if($countrows>0){
while($row=mysql_fetch_array($resultebbr30))
{$ebbr30limit=$row['ebbr30Quantity'];}}else{
$ebbr30limit='0';}		
		
		$ebbr306="select qty as ebbr306Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='29' && qty>'0'";
$resultebbr306=db_query($ebbr306);
$countrows=mysql_num_rows($resultebbr306);
if($countrows>0){
while($row=mysql_fetch_array($resultebbr306))
{$ebbr306limit=$row['ebbr306Quantity']*6;}}else{
$ebbr306limit='0';}
		
		$ebbr40="select qty as ebbr40Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='24' && qty>'0'";
$resultebbr40=db_query($ebbr40);
$countrows=mysql_num_rows($resultebbr40);
if($countrows>0){
while($row=mysql_fetch_array($resultebbr40))
{$ebbr40limit=$row['ebbr40Quantity'];}}else{
$ebbr40limit='0';}		
		
		$par38="select qty as par38Quantity from tblotsdetail_1 where otsID='$otsID' && itemNo='28' && qty>'0'";
$resultpar38=db_query($par38);
$countrows=mysql_num_rows($resultpar38);
if($countrows>0){
while($row=mysql_fetch_array($resultpar38))
{$par38limit=$row['par38Quantity'];}}else{
$par38limit='0';}		
		
		$black="select qty as blackQuantity from tblotsdetail_1 where otsID='$otsID' && itemNo='32' && qty>'0'";
$resultblack=db_query($black);
$countrows=mysql_num_rows($resultblack);
if($countrows>0){
while($row=mysql_fetch_array($resultblack))
{$blacklimit=$row['blackQuantity'];}}else{
$blacklimit='0';}		

				$white="select qty as whiteQuantity from tblotsdetail_1 where otsID='$otsID' && itemNo='33' && qty>'0'";
$resultwhite=db_query($white);
$countrows=mysql_num_rows($resultwhite);
if($countrows>0){
while($row=mysql_fetch_array($resultwhite))
{$whitelimit=$row['whiteQuantity'];}}else{
$whitelimit='0';}			
		
#print $combolimit;
		$out.="\"".$completeID."\",\"".$str."\",\"".$ship_firstname."\",\"".$ship_lastname."\",\"".$ship_address."\",\"".$ship_address2."\",\"".$ship_city."\",\"".$ship_state."\",\"".$ship_zip."\",\"".$instructions."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$subtotal."\",\"".$ship."\",\"".$amount."\",\"".$email."\",\"".$EB100wlimit."\",\"".$EB100w6limit."\",\"".$eb3waylimit."\",\"".$ebe12limit."\",\"".$ebe126limit."\",\"".$tcpe12limit."\",\"".$tcpe126limit."\",\"".$tcpe26limit."\",\"".$tcpe266limit."\",\"".$ebglobelimit."\",\"".$ebglobe6limit."\",\"".$r20limit."\",\"".$ebbr30limit."\",\"".$ebbr306limit."\",\"".$ebbr40limit."\",\"".$par38limit."\",\"".$blacklimit."\",\"".$whitelimit."\",\"".$ENLlimit."\",\"".$DNLlimit."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=Duke-Orders.csv");
echo $out;
exit;
?>

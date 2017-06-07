<? include("database.php"); ?>
<?
$sql="select * from tblOrdersCompleted_lto";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"First Name\",\"Last Name\",\"Address\",\"Address 2\",\"City\",\"State\",\"Zip\",\"Instructions\",\"Email\",\"Phone\",\"Office\",\"Mailstop\",\"Tax\",\"Total\",\"LED 5pack\",\"BR30 Pack\",\"Water & Energy Kit\"\n";
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
			$bill_zip=$row['bill_zip'];
			$office=$row['office'];
			$mailstop=$row['mailstop'];
			$email=$row['email'];
			$phone=$row['phone'];
			$tax=$row['tax'];
			$amount=$row['amount'];
			$instructions=$row['instructions'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);
$combo="select qty as ComboQuantity from tblotsdetail where otsID='$otsID' && itemNo='242' && qty>'0'";
$resultcombo=db_query($combo);
$countrows=mysql_num_rows($resultcombo);
if($countrows>0){
while($row=mysql_fetch_array($resultcombo))
{$combolimit=$row['ComboQuantity'];}}else{
$combolimit='0';}

$br="select qty as BRQuantity from tblotsdetail where otsID='$otsID' && itemNo='243' && qty>'0'";
$resultbr=db_query($br);
$countrowsbr=mysql_num_rows($resultbr);
if($countrowsbr>0){
while($row=mysql_fetch_assoc($resultbr)){
		$brlimit=$row['BRQuantity'];}}else{
$brlimit='0';}
$wek="select qty as WEKQuantity from tblotsdetail where otsID='$otsID' && itemNo='244' && qty>'0'";
$resultwek=db_query($wek);
$countrowswek=mysql_num_rows($resultwek);
if($countrowswek>0){
while($row=mysql_fetch_assoc($resultwek)){
		$weklimit=$row['WEKQuantity'];}}else{
$weklimit='0';}
#print $combolimit;
		$out.="\"".$completeID."\",\"".$timestamp."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$instructions."\",\"".$email."\",\"".$phone."\",\"".$office."\",\"".$mailstop."\",\"".$tax."\",\"".$amount."\",\"".$combolimit."\",\"".$brlimit."\",\"".$weklimit."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=SDGE-Orders.csv");
echo $out;
exit;
?>

<? include("database.php"); ?>
<? include("secure.php"); ?>
<? $key="2037290784"?>
<?
$sql="select completeID, otsID, stamp, ship_firstname, AES_DECRYPT(ship_lastname, '$key') as ship_lastname, AES_DECRYPT(ship_address, '$key') as ship_address, AES_DECRYPT(ship_address2, '$key') as ship_address2, AES_DECRYPT(ship_city, '$key') as ship_city, ship_state, ship_zip, instructions, bill_firstname, AES_DECRYPT(bill_lastname, '$key') as bill_lastname, AES_DECRYPT(bill_address, '$key') as bill_address, AES_DECRYPT(bill_address2, '$key') as bill_address2, AES_DECRYPT(bill_city, '$key') as bill_city, bill_state, bill_zip, AES_DECRYPT(email, '$key') as email, question1, question2, AES_DECRYPT(account, '$key') as account, water, source, tax, amount from tblOrdersCompleted";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"Ship First\",\"Ship Last\",\"Ship Address\",\"Ship Address 2\",\"Ship City\",\"Ship State\",\"Ship Zip\",\"Instructions\",\"Bill First\",\"Bill Last\",\"Bill Address\",\"Bill Address 2\",\"Bill City\",\"Bill State\",\"Bill Zip\",\"Email\",\"Question 1\",\"Question 2\",\"Account\",\"Heat Water\",\"Source\",\"Tax\",\"Total\",\"BR20\",\"BR30\",\"BR40\",\"T1 APS\"\n";
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
			$water=$row['water'];
			$source=$row['source'];
			$question1=$row['question1'];
			$question2=$row['question2'];
			$account=$row['account'];
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
		
		$med="select qty as medQuantity from tblotsdetail where otsID='$otsID' && itemNo='243' && qty>'0'";
$resultmed=db_query($med);
$countrows=mysql_num_rows($resultmed);
if($countrows>0){
while($row=mysql_fetch_array($resultmed))
{$medlimit=$row['medQuantity'];}}else{
$medlimit='0';}
		
		$can="select qty as canQuantity from tblotsdetail where otsID='$otsID' && itemNo='244' && qty>'0'";
$resultcan=db_query($can);
$countrows=mysql_num_rows($resultcan);
if($countrows>0){
while($row=mysql_fetch_array($resultcan))
{$canlimit=$row['canQuantity'];}}else{
$canlimit='0';}
		$aps="select qty as apsQuantity from tblotsdetail where otsID='$otsID' && itemNo='245' && qty>'0'";
$resultaps=db_query($aps);
$countrows=mysql_num_rows($resultaps);
if($countrows>0){
while($row=mysql_fetch_array($resultaps))
{$apslimit=$row['apsQuantity'];}}else{
$apslimit='0';}


$out.="\"".$completeID."\",\"".$timestamp."\",\"".$ship_firstname."\",\"".$ship_lastname."\",\"".$ship_address."\",\"".$ship_address2."\",\"".$ship_city."\",\"".$ship_state."\",\"".$ship_zip."\",\"".$instructions."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$email."\",\"".$question1."\",\"".$question2."\",\"".$account."\",\"".$water."\",\"".$source."\",\"".$tax."\",\"".$amount."\",\"".$combolimit."\",\"".$medlimit."\",\"".$canlimit."\",\"".$apslimit."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=Mass-Orders.csv");
echo $out;
exit;
?>

<? include("database.php"); ?>
<? include("secure.php"); ?>
<? include("../../oldsites/j/4/stuff.php");?>
<?
$sql="select completeID, otsID, stamp, ship_firstname, AES_DECRYPT(ship_lastname, '$key') as ship_lastname, AES_DECRYPT(ship_address, '$key') as ship_address, AES_DECRYPT(ship_address2, '$key') as ship_address2, AES_DECRYPT(ship_city, '$key') as ship_city, ship_state, ship_zip, instructions, bill_firstname, AES_DECRYPT(bill_lastname, '$key') as bill_lastname, AES_DECRYPT(bill_address, '$key') as bill_address, AES_DECRYPT(bill_address2, '$key') as bill_address2, AES_DECRYPT(bill_city, '$key') as bill_city, bill_state, bill_zip, AES_DECRYPT(email, '$key') as email, email_opt, AES_DECRYPT(account, '$key') as account, water, tax, amount from tblOrdersCompleted";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"Ship First\",\"Ship Last\",\"Ship Address\",\"Ship Address 2\",\"Ship City\",\"Ship State\",\"Ship Zip\",\"Instructions\",\"Bill First\",\"Bill Last\",\"Bill Address\",\"Bill Address 2\",\"Bill City\",\"Bill State\",\"Bill Zip\",\"Email\",\"Email Opt-In/Out\",\"Account\",\"Heat Water\",\"Tax\",\"Total\",\"Kit\",\n";
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
			$email_opt=$row['email_opt'];
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

$out.="\"".$completeID."\",\"".$timestamp."\",\"".$ship_firstname."\",\"".$ship_lastname."\",\"".$ship_address."\",\"".$ship_address2."\",\"".$ship_city."\",\"".$ship_state."\",\"".$ship_zip."\",\"".$instructions."\",\"".$bill_firstname."\",\"".$bill_lastname."\",\"".$bill_address."\",\"".$bill_address2."\",\"".$bill_city."\",\"".$bill_state."\",\"".$bill_zip."\",\"".$email."\",\"".$email_opt."\",\"".$account."\",\"".$water."\",\"".$tax."\",\"".$amount."\",\"".$combolimit."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=Mass-Orders.csv");
echo $out;
exit;
?>

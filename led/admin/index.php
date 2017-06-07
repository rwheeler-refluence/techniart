<? include("database.php"); ?>
<? include("secure.php"); ?>

<?
$sql="select * from tblOrdersCompleted_led";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"Date\",\"Account\",\"First\",\"Last\",\"Address\",\"City\",\"State\",\"Zip\",\"Zip4\",\"Email\",\"Ship First\",\"Ship Last\",\"Ship Address\",\"Ship City\",\"Ship State\",\"Ship Zip\",\"Ship Zip4\",\"Pledge\",\"Customer\",\"Swear\",\"Emp ID\",\"Event Name\",\"Event Date\",\"Portal\",\"ID\",\"Ship?\",\"Qualified?\",\"Instructions\",\"Phone\",\"Tax\",\"Total\",\"Free\",\"Water\",\"$10\"\n";
	while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$otsID=$row['otsID'];
			$fname=$row['fname'];
			$lname=$row['lname'];
			$showdate=$row['showdate'];
			$emp=$row['emp'];
			$customer=$row['customer'];
			$swear=$row['swear'];
			$source=$row['source'];
			$streetnum=$row['streetnum'];
			$route=$row['route'];
			$unit=$row['unit1'];
			$address=$streetnum.' '.$route.' '.$unit;
			$city=$row['city'];
			$state=$row['state'];
			$zip=$row['zip'];
			$zip4=$row['zip4'];
			$ship_fname=$row['fname'];
			$ship_lname=$row['lname'];
			$ship_streetnum=$row['streetnum'];
			$ship_route=$row['route'];
			$ship_unit=$row['unit1'];
			$ship_address=$ship_streetnum.' '.$ship_route.' '.$ship_unit;
			$ship_city=$row['city'];
			$ship_state=$row['state'];
			$ship_zip=$row['zip'];
			$account=$row['account'];
			$ship_zip4=$row['zip4'];
			$phone=$row['phone'];
			$tax=$row['zip4'];
			$total=$row['total'];
			$email=$row['tax'];
				$ship=$row['ship'];
				$qual=$row['qual'];
			$pledge=$row['pledge'];
			$company=('SDGE Time of Use');
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);


#print $combolimit;
		$out.="\"".$timestamp."\",\"".$account."\",\"".$fname."\",\"".$lname."\",\"".$address."\",\"".$city."\",\"".$state."\",\"".$zip."\",\"".$zip4."\",\"".$email."\",\"".$ship_fname."\",\"".$ship_lname."\",\"".$ship_address."\",\"".$ship_city."\",\"".$ship_state."\",\"".$ship_zip."\",\"".$ship_zip4."\",\"".$pledge."\",\"".$customer."\",\"".$swear."\",\"".$emp."\",\"".$source."\",\"".$event_name."\",\"".$event_date."\",\"".$company."\",\"".$completeID."\",\"Ship to Customer\",\"".$qual."\",\"".$instructions."\",\"".$phone."\",\"".$tax."\",\"".$total."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=SDGE_TOU.csv");
echo $out;
exit;
?>

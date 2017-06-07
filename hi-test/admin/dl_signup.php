<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$sql="select * from tblContact";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
$out.="\"ID\",\"Date\",\"Email\",\"Zip\",\"Question\"\n";
	while($row=mysql_fetch_array($result)){
		$contactID=$row['contactID'];
		$stamp=strftime("%D %H:%M:%S",$row['stamp']);
		$email=$row['email'];
		$zip=$row['zip'];
		$question=$row['question'];
		$out.="\"".$contactID."\",\"".$stamp."\",\"".$email."\",\"0".$zip."\",\"".$question."\"\n";
		}
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename = $filename");
header("Content-Length: " . strlen($out));
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=MassSave-signup.csv");
echo $out;
exit;
?>
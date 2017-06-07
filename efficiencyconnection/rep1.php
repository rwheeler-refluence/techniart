<? include("database.php");?>
<?
$rep=$_SESSION['rep'];
$utility=$_SESSION['utility'];
#print $zipcode;
$sql="select * from tblInfo where rep='$rep'";
#print("".$sql."<br>");
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
		$name=$row['name'];
	$logo=$row['logo'];}
#print $countzip;
#		print("sess:".$_SESSION['st']."<br>");
#echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
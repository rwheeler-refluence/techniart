<? include("database.php");?>
<?
$rep=$_GET['rep'];
#print $zipcode;
$_SESSION['rep']=$rep;
$sql="select * from tblInfo where rep='$rep'";
#print("".$sql."<br>");
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$image=$row['image'];
	$name=$row['name'];
	$logo=$row['logo'];
}
#print $countzip;
#		print("sess:".$_SESSION['st']."<br>");
?>
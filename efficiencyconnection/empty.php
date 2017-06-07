<? include("database.php"); ?>
<?
$ID=$_GET['ID'];
$otsID=$_GET['otsID'];
$rep=$_SESSION['rep'];
$utility=$_SESSION['utility'];
#print $zipcode;
$sql="select * from tblInfo where rep='$rep'";
#print("".$sql."<br>");
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
		$name=$row['name'];
	$logo=$row['logo'];}
$sql="delete from tblotsdetail_$rep where otsID='$otsID'";
$result=db_query($sql);
header("location: cart.php"); ?>

<? include("../database.php");?>
<?
$sql="select * from tblProducts where category='Portable Lamps';";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$productID=$row['productID'];
	$modelNumber=$row['modelNumber'];
	$imageLoc="".$row['modelNumber'].".jpg";
	$sql2="update tblProducts set imageLoc='$imageLoc' where productID='$productID'";
	print("".$sql2."<br>");
	$result2=db_query($sql2);
}
?>
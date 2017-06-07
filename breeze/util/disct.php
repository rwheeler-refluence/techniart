<? include("../database.php");?>
<?
$sql="select * from tblProducts where energy_star='Yes';";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$productID=$row['productID'];
	$modelNumber=$row['modelNumber'];

	$sql1="select * from tblTerritory where vendor='9' || vendor='1'";
	$result1=db_query($sql1);
	while($row1=mysql_fetch_array($result1)){
		$zip=$row1['zip'];

		$sql2="insert into tblDiscounts values ('','$modelNumber','$zip')";
		print("".$sql2."<br>");
		$result2=db_query($sql2);
	}
}
?>
<? include("database.php");?>
<?
$zipcode=$_POST['zipcode']. '-' . $_POST['zip4'];
$_SESSION['zip']=$zipcode;
$sql="select * from tblTerritory where zip='$zipcode'";
#print("".$sql."<br>");
$result=db_query($sql);
$countzip=mysql_num_rows($result);
if($countzip>0){
	$_SESSION['zip_qualify']=$zipcode;
	while($rowzip=mysql_fetch_array($result)){
		$vendor=$rowzip['vendor'];
#		print("vendor:".$vendor."<br>");
	}}
#		print("sess:".$_SESSION['st']."<br>");
if($vendor=='30'){
header("location:store.php");}
else{header("location:sorry.php");}
?> 
<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
#print $zipcode;
$_SESSION['zip']=$zipcode;
$sql="select * from tblTerritory where zip='$zipcode'";
#print("".$sql."<br>");
$result=db_query($sql);
$countzip=mysql_num_rows($result);
while($rowzip=mysql_fetch_array($result)){
		$vendor=$rowzip['vendor'];}
#print $countzip;
#		print("sess:".$_SESSION['st']."<br>");
if($vendor=='30'){header("location:approved-zip.php");}
else{header("location:sorry.php");}
?>
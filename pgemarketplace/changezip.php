<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
#print $zipcode;
$_SESSION['zip']=$zipcode;
$sql="select * from tblTerritory where zip='$zipcode'";
#print("".$sql."<br>");
$result=db_query($sql);
$countzip=mysql_num_rows($result);
#print $countzip;
#		print("sess:".$_SESSION['st']."<br>");
if($countzip=='1'){header("location:select.php");}
if($countzip<'1'){header("location:sorry.php");}
?>
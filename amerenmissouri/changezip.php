<? include("database.php");
$source=$_POST['source'];?>
<? session_start(); 
$_SESSION['source'] = $source;
$zipcode=$_POST['zipcode'];

#print $zipcode;
#print $_SESSION['source'];
$sql="select * from tblTerritory where zip='$zipcode'";
#print("".$sql."<br>");
$result=db_query($sql);
$countzip=mysql_num_rows($result);
#print $countzip;
#		print("sess:".$_SESSION['st']."<br>");
#print $_SESSION['source'];
if($countzip=='1'){header("location:approved-zip.php");}
if($countzip<'1'){header("location:sorry.php");}
?>
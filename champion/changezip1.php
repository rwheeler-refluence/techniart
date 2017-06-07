<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
$_SESSION['zip']=$zipcode;
$sql="select * from tblTerritory where zip='$zipcode'";
#print("".$sql."<br>");
$result=db_query($sql);
	$_SESSION['zip_qualify']=$zipcode;
	while($rowzip=mysql_fetch_array($result)){
		$vendor=$rowzip['vendor'];}
#		print("vendor:".$vendor."<br>");
if($vendor=='30'){$_SESSION['rep']="CNP";}
if($vendor=='31'){$_SESSION['rep']="AEP";}
if($vendor=='32'){$_SESSION['rep']="TMNP";}

#		print("sess:".$_SESSION['st']."<br>");
if($vendor=='30'){header("location:http://www.techniart.us/ces/store.php");}
if($vendor=='31'){header("location:http://www.techniart.us/ces/store.php");}
if($vendor=='32'){header("location:http://www.techniart.us/ces/store.php");}
if(!$vendor){$_SESSION['rep']="NQ";}

#		print("sess:".$_SESSION['st']."<br>");
if(!$vendor){header("location:store.php");}
?>
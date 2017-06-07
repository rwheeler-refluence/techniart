<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
$rep=$_POST['rep'];
$_SESSION['zip']=$zipcode;
$_SESSION['rep']=$rep;
$sql="select * from tblTerritory where zip='$zipcode'";
#print("".$sql."<br>");
$result=db_query($sql);
	$_SESSION['zip_qualify']=$zipcode;
	while($rowzip=mysql_fetch_array($result)){
		$vendor=$rowzip['vendor'];
	$utility=$rowzip['utility'];}
#		print("vendor:".$utility."<br>");
if($vendor=='30'){$_SESSION['utility']=$utility;}
if($vendor=='32'){$_SESSION['utility']=$utility;}
if(!$vendor){$_SESSION['utility']="NQ";}
#print $_SESSION['utility'];
if($vendor=='30'){header("location:store.php");}
if($vendor=='32'){header("location:store.php");}
if(!$vendor){header("location:sorry.php");}
?>
<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
$zipcode1=$_GET['zipcode1'];
$util=$_POST['util'];
$_SESSION['zip']=$zipcode;
$sql="select * from tblTerritory_cnp where zip='$zipcode'";
#print("".$sql."<br>");
$result=db_query($sql);
	$_SESSION['zip_qualify']=$zipcode;
	while($rowzip=mysql_fetch_array($result)){
		$vendor=$rowzip['vendor'];}
		#print("re:".$rep."<br>");
if($vendor=='30'){$_SESSION['rep']="CNP";}

#		print("sess:".$_SESSION['st']."<br>");
if($vendor=='30'){header("location:http://www.techniart.us/".$util."/changezip2.php?zipcode=".$zipcode."&zipcode1=".$zipcode1."");}
if(!$vendor){header("location:sorry.php");}
?>
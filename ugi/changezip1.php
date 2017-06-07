<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
$_SESSION['zip']=$zipcode;
$sql="select * from tblTerritory where zip='$zipcode'";

#print("".$sql."<br>");
$result=db_query($sql);

$countzip=mysql_num_rows($result);

#print("countzip:".$countzip."<br>");

#		print("sess:".$_SESSION['st']."<br>");
if($countzip>0){header("location:store.php");}
else{header("location:sorry.php");}
?>
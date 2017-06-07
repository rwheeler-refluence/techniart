<? include("database.php"); ?>
<?
$ID=$_GET['ID'];
$otsID=$_GET['otsID'];
$sql="delete from tblotsdetail_trieagle where otsID='$otsID'";
$result=db_query($sql);
header("location: cart.php"); ?>

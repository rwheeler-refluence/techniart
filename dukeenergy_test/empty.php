<? include("database.php"); ?>
<?
$ID=$_GET['ID'];
$otsID=$_GET['otsID'];
$sql="delete from tblotsdetail_1 where otsID='$otsID'";
$result=db_query($sql);
header("location: http://www.techniart.us/dukeenergy/store.php"); ?>
<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblDaily where dailyID='$ID'";
$result=db_query($sql);

header("location: show_daily.php"); ?>

?>
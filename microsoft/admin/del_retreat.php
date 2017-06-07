<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblRetreatsDynamic where retreatID='$ID'";
$result=db_query($sql);

header("location: show_retreat.php"); ?>

?>
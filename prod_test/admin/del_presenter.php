<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblPresenters where presenterID='$ID'";
$result=db_query($sql);

header("location: show_presenters.php"); ?>

?>
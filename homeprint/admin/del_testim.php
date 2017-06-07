<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblTestim where testimID='$ID'";
$result=db_query($sql);

header("location: show_testim.php"); ?>

?>
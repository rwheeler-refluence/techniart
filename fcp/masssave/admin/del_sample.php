<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblPres where presID='$ID'";
$result=db_query($sql);

header("location: show_samples.php"); ?>

?>
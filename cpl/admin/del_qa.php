<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblQA where questionID='$ID'";
$result=db_query($sql);

header("location: show_qa.php"); ?>

?>
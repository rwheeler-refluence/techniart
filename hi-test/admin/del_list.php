<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblSubscribers where subscriberID='$ID'";
$result=db_query($sql);

header("location: show_list.php"); ?>

?>
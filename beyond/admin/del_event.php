<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblEvents where eventID='$ID'";
$result=db_query($sql);

header("location: show_events.php"); ?>

?>
<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblEmail where emailID='$ID'";
$result=db_query($sql);

$sql="delete from tblEmailTrack where emailID='$ID'";
$result=db_query($sql);

header("location: show_emails.php"); ?>

?>
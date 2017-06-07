<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblContact where contactID='$ID'";
$result=db_query($sql);

header("location: show_contact.php"); ?>

?>
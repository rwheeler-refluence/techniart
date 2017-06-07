<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblOrdersCompleted where completeID='$ID'";
$result=db_query($sql);

header("location: show_orders.php"); ?>

?>
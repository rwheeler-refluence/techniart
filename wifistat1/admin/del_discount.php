<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];

$sql="delete from tblProductDiscounts where proddisctID='$ID'";
$result=db_query($sql);

header("location: show_discounts.php"); ?>

?>
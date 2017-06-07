<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$ID=$_GET['ID'];
$cat=$_GET['cat'];
$sql="delete from tblProducts where productID='$ID'";
$result=db_query($sql);

header("location: show_products.php?cat=".$cat.""); ?>

?>
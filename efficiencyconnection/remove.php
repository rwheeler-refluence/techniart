<? include("rep1.php"); ?>
<?
$ID=$_GET['ID'];
$sql="delete from tblotsdetail_$rep where otsdetailID='$ID'";
$result=db_query($sql);
header("location: cart.php"); ?>

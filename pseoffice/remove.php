<? include("database.php"); ?>
<?
session_start();
$ID=$_GET['ID'];
$sql="delete from tblotsdetail_pse where otsdetailID='$ID'";
$result=db_query($sql);
header("location: cart.php"); 
?>
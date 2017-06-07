<? include("database.php"); ?>
<?
session_start();
$ID=$_GET['ID'];
$sql="delete from tblotsdetail where otsdetailID='$ID'";
$result=db_query($sql);
header("location: facebook.php"); 
?>
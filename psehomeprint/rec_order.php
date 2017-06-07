<? include("secure.php"); ?>
<? include("database.php"); ?>
<?
$oID=$_GET['oID'];
$ID=$_GET['ID'];

$sql="update tblotsdetail set received='YES' where otsdetailID='$oID'";
$result=db_query($sql);

header("location: order_detail.php?ID='$ID'"); ?>

?>
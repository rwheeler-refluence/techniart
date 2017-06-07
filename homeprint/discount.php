<? include("database.php");?>
<?
$discountID=$_POST['discountID'];
$_SESSION['discountID']=$discountID;
$sql="select discountID from tblDiscount where discount='$discount'";
#print("".$sql."<br>");
$result=db_query($sql);
$countdiscount=mysql_num_rows($result);
if($countdiscount>0){
$_SESSION['discount_qualify']=$discount;
#		print("sess:".$_SESSION['st']."<br>");
if($discountID=='1'){header("location:add-discount.php");}
if($discountID<'1'){header("location:approved-zip.php");}}
?>
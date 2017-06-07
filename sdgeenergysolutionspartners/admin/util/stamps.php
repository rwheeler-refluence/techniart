<? include("../database.php");?>
<?
$sql="select * from tblOrdersCompleted_copy";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$completeID=$row['completeID'];
	$stamp=substr($row['stamp'],0,15);
	$stamp=str_replace("-","/",$stamp);
	$stamp=strtotime($stamp);
	$sql2="update tblOrdersCompleted set stamp='$stamp' where completeID='$completeID'";
	$result2=db_query($sql2);
}
print("done");
?>
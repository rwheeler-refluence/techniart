<? include("../database.php");?>
<?
$sql="select * from tblSubscribers";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$subscriberID=$row['subscriberID'];
	$stamp=$row['stamp'];
	$st=explode(" ",$stamp);
	$st1=strtotime($st[0]);
	$sql1="update tblSubscribers set stamp1='$st1' where subscriberID='$subscriberID'";
	print($sql1."<br>");
	$result1=db_query($sql1);
}
print("done");
?>
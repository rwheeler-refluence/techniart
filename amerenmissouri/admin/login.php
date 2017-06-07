<? include("database.php"); ?>
<?
$user=$_POST['user'];
$pass=md5($_POST['pass']);

$sql="select * from tblAccess where user='$user' && pass='$pass'";
#print($sql);
$result=db_query($sql);
$count=mysql_num_rows($result);
if(!$count){
	header("location: loginform.php");
}else{
	while ($row=mysql_fetch_array($result)) {
	$uaccessID=$row['uaccessID'];
		$_SESSION['myspiritID']=$uaccessID;
	}
	header("location: show_orders.php");
}
?>

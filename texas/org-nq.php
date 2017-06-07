<? include("database.php");?>
<?
$db=$_POST['db'];
$rep="NQ";
echo ($db);
$sql="select name from tblVendors where db='$db'";
$result=db_query($sql);
while($row=mysql_fetch_assoc($result)){
	$name=$row['name'];}
#echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
#$sql="select * from tblTerritory where zip='$zipcode'";
#print("".$sql."<br>");
#$result=mysql_query($sql);
#$countzip=mysql_num_rows($result);
#if($countzip>0){
#	while($rowzip=mysql_fetch_array($result)){
#		$vendor=$rowzip['vendor'];
#}
#}
#		print("sess:".$_SESSION['st']."<br>");
if($db){
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='show_orders.php?db=".$db."&name=".$name."&rep=".$rep."'
        </SCRIPT>
        ";
}

?>
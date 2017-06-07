<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
$utility=$_POST['utility'];
$gasv=$_POST['gasv'];
$water=$_POST['water'];
$_SESSION['zip']=$zipcode;
$_SESSION['util']=$utility;
$_SESSION['gas']=$gasv;
$_SESSION['water']=$water;
#print $utility;
#print $gasv;
#print $water;
$sql="select * from tblElec where zip='$zipcode' AND vendor='$utility'";
$result=db_query($sql);
#print $sql;
#print $result;
$countzip=mysql_num_rows($result);
if($countzip>0)
{
#print $countzip;
	$elec=1;
	$_SESSION['zip_qualify']=$zipcode;
	while($rowzip=mysql_fetch_array($result)){
		$vendor=$rowzip['vendor'];
		#print("vendor:".$elec."<br>");
		#print("gas vendor:".$gasv."<br>");
}}
$sqlg="select * from tblGas where zip='$zipcode' AND gasv='$gasv'";
$resultg=db_query($sqlg);
$countzipg=mysql_num_rows($resultg);
if($countzipg>0){
	$gas=1;
	while($rowzip=mysql_fetch_array($resultg)){
		$gvendor=$rowzip['gasv'];
		#print("vendor:".$vendor."<br>");
		#print("gas vendor:".$gasv."<br>");
		
		
}}
#print $sql;
#print("count 1: ".$countzip."\n\n");
#print("count 2: ".$countzipg."\n");
#print $sqlg;
#print $gasv;
#echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
#if($vendor=='99' & $countzip>'0' & $gas<'98'){header("location:store-cat1.php?cat=LED%20Products");}
#print $gas;

if($elec==1 && $gas==1){
header("location:both/store.php");
}else{
if($elec==1 && $water>2){
			header("location:both/store.php");}
else{
if($elec==1 && $gas!=1){
			header("location:elec/store.php");}
else{
if($elec!=1 && $gas==1){
			header("location:gas/store.php");}
else{
if($countzip<1 && $countzip1<1){header("location:index.php?msg=notqualified");}}}}}
?>
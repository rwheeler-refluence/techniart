<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
$utility=$_POST['utility'];
$gas=$_POST['gas'];
$water=$_POST['water'];
$_SESSION['zip']=$zipcode;
$_SESSION['util']=$utility;
$_SESSION['gas']=$gas;
$_SESSION['water']=$water;
#print $gas;
#print $water;
$sql="select * from tblTerritory where zip='$zipcode'";
$result=db_query($sql);
$countzip=mysql_num_rows($result);
if($countzip>0){
	$_SESSION['zip_qualify']=$zipcode;
	while($rowzip=mysql_fetch_array($result)){
		$vendor=$rowzip['vendor'];
		$gvendor=$rowzip['gasv'];
		#print("vendor:".$vendor."<br>");
		#print("gas vendor:".$gasv."<br>");

#print $countzip;
#echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
#if($vendor=='99' & $countzip>'0' & $gas<'98'){header("location:store-cat1.php?cat=LED%20Products");}

if($utility>'98' & $gas<'98'){
	$prodclass="gas";
	$_SESSION['prodclass']=$prodclass;
		header("location:store-cat1.php?prodclass=$prodclass");}
if($utility<'99' & $gas>'97'){
	$prodclass="elec";
	$_SESSION['prodclass']=$prodclass;
	header("location:store-cat1.php?prodclass=$prodclass");
							}
if($utility<'99' & $gas<'98'){
	$prodclass="both";
$_SESSION['prodclass']=$prodclass;
	header("location:store-cat1.php?prodclass=$prodclass");
}}}
#if($countzip>'0' & $gas>'1' & $water>'1'){header("location:store-cat-lw.php?cat=Products");}
#else{
#if($countzip>'0' & $gas>'1'){header("location:store-cat-lw.php?cat=Products");}
#else{
#if($countzip>'0' & $water>'1'){header("location:store-cat-lw.php?cat=Products");}
#else{
#if($countzip>'0'){header("location:store-cat.php?cat=LED%20Products");}
#else{
if($countzip<'1'){header("location:index.php?msg=notqualified");}
?>
<? include("database.php");?>
<?
$coupon=$_POST['coupon'];
$sql1="select * from tblCoupon where code='$coupon'";
#print("".$sql."<br>");
$result1=db_query($sql1);
	while($rowcode=mysql_fetch_array($result1)){
		$_SESSION['discount']=$rowcode['value'];
		$status=$rowcode['status'];}
#print("".$result."<br>");
$countcoupon=mysql_num_rows($result1);
#print $countcoupon;
if($countcoupon>0 && $status==1){$_SESSION['coupon']=$coupon;
echo "<SCRIPT LANGUAGE='JavaScript'>
        alert('Your coupon code has been accepted. Coupons are one time use only!')
		window.location.href='cart.php'
        </SCRIPT>";
$_SESSION['otsID']=$otsID;	
#print $otsID;	
$sqlincoup="UPDATE tblotsdetail set coupon='$coupon' WHERE otsID='$otsID'";
$resultcoup=mysql_query($sqlincoup);
}else{
if($countcoupon>0 && $status=2){
$_SESSION['coupon']='';
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('That coupon code has already been redeemed.')
		window.location.href='cart.php'
        </SCRIPT>";
}else{
if($countcoupon<1){
$_SESSION['coupon']='';
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('That coupon code is not qualified.')
		window.location.href='cart.php'
        </SCRIPT>";
}}}
?>
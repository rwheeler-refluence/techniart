<? include("database.php");?>
<?
$otsID=$_SESSION['otsID'];
$coupon=$_POST['coupon'];
$sql1="select * from tblCoupon_champion where code='$coupon'";
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
        window.alert('Your coupon code has been accepted.')
		window.location.href='http://www.techniart.us/champion/cart.php'
        </SCRIPT>";

print $otsID;	
$sqlincoup="UPDATE tblotsdetail_ces set coupon='$coupon' WHERE otsID='$otsID'";
$resultcoup=db_query($sqlincoup);
}else{
if($countcoupon>0 && $status=2){
$_SESSION['coupon']='';
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('That coupon code has already been redeemed.')
		window.location.href='http://www.techniart.us/champion/cart.php'
        </SCRIPT>";
}else{
if($countcoupon<1){
$_SESSION['coupon']='';
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('That coupon code is not qualified.')
		window.location.href='http://www.techniart.us/champion/cart.php'
        </SCRIPT>";
}}}
?>
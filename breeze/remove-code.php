<? include("database.php");?>
<?
$_SESSION['otsID']=$otsID;	
#print $otsID;	
$del="UPDATE tblotsdetail_breeze set coupon='0' WHERE otsID='$otsID'";
$resultdel=db_query($del);
$_SESSION['coupon']='';
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Your coupon code has been removed.')
		window.location.href='cart.php'
       </SCRIPT>";

?>

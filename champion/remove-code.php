<? include("database.php");?>
<?
$otsID=$_SESSION['otsID'];	
#print $otsID;	
$del="UPDATE tblotsdetail_champion set coupon='0' WHERE otsID='$otsID'";
$resultdel=db_query($del);
$_SESSION['coupon']='';
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Your coupon code has been removed.')
		window.location.href='cart.php'
       </SCRIPT>";

?>

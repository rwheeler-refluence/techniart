<? include("database.php");?>
<?
$promocode=$_POST['code'];
$_SESSION['code']=$promocode;
#$sql="select distinct code from tblPromo where code='$promocode'";
#$sqls="select status from tblPromo where code='$promocode'";
$sqlt="SELECT * FROM tblPromo WHERE code='$promocode' AND status='1'";
#print("".$sqls."<br>");
#print("".$sqlt."<br>");
$result=db_query($sqlt);
#$results=db_query($sqls);
$countcode=mysql_num_rows($result);
#$countcodes=mysql_num_rows($results);
#print $countcode;
if($countcode>0){header("location:approved-code.php?code=$promocode");}
if($countcode<'1'){
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('That promo code is not qualified or has expired.')
		window.location.href='http://www.techniart.com/homeprint'
        </SCRIPT>";
}
?>
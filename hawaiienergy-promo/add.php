<? include("database.php");?>
<?
$pcqty=$_POST['pcqty'];
$avqty=$_POST['avqty'];
#print $zipcode;
#print("".$sql."<br>");
if($pcqty=='1' && $avqty=='0')
{header("location:addpc15.php");
}else{
if($pcqty=='2' && $avqty=='0')
{header("location:addpc25.php");
}else{
if($pcqty=='1' && $avqty=='1')
{header("location:add1n1.php");	
}else{
if($pcqty=='1' && $avqty=='2')
{header("location:add1n2.php");	
}else{	
if($pcqty=='2' && $avqty=='1')
{header("location:add2n1.php");
}else{
if($pcqty=='2' && $avqty=='2')
{header("location:add2n2.php");
}else{
if($pcqty=='0' && $avqty=='1')
{header("location:addav15.php");
}else{
if($pcqty=='0' && $avqty=='2')
{header("location:addav25.php");}
if($pcqty=='0' && $avqty=='0')
{echo "<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Please select at least 1 power strip!')
		window.location.href='choose.php'
        </SCRIPT>
        ";
		die();}
}}}}}}}
?>
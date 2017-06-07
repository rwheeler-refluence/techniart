<? include("database.php"); ?>
<?
$name=$_POST['name'];
$company=$_POST['company'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Marketing The Future</title>
</head>
<BODY onLoad='document.form1.submit();'>
<?
$sql="select * from tblShipping where access_company='$company' && name='$name'";
	$result=db_query($sql);

		while($rowa=mysql_fetch_array($result)){
			$ship_fname=$rowa['ship_firstname'];
			$ship_lname=$rowa['ship_lastname'];
			$ship_address1=$rowa['ship_address'];
			$ship_address2=$rowa['ship_address2'];
			$ship_city=$rowa['ship_city'];
			$ship_zip=$rowa['ship_zip'];
}
#print $ship_fname;?>
<form action="orderform.php" name="form1" id="form1" method="POST" >
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>">
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>">
<input type=hidden name="ship_address1" value="<? echo($ship_address1); ?>"> 
<input type=hidden name="ship_address2" value="<? echo($ship_address2); ?>">
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>">
<input type=hidden name="ship_option" value="<? echo($ship_option); ?>">
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>">
<input type=hidden name="name" value="<? echo($name); ?>">
</form>
</body>
</html>
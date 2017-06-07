<? include("database.php");?>
<?php
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0');
header ('Pragma: no-cache');
error_reporting(0);
//if php includes stop working something is wrong with this header
if (isset($_GET['j1'])) {

	$theacct=$_GET['j1'];
  	$thepass=$_GET['j2'];
    $islogin="Y";

} else {

	$islogin="N";
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CASCADE WATER ALLIANCE |  Free Items</title>


<link rel="stylesheet" type="text/css" href="css/main.css"/>

</head>

<body id="reliability" onLoad="theonload();">
<?php include("header.php"); ?>



<? include("products.php");?>


</div>
<div class="footer" style="position:fixed;bottom:0;width:975px;height:195px;z-index: 16;background-color:#1d4d7b;display:block;">

</form>
<?php include("includes/screens/footer_scr.txt"); ?>
</body>
</html>


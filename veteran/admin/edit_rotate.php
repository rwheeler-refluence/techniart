<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$action=$_POST['action'];
if($action=='add'){
	$rotateID=$_POST['rotateID'];
	$rotateImg=$_POST['rotateImg'];           
	$rotateURL=$_POST['rotateURL'];           

		$imgpath="".$rootDir."pix/";
		$imgsource = $_FILES['rotateImg']['tmp_name'];
		$imgdest = $imgpath.$_FILES['rotateImg']['name'];
		$imgpath=$_FILES['rotateImg']['name'];

		$sql.="update tblRotate set";
		if($_FILES['rotateImg']['tmp_name']!==''){
			move_uploaded_file($imgsource, $imgdest);
			$sql.=" rotateImg='$imgpath',";
		}


	$sql.=" rotateURL='$rotateURL' where rotateID='$rotateID'";
	print($sql);
	$result=db_query($sql);

	#header("location: show_rotate.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?
$ID=$_GET['id'];
$sql="select * from tblRotate where rotateID='$ID'";
$result=db_query($sql);
	while($row = mysql_fetch_array($result)){ 
		$rotateID=$row['rotateID'];
		$rotateImg=stripslashes($row['rotateImg']);
		$rotateURL=stripslashes($row['rotateURL']);
	}
?>

<html>
<head>
<title>CRUCMS - by Crucial Networking</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>

<STYLE>
BODY {
background-color : #18304c;
background-image: url(pix/g_bkg.gif);
background-repeat: repeat-x;
background-position: top center; 
font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
color : #ffffff;
margin: 0px; 
}
</STYLE>

</head>

<BODY>

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main_sub">Homepage Rotator:</span>&nbsp;&nbsp;<span class="title_sub_level2">Edit Image</span><br></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<?
if($msg){
	print("<h2>".$msg."</h2>\n");
}?>

<form method="post" action="<? echo($PHP_SELF); ?>" enctype="multipart/form-data">
<input type="hidden" name="action" value="add">
<input type="hidden" name="rotateID" value="<? echo($rotateID); ?>">

<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<span class="body_content"><b>Image:</b></span><br>
<input type="file" name="rotateImg" size="30" class="forms"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<span class="body_content"><b>URL:</b> (include http://)</span><br>
<input type="text" name="rotateURL" size="30" class="forms" value="<? echo($rotateURL);?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<input type="submit" name="Submit" value="Update"></form>
<br>
<? include("body_bot.php"); ?>

</body>
</html>
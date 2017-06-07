<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$action=$_POST['action'];
if($action=='add'){
	$presenterImg=addslashes($_POST['presenterImg']);
	$presenterName=addslashes($_POST['presenterName']);
	$presenterTitle=addslashes($_POST['presenterTitle']);
	$presenterCol1=addslashes($_POST['FCKeditor1']);
	$presenterCol2=addslashes($_POST['FCKeditor2']);

	$imgpath="".$rootDir."pix/presenters/";
	$imgsource = $_FILES['presenterImg']['tmp_name'];
	$imgdest = $imgpath.$_FILES['presenterImg']['name'];
	$imgpath=$_FILES['presenterImg']['name'];
	if($_FILES['presenterImg']['tmp_name']!==''){
		move_uploaded_file($imgsource, $imgdest);
	}

	$sql="insert into tblPresenters values ('', '$imgpath', '$presenterName', '$presenterTitle', '$presenterCol1', '$presenterCol2', 'No')";
	$result=db_query($sql);

	header("location: show_presenters.php");
}
?>
<? include("editor/fckeditor.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
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
<td><span class="title_main_sub">Presenters:</span>&nbsp;&nbsp;<span class="title_sub_level2">Add Presenter</span><br></td>
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

<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<span class="body_content">
<?php
$sBasePath = "editor/";
?>
<b>Presenter Name:</b><br>
<input type="text" name="presenterName" size="30">
<br><br>
<b>Presenter Title:</b><br>
<input type="text" name="presenterTitle" size="30">
<br><br>
<b>Presenter Image: (should not exceed 150px wide)</b><br>
<input type="file" name="presenterImg">
<br><br>
<b>Left Column Text:</b><br>
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $presenterCol1;
$oFCKeditor->Create() ;
?>
<b>Right Column Text:</b></span><br>
<?php
$oFCKeditor = new FCKeditor('FCKeditor2') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $presenterCol2;
$oFCKeditor->Create() ;
?>
<br>
<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<input type="submit" name="Submit" value="Add Presenter"></form>
<br>
<? include("body_bot.php"); ?>

</body>
</html>
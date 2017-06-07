<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$action=$_POST['action'];
if($action=='add'){
	$presFile=addslashes($_POST['presFile']);
	$presTitle=addslashes($_POST['presTitle']);
	$presType=addslashes($_POST['presType']);

	$imgpath="".$rootDir."samples/";
	$imgsource = $_FILES['presFile']['tmp_name'];
	$imgdest = $imgpath.$_FILES['presFile']['name'];
	$imgpath=$_FILES['presFile']['name'];
	if($_FILES['presFile']['tmp_name']!==''){
		move_uploaded_file($imgsource, $imgdest);
	}

	$sql="insert into tblPres values ('', '$presTitle', '$imgpath','$presType','No')";
	$result=db_query($sql);

	header("location: show_samples.php");
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
<td><span class="title_main_sub">Presentation Samples:</span>&nbsp;&nbsp;<span class="title_sub_level2">Add Presentation Sample</span><br></td>
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
<b>Sample Title:</b><br>
<input type="text" name="presTitle" size="30" value="<? echo($presTitle);?>">
<br><br>
<b>Sample File:</b><br>
<? if($presFile){?>
(Currently: <a class="body_content" href="../samples/<? echo($presFile);?>" target="_new"><? echo($presFile);?></a>)<br>
<?}?>
<input type="file" name="presFile">
<br><br>
<b>Sample Type:</b><br>
<input type="radio" name="presType" value="mp3" <? if($presType=='mp3'){print("checked");}?>">MP3<br>
<input type="radio" name="presType" value="pdf" <? if($presType=='pdf'){print("checked");}?>">PDF<br>
<br>
<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<input type="submit" name="Submit" value="Add Presentation Sample"></form>
<br>
<? include("body_bot.php"); ?>

</body>
</html>
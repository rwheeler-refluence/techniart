<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$action=$_POST['action'];
if($action=='add'){
	$testimID=$_POST['testimID'];
	$testimText=addslashes($_POST['FCKeditor1']);           
	$testimFrom=addslashes($_POST['testimFrom']);           

	$sql="update tblTestim set testimText='$testimText',testimFrom='$testimFrom' where testimID='$testimID'";
	$result=db_query($sql);

	header("location: show_testim.php");
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
<?
$ID=$_GET['ID'];
$sql="select * from tblTestim where testimID='$ID'";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$testimID=$row['testimID'];
	$testimText=stripslashes($row['testimText']);
	$testimFrom=stripslashes($row['testimFrom']);
	$testimPub=$row['testimPub'];
}
?>
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main_sub">Testimonial:</span>&nbsp;&nbsp;<span class="title_sub_level2">Edit Testimonial</span><br></td>
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
<input type="hidden" name="testimID" value="<? echo($testimID); ?>">

<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<span class="body_content">
<?php
$sBasePath = "editor/";
?>
<b>Testimonial:</b><br>
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $testimText;
$oFCKeditor->Create() ;
?>
<b>From:</b></span><br>
<textarea name="testimFrom" cols="30" rows="3"><? echo($testimFrom);?></textarea><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<input type="submit" name="Submit" value="Update Testimonial"></form>
<br>
<? include("body_bot.php"); ?>

</body>
</html>
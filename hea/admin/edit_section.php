<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$action=$_POST['action'];
if($action=='add'){
	$sectionID=$_POST['sectionID'];
	$sectionTitle=addslashes($_POST['sectionTitle']);           
	$sectionText=addslashes($_POST['FCKeditor1']);           

	$sql="update tblSections set sectionText='$sectionText' where sectionID='$sectionID'";
	$result=db_query($sql);

	$msg="Content Updated";
}
?>
<? include("editor/fckeditor.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?
$ID=$_GET['ID'];
$sql="select * from tblSections where sectionID='$ID'";
$result=db_query($sql);
	while($row = mysql_fetch_array($result)){ 
		$sectionID=$row['sectionID'];
		$sectionTitle=stripslashes($row['sectionTitle']);
		$sectionText=stripslashes($row['sectionText']);
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
<td><span class="title_main_sub"><? echo($sectionTitle);?></span><!--&nbsp;&nbsp;<span class="title_sub_level2">Edit Image</span>--><br></td>
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
<input type="hidden" name="sectionID" value="<? echo($sectionID); ?>">

<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<span class="body_content"><b>Text:</b></span><br>
<?php
$sBasePath = "editor/";

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $sectionText;
$oFCKeditor->Create() ;
?>
<br>
<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<input type="submit" name="Submit" value="Update"></form>
<br>
<? include("body_bot.php"); ?>

</body>
</html>
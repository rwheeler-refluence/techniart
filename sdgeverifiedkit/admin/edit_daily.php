<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php");?>
<? 
$action=$_POST['action'];
if($action=='update'){
	$dailyID=$_POST['dailyID'];
	$dailyTitle=addslashes($_POST['dailyTitle']);
	$dailyText=addslashes($_POST['FCKeditor1']);
	$dailyDate=strtotime($_POST['dailyDate']);
	$dailyDate_year=$_POST['dailyDate_year'];
	$dailyDate_mo=$_POST['dailyDate_mo'];
	$dailyDate_day=$_POST['dailyDate_day'];
	$comb="".$dailyDate_year."-".$dailyDate_mo."-".$dailyDate_day."";
	
			$sql="update tblDaily set dailyTitle='$dailyTitle',dailyText='$dailyText',dailyDate='$comb',stamp='$dailyDate' where dailyID='$dailyID'";
			$result=db_query($sql);
			header("location: show_daily.php");
		}

?>
<? include("editor/fckeditor.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Spirit of Golf</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
</head>

<BODY>

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="body_content"><span style="font-size: 14px;"><b>Thought of the Day:</b></span><span style="color:#a02136; font-size: 18px;"><b>Edit Thought of the Day</b></span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->



<? if($msg){
	print("<b>".$msg."</b><br><br>\n");
}
?>
<?
$ID=$_GET['ID'];
$sql="select *,YEAR(dailyDate) as dailyDate_year, MONTH(dailyDate) as dailyDate_mo, DAY(dailyDate) as dailyDate_day from tblDaily where dailyID='$ID'";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$dailyID=$row['dailyID'];
	$dailyTitle=stripslashes($row['dailyTitle']);
	$dailyText=stripslashes($row['dailyText']);
	$dailyDate_year=$row['dailyDate_year'];
	$dailyDate_mo=$row['dailyDate_mo'];
	$dailyDate_day=$row['dailyDate_day'];
	$dailyDate=strftime("%D",$row['stamp']);
	$comb="".$dailyDate_year."-".$dailyDate_mo."-".$dailyDate_day."";
}
?>
<form method="post" action="<? echo($PHP_SELF); ?>" enctype="multipart/form-data">
<input type="hidden" name="action" value="update">
<input type="hidden" name="dailyID" value="<? echo($dailyID);?>">
<table border="0" width="400">
<tr>
<td><span class="body_content"><b>Title</b> (if applicable)</span><br>
<input type="text" size="45" name="dailyTitle" value="<? echo($dailyTitle);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Date</b> (mm/dd/YYYY)</span><br>
<input type="text" size="10" name="dailyDate" value="<? echo($dailyDate);?>">&nbsp;</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content" colspan="2"><b>Text</b></span><br>
<?php
$sBasePath = "editor/";

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $dailyText;
$oFCKeditor->Height	= '600' ;
$oFCKeditor->Width	= '520' ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan="2"><input type="submit" value="Edit Thought of the Day"></td></tr></table>
</form>

<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html><?php ob_end_flush() ?>
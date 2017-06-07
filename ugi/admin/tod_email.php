<?php ob_start() ?>
<? $ID=$_GET['ID'];?>
<? include("database.php"); ?>
<? include("secure.php");?>
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
<td><span class="body_content"><span style="font-size: 14px;"><b>Emails:</b></span><span style="color:#a02136; font-size: 18px;"><b><? if($ID){print("Edit");}else{print("Add");}?> Email</b></span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->

<?
#grab email details
$sqlemail="select * from tblEmail where emailID='$ID'";
$resultemail=db_query($sqlemail);
while($rowemail=mysql_fetch_array($resultemail)){
	$subject=stripslashes($rowemail['subject']);
	$extra=stripslashes($rowemail['extra']);
	$emailID=$rowemail['emailID'];
	$thought=stripslashes($rowemail['thought']);
	$date=strftime("%D",$rowemail['date']);
}
if(!$subject){
	$subject="Spirit of Golf - Thought of the Day";
}

if($msg){
	print("<b>".$msg."</b><br><br>\n");
}
$m=date("m");
$d=date("d");
$Y=date("Y");
$comb=strtotime("".$m."/".$d."/".$Y."");
#$sql="select dailyID,MONTH(dailyDate) as mo,DAY(dailyDate) as day,YEAR(dailyDate) as year,dailyDate,dailyPub,dailyTitle,dailyText from tblDaily where MONTH(dailyDate)='$m' && DAY(dailyDate)='$d' && YEAR(dailyDate)='$Y' && dailyPub='Yes'";
#print($sql);
$sql="select * from tblDaily where stamp='$comb' && dailyPub='Yes'";
$result=db_query($sql);
$count=mysql_num_rows($result);
if($count<1){
#	$sql="select dailyID,MONTH(dailyDate) as mo,DAY(dailyDate) as day,YEAR(dailyDate) as year,dailyDate,dailyPub,dailyTitle,dailyText from tblDaily where dailyPub='Yes' order by dailyDate desc limit 1";
	$sql="select * from tblDaily where dailyPub='Yes' order by stamp desc limit 1";
	$result=db_query($sql);
}
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
if(!$ID){
	$thought=$dailyText;
}
?>
<form method="post" action="email/save.php" enctype="multipart/form-data" target="_blank">
<input type="hidden" name="action" value="update">
<input type="hidden" name="emailID" value="<? echo($emailID);?>">
<table border="0" width="400">
<tr>
<td><span class="body_content"><b>Send On</b> (mm/dd/YYYY)</span><br>
<input type="text" size="10" name="date" value="<? echo($date);?>"></td>
</tr>
<tr>
<td><span class="body_content"><b>Subject</b></span><br>
<input type="text" size="45" name="subject" value="<? echo($subject);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content" colspan="2"><b>Extra Text</b></span><br>
<?php
$sBasePath = "editor/";

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $extra;
$oFCKeditor->Height	= '300' ;
$oFCKeditor->Width	= '520' ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
<tr>
<td><span class="body_content" colspan="2"><b>Thought of the Day</b></span><br>
<?php
$oFCKeditor = new FCKeditor('FCKeditor2') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $thought;
$oFCKeditor->Height	= '300' ;
$oFCKeditor->Width	= '520' ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan="2"><input type="submit" value="Save Thought of the Day Email"></td></tr></table>
</form>

<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html><?php ob_end_flush() ?>
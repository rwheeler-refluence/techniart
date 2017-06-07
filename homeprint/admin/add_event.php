<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php");?>
<? 
$action=$_POST['action'];
if($action=='update'){
	$eventTitle=addslashes($_POST['eventTitle']);
	$date_year=$_POST['date_year'];
	$date_mo=$_POST['date_mo'];
	$date_day=$_POST['date_day'];
	$comb="".$date_year."-".$date_mo."-".$date_day."";
	$eventTime=addslashes($_POST['eventTime']);
	$endTime=addslashes($_POST['endTime']);
	$eventCompany=addslashes($_POST['eventCompany']);
	$eventAddress=addslashes($_POST['eventAddress']);
	$eventCity=addslashes($_POST['eventCity']);
	$eventState=addslashes($_POST['eventState']);
	$eventType=addslashes($_POST['eventType']);
	
			$sql="insert into tblEvents values ('','$comb','$eventTitle','$eventCompany','$eventAddress','$eventCity','$eventState','$eventTime','$eventType','No')";
			$result=db_query($sql);
			header("location: show_events.php");
		}

?>
<? include("editor/fckeditor.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Techniart, Inc.</title>

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
<td><span class="body_content"><span style="font-size: 14px;"><b>EVENTS | </b></span><span style="color:#a02136; font-size: 18px;"><b>ADD EVENT</b></span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->



<? if($msg){
	print("<b>".$msg."</b><br><br>\n");
}
?>
<form method="post" action="<? echo($PHP_SELF); ?>" enctype="multipart/form-data">
<input type="hidden" name="action" value="update">
<table border="0" width="400">
<tr>
<td><span class="body_content"><b>Title</b></span><br>
<input type="text" size="45" name="eventTitle"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Date</b></span><br>
<input type="text" size="4" name="date_year" value="YEAR">&nbsp;<input type="text" size="2" name="date_mo" value="MM">&nbsp;<input type="text" size="2" name="date_day" value="DD">&nbsp;</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Events Time</b></span><br>
<input type="text" size="45" name="eventTime"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Company</b></span><br>
<input type="text" size="45" name="eventCompany"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Address</b></span><br>
<input type="text" size="45" name="eventAddress"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>City</b></span><br>
<input type="text" size="45" name="eventCity"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>State</b></span><br>
<input type="text" size="2" name="eventState"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Event Type</b><br>
<input type="radio"name="eventType" value="public">public<br>
<input type="radio"name="eventType" value="private">private

</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan="2"><input type="submit" value="Add Event"></td></tr></table>
</form>

<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html><?php ob_end_flush() ?>
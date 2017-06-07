<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php");?>
<? 
$action=$_POST['action'];
if($action=='update'){
	$eventID=$_POST['eventID'];
	$eventTitle=addslashes($_POST['eventTitle']);
	$eventCompany=addslashes($_POST['eventCompany']);
	$date_year=$_POST['date_year'];
	$date_mo=$_POST['date_mo'];
	$date_day=$_POST['date_day'];
	$comb="".$date_year."-".$date_mo."-".$date_day."";
	$eventTime=addslashes($_POST['eventTime']);
	$eventLoc=addslashes($_POST['eventLoc']);
	$eventAddress=addslashes($_POST['eventAddress']);
	$eventCity=addslashes($_POST['eventCity']);
	$eventState=addslashes($_POST['eventState']);
	$eventType=$_POST['eventType'];
	
			$sql="update tblEvents set eventTitle='$eventTitle',stamp='$comb',eventTime='$eventTime',eventCompany='$eventCompany',eventAddress='$eventAddress',eventType='$eventType',eventCity='$eventCity',eventState='$eventState' where eventID='$eventID'";
			$result=db_query($sql);
			header("location: show_events.php");
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
<td><span class="body_content"><span style="font-size: 14px;"><b>EVENTS | </b></span><span style="color:#a02136; font-size: 18px;"><b>EDIT EVENT</b></span></td>
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
$sql="select *,YEAR(stamp) as date_year, MONTH(stamp) as date_mo, DAY(stamp) as date_day from tblEvents where eventID='$ID'";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$eventID=$row['eventID'];
	$eventTitle=stripslashes($row['eventTitle']);
	$date_year=$row['date_year'];
	$date_mo=$row['date_mo'];
	$date_day=$row['date_day'];
	$comb="".$date_year."-".$date_mo."-".$date_day."";
	$startTime=stripslashes($row['startTime']);
	$endTime=stripslashes($row['endTime']);
	$eventLoc=stripslashes($row['eventLoc']);
	$eventCompany=stripslashes($row['eventCompany']);
	$eventAddress=stripslashes($row['eventAddress']);
	$eventCity=stripslashes($row['eventCity']);
	$eventTime=$row['eventTime'];
	$eventState=stripslashes($row['eventState']);
	$eventType=$row['eventType'];
}
?>
<form method="post" action="<? echo($PHP_SELF); ?>" enctype="multipart/form-data">
<input type="hidden" name="action" value="update">
<input type="hidden" name="eventID" value="<? echo($eventID);?>">
<table border="0" width="400">
<tr>
<td><span class="body_content"><b>Title</b></span><br>
<input type="text" size="45" name="eventTitle" value="<? echo($eventTitle);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Date</b></span><br>
<input type="text" size="4" name="date_year"  value="<? echo($date_year);?>">&nbsp;<input type="text" size="2" name="date_mo"  value="<? echo($date_mo);?>">&nbsp;<input type="text" size="2" name="date_day" value="<? echo($date_day);?>">&nbsp;</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Event Time</b></span><br>
<input type="text" size="45" name="eventTime" value="<? echo($eventTime);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Company</b></span><br>
<input type="text" size="45" name="eventCompany" value="<? echo($eventCompany);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Address</b></span><br>
<input type="text" size="45" name="eventAddress" value="<? echo($eventAddress);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>City</b></span><br>
<input type="text" size="45" name="eventCity" value="<? echo($eventCity);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>State</b></span><br>
<input type="text" size="2" name="eventState" value="<? echo($eventState);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Event Type</b><br>
<input type="radio" name="eventType" value="public" <? if($eventType=='public'){print("checked");}?>>public<br>
<input type="radio" name="eventType" value="private" <? if($eventType=='private'){print("checked");}?>>private
</tr></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan="2"><input type="submit" value="Edit Event"></td></tr></table>
</form>

<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html><?php ob_end_flush() ?>
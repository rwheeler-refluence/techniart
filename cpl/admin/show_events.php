<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$ID=$_GET['ID'];
if($ID){
	$act=$_GET['act'];
	if($act=='pub'){
		$sql="update tblEvents set eventPub='Yes' where eventID='$ID'";
	}else{
		$sql="update tblEvents set eventPub='No' where eventID='$ID'";
	}
	$result=db_query($sql);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Techniart, Inc</title>

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
<td><span class="title_main_sub">Events:</span>&nbsp;&nbsp;<span class="title_sub_level2">Show Events</span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<a class="body_content" href="add_event.php">Add Event</a><br><br>
<?
$sql="select *,YEAR(stamp) as date_year, MONTH(stamp) as date_mo, DAY(stamp) as date_day from tblEvents order by stamp desc";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No entries in database<br>\n");
		}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Event Title</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>City,State</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Date</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Published?</b></span></td>\n");
		print("<td width=\"125\">&nbsp;</td>\n");
		print("</tr>\n");
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
			$eventAddress=stripslashes($row['eventAddress']);
			$eventAddress2=stripslashes($row['eventAddress2']);
			$eventAddress3=stripslashes($row['eventAddress3']);
			$eventPub=$row['eventPub'];
			$eventCity=$row['eventCity'];
			$eventState=$row['eventState'];
			print("<tr bgcolor=\"eaeef4\">\n");
			print("<td><span class=\"body_content\">".$eventTitle."</span></td>");
			print("<td><span class=\"body_content\">".$eventCity.",".$eventState."</span></td>");
			print("<td><span class=\"body_content\">".$date_mo."/".$date_day."/".$date_year."</span></td>");
			print("<td><span class=\"body_content\">".$eventPub."<br>");
			if($eventPub=='Yes'){
				print("<a class=\"body_content\" href=\"".$_SERVER['PHP_SELF']."?ID=".$eventID."&act=depub\">De-Publish?</a>");
			}else{
				print("<a class=\"body_content\" href=\"".$_SERVER['PHP_SELF']."?ID=".$eventID."&act=pub\">Publish?</a>");
			}
			print("</span></td>");
			print("<td><img src=\"pix/b_edit.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"edit_event.php?ID=".$eventID."\">Edit Event</a><br><img src=\"pix/b_delete.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"#\" ONCLICK=\"javascript:decision('Are you sure you want to delete this entry?', 'del_event.php?ID=".$eventID."')\">Delete</a>");
			print("</td>");
			print("</tr>\n");
		}
		print("</table><br>");
}
?><br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
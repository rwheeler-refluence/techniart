<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$ID=$_GET['ID'];
if($ID){
	$act=$_GET['act'];
	if($act=='pub'){
		$sql="update tblDaily set dailyPub='Yes' where dailyID='$ID'";
	}else{
		$sql="update tblDaily set dailyPub='No' where dailyID='$ID'";
	}
	$result=db_query($sql);
}
?>
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
<td><span class="title_main_sub">Thought of the Day:</span>&nbsp;&nbsp;<span class="title_sub_level2">Show Thoughts of the Day</span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<a class="body_content" href="add_daily.php">Add Thought of the Day</a><br><br>
<?
$page=$_GET['page'];
$limitvalue=25;
if(!$page || $page==1){
	$limit=0;
}else{
	$limit=($page-1)*$limitvalue;
}
$sqlcount="select dailyID,dailyText,YEAR(dailyDate) as dailyDate_year, MONTH(dailyDate) as dailyDate_mo, DAY(dailyDate) as dailyDate_day,dailyPub from tblDaily order by dailyDate desc";
$resultcount=db_query($sqlcount);
$numrows=mysql_num_rows($resultcount);
$numpages=ceil($numrows/$limitvalue);

		$sql="select dailyID,dailyText,YEAR(dailyDate) as dailyDate_year, MONTH(dailyDate) as dailyDate_mo, DAY(dailyDate) as dailyDate_day,dailyPub,stamp from tblDaily order by stamp desc limit $limit,$limitvalue";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No entries in database<br>\n");
		}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Thought</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Date</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Published?</b></span></td>\n");
		print("<td width=\"125\">&nbsp;</td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
			$dailyID=$row['dailyID'];
			$dailyTitle=stripslashes($row['dailyTitle']);
			$dailyText=stripslashes($row['dailyText']);
			$dailyDate_year=$row['dailyDate_year'];
			$dailyDate_mo=$row['dailyDate_mo'];
			$dailyDate_day=$row['dailyDate_day'];
			$stamp=strftime("%D",$row['stamp']);
			$comb="".$dailyDate_year."-".$dailyDate_mo."-".$dailyDate_day."";
			$dailyPub=$row['dailyPub'];
			print("<tr bgcolor=\"eaeef4\">\n");
			print("<td><span class=\"body_content\">");
			if($dailyTitle){
				print("<b>".$dailyTitle."</b><br>");
			}
			print("".$dailyText."");
			print("</span></td>");
			print("<td><span class=\"body_content\">".$stamp."</span></td>");
			print("<td><span class=\"body_content\">".$dailyPub."<br>");
			if($dailyPub=='Yes'){
				print("<a class=\"body_content\" href=\"".$_SERVER['PHP_SELF']."?ID=".$dailyID."&act=depub\">De-Publish?</a>");
			}else{
				print("<a class=\"body_content\" href=\"".$_SERVER['PHP_SELF']."?ID=".$dailyID."&act=pub\">Publish?</a>");
			}
			print("</span></td>");
			print("<td><img src=\"pix/b_edit.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"edit_daily.php?ID=".$dailyID."\">Edit</a><br><img src=\"pix/b_delete.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"#\" ONCLICK=\"javascript:decision('Are you sure you want to delete this entry?', 'del_daily.php?ID=".$dailyID."')\">Delete</a>");
			print("</td>");
			print("</tr>\n");
		}
		print("</table><br>");
}
?>
<span class="body_content">
<?for($i=1;$i<=$numpages;$i++){?>
<a class="body_content" href="show_daily.php?page=<? echo($i);?>">Page <? echo($i);?></a>
<? if($i==1 || $i<$numpages){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?}?>
<?}?>
</span>
<br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
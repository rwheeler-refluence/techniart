<? include("database.php"); ?>
<? include("secure.php"); ?>
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
<td><span class="title_main_sub">Mailing List Subscribers:</span>&nbsp;&nbsp;</td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<?
$page=$_GET['page'];
$limitvalue=200;
if(!$page || $page==1){
	$limit=0;
}else{
	$limit=($page-1)*$limitvalue;
}
$sqlcount="select * from tblSubscribers order by stamp1 desc";
$resultcount=db_query($sqlcount);
$numrows=mysql_num_rows($resultcount);
$numpages=ceil($numrows/$limitvalue);

		$sql="select * from tblSubscribers order by stamp1 desc limit $limit,$limitvalue";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No entries in database<br>\n");
		}else{
		print("<span class=\"body_content\"><b>".$numrows." subscribers</b></span><br>");
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		#print("<td><span class=\"body_content\"><b>Name</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Email</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Timestamp</b></span></td>\n");
		print("<td width=\"125\">&nbsp;</td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
			$listID=$row['listID'];
			$name=stripslashes($row['name']);
			$email=stripslashes($row['email']);
			$stamp=strftime("%D",$row['stamp1']);
			print("<tr bgcolor=\"eaeef4\">\n");
			#print("<td><span class=\"body_content\">");
			#print("".$name."");
			#print("</span></td>");
			print("<td><span class=\"body_content\">".$email."</span></td>");
			print("<td><span class=\"body_content\">".$stamp."");
			print("</span></td>");
			print("<td><img src=\"pix/b_delete.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"#\" ONCLICK=\"javascript:decision('Are you sure you want to delete this entry?', 'del_list.php?ID=".$listID."')\">Delete</a>");
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
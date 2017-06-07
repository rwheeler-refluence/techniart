<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$ID=$_GET['ID'];
if($ID){
	$act=$_GET['act'];
	if($act=='pub'){
		$sql="update tblTestim set testimPub='Yes' where testimID='$ID'";
	}else{
		$sql="update tblTestim set testimPub='No' where testimID='$ID'";
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
<td><span class="title_main_sub">Testimonials:</span>&nbsp;&nbsp;<span class="title_sub_level2">Show Testimonials</span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<a class="body_content" href="add_testim.php">Add Testimonial</a><br><br>
<?
$sql="select * from tblTestim order by testimID asc";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No entries in database<br>\n");
		}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Testimonial</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Published?</b></span></td>\n");
		print("<td width=\"125\">&nbsp;</td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
			$testimID=$row['testimID'];
			$testimText=stripslashes($row['testimText']);
			$testimFrom=stripslashes($row['testimFrom']);
			$testimPub=$row['testimPub'];
			print("<tr bgcolor=\"eaeef4\">\n");
			print("<td><span class=\"body_content\">".$testimText."<br><i>".$testimFrom."</i></span></td>");
			print("<td><span class=\"body_content\">".$testimPub."<br>");
			if($testimPub=='Yes'){
				print("<a class=\"body_content\" href=\"".$_SERVER['PHP_SELF']."?ID=".$testimID."&act=depub\">De-Publish?</a>");
			}else{
				print("<a class=\"body_content\" href=\"".$_SERVER['PHP_SELF']."?ID=".$testimID."&act=pub\">Publish?</a>");
			}
			print("</span></td>");
			print("<td><img src=\"pix/b_edit.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"edit_testim.php?ID=".$testimID."\">Edit Testimonial</a><br><img src=\"pix/b_delete.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"#\" ONCLICK=\"javascript:decision('Are you sure you want to delete this entry?', 'del_testim.php?ID=".$testimID."')\">Delete</a>");
			print("</td>");
			print("</tr>\n");
		}
		print("</table><br>");
}
?><br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
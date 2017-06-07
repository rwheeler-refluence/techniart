<? include("database.php"); ?>
<? include("secure.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Mass Save Email Sign-Up</title>

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
<? include("body_top1.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main_sub">Contact Form Submissions:</span>&nbsp;&nbsp;</td>
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
$sqlcount="select * from tblContact order by stamp desc";
$resultcount=db_query($sqlcount);
$numrows=mysql_num_rows($resultcount);
$numpages=ceil($numrows/$limitvalue);

		$sql="select * from tblContact order by stamp desc limit $limit,$limitvalue";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No entries in database<br>\n");
		}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Timestamp</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Email</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Zip</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Question</b></span></td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
			$contactID=$row['contactID'];
			$stamp=strftime("%D",$row['stamp']);
			$email=stripslashes($row['email']);
			$zip=($row['zip']);
			$question=($row['question']);
			print("<tr bgcolor=\"eaeef4\">\n");
			print("<td><span class=\"body_content\">".$stamp."");
			print("</span></td>");
			print("<td><span class=\"body_content\">");
			print("".$email."");
			print("</span></td>");
			print("<td><span class=\"body_content\">".$zip."</span></td>");
			print("<td><span class=\"body_content\">".$question."</span></td>");
			print("</tr>\n");
			print("<tr bgcolor=\"eaeef4\">\n");
			print("<div align=\"right\" style=\"padding-right:20px;\"><a class=\"body_content\" href=\"dl_signup.php\">Download as *.csv</a></div>\n");
		}
		print("</table><br>");
}
?>
<span class="body_content">
<?for($i=1;$i<=$numpages;$i++){?>

<? if($i==1 || $i<$numpages){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?}?>
<?}?>
</span>
<br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
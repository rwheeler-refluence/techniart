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
<td><span class="title_main_sub">Contact Form Submissions:</span>&nbsp;&nbsp;</td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<a class="body_content" href="javascript: history.go(-1);"><< Back</a><br><br>
<?
$ID=$_GET['ID'];
		$sql="select * from tblContact where contactID='$ID'";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No entries in database<br>\n");
		}else{
		while($row=mysql_fetch_array($result)){
			$contactID=$row['contactID'];
			$fname=stripslashes($row['fname']);
			$lname=stripslashes($row['lname']);
			$email=stripslashes($row['email']);
			$stamp=strftime("%D",$row['stamp']);
			$address=stripslashes($row['address']);
			$address2=stripslashes($row['address2']);
			$city=stripslashes($row['city']);
			$state=stripslashes($row['state']);
			$zip=stripslashes($row['zip']);
			$notes=stripslashes($row['notes']);
			$phone=stripslashes($row['phone']);
			
			print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Name</b></span></td>\n");
			print("<td><span class=\"body_content\">");
			print("".$fname." ".$lname."");
			print("</span></td>");
			print("</tr><tr vailgn=\"top\">\n");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Email</b></span></td>\n");
			print("<td><span class=\"body_content\">".$email."</span></td>");
			print("</tr><tr vailgn=\"top\">\n");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Address</b></span></td>\n");
			print("<td><span class=\"body_content\">".$address." ".$address2."<br>".$city.", ".$state." ".$zip."</span></td>");
			print("</tr><tr vailgn=\"top\">\n");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Phone</b></span></td>\n");
			print("<td><span class=\"body_content\">".$phone."</span></td>");
			print("</tr><tr vailgn=\"top\">\n");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Comments</b></span></td>\n");
			print("<td><span class=\"body_content\">".$notes."");
			print("</tr><tr vailgn=\"top\">\n");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Timestamp</b></span></td>\n");
			print("<td><span class=\"body_content\">".$stamp."");
			print("</tr>\n");
		}
		print("</table><br>");
}
?>
<br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
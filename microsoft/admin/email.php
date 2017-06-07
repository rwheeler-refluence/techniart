<? include("database.php"); ?>
<? include("secure.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Spirit of Golf</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet_popup.css">
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
</head>

<BODY>
<span class="body_content">
<?
$ID=$_GET['ID'];
$sqlnotify="select * from tblNotify where notifyID='$ID'";
$resultnotify=db_query($sqlnotify);
while($rownotify=mysql_fetch_array($resultnotify)){
	$body=$rownotify['body'];
	$body=str_replace("\n","<br>",$body);
	$stamp=strftime("%D",$rownotify['stamp']);
	print("<b>To:</b> ".$rownotify['to']."<br><br>");
	print("<b>Subject:</b><br>");
	print($rownotify['subject']."<br><br>");
	print("<b>Message:</b><br>");
	print($body."<br><br>");
}
?>
<br>
<a class="body_content" href="javascript: window.close();">Close Window</a>
</span>
</body>
</html>
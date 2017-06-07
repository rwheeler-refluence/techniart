<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php"); ?>
<? include("editor/fckeditor.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>CRUCMS - by Crucial Networking</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>

<STYLE>
BODY {
background-color : #18304c;
background-image: url(pix/g_bkg.gif);
background-repeat: repeat-x;
background-position: top center; 
font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
color : #ffffff;
margin: 0px; 
}
</STYLE>

</head>
<BODY>
<?
$ID=$_GET['ID'];
$sql="select * from tblQA where questionID='$ID'";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$questionID=$row['questionID'];
	$questionTitle=stripslashes($row['questionTitle']);
	$questionAns=stripslashes($row['questionAns']);
	$questionPub=$row['questionPub'];
}
?>
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main_sub">Q&A</span>&nbsp;&nbsp;<span class="title_sub_level2">Read Q&A</span><br></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<?
if($msg){
	print("<h2>".$msg."</h2>\n");
}?>
<a class="body_content" href="javascript:history.go(-1);"><< Back</a><br><br>
<form method="post" action="<? echo($PHP_SELF); ?>" enctype="multipart/form-data">
<input type="hidden" name="action" value="add">
<input type="hidden" name="questionID" value="<? echo($questionID); ?>">

<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<span class="body_content">
<b><? echo($questionTitle);?></b>
<br><br>
<? echo($questionAns);?>
<? include("body_bot.php"); ?>

</body>
</html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>TechniArt CMS -- Login</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
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

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<table width="975" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="230"><img src="pix/pix_trans.gif" alt="" width="230" height="21" border="0"><br>
<img src="pix/g_navbar_top.gif" alt="" width="230" height="14" border="0"></td>
<td width="745"><img src="pix/g_body_top.gif" alt="" width="745" height="35" border="0"></td>
</tr></table>
<!-- end navigation/body -->

<!-- begin body -->
<table width="975" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff"><tr valign="top">
<td width="17" class="nav_bkg"><img src="pix/pix_trans.gif" alt="" width="17" height="1" border="0"></td>
<td width="190" class="nav_bkg">&nbsp;</td>
<td width="23"><img src="pix/g_navbar_fade_rt.gif" alt="" width="23" height="420" border="0"></td>
<td width="25"><img src="pix/g_body_fade_lt.gif" alt="" width="25" height="431" border="0"></td>
<td width="671" class="body_bkg">

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main">Please Login</span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<form name="login" action="login.php" method="post">
<span class="body_content"><b>Username:</b></span><br>
<input type="text" name="user" class="forms"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<span class="body_content"><b>Password:</b></span><br>
<input type="password" name="pass" class="forms"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="8" border="0"><br>
<input type="submit" value="login">
</form>
<br><br></span>
<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
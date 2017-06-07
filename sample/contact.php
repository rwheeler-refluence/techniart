<? include("database.php"); ?>
<?
$s_email=$_SESSION['s_email'];
$s_fname=$_SESSION['s_fname'];
$s_lname=$_SESSION['s_lname'];
$s_address1=$_SESSION['s_address1'];
$s_address2=$_SESSION['s_address2'];
$s_city=$_SESSION['s_city'];
$s_state=$_SESSION['s_state'];
$s_zip=$_SESSION['s_zip'];
$s_phone=$_SESSION['s_phone'];
$s_best_time=$_SESSION['s_best_time'];
$s_notes=$_SESSION['s_notes'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Marketing The Future</title>

<meta name="robots" content="index,follow" />
<meta name="author" content="TechniArt" />
<meta name="publisher" content="techniart.com" />
<meta name="copyright" content="Copyright 2008 TechniArt. All Rights Reserved" />
<meta http-equiv="content-language" content="EN" />
<meta name="content-language" content="EN" />
<meta name="rating" content="All" />
<meta name="audience" content="General" />
<meta name="distribution" content="Global" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
</head>

<BODY>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Contact</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
<td width="649"><div id="main_content_ip" align="left"><span class="body_content_style1">
<?
$msg=$_GET['msg'];
if($msg=='security'){
	print("<h3>The security code you entered does not match.  Please try again.</h3>\n");
}
?>
<form method="post" action="sendmail.php">
<input type="hidden" name="aa" value="contactpage">
<table width="580" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="205"><span class="body_content_blue"><b>First Name:</b><br>
<input type="text" size="30" name="fname" class="forms3" value="<? echo($s_fname); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Last Name:</b><br>
<input type="text" size="30" name="lname" class="forms3" value="<? echo($s_lname); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Building Name:</b><br>
<input type="text" size="30" name="address" class="forms3" value="<? echo($s_address); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Room Number:</b><br>
<input type="text" size="30" name="address2" class="forms3" value="<? echo($s_address2); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<table width="205" border="0" cellspacing="0" cellpadding="0"><tr valign="top">

</tr></table>

<b>Email:</b><br>
<input type="text" size="30" name="email" class="forms3" value="<? echo($s_email); ?>"><br>
<b>Pickup Location:</b><br>
<select name="best_time" class="forms3">
    <option></option>
    <option value="29 Garden Street Common Room - Oct 25th  10am-12pm">29 Garden Street Common Room - Oct 25th  10am-12pm</option>
    <option value="Peabody Terrace Common Room - Oct 26th 3pm-5pm">Peabody Terrace Common Room - Oct 26th 3pm-5pm</option>
  </select><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br></span></td>
<td width="20"><img src="pix/pix_trans.gif" alt="" width="20" height="1" border="0"></td>
<td width="365"><span class="body_content_blue">
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Swap Quantity</b><br>
<SELECT NAME="phone" class="forms2">
<OPTION VALUE=""></OPTION>
<OPTION VALUE="1">1</OPTION>
<OPTION VALUE="2">2</OPTION>
</SELECT><br>
<b>Comments</b><br>
<textarea name="notes" cols="30" rows="10" class="forms_comment"></textarea><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>

<b>Security</b><br>
<!--security-->
<?
$days=array("1","2","3","4","5","6","7");
$chosen=array_rand($days,1);
?>
<input type="hidden" name="chosen" value="<? echo($days[$chosen]); ?>">
<img src="pix/security/<? echo("cv".$days[$chosen].".gif");?>">
<br>
<b>Please enter the characters you<br>
see above in the box below:</b><br></span>
<input type="text" name="security" size="8" class="forms2">
<br><br>
<!--end security-->
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit">
</form></td>
</tr></table>


</span>

<br><br></div></td>
<td width="200">

<!-- ------------------------------begin callouts------------------------------ -->
<table align="left"><tr><td><img src="swap.png"><br><br><span class="section_heading_style1"><b>The LED SlimStyle bulbs provided in the bulb swap are ONLY to be used on campus.</b></span></td></tr></table>
<!-- ------------------------------end callouts------------------------------ -->

</td>
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="1" border="0"></td>
</tr></table>

</div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><img src="pix/g_body_bot.gif" alt="" width="906" height="12" border="0"></td>
</tr></table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7592070-3");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>


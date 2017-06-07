<? include("database.php");?>
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
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Employment Opportunities</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" rowspan="2" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
<td width="200" height="114"><div id="main_content_ip" align="left">
<? $state=$_GET['state'];?>
<a class="body_content_events-public" href="employment.php?state=CT">Connecticut</a><br>
<a class="body_content_events-public" href="employment.php?state=MA">Massachusetts</a><br>
<a class="body_content_events-public" href="employment.php?state=NH">New Hampshire</a><br>
<a class="body_content_events-public" href="employment.php?state=NJ">New Jersey</a><br>
<a class="body_content_events-public" href="employment.php?state=NY">New York</a><br>
<br><br></div></td>
<td width="451" height="114" valign="top"><div align="center">
</div></td>
<td width="245" rowspan="2">

<!-- ------------------------------begin callouts------------------------------ -->
<? include("callouts.php"); ?>
<!-- ------------------------------end callouts------------------------------ --></td>
<td width="1" rowspan="2" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="1" border="0"></td>
</tr>
  <tr valign="top" align="center">
    <td colspan="2">
<?
$query="SELECT * FROM tblEmployment";
$result=mysql_query($query);

$num=mysql_num_rows($result);

echo "<b><center>Database Output</center></b><br><br>";

$i=0;
while ($i < $num) {

$jobTitle=mysql_result($result,$i,"jobTitle");
$jobDescription=mysql_result($result,$i,"jobDescription");
$jobState=mysql_result($result,$i,"jobState");
$mobile=mysql_result($result,$i,"mobile");
$fax=mysql_result($result,$i,"fax");
$email=mysql_result($result,$i,"email");
$web=mysql_result($result,$i,"web");

echo "<b>$jobTitle $jobDescription</b><br>Phone: $phone<br>Mobile: $mobile<br>Fax: $fax<br>E-mail: $email<br>Web: $web<br><hr><br>";

$i++;
}

?></td>
  </tr>
</table>

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
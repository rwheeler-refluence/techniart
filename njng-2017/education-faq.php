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
<a name="top"></a>
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Frequently Asked Questions</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
<td width="649"><div id="main_content_ip" align="left">
<span class="body_content_style1">

<p class="body_content_style1">
<?
$sql="select * from tblFAQs order by faqID asc";
$result=db_query($sql);
print("<a name=\"top\"></a>\n");
print("<ol>");
while($row=mysql_fetch_array($result)){
	$faqQues=stripslashes($row['faqQues']);
	$faqAns=stripslashes($row['faqAns']);
	$faqID=$row['faqID'];
	print("<li><a class=\"body_content_style1\" href=\"#".$faqID."\">".$faqQues."</a>\n");
	$prn.="<a name=\"".$faqID."\"></a><b>".$faqQues."</b><br>\n";
	$prn.="".$faqAns."<br>\n";
	$prn.="<div align=\"right\" style=\"border-bottom:1px solid #e6e6e6;\"><a class=\"body_content_style1\" href=\"#top\">Back to Top</a></div><br>\n";
}
print("</ol><br>");
print($prn);
?>

</p>	 

<img src="pix/LightOutput_Equival_Chart.jpg" alt="Light Output Equivalency chart" />
</span><br><br></div></td>
<td width="256">

<!-- ------------------------------begin callouts------------------------------ -->
<? include("callouts.php"); ?>
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


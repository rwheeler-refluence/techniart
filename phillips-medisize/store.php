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
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Store</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
<td width="904"><div id="main_content_ip" align="left">

<!-- ------------------------------begin default zip code display------------------------------ -->
<div id="zip-search-ip_bkg" align="left">
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="506"><div id="main_content_zip-callout_ip"><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Special pricing based on location</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style2"><i>Search for special rebates &amp; pricing</i></span><br><br>

<table width="331" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="110">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style3">Zip Code</span>&nbsp;&nbsp;</td>
<td width="160"><form><input type="text" size="30" name="zipcode" class="forms1"></td>
<td width="61"><input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit"></form></td>
</tr></table>

</div></div></td>
<td width="347"><div id="main_content_zip-callout_ip">
<?$cat=$_GET['cat'];?>
<form><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Shop by category</span><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<table border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<SELECT NAME="cat" class="forms5" onChange="if (this.selectedIndex >0) window.location=this.options[this.selectedIndex].value">
<? if(!$cat){
	print("<OPTION VALUE=\"Select Category\" selected></OPTION>\n");
}else{
	print("<OPTION VALUE=\"Select Category\"></OPTION>\n");
}

$sql="select distinct category from tblProducts order by category asc";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$category=$row['category'];
	print("<OPTION VALUE=\"store.php?cat=".$category."\" ");
	if($category==$cat){
		print("selected");
	}
	print(">".$category."</OPTION>\n");
}
?>
</SELECT>&nbsp;&nbsp;</td>
</tr></table></form>

<form><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Search our store</span><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>

<table border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="search-store" type="text" id="search-store" size="40" value="" class="forms1">&nbsp;&nbsp;</td>
<td><input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit"></td>
</tr></table></form>

</div></td>
</tr></table>
</div><br>
<!-- ------------------------------end default zip code display------------------------------ -->

<!-- ------------------------------begin products - row 1------------------------------ -->
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
</tr></table><br><br>
<!-- ------------------------------end products - row 1------------------------------ -->

<!-- ------------------------------begin products - row 2------------------------------ -->
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
</tr></table><br><br>
<!-- ------------------------------end products - row 2------------------------------ -->

<!-- ------------------------------begin products - row 3------------------------------ -->
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>
<td width="275">

<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="71"><img src="pix/th_placeholder.jpg" alt="" width="61" height="125" border="0" class="img_stroke"></td>
<td width="204"><span class="product_title">Product Title</span><br>
<span class="product_number">#MLM20S</span><br><br>

<span class="product_price">$1.10</span><br>
<a href="store-detail.php"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
<a href="store-detail.php"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
</tr></table>

</td>
</tr></table><br><br>
<!-- ------------------------------end products - row 3------------------------------ -->

</div></td>
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


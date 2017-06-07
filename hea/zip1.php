<? 
$page=$_SERVER['REQUEST_URI'];
$cat=$_GET['cat'];

$select.="<SELECT NAME=\"cat\" class=\"forms5\" onChange=\"if (this.selectedIndex >0) window.location=this.options[this.selectedIndex].value\">\n";
if(!$cat){
	$select.="<OPTION VALUE=\"Select Category\" selected></OPTION>\n";
#	$cat="Spiral CFLs";
}else{
	$select.="<OPTION VALUE=\"Select Category\"></OPTION>\n";
}

$sql="select distinct category from tblProducts order by category asc";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$category=$row['category'];
	$select.="<OPTION VALUE=\"store-cat.php?cat=".$category."\" \n";
	if($category==$cat){
		$select.="selected";
	}
	$select.=">".$category."</OPTION>\n";
}
$select.="</SELECT>\n";

?>
<? if($_SESSION['zip']){?>
<!-- ------------------------------begin your zip is... display------------------------------ -->
<div id="zip-search-ip_bkg" align="left">
<table width="840" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="493"><div id="main_content_zip-callout_ip" name="main_content_zip-callout_ip"><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Your zip code is <span style="font-size: 22px;"><? echo($_SESSION['zip']);?></span>. <a href="#" onClick="javscript:window.open('changezip_form1.php?redir=<? echo($page);?>','popup2a','scrollbars=yes, resizeable=yes,width=360,height=200,screenY=200,top=40, left=120');" class="section_heading_style1" style="text-decoration: underline;">Change zip code</a></span><br>

<?
$sqldis="select * from tblTerritory LEFT OUTER JOIN tblVendors on tblTerritory.vendor=tblVendors.vendorID where tblTerritory.zip='$_SESSION[zip]'";
$resultdis=db_query($sqldis);
$countdis=mysql_num_rows($resultdis);
if($countdis>0){
	print("<span class=\"section_heading_style1\"><b>Discounted prices made possible by:</b></span><br>\n");
	while($rowdis=mysql_fetch_array($resultdis)){
		$vendorLogo=$rowdis['vendorLogo'];
		$vendor=$rowdis['vendor'];
			$loc=$rootDir."pix/logos/".$vendorLogo;
			if(file_exists($loc)){
			list($width, $height, $type, $attr) = getimagesize($loc);
				if($height>120){
					$newheight_divisor=120/$height;
					$height=$height*$newheight_divisor;
					$width=$width*$newheight_divisor;
				}else{
					$width=$width;
					$height=$height;
				}
			}
		if($vendor=='9'){
			print("<table align=\"left\"><tr><td>\n");
		}
		print("<img src=\"pix/logos/".$vendorLogo."\" class=\"img_stroke\" width=\"".$width."\" height=\"".$height."\">\n");
		if($vendor=='9'){
			print("</td></tr></table><span class=\"section_heading_style1\">Customers referred to this website through a <i>Lighting Fair</i> must call 860-693-2450 to place an order.</span>\n");
		}
	}
}
?>
</td>
<td width="347"><div id="main_content_zip-callout_ip">

<form><table border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0"></td>
<td><span class="section_heading_style1">Shop by category</span><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>

<? echo($select);?>&nbsp;&nbsp;</td>
</tr></table></form>

<form method="get" action="search.php"><input type="hidden" name="action" value="search"><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Search our store</span>&nbsp;<span class="body_content_style2">(<a class="body_content_style2" href="search.php">Advanced Search</a>)</span><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>

<table border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="keyword" type="text" id="keyword" size="40" value="" class="forms1">&nbsp;&nbsp;</td>
<td><input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit" onclick="this.form.submit();"></td>
</tr></table></form>

</div></td>
</tr></table>
</div><br>
<!-- ------------------------------end your zip is... display------------------------------ -->
<?}else{?>
<!-- ------------------------------begin default zip code display------------------------------ -->
<div id="zip-search-ip_bkg" align="left">
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="506"><div id="main_content_zip-callout_ip"><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Special pricing based on location</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style2"><i>Search for special rebates &amp; pricing</i></span><br><br>

<table width="331" border="0" cellspacing="0" cellpadding="0"><tr valign="top"><form method="post" action="changezip1.php" target="_new"><input type="hidden" name="redir" value="<? echo($page);?>">
<td width="110" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style3">Zip Code</span>&nbsp;&nbsp;</td>
<td width="160"><form><input type="text" size="30" name="zipcode" class="forms1"></td>
<td width="61"><input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit" onClick="this.form.submit();"></form></td>
</tr><tr valign="top">
<td colspan="3" style="padding-left:30px;"><span class="body_content_style1"><i>Arizona Public Service customers: please enter your 5 digit zip code plus your 4 digit extension. Don't know it? <a class="body_content_style1" href="http://zip4.usps.com/zip4/welcome.jsp" target="_blank">Click here to find out</a>.</i><br></span></td>
</tr></table>

</div></div></td>
<td width="347"><div id="main_content_zip-callout_ip">
<form><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Shop by category</span><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<table border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<? echo($select);?>&nbsp;&nbsp;</td>
</tr></table></form>

<form method="get" action="search.php"><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Search our store</span>&nbsp;<span class="body_content_style2">(<a class="body_content_style2" href="search.php">Advanced Search</a>)</span><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>

<table border="0" cellspacing="0" cellpadding="0"><tr valign="top"><input type="hidden" name="action" value="search">
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="keyword" type="text" id="keyword" size="40" value="" class="forms1">&nbsp;&nbsp;</td>
<td><input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit"></td>
</tr></table></form>
<br><img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0">

</div></td>
</tr></table>
</div><br>
<!-- ------------------------------end default zip code display------------------------------ -->
<?}?>
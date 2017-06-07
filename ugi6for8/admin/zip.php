<? if($_SESSION['zip']){?>
<div id="zip-search-ip_bkg" align="left">
<table width="300" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="300"><div id="main_content_zip-callout_ip" name="main_content_zip-callout_ip"><br>

<?
$sqldis="select * from tblTerritory_facebook LEFT OUTER JOIN tblVendors_facebook on tblTerritory_facebook.vendor=tblVendors_facebook.vendorID where tblTerritory_facebook.zip='$_SESSION[zip]'";
$resultdis=db_query($sqldis);
$countdis=mysql_num_rows($resultdis);
if($countdis>0){
	print("<span class=\"section_heading_style1\"><b>Look for discounted prices provided by:</b></span><br>\n");
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
			print("</td></tr></table>");
			#<span class=\"section_heading_style1\">Customers referred to this website through a <i>Lighting Fair</i> must call 860-693-2450 to place an order.</span>\n");
		}
	}
}
?>
</td>
<td width="347"><div id="main_content_zip-callout_ip">

<form>

</div></td>
</tr></table>
</div><br>
<!-- ------------------------------end your zip is... display------------------------------ -->
<?}else{?>
<!-- ------------------------------begin default zip code display------------------------------ -->
<div id="zip-search-ip_bkg" align="left">

</div><br>
<!-- ------------------------------end default zip code display------------------------------ -->
<?}?>
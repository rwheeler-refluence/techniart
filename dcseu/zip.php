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
<link href="stylesheet.css" rel="stylesheet" type="text/css" />

<div id="zip-search-ip_bkg" align="left">
<table width="840" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="452"><div id="main_content_zip-callout_ip" name="main_content_zip-callout_ip"><span class="product_title_sm"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Your zip code is <span style="font-size: 22px;"><? echo($_SESSION['zip']);?></span>.</span><br>

<?
$sqldis="select * from tblTerritory LEFT OUTER JOIN tblVendors on tblTerritory.vendor=tblVendors.vendorID where tblTerritory.zip='$_SESSION[zip]'";
$resultdis=db_query($sqldis);
$countdis=mysql_num_rows($resultdis);
if($countdis>0){
	print("<span class=\"section_heading_style1\"><b>Look for discounted prices provided by</span><br><span class=\"product_title_lg\">DC Sustainable Energy Utility</span>.</b><br><br>\n");
}
?>
</td>
<td width="388" valign="middle"><div id="style3">
<div align="center"><span class="style3"><strong>Get $7 flat rate shipping</strong><br />
      on all orders over $25!</span><br /><br /><span class="product_price">Limit of 12 bulbs per purchase.<br />
      </span></div>
</div></td>
</tr></table>
</div><br>
<!-- ------------------------------end your zip is... display------------------------------ -->
<?}else{?>
<!-- ------------------------------begin default zip code display------------------------------ -->
<div id="zip-search-ip_bkg" align="left">
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="400"><div id="main_content_zip-callout_ip"><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Special pricing based on location</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="product_title1"><i>Search for special rebates &amp; pricing</i></span><br><br>

<table border="0" cellspacing="0" cellpadding="0"><tr valign="middle"><form method="post" action="changezip.php" target="_new"><input type="hidden" name="redir" value="<? echo($page);?>">
<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="product_title">ZIP CODE</span>&nbsp;&nbsp;</td>
<td valign="middle"><form><input type="text" size="8" name="zipcode" class="forms2"></td>
<td valign="bottom">&nbsp;<input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit" onClick="this.form.submit();"></form></td>
</tr></table>

</div>
<td width="453" valign="middle"><div align="center"><span class="style3"><strong>Get $7 flat rate shipping</strong><br />
on all orders over $25!</span><br /><br /><span class="product_price">Limit of 12 bulbs per purchase.<br />
</span></div>
<tr><td colspan="2"></div><tr><td colspan="2"></td>
<tr><td colspan="2"><div id="main_content_zip-callout_ip">

</div></td>
</tr></table>
</div><br>
<!-- ------------------------------end default zip code display------------------------------ -->
<?}?>
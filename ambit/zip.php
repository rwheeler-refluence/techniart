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
<link href="stylesheet.css" rel="stylesheet" type="text/css" /><form action="remove-zip.php" method="post">
<div id="zip-search-ip_bkg" align="left">
<table width="840" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
  <td><div id="main_content_zip-callout_ip" name="main_content_zip-callout_ip"><span class="product_title_sm"><? if($_SESSION['rep']=="AEP"){?><img src="pix/g_arrow.jpg" /><?}else{?><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0"><?}?>Your zip/promo code is <span style="font-size: 18px;"><? echo($_SESSION['zip']);?></span>.</span> <input type="hidden" name="zip" value="" />
      <input type="submit" class="btn4" value="Remove" onclick="this.form.submit" /></form><br />
<span class="section_heading_style1">Look for discounted prices provided by</span><br>
    <span class="product_title_lg">Ambit Energy</span>.<br />
    <br />
  </td>
  <td width="372" rowspan="2" valign="middle"><div id="style3">
    <div align="center"><span class="style3"><strong>Get $7 flat rate shipping</strong><br />
      on all orders over $15!</span><br /><br /><span class="product_price">Limit of 24 bulbs per purchase.<br />
        </span></div>
  </div></td>
</tr>
  <tr valign="top">
    <td align="center"></td>
  </tr>
  </table>
</div>
<!-- ------------------------------end your zip is... display------------------------------ -->
<?}?>
<!-- ------------------------------begin default zip code display------------------------------ -->

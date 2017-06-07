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
<table width="906" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="418" rowspan="2"><div id="main_content_zip-callout_ip" name="main_content_zip-callout_ip"><span class="product_title_sm"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Your zip code is <span style="font-size: 22px;"><? echo($_SESSION['zip']);?></span>.</span><br>
  
  <span class="product_title"><b>Look for discounted prices provided by</span><br><span class="product_title_lg">Efficiency United</span>.</b><br><br>


</td>
<td width="488" height="39" align="left" valign="top"><span class="style34"><strong>FREE shipping</strong> on all orders!</span></td>
</tr>
  <tr valign="top">
    <td align="left" valign="middle"><span class="product_price_y">For a limited time only.</span> <span class="product_price_y"><br />
      Limit of 12 bulbs per purchase.</span></td>
  </tr>
  <tr valign="top">
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr valign="top">
    <td colspan="2"><img src="pix/hr_yellow.gif" width="906" height="6" /></td>
  </tr>
</table>
</div><br>
<!-- ------------------------------end your zip is... display------------------------------ -->
<?}else{?>
<!-- ------------------------------begin default zip code display------------------------------ -->
<div id="zip-search-ip_bkg" align="left">
<table width="906" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
  <td width="364" rowspan="2"><div id="main_content_zip-callout_ip"><span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Special pricing based on location</span><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="product_title1"><i>Search for special rebates &amp; pricing</i></span><br>
    
    <table width="358" border="0" cellpadding="0" cellspacing="0">
      <tr valign="middle">
        <td width="179" height="42" align="left" nowrap><span class="product_price"><span class="landing_berry"><strong>Utility:<br />
        </strong></span>
        <form name="form1" id="form1" method="post" action="changezip1.php" onSubmit="return fVerifyResForm();">
         <select name="utility" required class="forms5">
<option value=""></option>
<option value="1">Alpena Power Company</option>
<option value="2">Baraga Electric Company</option>
<option value="3">Crystal Falls E.D.</option>
<option value="4">Daggett Electric Company</option>
<option value="5">Dowagiac D.P.S.</option>
<option value="6">Gladstone L.U.</option>
<option value="7">Harbor Springs E.D.D.</option>
<option value="8">Hillsdale P.Pl.</option>
<option value="9">L'Anse Electric Utility</option>
<option value="10">Negaunee E.D.</option>
<option value="11">Norway L.D.</option>
<option value="12">South Haven B.P.U.</option>
<option value="13">Upper Peninsula Power</option>
<option value="14">Wisconsin Electric</option>
<option value="15">Wisconsin Public Service</option>
            </select>
        </span></td>
        <td width="179" valign="middle">&nbsp;</td>
        </tr>
      <tr valign="middle">
      <td valign="middle" nowrap><p><span class="landing_berry"><strong>Zip Code:<br />
      </strong></span>
        <input type="text" size="8" name="zipcode" class="forms2" />
      </p></td>
      <td valign="middle">&nbsp;<input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit" onClick="this.form.submit();"></form></td>
      </tr></table>
    
    </div>
    <td width="372" rowspan="2" valign="middle">
    <td width="534" align="left" valign="top"><span class="style34"><strong>FREE shipping</strong> on all orders!</span></tr>
  <tr valign="top">
    <td align="left" valign="top"><span class="product_price_y">For a limited time only.</span> <br />
      <span class="product_price_y">Limit of 12 bulbs per purchase.</span>  
    </tr>
  <tr valign="top">
    <td>  
    <td colspan="2" valign="middle">  
  </tr>
  <tr valign="top">
    <td>  
    <td colspan="2" valign="middle">  
  </tr>
  <tr valign="top">
    <td colspan="3"><img src="pix/hr_yellow.gif" width="906" height="6" />  </tr>
</table>
</div>
<!-- ------------------------------end default zip code display------------------------------ -->
<?}?>
<? if(!$_SESSION['zip']){echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('The ZIP code lost. Please re-enter your ZIP code.')
		window.location.href='http://www.techniart.us/effiencyunited'
        </SCRIPT>";}?>
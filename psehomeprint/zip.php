<style type="text/css">
.l2g {
  font-family: Arial;
  color: #58c3b4;
  font-size: 48px;
  font-weight:100;
}
.nav_text {
	font-family: Arial;
	font-size: 18px;
	color: #fff;
	text-align: left;
	}
a.nav_text:link {
	font-family: Arial;
	font-size: 18px;
	color: #fff;
	text-align: left;
	}
a.nav_text:visited {
	font-family: Arial;
	font-size: 18px;
	color: #fff;
	text-align: left;
	}
a.nav_text:hover {
	font-family: Arial;
	font-size: 18px;
	color: #000;
	text-align: left;
	}
.nav_bkg {
background-color:474C55;
background-repeat: repeat-x;
background-position: top center; 
}
a:link {
	color: #FFF;
	text-decoration: none;
}
a:visited {
	color: #FFF;
	text-decoration: none;
}
a:hover {
	color: #58c3b4;
	text-decoration: none;
}
a:active {
	color: #FFF;
	text-decoration: none;
}
</style>
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

<div>
<table width="906" height="167" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="40" rowspan="3" bgcolor="#81BE41"></td>
<td width="400" height="43" bgcolor="#81BE41">&nbsp;
</td>
<td width="12" rowspan="3" valign="middle"><div id="style3">
<div align="center"><span class="product_price"><br />
      </span></div>
</div></td>
<td width="42" rowspan="3" valign="middle" bgcolor="#B8C42E"><br />
<br /></td>
<td width="412" valign="middle" bgcolor="#B8C42E">&nbsp;</td>
</tr>
  <tr valign="top">
    <td bgcolor="#81BE41"><span class="zip_box">Your zip code is <span style="font-size: 22px;"><? echo($_SESSION['zip']);?></span><br><br />

<?
$sqldis="select * from tblTerritory LEFT OUTER JOIN tblVendors on tblTerritory.vendor=tblVendors.vendorID where tblTerritory.zip='$_SESSION[zip]'";
$resultdis=db_query($sqldis);
$countdis=mysql_num_rows($resultdis);
if($countdis>0){
	print("<span class=\"zip_box\">Look for discounted prices provided by</span><br><span class=\"zip_box\"><b>Puget Sound Energy</span>.</b><br><br>\n");
}
?>&nbsp;</td>
    <td width="412" valign="top" bgcolor="#B8C42E"><span class="zip_box"><strong>Get $7 flat rate shipping</strong><br />
on all orders over $50!</span><br />
<br />
<a href="brochure.pdf"><strong>Click here to learn how to participate</strong></a></td>
  </tr>
  <tr valign="top">
    <td bgcolor="#81BE41">&nbsp;</td>
    <td width="412" valign="middle" bgcolor="#B8C42E">&nbsp;</td>
  </tr>
</table>
</div>
<p><br>
  <!-- ------------------------------end your zip is... display------------------------------ -->
  <?}else{?>
</p>
<div>
  <table width="906" height="155" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr valign="top">
      <td width="40" rowspan="4" bgcolor="#81BE41"></td>
      <td height="43" colspan="3" bgcolor="#81BE41">&nbsp;</td>
      <td width="12" rowspan="4" valign="middle"><div id="style">
        <div align="center"><span class="product_price"><br />
          </span></div>
      </div></td>
      <td width="42" rowspan="4" valign="middle" bgcolor="#B8C42E"><br />
        <br />
        <br /></td>
      <td width="412" valign="middle" bgcolor="#B8C42E">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td height="54" colspan="3" bgcolor="#81BE41" class="zip_box">Special pricing based on location.<br />
        Search for special rebates &amp; pricing.</td>
      <td width="412" rowspan="2" valign="top" bgcolor="#B8C42E"><span class="zip_box"><strong>Get $7 flat rate shipping</strong><br />
        on all orders over $50!</span></td>
    </tr>
    <tr valign="top">
      <td width="90" valign="middle" bgcolor="#81BE41" class="zip_box">Zip code:</td><form method="post" action="changezip2.php">
      <td width="148" valign="middle" bgcolor="#81BE41" class="zip_box"><input type="text" size="8" name="zipcode" class="forms3"></td>
      <td width="162" valign="middle" bgcolor="#81BE41" class="zip_box"><input class="btn2" type="submit" value="Submit"></td>
    </tr>
    <tr valign="top">
      <td colspan="3" bgcolor="#81BE41">&nbsp;</td>
      <td width="412" valign="middle" bgcolor="#B8C42E">&nbsp;</td>
    </tr>
  </table>
</div>
<p><!-- ------------------------------begin default zip code display------------------------------ --><!-- ------------------------------end default zip code display------------------------------ -->
<?}?>

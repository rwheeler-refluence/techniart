<style type="text/css">
.efficiency_connection {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 34px;
	text-align: left;
	font-weight: bold;
}
</style>
<? $checkzip=$_SESSION['zip'];
#print $checkzip;
$logo="select vendor from tblTerritory_aep where zip='$checkzip'";
$logor=db_query($logo);
while($rowzip=mysql_fetch_array($logor)){
		$vendor=$rowzip['vendor'];}
#print $vendor;?>
<? if($vendor=='30'){
	$vendorname='CNP';
	$_SESSION['rep']=="CNP";
}else{
	if($vendor=='31'){
		$vendorname='AEP';
	$_SESSION['rep']=="AEP";
			}}
	?>
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="153" rowspan="3" align="left" valign="middle"><img src="pix/logos/champion-logo.png"width="153" height="85" border="0" /></td>
<td width="274" rowspan="3" align="center" valign="middle"><? if($_SESSION['rep']=="CNP"){?><img src="pix/logos/cnp.png" width="146" height="85" /><? }else{ if($vendor==31){?><img src="pix/logos/aep-small.png" width="225" height="63" /><?}}?></td>
<td width="479" align="right"><p class="secondary_nav"><a href="http://www.techniart.us/champion/contact.php" class="secondary_nav" title="Contact TechniArt">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.techniart.us/champion/customer-service.php" class="secondary_nav" title="TechniArt customer services">Customer Service</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.techniart.us/champion/cart.php" class="secondary_nav" title="Site Map">View Cart</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.techniart.us/champion/store.php" class="secondary_nav" title="Index">Home</a></p></td>
</tr>
  <tr valign="top">
    <td height="70" align="left"><br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="efficiency_connection">Efficiency Connection</span></td>
  </tr>
  <tr valign="top">
    <td align="right"></td>
  </tr>
</table>
<? #echo($_SESSION['rep']);?>
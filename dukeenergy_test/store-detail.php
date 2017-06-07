<? include("database.php");?>
<? $ID=$_GET['ID'];?>

<? $show=$_GET['show'];?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>Duke Energy Progress - Product Details</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="js/shadowbox.css">
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
</head>

<BODY><?php include_once("analyticstracking.php") ?><? include("nav.php")?>
<div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>
<!-- ------------------------------begin body------------------------------ -->


<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="main"><tr valign="top">
<td></td>
<td width="100%"><div id="main_content_ip" align="left">
<br>
<? include("zip.php");?>
<br>
<div id='cssmenu' style="padding-left: 22%">
<ul>
  
   <li class='has-sub'><a href='http://www.techniart.us/dukeenergy/store-cat.php?cat=General Purpose'><span>General Purpose</span></a></li>
   <li class='last'><a href='http://www.techniart.us/dukeenergy/store-cat.php?cat=Decorative'><span>Decorative</span></a></li>
   <li class='last'><a href='http://www.techniart.us/dukeenergy/store-cat.php?cat=Reflectors'><span>Reflectors</span></a></li>
   <li class='last'><a href='http://www.techniart.us/dukeenergy/store-cat.php?cat=Fixtures'><span>Fixtures</span></a></li>
</ul>
</div>
<!-- ------------------------------begin products -detail------------------------------ -->
<?
$sqlp="select * from tblProducts where productID='$ID'";
$resultp=db_query($sqlp);
while($rowp=mysql_fetch_array($resultp)){
	$productID=$rowp['productID'];
	$productName=$rowp['productName'];
	$imageLoc=$rowp['imageLoc'];
	$modelNumber=$rowp['modelNumber'];
	$category=$rowp['category'];
	$subcat1=$rowp['subcat1'];
	$subcat2=$rowp['subcat2'];
	$subcat3=$rowp['subcat3'];
	$class=$rowp['class'];
	$MOL=$rowp['MOL'];
	$watts_used=$rowp['watts_used'];
	$replacement_wattage=$rowp['replacement_wattage'];
	$MSRP=$rowp['MSRP'];
	$disct_price_nj=$rowp['disct_price_nj'];
	$disct_price=$rowp['disct_price'];
	$light_output=$rowp['light_output'];
	$color_temp=$rowp['color_temp'];
	$color_rendering=$rowp['color_rendering'];
	$rated_lifetime=$rowp['rated_lifetime'];
	$min_start_temp=$rowp['min_start_temp'];
	$electrical_spec=$rowp['electrical_spec'];
	$descrip=$rowp['descrip'];
	$recommended=$rowp['recommended'];
	$disclaimer=$rowp['disclaimer'];
	$subtitle=$rowp['subtitle'];
	$manuf=$rowp['manuf'];
	$base=$rowp['base'];
	$ceiling=$rowp['ceiling'];
	$pendant=$rowp['pendant'];
	$table_floor=$rowp['table_floor'];
	$extra=stripslashes($rowp['extra']);
	$ceiling_fans=$rowp['ceiling_fans'];
	$wallsconce=$rowp['wallsconce'];
	$recessedcans=$rowp['recessedcans'];
	$free_ship=$rowp['free_ship'];
	$replacement_bulb=$rowp['replacement_bulb'];
	$tracklighting=$rowp['tracklighting'];
	$outdorcovering=$rowp['outdorcovering'];
	$outdoorexposed=$rowp['outdoorexposed'];
	$manuf_warranty=$rowp['manuf_warranty'];
	$energy_star=$rowp['energy_star'];
	$productPub=$rowp['productPub'];
			$loc=$rootDir."dukeenergy/pix/products/".$imageLoc;

			if(file_exists($loc)){
			list($width, $height, $type, $attr) = getimagesize($loc);
				if($width>158){
					$newwidth_divisor=158/$width;
					$height=$height*$newwidth_divisor;
					$width=$width*$newwidth_divisor;
				}else{
					$width=$width;
					$height=$height;
				}
			}
}
?>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top"><br><br>


<form method="post" action="https://www.techniart.us/dukeenergy/cart.php">
<input type="hidden" name="action" value="add">
<input type="hidden" name="productID" value="<? echo($productID);?>">
<td width="20%"><a rel="shadowbox;" href="<? echo($loc);?>" class="option" title="<? echo($productName);?>"><img src="<? echo($loc);?>" alt="<? echo($productName);?>" width="200px" height="<? echo($height);?>" border="0" class="img_stroke"></a><br>
<? 
if($energy_star=='Yes'){
	print("<img src=\"pix/ES_Logo.gif\">");
}
?>
</td>
<td></td>
<td></td>
<td width="40%"><span class="cart-header"><? echo($productName);?></span><br>
<? if($subtitle && $watts_used){?>
<span class="cart-sm"><i><? echo(ucfirst($subtitle));?> <? echo($watts_used);?> watts</i></span><br>
<?}?>
<?


$sqlprice="select * from tblProducts where tblProducts.modelNumber='$modelNumber'";
$resultprice=db_query($sqlprice);
	while($rowprice=mysql_fetch_array($resultprice)){
	$price=number_format($rowprice['disct_price_nj'], 2, '.', ',');}
?>
<span class="price"><span style="color:#2ebf1e;">
<span class="price"><strike>$<? echo(number_format($MSRP, 2, '.', ','));?></strike></span><br>
<span class="price">$<? echo($price);?></span><br>
<br>
<span class="model">#<? echo($modelNumber);?></span><br><br>
<span class="cart-sm">
<? if($watts_used){?>
<b>Wattage:</b> <? echo($watts_used);?> watts<br>
<?}?>
<? if($replacement_wattage){?>
<b>Replaces:</b> <? echo($replacement_wattage);?> watts<br>
<?}?>
<? if($light_output){?>
<b>Light Output:</b> <? echo($light_output);?> lumens<br>
<?}?>
<? if($rated_lifetime){?>
<b>Rated Lifetime:</b> <? echo($rated_lifetime);?> hours<br>
<?}?>
<? if($color_temp){?>
<b>Color Temperature:</b> <? echo($color_temp);?><br>
<?}?>
<? if($MOL){?>
<b>MOL:</b> <? echo($MOL);?><br>
<?}?>
<? if($base){?>
<b>Base:</b> <? echo($base);?><br>
<?}?>
<? if($color_rendering){?>
<b>Color Rendering:</b> <? echo($color_rendering);?><br>
<?}?>
<? if($min_start_temp){?>
<b>Minimum Start Temperature:</b> <? echo($min_start_temp);?><br>
<?}?>
<? if($electrical_spec){?>
<b>Electrical Specifications:</b> <? echo($electrical_spec);?><br>
<?}?>
<? if($manuf){?>
<b>Manufacturer:</b> <? echo($manuf);?><br>
<?}?>
<? if($disclaimer){?>
<b>Dimmable:</b> <? echo($disclaimer);?><br>
<?}?>
<? if($manuf_warranty){?>
<b>Manufacturer Warranty:</b> <? echo($manuf_warranty);?><br><br>
<?}?>
<? if($extra){?>
<b>Description:</b> <? echo($extra);?><br><br>
<?}?>

<? if($free_ship=='Yes'){?>
<i>* This product qualifies for free shipping</i><br><br>
<?}?>
<? if(!$_SESSION['']){?>
<input type="hidden" name="modelNumber" value="<? echo($modelNumber);?>">
<input type="hidden" name="qty" value="1">
<input type="hidden" name="price" value="<? echo($price);?>">
<input type="hidden" name="productName" value="<? echo($productName);?>"><br>
<br>

<input type="button" alt="Buy now" value="Buy now" class="cat-btn" onClick="this.form.submit();">
<?}?>&nbsp;&nbsp;<input type="button" alt="Go Back" value="Go Back" class="cat-btn" border="0" onClick="location.href='store.php'">
<br></span></td>
<td width="30%" valign="top"><table width="85%" border="2" bordercolor="#000000">
  <tr>
    <td width="90%"><table width="100%" border="0" cellpadding="4" cellspacing="1" bordercolor="000000" bgcolor="ffffff">
      <tr>
        <td colspan="2" valign="baseline" bordercolor="000000"><span class="cart-header">Lighting Facts </span><span class="cart-sm">Per Bulb</span><br>
<hr size="10" noshade color="#000000" class="style11"></td>
      </tr>
      <tr>
        <td width="30%" bordercolor="000000"><span class="product_title_sm"><strong>Brightness</strong></span></td>
        <td width="30%" bordercolor="000000"><div align="right">
          <? if($light_output){?>
          <span class="product_title_sm"><? echo($light_output);?> lumens</span><br>
          <?}?>
        </div></td>
      </tr>
      <tr>
        <td colspan="2" class="body_content_style2 style1"><hr size="2" noshade color="#000000" class="style11"></td>
      </tr>
      <tr>
        <td colspan="2" bordercolor="000000" class="body_content_style2 style1"><span class="product_title_sm"><strong>Estimated Yearly 
          Energy Cost </strong></span><span class="product_title_sm"><strong>$<?php 
		  $first_number=1095;
		  $second_number=$watts_used;
		  $third_number=1000;
		  $forth_number=0.11;
		  $sum_total=$first_number * $second_number / $third_number * $forth_number;
		  $sum_total = sprintf('%0.2f', $sum_total);
		  print($sum_total);

		  ?></strong>
          </span>
          <div align="right"></div></td>
      </tr>
      <tr>
        <td colspan="2" bordercolor="000000"><table width="248" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td width="184"><span class="reg1">Based on 3 hrs/day, 11c/kWh<br />
              Cost depends on rates and use<br>
            </span></td>
            <td width="54" rowspan="2"><img src="pix/labels/es.jpg"></td>
          </tr>
          <tr>
            <td><hr width="100%" size="2" noshade color="#000000" class="style11"></td>
          </tr>
        </table>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td bordercolor="000000"><span class="product_title_sm"><strong>Lifetime</strong></span><br>
          <span class="reg">(hours of operation)</span></td>
        <td><div align="right">
          <span class="product_title_sm">
          <?php 
		  $first_number=1095;
		  $second_number=$rated_lifetime;
		  $sum_total=$second_number / $first_number;
  		  $sum_total = sprintf('%1.0f', $sum_total);
		  print($sum_total);

		  ?>
          years</span><br>
          <span class="reg">
            <? if($rated_lifetime){?>
          </span>            <span class="product_title_sm"><? echo($rated_lifetime);?> hours</span><br>
          <?}?>
        </div></td>
      </tr>
      <tr>
        <td colspan="2" bordercolor="000000"><hr size="2" noshade color="#000000" class="style11"></td>
      </tr>
      <tr>
        <td colspan="2"><span class="product_title_sm"><strong>Light Appearance</strong>
          <? if($color_temp=='2400K - Warm White'){
	print("<br><img src=\"pix/labels/24k-ww.jpg\">");
}
if($color_temp=='2700K - Warm White'){
	print("<br><img src=\"pix/labels/27k-ww.jpg\">");
}
if($color_temp=='3000K - Warm White'){
	print("<br><img src=\"pix/labels/30k-ww.jpg\">");
}
if($color_temp=='3500K - Cool White'){
	print("<br><img src=\"pix/labels/30k-cw.jpg\">");
}
if($color_temp=='4100K - Cool White'){
	print("<br><img src=\"pix/labels/41k-cw.jpg\">");
}
if($color_temp=='5000K - Daylight'){
	print("<br><img src=\"pix/labels/50k-day.jpg\">");
}
if($color_temp=='5500K - Daylight'){
	print("<br><img src=\"pix/labels/55k-day.jpg\">");
}
if($color_temp=='6500K - Full Spectrum'){
	print("<br><img src=\"pix/labels/65k-day.jpg\">");
}
?>
        </span></td>
      </tr>
      <tr>
        <td colspan="2" bordercolor="000000"><hr size="2" noshade color="#000000" class="style11"></td>
      </tr>
      <tr>
        <td bordercolor="000000"><span class="product_title_sm"><strong>Energy Used</strong> </span></td>
        <td bordercolor="000000"><div align="right">
          
          <span class="product_title_sm"><? echo($watts_used);?> watts</span><br>
          
        </div></td>
      </tr>
    </table></td>
  </tr>
</table><br>
<span class="product_title">
<? if($descrip){?>
<span class="cart-header">Description:</span><br>
<? echo($descrip);?>
<br><br>
<?}?>

<br><br>
<span class="cart"><? echo($recommended);?><br>
<?
if($table_floor=='x'){
	print("<img src=\"pix/applications/table-floor.jpg\">\n");
}	
if($pendant=='x'){
	print("<img src=\"pix/applications/pendant.jpg\">\n");
}
if($ceiling=='x'){
	print("<img src=\"pix/applications/ceiling.jpg\">\n");
}
if($ceilingfans=='x'){
print("<img src=\"pix/applications/ceilingfans.jpg\">\n");
}
if($wallsconce=='x'){
	print("<img src=\"pix/applications/wallsconces.jpg\">\n");
}
if($recessedcans=='x'){
	print("<img src=\"pix/applications/recessed-cans.jpg\">\n");
}	
if($tracklighting=='x'){
	print("<img src=\"pix/applications/track-lighting.jpg\">\n");
}
if($outdorcovering=='x'){
	print("<img src=\"pix/applications/outdoor-covered.jpg\">\n");
}	
if($outdoorexposed=='x'){
	print("<img src=\"pix/applications/outdoor-exposed.jpg\">\n");
}	

?>

</span>
<br>
<br>
<br>
</td>
</tr></form></table>
<!-- ------------------------------end products - row 3------------------------------ -->

</td>
<td></td>
</tr></table></td>
</tr></table>


<!-- ------------------------------end body------------------------------ -->
</div><br>
<? #echo($_SESSION['rep']);?>
<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->

</body>
</html>


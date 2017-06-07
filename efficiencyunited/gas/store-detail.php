<? include("database.php");?>
<?$ID=$_GET['ID'];?>
<? $show=$_GET['show'];?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Marketing The Future</title>

<meta name="robots" content="index,follow" />
<meta name="author" content="TechniArt" />
<meta name="publisher" content="techniart.us" />
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="js/shadowbox.css">
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
</head>

<BODY>
<?php include("analyticstracking.php") ?>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">

<? include("zip.php");?><br>
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
	$outdoorcovering=$rowp['outdoorcovering'];
	$outdoorexposed=$rowp['outdoorexposed'];
	$manuf_warranty=$rowp['manuf_warranty'];
	$energy_star=$rowp['energy_star'];
	$productPub=$rowp['productPub'];
			$loc="pix/products/".$imageLoc;
			if(!file_exists($loc)){
				$loc="pix/products/soon.jpg";
				$folder="pix/products/";
				$imageLoc="soon.jpg";
			}
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
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<form method="post" action="http://www.techniart.us/efficiencyunited/cart.php">
<input type="hidden" name="action" value="add">
<input type="hidden" name="productID" value="<? echo($productID);?>">
<td width="170"><a rel="shadowbox;" href="pix/products/<? echo($imageLoc);?>" class="option" title="<? echo($productName);?>"><img src="pix/products/<? echo($imageLoc);?>" alt="<? echo($productName);?>" width="<? echo($width);?>" height="<? echo($height);?>" border="0" class="img_stroke"></a><br>
<? 
if($energy_star=='Yes'){
	print("<img src=\"pix/ES_Logo.gif\" width=\"60\" height=\"60\">");
}
?>
</td>
<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>
<td width="369"><span class="product_title_lg"><? echo($productName);?></span><br>
<? if($subtitle && $watts_used){?>
<span class="product_title_sm"><i><? echo(ucfirst($subtitle));?> <? echo($watts_used);?> watts</i></span><br>
<?}?>
<?
#check for discounts
	if(strlen($_SESSION['zip_qualify'])>0){
		if($_SESSION['st']=='alt'){
			$sqlprice="select * from tblProductDiscounts LEFT OUTER JOIN tblTerritory on tblProductDiscounts.vendorID=tblTerritory.vendor where tblProductDiscounts.itemNo='$modelNumber' && tblTerritory.zip='$_SESSION[zip]' && tblTerritory.vendor!='13'";
#			print($sqlprice);
			$resultprice=db_query($sqlprice);
			$countprice=mysql_num_rows($resultprice);
			if($countprice<1){
				$price=number_format($MSRP, 2, '.', ',');
				$nomsrp="No";
			}else{
				while($rowprice=mysql_fetch_array($resultprice)){
					$price=number_format($rowprice['disct_price'], 2, '.', ',');
					$nomsrp="Yes";
				}
			}
		}else{
			if($_SESSION['st']=='NJ'){
				if($disct_price_nj>0){
					$price=number_format($disct_price_nj, 2, '.', ',');
					$nomsrp="Yes";
				}
			}else{
				if($_SESSION['clp']=='yes'){
					$price=number_format($disct_price, 2, '.', ',');
					$nomsrp="Yes";
				}else{
					$price=number_format($MSRP, 2, '.', ',');
					$nomsrp="No";
				}
			}
		}
	}else{
		$price=number_format($MSRP, 2, '.', ',');
		$nomsrp="No";
	}
if($price=='0' || $price==''){
	$price=number_format($MSRP, 2, '.', ',');
	$nomsrp="No";
}

/*if($_SESSION['zip']){
	$z=$_SESSION['zip'];
	$sqlz="select * from tblDiscounts where item_no='$modelNumber' && zip='$z'";
	$resultz=db_query($sqlz);
	$countz=mysql_num_rows($resultz);
	if($countz>0){
		$disct="Yes";
		if($_SESSION['st']=='NJ'){
			$price=$disct_price_nj;
		}else{
			$price=$disct_price;
		}
	}else{
		$price=$MSRP;
	}
}else{
	$price=$MSRP;
}*/
?>
<span class="product_price"><span style="color:#2ebf1e;">
<!--<?	if(strlen($_SESSION['zip_qualify'])>0 && $_SESSION['clp']=='no'){?>
<strike><b>Price:</b></span> $<? echo($MSRP);?></strike>
<?}?>-->

<span class="product_price"><strike>$<? echo(number_format($MSRP, 2, '.', ','));?></strike></span><br>
<span class="product_price">$<? echo(number_format($disct_price, 2, '.', ','));?></span><br>
<br>
<span class="product_number">#<? echo($modelNumber);?></span><br><br>
<span class="body_content_style1">
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
<input type="hidden" name="price" value="<? echo($disct_price);?>">
<input type="hidden" name="productName" value="<? echo($productName);?>">
<input type="image" src="pix/b_buy-now_lg.gif" alt="Buy now" width="83" height="27" border="0" onClick="this.form.submit();">
<?}?>&nbsp;&nbsp;<a href="store.php"><img src="pix/go_back.gif" width="83" height="27"></a>
<br></span></td>
<td width="300" valign="top">
<? if($class=='light'){?><table width="255" border="2" bordercolor="#000000">
  <tr>
    <td width="275"><table width="255" border="0" cellpadding="0" cellspacing="1" bordercolor="0000000">
      <tr>
        <td colspan="2" valign="baseline" bordercolor="000000"><span class="product_title_lg">Lighting Facts </span><span class="product_title_sm">Per Bulb</span></td>
      </tr>
      <tr>
        <td colspan="2" bordercolor="000000"><hr size="10" noshade color="#000000" class="style11"></td>
      </tr>
      <tr>
        <td width="145" bordercolor="000000"><span class="product_title_sm">Brightness</span></td>
        <td width="100" bordercolor="000000"><div align="right">
          <? if($light_output){?>
          <span class="product_title"><? echo($light_output);?> lumens</span><br>
          <?}?>
        </div></td>
      </tr>
      <tr>
        <td colspan="2" class="body_content_style2 style1"><hr size="2" noshade color="#000000" class="style11"></td>
      </tr>
      <tr>
        <td colspan="2" bordercolor="000000" class="body_content_style2 style1"><span class="product_title">Estimated Yearly 
          Energy Cost </span><span class="product_title">$<?php 
		  $first_number=1095;
		  $second_number=$watts_used;
		  $third_number=1000;
		  $forth_number=0.11;
		  $sum_total=$first_number * $second_number / $third_number * $forth_number;
		  $sum_total = sprintf('%0.2f', $sum_total);
		  print($sum_total);

		  ?>
          </span>
          <div align="right"></div></td>
      </tr>
      <tr>
        <td colspan="2" bordercolor="000000"><table width="248" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td width="184"><span class="reg1">Based on 3 hrs/day, 11c/kWh<br />
              Cost depends on rates and use<br>
            </span></td>
            <td width="54" rowspan="2"><img src="pix/labels/es.jpg" width="36" height="38"></td>
          </tr>
          <tr>
            <td><hr width="100%" size="2" noshade color="#000000" class="style11"></td>
          </tr>
        </table>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td bordercolor="000000"><span class="product_title_sm">Lifetime</span><br>
          <span class="reg">(hours of operation)</span></td>
        <td><div align="right">
          <span class="product_title">
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
          </span>            <span class="product_title"><? echo($rated_lifetime);?> hours</span><br>
          <?}?>
        </div></td>
      </tr>
      <tr>
        <td colspan="2" bordercolor="000000"><hr size="2" noshade color="#000000" class="style11"></td>
      </tr>
      <tr>
        <td colspan="2"><span class="product_title_sm">Light Appearance
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
        <td bordercolor="000000"><span class="product_title_sm">Energy Used </span></td>
        <td bordercolor="000000"><div align="right">
          <? if($watts_used){?>
          <span class="product_title"><? echo($watts_used);?> watts</span><br>
          <?}?>
        </div></td>
      </tr>
    </table></td>
  </tr>
</table><?;}?><br>
<span class="body_content_style1">
<span class="product_title">
<? if($descrip){?>
<span class="product_title_lg">Description:</span><br>
<? echo($descrip);?>
<br><br>
<?}?>
<? echo($disclaimer);?>
<br>
<span class="body_content_style1"><strong><? echo($recommended);?></strong></span><br>
<?
if($table_floor=='x'){
	print("<img src=\"pix/applications/table-floor.jpg\">&nbsp;\n");
}	
if($pendant=='x'){
	print("<img src=\"pix/applications/pendant.jpg\">&nbsp;\n");
}
if($ceiling=='x'){
	print("<img src=\"pix/applications/ceiling.jpg\">&nbsp;\n");
}
if($ceilingfans=='x'){
print("<img src=\"pix/applications/ceilingfans.jpg\">&nbsp;\n");
}
if($wallsconce=='x'){
	print("<img src=\"pix/applications/wallsconces.jpg\">&nbsp;\n");
}
if($recessedcans=='x'){
	print("<img src=\"pix/applications/recessed-cans.jpg\">&nbsp;\n");
}	
if($tracklighting=='x'){
	print("<img src=\"pix/applications/track-lighting.jpg\">&nbsp;\n");
}
if($outdorcovering=='x'){
	print("<img src=\"pix/applications/outdoor-covered.jpg\">&nbsp;\n");
}	
if($outdoorexposed=='x'){
	print("<img src=\"pix/applications/outdoor-exposed.jpg\">&nbsp;\n");
}	

#replacement bulbs for fixtures
if($replacement_bulb){
	print("<br><br>");
	print("<b>Replacement Bulbs:</b> (Click to see details)<br>");
	$split=explode(", ",$replacement_bulb);
	for($r=0;$r<count($split);$r++){
			$loc1=$rootDir."pix/products/".$split[$r];
			$mf_nbr=str_replace(".jpg","",$split[$r]);
			$sqlnum="select productID,productName from tblProducts where modelNumber='$mf_nbr'";
			$resultnum=db_query($sqlnum);
			while($rownum=mysql_fetch_array($resultnum)){
				$productTitle=$rownum['productName'];
				$productID=$rownum['productID'];
			}
				if(file_exists($loc1)){
				list($width, $height, $type, $attr) = getimagesize($loc1);
					if($width>65){
						$newwidth_divisor1=65/$width;
						$height1=$height*$newwidth_divisor1;
						$width1=$width*$newwidth_divisor1;
					}else{
						$width1=$width;
						$height1=$height;
					}
				}

		print("<a href=\"store-detail.php?ID=".$productID."\"><img src=\"pix/products/".$split[$r]."\" width=\"".$width1."\" height=\"".$height1."\" class=\"img_stroke\"></a>&nbsp;\n");
	}
}

?>

</span>
</td>
</tr></form></table><br><br>
<!-- ------------------------------end products - row 3------------------------------ -->

</td>
<td><img src="pix/pix_000000.gif" alt="" width="1" height="1" border="0"></td>
</tr></table></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906">&nbsp;</td>
</tr></table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
</html>


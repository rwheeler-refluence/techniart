<? include("database.php");?>
<? include("jersey.php");?>
<?
$action=$_GET['action'];
$keyword=$_GET['keyword'];
$productName=$_GET['productName'];
$modelNumber=$_GET['modelNumber'];
$manuf=$_GET['manuf'];
$watts_used=$_GET['watts_used'];
$replacement_wattage=$_GET['replacement_wattage'];
$light_output=$_GET['light_output'];
$color_temp=$_GET['color_temp'];
$color_rendering=$_GET['color_rendering'];
$rated_lifetime=$_GET['rated_lifetime'];
$min_start_temp=$_GET['min_start_temp'];
$sort1=$_GET['sort'];
if(!$sort1){
	$sort="watts_used";
}else{
	$sort="".$sort1.",watts_used";
}
?>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

<script type="text/javascript">
function loadContent(elementSelector, sourceUrl) {
	$(""+elementSelector+"").load(sourceUrl);
	
}
</script>
</head>

<BODY>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Energy Saving Outlet - Advanced Search</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
<td width="904"><div id="main_content_ip" align="left">
<? include("zip.php");?>
<span class="section_heading_style1"><b>Search based on your specific criteria below:</b><br><br>
<? if(!$action){?>
<form method="get" action="<? echo($PHP_SELF);?>">
<input type="hidden" name="action" value="search">
<table><tr>
<td><span class="section_heading_style1"><b>Product Name:</b></span></td>
<td>&nbsp;<input type="text" name="productName" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Model Number:</b></span></td>
<td>&nbsp;<input type="text" name="modelNumber" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Manufacturer Name:</b></span></td>
<td>&nbsp;<input type="text" name="manuf" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Watts Used:</b></span></td>
<td>&nbsp;<input type="text" name="watts_used" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Replacement Wattage:</b></span></td>
<td>&nbsp;<input type="text" name="replacement_wattage" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Light Output:</b></span></td>
<td>&nbsp;<input type="text" name="light_output" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Color Temperature:</b></span></td>
<td>&nbsp;<input type="text" name="color_temp" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Color Rendering:</b></span></td>
<td>&nbsp;<input type="text" name="color_rendering" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Rated Lifetime:</b></span></td>
<td>&nbsp;<input type="text" name="rated_lifetime" size="30"></td>
</tr><tr valign="top">
<td><span class="section_heading_style1"><b>Minimum Start Temperature:</b></span></td>
<td>&nbsp;<input type="text" name="min_start_temp" size="30"></td>
</tr><tr valign="top">
<td colspan="2"><input type="submit" value="Search"></td>
</tr></table>
</form>
<?}?>
<?
if($action=='search'){
	print("<a class=\"body_content_style1\" href=\"search-discount.php\"><< Search Again</a><br><br>\n");
	$cnt=0;
	$sqlp.="select * from tblProducts_ues where ";
	if($keyword){
		$sqlp.=" ((category like '%$keyword%' || productName LIKE '%$keyword%' || modelNumber LIKE '%$keyword%') ";
		$cnt++;
	}
	if($productName){
		if($cnt>0){
			$sqlp.="|| (productName like '%$productName%'";
		}else{
			$sqlp.=" (productName like '%$productName%'";
		}
		$cnt++;
	}
	if($modelNumber){
		if($cnt>0){
			$sqlp.=" || modelNumber like '%$modelNumber%'";
		}else{
			$sqlp.="(modelNumber like '%$modelNumber%'";
		}
		$cnt++;
	}
	
	if($manuf){
		if($cnt>0){
			$sqlp.=" || manuf like '%$manuf%'";
		}else{
			$sqlp.="(manuf like '%$manuf%'";
		}
		$cnt++;
	}

	if($watts_used){
		if($cnt>0){
			$sqlp.=" || watts_used like '%$watts_used%'";
		}else{
			$sqlp.="(watts_used like '%$watts_used%'";
		}
		$cnt++;
	}

	if($replacement_wattage){
		if($cnt>0){
			$sqlp.=" || replacement_wattage like '%$replacement_wattage%'";
		}else{
			$sqlp.="(replacement_wattage like '%$replacement_wattage%'";
		}
		$cnt++;
	}

	if($light_output){
		if($cnt>0){
			$sqlp.=" || light_output like '%$light_output%'";
		}else{
			$sqlp.="(light_output like '%$light_output%'";
		}
		$cnt++;
	}

	if($color_temp){
		if($cnt>0){
			$sqlp.=" || color_temp like '%$color_temp%'";
		}else{
			$sqlp.="(color_temp like '%$color_temp%'";
		}
		$cnt++;
	}

	if($color_rendering){
		if($cnt>0){
			$sqlp.=" || color_rendering like '%$color_rendering%'";
		}else{
			$sqlp.="(color_rendering like '%$color_rendering%'";
		}
		$cnt++;
	}
	
	if($rated_lifetime){
		if($cnt>0){
			$sqlp.=" || rated_lifetime like '%$rated_lifetime%'";
		}else{
			$sqlp.="(rated_lifetime like '%$rated_lifetime%'";
		}
		$cnt++;
	}

	if($min_start_temp){
		if($cnt>0){
			$sqlp.=" || min_start_temp like '%$min_start_temp%'";
		}else{
			$sqlp.="(min_start_temp like '%$min_start_temp%'";
		}
		$cnt++;
	}
	if($cnt>0){
		$sqlp.=") &&";
	}
	$sqlp.=" productPub='Yes' order by $sort asc";
#print($sqlp);
$resultp=db_query($sqlp);
	$countp=mysql_num_rows($resultp);
	if($countp==1){
		$label="result";
	}else{
		$label="results";
	}
	$i=1;
	if($action=='search'){
		print("<span class=\"product_title\">");
		print("".$countp." results found</span><br><br>");
	}
	?>
	<!-- ------------------------------begin products - row <? echo($i);?>------------------------------ -->
	<? if($action!=='search' || ($action=='search' && $countp>0)){?>
	<div align="right">
	<span class="body_content_style1">Sort by:&nbsp;</span>
	<select name="theSelect" size=1 onChange="if (this.selectedIndex >0) window.location=this.options[this.selectedIndex].value">
	<option value="">
	<option value="search-discount.php?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=replacement_wattage&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Replacement wattage
	<option value="search-discount.php?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=watts_used&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Wattage used
	<option value="search-discount.php?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=MSRP&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Price
	<option value="search-discount.php?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=color_temp&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Color temperature
	<option value="search-discount.php?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=manuf&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Manufacturer
	</select></div>
	<br>
	<?}?>
	<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
	<?
	while($rowp=mysql_fetch_array($resultp)){
		$rowcount=0;
		$productID=$rowp['productID'];
		$productName=$rowp['productName'];
		if($_SESSION['zip']){
			$price=number_format($rowp['MSRP'], 2, '.', ',');
		}else{
			$price=number_format($rowp['disct_price'], 2, '.', ',');
		}
		$imageLoc=$rowp['imageLoc'];
		$modelNumber=$rowp['modelNumber'];
			$loc=$rootDir."pix/products/thumbnails/".$imageLoc;
			if(!file_exists($loc)){
				$loc=$rootDir."pix/products/".$imageLoc;
				$folder="pix/products/";
			}else{
				$folder="pix/products/thumbnails/";
			}
			if(!file_exists($loc)){
				$loc="pix/products/soon.jpg";
				$folder="pix/products/";
				$imageLoc="soon.jpg";
			}
			list($width, $height, $type, $attr) = getimagesize($loc);
				if($width>106){
					$newwidth_divisor=106/$width;
					$height=$height*$newwidth_divisor;
					$width=$width*$newwidth_divisor;
				}else{
					$width=$width;
					$height=$height;
				}
	?>
	<td width="275">
	<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
	<td width="71"><a href="store-detail-discount.php?ID=<? echo($productID);?>"><img src="<? echo($folder);?><? echo($imageLoc);?>" alt="<? echo($productName);?>" width="<? echo($width);?>" height="<? echo($height);?>" border="0" class="img_stroke"></a></td>
	<td width="204"><span class="product_title"><? echo($productName);?></span><br>
	<span class="product_number">#<? echo($modelNumber);?></span><br><br>

	<span class="product_price">$<? echo($price);?></span><br>S
	<? if(!$_SESSION['noshop']){?>
	<a href="store-detail-discount.php?ID=<? echo($productID);?>"><img src="pix/b_buy-now_sm.gif" alt="Buy now" width="55" height="19" border="0"></a><br>
	<?}?>
	<a href="store-detail-discount.php?ID=<? echo($productID);?>"><img src="pix/b_more-info_sm.gif" alt="Learn more" width="55" height="19" border="0"></a></td>
	</tr></table>

	</td>
<? if($i>1 && $i%2!==0){?>
<!--<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>-->
<?}?>
<? if($i>1 && $i%3==0){?>
<?$j=$i+1;?>
</tr></table><br><br>
<!-- ------------------------------end products - row <? echo($i);?>------------------------------ -->

<!-- ------------------------------begin products - row <? echo($j);?>------------------------------ -->
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?}?>
<?$i++;?>
<? $rowcount++;?>
<?}?>
<?
$eval=$i-1;
#print("eval: ".$rowcount."<br>");
$num=3-$eval;
for($ee=0;$ee<$rowcount;$ee++){
	print("<td width=\"275\"><img src=\"pix/pix_trans.gif\" width=\"275\" height=\"1\"></td>\n");
}
?>
</td>
</tr></table><br><br>
<!-- ------------------------------end products - row 3------------------------------ -->
<?}?>
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


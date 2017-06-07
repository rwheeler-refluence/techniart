<? include("database.php");?>
<? include("jersey.php");?>
<?
$action=$_GET['action'];
$keyword=$_GET['keyword'];
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
<?php include_once("analyticstracking.php") ?>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main"><b>TechniArt's online store</b></span></div></td>
</tr></table>
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
<td width="904"><div id="main_content_ip" align="left">

<? include("zip.php");?>
<?
$sql="select distinct tblSort.category from tblSort LEFT OUTER JOIN tblProducts on tblSort.category=tblProducts.category order by tblSort.sort asc";
$result=db_query($sql);
$i=1;
?>
<span class="title_main"><b>Shop by Category</b></span><br><br>
<table width="853" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<? while($row=mysql_fetch_array($result)){
		$category=$row['category'];
		$sqlp="select * from tblProducts where category='$category' && productPub='Yes' order by rand() limit 1";
#		print("<br>".$sqlp."<br>");
$resultp=db_query($sqlp);
$countp=mysql_num_rows($resultp);
?>
<!-- ------------------------------begin products - row <? echo($i);?>------------------------------ -->
<?
while($rowp=mysql_fetch_array($resultp)){
	$category=$rowp['category'];
	$imageLoc=$rowp['imageLoc'];
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

	<td width="275" style="padding:5px 5px 5px 5px;" align="center"><span class="product_title"><? echo($category);?></span><br>
	<a href="store-cat.php?cat=<? echo($category);?>"><img src="<? echo($folder);?><? echo($imageLoc);?>" alt="<? echo($productName);?>" width="<? echo($width);?>" height="<? echo($height);?>" border="0" class="img_stroke"></a></td>
	<? if($i>1 && $i%3==0){?>	
	</tr><tr valign="top">
	<td colspan="3">
	<img src="pix/pix_trans.gif" width="580" height="5">
	</tr><tr valign="top">
	<td colspan="3" align="cetner">
	<img src="pix/pix_c8e1ea.gif" width="800" height="1">
	</tr><tr valign="top">
	<td colspan="3">
	<img src="pix/pix_trans.gif" width="580" height="5">
	</tr><tr valign="top">
	<?}?>
	<?$i++;?>
<?}?>
<?}?>
</tr></table><br><br>

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

</html>


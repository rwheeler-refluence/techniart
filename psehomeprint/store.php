<? include("database.php");?>
<html>
<head>
<title>TechniArt - Marketing The Future</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>

<BODY>
<?php include("bluebar.php") ?><center><div class="fbwhitebox"><?php include("header.php") ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td></td>
<td width="904"><div align="left">


<?
$sql="select distinct tblSort.category from tblSort LEFT OUTER JOIN tblProducts on tblSort.category=tblProducts.category order by tblSort.sort asc";
$result=db_query($sql);
$i=1;
?>
<span class="title_main">Shop by Category</span><br><br>
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
			$loc=$rootDir."psehomeprint/pix/products/thumbnails/".$imageLoc;
			if(!file_exists($loc)){
				$loc=$rootDir."psehomeprint/pix/products/".$imageLoc;
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
	<img src="pix/pix_trans.gif" width="580" height="40">
	</tr><tr valign="top">
	<td colspan="3" align="center">
	
	</tr><tr valign="top">
	<td colspan="3">
	<img src="pix/pix_trans.gif" width="580" height="5">
	</tr><tr valign="top">
	<?}?>
	<?$i++;?>
<?}?>
<?}?>
</tr></table><br><br>

</td>
<td></td>
</tr></table>

</td>
</tr></table>


<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
</div></div>
<!-- ------------------------------end footer------------------------------ -->

</body>

</html>


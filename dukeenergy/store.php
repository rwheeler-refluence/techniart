<? include("database.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>TechniArt - Store</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
</head>

<BODY><?php include_once("analyticstracking.php") ?><? include("nav.php")?>
<div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?><div></div></div>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->


<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="main"><tr valign="top">
<td></td>
<td width="100%">

<? include("zip.php");?>
<?
$sql="select distinct tblSort.category from tblSort LEFT OUTER JOIN tblProducts on tblSort.category=tblProducts.category order by tblSort.sort asc";
$result=db_query($sql);
$i=1;
?>
<br>
<br>
<span class="cart-header" style="margin-left: 3%"><b>Shop by Category</b></span><br><br>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="left"><tr valign="top">
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
			$loc=$rootDir."dukeenergy/pix/products/thumbnails/".$imageLoc;

?>

	<td width="25%" align="center"><span class="product"><a href="store-cat.php?cat=<? echo($category);?>" style="text-decoration:none;"><? echo($category);?></a></span><br><br>

	<a href="store-cat.php?cat=<? echo($category);?>"><img src="<? echo($loc);?>" alt="<? echo($productName);?>" width="<? echo($width);?>" height="<? echo($height);?>" border="0" class="img_stroke"></a></td>
	<? if($i>1 && $i%4==0){?>	
		</tr><tr valign="top">
	<?}?>
	<?$i++;?>
<?}?>
<?}?>
<p></p>
</tr><tr><td height="50px"></td></tr></table><br><br>

</div></td>
<td></td>
</tr></table>

</div></td>
</tr></table></div>

<!-- ------------------------------end body------------------------------ -->
</div>
<p>
</p>
<!-- ------------------------------begin footer------------------------------ -->
<? #echo($_SESSION['rep']);?>
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


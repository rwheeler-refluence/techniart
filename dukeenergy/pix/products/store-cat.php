<? include("database.php");?>
<?
$action=$_GET['action'];
$keyword=$_GET['keyword'];
$sort1=$_GET['sort'];
if(!$sort1){
	$sort="class";
}else{
	$sort="".$sort1.",productID";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Marketing The Future</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
</head>

<BODY><?php include_once("analyticstracking.php") ?><? include("nav.php")?>
<div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>
<!-- ------------------------------begin body------------------------------ -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="100%"><</td>
</tr></table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" ><tr valign="top">
<td></td>
<td width="98%"><div id="main_content_ip" align="left">

<? include("zip.php");?>
<?
$subcat=$_GET['subcat'];
$subcat1=$_GET['subcat1'];
$sqlp.="select * from tblProducts where category='$cat' ";
if($subcat){
$sqlp.="&& subcat1='$subcat'";
	}
	if($subcat1){
		$sqlp.="&& subcat2='$subcat1'";
	}
	$sqlp.=" && productPub='Yes' order by $sort asc";

#print($sqlp);
$resultp=db_query($sqlp);
$countp=mysql_num_rows($resultp);
if($countp==1){
	$label="result";
}else{
	$label="results";
}
$i=1;

	print("<br><br>	<a class=\"title_main\" href=\"store-cat.php?cat=".$cat."\"><b>".$cat." </a>");
	if($subcat){
		print(" - <a class=\"title_main\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."\">".$subcat."</a>");
	}
	if($subcat1){
		print(" - <a class=\"title_main\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat1."\">".$subcat1."</a>");
	}
	print("</b></span><br>");
	if(!$subcat){
		$sqlsubs="select distinct subcat1 from tblProducts where category='$cat' && subcat1!='' order by $sort asc";
		$resultsubs=db_query($sqlsubs);
		$countsubs=mysql_num_rows($resultsubs);
		$subs=1;
		while($rowsubs=mysql_fetch_array($resultsubs)){
			$subcat1=$rowsubs['subcat1'];
			print("<a class=\"product_title1\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat1."\">".$subcat1."</a>");
			if($subs<$countsubs){
				print("&nbsp;&nbsp;|&nbsp;&nbsp;");
			}
			$subs++;
		}
		if($countsubs>0){
			print("<br>");
		}
	}else{
		$sqlsubs="select distinct subcat2 from tblProducts where subcat1='$subcat' && category='$cat' && subcat2!='' order by subcat2 asc";
		$resultsubs=db_query($sqlsubs);
		$countsubs=mysql_num_rows($resultsubs);
		$subs=1;
		while($rowsubs=mysql_fetch_array($resultsubs)){
			$subcat2=$rowsubs['subcat2'];
			print("<a class=\"product_title\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat2."\">".$subcat2."</a>");
			if($subs<$countsubs){
				print("&nbsp;&nbsp;|&nbsp;&nbsp;");
			}
			$subs++;
		}
		if($countsubs>0){
			print("<br><br>");
		}
	}
	print("<br>\n");

?>
<!-- ------------------------------begin products - row <? echo($i);?>------------------------------ -->
<table width="88%" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?
#	print("state:".$_SESSION['st']."<br>");
while($rowp=mysql_fetch_array($resultp)){
	$productID=$rowp['productID'];
	$productName=$rowp['productName'];
	$modelNumber=$rowp['modelNumber'];
	$MSRP=number_format($rowp['MSRP'], 2, '.', ',');
	$nomsrp="";
	 			$sqlprice="select * from tblProducts where tblProducts.modelNumber='$modelNumber'";
		#	print($sqlprice);
			$resultprice=db_query($sqlprice);
			while($rowprice=mysql_fetch_array($resultprice)){
					$price=number_format($rowprice['disct_price_nj'], 2, '.', ',');
					if($rowp['disct_price_nj']!==$rowp['MSRP']){
						$nomsrp="Yes";
						$show="Yes";
					}}
	$imageLoc=$rowp['imageLoc'];
	$modelNumber=$rowp['modelNumber'];
			$loc=$rootDir."duke-lto/pix/products/thumbnails/".$imageLoc;
			

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
<td width="33%">
<form method="post" action="cart.php">
<input type="hidden" name="action" value="add">
<table width="33%" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="100%"><a href="store-detail.php?ID=<? echo($productID);?>&show=<? echo($show);?>"><img src="<? echo($loc);?>" alt="<? echo($productName);?>" width="<? echo($width);?>" height="<? echo($height);?>" border="0" class="img_stroke"></a></td>
<td><br><span class="product_title"><? echo($productName);?></span><br>
<span class="product_number">#<? echo($modelNumber);?></span><br><br>
<? if($nomsrp=='Yes'){?>
<span class="product_price"><strike>$<? echo($MSRP);?></strike></span><br>
<?}?>
<span class="product_price">$<? echo($price);?></span><br>
<? if(!$_SESSION['']){?>
<input type="hidden" name="productID" value="<? if($productID==5){echo($productID=19);}else if($productID==6){echo($productID=20);}else if($productID==12){echo($productID=21);}else if($productID==13){echo($productID=22);}else if($productID==14){echo($productID=23);}else if($productID==17){echo($productID=24);}else if($productID==18){echo($productID=25);}else{echo($productID);}?>
">
<input type="hidden" name="modelNumber" value="<? echo($modelNumber);?>">
<input type="hidden" name="qty" value="1">
<input type="hidden" name="price" value="<? echo($price);?>">
<input type="hidden" name="productName" value="<? echo($productName);?>">
<input type="hidden" name="rep" value="<? echo($_SESSION['rep']);?>">
<input type="button" alt="Buy now" value="Buy now" class="btn4" width="55" height="19" border="0" onClick="this.form.submit();">
<?}?>
<input type="button" alt="More Info" value="More Info" class="btn5" width="83" height="27" border="0" onClick="location.href='store-detail.php?ID=<? echo($productID);?>&show=<? echo($show);?>'"></td>
</tr></form><br></table>

</td>
<? if($i>1 && $i%2!==0){?>
<!--<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>-->
<?}?>
<? if($i>1 && $i%3==0){?>
<?$j=$i+1;?>
</tr></table><br>
<!-- ------------------------------end products - row <? echo($i);?><br>------------------------------ -->

<!-- ------------------------------begin products - row <? echo($j);?>------------------------------ -->
<table width="85%" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?}?>
<?$i++;?>
<?}?>
<?
$eval=$i-1;
$num=3-$eval;
for($ee=0;$ee<$num;$ee++){
	print("<td width=\"35%\"><img src=\"pix/pix_trans.gif\" width=\"35%\" height=\"1\"></td>\n");
}
?>
</td>
</tr></table><br>
<!-- ------------------------------end products - row 3------------------------------ -->

</div></td>
<td></td>
</tr>
</table>
<!-- ------------------------------end body------------------------------ -->
</div><br>
<? #echo($_SESSION['rep']);?>
<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</body>
</html>

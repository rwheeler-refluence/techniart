<? include("database.php");?>
<?
$action=$_GET['action'];
$keyword=$_GET['keyword'];
$sort1=$_GET['sort'];
if(!$sort1){
	$sort="productID";
}else{
	$sort="".$sort1.",productID";
}
?>
<html>
<head>
<title>TechniArt - Marketing The Future</title>


<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>

<BODY>
<?php include("bluebar.php") ?><center><div class="fbwhitebox"><?php include("header.php") ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main">
  <tr valign="top">
<td></td>
<td width="904"><div align="left">
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

	print("<br><br>	<a class=\"title_main\" href=\"store-cat.php?cat=".$cat."\">".$cat." </a>");
	if($subcat){
		print(" - <a class=\"title_main\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."\">".$subcat."</a>");
	}
	if($subcat1){
		print(" - <a class=\"title_main\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat1."\">".$subcat1."</a>");
	}
	print("</span><br>");
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
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?
#	print("state:".$_SESSION['st']."<br>");
while($rowp=mysql_fetch_array($resultp)){
	$productID=$rowp['productID'];
	$productName=$rowp['productName'];
	$modelNumber=$rowp['modelNumber'];
	$MSRP=number_format($rowp['MSRP'], 2, '.', ',');
	$case_quantity=$rowp['case_quantity'];
	$nomsrp="";
	$price=$rowp['price'];
	$imageLoc=$rowp['imageLoc'];
	$modelNumber=$rowp['modelNumber'];
			$loc=$rootDir."psehomeprint/pix/products/thumbnails/".$imageLoc;
			
			list($width, $height, $type, $attr) = getimagesize($loc);
				if($width>106){
					$newwidth_divisor=106/$width;
					$height=$height*$newwidth_divisor;
					$width=$width*$newwidth_divisor;
				}else{
					$width=$width;
					$height=$height;
				}

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
?>
<td width="275">
<form method="post" action="https://www.techniart.us/psehomeprint/cart.php">
<input type="hidden" name="action" value="add">
<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="106"><a href="store-detail.php?ID=<? echo($productID);?>&show=<? echo($show);?>"><img src="<? echo($loc);?>" alt="<? echo($productName);?>" width="<? echo($width);?>" height="<? echo($height);?>" border="0" class="img_stroke"></a></td>
<td width="123"><img src="pix/pix_trans.gif" width="123" height="1"><br><span class="product_title"><? echo($productName);?></span><br>
<span class="product_number">#<? echo($modelNumber);?></span><br><br>
<span class="product_price">$<? echo($MSRP);?></span><br><br>
<? if(!$_SESSION['']){?>
<input type="hidden" name="productID" value="<? echo($productID);?>">
<input type="hidden" name="modelNumber" value="<? echo($modelNumber);?>">
<select name="qty">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option></select> <span class="product_number">Case (<? echo($case_quantity);?> qty)</span><br>
<input type="hidden" name="case_quantity" value="<? echo($case_quantity);?>">
<input type="hidden" name="price" value="<? echo($price);?>">
<input type="hidden" name="productName" value="<? echo($productName);?>">
<input type="button" class="btn2" value="Add to Cart" onClick="this.form.submit();">
<?}?>
<input type="button" class="btn4" value="More Info" onclick='location.href="store-detail.php?ID=<? echo($productID);?>"'/></td>
</tr></form><br></table>

</td>
<? if($i>1 && $i%2!==0){?>
<!--<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>-->
<?}?>
<? if($i>1 && $i%3==0){?>
<?$j=$i+1;?>
</tr></table>
<!-- ------------------------------end products - row <? echo($i);?><br>------------------------------ -->

<!-- ------------------------------begin products - row <? echo($j);?>------------------------------ -->
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?}?>
<?$i++;?>
<?}?>
<?
$eval=$i-1;
$num=3-$eval;
for($ee=0;$ee<$num;$ee++){
	print("<td width=\"275\"><img src=\"pix/pix_trans.gif\" width=\"275\" height=\"1\"></td>\n");
}
?>
</td>
</tr></table><br>
<!-- ------------------------------end products - row 3------------------------------ -->

</div></td>
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr valign="top">
<td width="906">&nbsp;</td>
</tr></table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div></div>
</body>
</html>


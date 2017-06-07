<center>
<table width="760" height="15"border="0" align="center" cellpadding="0" cellspacing="0" background="back-top.jpg">
  <tr>
    <td></td>
  </tr>
</table>
<table width="760" border="0" cellspacing="0" cellpadding="0" class="bkg_body-main">
<tr valign="top">
<td width="760">
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

	print("<br><a class=\"title_main\" href=\"store-cat.php?cat=".$cat."\"><b>".$cat." </a>");
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
			print("<a class=\"product_title\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat1."\">".$subcat1."</a>");
			if($subs<$countsubs){
				print("&nbsp;&nbsp;|&nbsp;&nbsp;");
			}
			$subs++;
		}
		if($countsubs>0){
			print("");
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
			print("");
		}
	}
	print("\n");

?>
<!-- ------------------------------begin products - row <? echo($i);?>------------------------------ -->
<table width="760" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?
#	print("state:".$_SESSION['st']."<br>");
while($rowp=mysql_fetch_array($resultp)){
	$productID=$rowp['productID'];
	$productName=$rowp['productName'];
	$modelNumber=$rowp['modelNumber'];
	$MSRP=number_format($rowp['MSRP'], 2, '.', ',');
	$nomsrp="";
	if(strlen($_SESSION['zip_qualify'])>0){
 		if($_SESSION['st']=='alt'){
			$sqlprice="select * from tblProductDiscounts LEFT OUTER JOIN tblTerritory on tblProductDiscounts.vendorID=tblTerritory.vendor where tblProductDiscounts.itemNo='$modelNumber' && tblTerritory.zip='$_SESSION[zip]' && tblTerritory.vendor!='13'";
		#	print($sqlprice);
			$resultprice=db_query($sqlprice);
			$countprice=mysql_num_rows($resultprice);
			if($countprice<1){
				$price=number_format($rowp['MSRP'], 2, '.', ',');
				$nomsrp="No";
			}else{
				while($rowprice=mysql_fetch_array($resultprice)){
					$price=number_format($rowprice['disct_price'], 2, '.', ',');
					if($rowp['disct_price']!==$rowp['MSRP']){
						$nomsrp="Yes";
						$show="Yes";
					}else{
						$nomsrp="No";
						$show="No";
					}
				}
			}
		}else{
			if($_SESSION['st']=='NJ'){
				$price=number_format($rowp['disct_price_nj'], 2, '.', ',');
				if($rowp['disct_price']!==$rowp['MSRP']){
						$nomsrp="Yes";
						$show="Yes";
					}else{
						$nomsrp="No";
						$show="No";
					}
			}else{
				#print("clp:".$_SESSION['clp']."<br>");
				if($_SESSION['clp']=='yes'){
					$price=number_format($rowp['disct_price'], 2, '.', ',');
					if($rowp['disct_price']!==$rowp['MSRP']){
						$nomsrp="Yes";
						$show="Yes";
					}else{
						$nomsrp="No";
						$show="No";
					}
				}else{
					$price=number_format($rowp['MSRP'], 2, '.', ',');
					$nomsrp="No";
				}
			}
		}
	}else{
		$price=number_format($rowp['MSRP'], 2, '.', ',');
		$nomsrp="No";
	}
	$imageLoc=$rowp['imageLoc'];
	$modelNumber=$rowp['modelNumber'];
			

?>
<td width="350">
<form method="post" action="cart.php">
<input type="hidden" name="action" value="add">
<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="106"></a></td>
<td width="123"><img src="pix/pix_trans.gif" width="123" height="1"><br><span class="product_title"><? echo($productName);?></span><br>
<br><? if($nomsrp=='Yes'){?>
<span class="product_price"><strike>$<? echo($MSRP);?></strike></span><br>
<?}?>
<span class="product_price">$<? echo($price);?></span><br>
<? if(!$_SESSION['']){?>
<input type="hidden" name="productID" value="<? echo($productID);?>">
<input type="hidden" name="modelNumber" value="<? echo($modelNumber);?>">
<input type="hidden" name="qty" value="1">
<input type="hidden" name="price" value="<? echo($price);?>">
<input type="hidden" name="productName" value="<? echo($productName);?>">
<input type="button" class="btn" name="Add to Cart" value="Add to Cart" onClick="this.form.submit();"><br>
<?}?>
<a href="store-detail.php?ID=<? echo($productID);?>&show=<? echo($show);?>"></a></td>
</tr></form><br></table>

</td>
<? if($i>1 && $i%2!==0){?>
<!--<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>-->
<?}?>
<? if($i>1 && $i%2==0){?>
<?$j=$i+1;?>
</tr></table>
<!-- ------------------------------end products - row <? echo($i);?>------------------------------ -->

<!-- ------------------------------begin products - row <? echo($j);?>------------------------------ -->
<table width="760" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?}?>
<?$i++;?>
<?}?>

</td>
</tr></table><br><br>
<!-- ------------------------------end products - row 3------------------------------ -->

</td>
<td></td>
</tr></table>

</td>
</tr></table>

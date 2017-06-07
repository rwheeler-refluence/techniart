<? $ID=242;?>
<? include("database.php"); ?>
<? include("header.php");?>
  <!-- ------------------------------begin header------------------------------ -->

  <!-- ------------------------------end header------------------------------ -->
    
  <!-- ------------------------------begin body------------------------------ -->
  <table width="906" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td height="477" valign="bottom" background="led10pack.jpg"><div align="right">
          <?
$sqlp="select * from tblProducts_smeco where productID='$ID'";
$resultp=db_query($sqlp);
while($rowp=mysql_fetch_array($resultp)){
	$productID=$rowp['productID'];
	$productName=$rowp['productName'];
	$imageLoc=$rowp['imageLoc'];
	$MSRP=$rowp['MSRP'];
	$descrip=$rowp['descrip'];
	$productPub=$rowp['productPub'];
			$loc=$rootDir."pix/products/".$imageLoc;
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
          
          
        </div>
        <form method="post" action="cart.php">
                
          <div align="center">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="productID" value="<? echo($productID);?>">
            <? if($subtitle && $watts_used){?>
            
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
            <? if(!$_SESSION['']){?>
            <input type="hidden" name="modelNumber" value="<? echo($modelNumber);?>">
            <input type="hidden" name="qty" value="1">
            <input type="hidden" name="price" value="<? echo($price);?>">
            <input type="hidden" name="productName" value="<? echo($productName);?>">
            <input name="image" type="image" onClick="this.form.submit();" src="buy-now.png" alt="Buy now" align="right" border="0">
            <?}?>
          </div>
      </form></td>
    </tr>
    </table>
       
            
       
  <br>
  
  
</td>
</tr></table>
<? include("footer.php");?></div>
</body>
</html>


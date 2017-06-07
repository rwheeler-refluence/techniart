<? include("database.php");?>

<? $show=$_GET['show'];?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Berkshire Gas Online Sale</title>

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
<style type="text/css">
<!--
body,td,th {
	color: #000000;
}
a:link {
	color: #FFFFFF;
}
a:visited {
	color: #FFFFFF;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<BODY>
<div align="center"><div class="fbwhitebox">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
  <!-- ------------------------------end header------------------------------ -->
    
  <!-- ------------------------------begin body------------------------------ -->
  <table width="900" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td height="379" valign="bottom" background="lamps.jpg"><div align="right">
          <?
$sqlp="select * from tblProducts_berkshire where productID='$ID'";
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
        <form method="post" action="https://www.techniart.us/BerkshireGas/cart.php">
                
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
           
            <?}?>
          </div>
      </form></td>
    </tr>
    </table>
       
            
       
  <br>
  <table width="900" border="1" align="center">
    
    <tr>
      <td width="884" height="42" colspan="2" align="center"><strong class="style1"><table align="center">
        <tr>
          <td width="280" align="center"><form method="post" action="https://www.techniart.us/BerkshireGas/cart.php">
            <span class="cart">
              <strong>
                <input hidden name="otsID" value="<? echo($otsID);?>">
                White LED Desk Lamp</strong></span><br>
            <span class="cart-header"><br>
              $<strong>10</strong> </span><br>
            <br>
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="productID" value="562">
            <input type="hidden" name="qty" value="1">
            <input type="hidden" name="price" value="10">
            <input type="hidden" name="productName" value="White LED Desk Lamp">
            <input type="submit" class="btn" name="Add to Cart" value="Add to Cart" onClick="this.form.submit();">&nbsp;&nbsp;
            <br>
            <br>
            <a href="WW-kit.pdf" target="_blank">More Info </a>
            
            </form></td>
          <td width="31" align="center">&nbsp;</td>
          <td width="275" align="center" valign="top"><form method="post" action="https://www.techniart.us/BerkshireGas/cart.php">
            <span class="cart"><strong>Black LED Desk Lamp</strong></span><br>
            <span class="cart-header"><br>
              $1<strong>0</strong></span> <br>
            <br>
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="productID" value="561">
            <input type="hidden" name="qty" value="1">
            <input type="hidden" name="price" value="10">
            <input type="hidden" name="productName" value="Black LED Desk Lamp">
            <input type="submit" class="btn" name="Add to Cart" value="Add to Cart" onClick="this.form.submit();">
            <a href="WW-br30.pdf" target="_blank"><br>
              <br>
              More Info </a>
            </form></td></tr>
  </table></strong></td>
    </tr>
    </table>
  
</td>
</tr></table>
<? include("footer.php");?></div>
</body>
</html>


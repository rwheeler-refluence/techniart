<? include("database.php");?>
<?$ID=242;?>
<? $show=$_GET['show'];?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="js/shadowbox.css">
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>

<title>TechniArt</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<link rel="STYLESHEET" type="text/css" href="menu.css">
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<center>
<div class="fbwhitebox">
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="201" align="left" valign="bottom"><img src="pix/logos/ta-logo.jpg" width="194" height="51"></td>
<td width="321" align="center" valign="middle"><br></td>
<td width="276" align="center" valign="bottom">&nbsp;</td>
<td width="72" align="right" valign="middle"><p class="footer_content_style3"><a href="index.php" class="secondary_nav" title="Site Map">Home </a><a href="index.php"></a></p>
  <br />
  <span class="footer_content_style3"><a href="cart.php" class="secondary_nav" title="Site Map">View Cart </a></span></td>
<td width="36" align="right" valign="middle">&nbsp;</td>
</tr>
  <tr valign="top">
    <td colspan="6" valign="middle">
    <table width="906" border="0">
  <tr>
    <td><? include("menu.php");?></td>
  </tr>
</table></td>
  </tr>
</table>
<div align="center">
  <!-- ------------------------------begin header------------------------------ -->
  <!-- ------------------------------end header------------------------------ -->
    
  <!-- ------------------------------begin body------------------------------ -->
  <table width="900" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td height="379" valign="bottom" background="led-6pack-c.jpg"><div align="right">
          <?
$sqlp="select * from tblProducts where productID='$ID'";
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
        <form method="post" action="https://www.techniart.us/johanna/cart.php">
                
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
            <input type="hidden" name="price" value="10.00">
            <input type="hidden" name="productName" value="<? echo($productName);?>">
            <input name="image" type="image" onClick="this.form.submit();" src="buy.png" alt="Buy now" align="right" border="0">
            <?}?>
          </div>
      </form></td>
    </tr>
    </table>
       
            
       
  <br>
  <table width="900" border="1" align="center">
    
    <tr>
      <td height="52" colspan="2"><div align="center"><span class="style1">The LED 6-Pack contains the following:</span></div></td>
    </tr>
    <tr>
      <td width="332" height="260"><div align="center"><img src="tcp-led-a19.jpg" width="70" height="130"><img src="tcp-led-a19.jpg" width="70" height="130"><img src="tcp-led-a19.jpg" width="70" height="130"><br>
        <img src="tcp-led-a19.jpg" width="70" height="130"><img src="tcp-led-a19.jpg" width="70" height="130"><img src="tcp-led-a19.jpg" width="70" height="130"></div></td>
      <td width="552" align="left"><div class="style1">6 - 60 watt equivalent 
        LED A19s      </div>
        <ul>
          <li>
            10w usage = 60 watt equivalent output
            </li>
          <li>
            25,000 hour lifetime
            </li>
          <li>800 lumens
            </li>
          <li>
            2700K - warm white color
            </li>
          <li>
            fully dimmable
            </li>
          </ul></td>
    </tr>
    </table>
  <br>

<? include("footer.php");?>
</body>
</html>


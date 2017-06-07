<? include("database.php");?>
<?$ID=244;?>
<? $show=$_GET['show'];?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - NSTAR LED &amp; Showerhead &amp; APS Kit</title>

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
<link rel="STYLESHEET" type="text/css" href="menu.css">
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

<script type="text/javascript" src="js/shadowbox-2.0.js"></script>
<script type="text/javascript">

Shadowbox.loadSkin('classic', 'src/skin');
Shadowbox.loadLanguage('en', 'src/lang');
Shadowbox.loadPlayer(['flv', 'html', 'iframe', 'img', 'qt', 'swf', 'wmp'], 'src/player');

window.onload = function(){

    Shadowbox.init();

};

</script>
<style type="text/css">
<!--
.style1 {font-size: 20px}
-->
</style>
</head>

<BODY>
<div align="center">
  <!-- ------------------------------begin header------------------------------ -->
  <? include("header.php"); ?>
  <!-- ------------------------------end header------------------------------ -->
    
  <!-- ------------------------------begin body------------------------------ -->
  <table width="900" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td height="379" valign="bottom" background="led-sh-aps-back.jpg"><div align="right">
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
        <form method="post" action="https://www.techniart.com/nstar/cart.php">
                
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
            <input type="hidden" name="price" value="15.00">
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
      <td height="52" colspan="2"><div align="center"><span class="style1">The LED 4-Pack &amp; Showerhead &amp; APS kit contains the following products:</span></div></td>
    </tr>
    <tr>
      <td width="340" height="260"><div align="center"><img src="tcp-led-a19.jpg" width="70" height="130"><img src="tcp-led-a19.jpg" width="70" height="130"><img src="tcp-led-a19.jpg" width="70" height="130"><img src="tcp-led-a19.jpg" width="70" height="130"></div></td>
      <td width="544" align="left"><div class="style1">4 - 60 watt equivalent Omni-directional LED A19s </div>
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
				warm white color
            </li>
            <li>
              fully dimmable
            </li>
          </ul></td>
    </tr>
    <tr>
      <td height="260" align="center"><img src="roadrunner.jpg" width="300" height="262"></td>
      <td align="left"><div class="style1">1 - Evolve Roadrunner II Showerhead<br>
      </div>
        <ul>
          <li>ShowerStart&#8482; technology </li>
          <li>The evolve showerhead cuts flow to a trickle once water is warm so it's not running down the drain while you're away (or, before you enter)</li>
          <li>This luxury showerhead conserves while you're taking a shower, and its ShowerStart&#8482; technology also saves the hot water that's wasted before you actually get in.<br>
          </li>
          <li>Restart normal flow by pulling cord or flipping switch.</li>
          <li>powerful spray pattern</li>
          <li>54 nozzles for maximum coverage and warmth</li>
          <li> 1.5 gpm (5.7 L/min) maximum flow @ 80 psi </li>
          <li> 1.1 gpm (4.2 L/min) minimum flow @ 45 psi </li>
          <li>pressure compensating flow regulation - great feeling shower even in homes with lower water pressure</li>
          <li>rub clean anti-clog spray nozzles</li>
          <li>solid brass fittings</li>
          <li>stylish european design</li>
          <li>3 year warranty </li>
      </ul></td>
    </tr>
    <tr>
      <td height="260" align="center"><img src="tricklestrip.jpg" alt="" width="315" height="161"></td>
      <td align="left"><div class="style1">1 - TrickleStar Tier 1 TrickleStrip APS<br>
      </div>
        <ul>
          <li>Provides premium quality, fireproof surge protection for PC and TV peripherals</li>
          <li>Eliminates standby power consumed by PC and TV peripherals</li>
          <li>Protects electronics with state of the art surge protection</li>
          <li>Simple automation reduces plug-load</li>
          <li>Easy to install</li>
        </ul></td>
    </tr>
  </table>
  <br>
</div>
<? include("footer.php");?>
</body>
</html>


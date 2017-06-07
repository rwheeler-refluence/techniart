<? include("database.php");?>
<?$ID=242;?>
<? $show=$_GET['show'];?>
<?php
    // START SAFARI SESSION FIX
    session_start();
    $page_url = "https://www.techniart.com/facebook/facebook.php";
    if (isset($_GET["start_session"]))
        die(header("Location:" . $page_url));

    if (!isset($_GET["sid"]))
        die(header("Location:?sid=" . session_id()));
    $sid = session_id();
    if (empty($sid) || $_GET["sid"] != $sid):
?>
   <script>
        top.window.location="?start_session=true";
    </script>
<?php
    endif;
    // END SAFARI SESSION FIX
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - MassSavers Facebook Fan Bundle Sale</title>

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
</head>

<BODY>
<?php include_once("analyticstracking.php") ?>
  <table width="760" height="950" border="0">
    
    <tr>
      <td width="937" height="950"><table width="760" height="950" border="0" background="back.jpg">
        <tr>
          <td height="192" colspan="2">&nbsp;</td>
          <td width="51%">&nbsp;</td>
        </tr>
        <tr>
          <td height="145" colspan="2" valign="bottom"><?
$sqlp="select * from tblProducts_dealsinri where productID='$ID'";
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
          
          
        
        <form method="post" action="https://www.techniart.com/facebook/cart.php">
                
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
            <input name="image" type="image" onClick="this.form.submit();" src="buy.jpg" alt="Buy now" align="center" border="0">
            <?}?>
          </div>
      </form>
          <td width="51%">&nbsp;</td>
        <tr>
          <td height="297" colspan="2">&nbsp;</td>
          <td width="51%" height="297"><div align="left"><br>  
                <br>  
                <br>
                <strong><br>
&nbsp;&nbsp;&nbsp; <strong></strong>3 - Philips Omni Directional LED A19s </strong></div>
            <ul>
            <li>
              <div align="left">Energy Used (Watts) - 11</div>
            </li>
            <li>
              <div align="left"> Replaces (Watts) - 60</div>
            </li>
            <li>
              <div align="left"> Lumens - 830</div>
            </li>
            <li>
              <div align="left"> Color Rendering Index - 81</div>
            </li>
            <li>
              <div align="left"> Lifetime (Hours) - 25,000</div>
            </li>
            <li>
              <div align="left"> Color Temperature (K) - 2,700</div>
            </li>
            <li>
              <div align="left"> Beam Spread - Omni-directional</div>
            </li>
          </ul>          </td>
        </tr>
        <tr>
          <td width="7%" height="281">&nbsp;</td>
          <td width="42%">


  <div align="left"><strong>&nbsp;&nbsp;&nbsp; <strong></strong>7-outlet TrickleStrip<br>
  &nbsp;&nbsp;&nbsp; <strong></strong>Advanced Power Strip</strong></div>
  <ul>
            <li>
              <div align="left">
                1 Control Outlet            </div>
            </li>
            <li>
              <div align="left"> 2 Always-on Outlets </div>
            </li>
            <li>
              <div align="left"> 4 Switched Outlets </div>
            </li>
            <li>
              <div align="left">$20,000 equipment warranty</div>
            </li>
            <li>
              <div align="left">Selectable switching thresholds 10W / 22W / 42W</div>
            </li>
            <li>
              <div align="left">72,000 Amps / 1080 Joules</div>
            </li>
            <li>
              <div align="left">Ceramic Surge Protection</div>
            </li>
            <li>
              <div align="left">Heavy duty cord</div>
            </li>
            <li>
              <div align="left">Outlet protectors</div>
            </li>
  </ul>
          </td>
          <td height="281">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
</table>


  <p>
    <?php include_once("footer.php") ?>
</p>
</body>
</html>


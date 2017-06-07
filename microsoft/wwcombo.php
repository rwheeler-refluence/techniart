<? $ID=242;?>
<? include("database.php"); ?>
<? include("header.php");?>
  <!-- ------------------------------begin header------------------------------ -->

  <!-- ------------------------------end header------------------------------ -->
    
  <!-- ------------------------------begin body------------------------------ -->
  <table width="900" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td height="577" valign="bottom" background="wwcombo.jpg"><div align="right">
          
          </div>
      </form></td>
    </tr>
  </table>
       
            
       
  <br>
  <table width="900" border="1" align="center">
    
    <tr>
      <td width="489" height="42" align="center"><strong class="style1">Limit of (2) Home Efficiency Kits per residential account</strong></td>
      <td width="395" height="42" align="center"><?
$sqlp="select * from tblProducts_pse where productID='$ID'";
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
            <input name="buy" type="button" class="btn" value="Buy Now" onClick="this.form.submit();">
            <?}?></td>
    </tr>
    <tr>
      <td height="213"><div align="center">&nbsp;<img src="60w-a19s.jpg" width="317" height="175" alt=""/></div></td>
      <td align="left"><div align="center" class="style1"><strong>4 - 60 watt equivalent 
        Omni-directional<br>
        incandescent style LEDs</strong></div>
        <ul>
          <li>9w usage = 60 watt equivalent output
          </li>
          <li>
            <div align="left">25,000 hour lifetime</div>
          </li>
          <li>800 lumens </li>
          <li>
            <div align="left">warm white color</div>
          </li>
          <li>
            <div align="left">fully dimmable</div>
          </li>
        </ul></td>
    </tr>
    <tr>
      <td height="213" align="center"><img src="75w-100w.jpg" width="92" height="175" alt=""/></td>
      <td align="left"><div align="center" class="style1"><strong> 1- 75w watt equivalent 
        Omni-directional<br>
        incandescent style LED</strong></div>
        <ul>
          <li>
            <div align="left">13w usage = 75 watt equivalent output</div>
          </li>
          <li>
            <div align="left">25,000 hour lifetime</div>
          </li>
          <li>1100 lumens </li>
          <li>
            <div align="left">warm white color</div>
          </li>
          <li>
            <div align="left">fully dimmable</div>
          </li>
      </ul></td>
    </tr>
    <tr>
      <td height="213" align="center"><img src="75w-100w.jpg" width="92" height="175" alt=""/></td>
      <td align="left"><div align="center" class="style1"><strong> 1 - 100 watt equivalent 
        Omni-directional<br>
        incandescent style LED</strong></div>
        <ul>
          <li>
            <div align="left">18w usage = 100 watt equivalent output</div>
          </li>
          <li>
            <div align="left">25,000 hour lifetime</div>
          </li>
          <li>1600 lumens </li>
          <li>
            <div align="left">warm white color</div>
          </li>
          <li>
            <div align="left">fully dimmable</div>
          </li>
      </ul></td>
    </tr>
    <tr>
      <td height="213" align="center"><img src="aerator.jpg" width="138" height="150" alt=""/></td>
      <td align="left"><div align="center" class="style1"><strong> 1 - Kitchen Faucet Aerator</strong></div>
        <ul>
          <li>
            <div align="left">Swivel spray aerator with pause valve</div>
          </li>
          <li>
            <div align="left">Powerful 1.5 GPM flow, controlled by proprietary flow compensator</div>
          </li>
          <li>Control from soft spray to solid stream</li>
          <li>
            <div align="left">Rubberized grip for easy adjustment</div>
          </li>
          <li>
            <div align="left">Dual threads make for easy installation</div>
          </li>
      </ul></td>
    </tr>
    <tr>
      <td height="213" align="center"><img src="bath-aerator.jpg" width="154" height="150" alt=""/></td>
      <td align="left"><div align="center" class="style1"><strong> 2 - Dual Thread Aerators</strong></div>
        <ul>
          <li>
            <div align="left">Dual-thread aerator to fit both male and female faucets</div>
          </li>
          <li>
            <div align="left">Works well in both kitchens and baths</div>
          </li>
          <li>Flow Control:Pressure Compensated</li>
          <li>
            <div align="left">Dual-thread brass connection, Male:15/16-27 Female: 55/64-27</div>
          </li>
          <li>
            <div align="left">10-year guarantee</div>
          </li>
      </ul></td>
    </tr>
    <tr>
      <td height="213" align="center"><img src="showerhaead.jpg" width="231" height="254" alt=""/></td>
      <td align="left"><div align="center" class="style1"><strong> High efficiency showerhead</strong></div>
        <ul>
          <li>
            <div align="left">Chrome plated finish</div>
          </li>
          <li>
            <div align="left">Full body & massage spray patterns + “soap-up” pause setting</div>
          </li>
          <li>50 rub-clean, anti-clog spray nozzles</li>
          <li>
            <div align="left">Pressure compensating flow regulation</div>
          </li>
          <li>
            <div align="left">WaterSense certification</div>
          </li>
      </ul></td>
    </tr>
    
  </table>
  
</td>
</tr></table>
<? include("footer.php");?></div>
</body>
</html>


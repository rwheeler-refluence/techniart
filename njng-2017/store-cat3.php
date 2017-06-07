<? include("database.php");?>
<? include("jersey.php");?>
<?
$action=$_GET['action'];
$keyword=$_GET['keyword'];
$sort1=$_GET['sort'];
if(!$sort1){
	$sort="watts_used";
}else{
	$sort="".$sort1.",watts_used";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Energy Saving Outlet</title>
<meta name="robots" content="index,follow" />
<meta name="author" content="Energy Saving Outlet" />
<meta name="publisher" content="energysavingoutlet.com" />
<meta name="copyright" content="Copyright 2010 Energy Saving Outlet. All Rights Reserved" />
<meta http-equiv="content-language" content="EN" />
<meta name="content-language" content="EN" />
<meta name="rating" content="All" />
<meta name="audience" content="General" />
<meta name="distribution" content="Global" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<link type="text/css" rel="stylesheet" href="style/reset.css" />
<link type="text/css" rel="stylesheet" href="style/base.css" />
<link type="text/css" rel="stylesheet" href="style/buttons.css" />
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/shadowbox.css">
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
<style type="text/css">
img, div, #, input, ul, li, em, span {
 behavior: url("iepngfix.htc")
}
</style>
<!-- begin sticky footer ie6 hack -->
<!--[if lt IE 7]>
  <link rel="stylesheet" type="text/css" href="ie6.css" />
<![endif]-->
<!-- end sticky footer ie6 hack -->
<script type="text/javascript">
function loadContent(elementSelector, sourceUrl) {
	$(""+elementSelector+"").load(sourceUrl);
	
}
</script>
</head>
<body>
<? include("includes/newsletter-signup-div.php"); ?>
<div class="wrapper-body-main-ip">
	<div class="body-bkg-main-ip">
		<div class="grid-header-ip">
			<div class="page grid-header-ip-column1"> <a href="index.php" title="Energy Saving Outlet - web site home page"><img src="pix/pix_trans.gif" width="200" height="158" /></a> </div>
			<!--end page grid-header-ip-column1-->
			<div class="page grid-header-ip-column2">
				<? include("includes/header.php"); ?>
			</div>
			<!--end page grid-header-ip-column2-->
			<br style="clear:both" />
		</div>
		<!--end grid-header-ip-->
		<div class="page grid-ip-onecolumn">
			<div class="spacer-main-content"> <span class="title_style1">Store</span> <br />
				<br />
				<p>
					<? include("zip.php");?>
				<?
				$subcat=$_GET['subcat'];
				$subcat1=$_GET['subcat1'];
				if($action=='search'){
					$sqlp="select * from tblProducts where (category like '%$keyword%' || productName LIKE '%$keyword%' || modelNumber LIKE '%$keyword%') && productPub='Yes' order by $sort asc";
				}else{
					$sqlp.="select * from tblProducts where category='$cat' ";
					if($subcat){
						$sqlp.="&& subcat1='$subcat'";
					}
					if($subcat1){
						$sqlp.="&& subcat2='$subcat1'";
					}
					$sqlp.=" && productPub='Yes' order by $sort asc";
				}
				#print($sqlp);
				$resultp=db_query($sqlp);
				$countp=mysql_num_rows($resultp);
				if($countp==1){
					$label="result";
				}else{
					$label="results";
				}
				$i=1;

				if($action=='search'){
					print("<p class=\"heading\">You searched for the term: ".$keyword."</p>");
					print("<p>".$countp." results found</p>");
				}else{
					print("<p class=\"heading\"><a href=\"store-cat.php?cat=".$cat."\">".$cat." Products</a></p>");
					if($subcat){
						print(" <p>- <a href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."\">".$subcat."</a></p>");
					}
					if($subcat1){
						print("<p> - <a href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat1."\">".$subcat1."</a></p>");
					}
					if(!$subcat){
						$sqlsubs="select distinct subcat1 from tblProducts where category='$cat' && subcat1!=''";
						$resultsubs=db_query($sqlsubs);
						$countsubs=mysql_num_rows($resultsubs);
						$subs=1;
						while($rowsubs=mysql_fetch_array($resultsubs)){
							$subcat1=$rowsubs['subcat1'];
							print("<p><a href=\"store-cat.php?cat=".$cat."&subcat=".$subcat1."\">".$subcat1."</a></p>");
							if($subs<$countsubs){
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
							print("<p><a href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat2."\">".$subcat2."</a></p>");
							if($subs<$countsubs){
							}
							$subs++;
						}
						if($countsubs>0){
							print("<br>");
						}
					}
				}
				?>
				<!-- ------------------------------begin products - row <? echo($i);?>------------------------------ -->
				<? if($action!=='search' || ($action=='search' && $countp>0)){?>
				<div align="right"> <p>Sort by:&nbsp;
					<select name="theSelect" size=1 onChange="if (this.selectedIndex >0) window.location=this.options[this.selectedIndex].value">
						<option value="">
						<option value="<? echo($PHP_SELF);?>?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=replacement_wattage&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Replacement wattage
						<option value="<? echo($PHP_SELF);?>?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=watts_used&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Wattage used
						<option value="<? echo($PHP_SELF);?>?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=MSRP&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Price
						<option value="<? echo($PHP_SELF);?>?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=color_temp&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Color temperature
						<option value="<? echo($PHP_SELF);?>?cat=<? echo($cat);?>&subcat=<? echo($subcat);?>&sort=manuf&action=<? echo($action);?>&keyword=<? echo($keyword);?>">Manufacturer
					</select></p>
				</div>
				<br>
				<?}?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr valign="top">
						<?
				#	print("state:".$_SESSION['st']."<br>");
				while($rowp=mysql_fetch_array($resultp)){
					$productID=$rowp['productID'];
					$productName=$rowp['productName'];
					$modelNumber=$rowp['modelNumber'];
					$MSRP=number_format($rowp['MSRP'], 2, '.', ',');
					$nomsrp="";
					if(strlen($_SESSION['zip_qualify'])>0){
				 #print("ss:".$_SESSION['st']);
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
							$loc=$rootDir."pix/products/thumbnails/".$imageLoc;
							if(!file_exists($loc)){
								$loc=$rootDir."pix/products/".$imageLoc;
								$folder="pix/products/";
							}else{
								$folder="pix/products/thumbnails/";
							}
							if(!file_exists($loc)){
								$loc="pix/products/soon.jpg";
								$folder="pix/products/";
								$imageLoc="soon.jpg";
							}
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
						<td width="275"><form id="BuyNow" name="BuyNow" method="post" action="cart.php">
								<input type="hidden" name="action" value="add">
								<table width="275" border="0" cellspacing="0" cellpadding="0">
									<tr valign="top">
										<td width="106"><a href="store-detail.php?ID=<? echo($productID);?>&show=<? echo($show);?>" style="border-bottom: none; padding-bottom: 0px;"><img src="<? echo($folder);?><? echo($imageLoc);?>" alt="<? echo($productName);?>" width="<? echo($width);?>" height="<? echo($height);?>" border="0" class="img_border-padding"></a></td>
										<td width="123"><img src="pix/pix_trans.gif" width="123" height="1"><br>
											<p class="product_title"><? echo($productName);?></p>
											<p class="product_number">#<? echo($modelNumber);?></p>
											<? if($nomsrp=='Yes'){?>
											<p class="product_price"><strike>$<? echo($MSRP);?></strike></p>
											<?}?>
											<p class="product_price">$<? echo($price);?></p>
											<? if(!$_SESSION['']){?>
											<input type="hidden" name="productID" value="<? echo($productID);?>">
											<input type="hidden" name="modelNumber" value="<? echo($modelNumber);?>">
											<input type="hidden" name="qty" value="1">
											<input type="hidden" name="price" value="<? echo($price);?>">
											<input type="hidden" name="productName" value="<? echo($productName);?>">
											<div class="button-clear"> <a href="#" class="button-sm" onclick="document.BuyNow.submit();" style="border-bottom: none; padding-bottom: 0px;"> <em><span class="general">Buy Now</span></em> </a> </div>
											<img src="pix/pix_trans.gif" width="1" height="3"><br>
											<?}?>
											<div class="button-clear"> <a href="store-detail.php?ID=<? echo($productID);?>&show=<? echo($show);?>" class="button-sm" style="border-bottom: none; padding-bottom: 0px;"> <em><span class="general">Learn More</span></em> </a> </div>
											<!--end button-clear--></td>
									</tr>
								</table>
							</form>
							<br></td>
						<? if($i>1 && $i%2!==0){?>
						<!--<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>-->
						<?}?>
						<? if($i>1 && $i%3==0){?>
						<?$j=$i+1;?>
					</tr>
				</table>
				<br>
				<br>
				<!-- ------------------------------end products - row <? echo($i);?>------------------------------ -->
				<!-- ------------------------------begin products - row <? echo($j);?>------------------------------ -->
				<table width="853" border="0" cellspacing="0" cellpadding="0">
					<tr valign="top">
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
					</tr>
				</table>
				<br>
				<br>
				<!-- ------------------------------end products - row 3------------------------------ -->
			</div>
			</td>
			<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="1" border="0"></td>
			</tr>
			</table>
			</p>
			<br />
		</div>
		<!--end spacer-main-content-->
		<? include("includes/banners.php");?>
		<br style="clear:both" />
	</div>
	<!--end page grid-ip-onecolumn-->
</div>
<!--end body-bkg-main-ip-->
<div class="push"></div>
</div>
<!--end wrapper-body-main-ip-->
<div class="footer">
	<? include("includes/footer.php"); ?>
</div>
<!--end footer-->
<script language="javascript">	
var a = document.getElementById('newsletter');
     a.style.display = 'none';
function toggle() {
  var a = document.getElementById('newsletter');
 if (a.style.display =='block'){
	 a.style.display='none';
 } else {
	a.style.display='block';  
 }
 }
 </script>
</body>
</html>

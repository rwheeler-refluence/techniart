<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php");?>
<? 
$action=$_POST['action'];
if($action=='update'){
	$category=addslashes($_POST['category']);
	$category=str_replace("_"," ",$category);
	$subcategory=addslashes($_POST['subcategory']);
	$subcategory2=addslashes($_POST['subcategory2']);
	$subcategory3=addslashes($_POST['subcategory3']);
	$class=addslashes($_POST['class']);
	$productName=addslashes($_POST['productName']);
	$subtitle=addslashes($_POST['subtitle']);
	$manuf=addslashes($_POST['manuf']);
	$imageLoc=addslashes($_POST['imageLoc']);
	$thumbLoc=addslashes($_POST['thumbLoc']);
	$modelNumber=addslashes($_POST['modelNumber']);
	$MSRP=addslashes($_POST['MSRP']);
	$disct_price=addslashes($_POST['disct_price']);
	$disct_price_nj=addslashes($_POST['disct_price_nj']);
	$bulb_height=addslashes($_POST['bulb_height']);
	$dim=addslashes($_POST['dim']);
	$weight=addslashes($_POST['weight']);
	$ct_tax_exempt=addslashes($_POST['ct_tax_exempt']);
	$free_ship=addslashes($_POST['free_ship']);
	$watts_used=addslashes($_POST['watts_used']);
	$replacement_wattage=addslashes($_POST['replacement_wattage']);
	$light_output=addslashes($_POST['light_output']);
	$color_temp=addslashes($_POST['color_temp']);
	$color_rendering=addslashes($_POST['color_rendering']);
	$rated_lifetime=addslashes($_POST['rated_lifetime']);
	$min_start_temp=addslashes($_POST['min_start_temp']);
	$electrical_spec=addslashes($_POST['electrical_spec']);
	$base=addslashes($_POST['base']);
	$manuf_warranty=addslashes($_POST['manuf_warranty']);
	$energy_star=addslashes($_POST['energy_star']);
	$FCKeditor1=addslashes($_POST['FCKeditor1']);
	$FCKeditor2=addslashes($_POST['FCKeditor2']);
	$FCKeditor3=addslashes($_POST['FCKeditor3']);
	$table_floor=addslashes($_POST['table_floor']);
	$pendant=addslashes($_POST['pendant']);
	$ceiling=addslashes($_POST['ceiling']);
	$ceilingfans=addslashes($_POST['ceilingfans']);
	$wallsconce=addslashes($_POST['wallsconce']);
	$recessedcans=addslashes($_POST['recessedcans']);
	$tracklighting=addslashes($_POST['tracklighting']);
	$outdoorcovering=addslashes($_POST['outdoorcovering']);
	$outdoorexposed=addslashes($_POST['outdoorexposed']);
	$replacement_bulb=addslashes($_POST['replacement_bulb']);
	#main
	$imgpath="".$rootDir."pix/products/";
	$imgsource = $_FILES['imageLoc']['tmp_name'];
	$imgdest = $imgpath.$_FILES['imageLoc']['name'];
	$imgpath=$_FILES['imageLoc']['name'];
	if($_FILES['imageLoc']['tmp_name']!==''){
		move_uploaded_file($imgsource, $imgdest);
	}
	#thumb
	$imgpath2="".$rootDir."pix/products/thumbnails/";
	$imgsource2 = $_FILES['thumbLoc']['tmp_name'];
	$imgdest2 = $imgpath2.$_FILES['thumbLoc']['name'];
	$imgpath2=$_FILES['thumbLoc']['name'];
	if($_FILES['thumbLoc']['tmp_name']!==''){
		move_uploaded_file($imgsource2, $imgdest2);
	}
	#replacement
	$imgpath3="".$rootDir."pix/products/";
	$imgsource3 = $_FILES['replacement_bulb']['tmp_name'];
	$imgdest3 = $imgpath3.$_FILES['replacement_bulb']['name'];
	$imgpath3=$_FILES['replacement_bulb']['name'];
	if($_FILES['replacement_bulb']['tmp_name']!==''){
		move_uploaded_file($imgsource3, $imgdest3);
	}

			$sql="insert into tblProducts_raytheon values ('','$category','$subcategory1','$subcategory2','$subcategory3','$class','$productName','$manuf','$imgpath','$modelNumber','','$MSRP','$disct_price','$disct_price_nj','$bulb_height','$dim','$weight','$ct_tax_exempt','$free_ship','$subtitle','$watts_used','$replacement_wattage','$light_output','$color_temp','$color_rendering','$rated_lifetime','$min_start_temp','$electrical_spec','$base','$manuf_warranty','$energy_star','$FCKeditor1','$FCKeditor2','$FCKeditor3','$table_floor','$pendant','$ceiling','$ceilingfans','$wallsconce','$recessedcans','$tracklighting','$outdoorcovering','$outdoorexposed','$imgpath3','No')";
			$result=db_query($sql);
			header("location: show_products.php?cat=".$category."");
		}

?>
<? include("editor/fckeditor.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Techniart, Inc.</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

		<script type="text/javascript">
		function loadSub() {
			var varg=document.Form1.category.value;
			$("#sub").load('vars/sub.php?ID='+varg);
		}
		function loadSub2() {
			var varg=document.Form1.subcategory.value;
			$("#sub2").load('vars/sub2.php?ID='+varg);
		}
		function loadSub3() {
			var varg=document.Form1.subcategory2.value;
			$("#sub3").load('vars/sub3.php?ID='+varg);
		}

		function loadInitial() {
			$("#sub").load('vars/initial.php');
			$("#sub2").load('vars/initial.php');
			$("#sub3").load('vars/initial.php');
		}
</script>
</head>

<BODY onLoad="loadInitial();document.Form1.category.disabled=false;">

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="body_content"><span style="font-size: 14px;"><b>PRODUCTS | </b></span><span style="color:#a02136; font-size: 18px;"><b>ADD PRODUCT</b></span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->



<? if($msg){
	print("<b>".$msg."</b><br><br>\n");
}
?>
<form name="Form1" id="Form1" method="post" action="<? echo($PHP_SELF); ?>" enctype="multipart/form-data">
<input type="hidden" name="action" value="update">
<table border="0" width="400">
<tr>
<td><span class="body_content"><b>Category</b></span><br>
<select class="forms" id="category" name="category" size="1" onChange="loadSub();" disabled>
<?
print("<option value=\"\">Choose a Category\n");
#category dropdown
$sql1="select distinct category from tblProducts_raytheon order by category asc";
$result1=db_query($sql1);
	while($row1 = mysql_fetch_array($result1)){ 
		$category1=$row1['category'];
		$category=str_replace(" ","_",$category1);
		print("<option value=\"".$category."\">".$category1."\n");
	}				
print("</select>\n");
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Subcategory</b></span><br>
<div id="sub" name="sub"></div></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Subcategory 2</b></span><br>
<div id="sub2" name="sub2"></div></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Subcategory 3</b></span><br>
<div id="sub3" name="sub3"></div></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Class</b></span><br>
<input type="text" size="45" name="class"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Product Title</b></span><br>
<input type="text" size="45" name="productName"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Product SubTitle</b></span><br>
<input type="text" size="45" name="subtitle"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Manufacturer</b></span><br>
<input type="text" size="45" name="manuf"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Product Image</b></span><br>
<input type="file" size="45" name="imageLoc"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Product Thumbnail</b></span><br>
<input type="file" size="45" name="thumbLoc"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Model Number</b></span><br>
<input type="text" size="45" name="modelNumber"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>MSRP</b></span><br>
<span class="body_content"><b>$</b></span><input type="text" size="45" name="MSRP"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Discount Price CT</b></span><br>
<span class="body_content"><b>$</b></span><input type="text" size="45" name="disct_price"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Discount Price NJ</b></span><br>
<span class="body_content"><b>$</b></span><input type="text" size="45" name="disct_price_nj"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Bulb Height</b></span><br>
<span class="body_content"></span><input type="text" size="45" name="bulb_height"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Dimensions</b></span><br>
<input type="text" size="45" name="dim"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Weight</b></span><br>
<input type="text" size="45" name="weight"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Tax Exempt in CT?</b></span><br>
<span class="body_content"><input type="radio" name="ct_tax_exempt" value="Yes">Yes<br><input type="radio" name="ct_tax_exempt" value="No">No</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Eligible For Free Shipping?</b><br>
<input type="radio" name="free_ship" value="Yes">Yes<br><input type="radio" name="free_ship" value="No">No<br></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Watts Used</b></span><br>
<input type="text" size="45" name="watts_used"></td>
</tr>
<tr><td>&nbsp;</td></tr><tr>
<td><span class="body_content"><b>Replacement Wattage</b></span><br>
<input type="text" size="45" name="replacement_wattage"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Light Output</b></span><br>
<input type="text" size="45" name="light_output"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Color Temp</b></span><br>
<input type="text" size="45" name="color_temp"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Color Rendering</b></span><br>
<input type="text" size="45" name="color_rendering"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Rated Lifetime</b></span><br>
<input type="text" size="45" name="rated_lifetime"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Minimum Start Temp</b></span><br>
<input type="text" size="45" name="min_start_temp"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Electrical Spec</b></span><br>
<input type="text" size="45" name="electrical_spec"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Base</b></span><br>
<input type="text" size="45" name="base"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Manuf. Warranty</b></span><br>
<input type="text" size="45" name="manuf_warranty"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Energy Star?</b></span><br>
<select name="energy_star" size="1">
<option value="Yes">Yes
<option value="No">No
</select>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Description</b></span><br>
<?php
$sBasePath = "editor/";

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $descrip;
$oFCKeditor->Height	= '600' ;
$oFCKeditor->Width	= '520' ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Disclaimer</b></span><br>
<?php
$oFCKeditor = new FCKeditor('FCKeditor2') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $descrip;
$oFCKeditor->Height	= '600' ;
$oFCKeditor->Width	= '520' ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Recommended Usage</b></span><br>
<?php
$oFCKeditor = new FCKeditor('FCKeditor3') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $descrip;
$oFCKeditor->Height	= '600' ;
$oFCKeditor->Width	= '520' ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Applications</b><br>
<input type="checkbox" name="table_floor" value="x">Table Floor<br>
<input type="checkbox" name="pendant" value="x">Pendant<br>
<input type="checkbox" name="ceiling" value="x">Ceiling<br>
<input type="checkbox" name="ceilingfans" value="x">Ceiling Fans<br>
<input type="checkbox" name="wallsconce" value="x">Wall Sconce<br>
<input type="checkbox" name="recessedcans" value="x">Recessed Cans<br>
<input type="checkbox" name="tracklighting" value="x">Track Lighting<br>
<input type="checkbox" name="outdoorcovering" value="x">Outdoor Covering<br>
<input type="checkbox" name="outdoorexposed" value="x">Outdoor Exposed<br>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Replacement Bulb Image?</b><br>
<input type="file" size="45" name="replacement_bulb"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan="2"><input type="submit" value="Add Product"></td></tr></table>
</form>

<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html><?php ob_end_flush() ?>
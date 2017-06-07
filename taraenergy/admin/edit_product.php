 <?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php");?>
<? 
$action=$_POST['action'];
if($action=='update'){
	$productID=$_POST['productID'];
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

	$sql.="update tblProducts set category='$category',subcat1='$subcategory1',subcat2='$subcategory2',subcat3='$subcategory3',class='$class',productName='$productName',manuf='$manuf'";
	
	#main
	$imgpath="".$rootDir."pix/products/";
	$imgsource = $_FILES['imageLoc']['tmp_name'];
	$imgdest = $imgpath.$_FILES['imageLoc']['name'];
	$imgpath=$_FILES['imageLoc']['name'];
	if($_FILES['imageLoc']['tmp_name']!==''){
		move_uploaded_file($imgsource, $imgdest);
		$sql.=",imageLoc='$imgpath'";
	}
	#thumb
	$imgpath2="".$rootDir."pix/products/thumbnails/";
	$imgsource2 = $_FILES['thumbLoc']['tmp_name'];
	$imgdest2 = $imgpath2.$_FILES['thumbLoc']['name'];
	$imgpath2=$_FILES['thumbLoc']['name'];
	if($_FILES['thumbLoc']['tmp_name']!==''){
		move_uploaded_file($imgsource2, $imgdest2);
		$sql.=",imageLoc='$imgpath'";
	}
	$sql.=",modelNumber='$modelNumber',MSRP='$MSRP',disct_price='$disct_price',disct_price_nj='$disct_price_nj',bulb_height='$bulb_height',dim='$dim',weight='$weight',ct_tax_exempt='$ct_tax_exempt',free_ship='$free_ship',subtitle='$subtitle',watts_used='$watts_used',replacement_wattage='$replacement_wattage',light_output='$light_output',color_temp='$color_temp',color_rendering='$color_rendering',rated_lifetime='$rated_lifetime',min_start_temp='$min_start_temp',electrical_spec='$electrical_spec',base='$base',manuf_warranty='$manuf_warranty',energy_star='$energy_star',descrip='$FCKeditor1',disclaimer='$FCKeditor2',recommended='$FCKeditor3',table_floor='$table_floor',pendant='$pendant',ceiling='$ceiling',ceilingfans='$ceilingfans',wallsconce='$wallsconce',recessedcans='$recessedcans',tracklighting='$tracklighting',outdorcovering='$outdoorcovering'";
	#replacement
	$imgpath3="".$rootDir."pix/products/";
	$imgsource3 = $_FILES['replacement_bulb']['tmp_name'];
	$imgdest3 = $imgpath3.$_FILES['replacement_bulb']['name'];
	$imgpath3=$_FILES['replacement_bulb']['name'];
	if($_FILES['replacement_bulb']['tmp_name']!==''){
		move_uploaded_file($imgsource3, $imgdest3);
		$sql.="replacement_bulb='$imgpath3'";
	}

			$sql.=",outdoorexposed='$outdoorexposed' where productID='$productID';";
		#	print($sql);
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
<?
$ID=$_GET['ID'];
$sql="select * from tblProducts where productID='$ID'";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$productID=$row['productID'];
	$category_a=stripslashes($row['category']);
	$category=str_replace("_"," ",$category_a);
	$subcategory=stripslashes($row['subcat1']);
	$subcategory2=stripslashes($row['subcat2']);
	$subcategory3=stripslashes($row['subcat3']);
	$class=stripslashes($row['class']);
	$productName=stripslashes($row['productName']);
	$subtitle=stripslashes($row['subtitle']);
	$manuf=stripslashes($row['manuf']);
	$imageLoc=stripslashes($row['imageLoc']);
	$thumbLoc=stripslashes($row['thumbLoc']);
	$modelNumber=stripslashes($row['modelNumber']);
	$MSRP=stripslashes($row['MSRP']);
	$disct_price=stripslashes($row['disct_price']);
	$disct_price_nj=stripslashes($row['disct_price_nj']);
	$bulb_height=stripslashes($row['bulb_height']);
	$dim=stripslashes($row['dim']);
	$weight=stripslashes($row['weight']);
	$ct_tax_exempt=stripslashes($row['ct_tax_exempt']);
	$free_ship=stripslashes($row['free_ship']);
	$watts_used=stripslashes($row['watts_used']);
	$replacement_wattage=stripslashes($row['replacement_wattage']);
	$light_output=stripslashes($row['light_output']);
	$color_temp=stripslashes($row['color_temp']);
	$color_rendering=stripslashes($row['color_rendering']);
	$rated_lifetime=stripslashes($row['rated_lifetime']);
	$min_start_temp=stripslashes($row['min_start_temp']);
	$electrical_spec=stripslashes($row['electrical_spec']);
	$base=stripslashes($row['base']);
	$manuf_warranty=stripslashes($row['manuf_warranty']);
	$energy_star=stripslashes($row['energy_star']);
	$descrip=stripslashes($row['descrip']);
	$disclaimer=stripslashes($row['disclaimer']);
	$recommend=stripslashes($row['recommend']);
	$table_floor=stripslashes($row['table_floor']);
	$pendant=stripslashes($row['pendant']);
	$ceiling=stripslashes($row['ceiling']);
	$ceilingfans=stripslashes($row['ceilingfans']);
	$wallsconce=stripslashes($row['wallsconce']);
	$recessedcans=stripslashes($row['recessedcans']);
	$tracklighting=stripslashes($row['tracklighting']);
	$outdoorcovering=stripslashes($row['outdorcovering']);
	$outdoorexposed=stripslashes($row['outdoorexposed']);
	$replacement_bulb=stripslashes($row['replacement_bulb']);
}
?>
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
			var varg1=document.Form1.productID.value;
			$("#sub").load('vars/sub.php?ID='+varg+'&subcategory1=<? echo($subcategory);?>&productID='+varg1);
		}
		function loadSub2() {
			var varg=document.Form1.subcategory.value;
			var varg1=document.Form1.productID.value;
			$("#sub2").load('vars/sub2.php?ID='+varg+'&subcategory2=<? echo($subcategory2);?>'&productID='+varg1);
		}
		function loadSub3() {
			var varg=document.Form1.subcategory2.value;
			var varg1=document.Form1.productID.value;
			$("#sub3").load('vars/sub3.php?ID='+varg+'&subcategory3=<? echo($subcategory3);?>'&productID='+varg1);
		}

		function loadInitial() {
			$("#sub").load('vars/sub.php');
			$("#sub2").load('vars/sub2.php');
			$("#sub3").load('vars/sub3.php');
		}
</script>
</head>
<BODY document.Form1.category.disabled=false;">

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="body_content"><span style="font-size: 14px;"><b>PRODUCTS | </b></span><span style="color:#a02136; font-size: 18px;"><b>EDIT PRODUCT</b></span></td>
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
<input type="hidden" name="productID" value="<? echo($ID);?>">
<table border="0" width="400">
<tr>
<td><span class="body_content"><b>Category</b></span><br>
<select class="forms" id="category" name="category" size="1">
<?
print("<option value=\"\">Choose a Category\n");
#category dropdown
$sql1="select distinct category from tblProducts order by category asc";
$result1=db_query($sql1);
	while($row1 = mysql_fetch_array($result1)){ 
		$category1=$row1['category'];
		$category=str_replace(" ","_",$category1);
		print("<option value=\"".$category."\"");
		if($category_a==$category1){
			print(" selected");
		}
		print(">".$category1."\n");
	}				
print("</select>\n");
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Subcategory</b></span><br>
<select class="forms" id="subcategory" name="subcategory" size="1" >
<?
print("<option value=\"\">Choose a subcategory\n");
#subcategory dropdown
$sql2="select distinct subcat1 from tblProducts order by subcat1 asc";
$result2=db_query($sql2);
	while($row2 = mysql_fetch_array($result2)){ 
		$subcat1a=$row2['subcat1'];
		print("<option value=\"".$subcat1a."\"");
		if($subcategory==$subcat1a){
			print(" selected");
		}
		print(">".$subcat1a."\n");
	}				
print("</select>\n");
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Subcategory 2</b></span><br>
<select class="forms" id="subcategory2" name="subcategory2" size="1" >
<?
print("<option value=\"\">Choose a subcategory\n");
#subcategory dropdown
$sql3="select distinct subcat2 from tblProducts order by subcat2 asc";
$result3=db_query($sql3);
	while($row3 = mysql_fetch_array($result3)){ 
		$subcat2a=$row3['subcat2'];
		print("<option value=\"".$subcat2a."\"");
		if($subcat2a==$subcategory2){
			print(" selected");
		}
		print(">".$subcat2a."\n");
	}				
print("</select>\n");
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Subcategory 3</b></span><br>
<select class="forms" id="subcategory3" name="subcategory3" size="1" >
<?
print("<option value=\"\">Choose a subcategory\n");
#subcategory dropdown
$sql4="select distinct subcat3 from tblProducts order by subcat3 asc";
$result4=db_query($sql4);
	while($row4 = mysql_fetch_array($result4)){ 
		$subcat3a=$row4['subcat3'];
		print("<option value=\"".$subcat3a."\"");
		if($subcategory3==$subcat3a){
			print(" selected");
		}
		print(">".$subcat3a."\n");
	}				
print("</select>\n");
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Class</b></span><br>
<input type="text" size="45" name="class" value="<? echo($class);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Product Title</b></span><br>
<input type="text" size="45" name="productName" value="<? echo($productName);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Product SubTitle</b></span><br>
<input type="text" size="45" name="subtitle" value="<? echo($subtitle);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Manufacturer</b></span><br>
<input type="text" size="45" name="manuf" value="<? echo($manuf);?>"></td>
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
<input type="text" size="45" name="modelNumber" value="<? echo($modelNumber);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>MSRP</b></span><br>
<span class="body_content"><b>$</b></span><input type="text" size="45" name="MSRP" value="<? echo($MSRP);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Discount Price CT</b></span><br>
<span class="body_content"><b>$</b></span><input type="text" size="45" name="disct_price" value="<? echo($disct_price);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Discount Price NJ</b></span><br>
<span class="body_content"><b>$</b></span><input type="text" size="45" name="disct_price_nj" value="<? echo($disct_price_nj);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Bulb Height</b></span><br>
<span class="body_content"></span><input type="text" size="45" name="bulb_height" value="<? echo($bulb_height);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Dimensions</b></span><br>
<input type="text" size="45" name="dim" value="<? echo($dim);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Weight</b></span><br>
<input type="text" size="45" name="weight" value="<? echo($weight);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Tax Exempt in CT?</b></span><br>
<span class="body_content"><input type="radio" name="ct_tax_exempt" value="Yes" <? if($ct_tax_exempt=='Yes'){print("checked");}?>>Yes<br><input type="radio" name="ct_tax_exempt" value="No" <? if($ct_tax_exempt=='No'){print("checked");}?>>No</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Eligible For Free Shipping?</b><br>
<input type="radio" name="free_ship" value="Yes" <? if($free_ship=='Yes'){print("checked");}?>>Yes<br><input type="radio" name="free_ship" value="No" <? if($free_ship=='No'){print("checked");}?>>No<br></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Watts Used</b></span><br>
<input type="text" size="45" name="watts_used" value="<? echo($watts_used);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr><tr>
<td><span class="body_content"><b>Replacement Wattage</b></span><br>
<input type="text" size="45" name="replacement_wattage" value="<? echo($replacement_wattage);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Light Output</b></span><br>
<input type="text" size="45" name="light_output" value="<? echo($light_output);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Color Temp</b></span><br>
<input type="text" size="45" name="color_temp" value="<? echo($color_temp);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Color Rendering</b></span><br>
<input type="text" size="45" name="color_rendering" value="<? echo($color_rendering);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Rated Lifetime</b></span><br>
<input type="text" size="45" name="rated_lifetime" value="<? echo($rated_lifetime);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Minimum Start Temp</b></span><br>
<input type="text" size="45" name="min_start_temp" value="<? echo($min_start_temp);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Electrical Spec</b></span><br>
<input type="text" size="45" name="electrical_spec" value="<? echo($electrical_spec);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Base</b></span><br>
<input type="text" size="45" name="base" value="<? echo($base);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Manuf. Warranty</b></span><br>
<input type="text" size="45" name="manuf_warranty" value="<? echo($manuf_warranty);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Energy Star?</b></span><br>
<select name="energy_star" size="1">
<option value="Yes" <? if($energy_star=='Yes'){print("selected");}?>>Yes
<option value="No" <? if($energy_star=='No'){print("checked");}?>>No
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
$oFCKeditor->Value		= $disclaimer;
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
$oFCKeditor->Value		= $recommended;
$oFCKeditor->Height	= '600' ;
$oFCKeditor->Width	= '520' ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Applications</b><br>
<input type="checkbox" name="table_floor" value="x" <? if($table_floor=='x'){print("checked");}?>>Table Floor<br>
<input type="checkbox" name="pendant" value="x" <? if($pendant=='x'){print("checked");}?>>Pendant<br>
<input type="checkbox" name="ceiling" value="x" <? if($ceiling=='x'){print("checked");}?>>Ceiling<br>
<input type="checkbox" name="ceilingfans" value="x" <? if($ceilingfans=='x'){print("checked");}?>>Ceiling Fans<br>
<input type="checkbox" name="wallsconce" value="x" <? if($wallsconce=='x'){print("checked");}?>>Wall Sconce<br>
<input type="checkbox" name="recessedcans" value="x" <? if($recessedcans=='x'){print("checked");}?>>Recessed Cans<br>
<input type="checkbox" name="tracklighting" value="x" <? if($tracklighting=='x'){print("checked");}?>>Track Lighting<br>
<input type="checkbox" name="outdoorcovering" value="x" <? if($outdoorcovering=='x'){print("checked");}?>>Outdoor Covering<br>
<input type="checkbox" name="outdoorexposed" value="x" <? if($outdoorexposed=='x'){print("checked");}?>>Outdoor Exposed<br>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td><span class="body_content"><b>Replacement Bulb Image?</b><br>
<input type="file" size="45" name="replacement_bulb" value="<? echo($replacement_bulb);?>"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan="2"><input type="submit" value="Edit Product"></td></tr></table>
</form>

<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html><?php ob_end_flush() ?>
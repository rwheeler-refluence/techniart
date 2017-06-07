<? include("database.php"); ?>
<?
$ID=$_GET['ID'];
$cat=$_GET['cat'];
if($ID){
	$act=$_GET['act'];
	if($act=='pub'){
		$sql="update tblProducts set productPub='Yes' where productID='$ID'";
	}else{
		$sql="update tblProducts set productPub='No' where productID='$ID'";
	}
	$result=db_query($sql);
header("location:show_products.php?cat=".$cat."");
}
?>
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
</head>

<BODY>

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main_sub">Products:</span>&nbsp;&nbsp;<span class="title_sub_level2">Show Products</span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<? $cat=$_GET['cat'];?>
<select class="forms" name="theSelect" size=1 onChange="if (this.selectedIndex >0) window.location=this.options[this.selectedIndex].value">
<?
if(!$cat){
	print("<option value=\"\" selected>Choose a Category\n");
}else{
	print("<option value=\"\">Choose a Category\n");
}
#category dropdown
$sql1="select distinct category from tblProducts order by category asc";
$result1=db_query($sql1);
	while($row1 = mysql_fetch_array($result1)){ 
		$category=$row1['category'];
		if($category==$cat){
			print("<option value=\"".$PHP_SELF."?cat=".$category."\" selected>".$category."\n");
		}else{
			print("<option value=\"".$PHP_SELF."?cat=".$category."\">".$category."\n");
		}
	}				
print("</select>\n");
print("<br>\n");

if($cat){
		$sql="select * from tblProducts where category='$cat' order by modelNumber asc";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No entries in database for this category<br>\n");
		}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td width=\"61\">&nbsp;</td>\n");
		print("<td><span class=\"body_content\"><b>Product Name</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Model Number</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>MSRP</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Published?</b></span></td>\n");
		print("<td width=\"125\">&nbsp;</td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
			$productID=$row['productID'];
			$productName=$row['productName'];
			$productPub=$row['productPub'];
			$MSRP=number_format($row['MSRP'],2,".",",");
			$imageLoc=$row['imageLoc'];
			$modelNumber=$row['modelNumber'];
					$loc=$rootDir."pix/products/".$imageLoc;
					if(file_exists($loc)){
					list($width, $height, $type, $attr) = getimagesize($loc);
						if($width>61){
							$newwidth_divisor=61/$width;
							$height=$height*$newwidth_divisor;
							$width=$width*$newwidth_divisor;
						}else{
							$width=$width;
							$height=$height;
						}
					}
		print("<tr bgcolor=\"eaeef4\">\n");
		print("<td><img src=\"../pix/products/".$imageLoc."\" width=\"".$width."\" height=\"".$height."\"></td>");
		print("<td><span class=\"body_content\">".$productName."</span></td>");
		print("<td><span class=\"body_content\">".$modelNumber."</span></td>");
		print("<td><span class=\"body_content\">$".$MSRP."</span></td>");
		print("<td><span class=\"body_content\">".$productPub."<br>");
		if($productPub=='Yes'){
			print("<a class=\"body_content\" href=\"".$_SERVER['PHP_SELF']."?ID=".$productID."&cat=".$cat."&act=depub\">De-Publish?</a>");
		}else{
			print("<a class=\"body_content\" href=\"".$_SERVER['PHP_SELF']."?ID=".$productID."&cat=".$cat."&act=pub\">Publish?</a>");
		}
		print("</span></td>");
		print("<td><img src=\"pix/b_edit.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"edit_product.php?ID=".$productID."&cat=".$cat."\">Edit Product</a><br><img src=\"pix/b_delete.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"#\" ONCLICK=\"javascript:decision('Are you sure you want to delete this entry?', 'del_product.php?ID=".$productID."&cat=".$cat."')\">Delete</a>");
		print("</td>");
		print("</tr>\n");
		}
		print("</table><br>");
}
}
?><br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
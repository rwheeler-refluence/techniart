<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php");?>
<? 
$action=$_POST['action'];
if($action=='update'){
	$proddisctID=$_POST['proddisctID'];
	$itemNo=$_POST['itemNo'];
	$vendorID=$_POST['vendorID'];
	$zip=$_POST['zip'];
	$disct_price=$_POST['disct_price'];

	$sql="update tblProductDiscounts set itemNo='$itemNo',vendorID='$vendorID',disct_price='$disct_price' where proddisctID='$proddisctID'";
	$result=db_query($sql);
	header("location: show_discounts.php");
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
</head>

<BODY>
<?
$ID=$_GET['ID'];
$sql="select * from tblProductDiscounts where proddisctID='$ID'";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$proddisctID=$row['proddisctID'];
	$modelNumber=$row['modelNumber'];
	$itemNo=$row['itemNo'];
	$vendorID=$row['vendorID'];
	$disct_price=number_format($row['disct_price'],2,".",",");
	$zip=$row['zip'];
}?>
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="body_content"><span style="font-size: 14px;"><b>PRODUCT DISCOUNTS | </b></span><span style="color:#a02136; font-size: 18px;"><b>EDIT DISCOUNT</b></span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->



<? if($msg){
	print("<b>".$msg."</b><br><br>\n");
}
?>
<form method="post" action="<? echo($PHP_SELF); ?>" enctype="multipart/form-data">
<input type="hidden" name="action" value="update">
<input type="hidden" name="proddisctID" value="<? echo($proddisctID);?>">
<table border="0" width="400">
<tr>
<td><span class="body_content"><b>Model Number</b></span></td>
<td><span class="body_content"><b>Vendor</b></span></td>
<!--<td><span class="body_content"><b>Zip</b></span></td>-->
<td><span class="body_content"><b>Discount Price</b></td>
</tr>
<tr valign="top">
<td><span class="body_content"><input type="text" name="itemNo" size="12" value="<? echo($itemNo);?>"></span></td>
<td><select name="vendorID" size="1">
<option value="">
<?
$sql="select * from tblVendors where vendorID>'9' order by vendorName asc";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$vendorID1=$row['vendorID'];
	$vendorName=$row['vendorName'];
	print("<option value=\"".$vendorID1."\"");
	if($vendorID1==$vendorID){
		print(" selected");
	}
	print(">".$vendorName."\n");
}
?>
</select></td>
<!--<td><span class="body_content"><input type="text" size="10" name="zip" value="<? echo($zip);?>"></span></td>-->
<td nowrap><span class="body_content">$<input type="text" size="10" name="disct_price" value="<? echo($disct_price);?>"></span></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="Edit Discount"></td></tr></table>
</form>

<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html><?php ob_end_flush() ?>
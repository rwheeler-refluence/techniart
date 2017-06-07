<?php ob_start() ?>
<? include("database.php"); ?>
<? include("secure.php");?>
<? 
$action=$_POST['action'];
if($action=='update'){
	$itemNo=$_POST['itemNo'];
	$vendorID=$_POST['vendorID'];
	$zip=$_POST['zip'];
	$disct_price=$_POST['disct_price'];

	for($i=0;$i<count($itemNo);$i++){
		if(strlen($itemNo[$i])>0){
			$sql="insert into tblProductDiscounts values ('','$itemNo[$i]','$vendorID[$i]','','$disct_price[$i]')";
			$result=db_query($sql);
		}
	}
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

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="body_content"><span style="font-size: 14px;"><b>PRODUCT DISCOUNTS | </b></span><span style="color:#a02136; font-size: 18px;"><b>ADD DISCOUNT</b></span></td>
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
<table border="0" width="400">
<tr>
<td><span class="body_content"><b>Model Number</b></span></td>
<td><span class="body_content"><b>Vendor</b></span></td>
<!--<td><span class="body_content"><b>Zip</b></span></td>-->
<td><span class="body_content"><b>Discount Price</b></td>
</tr><? for($j=0;$j<10;$j++){?>
<tr valign="top">
<td><span class="body_content"><input type="text" name="itemNo[]" size="12"></span></td>
<td><select name="vendorID[]" size="1">
<option value="">
<?
$sql="select * from tblVendors where vendorID>'9' order by vendorName asc";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$vendorID=$row['vendorID'];
	$vendorName=$row['vendorName'];
	print("<option value=\"".$vendorID."\">".$vendorName."\n");
}
?>
</select></td>
<!--<td><span class="body_content"><input type="text" size="10" name="zip[]"></span></td>-->
<td nowrap><span class="body_content">$<input type="text" size="10" name="disct_price[]"></span></td>
</tr>
<?}?>
<tr>
<td colspan="2"><input type="submit" value="Add Discount"></td></tr></table>
</form>

<!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html><?php ob_end_flush() ?>
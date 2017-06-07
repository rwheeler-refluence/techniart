<? include("database.php"); ?>
<? include("secure.php"); ?>
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
<td><span class="title_main_sub">Products:</span>&nbsp;&nbsp;<span class="title_sub_level2">Show Product Discounts</span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<?
		$sql="select tblProductDiscounts.proddisctID,tblProductDiscounts.itemNo,tblProductDiscounts.disct_price,tblProductDiscounts.zip,tblVendors.vendorName,tblProducts.productName from tblProductDiscounts LEFT OUTER JOIN tblProducts on tblProductDiscounts.itemNo=tblProducts.modelNumber LEFT OUTER JOIN tblVendors on tblProductDiscounts.vendorID=tblVendors.vendorID order by tblProductDiscounts.itemNo asc";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No discounts in database<br>\n");
		}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Model Number</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Product Name</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Discount Price</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Vendor</b></span></td>\n");
		#print("<td><span class=\"body_content\"><b>Zip Code</b></span></td>\n");
		print("<td width=\"125\">&nbsp;</td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
			$proddisctID=$row['proddisctID'];
			$modelNumber=$row['modelNumber'];
			$productName=$row['productName'];
			$itemNo=$row['itemNo'];
			$disct_price=number_format($row['disct_price'],2,".",",");
			$zip=$row['zip'];
			$vendorName=$row['vendorName'];
		print("<tr bgcolor=\"eaeef4\">\n");
		print("<td><span class=\"body_content\">".$itemNo."</span></td>");
		print("<td><span class=\"body_content\">".$productName."</span></td>");
		print("<td><span class=\"body_content\">$".$disct_price."</span></td>");
		print("<td><span class=\"body_content\">".$vendorName."</span></td>");
	#	print("<td><span class=\"body_content\">".$zip."</span></td>");
		print("<td><img src=\"pix/b_edit.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"edit_discount.php?ID=".$proddisctID."\">Edit Discount</a><br><img src=\"pix/b_delete.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a class=\"body_content\" href=\"#\" ONCLICK=\"javascript:decision('Are you sure you want to delete this entry?', 'del_discount.php?ID=".$proddisctID."')\">Delete</a>");
		print("</td>");
		print("</tr>\n");
		}
		print("</table><br>");
}
?><br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
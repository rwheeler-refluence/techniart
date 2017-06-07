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
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<BODY>

<!-- ------------------------------begin header------------------------------ -->
<?php include("bluebar.php") ?><center><div class="fbwhitebox"><?php include("header.php") ?>
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left"><span class="section_heading_style1">
<a class="body_content_style1" href="javascript:history.go(-1);">Back</a><br><br>
<?
	$ID=$_GET['ID'];
	$sql="select * from tblOrdersCompleted where completeID='$ID'";
	$result=db_query($sql);
			print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\">");
		while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$otsID=$row['otsID'];
			$stamp=strftime("%D %H:%M:%S",$row['stamp']);
			$ship_first=$row['ship_firstname'];
			$ship_last=$row['ship_lastname'];
			$ship_address=$row['ship_address'];
 			$ship_address2=$row['ship_address2'];
 			$ship_city=$row['ship_city'];		
			$ship_state=$row['ship_state'];
			$ship_zip=$row['ship_zip'];
			$ship_date=$row['ship_date'];
			$tracking=$row['tracking'];
			$status=$row['status'];
			$ship_country=$row['ship_country'];
			$bill_country=$row['bill_country'];	
			$instructions=$row['instructions'];
			$tax=$row['tax'];
			$amount=$row['amount'];
			$email=$row['email'];
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content_style1\"><b>Order Date</b></span></td>\n");
			print("<td><span class=\"body_content_style1\">".$stamp."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content_style1\"><b>Shipping Name</b></span></td>\n");
			print("<td><span class=\"body_content_style1\">".$ship_first." ".$ship_last."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content_style1\"><b>Shipping Address</b></span></td>\n");
			print("<td><span class=\"body_content_style1\">".$ship_address." ".$ship_address2."<br>".$ship_city.",".$ship_state." ".$ship_zip."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content_style1\"><b>Order Received?</b></span></td>\n");
			print("<td><span class=\"body_content_style1\">".$status."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content_style1\"><b>Tracking Number</b></span></td>\n");
			print("<td><span class=\"body_content_style1\">".$tracking."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content_style1\"><b>Order Contents</b></span></td>\n");
			print("<td><span class=\"body_content_style1\">");
			$sql2="select * from tblotsdetail where otsID='$otsID'";
			$result2=db_query($sql2);
			$count2=mysql_num_rows($result2);
			if($count2){
				$ia=2;
				while($row2=mysql_fetch_array($result2)){
					$otsdetailID=$row2['otsdetailID'];
					$qty=$row2['qty'];
					$price=$row2['price'];
					$case_quantity=$row2['case_quantity'];
					$productDesc=$row2['productDesc'];
					$productDesc=str_replace("™", "&trade;",$productDesc);
					$sizeDesc=$row2['sizeName'];
					$sizesku=$row2['sizesku'];
					$tot=$price*$qty;
					$sumtot+=$tot;
					$prod_tot=$case_quantity*$qty;
					$extra=$row2['extra'];
					$extra_amt=$row2['extra_amt'];
					$received=$row2['received'];
					$notes=$row2['notes'];
					$productID=$row2['productID'];
						$spl=explode("<br>",$productDesc);
						print("<b>Item:</b> ");
						for($s=0;$s<count($spl);$s++){
							print("".$spl[$s]."<br>");
						}
						#print(""Size: ".$sizeDesc."\n";
						print("<b>Case Qty:</b> ".$qty."<br>");
					    print("<b>Products per case:</b> ".$case_quantity."<br>");
					    print("<b>Total Products:</b> ".$prod_tot."<br>");
					    print("<b>Received?</b> ".$received."&nbsp;<input class=\"btn2\" value=\"YES\" type=\"button\" onclick='location.href=\"rec_item.php?oID=".$otsdetailID."&ID=".$completeID."\"'><br>");
						print("<b>Notes:</b> ".$notes." <input class=\"forms10\" value=\"".$notes."\" type=\"text\"><br>");
						print("------------------------------------------------------------------------------<br>\n");
				}

			}
			print("</span></td>\n");
			print("</tr>\n");


			
			$text1="";
		}
		print("</table>\n");
	
?>
</td>
<td></td>
</tr></table>
</td>
</tr></table>

</body>
</html>
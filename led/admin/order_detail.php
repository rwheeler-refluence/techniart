<? include("database.php"); ?>
<? include("secure.php"); ?>
<? include("../../oldsites/j/4/stuff.php");?>
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
<td><span class="title_main_sub">Order Detail:</span>&nbsp;&nbsp;</td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<a class="body_content" href="javascript:history.go(-1);"><< Back</a><br><br>
<?
$page=$_GET['page'];
$limitvalue=200;
if(!$page || $page==1){
	$limit=0;
}else{
	$limit=($page-1)*$limitvalue;
}
	print("<br>");
	$ID=$_GET['ID'];
	$sql="select otsID, stamp, ship_firstname, AES_DECRYPT(ship_lastname, '$key') as ship_lastname, AES_DECRYPT(ship_address, '$key') as ship_address, AES_DECRYPT(ship_address2, '$key') as ship_address2, AES_DECRYPT(ship_city, '$key') as ship_city, ship_state, ship_zip, instructions, bill_firstname, AES_DECRYPT(bill_lastname, '$key') as bill_lastname, AES_DECRYPT(bill_address, '$key') as bill_address, AES_DECRYPT(bill_address2, '$key') as bill_address2, AES_DECRYPT(bill_city, '$key') as bill_city, bill_state, bill_zip, AES_DECRYPT(email, '$key') as email, tax, amount from tblOrdersCompleted where completeID='$ID'";
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if(!$count){
		print("No orders in the database<br /><br />\n");
	}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\">");
		while($row=mysql_fetch_array($result)){
			$completeID=$row['completeID'];
			$otsID=$row['otsID'];
			$bill_firstname=$row['bill_firstname'];
			$bill_lastname=$row['bill_lastname'];
			$bill_address=$row['bill_address'];
			$bill_address2=$row['bill_address2'];
			$bill_city=$row['bill_city'];
			$bill_state=$row['bill_state'];
			$bill_zip=$row['bill_zip'];
			$email=$row['email'];
			$ship_firstname=$row['ship_firstname'];
			$ship_lastname=$row['ship_lastname'];
			$ship_address=$row['ship_address'];
			$ship_address2=$row['ship_address2'];
			$ship_city=$row['ship_city'];
			$ship_state=$row['ship_state'];
			$ship_zip=$row['ship_zip'];
			$comments=$row['instructions'];
			$tax=$row['tax'];
			$amount=$row['amount'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Name</b></span></td>\n");
			print("<td><span class=\"body_content\">".$bill_firstname." ".$bill_lastname."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Date</b></span></td>\n");
			print("<td><span class=\"body_content\">".$timestamp."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Total</b></span></td>\n");
			print("<td><span class=\"body_content\">$".$amount."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Tax</b></span></td>\n");
			print("<td><span class=\"body_content\">$".$tax."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Billing Address</b></span></td>\n");
			print("<td><span class=\"body_content\">".$bill_firstname." ".$bill_lastname."<br>".$bill_address." ".$bill_address2."<br>".$bill_city.",".$bill_state." ".$bill_zip."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Shipping Address</b></span></td>\n");
			print("<td><span class=\"body_content\">".$ship_firstname." ".$ship_lastname."<br>".$ship_address." ".$ship_address2."<br>".$ship_city.",".$ship_state." ".$ship_zip."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Email</b></span></td>\n");
			print("<td><span class=\"body_content\">".$email."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Comments</b></span></td>\n");
			print("<td><span class=\"body_content\">".$comments."</span></td>\n");
			print("</tr>\n");
			print("<tr valign=\"top\">");
			print("<td bgcolor=\"#eaeef4\"><span class=\"body_content\"><b>Order Contents</b></span></td>\n");
			print("<td><span class=\"body_content\">");
			$sql2="select * from tblotsdetail where otsID='$otsID'";
			$result2=db_query($sql2);
			$count2=mysql_num_rows($result2);
			if($count2){
				$ia=2;
				while($row2=mysql_fetch_array($result2)){
					$otsdetailID=$row2['otsdetailID'];
					$qty=$row2['qty'];
					$price=$row2['price'];
					$productDesc=$row2['productDesc'];
					$productDesc=str_replace("�", "&trade;",$productDesc);
					$sizeDesc=$row2['sizeName'];
					$sizesku=$row2['sizesku'];
					$tot=$price*$qty;
					$sumtot+=$tot;
					$extra=$row2['extra'];
					$extra_amt=$row2['extra_amt'];
					$productID=$row2['productID'];
						$spl=explode("<br>",$productDesc);
						print("Item: ");
						for($s=0;$s<count($spl);$s++){
							print("".$spl[$s]."<br>");
						}
						#print(""Size: ".$sizeDesc."\n";
						print("Qty: ".$qty."<br>");
					    print("Price: $".$price."<br>");
						print("------------------------------------------------------------------------------<br>\n");
				}
			print("Subtotal of Items: $".$sumtot."");
			}
			print("</span></td>\n");
			print("</tr>\n");

			
			$text1="";
		}
		print("</table>\n");
	}
?>
<span class="body_content">
<?for($i=1;$i<=$numpages;$i++){?>
<a class="body_content" href="show_daily.php?page=<? echo($i);?>">Page <? echo($i);?></a>
<? if($i==1 || $i<$numpages){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?}?>
<?}?>
</span>
<br><!-- END insert WYSIWYG or all other forms, etc. here -->
<? include("zip.php"); ?>
<? include("body_bot.php"); ?>

</body>
</html>
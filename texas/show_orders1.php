<? include("database.php"); ?>
<? include("secure.php"); ?>
<? $db=$_GET['db'];
$table='tblOrdersCompleted_'. $db;
$name=$_GET['name'];
$rep=$_GET['rep'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>TechniArt -- <? echo $name?> Orders</title>

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
<? #echo($table);?>
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main_sub"><? echo($rep);?> <? echo($name);?> Orders:</span>&nbsp;&nbsp;</td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<?
$page=$_GET['page'];
$limitvalue=200;
if(!$page || $page==1){
	$limit=0;
}else{
	$limit=($page-1)*$limitvalue;
}
	print("<br>");
	$sql="select * from $table where type='$rep' order by completeID desc";
   # print("".$sql."");
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	
	if(!$count){
		print("No orders in the database<br /><br />\n");
	}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Order #</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Name</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Date</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Total</b></span></td>\n");
	#	print("<td>&nbsp;</td>\n");
		print("<td>&nbsp;</td>\n");
		print("<td><span class=\"body_content\"><b>TCC or TNC</b></span></td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
$completeID=$row['completeID'];
$coupon=$row['coupon'];
$otsID=$row['otsID'];
$bill_firstname=$row['bill_firstname'];
$bill_firstname=$row['bill_firstname'];
$bill_lastname=$row['bill_lastname'];
$ship_firstname=$row['ship_firstname'];
$ship_lastname=$row['ship_lastname'];
$ship_zip=$row['ship_zip'];
$amount=$row['amount'];

			$timestamp=strftime("%a %D %r",$row['stamp']);

	

			print("<tr valign=\"top\" bgcolor=\"#FFFFFF\">\n");
			print("<td><span class=\"body_content\">".$completeID."</span></td>\n");
if(!$bill_firstname){
			print("<td><span class=\"body_content\">".$ship_firstname." ".$ship_lastname."</span></td>\n");
			}else{
			print("<td><span class=\"body_content\">".$bill_firstname." ".$bill_lastname."</span></td>\n");}
			print("<td><span class=\"body_content\">".$timestamp."</span></td>\n");
			print("<td><span class=\"body_content\">$".$amount."</span></td>\n");
#			print("<td><span class=\"body_content\">");
#			$sqlnotify="select * from tblNotify where orderID='$completeID'";
#			$resultnotify=db_query($sqlnotify);
#			while($rownotify=mysql_fetch_array($resultnotify)){
#				$stamp=strftime("%D",$rownotify['stamp']);
#				$notifyID=$rownotify['notifyID'];
#				print("You emailed this customer on ".$stamp." (<a class=\"body_content\" href=\"email.php?ID=".$notifyID."\" target=\"_new\">Read Email</a>)<br>");
#			}
#			print("<a class=\"body_content\" href=\"email_order.php?ID=".$completeID."\" target=\"_new\">Email Customer Shipping Notification</a>");
#			print("</td>\n");
			print("<td><a class=\"body_content\" href=\"order_detail1.php?ID=".$completeID."&db=".$db."\">DETAILS</span></td>\n");
				$sqls="select region from tblTerritory where zip='$ship_zip'";
	#print("".$sqls."<br>");
	$results=db_query($sqls);
	while($row=mysql_fetch_assoc($results)){
	$region=$row['region'];}
			print("<td><a class=\"body_content\" href=\"print_order.php?ID=".$completeID."&db=".$db."&rep=".$rep."\" target=\"_blank\">Print Order</span></td>\n");
            #print("<td><span class=\"body_content\">".$participant."</span></td>\n");
			print("</tr>\n");
			$text1="";
		}
		print("</table>\n");
	}
?>
<? include("body_bot.php"); ?>

</body>
</html>
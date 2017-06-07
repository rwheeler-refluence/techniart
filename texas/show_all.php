<? include("database.php"); ?>
<? include("secure.php"); ?>
<? $db=$_GET['db'];
$table='tblOrdersCompleted_aep,tblOrdersCompleted_ambit,tblOrdersCompleted_beyond,tblOrdersCompleted_bounce,tblOrdersCompleted_breeze,tblOrdersCompleted_brililant,tblOrdersCompleted_centerpoint,tblOrdersCompleted_ces,tblOrdersCompleted_champion,tblOrdersCompleted_cpl,tblOrdersCompleted_directenergy,tblOrdersCompleted_entrust,tblOrdersCompleted_fcp,tblOrdersCompleted_frontier,tblOrdersCompleted_infinite,tblOrdersCompleted_justenergy,tblOrdersCompleted_reliant,tblOrdersCompleted_spark,tblOrdersCompleted_startex,tblOrdersCompleted_taraenergy,tblOrdersCompleted_trieagle,tblOrdersCompleted_tnmp,tblOrdersCompleted_veteran,tblOrdersCompleted_wtu';
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
	#$sql="select * from tblOrdersCompleted_aep, tblOrdersCompleted_ambit, tblOrdersCompleted_beyond, tblOrdersCompleted_bounce, tblOrdersCompleted_breeze, tblOrdersCompleted_brilliant, tblOrdersCompleted_centerpoint, tblOrdersCompleted_ces, tblOrdersCompleted_champion, tblOrdersCompleted_cpl, tblOrdersCompleted_directenergy, tblOrdersCompleted_entrust, tblOrdersCompleted_fcp, tblOrdersCompleted_frontier, tblOrdersCompleted_infinite, tblOrdersCompleted_justenergy, tblOrdersCompleted_reliant, tblOrdersCompleted_spark, tblOrdersCompleted_startex, tblOrdersCompleted_taraenergy, tblOrdersCompleted_trieagle, tblOrdersCompleted_tnmp, tblOrdersCompleted_veteran, tblOrdersCompleted_wtu where type='$rep' group by type order by completeID desc";
   $sql="select * from tblOrdersCompleted_aep where type='$rep' UNION ALL select * from tblOrdersCompleted_ambit where type='$rep' UNION ALL select * from tblOrdersCompleted_beyond where type='$rep' UNION ALL select * from tblOrdersCompleted_bounce where type='$rep' UNION ALL select * from tblOrdersCompleted_breeze where type='$rep' UNION ALL select * from tblOrdersCompleted_brilliant where type='$rep' UNION ALL select * from tblOrdersCompleted_centerpoint where type='$rep' UNION ALL select * from tblOrdersCompleted_ces where type='$rep' UNION ALL select * from tblOrdersCompleted_champion where type='$rep' UNION ALL select * from tblOrdersCompleted_cpl where type='$rep' UNION ALL select * from tblOrdersCompleted_directenergy where type='$rep' UNION ALL select * from tblOrdersCompleted_entrust where type='$rep' UNION ALL select * from tblOrdersCompleted_fcp where type='$rep' UNION ALL select * from tblOrdersCompleted_frontier where type='$rep' UNION ALL select * from tblOrdersCompleted_infinite where type='$rep' UNION ALL select * from tblOrdersCompleted_justenergy where type='$rep' UNION ALL select * from tblOrdersCompleted_reliant where type='$rep' UNION ALL select * from tblOrdersCompleted_spark where type='$rep' UNION ALL select * from tblOrdersCompleted_startex where type='$rep' UNION ALL select * from tblOrdersCompleted_taraenergy where type='$rep' UNION ALL select * from tblOrdersCompleted_tnmp where type='$rep' UNION ALL select * from tblOrdersCompleted_trieagle where type='$rep' UNION ALL select * from tblOrdersCompleted_veteran where type='$rep' UNION ALL select * from tblOrdersCompleted_wtu where type='$rep' order by stamp desc";
   #echo $sql;
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
		#print("<td><span class=\"body_content\"><b>Participant</b></span></td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
$completeID=$row['completeID'];
$coupon=$row['coupon'];
$otsID=$row['otsID'];
$bill_firstname=$row['bill_firstname'];
$bill_firstname=$row['bill_firstname'];
$bill_lastname=$row['bill_lastname'];
$bill_address=$row['bill_address'];
$bill_address2=$row['bill_address2'];
$bill_city=$row['bill_city'];
$bill_state=$row['bill_state'];
$bill_zip=$row['bill_zip'];
$ship_firstname=$row['ship_firstname'];
$ship_lastname=$row['ship_lastname'];
$ship_address1=$row['ship_address1'];
$ship_address2=$row['ship_address2'];
$ship_city=$row['ship_city'];
$ship_state=$row['ship_state'];
$ship_zip=$row['ship_zip'];
$bill_county=$row['county'];
$ship_county=$row['ship_county'];
$amount=$row['amount'];
$email=$row['email'];
$phone=$row['phone'];
$status=$row['status'];
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
			print("<td><a class=\"body_content\" href=\"order_detail.php?ID=".$completeID."&db=".$status."\">DETAILS</span></td>\n");
            print("<td><a class=\"body_content\" href=\"print_order.php?ID=".$completeID."&db=".$status."&rep=".$rep."\" target=\"_blank\">Print Order</span></td>\n");
			print("</tr>\n");
			$text1="";
		}
		print("</table>\n");
	}
?>
<? include("body_bot.php"); ?>

</body>
</html>
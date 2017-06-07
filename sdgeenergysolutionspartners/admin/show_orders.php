<? include("database.php"); ?>
<? include("secure.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>TechniArt -- SDGE Retail Therm Kit</title>

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
<td><span class="title_main_sub">SDGE Retail Therm Kit:</span>&nbsp;&nbsp;</td>
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
$sql="select * from tblOrdersCompleted order by completeID desc";
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if(!$count){
		print("No orders in the database<br /><br />\n");
	}else{
		print("<table width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Order #</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Name</b></span></td>\n");
		print("<td><span class=\"body_content\"><b>Date</b></span></td>\n");
		#print("<td><span class=\"body_content\"><b>Total</b></span></td>\n");
	#	print("<td>&nbsp;</td>\n");
		#print("<td>&nbsp;</td>\n");
		print("<td>&nbsp;</td>\n");
		print("</tr>\n");
		while($row=mysql_fetch_array($result)){
			$ship_fname=$row['ship_fname'];
$ship_lname=$row['ship_lname'];
$ship_streetnum=$row['ship_streetnum'];
$ship_unit1=$row['ship_unit1'];
$ship_route=$row['ship_route'];
$ship_city=$row['ship_city'];
$ship_state=$row['ship_state'];
$ship_zip=$row['ship_zip'];
$ship_zip4=$row['ship_zip4'];
$email=$row['email'];
$fname=$row['fname'];
$lname=$row['lname'];
$streetnum=$row['streetnum'];
$route=$row['route'];
$unit1=$row['unit1'];
$city=$row['city'];
$state=$row['state'];
$zip=$row['zip'];
$zip4=$row['zip4'];
$pledge=$row['pledge'];
$opt=$row['opt'];
$company=("SDG&E Retail Kit");
$completeID=$row['completeID'];
$instr=$row['instr'];
			$timestamp=strftime("%D %H:%M:%S",$row['stamp']);

			print("<tr valign=\"top\" bgcolor=\"#FFFFFF\">\n");
			print("<td><span class=\"body_content\">".$completeID."</span></td>\n");
			print("<td><span class=\"body_content\">".$fname." ".$lname."</span></td>\n");
			print("<td><span class=\"body_content\">".$timestamp."</span></td>\n");
#			print("<td><span class=\"body_content\">$".$orderAmount."</span></td>\n");
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
			print("<td><a class=\"body_content\" href=\"order_detail.php?ID=".$completeID."\">DETAILS</span></td>\n");
           # print("<td><a class=\"body_content\" href=\"order_email.php?ID=".$completeID."\" target=\"_blank\">REGENERATE ORDER EMAIL</span></td>\n");
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

<? include("body_bot.php"); ?>

</body>
</html>
<? include("database.php"); ?>
<?
session_start();
?>
<html>
<head>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>
<body>
<div style="padding:25px;">
<span class="body_content_style1">
<?php
if(!$_POST){
	$weight=$_GET['weight']+1;
?>
<form method="post" action="<?php echo($_SERVER['PHP_SELF']);?>">
<input type="hidden" name="weight" value="<?php echo($weight);?>">
<strong>Is this package being shipped to a business address or a residential address?</strong><br />
<input type="radio" name="res" value="0">Commercial Address<br />
<input type="radio" name="res" value="1" checked>Residential Address<br />
<br />
<strong>Zip Code:</strong><br />
<input type="text" size="10" name="zip" value="<?php echo($_SESSION['zip']);?>">
<br /><br />
<input type="submit" value="Submit">
</form>
<?php
}else{
	if($_POST['action']=='choose'){
		$chosen=explode("^",$_POST['chosen']);
		$_SESSION['ship_carrier']=$chosen[0];
		$_SESSION['ship_desc']=$chosen[1];
		$_SESSION['ship_amt']=$chosen[2];
		$_SESSION['ship_code']=$chosen[3];
		$_SESSION['res']=$_POST['res'];
		$_SESSION['zip']=$_POST['zip'];
		print("<hr>");
		print_r($_POST);
		print("<hr>");
?>
<script language="javascript">
opener.location.href='cart.php';
this.window.close();
</script>
<?php
	}

	$weight=$_POST['weight'];
	if($_POST['zip']){
		$zip=$_POST['zip'];
	}else{
		$zip=$_SESSION['zip'];
	}
	$_SESSION['weight']=$weight;
	require 'combined/autoload.php'; // This autoloads RocketShipIt classes
	print("<h1>Shipping Options</h1>");
	print("<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">");
	print("<input type=\"hidden\" name=\"action\" value=\"choose\">");
	print("<input type=\"hidden\" name=\"res\" value=\"".$_POST['res']."\">");
	print("<input type=\"hidden\" name=\"zip\" value=\"".$_POST['zip']."\">");
	print("<table cellpadding=0 cellspacing=1 bgcolor=#e6e6e6>");
	print("<tr bgcolor=#ffffff>");
	print("<td>&nbsp;</td>");
	print("<td style=\"padding:3px;\"><span class=\"body_content_style1\"><strong>Carrier</strong></span></td>");
	print("<td style=\"padding:3px;\"><span class=\"body_content_style1\"><strong>Service Description</strong></span></td>");
	print("<td style=\"padding:3px;\"><span class=\"body_content_style1\"><strong>Rate</strong></span></td>");
	#print("<td style=\"padding:3px;\"><span class=\"body_content_style1\"><strong>Service Code</strong></span></td>");
	print("</tr>");
	$rate1 = new \RocketShipIt\Rate('USPS');
	$rate1->setParameter('toCode',$zip);
	$rate1->setParameter('weight',$weight);
	$response1 = $rate1->getSimpleRates();
	foreach($response1 as $key=>$val){
		if($val[service_code]=='1' || $val[service_code]=='4'){
			print("<tr bgcolor=#ffffff>");
			print("<td style=\"padding:3px;\"><input type=\"radio\" name=\"chosen\" value=\"USPS^$val[desc]^$val[rate]^$val[service_code]\"></td>");
			print("<td style=\"padding:3px;\"><span class=\"body_content_style1\">U.S. Postal Service</span></td>");
			print("<td style=\"padding:3px;\"><span class=\"body_content_style1\">$val[desc]</span></td>");
			print("<td style=\"padding:3px;\"><span class=\"body_content_style1\">$$val[rate]</span></td>");
		#	print("<td style=\"padding:3px;\"><span class=\"body_content_style1\">$val[service_code]</span></td>");
			print("</tr>");
		}
	}

	$rate = new \RocketShipIt\Rate('UPS');

	$rate->setParameter('toCode',$zip);
	$rate->setParameter('weight',$weight);
	$rate->setParameter('residentialAddressIndicator',$res);

	$response = $rate->getSimpleRates();
	foreach($response as $key=>$val){
		if($val[service_code]=='03'){
			print("<tr bgcolor=#ffffff>");
			print("<td style=\"padding:3px;\"><input type=\"radio\" name=\"chosen\" value=\"UPS^$val[desc]^$val[rate]^$val[service_code]\"></td>");
			print("<td style=\"padding:3px;\"><span class=\"body_content_style1\">UPS</span></td>");
			print("<td style=\"padding:3px;\"><span class=\"body_content_style1\">$val[desc]</span></td>");
			print("<td style=\"padding:3px;\"><span class=\"body_content_style1\">$$val[rate]</span></td>");
		#	print("<td style=\"padding:3px;\"><span class=\"body_content_style1\">$val[service_code]</span></td>");
			print("</tr>");
		}
	}
	print("</table>");
	print("<br />");
	print("<input type=\"submit\" value=\"Choose and return to cart\"></form>");
}
?>
</span>
</div>
</body>
</html>
<? include("database.php"); ?>

<html>
<head>
<title>TechniArt - Credit Card Declined</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<style type="text/css">
<!--
.style2 {	color: #06303C;
	font-size: 14px;
}
.style3 {	color: #06303C;
	font-size: 12px;
}
-->
</style>
</head>
<BODY>

<? include_once('phpauthnet_aim.php'); ?>
<img src="back-top.jpg" width="760" height="15"><br>
<table width="760" border="0" class="bkg_body-main">
  <tr>
    <td width="66">&nbsp;</td>
    <td width="616"><div align="left">Sorry, your credit card was declined for the following reason: <br> <?php echo $authnet_results['x_response_reason_text']; ?><br>
      
    If you have any questions in regards to being declined, please send an email to <a href="mailto:customerservice@techniart.com">customerservice@techniart.com</a>. </div></td>
    <td width="64">&nbsp;</td>
  </tr>
</table>
<img src="back-bottom.jpg" width="760" height="15">
</body>
</html>


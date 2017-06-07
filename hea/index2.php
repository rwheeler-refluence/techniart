<? include("database.php"); ?>
<? $page=("facebook.php");?>
<? $page1=("sorry.php");?>
<html>
<head>
<title>TechniArt - Facebook Shopping Cart</title>
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
<?php include_once("analyticstracking.php") ?>
<table width="760" border="0" background="back-top.jpg">
  <tr>
    <td height="50"></td>
  </tr>
</table>
<table width="760" border="0" class="bkg_body-main">
  <tr>
    <td valign="top">
       <table width="638" border="0" align="center">
        <tr>
          <td height="51" colspan="5"><div align="center">Special pricing for Mass Save customers only.<br>
Please enter your zip code to confirm your eligibilty.<br>
          </div></td>
        </tr>
        <tr valign="middle">
          <td width="18"></td>
          <td width="171" class="product_title_sm" align="right">Zip Code:</td>
          <td width="112" valign="middle" align="center"><br>

<form method="post" action="changezip.php">
<input type="hidden" name="redir" value="<? echo($page);?>">
<input type="hidden" name="redir1" value="<? echo($page1);?>">              
<input type="text" size="8" name="zipcode" class="forms2"></td>
<td width="260">
    <input name="submit" type="image" onClick="this.form.submit();" value="Submit" src="pix/submit.jpg" alt="Submit" align="left" border="0"></form></td>
<td width="55">&nbsp;</td>
        </tr>
</table>      
<br></td>
  </tr>
</table>
<table width="760" height="25" alight="left" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td background="back-bottom.jpg">&nbsp;</td>
  </tr>
</table>
<br>
<?php include_once("footer.php") ?>
</body>
</html>


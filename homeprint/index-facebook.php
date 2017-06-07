<? include("database.php"); ?>
<? $page=("facebook.php");?>
<? $page1=("sorry.php");?>
<html>
<head>
<title>TechniArt - Facebook Shopping Cart</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #f7f7f7;
}
-->
</style></head>
<BODY><div class="blueBar" height:"50px">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="ffffff" align="center"><div class="fbwhitebox">
<?php include_once("analyticstracking.php") ?>

<table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="34">&nbsp;</td>
    <td width="816"><?php include("header.php") ?>
<table width="760" border="0" class="bkg_body-main">
  <tr>
    <td valign="top">
       <table width="638" border="0" align="center">
        <tr>
          <td height="51" colspan="5"><div align="center">Special pricing for Mass Save customers only.<br>
Please enter your zip code to confirm your eligibilty.<br>
          </div></td>
        </tr>
        <tr>
          <td width="18"></td>
          <td width="171" class="product_title_sm" align="right">Zip Code:</td>
          <td width="112" valign="middle" align="center">

<form method="post" action="changezip-facebook.php">
<input type="hidden" name="redir" value="<? echo($page);?>">
<input type="hidden" name="redir1" value="<? echo($page1);?>">              
<input type="text" size="8" name="zipcode" class="forms2"></td>
<td width="260">
    <input name="submit" type="button" onClick="this.form.submit();" value="Click to Qualify" align="left" border="0"></form></td>
<td width="55">&nbsp;</td>
        </tr>
</table>      
<br></td>
  </tr>
</table>
<table background="back-bottom.jpg" width="760" height="15"border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>
  </tr>
</table>
<?php include_once("footer.php") ?>
  
</table>
</body>
</html>


<? include("database.php"); ?>
<? $page=("facebook-ri.php");?>
<? $page1=("sorry.php");?>
<html>
<head>
<title>TechniArt - Enter Your Zip Code to Qualify</title>
<link rel="icon" 
      type="image/png" 
      href="icon.png">
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #F0F0F0;
}
-->
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/shadowbox.css">
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
<script language="Javascript">
 <!--
 alert ("This promotion is ONLY for National Grid customers who are residents of Rhode Island!")
 //-->
 </script>

</head>
<BODY><?php include("bluebar.php") ?><br><table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="fbwhitebox">
<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?><center>
<table width="760" border="0" class="bkg_body-main" align="center">
  <tr>
    <td valign="top">
       <table width="638" border="0" align="center">
        <tr>
          <td height="51" colspan="5"><div align="center" class="footer_content_style1"><a class="body_content_style1" rel="shadowbox;width=450;height=300" href="http://www.youtube.com/embed/p-T8VJiPAWQ">Click here to learn about ShowerStart&#8482; technology </a></div><br /><div align="center"><span class="section_heading_style1">Special pricing for National Grid (Rhode Island) customers only.<br>
Please enter your zip code to confirm your eligibilty.</span><br>
          </div></td>
        </tr>
        <tr>
          <td width="18"></td>
          <td width="171" class="product_title_sm" align="right">Zip Code:</td>
          <td width="112" valign="middle" align="center">

<form method="post" action="changezip.php">
<input type="hidden" name="redir" value="<? echo($page);?>">
<input type="hidden" name="redir1" value="<? echo($page1);?>">              
<input type="text" size="8" name="zipcode" class="forms2"></td>
<td width="260">
    <input name="submit" type="image" onClick="this.form.submit();" value="Submit" src="pix/submit.jpg" alt="Submit" align="left" border="0"></form></td>
<td width="55"></td>
        </tr>
</table>      
<br></td>
  </tr>
</table></center>
<table background="back-bottom.jpg" width="760" height="15"border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td></td>
  </tr>
</table>
<?php include_once("footer.php") ?></div></td>
  </tr>
</table>
</body>
</html>


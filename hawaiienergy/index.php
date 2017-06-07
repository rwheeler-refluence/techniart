<? include("database.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html><head>
<title>TechniArt - Hawaii Energy Online Store</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>

<BODY>
<?php include_once("analyticstracking.php") ?>

<!-- ------------------------------begin header------------------------------ -->

<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<center><div class="rcorners4">      <form method="post" action="changezip1.php">
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td></td>
<td width="906"><img src="landing.jpg"></td>
<td></td>
</tr></table>
<div class="">
<table width="906" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr valign="top">
      <td></td>
      <td width="904">
      <table width="850" border="0" align="center">
        <tr><br>
          
          <td width="32" height="51" rowspan="2" valign="top"></td>
          <td width="401" align="center" valign="top"><span class="product_price">Enter your ZIP code to confirm your eligibility.</span><br><br></td>
        </tr>
        <tr>
          <td height="25" colspan="6" align="left" valign="top"><span class="product_price"></span>
            <table width="27%" border="0" align="center">
              <tbody>
                <tr>
                  <td><input required type="text" size="5" maxlength="5" name="zipcode" class="forms9" placeholder="ZIP Code">
                    <input required type="submit" value="Submit" class="btn">
                    <br>
                    <span class="product_price">(5 digit ZIP only)</span></td>
                </tr>
              </tbody>
          </table>
            <br></td>
          </tr>
      </table></td>
    <td></td></tr>
  </table>
<img src="footer-logo.jpg"/><!-- ------------------------------end body------------------------------ -->
</div></div><br>

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</body>
</html>

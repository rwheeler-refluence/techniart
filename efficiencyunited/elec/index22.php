<? include("database.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Marketing The Future</title>

<meta name="robots" content="index,follow" />
<meta name="author" content="TechniArt" />
<meta name="publisher" content="techniart.com" />
<meta name="copyright" content="Copyright 2008 TechniArt. All Rights Reserved" />
<meta http-equiv="content-language" content="EN" />
<meta name="content-language" content="EN" />
<meta name="rating" content="All" />
<meta name="audience" content="General" />
<meta name="distribution" content="Global" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Only Champion Energy Services residential customers are eligible for this program! Please enter your qualified zip code on this page to view the discounted prices.')
        </SCRIPT>
</head>

<BODY>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header-entry.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div align="left" class="cp_title" id="title_spacer"></div></td>
</tr></table>
<table width="906" border="0" class="bkg_body-main" align="center">
<tr>
    <td valign="top">
  <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="866" border="0" align="center">
        <tr><br>
          <td height="51" colspan="6"><div align="center"><span class="product_price"><br>Special pricing for Green Mountain Energy customers in the CenterPoint Energy Houston Electric service area only.<br><br>Please enter your zip code to confirm your eligibility.<br></span><br>
          </div></td>
        </tr>
        <tr>
          
          <td width="356" class="product_price" align="right">Zip Code:</td>
          <td width="111" align="center">
          <form method="post" action="changezip1.php">
            <input type="hidden" name="redir" value="<? echo($page);?>">
            <input type="hidden" name="redir1" value="<? echo($page1);?>">
            <input type="text" size="8" name="zipcode" class="forms2">
                      <td width="69" align="left"><input type="button" onClick="this.form.submit();" value="Submit" alt="Submit" align="left" border="0">
          </form>
          </td>
                      <td width="312" align="left">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4" align="right" class="product_price"><br><br><br><br><br></td>
        </tr>
        </table></td>
    </tr>
  </table></tr></table>
  

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


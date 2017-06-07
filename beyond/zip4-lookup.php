<? include("database.php");?>
<? $page=$_GET['redir'];?>
<html>
<head>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>
<body>
<span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Look-up your 4-digit Zip extension </span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style2"><i>Search for special rebates &amp; pricing</i></span><br><br>
<table width="245" border="1">
  <tr>
    <td width="65">Address</td>
    <td width="233"><input type="text" size="30" name="Address2" class="forms1"></td>
  </tr>
  <tr>
    <td>City</td>
    <td><input type="text" size="25" maxlength="40" name="City" value="" class="forms3" /></td>
  </tr>
  <tr>
    <td>State</td>
    <td><select name="State" class="forms2">
      <option></option>
      <option value="AK">AK</option>
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit" onClick="this.form.submit();"></form>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>http://production.shippingapis.com/ShippingAPITest.dll</p>
<p>https://secure.shippingapis.com/ShippingAPITest.dll.</p>
</html>
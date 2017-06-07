<? include("database.php");?>
<? $page=("facebook.php");?>
<? $page1=("sorry.php");?>
<html>
<head>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #EFF8FD;
}
.style2 {
	color: #06303C;
	font-size: 14px;
}
.style3 {
	color: #06303C;
	font-size: 12px;
}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style></head>
<body>
<br>
<table width="425" border="0">
  <tr>
    <td width="419" height="39"><div align="center"><span class="style2">Special pricing for Mass Save customers only.<br>
    Please enter your zip code to confirm your eligibilty.</span></div></td>
  </tr>
  <tr>
    <td height="80"><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr valign="top"><form method="post" action="changezip1.php">
          <input type="hidden" name="redir" value="<? echo($page);?>">
          <input type="hidden" name="redir1" value="<? echo($page1);?>">
            <td nowrap>&nbsp;&nbsp;&nbsp;<span class="style3">&nbsp;&nbsp;Zip Code</span>&nbsp;&nbsp;</td>
          <td><form><input type="text" size="20" name="zipcode" class="forms1"></td>
            <td><input type="image" src="pix/submit.jpg" name="submit" alt="Submit" border="0" value="Submit" onClick="this.form.submit();">
          </form>
          </td>
        </tr>
      </table>    </td>
  </tr>
</table>
</body>
</html>
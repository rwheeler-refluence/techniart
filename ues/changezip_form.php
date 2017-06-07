<? include("database.php");?>
<? $page=$_GET['redir'];?>
<html>
<head>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>
<body>
<span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Special pricing based on location</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style2"><i>Search for special rebates &amp; pricing</i></span><br><br>

<table width="331" border="0" cellspacing="0" cellpadding="0"><tr valign="top"><form method="post" action="changezip1.php"><input type="hidden" name="redir" value="<? echo($page);?>">
<td width="110" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style3">Zip Code</span>&nbsp;&nbsp;</td>
<td width="160"><form><input type="text" size="30" name="zipcode" class="forms1"></td>
<td width="61"><input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit" onClick="this.form.submit();"></form></td>
</tr><tr valign="top">
<td colspan="3" style="padding-left:30px;"><span class="body_content_style1"><i>Please enter your 5 digit zip code.</span></td>
</tr></table>

</body>
</html>
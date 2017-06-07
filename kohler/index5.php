<? include("database.php"); ?>
<? $page=("approved.php");?>
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
	background-color: #CCCCCC;
}
-->
</style>
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
<script>
  $(function() {
    $( "#dialog" ).dialog({
      modal: false,
	  width: 500,
      });
  });
  </script>

</head>
<BODY>
<div id="dialog">
<span class="section_heading_style1"><img src="pix/g_arrow.gif" alt="" width="28" height="22" border="0">Special pricing based on location</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style2"><i>Search for special rebates &amp; pricing</i></span><br><br>
<table width="331" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<form method="post" action="changezip.php">
<input type="hidden" name="redir" value="<? echo($page);?>"><td width="110" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="section_heading_style3">Zip Code</span>&nbsp;&nbsp;</td>
<td width="160"><form><input type="text" size="30" name="zipcode" class="forms1"></td>
<td width="61"><input type="image" src="pix/submit.png" name="submit" alt="Submit" border="0" value="Submit" onClick="this.form.submit();"></td>
</tr><tr valign="top"></form>

</tr></table>
</div>
</body>
</html>


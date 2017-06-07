<? include("database.php"); ?>
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/shadowbox.css">
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
<script language="Javascript">
 <!--
 alert ("This promotion is ONLY for Puget Sound Energy residential customers! You will be asked for your ZIP code as well as what type of PSE account you have.")
 //-->
 </script>
 <script language="javascript" type="text/javascript">
	<!--
		function fVerifyResForm() {
			var oForm = document.form1;	
			var errFlag = 0;
			var errStr = "Oops, looks like you missed a required field.\n\n";

			if (oForm.account[0].checked || oForm.account[1].checked || oForm.account[2].checked) {
			}else{
				errFlag = 1;
				errStr = errStr + "Please select your PSE account type.\n";
			}
 			if (oForm.zipcode.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your PSE ZIP code.\n";
			}
			
			if (errFlag == 0) {
				return true;
				oForm.submit();
			} else {
				alert(errStr);
				return false;
			}
		}
		//-->
	</script>
    <SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = 'index-test.php';
}
// --->
</SCRIPT>
</head>
<BODY><?php include("bluebar.php") ?><?php include("analyticstracking.php") ?><br><table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div class="fbwhitebox">
<?php include("header.php") ?><center>
<table background="back-top.jpg" width="760" height="15"border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td></td>
  </tr>
</table>
<table width="760" border="0" class="bkg_body-main" align="center">
  <tr>
    <td colspan="5" valign="top">
       <table width="638" border="0" align="center">
        <tr>
          <td height="51" colspan="5"><div align="center"><span class="section_heading_style1">Special pricing for Puget Sound Energy residential customers only.<br>
Please check your PSE account status and enter your zip code to confirm your eligibilty.</span><br>
          </div></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="3" align="center" class="product_title_sm">PSE Account Type:<form name="form1" id="form1" method="post" onSubmit="return fVerifyResForm();" action="changezip2.php">
            <label><input name="account" type="radio" id="account" value="1">
            Electric            &nbsp;&nbsp;
            <input name="account" type="radio" id="account" value="3">
            Gas&nbsp;&nbsp;
            <input name="account" type="radio" id="account" value="2"></label>
            Electric &amp; Gas&nbsp;&nbsp;&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td width="18"></td>
          <td width="171" class="product_title_sm" align="right">Zip Code:</td>
          <td width="112" valign="middle" align="center">
<input type="text" size="8" name="zipcode" class="forms2"></td>
<td width="260">
    <input type="submit" value="Click Here to Qualify"></form></td>
<td width="55"></td>
        </tr>
</table></td>
  </tr>
  <tr>
    <td width="220" valign="top">&nbsp;</td>
    <td width="112" align="center" valign="top"><a class="body_content_style1" rel="shadowbox;width=420;height=315" href="https://www.youtube.com/embed/tiarMemvVB8"><img src="icon-installation.jpg" width="86" height="95"></td>
    <td width="61" valign="top">&nbsp;</td>
    <td width="120" align="center" valign="top"><a class="body_content_style1" rel="shadowbox;width=420;height=315" href="https://www.youtube.com/embed/8_8CLxCanJ4"><img src="icon-operation.jpg" width="86" height="95"></td>
    <td width="225" valign="top">&nbsp;</td>
  </tr>
</table>
  </center>
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


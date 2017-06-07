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
<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Only Efficiency United residential customers are eligible for this program! Please enter your qualified zip code on this page to view the discounted prices.')
        </SCRIPT>
        
 <script language="javascript" type="text/javascript">
 var downloadLink = document.getElementById('button');
addListener(downloadLink, 'click', function() {
  ga('send', 'event', 'button', 'click', 'nav-buttons');
});


/**
 * Utility to wrap the different behaviors between W3C-compliant browsers
 * and IE when adding event handlers.
 *
 * @param {Object} element Object on which to attach the event listener.
 * @param {string} type A string representing the event type to listen for
 *     (e.g. load, click, etc.).
 * @param {function()} callback The function that receives the notification.
 */
function addListener(element, type, callback) {
 if (element.addEventListener) element.addEventListener(type, callback);
 else if (element.attachEvent) element.attachEvent('on' + type, callback);
}</script>
 <script language="javascript" type="text/javascript">
	<!--
		function fVerifyResForm() {
			var oForm = document.form1;	
			var errFlag = 0;
			var errStr = "Oops, looks like you missed a required field.\n\n";

			if (oForm.account.value== '') {
				errFlag = 1;
				errStr = errStr + "Please select your utility company.\n";
			}
 			if (oForm.zipcode.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your ZIP code.\n";
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
if(confirm(message)) location.href = 'index.php';
}
// --->
</SCRIPT>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>

<BODY>
<?php include("analyticstracking.php") ?>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header-entry.php"); ?>
<!-- ------------------------------end header------------------------------ -->
<table width="906" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="EU-landing.jpg" width="906" height="260"></td>
  </tr>
</table>
<table width="906" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr><td height="51" colspan="6"><div align="center"><br><span class="landing_berry"><strong>Please select your utility company and enter your zip code to confirm your eligibility.</strong></span><span class="product_price"><br>
        </span><br>
		<?
$msg=$_GET['msg'];
if($msg=='notqualified'){
	print("<h3>The utility company/zip code combination you entered does not match. Please try again.</h3>\n");
}
?><br>
          </div></td>
        </tr>
        <tr valign="middle">
          
          <td width="155" align="right" class="product_price">&nbsp;</td>
          <td width="296" align="center">
<form name="form1" id="form1" method="post" action="changezip1.php" onSubmit="return fVerifyResForm();">
<span class="product_price"><span class="landing_berry"><strong>Utility:</strong></span></span>
<select name="utility" required class="forms5">
<option value=""></option>
<option value="1">Alpena Power Company</option>
<option value="2">Baraga Electric Company</option>
<option value="3">Crystal Falls E.D.</option>
<option value="5">Dowagiac D.P.S.</option>
<option value="6">Gladstone L.U.</option>
<option value="7">Harbor Springs E.D.D.</option>
<option value="8">Hillsdale P.Pl.</option>
<option value="9">L'Anse Electric Utility</option>
<option value="10">Negaunee E.D.</option>
<option value="11">Norway L.D.</option>
<option value="13">Upper Peninsula Power</option>
<option value="14">Wisconsin Electric</option>
<option value="15">Wisconsin Public Service</option>
<option value="16">Xcel Energy</option>
</select></td><td width="197" align="center">
<span class="product_price"><span class="landing_berry"><strong>Zip Code:</strong></span></span>
<input required type="text" size="10" maxlength="10" name="zipcode" value="" class="forms2" /><td width="83" align="left"><input type="submit" value="Submit" class="btn"></form>
          </td>
                      <td width="175" align="left"></td>
        </tr>
        <tr valign="middle">
          <td height="44" align="right" class="product_price"></td>
          <td colspan="3" align="center"><br><span class="landing_berry"><strong>Special pricing for Efficiency UNITED customers only.</strong></span><br><br>	<?
$msg=$_GET['msg'];
if($msg=='notqualified'){
	print("<span class=\"body_content_style1\">If you have any questions regarding your eligibility, please send an email to: customerservice@techniart.com.<br>The email should contain your name and your residential address. We will manually confirm your eligibility 
status with your utility company.<br></span><br>\n");
}
?></td>
          <td align="left"></td>
        </tr>
        <tr valign="middle">
          <td height="27" colspan="5" align="right" class="product_price">&nbsp;</td>
        </tr>
        <tr valign="middle">
          <td height="15" colspan="5" align="right" class="product_price">&nbsp;</td>
        </tr>
      </table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</body>
</html>

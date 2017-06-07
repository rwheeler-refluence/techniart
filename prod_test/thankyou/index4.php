<html>
<head>
<meta name="viewport" content="user-scalable = yes">
<link rel="icon" 
      type="image/png" 
      href="icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #F0F0F0;
}
-->
</style></head>
<title>TechniArt - THANK YOU</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=406049489530757&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<body>
  <script src="js/jquery.min.js"></script>
 <script>
$(function() {  
      $( "#share" ).click(function() {
      
 FB.ui({
 method: 'feed',
 name: 'Mass Savers Savings Pack',
 redirect_uri: 'http://www.techniart.com/masssave/thankyou/closewindow.php',
 link: 'https://www.facebook.com/MassSavers/app_589918307757042',
 picture: 'https://www.techniart.com/111x74_fb_oct_tab.jpg',
 caption: '',
 description: 'I just purchased a Mass Save Savings Pack! Click to purchase!  https://www.facebook.com/MassSavers/app_589918307757042'
}, function(response){});
 on.click(window.close())      });

});
    </script></div>


<?php include("bluebar.php") ?>
<center><div align="center" class="fbwhitebox"><table width="760" height="421" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="NP_I0021_JAN_THANKYOUPAGE_15.jpg" width="906" height="418" usemap="#Map" border="0">
      <map name="Map">
        <area id="share" shape="rect" coords="491,153,601,187" href="">
      </map></td>
  </tr>
</table>
<img src="back-top.jpg" width="906" height="15"><br>
<table width="906" height="143" border="0" background="back-main.jpg" class="bkg_body-main">
  <tr>
    <td height="50" valign="middle"><div align="center"><span class="footer_content_style1">Your order has been successfully processed. You will receive an email receipt from TechniArt and from our  
      payment gateway, Bluepay, confirming your order.</span><span class="body_content_style1"><br />
      </span></div></td>
    </tr>
  <tr>
    <td height="33" valign="middle"><div align="center"><span class="footer_content_style1">Please do not click the back button as you may mistakenly place a duplicate order.</span><br>
    </div></td>
    </tr>
  <tr>
    <td height="52" valign="middle"><div align="center">
      <form name="facebook" method="post" action="https://www.facebook.com">
        <a href="https://www.facebook.com/MassSavers">Back to Facebook</a> 
        </form>
      
    </div></td>
    </tr>
</table>
<table width="906" height="15"border="0" align="center" cellpadding="0" cellspacing="0" background="back-bottom.jpg">
  <tr>
    <td></td>
  </tr>
</table>
<br>  
<?php include_once("footer.php") ?></div></center></body>

</map>
</body>

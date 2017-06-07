<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #F0F0F0;
}
-->
</style></head>
<title>TechniArt - MassSavers Facebook Fan Bundle - THANK YOU</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<body>

<?php include("bluebar.php") ?><br>
<div id="fb-root"><div id="fb-root"></div><script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '406049489530757',
          status     : true,
          xfbml      : true
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>



  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
$(function() {  
      $( "#share" ).click(function() {
      
          FB.ui(
            {
              method: 'feed',
              name: 'Mass Savers Choice Bundle',
              link: 'https://www.facebook.com/MassSavers/app_589918307757042',
              picture: 'http://www.techniart.com/share1.jpg',
              caption: '',
              description: 'I just purchased a Mass Savers Choice Bundle! Click to purchase 2 LED bulbs and 4 CFL bulbs for only $10! That’s a savings of $44!'
            },
            function(response) {
              if (response && response.post_id) {
                alert('Post was published.');
              } else {
                alert('Post was not published.');
              }
            }
          );

      });

});
    </script>

<center><div align="center" class="fbwhitebox"><table width="760" height="421" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="760x421_jan_thankyou.jpg" width="760" height="421" border="0" usemap="#Map" /></td>
  </tr>
</table>
<img src="back-top.jpg" width="760" height="15"><br>
<table width="760" height="96" border="0" background="back-main.jpg" class="bkg_body-main">
  <tr>
    <td width="66" height="92">&nbsp;</td>
    <td width="616"><div align="left"><span class="body_content_style1"><br />
Your order has been successfully processed. You will receive an email receipt from TechniArt and from our<br> 
payment gateway, Bluepay, confirming your order.<br />
      </span></div>
    </td>
    <td width="64">&nbsp;</td>
  </tr>
</table>
</td>
</tr></table></td>
</tr></table>
<table width="760" height="15"border="0" align="center" cellpadding="0" cellspacing="0" background="back-bottom.jpg">
  <tr>
    <td></td>
  </tr>
</table>
  <?php include_once("footer.php") ?>
</div></center>
<map name="map" id="map">
<area id="share" shape="rect" coords="21,264,135,290" href="javascript:fbShare('https://www.facebook.com/MassSavers/app_589918307757042', 'Mass Savers Power Savings Pack', 'I just purchased a Mass Save Power Savings Pack! Click to purchase three LED bulbs and one advanced power strip for only $10! That is a savings of $80!', 'http://goo.gl/dS52U', 520, 350)">
</map>
</body>

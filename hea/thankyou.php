<html>
<head>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '{techniartfb}',
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
      $( "#target" ).click(function() {
      
          FB.ui(
            {
              method: 'feed',
              name: 'Facebook Dialogs',
              link: 'https://developers.facebook.com/docs/dialogs/',
              picture: 'http://fbrell.com/f8.jpg',
              caption: 'Reference Documentation',
              description: 'Dialogs provide a simple, consistent interface for applications to interface with users.'
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
    </script></head>
<title>TechniArt - MassSavers Facebook Fan Bundle - THANK YOU</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<body>
<div id="fb-root"><table width="760" height="421" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="760x421_jan_thankyou.jpg" width="760" height="421" border="0" usemap="#Map" /></td>
  </tr>
</table>
<img src="back-top.jpg" width="760" height="15"><br>
<table width="760" height="96" border="0" class="bkg_body-main">
  <tr>
    <td width="66" height="92">&nbsp;</td>
    <td width="616"><div align="left"><br>
      <span class="body_content_style1">Thank You !<br />
      <br />
Your order has been successfully processed. You will receive an email receipt from TechniArt and from our e-commerce gateway, Bluepay, confirming your order.<br />
      </span></div>
      </td>
    <td width="64">&nbsp;</td>
  </tr>
</table>
<img src="back-bottom.jpg" width="760" height="15">

<map name="Map" id="Map">
<area shape="rect" coords="21,264,135,290" href="#" />
</map></div>
<?php include_once("footer.php") ?>
</body>

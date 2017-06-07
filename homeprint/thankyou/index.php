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
<body>
<div id="fb-root"><div id="fb-root"></div><script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '522266667871332',
          status     : false,
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
              name: 'Bathroom Savings Kit',
              link: 'https://www.facebook.com/NationalGridRI/app_1482070402013376',
              picture: 'http://www.techniart.com/share.jpg',
              caption: '',
              description: 'I just purchased National Grid’s Bathroom Savings Kit, 6 Maxlite CFLs and 1 Evolve hot water saving showerhead for only $15! Check out this great deal here: https://www.facebook.com/NationalGridRI/app_1482070402013376'
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
    </script></div>


<?php include("bluebar.php") ?><br>


<center><div align="center" class="fbwhitebox"><table width="760" height="421" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="NGRID_RI Deal-ThankYou.jpg" border="0" usemap="#Map"></td>
  </tr>
</table>
<img src="back-top.jpg" width="760" height="15"><br>
<table width="760" height="243" border="0" background="back-main.jpg" class="bkg_body-main">
  <tr>
    <td width="59" height="92">&nbsp;</td>
    <td colspan="2" valign="middle"><div align="center"><span class="footer_content_style1"><br />
      Your order has been successfully processed. You will receive an email receipt from TechniArt and from our  
      payment gateway, Bluepay, confirming your order.</span><span class="body_content_style1"><br />
      </span></div></td>
    <td width="57">&nbsp;</td>
  </tr>
  <tr>
    <td height="51">&nbsp;</td>
    <td colspan="2" valign="middle"><div align="center"><span class="footer_content_style1">Please do not click the back button as you may mistakenly place a duplicate order.</span><br>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="92">&nbsp;</td>
   <td valign="middle"><div align="center">
      <form name="facebook" method="post" action="https://www.facebook.com">
        <a href="https://www.facebook.com/NationalGridRI">Back to Facebook</a> 
        </form>
      
    </div></td>
    <td>&nbsp;</td>
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

<map name="Map"><area id="share" shape="rect" coords="35,208,134,235" href=""></map></body>

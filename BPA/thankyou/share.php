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
<title>TechniArt - Share with your friends</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1681081712215370',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<body><? include('analyticstracking1.php');?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
$(function() {  
      $( "#share" ).click(function() {
      
          FB.ui(
            {
              method: 'feed',
              name: 'Special Offer – Bathroom Kit Sale',
			  redirect_uri: 'http://www.techniart.us/masssave/thankyou/closewindow.php',
			  link: 'http://bit.ly/2j0txYU',
              picture: 'https://www.techniart.us/facebook-share.jpg',
			  caption: ' TechniArt.us/MassSave ',
              description: 'Update your bathroom with this new kit from Mass Save – 6 globe LEDs and 1 energy-saving showerhead adapter, available at 85% off retail value! Offer available through 3/5/2017 or while supplies last.'
            },
            function(response) {
    if (response && !response.error_code) {
      alert('Posting completed.');
    } else {
      alert('Error while posting.');
    }
  }
);

      });

});
    </script>
    <table width="412" border="0">
      <tr>
        <td height="44" colspan="2" align="center">Share with your friends on Twitter or Facebook</td>
      </tr>
      <tr>
        <td width="200" align="center"><a href="https://twitter.com/share" class="twitter-share-button" data-text="Spruce up your bathroom with globe LEDs & an energy-saving showerhead adapter–now 85% off! pic.twitter.com/dBTwLkf1HM" data-url="http://bit.ly/2jQyseS">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></td>
        <td width="202" align="center"><img src="fb-share.jpg" width="59" height="25" usemap="#Map" border="0"></div></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
    </table>

    


<map name="Map">
  <area id="share" shape="rect" coords="1,0,58,23" href="#" alt="Facebook Share">
</map>
</body>
</html>
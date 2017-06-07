<!doctype html>
<? $util=$_GET['util'];?>
<? if($util=="CLC"){$message="<a href=\"http://www.capelightcompact.org/energy-efficiency/residential/\">Learn about additional home energy efficiency programs at capelightcompact.org</a>";};?>
<? if($util=="NSTAR"){$message="<a href=\"http://www.masssave.com/ residential/home-energy-assessments/about-home-energy-assessments/online-home-energy-assessment/?campaign_code=LPpromotion\">Find additional savings opportunities, take Mass Save’s no cost online home energy assessment</a>";};?>
<? if($util=="WMECO"){$message="<a href=\"http://www.masssave.com/ residential/home-energy-assessments/about-home-energy-assessments/online-home-energy-assessment/?campaign_code=LPpromotion\">Find additional savings opportunities, take Mass Save’s no cost online home energy assessment</a>";};?>
<? if($util=="NGRID"){$message="<a href=\"http://www.masssave.com/ residential/home-energy-assessments/about-home-energy-assessments/online-home-energy-assessment/?campaign_code=LPpromotion\">Find additional savings opportunities, take Mass Save’s no cost online home energy assessment</a>";};?>
<? if($util=="UNITIL"){$message="<a href=\"http://www.masssave.com/?utm_source=www.techniart.com&utm_medium=ThankYouPage&utm_campaign=lighting+products\">Discover more ways to save, visit MassSave.com</a>";};?>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<title>THANK YOU</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<div id="fb-root"></div>
</head>

<BODY>

    <center><div class="gridContainer clearfix">
  <br>
  <div id="LayoutDiv1">
<?php include_once("analyticstracking.php") ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="ty.jpg" usemap="#Map" border="0">

      <map name="Map">
        <area id="share2" shape="rect" coords="201,216,356,260" href="#" onClick="javscript:window.open('share.php','popup2a','scrollbars=no, resizeable=no,width=450,height=100,screenY=450,top=40, left=420');" alt="Facebook Share">
      </map></td></tr>
</table>
<table width="85%" border="0">
  <tr>
    <td width="100%" height="50" valign="middle"><div align="center"><span class="cart"> <strong>Your order has been successfully processed. <br>
<br>
You will receive an email receipt from TechniArt and from our payment gateway, Bluepay, confirming your order.</strong></span><br />
</div></td>
    </tr>
  <tr>
    <td height="54" valign="middle"><div align="center"><span class="cart"><strong>Please do not click the back button as you may mistakenly place a duplicate order.</strong></span><br>
    </div></td>
    </tr>
    <tr>
    <td height="35" valign="middle"><div align="center">
      <span class="cart"><? print $message;?></span><br>
    </div></td>
    </tr>
  </table>

<map name="Map">
  <area id="share" shape="rect" coords="0,1,57,24" href="share.php" alt="Facebook Share"></map>
<?php include_once("footer.php") ?></div>
</div>

</body>
</html>
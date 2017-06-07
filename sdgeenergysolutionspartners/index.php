<? $source=$_GET['utm_source'];?>
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<title>Get Your No-Cost Energy &amp; Water Savings Kit</title>

<meta property="og:site_name" content="SDG&amp;E Energy & Water Savings Kit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="mobile.css"/>
                <link rel="stylesheet" type="text/css" href="boilerplate.css"/>
    <!--[if lt IE 9]>
    <script src="/static/bootstrap/3.3.0/js/html5shiv.js"></script>
    <script src="/static/bootstrap/3.3.0/js/respond.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/ie8.css">

<![endif]-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
<style>
body { background: #0878b5;}
</style>
</head>
<body><?php include("analyticstracking.php") ?><form method="post" action="orderform.php">
<? include("header.php");?>
<!-- Begin content -->
<br>
<br>
<br>
<br>
<br>


<div class="main" ><br>
<br>
<br>
<br><div align="center"> <a href="WEK-specs.pdf" target="_blank"><img src="landing-graphic.jpg"></a></div>


<div class="row">
	   <table align="center"><tr><td><br><br><input type="hidden" name="source" value="<? echo($source);?>"><input name="Order Your Energy & Water Savings Kit!" class="btn1" value="Order Your Water and Energy Savings Kit!" type="submit"><br><br></td></tr></table>
  </div></form>
</div>
</div>
<!-- End content -->
<? print $source?>
<? include("footer.php");?>

<map name="Map">
  <area shape="poly" coords="15,360,36,211,84,153,81,111,68,96,85,85,119,102,153,119,225,28,250,10,288,34,302,78,279,108,197,102,150,170,87,274,88,366,45,366" href="#">
  <area shape="rect" coords="160,163,235,326" href="#">
<area shape="rect" coords="254,160,351,228" href="#">
  <area shape="rect" coords="270,243,351,335" href="#">
</map>
</body>
</html>

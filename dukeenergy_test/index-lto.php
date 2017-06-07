<!doctype html>
<? 
$source=$_GET['utm_source'];
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<title>Duke Energy Savings Packs</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

</head><form method="post" action="changezip.php"><input type="hidden" name="source" value="<? echo("$source");?>">
<BODY><?php include_once("analyticstracking1.php") ?><? include("nav-entry.php")?>
<div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header-lto1.php")?></div>


    <table width="100%" border="0">
		<tr bgcolor="f2f4f4"><td height="5px"><a href="http://www.duke-energy.com/bulbsonline"><img src="expired.jpg" alt=""/></a></td></tr>
        
           

            

<? include("footer.php");?>
</body>
</html>

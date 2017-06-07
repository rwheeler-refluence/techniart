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
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
<link rel="stylesheet" type="text/css" href="./js/shadowbox.css">
<script type="text/javascript" src="./js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
</head><form method="post" action="changezip.php"><input type="hidden" name="source" value="<? echo("$source");?>">
<BODY><?php include_once("analyticstracking1.php") ?><? include("nav-entry.php")?>
<div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header-lto.php")?></div>


    <table width="100%" border="0">
		<tr bgcolor="f2f4f4"><td height="5px"></td></tr>
           

            

<? include("footer-lto.php");?>
</body>
</html>

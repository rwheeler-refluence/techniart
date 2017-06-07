<!doctype html>
<? session_start();
echo "hi";
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "|".$session_id."|</br>";
echo "|".$_SESSSION."|</br>";
var_dump($_SESSION)."</br>";
foreach ($_SESSION as $key=>$val)
    echo $key." |*| ".$val."<br/>";
    echo $sess."<br/>";
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<title>Choose Your Room Air Cleaner</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<?php include_once("pixel.php") ?>

</head>
<BODY>
<?php include_once("analyticstracking.php") ?>
<center><div class="gridContainer clearfix">
<div id="LayoutDiv1"><? include("header.php")?></div>
    <div id="LayoutDiv1"><? include("header1.php")?></div>
<table width="100%" border="0">

<? include("footer.php");?>

</body>
</html>

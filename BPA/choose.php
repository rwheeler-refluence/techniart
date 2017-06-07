<!doctype html>
<? session_start()?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://www.techniart.us/masssave/boilerplate.css" rel="stylesheet" type="text/css">
<link href="https://www.techniart.us/masssave/mobile.css" rel="stylesheet" type="text/css">
<title>Choose Your Massive Savings Kit</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

</head>
<BODY>
<?php include_once("analyticstracking.php") ?>
<center><div class="gridContainer clearfix">
<div id="LayoutDiv1"><? include("header.php")?></div>
    <div id="LayoutDiv1"><? include("header1.php")?></div>
<? print($_SESSION['source']); ?> 
<? include("footer.php");?>
</div>
</body>
</html>

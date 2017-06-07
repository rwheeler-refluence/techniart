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
<title>Duke Energy Progress Store</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

</head><form method="post" action="changezip1.php"><input type="hidden" name="source" value="<? echo("$source");?>">
<BODY><?php include_once("analyticstracking.php") ?><? include("nav-entry.php")?>
<div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>


    <table width="100%" border="0">
		<tr bgcolor="f2f4f4"><td height="50px"></td></tr>
        <tr bgcolor="f2f4f4">
          <td colspan="2" align="center"><br>
			  <span class="cart-huge">Welcome to the Duke Energy Progress Online Lighting Store.</span><br>
<br>
<span class="cart-header">Please enter your ZIP code to confirm your eligibility.</span></td>
        </tr>
        <tr bgcolor="f2f4f4">
          <td height="59" colspan="2" align="center" valign="middle"><br><br><div style="display: inline"><span class="cart"><strong>ZIP CODE:</strong>&nbsp;</span></div><div style="display: inline">
<input required type="text" name="zipcode" size="7" class="forms9"></div><div style="display: inline">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="fakebutton" name="submit" value="SUBMIT" /><br>
<br>
<tr bgcolor="f2f4f4" valign="middle">
          <td colspan="2" align="center"><br>
<a href="https://portal.efficiency.ecova.com/locator_preprod/progress/Default.aspx?true" class="cart-header"><img src="back.png"/> <span class="cart">Click here to go back</a><br>
<br>
<br>
<img src="bulbs.jpg" alt=""/> </span></td>
        </tr><br>
<br>
<br>
</div></td>
           </tr>
           
            

<? include("footer.php");?>
</body>
</html>

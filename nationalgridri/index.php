<!doctype html>
<? 
$source=$_GET['utm_source'];
?>
<html>
<head>
<meta property="og:title" content="Limited-Time Room Air Cleaner Sale" /> 
<meta property="og:description" content="Choose from two Honeywell Room Air Cleaners, up to 54% off retail value! Offer available through 4/9/2017 or while supplies last." /> 

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<title>Special Offer – Room Air Purifier</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>


</head><form method="post" action="changezip.php"><input type="hidden" name="source" value="<? echo("$source");?>">
<BODY><?php include_once("analyticstracking.php") ?>
<div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>


    <table width="100%" border="0">
        <tr>
          <td colspan="2"></td>
      </tr>
        <tr>
          <td colspan="2" align="center"><br>
<span class="cart-header">Special pricing for National Grid Rhode Island residential electric customers</span></td>
        </tr>
        <tr>
          <td height="59" colspan="2" align="center" valign="middle"><div style="display: inline"><span class="cart"><strong>Zip Code:</strong></span></div><div style="display: inline">
<input required type="text" name="zipcode" size="5" class="forms9"></div><div style="display: inline">&nbsp;<input type="submit" class="btn1" name="submit" value="Check ZIP Code" /></div></td>
           </tr>
    </table>
    </form>
            
<? include("footer.php");?>
</div>
</body>
</html>

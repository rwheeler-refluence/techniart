<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
</head>
<BODY><?php include_once("analyticstracking.php") ?>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?>
  <div id="LayoutDiv1"><br>
<div class="indent">
<table style="display: inline-block;" align="left">
  <tr>
    <td></td>
    <td align="center"><form method="post" action="cart.php">
     <span class="cart-header">LED A19 8-Pack</span><br>
        <br>
        <span class="cart">$10.00</span>
      <br>
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="productID" value="242">
        <input type="hidden" name="qty" value="1">
        <input type="hidden" name="price" value="10">
        <input type="hidden" name="productName" value="LED A19 8-Pack">
        <input type="submit" class="btn1" name="Add to Cart" value="Add to Cart" onClick="this.form.submit();">
     
    </form></td></tr></table></div>
<div class="indent1">
<table style="display: inline-block;">
	<tr>
    <td align="center"><form method="post" action="cart.php">
      <span class="cart-header">LED BR30 3-pack</span><br>
        <br>
        <span class="cart">$10.00</span>
      <br>
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="productID" value="243">
        <input type="hidden" name="qty" value="1">
        <input type="hidden" name="price" value="10">
        <input type="hidden" name="productName" value="LED BR30 3-pack">
        <input type="submit" class="btn1" name="Add to Cart" value="Add to Cart" onClick="this.form.submit();">
    
    </form></td>
      </tr>
  </table></div>

<? include("footer.php");?>
</div></div></div>
</body>
</html>

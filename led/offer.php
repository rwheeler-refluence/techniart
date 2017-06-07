<? $otsID=$_GET['otsID'];?>
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
  <div id="LayoutDiv1"><? include("header1.php")?></div>

<table align="center">
  <tr>
    <td width="280" align="center"><form method="post" action="https://www.techniart.com/padres/cart.php">
    <input hidden name="otsID" value="<? echo($otsID);?>">
     <span class="cart-header">LED A19 5-Pack</span><br>
        <br>
        <span class="cart">$10.00</span>
      <br>
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="productID" value="243">
        <input type="hidden" name="qty" value="1">
        <input type="hidden" name="price" value="10">
        <input type="hidden" name="productName" value="LED A19 5-Pack">
        <input type="submit" class="btn1" name="Add to Cart" value="Add to Cart" onClick="this.form.submit();">
     
    </form></td>
    <td width="31" align="center">&nbsp;</td>
    <td width="275" align="center"><form method="post" action="https://www.techniart.com/padres/cart.php">
      <span class="cart-header">Water & Energy Savings Kit</span><br>
        <br>
        <span class="cart">FREE</span>
      <br>
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="productID" value="244">
        <input type="hidden" name="qty" value="1">
        <input type="hidden" name="price" value="0">
        <input type="hidden" name="productName" value="Water & Energy Savings Kit">
        <input type="submit" class="btn1" name="Add to Cart" value="Add to Cart" onClick="this.form.submit();">
    
    </form></td></tr>
  <tr>
    <td height="50" colspan="3" align="center"><form method="post" action="https://www.techniart.com/padres/cart.php"><input type="submit" class="btn1" name="No Thanks" value="No Thanks" onClick="this.form.submit();"></td>
    </tr>
</table>
<br>
<br>

<? include("footer.php");?></div></div></div>

</body>
</html>

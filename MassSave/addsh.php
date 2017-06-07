<? $ID=242;?>
<? $show=$_GET['show'];?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
function load()
{
document.frm1.submit()
}
</script>
<script>
fbq('track', 'AddToCart', );
</script>
</head>
<body onLoad="load()">
<div class="indent">
<table style="display: inline-block;" align="left">
  <tr>
    <td></td>
    <td align="center"><form method="post" name="frm1" id="frm1" action="cart.php">
     <input type="hidden" name="source" value"<? echo $source;?>">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="productID" value="242">
        <input type="hidden" name="qty" value="1">
        <input type="hidden" name="price" value="10">
        <input type="hidden" name="productName" value="Pack 2: Six (6) EarthTronics BR30 LEDs (LBR3827D)">
       
     
    </form></td></tr></table></div>



</div>
</body>
</html>

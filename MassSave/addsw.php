<? $ID=245;?>
<? $show=$_GET['show'];?>
<? $qty=$_POST['qty'];?>
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
</head>
<body onLoad="load()">
<div class="indent">
<table style="display: inline-block;" align="left">
  <tr>
    <td></td>
    <td align="center"><form method="post" name="frm1" id="frm1" action="cart2.php">
		<input type="hidden" name="source" value"<? echo $source;?>">     
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="productID" value="245">
        <input type="hidden" name="qty" value="<? echo $qty;?>">
        <input type="hidden" name="price" value="5.00">
        <input type="hidden" name="productName" value="TrickleStar Tier 1 APS">
       
     
    </form></td></tr></table></div>



</div>
</body>
</html>

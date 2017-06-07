<? include("database.php");?>
<html>
<head>
<script>
function load()
{
document.frm1.submit()
}
</script>
</head>
<body onLoad="load()">
<form method="post" name="frm1" id="frm1" action="cart.php">
<input type="hidden" name="action" value="add">
<input type="hidden" name="productID" value="19">
<input type="hidden" name="modelNumber" value="LED10A19DOD27K-6">
<input type="hidden" name="qty" value="1">
<input type="hidden" name="price" value="8">
<input type="hidden" name="productName" value="60w Dimmable LED A19 6-pack">
</form>
      
</body>
</html>


<? include("database.php"); ?>
<? $key='2037290784';?>

<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<title>Mass Save Embertec Promo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://www.techniart.com/masssave/boilerplate.css" rel="stylesheet" type="text/css">
<link href="https://www.techniart.com/masssave/mobile.css" rel="stylesheet" type="text/css">
</head>
<BODY>
<?

	$bill_city=("TEST");
	$sql="insert into tblOrdersCompleted ship_city=AES_ENCRYPT('$bill_city', '$key') where completeID='3'";
	$result=db_query($sql);
?>

<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


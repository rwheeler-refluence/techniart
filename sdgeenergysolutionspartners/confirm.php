<? include("database.php"); ?>
<?
$ship_fname=$_POST['ship_fname'];
$ship_lname=$_POST['ship_lname'];
$ship_streetnum=$_POST['ship_streetnum'];
$ship_unit1=$_POST['ship_unit1'];
$ship_route=$_POST['ship_route'];
$ship_city=$_POST['ship_city'];
$ship_state=$_POST['ship_state'];
$ship_zip=$_POST['ship_zip'];
$ship_zip4=$_POST['ship_zip4'];
$email=$_POST['email'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$streetnum=$_POST['streetnum'];
$route=$_POST['route'];
$unit1=$_POST['unit1'];
$city=$_POST['city'];
$state=$_POST['state'];
$source=$_POST['source'];
$zip=$_POST['zip'];
$zip4=$_POST['zip4'];
$code=$_POST['code'];
$pledge=$_POST['pledge'];
$customer=$_POST['customer'];
$swear=$_POST['swear'];
$company=("SDG&E Partners Kit");
$instr=$_POST['instr'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Get Your No-Cost Energy & Water Savings Kit</title>

<meta property="og:site_name" content="SDG&amp;E Energy & Water Savings Kit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="mobile.css"/>
                <link rel="stylesheet" type="text/css" href="boilerplate.css"/>
    <!--[if lt IE 9]>
    <script src="/static/bootstrap/3.3.0/js/html5shiv.js"></script>
    <script src="/static/bootstrap/3.3.0/js/respond.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/ie8.css">

<![endif]-->
<style>
body { background: #0878b5;}
</style>
</head>
<body><form method="post" action="process.php"><?php include("analyticstracking.php") ?>
<? include("header.php");?>
<!-- Begin content -->
<br>
<br>
<br>
<br>
<br><form action="process.php" method="POST" >
<input type=hidden name=paymentType value="Sale" />
<input type=hidden name="otsID" value="<? echo($otsID); ?>" />
<input type=hidden name="fname" value="<? echo($fname); ?>" />
<input type=hidden name="lname" value="<? echo($lname); ?>" />
<input type=hidden name="streetnum" value="<? echo($streetnum); ?>" />
<input type=hidden name="route" value="<? echo($route); ?>" />
<input type=hidden name="unit1" value="<? echo($unit1); ?>" />
<input type=hidden name="city" value="<? echo($city); ?>" />
<input type=hidden name="state" value="<? echo($state); ?>" />
<input type=hidden name="zip" value="<? echo($zip); ?>" />
<input type=hidden name="code" value="<? echo($code); ?>" />
<input type=hidden name="zip4" value="<? echo($zip4); ?>" />
<input type=hidden name="pledge" value="<? echo($pledge); ?>" />
<input type=hidden name="opt" value="<? echo($opt); ?>" />
<input type=hidden name="ship_fname" value="<? echo($ship_fname); ?>" />
<input type=hidden name="ship_lname" value="<? echo($ship_lname); ?>" />
<input type=hidden name="ship_streetnum" value="<? echo($ship_streetnum); ?>" />
<input type=hidden name="ship_route" value="<? echo($ship_route); ?>" />
<input type=hidden name="ship_unit1" value="<? echo($ship_unit1); ?>" />
<input type=hidden name="ship_state" value="<? echo($ship_state); ?>" />
<input type=hidden name="ship_city" value="<? echo($ship_city); ?>" />
<input type=hidden name="ship_zip" value="<? echo($ship_zip); ?>" />
<input type=hidden name="ship_zip4" value="<? echo($ship_zip4); ?>" />
<input type=hidden name="email" value="<? echo($email); ?>" />
<input type=hidden name="source" value="<? echo($source); ?>" />
<input type=hidden name="customer" value="<? echo($customer); ?>">
<input type=hidden name="swear" value="<? echo($swear); ?>">
<input type=hidden name="company" value="<? echo($company); ?>">
<div class="main" ><br><br>

<center>
<a class="body_content_style1" href="orderform.php"><span class="cart">&lt;Go back and make changes</span></a>
<table align="center" width="40%">
  <tr valign="top">
    <td><span class="cart-header"><strong>Service Address:</strong></span></td></tr>
  <tr valign="top">
    <td><span class="cart"><? echo($fname); ?> <? echo($lname); ?></span><br>
      <span class="cart"><? echo($streetnum); ?>&nbsp;<? echo($route); ?>&nbsp;<? echo($unit1); ?></span><br>
      <span class="cart"><? echo($city); ?>, <? echo($state); ?> <? echo($zip); ?> <? echo($zip4); ?></span></td></tr><br>
      <br><br>
       <tr valign="top">
  <td><span class="cart-header"><br></span></td></tr>
        <tr valign="top">
  <td><span class="cart-header"><strong>Shipping Address:</strong></span></td></tr>
  <tr valign="top">

      <td>
       <span class="cart"><? echo($ship_fname); ?> <? echo($ship_lname); ?></span><br>
      <span class="cart"><? echo($ship_streetnum); ?>&nbsp;<? echo($ship_route); ?>&nbsp;<? echo($ship_unit1); ?></span><br>
      <span class="cart"><? echo($ship_city); ?>, <? echo($ship_state); ?> <? echo($ship_zip); ?> <? echo($ship_zip4); ?></span></td></tr><br>
      <br><br>
</td>
  </tr>
</table>
<br>
</form>

</p></td>
</tr></table></td>
</tr></table>
<input type="button" class="btn1" value ="Place Order" onClick="this.form.submit();" /><br><br><strong class="cart">Please click the Place Order button once to avoid duplicate orders.</strong></div>
<? print $source?>
  <?php include_once("footer.php") ?>
</div></div></center>
</body>
</html>


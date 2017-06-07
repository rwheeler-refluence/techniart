<? include("database.php"); ?>
<?
$s_email=$_SESSION['s_email'];
$s_fname=$_SESSION['s_fname'];
$s_lname=$_SESSION['s_lname'];
$s_address1=$_SESSION['s_address1'];
$s_address2=$_SESSION['s_address2'];
$s_city=$_SESSION['s_city'];
$s_state=$_SESSION['s_state'];
$s_zip=$_SESSION['s_zip'];
$s_phone=$_SESSION['s_phone'];
$s_best_time=$_SESSION['s_best_time'];
$s_notes=$_SESSION['s_notes'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<title>Duke Energy Contact</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

</head>

<BODY><?php include_once("analyticstracking.php") ?><? include("nav.php")?>
<div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->


<table width="100%" border="0" class="main">
  <tr>
    <td width="40%" height="73" style="padding-left:2%"><br>
      <span class="cart-huge">Contact<br>
</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" style="padding-left: 2%"><?
$msg=$_GET['msg'];
if($msg=='security'){
	print("<h3>The security code you entered does not match.  Please try again.</h3>\n");
}
?>
<form method="post" action="sendmail.php">
<input type="hidden" name="aa" value="contactpage">
<span class="body_content_blue"><b>First Name:</b><br>
<input type="text" size="30" name="fname" class="forms11" value="<? echo($s_fname); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Last Name:</b><br>
<input type="text" size="30" name="lname" class="forms11" value="<? echo($s_lname); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Address:</b><br>
<input type="text" size="30" name="address" class="forms11" value="<? echo($s_address); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><b>Address 2:</b><br>
<input type="text" size="30" name="address2" class="forms11" value="<? echo($s_address2); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>City:</b><br /> 	
<input type="text" name="city" size="30" class="forms11" value="<? echo($s_city); ?>"><br />

<table width="205" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="60"><span class="body_content_blue"><b>State:</b><br /> 	
<SELECT NAME="state" class="forms7">
<OPTION VALUE=""></OPTION>
<OPTION VALUE="AL">AL</OPTION>
<OPTION VALUE="AK">AK</OPTION>
<OPTION VALUE="AZ">AZ</OPTION>
<OPTION VALUE="AR">AR</OPTION>
<OPTION VALUE="CA">CA</OPTION>
<OPTION VALUE="CO">CO</OPTION>
<OPTION VALUE="CT">CT</OPTION>
<OPTION VALUE="DC">DC</OPTION>
<OPTION VALUE="DE">DE</OPTION>
<OPTION VALUE="FL">FL</OPTION>
<OPTION VALUE="GA">GA</OPTION>
<OPTION VALUE="HI">HI</OPTION>
<OPTION VALUE="ID">ID</OPTION>
<OPTION VALUE="IL">IL</OPTION>
<OPTION VALUE="IN">IN</OPTION>
<OPTION VALUE="IA">IA</OPTION>
<OPTION VALUE="KS">KS</OPTION>
<OPTION VALUE="KY">KY</OPTION>
<OPTION VALUE="LA">LA</OPTION>
<OPTION VALUE="MA">MA</OPTION>
<OPTION VALUE="MD">MD</OPTION>
<OPTION VALUE="ME">ME</OPTION>
<OPTION VALUE="MI">MI</OPTION>
<OPTION VALUE="MN">MN</OPTION>
<OPTION VALUE="MO">MO</OPTION>
<OPTION VALUE="MS">MS</OPTION>
<OPTION VALUE="MT">MT</OPTION>
<OPTION VALUE="NE">NE</OPTION>
<OPTION VALUE="NV">NV</OPTION>
<OPTION VALUE="NH">NH</OPTION>
<OPTION VALUE="NJ">NJ</OPTION>
<OPTION VALUE="NM">NM</OPTION>
<OPTION VALUE="NY">NY</OPTION>
<OPTION VALUE="NC">NC</OPTION>
<OPTION VALUE="ND">ND</OPTION>
<OPTION VALUE="OH">OH</OPTION>
<OPTION VALUE="OK">OK</OPTION>
<OPTION VALUE="OR">OR</OPTION>
<OPTION VALUE="PA">PA</OPTION>
<OPTION VALUE="RI">RI</OPTION>
<OPTION VALUE="SC">SC</OPTION>
<OPTION VALUE="SD">SD</OPTION>
<OPTION VALUE="TN">TN</OPTION>
<OPTION VALUE="TX">TX</OPTION>
<OPTION VALUE="UT">UT</OPTION>
<OPTION VALUE="VT">VT</OPTION>
<OPTION VALUE="VA">VA</OPTION>
<OPTION VALUE="WA">WA</OPTION>
<OPTION VALUE="WV">WV</OPTION>
<OPTION VALUE="WI">WI</OPTION>
<OPTION VALUE="WY">WY</OPTION>
</SELECT></span></td>
<td width="145"><span class="body_content_blue"><b>Zip Code:</b><br /> 	
<input type="text" name="zip" size="5" class="forms9" value="<? echo($s_zip); ?>"><br /></span></td>
</tr></table>
<b>Email:</b><br>
<input type="text" size="30" name="email" class="forms11" value="<? echo($s_email); ?>"><br>
<b>Phone Number:</b><br>
<input type="text" size="30" name="phone" class="forms11" value="<? echo($s_phone); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br></span></td>
    <td>&nbsp;</td>
    <td><span class="body_content_blue">
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Best time to contact</b><br>
<input type="text" size="35" name="best_time" class="forms11" value="<? echo($s_best_time); ?>"><br>
<b>Comments</b><br>
<textarea name="notes" cols="30" rows="10" class="forms11"></textarea><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>

<b>Security</b><br>
<!--security-->
<?
$days=array("1","2","3","4","5","6","7");
$chosen=array_rand($days,1);
?>
<input type="hidden" name="chosen" value="<? echo($days[$chosen]); ?>">
<img src="pix/security/<? echo("cv".$days[$chosen].".gif");?>">
<br>
<b>Please enter the characters you<br>
see above in the box below:</b><br></span>
<input type="text" name="security" size="8" class="forms11">
<br><br>
<!--end security-->
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<input type="submit" class="btn1" name="submit" alt="Submit" border="0" value="Submit">
<br>
    </form></td>
  </tr>
  <tr>
    <td>  
    <td>  
    <td>&nbsp;</td>
    <td>  
    <td>  
  </tr>
  <tr>
    <td>  
    <td>  
    <td>&nbsp;</td>
    <td>  
    <td>  
  </tr>
</table>

<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


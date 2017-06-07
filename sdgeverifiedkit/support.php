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
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
<style>
body { background: #0878b5;}
</style>
</head>
<body>
<? include("header.php");?>
<!-- Begin content -->
<br>
<br>
<br>


<div class="main" ><br>
<br>
<br>
<br><table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div align="left" id="title_spacer"><span class="cart-header">Customer Support Contact</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="rcorners3"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">
<?
$msg=$_GET['msg'];
if($msg=='security'){
	print("<h3>The security code you entered does not match.  Please try again.</h3>\n");
}
?>
<form method="post" action="sendmail.php">
<input type="hidden" name="aa" value="contactpage">
<table width="580" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="205"><span class="body_content_blue"><b>First Name:</b><br>
<input type="text" size="30" name="fname" class="forms3" value="<? echo($s_fname); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Last Name:</b><br>
<input type="text" size="30" name="lname" class="forms3" value="<? echo($s_lname); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Address:</b><br>
<input type="text" size="30" name="address" class="forms3" value="<? echo($s_address); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Address 2:</b><br>
<input type="text" size="30" name="address2" class="forms3" value="<? echo($s_address2); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>City:</b><br /> 	
<input type="text" name="city" size="30" class="forms3" value="<? echo($s_city); ?>"><br />

<table width="205" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="60"><span class="body_content_blue"><b>State:</b><br /> 	
<SELECT NAME="state" class="forms2">
<OPTION VALUE=""></OPTION>
<OPTION VALUE="CA">CA</OPTION>

</SELECT></span></td>
<td width="145"><span class="body_content_blue"><b>Zip Code:</b><br /> 	
<input type="text" name="zip" size="5" class="forms2" value="<? echo($s_zip); ?>"><br /></span></td>
</tr></table>

<b>Email:</b><br>
<input type="text" size="30" name="email" class="forms3" value="<? echo($s_email); ?>"><br>
<b>Phone Number:</b><br>
<input type="text" size="30" name="phone" class="forms3" value="<? echo($s_phone); ?>"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br></span></td>
<td width="20"><img src="pix/pix_trans.gif" alt="" width="20" height="1" border="0"></td>
<td width="365"><span class="body_content_blue">
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Comments</b><br>
<textarea name="notes" id="notes" rows="5" cols="30" class="forms3" /></textarea><br>
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
<input type="text" name="security" size="8" class="forms2">
<br><br>
<!--end security-->
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<input type="submit" class="btn1" name="submit" alt="Submit" border="0" value="Submit">
</form></td>
</tr></table>


</span>

<br><br></div></td>
<td></td>
</tr></table>

</div></td>
</tr></table>
<!-- End content -->
<? include("footer.php");?>

</body>
</html>

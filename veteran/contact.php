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
<head>
<title>TechniArt - Marketing The Future</title>

<meta name="robots" content="index,follow" />
<meta name="author" content="TechniArt" />
<meta name="publisher" content="techniart.com" />
<meta name="copyright" content="Copyright 2008 TechniArt. All Rights Reserved" />
<meta http-equiv="content-language" content="EN" />
<meta name="content-language" content="EN" />
<meta name="rating" content="All" />
<meta name="audience" content="General" />
<meta name="distribution" content="Global" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<? if($_SESSION['rep']=="CNP"){?><link rel="STYLESHEET" type="text/css" href="cnp.css"><?;}?>
<? if($_SESSION['rep']=="AEP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="TMNP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="NQ"){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
<? if($_SESSION['rep']==""){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>

</head>

<BODY>
<?php include_once("analyticstracking.php") ?>

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->
<center><div class="rcorners2">
<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div align="left" id="title_spacer"><span class="title_main">Contact</span></div></td>
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
<input type="image" src="pix/b_submit.gif" name="submit" alt="Submit" border="0" value="Submit">
</form></td>
</tr></table>


</span>

<br><br></div></td>
<td></td>
</tr></table>

</div></td>
</tr></table>

</div>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


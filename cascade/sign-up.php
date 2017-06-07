<? include("database.php"); ?>
<?
$s_user=$_SESSION['s_user'];
$s_pass=$_SESSION['s_pass'];
$s_access_first=$_SESSION['s_access_first'];
$s_access_last=$_SESSION['s_access_last'];
$s_phone=$_SESSION['s_phone'];
$s_email=$_SESSION['s_email'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CASCADE WATER ALLIANCE |  Free Items</title>


<link rel="stylesheet" type="text/css" href="css/main.css"/>

<style type="text/css">





#pleasewait {position: absolute; top: 0px; left:0px; height:3500px; width:100%;font: 12px Archivo Narrow, Arial, Helvetica; visibility:hidden; z-index: 100000; background-color:#eee;filter:alpha(opacity=50); -moz-opacity:0.5 ;opacity: 0.5;}
#checkout a {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#checkout a:hover {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#checkout a:active {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}

#close a {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#close a:hover {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#close a:active {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}


#prods {position: absolute; top: 700px; left:300px; height:2525px; width:975px;display:block;background:#ffffff; border: 0px solid #000000; z-index: 1000; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;}
#register {position: absolute; top: 415px; left:0px; height:1300px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}

#cart {position: absolute; top: 415px; left:0px; height:700px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}
#review_checkout {position: absolute; top: 415px; left:0px; height:700px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}
#forgotpass {position: absolute; top: 185px; left:325px; height:325px; width:585px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 1002; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
#signin {position: absolute; top: 385px; left:250px; height:475px; width:730px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
#messagescr {position: absolute; top: 215px; left:340px; height:450px; width:570px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 10003; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
li~li {
	border-left: 1px solid #ffffff;
}
.content{
	margin-left:50px;
}
</style>

</head>

<body>
<?php include("header.php"); ?>
<?
$msg=$_GET['msg'];
if($msg=='security'){
	print("<h3>The security code you entered does not match.  Please try again.</h3>\n");
}
?>
<div class="content">
<form method="post" action="sign-up-mail.php">
<input type="hidden" name="sign-up" value="sign-up-page">
<table width="780" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="205"><span class="body_content_blue"><b>Username:</b><br>
<input type="text" size="30" name="user" class="forms3" value="<? echo $s_user?>" required><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Password:</b><br>
<div class="td">
    <input type="text" size="30" name="password" class="forms3" required>
</div>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>First Name</b><br>
<input type="text" size="30" name="access_company" class="forms3" value="<? echo $s_access_company?>" required><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Last Name</b><br>
<input type="text" size="30" name="company_address" class="forms3" value="<? echo $s_company_address?>" required><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Company City:</b><br>
<input type="text" size="30" name="company_city" class="forms3" value="<? echo $s_company_city?>" required><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Company Zip:</b><br>
<input type="text" size="30" name="company_zip" class="forms3" value="<? echo $s_company_zip?>" required><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Company Owner Name:</b><br>
<input type="text" size="30" name="company_owner" class="forms3" value="<? echo $s_company_owner?>" required><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Owner Phone:</b><br>
<input type="text" size="30" name="owner_phone" class="forms3" value="<? echo $s_owner_phone?>" required><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Owner Email:</b><br>
<input type="text" size="30" name="owner_email" class="forms3" value="<? echo $s_owner_email?>" required><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<b>Administrator/Purchaser Name:</b><br>
<input type="text" size="30" name="admin_name" class="forms3" value="<? echo $s_admin_name?>" required><br>
<b>Admin Phone Number:</b><br>
<input type="text" size="30" name="admin_phone" class="forms3" value="<? echo $s_admin_phone?>" required><br>
<b>Admin Email:</b><br>
<input type="text" size="30" name="admin_email" class="forms3" value="<? echo $s_admin_email?>" required><br>

<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br></span></td>
<td width="20"><img src="pix/pix_trans.gif" alt="" width="20" height="1" border="0"></td>
<td width="365"><span class="body_content_blue">
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<br>
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
see above in the box below:<br>
(case sensitive)
</b><br></span>
<input type="text" name="security" size="8" class="forms2" required>
<br><br>
<!--end security-->
<img src="pix/pix_trans.gif" alt="" width="1" height="5" border="0"><br>
<input type="submit" class="btn1" value="Sign-Up">
</form></td>
</tr></table>


</span>

<br><br></td>
<td width="256">

<!-- ------------------------------begin callouts------------------------------ -->

<!-- ------------------------------end callouts------------------------------ -->

</td>
<td width="1"></td>
</tr></table>

</td>
</tr></table>
</div>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div></div>
</body>

</html>


<? include("database.php");?><form name="login" action="login.php" method="post">


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CASCADE WATER ALLIANCE |  Free Items</title>


<link rel="stylesheet" type="text/css" href="css/main.css"/>

<style type="text/css">





#pleasewait {position: absolute; top: 0px; left:0px; height:2000px; width:100%;font: 12px Archivo Narrow, Arial, Helvetica; visibility:hidden; z-index: 100000; background-color:#eee;filter:alpha(opacity=50); -moz-opacity:0.5 ;opacity: 0.5;}
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

<body id="reliability" onLoad="theonload();">
<?php include("header.php"); ?>



<br />
<br /><div class="content">
<span class="landing_text">Account Login</span><br /><br />

Username:
                   <input type="text" name="user" class="forms3">            </span></td>
               <br /><br />

Password:<input type="password" name="pass" class="forms3"><br />
<br />
<input class="btn1" type="submit" value="Submit"><br />
<br />
<a href="sign-up.php">Sign-up?</a><br />
<br />
<br />

</div>
<div class="footer" style="position:absolute;left:0px;width:975px;height:195px;z-index: 16;background-color:#1d4d7b;display:block;">

</form>
<?php include("includes/screens/footer_scr.txt"); ?>
</body>
</html>


<?
include("class.phpmailer.php");
$date=mktime();
$month=strftime("%B",$date);
$day=strftime("%e",$date);
$year=strftime("%Y",$date);
$body.="<html>\n";
$body.="<heat>\n";
$body.="<title> Spirit of Golf Thought of the Day </title>\n";
$body.="<style type='text/css'>\n";
$body.=".body-black{\n";
$body.="font-size: 18px;\n";
$body.="text-decoration: none;\n";
$body.="font-family: Arial, Verdana, Helvetica, sans-serif;\n";
$body.="color:#000000;\n";
$body.="font-weight:bold;\n";
$body.="}\n";
$body.=".body_content{\n";
$body.="font-size: 13px;\n";
$body.="text-decoration: none;\n";
$body.="font-family: Arial, Garamond, Verdana, Helvetica, sans-serif;\n";
$body.="color:#000000;\n";
$body.="}\n";
$body.=".smgray{\n";
$body.="font-size: 13px;\n";
$body.="text-decoration: none;\n";
$body.="font-family: Arial, Garamond, Verdana, Helvetica, sans-serif;\n";
$body.="color:#000000;\n";
$body.="}\n";
$body.="</style>\n";
$body.="</head>\n";
$body.="\n";
$body.="<BODY>\n";
$body.="<table width='600' cellpadding='0' cellspacing='0' border='0'><tr valign='top'>\n";
$body.="<td colspan='3'><img src='http://www.myspiritofgolf.com/admin/email/email-header_v2.jpg' width='600' height='150'></td>\n";
$body.="</tr><tr valign='top'>\n";
$body.="<td width='1' background='http://www.myspiritofgolf.com/admin/email/pix_black.gif'><img src='http://www.myspiritofgolf.com/admin/email/pix_trans.gif' width='1' height='1'></td>\n";
$body.="<td width='598'><img src='http://www.myspiritofgolf.com/admin/email/pix_trans.gif' width='598' height='1'><br>\n";
$body.="<div style='padding:15px;'><span class='body_content'>\n";
$body.="<div align='right' style='padding:15px;'>".$month." ".$day.", ".$year."</div><br><br>\n";
$body.="Thank you for subscribing to the Spirit of Golf Thought of the Day!  You have been added to our list, and will begin receiving emails right away.<br><br>";
$body.="Tim Kremer<br>";
$body.="Spirit of Golf";
$body.="</span>\n";
$body.="<br>";
$body.="<table width='565' border='0' cellpadding='0' cellspacing='0'><tr><td align='left'><img src='http://www.myspiritofgolf.com/admin/email/pix_trans.gif' width='1' height='60'><br>\n";
$body.="<td valign='bottom'><span class='body_content'><div align='right'>Copyright ".date("Y").", Spirit of Golf<br><a href='http://www.myspiritofgolf.com'>http://www.myspiritofgolf.com</a></div></span>\n";
$body.="</td></tr></table>";
$body.="</div>\n";
$body.="</td>\n";
$body.="<td width='1' background='http://www.myspiritofgolf.com/admin/email/pix_black.gif'><img src='http://www.myspiritofgolf.com/admin/email/pix_trans.gif' width='1' height='1'></td>\n";
$body.="</tr><tr valign='top'>\n";
$body.="<td colspan='3'><img src='http://www.myspiritofgolf.com/admin/email/pix_black.gif' width='600' height='1'></td>\n";
$body.="</tr></table>\n";
$body.="</BODY>\n";
$body.="</html>\n";
?>
<? include("database.php");?>
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
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
</head>

<BODY>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Event Schedule</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" rowspan="2" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
<td width="200" height="114"><div id="main_content_ip" align="left">
<? $state=$_GET['state'];?>
<a class="body_content_events-public" href="event-schedule.php?state=CT">Connecticut</a><br>
<a class="body_content_events-public" href="event-schedule.php?state=MA">Massachusetts</a><br>
<a class="body_content_events-public" href="event-schedule.php?state=NH">New Hampshire</a><br>
<a class="body_content_events-public" href="event-schedule.php?state=NJ">New Jersey</a><br>
<a class="body_content_events-public" href="event-schedule.php?state=NY">New York</a><br>
<br><br></div></td>
<td width="451" height="114" valign="top"><div align="center">
<? if ($state == 'CT') {echo "<img src=\"ceef.jpg\">"; }?>
<? if ($state == 'MA') {echo "<img src=\"mass.jpg\">"; }?>
<? if ($state == 'NH') {echo "<img src=\"nh.jpg\">"; }?>
<? if ($state == 'NJ') {echo "<img src=\"njcep.jpg\">"; }?>
<? if ($state == 'NY') {echo "<img src=\"ny.jpg\">"; }?></div></td>
<td width="245" rowspan="2">

<!-- ------------------------------begin callouts------------------------------ -->
<? include("callouts.php"); ?>
<!-- ------------------------------end callouts------------------------------ --></td>
<td width="1" rowspan="2" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="1" border="0"></td>
</tr>
  <tr valign="top" align="center">
    <td colspan="2">
	<?if($state){?>
      <?
print("<br><br>\n");
$sql="select distinct MONTH(stamp) as mo,YEAR(stamp) as year from tblEvents where eventState='$state' order by mo asc";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$mo=$row['mo'];
	$year=$row['year'];
	$mon=date("F", mktime(0, 0, 0, $mo, 1, $year));
	$holder.="<a class=\"body_content_events-public\" href=\"".$PHP_SELF."?state=".$state."&mo=".$mo."&year=".$year."&mon=".$mon."\">".$mon." ".$year."</a>&nbsp;&nbsp;\n";
}
$holder.="<br><br>";
$getmo=$_GET['mo'];
$getyear=$_GET['year'];
$mon=$_GET['mon'];
if($getmo && $getyear){
	$qry.="&& MONTH(stamp)='$getmo' && YEAR(stamp)='$getyear'";
}
$sql2="select eventID, stamp, eventTitle, eventCompany, eventAddress, eventCity, eventState, eventTime, eventType, eventPub, MONTH(stamp) as mo, DAY(stamp) as day, YEAR(stamp) as year from tblEvents where eventPub='Yes' && eventState='$state' $qry order by stamp asc";
$result2=db_query($sql2);
#print($sql2);
$count2=mysql_num_rows($result2);
if($count2<1){
		$holder.="<span class=\"product_title_lg\"><b>Both public and private events in ".$state." will be posted as they become available.</b></span><br>";
}else{
$holder.="<table width=\"595\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\" align=\"center\"><tr valign=\"top\">\n";
$holder.="<td><span class=\"body_content_events-private\">*Shows listed in RED are private</span>&nbsp;&nbsp;&nbsp;<span class=\"body_content_events-public\">*Shows listed in GREEN are public</span></td>\n";
$holder.="</tr></table>\n";
$holder.="<table width=\"595\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\" align=\"center\">";
if($mon && $getyear){
	$holder.="<tr valign=\"top\" bgcolor=\"#b2e8fd\">\n";
	$holder.="<td colspan=\"6\"><span class=\"section_heading_style1\">".$mon." ".$getyear."</span></td>\n";
	$holder.="</tr>\n";
}
while($row2=mysql_fetch_array($result2)){
	$eventTitle=$row2['eventTitle'];
	$eventCompany=$row2['eventCompany'];
	$eventAddress=$row2['eventAddress'];
	$eventCity=$row2['eventCity'];
	$eventState=$row2['eventState'];
	$eventTime=$row2['eventTime'];
	$stamp=$row2['stamp'];
	$mo=$row2['mo'];
	$day=$row2['day'];
	$year=$row2['year'];
	$comb=strtotime("".$mo."/".$day."/".$year."");
	$dayofweek=strftime("%A",$comb);
	$eventType=$row2['eventType'];
	if($eventType=='public'){
		$style="body_content_events-public";
	}else{
		$style="body_content_events-private";
	}
	$eventPub=$row2['eventPub'];
	$holder.="<tr valign=\"top\" bgcolor=\"#cdf1fe\">\n";
	$holder.="<td><span class=\"".$style."\">".$mo.".".$day.".".$year."<br>".$dayofweek."</span></td>\n";
	$holder.="<td><span class=\"".$style."\">".$eventTitle."";
	if($eventCompany){
		$holder.="/".$eventCompany."";
	}
	$holder.="</span></td>\n";
	$holder.="<td><span class=\"".$style."\">".$eventAddress."<br>".$eventCity.", ".$eventState."</span></td>\n";
	$holder.="<td><span class=\"".$style."\">".$eventTime."</span></td>\n";
	$holder.="</tr>\n";
}
	$holder.="</table>\n";
}
		print("<span class=\"product_title_lg\"><b>Upcoming ".$state." Events</b></span><br>");
		echo($holder);
}?></td>
  </tr>
</table>

</div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><img src="pix/g_body_bot.gif" alt="" width="906" height="12" border="0"></td>
</tr></table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7592070-3");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
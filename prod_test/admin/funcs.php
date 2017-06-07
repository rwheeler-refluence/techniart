<?
function build_sched(){

$sql2="select * from tblSched order by schedUnix asc";
$result2=db_query($sql2);
	print("<table width=\"652\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\" align=\"center\" bordercolor=\"#34689A\" bgcolor=\"#A1BEDB\">");
$count2=mysql_num_rows($result2);
if($count2){

$month_array=array("","January","February","March","April","May","June","July","August","September","October","November","December");

	while($row=mysql_fetch_array($result)){
		$schedID=$row['schedID'];
  		$schedTitle=$row['schedTitle'];
		$startMo=$row['startMo'];
		$startDay=$row['startDay'];
		$startYear=$row['startYear'];
		$endMo=$row['endMo'];
		$endDay=$row['endDay'];
		$endYear=$row['endYear'];
		$schedDesc=$row['schedDesc'];
		$schedNote=$row['schedNote'];
		$schedUnix=$row['schedUnix'];


		print("<tr valign=\"top\">\n");
		if($startMo=='TBD' && $startDay=='TBD' && $startYear=='TBD'){
			print("<td bgcolor=\"#C7DBF0\"><span class=\"body\">TBD");
		}else{
			if($startMo=='TBD' && $startDay=='TBD' && $startYear!=='TBD'){
				print("<td bgcolor=\"#C7DBF0\"><span class=\"body\">".$startYear." - TBD");
			}else{
				print("<td bgcolor=\"#C7DBF0\"><span class=\"body\">".$startMo."/".$startDay."/".$startYear."");
			}
		}
		if(($startMo==$endMo) && ($startDay==$endDay)){
		}else{
			if($endMo=='TBD' && $endDay=='TBD' && $endYear=='TBD'){
				print(" - TBD");
			}else{
				print(" - ".$endMo."/".$endDay."/".$endYear."");
			}
		}
		print("</span></td>\n");
		print("<td bgcolor=\"#C7DBF0\"><span class=\"body\"><a href=\"#".$schedID."\" class=\"body\">".$schedTitle."</a></span></td>\n");
		print("</tr>");
		if(!$printed){
			print("</tr></table><br>\n");
			print("\n");
			print("<!-- begin spacer -->\n");
			print("<table width=\"652\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr valign=\"top\">\n");
			print("<td><img src=\"pix/pix_trans.gif\" width=\"652\" height=\"5\" alt=\"\" border=\"0\"><br>\n");
			print("<img src=\"pix/pix_blue.gif\" width=\"652\" height=\"1\" alt=\"\" border=\"0\"><br>\n");
			print("<img src=\"pix/pix_trans.gif\" width=\"652\" height=\"5\" alt=\"\" border=\"0\"></td>\n");
			print("</tr></table>\n");
			print("<!-- end spacer -->\n");
			print("\n");
			print("<table width=\"652\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">");
			$printed="Yes";
		}
		
		$Body.="<tr valign=\"top\">\n";
		$Body.="<td width=\"531\"><span class=\"body\"><span class=\"body\"><a name=\"".$schedID."\"></a>\n";
		$Body.="<b>".$schedTitle."</b><br>\n";
		if($startMo=='TBD' && $startDay=='TBD' && $startYear=='TBD'){
			$Body.="TBD";
		}else{
			if($startMo=='TBD' && $startDay=='TBD' && $startYear!=='TBD'){
				$Body.="<span class=\"body\">Coming in ".$startYear."";
			}else{
				$Body.="<span class=\"body\">".$startMo."/".$startDay."/".$startYear."";
			}
		}
		if(($startMo==$endMo) && ($startDay==$endDay)){
		}else{
			if($endMo=='TBD' && $endDay=='TBD' && $endYear=='TBD'){
				$Body.=" - TBD";
			}else{
				$Body.=" - ".$endMo."/".$endDay."/".$endYear."";
			}
		}
		$Body.="".$schedDesc."<br>\n";
		$Body.="<b>".$schedNote."</b><br><br></span></td>\n";
		$Body.="<td width=\"121\"><a href=\"xxxxxxxxxx.php\"><img src=\"pix/b_signmeup.gif\" width=\"121\" height=\"24\" alt=\"Sign Me Up!\" border=\"0\"></a></td>\n";
		$Body.="</tr></table>\n";
		$Body.="\n";
		$Body.="<!-- begin spacer -->\n";
		$Body.="<table width=\"652\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr valign=\"top\">\n";
		$Body.="<td><img src=\"pix/pix_trans.gif\" width=\"652\" height=\"5\" alt=\"\" border=\"0\"><br>\n";
		$Body.="<img src=\"pix/pix_blue.gif\" width=\"652\" height=\"1\" alt=\"\" border=\"0\"><br>\n";
		$Body.="<img src=\"pix/pix_trans.gif\" width=\"652\" height=\"5\" alt=\"\" border=\"0\"></td>\n";
		$Body.="</tr></table>\n";
		$Body.="<!-- end spacer -->\n";
}
print($Body);
}
?>
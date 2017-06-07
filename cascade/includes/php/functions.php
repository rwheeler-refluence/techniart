<?php

function trim_array($totrim) {
   if (is_array($totrim)) {
       $totrim = array_map("trim_array", $totrim);
   } else {
       $totrim = trim($totrim);
   }
   return $totrim;
}

 
function saveLogEntry($mcoid,$logstr,$logfile,$domain){

$mfilename="c:\\Inetpub\\" . $mcoid . "_logfiles\\$logfile";

$t=time();

  $fh = fopen($mfilename, "a+") or die();
  fwrite($fh, date("m/d/Y H:i:s",$t) . "  " . $domain . "  " . $logstr);
  fclose($fh);

return "Done";

}





function convertSQLdt($mdate) {

$d="";
$y="";
$return="";
$m="";
	
 $temp=explode(" ",$mdate);
   
   if ($temp[0]=='Jan'){
	 $m='01';
   }	   
   if ($temp[0]=='Feb'){
	 $m='02';
   }	
   if ($temp[0]=='Mar'){
	 $m='03';
   }
   if ($temp[0]=='Apr'){
	 $m='04';
   }	   
   if ($temp[0]=='May'){
	 $m='05';
   }	
   if ($temp[0]=='Jun'){
	 $m='06';
   }
   if ($temp[0]=='Jul'){
	 $m='07';
   }	   
   if ($temp[0]=='Aug'){
	 $m='08';
   }	
   if ($temp[0]=='Sep'){
	 $m='09';
   }
   if ($temp[0]=='Oct'){
	 $m='10'; 
   }	   
   if ($temp[0]=='Nov'){
	 $m='11';
   }	
   if ($temp[0]=='Dec'){
	 $m='12';
   }
   
   $d="/" . $temp[1];
   $y="/" . $temp[2];
   $return=$m . $d . $y;
   return $return; 
	
} 


function left($str, $length) {
	return substr($str, 0, $length);
} 

function right($str, $length) {
	//INCREASE LENGTH BY ONE TO ACCOUNT FOR 0
	return substr($str, -$length);
}


?>
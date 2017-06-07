<?
/**
*Defines application constants. 
*/
include("config_system.php");

define("DATEFORMAT",	"d/M/Y");
define("DEFAULTLANG",	"en");

define("BAPIDELIM","0023a0u");
define("QUOTEDELIM",	"abcdefgfedcba");
define("SLASHDELIM",	"0123456789876543210");

define("LOGINCRYPTKEY",md5("abcdefghijkl1234567890"));
define("LOGINREMEMBER",86400*14);	
	
define("THUMBWIDTH",	100);
define("THUMBHEIGHT",	100);
	
//define UPS paramaters
define("PICKUP_TYPE",	"01"); 
//01=>"Daily Pickup",
//03=>"Customer Counter",
//06=>"One Time Pickup",
//07=>"On Call Air",
//11=>"Suggested Retail Rates",
//19=>"Letter Center",
//20=>"Air Service Center"
define("PACKAGE_CODE",	"02");
//01=>"UPS letter/ UPS Express Envelope",
//02=>"Package",
//03=>"UPS Tube",
//04=>"UPS Pak",
//21=>"UPS Express Box",
//24=>"UPS 25Kg Box",
//25=>"UPS 10Kg Box"

//Shipper information
define("shipper_ZIP","06010");
define("shipper_CC","US");
define("shipper_country","United States");

			
define("SITETITLE",	 "CU Next Tuesday");
   
define("MFSESSION"		,1);
define("DBOBJ_CACHE"	,1);
?>
<?
/**
*Defines deployment area specific application constants.
*/
/***********************************************
	PATH AND BAPI CONSTANTS
***********************************************/	
//	/home/httpd/vhosts/somafuel.com/httpdocs/ups
//  /home/httpd/vhosts/somafuel.com/httpdocs/ups

define("BAPIENTRY","/data/localhost/htdocs/techniart/site/ups/bapi/bapimain.php");
define("LOCALPATH","/data/localhost/htdocs/techniart/site/ups");
define("SESSIONSAVEPATH","/tmp");	
define("HTTPURL", "http://dev.crucialnetworking.com/techniart/site/");
/***********************************************
	DATABASE CONSTANTS
***********************************************/	
define("USEDBENGINE", "MYSQL");
define("DB_HOST", "sqlc40c.carrierzone.com");
define("DB_USER", "root");
define("DB_PASSWORD", "networking011");
define("DB_DB", "techniart_main");
/***********************************************
	ATTACHEMENTS AND UPLOADS
***********************************************/
define("MAXATTACHEMENTSIZE"  , 1024*1024);
define("UPLOADFOLDER" 			 , "/data/localhost/htdocs/techniart/site/ups/uploads");
define("HTTPTOUPLOADFOLDER"	 , "/data/localhost/htdocs/techniart/site/ups/uploads/");
define("DEFAULTPIC"					 , "img/nopic.gif");
/***********************************************
	SMARTY
***********************************************/
define("SMARTY_TEMPLATEBASE", "/data/localhost/htdocs/techniart/site/ups/templates/");
define("SMARTY_CONFIG", "/data/localhost/htdocs/techniart/site/ups/smarty/config");
define("SMARTY_COMPILE", "/data/localhost/htdocs/techniart/site/ups/smarty/compile");
define("SMARTY_CACHE","/data/localhost/htdocs/techniart/site/ups/smarty/cache");
?>
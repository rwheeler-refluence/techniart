<?php

#$sys_dbhost='pro2.abac.com';
$sys_dbhost='localhost';
$sys_dbuser='techniar';
$sys_dbpasswd='!TABluehost2016';
$sys_dbname='techniar_cascade';

	function start_session(){
	   static $started=false;
	   if(!$started){
		   session_start();
		   $started = true;
	   }
	}

	start_session();
	$sess=session_id();
	$_COOKIE['sess']=$sess;
	

function db_connect() {
	global $sys_dbhost,$sys_dbuser,$sys_dbpasswd;
	$conn = mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpasswd);
	if (!$conn) {
	//	echo mysql_error();
	}
	return $conn;
}


function db_query($qstring,$print=0) {
	global $sys_dbname;
	return @mysql($sys_dbname,$qstring);
}

function db_numrows($qhandle) {
	// return only if qhandle exists, otherwise 0
	if ($qhandle) {
		return @mysql_numrows($qhandle);
	} else {
		return 0;
	}
}

function db_result($qhandle,$row,$field) {
	return @mysql_result($qhandle,$row,$field);
}

function db_numfields($lhandle) {
	return @mysql_numfields($lhandle);
}

function db_fieldname($lhandle,$fnumber) {
           return @mysql_fieldname($lhandle,$fnumber);
}

function db_affected_rows($qhandle) {
	return @mysql_affected_rows();
}
	
function db_fetch_array($qhandle) {
	return @mysql_fetch_array($qhandle);
}
	
function db_insertid($qhandle) {
	return @mysql_insert_id($qhandle);
}

function db_error() {
	return "\n\n<P><B>".@mysql_error()."</B><P>\n\n";
}

//connect to the db
//I usually call from pre.php
db_connect();

?>

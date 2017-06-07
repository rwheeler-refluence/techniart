<?
	/*---------------------------------------------------------------------------
		File	: dbentry.php
		Desc	: BAPI db functions entry point. Selects the appropriate implementation
						by USEDBENGINE constant. Files in this branch can be included directly.
		Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 30-nov-2003
		Version : 1.3
		Updates : n/a
	---------------------------------------------------------------------------
		22-aug-2004 - (~) mysql_impl
									(+) CDBBaseObject
									(+)	CDBRelationalObject
									(+) CDBObject		
	---------------------------------------------------------------------------
		6-sept-2004 - (+) dbutils.php								
	---------------------------------------------------------------------------*/
	include_once("dbutils.php");

	if(USEDBENGINE == "MSSQL") include_once("implems/mssql_impl.php");
	if(USEDBENGINE == "MYSQL") include_once("implems/mysql_impl.php");
	if(USEDBENGINE == "POSTGRESQL") include_once("implems/pg_impl.php");
	
	include_once("class/class.dbbaseobject.php");
	include_once("class/class.dbrelationalobject.php");
	include_once("class/class.dbobject.php");
	include_once("class/class.dbview.php");
	include_once("class/class.dbobjectlist2.php");
	include_once("class/class.query_cache.pg.php");
?>
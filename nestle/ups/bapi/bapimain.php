<?
	/*---------------------------------------------------------------------------
		File	: bapimain.php
		Desc	: BAPI entry point. Include this file to have access to BAPI functions and objects.
				  	Do not include directly BAPI files.
		Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 30-nov-2003
		Version : 1.41
		Updates : 
	---------------------------------------------------------------------------
		30-nov-2003	-	reorganization of BAPI files. Not compatible with earlier
						versions.
					-	introduces DBObject class					
	---------------------------------------------------------------------------
		3-jan-2004	-	introduces parser functions
					-   tpl_if added to templates		
	---------------------------------------------------------------------------
		6-jan-2004	-	corrected getFile - fixed file starting with blank line bug
	---------------------------------------------------------------------------
		7-jan-2004	-	changes to templateenginge.php
	---------------------------------------------------------------------------
		21-apr-2004	-	changes to xmlenginge.php
									changes to misc.php
	---------------------------------------------------------------------------
		29-apr-2004	-	changes to templateengine.php
	---------------------------------------------------------------------------
		10-may-2004	-	added extern.php
	---------------------------------------------------------------------------
		10-jul-2004 -	changes to misc.php
	---------------------------------------------------------------------------
		22-aug-2004 - 
									(+)	Smarty
								 	(-)	BZPass
									(-)	templateengine
									(+) CObject
									(+) CDBBaseObject
									(+) CDBObject
									(+) Users
	---------------------------------------------------------------------------
		22-aug-2004 - 
									(+)	htp()
	---------------------------------------------------------------------------
		6-sept-2004 - 
									(+)	GetDBObject()
									(+) changes in misc
	---------------------------------------------------------------------------
		1-jan-2005 - 
									(+)	smarty.string_tpl.php
	---------------------------------------------------------------------------
		31-jan-2005 - 
									(~) Major changes to dbobject
	---------------------------------------------------------------------------
		1-feb-2005 - 
									(~) misc.php
	---------------------------------------------------------------------------
		12-mar-2005 - Major 1.5 Changes
	---------------------------------------------------------------------------
		1-oct-2005 - Added ext, Adodb_time
	---------------------------------------------------------------------------*/
	define(BAPI_VERSION, 1.5);

	include_once("core/coreentry.php");
	include_once("db/dbentry.php");
	include_once("xml/xmlentry.php");
	include_once("smarty/smartyentry.php");
	include_once("globalsession/globalsessionentry.php");
	include_once("application/applicationentry.php");
	include_once("modules/modulesentry.php");
	include_once("generic/genericentry.php");
	include_once("deprecated/deprecatedentry.php");
	
	include_once("external/adodb-time.inc.php");
	
?>
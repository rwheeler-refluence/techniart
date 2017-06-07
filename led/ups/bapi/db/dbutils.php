<?
	/**---------------------------------------------------------------------------
		File		: dbutils.php
		Desc		: db independed database functions
		Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 6-sept-2003
		Version : 1
		Updates : 
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 21-jan-2005
		Version : 1.1
		Desc		: Uses GlobalSession instead of Session
		---------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 30-jun-2005
		Version : 1.2
		Desc		: TDBObject layer
		---------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 2-nov-2005
		Version : 1.21
		Desc		: (~) FetchDBObject can now use other fields than ident as well
		---------------------------------------------------------------------------
	*/

//--------------------------------------------------------------------------------------------------------------------------------------------	
	/**
	* @return CDBObject
	* @param string $tablename
	* @param string $tbl_prefix
	* @desc Returns the corresponding EJB
	
	*/	
	function GetDBObject($tablename,$tbl_prefix=0)
	{
		global $_GLOBALSESSION;
		if(DBOBJ_CACHE==1)
			if(isset($_GLOBALSESSION["bapi"]["dbobjcache"][$tablename])) return unserialize(serialize($_GLOBALSESSION["bapi"]["dbobjcache"][$tablename]));// see if we have the object round here
		if(class_exists("T".$tablename)) $rv = eval('return new T'.$tablename.'();');
		elseif(class_exists("TDBObject")) $rv = new TDBObject($tablename,$tbl_prefix);
		else $rv = new CDBObject($tablename,$tbl_prefix);
		if(DBOBJ_CACHE==1)
			$_GLOBALSESSION["bapi"]["dbobjcache"][$tablename] = unserialize(serialize($rv));
		return $rv;
	}

//--------------------------------------------------------------------------------------------------------------------------------------------	
	function GetDBObjectList($tablename,$tbl_prefix)
	{
		if(class_exists("T".$tablename."list")) return eval('return new T'.$tablename.'list();');
		else return (new CDBObjectList($tablename,$tbl_prefix));
	}
	
//--------------------------------------------------------------------------------------------------------------------------------------------	
	function GetDBObjectList2($tablename,$tbl_prefix=0)
	{
		global $_GLOBALSESSION;
		if(DBOBJ_CACHE==1)
			if(isset($_GLOBALSESSION["bapi"]["dbobjcache"][$tablename."list"])) return unserialize(serialize($_GLOBALSESSION["bapi"]["dbobjcache"][$tablename."list"]));// see if we have the object round here
		if(class_exists("T".$tablename."list")) $rv = eval('return new T'.$tablename.'list();');
		elseif(class_exists("TDBObjectList2")) $rv = new TDBObjectList2($tablename,$tbl_prefix);
		else $rv = new CDBObjectList2($tablename,$tbl_prefix);
		
		if(DBOBJ_CACHE==1)
			$_GLOBALSESSION["bapi"]["dbobjcache"][$tablename."list"] = unserialize(serialize($rv));
		return $rv;

	}
//--------------------------------------------------------------------------------------------------------------------------------------------	
	function FetchDBObject($tablename,$ident,$field="ident")
	{
		$obj = GetDBObject($tablename);
		$obj->$field = $ident;
		$obj->DB_FetchByModel();
		return $obj;
	}
?>
<?
/*---------------------------------------------------------------------------
		File		: class.dbrelationalobject.php
		Desc		:	Implements CDBRelationalObject
		Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 21-aug-2004
		Version : 1.0
		Updates : 
---------------------------------------------------------------------------*/

/**
	Name: CDBRelationalObject
	Description: Extends CDBBaseObject with features specific to entities relations
*/

class CDBRelationalObject extends CDBBaseObject
{

	function DB_LoadLink_From($tablename)
	{
		global $_GLOBALSESSION;
		if(!isset($_GLOBALSESSION["bapi"]["db"][DB_DB][$this->tablename]["to"][$tablename])) return 0;
		$relation = $_GLOBALSESSION["bapi"]["db"][DB_DB][$this->tablename]["to"][$tablename];

		$obj = GetDBObjectList2($tablename,"");
		
		eval('$obj->'.$relation['fieldfrom'].'=$this->'.$relation['fieldto'].';');
		$obj->DB_GetObjectsMODEL();
		eval('$this->'.$tablename.'=$obj;');
		return 1;
	}
		
	function DB_LoadLink_To($tablename)
	{
		global $_GLOBALSESSION;

		if(!isset($_GLOBALSESSION["bapi"]["db"][DB_DB][$this->tablename]["from"][$tablename])) return 0;
		$relation = $_GLOBALSESSION["bapi"]["db"][DB_DB][$this->tablename]["from"][$tablename];

		$obj = GetDBObjectList2($tablename,"");
		
		eval('$obj->'.$relation['fieldto'].'=$this->'.$relation['fieldfrom'].';');
		$obj->DB_GetObjectsMODEL();
		eval('$this->'.$tablename.'=$obj;');
		return 1;
	}
		
	function DB_Delete()
	{
		if($this->swcascade)
		{
			// get all relations
			global $_GLOBALSESSION;
			$relations = $_GLOBALSESSION["bapi"]["db"][DB_DB][$this->tablename]["to"];
	
			$rk = array_keys($relations);
			for($i=0;$i<count($relations);$i++)
				if($relations[$rk[$i]]['ondelete']=='CASCADE')
				{
					$objlist = GetDBObjectList2($relations[$rk[$i]]['tablefrom'],"");
					$filterval = eval('return $this->'.$relations[$rk[$i]]['fieldto'].';');	
					eval('$objlist->'.$relations[$rk[$i]]['fieldfrom'].'='.$filterval.';');
					$objlist->DB_GetObjectsMODEL();
					$objlist->DB_Delete();			
				}
		}		
		$this->DB_DeleteA();
	}
	
	function DB_Activate($status)
	{
		if($this->swcascade)
		{
			// get all relations
			global $_GLOBALSESSION;
			$relations = $_GLOBALSESSION["bapi"]["db"][DB_DB][$this->tablename]["to"];
	
			$rk = array_keys($relations);
			for($i=0;$i<count($relations);$i++)
				if($relations[$rk[$i]]['onactivate'] == "CASCADE")
				{
					$objlist = GetDBObjectList2($relations[$rk[$i]]['tablefrom'],"");
					$objlist->active = "-123456789";
					$filterval = eval('return $this->'.$relations[$rk[$i]]['fieldto'].';');	
					eval('$objlist->'.$relations[$rk[$i]]['fieldfrom'].'='.$filterval.';');
					$objlist->DB_GetObjectsMODEL();
					$objlist->DB_Activate($status);			
				}	
		}
		$this->DB_ActivateA($status);	
		
	}
	
}

?>
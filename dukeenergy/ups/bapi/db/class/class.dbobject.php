<?
/*---------------------------------------------------------------------------
		File		: class.mysql_dbobject.php
		Desc		:	Implements CDBObject
		Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 22-aug-2004
		Version : 1.0
		Updates : 
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 12-sep-2004
		Version : 1.1
		Desc		: (+) HTTP_TranslateMS
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 16-sept-2004
		Version : 1.2
		Desc		: (+) Files upload handling => only works with LoadFromPost
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 27-sept-2004
		Version : 1.21
		Desc		: (+) CheckOwner
	-----------------------------------------------------------------------------
		Author	: none
		Created : none
		Version : none
		Desc		: none
---------------------------------------------------------------------------*/

class CDBObject extends CDBRelationalObject
{
	
	var $ownerfield; // contains the DB column that represents the user ident
									 // that owns this object... ie. ord_us_ident
	
	function CheckOwner()
	{
		global $_SESSION;
		global $noownercheck;
		if($noownercheck) return 1;
		if($_SESSION['loggedas']->us_admin) return 1;
		if(!$this->ownerfield) return 1;
		$ownerid = eval('return $this->'.$this->ownerfield.';');
		if($ownerid==$_SERVER['loggedas']->ident) return 1;
		htp('error.php');
	}
	
	function HTTP_HandleFile($field)
	{
		global $_FILES;
		global $_POST;
		if($_FILES[$field]['error']==0)
		{
			$file = join("",file($_FILES[$field]['tmp_name']));
			$_POST[$field] = $file;
		}
	}
	
	
	// Translates a POST array representing a checkbox collection or multiselect
	// to a corresponding binary representation
	function HTTP_TranslateMS($ar,$field)
	{
		$retv = "";
		GLOBAL $resources;
		$av = @array_values($resources[$field]);
		$ak = @array_keys($resources[$field]);
		$pc = 0;
		$aak = @array_keys($ar);
		for($i=0;$i<count($ak);$i++) if($ak[$i]>$pc) $pc = $ak[$i];
		$rv = str_pad("",$pc+1,"_");
		for($i=0;$i<count($ar);$i++)
			if(is_numeric($aak[$i]))
			{
				$rv[$ar[$aak[$i]]] = "1";
			}
		return $rv;
	}
	
	function HTTP_LoadFromParams($params,$clearfields=0,$loadfilter=0)
	{
		$paramsk = @array_keys($params);
		
		for($i=0;$i<$this->fieldscount;$i++)
		{

			if((@in_array($this->fields[$i],$paramsk))||($clearfields))
			{
				if($params[$this->fields[$i]]=="") $params[$this->fields[$i]] = NULL;
				eval('$this->'.$this->fields[$i].'=$params["'.$this->fields[$i].'"];');
				if((is_array($params[$this->fields[$i]]))&&(!$loadfilter))
							eval('$this->'.$this->fields[$i].'=$this->HTTP_TranslateMS($params["'.$this->fields[$i].'"],$this->fields[$i]);');
			}
		}
	}
	
	function HTTP_LoadFromPost($useget=0,$clearfields=0)
	{
		if($useget)
		{
			global $_GET;
			$params = $_GET;
		}			
		else
		{
			global $_POST;
			// now a bit of fun with the $_FILE variables
			global $_FILES;
			$fk = array_keys($_FILES);
			for($i=0;$i<count($fk);$i++) $this->HTTP_HandleFile($fk[$i]);
			$params = $_POST;
			
		}
		$this->HTTP_LoadFromParams($params,$clearfields);
	}


}

?>
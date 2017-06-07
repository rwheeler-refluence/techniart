<?
/**
*@package bapi_application
*/
/**
*EJB for variables. Defines default methods of getting and setting application variables stored in the database.
*
*@version:	1.0
*@author:	Sebastian Cristea <sebastian.cristea@bitnet.info>
Updates:
-----------------------------------------------------------------------------
Author	:	David Coman - BITNET Software - www.bitnet.info
Created : 2-may-2005
Desc	  :  Added the RegisterVariables function
-----------------------------------------------------------------------------
*/
class CVariables extends CDBObject 
{
	var $tablename = "variables";
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*Obtain the value of a database stored variable.
	*
	*@param string $name Variable name.
	*@return mixed null if the variable not found, value stored in the database if found.
	*/
	function GetVariable($name)
	{
		$this->var_name = $name;
		if($this->DB_FetchByModel())
		{
			return $this->var_value;
		}
		else return NULL;
	}
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*Sets the value of a database stored variable.
	*
	*@param string $name Variable name.
	*@param mixed $value Value to set.
	*@return int 1 on success. 0 if the variable has not been found.
	*/
	function SetVariable($name,$value)
	{
		$this->var_name = $name;
		if($this->DB_FetchByModel())
		{
			$this->var_value = $value;
			$this->DB_Update();
			return 1;
		}
		else return 0;
	}
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*Creates the constants from the database stored variables.
	*
	*@if finds the variables array in session sets the constants from there, if not reads them from the db and sets them
	*/
	function RegisterVariables()
	{
	  global $_GLOBALSESSION;
	  if(isset($_GLOBALSESSION["bapi"]["variables"]))
	  { 
        foreach ($_GLOBALSESSION["bapi"]["variables"] as $k => $v) 
        define($k , $v);    
	  }
	  else
	  { 
		$var_list = array();
	    $myvar = GetDBObjectList2("variables");
	    $myvar->DB_GetObjectsMODEL(0);
				  
	    for($i=0;$i<count($myvar->items);$i++)
	    {
	    	define($myvar->items[$i]->values["var_name"] , $myvar->items[$i]->values["var_value"]);    
		  	$var_list[$myvar->items[$i]->values["var_name"]] = $myvar->items[$i]->values["var_value"];
	    }	
        $_GLOBALSESSION["bapi"]["variables"] = $var_list;
	  }
	}
	
}
?>
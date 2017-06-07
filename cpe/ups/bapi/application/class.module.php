<?
/**
*@package bapi_application
*/
/**
*BAPI Framework page class.
*
*This class contains common code for all the BAPI Framework modules. Each
*application should use it's own CModule derived class to implement site
*specific code (TModule). That class is further derived in each php page (module) of
*the site.
*
*@version:	1.0
*@author:	Sebastian Cristea <sebastian.cristea@bitnet.info>
Updates:
-----------------------------------------------------------------------------
Author	:	
Created : 
Desc		:
-----------------------------------------------------------------------------
*/	
class CModule extends CApplication
{
	/**
	*Default action for this module (in case $action is not sent either by $_GET or $_POST
	*@var string
	*/
	var $defaultaction="ActionNotImplemented";
	/**
	*Current module action
	*@var string
	*/
	var $action;
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  */
	function Alert($string)
	{
		echo "<script>alert('".$string."');</script>";
	}  
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  */
	function Prompt($string)
	{
		echo "<script>prompt('debug output:','".$string."');</script>";
	}  
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Loads a variable from $_POST, $_GET, $_SESSION. If found, it's new value is
  *saved in $_SESSION. If not found, the default value is stored in $_SESSION.
  *The new value is returned.
	*@param 	string 	$name 		Variable name
	*@param 	mixed 	$default 	Default value
	*@param 	int 	$pagepersistent 	If set, the variable name is prefixed with a page identifier before being used in the session. This ensures that different pages can have different values for this variable.
	*@param     int 	$action		 		0- Default behaviour
											1- Only returns the stored variable, doesn't not check for it in get or post	
											2- Store and return the default value			
  *@return 	mixed	
  */
  function LoadPersistentVar($name,$default,$pagepersistent=1,$action=0)
	{
		if(!is_array($_SESSION["storevars"])) $_SESSION["storevars"] = array();
		$key = $name;
		if($pagepersistent) $key = md5($this->action." ".$this->self_filename).$key;
		
/*		if($name=="objects_ident") 
		{
			$this->Alert($this->self_filename."-".$this->action);
		}		*/
		$value = $default;
		if($action==1)
		{
			if(@array_key_exists($key,$_SESSION["storevars"]))	return  $_SESSION["storevars"][$key];
			else return $default;
		}
		if($action==2)
		{
			$_SESSION["storevars"][$key] = $default;
			return $default;
		}
		
		if(array_key_exists($name,$_REQUEST)) 
		{
			$value = $_REQUEST[$name];
			$_SESSION["storevars"][$key] = $value;
		}
		elseif(array_key_exists($name,$_POST)) 
		{
			$value = $_POST[$name];
			$_SESSION["storevars"][$key] = $value;
		}
		elseif(array_key_exists($name,$_GET))
		{
			$value = $_GET[$name];
			$_SESSION["storevars"][$key] = $value;
		}
		elseif(@array_key_exists($key,$_SESSION["storevars"]))
		{
			$value = $_SESSION["storevars"][$key];
		}
		else
		{
			$value = $default;
			$_SESSION["storevars"][$key] = $value;
		}
		return $value;
	}
//--------------------------------------------------------------------------------------------------------------------------------------------	
	function act_returntobookmark()
	{
		$bmname = getFromArrays(array($_POST,$_GET),"bookname","");
		if($bmname=="") $this->act_back();
		else $this->ReqBookmark($bmname,1);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*Action to be executed if an unimplemented action is called.
	*/
	function act_ActionNotImplemented()
	{
		echo "Sorry, this module (".get_class($this).") does not implement such an action: ($this->action)!";
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*Preprocess script input. Currently just removing browser generated \' and \\ from $_GET and $_POST. Add further processing and filtering as needed.
	*/
	function PreProcessInput()
	{
		// first clear \' from $_POST and $_GET
		$_REQUEST = removesq($_REQUEST);
		$_POST = removesq($_POST);
		$_GET = removesq($_GET);

		$_REQUEST = utf8_encode_array($_REQUEST);
		$_POST = utf8_encode_array($_POST);
		$_GET = utf8_encode_array($_GET);
		$_FILES = utf8_encode_array($_FILES);
		
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*Runs the current module. Detects the action from $_POST or $_GET, then calls the 
	*header, the current action and the footer.
	*/
	function Run()
	{
		$this->PreProcessInput();
		if(array_key_exists("nexturl",$_REQUEST)) $this->nexturl = $_REQUEST["nexturl"];
		if(isset($_POST["action"]))			$this->action = $_POST["action"];
		elseif(isset($_GET["action"])) 	$this->action = $_GET["action"];
		else $this->action=$this->defaultaction;
		if(!method_exists($this,"act_$this->action")) return $this->act_ActionNotImplemented();
		// run the sucker

		$this->Header();
		$action = "act_".$this->action;
		$this->$action();
		$this->Footer();
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Action common to all modules. Back 1 page on the request stack.
  *@return null
  */
	function act_back()
	{
		if($_GET["count"]) $count = $_GET["count"]+1;
		else $count = 2;
		$this->Back($count);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Common paging code. Responsable for saving and restoring paging data in the session and 
  *generating template variables.
  *NOT YET IMPLEMENTED!!!
  */
	/*function GeneratePages($itemscount,$itemsperpage)
	{
		/*		$sesindex = md5($_ENV["PATH_TRANSLATED"]);
	
		$pagescount = ($itemscount)/$itemsperpage;
		
		if($_GET["page"]=="") $_GET["page"] = $_SESSION[$sesindex."page"];	else $_SESSION[$sesindex."page"]=$_GET["page"];
		if($_GET["orderby"]=="") $_GET["orderby"] = $_SESSION[$sesindex."orderby"];	else $_SESSION[$sesindex."orderby"]=$_GET["orderby"];
		if($_GET["orderdir"]=="") $_GET["orderdir"] = $_SESSION[$sesindex."orderdir"];	else $_SESSION[$sesindex."orderdir"]=$_GET["orderdir"];
		if($_GET["page"]=="") $_GET["page"] = 1;
		if($pagescount!=floor($pagescount)) $pagescount=floor($pagescount)+1;
		$page = $_GET["page"]-1;
		if($page==-1) $page = 0;
		$pages = array();
		for($i=1;$i<=$pagescount;$i++) $pages[$i]=$i;
		$sm->assign("pages",$pages);
		$sm->assign("page",$page+1);
	}*/
	
	function GeneratePages($itemscount,$itemsperpage,$pagesnb=0)
	{
		$page = $this->LoadPersistentVar("page",0,1);//getFromArrays(array($_POST,$_GET),"page","0");
		$pagescount = $itemscount/$itemsperpage;
		if(!$page) $page = 1;
		if($pagescount!=floor($pagescount)) $pagescount=floor($pagescount)+1;
		$page = $page-1;
		
		if($page>$pagescount) $page = 0;
		$pages = array();
		
		$sta_page=1;
		$end_page=$pagescount;
		
		if($pagesnb)
		{
			$leftpages = floor(($pagesnb-1)/2);
			$rightpages = $pagesnb-1-$leftpages;
			
			$pag1 = $page+1;
			
			$ad_down = $leftpages+1-$pag1;
			if($ad_down<1) $ad_down = 0;
		
			$ad_up = $pag1+$rightpages-$pagescount;
			if($ad_up<1) $ad_up = 0;
		
		
			$sta_page = $pag1-$leftpages-$ad_up;
			$end_page = $pag1+$rightpages+$ad_down;
			if($sta_page<1) $sta_page = 1;
			if($end_page>$pagescount) $end_page=$pagescount;
		}
		for($i=$sta_page,$k=$i;$i<=$end_page;$i++) $pages[$i-$k+1]=$i;
		$this->TPL_Assign("pages",$pages);
		$this->TPL_Assign("page",$page+1);
		$this->TPL_Assign("pagescount",$pagescount);
		//-----
		$this->TPL_Assign("itemscount",$itemscount);
		$this->TPL_Assign("start",$sta_page*$itemsperpage+1);
		$this->TPL_Assign("end",$end_page*$itemsperpage);
		//----
		return $page;
	}
}
?>
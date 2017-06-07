<?
/**
*@package bapi_application
*/
/**
*BAPI Framework application class.
*
*This class contains code common to all BAPI Framework sites. Each site should
*have it's own CApplication derived class for adding site specific code. That
*class has to be named TApplication.
*
*Also util functions that could not be used as class members.
*
*@version:	1.1
*@author:	Sebastian Cristea <sebastian.cristea@bitnet.info>
Updates:
-----------------------------------------------------------------------------
Author	:	David Coman - BITNET Software - www.bitnet.info
Created : 2-may-2005
Desc	: added the InitGlobalSession function
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 13-aug-2005
Version : 1.1
Desc		: (+) UTF8 decoding output filter 
---------------------------------------------------------------------------
-----------------------------------------------------------------------------
*/
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Registered output filter that utf8 decode
*/
function smarty_output_utf8_decode($tpl_output, &$smarty)
{
    //$tpl_output = utf8_decode($tpl_output);
    //return $tpl_output."<script>loaded=1;</script>";
}
class CApplication extends CObject 
{
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	// PRIVATE
	/**
	*Used in Footer to know if this is a 'normal' run or a redirection cleanup
	*@var int
	*/
	var $redirected=0;
	/**
	*Template handler
	*@var smarty
	*@private
	*/
	var $tpl;					
	/**
	*Language
	*@var string
	*@private
	*/
	var $lang="en";					
	/**
	*Messages array
	*@var array
	*@private
	*/
	var $messages;
	/**
	*Resources array
	*@var string
	*@private
	*/
	var $resources;
	/**
	*Execution start time
	*@var int
	*@private
	*/
	var $starttime;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*Application name
	*@var string
	*/
	var $name;					
	/**
	*Search path, if using a database that supports schemas
	*@var string
	*/
	var $db_searchpath;					
//--------------------------------------------------------------------------------------------------------------------------------------------
	// RUNTIME
	/**
	*Page content
	*@var string
	*/
	var $content="";			
	/**
	*Page title
	*@var string
	*/
	var $title;
	/**
	* Request stack id
	*/
	var $requestuid = 0;
	/**
	*Set to 1 if no database connection is needed for this page
	*@var int
	*/
	var $nodb=0;
	/**
	*Set to 1 if no session access is needed in this page
	*@var int
	*/
	var $nosession=0;			
	/**
	*Set to 1 if you don't want to use any templates
	*@var int
	*/
	var $notemplates=0;		
	/**
	*Set to 1 if you don't want to use global session
	*@var int
	*/
	var $nogs=0;					
	/**
	*Set to 1 if you don't want any wrapper to be displayed
	*@var int
	*/
	var $nowrap=0;			
	/**
	*Set to 1 if you don't want this page to be stored on the request stack
	*@var int
	*/
	var $nosaverequest=0;			// don't add this to the request stack
	/**
	*Set to 1 if you're using the default CheckLogin and need the user to be 
	*logged in in order to see this page
	*@var int
	*/
	var $loginreq=0;				// login is required to view this page
	/**
	*Set to 1 if you're using the default CheckLogin and need the user to be 
	*logged in with an admin account in order to see this page
	*@var int
	*/
	var $adminreq=0;				// admin section
	/**
	*Array of actions that require login
	*@var array
	*/
	var $actionswithlogin=array();
	/**
	*Array of actions that require admin login
	*@var array
	*/
	var $adminactions=array();
	/**
	*Url of the login page
	*@var string
	*/
	var $loginurl = "users.php?action=login";
	/**
	*File being executed
	*@var string
	*/
	var $self_filename;
	/**
	*Wrapper to be used by the default GetWrapper() method for the admin pages 
	*@var string
	*/
	var $adminwrapper = "admin/wrapper.tpl";
	/**
	*Wrapper to be used by the default GetWrapper() method for all but the admin pages
	*@var string
	*/
	var $defaultwrapper = "wrapper.tpl";
//--------------------------------------------------------------------------------------------------------------------------------------------
	// GLOBAL SESSION VARIABLES	
	/**
	*Global session handler
	*@var CSHMGlobalSession
	*/
	var $gs;						// handler
	/**
	*Global session block size
	*@var int
	*/
	var $gs_blocksize=1024;		// block size
	/**
	*Global session shm key. Should be unique per application
	*@var int
	*/
	var $gs_key=0xff1;			// key
	/**
	*Total memory to allocate for the global session
	*@var int
	*/
	var $gs_memsize=8388608;		// total size to allocate
//--------------------------------------------------------------------------------------------------------------------------------------------
	// DEBUGGING	
	/**
	*Error reporting level: 
	*								 0 - Stop on fatal, no details
	*								 1 - Show FATAL, ERROR, WARNING, details
	*								 2 - Same as 1 but with debug output
	*								 3 - All
	*@var int
	*/
	var $errorlevel=0;			
	/**
	*Set to 1 to enable benchmarking and statistics gathering
	*var int
	*/
	var $benchmarking=0;
	/**
	*Behnchmark module
	*@var CBenchMark
	*/
	var $bm_module;

//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Constructor
	*@param 	string	$name	Application name
  *@return	null
  */
  function CApplication($name)
	{
		$this->name 			= $name;
		global $DEBUG;
		if($this->errorlevel>1) $DEBUG=1;
		$this->self_filename = $_SERVER["SCRIPT_FILENAME"];
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE
  *Checks whether the user is logged in
  *@return bool		
  */
	function IsLoggedIn()
	{
		if($_SESSION["loggedas"]->ident) return true;
		return false;
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE
  *Prints a default Error Message in case of $errorlevel=0 and fatal error
  *@return null
  */
	function ErrorMessageHeader()
	{
		return '
				<B>'.SITETITLE.' encountered an error interpreting your request and can not continue.</B><br><br>
				Please <a href="?action=back">go back</a> and try again. If the error persists, please contact
				our support department.<br>
				';
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE
  *Error handler callback function. See set_error_handler() in the PHP docs.
  */
	function ErrorHandler($errno, $errstr, $errfile, $errline, $errcontext) 
	{
		if(($errno==FATAL)&&($this->errorlevel==0))
		{
			$this->content = $this->ErrorMessageHeader();
			$this->Footer();
			exit(0);
		}
		if(
		((($errno==FATAL)||
		($errno==ERROR)||
		($errno==WARNING))&&($this->errorlevel==1))
		||($this->errorlevel==3))
		{
			if($errno==FATAL) $et = "FATAL";
			elseif($errno==FATAL) $et = "ERROR";
			elseif($errno==FATAL) $et = "WARNING";
			else $et = "UNKNOWN";
			$de="<br>
				<B>Type:</B> ".$et."<br>
				<B>Message:</B> $errstr<br>
				<B>File:</B> $errfile<br>
				<B>Line:</B> $errline<br>
				<b>Context:</b>".print_rt($errcontext,1);
			echo $de;
			if($errno==FATAL) 
			{
				$this->Footer();
				exit(1);
			}
		}
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Initializes the benchmark module
  *@private
  */
	function BM_Init()
	{
		bapi_modules_load("class.benchmark.php");
		$this->bm_module = new CBenchMark();
		if($this->benchmarking==2) $this->bm_module->savetodb=1;
		$this->bm_module->dbeng = USEDBENGINE;
		$this->bm_module->Header();
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Closes the benchmark module
  *@private
  */
	function BM_Close()
	{
		$this->bm_module->Footer();
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Sets the errorhandler function
  *@return null
  *@private
  */
	function SetErrorHandler()
	{
		// redefine the user error constants - PHP 4 only
		define("FATAL", E_USER_ERROR);
		define("ERROR", E_USER_WARNING);
		define("WARNING", E_USER_NOTICE);
		// set the error reporting level for this script
		error_reporting(FATAL | ERROR | WARNING);
		set_error_handler(array(&$this, 'ErrorHandler'));
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE - If you want to use a different global session handler than 
  *the default (file+shm)
  *Initializes the global session
  *@return null
  */
	function InitGlobalSession()
	{
		/* OLD STYLE
		The GLOBALSESSION array should only be used in scenarios
		where the data stored DOES NOT CHANGE (you only add to the session,
		there are no updates or deletes of the already stored data).
		This method is completely undeterministic. There is no guarantee that
		your changes will actually be saved and seen by other scripts.
		The advantage however is that reading data that actually got stored
		is very fast.
		
		Only use this when all the scripts need to store the same oftenly
		accessed data. It might not get stored for a while if there is a
		high load, but as each script will atempt to store it, it will 
		ultimatelly get stored (usually run a *special* script to create
		this array at first), and reading it will be quite fast afterwards.
		
		Access time is proportional to the size, so keep it small.
		
		We need to load it if we have database, even if nogs.
		
		TODO: Will have to probably extend the checks to query caching, which
		will need shm.
		*/
		if(($this->nogs!=1)&&($this->nodb!=1))
		{
			global $_GLOBALSESSION;
			$gss = @join(@file(SESSIONSAVEPATH."/".SITETITLE."globalsession"));
			$_GLOBALSESSION = unserialize($gss);
		}		
		/* Regular Handler
		*/
/*		if(!$this->nogs)	
		{	
			$this->gs = new CSHMGlobalSession();
			$this->gs->Open($this->gs_key,$this->gs_memsize,$this->gs_blocksize);
		}*/
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OWERWRITE - If you want to use a different global session handler than 
  *the default (file+shm)
	*Closes the global session
  *@return null
  */
	function CloseGlobalSession()
	{
		/*FILE
		*/
		global $_GLOBALSESSION;
		$fp = @fopen(SESSIONSAVEPATH."/".SITETITLE."globalsession","w+");
		@fwrite($fp,serialize($_GLOBALSESSION));
		@fclose($fp);
		/*Regular 
		*/
		//$this->gs->Close();
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Stores the login in cookies. 
  *
  *Uses cookies to store the username and the password hash
  *@return null
  */
	function RememberLogin()
	{
		
		if((!$this->IsLoggedIn())&&($_COOKIE["storedlogin"]==1))
		{// not logged, but remembered login
			$_SESSION["loggedas"] = GetDBObject("users");
			$_SESSION["loggedas"]->us_username = $_COOKIE["storedusername"];
			$_SESSION["loggedas"]->DB_FetchByModel();
			
			if(md5($_SESSION["loggedas"]->us_password)!=$_COOKIE["storedpassword"])
			{// bad login
				
				$_SESSION["loggedas"] = 0;
				setcookie("storedlogin",0,time()+LOGINREMEMBER);
				setcookie("storedusername",0,time()+LOGINREMEMBER);
				setcookie("storedpassword",0,time()+LOGINREMEMBER);
			}
		}	
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Bookmarks the cuurent request in the session. Use this if you want to easily return to
  *the current page at a later time.
	*@param		string	$name	Name/Indetifier of the bookmark
	*@param		int		$action	Use 0(default) to store the request. Use 1 to go to the bookmarked page.
  *@return
  */
	function ReqBookmark($name,$action=0,$back=0,$request=0)
	{
		if($action==0)
		{
			if(is_array($request)) BapiBookmark($name,0,$request);
			elseif($back)
			{
				$request = $_SESSION["requeststack"][count($_SESSION["requeststack"])-$back-1];
				BapiBookmark($name,0,$request);
			}
			else BapiBookmark($name,0);
		}
		else		BapiBookmark($name,$action,$back,$request);

	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE
  *Searches the actionswithlogin and adminactions arrays and sets loginreq resp adminreq. If the action
  *is not found in the arrays, loginreq and adminreq are not changed.
  *@return null
  */
	function BeforeCheckLogin()
	{
		if(in_array($this->action,$this->actionswithlogin)) $this->loginreq = 1;
		if(in_array($this->action,$this->adminactions)) $this->adminreq = 1;
	}	
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE
  *Checks the login status. By default it only checks for basic login and admin login ($loginreq and $adminreq).
  *Overwrite if you need to check for more access areas.
  *If the area conditions are not met, it redirects the user to the login page.
  *@return null
  */
	function CheckLogin()
	{
		
		$this->BeforeCheckLogin();
		if($this->loginreq) 
			if(!$_SESSION["loggedas"]->ident)
			{	
				$this->ReqBookmark("loginreturn");
				$_SESSION["loginredirect"] =1;
				$this->HeadTo($this->loginurl);
			}
		if(($this->adminreq==1)&&($_SESSION["loggedas"]->us_admin!=1))
			$this->HeadTo($this->loginurl);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Initializes the templates system. Overwrite if using some other templates system
  *than Smarty.
  *@return null
  */
	function InitTemplates()
	{
		$this->tpl = new Smarty();
		smarty_register_string_tpl($this->tpl); // so we can use string:abc style templates
//		$this->tpl->register_outputfilter("smarty_output_utf8_decode");
		
		$this->tpl->template_dir 	= SMARTY_TEMPLATEBASE;
		$this->tpl->compile_dir 	= SMARTY_COMPILE;
		$this->tpl->config_dir 	= SMARTY_CONFIG;
		$this->tpl->cache_dir 	= SMARTY_CACHE;	
		
		if(array_key_exists("error",$_POST))	$this->TPL_Assign("error",$_POST["error"]);
		elseif(array_key_exists("error",$_GET))	$this->TPL_Assign("error",$_GET["error"]);
		
		
		$this->TPL_Assign("_post",$_POST);
		$this->TPL_Assign("_get",$_GET);
		$this->TPL_Assign("_cookie",$_COOKIE);
		$this->TPL_Assign("_request",$_REQUEST);
		$this->TPL_Assign("_session",unserialize(serialize($_SESSION)));
		$this->TPL_Assign("_resources",$this->resources);
		$this->TPL_Assign("_const",get_defined_constants());
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Sets and changes the current language.
  *@return null
  */
	function GetLanguage()
	{
		return $this->lang;
	}

//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Sets and changes the current language.
  *@return null
  */
	function SetLanguage()
	{
		if(isset($_GET['set_lang'])) 			$_SESSION['sess_lang'] = $_GET['set_lang'];
		if(isset($_POST['set_lang'])) 		$_SESSION['sess_lang'] = $_POST['set_lang'];
		if(isset($_SESSION['sess_lang']))		$this->lang = $_SESSION['sess_lang'];
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Saves the current request in the request stack.
  *@return null
  */
	function SaveRequest()
	{
		// save current request and last request
		$currentrequest = array();
		$currentrequest["post"] = $_POST;
		$currentrequest["uid"] = md5(microtime(1).print_r($_POST,1).print_r($_GET,1));
		if(isset($_ENV["REQUEST_URI"]))	$currentrequest["uri"] = $_ENV["REQUEST_URI"];
		else $currentrequest["uri"] = $_SERVER["REQUEST_URI"];
		if(!isset($_SESSION["requeststack"]))$_SESSION["requeststack"]=array();
		array_push($_SESSION["requeststack"],$currentrequest);
		$this->requestuid = $currentrequest["uid"];
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE
  *Header function. Performs common module startup actions. Most of these actions can be controled
  *through the '$no' variables. Eg: $nosession or $nodb etc.
  *Overwrite to add more code to be executed before each page loads.
  *@return null
  */
	function Header()
	{
		global $_GLOBALSESSION;
		 
		$this->starttime = microtime(1);
		/*ERROR HANDLING
		*/
		$this->SetErrorHandler();
		/*IMPLICIT BUFFERING
		*/
		ob_start();
		/*BENCHMARKING
		*/
		if($this->benchmarking) $this->BM_Init();
		/*Defines
		*/
		$this->DefineMessages();
		$this->DefineResources();
		/*DATABASE
		*/
		if($this->nodb!=1) 
		{
			b_ctdb();
			if($this->db_searchpath)
				b_query("set search_path to $this->db_searchpath");
		}
		/*SESSION
		*/		
		if($this->nosession!=1)
		{
		session_save_path(SESSIONSAVEPATH);
		session_start();
		if(MFSESSION==1)	session_write_close();
		}
		/*GLOBAL SESSION
		*/
		$this->InitGlobalSession();
		/*SETS THE SITE CONSTANTS
		*/
		$this->LoadVariables();
		/*REFRESH USER DATA
		*/ 
		if(!$this->nosession)	if(is_a($_SESSION["loggedas"], 'CDBObject')) if($_SESSION["loggedas"]->ident!=$_SESSION["loggedas"]->delim)$_SESSION["loggedas"]->DB_Fetch();
		/* REMEMBER LOGIN
		*/
		
		if(!$this->nosession)	$this->RememberLogin();
		/*BACK FUNCTION
		*/
		if($this->nosaverequest!=1) $this->SaveRequest();
		/*LANGUAGES
		*/
		$this->SetLanguage();
		/*INIT TEMPLATES
		*/	
		if(!$this->notemplates) $this->InitTemplates();	
		/*LOGIN CHECK
		*/		
		if(!$this->nosession) $this->CheckLogin();

	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Sets the site constants.
  */
	function LoadVariables()
	{ global $_GLOBALSESSION;
		if(($this->nosession!=1)&&($this->nodb!=1))
		{
			$site_vars = new CVariables();
			$site_vars->RegisterVariables();
		}		
	}	
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Obtains the page title.
  *@return string
  */
	function GetTitle()
	{
		if($this->title) return $this->name." : ".$this->title;
		else return $this->name;
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE
  *Returns the wrapper template to use for this page. By default it uses
  *the normal and the admin wrapper out of which it chooses based on the
  *$adminreq variable. Overwrite to use more wrappers.
  *@return string
  */
	function GetWrapper()
	{
		if(!$this->adminreq)
			return $this->defaultwrapper;
		else
			return $this->adminwrapper;
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE
  *Performs common end of script tasks. Overwrite if you need more stuff
  *performed after each script runs. You'll probably want to overwrite it
  *especially if you have also extended the header() function.
  *@return null
  */
	function Footer()
	{
		if(!$this->redirected)// if true, we were redirected from a HeadTo function, so only do cleanup stuff
		{
			if($this->nexturl) $this->HeadTo($this->nexturl);
			elseif(!$this->notemplates)
			{
				if(!($this->nowrap))
				{
					$this->TPL_Assign("_post",$_POST);
					$this->TPL_Assign("_get",$_GET);
					$this->TPL_Assign("_cookie",$_COOKIE);
					$this->TPL_Assign("_request",$_REQUEST);
					
					$this->TPL_Assign("_session",unserialize(serialize($_SESSION)));
					$this->TPL_Assign("_resources",$this->resources);
					$this->TPL_Assign("_const",get_defined_constants());
					
					
					$this->TPL_Assign("content",$this->content);
					//--------------------------------
					
					$this->TPL_Assign("title",$this->GetTitle());
					//--------------------------------
					$this->TPL_Assign("random",rand(0,100000));
					//--------------------------------
					$display = utf8_decode($this->TPL_fetch($this->GetWrapper()));
					echo $display;
				}
				else
					echo utf8_decode($this->content);
			}
			if($this->errorlevel==2) 
			{
				global $debug_db;
				echo "<pre>";
				echo "<h1>Database degbug</h1><br>".$debug_db;
				echo "<h1>POST variables</h1><br><pre>".print_r($_POST,true)."</pre>";
				echo "<h1>GET variables</h1><br><pre>".print_r($_GET,true)."</pre>";
				echo "<h1>SESSION variables</h1><br><pre>".print_r($_SESSION,true)."</pre>";
				echo "<h1>COOKIE variables</h1><br><pre>".print_r($_COOKIE,true)."</pre>";
				echo "<h1>FILE variables</h1><br><pre>".print_r($_FILES,true)."</pre>";
				echo "<h1>ENVIRONMENT variables</h1><br><pre>".print_r($_ENV,true)."</pre>";
				echo "<h1>SERVER variables</h1><br><pre>".print_r($_SERVER,true)."</pre>";
				echo "<h1>REQUEST variables</h1><br><pre>".print_r($_REQUEST,true)."</pre>";
				echo "page generation :".(microtime(1)-$this->starttime);
				echo "</pre>";
			}
		}
		if((!$this->nosession)&&(MFSESSION==1))
		{
		$os = $_SESSION;
		session_start();
		$_SESSION = $os;
		session_write_close();
		}
		/*GLOBAL SESSION
		*/
		$this->CloseGlobalSession();
		/*BENCHMARKING
		*/
		if($this->benchmarking) $this->BM_Close();
		/*DISPLAY
		*/
		if(!$this->redirected)
		ob_end_flush();
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Returns a string consisting of the processed template sent as a resource.
  *See the fetch method in Smarty for more information.
	*@param 	string	$resource	Template resource
  *@return string
  */
	function TPL_Fetch($resource)
	{
		$this->tpl_assign("Application",$this);
		
		return $this->tpl->fetch($this->lang."/".$resource);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Same as TPL_Fetch, but it prints the result. See the display method in Smarty
  *for more information.
	*@param 	string	$resource	Template resource
  *@return bool
  */
	function TPL_Display($resource)
	{
		return $this->tpl->display($this->lang."/".$resource);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Assign a variable to the template. See the assign method in Smarty for more
  *information.
	*@param		string	$var		Name of the variable to assign.
	*@param		mixed		$value	Value to assign
  *@return
  */
	function TPL_Assign($var,$value)
	{
		return $this->tpl->assign($var,$value);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Send an email. Include a %s in the resource, that will be replaced with body.tpl, subject.tpl and headers.tpl to obtain the 3 corresponding fields.
  *information.
	*@param		string 		$resource 	Base resource name
	*@param		string		$email 		Recepient's Email
  *@return
  */	
	function TPL_Mail($resource,$email)
	{
		$body 	 = $this->TPL_Fetch(sprintf($resource,"body.tpl"));
		$subject = $this->TPL_Fetch(sprintf($resource,"subject.tpl"));
		$headers = $this->TPL_Fetch(sprintf($resource,"header.tpl"));
		
		
		return mail($email,$subject,$body,$headers);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Goes to a request stack entry 
	*@param	int	$reqback	Request stack entry
  *@return	null
  */
	function RequestStackGo($reqback)
	{
		if(count($reqback["post"]))
		{
			$_POST = $reqback["post"];
			$this->PostTo($reqback["uri"],array(),array(),1);
		}
		else $this->HeadTo($reqback["uri"]);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Goes to a request stack entry specified by $uid
	*@param	string	$uid	UID of the entry to go to
  *@return	null
  */
	function RequestStackGoUID($uid,$adduri=0)
	{
		for($i=count($_SESSION["requeststack"])-1;$i>=0;$i--)
		{
			if($_SESSION["requeststack"][$i]["uid"]==$uid)
			{
				$reqback = $_SESSION["requeststack"][$i];
				break;
			}
		}
		if($adduri) 
			if(strpos($reqback["uri"],"?")===false)
				$reqback["uri"].="?".$adduri;
		else
			$reqback["uri"].="&".$adduri;
/*		print_rt($reqback);
		print_rt($_SESSION["requeststack"]);
		die($uid);*/
		return $this->RequestStackGo($reqback);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Returns $count pages back on the request stack.
	*@param	int	$count	How many pages to go back.
  *@return	null
  */
	function Back($count=1)
	{
		if($count<1) $count = 1;
		$reqback = array_pop($_SESSION["requeststack"]);
		for($i=0;$i<$count;$i++)
			$reqback = array_pop($_SESSION["requeststack"]);
		$this->RequestStackGo($reqback);
	}	
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE *** You should always overwrite this method to define your application's resources.
  *Define resources.
  *@return null.
  */
	function DefineResources()
	{
		$this->resources = array();
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *OVERWRITE *** You should always overwrite this method to define your application's messages and errors.
  *@return null
  */
	function DefineMessages()
	{
		$this->messages = array();
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Get a message in the current language.
	*@param	string	$id	Message identifier. Key in the $messages array created in the DefineMessages() method.
  *@return mixed
  */
	function GetMessage($id)
	{
		return $this->messages[$this->lang][$id];
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Silently redirects the browser to another page using the location header.
	*@param	string	$url	Destination address.
	*@param	integer	$post	Set to 1 if you want the $_POST array included as get parameters to the destination page.
	*@param	integer	$get	Same as $post, but uses $_GET
	*@param	array		$params	Pass an associative array to use in the same way as the above $post and $get params.
  *@return null
  */
	function HeadTo($url,$post=0,$get=0,$params=0)
	{
		$this->redirected = 1;
		$this->Footer();
		htp($url,$post,$get,$params);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
  /**
  *Redirects the browser to another page by making a post operation. (Actually 
  *outputs a form and silently submits it).
	*@param	string	$target 	Destination address.
	*@param	array		$headers	Array containing the names of the inputs.
	*@param	array		$values	Values corresponding to the $headers array. Eg. $headers = array("abc","def"), $values=array(1,2) will result in $_POST=array("abc"=>1,"def"=>2).
	*@param	integer	$usep		Also add all the variables present in the current $_POST array to the request.
  *@return null
  */
	function PostTo($target,$headers,$values,$usep=0)
	{
		$this->redirected = 1;
		$this->Footer();
		PostTo($target,$headers,$values,$usep);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*See CBenchMark::Zone
	*@param string $zone Zone name
	*/
	function BM_Zone_Enter($zone)
	{
		if($this->benchmarking) $this->bm_module->Zone($zone,0);
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
	/**
	*See CBenchMark::Zone
	*@param string $zone Zone name
	*/
	function BM_Zone_Exit($zone)
	{
		if($this->benchmarking) $this->bm_module->Zone($zone,1);
	}
	
}
?>
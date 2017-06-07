<?
/**
*Miscelaneous functions.
*@package bapi
*@version:	1.21
*@Author	:	Sebastian Cristea <sebastian.cristea@bitnet.info>
*@created 30-nov-2003
Updates:
-----------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 7-jan-2004
Version : 1
Desc		: Added bapi_crypt and bapi_descrypt functions
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 21-apr-2004
Version : 1.1
Desc		: (+) arraytoini
					(+) added initoarray
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 29-apr-2004
Version : 1.11
Desc		: changes to array to ini - bug fix to process elements first, child arrays later  
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 10-jul-2004
Version : 1.12
Desc		: (+) YesNoToInt, GetSLD, GetTLD, SplitIni 
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 17-aug-2004
Version : 1.13
Desc		: (+) CheckValidEmail
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 23-aug-2004
Version : 1.14
Desc		: (+) htp
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 1-sept-2004
Version : 1.15
Desc		: (+) ComposeGet
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 17-sept-2004
Version : 1.16
Desc		: (+) GetImageResizeB 
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 13-oct-2004
Version : 1.16
Desc		: (+) html_activate_links 
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 19-oct-2004
Version : 1.17
Desc		: (+) bdie
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 1-feb-2005
Version : 1.18
Desc		: (+) StartOfMonth
					(+) EndOfMonth
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 4-mar-2005
Version : 1.19
Desc		: (+) myarray_combine - useful for <php5
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 17-mar-2005
Version : 1.20
Desc		: (~) bdie now checks for MFSESSION
---------------------------------------------------------------------------
Author	: Ionut Cornea - BITNET Software - www.bitnet.info
Created : 24-mar-2005
Version : 1.21
Desc		: (+) getFromArrays
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 31-mar-2005
Version : 1.22
Desc	: (+) Format storage
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 26-sept-2005
Version : 1.23
Desc	: (+) mkdirR
---------------------------------------------------------------------------
Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
Created : 3-nov-2005
Version : 1.24
Desc	: (+) GenCalendarDays
---------------------------------------------------------------------------*/

//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function mkdirR($strPath, $mode = 0777) 
{
   return is_dir($strPath) or ( mkdirR(dirname($strPath), $mode) and mkdir($strPath, $mode) );
}
//--------------------------------------------------------------------------------------------------------------------------------------------
function GenCalendarDays($date=0)
{
	if(!$date) $date = time();
	$day = date("j",$date);
	$month = date("n",$date);
	$year = date("Y",$date);
	$nodays = date("t",$date);
	
	$rv = array();
	$line = array();
	for($i=0;$i<date("w",mktime(1,1,1,$month,1,$year));$i++) $line[$i] = array("day"=>0,"time"=>"");
	for($i=1;$i<=$nodays;$i++)
	{
		$mkt = mktime(1,1,1,$month,$i,$year);
		$dow = date("w",$mkt);
		$line[$dow] = array("day"=>$i,"time"=>$mkt);
		if($dow==6)// end of week
		{
			$rv[] = $line;
			$line = array();
		}
	}
	
	if(count($line)) 
	{
		for($i=count($line);$i<7;$i++)
			$line[$i] = array("day"=>0,"time"=>"");
		$rv[] = $line;
	}
	return $rv;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*Saves a variable (array, string, object etc) to a file
*@param string $filename Destination file
*@param mixed $var Variable to save
*@param int $text If set, the variable must be an array and will be saved one entry/new line in the file
*@param int $weol Windows end of line. If set use \r\n as end of line, else just \n.
*@return int 1 on success, 0 on failure
*/
function var_savetofile($filename,$var,$text=0,$weol=0,$serialize=1)
{
	if($weol)
		$eol = "\r\n";
	else
		$eol = "\n";
	$fp = fopen($filename,"w");
	if($fp===false) return 0;
	if(!$text)
	{
		if($serialize) $var = serialize($var);
		fwrite($fp,$var);
	}
	else
	{
		fwrite($fp,join($eol,$var));
	}
	fclose($fp);
	return 1;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*Loads a variable (array, string, object etc) from a file
*@param string $filename
*@param int $text If set, the file must contain an array and will be loaded one entry/new line in the file
*@param int $weol Windows end of line. If set use \r\n as end of line, else just \n.
*@return mixed null on failure, variable saved in the file on success
*/
function var_loadfromfile($filename,$text=0,$weol)
{
	if($weol)
		$eol = "\r\n";
	else
		$eol = "\n";
	$fp = fopen($filename,"r");
	if($fp===false) return 0;
	$rv = fread($fp,filesize($filename));
	if(!$text)
		$rv = unserialize($rv);
	else $rv = explode($eol,$rv);
	fclose($fp);
	return $rv;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function FormatStorage($bytes)
{
	if($bytes>=1024*1024*1024*1024) $bytes = (round($bytes/(1024*1024*1024*10.24))/100)." TB";
	elseif($bytes>=1024*1024*1024) $bytes = (round($bytes/(1024*1024*10.24))/100)." GB";
	elseif($bytes>=1024*1024) $bytes = (round($bytes/(1024*10.24))/100)." MB";
	elseif($bytes>=1024) $bytes = (round($bytes/(10.24))/100)." KB";
	elseif($bytes>=1024) $bytes = $bytes." B";
	return $bytes;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function getFromArrays($array,$var_name,$def_val=NULL)
{
	$rv = NULL;
	for($i=0;$i<count($array)&&(is_null($rv));$i++)
		$rv = $array[$i][$var_name];
	if(!isset($rv)) $rv=$def_val;
	return $rv;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function myarray_combine($keys,$data)
{
	$rv = array();
	for($i=0;$i<count($keys);$i++)
		$rv[$keys[$i]]=$data[$i];
	return $rv;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function BapiBookmark($name,$action=0,$request=0)
{
	global $_POST;
	global $_ENV;
	if(!isset($_SESSION["bapibookmarks"])) $_SESSION["bapibookmarks"] = array();
	if($action==0)// save
	{
		if(!$request)
		{
			$request = array();
			$request["post"] = $_POST;
			if(isset($_ENV["REQUEST_URI"]))	$request["uri"] = $_ENV["REQUEST_URI"];
			else $request["uri"] = $_SERVER["REQUEST_URI"];
		}
		$_SESSION["bapibookmarks"][$name] = $request;
	}
	else
	{// go to
	
		$reqback = $_SESSION["bapibookmarks"][$name];

		if($action==1)
		{
			if(count($reqback["post"]))
			{
				$_POST = $reqback["post"];
				PostTo($reqback["uri"],array(),array(),1);
			}
			else htp($reqback["uri"]);
		}
		else 
		{
			print_rt($reqback);
		}
	}
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function utf8_decode_array($a)
{
	if(is_array($a))
	{
		$ak = array_keys($a);
		for($i=0;$i<count($ak);$i++)
			$a[$ak[$i]] = utf8_decode_array($a[$ak[$i]]);
	}
	elseif(is_object($a))
	{
		$vars = get_object_vars($a);
		$varsk = array_keys($vars);
		for($i=0;$i<count($varsk);$i++)
			$vars[$varsk[$i]] = utf8_decode_array($vars[$varsk[$i]]);
		for($i=0;$i<count($varsk);$i++)
			eval('$a->'.$varsk[$i].'=$vars[$varsk[$i]];');
	}
	else 
	{
		$a = utf8_decode($a);
	}
	return $a;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function utf8_encode_array($a)
{
	if(is_array($a))
	{
		$ak = array_keys($a);
		for($i=0;$i<count($ak);$i++)
			$a[$ak[$i]] = utf8_encode_array($a[$ak[$i]]);
	}
	elseif(is_object($a))
	{
		$vars = get_object_vars($a);
		$varsk = array_keys($vars);
		for($i=0;$i<count($varsk);$i++)
			$vars[$varsk[$i]] = utf8_encode_array($vars[$varsk[$i]]);
		for($i=0;$i<count($varsk);$i++)
			eval('$a->'.$varsk[$i].'=$vars[$varsk[$i]];');
	}
	else 
	{
		$a = utf8_encode($a);
	}
	return $a;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function removesq($a)
{
	if(is_array($a))
	{
		$ak = array_keys($a);
		for($i=0;$i<count($ak);$i++)
		$a[$ak[$i]] = removesq($a[$ak[$i]]);
	}
	else 
	{
		$a = str_replace("\'","'",$a);
		$a = str_replace('\"','"',$a);
		$a = str_replace("\\\\","\\",$a);
	}
	return $a;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function bdie($e='')
{
	global $nosession;
	if((!$nosession)&&(MFSESSION==1))
	{
		$os = $_SESSION;
		@session_start();
		$_SESSION = $os;
		@session_write_close();
	}
	global $nodb;
//	if(!$nodb) b_transact(1);	
	
	// global session handling
	global $_GLOBALSESSION;
	$fp = fopen(SESSIONSAVEPATH."/".SITETITLE."globalsession","w+");
	fwrite($fp,serialize($_GLOBALSESSION));
	fclose($fp);
		
	die($e);
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function html_activate_links($str,$spacebef=0) 
{ 
	if($spacebef)
	{
		$str = eregi_replace('[\r\n \t]*(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '<a href="\\1" target="_blank">\\1</a>', $str); 
	    $str = eregi_replace(' ([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '\\1<a href="http://\\2" target="_blank">\\2</a>', $str); 
	    $str = eregi_replace(' ([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4})','<a href="mailto:\\1">\\1</a>', $str); 
	}
	else
	{
		$str = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '<a href="\\1" target="_blank">\\1</a>', $str); 
	    $str = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '\\1<a href="http://\\2" target="_blank">\\2</a>', $str); 
	    $str = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4})','<a href="mailto:\\1">\\1</a>', $str); 
	}
	return $str; 
} 
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function EndOfMonth($time=-1)
{
	if($time==-1) $time = time();
	$m = date("n",$time);
	$y = date("Y",$time);
	$d = date("t",$time);
	return mktime(0,0,0,$m,$d,$y);
	}	
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function StartOfMonth($time=-1)
{
	if($time==-1) $time = time();
	$m = date("n",$time);
	$y = date("Y",$time);
	return mktime(0,0,0,$m,1,$y);
}
	
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function DateAfterMonths($months,$time=-1)
{
	if($time==-1) $time = time();
	$d = date("j",$time);
	$m = date("n",$time);
	$y = date("Y",$time);
	$h = date("G",$time);
	$min = date("i",$time);
	$s = date("s",$time);

	$nm = $m + $months;
	$m = $nm;
/*	$m = $nm%12;
	if($m==0) 
	{
		$m = 12;
		$y--;
	}
	$y+=floor($nm/12);
	if($m<0) $m*=-1;*/
	return mktime($h,$min,$s,$m,$d,$y);
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function TrueFalseToInt($v)
{
	if(strtolower($v)=="false") return 0;
	return 1;
}
	
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function print_rt($e,$i=0)
{
	if(!$i)
		echo "<pre>".print_r($e,1)."</pre>";
	else return "<pre>".print_r($e,1)."</pre>";
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function ComposeGet($post=0,$get=0,$params=0)
{
	
	$url = "";
	if($get)
	{
		global $_GET;
		$gk = array_keys($_GET);
		for($i=0;$i<count($gk);$i++) 
		$url.="&".$gk[$i]."=".urlencode($_GET[$gk[$i]]);

	}
	if($post)
	{
		global $_POST;
		$gk = array_keys($_POST);
		for($i=0;$i<count($gk);$i++) 
		$url.="&".$gk[$i]."=".urlencode($_POST[$gk[$i]]);
	}
	if($params)
	{
		$gk = array_keys($params);
		for($i=0;$i<count($gk);$i++) 
		$url.="&".$gk[$i]."=".urlencode($params[$gk[$i]]);
	}
	return $url;
	}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function CheckValidEmail($email)
	{
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$email,$regs) != strlen($email) ) return 0;
		return 1;
/*
	if(strpos($email,"@")===false) return 0;
	if(strpos($email,".")===false) return 0;
	return 1;
*/	
	};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/	
function htp($url,$post=0,$get=0,$params=0)
{
	if($get||$post||$params)
	{
		$hasparams = strpos($url,"?");
		if($hasparams===false) $url.="?";	
		$url = $url.ComposeGet($post,$get,$params);
	}
	header("location:$url");
	bdie();
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function PostReplaceBw($bws=0)
{
	// this function supposes you have 
	//	CREATE TABLE `badwords` (
	// 'bw_word` varchar(255) }
	// definde in the database you are connected to

	// otherwise pass the bad words list as the bws parameter
	
	global $_POST;
	
	$pv = array_values($_POST);	
	$pk = array_keys($_POST);
		
	if($bws==0)
	{
		$bws = array();
		$result = b_query("select bw_word from badwords");
		for($i=0;$i<b_num_rows($result);$i++)
		{
			$dbline = b_fetch_row($result);
			$bws[$i] = $dbline[0];
		};	
	};	

	for($i=0;$i<count($bws);$i++)
		for($j=0;$j<count($_POST);$j++)
		{
			$_POST[$pk[$j]] = str_replace($bws[$i],"",$_POST[$pk[$j]]);

		};
		
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function Gtp($page)
{
	echo '<br><b align="center">If you do not get automatically redirected within the next 5 seconds, Please <a href="'.$page.'">click here</a>.</b>';
	bdie("<script>document.location='".$page."'</script>");
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function PostTo_input($var,$key,$name)
{
	if(strlen($key)) $key = "[".$key."]";
	if(is_array($var))
	{
		$vk = array_keys($var);
		$rv = "";
		for($i=0;$i<count($var);$i++)
		$rv.=PostTo_input($var[$vk[$i]],$vk[$i],$name.$key);
		return $rv;
	}
	else
		return "\r\n".'<input type="hidden" name="'.$name.$key.'" value="'.$var.'">';
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function PostTo($target,$headers,$values,$usep=0)
{
	
	if($usep)
	{// headers and values taken from post
		global $_POST;
		$values = array_values($_POST);
		$headers = array_keys($_POST);
	};
	// generate the form, then submit it:p
	$formname = "postform";//md5($time);
	echo '<br><br><br><br><br><form method="post" action="'.$target.'" name="frm'.$formname.'" id="frm'.$formname.'">';
	for($i=0;$i<count($headers);$i++)
		if($headers[$i]!="submit")
		echo PostTo_input($values[$i],"",$headers[$i]);
	echo '<div align="center"><input type="submit" value="Click here to proceed if you are not automatically redirected within the next 5 seconds" class="nbutton"></div>';
	echo '</form>';
	echo '<script>document.getElementById("frm'.$formname.'").submit();</script><br><br><br><br><br>';
	bdie("");
	};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function GetMonthName($id)
{
	if($id ==1) return "January";
	if($id ==2) return "February";
	if($id ==3) return "March";
	if($id ==4) return "April";
	if($id ==5) return "May";
	if($id ==6) return "June";
	if($id ==7) return "July";
	if($id ==8) return "August";
	if($id ==9) return "September";
	if($id ==10) return "October";
	if($id ==11) return "November";
	if($id ==12) return "December";
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function GetImageReSizeB($blob,$mw,$mh)
{
	$im = imagecreatefromstring($blob);
	
	$rv = array();
	$ar = @getimagesize($filename);
	$w = imagesx($im);
	$h = imagesy($im);
	$dw = $mw-$w;
	$dh = $mh-$h;
	if(($dw<0)||($dh<0))
	{
		if($dw<$dh)
		{
		$ratio = $mw/$w;		
		$w = $w*$ratio;
		$h = $h*$ratio;
		}
		else
		{
		$ratio = $mh/$h;
		$w = $w*$ratio;
		$h = $h*$ratio;
		};
	};
	$w = round($w);
	$h = round($h);

	$rv[0] = $w;
	$rv[1] = $h;
	
	$rv[2] = $ar[0];
	$rv[3] = $ar[1];
	
	return $rv;		
};	
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function GetImageReSize($filename,$mw,$mh)
{

	$rv = array();
	$ar = @getimagesize($filename);
	$w = $ar[0];
	$h = $ar[1];
	$dw = $mw-$w;
	$dh = $mh-$h;
	if(($dw<0)||($dh<0))
	{
		if($dw<$dh)
		{
		$ratio = $mw/$w;		
		$w = $w*$ratio;
		$h = $h*$ratio;
		}
		else
		{
		$ratio = $mh/$h;
		$w = $w*$ratio;
		$h = $h*$ratio;
		};
	};
	$w = round($w);
	$h = round($h);

	$rv[0] = $w;
	$rv[1] = $h;
	
	$rv[2] = $ar[0];
	$rv[3] = $ar[1];
	
	return $rv;		
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function ResizeSquare($w,$h,$mw,$mh)
{
	$rv = array();
	$dw = $mw-$w;
	$dh = $mh-$h;
	if(($dw<0)||($dh<0))
	{
		if($dw<$dh)
		{
		$ratio = $mw/$w;		
		$w = $w*$ratio;
		$h = $h*$ratio;
		}
		else
		{
		$ratio = $mh/$h;
		$w = $w*$ratio;
		$h = $h*$ratio;
		};
	};
	$w = round($w);
	$h = round($h);

	$rv[0] = $w;
	$rv[1] = $h;
	$rv[3] = $ratio;
	
	return $rv;		
}
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function bapi_crypt($string,$key)
{
	$i = 0;
	$k = 0;
	while($i<strlen($string))
	{
		$string[$i] = chr( ord($string[$i]) + ord($key[$k]) );
		$i++;
		$k++;
		if($k>(strlen($key)-1)) $k=0;
	};
	return $string;
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function bapi_decrypt($string,$key)
	{
	$i = 0;
	$k = 0;
	while($i<strlen($string))
	{
		$string[$i] = chr( ord($string[$i]) - ord($key[$k]) );
		$i++;
		$k++;
		if($k>(strlen($key)-1)) $k=0;
	};
	return $string;
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function initoarray($file)
{
	$rv = array();
	for($i=0;$i<count($file);$i++)
	{
		$str = $file[$i];
		$iPos = strpos($str,"=");
		$name = substr($str,0,$iPos);
		$value = substr($str,$iPos+1,strlen($str)-$iPos-1);
		$rv[trim($name)] = trim($value);
	};
	return $rv;
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function arraytoini($array,$section,$separator="\r\n")
{
	$ak = array_keys($array);
	$av = array_values($array);
	
	$rv = "[".$section."]".$separator;
	for($i=0;$i<count($ak);$i++)
		if(!is_array($av[$i]))
		$rv.=$ak[$i]."=".$av[$i].$separator;
	for($i=0;$i<count($ak);$i++)
		if(is_array($av[$i]))
		$rv.=arraytoini($av[$i],$section."-".$ak[$i],$separator);
	return $rv;	
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function GetTld($domain,$delim=".")
{
	$iPos = strrpos($domain,$delim);
	return substr($domain,$iPos+1,strlen($domain)-1-$iPos);
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function GetSld($domain,$delim=".")
{
	$iPos = strrpos($domain,$delim);
	return substr($domain,0,$iPos);
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function YesNoToInt($yn)
{
	if($yn == "yes") return 1;
	return 0;
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*
*/
function SplitIni($file)
{
	return initoarray($file);
};
?>
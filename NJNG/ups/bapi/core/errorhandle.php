<?
/**
*@package bapi
*/
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*Call this function in order to raise an E_USER_ERROR
*@param	string	$err	Error message
*/
function eFatalError($err)
{
	trigger_error($err,E_USER_WARNING);
};
//--------------------------------------------------------------------------------------------------------------------------------------------
/**
*Call this function in order to raise an E_USER_WARNING
*@param	string	$err	Error message
*/
function eWarning($err)
{
	trigger_error($err,E_USER_WARNING);
};
?>
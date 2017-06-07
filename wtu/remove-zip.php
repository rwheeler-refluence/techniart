<?
include("database.php");
#print $otsID;	
$_SESSION['zip']='';
$_SESSION['zip_qualify']='';
$_SESSION['rep']='';

session_unset;
if($vendor==''){header("location:store.php");}
?>

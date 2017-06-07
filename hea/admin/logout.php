<?
include("database.php");
$_SESSION['myspiritID']="";
session_destroy();
header("location: loginform.php");
?>

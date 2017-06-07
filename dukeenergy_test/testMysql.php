<?php
include("database.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql="insert into tblOrdersCompleted_1(status) values('Closed')";
$result=db_query($sql);
$next=mysql_insert_id();
echo $next;
?>
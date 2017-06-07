<?php
include("database.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "hi";
//$key='2037290784';

$testVar = "ʻO ka ʻŌlelo ke Kaʻā o ka Mauli";


	//document the order in the database
	$stamp=time();

	$date=time();
	$otsID="2235";
	$trademark="ô";
	$ship_fname=$testVar;
	$ship_lname=$testVar;
	$ship_address1=$testVar;
	$ship_address2=$testVar;
	$ship_city=$testVar;
	$ship_state=$testVar;
	$ship_zip=$testVar;
	$email=$testVar;
	$account=$testVar;
	$question1=$testVar;
	$question2=$testVar;
	$fname=$testVar;
	$lname=$testVar;
	$address1=$testVar;
	$address2=$testVar;
	$city=$testVar;
	$state=$testVar;
	$zip=$testVar;
	$source='';
	$water='';
	$trademark="ô";
	$tax=0.99;
	$amount=1.01;
	$instr='';
$orderinfo = "Ka Haka ʻUla O' Keʻelikōlani,
Koleke ʻŌlelo Hawaiʻi";


$sql21="update tblotsdetail set orderinfo=$orderinfo where otsID='$otsID'";

$result21=db_query($sql21);


?>
<?PHP
// PREVENT CACHING FIRST BEFORE ANYTHING ELSE!
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
error_reporting(0);
include("ADODB/adodb.inc.php");
$ms = $_GET['mform'];
$ms=str_replace("zpos","''",$ms);
$ms = explode(",",$ms);

include("functions.php");

include("mysqlcust.con");

$sqldb=mysql_select_db("nyserda_garycardil610729",$sqlconnect);

// trim here once customer saves
$s = trim_array($ms);

//check for qualified
$sql="SELECT * FROM cwa.cwa_zip_codes where zip='". $s[7] . "' and member_area='". $s[8] . "'";

$res= mysql_query($sql,$sqlconnect) or die('Could Not open Zip validation database');

$trec=mysql_num_rows($res);
if ($trec < 1){
	die('Invalid Cascade Member district.');
}



//check for customer
$sqlquery="SELECT * FROM cwa.cascade_users where cascade_acct='". $s[0] . "'";

$results= mysql_query($sqlquery,$sqlconnect) or die('Could Not open database');

$numrec=mysql_num_rows($results);
$whathappened="";


if ($numrec > 0){
	
	//update
	$sqlquery="update cwa.cascade_users set fname='" . $s[1] . "',
	lname='".$s[2] . "',
	add1='".$s[3] . "',
	add2='".$s[4] . "',
	city='".$s[5] . "',
	zip='".$s[7] . "',
	cascade_member='".$s[8] . "',
	b_fname='".$s[9] . "',
	b_lname='".$s[10] . "',
	b_add1='".$s[11] . "',
	b_add2='".$s[12] . "',
	b_city='".$s[13] . "',
	b_state='".$s[14] . "',
	b_zip='".$s[15] . "',
	email='".$s[16] . "',
	phone='".$s[17] . "',
	pass='".$s[18] . "' where cascade_acct='". $s[0] . "'";
	
	//die($sqlquery);
	$results= mysql_query($sqlquery,$sqlconnect) or die('Could not save your account info- ' . mysql_error());
    $whathappened="savedtheaccount";
	
} else {
	
	//add record	
	$sqlquery="INSERT INTO cwa.cascade_users( cascade_acct,fname,lname,add1,add2,city,zip,cascade_member,b_fname,b_lname,b_add1,b_add2,b_city,b_state,b_zip,email,phone,pass) VALUES( '" . $s[0] . "','" . $s[1] . "','" . $s[2] . "','" . $s[3] . "','" . $s[4] . "','" . $s[5] . "','" . $s[7] . "','" . $s[8] . "','" . $s[9] . "','" . $s[10] . "','" . $s[11] . "','" . $s[12] . "','" . $s[13] . "','" . $s[14] . "','" . $s[15] . "','" . $s[16] . "','" . $s[17] . "','" . $s[18] . "')";
    $results= mysql_query($sqlquery,$sqlconnect) or die('Could not create your account- ' . mysql_error());
    //die($sqlquery);
    $whathappened="addedtheaccount";
}


 $mret = array('acct' => $s[0],
     'fname' => $s[1],
     'lname' => $s[2],
     'add1' => $s[3],
     'add2' => $s[4],
     'city' => $s[5],
     'zip' => $s[7],
     'cascade_member' => $s[8],
     'b_fname' => $s[9],
     'b_lname' => $s[10],
     'b_add1' => $s[11],
     'b_add2' => $s[12],
     'b_city' => $s[13],
     'b_state' => $s[14],
     'b_zip' => $s[15],
     'email' => $s[16],
     'phone' => $s[17],
     'pass' => $s[18] );

     
mysql_close($sqlconnect);
 //echo json_encode($mret); 
echo $whathappened . "|" . json_encode($mret); 

?>

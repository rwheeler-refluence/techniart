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
$s = $ms;


//check for customer
$sqlquery="SELECT * FROM cwa.cascade_users where cascade_acct='". $s[0] . "'";

$results= mysql_query($sqlquery,$sqlconnect) or die('Could Not open database');

$numrec=mysql_num_rows($results);

//die('The number of records:'+$numrec);

 if ($numrec > 0){

	 $cascade_acct="";
     $fname="";
     $lname="";
     $add1="";
     $add2="";
     $city="";
     $zip="";
     $cascade_member="";
     $b_fname="";
     $b_lname="";
     $b_add1="";
     $b_add2="";
     $b_city="";
     $b_state="";
     $b_zip="";
     $email="";
     $phone="";
     $pass="";

	 while($row = mysql_fetch_array($results)){
	    $cascade_acct=$cascade_acct . trim($row['cascade_acct']);
        $fname=$fname . trim($row['fname']);
        $lname=$lname . trim($row['lname']);
        $add1=$add1 . trim($row['add1']);
        $add2=$add2 . trim($row['add2']);
        $city=$city . trim($row['city']);
        $zip=$zip . trim($row['zip']);
        $cascade_member=$cascade_member . trim($row['cascade_member']);
        $b_fname=$b_fname . trim($row['b_fname']);
        $b_lname=$b_lname . trim($row['b_lname']);
        $b_add1=$b_add1 . trim($row['b_add1']);
        $b_add2=$b_add2 . trim($row['b_add2']);
        $b_city=$b_city . trim($row['b_city']);
        $b_state=$b_state . trim($row['b_state']);
        $b_zip=$b_zip . trim($row['b_zip']);
        $email=$email . trim($row['email']);
        $phone=$phone . trim($row['phone']);
        $pass=$pass . trim($row['pass']);

	 }

     $mret = array('acct' => $cascade_acct,
     'fname' => $fname,
     'lname' => $lname,
     'add1' => $add1,
     'add2' => $add2,
     'city' => $city,
     'zip' => $zip,
     'cascade_member' => $cascade_member,
     'b_fname' => $b_fname,
     'b_lname' => $b_lname,
     'b_add1' => $b_add1,
     'b_add2' => $b_add2,
     'b_city' => $b_city,
     'b_state' => $b_state,
     'b_zip' => $b_zip,
     'email' => $email,
     'phone' => $phone,
     'pass' => $pass );

     //get the cart
     //check for customer
     $sqlquery="SELECT * FROM cwa.cascade_carts where cascade_acct='". $s[0] . "'";
     $results= mysql_query($sqlquery,$sqlconnect) or die('Could Not open database');

     $numrec=mysql_num_rows($results);
//$numrec=0;
     if ($numrec > 0){

	   $cascade_acct="";
       $p1=0;
       $p2=0;
       $p3=0;
       $p4=0;
       $p5=0;
       $p6=0;
       $p7=0;
       $p8=0;
       $p9=0;
       $p10=0;

	   while($row = mysql_fetch_array($results)){
	    $cascade_acct=$cascade_acct . trim($row['cascade_acct']);
        $p1=$row['p1'];
        $p1amt=$row['p1amt'];
        $p2=$row['p2'];
        $p2amt=$row['p2amt'];
        $p3=$row['p3'];
        $p3amt= $row['p3amt'];
        $p4= $row['p4'];
        $p4amt= $row['p4amt'];
        $p5= $row['p5'];
        $p5amt= $row['p5amt'];
        $p6= $row['p6'];
        $p6amt= $row['p6amt'];
        $p7= $row['p7'];
        $p7amt= $row['p7amt'];
        $p8= $row['p8'];
        $p8amt= $row['p8amt'];
        $p9= $row['p9'];
        $p9amt= $row['p9amt'];
        $p10= $row['p10'];
        $p10amt= $row['p10amt'];

	  }

      $mretCart = array('acct' => $cascade_acct,
       'p1' => $p1,
       'p1amt' => $p1amt,
       'p2' => $p2,
       'p2amt' => $p2amt,
       'p3' => $p3,
       'p3amt' => $p3amt,
       'p4' => $p4,
       'p4_amt' => $p4amt,
       'p5' => $p5,
       'p5amt' => $p5amt,
       'p6' => $p6,
       'p6amt' => $p6amt,
       'p7' => $p7,
       'p7amt' => $p7amt,
       'p8' => $p8,
       'p8amt' => $p8amt,
       'p9' => $p9,
       'p9amt' => $p9amt,
       'p10' => $p10,
       'p10amt' => $p10amt );

    }

    mysql_close($sqlconnect);
    echo json_encode($mret) . "|" . json_encode($mretCart);

 } else {

	mysql_close($sqlconnect);
	echo 'No record found, please chck your information.|nothing';
 }


?>

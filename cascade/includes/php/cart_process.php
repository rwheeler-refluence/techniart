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

//there are only 10 products so no need to have a products database/just change it here when needed
/*

1 1.60 Dish Squeegee
2 1.60 Sprinkler System DVD
3 4.60 Earth Massage Chrome Showerhead
4 4.60 Earth Massage Showerhead
5 4.60 Spray Clean Showerhead
6 1.60 Dye Tablets/Strips
7 1.60 Rain Gauge
8 4.60 Shower Timer
9 4.60 Kitchen Faucet Aerator
10 4.60 Bathroom Faucet Aerator

*/


include("functions.php");

include("mysqlcust.con");

$sqldb=mysql_select_db("nyserda_garycardil610729",$sqlconnect);

// trim here once customer saves
$s = $ms;


if ($s[11] !='get') {

	//check for customer
    $sqlquery="SELECT * FROM cwa.cascade_carts where cascade_acct='". $s[0] . "'";

    $results= mysql_query($sqlquery,$sqlconnect) or die('Could Not open database');

    $numrec=mysql_num_rows($results);
    $whathappened="";

    if ($numrec > 0){

	    //update
	    $sqlquery="update cwa.cascade_carts set
	    p1=" . $s[1] . ",
	    p2=" . $s[2] . ",
	    p3=" . $s[3] . ",
	    p4=" . $s[4] . ",
	    p5=" . $s[5] . ",
	    p6=" . $s[6] . ",
	    p7=" . $s[7] . ",
	    p8=" . $s[8] . ",
	    p9=" . $s[9] . ",
 	    p10=" . $s[10] . " where cascade_acct='". $s[0] . "'";
  	    //die($sqlquery);
	    $results= mysql_query($sqlquery,$sqlconnect) or die('Could not save your account info- ' . mysql_error());
        $whathappened="updatedthecart";

    } else {


	    //add record
	    $sqlquery="INSERT INTO cwa.cascade_carts(cascade_acct,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10) values('"
	    . $s[0] . "',"
	    . $s[1] . ","
	    . $s[2] . ","
	    . $s[3] . ","
	    . $s[4] . ","
	    . $s[5] . ","
	    . $s[6] . ","
	    . $s[7] . ","
	    . $s[8] . ","
	    . $s[9] . ","
	    . $s[10] . ")";

  	    //die($sqlquery);
        $results= mysql_query($sqlquery,$sqlconnect) or die('Could not create your account- ' . mysql_error());
        $whathappened="addedtheaccount";
    }


    $mret = array('acct' => $s[0],
     'p1' => $s[1],
     'p2' => $s[2],
     'p3' => $s[3],
     'p4' => $s[4],
     'p5' => $s[5],
     'p6' => $s[6],
     'p7' => $s[7],
     'p8' => $s[8],
     'p9' => $s[9],
     'p10' => $s[10]);


} else {

  //check for customer
  $sqlquery="SELECT * FROM cwa.cascade_carts where cascade_acct='". $s[0] . "'";

  $results= mysql_query($sqlquery,$sqlconnect) or die('Could Not open database');

  $numrec=mysql_num_rows($results);

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
        $p2=$row['p2'];
        $p3=$row['p3'];
        $p4= $row['p4'];
        $p5= $row['p5'];
        $p6= $row['p6'];
        $p7= $row['p7'];
        $p8= $row['p8'];
        $p9= $row['p9'];
        $p10= $row['p10'];

	 }

     $mret = array('acct' => $cascade_acct,
     'p1' => $p1,
     'p2' => $p2,
     'p3' => $p3,
     'p4' => $p4,
     'p5' => $p5,
     'p6' => $p6,
     'p7' => $p7,
     'p8' => $p8,
     'p9' => $p9,
     'p10' => $p10);

     $whathappened="gotthecart";
  }

}

mysql_close($sqlconnect);
//echo json_encode($mret);
echo $whathappened . "|" . json_encode($mret). "|" . $s[11];


?>

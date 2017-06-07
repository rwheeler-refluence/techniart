<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
error_reporting(0);
include("functions.php");
require("phpmailer/class.phpmailer.php");

//converted to authorize.net
$mdate=getdate(date("U"));

$ms = $_GET['mform'];
$ms=str_replace("zpos","''",$ms);
$ms = explode(",",$ms);

//not loging here yet
//include("mysqlcust.con");
//$sqldb=mysql_select_db("cwa",$sqlconnect);


// trim here once customer saves
$s = $ms;

$custId=$s[0];
$first_name=$s[1];
$last_name=$s[2];
$address=$s[3];
$city=$s[4];
$zipcode=$s[5];
$cctype=$s[6];
$ccnum=$s[7];
$exp=$s[8];
$amt=$s[9];

include("mysqljob.con");

 //check for customer
  $sqlquery="SELECT * FROM cwa.cascade_carts where cascade_acct='" . $custId ."'";

  //die($sqlquery);
  $sqldb=mysql_select_db("nyserda_garycardil610729",$sqlconnect);

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

     $morder = array('acct' => $cascade_acct,
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


     $morder_print="";

     if ( $p1 !=0 ){
	     $morder_print .= $p1 . " Dish Squeegee(s) <br>";
     }
     if ( $p2 !=0 ){
	     $morder_print .= $p2 . " Sprinkler System DVD(s) <br>";
     }
     if ( $p3 !=0 ){
	     $morder_print .= $p3 . " Earth Massage Chrome Showerhead(s) <br>";
     }
     if ( $p4 !=0 ){
	     $morder_print .= $p4 . " Earth Massage Showerhead(s) <br>";
     }
     if ( $p5 !=0 ){
	     $morder_print .= $p5 . " Spray Clean Showerhead(s) <br>";
     }
     if ( $p6 !=0 ){
	     $morder_print .= $p6 . " Dye Tablets/Strips(s) <br>";
     }
     if ( $p7 !=0 ){
	     $morder_print .= $p7 . " Rain Gauge(s) <br>";
     }

     if ( $p8 !=0 ){
	     $morder_print .= $p8 . " Shower Timer(s) <br>";
     }
     if ( $p9 !=0 ){
	     $morder_print .= $p9 . " Kitchen Faucet Aerator(s) <br>";
     }

     if ( $p10 !=0 ){
	     $morder_print .= $p10 . " Bathroom Faucet Aerator(s) <br>";
     }


  }


//die('made it here');


  if (trim($custId)==""){
	  $custId='0';
  }

  //we auth and capture to authorize.net- per carol
  $reply = array();
  $errorMsg="";

     	$post_url = "https://secure.authorize.net/gateway/transact.dll";
	    //$post_url = "https://test.authorize.net/gateway/transact.dll";

	    $r = explode("/",$exp);

		$newexp=$r[0] . substr($r[1],2,2);
		$newexp=$newexp . "";

	//die('made it here 60 : ' . $newexp);



    	if (strlen($newexp) < 4){
			$newexp = "0" . $newexp;
    	}
		  //  "x_login"	=> "28mwP3WL",
		  //"x_tran_key" => "2BmpB9J752TwdE9K",

    	$post_values = array(

		  "x_login"	=> "28mwP3WL",
		  "x_tran_key" => "2BmpB9J752TwdE9K",
		  "x_version" => "3.1",
		  "x_delim_data" => "TRUE",
		  "x_delim_char" => "|",
		  "x_relay_response" => "FALSE",
		  "x_type" => "AUTH_CAPTURE",
		  "x_method" => "CC",
		  "x_card_num" => $ccnum,
		  "x_exp_date" => "$newexp",
		  "x_amount" => $amt,
		  "x_invoice_num" => $custId,
		  "x_first_name" => $first_name,
		  "x_last_name" => $last_name,
		  "x_address" => $address,
		  "x_city" => $city,
		  "x_state" => "WA",
    	  "x_zip" => $zipcode
		 );


		$post_string = "";

		foreach( $post_values as $key => $value ){
			$post_string .= "$key=" . urlencode( $value ) . "&";
		}

		$post_string = rtrim( $post_string, "& " );

		$value= $post_string . "\r\n";
	   	$thefile="LOGS/" . $custId . "_ccResponce_post.txt";
        $fp=fopen($thefile,"a+");
        fwrite($fp, "\r\n" . $value);
        fclose($fp);

        //echo $post_string;


		$request = curl_init($post_url); // initiate curl object

		curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
		$post_response = curl_exec($request); // execute curl post and store results in $post_response

		curl_close ($request); // close curl object

		// This line takes the response and breaks it into an array using the specified delimiting character
		$reply = explode($post_values["x_delim_char"],$post_response);

		// The results are output to the screen in the form of an html numbered list.
		//foreach ($result_arr as $key=>$val){
                //echo $key . "  - " . $val . "<br>";
        //}


    	$status = $reply[0];

    	//return array( 'RESULT' => $reply[0],'PNREF' => $reply[6] . '|' . $reply[4],'RESPMSG' => $reply[3] );

		//testing only- records cc numbers -log all ccresponces by jobnumber

		foreach ($reply as $key=>$val){

	   		$value= $key . "  -  " . $val . "\r\n";
	   		$thefile="LOGS/" . $custId . "_ccResponce.txt";
            $fp=fopen($thefile,"a+");
            fwrite($fp, "\r\n" . $value);
            fclose($fp);

    	}

    	 //die('made it here 145');


		if ($status > 0){

			$decision = strtoupper($reply[3]);
			$requestID=$reply[6];
			$thedate=$mdate['mon'] . "/" . $mdate['mday'] . "/" . $mdate['year'];
			$theauthcode=trim($reply[4]);
    	    $tmpjbnum=$custId . "-011";

			//let's put it in the aplypymt fox database for carol to capture the payment from
			if ($theauthcode !="") {



		    } else {

			   //Declined or failed
			   // SEND MAIL BELOW AFTER WE PULL THE ENGLISH DESCRIPTIONS FOR THE REASON CODE AND THE AVS CODE.


			}

			//htese are the fields put in if they have values
			if (!isset($reply[9])){
			  $authamt=0;
		    } else {
			  $authamt= $reply[9];
		    }

		    if (!isset($reply[4])){
			  $newcode=" ";
		    } else {
			  $newcode=$reply[4];
		    }

		    ////$reply[3]- is the text.

		    //not using so declare a blank
		    if (!isset($reply[5])){
			  $newavccode=" ";
		    } else {
			  $newavscode=$reply[5];
		    }

			if (!isset($reply[0])){
			  $newrcode=" ";
		    } else {
			  $newrcode=$reply[0];
		    }

			//$reply[6]
			//$reply[1]
		    if ($reply[0]==1){
			    $thedecision='ACCEPT';
		    } else {
			    $thedecision='REJECT';
		    }


			//now save it in order credit card database
	   		$SQL="INSERT INTO cwa.credit_card(site,cust_id,jobno,joblog_id,amount,auth_amount,auth_code,avs_result,response_code,request_id,decision) values('V3','" . $custId . "',1,'0'," . $amt . "," . $authamt . ",'" . $newcode . "','" . $newavscode . "','" . $newrcode . "','" . $reply[6] . "','" . $thedecision . "')";
	   		$sqldb=mysql_select_db("cwa",$sqlconnect);
	   		$results= mysql_query($SQL); //or die('System failed to insert into Credit Card table for job : ' . $SQL . ' :  '   . mysql_error());

	   		if (mysql_affected_rows($sqlconnect) <= 0) {

				//mail('stephen@cisdirect.com', 'Cascade data Error', 'System failed to insert into Credit Card table for cascade order : ' . $tmpjbnum);

			}


			if ($thedecision=='REJECT') {


		          $errorMsg=$errorMsg . "\nCredit card auth failure, - $reply[3] - Please correct the problem and try again, if this problem persist please call our customer service department.\n\n";

		          $thebody = "<html><body>";
				  $thebody = $thebody . '<table style="font: 12px Arial, Helvetica;width:650px;line-height: 14px;">';
				  $thebody = $thebody . "<br>Credit card auth failure, - " . $reply[3] . "<br>Acount Number: " . $custId  . "<br>Name: " . $first_name . " " . $last_name . "<br>Ship to: " . $address . ", " . $city . " WA " . $zipcode . "<br> <br>Payment Type: " . $cctype . "<br>Account Number: xxxxxxxxxxxx" . substr($ccnum, 12,4) .  "<br>Expires: " . $exp . "<br>Amount : $" . $amt . "<br><br><br>Order Details:<br><br>" . $morder_print . "<br><br>";
				  $thebody = $thebody . "<b>Cascade Water Alliance</b><br>520 112th Ave. NE Suite 400<br>Bellevue, WA 98004<br>425.453.0930<br>http://www.CascadeWater.org<br><br>";


				  $thebody = $thebody . "</table>";
				  $thebody = $thebody . "</body></html>";
				  $thebody= str_replace("\n", "<br>", $thebody);
				  $body2= str_replace("<br>", "\r\n", $thebody);

				  $mail = new PHPMailer();

				  $mail->IsSMTP();                                   // send via SMTP
				  $mail->Host     = "mail.cisdirect.com"; // SMTP servers
				  $mail->Port     = "587";
				  $mail->SMTPAuth = false;     // turn on SMTP authentication

				  $mail->From     = "admin@cisdirect.com";
				  $mail->FromName = "Admin";

				  $mail->AddAddress("stephen@cisdirect.com");               // optional name

				  $mail->AddReplyTo("stephen@cisdirect.com","Site Administration");

				  $mail->WordWrap = 50;                              // set word wrap
				  $mail->IsHTML(true);                               // send as HTML

				  $mail->Subject  =  "Cascade water Alliance credit card failure";

				  $mail->IsHTML(true);
				  $mail->AddEmbeddedImage('images/emaillogo.jpg', 'logoimg', 'emaillogo.jpg'); // attach file logo.jpg, and later link to it using identfier logoimg
				  $mail->Body =  "<BR><p><img src=\"cid:logoimg\" alt=\"Cascade Water Alliance Order Confirmation\" /></p><br>$thebody<BR><BR>";

				  $mail->AltBody  =  "\r\n$body2\r\n";

				  if(!$mail->Send()) {
				    $errorMsg=$errorMsg . "Error sending email " . $mail->ErrorInfo;
				  } else {
				    $errorMsg=$errorMsg . "Email sent without error";
				  }


		    } else {


			      $total=number_format($amt, 2, '.', '');

				  $thebody = "<html><body>";
				  $thebody = $thebody . '<table style="font: 12px Arial, Helvetica;width:650px;line-height: 14px;">';
				  $thebody = $thebody . "Your order for free conservation items is currently being processed<br>and will ship in 5-10 working days. The shipping cost for this order will appear on your credit card statement<br>as <b>Compact Information Systems</b>.<BR><BR>If you have any questions or to inquire about the status of your order feel free to<br>call 425-869-1379 or 1-800-632-1379 for assistance.<BR><BR>Cascade Account Number: " . $custId  . "<br>Name: " . $first_name . " " . $last_name . "<br>Ship to: " . $address . ", " . $city . " WA " . $zipcode . "<br> <br>Payment Type: " . $cctype . "<br>Account Number: xxxxxxxxxxxx" . substr($ccnum, 12,4) . "<br>Expires: " . $exp . "<br>Amount Paid : $" . $total . "<br><br><br>Order Details:<br><br>" . $morder_print . "<br><br>";
				  $thebody = $thebody . "<b>Cascade Water Alliance</b><br>520 112th Ave. NE Suite 400<br>Bellevue, WA 98004<br>425.453.0930<br>http://www.CascadeWater.org<br><br>";


				  $thebody = $thebody . "</table>";
				  $thebody = $thebody . "</body></html>";
				  $thebody= str_replace("\n", "<br>", $thebody);
				  $body2= str_replace("<br>", "\r\n", $thebody);

				  $mail = new PHPMailer();

				  $mail->IsSMTP();                                   // send via SMTP
				  $mail->Host     = "mail.cisdirect.com"; // SMTP servers
				  $mail->Port     = "587";
				  $mail->SMTPAuth = false;     // turn on SMTP authentication

				  $mail->From     = "stephen@cisdirect.com";
				  $mail->FromName = "Admin";

				  $mail->AddAddress($s[10]);               // optional name
				  $mail->AddBCC("stephen@cisdirect.com");
	              $mail->AddBCC("bettina@compactprinting.com");
	              $mail->AddBCC("wade@compactprinting.com");

				  $mail->AddReplyTo("stephen@cisdirect.com","Site Administration");

				  $mail->WordWrap = 50;                              // set word wrap
				  $mail->IsHTML(true);                               // send as HTML

				  $mail->Subject  =  "Cascade water Alliance order confirmation";

				  $mail->IsHTML(true);
				  $mail->AddEmbeddedImage('images/emaillogo.jpg', 'logoimg', 'emaillogo.jpg'); // attach file logo.jpg, and later link to it using identfier logoimg
				  $mail->Body =  "<BR><p><img src=\"cid:logoimg\" alt=\"Cascade Water Alliance Order Confirmation\" /></p><br>$thebody<BR><BR>";

				  $mail->AltBody  =  "\r\n$body2\r\n";

				  if(!$mail->Send()) {
				    $errorMsg=$errorMsg . "Error sending email " . $mail->ErrorInfo;
				  } else {
				    $errorMsg=$errorMsg . "Email sent without error";
				  }

				   //datestamp it
			   $SQL="update cwa.cascade_carts set thedate=NOW(),total=" . $amt . " where cascade_acct='" . $custId ."'";
	   		   $sqldb=mysql_select_db("cwa",$sqlconnect);
	   		   $results= mysql_query($SQL) or die('System failed to update the orderdate : ' . $SQL . ' :  '   . mysql_error());

			   //now move it to orders and delete form open carts
	   		   $SQL="INSERT INTO cwa.cascade_orders SELECT * from cwa.cascade_carts where cascade_acct='" . $custId ."'";
	   		   $sqldb=mysql_select_db("cwa",$sqlconnect);
	   		   $results= mysql_query($SQL) or die('System failed to insert into Credit Card table for job : ' . $SQL . ' :  '   . mysql_error());

	   		   if (mysql_affected_rows($sqlconnect) > 0 ) {

		   		  $SQL="delete from cwa.cascade_carts where cascade_acct='" . $custId ."'";
	   		      $sqldb=mysql_select_db("cwa",$sqlconnect);
	   		      $results= mysql_query($SQL) or die('System failed to remove the cart after placed into orders : ' . $SQL . ' :  '   . mysql_error());

		   	   }


		     }

		     mysql_close();

	  } else { //status code defined


		  $errorMsg=$errorMsg . "\nCredit card auth failure, an HTTP error occurred, if this problem persist please call our customer service department.\n\n";


	  }


  $reply[1]=$reply[1] . $errorMsg;

  $returnArray= array( "card" => $reply[50], "amount" => $reply[9] , "ccAuthReply_authorizationCode" => $reply[4], "thedecision" => $thedecision, "text" => $reply[9], "error" => $reply[9]);
  echo json_encode($returnArray);


?>




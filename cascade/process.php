<? include("database.php"); ?>
<? 	$sql="select * from tblOrdersCompleted where otsID='$otsID'";
	#print($sql);
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if($count>'0'){
	echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Order ID already exists.')
		window.location.href='http://www.techniart.us/cascade'
        </SCRIPT>";
		die();	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<link rel="icon" 
      type="image/png" 
      href="icon.png">
<title>TechniArt - Order Processed</title>


<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>



<link rel="stylesheet" type="text/css" href="css/main.css"/>

<style type="text/css">





#pleasewait {position: absolute; top: 0px; left:0px; height:2000px; width:100%;font: 12px Archivo Narrow, Arial, Helvetica; visibility:hidden; z-index: 100000; background-color:#eee;filter:alpha(opacity=50); -moz-opacity:0.5 ;opacity: 0.5;}
#checkout a {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#checkout a:hover {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#checkout a:active {background: url(images/checkout.jpg) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}

#close a {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#close a:hover {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}
#close a:active {background: url(images/close.png) 0 0 no-repeat;width:148px;height:62px;position: absolute;top: auto;left: auto;bottom: auto;text-decoration:none;}


#prods {position: absolute; top: 700px; left:300px; height:2525px; width:975px;display:block;background:#ffffff; border: 0px solid #000000; z-index: 1000; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;}
#register {position: absolute; top: 415px; left:0px; height:1300px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}

#cart {position: absolute; top: 415px; left:0px; height:700px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}
#review_checkout {position: absolute; top: 415px; left:0px; height:700px; width:975px;display:none;background:#ccc; border: 0px solid #000000; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 0px; border-radius: 0px;}
#forgotpass {position: absolute; top: 185px; left:325px; height:325px; width:585px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 1002; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
#signin {position: absolute; top: 385px; left:250px; height:475px; width:730px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 1001; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
#messagescr {position: absolute; top: 215px; left:340px; height:450px; width:570px;display:none;background:#ccc; border: 2px solid #8EC100; z-index: 10003; background-color:#ffffff;filter:alpha(opacity=100); -moz-opacity:1.0;opacity: 1.0;-moz-border-radius: 15px; border-radius: 15px;}
li~li {
	border-left: 1px solid #ffffff;
}
.content{
	margin-left:50px;
}
</style>
<style>.btn {
  -webkit-border-radius: 10;
  -moz-border-radius: 10;
  border-radius: 10px;
  font-family: Arial;
  color: #ffffff;
  font-size: 12px;
  background: #82b101;
  padding: 10px 10px 10px 10px;
  text-decoration: bold;
  border: none;
}

.btn:hover {
  background: #3daff3;
	cursor: pointer;
  text-decoration: none;
	}</style></head>
<BODY>
<center>
<?php include_once("cart-header.php") ?>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-left:20px">
  <tr>
    <td>
<?
print("<div style=\"padding-left:55px;\"><p class=\"body_content_style1\">");
if($amount=='8.00'){
	print("There appears to be an issue with your order. It has timed out due to inactivity in your browsing session (a security feature to protect you). Please <a class=\"body_content_style1\" href=\"https://www.techniart.us/masssave/cart.php\">click here</a> to return to your cart.<br>");
}else{
#ini_set('display_errors','On');

/*************************************************
// Program: PHPAUTHNET AIM
// Version: 2.0
// Author: Hasan Robinson 
// Copyright (c) 2002,2003 AuthnetScripts.com
// All rights reserved.
//
//
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
// "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
// LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
// FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
// REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
// INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
// (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
// SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
// HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
// STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
// ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
// OF THE POSSIBILITY OF SUCH DAMAGE.
//
//------------------------------------------------------------------------

Description: 
Checks the response code from Authorizenet sets the results of the 
authorization  request into the message variable.

$authnet_results[x_response_code] / 1=approved 2=declined 3=error

/*********************************************************************/

include_once('./phpauthnet_aim.php');


//CHECK MD5 HASH VALUE
if($authnet['md5hash'] != "") { 
	if($authnet_results['md5'] != $authnet_results['x_md5_hash']) {   
		$authnet_results['x_response_code']='3';$authnet_results['x_response_reason_text']='MD5 HASH mis-match'; 
	}  
}
#print("Error code:".$authnet_results["x_response_code"]);
#print("<br>");
#print("Error Text:".$authnet_results["x_response_reason_text"]);

switch($authnet_results["x_response_code"]) {
	case 1:
	//document the order in the database
	$stamp=mktime();
#	$date=date("m-d-Y H:m:s");
	$date=mktime();
	$otsID=$authnet['md2'];
	$ship_fname=$_POST['ship_fname'];
	$ship_lname=$_POST['ship_lname'];
	$ship_address1=$_POST['ship_address1'];
	$ship_address2=$_POST['ship_address2'];
	$ship_city=$_POST['ship_city'];
	$ship_state=$_POST['ship_state'];
	$ship_zip=$_POST['ship_zip'];
	$email=$_POST['email'];
	$account=$_POST['account'];
	$email_opt=$_POST['email_opt'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$address1=$_POST['address1'];
	$address2=$_POST['address2'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$water=$_POST['water'];
	$rate=$_POST['rate'];
	$amount=$_POST['amount'];
	$instr=$_POST['instr'];
	$sql="insert into tblOrdersCompleted(otsID, stamp, ship_firstname, ship_lastname, ship_address, ship_address2, ship_city, ship_state, ship_zip,  instructions,  account, shipping, email, status)	values('$otsID', '$date', '$ship_fname', '$ship_lname', '$ship_address1', '$ship_address2','$ship_city', '$ship_state', '$ship_zip', '$instr', '$account', '$rate', '$email', 'Closed')";
	$result=db_query($sql);
	$next=mysql_insert_id();

	$sql2="update tblorderstosend set status='Closed' where otsID='$otsID'";
	$result2=db_query($sql2);

#fulfillment e-mail
$to="cascade-orders@techniart.com";
$from="sales@techniart.com";
$subject="Cascade Water Free - techniart.us";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);


//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";
			$body.="Thank you for participating in Cascade’s special offer. Your order was received on ".date("m/d/Y H:i:s").". Please find the details of your order below.\n\n";

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_fname." ".$ship_lname."\n";
			$body.="Address: ".$ship_address1." ".$ship_address2."\n";
			$body.="".$ship_city.", ".$ship_state." ".$ship_zip."\n\n";
						
			$body.="Email: ".$email."\n\n";

			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="Mass Save Embertec Order - techniart.com";

		
			#end customer receipt
			$sql="select * from tblotsdetail where otsID='$otsID' order by otsdetailID desc";
			#print($sql);
			$result=db_query($sql);
			$count=mysql_num_rows($result);
			if($count){
				$ia=1;
				while($row=mysql_fetch_array($result)){
					$otsdetailID=$row['otsdetailID'];
					$qty=$row['qty'];
					$itemNo=$row['itemNo'];
					$price=$row['price'];
					$productDesc=$row['productDesc'];
					$productDesc=str_replace("™", "&trade;",$productDesc);
					$sizeDesc=$row['sizeDesc'];
					$sizesku=$row['sizesku'];
					$tot=$price*$qty;
					$sumtot+=$tot;
					$extra=$row['extra'];
					$extra_amt=$row['extra_amt'];
					$productID=$row['productID'];


						$body.="".$qty." - ".$productDesc." - $".number_format($price, 2, '.', ',')."\n";}

					//	$body.="------------------------------------------------------------------------------\n";
				
			
					$totfin=$sumtot+$ship_price+$rate;
					$body."\n\n\n";
									$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
									$body.="Shipping: $".number_format($rate, 2, '.', ',')."\n";
									$body.="Total: $".number_format($totfin, 2, '.', ',')."\n";
									$body.="\n";
									#if($ship_state=='CT'){
									#	$body.="Energize CT Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
									$body.="Order Processing Info
									
We will notify you by email if any item in your order will be delayed or if it is backordered. 

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt\n";
					
		
		mail($to,$subject,$body,"From:".$from."");
		mail($to=$email,$subject="Thank you for your Cascade Water Free Water Saving Items order from techniart.us",$body,"From:".$from."");
	}
				
			

	session_unset();

	//Show Thank You Page
?>
<? $sql="select util from tblTerritory where zip='$ship_zip'";
#print("".$sql."<br>");
$result=db_query($sql);
while($rowzip=mysql_fetch_array($result)){
		$util=$rowzip['util'];}
#print $util;
#		print("sess:".$_SESSION['st']."<br>");?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><br>
      <span class="cart">Your order has been successfully processed. <br>
<br>
You will receive an email receipt shortly both from us and from our e-commerce gateway confirming your order.</span><br><br>
        <span class="cart">Thank you for participating in this limited time offer. <br>
<br>
</td>
  </tr>
</table>

<? break;

case 2:
break;

case 3:
//Show Declined Page with reason
?>
<table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="cart">We're Sorry your credit card was declined for the following reason: <br><br>
      <font color="ff0000"><?php echo $authnet_results['x_response_reason_text']; ?></font> <br>
      <br>
<?
		$startdate=date("m-d-Y H:m:s");
		$a=$_POST['a'];
		$companyName=$_POST['companyName'];
		$membertype=$_POST['membertype'];
		$firstname=$authnet_results['firstname'];
		$lastname=$authnet_results['lastname'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$address=$_POST['address'];
		$price=$_POST['price'];
		$address2=$_POST['address2'];
		$phone=$_POST['phone'];
		$fax=$_POST['fax'];
		$url=$_POST['url'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$zip=$_POST['zip'];
		$email=$_POST['email'];
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		$optin=$_POST['optin'];
		$optin_stamp=$date;

?>
	  <form method="post" action="orderform.php">
	  <input type="hidden" name="reason" value="Y">
	  <input type="hidden" name="fname" value="<? echo($fname); ?>">
	  <input type="hidden" name="lname" value="<? echo($lname); ?>">
	  <input type="hidden" name="address" value="<? echo($address); ?>">
	  <input type="hidden" name="address2" value="<? echo($address2); ?>">
	  <input type="hidden" name="city" value="<? echo($city); ?>">
	  <input type="hidden" name="price" value="<? echo($price); ?>">
	  <input type="hidden" name="state" value="<? echo($state); ?>">
  	  <input type="hidden" name="zip" value="<? echo($zip); ?>">
	  <input type="hidden" name="email" value="<? echo($email); ?>">
	  <input type="submit" value="click here to submit your transaction again"></form> </td>
  </tr>
</table>

<?
break;

default:

echo "<center><font face='verdana' size='1'><font color='ff0000'><b>Error:</b></font> cURL program is not setup correctly. <br> 
Please contact <a href='mailto:support@authnetscripts.com'>support@authnetscripts.com</a> for assistance.</font></center>"; 

}
}
?>
</td>
  </tr>
</table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? #include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div></div></div>
</body>

</html>


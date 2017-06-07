<? include("database.php");?>
<html>
<head>
<title>TechniArt - Cambridge Online Sale</title>
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<style type="text/css">
<!--
body,td,th {
	color: #000000;
}
a:link {
	color: #FFFFFF;
}
a:visited {
	color: #FFFFFF;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<BODY>
<div align="center"><? include("header.php");?>
<!-- ------------------------------begin header------------------------------ -->
<!-- ------------------------------end header------------------------------ -->
<center><div class="rcorners2">
<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="rcorners3"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">
<br>
<img src="thanks.jpg" width="870" height="401" alt=""/>
<?
print("<div style=\"padding-left:55px;\"><p class=\"body_content_style1\">");
if($amount=='8.00'){
	print("There appears to be an issue with your order. It has timed out due to inactivity in your browsing session (a security feature to protect you). Please <a class=\"body_content_style1\" href=\"https://www.techniart.us/Cambridge/cart.php\">click here</a> to return to your cart.<br>");
}else{
#ini_set('display_errors','On');

/*************************************************
// Program: PHPAUTHNET AIM
// Version: 2.0
// Author: Hasan Robinson 
// Copyright (c) 2002,2003 AuthnetScripts.us// All rights reserved.
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

include_once('phpauthnet_aim.php');





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
	$cust=$authnet['custid'];
	$order=$authnet['invoice_num'];
	$card=$authnet['cardnum'];
	$last4=substr($card,-4);
	$card="xxxx-xxxx-xxxx-".$last4;
	$sess=$authnet['md1'];
	$otsID=$authnet['md2'];
	$duty=$authnet['duty'];
	$expdate=$authnet['expdate'];
	$ship_price=$_POST['ship_price'];
	$cardcode=$authnet['card_code'];
	$cctype=$authnet['md9'];
	$amount=$authnet['amount'];
	$fname=$_POST['fname']; 
	$lname=$_POST['lname'];
	$firstname=$authnet['fname']; 
	$lastname=$authnet['lname'];
	$address1=$_POST['address1'];
	$address2=$_POST['address2'];
	$city=$_POST['city']; 
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$email=$authnet['email'];
	$instr=$authnet['md3'];
	$tax=$_POST['tax'];
	$ship_firstname=$_POST['ship_fname'];
	$ship_lastname=$_POST['ship_lname'];
	$ship_address=$_POST['ship_address1'];
	$ship_city=$_POST['ship_city'];
	$ship_state=$_POST['ship_state'];
	$ship_zip=$_POST['ship_zip'];
	$ship_firstname=$_POST['ship_fname'];
	$ship_lastname=$_POST['ship_lname'];
	$ship_address2=$_POST['ship_address2'];
	$ship_city=$_POST['ship_city'];
	$ship_state=$_POST['ship_state'];
	$ship_zip=$_POST['ship_zip'];
	
	$sql="insert into tblOrdersCompleted(otsID, stamp, ship_firstname, ship_lastname, ship_address, ship_address2, ship_city, ship_state, ship_zip, instructions, bill_firstname, bill_lastname, bill_address, bill_address2, bill_city, bill_state, bill_zip, email, email_opt, email_opt1, email_opt2, shipping, tax, amount, status)	values('$otsID', '$date', '$ship_firstname', '$ship_lastname', '$ship_address', '$ship_address2', '$ship_city', '$ship_state', '$ship_zip', '$instr','$fname', '$lname', '$address1', '$address2', '$city', '$state', '$zip', '$email', '$email_opt','$email_opt1','$email_opt2', '$ship_price', '$tax', '$amount', 'Closed')";
	$result=db_query($sql);
	$next=mysql_insert_id();
	
	$shiptot=$ship_price;
	$dt=date("Y-m-d");
	$sdt=date("Y-m-d h:i:s");
	$transID=$authnet['transid'];

	$sql2="update tblorderstosend set status='Closed' where otsID='$otsID'";
	$result2=db_query($sql2);

#fulfillment e-mail
$to="ma-orders@techniart.com";
$from="sales@techniart.com";
$subject="Cambridge Online Order - techniart.com";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);

#grab unnotified orders
	$sqla="select * from tblOrdersCompleted where completeID='$next'";
	$resulta=db_query($sqla);
	$counta=mysql_num_rows($resulta);
	$i=1;
	if($counta){
		while($rowa=mysql_fetch_array($resulta)){
			$completeID=$rowa['completeID'];
			$otsID=$rowa['otsID'];
			$amount=$rowa['amount'];
			$stamp=$rowa['stamp'];
			//$ps=strtotime($stamp);
			$prettystamp=strftime("%y",$stamp).strftime("%m",$stamp).strftime("%d",$stamp);
			$card=$rowa['card'];
			$newcard=substr($card,-4);
		    $add="XXXX-XXXX-XXXX-".$newcard;
			$exp=$rowa['exp'];
			$card_code=$rowa['card_code'];
			$internalorderID=$rowa['internalorderID'];
			$ship_firstname=$rowa['ship_firstname'];
			$ship_lastname=$rowa['ship_lastname'];
			$ship_address=$rowa['ship_address'];
			$ship_address2=$rowa['ship_address2'];
			$ship_city=$rowa['ship_city'];
			$ship_state=$rowa['ship_state'];
			$ship_zip=$rowa['ship_zip'];
			$ship_country=$rowa['ship_country'];
			$bill_firstname=$rowa['bill_firstname'];
			$bill_lastname=$rowa['bill_lastname'];
			$bill_address=$rowa['bill_address'];
			$bill_address2=$rowa['bill_address2'];
			$bill_city=$rowa['bill_city'];
			$type=$rowa['type'];
			$bill_state=$rowa['bill_state'];
			$bill_zip=$rowa['bill_zip'];
						$instructions=$rowa['instructions'];

//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";

			$body.="Thank you for participating in Eversource's special offer. Your order was received on ".date("m/d/Y H:i:s").". Please find the details of your order below.\n\n";
			$body.="BILLING INFO:\n";
			$body.="Name: ".$fname." ".$lname."\n";
			$body.="Address: ".$address1." ".$address2."\n";
			$body.="".$city.", ".$state." ".$zip."\n\n";
			
			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_firstname." ".$ship_lastname."\n";
			$body.="Address: ".$ship_address." ".$ship_address2."\n";
			$body.="".$ship_city.", ".$ship_state." ".$ship_zip."\n\n";
						
			$body.="Email: ".$email."\n\n";
									
			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="NJNG Online Order - techniart.com";

		
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
					#check for discounts based on zip if they haven't already entered it.
						$zz=$ship_zip;
						$sqlz="select tblDiscounts.*,tblProducts.MSRP,tblProducts.disct_price from tblDiscounts LEFT OUTER JOIN tblProducts on tblDiscounts.item_no=tblProducts.modelNumber where tblProducts.productID='$itemNo' && zip='$zz'";
#						print($sqlz);
						$resultz=db_query($sqlz);
						$countz=mysql_num_rows($resultz);
						if($countz>0){
							$price_old=$price;
							while($rowz=mysql_fetch_array($resultz)){
								$MSRP=$rowz['MSRP'];
								$disct_price=$rowz['disct_price'];
							}
							$diff1+=$MSRP-$disct_price;
						}
					#end discount check


						$body.="".$qty." - ".$productDesc." - $".number_format($price, 2, '.', ',')."\n";

					//	$body.="------------------------------------------------------------------------------\n";
				}
			}
					$totfin=$sumtot+$tax+$ship_price;
					$body."\n\n\n";
					$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
					$body.="Shipping: ".number_format($ship_price, 2, '.', ',')."\n";
					$body.="".$ship_state." Sales Tax: $".number_format($tax, 2, '.', ',')."\n";
					$body.="Total: $".number_format($totfin, 2, '.', ',')."\n";
					$body.="\n";
					#if($ship_state=='CT'){
					#					$body.="Energize CT Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
					#				$body.="\n";
									$body.="Order Processing Info
									
Eversource's Cambridge online offer is available from Monday, November 14th through early December or while supplies last. We will send out a verification email when we begin shipping. Please leave up to 7 business days to receive your order.

We will notify you by email if any item in your order will be delayed or if it is backordered. 

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt & Eversource\n";		
					}

		
#		}
		mail($to,$subject,$body,"From:".$from."");
		mail($to=$email,$subject="Thank you for your Cambridge order from techniart.com",$body,"From:".$from."");
	}
				
			

	session_unset();

	//Show Thank You Page
?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="section_heading_style2"><br>
    </span><span class="product_title_sm"><br>    
    Thank you for your order!<br>
      <br>
      Your order has been successfully processed. <br>
      <br>
      You will receive an email receipt shortly both from us and from our e-commerce gateway confirming your order.<br>
        </span><span class="section_heading_style2"><br>
        </span></td>
  </tr>
</table>

<? break;

case 2:
break;

case 3:
//Show Declined Page with reason
?>
<p>&nbsp;</p><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="body">We're Sorry your credit card was declined for the following reason: <br><br>
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
</td>
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
</p><br>
</div></td>
<td></td>
</tr></table>

</td>
</tr></table>
</div>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->

</body>
</html>
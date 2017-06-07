<? include("database.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - MassSavers Facebook Fan Bundle Sale Order Completion</title>
<meta http-equiv="refresh" content="5; URL=https://www.facebook.com/MassSavers/">
<meta name="keywords" content="automatic redirection">
<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
<script language="javascript" type="text/javascript">
	<!--
		function fVerifyResForm() {
			var oForm = document.form1;	
			var errFlag = 0;
			var errStr = "Oops, looks like you missed a required field.\n";

			if (oForm.fname.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing first name.\n";
			}

			if (oForm.lname.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing last name.\n";
			}

			if (oForm.address1.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing address.\n";
			}

			if (oForm.city.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing city.\n";
			}

			if (oForm.state.value=='') {
				errFlag = 1;
				errStr = errStr + "Please enter your billing state.\n";
			}

			if (oForm.zip.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing zip.\n";
			}

			if (oForm.country.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your billing country.\n";
			} 

			if (oForm.email.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your email address.\n";
			} else {
				if (!(fCheckEmail(oForm.email.value))) {
					errFlag = 1;
					errStr = errStr + "Please enter a valid email address.\n";
				}
			}

			if (oForm.ship_fname.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping address first name.\n";
			}

			if (oForm.ship_lname.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping address last name.\n";
			}

			if (oForm.ship_address1.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping address.\n";
			}

			if (oForm.ship_city.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping city.\n";
			}

			if (oForm.ship_state.value=='') {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping state.\n";
			}

			if (oForm.ship_zip.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping zip.\n";
			}

			if (oForm.ship_country.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your shipping country.\n";
			}


			if (oForm.firstName.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter the name that appears on your credit card.\n";
			}
			if (oForm.creditCardType[0].checked || oForm.creditCardType[1].checked || oForm.creditCardType[2].checked || oForm.creditCardType[3].checked ) {
			}else{
				errFlag = 1;
				errStr = errStr + "Please select a credit card type.\n";
			}
			if (oForm.creditCardNumber.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your credit card number.\n";
			}
			if (oForm.expDateMonth.value== '') {
				errFlag = 1;
				errStr = errStr + "Please enter your credit card expiration month.\n";
			}

			if (oForm.expDateYear.value== '') {
				errFlag = 1;
				errStr = errStr + "Please enter your credit card expiration year.\n";
			}

			if (oForm.cvv2Number.value.length == 0) {
				errFlag = 1;
				errStr = errStr + "Please enter your credit card verification number.\n";
			}

 
			if (errFlag == 0) {
				return true;
				oForm.submit();
			} else {
				alert(errStr);
				return false;
			}
		}
		
		function fCheckEmail(strEmail) {
			re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
      if (re.test(strEmail)) {
      	return true;
      } else {
      	return false;
      }
		}
	//-->
	</script></head>

<BODY>
<table width="760" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="760" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Order Completion </span></div></td>
</tr></table>
<table width="760" height="350" border="0" cellpadding="0" cellspacing="0" class="bkg_body-main">
  <tr valign="top">
<td width="760">
<br>
<?
print("<div style=\"padding-left:55px;\"><p class=\"body_content_style1\">");
if($amount=='8.00'){
	print("There appears to be an issue with your order. It has timed out due to inactivity in your browsing session (a security feature to protect you). Please <a class=\"body_content_style1\" href=\"http://www.techniart.com/facebook/cart.php\">click here</a> to return to your cart.<br>");
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
	$cardcode=$authnet['card_code'];
	$cctype=$authnet['md9'];
	$amount=$authnet['amount'];
	$packages=$authnet['description'];
	$firstname=$authnet['firstname']; 
	$lastname=$authnet['lastname'];
	$phone=$authnet['phone'];
	$fax=$authnet['fax'];
	$xship=$authnet['md4'];
	$type=$authnet['md9'];
	$address=$authnet['address'];
	$address2=$authnet['address2'];
	$city=$authnet['city']; 
	$state=$authnet['state'];
	$zip=$authnet['zip'];
	$country=$authnet['country'];
	$company=$authnet['company'];
	$email=$authnet['email'];
	$instr=$authnet['md3'];
	$tax=$authnet['tax'];
	$customer_ip=$authnet['customer_ip'];
	$ship_firstname=$authnet['ship_firstname'];
	$ship_lastname=$authnet['ship_lastname'];
	$ship_address=$authnet['ship_address'];
	$ship_city=$authnet['ship_city'];
	$ship_state=$authnet['ship_state'];
	$ship_zip=$authnet['ship_zip'];
	$ship_country=$authnet['ship_country'];
	$sql="insert into tblOrdersCompleted_facebook(sess, otsID, card, exp, card_code, amount, stamp, ship_firstname, ship_lastname, 	ship_address, ship_city, ship_state, ship_zip, ship_country, instructions, bill_firstname, bill_lastname, bill_address, bill_city, bill_state, bill_zip, bill_country, ship_amt, xship, type, ship_address2, bill_address2, email, status, phone,tax)	values('$sess', '$otsID', '$card', '$expdate', '$cardcode', '$amount', '$date', '$ship_firstname', '$ship_lastname', '$ship_address', '$ship_city', '$ship_state', '$ship_zip', '$ship_country', '$instr','$firstname', '$lastname', '$address','$city', '$state', '$zip', '$country','$ship_price','','','$ship_address2','$address2','$email','Closed','$phone','$tax')";
	$result=db_query($sql);
	$next=mysql_insert_id();
	
	$shiptot=$ship_price;
	$dt=date("Y-m-d");
	$sdt=date("Y-m-d h:i:s");
	$transID=$authnet['transid'];

	$sql2="update tblorderstosend_facebook set status='Closed' where otsID='$otsID'";
	$result2=db_query($sql2);

#fulfillment e-mail
$to="jason@techniart.com,orders@techniart.com,adam@techniart.com";
$from="sales@techniart.com";
$subject="MassSavers Facebook Fan Bundle Order - techniart.com";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);

#grab unnotified orders
	$sqla="select * from tblOrdersCompleted_facebook where completeID='$next'";
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
			$xship=$rowa['xship'];
			$type=$rowa['type'];
			$bill_state=$rowa['bill_state'];
			$bill_zip=$rowa['bill_zip'];
			$bill_country=$rowa['bill_country'];
			$instructions=$rowa['instructions'];

//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";

			$body.="Order just received on ".date("m/d/Y H:i:s")."\n\n";

			$body.="BILLING INFO:\n";
			$body.="Name: ".$bill_firstname." ".$bill_lastname."\n";
			$body.="Address:".$bill_address." ".$bill_address2."\n";
			$body.="".$bill_city.",".$bill_state."  ".$bill_zip." ";

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_firstname." ".$ship_lastname."\n";
			$body.="Address:".$ship_address." ".$ship_address2."\n";
			$body.="".$city.",".$ship_state."  ".$ship_zip." ";
					
			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="MassSavers Facebook Fan Bundle Order - techniart.com";

		
			#end customer receipt
			$sql="select * from tblotsdetail_facebook where otsID='$otsID' order by otsdetailID desc";
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
						$sqlz="select tblDiscounts.*,tblProducts_facebook.MSRP,tblProducts_facebook.disct_price from tblDiscounts LEFT OUTER JOIN tblProducts on tblDiscounts.item_no=tblProducts_facebook.modelNumber where tblProducts_facebook.productID='$itemNo' && zip='$zz'";
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
					$totfin=$sumtot+$tax;
					$body."\n\n\n";
					$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
					$body.="".$ship_state." Sales Tax: $".number_format($tax, 2, '.', ',')."\n";
					$body.="Total: $".number_format($totfin, 2, '.', ',')."\n";
					$body.="Order Processing Info:
					 
Please allow 3-5 days for shipping.  If you have any questions, please email customerservice@techniart.com.

We will notify you by email if any item in your order will be delayed or if it is on backorder status.  TechniArt is not responsible for misdirected or undeliverable packages.

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt\n";
					$body.="\n";
					if($ship_state=='CT'){
						$body.="CEEF Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
					}

		
		}
		mail($to,$subject,$body,"From:".$from."");
		mail($to=$email,$subject="Thank you for your Mass Savers Facebook Fan Bundle order from techniart.com",$body,"From:".$from."");
	}

	session_unset();

	//Show Thank You Page
?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="body_content_style2">Thank You !<br>
      <br>
      Your order has been successfully processed. You will receive an email receipt shortly both from TechniArt and from our e-commerce gateway, Bluepay, confirming your order.<br>
        <br>
</span></td>
  </tr>
</table>

<? break;

case 2:
break;

case 3:
//Show Declined Page with reason
?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="product_title">We're Sorry your credit card was declined for the following reason:</span> <br>
      <br>
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

?></td>
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
</td>

</tr></table>
<table width="760" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="back-bottom.jpg" width="760" height="25"></td>
  </tr>
</table>
</body>
</html>


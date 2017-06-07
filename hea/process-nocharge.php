<? include("database.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Marketing The Future</title>

<meta name="robots" content="index,follow" />
<meta name="author" content="TechniArt" />
<meta name="publisher" content="techniart.com" />
<meta name="copyright" content="Copyright 2008 TechniArt. All Rights Reserved" />
<meta http-equiv="content-language" content="EN" />
<meta name="content-language" content="EN" />
<meta name="rating" content="All" />
<meta name="audience" content="General" />
<meta name="distribution" content="Global" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
</head>

<BODY>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<!--
body {
	background-color: #F0F0F0;
}
-->
</style></head>

<BODY>
<?php include("bluebar.php") ?><?php include("analyticstracking.php") ?><br>


<center><div align="center" class="fbwhitebox"><table width="760" height="15"border="0" align="center" cellpadding="0" cellspacing="0" background="back-top.jpg">
  <tr>
    <td></td>
  </tr>
</table>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="bkg_body-main">
  <tr valign="top">

<td width="760"><div id="main_content_ip" align="left">

<p class="body_content_style1">
<?
	//document the order in the database
	$stamp=mktime();
#	$date=date("m-d-Y H:m:s");
	$date=mktime();
	$promocode=$_SESSION['code'];	
	$sql="insert into tblOrdersCompleted(sess, otsID, card, exp, card_code, amount, stamp, ship_firstname, ship_lastname, ship_address, ship_city, ship_state, ship_zip, ship_country, instructions, bill_firstname, bill_lastname, bill_address, bill_city, bill_state, bill_zip, bill_country, ship_amt, xship, promocode, ship_address2, bill_address2, email, status, phone,tax)	values('$sess', '$otsID', '$card', '$expDateYear', '$creditCardNumber', '$amount', '$date', '$ship_fname', '$ship_lname', '$ship_address1', '$ship_city', '$ship_state', '$ship_zip', '$ship_country', '$instr','$firstName', '$lastName', '$address1','$city', '$state', '$zip', '$country','$ship_price','','$promocode','$ship_address2','$address2','$email','Closed','$phone','$tax')";
	$result=db_query($sql);
	$next=mysql_insert_id();
	
	$shiptot=$ship_price;
	$dt=date("Y-m-d");
	$sdt=date("Y-m-d h:i:s");
	$transID=$authnet['transid'];

	$sql2="update tblorderstosend set status='Closed' where otsID='$otsID'";
	$result2=db_query($sql2);

#fulfillment e-mail
$to="jason@techniart.com";
$from="sales@techniart.com";
$subject="PSE Home Print APS Order - techniart.com";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);

//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";
			$body.="Order just received on ".date("m/d/Y H:i:s")."\n\n";
			$body.="BILLING INFO:\n";
			$body.="Name: ".$firstName." ".$lastName."\n";
			$body.="Address: ".$address1." ".$address2."\n";
			$body.="".$city.", ".$state." ".$zip."\n";
			$body.="Billing County: ".$country."\n\n";

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_fname." ".$ship_lname."\n";
			$body.="Address: ".$ship_address1." ".$ship_address2."\n";
			$body.="".$ship_city.", ".$ship_state." ".$ship_zip."\n";
			$body.="Shipping County: ".$ship_country."\n\n";
			
			$body.="Phone: ".$phone."\n";
			$body.="Email: ".$email."\n\n";

			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="AEP Texas Order - techniart.com";

		
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
						$sqlz="select tblDiscounts.*,tblProducts.MSRP,tblProducts_enterg.disct_price from tblDiscounts LEFT OUTER JOIN tblProducts on tblDiscounts.item_no=tblProducts.modelNumber where tblProducts.productID='$itemNo' && zip='$zz'";
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
				
			
					$totfin=$sumtot+$ship_price+$tax;
					$body."\n\n\n";
									$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
									$body.="Shipping: $".number_format($ship_price, 2, '.', ',')."\n";
									$body.="Total: $".number_format($totfin, 2, '.', ',')."\n";
									$body.="\n";
									$body.="Order Processing Info
									
Our normal business hours are Monday - Friday, 9:00AM - 5:00PM EST. Please allow for processing time when you place your order. We do not process or ship orders on Saturday or Sunday. We observe the following company holidays which will affect order processing times: New Year's Day, Memorial Day, Fourth of July, Labor Day, Thanksgiving Day and Christmas Day.
  
We will notify you by email if any item in your order is on back order status. If you have a back order situation, you will be notified by email. Neither TechniArt nor Champion Energy Services is responsible for misdirected or undeliverable packages.

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt Inc.\n";
					}
		
		mail($to,$subject,$body,"From:".$from."");
		mail($to=$email,$subject="Thank you for your order from techniart.com",$body,"From:".$from."");
	}
				
$sqlu="update tblPromo set status='2' where code='$promocode'";
	$resultu=db_query($sqlu);			

	session_unset();

	//Show Thank You Page
?>
<table width="646" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="646"><span class="product_title">Thank you for your order!<br>
      <br>
      Your order has been successfully processed. You will receive an email receipt shortly both from TechniArt as welll as  from our e-commerce gateway, Bluepay, confirming your order.<br>
        <br>
        If you have any questions in regards to your order, please contact <a href="mailto:customerservice@techniart.com">customerservice@techniart.com</a>.</span></td>
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
</p></td>
</tr></table></td>
</tr></table>
<table width="760" height="15"border="0" align="center" cellpadding="0" cellspacing="0" background="back-bottom.jpg">
  <tr>
    <td></td>
  </tr>
</table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


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
<? if($_SESSION['rep']=="CNP"){?><link rel="STYLESHEET" type="text/css" href="cnp.css"><?;}?>
<? if($_SESSION['rep']=="AEP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="NQ"){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
<? if($_SESSION['rep']==""){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
</head>

<BODY>
<?php include_once("analyticstracking.php") ?>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->
<center><div class="rcorners2">
<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div id="title_spacer" align="left"><span class="title_main">Order Processed</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="rcorners3"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">

<p class="body_content_style1">
<?
	$stamp=mktime();
#	$date=date("m-d-Y H:m:s");
	$date=mktime();
	$otsID=$_POST['otsID'];
	$amount=$_POST['amount'];
	$ship_firstname=$_POST['ship_fname'];
	$ship_lastname=$_POST['ship_lname'];
	$ship_address=$_POST['ship_address1'];
	$ship_address2=$_POST['ship_address2'];
	$ship_city=$_POST['ship_city'];
	$ship_state=$_POST['ship_state'];
	$ship_zip=$_POST['ship_zip'];
	$ship_county=$_POST['ship_county'];
	$firstname=$_POST['firstname']; 
	$lastname=$_POST['lastname'];
	$phone=$_POST['phone'];
	$fax=$_POST['fax'];
	$xship=$_POST['md4'];
	$type=$_POST['md9'];
	$address=$_POST['address'];
	$address2=$_POST['address2'];
	$city=$_POST['city']; 
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$county=$_POST['county'];
	$company=$_POST['company'];
	$email=$_POST['email'];
	$rep=$_POST['rep'];
	$instr=$_POST['instr'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$coupon=$_POST['coupon'];
	$discount=$_POST['discount'];
	$sql="insert into tblOrdersCompleted_brilliant(sess, otsID, card, exp, card_code, amount, stamp, ship_firstname, ship_lastname, 	ship_address, ship_city, ship_state, ship_zip, ship_county, instructions, bill_firstname, bill_lastname, bill_address, bill_city, bill_state, bill_zip, bill_county, ship_amt, xship, type, ship_address2, bill_address2, email, status, phone,coupon)	values('$sess', '$otsID', '$card', '$expdate', '$cardcode', '$amount', '$date', '$ship_firstname', '$ship_lastname', '$ship_address', '$ship_city', '$ship_state', '$ship_zip', '$ship_county', '$instr','$firstname', '$lastname', '$address','$city', '$state', '$zip', '$county','$ship_price','','$rep','$ship_address2','$address2','$email','Closed','$phone','$coupon')";
	$result=db_query($sql);
	$next=mysql_insert_id();
	$sqlu="update tblCoupon_brilliant set value='0',status='2' where code='$coupon'";
	$resultu=db_query($sqlu);
	$shiptot=$ship_price;
	$dt=date("Y-m-d");
	$sdt=date("Y-m-d h:i:s");
	$transID=$_POST['transid'];

	$sql2="update tblorderstosend_brilliant set status='Closed' where otsID='$otsID'";
	$result2=db_query($sql2);
	
#fulfillment e-mail
$to="tx-orders@techniart.com";
$from="sales@techniart.com";
$subject="FREE Frontier ".$rep." Order - techniart.com";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);

#grab unnotified orders
	$sqla="select * from tblOrdersCompleted_brilliant where completeID='$next'";
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
			$ship_firstname=$rowa['ship_firstname'];
			$ship_lastname=$rowa['ship_lastname'];
			$ship_address=$rowa['ship_address'];
			$ship_address2=$rowa['ship_address2'];
			$ship_city=$rowa['ship_city'];
			$ship_state=$rowa['ship_state'];
			$ship_zip=$rowa['ship_zip'];
			$ship_county=$rowa['ship_county'];
			$instructions=$rowa['instructions'];
			$email=$rowa['email'];
			$phone=$rowa['phone'];
			$coupon=$rowa['coupon'];

//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";
			$body.="Order just received on ".date("m/d/Y H:i:s")."\n\n";

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_firstname." ".$ship_lastname."\n";
			$body.="Address: ".$ship_address." ".$ship_address2."\n";
			$body.="".$ship_city.", ".$ship_state." ".$ship_zip."\n";
			$body.="Shipping County: ".$ship_county."\n\n";
			
			$body.="Phone: ".$phone."\n";
			$body.="Email: ".$email."\n\n";

			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="Champion Energy Services Order - techniart.com";

		
			#end customer receipt
			$sql="select * from tblotsdetail_brilliant where otsID='$otsID' order by otsdetailID desc";
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
					$productID=$row['productID'];}}
									$body.="".$qty." - ".$productDesc." - $".number_format($price, 2, '.', ',')."\n";

					//	$body.="------------------------------------------------------------------------------\n";
			
									$totfin=$sumtot+$ship_price-$discount;
									
									$body."\n\n\n";
									$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
									if($ship_price==0){
									$body.="Shipping: FREE\n";
									}else{
									$body.="Shipping: ".number_format($ship_price, 2, '.', ',')."\n";}
									if($discount>0){$body.="Discount: $-".number_format($discount, 2, '.', ',')."\n";}
									$body.="Total: $".number_format($totfin, 2, '.', ',')."\n";
									$body.="\n";
									
									#if($ship_state=='CT'){
									#	$body.="Energize CT Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
									$body.="\n";
									$body.="Order Processing Info
									
Our normal business hours are Monday - Friday, 9:00AM - 5:00PM EST. Please allow for processing time when you place your order. We do not process or ship orders on Saturday or Sunday. We observe the following company holidays which will affect order processing times: New Year's Day, Memorial Day, Fourth of July, Labor Day, Thanksgiving Day and Christmas Day.
  
We will notify you by email if any item in your order is on back order status. If you have a back order situation, you will be notified by email. TechniArt is not responsible for misdirected or undeliverable packages.

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt Inc.\n";
					}
		
		mail($to,$subject,$body,"From:".$from."");
		mail($to=$email,$subject="Thank you for your order from techniart.com",$body,"From:".$from."");

	}
				
			

	session_unset();

	//Show Thank You Page
?>
<table width="646" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="646"><span class="product_title">Thank you for your order!<br>
      <br>
      Your order has been successfully processed. You will receive an email receipt shortly from TechniArt confirming your order.<br>
        <br>
        If you have any questions in regards to your order, please contact <a href="mailto:customerservice@techniart.com">customerservice@techniart.com</a>.</span></td>
<br>
<br>

  </tr>
</table>

</td>
  </tr>
</table>
</div></td>
<td></td>
</div>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


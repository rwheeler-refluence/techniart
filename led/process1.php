<? include("database.php"); ?>

<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<title>Order Processed</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
</head>
<BODY><?php include_once("analyticstracking.php") ?>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?>
    <table width="95%" border="0">
        <tr>
          <td align="center">
<?

	//document the order in the database
	$stamp=mktime();
#	$date=date("m-d-Y H:m:s");
	$date=mktime();
	$otsID=$_POST['otsID'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$address1=$_POST['address1'];
	$address2=$_POST['address2'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
		$ship_fname=$_POST['ship_fname'];
	$ship_lname=$_POST['ship_lname'];
	$ship_address1=$_POST['ship_address1'];
	$ship_address2=$_POST['ship_address2'];
	$ship_city=$_POST['ship_city'];
	$ship_state=$_POST['ship_state'];
	$ship_zip=$_POST['ship_zip'];
$sqlc="select * from tblOrdersCompleted_led where otsID='$otsID'";
	#print($sql);
	$resultc=db_query($sqlc);
	$countc=mysql_num_rows($resultc);
	if($countc>'0'){
	echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Order ID already exists.')
		window.location.href='http://www.techniart.com/led'
        </SCRIPT>";
		die();	}


	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$pledge=$_POST['pledge'];
$customer=$_POST['customer'];
$swear=$_POST['swear'];
	$phone=$_POST['phone'];
	$tax=$_POST['tax'];
	$amount=$_POST['amount'];
	$instr=$_POST['instr'];
	$sql="insert into tblOrdersCompleted_led(otsID, stamp, ship_firstname, ship_lastname, ship_address, ship_address2, ship_city, ship_state, ship_zip, instructions, bill_firstname, bill_lastname, bill_address, bill_address2, bill_city, bill_state, bill_zip, email, phone, pledge, customer, swear, tax, amount, status)values('$otsID', '$date', '$ship_fname', '$ship_lname', '$ship_address1','$ship_address2','$ship_city', '$ship_state', '$ship_zip', '$instr', '$fname', '$lname', '$address1','$address2','$city', '$state', '$zip','$email','$phone', '$pledge', '$customer', '$swear', '$tax', '$amount', 'Closed')";
	$result=db_query($sql);
	$next=mysql_insert_id();
	$sql2="update tblorderstosend_led set status='Closed' where otsID='$otsID'";
	$result2=db_query($sql2);

#fulfillment e-mail
$to="jason@techniart.com";
$from="sales@techniart.com";
$subject="SDG&E LED LTO Order - techniart.com";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);


//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";
			$body.="Thank you for participating in SDG&E’s special offer. Your order was received on ".date("m/d/Y H:i:s").". Please find the details of your order below.\n\n";
			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_fname." ".$ship_lname."\n";
			$body.="Address: ".$ship_address1." ".$ship_address2."\n";
			$body.="".$ship_city.", ".$ship_state." ".$ship_zip."\n\n";

			$body.="CONTACT INFO:\n";
			$body.="Phone: ".$phone."\n";						
			$body.="Email: ".$email."\n\n";

			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="PSE Order - techniart.com";

		
			#end customer receipt
			$sql="select * from tblotsdetail_led where otsID='$otsID' order by otsdetailID desc";
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


						$body.="".$qty." - ".$productDesc." - $".number_format($price, 2, '.', ',')."\n";

					//	$body.="------------------------------------------------------------------------------\n";
				}
			
					$totfin=$sumtot+$ship_price+$tax;
					$body."\n\n\n";
									$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
									$body.="Tax: $".number_format($tax, 2, '.', ',')."\n";
									$body.="Total: $".number_format($totfin, 2, '.', ',')."\n";
									$body.="\n";
									#if($ship_state=='CT'){
									#	$body.="Energize CT Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
									$body.="\n";
									$body.="Order Processing Info

Thank you for participating in the SDG&E LED giveaway promotion.

Please visit http://marketplace.sdge.com for more great deals!

Please allow up to 15 days for delivery from the date of purchase.

We will notify you by email if any item in your order will be delayed or if it is backordered. 

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.

Sincerely,

TechniArt Inc.\n";
					
		
		mail($to,$subject,$body,"From:".$from."");
		mail($to=$email,$subject="Thank you for your SDG&E LED order from techniart.com",$body,"From:".$from."");
	}
				
			

	session_unset();

	//Show Thank You Page
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="95%"><span class="cart-header">Thank you for your order!<br>
      <br>
      Your order has been successfully processed. You will receive an email receipt shortly from TechniArt confirming your order.<br>
        <br>
        If you have any questions in regards to your order, please contact <a href="mailto:customerservice@techniart.com">customerservice@techniart.com</a>.<br>
<br>
Shop for energy-efficient appliances and water-saving products with eligible rebates on <a href="marketplace.sdge.com">SDG&E Marketplace</a>.</span></td>
  </tr>
</table>

</td>
  </tr>
</table>

</p></td>
</tr></table></td>
</tr></table>

<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?></div>
</div>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


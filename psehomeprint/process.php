<? include("database.php"); ?>
<? 	$sql="select * from tblOrdersCompleted where otsID='$otsID'";
	#print($sql);
	$result=db_query($sql);
	$count=mysql_num_rows($result);
	if($count>'0'){
	echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Order ID already exists.')
		window.location.href='http://www.techniart.us/psehomeprint'
        </SCRIPT>";
		die();	}

?>
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
<?php include("bluebar.php") ?><center><div class="fbwhitebox"><?php include("header.php") ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div id="title_spacer" align="left"><span class="title_main">Order Placed</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">

<p class="body_content_style1">
<?
	//document the order in the database
	$stamp=mktime();
#	$date=date("m-d-Y H:m:s");
	$date=mktime();
	$sess=$_POST['sess'];
	$otsID=$_POST['otsID'];
	
	$company=$_POST['company'];
	$email=$_POST['email'];
	$instr=$_POST['instr'];
	$tax=$_POST['tax'];
	$customer_ip=$_POST['customer_ip'];
	$ship_firstname=$_POST['ship_fname'];
	$ship_lastname=$_POST['ship_lname'];
	$ship_address=$_POST['ship_address1'];
	$ship_city=$_POST['ship_city'];
	$ship_state=$_POST['ship_state'];
	$ship_zip=$_POST['ship_zip'];
	$ship_country=$_POST['ship_country'];
	$sql="insert into tblOrdersCompleted(otsID, stamp, ship_firstname, ship_lastname, ship_address, ship_address2, ship_city, ship_state, ship_zip, instructions, access_company, tracking, ship_date, status)	values('$otsID', '$stamp', '$ship_firstname', '$ship_lastname', '$ship_address', '$ship_address2', '$ship_city', '$ship_state', '$ship_zip', '$instructions', '$access_company', '', '', '')";
	$result=db_query($sql);
	$next=mysql_insert_id();
	
	$shiptot=$ship_price;
	$dt=date("Y-m-d");
	$sdt=date("Y-m-d h:i:s");
	$transID=$_POST['transid'];

	$sql2="update tblorderstosend set status='Closed' where otsID='$otsID'";
	$result2=db_query($sql2);

#fulfillment e-mail
$to="psehp@techniart.com";
$from="sales@techniart.com";
$subject="PSE HomePrint Order - techniart.us";

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
						$bill_country=$rowa['bill_country'];
			$instructions=$rowa['instructions'];

//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";
			$body.="Order just received on ".date("m/d/Y H:i:s")."\n\n";

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_firstname." ".$ship_lastname."\n";
			$body.="Address: ".$ship_address." ".$ship_address2."\n";
			$body.="".$city.", ".$ship_state." ".$ship_zip."\n\n";
			
			$body.="Special Instructions: ".$instr."\n\n";

			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="Amigo Energy Order - techniart.com";

		
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
					$case_quantity=$row['case_quantity'];
					$productDesc=$row['productDesc'];
					$productDesc=str_replace("™", "&trade;",$productDesc);
					$sizeDesc=$row['sizeDesc'];
					$sizesku=$row['sizesku'];
					$tot=$price*$qty;
					$sumtot+=$tot;
					$extra=$row['extra'];
					$extra_amt=$row['extra_amt'];
					$productID=$row['productID'];
					$tot_qty=$qty*$case_quantity;
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


						$body.="".$tot_qty." - ".$productDesc." (".$qty." case(s)(".$case_quantity."/case)\n";

					//	$body.="------------------------------------------------------------------------------\n";
				}
			}
					$totfin=$sumtot+$ship_price+$tax;
					$body."\n\n\n";
									#$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
									#$body.="Shipping: $".number_format($ship_price, 2, '.', ',')."\n";
									#$body.="Total: $".number_format($totfin, 2, '.', ',')."\n";
									$body.="\n";
									#if($ship_state=='CT'){
									#	$body.="Energize CT Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
									$body.="\n";
									$body.="Order Processing Info
									
Our normal business hours are Monday - Friday, 9:00AM - 5:00PM EST. Please allow for processing time when you place your order. We do not process or ship orders on Saturday or Sunday. We observe the following company holidays which will affect order processing times: New Year's Day, Memorial Day, Fourth of July, Labor Day, Thanksgiving Day and Christmas Day.
  
We will notify you by email if any item in your order is on back order status. If you have a back order situation, you will be notified by email. Neither TechniArt nor PSE is responsible for misdirected or undeliverable packages.

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt Inc.\n";
					}
		
		mail($to,$subject,$body,"From:".$from."");
		mail($to=$email,$subject="Thank you for your PSE Homeprint order from techniart.us",$body,"From:".$from."");
	}
				

	//Show Thank You Page
?>
<table width="646" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="646"><span class="product_title">Thank you for your order!<br>
      <br>
      We will send you and email with your receipt.  You can also print your order from the Previous Orders page.
        <br>
        If you have any questions in regards to your order, please contact customerservice@techniart.com.</span></td>
  </tr>
</table>


</p><br>
</div></td>
</td>
<td></td>
</tr></table>

</td>
</tr></table>

<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>

</html>


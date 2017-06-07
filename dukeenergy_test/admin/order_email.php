<?php include("database.php");?>
<?php include("secure.php");?>
<? $key='2037290784';?>
<?php
$to="jason@techniart.com";
#fulfillment e-mail
$from="sales@techniart.com";
$subject="Thank you for your Eversource energy-saving starter set order from techniart.com";
$headers = "From: " . $from . "\r\n";
$headers .= "BCC: ". $bcc . "\r\n";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);

$next=$_GET['ID'];

#grab unnotified orders
$sqla="select otsID, stamp, ship_firstname, AES_DECRYPT(ship_lastname, '$key') as ship_lastname, AES_DECRYPT(ship_address, '$key') as ship_address, AES_DECRYPT(ship_address2, '$key') as ship_address2, AES_DECRYPT(ship_city, '$key') as ship_city, ship_state, ship_zip, instructions, bill_firstname, AES_DECRYPT(bill_lastname, '$key') as bill_lastname, AES_DECRYPT(bill_address, '$key') as bill_address, AES_DECRYPT(bill_address2, '$key') as bill_address2, AES_DECRYPT(bill_city, '$key') as bill_city, bill_state, bill_zip, AES_DECRYPT(email, '$key') as email, tax, amount from tblOrdersCompleted where completeID='$next'";
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
			$email=$rowa['email'];
			$tax=$rowa['tax'];
			$ship_firstname=$rowa['ship_firstname'];
			$ship_lastname=$rowa['ship_lastname'];
			$ship_address=$rowa['ship_address'];
			$ship_address2=$rowa['ship_address2'];
			$ship_city=$rowa['ship_city'];
			$ship_state=$rowa['ship_state'];
			$ship_zip=$rowa['ship_zip'];
			$bill_firstname=$rowa['bill_firstname'];
			$bill_lastname=$rowa['bill_lastname'];
			$bill_address=$rowa['bill_address'];
			$bill_address2=$rowa['bill_address2'];
			$bill_city=$rowa['bill_city'];
			$bill_state=$rowa['bill_state'];
			$bill_zip=$rowa['bill_zip'];
			$stmp=strftime("%D %H:%M:%S",$rowa['stamp']);
			$instructions=$rowa['instructions'];}}

//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";

			$body.="Thank you for participating in Eversource’s special offer. Your order was received on ".$stmp.". Please find the details of your order below.\n\n";
			$body.="BILLING INFO:\n";
			$body.="Name: ".$bill_firstname." ".$bill_lastname."\n";
			$body.="Address: ".$bill_address." ".$bill_address2."\n";
			$body.="".$bill_city.", ".$bill_state."  ".$bill_zip."\n\n";

			$body.="Email: ".$email."\n\n";
		

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_firstname." ".$ship_lastname."\n";
			$body.="Address: ".$ship_address." ".$ship_address2."\n";
			$body.="".$ship_city.", ".$ship_state."  ".$ship_zip."\n\n";
			
			$body.="Special Instructions: ".$instr."\n\n";

			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="Mass Savers' SlimStyle LED 3-Pack Order - techniart.com";

		
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
					$productID=$row['productID'];}
					
					$body.="".$qty." - ".$productDesc." - $".number_format($price, 2, '.', ',')."\n";
					$totfin=$sumtot+$tax;
					$body."\n\n\n";
					$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
					$body.="Shipping: FREE\n";
					$body.="".$ship_state." Sales Tax: $".number_format($tax, 2, '.', ',')."\n";
					$body.="Total: $".number_format($totfin, 2, '.', ',')."\n\n";
									
					$body.="Order Processing Info
									
Eversource's energy-saving starter set offer is available from Friday, May 6th 2016 through Sunday, May 15th, 2016 or while supplies last. All orders will be processed, packed and shipped after the promotion has ended. We will send out a verification email when we begin shipping. All orders should be delivered no later than Friday, May 27th.

We will notify you by email if any item in your order will be delayed or if it is backordered. 

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt & Eversource\n";
					
		
		#mail($to,$subject,$body,"From:".$from."");
		#mail($to=$email,$subject="Thank you for your Eversource energy-saving starter set order from techniart.com",$body,"From:".$from."");
		}
print("<pre>");
print($body);
print("</pre>");

<? include("database.php");
$db=$_GET['db'];
$next=$_GET['ID'];
$table='tblOrdersCompleted_'. $db;
$table1='tblotsdetail_'. $db;
$rep=$_GET['rep'];
#echo $db;
#echo $next;
#echo $table;
#echo $table1;
#echo $rep; ?>
<?php

#fulfillment e-mail
$to="tx-orders@techniart.com";
#$to="george@crucialnetworking.com";
$from="sales@techniart.com";
$subject="Amigo Energy Order - techniart.com";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);



#grab unnotified orders
	$sqla="select * from $table where type='$rep' && completeID='$next'";
	#print $sql;
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
			$ship_county=$rowa['ship_county'];
			$bill_firstname=$rowa['bill_firstname'];
			$bill_lastname=$rowa['bill_lastname'];
			$bill_address=$rowa['bill_address'];
			$bill_address2=$rowa['bill_address2'];
			$bill_city=$rowa['bill_city'];
			$xship=$rowa['xship'];
			$type=$rowa['type'];
			$bill_state=$rowa['bill_state'];
			$bill_zip=$rowa['bill_zip'];
			$bill_county=$rowa['bill_county'];
			$instructions=$rowa['instructions'];
			$stmp=strftime("%D %H:%M:%S",$rowa['stamp']);
			$ship_amt=$rowa['ship_amt'];
			$phone=$rowa['phone'];
			$email=$rowa['email'];

//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";
			$body.="Order just received on ".$stmp."\n\n";
			$body.="BILLING INFO:\n";
			$body.="Name: ".$bill_firstname." ".$bill_lastname."\n";
			$body.="Address: ".$bill_address." ".$bill_address2."\n";
			$body.="".$bill_city.", ".$bill_state." ".$bill_zip."\n";
			$body.="Billing County: ".$bill_county."\n\n";

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_firstname." ".$ship_lastname."\n";
			$body.="Address: ".$ship_address." ".$ship_address2."\n";
			$body.="".$ship_city.", ".$ship_state." ".$ship_zip."\n";
			$body.="Shipping County: ".$ship_county."\n\n";
			
			$body.="Phone: ".$phone."\n";
			$body.="Email: ".$email."\n\n";
			
			$body.="Special Instructions: ".$instructions."\n\n";

			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="Champion Energy Services Order - techniart.com";

			#end customer receipt
			$sql="select * from $table1 where otsID='$otsID' order by otsdetailID desc";
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
							$diff1=$MSRP-$disct_price;
						}
					#end discount check


						$body.="".$qty." - ".$productDesc." - $".number_format($price, 2, '.', ',')."\n";

					//	$body.="------------------------------------------------------------------------------\n";
				}
			}
					$totfin=$sumtot+$tax+$ship_amt;
									$body."\n\n\n";
									$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
									$body.="Shipping: $".number_format($ship_amt, 2, '.', ',')."\n";
									$body.="Total: $".number_format($totfin, 2, '.', ',')."\n";
									$body.="\n";
									#if($ship_state=='CT'){
										#$body.="Energize CT Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
									$body.="\n";
									
									$body.="Order Processing Info
									
Our normal business hours are Monday - Friday, 9:00AM - 5:00PM EST. 
Please allow for processing time when you place your order. We do not 
process or ship orders on Saturday or Sunday. We observe the following 
company holidays which will affect order processing times: New Year's Day, 
Memorial Day, Fourth of July, Labor Day, Thanksgiving Day and Christmas Day.
  
We will notify you by email if any item in your order is on back order status. 
If you have a back order situation, you will be notified by email. 
TechniArt is not responsible for misdirected or undeliverable packages.

Thank you for your order. We appreciate your business and we're here to help! 
If you need any assistance concerning your order please feel free to email us 
at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt Inc.\n";

		
		}
						#mail($to,$subject,$body,"From:".$from."");
						#mail($to=$email,$subject="Thank you for your order from techniart.com",$body,"From:".$from."");
		}
print("<pre>");
print($body);
print("</pre>");
#print("Done!");


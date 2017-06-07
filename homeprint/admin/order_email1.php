<?php include("database.php");?>
<?php include("secure.php");?>
<?php

#fulfillment e-mail
$to="jason@techniart.com";
$from="sales@techniart.com";
$subject="National Grid Power Savings Pack Order - techniart.com";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);

$next=$_GET['ID'];

#grab unnotified orders
	$sqla="select * from tblOrdersCompleted_dealsinri16 where completeID='$next'";
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
			$email=$rowa['email'];
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
			$stmp=strftime("%D %H:%M:%S",$rowa['stamp']);
			$tax=$rowa['tax'];
			$ship_amt=$rowa['ship_amt'];
			$amount=$rowa['amount'];

//			$body.="Sent on: ".date("m/d/Y H:i:s")."\n\n";

			$body.="Order placed on ".$stmp."\n\n";
			$body.="BILLING INFO:\n";
			$body.="Name: ".$bill_firstname." ".$bill_lastname."\n";
			$body.="Address:".$bill_address." ".$bill_address2."\n";
			$body.="".$bill_city.", ".$bill_state."  ".$bill_zip." ";
			$body.="\n\n";

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_firstname." ".$ship_lastname."\n";
			$body.="Address:".$ship_address." ".$ship_address2."\n";
			$body.="".$ship_city.", ".$ship_state."  ".$ship_zip."\n\n";

			$body.="Email: ".$email."\n\n";

			$body.="Shipping Method: Eastern Connection\n\n";

			$body.="Order Contents:\n";
			
			#customer receipt
			$to1=$email;
			$from1="sales@techniart.com";
			$subject1="National Grid Power Savings Pack Order - techniart.com";

		
			#end customer receipt
			$sql="select * from tblotsdetail_dealsinri16 where otsID='$otsID' order by otsdetailID desc";
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
					$totfin=$sumtot+$tax;
									$body."\n\n\n";
									$body.="\nSubtotal: $".number_format($sumtot, 2, '.', ',')."\n";
									$body.="Shipping: $".number_format($ship_amt, 2, '.', ',')."\n";
									$body.="".$ship_state." Sales Tax: $".number_format($tax, 2, '.', ',')."\n";
									$body.="Total: $".number_format($amount, 2, '.', ',')."\n";
									$body.="\n";
									$body.="Order Processing Info
									
Offer good from Friday, March 14th @ 9:00am through Sunday, March 23rd @ 11:59pm EST. All orders will be processed, packed and shipped after the end of the event.  We will send out a verification email when our courier begins delivering.  All orders should be delivered no later than Friday, April 11th.  Keep in mind that shipping times could be extended due to severe weather.

We will notify you by email if any item in your order will be delayed or if it is backordered.  TechniArt and National Grid are responsible for misdirected or undeliverable packages.  If your package is returned as misdirected or undeliverable we will work with you to set up an alternate shipping option.

Thank you for your order. We appreciate your business and we're here to help!  If you need any assistance concerning your order please feel free to email us at cs-ripack@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt & National Grid

P.S. Interested in other energy savings offers from National Grid? 
Please visit www.nationalgridus.com/ri-ee to learn more.\n\n";

									if($ship_state=='CT'){
										$body.="Energize CT Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
									$body.="\n";
					}

		
		}
						mail($to,$subject,$body,"From:".$from."");
						mail($to=$email,$subject="Thank you for your order from techniart.com",$body,"From:".$from."");
					}
					
print("<pre>");
print($body);
print("</pre>");
print("Done!");
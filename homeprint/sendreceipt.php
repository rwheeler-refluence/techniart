<?
#fulfillment e-mail
$to="jason@techniart.com";
$from="sales@techniart.com";
$subject="Mass Save Power Savings Pack Order - techniart.com";

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
			$body.="Address: ".$bill_address." ".$bill_address2."\n";
			$body.="".$bill_city.", ".$bill_state."  ".$bill_zip."\n\n";
			$body.="Email: ".$email."\n\n";

			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_firstname." ".$ship_lastname."\n";
			$body.="Address: ".$ship_address." ".$ship_address2."\n";
			$body.="".$city.", ".$ship_state."  ".$ship_zip."\n\n";
			
			$body.="Special Instructions: ".$instr."\n\n";

			$body.="Order Contents:\n";
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
					$productDesc=str_replace("�", "&trade;",$productDesc);
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
					$body.="\nShipping: FREE\n";
					$body.="".$ship_state." Sales Tax: $".number_format($tax, 2, '.', ',')."\n";
					$body.="Total: $".number_format($totfin, 2, '.', ',')."\n\n";
					$body.="Order Processing Info:
					 
Offer good from Friday, January 24th @ 9:00am through Sunday, February 2nd @ 11:59pm EST. Please allow between 5-7 days for shipping from the end of the promotion.

We will notify you by email if any item in your order will be delayed or if it is on backorder status.  TechniArt is not responsible for misdirected or undeliverable packages.

Thank you for your order. We appreciate your business and we're here to help! If you need any assistance concerning your order please feel free to email us at customerservice@techniart.com or call us at 888-285-7290.
  
Sincerely,

TechniArt\n";
					$body.="\n";
					if($ship_state=='AZ'){
						$body.="CEEF Discount Applied: ($".number_format($diff1, 2, '.', ',').")\n";			
					}

		
		}

	}

	session_unset();

	//Show Thank You Page

?>
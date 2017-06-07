<?
/*function ship($weight,$otsID,$zip,$tot){
	if($weight==0){
		$quote="0.00";
		$_SESSION['ship']=$quote;
	}else{
		if(!$weight){
			$weight=".50";
		}
		$method="GND";
#		$weight=$weight+1.50;
		require("ups.php");
		$rate = new Ups;
		$rate->upsProduct("".$method."");   // See upsProduct() function for codes
		$rate->origin("06022 ", "US"); // Use ISO country codes!
		$rate->dest("".$zip."", "US");   // Use ISO country codes!
		$rate->rate("RDP");// See the rate() function for codes
		$rate->container("CP"); // See the container() function for codes
		$rate->weight($weight);
		$rate->rescom("RES");   // See the rescom() function for codes
		$quote1 = $rate->getQuote();
		$additl=0;
		if($quote1<1){
			$quote1=ceil($tot*.10);
		}
		$quote=number_format($quote1+$additl, 2, '.', '');

		$_SESSION['ship']=$quote;
		$ship=$quote;
	}
		print("".$quote."\n");
		print("<input type=\"hidden\" name=\"ship\" value=\"".$quote."\">\n");
#print_r($rate);
}*/

function ship($weight,$otsID,$zip,$tot){
	require("ups_extended.php");
	$service = '03';
	$length = '20';
	$width = '10';
	$height = '10';
	$weight = $weight;
	if($weight==0){
		$quote="0.00";
		$_SESSION['ship']=$quote;
	}else{
		if(!$weight){
			$weight=".50";
		}
	}
	$dest_zip = $zip;


	$rate = ups($dest_zip,$service,$weight,$length,$width,$height);
	if($rate<1){
		$rate1=ceil($tot*.10);
		$rate=number_format($rate1+$additl, 2, '.', '');
	}
	$ship=$rate;
	print("".$rate."\n");
	return $rate;
	return $ship;
	$_SESSION['ship']=$rate;
	return $_SESSION['ship'];
	print("<input type=\"hidden\" name=\"ship\" value=\"".$rate."\">\n");
}

?>

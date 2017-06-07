<?
if($_GET['zip']){
	$zip=$_GET['zip'];
	$weight=$_GET['weight'];
	$tot="100";
	$otsID="99";
	
	function ship($weight,$otsID,$zip,$tot){
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
		print("<br>");
		print("<input type=\"hidden\" name=\"ship\" value=\"".$quote."\">\n");
		print_r($rate);
		print("<br>");
	}
ship($weight,$otsID,$zip,$tot);
}
?>
<form method="get" action="<? echo($_SERVER['PHP_SELF']);?>">
zip:<input type="text" name="zip" size="5" value="<? echo($zip);?>"><br><br>
weight: (lbs)<input type="text" name="weight" size="5" value="<? echo($weight);?>"><br><br>
<input type="submit" value="submit"></form>
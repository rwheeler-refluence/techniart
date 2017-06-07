<? #include("database.php"); ?>
<?
#session_start();
$ID=$_SESSION['otsID'];
$zip=$_SESSION['zip'];
$sql="select * from tblotsdetail LEFT OUTER JOIN tblProducts on tblotsdetail.itemNo=tblProducts.productID where tblotsdetail.otsID='$ID'";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$wgt=explode(" ",$row['weight']);
	$weight = $wgt[0];
	$qty=$row['qty'];
	$totwgt+=$weight*$qty;
}
	$weightplus=$totwgt+1;
	$_SESSION['weight']=$weightplus;


	if($_SESSION['ship_carrier'] && $_SESSION['ship_desc'] && $_SESSION['ship_amt'] && $_SESSION['res'] && $_SESSION['ship_code']){
		require 'combined/autoload.php'; // This autoloads RocketShipIt classes
		switch($_SESSION['ship_carrier']){
			case "USPS":
				$rate1 = new \RocketShipIt\Rate('USPS');
				$rate1->setParameter('toCode',$_SESSION['zip']);
				$rate1->setParameter('weight',$_SESSION['weight']);
				$response1 = $rate1->getSimpleRates();
				foreach($response1 as $key=>$val){
					if($val[service_code]==$_SESSION['ship_code']){
						$_SESSION['ship_amt']=$val[rate];
					}
				}
			break;

			case "UPS":
			$rate = new \RocketShipIt\Rate('UPS');

				$rate->setParameter('toCode',$zip);
				$rate->setParameter('weight',$_SESSION['weight']);
				$rate->setParameter('residentialAddressIndicator',$res);

				$response = $rate->getSimpleRates();
				foreach($response as $key=>$val){
					if($val[service_code]==$_SESSION['ship_code']){
						$_SESSION['ship_amt']=$val[rate];
					}
				}
			break;
		}
	}
?>

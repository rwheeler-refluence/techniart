<? include("database.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Order Placed</title>

<meta property="og:site_name" content="SDG&amp;E Therm Kit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="mobile.css"/>
                <link rel="stylesheet" type="text/css" href="boilerplate.css"/>
    <!--[if lt IE 9]>
    <script src="/static/bootstrap/3.3.0/js/html5shiv.js"></script>
    <script src="/static/bootstrap/3.3.0/js/respond.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/ie8.css">

<![endif]-->

<style>
body { background: #0878b5;}
</style>
</head>
<body><?php include("analyticstracking.php") ?>
<? include("header.php");?>
<!-- Begin content -->
<br>
<br>
<br>
<br>
<br>

<div class="main" ><br>
<br>
<br>
  

<?
$date=mktime();
$ship_fname=$_POST['ship_fname'];
$ship_lname=$_POST['ship_lname'];
$ship_streetnum=$_POST['ship_streetnum'];
$ship_unit1=$_POST['ship_unit1'];
$ship_route=$_POST['ship_route'];
$ship_city=$_POST['ship_city'];
$ship_state=$_POST['ship_state'];
$ship_zip=$_POST['ship_zip'];
$ship_zip4=$_POST['ship_zip4'];
$email=$_POST['email'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$streetnum=$_POST['streetnum'];
$route=$_POST['route'];
$unit1=$_POST['unit1'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$zip4=$_POST['zip4'];
$pledge=$_POST['pledge'];
$opt=$_POST['opt'];
$customer=$_POST['customer'];
$swear=$_POST['swear'];
$source=$_POST['source'];
$company=("SDG&E Retail Kit");
$instr=$_POST['instr'];

	$sql="insert into tblOrdersCompleted_verified(stamp, fname, lname, streetnum, route, unit1, city, state, zip, zip4, email, ship_fname, ship_lname, ship_streetnum, ship_route, ship_unit1, ship_city, ship_state, ship_zip, ship_zip4, pledge, customer, swear, source)	values('$date','$fname','$lname', '$streetnum', '$route', '$unit1', '$city', '$state', '$zip', '$zip4', '$email', '$ship_fname', '$ship_lname', '$ship_streetnum', '$ship_route', '$ship_unit1', '$ship_city', '$ship_state','$ship_zip', '$ship_zip4','$pledge','$customer','$swear', '$source')";
	$result=db_query($sql);
	$next=mysql_insert_id();
		
#fulfillment e-mail
$to="sd-orders@techniart.com";
$from="SDGEWaterSavingsKit@techniart.com";
$subject="FREE SDGE Therm Kit Order - techniart.com";

#grab today's date
$today=strtotime(date("m/d/Y"));
$tomorrow=$today+86400;
$tomorrow_display=strftime("%D",$tomorrow);

#grab unnotified orders
	$sqla="select * from tblOrdersCompleted_verified where completeID='$next'";
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

			$body.="SERVICE ADDRESS INFO:\n";
			$body.="Name: ".$fname." ".$lname."\n";
			$body.="Address: ".$streetnum." ".$route." ".$unit1."\n";
			$body.="".$city.", ".$state." ".$zip."\n\n";
			
			
			$body.="SHIPPING INFO:\n";
			$body.="Name: ".$ship_fname." ".$ship_lname."\n";
			$body.="Address: ".$ship_streetnum." ".$ship_route." ".$ship_unit1."\n";
			$body.="".$ship_city.", ".$ship_state." ".$ship_zip."\n\n";

			$body.="Email: ".$email."\n\n";

			
			
			#customer receipt
			$to1=$email;
			$from1="jason@techniart.com";
			$subject1="Champion Energy Services Order - techniart.com";

		
			#end customer receipt
			$sql="select * from tblotsdetail_verified where otsID='$otsID' order by otsdetailID desc";
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
}}
					//	$body.="------------------------------------------------------------------------------\n";
			
									$totfin=$sumtot+$ship_price-$discount;
									
									
									$body.="Order Processing Info
									
Thank you for your order. We appreciate your interest and are happy to serve you.
 
A few things you should know:
·         If any item in your request is on back order status, we will notify you by email.
·         Please note any orders received on 12/9/16 will be placed on a waiting list with shipping to begin in mid-February. We apologize for any inconvenience this may bring.
 
In the meantime, if you’d like to learn more about no-cost energy tips, go to sdge.com. Be sure to visit SDG&E’s Marketplace [marketplace.sdge.com] to learn more about energy efficient appliances, rebates and purchase products directly from participating retailers.
 
Once again, thank you! If you need any assistance concerning your order, please feel free to email us at customerservice@techniart.com or call us at 888-285-7290. Our normal business hours are Monday - Friday, 9:00AM - 5:00PM EST. Please allow for processing time when you place your order. We do not process or ship orders on Saturday or Sunday. We observe the following company holidays which will affect order processing times: New Year's Day, Memorial Day, Fourth of July, Labor Day, Thanksgiving Day and Christmas Day.
 
Sincerely,
TechniArt Inc.\n";
					}
		
		#mail($to,$subject,$body,"From:".$from."");
		mail($to=$email,$subject="Thank you for your SDG&E Water & Energy Savings Kit order",$body,"From:".$from."");

	}
				
			

	session_unset();

	//Show Thank You Page
?>
<table width="646" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="646"><span class="cart"><br><script type="text/javascript">
<!--
function Redirect()
{
    window.location="http://www.techniart.us/sdgeverifiedkit/thanks.php";
}
document.write("<center><img src=\"animation_processing.gif\" width=\"100\" height=\"100\"></center>");
setTimeout('Redirect()', 1500);
//-->
</script></td>
<br>
<br>

  </tr>
</table>
</div>
<!-- End content -->
<? include("footer.php");?>
</body>
</html>

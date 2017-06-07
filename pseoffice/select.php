<? include("database.php");?>
<? $cat='Combos';?>
<? $show='Yes'; ?>
<?
session_start();
$action=$_GET['action'];
$keyword=$_GET['keyword'];
$sort1=$_GET['sort'];
if(!$sort1){
	$sort="productID";
}else{
	$sort="".$sort1.",productID";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>Select your product</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="ddimgtooltip.css">
<script type="text/javascript" src="ddimgtooltip.js"></script>
<script type="text/javascript">
function loadContent(elementSelector, sourceUrl) {
	$(""+elementSelector+"").load(sourceUrl);
	
}
</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<title>Special offer from PSE</title>
</head>
<BODY><?php include_once("analyticstracking.php") ?><? include("bluebar.php")?>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>
</div></center>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1">
<div id="main_content_ip" align="left">
<?
$sqlp.="select * from tblProducts_pse where category='$cat' ";
$sqlp.=" && productPub='Yes' order by $sort asc";

#print($sqlp);
$resultp=db_query($sqlp);
$countp=mysql_num_rows($resultp);
if($countp==1){
	$label="result";
}else{
	$label="results";
}
$i=1;

	//print("<br><a class=\"title_main\" href=\"store-cat.php?cat=".$cat."\"><b>".$cat." </a>");
	//if($subcat){
		//print(" - <a class=\"title_main\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."\">".$subcat."</a>");
	//}
	//if($subcat1){
		//print(" - <a class=\"title_main\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat1."\">".$subcat1."</a>");
	//}
	//print("</b></span><br>");
	//if(!$subcat){
		//$sqlsubs="select distinct subcat1 from tblProducts where category='$cat' && subcat1!='' order by $sort asc";
		//$resultsubs=db_query($sqlsubs);
		//$countsubs=mysql_num_rows($resultsubs);
		//$subs=1;
		//while($rowsubs=mysql_fetch_array($resultsubs)){
		//	$subcat1=$rowsubs['subcat1'];
			//print("<a class=\"product_title\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat1."\">".$subcat1."</a>");
			//if($subs<$countsubs){
				//print("&nbsp;&nbsp;|&nbsp;&nbsp;");
			//}
			//$subs++;
		//}
		//if($countsubs>0){
			//print("<br>");
		//}
	//}else{
		//$sqlsubs="select distinct subcat2 from tblProducts where subcat1='$subcat' && category='$cat' && subcat2!='' order by subcat2 asc";
		//$resultsubs=db_query($sqlsubs);
		//$countsubs=mysql_num_rows($resultsubs);
		//$subs=1;
		//while($rowsubs=mysql_fetch_array($resultsubs)){
			//$subcat2=$rowsubs['subcat2'];
			//print("<a class=\"product_title\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat2."\">".$subcat2."</a>");
			//if($subs<$countsubs){
				//print("&nbsp;&nbsp;|&nbsp;&nbsp;");
			//}
			//$subs++;
		//}
		//if($countsubs>0){
			//print("<br><br>");
		//}
	//}
	//print("<br>\n");

?>
<!-- ------------------------------begin products - row <? echo($i);?>------------------------------ -->
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?
#	print("state:".$_SESSION['st']."<br>");
while($rowp=mysql_fetch_array($resultp)){
	$productID=$rowp['productID'];
	$productName=$rowp['productName'];
	$modelNumber=$rowp['modelNumber'];
	$MSRP=number_format($rowp['MSRP'], 2, '.', ',');
	$nomsrp="";
	
					$price=number_format($rowp['disct_price'], 2, '.', ',');
					if($rowp['disct_price']!==$rowp['MSRP']){
						$nomsrp="Yes";
						$show="Yes";
					}else{
						$nomsrp="No";
						$show="No";
					}
	$imageLoc=$rowp['imageLoc'];
	$modelNumber=$rowp['modelNumber'];
		$watts_used=$rowp['watts_used'];
			$replace=$rowp['replacement_wattage'];
	$loc="http://www.techniart.us/pseoffice/pix/products/thumbnails/".$imageLoc;
?>
<td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td colspan="2" align="center">
</td></tr><tr>
<td width="420"><span class="cart-header"><? echo($productName);?></span><br>

<span class="cart-header">$<? echo($price);?></span></td>
<td width="340">
<form method="post" action="https://www.techniart.us/pseoffice/cart.php">
<input type="hidden" name="action" value="add">
<input type="hidden" name="productID" value="<? echo($productID);?>">
<input type="hidden" name="modelNumber" value="<? echo($modelNumber);?>">
<input type="hidden" name="qty" value="1">
<input type="hidden" name="price" value="<? echo($price);?>">
<input type="hidden" name="productName" value="<? echo($productName);?>">
<input type="button" class="btn2" alt="Buy now" value=" Buy Now" onClick="this.form.submit();"><br />
</form><br />
<? if(!$_SESSION['']){?>
<br /><?}?>
</td>
</tr></form><br></table>

</td>
<? //if($i>1 && $i%2!==0){?>
<!--<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>-->
<? //}?>
<? if($i>1 && $i%3==0){?>
<? $j=$i+1;?>
</tr></table>
<!-- ------------------------------end products - row <? echo($i);?>------------------------------ -->

<!-- ------------------------------begin products - row <? echo($j);?>------------------------------ -->
<table width="760" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?}?>
<?$i++;?>
<?}?>
<?
$eval=$i-1;
$num=2-$eval;
for($ee=0;$ee<$num;$ee++){
	print("<td width=\"250\"><img src=\"pix/pix_trans.gif\" width=\"250\" height=\"1\"></td>\n");
}
?>
</td>
</tr></table>
<!-- ------------------------------end products - row 3------------------------------ -->

</td>
<td></td>
</tr></table>

<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?></div></div>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
</html>

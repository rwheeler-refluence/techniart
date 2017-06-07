<? include("database.php");?>
<?
$action=$_GET['action'];
$keyword=$_GET['keyword'];
$sort1=$_GET['sort'];
if(!$sort1){
	$sort="class";
}else{
	$sort="".$sort1.",productID";
}
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
<? if($_SESSION['rep']=="CNP"){?><link rel="STYLESHEET" type="text/css" href="cnp.css"><?;}?>
<? if($_SESSION['rep']=="AEP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="TNMP"){?><link rel="STYLESHEET" type="text/css" href="aep.css"><?;}?>
<? if($_SESSION['rep']=="NQ"){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
<? if($_SESSION['rep']==""){?><link rel="STYLESHEET" type="text/css" href="nq.css"><?;}?>
</head>

<BODY>
<?php include_once("analyticstracking.php") ?>

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->
<center><div class="rcorners2">
<!-- ------------------------------begin body------------------------------ -->
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><div align="left" class="cp_title" id="title_spacer">PRODUCT CATEGORIES</div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="rcorners3"><tr valign="top">
<td></td>
<td width="904"><div id="main_content_ip" align="left">

<? include("zip.php");?>
<?
$subcat=$_GET['subcat'];
$subcat1=$_GET['subcat1'];
$sqlp.="select * from tblProducts where category='$cat' ";
if($subcat){
$sqlp.="&& subcat1='$subcat'";
	}
	if($subcat1){
		$sqlp.="&& subcat2='$subcat1'";
	}
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

	print("<br><br>	<a class=\"title_main\" href=\"store-cat.php?cat=".$cat."\"><b>".$cat." </a>");
	if($subcat){
		print(" - <a class=\"title_main\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."\">".$subcat."</a>");
	}
	if($subcat1){
		print(" - <a class=\"title_main\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat1."\">".$subcat1."</a>");
	}
	print("</b></span><br>");
	if(!$subcat){
		$sqlsubs="select distinct subcat1 from tblProducts where category='$cat' && subcat1!='' order by $sort asc";
		$resultsubs=db_query($sqlsubs);
		$countsubs=mysql_num_rows($resultsubs);
		$subs=1;
		while($rowsubs=mysql_fetch_array($resultsubs)){
			$subcat1=$rowsubs['subcat1'];
			print("<a class=\"product_title1\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat1."\">".$subcat1."</a>");
			if($subs<$countsubs){
				print("&nbsp;&nbsp;|&nbsp;&nbsp;");
			}
			$subs++;
		}
		if($countsubs>0){
			print("<br>");
		}
	}else{
		$sqlsubs="select distinct subcat2 from tblProducts where subcat1='$subcat' && category='$cat' && subcat2!='' order by subcat2 asc";
		$resultsubs=db_query($sqlsubs);
		$countsubs=mysql_num_rows($resultsubs);
		$subs=1;
		while($rowsubs=mysql_fetch_array($resultsubs)){
			$subcat2=$rowsubs['subcat2'];
			print("<a class=\"product_title\" href=\"store-cat.php?cat=".$cat."&subcat=".$subcat."&subcat1=".$subcat2."\">".$subcat2."</a>");
			if($subs<$countsubs){
				print("&nbsp;&nbsp;|&nbsp;&nbsp;");
			}
			$subs++;
		}
		if($countsubs>0){
			print("<br><br>");
		}
	}
	print("<br>\n");

?>
<!-- ------------------------------begin products - row <? echo($i);?>------------------------------ -->
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?
#	print("state:".$_SESSION['st']."<br>");
while($rowp=mysql_fetch_array($resultp)){
	$productID=$rowp['productID'];
	$productName=$rowp['productName'];
	$modelNumber=$rowp['modelNumber'];
	$MSRP=number_format($rowp['MSRP'], 2, '.', ',');
	$nomsrp="";
	if($_SESSION['rep']=="CNP" || $_SESSION['rep']=="AEP" || $_SESSION['rep']=="TNMP"){
 			$sqlprice="select * from tblProducts where tblProducts.modelNumber='$modelNumber'";
		#	print($sqlprice);
			$resultprice=db_query($sqlprice);
			while($rowprice=mysql_fetch_array($resultprice)){
					$price=number_format($rowprice['disct_price'], 2, '.', ',');
					if($rowp['disct_price_nj']!==$rowp['MSRP']){
						$nomsrp="Yes";
						$show="Yes";
					}
			}
		
	}else{
		if($_SESSION['rep']="NQ"){
		$price=number_format($rowp['disct_price_nj'], 2, '.', ',');
		$nomsrp="Yes";
		$show="Yes";
}}
	$imageLoc=$rowp['imageLoc'];
	$modelNumber=$rowp['modelNumber'];
			$loc=$rootDir."cpe/pix/products/thumbnails/".$imageLoc;
			
			list($width, $height, $type, $attr) = getimagesize($loc);
				if($width>106){
					$newwidth_divisor=106/$width;
					$height=$height*$newwidth_divisor;
					$width=$width*$newwidth_divisor;
				}else{
					$width=$width;
					$height=$height;
				}

?>
<td width="275">
<form method="post" action="cart.php">
<input type="hidden" name="action" value="add">
<table width="275" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<td width="106"><a href="store-detail.php?ID=<? echo($productID);?>&show=<? echo($show);?>"><img src="<? echo($loc);?>" alt="<? echo($productName);?>" width="<? echo($width);?>" height="<? echo($height);?>" border="0" class="img_stroke"></a></td>
<td width="123"><img src="pix/pix_trans.gif" width="123" height="1"><br><span class="product_title"><? echo($productName);?></span><br>
<span class="product_number">#<? echo($modelNumber);?></span><br><br>
<? if($nomsrp=='Yes'){?>
<span class="product_price"><strike>$<? echo($MSRP);?></strike></span><br>
<?}?>
<span class="product_price">$<? echo($price);?></span><br>
<? if(!$_SESSION['']){?>
<input type="hidden" name="productID" value="<? if($productID==12){echo($productID=46);}else if($productID==13){echo($productID=45);}else if($productID==14){echo($productID=47);}else if($productID==15){echo($productID=48);}else if($productID==16){echo($productID=49);}else if($productID==17){echo($productID=50);}else if($productID==29){echo($productID=51);}else if($productID==30){echo($productID=52);}else if($productID==31){echo($productID=53);}else if($productID==32){echo($productID=59);}else if($productID==33){echo($productID=61);}else if($productID==34){echo($productID=60);}else if($productID==40){echo($productID=54);}else if($productID==41){echo($productID=55);}else if($productID==42){echo($productID=56);}else if($productID==43){echo($productID=57);}else if($productID==44){echo($productID=58);}else{echo($productID);}?>
">
<input type="hidden" name="modelNumber" value="<? echo($modelNumber);?>">
<input type="hidden" name="qty" value="1">
<input type="hidden" name="price" value="<? echo($price);?>">
<input type="hidden" name="productName" value="<? echo($productName);?>">
<input type="hidden" name="rep" value="<? echo($_SESSION['rep']);?>">
<input type="button" alt="Buy now" value="Buy now" class="btn4" width="55" height="19" border="0" onClick="this.form.submit();">
<?}?>
<input type="button" alt="More Info" value="More Info" class="btn5" width="83" height="27" border="0" onClick="location.href='store-detail.php?ID=<? echo($productID);?>&show=<? echo($show);?>'"></td>
</tr></form><br></table>

</td>
<? if($i>1 && $i%2!==0){?>
<!--<td width="14"><img src="pix/pix_trans.gif" alt="" width="14" height="1" border="0"></td>-->
<?}?>
<? if($i>1 && $i%3==0){?>
<?$j=$i+1;?>
</tr></table><br>
<!-- ------------------------------end products - row <? echo($i);?><br>------------------------------ -->

<!-- ------------------------------begin products - row <? echo($j);?>------------------------------ -->
<table width="853" border="0" cellspacing="0" cellpadding="0"><tr valign="top">
<?}?>
<?$i++;?>
<?}?>
<?
$eval=$i-1;
$num=3-$eval;
for($ee=0;$ee<$num;$ee++){
	print("<td width=\"275\"><img src=\"pix/pix_trans.gif\" width=\"275\" height=\"1\"></td>\n");
}
?>
</td>
</tr></table><br>
<!-- ------------------------------end products - row 3------------------------------ -->

</div></td>
<td></td>
</tr>
</table>
<!-- ------------------------------end body------------------------------ -->
</div><br>
<? #echo($_SESSION['rep']);?>
<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</body>
</html>


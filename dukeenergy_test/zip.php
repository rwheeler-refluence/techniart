<? 
$page=$_SERVER['REQUEST_URI'];
$cat=$_GET['cat'];


$sql="select distinct category from tblProducts order by category asc";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$category=$row['category'];
	$select.="<OPTION VALUE=\"store-cat.php?cat=".$category."\" \n";
	if($category==$cat){
		$select.="selected";
	}
	$select.=">".$category."</OPTION>\n";
}
$select.="</SELECT>\n";

?>

<!-- ------------------------------begin your zip is... display------------------------------ -->

<div class="zip" id="zip"><center>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="middle">
	<td width="5%"></td><td><br><br><br>
<img src="arrow.png"><span class="pink">Your zip code is <? echo($_SESSION['zip']);?>.</span><br />
<span class="pink">Look for discounted prices provided by</span><br>
    <span class="pink">Duke Energy Progress.</span><br />
    <br />
  </td>
	<td width="34%" rowspan="2" valign="middle"></td></tr></table></center>
  </div>
<br>

<!-- ------------------------<strong>
<!-- ------------------------------begin default zip code display------------------------------ -->
<? if(!$_SESSION['zip']){echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('The ZIP code lost. Please re-enter your ZIP code.')
		window.location.href='http://www.techniart.us/dukeenergy/index.php'
        </SCRIPT>";}?>



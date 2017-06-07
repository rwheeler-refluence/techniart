<?
$ID=$_GET['ID'];
$subcategory1=$_GET['subcategory1'];
?>
<? include("../database.php");?>
<?
$ID=str_replace("_"," ",$ID);
$sqlsub="select distinct subcat1 from tblProducts where category='$ID' && subcat1!=''";
#print($sqlsub);
$resultsub=db_query($sqlsub);
$countsub=mysql_num_rows($resultsub);
#print("<br>".$countsub."<br>");
if($countsub<1){
?>
<input type="text" size="45" name="subcategory" value="<? echo($subcategory1);?>">
<?}else{?>
<select name="subcategory" id="subcategory" size="1" onChange="loadSub2();">
<option value="">
<?
while($rowsub=mysql_fetch_array($resultsub)){
	$subcat1=$rowsub['subcat1'];
	$subcat_use=str_replace(" ","_",$subcat1);
	print("<option value=\"".$subcat_use."\" ");
	if($subcategory1==$subcat1){
		print("selected");
	}
	print(">".$subcat1."\n");
}
?>
</select>
<?}?>
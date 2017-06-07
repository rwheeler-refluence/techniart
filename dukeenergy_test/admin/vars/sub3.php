<?
$ID=$_GET['ID'];
$subcategory3=$_GET['subcategory3'];
?>
<? include("../database.php");?>
<?
$ID=str_replace("_"," ",$ID);
$sqlsub="select distinct subcat3 from tblProducts where subcat2='$ID' && subcat3!=''";
#print($sqlsub);
$resultsub=db_query($sqlsub);
$countsub=mysql_num_rows($resultsub);
#print("<br>".$countsub."<br>");
if($countsub<1 || !$ID){
?>
<input type="text" size="45" name="subcategory3" value="<? echo($subcategory3);?>">
<?}else{?>
<select name="subcategory3" id="subcategory3" size="1" onChange="loadSub3();">
<option value="">
<?
while($rowsub=mysql_fetch_array($resultsub)){
	$subcat3=$rowsub['subcat3'];
	$subcat_use=str_replace(" ","_",$subcat3);
	print("<option value=\"".$subcat_use."\" ");
	if($subcategory3==$subcat3){
		print("selected");
	}
	print(">".$subcat3."\n");
}
?>
</select>
<?}?>
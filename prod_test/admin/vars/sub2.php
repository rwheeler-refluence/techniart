<?
$ID=$_GET['ID'];
$subcategory2=$_GET['subcategory2'];
?>
<? include("../database.php");?>
<?
$ID=str_replace("_"," ",$ID);
$sqlsub="select distinct subcat2 from tblProducts where subcat1='$ID' && subcat2!=''";
#print($sqlsub);
$resultsub=db_query($sqlsub);
$countsub=mysql_num_rows($resultsub);
#print("<br>".$countsub."<br>");
if($countsub<1){
?>
<input type="text" size="45" name="subcategory2" value="<? echo($subcategory2);?>">
<script language="javascript">
	loadSub3();
</script>
	<?}else{?>
<select name="subcategory2" id="subcategory2" size="1" onChange="loadSub3();">
<option value="">
<?
while($rowsub=mysql_fetch_array($resultsub)){
	$subcat2=$rowsub['subcat2'];
	$subcat_use=str_replace(" ","_",$subcat2);
	print("<option value=\"".$subcat_use."\" ");
	if($subcategory2==$subcat2){
		print("selected");
	}
	print(">".$subcat2."\n");
}
?>
</select>
<?}?>
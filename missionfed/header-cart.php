<br />
<img src="wek.jpg"/>
<div class="indent3"><table style="display: inline-block;" align="left">
  <tr>
    <td></td>
    <td align="center"><form method="post" action="cart.php">
     <span class="cart-header">Get your no-cost kit today!</span><span class="cart"></span>
      <br>
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="productID" value="244">
        <input type="hidden" name="qty" value="1">
        <input type="hidden" name="price" value="0">
        <input type="hidden" name="productName" value="Water & Energy Saving Kit">
        <? 
$wek="select qty as WEKQuantity from tblotsdetail_mission where tblotsdetail_mission.itemNo='244' && tblotsdetail_mission.otsID='$o'";
$wekup="update tblotsdetail_mission set qty='1' where tblotsdetail_mission.itemNo='244' && tblotsdetail_mission.otsID='$o'";
$resultwek=db_query($wek);
while($row=mysql_fetch_array($resultwek)){
		$weklimit=$row['WEKQuantity'];
	}

if ($weklimit>1){
	$resultwek=db_query($wekup);
	echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You may only add 1 Water & Energy Kit per household!')
		window.location.href='cart.php'
        </SCRIPT>
        ";
}	
		if($weklimit==0){
	print("<input type=\"submit\" class=\"btn1\" name=\"Add Water & Energy Saving Kit\" value=\"Add Water & Energy Saving Kit\" onClick=\"this.form.submit();\">\n");
	}?>
    
     
</form></td></tr></table></div>
<? $myspiritID=$_SESSION['myspiritID'];?>
<? #print $myspiritID;?>
<style type="text/css">
.l2g {
  font-family: Arial;
  color: #58c3b4;
  font-size: 48px;
  font-weight:100;
}
.nav_text {
	font-family: Arial;
	font-size: 18px;
	color: #fff;
	text-align: left;
	}
a.nav_text:link {
	font-family: Arial;
	font-size: 18px;
	color: #fff;
	text-align: left;
	}
a.nav_text:visited {
	font-family: Arial;
	font-size: 18px;
	color: #fff;
	text-align: left;
	}
a.nav_text:hover {
	font-family: Arial;
	font-size: 18px;
	color: #000;
	text-align: left;
	}
.nav_bkg {
background-color:474C55;
background-repeat: repeat-x;
background-position: top center; 
}
a:link {
	color: #FFF;
	text-decoration: none;
}
a:visited {
	color: #FFF;
	text-decoration: none;
}
a:hover {
	color: #58c3b4;
	text-decoration: none;
}
a:active {
	color: #FFF;
	text-decoration: none;
}
</style>
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr valign="top">
    <td height="36" colspan="7" align="right"><table width="906" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr valign="top" bgcolor="#474C55" class="nav_bkg">
        <td width="86" height="32" align="left" valign="top"></td>
        <td width="113" align="left" valign="top"></td>
        <td height="32" colspan="3" align="left" valign="middle"><a href="https://www.techniart.us/psehomeprint/store-cat.php?cat=Products">Home</a></td>
        <td width="19" align="right" valign="middle">&nbsp;</td>
        <td width="90" align="right" valign="middle"><a href="https://www.techniart.us/psehomeprint/cart.php">View Cart</a></td>
        <td width="11" align="right" valign="middle">&nbsp;</td>
        <td width="155" align="right" valign="middle"><a href="https://www.techniart.us/psehomeprint/show_orders.php">Previous Orders</a></td>
        <td width="13" align="right" valign="middle">&nbsp;</td>
        <td width="159" align="right" valign="middle"><a href="https://www.techniart.us/psehomeprint/customer-service.php">Customer Service</a></td>
        <td width="23" align="left" valign="middle"></td>
        <td width="83" align="left" valign="middle"><a href="https://www.techniart.us/psehomeprint/contact.php">Contact</a></td>
        <td width="11" align="left" valign="middle"></td>
        <td width="106" align="left" valign="middle"><a href="http://www.techniart.us/psehomeprint/logout.php" title="Index">Logout</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center">
<tr valign="top">
    <td height="29" rowspan="2" valign="top"></a>&nbsp;&nbsp;</a></td>
    <td width="347" height="14" align="right"><span class="section_heading_style2">
      <? if($myspiritID){
$sql="select * from tblCSDAccess where uaccessID='$myspiritID'";
$result=db_query($sql);
#print($uaccessID);
 while($row=mysql_fetch_array($result)){
		$access_company=$row['access_company'];
		$company_address=$row['company_address'];
		$company_city=$row['company_city'];
		$company_zip=$row['company_zip'];
		$owner_email=$row['owner_email'];
		$admin_name=$row['admin_name'];
		$admin_phone=$row['admin_phone'];
		$admin_email=$row['admin_email'];
		$delivery=$row['delivery'];
		$delivery_day=$row['delivery_day'];
		$delivery_time=$row['delivery_time'];
		$dock=$row['dock'];
		$access_company=$row['access_company'];		
		}
		echo $access_company;}?>
<? if($myspiritID==''){
echo "<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Login session lost! Please login again!')
		window.location.href='https://www.techniart.us/psehomeprint/index.php'
        </SCRIPT>
        ";
		die();
}?>
    </span></td>
  </tr>
<tr valign="top">
  <td height="15" align="right"><span class="section_heading_style2"><b><? echo(date("l F j, Y"));?></b></span></td>
</tr>
</table><br />

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./boilerplate.css" rel="stylesheet" type="text/css">
<link href="./mobile.css" rel="stylesheet" type="text/css">
<title>Choose your power strip</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>


</head>
<BODY><?php include_once("analyticstracking.php") ?>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?>
<form method="post" action="add.php">
<table width="100%" border="0">
  <tbody>
    <tr valign="top">
      <td width="100%">
<table width="96%" border="0" align="center">
<tbody>
<tr><td width="50%" valign="top">
<table width="100%" align="left">
<tr><div align="left"><td align="center"><span class="cart"><strong>Emberstrip<sup>&reg;</sup> 8PC+</strong></span></div><td height="21"></td></tr>
	<tr><td align="center"><span class="cart-header"><select name="pcqty"><option value="0">0</option><option value="1">1</option><option value="2">2</option></select></span></td></tr>
<tr><td align="center"><img src="tier1.jpg"/></td></tr>

<tr ><td align="left">
<ul>
<li style="margin-left: 2px">Class-leading data processing power</li>
<li style="margin-left: 2px">Active Powerdown for PC and peripherals</li>
<li style="margin-left: 2px">Power sensing for reliable control</li>
<li style="margin-left: 2px">Auto-adjusts to all desktop and laptop devices</li>
<li style="margin-left: 2px">Adjustable active standby timer control</li>
<li style="margin-left: 2px">Surge protection (1,530 Joules)</li></ul>
<div align="center"><span class="products"><a href="http://www.embertec.com/assets/pdf/ESUSPC8-ET-10-V3.pdf" target="_blank">Spec Sheet</a></div><br>
<div align="center"><span class="products"><a href="http://www.embertec.com/assets/usermanual/ESUSPC8-ET-10-User%20Manual-V1.pdf" target="_blank">User Manual</a></div><br>
<div align="center"><span class="products"><a href="http://www.embertec.com/pcsoftware/PcPlusSetup_2_0_00_60_ND.msi" target="_blank">Download PC+ v2.x software</a></div></td></tr>
</table>
</td>
             
              <td width="50%" valign="top"><table align="left" width="100%">
                <tr>
        <td align="center">
       <span class="cart"><strong>Emberstrip<sup>&reg;</sup> 8AV+ (Bluetooth<sup>&reg;</sup>)</span></div></td></tr>
  <tr>
        <td align="center" ><span class="cart-header"><select name="avqty"><option value="0">0</option><option value="1">1</option><option value="2">2</option></select></span></td>
  </tr>
      <tr>
        <td align="center" ><img src="tier2.jpg"/></td>
      </tr>
      <tr>
        <td align="center" ></td>
      </tr>
        <td align="left">
            
            <input hidden="hidden" name="otsID" value="<? echo($otsID);?>" />
          </td>
      </tr><tr >
        <td  align="left"><table width="70%" border="0" align="center">
  <tbody>
    <tr>
      <td><ul><li style="margin-left: 2px">Class-leading data processing power</li>
<li style="margin-left: 2px">IR shielding from stray CFL and sunlight IR</li>
<li style="margin-left: 2px">Power sensing for reliable control</li>
<li style="margin-left: 2px">Adjustable active standby timer control</li>
<li style="margin-left: 2px">Surge protection (1,530 Joules)</li><br>
          <br>
      </div>          
      <div align="center"><span class="products">
            <a href="http://www.embertec.com/assets/pdf/ESUSAV8-ET-10B-V3.1.pdf" target="_blank">Spec Sheet</a></div><br><div align="center"><span class="products">
            <a href="http://www.embertec.com/assets/usermanual/ESUSAV8-ET-10B-User%20Manual-V2.1.pdf" target="_blank">User Manual</a></div><br><div align="center"><span class="products">
            <a href="install.php" target="_blank">How to install</a></div><br><div align="center"><span class="products">
            <a href="use.php" target="_blank">How to use</a></div></td>
    </tr>
  </tbody>
</table>
</td>
      </tr>
      </table>
</td>
      </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>

<input type="submit" class="btn1" name="Add to Cart" value="Add Selections to Cart" onclick="this.form.submit();" /></form><br>
<br>
</div>


<? include("footer.php");?>
</div>
</body>
</html>

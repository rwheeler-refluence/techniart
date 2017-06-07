<? include("database.php");?>
<? $source=$_POST['source'];?>
<form name="form1" id="form1" method="post" action="https://www.techniart.us/sdgeverifiedkit/confirm.php" onSubmit="return fVerifyResForm();">
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Get your No-Cost Energy & Water Savings Kit</title>

<meta property="og:site_name" content="SDG&amp;E Marketplace"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="mobile.css"/>
                <link rel="stylesheet" type="text/css" href="boilerplate.css"/>
    <!--[if lt IE 9]>
    <script src="/static/bootstrap/3.3.0/js/html5shiv.js"></script>
    <script src="/static/bootstrap/3.3.0/js/respond.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/ie8.css">

<![endif]-->
<SCRIPT LANGUAGE="Javascript">
<!---
function pop(){

document.form1.ship_fname.value=document.form1.fname.value;
document.form1.ship_lname.value=document.form1.lname.value;
document.form1.ship_streetnum.value=document.form1.streetnum.value;
document.form1.ship_route.value=document.form1.route.value;
document.form1.ship_unit1.value=document.form1.unit1.value;
document.form1.ship_city.value=document.form1.city.value;
document.form1.ship_state.value=document.form1.state.value;
document.form1.ship_zip.value=document.form1.zip.value;
document.form1.ship_zip4.value=document.form1.zip4.value;
}

// --->
</SCRIPT>	
<script language="javascript">
function unhide(divID) {
  var item = document.getElementById(divID);
  if (item) {
//    item.className=(item.className=='hidden')?'unhidden':'hidden';
    item.className='unhidden';
  }
}
function hide(divID) {
  var item = document.getElementById(divID);
  if (item) {
//    item.className=(item.className=='hidden')?'unhidden':'hidden';
    item.className='hidden';
  }
}

</script>
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

<div class="main" >
 <br> 
<table width="90%" border="0" align="center">
  <tr>
    <td valign="top"><table width="91%"  align="center" border="0" cellpadding="0" cellspacing="0">
           <tr valign="top">
             <td colspan="2" align="left"><strong>SDG&amp;E Residential Service Address</strong></td>
            </tr>
           <tr valign="top">
             <td align="left">&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr valign="top">
            <td width="38%" align="left">First Name:</td>
            <td width="62%" align="left"><input required type="text" size="25" maxlength="100" name="fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">Last Name:</td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">Street Number:</td>
            <td align="left"><input name="streetnum" type="number" required class="forms9" id="streetnum" value="" size="25" maxlength="10" /></td>
          </tr>
        <tr valign="top">
            <td height="5"></td>
          </tr>
        <tr valign="top">
          <td align="left">Street Name (Route):</td>
          <td align="left"><input required name="route" type="text" class="forms10" id="route" size="25" maxlength="100" /></td>
        </tr>
        <tr valign="top">
          <td height="5"></td>
        </tr>
        <tr valign="top">
          <td align="left">Unit:</td>
          <td align="left"><input name="unit1" type="text" class="forms10" id="unit1" value="" size="25" maxlength="40" /></td>
        </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">City:</td>
            <td align="left"><input required type="text" size="25" maxlength="40" name="city" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">State:</td>
            <td align="left"><select required name="state" class="forms10">
              <option value="CA">CA</option>
                         </select></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">ZIP Code: <br></td>
            <td align="left"><input required type="text" size="5" maxlength="10" name="zip" value="" class="forms9" />
              - 
              <input name="zip4" type="text" class="forms9" id="zip4" value="" size="5" maxlength="4" />
              <br>
            (5 or 9 digit)            </td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
                    <tr valign="top">
            <td align="left">Email:</td>
            <td align="left"><input type="text" size="25" maxlength="100" name="email" value="" class="forms10" />
            </td>
          </tr>
                    <tr valign="top">
                      <td align="left">&nbsp;</td>
                      <td align="left">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td height="41" colspan="2" align="left"><input required type="checkbox" name="pledge" id="pledge" value="Checked">&nbsp;&nbsp;I pledge to install the low-flow showerhead and aerators in my home.<br><br>

                      <input type="checkbox" required name="customer" id="customer" value="Yes">
                      &nbsp;I am a SDG&amp;E residential gas customer. Electric only customers do not qualify.<br>
                      <br>
                      <input type="checkbox" required name="swear" id="swear" value="Yes">
                      This is my first water and energy savings kit from SDG&amp;E. I understand there is a limit of one kit per household every 10 years.<br></td>
                    </tr>
          
        </table></td>
   
  </tr>
  <tr>
  <td>
  <br>
  <br>
  <table width="91%"  align="center" border="0" cellpadding="0" cellspacing="0">
           <tr valign="top">
             <td height="26" colspan="2" align="left"><strong>Shipping Address</strong></td>
             
           </tr>
           <tr valign="top">
             <td height="32" colspan="2" align="left"><input type="checkbox" name="same" value="yes" onClick="pop();">Same as Service Address&nbsp;</td>
            </tr>
           <tr valign="top">
            <td width="38%" align="left">First Name:</td>
            <td width="62%" align="left"><input required type="text" size="25" maxlength="100" name="ship_fname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">Last Name:</td>
            <td align="left"><input required type="text" size="25" maxlength="100" name="ship_lname" value="" class="forms10" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">Street Number:</td>
            <td align="left"><input name="ship_streetnum" type="number" required class="forms9" id="ship_streetnum" value="" size="25" maxlength="10" /></td>
          </tr>
        <tr valign="top">
            <td height="5"></td>
          </tr>
        <tr valign="top">
          <td align="left">Street Name (Route):</td>
          <td align="left"><input required name="ship_route" type="text" class="forms10" id="ship_route" size="25" maxlength="100" /></td>
        </tr>
        <tr valign="top">
          <td height="5"></td>
        </tr>
        <tr valign="top">
          <td align="left">Unit:</td>
          <td align="left"><input name="ship_unit1" type="text" class="forms10" id="ship_unit1" value="" size="25" maxlength="40" /></td>
        </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">City:</td>
            <td align="left"><input name="ship_city" type="text" required class="forms10" id="ship_city" value="" size="25" maxlength="40" /></td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
          <tr valign="top">
            <td align="left">State:</td>
            <td align="left"><select name="ship_state" class="forms10" id="ship_state" required>
               <option value="CA">CA</option>
                         </select></td>
          </tr>
          <tr valign="top">
            <td height="4"></td>
          </tr>
          <tr valign="top">
            <td align="left">ZIP Code: <br></td>
            <td align="left"><input required type="text" size="5" maxlength="5" name="ship_zip" value="" class="forms9" />
              -
              <input name="ship_zip4" type="text" class="forms9" id="ship_zip4" value="" size="5" maxlength="4" />
              <br>
            (5 or 9 digit)            </td>
          </tr>
          <tr valign="top">
            <td height="5"></td>
          </tr>
                    <tr valign="top">
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
                    <tr valign="top">
                      <td align="left">&nbsp;</td>
                      <td align="left">&nbsp;</td>
                    </tr>
                    <tr valign="top">
                      <td colspan="2" align="center"><input name="source" type="hidden" value="<? echo($source);?>"><input required name="place" class="btn2" value="Confirm Order" type="submit"></td>
                    </tr>
          
        </table></form>
        </td></tr>
</table>
</p>
</td>
</tr></table></td>
</tr></table></td></tr></table>
    </div>

<!-- End content -->
<? print $source?>
<? include("footer.php");?>
</body>
</html>
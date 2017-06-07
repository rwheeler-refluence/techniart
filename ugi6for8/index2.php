<!doctype html>
<html>
<head>
<meta property="og:title" content="Save Energy, Support the Ellie Fund" /> 
<meta property="og:description" content="Buy a 4-pack of pink-based ENERGY STAR certified LEDs for just $10 and $5 will be donated to the Ellie Fund." /> 
<meta property="og:image" content="http://www.techniart.com/masssave/elliefund_entrypage.jpg" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="http://techniart.com/masssave/" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
<title>Save Energy, Support the Ellie Fund</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    function close_accordion_section() {
        $('.accordion .accordion-section-title').removeClass('active');
        $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
    }
 
    $('.accordion-section-title').click(function(e) {
        // Grab current anchor value
        var currentAttrValue = $(this).attr('href');
 
        if($(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();
 
            // Add active class to section title
            $(this).addClass('active');
            // Open up the hidden content panel
            $('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
        }
 
        
});
		
    });
	
</script>
</head><form method="post" action="changezip.php">
<BODY><?php include_once("analyticstracking.php") ?>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>


    <table width="100%" border="0">
        <tr>
          <td colspan="2"></td>
      </tr>
        <tr>
          <td colspan="2" align="center"><br>
<span class="cart-header">Special pricing for Mass Save residential electric customers</span></td>
        </tr>
        <tr>
          <td height="59" colspan="2" align="center" valign="middle"><div style="display: inline"><span class="cart"><strong>Zip Code:</strong></span></div><div style="display: inline">
<input required type="text" name="zipcode" size="5" class="forms9"></div><div style="display: inline">&nbsp;<input type="submit" class="btn1" name="submit" value="Check ZIP Code" /></div></td>
           </tr>
    </table>
    </form>
        <br>
<? include("footer.php");?>
</div>
</body>
</html>

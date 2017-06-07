<!doctype html>
<html>
<head>

<link href="https://www.techniart.us/masssave/boilerplate.css" rel="stylesheet" type="text/css">
<link href="https://www.techniart.us/masssave/mobile.css" rel="stylesheet" type="text/css">
<title>Promo Has Ended</title>
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
  <div id="LayoutDiv1"><? include("header1.php")?></div>


    <table width="100%" border="0">
        <tr>
          <td colspan="2"></td>
      </tr>
        <tr>
          <td colspan="2" align="center"><br>
<span class="cart-header"><br>
The Mass Save Emberstrip promo had ended. Thank you for a great promotion!<br>
<br>
Check out our <a href="https://www.techniart.us/MAFallenHeroes" style="color:#00F">Mass Fallen Heroes LED Fundraiser</a> for another great deal on LED bulbs (6 general purpose LEDs for $10) that also helps support a great local organization.<br>
<br>
<br>
</span></td>
        </tr>
    </table>
    </form>
        <br>
<? #include("footer.php");?>
</div>
<br>
<br>
<span class="footer_content_style1">&copy; <? echo(date("Y"));?>, TechniArt, Inc. All rights reserved.</span></td>
  <td align="right">&nbsp;</td>
</tr>
</table>
</div></div>
</body>
</html>

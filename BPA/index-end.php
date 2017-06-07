<!doctype html>
<html>
<head>


<link href="https://www.techniart.us/masssave/boilerplate.css" rel="stylesheet" type="text/css">
<link href="https://www.techniart.us/masssave/mobile.css" rel="stylesheet" type="text/css">
<title>Bathroom Savings Pack</title>
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
</head>
<BODY><?php include_once("analyticstracking.php") ?>
<center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>


    <table width="100%" border="0">
        <tr>
          <td colspan="2"></td>
      </tr>
        <tr>
          <td colspan="2" align="center"><br>
<span class="cart-header">The promotion has ended.</span></td>
        </tr>
        <tr>
          <td height="59" colspan="2" align="center" valign="middle"><div style="display: inline"><span class="cart"><strong></strong></span></div><div style="display: inline">
</div></td>
           </tr>
    </table>

        <br>
<? include("footer.php");?>
</div>

</body>
</html>

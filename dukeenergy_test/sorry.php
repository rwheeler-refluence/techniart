<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<title>NOT QUALIFIED</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="mobile.css" rel="stylesheet" type="text/css">
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
<BODY><?php include_once("analyticstracking1.php") ?><? include("nav-lto.php")?><center><div class="gridContainer clearfix">
  <div id="LayoutDiv1"><? include("header.php")?></div>

    <table width="100%" border="0">
        <tr bgcolor="f2f4f4">
          <td align="left"><span class="cart"><br>
          </span>
            <p class="cart">Sorry, this offer is only available to Duke Energy Progress residential electric customers in North and South Carolina. Residents of 
              Packs from this offer will only be shipped to qualifying ZIP codes within North and South Carolina.<br>
              <br>
If you have any questions regarding your eligibility, please send an email to: <a href="mailto: customerservice@techniart.com">customerservice@techniart.com</a></p>
            <p class="cart">Please include your name and address to help us verify your eligibility with Duke Energy Progress.</p>
            <p class="cart"><br>
            </p>
</td>
        </tr>
        
    

<?php include("footer.php") ?>
</body>
</html>


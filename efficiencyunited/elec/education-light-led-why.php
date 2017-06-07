<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>TechniArt - Marketing The Future</title>

<meta name="robots" content="index,follow" />
<meta name="author" content="TechniArt" />
<meta name="publisher" content="techniart.com" />
<meta name="copyright" content="Copyright 2008 TechniArt. All Rights Reserved" />
<meta http-equiv="content-language" content="EN" />
<meta name="content-language" content="EN" />
<meta name="rating" content="All" />
<meta name="audience" content="General" />
<meta name="distribution" content="Global" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<script type="text/javascript" language="JavaScript1.2" src="script/stmenu.js"></script>
</head>

<BODY>
<div align="center">
<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- ------------------------------begin body------------------------------ -->
<a name="top"></a>
<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906" class="title_bkg"><div id="title_spacer" align="left"><span class="title_main">Education - Why Choose ENERGY STAR Qualified LED Lighting?</span></div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center" class="bkg_body-main"><tr valign="top">
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="300" border="0"></td>
<td width="649"><div id="main_content_ip" align="left">
<span class="body_content_style1">
<table align="right"><tr><td>
<script type="text/javascript">
<!--//--><![CDATA[//><!--


/*==================================================*
 $Id$
 Copyright 2000-2003 Patrick Fitzgerald
 http://slideshow.barelyfitz.com/

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *==================================================*/

// There are two objects defined in this file:
// "slide" - contains all the information for a single slide
// "slideshow" - consists of multiple slide objects and runs the slideshow

//==================================================
// slide object
//==================================================
function slide(src,link,text,target,attr) {
  // This is the constructor function for the slide object.
  // It is called automatically when you create a new slide object.
  // For example:
  // s = new slide();

  // Image URL
  this.src = src;

  // Link URL
  this.link = link;

  // Text to display
  this.text = text;

  // Name of the target window ("_blank")
  this.target = target;

  // Custom duration for the slide, in milliseconds.
  // This is an optional parameter.
  // this.timeout = 3000

  // Attributes for the target window:
  // width=n,height=n,resizable=yes or no,scrollbars=yes or no,
  // toolbar=yes or no,location=yes or no,directories=yes or no,
  // status=yes or no,menubar=yes or no,copyhistory=yes or no
  // Example: "width=200,height=300"
  this.attr = attr;

  // Create an image object for the slide
  if (document.images) {
    this.image = new Image();
  }

  // Flag to tell when load() has already been called
  this.loaded = false;

  //--------------------------------------------------
  this.load = function() {
    // This method loads the image for the slide

    if (!document.images) { return; }

    if (!this.loaded) {
      this.image.src = this.src;
      this.loaded = true;
    }
  }

  //--------------------------------------------------
  this.hotlink = function() {
    // This method jumps to the slide's link.
    // If a window was specified for the slide, then it opens a new window.

    var mywindow;

    // If this slide does not have a link, do nothing
    if (!this.link) return;

    // Open the link in a separate window?
    if (this.target) {

      // If window attributes are specified,
      // use them to open the new window
      if (this.attr) {
        mywindow = window.open(this.link, this.target, this.attr);
  
      } else {
        // If window attributes are not specified, do not use them
        // (this will copy the attributes from the originating window)
        mywindow = window.open(this.link, this.target);
      }

      // Pop the window to the front
      if (mywindow && mywindow.focus) mywindow.focus();

    } else {
      // Open the link in the current window
      location.href = this.link;
    }
  }
}

//==================================================
// slideshow object
//==================================================
function slideshow( slideshowname ) {
  // This is the constructor function for the slideshow object.
  // It is called automatically when you create a new object.
  // For example:
  // ss = new slideshow("ss");

  // Name of this object
  // (required if you want your slideshow to auto-play)
  // For example, "SLIDES1"
  this.name = slideshowname;

  // When we reach the last slide, should we loop around to start the
  // slideshow again?
  this.repeat = true;

  // Number of images to pre-fetch.
  // -1 = preload all images.
  //  0 = load each image is it is used.
  //  n = pre-fetch n images ahead of the current image.
  // I recommend preloading all images unless you have large
  // images, or a large amount of images.
  this.prefetch = -1;

  // IMAGE element on your HTML page.
  // For example, document.images.SLIDES1IMG
  this.image;

  // ID of a DIV element on your HTML page that will contain the text.
  // For example, "slides2text"
  // Note: after you set this variable, you should call
  // the update() method to update the slideshow display.
  this.textid;

  // TEXTAREA element on your HTML page.
  // For example, document.SLIDES1FORM.SLIDES1TEXT
  // This is a depracated method for displaying the text,
  // but you might want to supply it for older browsers.
  this.textarea;

  // Milliseconds to pause between slides.
  // Individual slides can override this.
  this.timeout = 3000;

  // Hook functions to be called before and after updating the slide
  // this.pre_update_hook = function() { }
  // this.post_update_hook = function() { }

  // These are private variables
  this.slides = new Array();
  this.current = 0;
  this.timeoutid = 0;

  //--------------------------------------------------
  // Public methods
  //--------------------------------------------------
  this.add_slide = function(slide) {
    // Add a slide to the slideshow.
    // For example:
    // SLIDES1.add_slide(new slide("s1.jpg", "link.html"))
  
    var i = this.slides.length;
  
    // Prefetch the slide image if necessary
    if (this.prefetch == -1) {
      slide.load();
    }

    this.slides[i] = slide;
  }

  //--------------------------------------------------
  this.play = function(timeout) {
    // This method implements the automatically running slideshow.
    // If you specify the "timeout" argument, then a new default
    // timeout will be set for the slideshow.
  
    // Make sure we're not already playing
    this.pause();
  
    // If the timeout argument was specified (optional)
    // then make it the new default
    if (timeout) {
      this.timeout = timeout;
    }
  
    // If the current slide has a custom timeout, use it;
    // otherwise use the default timeout
    if (typeof this.slides[ this.current ].timeout != 'undefined') {
      timeout = this.slides[ this.current ].timeout;
    } else {
      timeout = this.timeout;
    }

    // After the timeout, call this.loop()
    this.timeoutid = setTimeout( this.name + ".loop()", timeout);
  }

  //--------------------------------------------------
  this.pause = function() {
    // This method stops the slideshow if it is automatically running.
  
    if (this.timeoutid != 0) {

      clearTimeout(this.timeoutid);
      this.timeoutid = 0;

    }
  }

  //--------------------------------------------------
  this.update = function() {
    // This method updates the slideshow image on the page

    // Make sure the slideshow has been initialized correctly
    if (! this.valid_image()) { return; }
  
    // Call the pre-update hook function if one was specified
    if (typeof this.pre_update_hook == 'function') {
      this.pre_update_hook();
    }

    // Convenience variable for the current slide
    var slide = this.slides[ this.current ];

    // Determine if the browser supports filters
    var dofilter = false;
    if (this.image &&
        typeof this.image.filters != 'undefined' &&
        typeof this.image.filters[0] != 'undefined') {

      dofilter = true;

    }

    // Load the slide image if necessary
    slide.load();
  
    // Apply the filters for the image transition
    if (dofilter) {

      // If the user has specified a custom filter for this slide,
      // then set it now
      if (slide.filter &&
          this.image.style &&
          this.image.style.filter) {

        this.image.style.filter = slide.filter;

      }
      this.image.filters[0].Apply();
    }

    // Update the image.
    this.image.src = slide.image.src;

    // Play the image transition filters
    if (dofilter) {
      this.image.filters[0].Play();
    }

    // Update the text
    this.display_text();

    // Call the post-update hook function if one was specified
    if (typeof this.post_update_hook == 'function') {
      this.post_update_hook();
    }

    // Do we need to pre-fetch images?
    if (this.prefetch > 0) {

      var next, prev, count;

      // Pre-fetch the next slide image(s)
      next = this.current;
      prev = this.current;
      count = 0;
      do {

        // Get the next and previous slide number
        // Loop past the ends of the slideshow if necessary
        if (++next >= this.slides.length) next = 0;
        if (--prev < 0) prev = this.slides.length - 1;

        // Preload the slide image
        this.slides[next].load();
        this.slides[prev].load();

        // Keep going until we have fetched
        // the designated number of slides

      } while (++count < this.prefetch);
    }
  }

  //--------------------------------------------------
  this.goto_slide = function(n) {
    // This method jumpts to the slide number you specify.
    // If you use slide number -1, then it jumps to the last slide.
    // You can use this to make links that go to a specific slide,
    // or to go to the beginning or end of the slideshow.
    // Examples:
    // onClick="myslides.goto_slide(0)"
    // onClick="myslides.goto_slide(-1)"
    // onClick="myslides.goto_slide(5)"
  
    if (n == -1) {
      n = this.slides.length - 1;
    }
  
    if (n < this.slides.length && n >= 0) {
      this.current = n;
    }
  
    this.update();
  }


  //--------------------------------------------------
  this.goto_random_slide = function(include_current) {
    // Picks a random slide (other than the current slide) and
    // displays it.
    // If the include_current parameter is true,
    // then 
    // See also: shuffle()

    var i;

    // Make sure there is more than one slide
    if (this.slides.length > 1) {

      // Generate a random slide number,
      // but make sure it is not the current slide
      do {
        i = Math.floor(Math.random()*this.slides.length);
      } while (i == this.current);
 
      // Display the slide
      this.goto_slide(i);
    }
  }


  //--------------------------------------------------
  this.next = function() {
    // This method advances to the next slide.

    // Increment the image number
    if (this.current < this.slides.length - 1) {
      this.current++;
    } else if (this.repeat) {
      this.current = 0;
    }

    this.update();
  }


  //--------------------------------------------------
  this.previous = function() {
    // This method goes to the previous slide.
  
    // Decrement the image number
    if (this.current > 0) {
      this.current--;
    } else if (this.repeat) {
      this.current = this.slides.length - 1;
    }
  
    this.update();
  }


  //--------------------------------------------------
  this.shuffle = function() {
    // This method randomly shuffles the order of the slides.

    var i, i2, slides_copy, slides_randomized;

    // Create a copy of the array containing the slides
    // in sequential order
    slides_copy = new Array();
    for (i = 0; i < this.slides.length; i++) {
      slides_copy[i] = this.slides[i];
    }

    // Create a new array to contain the slides in random order
    slides_randomized = new Array();

    // To populate the new array of slides in random order,
    // loop through the existing slides, picking a random
    // slide, removing it from the ordered list and adding it to
    // the random list.

    do {

      // Pick a random slide from those that remain
      i = Math.floor(Math.random()*slides_copy.length);

      // Add the slide to the end of the randomized array
      slides_randomized[ slides_randomized.length ] =
        slides_copy[i];

      // Remove the slide from the sequential array,
      // so it cannot be chosen again
      for (i2 = i + 1; i2 < slides_copy.length; i2++) {
        slides_copy[i2 - 1] = slides_copy[i2];
      }
      slides_copy.length--;

      // Keep going until we have removed all the slides

    } while (slides_copy.length);

    // Now set the slides to the randomized array
    this.slides = slides_randomized;
  }


  //--------------------------------------------------
  this.get_text = function() {
    // This method returns the text of the current slide
  
    return(this.slides[ this.current ].text);
  }


  //--------------------------------------------------
  this.get_all_text = function(before_slide, after_slide) {
    // Return the text for all of the slides.
    // For the text of each slide, add "before_slide" in front of the
    // text, and "after_slide" after the text.
    // For example:
    // document.write("<ul>");
    // document.write(s.get_all_text("<li>","\n"));
    // document.write("<\/ul>");
  
    all_text = "";
  
    // Loop through all the slides in the slideshow
    for (i=0; i < this.slides.length; i++) {
  
      slide = this.slides[i];
    
      if (slide.text) {
        all_text += before_slide + slide.text + after_slide;
      }
  
    }
  
    return(all_text);
  }


  //--------------------------------------------------
  this.display_text = function(text) {
    // Display the text for the current slide
  
    // If the "text" arg was not supplied (usually it isn't),
    // get the text from the slideshow
    if (!text) {
      text = this.slides[ this.current ].text;
    }
  
    // If a textarea has been specified,
    // then change the text displayed in it
    if (this.textarea && typeof this.textarea.value != 'undefined') {
      this.textarea.value = text;
    }

    // If a text id has been specified,
    // then change the contents of the HTML element
    if (this.textid) {

      r = this.getElementById(this.textid);
      if (!r) { return false; }
      if (typeof r.innerHTML == 'undefined') { return false; }

      // Update the text
      r.innerHTML = text;
    }
  }


  //--------------------------------------------------
  this.hotlink = function() {
    // This method calls the hotlink() method for the current slide.
  
    this.slides[ this.current ].hotlink();
  }


  //--------------------------------------------------
  this.save_position = function(cookiename) {
    // Saves the position of the slideshow in a cookie,
    // so when you return to this page, the position in the slideshow
    // won't be lost.
  
    if (!cookiename) {
      cookiename = this.name + '_slideshow';
    }
  
    document.cookie = cookiename + '=' + this.current;
  }


  //--------------------------------------------------
  this.restore_position = function(cookiename) {
  // If you previously called slideshow_save_position(),
  // returns the slideshow to the previous state.
  
    //Get cookie code by Shelley Powers
  
    if (!cookiename) {
      cookiename = this.name + '_slideshow';
    }
  
    var search = cookiename + "=";
  
    if (document.cookie.length > 0) {
      offset = document.cookie.indexOf(search);
      // if cookie exists
      if (offset != -1) { 
        offset += search.length;
        // set index of beginning of value
        end = document.cookie.indexOf(";", offset);
        // set index of end of cookie value
        if (end == -1) end = document.cookie.length;
        this.current = parseInt(unescape(document.cookie.substring(offset, end)));
        }
     }
  }


  //--------------------------------------------------
  this.noscript = function() {
    // This method is not for use as part of your slideshow,
    // but you can call it to get a plain HTML version of the slideshow
    // images and text.
    // You should copy the HTML and put it within a NOscript element, to
    // give non-javascript browsers access to your slideshow information.
    // This also ensures that your slideshow text and images are indexed
    // by search engines.
  
    $html = "\n";
  
    // Loop through all the slides in the slideshow
    for (i=0; i < this.slides.length; i++) {
  
      slide = this.slides[i];
  
      $html += '<p>';
  
      if (slide.link) {
        $html += '<a href="' + slide.link + '">';
      }
  
      $html += '<img src="' + slide.src + '" alt="Examples of ENERGY STAR Qualified Fixtures">';
  
      if (slide.link) {
        $html += "<\/a>";
      }
  
      if (slide.text) {
        $html += "<br />\n" + slide.text;
      }
  
      $html += "<\/P>" + "\n\n";
    }
  
    // Make the HTML browser-safe
    $html = $html.replace(/\&/g, "&amp;" );
    $html = $html.replace(/</g, "&lt;" );
    $html = $html.replace(/>/g, "&gt;" );
  
    return('<pre>' + $html + '</pre>');
  }


  //==================================================
  // Private methods
  //==================================================

  //--------------------------------------------------
  this.loop = function() {
    // This method is for internal use only.
    // This method gets called automatically by a Javascript timeout.
    // It advances to the next slide, then sets the next timeout.
    // If the next slide image has not completed loading yet,
    // then do not advance to the next slide yet.

    // Make sure the next slide image has finished loading
    if (this.current < this.slides.length - 1) {
      next_slide = this.slides[this.current + 1];
      if (next_slide.image.complete == null || next_slide.image.complete) {
        this.next();
      }
    } else { // we're at the last slide
      this.next();
    }
    
    // Keep playing the slideshow
    this.play( );
  }


  //--------------------------------------------------
  this.valid_image = function() {
    // Returns 1 if a valid image has been set for the slideshow
  
    if (!this.image)
    {
      return false;
    }
    else {
      return true;
    }
  }

  //--------------------------------------------------
  this.getElementById = function(element_id) {
    // This method returns the element corresponding to the id

    if (document.getElementById) {
      return document.getElementById(element_id);
    }
    else if (document.all) {
      return document.all[element_id];
    }
    else if (document.layers) {
      return document.layers[element_id];
    } else {
      return undefined;
    }
  }
  

  //==================================================
  // Deprecated methods
  // I don't recommend the use of the following methods,
  // but they are included for backward compatibility.
  // You can delete them if you don't need them.
  //==================================================

  //--------------------------------------------------
  this.set_image = function(imageobject) {
    // This method is deprecated; you should use
    // the following code instead:
    // s.image = document.images.myimagename;
    // s.update();

    if (!document.images)
      return;
    this.image = imageobject;
  }

  //--------------------------------------------------
  this.set_textarea = function(textareaobject) {
    // This method is deprecated; you should use
    // the following code instead:
    // s.textarea = document.form.textareaname;
    // s.update();

    this.textarea = textareaobject;
    this.display_text();
  }

  //--------------------------------------------------
  this.set_textid = function(textidstr) {
    // This method is deprecated; you should use
    // the following code instead:
    // s.textid = "mytextid";
    // s.update();

    this.textid = textidstr;
    this.display_text();
  }
}

SLIDES = new slideshow("SLIDES");
SLIDES.timeout = 3000;
SLIDES.prefetch = -1;
SLIDES.repeat = true;

s = new slide();
s.src =  "pix/1.jpg";
s.text = "";
s.link = "";
s.target = "";
s.attr = "";
s.filter = "";
SLIDES.add_slide(s);

s = new slide();
s.src =  "pix/2.jpg";
s.text = "";
s.link = "";
s.target = "";
s.attr = "";
s.filter = "";
SLIDES.add_slide(s);

s = new slide();
s.src =  "pix/3.jpg";
s.text = "";
s.link = "";
s.target = "";
s.attr = "";
s.filter = "";
SLIDES.add_slide(s);

s = new slide();
s.src =  "pix/4.jpg";
s.text = "";
s.link = "";
s.target = "";
s.attr = "";
s.filter = "";
SLIDES.add_slide(s);

s = new slide();
s.src =  "pix/5.jpg";
s.text = "";
s.link = "";
s.target = "";
s.attr = "";
s.filter = "";
SLIDES.add_slide(s);

s = new slide();
s.src =  "pix/6.jpg";
s.text = "";
s.link = "";
s.target = "";
s.attr = "";
s.filter = "";
SLIDES.add_slide(s);

s = new slide();
s.src =  "pix/7.jpg";
s.text = "";
s.link = "";
s.target = "";
s.attr = "";
s.filter = "";
SLIDES.add_slide(s);

if (false) SLIDES.shuffle();

//--><!]]>

</script>
	<img id="SLIDESIMG"
src="pix/1.jpg" style="filter:progid:DXImageTransform.Microsoft.Fade()" alt="Examples of Eligible Residential Fixture Types" class="flt_r" />
	<script type="text/javascript">
<!--//--><![CDATA[//><!--
if (document.images) {
  SLIDES.image = document.images.SLIDESIMG;
  SLIDES.textid = "SLIDESTEXT";
  SLIDES.update();
  SLIDES.play();
}
//--><!]]>
</script>
</td></tr></table>		
	<p>LED lighting is a rapidly evolving technology that <a href="education-light-led-learn.php?c=lighting.pr_what_are">produces light in a whole new way</a>. It is already beginning to surpass the quality and efficiency of existing lighting technologies, such as fluorescent and incandescent &#8212; but not all LED lighting is created equal.</p> 
	
	<p>The ENERGY STAR is awarded to select fixture types</a> that meet strict efficiency and performance criteria. 
	<h3>ENERGY STAR Qualified LED Lighting:</h3>

	<ul>
		<li><strong>Saves money on energy bills</strong> &#8212; uses at least 75% less energy than incandescent lighting.</li>
		<li><strong>Lasts a long time</strong> &#8212; lasts a minimum of 25,000 hours, or 22 years based on average household use.</li>
		<li><strong>Is guaranteed</strong> &#8212; comes with a minimum three-year warranty &#8212; far beyond the industry standard.</li>

		<li><strong>Offers convenient features</strong> &#8212; available with dimming on some indoor models and automatic daylight shut-off and motion sensors on some outdoor models.</li>
		<li><strong>Is durable</strong> &#8212; won&#8217;t break like a bulb.</li>
		<li><strong>Reduces cooling costs</strong> &#8212; LEDs produce very little heat.</li>

	</ul>
	
<h3 style="padding-bottom:5px;"><a name="all_equal" id="all_equal">Aren&#8217;t all LED lights highly efficient and long-lasting?</a></h3>
	<table align="right"><tr><td><img src="pix/Color_Shift_NEW.jpg" alt="LED with normal color after 100 hours" height="150" width="150" /><br /><img src="pix/Color_Shift_1000HRS.jpg" alt="LED discolored after 1000 hours" height="150" width="150" style="margin-top:5px;" /></td></tr></table>

	<p class="body_content_style1">Not necessarily. LEDs have been efficient and long lasting as indicator lights in electronics for years, but using LEDs to create stable white light for general lighting presents new challenges. The key to success is smart design. To qualify for ENERGY STAR, LED lighting products must pass a variety of tests to prove that the products will display the following characteristics:</p>
	
	<ul>
		<li><strong>Brightness is equal to or greater than existing lighting technologies</strong> (incandescent or fluorescent) and light is well distributed over the area lighted by the fixture.</li>

		<li><strong>Light output remains constant over time</strong>, only decreasing towards the end of the rated lifetime (at least 25,000 hours or 22 years based on use of 3 hours per day). </li>
		<li><strong>Excellent color quality</strong>. The shade of white light appears clear and consistent over time.</li>
		<li><strong>Efficiency is as good as or better than fluorescent lighting</strong>.</li>
		<li><strong>Light comes on instantly</strong> when turned on.</li>

		<li><strong>No flicker</strong> when dimmed.</li>
		<li><strong>No off-state power draw</strong>. The fixture does not use power when it is turned off, with the exception of external controls, whose power should not exceed 0.5 watts in the off state.</li>
	</ul>
	
	<p><strong>Bad design can lead to a wide range of problems, some immediately observable and some not</strong>. Poorly designed products often come with exaggerated claims while failing to deliver on the quality specifications above.</p>
	
	<p>Choose ENERGY STAR quailified LED fixtures to ensure the products you purchase perform well.</p>

	
</p>
</span><br><br></div></td>
<td width="256">

<!-- ------------------------------begin callouts------------------------------ -->
<? include("callouts.php"); ?>
<!-- ------------------------------end callouts------------------------------ -->

</td>
<td width="1" bgcolor="#c8e1ea"><img src="pix/pix_c8e1ea.gif" alt="" width="1" height="1" border="0"></td>
</tr></table>

</div></td>
</tr></table>

<table width="906" border="0" cellspacing="0" cellpadding="0" align="center"><tr valign="top">
<td width="906"><img src="pix/g_body_bot.gif" alt="" width="906" height="12" border="0"></td>
</tr></table>
<!-- ------------------------------end body------------------------------ -->

<!-- ------------------------------begin footer------------------------------ -->
<? include("footer.php"); ?>
<!-- ------------------------------end footer------------------------------ -->
</div>
</body>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7592070-3");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>


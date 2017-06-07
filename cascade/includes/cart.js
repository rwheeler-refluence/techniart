//function for updating an edit

 function cartResponse() {

  if (http.readyState == 4) {

   results = http.responseText.split('|');

    //alert(http.responseText.split('|'));
    hidewait();

    cartinfo= eval('(' + results[1] + ')');
    var theacct = cartinfo['p1'];
	//alert("p1:"+theacct);

	//store in cookie
	var cartvar = JSON.stringify(cartinfo);
    setCookie('cartinfo',cartvar,365);

    //document.body.style.cursor='auto';

    if (http.responseText.indexOf("gotthecart") > -1 || http.responseText.indexOf("fromcart") > -1){

	  //there are only 10 products so no need to have a products database/just change it here when needed
/*

1 1.60 Dish Squeegee
2 1.60 Sprinkler System DVD
3 4.60 Earth Massage Chrome Showerhead
4 4.60 Earth Massage Showerhead
5 4.60 Spray Clean Showerhead
6 1.60 Dye Tablets/Strips
7 1.60 Rain Gauge
8 4.60 Shower Timer
9 4.60 Kitchen Faucet Aerator
10 4.60 Bathroom Faucet Aerator

*/

	   var mpara='';
	   var mpara2='';
	   mpara="<table id='cart_body'>";
	   mpara2="<table id='cart_body'>";
	   var i=1;
	   var ptitle="";
	   var pdesc="";
	   var pqty=0;
	   var mship=0;
	   var mtop=355;
	   var num_products=0;
       
       var envelope = 0;  //0=#10 envelope, 1=6x9 mailer, 2=box
       
	   while (i < 11) {

		    if (cartinfo['p'+i] > 0){

			    if (i==1){
		          ptitle="Dish Squeegee";
                  pdesc="The dish squeegee allows you to scrape food waste from dirty dishes.";
                  pqty=cartinfo['p1'];
                  mship=mship+(1.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  
                  //envelope stays at 0
                } else if(i==2){
                  ptitle="Sprinkler System DVD";
                  pdesc="The Beautiful Landscapes Through Smart Watering DVD.";
                  pqty=cartinfo['p2'];
                  mship=mship+(1.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  if(envelope < 2) {
                      envelope++;  //upgrade if it's not already a box
                  }
                } else if(i==3){
                  ptitle="Earth Massage Chrome Showerhead";
                  pdesc="The Earth Massage Chrome showerhead uses 1.75 gallons per minute.";
                  pqty=cartinfo['p3'];
                  mship=mship+(4.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  envelope=2;
                } else if(i==4){
                  ptitle="Earth Massage Showerhead";
                  pdesc="The Earth Massage showerhead uses 2.0 gallons per minute.";
                  pqty=cartinfo['p4'];
                  mship=mship+(4.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  envelope=2;
                } else if(i==5){
                  ptitle="Spray Clean Showerhead";
                  pdesc="Save water and energy with this high-efficiency, chrome-plated showerhead.";
                  pqty=cartinfo['p5'];
                  mship=mship+(4.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  envelope=2;
                } else if(i==6){
                  ptitle="Dye Tablets/Strips";
                  pdesc="Check your toilets for leaks at least once each year with these non-toxic dye tablets.";
                  pqty=cartinfo['p6'];
                  mship=mship+(1.50*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                } else if(i==7){
                  ptitle="Rain Gauge";
                  pdesc=" Use this high quality durable plastic gauge to keep track of rainfall.";
                  pqty=cartinfo['p7'];
                  mship=mship+(1.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  envelope=2;
                } else if(i==8){
                  ptitle="Shower Timer";
                  pdesc="This digital and waterproof timer attaches to the shower wall with a suction cup.";
                  pqty=cartinfo['p8'];
                  mship=mship+(4.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  envelope=2;
                } else if(i==9){
                  ptitle="Kitchen Faucet Aerator";
                  pdesc="A 360 degree swivel capability plus an on / off throttle to make this water saver.";
                  pqty=cartinfo['p9'];
                  mship=mship+(4.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  if(envelope < 2) {
                      envelope++;  
                      //if it's 2, it stays 2
                  }
                } else if(i==10){
                  ptitle="Bathroom Faucet Aerator";
                  pdesc="The flow rate of the faucet is reduced to 0.5 gallons per minute.";
                  pqty=cartinfo['p10'];
                  mship=mship+(4.60*pqty);
                  mtop=mtop+90;
                  num_products=num_products+1;
                  
                  if(envelope < 2) {
                      envelope++;  
                      //if it's 2, it stays 2
                  }
                }

		          mpara=mpara+"<tr><td colspan='3'  valign='middle' width='130' height='20'><img src='images/cart-line.png\' alt='' width='760' height='2' /></td></tr>";

   	              mpara=mpara+"<tr>";


   	              //now three cells
   	              mpara=mpara+"<td valign='top' width='130'><img src='images/p"+i+"-thumb.jpg' alt='' width='110' height='70' /></td>";

	              mpara=mpara+"<td colspan='2' valign='top'>";

	              mpara=mpara+"<h3 style='font: 20px Fjalla One; font-weight:regular;color:#20507C;'>"+ptitle+"</h3>";
		          mpara=mpara+"<p style='font: 16px Archivo Narrow; color:#000000;line-height:150%;'>"+pdesc+"</p>";
		          mpara=mpara+"<a style='font: 14px Archivo Narrow; color:#577b9d;' id='d"+i+"' class='cart-delete' onclick='prod_delete(this.id);'>Delete &raquo;</a>";

		          mpara=mpara+"</td>";

		          mpara=mpara+"<td class='td-qty' valign='center'>";
		          mpara=mpara+"<input type='number' id='shop-p"+i+"' onchange='' class='rounded' value="+pqty+" style='width:20px;text-align:left;'>";
	              mpara=mpara+"</td>";


	              mpara=mpara+"</tr>";


	              //the review
	              mpara2=mpara2+"<tr><td colspan='3'  valign='middle' width='130' height='20'><img src='images/cart-line.png\' alt='' width='760' height='2' /></td></tr>";

   	              mpara2=mpara2+"<tr>";


   	              //now three cells
   	              mpara2=mpara2+"<td valign='top' width='130'><img src='images/p"+i+"-thumb.jpg' alt='' width='110' height='70' /></td>";

	              mpara2=mpara2+"<td colspan='2' valign='top'>";

	              mpara2=mpara2+"<h3 style='font: 20px Fjalla One; font-weight:regular;color:#20507C;'>"+ptitle+"</h3>";
		          mpara2=mpara2+"<p style='font: 16px Archivo Narrow;color:#000000;line-height:150%;'>"+pdesc+"</p>";
		          mpara2=mpara2+"</td>";

		          mpara2=mpara2+"<td class='td-qty' valign='center'>";
		          mpara2=mpara2+"<td>"+pqty+"</td>";
	              mpara2=mpara2+"</td>";


	              mpara2=mpara2+"</tr>";

	              //fill in the customer review information
	              var userinfo=getCookie("cinfo");
                  var acctinfo = eval('(' + userinfo + ')');

                  var billblk="<div style='position:absolute;width:200px;height:100px;left:0px;top:0px;font: 14px Archivo Narrow;border:0px solid #ccc;z-index:14;text-align:left;'><p style='font: 16px Archivo Narrow;font-weight:regular;color:#1d4d7b;padding-top:5px;'>Shipping Information</p><p style='line-height:150%;'>"+acctinfo['fname']+"&nbsp;"+acctinfo['lname']+"<br />"+acctinfo['add1']+"&nbsp;&nbsp;"+acctinfo['add2']+"<br />"+acctinfo['city']+", WA&nbsp;"+ acctinfo['zip']+"</p><a onclick='showSec(orregister\");' href='#'>Edit</a></div>";
                  var shipblk="<div style='position:absolute;width:200px;height:100px;left:250px;top:0px;font: 14px Archivo Narrow;border:0px solid #ccc;z-index:14;text-align:left;'><p style='font: 16px Archivo Narrow;font-weight:regular;color:#1d4d7b;padding-top:5px;'>Billing Information</p><p style='line-height:150%;'>"+acctinfo['b_fname']+"&nbsp;"+acctinfo['b_lname']+"<br />"+acctinfo['b_add1']+"&nbsp;&nbsp;"+acctinfo['b_add2']+"<br />"+acctinfo['b_city']+", WA&nbsp;"+ acctinfo['b_zip']+"</p><a onclick='showSec(\"register\");' href='#'>Edit</a></div>";



            }

          i++;
       }


      /* if (mship > 4.60){
	       mship=5.30;
       }*/
       
       switch(envelope) {
           case 0:
            mship = 1.50;
            break;
           case 1:
            mship = 4.30;
            break;
           case 2: 
            mship = 6.25;
            break;
       }
       

       document.getElementById('j4').value=mship;

       if (num_products > 1){
	      prod_box=((num_products*82)+700);
       } else {
	      prod_box=700;
       }

       mship=mship.toFixed(2);
       mpara=mpara+"<tr><td colspan='4' valign='middle' width='140' height='20'><img src='images/cart-line.png' alt='' width='760' height='2'></td></tr>";

       mpara=mpara+"<tr><td colspan='4'>&nbsp;</td></tr>";
	   mpara=mpara+"<tr><td colspan='4'>&nbsp;</td></tr>";


	   mpara=mpara+"<tr><td colspan='4' style='font: 18px Fjalla One; font-weight:regular;text-align:right'>&nbsp;&nbsp;&nbsp;Shipping: "+mship+"</td></tr>";
	   mpara=mpara+"<tr><td colspan='4' style='font: 20px Fjalla One; font-weight:regular;text-align:right'>&nbsp;&nbsp;&nbsp;Your Total: "+mship+"</td></tr>";
	   mpara=mpara+"<tr><td colspan='4' style='font: 13px Archivo Narrow; font-weight:regular;text-align:right'>&nbsp;&nbsp;&nbsp;(Items are free.  You pay for only the shipping)</td></tr>";

       mpara=mpara+"</table>";

       //review
       mpara2=mpara2+"<tr><td colspan='4' valign='middle' width='140' height='20'><img src='images/cart-line.png' alt='' width='760' height='2'></td></tr>";

       mpara2=mpara2+"<tr><td colspan='4'>&nbsp;</td></tr>";
	   mpara2=mpara2+"<tr><td colspan='4'>&nbsp;</td></tr>";


	   mpara2=mpara2+"<tr><td colspan='4' style='font: 18px Fjalla One; font-weight:regular;text-align:right;'>Shipping: "+mship+"</td></tr>";
	   mpara2=mpara2+"<tr><td colspan='4' style='font: 20px Fjalla One; font-weight:regular;text-align:right;'>Your Total: "+mship+"</td></tr>";
	   mpara2=mpara2+"<tr><td colspan='4' style='font: 13px Archivo Narrow; font-weight:regular;text-align:right;'>(Items are free.  You pay for only the shipping)</td></tr>";

       mpara2=mpara2+"</table>";


       //setup yhe review page if customer decide to order the free ones chosen
	      var chkbox= prod_box;
	      chkbox=chkbox-100;

	      mtop=mtop+30;
          document.getElementById('cancelorder').style.top=mtop+"px";
          document.getElementById('placeorder').style.top=mtop+"px";
          document.getElementById('review_checkout').style.height=chkbox+"px";

          mtop=mtop+120;
          document.getElementById('footer3').style.top=mtop+"px";

          if (num_products > 0){
	         document.getElementById('checkout_cust_details').innerHTML=shipblk+billblk;

             document.getElementById('cart_prods_review').innerHTML=mpara2;
          } else {
	        document.getElementById('cart_prods_review').innerHTML="<p><center>***  There are no products selected  ***</center></p>";

          }
          mtop=mtop-150;



          document.getElementById('updatebtn').style.top=mtop+"px";
          mtop=mtop+50;
          document.getElementById('continueshopbtn').style.top=mtop+"px";
          document.getElementById('checkoutbtn').style.top=mtop+"px";

          mtop=mtop+180;
          document.getElementById('footer2').style.top=mtop+"px";

          document.getElementById('cart').style.height=prod_box+"px";

          if (num_products > 0){
             document.getElementById('cart_prods').innerHTML=mpara;
          } else {
	        document.getElementById('cart_prods').innerHTML="<p><center>***  There are no products selected  ***</center></p>";

          }

          if (http.responseText.indexOf("fromcart") > -1){

	           document.getElementById('themessage').innerHTML="<b>Your cart has been updated.</b><br>";
               showSec('messagescr');

	           //alert('Your cart has been updated.');
          }

          showSec('cart');




      } else {

	      if (results[0].indexOf("updatedthecart") > -1 ){

		       document.getElementById('themessage').innerHTML="<b>Your cart has been updated with current values.</b><br>";
               showSec('messagescr');

		       //alert('Your cart has been updated with current values.');
	      } else {

		       document.getElementById('themessage').innerHTML="<b>The product has been added to your cart.</b><br>";
               showSec('messagescr');

		       //alert('The product has been added to your cart.');
	      }

          showSec('prods');

      } // end of condition to test for getting cart or adding updating cart with items.

  }

}




function cart_proc(mwhat) {


var checkvalues="";
checkvalues=prod_check();
if (checkvalues !=""){

	document.getElementById('themessage').innerHTML=checkvalues;
    showSec('messagescr');
    //alert(checkvalues);
	exit;
}

  var updateurl = "includes/php/cart_process.php?mform="; // The server-side script

  //alert('in cart function');
  //document.body.style.cursor = "wait";


  s = new Array();


  if (trim(document.getElementById('j1').value)==""){
	  document.getElementById('themessage').innerHTML="You must be logged to do this function.";
      showSec('messagescr');
	  //alert("You must be logged to do this function.");
  } else {

     s[0] = document.getElementById('j1').value;
     s[1] = "0"; //document.getElementById('p1').value;
     s[2] = document.getElementById('p2').value;
     s[3] = document.getElementById('p3').value;
     s[4] = document.getElementById('p4').value;
     s[5] = document.getElementById('p5').value;
     s[6] = document.getElementById('p6').value;
     s[7] = document.getElementById('p7').value;
     s[8] = document.getElementById('p8').value;
     s[9] = document.getElementById('p9').value;
     s[10] =document.getElementById('p10').value;
     s[11] = mwhat;



     if ((s[1] + s[2] + s[3] + s[4] + s[5] + s[6] + s[7] + s[8] + s[9] + s[10]) ==0){
	    document.getElementById('themessage').innerHTML="<b>Your cart does not have any products.</b><br>Enter a value in the box next to the<br>products you want and click to add to cart.";
        showSec('messagescr');
	    //alert("You must add products.");
	    showSec('prods');
        exit;

	 }

     //alert(s[0]+" : "+s[1]+" : "+s[2]+" : "+s[3]+" : "+s[4]+" : "+s[5]+" : "+s[6]+" : "+s[7]+" : "+s[8]+" : "+s[9]+" : "+s[10]+" : "+s[11]);

     for(myKey in s){



        s[myKey]=s[myKey].replace(/\'/g,'');

     }

     showwait();
     http.open("GET", updateurl + escape(s), true);
     http.onreadystatechange = cartResponse;
     http.send(null);

  }


}

function cart_update() {
//do this in separate function so it can only be called when cart up

  var ix=1;
  while (ix < 11) {

	 if (document.getElementById('shop-p'+ix)){
		//alert('shop-p'+ix+' exist');
		document.getElementById('p'+ix).value=document.getElementById('shop-p'+ix).value;

		//alert("the main value: "+document.getElementById('p'+ix).value);

     }

    ix++;
  }

  cart_proc('fromcart');

}

function prod_delete(whichone) {

  var ix=parseInt(trim(whichone.substring(1)));

  //alert(ix+"  <--");
  document.getElementById('p'+ix).value=0;
  cart_proc('fromcart');

}


function prod_check() {


	var checkforErrors="";

	var num1 = parseInt(document.getElementById('p3').value);
	var num2 = parseInt(document.getElementById('p4').value);
	var num3 = parseInt(document.getElementById('p5').value);
	var mtotal=(num1+(num2+num3));

	//alert("showerheads: "+mtotal);
	if ( mtotal > 2) {
	  	checkforErrors = checkforErrors+"Only two showerheads are allowed per household. <br>";
	  	document.getElementById('p3').value=0;
	  	document.getElementById('p4').value=0;
	  	document.getElementById('p5').value=0;

		if (document.getElementById('shop-p3')){
		   document.getElementById('shop-p3').value=0;
	    }
	    if (document.getElementById('shop-p4')){
		   document.getElementById('shop-p4').value=0;
	    }
	    if (document.getElementById('shop-p5')){
		   document.getElementById('shop-p5').value=0;
	    }
	}

	/*
	if ( parseInt(document.getElementById('p1').value) > 1 ){

		document.getElementById('p1').value=1;
		if (document.getElementById('shop-p1')){
		   document.getElementById('shop-p1').value=1;
	    }
		checkforErrors = checkforErrors+"Only one squeegee is allowed per household. <br>";
    }
    */
	if ( parseInt(document.getElementById('p2').value) > 1 ){
		checkforErrors = checkforErrors+"Only one DVD is allowed per household. <br>";
		document.getElementById('p2').value=1;
		if (document.getElementById('shop-p2')){
		   document.getElementById('shop-p2').value=1;
	    }
	}

	if ( parseInt(document.getElementById('p6').value) > 3 ){
		checkforErrors = checkforErrors+"Only three packages tablets are allowed per household. <br>";
		document.getElementById('p6').value=3;
		if (document.getElementById('shop-p6')){
		   document.getElementById('shop-p6').value=3;
	    }
	}

	if ( parseInt(document.getElementById('p7').value) > 1 ){
		checkforErrors = checkforErrors+"Only one raind gauge is allowed per household. <br>";
		document.getElementById('p7').value=1;
		if (document.getElementById('shop-p7')){
		   document.getElementById('shop-p7').value=1;
	    }
	}

	if ( parseInt(document.getElementById('p8').value) > 1 ){
		checkforErrors = checkforErrors+"Only one timer is allowed per household. <br>";
		document.getElementById('p8').value=1;
		if (document.getElementById('shop-p8')){
		   document.getElementById('shop-p8').value=1;
	    }
	}

	if ( parseInt(document.getElementById('p9').value) > 1 ){
		checkforErrors = checkforErrors+"Only one kitchen faucet aerator is allowed per household. <br>";
		document.getElementById('p9').value=1;
		if (document.getElementById('shop-p9')){
		   document.getElementById('shop-p9').value=1;
	    }
	}


	if ( parseInt(document.getElementById('p10').value) > 3){
		checkforErrors = checkforErrors+"Only one bathroom faucet aerator is allowed per household. <br>";
		document.getElementById('p10').value=3;
		if (document.getElementById('shop-p10')){
		   document.getElementById('shop-p10').value=3;
	    }
	}


	return checkforErrors;

}



function cc_proc() {


 var updateurl = "includes/php/submitCC.php?mform="; // The server-side script


  //fill in the customer review information
  var userinfo=getCookie("cinfo");
  var acctinfo = eval('(' + userinfo + ')');

  var cctype="Visa";

  if (document.getElementById('Billing_type').selectedIndex==1){
  	 cctype="Mastercard";
  }



  s = new Array();


  if (trim(document.getElementById('j1').value)==""){
	 document.getElementById('themessage').innerHTML="<b>You must be logged to do this function.</b><br>";
     showSec('messagescr');
	 //alert("You must be logged to do this function.");
  } else {

     s[0] = document.getElementById('j1').value;
     s[1] = acctinfo['b_fname'];
     s[2] = acctinfo['b_lname'];
     s[3] = acctinfo['b_add1']+" "+acctinfo['b_add2'];
     s[4] = acctinfo['b_city'];
     s[5] = acctinfo['b_zip'];
     s[6] = cctype;
     s[7] = document.getElementById('Billing_Number').value;
     s[8] = document.getElementById('Billing_exp').value;
     s[9] = document.getElementById('j4').value;
     s[10] =  acctinfo['email'];
     //alert(s[0]+" : "+s[1]+" : "+s[2]+" : "+s[3]+" : "+s[4]+" : "+s[5]+" : "+s[6]+" : "+s[7]+" : "+s[8]+" : "+s[9]);

     for(myKey in s){

        s[myKey]=s[myKey].replace(/\'/g,'');

     }

     showwait();
     //alert("making cc ajax call.");

     http.open("GET", updateurl + escape(s), true);
     http.onreadystatechange = ccResponse;
     http.send(null);

  }


}


function ccResponse() {

  if (http.readyState == 4) {

   var mdone=false;
   //alert(  http.responseText );
   results = http.responseText;
   cartinfo= eval('(' + results + ')');
   var theacct = cartinfo['thedecision'];
   //alert("p1: "+theacct);


   hidewait();

   if (theacct=='REJECT'){
	  document.getElementById('themessage').innerHTML="<b>Payment was rejected.</b><br><br>Please try again. Call 425-869-1379<br>or 1-800-632-1379 for assistance.<br>";
      showSec('messagescr');
      showSec('cart');
   } else {

      document.getElementById('themessage').innerHTML="<b>Payment has been processed.</b><br><br>Your order for free conservation items is currently<br>being processed and will ship in 5-10 working days.<br>The shipping cost for this order will appear on your<br>credit card statement as Compact Information Systems.<br><br>If you have any questions or to inquire about the <br>status of your order feel free to call 425-869-1379<br>or 1-800-632-1379 for assistance.<br><br>Thank you for your order.";
      showSec('messagescr');
      var mdone=resetprods();
      showSec('prods');
      eraseCookie('mcartinfo');
   }

  }

}


function resetprods() {

  var ix=1;
  while (ix < 11) {

	 if (document.getElementById('shop-p'+ix)){

		document.getElementById('p'+ix).value=0;
		document.getElementById('shop-p'+ix).value=0;


     }

    ix++;
  }


  return true;

}
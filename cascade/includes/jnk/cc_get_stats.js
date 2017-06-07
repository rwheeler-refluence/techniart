//function for getting stats

 function getstatsResponse() {

  if (http.readyState == 4) {
   document.getElementById('statText1').innerHTML="";
   document.getElementById('statText2').innerHTML="";
   document.getElementById('statText3').innerHTML="";
   document.getElementById('statText4').innerHTML="";
   var has_stats="N";
 
   results = http.responseText.split("^");

   r1= new Array();

   // this will build out the columns for the orders and order amount
   for (x in results)
    {
     
      r1 = results[x].split("|");
      if (r1[3] > 0){
         has_stats="Y";
         if (parseInt(r1[0]) < 10) {r1[0]="0" + r1[0]};
         mthyr=r1[0]+"/"+r1[1];

         r1[3]=trim(r1[3]);
         if (r1[3].indexOf('.',0)==-1) {r1[3] = (r1[3]+'.00')};

         var singledec=(r1[3].length-2);
         if ( r1[3].indexOf('.',0) == singledec ){r1[3]=(r1[3]+'0')};
         
         //document.getElementById('statText1').innerHTML=document.getElementById('statText1').innerHTML+mthyr+"<br>"
         //document.getElementById('statText2').innerHTML=document.getElementById('statText2').innerHTML+r1[2]+"<br>"
         //document.getElementById('statText3').innerHTML=document.getElementById('statText3').innerHTML+r1[3]+"<br>"
      }
    }


    //send multi-demintional array to chart script and it will loop through various charts until done
    if (has_stats == "Y") {
      
      getstatchart(results,"R");

    } else {

      document.getElementById('statText1').innerHTML="";
      document.getElementById('statText2').innerHTML="";
      document.getElementById('statText3').innerHTML="";
      document.getElementById('statText4').innerHTML="<br>&nbsp;&nbsp;No Activity.";

      hidewait();
      document.body.style.cursor='auto';  

    }    
  }

}


function getstats() {
  var updateurl = "includes/php/cc_get_stats_fox.php?mform="; // The server-side script


  if (trim(document.getElementById('mcustid').value) != "") {

    s = new Array(); 
    s[0] = document.getElementById('mcustid').value;
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getstatsResponse;
    http.send(null);

  } else {
  
 
    document["graph1"].src ="images/blankchart.gif";
    document["graph2"].src ="images/blankchart.gif";
    document.getElementById('confirmtext').innerHTML="No customer currently selected.";
    showconfirm();

  }


}



//function for getting the quick stats

 function getqstatsResponse() {

  if (http.readyState == 4) {
    document.getElementById('statText4').innerHTML=" ";
    results = http.responseText.split("|");
//alert(http.responseText);
    if (results[0] > 0 || results[1] > 0){

       if (results[0].substring(0,6) == "Object") {results[0]="0"};
       if(results[4]){if (results[4].substring(0,6) == "Object") {results[4]="0.00"}};
       
         if (results[1] >= 0){
	         
              if(results[4]){document.getElementById('statln1').innerHTML="$"+trim(results[4])};
              document.getElementById('statln2').innerHTML="$"+trim(results[0]);
              document.getElementById('statln3').innerHTML=results[1];
              document.getElementById('statln4').innerHTML="On John's List";
              if(results[3]){
                document.getElementById('statln5').innerHTML=results[2]+"   "+results[3];
                document.getElementById('statln6').innerHTML=results[5];
                document.getElementById('statln7').innerHTML=results[6];
              }
         } else {
	         
	          if(results[4]){document.getElementById('statln1').innerHTML="$"+trim(results[4])};
              document.getElementById('statln2').innerHTML="$"+trim(results[0]);
              document.getElementById('statln3').innerHTML="Has not logged into website";
              document.getElementById('statln4').innerHTML="On John's List";
              if(results[3]){
                document.getElementById('statln5').innerHTML=results[2]+"   "+results[3];
                document.getElementById('statln6').innerHTML=results[5];
                document.getElementById('statln7').innerHTML=results[6];
              }
 
         }    
          
         document.getElementById('statblockvalues').style.visibility = "visible";
     } else {
       document.getElementById('statblockvalues').style.visibility = "hidden";
       document.getElementById('statText4').innerHTML="<br>&nbsp;&nbsp;There has been no order<br>&nbsp;&nbsp;or website activity"; 

     }

    //showqstats();
    hidewait();
    document.body.style.cursor='auto'; 
 
 } 


}


function getqstats() {
  var updateurl = "includes/php/cc_get_qstats_fox.php?mform="; // The server-side script

    s = new Array(); 
    s[0] = document.getElementById('mcustid').value;
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getqstatsResponse;
    http.send(null);


}





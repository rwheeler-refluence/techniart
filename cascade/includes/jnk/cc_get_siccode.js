//function for getting stats

 function getorderreportResponse() {

  if (http.readyState == 4) {
//alert(http.responseText);

   var d=new Date();
   var day=d.getDate();
   var month=d.getMonth()+1;
   var year=d.getFullYear();
   var mwho=trim(document.getElementById('mcustid').value)+" -"+trim(document.getElementById('company').value);

   reportArray = new Array();
   reportArray[0] = "<table border='0' width='80%' align='left'><tr style='font: 12px Arial'><td id='rptTitle' width='20%'><b>Account Orders</td><td id='rptcoHead' width='80%'>-</b>for "+mwho+" As of :  "+month+"/"+day+"/"+year+"</td></tr></table>";  
   reportArray[1] = "<table border='0' width='80%' align='left'><tr style='font: 11px Arial'><td width='16%'><b>Mth/year</b></td><td width='19%' align='right'><b>Orders</b></td><td width='34%' align='right'><b>Amount</b></td><td width='31%' align='right'></td></tr></table>";
   reportArray[2] = "";
   var col1tot=0;
   var col2tot=0;
   var lncount=0;
   var bcolor=document.getElementById('chartbg').value;
   

   results = http.responseText.split("^");

   r1= new Array();

   // this will build out the columns for the orders and record counts
   for (x in results)
    {
     
      r1 = results[x].split("|");

      

      if ( (r1[3] > 0) && (r1[0].substring(0,1) !="undefined") ){
        
         if (parseInt(r1[0]) < 10) {r1[0]="0" + r1[0]};

         mthyr=r1[0]+"/"+r1[1];

         r1[3]=trim(r1[3]);
         if (r1[3].indexOf('.',0)==-1) {r1[3] = (r1[3]+'.00')};

         var singledec=(r1[3].length-2);
         if ( r1[3].indexOf('.',0) == singledec ){r1[3]=(r1[3]+'0')};



         col1tot=col1tot+(+r1[2]);

         col2tot=col2tot+(+r1[3]);

         lncount=(lncount+1);
         if (bcolor==document.getElementById('chartbg').value){
           bcolor=document.getElementById('chartmargin').value;
         } else {
           bcolor=document.getElementById('chartbg').value;
         }
  
         reportArray[2] = reportArray[2]+"<tr style='font: 11px Arial' bgcolor='"+bcolor+"'><td style='font: 11px Arial, Helvetica' width='16%'>"+mthyr+"</td><td width='16%'  align='right'>"+r1[2]+"</td><td width='31%' align='right'>"+r1[3]+"</td><td width='37%' align='right'></td></tr>";

      }

    }

    hidewait();
    document.body.style.cursor='auto';
    col2tot=col2tot.toFixed(2);
    document.getElementById('rpttitle').innerHTML=reportArray[0];
    document.getElementById('rowheader').innerHTML=reportArray[1];
  
    document.getElementById('reportbody').innerHTML="<table border='0' width='80%' align='left'>"+reportArray[2]

        +"<tr style='font: 11px Arial'><td width='16%'></td><td width='16%' align='right'>==========</td><td width='31%' align='right'>==========</td><td width='37%'></td></tr>"

        +"<tr style='font: 11px Arial'><td width='16%'></td><td width='16%' align='right'>"
        +col1tot+"</td><td width='31%'  align='right'>"+col2tot+"</td><td width='37%'></td></tr></table>"

        +"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>" 
        +"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";
    document.getElementById('pdfid').value=trim(document.getElementById('mcustid').value);
    document.getElementById('current_pdf').value="orders";

    //need to add this to the other excell reports to be able to save xls report  
    document.getElementById('excelrpt').innerHTML="<font size='2'>Excel File</font>";   
    document.getElementById('excelrpt').href="http://<?php echo $SERVER_NAME ?>/cc/"+document.getElementById('ucoid').value+"graphs/"+trim(document.getElementById('mcustid').value)+"_orders.xls";

   

    showreport("noninv");

  }

}


function getorderreport() {
  var updateurl = "includes/php/cc_get_stats_fox.php?mform="; // The server-side script
  if (trim(document.getElementById('mcustid').value) != "") {

    s = new Array(); 
    s[0] = document.getElementById('mcustid').value;
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getorderreportResponse;
    http.send(null);

  } else {
  
    document.getElementById('confirmtext').innerHTML="No customer currently selected.";
    showconfirm();

  }


}


function exp_coll(ind)
 
{
 s = document.getElementById("sp_" + ind);
 i = document.getElementById("im_" + ind);
 if (s.style.display == 'none')
 { 
   s.style.display = 'block';
   i.src = "./images/minus.gif";
   
   if (ind==0){
     getsicinfo('0','0999',4);
   } else if(ind==10){
     getsicinfo('1000','1499',4);   
   } else if (ind==15){
	 getsicinfo('1500','1799',4);   
   } else if (ind==20){
	 getsicinfo('2000','3999',4);    
   } else if (ind==40){
	 getsicinfo('4000','4999',4);     
   } else if (ind==50){
   	 getsicinfo('5000','5199',4);    	   	   
   } else if (ind==52){
   	 getsicinfo('5200','5999',4);    	   	   
   } else if (ind==60){
   	 getsicinfo('6000','6799',4);    	   	   
   } else if (ind==70){
   	 getsicinfo('7000','8999',4);    	   	   
   } else if (ind==91){
   	 getsicinfo('9100','9799',4);    	   	   
   } else if (ind==99){
   	 getsicinfo('9900','9999',4);    	   	   
   }
   
 }
 else if (s.style.display == 'block')
 {
   s.style.display = 'none';
   i.src = "./images/plus.gif";
 }
}

 
function exp(ind)
{
 s = document.getElementById("sp_" + ind);
 i = document.getElementById("im_" + ind);
 
 if (!(s && i)) return false;
 s.style.display = 'block';
 i.src = "./images/minus.gif";
 
 
}

 
function coll(ind)
{
 s = document.getElementById("sp_" + ind);
 i = document.getElementById("im_" + ind);
 if (!(s && i)) return false;
 s.style.display = 'none';
 i.src = "./images/plus.gif";
}
 

function coll_all()
{
 var cnt=0;
 
 while (cnt < 100){
   coll(cnt);
  cnt=(cnt+1);
 }  
    
}
 
function exp_all()
{
	
 var cnt=0;
 
 while (cnt < 100){
   exp(cnt);
  cnt=(cnt+1);
 }  	
	
 
}

function loadtmpinfo(mcode,mname){
	  	  
  document.getElementById('TMP_dun_sic').value=mcode;
  document.getElementById('TMP_dun_sic_desc').value=trim(mname.substring(6));  
  
}	

function loadsicinfo(){
	
   if (document.getElementById('maddscreenup').value === "YES") {
	  
      document.getElementById('ADD_dun_sic').value=document.getElementById('TMP_dun_sic').value;
      document.getElementById('ADD_dun_sic_desc').value=document.getElementById('TMP_dun_sic_desc').value;
      
   } else {
	  document.getElementById('dun_sic').value=document.getElementById('TMP_dun_sic').value;
      document.getElementById('dun_sic_desc').value=document.getElementById('TMP_dun_sic_desc').value;
      
   }
   	
 hideSicLookup();  
   
}	

// the next two functions retrieve the dun information
function getsicinfo(low,high,FourOrSix) {
		
  var url = "includes/php/getsic_process.php?mfilter="; // The server-side script
  //alert("in this function");
  s = new Array();
  s[0] = low;
  s[1] = high;
  s[2] = FourOrSix;
  
  //document.body.style.cursor = "wait";
  //showwait();

  http.open("GET", url + escape(s), true);
  http.onreadystatechange = getsicResponse;
  http.send(null);

 
}

function getsicResponse() {

  if (http.readyState == 4) {
	        
    results = http.responseText.split("^");
    var thesic="";
    //alert(http.responseText);
    //results=tresults.sort();
    
    r1= new Array();

    reportArray = new Array();
    reportArray[0] = "";  
        
    for (x in results)
    {
     
     r1 = results[x].split("|");
    
         if (r1[1] != undefined){
	       thesic=r1[0]; 
	       r1[0]=r1[0].replace(",",";");
	       //reportArray[0] = reportArray[0]+"<li><a href='javascript:exp_coll(18);'><img src='./images/plus.gif' width='11' height='11' alt='toggle' border='0' id='im_18' /></a>";
           reportArray[0] = reportArray[0]+"<a class='sica' href=\"javascript:loadtmpinfo('"+r1[0]+"','"+r1[1]+"');\"> "+r1[1]+" </a>";
           reportArray[0] = reportArray[0]+"<ul class='sicul' id='sp_18' style='display:block;'><div id='agr"+x+"'>";
           //this is for another one
           reportArray[0] = reportArray[0]+"</ul></li>";
	       
	     }// end of defined condition
     } // end of loop
  
  //alert(thesic);  
  thesic=parseInt(thesic);
     
  if (thesic <=999){ 
     document.getElementById('agrlist').innerHTML= reportArray[0];
  } else if (thesic > 999 && thesic <= 1499){  
	 document.getElementById('minelist').innerHTML= reportArray[0]; 
  } else if (thesic >= 1500 && thesic <= 1799){
	 document.getElementById('constlist').innerHTML= reportArray[0];  
  } else if (thesic >= 2000 && thesic <=3999){ 
	 document.getElementById('manulist').innerHTML= reportArray[0];    
  }	else if (thesic >= 4000 && thesic <=4999){
	 document.getElementById('translist').innerHTML= reportArray[0]; 
  }	else if (thesic >= 5000 && thesic <=5199){
	 document.getElementById('wholelist').innerHTML= reportArray[0];  
  }	else if (thesic >= 5200 && thesic <=5999){
	 document.getElementById('retaillist').innerHTML= reportArray[0];  
  } else if (thesic >= 6000 && thesic <=6799){
	 document.getElementById('finlist').innerHTML= reportArray[0];  
  } else if (thesic >= 6000 && thesic <=6799){
	 document.getElementById('finlist').innerHTML= reportArray[0];  
  } else if (thesic >= 6000 && thesic <=6799){
	 document.getElementById('finlist').innerHTML= reportArray[0];  
  } else if (thesic >= 7000 && thesic <=8999){
	 document.getElementById('servlist').innerHTML= reportArray[0];  
  } else if (thesic >= 9100 && thesic <=9799){
	 document.getElementById('publiclist').innerHTML= reportArray[0];  
  } else if (thesic >= 9900 && thesic <=9999){
	 document.getElementById('misclist').innerHTML= reportArray[0];  
  } 
  //hidewait();
  //document.body.style.cursor='auto';
   	  
   
  } //end of ready state

}


function clearSicInfo(){
	
  document.getElementById('dun_match').value ="";
  document.getElementById('duns_nmbr').value ="";
  document.getElementById('dun_sic').value ="";
  document.getElementById('dun_sic_desc').value ="";
  document.getElementById('dun_name').value ="";
  document.getElementById('dun_add1').value ="";
  document.getElementById('dun_city').value ="";
  document.getElementById('dun_st').value ="";
  document.getElementById('dun_zip').value ="";
  document.getElementById('dun_zip4').value ="";
  document.getElementById('dun_trade').value ="";
   
}	
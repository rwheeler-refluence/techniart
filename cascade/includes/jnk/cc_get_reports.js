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



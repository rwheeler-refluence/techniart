//function for getting stats

 function gettkreportsResponse() {

  if (http.readyState == 4) {

	 //alert(http.responseText);

     var results='';
     var d=new Date();
     var day=d.getDate();
     var month=d.getMonth()+1;
     var year=d.getFullYear();
     var mindex = document.forms['ticketform'].tkrptselect.selectedIndex;
     var pdfValue = document.forms['ticketform'].tkrptselect.options[mindex].value;
     var midValue = document.forms['ticketform'].tkrptselect.options[mindex].text;
     var mwho=midValue;

     reportArray = new Array();
     reportArray[0] = "<table border='0' width='85%' align='left'><tr style='font: 12px Arial'><td id='rptTitle' width='7%'><b>Joblog</td><td id='rptcoHead' width='93%'>-</b>for&nbsp;&nbsp;&nbsp;&nbsp;<b>"+mwho+"</b>&nbsp;&nbsp;&nbsp;&nbsp;As&nbsp;of&nbsp;:&nbsp;&nbsp;"+month+"/"+day+"/"+year+"</td></tr></table>"; 
 
     reportArray[1] = "<table border='0' width='85%' align='left'><tr style='font: 11px Arial'>"

         +"<td align='left' width='9%' valign='middle' style='font: 11px Arial, Helvetica'>Job"
         +"</TD><td align='left' width='9%' valign='middle' style='font: 11px Arial, Helvetica'>In"
         +"</TD><td align='left' width='8%' valign='middle' style='font: 11px Arial, Helvetica'>Due"
         +"</TD><td align='left' width='27%' valign='middle' style='font: 11px Arial, Helvetica'>Client"
         +"</TD><td align='left' width='26%' valign='middle' style='font: 11px Arial, Helvetica'>Description"
         +"</TD><td align='left' width='7%' valign='middle' style='font: 11px Arial, Helvetica'>Type"
         +"</TD><td align='left' width='7%' valign='middle' style='font: 11px Arial, Helvetica'>Quan"
         +"</TD><td align='left' width='13%' valign='middle' style='font: 11px Arial, Helvetica'>CIS</td></tr></table>";



     reportArray[2] = "";
     var col1tot=0;
     var col2tot=0;
     var lncount=0;
     var bcolor=document.getElementById('chartbg').value;
     var shownonefound="N";

    var emptytest= http.responseText;
    if (emptytest.substring(0,3) == 'Not' ) {

      reportArray[2] = "<tr style='font: 11px Arial' bgcolor='"+bcolor+"'><td style='font: 11px Arial, Helvetica' width='90%'>No Records Found.<br></td></tr>";
      var shownonefound="Y";

    } else {

       results = http.responseText.split("^");

//alert(http.responseText);
       var linestring='';

       r1= new Array();

       // this will build out the columns for the orders and record counts
       for (x in results)
       {
     
        r1 = results[x].split("|");

      
        if (r1[1] != undefined)
        {
       
	        
	        
	    if (document.getElementById("ucoid").value=='CIS'){    
	        
          r1[1]=r1[1].charAt(5)+r1[1].charAt(6)+"/"+r1[1].charAt(8)+r1[1].charAt(9)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
          r1[2]=r1[2].charAt(5)+r1[2].charAt(6)+"/"+r1[2].charAt(8)+r1[2].charAt(9)+"/"+r1[2].charAt(2)+r1[2].charAt(3);
        
        } else {	        
  
        //this is for fox
        if (r1[1].charAt(1) =="/"){
          if (parseInt(r1[1].charAt(0)) < 10) {r1[1]="0" + r1[1]};
        }
        if (r1[2].charAt(1) =="/"){
          if (parseInt(r1[2].charAt(0)) < 10) {r1[2]="0" + r1[2]};
        }
 
        //this is for fox
        if (r1[1].charAt(4) =="/"){
          if (parseInt(r1[1].charAt(3)) < 10) {r1[1]=r1[1].substring(0,3)+"0" + r1[1].substring(3,9)};
        }
        if (r1[2].charAt(4) =="/"){
          if (parseInt(r1[2].charAt(3)) < 10) {r1[2]=r1[2].substring(0,3)+"0" + r1[2].substring(3,9)};
        }

        r1[1]=r1[1].substring(0,5)+"/"+r1[1].charAt(8)+r1[1].charAt(9);
        r1[2]=r1[2].substring(0,5)+"/"+r1[2].charAt(8)+r1[2].charAt(9);
  
        } //end of cis check
        
        
           lncount=(lncount+1);
           if (bcolor==document.getElementById('chartbg').value){
             bcolor=document.getElementById('chartmargin').value;
           } else {
             bcolor=document.getElementById('chartbg').value;
           }
   
         linestring="<td align='left' width='8%' valign='middle' style='font: 11px Arial, Helvetica'>"+r1[0]
         +"</TD><td align='left' width='8%' valign='middle' style='font: 11px Arial, Helvetica'>"+r1[1]
         +"</TD><td align='left' width='8%' valign='middle' style='font: 11px Arial, Helvetica'>"+r1[2]
         +"</TD><td align='left' width='25%' valign='middle' style='font: 11px Arial, Helvetica'>"+r1[3]
         +"</TD><td align='left' width='25%' valign='middle' style='font: 11px Arial, Helvetica'>"+r1[5]
         +"</TD><td align='left' width='5%' valign='middle' style='font: 11px Arial, Helvetica'>"+r1[4]
         +"</TD><td align='left' width='7%' valign='middle' style='font: 11px Arial, Helvetica'>"+r1[7]
         +"</TD><td align='left' width='14%' valign='middle' style='font: 11px Arial, Helvetica'>"+r1[8]+"/"+r1[6]+"</td>";


         //linestring=r1[0]+r1[1]+r1[2]+r1[4]+r1[5]+r1[7]+r1[8];
         reportArray[2] = reportArray[2]+"<tr style='font: 11px Arial' bgcolor='"+bcolor+"'>"+linestring+"</tr>";


        }  


      }


      } // end of condition for empty 


      hidewait();
      document.body.style.cursor='auto';
     
      document.getElementById('rpttitle').innerHTML=reportArray[0];
      document.getElementById('rowheader').innerHTML=reportArray[1];
      if (results.length > 0){
        var mnumrecords=results.length-1;
      } else {
        var mnumrecords=0;
      }
      document.getElementById('reportbody').innerHTML="<table border='0' width='85%' align='left'>"+reportArray[2]
       
        +"<tr style='font: 11px Arial'><td width='100%' colspan='5' align='left'>Number of Tickets:&nbsp;&nbsp;"+mnumrecords+"</td></tr></table>"

        +"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>" 
        +"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";

       
       document.getElementById('pdfid').value=pdfValue;
       document.getElementById('current_pdf').value="tkrpts";

       //disabled the hides and show report section & had just pull PDF
       //document.getElementById('tkselectMain').style.visibility =  "hidden";
       //document.getElementById('tkrptselect').style.visibility =  "hidden";

              //need to add this to the other excell reports to be able to save xls report  

	document.getElementById('excelrpt').innerHTML="<font size='2'>Excel File</font>";   
	document.getElementById('excelrpt').href="http://<?php echo $SERVER_NAME ?>/cc/"+document.getElementById('ucoid').value+"graphs/"+pdfValue+"_tkrpts.xls";

document.getElementById('tkrptselect').selectedIndex=0;

      //showreport("noninv");

      if (shownonefound=="Y") {
	
         document.getElementById('confirmtext').innerHTML= "No open tickets found matching your selection";   //'not found or locked by another user.';
	 showconfirm();
	
      } else {

         rpdfopen('popup', 640, 480);

      } 



  }




}


function gettkreports() {
  var updateurl = "includes/php/tk_get_reports_process_fox.php?mtype="; // The server-side script
  var mindex = document.forms['ticketform'].tkrptselect.selectedIndex;
  var midValue = document.forms['ticketform'].tkrptselect.options[mindex].value;
  var rpttitle = document.forms['ticketform'].tkrptselect.options[mindex].text;
  s = new Array(); 
  s[0] = midValue;

//alert(midValue);

  if (midValue !=1){

  document.body.style.cursor = "wait";
  showwait();

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession)+"&rtitle=" +escape(rpttitle), true);
  http.onreadystatechange = gettkreportsResponse;
  http.send(null);

  }

}



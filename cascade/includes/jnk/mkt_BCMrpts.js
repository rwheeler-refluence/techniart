//function for getting uploaded files
 

function getBCMResponse() {

  if (http.readyState == 4) {
  
    // Split the delimited response into an array

    results = http.responseText.split("|");
    
    document.forms['marketform'].bcmselect.options.length = 0;

    for (x in results){
       document.forms['marketform'].bcmselect.options[x] = new Option(results[x],results[x],true,false);
    }

    if (document.forms['marketform'].bcmselect.options.length == 0) {
     document.forms['marketform'].bcmselect.options[x] = new Option("No uploaded .bcm files found.",'true');
    }
document.getElementById('bcmselect').style.visibility = "visible";
document.forms['marketform'].bcmselect.selectedIndex=0;
hidewait();
document.body.style.cursor='auto';

  }

}

function getBCM() {
  var bcmurl = "includes/php/mkt_get_bcm_process.php?mid="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = document.getElementById("uname").value;
  var usession = getmsession();
  http.open("GET", bcmurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getBCMResponse;
  http.send(null);
}



// retrieve opportunities


function pickOPResponse() {

  if (http.readyState == 4) {

    //set file for title
    var mindex = document.forms['marketform'].bcmselect.selectedIndex;
    var mselectedFile = document.forms['marketform'].bcmselect.options[mindex].value;

  results = http.responseText.split("^");
  var reccount=results.length;
  reccount=(reccount-1);
  var bcolor=document.getElementById('chartbg').value;

  document.getElementById('s1').innerHTML=reccount+"&nbsp<img src='images/rarrow.gif'>";
  document.getElementById('s2').innerHTML=" ";
  document.getElementById('s3').innerHTML=" ";
  document.getElementById('s4').innerHTML=" ";
  document.getElementById('s5').innerHTML=" ";
  
  results.sort();  

    r1= new Array();
    reportArray = new Array();
    reportArray[0] = "<table border='0' width='80%' align='left'><tr style='font: 11px Arial'><td id='rptTitle' width='30%'><b>Opportunities Pending for -</td><td id='rptcoHead' width='70%'>"+mselectedFile+"</b></td></tr></table>";  
    reportArray[1] = "<table border='0' width='80%' align='left'><tr style='font: 11px Arial'><td width='38%' align='left'><b>Company</b></td><td width='38%' align='left'><b>Contact</b></td><td width='11%' align='left'><b>Prob</b></td><td width='13%' align='left'><b>Product</b><br></td></tr></table>";


    reportArray[2] = "";

    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)

      {
 
         if (bcolor==document.getElementById('chartbg').value){
           bcolor=document.getElementById('chartmargin').value;
         } else {
           bcolor=document.getElementById('chartbg').value;
         }
  
         reportArray[2] = reportArray[2]+"<tr style='font: 11px Arial' bgcolor='"+bcolor+"'><td width='35%'a lign='left'>"+r1[0]+"</td><td width='35%' align='left'>"+r1[1]+"</td><td width='10%' align='left'>"+(r1[2]*100)+"%</td><td width='20%' align='left'>"+r1[3]+"</td></tr>";



      }  

    }


    document.getElementById('rpttitle').innerHTML=reportArray[0];
    document.getElementById('rowheader').innerHTML=reportArray[1];
    document.getElementById('reportbody').innerHTML="<table cellpadding='4' border='0'  width='80%' align='left'>"+reportArray[2]+"<tr style='font: 11px Arial'><td colspan='6' align='left'>Total number of opportunities found :&nbsp;"+reccount+"</td></tr></table><table class='singlelntable'><tr class='singlelntable' ><td class='singlelntable'></td><tr></table>"+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";

showreport('inv');
hidewait();
document.body.style.cursor='auto';


  }
}



function pickOP(){

document.getElementById('s1').innerHTML=" ";
document.getElementById('s2').innerHTML=" ";
document.getElementById('s3').innerHTML=" ";
document.getElementById('s4').innerHTML=" ";
document.getElementById('s5').innerHTML=" ";

var results =" ";
 
  if (document.forms['marketform'].bcmselect.options[0].text != "No uploaded .bcm files found.") {
    document.getElementById('reportbody').innerHTML="";
    var userurl = "includes/php/mkt_op_process.php?mid="; // The server-side script
    var mindex = document.forms['marketform'].bcmselect.selectedIndex;
    var midValue = document.forms['marketform'].bcmselect.options[mindex].value;

    //set pdf name
    document.getElementById('mkt_pdf').value=document.getElementById('ordpdfdir').value+midValue+"_bcmop.pdf";

    document.body.style.cursor = "wait";
    showwait();  
    var usession = getmsession();
    http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = pickOPResponse;
    http.send(null);

  } else {
 
    document.getElementById('confirmtext').innerHTML=document.forms['marketform'].bcmselect.options[0].text;
    showconfirm();

  }


}



// retrieve activities

function pickACTResponse() {

  if (http.readyState == 4) {

    //set file for title
    var mindex = document.forms['marketform'].bcmselect.selectedIndex;
    var mselectedFile = document.forms['marketform'].bcmselect.options[mindex].value;

  results = http.responseText.split("^");
  var bcolor=document.getElementById('chartbg').value;
  var reccount=results.length;
  reccount=(reccount-1);  //this one reads the last record returned to see if completed acctivities

  //declare report array here to include in test for percent complete
  reportArray = new Array();
  
   document.getElementById('s1').innerHTML=" ";
   //the last returned reccord is the tag for wether it is all activities or 100% completed
   if (results[reccount] < 100){
  
     reportArray[0] = "<table border='0' width='80%' align='left'><tr style='font: 12px Arial' ><td id='rptTitle' width='30%'><b>Activities less than 100% for -</td><td id='rptcoHead' width='70%'>"+mselectedFile+"</b></td></tr></table>";  
     reportArray[1] = "(Includes additional activities that are complete for same company.)";
     reccount=(reccount-1);
     document.getElementById('s2').innerHTML=reccount+"&nbsp;<img src='images/rarrow.gif'>";
     document.getElementById('s3').innerHTML="";

   } else {

     reportArray[0] = "<table border='0' width='80%' align='left'><tr style='font: 11px Arial'><td id='rptTitle' width='30%'><b>Activities 100% complete for -</td><td id='rptcoHead' width='70%'>"+mselectedFile+"</b></td></tr></table>";  
     reportArray[1] = "(Includes additional activities that are not complete for same company.)";
     document.getElementById('s2').innerHTML="";
     reccount=(reccount-1);
     document.getElementById('s3').innerHTML=reccount+"&nbsp;<img src='images/rarrow.gif'>";

   }

   document.getElementById('s4').innerHTML=" ";
   document.getElementById('s5').innerHTML=" ";

    var runningcount=0;
    
    results.sort();

    r1= new Array();
     
    reportArray[2] = " ";


    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)

      {

         if (bcolor==document.getElementById('chartbg').value){
           bcolor=document.getElementById('chartmargin').value;
         } else {
           bcolor=document.getElementById('chartbg').value;
         }
  
       runningcount=(runningcount+1);
       bdystr="<br>&nbsp;&nbsp;&nbsp;&nbsp;<b>"+runningcount+")&nbsp;";
       bdystr=bdystr+"&nbsp;&nbsp;"+r1[0];
       bdystr=bdystr+"</b><br>&nbsp;&nbsp;&nbsp;&nbsp;Contact:&nbsp;&nbsp;"+r1[1];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Subject:&nbsp;&nbsp;"+r1[2].substring(0,150);
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;&nbsp;"+r1[3];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Created On:&nbsp;&nbsp;"+r1[4];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Created By:&nbsp;&nbsp;"+r1[5];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Modified By:&nbsp;&nbsp;"+r1[6];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Modified On:&nbsp;&nbsp;"+r1[7]; 
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Start Time:&nbsp;&nbsp;"+r1[8];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Duration:&nbsp;&nbsp;"+r1[9];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;End Time:&nbsp;&nbsp;"+r1[10];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Sent Time:&nbsp;&nbsp;"+r1[11];
       bdystr=bdystr+"<br>&nbsp;&nbsp;&nbsp;&nbsp;Percent Complete:&nbsp;&nbsp;"+r1[12];
       bdystr=bdystr+"%<br>&nbsp;&nbsp;&nbsp;&nbsp;Type:&nbsp;&nbsp;"+r1[13]+"<br><td></tr>";

       reportArray[2] = reportArray[2]+"<tr style='font: 11px Arial' bgcolor='"+bcolor+"'><td width='100%'a lign='left'>"+bdystr;
    
      } 

    }
    
    document.getElementById('rpttitle').innerHTML=reportArray[0];
    document.getElementById('rowheader').innerHTML=reportArray[1];
    document.getElementById('reportbody').innerHTML="<table cellpadding='4' border='0'  width='85%' align='left'>"+reportArray[2]+"<tr style='font: 11px Arial'><td colspan='6' align='left'>&nbsp;&nbsp;Total number of opportunities found :&nbsp;"+reccount+"</td></tr></table><table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";

showreport('inv');
hidewait();
document.body.style.cursor='auto';

  }
}



function pickACT(mp){
document.getElementById('s1').innerHTML=" ";
document.getElementById('s2').innerHTML=" ";
document.getElementById('s3').innerHTML=" ";
document.getElementById('s4').innerHTML=" ";
document.getElementById('s5').innerHTML=" ";


  if (document.forms['marketform'].bcmselect.options[0].text != "No uploaded .bcm files found.") {
    document.getElementById('reportbody').innerHTML="";
    var mpcomp = mp;
    var userurl = "includes/php/mkt_act_process.php?mid="; // The server-side script
    var mindex = document.forms['marketform'].bcmselect.selectedIndex;
    var midValue = document.forms['marketform'].bcmselect.options[mindex].value;

    //set pdf name
    document.getElementById('mkt_pdf').value=document.getElementById('ordpdfdir').value+midValue+"_bcmactivity.pdf";

    document.body.style.cursor = "wait";
    showwait();  
    var usession = getmsession();
    http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession)+ "&pcomplete=" +mpcomp, true);
    http.onreadystatechange = pickACTResponse;
    http.send(null);

  } else {
 
    document.getElementById('confirmtext').innerHTML=document.forms['marketform'].bcmselect.options[0].text;
    showconfirm();

  }


}


// retrieve list of accounts


function getAcctResponse() {

  if (http.readyState == 4) {

    //set file for title
    var mindex = document.forms['marketform'].bcmselect.selectedIndex;
    var mselectedFile = document.forms['marketform'].bcmselect.options[mindex].value;

  results = http.responseText.split("^");
  var reccount=results.length;
  var bcolor=document.getElementById('chartbg').value;
  reccount=(reccount-1);

  document.getElementById('s1').innerHTML=" ";
  document.getElementById('s2').innerHTML=" ";
  document.getElementById('s3').innerHTML=" ";
  document.getElementById('s4').innerHTML=reccount+"&nbsp;<img src='images/rarrow.gif'>";
  document.getElementById('s5').innerHTML=" ";
  

  results.sort();
 
    r1= new Array();
    reportArray = new Array();
    reportArray[0] = "<table border='0' width='80%' align='left'><tr style='font: 11px Arial'><td id='rptTitle' width='30%'><b>Accounts Currently Loaded -</td><td id='rptcoHead' width='70%'>"+mselectedFile+"</b></td></tr></table>";  
    reportArray[1] = "<table border='0' width='80%' align='left'><tr style='font: 11px Arial'><td width='6%' align='right'></td><td width='37%' align='left'><b>Company</b></td><td width='57%' align='left'><b>&nbsp;&nbsp;Address</b></td></tr></table>";
    reportArray[2] = "";

    var bcolor=document.getElementById('chartshadow').value;

    var runningcount=0;
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)

      {
 
         if (bcolor==document.getElementById('chartbg').value){
           bcolor=document.getElementById('chartmargin').value;
         } else {
           bcolor=document.getElementById('chartbg').value;
         }
         r1[1] = trim(r1[1]);
         runningcount=(runningcount+1);
         if (r1[1].length > 5){
           reportArray[2] = reportArray[2]+"<tr style='font: 11px Arial' bgcolor='"+bcolor+"'><td align='right' width='5%'>"+runningcount+")</td><td width='35%'>"+r1[0]+"</td><td width='60%'  align='left'>"+r1[1]+", "+r1[2]+" "+r1[3]+"</td></tr>";
         } else {
      
           reportArray[2] = reportArray[2]+"<tr style='font: 11px Arial' bgcolor='"+bcolor+"'><td align='right' width='5%'>"+runningcount+")</td><td width='35%'>"+r1[0]+"</td><td width='60%'  align='left'><FONT COLOR='#ff0000'>No Address for this account.</font></td></tr>";
  

         } 
      } 

    }

    document.getElementById('rpttitle').innerHTML=reportArray[0];
    document.getElementById('rowheader').innerHTML=reportArray[1];
    document.getElementById('reportbody').innerHTML="<table cellpadding='4' border='0'  width='80%' align='left'>"+reportArray[2]+"<tr style='font: 11px Arial' ><td colspan='6' align='left'>Total number of accounts loaded :&nbsp;"+reccount+"</td></tr></table><table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";


showreport('inv');
hidewait();
document.body.style.cursor='auto';

  }
}


function getAcct(){
document.getElementById('s1').innerHTML=" ";
document.getElementById('s2').innerHTML=" ";
document.getElementById('s3').innerHTML=" ";
document.getElementById('s4').innerHTML=" ";
document.getElementById('s5').innerHTML=" ";


  if (document.forms['marketform'].bcmselect.options[0].text != "No uploaded .bcm files found.") {

    document.getElementById('reportbody').innerHTML="";
    var userurl = "includes/php/mkt_getacct_process.php?mid="; // The server-side script
    var mindex = document.forms['marketform'].bcmselect.selectedIndex;
    var midValue = document.forms['marketform'].bcmselect.options[mindex].value;

    //set pdf name
    document.getElementById('mkt_pdf').value=document.getElementById('ordpdfdir').value+midValue+"_bcmacct.pdf";

    document.body.style.cursor = "wait";
    showwait();  
    var usession = getmsession();
    http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getAcctResponse;
    http.send(null);

  } else {
 
    document.getElementById('confirmtext').innerHTML=document.forms['marketform'].bcmselect.options[0].text;
    showconfirm();

  }


}

// retrieve list of contacts

function getContactResponse() {

  if (http.readyState == 4) {

    //set file for title
    var mindex = document.forms['marketform'].bcmselect.selectedIndex;
    var mselectedFile = document.forms['marketform'].bcmselect.options[mindex].value;

  results = http.responseText.split("^");
  var reccount=results.length;
  var bcolor=document.getElementById('chartbg').value;

  reccount=(reccount-1);

  document.getElementById('s1').innerHTML=" ";
  document.getElementById('s2').innerHTML=" ";
  document.getElementById('s3').innerHTML=" ";
  document.getElementById('s4').innerHTML=" ";
  document.getElementById('s5').innerHTML=reccount+"&nbsp;<img src='images/rarrow.gif'>";
  
  

  results.sort();
 
    r1= new Array();
    reportArray = new Array();
    reportArray[0] = "<table border='0' width='80%' align='left'><tr style='font: 11px Arial'><td id='rptTitle' width='30%'><b>Contacts Currently Loaded -</td><td id='rptcoHead' width='70%'>"+mselectedFile+"</b></td></tr></table>";  
    reportArray[1] = "<table border='0' width='80%' align='left'><tr style='font: 11px Arial'><td width='6%' align='right'></td><td width='28%' align='left'><b>&nbsp;&nbsp;Contact</b></td><td width='32%' align='left'><b>Title</b></td><td width='34%' align='left'><b>Company</b></td></tr></table>";
    reportArray[2] = "";

    var bcolor=document.getElementById('chartshadow').value;

    var runningcount=0;
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)

      {
 
         if (bcolor==document.getElementById('chartbg').value){
           bcolor=document.getElementById('chartmargin').value;
         } else {
           bcolor=document.getElementById('chartbg').value;
         }
         r1[1] = trim(r1[1]);
         runningcount=(runningcount+1);
   
         if (r1[1].length > 5){

           reportArray[2] = reportArray[2]+"<tr style='font: 11px Arial' bgcolor='"+bcolor+"'><td align='right' width='5%'>"+runningcount+")</td><td width='25%'>"+r1[0]+"</td><td width='30%'  align='left'>"+r1[1]+"</td><td width='40%'  align='left'>"+r1[2]+"</td></tr>";

         } else {
      
           reportArray[2] = reportArray[2]+"<tr style='font: 11px Arial' bgcolor='"+bcolor+"'><td align='right' width='5%'>"+runningcount+")</td><td width='25%'>"+r1[0]+"</td><td width='30%'  align='left'><FONT COLOR='#ff0000'>No job title for this contact.</font></td><td width='40%'  align='left'>"+r1[2]+"</td></tr>";
  
         } 

      } 

    }

    document.getElementById('rpttitle').innerHTML=reportArray[0];
    document.getElementById('rowheader').innerHTML=reportArray[1];
    document.getElementById('reportbody').innerHTML="<table cellpadding='4' border='0'  width='80%' align='left'>"+reportArray[2]+"<tr style='font: 11px Arial'><td colspan='6' align='left'>Total number of accounts loaded :&nbsp;"+reccount+"</td></tr></table><table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";


showreport('inv');
hidewait();
document.body.style.cursor='auto';

  }
}

function getContact(){

document.getElementById('s1').innerHTML=" ";
document.getElementById('s2').innerHTML=" ";
document.getElementById('s3').innerHTML=" ";
document.getElementById('s4').innerHTML=" ";
document.getElementById('s5').innerHTML=" ";


  if (document.forms['marketform'].bcmselect.options[0].text != "No uploaded .bcm files found.") {

    document.getElementById('reportbody').innerHTML="";
    var userurl = "includes/php/mkt_getcontact_process.php?mid="; // The server-side script
    var mindex = document.forms['marketform'].bcmselect.selectedIndex;
    var midValue = document.forms['marketform'].bcmselect.options[mindex].value;

    //set pdf name
    document.getElementById('mkt_pdf').value=document.getElementById('ordpdfdir').value+midValue+"_bcmcontact.pdf";

    document.body.style.cursor = "wait";
    showwait();  
    var usession = getmsession();
    http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getContactResponse;
    http.send(null);

  } else {
 
    document.getElementById('confirmtext').innerHTML=document.forms['marketform'].bcmselect.options[0].text;
    showconfirm();

  }


}


function resetBCM(){


document.getElementById('s1').innerHTML=" ";
document.getElementById('s2').innerHTML=" ";
document.getElementById('s3').innerHTML=" ";
document.getElementById('s4').innerHTML=" ";
document.getElementById('s5').innerHTML=" ";

//clear all report buttons
for(var i = 0; i < 5; i++) {
  document.forms['marketform'].mktopt1[i].checked = false;	
}


}

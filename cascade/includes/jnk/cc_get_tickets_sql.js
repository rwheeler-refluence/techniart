//function for getting tickets

 

function getCTKResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].tkselect.options.length = 0;

    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
      //convert fox converted dates to display
      r1[1]=r1[1].charAt(4)+r1[1].charAt(5)+"/"+r1[1].charAt(6)+r1[1].charAt(7)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
      r1[2]=r1[2].charAt(4)+r1[2].charAt(5)+"/"+r1[2].charAt(6)+r1[2].charAt(7)+"/"+r1[2].charAt(2)+r1[2].charAt(3);

       // pad out the elements for table if individual elements not null
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',8)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',11)};
       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',11)};
       if (r1[4] != undefined){r1[4] = padRight(r1[4],' ',27)};
       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',16)};
       if (r1[6] != undefined){r1[6] = padRight(r1[6],' ',15)};
       if (r1[7] != undefined){r1[7] = padBoth(r1[7],' ',9)};
       if (r1[8] != undefined){r1[8] = padRight(r1[8],' ',11)};
       
       document.forms['custcareform'].tkselect.options[x] = new Option(r1[0]+r1[1]+r1[2]+r1[4]+r1[5]+r1[7]+r1[8],r1[0],true,false);
      }  

    }

    if (document.forms['custcareform'].tkselect.options.length == 0) {
     document.forms['custcareform'].tkselect.options[x] = new Option("No orders found for customer.",'true');
    }

hidewait();
document.body.style.cursor='auto';

  }
}

function getCTK() {
  var tkurl = "includes/php/cc_get_tk_process.php?mid="; // The server-side script
  var mrecord = "";
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = document.getElementById("mcustid").value;
  var usession = getmsession();
  http.open("GET", tkurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getCTKResponse;
  http.send(null);
}


function getSingleCtk() {

if (document.forms['custcareform'].tkselect.options[0].text != "No orders found for customer.") {

  var userurl = "includes/php/cc_get_singletk_process.php?mid="; // The server-side script
  var mindex = document.forms['custcareform'].tkselect.selectedIndex;
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = document.forms['custcareform'].tkselect.options[mindex].value;
  var usession = getmsession();
  http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getSinglectkResponse;
  http.send(null);

  } else {
 
    document.getElementById('confirmtext').innerHTML=document.forms['custcareform'].tkselect.options[0].text;
    showconfirm();

  }

}

function getSinglectkResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
  
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
      //convert fox converted dates to display
      r1[1]=r1[1].charAt(4)+r1[1].charAt(5)+"/"+r1[1].charAt(6)+r1[1].charAt(7)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
      r1[2]=r1[2].charAt(4)+r1[2].charAt(5)+"/"+r1[2].charAt(6)+r1[2].charAt(7)+"/"+r1[2].charAt(2)+r1[2].charAt(3);
      r1[7]=r1[7].charAt(4)+r1[7].charAt(5)+"/"+r1[7].charAt(6)+r1[7].charAt(7)+"/"+r1[7].charAt(2)+r1[7].charAt(3);
      r1[25]=r1[25].charAt(4)+r1[25].charAt(5)+"/"+r1[25].charAt(6)+r1[25].charAt(7)+"/"+r1[25].charAt(2)+r1[25].charAt(3);

       // post elements
  
      document.getElementById('stkJOB_ID').value = r1[0];
      document.getElementById('stkDATE_IN').value = r1[1];
      document.getElementById('stkDATE_DUE').value = r1[2];
      //document.getElementById('stkCUSTOMER').value = r1[3];
      document.getElementById('stkTYPE').value = r1[4];
      document.getElementById('stkORDERDESC').value = r1[5];
      document.getElementById('stkPO').value = r1[6];
      document.getElementById('stkDATE_DONE').value = r1[7];
      document.getElementById('stkCUST_ID').value = r1[8];
      //document.getElementById('stkVPID').value = r1[9];
      //document.getElementById('stkOLD_CUST').value = r1[10];
      document.getElementById('stkAMOUNT').value = r1[11];
      document.getElementById('stkSHIPPING').value = r1[12];
      //document.getElementById('stkWEEKNO').value = r1[13];
      document.getElementById('stkCONTACT').value = r1[14];
      document.getElementById('stkCIS1').value = r1[15];
      //document.getElementById('stkCIS2').value = r1[16];
      //document.getElementById('stkCIS3').value = r1[17];
      document.getElementById('stkWHO').value = r1[18];
 
       r1[19]=trim(r1[19]);
       // 19 is Y/N for DP
       if (r1[19].substring(0,6) !="Object") {
         if (r1[19].substring(1,0) == 'Y') {
           document.getElementById("stkDPbox").checked = true;
         } else {document.getElementById('stkDPbox').checked = false};

       } else {document.getElementById('stkDPbox').checked = false};
  
       // 20 is Y/N for lasering
       if (r1[20].substring(0,6) !="Object") {
         if (r1[20].substring(1,0) == 'Y') {
           document.getElementById("stkLASERINGbox").checked = true;
         } else {document.getElementById('stkLASERINGbox').checked = false};

       } else {document.getElementById('stkLASERINGbox').checked = false};
      
      // 21 is Y/N for OCCUPANT
       if (r1[21].substring(0,6) !="Object") {
         if (r1[21].substring(0,1) == 'Y') {
           document.getElementById("stkOCCUPANTbox").checked = true;
         } else {document.getElementById('stkOCCUPANTbox').checked = false};

       } else {document.getElementById('stkOCCUPANTbox').checked = false};

      document.getElementById('stkDATA_ENTRYbox').value = r1[22];
      // 22 is Y/N for Data Entry
       if (r1[22].substring(0,6) !="Object") {
         if (r1[22].substring(0,1) == 'Y') {
           document.getElementById("stkDATA_ENTRYbox").checked = true;
         } else {document.getElementById('stkDATA_ENTRYbox').checked = false};

       } else {document.getElementById('stkDATA_ENTRYbox').checked = false};

      // 23 is Y/N for Maps
       if (r1[23].substring(0,6) !="Object") {
         if (r1[23].substring(0,1) == 'Y') {
           document.getElementById("stkMAPSbox").checked = true;
         } else {document.getElementById('stkMAPSbox').checked = false};

       } else {document.getElementById('stkMAPSbox').checked = false};

      document.getElementById('stkQUANTITY').value = r1[24];
      document.getElementById('stkINV_DATE').value = r1[25];
      //document.getElementById('stkSALESPER').value = r1[26];
      //document.getElementById('stkSALESPERNO').value = r1[27];
      document.getElementById('stkARMS_ORD').value = r1[28];
      document.getElementById('stkARMS_JOB').value = r1[29];
      document.getElementById('stknotes').value = trim(r1[30]);
     }  

    }

 
hidewait();
document.body.style.cursor='auto';
showstk();

  }
}
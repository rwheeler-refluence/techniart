//function for getting tickets

 

function getCTKResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array
//alert(http.responseText);
    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].tkselect.options.length = 0;

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

  	    // if the value is 12:00  
        if (r1[1].substring(0,5) =="12:00") { r1[1] = "" };
        if (r1[2].substring(0,5) =="12:00") { r1[2] = "" };
      
      } //end of cis check
    
       // pad out the elements for table if individual elements not null
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',8)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',11)};
       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',11)};
       if (r1[4] != undefined){r1[4] = padRight(r1[4],' ',27)};
       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',16)};
       if (r1[6] != undefined){r1[6] = padRight(r1[6],' ',15)};
       if (r1[7] != undefined){r1[7] = padLeft(r1[7],' ',9)};
       if (r1[8] != undefined){r1[8] = padLeft(r1[8],' ',11)};
       

       document.forms['custcareform'].tkselect.options[x] = new Option(r1[0]+r1[1]+r1[2]+r1[4]+r1[5]+r1[7]+r1[8],r1[0],true,false);


        if (document.forms['custcareform'].tkselect.options.length > 1000) {
           break;
        }

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
  var tkurl = "includes/php/cc_get_tk_process_fox.php?mid="; // The server-side script
  var mrecord = "";
  
  var midValue = document.getElementById("mcustid").value;
  if (trim(midValue)==''){
	 return null;
  }	   

  document.body.style.cursor = "wait";
  showwait();  	 
   
  var usession = getmsession();
  http.open("GET", tkurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getCTKResponse;
  http.send(null);
}


function getSingleCtk() {

if (document.forms['custcareform'].tkselect.options[0].text != "No orders found for customer.") {

  var userurl = "includes/php/cc_get_singletk_process_fox.php?mid="; // The server-side script
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
    //alert(http.responseText);
    results = http.responseText.split("^");
    r1= new Array();
  
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       if (document.getElementById("ucoid").value=='CIS'){    
      
	     //took out the next 4 SQL -fox converted dates to display
        r1[1]=r1[1].charAt(5)+r1[1].charAt(6)+"/"+r1[1].charAt(8)+r1[1].charAt(9)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
        r1[2]=r1[2].charAt(5)+r1[2].charAt(6)+"/"+r1[2].charAt(8)+r1[2].charAt(9)+"/"+r1[2].charAt(2)+r1[2].charAt(3);
        r1[7]=r1[7].charAt(5)+r1[7].charAt(6)+"/"+r1[7].charAt(8)+r1[7].charAt(9)+"/"+r1[7].charAt(2)+r1[7].charAt(3);
        r1[25]=r1[25].charAt(5)+r1[25].charAt(6)+"/"+r1[25].charAt(8)+r1[25].charAt(9)+"/"+r1[25].charAt(2)+r1[25].charAt(3);
  
        
        if (r1[1]=='00/00/00'){r1[1]==''};
        if (r1[2]=='00/00/00'){r1[2]==''};
	    if (r1[7]=='00/00/00'){r1[7]==''};  
	    if (r1[25]=='00/00/00'){r1[25]==''};
	       
      } else { 
      
        //this is for fox
        if (r1[1].charAt(1) =="/"){
          if (parseInt(r1[1].charAt(0)) < 10) {r1[1]="0" + r1[1]};
        }
        if (r1[2].charAt(1) =="/"){
          if (parseInt(r1[2].charAt(0)) < 10) {r1[2]="0" + r1[2]};
        }
 
        if (r1[7].charAt(1) =="/"){
          if (parseInt(r1[7].charAt(0)) < 10) {r1[7]="0" + r1[7]};
        }
        if (r1[25].charAt(1) =="/"){
          if (parseInt(r1[25].charAt(0)) < 10) {r1[25]="0" + r1[25]};
        }
 

        if (r1[1].charAt(4) =="/"){
          if (parseInt(r1[1].charAt(3)) < 10) {r1[1]=r1[1].substring(0,3)+"0" + r1[1].substring(3,9)};
        }
        if (r1[2].charAt(4) =="/"){
          if (parseInt(r1[2].charAt(3)) < 10) {r1[2]=r1[2].substring(0,3)+"0" + r1[2].substring(3,9)};
        }
  
        if (r1[7].charAt(4) =="/"){
          if (parseInt(r1[7].charAt(3)) < 10) {r1[7]=r1[7].substring(0,3)+"0" + r1[7].substring(3,9)};
        }
        if (r1[25].charAt(4) =="/"){
          if (parseInt(r1[25].charAt(3)) < 10) {r1[25]=r1[2].substring(0,3)+"0" + r1[25].substring(3,9)};
        }

        r1[1]=r1[1].substring(0,5)+"/"+r1[1].charAt(8)+r1[1].charAt(9);
        r1[2]=r1[2].substring(0,5)+"/"+r1[2].charAt(8)+r1[2].charAt(9);
        r1[7]=r1[7].substring(0,5)+"/"+r1[7].charAt(8)+r1[7].charAt(9);
        r1[25]=r1[25].substring(0,5)+"/"+r1[25].charAt(8)+r1[25].charAt(9);

        // if the value is 12:00  
        if (r1[1].substring(0,5) =="12:00") { r1[1] = "" };
        if (r1[2].substring(0,5) =="12:00") { r1[2] = "" };
        if (r1[7].substring(0,5) =="12:00") { r1[7] = "" };
        if (r1[25].substring(0,5) =="12:00") { r1[25] = "" };

      }//end of cis check
      
      
       // post elements
  
      if (r1[0].substring(0,6) !="Object") {document.getElementById('stkJOB_ID').value = trim(r1[0])} else {document.getElementById('stkJOB_ID').value =""};
      if (r1[1].substring(0,6) !="Object") {document.getElementById('stkDATE_IN').value = trim(r1[1])} else {document.getElementById('stkDATE_IN').value =""};
      if (r1[2].substring(0,6) !="Object") {document.getElementById('stkDATE_DUE').value = trim(r1[2])} else {document.getElementById('stkDATE_DUE').value =""};
      //document.getElementById('stkCUSTOMER').value = r1[3];
      if (r1[4].substring(0,6) !="Object") {document.getElementById('stkTYPE').value = trim(r1[4])} else {document.getElementById('stkTYPE').value =""};
      if (r1[5].substring(0,6) !="Object") {document.getElementById('stkORDERDESC').value = trim(r1[5])} else {document.getElementById('stkORDERDESC').value =""};
      if (r1[6].substring(0,6) !="Object") {document.getElementById('stkPO').value = trim(r1[6])} else {document.getElementById('stkPO').value=""};
      if (r1[7].substring(0,6) !="Object") {document.getElementById('stkDATE_DONE').value = trim(r1[7])} else {document.getElementById('stkDATE_DONE').value =""};
      if (r1[8].substring(0,6) !="Object") {document.getElementById('stkCUST_ID').value = trim(r1[8])} else {document.getElementById('stkCUST_ID').value =""};
      //document.getElementById('stkVPID').value = r1[9];
      //document.getElementById('stkOLD_CUST').value = r1[10];
      if (r1[11].substring(0,6) !="Object") {document.getElementById('stkAMOUNT').value = trim(r1[11])} else {document.getElementById('stkAMOUNT').value =""};
      if (r1[12].substring(0,6) !="Object") {document.getElementById('stkSHIPPING').value = trim(r1[12])} else {document.getElementById('stkSHIPPING').value =""};
      //document.getElementById('stkWEEKNO').value = r1[13];
      if (r1[14].substring(0,6) !="Object") {document.getElementById('stkCONTACT').value = trim(r1[14])} else {document.getElementById('stkCONTACT').value =""};
      if (r1[15].substring(0,6) !="Object") {document.getElementById('stkCIS1').value = trim(r1[15])} else {document.getElementById('stkCIS1').value =""};
      //document.getElementById('stkCIS2').value = r1[16];
      //document.getElementById('stkCIS3').value = r1[17];
      if (r1[18].substring(0,6) !="Object") {document.getElementById('stkWHO').value = trim(r1[18])} else {document.getElementById('stkWHO').value =""};

//********* important ************
// php adodb lib is dellivering a negative 1 for true and 0 for false, when saved 
// in fox the negative 1 must be saved as a positive 1.

 
       r1[19]=trim(r1[19]);
       // 19 is Y/N for DP
       if (r1[19].substring(0,6) !="Object") {
         if (r1[19] == -1) {
           document.getElementById("stkDPbox").checked = true;
         } else {document.getElementById('stkDPbox').checked = false};

       } else {document.getElementById('stkDPbox').checked = false};
  
       // 20 is Y/N for lasering
       if (r1[20].substring(0,6) !="Object") {
         if (r1[20] == -1) {
           document.getElementById("stkLASERINGbox").checked = true;
         } else {document.getElementById('stkLASERINGbox').checked = false};

       } else {document.getElementById('stkLASERINGbox').checked = false};
      
      // 21 is Y/N for OCCUPANT
       if (r1[21].substring(0,6) !="Object") {
         if (r1[21] == -1) {
           document.getElementById("stkOCCUPANTbox").checked = true;
         } else {document.getElementById('stkOCCUPANTbox').checked = false};

       } else {document.getElementById('stkOCCUPANTbox').checked = false};

      document.getElementById('stkDATA_ENTRYbox').value = r1[22];
      // 22 is Y/N for Data Entry
       if (r1[22].substring(0,6) !="Object") {
         if (r1[22] == -1) {
           document.getElementById("stkDATA_ENTRYbox").checked = true;
         } else {document.getElementById('stkDATA_ENTRYbox').checked = false};

       } else {document.getElementById('stkDATA_ENTRYbox').checked = false};

      // 23 is Y/N for Maps
       if (r1[23].substring(0,6) !="Object") {
         if (r1[23] == -1) {
           document.getElementById("stkMAPSbox").checked = true;
         } else {document.getElementById('stkMAPSbox').checked = false};

       } else {document.getElementById('stkMAPSbox').checked = false};

      if (r1[24].substring(0,6) !="Object") {document.getElementById('stkQUANTITY').value = trim(r1[24])} else {document.getElementById('stkQUANTITY').value =""};
      if (r1[25].substring(0,6) !="Object") {document.getElementById('stkINV_DATE').value = trim(r1[25])} else {document.getElementById('stkINV_DATE').value =""};
      //document.getElementById('stkSALESPER').value = r1[26];
      //document.getElementById('stkSALESPERNO').value = r1[27];
      if (r1[28].substring(0,6) !="Object") { document.getElementById('stkARMS_ORD').value = trim(r1[28])} else {document.getElementById('stkARMS_ORD').value =""};
      if (r1[29].substring(0,6) !="Object") { document.getElementById('stkARMS_JOB').value = trim(r1[29])} else {document.getElementById('stkARMS_JOB').value =""};
      document.getElementById('stknotes').value = trim(r1[30]);
     }  

    }

document.getElementById('tk_stkNewCUST_ID').value ='';
hidewait();
document.body.style.cursor='auto';

//hide all edit buttons
  if (document.getElementById('EditEnabled').value=="N") {
    document.getElementById('tksave').style.visibility = "hidden";
  } else {
    document.getElementById('tksave').style.visibility = "visible";
  }


showstk();

  }
}
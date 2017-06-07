//function for updating a ticket edit

 function getstkeditResponse() {

  if (http.readyState == 4) {

    results = http.responseText;
    getCTK();
    hidewait();
    document.body.style.cursor='auto';
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();
  }

}


function updateStk() {
  var updateurl = "includes/php/update_ticket_fox.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;
  document.body.style.cursor = "wait";
  showwait();
    
  checkforErrors=validStk2();

if (checkforErrors == 0) {

  s = new Array();

  s[0] = "mstk";
  s[1] = document.getElementById('stkJOB_ID').value;
  s[2] = document.getElementById('stkDATE_IN').value;
  s[3] = document.getElementById('stkDATE_DUE').value;
  s[4] = document.getElementById('company').value;   
  s[5] = document.getElementById('stkTYPE').value;
  s[6] = document.getElementById('stkORDERDESC').value;
  s[7] = document.getElementById('stkPO').value;
  s[8] = document.getElementById('stkDATE_DONE').value;
  s[9] = document.getElementById('stkCUST_ID').value;
  s[10] = " "; //document.getElementById('stkVPID').value;
  s[11] = " "; //document.getElementById('stkOLD_CUST').value;
  s[12] = document.getElementById('stkAMOUNT').value;
  s[13] = document.getElementById('stkSHIPPING').value;
  s[14] = "50"; getWeekNr(); //document.getElementById('stkWEEKNO').value;
  s[15] = document.getElementById('stkCONTACT').value;
  s[16] = document.getElementById('stkCIS1').value;
  s[17] = " "; //document.getElementById('stkCIS2').value;
  s[18] = " "; //document.getElementById('stkCIS3').value;
  s[19] = document.getElementById('stkWHO').value;
 
  if (document.getElementById('stkDPbox').checked == false) {
      s[20]="0";
  } else {s[20]="1"};

  if (document.getElementById('stkLASERINGbox').checked == false) {
      s[21]="0";
  } else {s[21]="1"};

  if (document.getElementById('stkOCCUPANTbox').checked == false) {
      s[22]="0";
  } else {s[22]="1"};

  if (document.getElementById('stkDATA_ENTRYbox').checked == false) {
      s[23]="0";
  } else {s[23]="1"};
    
  if (document.getElementById('stkMAPSbox').checked == false) {
      s[24]="0";
  } else {s[24]="1"};


  s[25] = document.getElementById('stkQUANTITY').value;
  s[26] = document.getElementById('stkINV_DATE').value;
  s[27] = " "; //document.getElementById('stkSALESPER').value;
  s[28] = " "; //document.getElementById('stkSALESPERNO').value;
  s[29] = document.getElementById('stkARMS_ORD').value;
  s[30] = document.getElementById('stkARMS_JOB').value;
  s[31] = document.getElementById('stknotes').value;


  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     rkey=/^/gi;
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
     
    }

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getstkeditResponse;
  http.send(null);

} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

}



function validStk2() {
//alert('in valid stk');
 var numerrors=0;
 document.getElementById('emsg').innerHTML="";
 document.getElementById('errorcnt').innerHTML="";
 numchk="";

  document.getElementById('stkJOB_ID').style.color='black';

  // date and needs date conversion
  tdt=document.getElementById('stkDATE_IN').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('stkDATE_IN').style.color='black';
  } else {
    document.getElementById('stkDATE_IN').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date in format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  tdt=document.getElementById('stkDATE_DUE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('stkDATE_DUE').style.color='black';
  } else {
    document.getElementById('stkDATE_DUE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date due format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('stkTYPE').style.color='black';
 
  var mchk=document.getElementById('stkORDERDESC').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('stkORDERDESC').style.color='black';
  } else {
    document.getElementById('stkORDERDESC').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave order description blank.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('stkPO').style.color='black';
 
  tdt=document.getElementById('stkDATE_DONE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('stkDATE_DONE').style.color='black';
  } else {
    document.getElementById('stkDATE_DONE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date done format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('stkCUST_ID').style.color='black';
  //document.getElementById('stkVPID').style.color='black';
  //document.getElementById('stkOLD_CUST').style.color='black';

  var numchk=document.getElementById('stkAMOUNT').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,999999.99)) { 
    document.getElementById('stkAMOUNT').style.color='black';
  } else { 
    document.getElementById('stkAMOUNT').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  var numchk=document.getElementById('stkSHIPPING').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,99.99)) { 
    document.getElementById('stkSHIPPING').style.color='black';
  } else { 
    document.getElementById('stkSHIPPING').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket shipping amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('stkCONTACT').style.color='black';
  document.getElementById('stkCIS1').style.color='black';
  //document.getElementById('stkCIS2').style.color='black';
  //document.getElementById('stkCIS3').style.color='black';
  document.getElementById('stkWHO').style.color='black';
 
  var numchk=document.getElementById('stkQUANTITY').value;
  numchk=trim(numchk);
  if (isNumeric(numchk)) { 
    document.getElementById('stkQUANTITY').style.color='black';
  } else { 
    document.getElementById('stkQUANTITY').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket quantity amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }


  tdt=document.getElementById('stkINV_DATE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('stkINV_DATE').style.color='black';
  } else {
    document.getElementById('stkINV_DATE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Invoice date format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  //document.getElementById('stkSALESPER').style.color='black';
  //document.getElementById('stkSALESPERNO').style.color='black';
  document.getElementById('stkARMS_ORD').style.color='black';
  document.getElementById('stkARMS_JOB').style.color='black';
  document.getElementById('stknotes').style.color='black';

 
  return numerrors;
}
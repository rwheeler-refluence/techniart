//function for updating a ticket edit

 function addtkResponse() {

  if (http.readyState == 4) {

    results = http.responseText;

//alert(http.responseText);

    //tkCTK();
    hidewait();
    document.body.style.cursor='auto';
    clrtk_addFields();
    document.getElementById('tkclientadd').selectedIndex=0;
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();
  }

}


function addtk(){
  var updateurl = "includes/php/tk_add_tk_process_fox.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;
  document.getElementById('maddtkscrnup').value ="YES";

  document.body.style.cursor = "wait";
  showwait();
  checkforErrors=validaddtk();
  var mweeknum=getWeekNr();

if (checkforErrors == 0) {

  s = new Array();

  s[0] = "mstk";
  s[1] = "999999"; //document.getElementById('tk_addstkJOB_ID').value;
  s[2] = document.getElementById('tk_addstkDATE_IN').value;
  s[3] = document.getElementById('tk_addstkDATE_DUE').value;
  s[4] = document.getElementById('tk_addstkCUSTOMER').value; 
  
  var mindex = document.forms['ticketform'].addtktypeselect.selectedIndex;
  s[5] = document.forms['ticketform'].addtktypeselect.options[mindex].value;

  s[6] = document.getElementById('tk_addstkORDERDESC').value;
  s[7] = document.getElementById('tk_addstkPO').value;
  s[8] = document.getElementById('tk_addstkDATE_DONE').value;
  s[9] = document.getElementById('tk_addstkCUST_ID').value;
  s[10] = " "; //document.getElementById('tk_addstkVPID').value;
  s[11] = " "; //document.getElementById('tk_addstkOLD_CUST').value;
  s[12] = document.getElementById('tk_addstkAMOUNT').value;
  s[13] = document.getElementById('tk_addstkSHIPPING').value;
  
  s[14] = String(mweeknum); //getWeekNr() this function is in ticket functions
   
  s[15] = document.getElementById('tk_addstkCONTACT').value;

  var mindex = document.forms['ticketform'].addtkcis1select.selectedIndex;
  if (mindex > 0){s[16] = document.forms['ticketform'].addtkcis1select.options[mindex].text};
 
  s[17] = " "; //document.getElementById('tk_addstkCIS2').value;
  s[18] = " "; //document.getElementById('tk_addstkCIS3').value;

  var mindex = document.forms['ticketform'].addtkwhoselect.selectedIndex;
  if (mindex > 0){ s[19] = document.forms['ticketform'].addtkwhoselect.options[mindex].text};
  
  if (document.getElementById('tk_addstkDPbox').checked == false) {
      s[20]="0";
  } else {s[20]="1"};

  if (document.getElementById('tk_addstkLASERINGbox').checked == false) {
      s[21]="0";
  } else {s[21]="1"};

  if (document.getElementById('tk_addstkOCCUPANTbox').checked == false) {
      s[22]="0";
  } else {s[22]="1"};

  if (document.getElementById('tk_addstkDATA_ENTRYbox').checked == false) {
      s[23]="0";
  } else {s[23]="1"};
    
  if (document.getElementById('tk_addstkMAPSbox').checked == false) {
      s[24]="0";
  } else {s[24]="1"};


  s[25] = document.getElementById('tk_addstkQUANTITY').value;
  s[26] = document.getElementById('tk_addstkINV_DATE').value;
  s[27] = " "; //document.getElementById('tk_addstkSALESPER').value;
  s[28] = "0"; //document.getElementById('tk_addstkSALESPERNO').value;
  s[29] = document.getElementById('tk_addstkARMS_ORD').value;
  s[30] = document.getElementById('tk_addstkARMS_JOB').value;
  s[31] = document.getElementById('tk_addstknotes').value;


  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     rkey=/^/gi;
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
     s[myKey]=s[myKey].replace(/\,/g,"-");
     s[myKey]=s[myKey].replace(/\'/g," ");
    }

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = addtkResponse;
  http.send(null);

} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

}

function validaddtk() {


 var numerrors=0;
 document.getElementById('emsg').innerHTML="";
 document.getElementById('errorcnt').innerHTML="";
 numchk="";


 document.getElementById('tk_addstkJOB_ID').style.color='black';


  var mchk=document.getElementById('tk_addstkDATE_IN').value;
  mchk=trim(mchk);

  if (mchk.length > 0) { 
    document.getElementById('tk_addstkDATE_IN').style.color='black';
  } else {
    document.getElementById('tk_addstkDATE_IN').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave date in blank.<br>";
    numerrors=numerrors+1;
  }


  //check selects
  var mselect1 = document.forms['ticketform'].addtktypeselect.selectedIndex;
  if (mselect1 == 0) { 
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You must select a ticket type.<br>";
    numerrors=numerrors+1;
  }

  var mselect2 = document.forms['ticketform'].addtkwhoselect.selectedIndex;
  if (mselect2 == 0) { 
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You must choose a staff name.<br>";
    numerrors=numerrors+1;
  }


  // date and needs date conversion
  tdt=document.getElementById('tk_addstkDATE_IN').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_addstkDATE_IN').style.color='black';
  } else {
    document.getElementById('tk_addstkDATE_IN').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date in format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  var mchk=document.getElementById('tk_addstkDATE_DUE').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_addstkDATE_DUE').style.color='black';
  } else {
    document.getElementById('tk_addstkDATE_DUE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave date due blank.<br>";
    numerrors=numerrors+1;
  }


  tdt=document.getElementById('tk_addstkDATE_DUE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_addstkDATE_DUE').style.color='black';
  } else {
    document.getElementById('tk_addstkDATE_DUE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date due format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

   var mchk=document.getElementById('tk_addstkCUSTOMER').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_addstkCUSTOMER').style.color='black';
  } else {
    document.getElementById('tk_addstkCUSTOMER').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave customer blank.<br>";
    numerrors=numerrors+1;
  }

  var mchk=document.getElementById('tk_addstkCUST_ID').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_addstkCUST_ID').style.color='black';
  } else {
    document.getElementById('tk_addstkCUST_ID').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave customer id blank.<br>";
    numerrors=numerrors+1;
  }


  var mchk=document.getElementById('tk_addstkORDERDESC').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_addstkORDERDESC').style.color='black';
  } else {
    document.getElementById('tk_addstkORDERDESC').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave order description blank.<br>";
    numerrors=numerrors+1;
  }


  document.getElementById('tk_addstkPO').style.color='black';
 
  tdt=document.getElementById('tk_addstkDATE_DONE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_addstkDATE_DONE').style.color='black';
  } else {
    document.getElementById('tk_addstkDATE_DONE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date done format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('tk_addstkCUST_ID').style.color='black';
  //document.getElementById('tk_addstkVPID').style.color='black';
  //document.getElementById('tk_addstkOLD_CUST').style.color='black';

  var numchk=document.getElementById('tk_addstkAMOUNT').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,999999.99)) { 
    document.getElementById('tk_addstkAMOUNT').style.color='black';
  } else { 
    document.getElementById('tk_addstkAMOUNT').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  var numchk=document.getElementById('tk_addstkSHIPPING').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,99.99)) { 
    document.getElementById('tk_addstkSHIPPING').style.color='black';
  } else { 
    document.getElementById('tk_addstkSHIPPING').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket shipping amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('tk_addstkCONTACT').style.color='black';
 
  //document.getElementById('tk_addstkCIS2').style.color='black';
  //document.getElementById('tk_addstkCIS3').style.color='black';
 
  var numchk=document.getElementById('tk_addstkQUANTITY').value;
  numchk=trim(numchk);
  if (isNumeric(numchk)) { 
    document.getElementById('tk_addstkQUANTITY').style.color='black';
  } else { 
    document.getElementById('tk_addstkQUANTITY').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket quantity amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }


  tdt=document.getElementById('tk_addstkINV_DATE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_addstkINV_DATE').style.color='black';
  } else {
    document.getElementById('tk_addstkINV_DATE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Invoice date format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  //document.getElementById('tk_addstkSALESPER').style.color='black';
  //document.getElementById('tk_addstkSALESPERNO').style.color='black';
  document.getElementById('tk_addstkARMS_ORD').style.color='black';
  document.getElementById('tk_addstkARMS_JOB').style.color='black';
  document.getElementById('tk_addstknotes').style.color='black';

 
  return numerrors;
}



function validmaintk() {

 var numerrors=0;
 document.getElementById('emsg').innerHTML="";
 document.getElementById('errorcnt').innerHTML="";
 numchk="";

  document.getElementById('tk_addstkJOB_ID').style.color='black';

  // date and needs date conversion
  tdt=document.getElementById('tk_addstkDATE_IN').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_addstkDATE_IN').style.color='black';
  } else {
    document.getElementById('tk_addstkDATE_IN').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date in format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  tdt=document.getElementById('tk_addstkDATE_DUE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_addstkDATE_DUE').style.color='black';
  } else {
    document.getElementById('tk_addstkDATE_DUE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date due format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

 
  var mchk=document.getElementById('tk_addstkORDERDESC').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_addstkORDERDESC').style.color='black';
  } else {
    document.getElementById('tk_addstkORDERDESC').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave order description blank.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('tk_addstkPO').style.color='black';
 
  tdt=document.getElementById('tk_addstkDATE_DONE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_addstkDATE_DONE').style.color='black';
  } else {
    document.getElementById('tk_addstkDATE_DONE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date done format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('tk_addstkCUST_ID').style.color='black';
  //document.getElementById('tk_addstkVPID').style.color='black';
  //document.getElementById('tk_addstkOLD_CUST').style.color='black';

  var numchk=document.getElementById('tk_addstkAMOUNT').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,999999.99)) { 
    document.getElementById('tk_addstkAMOUNT').style.color='black';
  } else { 
    document.getElementById('tk_addstkAMOUNT').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  var numchk=document.getElementById('tk_addstkSHIPPING').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,99.99)) { 
    document.getElementById('tk_addstkSHIPPING').style.color='black';
  } else { 
    document.getElementById('tk_addstkSHIPPING').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket shipping amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('tk_addstkCONTACT').style.color='black';
 
  //document.getElementById('tk_addstkCIS2').style.color='black';
  //document.getElementById('tk_addstkCIS3').style.color='black';
 
  var numchk=document.getElementById('tk_addstkQUANTITY').value;
  numchk=trim(numchk);
  if (isNumeric(numchk)) { 
    document.getElementById('tk_addstkQUANTITY').style.color='black';
  } else { 
    document.getElementById('tk_addstkQUANTITY').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket quantity amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }


  tdt=document.getElementById('tk_addstkINV_DATE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_addstkINV_DATE').style.color='black';
  } else {
    document.getElementById('tk_addstkINV_DATE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Invoice date format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  //document.getElementById('tk_addstkSALESPER').style.color='black';
  //document.getElementById('tk_addstkSALESPERNO').style.color='black';
  document.getElementById('tk_addstkARMS_ORD').style.color='black';
  document.getElementById('tk_addstkARMS_JOB').style.color='black';
  document.getElementById('tk_addstknotes').style.color='black';

 
  return numerrors;
}
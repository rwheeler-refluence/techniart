//function for updating a ticket edit

 function updatemaintkResponse() {

  if (http.readyState == 4) {

    results = http.responseText;

//alert(http.responseText);

    document.getElementById('mtksinglescrup').value='YES';
    hidewait();
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();
    setTKEditNo();
    unlockalltk();
    tkSingleCtk(trim(document.getElementById('tk_stkJOB_ID').value));
  }

}


function tkmainup(isvoid){

//void by default no	
var tkisvoid="N";
	
if (isvoid){
   var poststr = trim(document.getElementById('tk_isposted').value);
   if (poststr=="Y"){
     alert('This ticket has been invoiced, please send request to void manually.');
	 showinvcan();	
     return null;
   } else {
	 tkisvoid="Y"  
   }	   
	 
	 
} 

		
//alert("saving ticket");
  var updateurl = "includes/php/update_ticket_fox.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;
  document.body.style.cursor = "wait";
  showwait();
  
  //folded void into this so if it is a void by pass validation
  if (tkisvoid=="Y"){
    checkforErrors = 0;
  }	else {
    checkforErrors=validdatetk(); 	  
  }	 
     
  
if (checkforErrors == 0) {
  var mweeknum=getWeekNr();
  s = new Array();

  s[0] = "mstk";

  s[1] = document.getElementById('tk_stkJOB_ID').value;
  s[2] = document.getElementById('tk_stkDATE_IN').value;
  s[3] = document.getElementById('tk_stkDATE_DUE').value;
  s[4] = document.getElementById('tk_stkCUSTOMER').value; 

  var mindex = document.forms['ticketform'].tktypeselect.selectedIndex;
  s[5] = document.forms['ticketform'].tktypeselect.options[mindex].value;

  s[6] = document.getElementById('tk_stkORDERDESC').value;

  s[7] = document.getElementById('tk_stkPO').value;

  s[8] = document.getElementById('tk_stkDATE_DONE').value;

  s[9] = document.getElementById('tk_stkCUST_ID').value;

  s[10] = " "; //document.getElementById('tk_stkVPID').value;

  s[11] = " "; //document.getElementById('tk_stkOLD_CUST').value;

  s[12] = document.getElementById('tk_stkAMOUNT').value;

  s[13] = document.getElementById('tk_stkSHIPPING').value;

  s[14] = ""; //String(mweeknum); //getWeekNr() this function is in ticket functions

  s[15] = document.getElementById('tk_stkCONTACT').value;

  var mindex = document.forms['ticketform'].tkcis1select.selectedIndex;
  if (mindex > 0){s[16] = document.forms['ticketform'].tkcis1select.options[mindex].text};
 
  s[17] = " "; //document.getElementById('tk_stkCIS2').value;

  s[18] = " "; //document.getElementById('tk_stkCIS3').value;


  var mindex = document.forms['ticketform'].tkwhoselect.selectedIndex;
  if (mindex > 0){s[19] = document.forms['ticketform'].tkwhoselect.options[mindex].text};
  
  if (document.getElementById('tk_stkDPbox').checked == false) {
      s[20]="0";
  } else {s[20]="1"};

  if (document.getElementById('tk_stkLASERINGbox').checked == false) {
      s[21]="0";
  } else {s[21]="1"};

  if (document.getElementById('tk_stkOCCUPANTbox').checked == false) {
      s[22]="0";
  } else {s[22]="1"};

  if (document.getElementById('tk_stkDATA_ENTRYbox').checked == false) {
      s[23]="0";
  } else {s[23]="1"};
    
  if (document.getElementById('tk_stkMAPSbox').checked == false) {
      s[24]="0";
  } else {s[24]="1"};


  s[25] = document.getElementById('tk_stkQUANTITY').value;
  s[26] = document.getElementById('tk_stkINV_DATE').value;
  s[27] = " "; //document.getElementById('tk_stkSALESPER').value;
  s[28] = "0"; //document.getElementById('tk_stkSALESPERNO').value;
  s[29] = document.getElementById('tk_stkARMS_ORD').value;
  s[30] = document.getElementById('tk_stkARMS_JOB').value;
  s[31] = document.getElementById('tk_stknotes').value;

  s[31] = s[31].replace(/\"/g,"zdblq");
  s[31] = s[31].replace(/\'/g,"zpos");
  s[31] = s[31].replace(/\$/g,"zdol");
  s[31] = xreplace(s[31],"\n","linefeed");
  s[31] = xreplace(s[31],"#"," Number ");
  
  s[32] = tkisvoid;
  if (s[32]=="Y"){
	  
	 s[6]  = 'VOID';  //document.getElementById('tk_stkORDERDESC').value;
     s[7]  = 'VOID';  //document.getElementById('tk_stkPO').value;
     s[8]  = s[2];    //document.getElementById('tk_stkDATE_DONE').value;
     s[12] = '0.00';  //document.getElementById('tk_stkAMOUNT').value;
     s[13] = '0.00';  //document.getElementById('tk_stkSHIPPING').value;
     s[15] = 'VOID';  //document.getElementById('tk_stkCONTACT').value;  
 	 s[26] = s[2];    //document.getElementById('tk_stkINV_DATE').value;  
	  
  }
  
  
  
  
//should add &qout etc at some point
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
  http.onreadystatechange = updatemaintkResponse;
  http.send(null);

} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}



}



function validdatetk() {

 var numerrors=0;
 document.getElementById('emsg').innerHTML="";
 document.getElementById('errorcnt').innerHTML="";
 numchk="";


 document.getElementById('tk_stkJOB_ID').style.color='black';


  var mchk=document.getElementById('tk_stkDATE_IN').value;
  mchk=trim(mchk);

  if (mchk.length > 0) { 
    document.getElementById('tk_stkDATE_IN').style.color='black';
  } else {
    document.getElementById('tk_stkDATE_IN').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave date in blank.<br>";
    numerrors=numerrors+1;
  }


  //check selects
  var mselect1 = document.forms['ticketform'].tktypeselect.selectedIndex;
  if (mselect1 == 0) { 
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You must select a ticket type.<br>";
    numerrors=numerrors+1;
  }


  var mselect2 = document.forms['ticketform'].tkwhoselect.selectedIndex;
  if (mselect2 == 0) { 
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You must choose a staff name.<br>";
    numerrors=numerrors+1;
  }

  // date and needs date conversion
  tdt=document.getElementById('tk_stkDATE_IN').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_stkDATE_IN').style.color='black';
  } else {
    document.getElementById('tk_stkDATE_IN').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date in format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  var mchk=document.getElementById('tk_stkDATE_DUE').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_stkDATE_DUE').style.color='black';
  } else {
    document.getElementById('tk_stkDATE_DUE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave date due blank.<br>";
    numerrors=numerrors+1;
  }

  tdt=document.getElementById('tk_stkDATE_DUE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_stkDATE_DUE').style.color='black';
  } else {
    document.getElementById('tk_stkDATE_DUE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date due format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

   var mchk=document.getElementById('tk_stkCUSTOMER').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_stkCUSTOMER').style.color='black';
  } else {
    document.getElementById('tk_stkCUSTOMER').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave customer blank.<br>";
    numerrors=numerrors+1;
  }

  var mchk=document.getElementById('tk_stkCUST_ID').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_stkCUST_ID').style.color='black';
  } else {
    document.getElementById('tk_stkCUST_ID').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave customer id blank.<br>";
    numerrors=numerrors+1;
  }


  var mchk=document.getElementById('tk_stkORDERDESC').value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById('tk_stkORDERDESC').style.color='black';
  } else {
    document.getElementById('tk_stkORDERDESC').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave order description blank.<br>";
    numerrors=numerrors+1;
  }


  document.getElementById('tk_stkPO').style.color='black';
 
  tdt=document.getElementById('tk_stkDATE_DONE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_stkDATE_DONE').style.color='black';
  } else {
    document.getElementById('tk_stkDATE_DONE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket date done format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }


  document.getElementById('tk_stkCUST_ID').style.color='black';
  //document.getElementById('tk_stkVPID').style.color='black';
  //document.getElementById('tk_stkOLD_CUST').style.color='black';

  var numchk=document.getElementById('tk_stkAMOUNT').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,999999.99)) { 
    document.getElementById('tk_stkAMOUNT').style.color='black';
  } else { 
    document.getElementById('tk_stkAMOUNT').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }


  var numchk=document.getElementById('tk_stkSHIPPING').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,99.99)) { 
    document.getElementById('tk_stkSHIPPING').style.color='black';
  } else { 
    document.getElementById('tk_stkSHIPPING').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket shipping amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }


  document.getElementById('tk_stkCONTACT').style.color='black';
 
  //document.getElementById('tk_stkCIS2').style.color='black';
  //document.getElementById('tk_stkCIS3').style.color='black';
 
  var numchk=document.getElementById('tk_stkQUANTITY').value;
  numchk=trim(numchk);
  if (isNumeric(numchk)) { 
    document.getElementById('tk_stkQUANTITY').style.color='black';
  } else { 
    document.getElementById('tk_stkQUANTITY').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Ticket quantity amount Format is incorrect or to high. Please use '##' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  tdt=document.getElementById('tk_stkINV_DATE').value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById('tk_stkINV_DATE').style.color='black';
  } else {
    document.getElementById('tk_stkINV_DATE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Invoice date format incorrect. Please use mm/dd/yy' format.<br>";
    numerrors=numerrors+1;
  }

  //document.getElementById('tk_stkSALESPER').style.color='black';
  //document.getElementById('tk_stkSALESPERNO').style.color='black';
  document.getElementById('tk_stkARMS_ORD').style.color='black';
  document.getElementById('tk_stkARMS_JOB').style.color='black';
  document.getElementById('tk_stknotes').style.color='black';

 
  return numerrors;
}




// clear tk elements
function clrtk_Fields() {
  
  document.getElementById('tk_stkJOB_ID').value = '';
  document.getElementById('tk_stkDATE_IN').value = '';
  document.getElementById('tk_stkDATE_DUE').value = '';
  //document.getElementById('tk_stkCUSTOMER').value = '';
  document.getElementById('tk_stkORDERDESC').value = '';
  document.getElementById('tk_stkPO').value = '';
  document.getElementById('tk_stkDATE_DONE').value = '';
  document.getElementById('tk_stkCUST_ID').value = '';
  //document.getElementById('tk_stkVPID').value = '';
  //document.getElementById('tk_stkOLD_CUST').value = '';
  document.getElementById('tk_stkAMOUNT').value = '';
  document.getElementById('tk_stkSHIPPING').value = '';
  //document.getElementById('tk_stkWEEKNO').value = '';
  document.getElementById('tk_stkCONTACT').value = '';

  //document.getElementById('tk_stkCIS2').value = '';
  //document.getElementById('tk_stkCIS3').value = '';

  // 19 is Y/N for DP
  document.getElementById('tk_stkDPbox').checked = false;
  
  // 20 is Y/N for lasering
  document.getElementById('tk_stkLASERINGbox').checked = false;
      
  // 21 is Y/N for OCCUPANT
  document.getElementById('tk_stkOCCUPANTbox').checked = false;

  // 22 is Y/N for Data Entry
  document.getElementById('tk_stkDATA_ENTRYbox').checked = false;

  // 23 is Y/N for Maps
  document.getElementById('tk_stkMAPSbox').checked = false;

  document.getElementById('tk_stkQUANTITY').value = '';
  document.getElementById('tk_stkINV_DATE').value = '';
  //document.getElementById('tk_stkSALESPER').value = '';
  //document.getElementById('tk_stkSALESPERNO').value = '';
  document.getElementById('tk_stkARMS_ORD').value = '';
  document.getElementById('tk_stkARMS_JOB').value = '';
  document.getElementById('tk_stkNOTES').value = '';

 
 //reset validation to black
  document.getElementById('tk_stkJOB_ID').style.color='black';
  document.getElementById('tk_stkDATE_DUE').style.color='black';
  document.getElementById('tk_stkORDERDESC').style.color='black';
  document.getElementById('tk_stkPO').style.color='black';
  document.getElementById('tk_stkDATE_DONE').style.color='black';
  document.getElementById('tk_stkCUST_ID').style.color='black';
  //document.getElementById('tk_stkVPID').style.color='black';
  //document.getElementById('tk_stkOLD_CUST').style.color='black';
  document.getElementById('tk_stkAMOUNT').style.color='black';
  document.getElementById('tk_stkSHIPPING').style.color='black';
  document.getElementById('tk_stkCONTACT').style.color='black';
  //document.getElementById('tk_stkCIS2').style.color='black';
  //document.getElementById('tk_stkCIS3').style.color='black';
  document.getElementById('tk_stkQUANTITY').style.color='black';
  document.getElementById('tk_stkINV_DATE').style.color='black';
  //document.getElementById('tk_stkSALESPER').style.color='black';
  //document.getElementById('tk_stkSALESPERNO').style.color='black';
  document.getElementById('tk_stkARMS_ORD').style.color='black';
  document.getElementById('tk_stkARMS_JOB').style.color='black';
  document.getElementById('tk_stknotes').style.color='black';

//not sure why this called the hide screen- commented out
//hidetk_stk();

//document.getElementById('mtktscreenup').value = "NO"; 
document.getElementById('tkselectMain').style.visibility = "hidden";

}



function clrtk_addFields() {
  
  document.getElementById('tk_addstkJOB_ID').value = 'To Be Assigned';
  document.getElementById('tk_addstkDATE_IN').value = '';
  document.getElementById('tk_addstkDATE_DUE').value = '';

  document.getElementById('tk_addstkCUSTOMER').value = '';
  
  document.forms['ticketform'].addtktypeselect.options[0].selected = true;
  document.forms['ticketform'].addtkwhoselect.options[0].selected = true;
  document.forms['ticketform'].addtkcis1select.options[0].selected = true;
  
  document.getElementById('tk_addstkORDERDESC').value = '';
  document.getElementById('tk_addstkPO').value = '';
  document.getElementById('tk_addstkDATE_DONE').value = '';
  document.getElementById('tk_addstkCUST_ID').value = '';
  //document.getElementById('tk_addstkVPID').value = '';
  //document.getElementById('tk_addstkOLD_CUST').value = '';
  document.getElementById('tk_addstkAMOUNT').value = '';
  document.getElementById('tk_addstkSHIPPING').value = '';
  //document.getElementById('tk_addstkWEEKNO').value = '';
  document.getElementById('tk_addstkCONTACT').value = '';
  //document.getElementById('tk_addstkCIS2').value = '';
  //document.getElementById('tk_addstkCIS3').value = '';

  // 19 is Y/N for DP
  document.getElementById('tk_addstkDPbox').checked = false;
  
  // 20 is Y/N for lasering
  document.getElementById('tk_addstkLASERINGbox').checked = false;
      
  // 21 is Y/N for OCCUPANT
  document.getElementById('tk_addstkOCCUPANTbox').checked = false;

  // 22 is Y/N for Data Entry
  document.getElementById('tk_addstkDATA_ENTRYbox').checked = false;

  // 23 is Y/N for Maps
  document.getElementById('tk_addstkMAPSbox').checked = false;

  document.getElementById('tk_addstkQUANTITY').value = '';
  document.getElementById('tk_addstkINV_DATE').value = '';
  //document.getElementById('tk_addstkSALESPER').value = '';
  //document.getElementById('tk_addstkSALESPERNO').value = '';
  document.getElementById('tk_addstkARMS_ORD').value = '';
  document.getElementById('tk_addstkARMS_JOB').value = '';
  document.getElementById('tk_addstkNOTES').value = '';

 
 //reset validation to black
  document.getElementById('tk_addstkJOB_ID').style.color='black';
  document.getElementById('tk_addstkDATE_DUE').style.color='black';
  
  document.getElementById('tk_addstkORDERDESC').style.color='black';
  document.getElementById('tk_addstkPO').style.color='black';
  document.getElementById('tk_addstkDATE_DONE').style.color='black';
  document.getElementById('tk_addstkCUST_ID').style.color='black';
  //document.getElementById('tk_addstkVPID').style.color='black';
  //document.getElementById('tk_addstkOLD_CUST').style.color='black';
  document.getElementById('tk_addstkAMOUNT').style.color='black';
  document.getElementById('tk_addstkSHIPPING').style.color='black';
  document.getElementById('tk_addstkCONTACT').style.color='black';
  //document.getElementById('tk_addstkCIS2').style.color='black';
  //document.getElementById('tk_addstkCIS3').style.color='black';
  document.getElementById('tk_addstkQUANTITY').style.color='black';
  document.getElementById('tk_addstkINV_DATE').style.color='black';
  //document.getElementById('tk_addstkSALESPER').style.color='black';
  //document.getElementById('tk_addstkSALESPERNO').style.color='black';
  document.getElementById('tk_addstkARMS_ORD').style.color='black';
  document.getElementById('tk_addstkARMS_JOB').style.color='black';
  document.getElementById('tk_addstknotes').style.color='black';

//not sure why this called the hide screen- commented out
//hidetk_addstk();

//document.getElementById('mtktscreenup').value = "NO"; 
document.getElementById('tkselectMain').style.visibility = "hidden";
document.getElementById('tkclientadd').selectedIndex=0;

}
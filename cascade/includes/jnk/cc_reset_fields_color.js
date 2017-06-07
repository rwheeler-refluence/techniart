 
function resetFieldColors() {

// use the clear fileds js to make a new color reset- needed to split out so it would update dynamically from
// layers.js only fires after visible property set
// simply do a search and replace on all ____.value='';____ to _______.style.color='black';________
// and then get rid of all check boxes and select updates


document.getElementById('company').style.color='black';
document.getElementById('add1').style.color='black';
document.getElementById('CITY').style.color='black';
document.getElementById('ST').style.color='black';
document.getElementById('ZIP').style.color='black';
document.getElementById('ZIP4').style.color='black';
document.getElementById('MLRA_DATE').style.color='black';
document.getElementById('RETAILCERT').style.color='black';
document.getElementById('RETAILCERT').style.color='black';
document.getElementById('RESPRICE').style.color='black';
document.getElementById('DELVREMAIL').style.color='black';
document.getElementById('UPSNAME').style.color='black';
document.getElementById('SHIPNOEMA1').style.color='black';
document.getElementById('SHIPPHONE').style.color='black';
document.getElementById('SRVCTYPE').style.color='black';
document.getElementById('MINCHARGE').style.color='black';
document.getElementById('EMAILFTP').style.color='black';
document.getElementById('OCCUCHARGE').style.color='black';
document.getElementById('PDFCHARGE').style.color='black';
document.getElementById('PDFTAGMIN').style.color='black';
document.getElementById('CONPRICE').style.color='black';
document.getElementById('CONMIN').style.color='black';
document.getElementById('PLUS3CON').style.color='black';
document.getElementById('PLUSPHNCON').style.color='black';
document.getElementById('MLTIUSECON').style.color='black';
document.getElementById('CREDITLIM').style.color='black';
document.getElementById('CREDITEXP').style.color='black'; 
document.getElementById('PAFNUM').style.color='black';
document.getElementById('PAFEXP').style.color='black';
document.getElementById('PAFNUM2').style.color='black';
document.getElementById('PAFEXP2').style.color='black';
document.getElementById('NCOAEMAIL').style.color='black';
document.getElementById('OLD_ID').style.color='black';
document.getElementById('SOURCE').style.color='black';

document.getElementById('mcustid').style.color='black';
document.getElementById('CONTACTL1').style.color='black';
document.getElementById('CL1_EMAIL').style.color='black';
document.getElementById('P_LDL1').style.color='black';
document.getElementById('P_ACL1').style.color='black';
document.getElementById('P_NUMBERL1').style.color='black';
document.getElementById('P_EXTL1').style.color='black';
document.getElementById('F_LDL1').style.color='black';
document.getElementById('F_ACL1').style.color='black';
document.getElementById('F_NUMBERL1').style.color='black';
document.getElementById('COMMENTL').style.color='black';
document.getElementById('COMMENTD').style.color='black';
document.getElementById('COMMENTA').style.color='black';


// clear bl

  document.getElementById('blcid').style.color='black';
  document.getElementById('blokamttrigger').style.color='black';
  document.getElementById('blokvoltrigger').style.color='black';
  document.getElementById('bloknumorderstrigger').style.color='black';
  document.getElementById('blpkg1_single').style.color='black';
  document.getElementById('blpkg1_yr').style.color='black';
  document.getElementById('blpkg2_yr').style.color='black';
  document.getElementById('blp1Sd1v').style.color='black';
  document.getElementById('blp1Sd1a').style.color='black';
  document.getElementById('blp1Sd2v').style.color='black';
  document.getElementById('blp1Sd2a').style.color='black';
  document.getElementById('blp1Yd1v').style.color='black';
  document.getElementById('blp1Yd1a').style.color='black';
  document.getElementById('blp1Yd2v').style.color='black';
  document.getElementById('blp1Yd2a').style.color='black';
  document.getElementById('blp2Yd1v').style.color='black';
  document.getElementById('blp2Yd1a').style.color='black';
  document.getElementById('blp2Yd2v').style.color='black';
  document.getElementById('blp2Yd2a').style.color='black';
  document.getElementById('blmin_order').style.color='black';
  document.getElementById('bloneuplblprice').style.color='black';
  document.getElementById('blfouruplblprice').style.color='black';
  document.getElementById('blcdprice').style.color='black';
  document.getElementById('bldiskprice').style.color='black';
  document.getElementById('blseq10price').style.color='black';
  document.getElementById('blseq11price').style.color='black';
  document.getElementById('bluspdiskprice').style.color='black';
  document.getElementById('blusplblprice').style.color='black';
  document.getElementById('blitememphrprice').style.color='black';
  document.getElementById('blitememptotprice').style.color='black';
  document.getElementById('blitemownsprice').style.color='black';
  document.getElementById('blitemsiteprice').style.color='black';
  document.getElementById('blitemfranprice').style.color='black';
  document.getElementById('blitemcorpprice').style.color='black';
  document.getElementById('blitemyrprice').style.color='black';
  document.getElementById('blitemmanuprice').style.color='black';
  document.getElementById('blitemtickerprice').style.color='black';
  document.getElementById('blitempubpriprice').style.color='black';
  document.getElementById('blitemsalesprice').style.color='black';
  document.getElementById('blitemsqfootprice').style.color='black';
  document.getElementById('blitemnumpcprice').style.color='black';
  document.getElementById('blitemteleprice').style.color='black';
  document.getElementById('blitemcontactprice').style.color='black';
  document.getElementById('blemailprice').style.color='black';
  document.getElementById('blcheshirelblprice').style.color='black';
      
 // clear address screen
  document.getElementById('acid').style.color='black';  
  document.getElementById('aattn').style.color='black'; 
  document.getElementById('aconm').style.color='black'; 
  document.getElementById('aadd1').style.color='black'; 
  document.getElementById('acity').style.color='black';  
  document.getElementById('ast').style.color='black';    
  document.getElementById('azip').style.color='black';     
  document.getElementById('aemail').style.color='black';   
  document.getElementById('aldd').style.color='black';     
  document.getElementById('aacl').style.color='black';       
  document.getElementById('anum').style.color='black';     
  document.getElementById('aext').style.color='black';     
  document.getElementById('afldd').style.color='black';    
  document.getElementById('afacl').style.color='black';    
  document.getElementById('afnum').style.color='black';    
  document.getElementById('arec').style.color='black';     
  document.getElementById('aloc').style.color='black';     
  document.getElementById('adept').style.color='black';    

 // clear ncoa
  document.getElementById('sncoaCUST_ID').style.color='black';   
  document.getElementById('sncoaPROCESS').style.color='black';
  document.getElementById('sncoaLESS1MM').style.color='black';
  document.getElementById('sncoaMM1MM3').style.color='black';
  document.getElementById('sncoaMM3MM5').style.color='black';
  document.getElementById('sncoaMM5MORE').style.color='black';
  document.getElementById('sncoaMINIMUM').style.color='black';
  document.getElementById('sncoaCUSTTYPE').style.color='black'; 
 
 // clear tk elements
  
  document.getElementById('stkJOB_ID').style.color='black';
  document.getElementById('stkDATE_IN').style.color='black';
  document.getElementById('stkDATE_DUE').style.color='black';
  //document.getElementById('stkCUSTOMER').style.color='black';
  document.getElementById('stkTYPE').style.color='black';
  document.getElementById('stkORDERDESC').style.color='black';
  document.getElementById('stkPO').style.color='black';
  document.getElementById('stkDATE_DONE').style.color='black';
  document.getElementById('stkCUST_ID').style.color='black';
  //document.getElementById('stkVPID').style.color='black';
  //document.getElementById('stkOLD_CUST').style.color='black';
  document.getElementById('stkAMOUNT').style.color='black';
  document.getElementById('stkSHIPPING').style.color='black';
  //document.getElementById('stkWEEKNO').style.color='black';
  document.getElementById('stkCONTACT').style.color='black';
  document.getElementById('stkCIS1').style.color='black';
  //document.getElementById('stkCIS2').style.color='black';
  //document.getElementById('stkCIS3').style.color='black';
  document.getElementById('stkWHO').style.color='black';

  document.getElementById('stkQUANTITY').style.color='black';
  document.getElementById('stkINV_DATE').style.color='black';
  //document.getElementById('stkSALESPER').style.color='black';
  //document.getElementById('stkSALESPERNO').style.color='black';
  document.getElementById('stkARMS_ORD').style.color='black';
  document.getElementById('stkARMS_JOB').style.color='black';
  document.getElementById('stkNOTES').style.color='black';

 
 //reset validation to black
  document.getElementById('stkJOB_ID').style.color='black';
  document.getElementById('stkDATE_DUE').style.color='black';
  document.getElementById('stkTYPE').style.color='black';
  document.getElementById('stkORDERDESC').style.color='black';
  document.getElementById('stkPO').style.color='black';
  document.getElementById('stkDATE_DONE').style.color='black';
  document.getElementById('stkCUST_ID').style.color='black';
  //document.getElementById('stkVPID').style.color='black';
  //document.getElementById('stkOLD_CUST').style.color='black';
  document.getElementById('stkAMOUNT').style.color='black';
  document.getElementById('stkSHIPPING').style.color='black';
  document.getElementById('stkCONTACT').style.color='black';
  document.getElementById('stkCIS1').style.color='black';
  //document.getElementById('stkCIS2').style.color='black';
  //document.getElementById('stkCIS3').style.color='black';
  document.getElementById('stkWHO').style.color='black';
  document.getElementById('stkQUANTITY').style.color='black';
  document.getElementById('stkINV_DATE').style.color='black';
  //document.getElementById('stkSALESPER').style.color='black';
  //document.getElementById('stkSALESPERNO').style.color='black';
  document.getElementById('stkARMS_ORD').style.color='black';
  document.getElementById('stkARMS_JOB').style.color='black';
  document.getElementById('stknotes').style.color='black';

  //contact add

  document.getElementById('ADD_aattn').style.color='black';
  document.getElementById('ADD_aconm').style.color='black';
  document.getElementById('ADD_aadd1').style.color='black';
  document.getElementById('ADD_acity').style.color='black';
  document.getElementById('ADD_ast').style.color='black';
  document.getElementById('ADD_azip').style.color='black';
  document.getElementById('ADD_aemail').style.color='black';
  document.getElementById('ADD_aldd').style.color='black';
  document.getElementById('ADD_aacl').style.color='black';  
  document.getElementById('ADD_anum').style.color='black';
  document.getElementById('ADD_aext').style.color='black';
  document.getElementById('ADD_afldd').style.color='black';
  document.getElementById('ADD_afacl').style.color='black';
  document.getElementById('ADD_afnum').style.color='black';
  document.getElementById('ADD_arec').style.color='black';
  document.getElementById('ADD_aloc').style.color='black';
  document.getElementById('ADD_adept').style.color='black';


  // clear user 
  document.getElementById('uid').style.color='black';
  document.getElementById('ucid').style.color='black';
  document.getElementById('unm').style.color='black';
  document.getElementById('ulevel').style.color='black';
  document.getElementById('uwebnm').style.color='black';
  document.getElementById('uwebpass').style.color='black';
  //document.getElementById('ulogdt').style.color='black';
  //document.getElementById('ulogtime').style.color='black';


//currently no validation on TM fields

} 

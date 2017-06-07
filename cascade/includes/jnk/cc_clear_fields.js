// use the clear fileds js to make a new color reset- needed to split out so it would update dynamically from
// layers.js only fires after visible property set
// simply do a search and replace on all ____.style.color='black';____ to _______.style.color='black';________
// and then get rid of all check boxes and select updates

function clrFields() {
 document.forms['custcareform'].salesperson.options.length = 0;
  document.forms['custcareform'].salesperson.options[0] = new Option("No Salesperson","No salesperson|0.00|    ",true,false);
  document.getElementById('mcommrate').value=0.00;
  

hidesuser();
hidesadd();
hidestk();
hidesncoa();

var mchartdir=document.getElementById('ucoid').value+"graphs/";

document["graph1"].src ="images/blankchart.gif";
document["graph2"].src ="images/blankchart.gif";

document.getElementById('statText1').innerHTML="";
document.getElementById('statText2').innerHTML="";
document.getElementById('statText3').innerHTML="";
document.getElementById('statText4').innerHTML="";

document.getElementById('company').value ='';
document.getElementById('add1').value ='';
document.getElementById('CITY').value ='';
document.getElementById('ST').value ='';
document.getElementById('ZIP').value ='';
document.getElementById('ZIP4').value ='';
document.forms['custcareform'].mship.options[0].selected = true;
// updated based on whlsretl field ---document.getElementById('COD').value = '';
document.forms['custcareform'].mterms.options[0].selected = true;
document.getElementById('MLRAbox').checked = false;
document.getElementById('MLRA_DATE').value ='';
// not used because of contact prim field ---document.getElementById('LSTCNTPRIM').value ='';
// updated based on whlsretl field ---document.getElementById('TAXABLE').value = '';  
document.getElementById('RETAILCERT').value ='';
document.getElementById('AUTORESbox').checked = false;
document.getElementById('RESPRICE').value ='';
document.getElementById('REVCHARGEbox').checked = false;
document.getElementById('DELVREMAIL').value ='';
document.getElementById('UPSNAME').value ='';
document.getElementById('UPSRESIDbox').checked = false;
document.getElementById('SHIPNOTYP1box').checked = false;

document.getElementById('allow_mktng').checked =false;
document.getElementById('PROSPECTbox').checked =false;
document.getElementById('trend_box').checked =false;


document.getElementById('SHIPNOEMA1').value ='';
document.getElementById('SHIPPHONE').value ='';
document.getElementById('SRVCTYPE').value ='';
document.forms['custcareform'].filetype.options[0].selected = true;
document.getElementById('WHSLRETLbox').checked = false;
document.getElementById('MINCHARGE').value ='';
document.getElementById('EMAILFTP').value ='';
document.getElementById('OCCUCHARGE').value ='';
document.getElementById('EXTRACHARGbox').checked = false;
document.getElementById('NOINVOICEbox').checked = false;
document.getElementById('AUTOTAGbox').checked = false;
document.forms['custcareform'].tagformat.options[0].selected = true;
document.getElementById('TRAILERbox').checked = false;
document.getElementById('PDFTAGSbox').checked = false;
document.getElementById('PDFCHARGE').value ='';
document.getElementById('PDFTAGMIN').value ='';
document.getElementById('CONPRICE').value ='';
document.getElementById('CONMIN').value ='';
document.getElementById('PLUS3CON').value ='';
document.getElementById('PLUSPHNCON').value ='';
document.getElementById('AUTOCONbox').checked = false;
document.getElementById('MLTIUSECON').value ='';
document.getElementById('TMTAGSbox').checked = false;
document.getElementById('NOCISDEFbox').checked = false;
document.getElementById('ALLOWNOCISBOX').checked = false;
document.getElementById('CREDITLIM').value ='';
document.getElementById('CREDITEXP').value =''; 
document.getElementById('PAFNUM').value ='';
document.getElementById('PAFEXP').value ='';
document.getElementById('PAFNUM2').value ='';
document.getElementById('PAFEXP2').value ='';
document.getElementById('NCOAONLYbox').checked = false;
document.getElementById('NCOAEMAIL').value ='';
document.getElementById('ALLOWNCOAbox').checked = false;

//moved this to tab and this not needed-visible on tab screws up DHTML layers
//document.getElementById('OLD_ID').value ='';
//document.getElementById('SOURCE').value ='';
//document.getElementById('sourceln1').style.visibility =  "visible";
//document.getElementById('sourceln2').style.visibility =  "visible";


document.getElementById('mcustid').value ='';
document.getElementById('CONTACTL1').value ='';
document.getElementById('CL1_EMAIL').value ='';
document.getElementById('P_LDL1').value ='';
document.getElementById('P_ACL1').value ='';
document.getElementById('P_NUMBERL1').value ='';
document.getElementById('P_EXTL1').value ='';
document.getElementById('F_LDL1').value ='';
document.getElementById('F_ACL1').value ='';
document.getElementById('F_NUMBERL1').value ='';
document.getElementById('COMMENTL').value ='';
document.getElementById('COMMENTD').value ='';
document.getElementById('COMMENTA').value ='';


// clear bl

  document.getElementById('blcid').value = '';
  document.getElementById('blokamttrigger').value = '';
  document.getElementById('blokvoltrigger').value = '';
  document.getElementById('bloknumorderstrigger').value = '';
  document.getElementById('blpkg1_single').value = '';
  document.getElementById('blpkg1_yr').value = '';
  document.getElementById('blpkg2_yr').value = '';
  document.getElementById('blp1Sd1v').value = '';
  document.getElementById('blp1Sd1a').value = '';
  document.getElementById('blp1Sd2v').value = '';
  document.getElementById('blp1Sd2a').value = '';
  document.getElementById('blp1Yd1v').value = '';
  document.getElementById('blp1Yd1a').value = '';
  document.getElementById('blp1Yd2v').value = '';
  document.getElementById('blp1Yd2a').value = '';
  document.getElementById('blp2Yd1v').value = '';
  document.getElementById('blp2Yd1a').value = '';
  document.getElementById('blp2Yd2v').value = '';
  document.getElementById('blp2Yd2a').value = '';
  document.getElementById('blmin_order').value = '';
  document.getElementById('bloneuplblprice').value = '';
  document.getElementById('blfouruplblprice').value = '';
  document.getElementById('blcdprice').value = '';
  document.getElementById('bldiskprice').value = '';
  document.getElementById('blseq10price').value = '';
  document.getElementById('blseq11price').value = '';
  document.getElementById('bluspdiskprice').value = '';
  document.getElementById('blusplblprice').value = '';
  document.getElementById('blitememphrprice').value = '';
  document.getElementById('blitememptotprice').value = '';
  document.getElementById('blitemownsprice').value = '';
  document.getElementById('blitemsiteprice').value = '';
  document.getElementById('blitemfranprice').value = '';
  document.getElementById('blitemcorpprice').value = '';
  document.getElementById('blitemyrprice').value = '';
  document.getElementById('blitemmanuprice').value = '';
  document.getElementById('blitemtickerprice').value = '';
  document.getElementById('blitempubpriprice').value = '';
  document.getElementById('blitemsalesprice').value = '';
  document.getElementById('blitemsqfootprice').value = '';
  document.getElementById('blitemnumpcprice').value = '';
  document.getElementById('blitemteleprice').value = '';
  document.getElementById('blitemcontactprice').value = '';
  document.getElementById('blemailprice').value = '';
  document.getElementById('blcheshirelblprice').value = '';
      
 // clear address screen
  document.getElementById('acid').value = '';       //CUST_ID
  document.getElementById('aattn').value = '';      //ATTN
  document.getElementById('aconm').value = '';      //COMPANY
  document.getElementById('aadd1').value = '';      //ADD1
  document.getElementById('acity').value = '';      //CITY
  document.getElementById('ast').value = '';        //ST
  document.getElementById('azip').value = '';       //ZIP
  document.getElementById('aemail').value = '';     //EMAIL
  document.getElementById('aldd').value = '';       //LDD
  document.getElementById('aacl').value = '';       //ACL  
  document.getElementById('anum').value = '';      //NUMBERL
  document.getElementById('aext').value = '';      //EXTL
  document.getElementById('afldd').value = '';     //F_LDD
  document.getElementById('afacl').value = '';     //F_ACL
  document.getElementById('afnum').value = '';     //NUMBERF
  document.getElementById('arec').value = '';      //REC_TYPE
  document.getElementById('aloc').value = '';      //LOC_TYPE
  document.getElementById('adept').value = '';     //DEPT

  
  document.getElementById('dun_match').value = '';  
  document.getElementById('duns_nmbr').value = '';  
  document.getElementById('dun_sic').value = '';  
  document.getElementById('dun_sic_desc').value = '';  
  document.getElementById('dun_name').value = '';  
  document.getElementById('dun_add1').value = '';  
  document.getElementById('dun_city').value = '';  
  document.getElementById('dun_st').value = '';  
  document.getElementById('dun_zip').value = '';  
  document.getElementById('dun_zip4').value = '';  
  document.getElementById('dun_trade').value = ''; 
  document.getElementById('TMP_dun_sic').value = ''; 
  document.getElementById('TMP_dun_sic_desc').value = '';  
  
 // clear ncoa
  document.getElementById('sncoaCUST_ID').value = '';   
  document.getElementById('sncoaPROCESS').value = '';
  document.getElementById('sncoaLESS1MM').value = '';
  document.getElementById('sncoaMM1MM3').value = '';
  document.getElementById('sncoaMM3MM5').value = '';
  document.getElementById('sncoaMM5MORE').value = '';
  document.getElementById('sncoaMINIMUM').value = '';
  document.getElementById('sncoaCUSTTYPE').value = ''; 
 
 // clear tk elements
  
  document.getElementById('stkJOB_ID').value = '';
  document.getElementById('stkDATE_IN').value = '';
  document.getElementById('stkDATE_DUE').value = '';
  //document.getElementById('stkCUSTOMER').value = '';
  document.getElementById('stkTYPE').value = '';
  document.getElementById('stkORDERDESC').value = '';
  document.getElementById('stkPO').value = '';
  document.getElementById('stkDATE_DONE').value = '';
  document.getElementById('stkCUST_ID').value = '';
  //document.getElementById('stkVPID').value = '';
  //document.getElementById('stkOLD_CUST').value = '';
  document.getElementById('stkAMOUNT').value = '';
  document.getElementById('stkSHIPPING').value = '';
  //document.getElementById('stkWEEKNO').value = '';
  document.getElementById('stkCONTACT').value = '';
  document.getElementById('stkCIS1').value = '';
  //document.getElementById('stkCIS2').value = '';
  //document.getElementById('stkCIS3').value = '';
  document.getElementById('stkWHO').value = '';

  // 19 is Y/N for DP
  document.getElementById('stkDPbox').checked = false;
  
  // 20 is Y/N for lasering
  document.getElementById('stkLASERINGbox').checked = false;
      
  // 21 is Y/N for OCCUPANT
  document.getElementById('stkOCCUPANTbox').checked = false;

  // 22 is Y/N for Data Entry
  document.getElementById('stkDATA_ENTRYbox').checked = false;

  // 23 is Y/N for Maps
  document.getElementById('stkMAPSbox').checked = false;

  document.getElementById('stkQUANTITY').value = '';
  document.getElementById('stkINV_DATE').value = '';
  //document.getElementById('stkSALESPER').value = '';
  //document.getElementById('stkSALESPERNO').value = '';
  document.getElementById('stkARMS_ORD').value = '';
  document.getElementById('stkARMS_JOB').value = '';
  document.getElementById('stknotes').value = '';

 
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


// clear user 
  document.getElementById('uid').value = '';
  document.getElementById('ucid').value = '';
  document.getElementById('unm').value = '';
  document.getElementById('ulevel').value = '';
  document.getElementById('uwebnm').value = '';
  document.getElementById('uwebpass').value = '';
  //document.getElementById('ulogdt').value = '';
  //document.getElementById('ulogtime').value = '';


  document.getElementById('TM_VPID').value='';         //  VPID        Character   6
  document.getElementById('TM_COMPANY').value='';      //  COMPANY     Character  40
  document.getElementById('TM_RESDN_TAG').value='';    //  RESDN_TAG   Character  30
  document.getElementById('TM_BUSN_TAG').value='';     //  BUSN_TAG    Character  30
  document.getElementById('TM_BOX_TAG').value='';      //  BOX_TAG     Character  30
  document.getElementById('TM_PRN_LINES').value='';    //  PRN_LINES   Numeric     2
  document.getElementById('TM_BILL_TO').value='';      //  BILL_TO     Character  40
  document.getElementById('TM_MULTI_USE').value='';    //  MULTI_USE   Character   1
  document.getElementById('TM_EW').value='';           //  EW          Character   1
  document.getElementById('TM_MAP_VIEWER').value='';   //  MAP_VIEWER  Character   1
  document.getElementById('TM_VP').value='';          //  VP          Character   1
  document.getElementById('TM_SELECT_NTA').value='';  //  SELECT_NTA  Character   1
  document.getElementById('TM_SHIP_TYPE').value='';   //  SHIP_TYPE   Character  12
  document.getElementById('TM_SHIP1FTP').value='Send File to FTP';   //  SHIPPING1   Character  30
  document.getElementById('TM_SHIP2FTP').value='';   //  SHIPPING2   Character  30
  document.getElementById('TM_SHIP3FTP').value='';   //  SHIPPING3   Character  30
  document.getElementById('TM_SHIP4FTP').value='';   //  SHIPPING4   Character  30
  document.getElementById('TM_SHIP1BBS').value="Send File to BBS";   //  SHIPPING1   Character  30
  document.getElementById('TM_SHIP2BBS').value="";   //  SHIPPING2   Character  30
  document.getElementById('TM_SHIP3BBS').value="";   //  SHIPPING3   Character  30
  document.getElementById('TM_SHIP4BBS').value="";   //  SHIPPING4   Character  30
  document.getElementById('TM_SHIP1ADD').value="Send File to BBS";   //  SHIPPING1   Character  30
  document.getElementById('TM_SHIP2ADD').value="";   //  SHIPPING2   Character  30
  document.getElementById('TM_SHIP3ADD').value="";   //  SHIPPING3   Character  30
  document.getElementById('TM_SHIP4ADD').value="";   //  SHIPPING4   Character  30
  document.getElementById('TM_SHIPEMAIL').value="";   //  SHIPPING4   Character  30

  document.getElementById('TM_LABELS').value='';      //  LABELS      Character  20
  document.getElementById('TM_LABEL_BAR').value='';   //  LABEL_BAR   Character   1
  document.getElementById('TM_DATAFILE').value='';    //  DATAFILE    Character  22
  document.getElementById('TM_OUTPUT').value='';      //  OUTPUT      Character  20
  document.getElementById('TM_REV_WALK').value='';    //  REV_WALK    Character   1
  document.getElementById('TM_SEASONAL').value='';    //  SEASONAL    Character   1
  document.getElementById('TM_SEASONBUTN').value='';  //  SEASONBUTN  Character   1
  document.getElementById('TM_PAPERWORK').value='';   //  PAPERWORK   Character   1
  document.getElementById('TM_PAPEREMAIL').value='';  //  PAPEREMAIL  Character  40
  document.getElementById('TM_DROP_GATE').value='';   //  DROP_GATE   Character   1
  document.getElementById('TM_USE_POP').value='';     //  USE_POP     Character   1
  document.getElementById('TMMESSAGE').innerHTML='';
         
  document.forms['custcareform'].tmshipselect.selectedIndex=0;
  document.forms['custcareform'].tmoutputselect.selectedIndex=0;
  document.forms['custcareform'].tmoutputtype.selectedIndex=0;
  document.forms['custcareform'].tmfiletypeselect.selectedIndex=0;
  document.forms['custcareform'].tmlabelselect.selectedIndex=0;

  //addrchg
  document.getElementById('new_conm').value=''; 
  document.getElementById('new_add1').value='';
  document.getElementById('new_city').value='';
  document.getElementById('new_st').value='';
  document.getElementById('new_zip').value='';
  document.getElementById('new_zip4').value='';
  document.getElementById('new_attn').value='';
  document.getElementById('new_email').value='';
  document.getElementById('new_ldd').value='';
  document.getElementById('new_acl').value='';
  document.getElementById('new_num').value='';
  document.getElementById('new_ext').value='';

  document.getElementById('new_fldd').value='';
  document.getElementById('new_facl').value='';
  document.getElementById('new_fnum').value='';
         
  document.getElementById('new_PHYbox').checked = false;
  document.getElementById('new_PRIMbox').checked = false;
  document.getElementById('new_ACCTbox').checked = false;
  document.getElementById('new_SHIPbox').checked = false;
  document.getElementById('new_USERbox').checked = false;
  document.getElementById('new_PHYnmbox').checked = false;
  document.getElementById('new_PRIMnmbox').checked = false;
  document.getElementById('new_ACCTnmbox').checked = false;
  document.getElementById('new_SHIPnmbox').checked = false;
  document.getElementById('new_USERnmbox').checked = false;

  document.getElementById('new_PRIMcontbox').checked = false;      
  document.getElementById('new_ACCTcontbox').checked = false;      
  document.getElementById('new_SHIPcontbox').checked = false;      
  document.getElementById('new_USERcontbox').checked = false;       
  document.getElementById('new_PRIMphtbox').checked = false;   
  document.getElementById('new_ACCTphbox').checked = false;    
  document.getElementById('new_SHIPphbox').checked = false;     
  document.getElementById('new_USERphbox').checked = false;
  document.getElementById('new_PRIMfaxbox').checked = false; 
  document.getElementById('new_ACCTfaxbox').checked = false;
  document.getElementById('new_SHIPfaxbox').checked = false;
  document.getElementById('new_USERfaxbox').checked = false;   
  document.getElementById('new_PRIMemailbox').checked = false;
  document.getElementById('new_ACCTemailbox').checked = false;      
  document.getElementById('new_SHIPemailbox').checked = false;
  document.getElementById('new_USERemailbox').checked = false;        
  document.getElementById('new_INVacctbox').checked = false;      
  document.getElementById('new_INVshipbox').checked = false;      
   
  
//showcust(1);
if (document.getElementById('ucoid').value=="CIS"){
  showcust(1);
} else {
  showcust(5);  
}	 
  
setEditNo();
} 

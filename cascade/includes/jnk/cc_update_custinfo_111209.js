//function for updating an edit

 function getcusteditResponse() {

  if (http.readyState == 4) {
    results = http.responseText;
    //alert(results);
    //updateCustcommL();
    
    strmlen =trim(document.getElementById('COMMENTL').value)+trim(document.getElementById('COMMENTD').value)+trim(document.getElementById('COMMENTA').value);  

    sizeoffiles=strmlen.length;
    if (sizeoffiles < 100) {   
      updateFoxCommL();
    } else {
	  updateCustcommL();
    }
  }

}


function updateCustInfo() {

if (trim(document.getElementById('mcustid').value) !=""){

  var updateurl = "includes/php/cc_update_custinfo_process_fox.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;

  // the following are a check for small comment blocks to stuff into fox-trouble opening comm within miliseconds
  var sizeofcomments=0;
  var tempcommentstr="";  
  tempcommentstr=trim(document.getElementById('COMMENTL').value)+trim(document.getElementById('COMMENTD').value)+trim(document.getElementById('COMMENTA').value);  
  sizeofcomments=tempcommentstr.length;

  document.body.style.cursor = "wait";
  showwait();

  checkforErrors=validCustInfo();


if (checkforErrors == 0) {
  s = new Array();
  s[0] = "mscr";
  s[1] = trim(document.getElementById('company').value);
  
  s[2] = trim(document.getElementById('add1').value);
  s[3] = trim(document.getElementById('CITY').value);
  s[4] = trim(document.getElementById('ST').value);
  s[5] = trim(document.getElementById('ZIP').value);
  s[6] = trim(document.getElementById('ZIP4').value);

  var mindex = document.forms['custcareform'].mship.selectedIndex;
  s[7] = document.forms['custcareform'].mship.options[mindex].value;

  //set to null until s9 defined
  s[8] = "";

  var mindex = document.forms['custcareform'].mterms.selectedIndex;
  s[9] = document.forms['custcareform'].mterms.options[mindex].value;

  //document.getElementById('COD').value substrings on terms
  if (s[9].substring(0,3) == "COD") {
    s[8]="Y";
  } else { 
    s[8]="N";
  }

  if (document.getElementById('MLRAbox').checked == false) {
      s[10]= "N";
  } else {s[10]= "Y"};

  // s[11] is a date and needs date conversion
  tdt=document.getElementById('MLRA_DATE').value;
  if (tdt.length > 6){
	 tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*"); 
	 var tgtemp = new Array();
     tgtemp=tdt.split("*");
     if (tgtemp[2].length < 4){tgtemp[2]='20' + tgtemp[2]};
     if (tgtemp[0].length < 2){tgtemp[0]='0' + tgtemp[0]};
     if (tgtemp[1].length < 2){tgtemp[1]='0' + tgtemp[1]};
     s[11]=tgtemp[2]+tgtemp[0]+tgtemp[1];   
	  
  } else {s[11]= " "};

  s[12] = "Y";//document.getElementById('LSTCNTPRIM').value;

  // s[13] is the taxable box 
  if (document.getElementById('TAXABLEbox').checked == false) {
     s[13]= "N";
  } 
  else {s[13]= "Y"}; 

  // s[14] is a date and needs date conversion
  tdt=document.getElementById('RETAILCERT').value;
  if (tdt.length > 6){
	 tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*"); 
	 var tgtemp = new Array();
     tgtemp=tdt.split("*");
     if (tgtemp[2].length < 4){tgtemp[2]='20' + tgtemp[2]};
     if (tgtemp[0].length < 2){tgtemp[0]='0' + tgtemp[0]};
     if (tgtemp[1].length < 2){tgtemp[1]='0' + tgtemp[1]};
     s[14]=tgtemp[2]+tgtemp[0]+tgtemp[1]; 
  } else {s[14]= " "};
  
  if (document.getElementById('AUTORESbox').checked == false) {
      s[15]= "N";
  } else {s[15]= "Y"};

  s[16] = trim(document.getElementById('RESPRICE').value);

  if (document.getElementById('REVCHARGEbox').checked == false) {
      s[17]= "N";
  } else {s[17]= "Y"};
 
  s[18] = trim(document.getElementById('DELVREMAIL').value);
  s[19] = trim(document.getElementById('UPSNAME').value);

  if (document.getElementById('UPSRESIDbox').checked == false) {
      s[20]= "N";
  } else {s[20]= "Y"};
 
  s[21] = "Y"; // document.getElementById('SHIPNOopt1')

  if (document.getElementById('SHIPNOTYP1box').checked == false) {
      s[22]= "N";
  } else {s[22]= "Y"};

  s[23] = trim(document.getElementById('SHIPNOEMA1').value);
  s[24] = document.getElementById('SHIPPHONE').value;
  
  //s[25] = trim(document.getElementById('SRVCTYPE').value);
  var mindex = document.forms['custcareform'].SRVCTYPE.selectedIndex;
  s[25] = document.forms['custcareform'].SRVCTYPE.options[mindex].value;
   
  
  var mindex = document.forms['custcareform'].filetype.selectedIndex;
  s[26] = document.forms['custcareform'].filetype.options[mindex].value;

  if (document.getElementById('WHSLRETLbox').checked == false) {
      s[27]= "R";
  } else {s[27]= "W"};

  s[28] = trim(document.getElementById('MINCHARGE').value);
  s[29] = trim(document.getElementById('EMAILFTP').value);
  s[30] = trim(document.getElementById('OCCUCHARGE').value);


  if (document.getElementById('EXTRACHARGbox').checked == false) {
      s[31]= "N";
  } else {s[31]= "Y"};
 
  if (document.getElementById('NOINVOICEbox').checked == false) {
      s[32]= "N";
  } else {s[32]= "Y"};
 
  if (document.getElementById('AUTOTAGbox').checked == false) {
      s[33]= "N";
  } else {s[33]= "Y"};

  var mindex = document.forms['custcareform'].tagformat.selectedIndex;
  s[34] = document.forms['custcareform'].tagformat.options[mindex].value;

  if (document.getElementById('TRAILERbox').checked == false) {
      s[35]= "N";
  } else {s[35]= "Y"};

  if (document.getElementById('PDFTAGSbox').checked == false) {
      s[36]= "N";
  } else {s[36]= "Y"};

  s[37] = trim(document.getElementById('PDFCHARGE').value);
  s[38] = trim(document.getElementById('PDFTAGMIN').value);
  s[39] = trim(document.getElementById('CONPRICE').value);
  s[40] = trim(document.getElementById('CONMIN').value);
  s[41] = trim(document.getElementById('PLUS3CON').value);
  s[42] = trim(document.getElementById('PLUSPHNCON').value);

  if (document.getElementById('AUTOCONbox').checked == false) {
      s[43]= "N";
  } else {s[43]= "Y"};

  s[44] = trim(document.getElementById('MLTIUSECON').value);

  if (document.getElementById('TMTAGSbox').checked == false) {
      s[45]= "N";
  } else {s[45]= "Y"};


  if (document.getElementById('NOCISDEFbox').checked == false) {
      s[46]= "N";
  } else {s[46]= "Y"};


  if (document.getElementById('ALLOWNOCISbox').checked == false) {
      s[47]= "N";
  } else {s[47]= "Y"};


  s[48] = trim(document.getElementById('CREDITLIM').value);


  // s[49] is a date and needs date conversion
  tdt=document.getElementById('CREDITEXP').value;
  if (tdt.length > 6){
	 tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*"); 
	 var tgtemp = new Array();
     tgtemp=tdt.split("*");
     if (tgtemp[2].length < 4){tgtemp[2]='20' + tgtemp[2]};
     if (tgtemp[0].length < 2){tgtemp[0]='0' + tgtemp[0]};
     if (tgtemp[1].length < 2){tgtemp[1]='0' + tgtemp[1]};
     s[49]=tgtemp[2]+tgtemp[0]+tgtemp[1];  
	 
  } else {s[49]= " "};


  s[50] = document.getElementById('PAFNUM').value;

  // s[51] is a date and needs date conversion
  tdt=document.getElementById('PAFEXP').value;
  if (tdt.length > 6){
	  
	 tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*"); 
	 var tgtemp = new Array();
     tgtemp=tdt.split("*");
     if (tgtemp[2].length < 4){tgtemp[2]='20' + tgtemp[2]};
     if (tgtemp[0].length < 2){tgtemp[0]='0' + tgtemp[0]};
     if (tgtemp[1].length < 2){tgtemp[1]='0' + tgtemp[1]};
     s[51]=tgtemp[2]+tgtemp[0]+tgtemp[1];   
	  
  } else {s[51]= " "};


  if (document.getElementById('NCOAONLYbox').checked == false) {
      s[52]= "N";
  } else {s[52]= "Y"};

  s[53] = trim(document.getElementById('NCOAEMAIL').value);
  
  if (document.getElementById('ALLOWNCOAbox').checked == false) {
      s[54]= "N";
  } else {s[54]= "Y"};

  s[55] = document.getElementById('OLD_ID').value;
  s[56] = document.getElementById('SOURCE').value;
  s[57] = document.getElementById('mcustid').value;

  s[58] = trim(document.getElementById('CONTACTL1').value);
  s[59] = trim(document.getElementById('CL1_EMAIL').value);
  s[60] = trim(document.getElementById('P_LDL1').value);
  s[61] = trim(document.getElementById('P_ACL1').value);
  s[62] = trim(document.getElementById('P_NUMBERL1').value);
  s[63] = trim(document.getElementById('P_EXTL1').value);
  s[64] = trim(document.getElementById('F_LDL1').value);
  s[65] = trim(document.getElementById('F_ACL1').value);
  s[66] = trim(document.getElementById('F_NUMBERL1').value);

  s[67] = "Comments are updates separately";
  s[68] = "Comments are updates separately";
  s[69] = "Comments are updates separately";
  

  s[70] = ""; // toggle this to empty and then test in php to update

  var checkbl= document.getElementById('blcid').value;
  if (checkbl==s[57]){
    s[70]= document.getElementById('blcid').value;
    s[71]= document.getElementById('blokamttrigger').value;
    s[72]= document.getElementById('blokvoltrigger').value;
    s[73]= document.getElementById('bloknumorderstrigger').value;
    s[74]= document.getElementById('blpkg1_single').value;
    s[75]= document.getElementById('blpkg1_yr').value;
    s[76]= document.getElementById('blpkg2_yr').value;
    s[77]= document.getElementById('blp1Sd1v').value;
    s[78]= document.getElementById('blp1Sd1a').value;
    s[79]= document.getElementById('blp1Sd2v').value;
    s[80]= document.getElementById('blp1Sd2a').value;
    s[81]= document.getElementById('blp1Yd1v').value;
    s[82]= document.getElementById('blp1Yd1a').value;
    s[83]= document.getElementById('blp1Yd2v').value;
    s[84]= document.getElementById('blp1Yd2a').value;
    s[85]= document.getElementById('blp2Yd1v').value;
    s[86]= document.getElementById('blp2Yd1a').value;
    s[87]= document.getElementById('blp2Yd2v').value;
    s[88]= document.getElementById('blp2Yd2a').value;
    s[89]= document.getElementById('blmin_order').value;
    s[90]= document.getElementById('bloneuplblprice').value;
    s[91]= document.getElementById('blfouruplblprice').value;
    s[92]= document.getElementById('blcdprice').value;
    s[93]= document.getElementById('bldiskprice').value;
    s[94]= document.getElementById('blseq10price').value;
    s[95]= document.getElementById('blseq11price').value;
    s[96]= document.getElementById('bluspdiskprice').value;
    s[97]= document.getElementById('blusplblprice').value;
    s[98]= document.getElementById('blitememphrprice').value;
    s[99]= document.getElementById('blitememptotprice').value;
    s[100]= document.getElementById('blitemownsprice').value;
    s[101]= document.getElementById('blitemsiteprice').value;
    s[102]= document.getElementById('blitemfranprice').value;
    s[103]= document.getElementById('blitemcorpprice').value;
    s[104]= document.getElementById('blitemyrprice').value;
    s[105]= document.getElementById('blitemmanuprice').value;
    s[106]= document.getElementById('blitemtickerprice').value;
    s[107]= document.getElementById('blitempubpriprice').value;
    s[108]= document.getElementById('blitemsalesprice').value;
    s[109]= document.getElementById('blitemsqfootprice').value;
    s[110]= document.getElementById('blitemnumpcprice').value;
    s[111]= document.getElementById('blitemteleprice').value;
    s[112]= document.getElementById('blitemcontactprice').value;
    s[113]= document.getElementById('blemailprice').value;
    s[114]= document.getElementById('blcheshirelblprice').value;

  } else {
    // added tm below, not sure if I need to pack these elements -check later
    s[70]=" ";
    s[71]=" ";
    s[72]=" ";
    s[73]=" ";
    s[74]=" ";
    s[75]=" ";
    s[76]=" ";
    s[77]=" ";
    s[78]=" ";
    s[79]=" ";
    s[80]=" ";
    s[81]=" ";
    s[82]=" ";
    s[83]=" ";
    s[84]=" ";
    s[85]=" ";
    s[86]=" ";
    s[87]=" ";
    s[88]=" ";
    s[89]=" ";
    s[90]=" ";
    s[91]=" ";
    s[92]=" ";
    s[93]=" ";
    s[94]=" ";
    s[95]=" ";
    s[96]=" ";
    s[97]=" ";
    s[98]=" ";
    s[99]=" ";
    s[100]=" ";
    s[101]=" ";
    s[102]=" ";
    s[103]=" ";
    s[104]=" ";
    s[105]=" ";
    s[106]=" ";
    s[107]=" ";
    s[108]=" ";
    s[109]=" ";
    s[110]=" ";
    s[111]=" ";
    s[112]=" ";
    s[113]=" ";
    s[114]=" ";
  }

    //all of these are not used but loaded for possible future use
    s[115]=trim(document.getElementById('TM_VPID').value);         //  VPID        Character   6
    s[116]=trim(document.getElementById('TM_COMPANY').value);      //  COMPANY     Character  40
    s[117]=trim(document.getElementById('TM_RESDN_TAG').value);    //  RESDN_TAG   Character  30
    s[118]=trim(document.getElementById('TM_BUSN_TAG').value);     //  BUSN_TAG    Character  30
    s[119]=trim(document.getElementById('TM_BOX_TAG').value);      //  BOX_TAG     Character  30
    s[120]=trim(document.getElementById('TM_PRN_LINES').value);    //  PRN_LINES   Numeric     2
    s[121]=trim(document.getElementById('TM_BILL_TO').value);      //  BILL_TO     Character  40
    s[122]=trim(document.getElementById('TM_MULTI_USE').value);    //  MULTI_USE   Character   1
    s[123]=trim(document.getElementById('TM_EW').value);           //  EW          Character   1
    s[124]=trim(document.getElementById('TM_MAP_VIEWER').value);   //  MAP_VIEWER  Character   1
    s[125]=trim(document.getElementById('TM_VP').value);          //  VP          Character   1
    s[126]=trim(document.getElementById('TM_SELECT_NTA').value);  //  SELECT_NTA  Character   1
    s[127]=trim(document.getElementById('TM_SEASONAL').value);    //  SEASONAL    Character   1
    s[128]=trim(document.getElementById('TM_SEASONBUTN').value);  //  SEASONBUTN  Character   1
    s[129]=trim(document.getElementById('TM_PAPERWORK').value);   //  PAPERWORK   Character   1
    s[130]=trim(document.getElementById('TM_PAPEREMAIL').value);  //  PAPEREMAIL  Character  40
    s[131]=trim(document.getElementById('TM_DROP_GATE').value);   //  DROP_GATE   Character   1
    s[132]=trim(document.getElementById('TM_USE_POP').value);     //  USE_POP     Character   1
  

    var msel=document.forms['custcareform'].tmshipselect.selectedIndex;
    
    //None
    if (msel==0){  //blank

      s[133]=" ";
      s[134]=" ";
      s[135]=" ";
      s[136]=" ";
      s[137]=" ";
  
    } else if (msel==1){  //Ship To

      s[133]="Ship To ";
      s[134]=trim(document.getElementById('TM_SHIP1ADD').value);
      s[135]=trim(document.getElementById('TM_SHIP2ADD').value);
      s[136]=trim(document.getElementById('TM_SHIP3ADD').value);
      s[137]=trim(document.getElementById('TM_SHIP4ADD').value);

    } else if (msel==2){  //Will Call

      s[133]="Will Call";
      s[134]=" ";
      s[135]=" ";
      s[136]=" ";
      s[137]=" ";

    } else if (msel==3){  //E-Mail
  
      s[133]="E-Mail";
      s[134]=trim(document.getElementById('TM_SHIPEMAIL').value);
      s[135]=" ";
      s[136]=" ";
      s[137]=" ";

   
    } else if (msel==4){  //BBS - Get file from CIS BBS

      s[133]="BBS";
      s[134]="Get file from CIS BBS";
      s[135]=" ";
      s[136]=" ";
      s[137]=" ";


    } else if (msel==5){  //BBS - Send file to BBS

      s[133]="BBS";
      s[134]=trim(document.getElementById('TM_SHIP1BBS').value);
      s[135]=trim(document.getElementById('TM_SHIP2BBS').value);
      s[136]=trim(document.getElementById('TM_SHIP3BBS').value); 
      s[137]=trim(document.getElementById('TM_SHIP4BBS').value);

    } else if (msel==6){  //FTP - Get file from CIS FTP site

      s[133]="FTP";
      s[134]="Get file from CIS FTP site";
      s[135]=" ";
      s[136]=" ";
      s[137]=" ";


    } else if (msel==7){  //FTP - Send file to FTP Site

      s[133]="FTP"; //ship type
      s[134]=trim(document.getElementById('TM_SHIP1FTP').value); //shipping1-4 
      s[135]=trim(document.getElementById('TM_SHIP2FTP').value);
      s[136]=trim(document.getElementById('TM_SHIP3FTP').value);
      s[137]=trim(document.getElementById('TM_SHIP4FTP').value);

    } else if (msel==8){  //CIS Delivery

      s[133]="CIS";
      s[134]="CIS Delivery";
      s[135]=" ";
      s[136]=" ";
      s[137]=" ";


    }
     
   //  OUTPUT    
   if (document.forms['custcareform'].tmoutputtype.selectedIndex > 0){        
            
          
      if (document.forms['custcareform'].tmoutputtype.selectedIndex==2){        
          //set label field
	      msel=document.forms['custcareform'].tmlabelselect.selectedIndex;        
          s[138]=document.forms['custcareform'].tmlabelselect.options[msel].text;    //LABELS   
          //set label out put type
      
          
          //set datafile type to 0
          s[140]=" ";
          s[139]=" ";
          
          if (document.getElementById('TM_LABEL_BARbox').checked == false) {
             s[141]= "N";
          } else {s[141]= "Y"};
           
          //there's only 3 choices
       } else {
	       
	       
		 //blank labels  
    	 s[138]=" ";
    	 s[141]= "N"; 
     	
     	 msel=document.forms['custcareform'].tmoutputselect.selectedIndex;        
         s[139]=document.forms['custcareform'].tmoutputselect.options[msel].text
      
     	 //set up file type
    	 msel=document.forms['custcareform'].tmfiletypeselect.selectedIndex;        
    	 s[140]=document.forms['custcareform'].tmfiletypeselect.options[msel].text;     
       
       }   
  } else {
  
	 //should never trigger this 
     s[139]=" ";
     s[138]=" ";
     s[140]=" ";     
     s[141]="N";
  }    
   
  //testing code
  //alert (s[139]+"  :   "+s[138]+"  :  "+s[140]+"  :  "+s[141]);
  //hidewait();
  //document.body.style.cursor='auto';
  //return null
  //end of test   
  
   if (document.getElementById('TM_REV_WALKbox').checked == false) {
      s[142]= " ";
   } else {s[142]= "Y"};
    

   if (document.getElementById('MLS_CUSTbox').checked == false) {
      s[143]= "N";
   } else {s[143]= "Y"};
     
   if (document.getElementById('WORLD_MKTbox').checked == false) {
      s[144]= "N";
   } else {s[144]= "Y"};           

   
   // added check box for flash editor- only checks for visible and checked/ php will clear field if it is unchecked
   if (document.getElementById('flash_edbox').checked == true && document.getElementById('flashedscr').style.visibility =='visible') {
      s[145]= "Y";
   } 
   
   if (document.getElementById('allow_mktng').checked == false) {
      s[146]= "N";
   } else {s[146]= "Y"};  
   
   if (document.getElementById('trend_box').checked == false) {
      s[147]= "N";
   } else {s[147]= "Y"};  
   
   if (document.getElementById('PROSPECTbox').checked == false) {
      s[148]= "N";
   } else {s[148]= "Y"};  
   
   s[149]=trim(document.getElementById('dun_match').value);
   s[150]=trim(document.getElementById('duns_nmbr').value);
   s[151]=trim(document.getElementById('dun_sic').value);
   s[152]=trim(document.getElementById('dun_sic_desc').value);
   s[153]=trim(document.getElementById('dun_name').value);
   s[154]=trim(document.getElementById('dun_add1').value);
   s[155]=trim(document.getElementById('dun_city').value);
   s[156]=trim(document.getElementById('dun_st').value);
   s[157]=trim(document.getElementById('dun_zip').value);
   s[158]=trim(document.getElementById('dun_zip4').value);
   s[159]=trim(document.getElementById('dun_trade').value);
   
   if (trim(s[66])=="-") {
    s[66]="";	   
   }  
    
   if (trim(s[62])=="-") {
    s[62]="";	   
   }
   
  //alert("ship type: "+s[133]+" ship1: "+s[134]+" ship2: "+s[135]+" Ship3: "+s[136]+" Ship4: "+s[137]+" Label:"+s[138]+" Output: "+s[139]+" Datafile: "+s[140]+" label bar: "+s[141]+" reverse walk: "+s[142])
  
  s[26]=s[26].replace(/\'/g,"zpos");
  s[1]=s[1].replace(/\,/g,"zcomma");
  s[1]=s[1].replace(/\'/g,"zpos");
  
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g," ");
     s[myKey]=s[myKey].replace(/\^/g," ");
     s[myKey]=s[myKey].replace(/\|/g," ");
     s[myKey]=s[myKey].replace(/\'/g,"''");
    }
  
  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getcusteditResponse;
  http.send(null);

} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

// this is the end of the check for no custid

} else {

  document.getElementById('confirmtext').innerHTML="No account loaded to save.";
  showconfirm();
}

// no cust check


}


function validCustInfo() {

// condense a lot of this stuff to functions as time allows 

 var numerrors=0;
 document.getElementById('emsg').innerHTML="";
 document.getElementById('errorcnt').innerHTML="";
 numchk="";

 numerrors=numerrors+blankchk('company','company name');
 numerrors=numerrors+blankchk('ZIP4','Zip plus 4 code');

 document.getElementById('add1').style.color='black';

 document.getElementById('CITY').style.color='black';

 document.getElementById('ST').style.color='black';

 numerrors=numerrors+checkzip('ZIP','company zip code');

 //numerrors=numerrors+checknumberentry('ZIP4','company zip4 ',9999);

 //allow anything here for now
 //numerrors=numerrors+checkdatefmt('MLRA_DATE','MLRA ');

  //- not used currently /document.getElementById('LSTCNTPRIM').style.color='black';


  numerrors=numerrors+checkdatefmt('RETAILCERT','retail cert ');
  numerrors=numerrors+checknumberentry('RESPRICE','Resident /M ',999);
//numerrors=numerrors+checkemail('DELVREMAIL','Delivery Email');

  document.getElementById('UPSNAME').style.color='black';
  //document.getElementById('SHIPNOEMA1').style.color='black';
//numerrors=numerrors+checkemail('SHIPNOEMA1','shipping Email');

  document.getElementById('SHIPPHONE').style.color='black';
  document.getElementById('SRVCTYPE').style.color='black';

  numerrors=numerrors+checknumberentry('MINCHARGE','Resident Minimum Charge ',999);
  numerrors=numerrors+checknumberentry('EMAILFTP','Email/FTP Charge ',99.99);
  numerrors=numerrors+checknumberentry('OCCUCHARGE','Occupant /M Charge ',99.99);
  numerrors=numerrors+checknumberentry('PDFCHARGE','PDF Charge ',99.99);
  numerrors=numerrors+checknumberentry('PDFTAGMIN','PDF Tag Minimum ',99.99);
  numerrors=numerrors+checknumberentry('CONPRICE','Consumer /M Charge ',99.99);
  numerrors=numerrors+checknumberentry('CONMIN','Consumer Minimum Charge ',999.99);
  numerrors=numerrors+checknumberentry('PLUS3CON','Plus3 Consumer Charge ',99.99);
  numerrors=numerrors+checknumberentry('PLUSPHNCON','Plus3 Phone Charge ',99.99);
  numerrors=numerrors+checknumberentry('MLTIUSECON','Consumer Multiuse Charge ',99.99);
  numerrors=numerrors+checknumberentry('CREDITLIM','Customer Credit limit ',999999.99);
  numerrors=numerrors+checkdatefmt('CREDITEXP','credit expire ');
  document.getElementById('PAFNUM').style.color='black';
  numerrors=numerrors+checkdatefmt('PAFEXP','PAF expiration ');
  numerrors=numerrors+checkemail('NCOAEMAIL','NCOA Email');
  document.getElementById('OLD_ID').style.color='black';
  document.getElementById('SOURCE').style.color='black';
  //document.getElementById('mcustid').style.color='black';

  // these edits will update primary contact 
  document.getElementById('CONTACTL1').style.color='black';

  //document.getElementById('CL1_EMAIL').style.color='black';
  //numerrors=numerrors+checkemail('CL1_EMAIL','Main Contact Email');
  document.getElementById('P_LDL1').style.color='black';
  document.getElementById('P_ACL1').style.color='black';
  document.getElementById('P_NUMBERL1').style.color='black';
  document.getElementById('P_EXTL1').style.color='black';
  document.getElementById('F_LDL1').style.color='black';
  document.getElementById('F_ACL1').style.color='black';
  document.getElementById('F_NUMBERL1').style.color='black';

  // these edits will update comments table
  document.getElementById('COMMENTL').style.color='black';
  document.getElementById('COMMENTD').style.color='black';
  document.getElementById('COMMENTA').style.color='black';
  
  // do not check clintid -- document.getElementById('blcid').value;

   //added a check to phonenumbers
  numerrors=numerrors+checkph('P_NUMBERL1','Primary phone number ');
  numerrors=numerrors+checkph('F_NUMBERL1','Primary fax number ');
  
  
  
  // businesslist updates
 
  numerrors=numerrors+checknumberentry('blokvoltrigger','Bus Lst Max-Daily Records ',99999999);
  numerrors=numerrors+checknumberentry('blokamttrigger','Bus Lst 24 Hour Amount Limit ',99999999);
  numerrors=numerrors+checknumberentry('bloknumorderstrigger','Bus Lst Max-Daily Orders ',99999999);
  numerrors=numerrors+checknumberentry('blmin_order','Bus Lst Min Order ',999.99); 
  numerrors=numerrors+checknumberentry('blpkg1_single','Bus Lst Basic Single Use ',999.99);
  numerrors=numerrors+checknumberentry('blpkg1_yr','Bus Lst Basic Basic - 1 Yr ',999.99); 
  numerrors=numerrors+checknumberentry('blpkg2_yr','Bus Lst Full List - 1 Yr ',999.99);
  numerrors=numerrors+checknumberentry('blp1Sd1v','Bus Lst Basic Discount #1 Volume ',99999999);
  numerrors=numerrors+checknumberentry('blp1Sd1a','Bus Lst Basic Discount #1 Amount ',999.99);
  numerrors=numerrors+checknumberentry('blp1Sd2v','Bus Lst Basic Discount #2 Volume ',99999999);
  numerrors=numerrors+checknumberentry('blp1Sd2a','Bus Lst Basic Discount #2 Amount ',999.99);
  numerrors=numerrors+checknumberentry('blp1Yd1v','Bus Lst Basic/ 1yr Discount #1 Volume ',99999999);
  numerrors=numerrors+checknumberentry('blp1Yd1a','Bus Lst Basic/ 1yr Discount #1 Amount ',999.99);
  numerrors=numerrors+checknumberentry('blp1Yd2v','Bus Lst Basic/ 1yr Discount #2 Volume ',99999999);
  numerrors=numerrors+checknumberentry('blp1Yd2a','Bus Lst Basic/ 1yr Discount #2 Amount ',999.99);
  numerrors=numerrors+checknumberentry('blp2Yd1v','Bus Lst Full List Discount #1 Volume ',99999999);
  numerrors=numerrors+checknumberentry('blp2Yd1a','Bus Lst Full List Discount #1 Amount ',999.99);
  numerrors=numerrors+checknumberentry('blp2Yd2v','Bus Lst Full List Discount #2 Volume ',99999999);
  numerrors=numerrors+checknumberentry('blp2Yd2a','Bus Lst Full List Discount #2 Amount ',999.99);
  numerrors=numerrors+checknumberentry('blitememphrprice','Bus Lst select item Emply (loc) ',99.99);
  numerrors=numerrors+checknumberentry('blitememptotprice','Bus Lst select item Emply Total ',99.99);
  numerrors=numerrors+checknumberentry('blitemownsprice','Bus Lst select item Owns/Rents ',99.99);
  numerrors=numerrors+checknumberentry('blitemsiteprice','Bus Lst select item HQ/BR/Sgl ',99.99);
  numerrors=numerrors+checknumberentry('blitemfranprice','Bus Lst select item Franchise ',99.99);
  numerrors=numerrors+checknumberentry('blitemcorpprice','Bus Lst select item Corp Status ',99.99);
  numerrors=numerrors+checknumberentry('blitemyrprice','Bus Lst select item Year Started ',99.99);
  numerrors=numerrors+checknumberentry('blitemmanuprice','Bus Lst select item Manufacturing ',99.99);
  numerrors=numerrors+checknumberentry('blitemtickerprice','Bus Lst select item Stock Ticker ',99.99);
  numerrors=numerrors+checknumberentry('blitempubpriprice','Bus Lst select item Public/Private ',99.99);
  numerrors=numerrors+checknumberentry('blitemsalesprice','Bus Lst select item Sales Volume ',99.99);
  numerrors=numerrors+checknumberentry('blitemsqfootprice','Bus Lst select item Sq Footage ',99.99);
  numerrors=numerrors+checknumberentry('blitemnumpcprice','Bus Lst select item Number of PCs ',99.99);
  numerrors=numerrors+checknumberentry('blitemteleprice','Bus Lst select item Telephone ',99.99);
  numerrors=numerrors+checknumberentry('blitemcontactprice','Bus Lst select item Main Contact ',99.99);
  numerrors=numerrors+checknumberentry('bloneuplblprice','Bus Lst 1Up P/S /M ',99.99);
  numerrors=numerrors+checknumberentry('blfouruplblprice','Bus Lst 4Up P/S /M ',99.99);
  numerrors=numerrors+checknumberentry('blcdprice','Bus Lst CD Disk Charge ',99.99);
  numerrors=numerrors+checknumberentry('bldiskprice','Bus Lst Disk Charge ',99.99);
  numerrors=numerrors+checknumberentry('blseq10price','Bus Lst Segments 10 ',99.99);
  numerrors=numerrors+checknumberentry('blseq11price','Bus Lst Segments 11+ ',99.99);
  numerrors=numerrors+checknumberentry('bluspdiskprice','Bus Lst USPS Disk ',99.99);
  numerrors=numerrors+checknumberentry('blusplblprice','Bus Lst USPS Label ',99.99);
  numerrors=numerrors+checknumberentry('blemailprice','Bus Lst Email Charge ',99.99);
  numerrors=numerrors+checknumberentry('blcheshirelblprice','Bus Lst Cheshire /M ',99.99);

  // check these dates to make sure they are not past -PAFEXP,CREDITEXP,RETAILCERT,MLRA_DATE
  numerrors=numerrors+checkdate2('PAFEXP','PAF expire ');
  //numerrors=numerrors+checkdate2('CREDITEXP','credit expire ');
  //numerrors=numerrors+checkdate2('RETAILCERT','retail cert ');
  //numerrors=numerrors+checkdate2('MLRA_DATE','MLRA expire ');

  return numerrors;

}


// the folowing three httpobject calls are for saving each comment section separately if they test out
// to be smaller than 2kb- if they are lager than that then the first function calls a separate set of functions 
// that chunks the comments in 2kb blocks. Originally had these included in the update_cust file and then 
// moved to individual saves unencoded. could combine these a tighter two function or even just send all 
// through the large comment block. left like this for now.  

function updateCustcommL() {
  var mmaxblocks=0;
  var mnumblocks=0;
  var mmaxblocks=0;
  var sizeoffiles=0;

  s = new Array();
  s[0] = "mcomml";
  s[1] =document.getElementById('mcustid').value;
  s[2] =trim(document.getElementById('COMMENTL').value);

  //escape chars
  s[2]=s[2].replace(/\"/g,"zdblq");
  s[2]=s[2].replace(/\'/g,"zpos");
  s[2]=s[2].replace(/\$/g,"zdol");

  s[2] =xreplace(s[2],"\n","linefeed");
  s[3] =trim(document.getElementById('COMMENTL').value)+trim(document.getElementById('COMMENTD').value)+trim(document.getElementById('COMMENTA').value);  

  sizeoffiles=s[3].length;

  var updateurl = "includes/php/cc_update_custinfo_process_fox.php?mform="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();

  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g," ");
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
     s[myKey]=s[myKey].replace(/\&/g,"and"); 
     //s[myKey]=s[myKey].replace(/\'/g,""); 
    }

//alert(sizeoffiles);

  if (sizeoffiles < 100) {

    var usession = getmsession();
    // start save chain of httpobject calls
    http.open("GET", updateurl + s + "&usession=" +escape(usession), true);
    http.onreadystatechange = upcustcommLResponse;
    http.send(null);

  } else {

     //calculate and send first comment block 
     mmaxblocks=(s[2].length/100);
     mnumblocks=Math.round(mnumblocks);
     mmaxblocks=Math.round(mmaxblocks);
     mmaxblocks=mmaxblocks+1;
     savelrgcom(0,mmaxblocks,"L");

  }


}




//function for updating an edit

 function upcustcommLResponse() {

  if (http.readyState == 4) {
    results = http.responseText;
    //alert(results);
    updateCustcommD();
  }

}


function updateCustcommD() {
  s = new Array();
  s[0] = "mcommD";
  s[1] =document.getElementById('mcustid').value;
  s[2] =trim(document.getElementById('COMMENTD').value);
  
   //escape chars
  s[2]=s[2].replace(/\"/g,"zdblq");
  s[2]=s[2].replace(/\'/g,"zpos");
  s[2]=s[2].replace(/\$/g,"zdol");

  s[2] =xreplace(s[2],"\n","linefeed");

  var updateurl = "includes/php/cc_update_custinfo_process_fox.php?mform="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();

  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g," ");
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
     s[myKey]=s[myKey].replace(/\&/g,"and");
     //s[myKey]=s[myKey].replace(/\'/g,"");    
    }

  var usession = getmsession();
  http.open("GET", updateurl + s + "&usession=" +escape(usession), true);
  http.onreadystatechange = upcustcommDResponse;
  http.send(null);

}

//function for updating an edit

 function upcustcommDResponse() {

  if (http.readyState == 4) {
	  
    results = http.responseText;
    //updateCustcommA(); //removed the update for accounting notes
    //and added everything below from the comment A responce
    getAdd();
    hidewait();
    document.body.style.cursor='auto';

    //PER RANDY NO CONFIRM ON SAVE
    document.getElementById('confirmtext').innerHTML=results;
    removelock(document.getElementById('mcustid').value);
    //alert("here");
    getCinfo("N","N");
    //showconfirm();
    
  }

}

function updateCustcommA() {
  s = new Array();
  s[0] = "mcommA";
  s[1] =document.getElementById('mcustid').value;
  s[2] =trim(document.getElementById('COMMENTA').value);
   //escape chars
  s[2]=s[2].replace(/\"/g,"zdblq");
  s[2]=s[2].replace(/\'/g,"zpos");
  s[2]=s[2].replace(/\$/g,"zdol");

  s[2] =xreplace(s[2],"\n","linefeed");

  var updateurl = "includes/php/cc_update_custinfo_process_fox.php?mform="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();

  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g," ");
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
     s[myKey]=s[myKey].replace(/\&/g,"and");
     //s[myKey]=s[myKey].replace(/\'/g,"");
   
    }

  var usession = getmsession();
  http.open("GET", updateurl + s + "&usession=" +escape(usession), true);
  http.onreadystatechange = upcustcommAResponse;
  http.send(null);

}

//function for updating an edit

 function upcustcommAResponse() {

  if (http.readyState == 4) {
    results = http.responseText;

    getAdd();
    hidewait();
    document.body.style.cursor='auto';

    //PER RANDY NO CONFIRM ON SAVE
    document.getElementById('confirmtext').innerHTML=results;
    removelock(document.getElementById('mcustid').value);
    getCinfo("N","N");
    //showconfirm();

  }

}

//these functions call the fox exe update and then start the regular sav
function updateFoxCommL() {
 
// need to have 3 separate funtions because the call is redirecting to a coldfusion page for cfexecute
// to server will not return back structured content only echo pach call	
  s = new Array();
 
  s[1] =document.getElementById('mcustid').value;
  s[2] =trim(document.getElementById('COMMENTL').value);
  //esscape chars
  s[2]=s[2].replace(/\"/g,"zdblq");
  s[2]=s[2].replace(/\'/g,"zpos");
  s[2]=s[2].replace(/\$/g,"zdol");
  s[2]=s[2].replace(/\,/g,"`");
  s[2] =xreplace(s[2],"\n","linefeed");
 
  s[3]="L"
  
  var updateurl = "includes/php/cc_update_updateFoxCom_process_fox.php?mform="; // The server-side script
  
  
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g,"`");
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
     s[myKey]=s[myKey].replace(/\&/g,"and");     
   }

  var usession = getmsession();
  http.open("GET", updateurl + s + "&usession=" +escape(usession), true);
  http.onreadystatechange = updateFoxComLResponse;
  http.send(null);

}


function updateFoxComLResponse() {

  if (http.readyState == 4) {
    results = http.responseText;
    //alert(results);
    updateFoxCommD();
  }

}


function updateFoxCommD() {
 
// need to have 3 separate funtions because the call is redirecting to a coldfusion page for cfexecute
// to server will not return back structured content only echo pach call	
  s = new Array();
 
  s[1] =document.getElementById('mcustid').value;
  s[2] =trim(document.getElementById('COMMENTD').value);
  //esscape chars
  s[2]=s[2].replace(/\"/g,"zdblq");
  s[2]=s[2].replace(/\'/g,"zpos");
  s[2]=s[2].replace(/\$/g,"zdol");
  s[2]=s[2].replace(/\,/g,"`");
  s[2] =xreplace(s[2],"\n","linefeed");
 
  s[3]="D"
  
  var updateurl = "includes/php/cc_update_updateFoxCom_process_fox.php?mform="; // The server-side script
  
  
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g,"`");
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
     s[myKey]=s[myKey].replace(/\&/g,"and");     
   }

  var usession = getmsession();
 
  http.open("GET", updateurl + s + "&usession=" +escape(usession), true);
  http.onreadystatechange = updateFoxComDResponse;
  http.send(null);

}


function updateFoxComDResponse() {

  if (http.readyState == 4) {
    results = http.responseText;
    updateFoxCommA();
  }

}

function updateFoxCommA() {
  updateCustcommL();
  // need to have 3 separate funtions because the call is redirecting to a coldfusion page for cfexecute
  // to server will not return back structured content only echo pach call	
  //s = new Array();
 
  //s[1] =document.getElementById('mcustid').value;
  //s[2] =trim(document.getElementById('COMMENTA').value);
  //esscape chars
  //s[2]=s[2].replace(/\"/g,"zdblq");
  //s[2]=s[2].replace(/\'/g,"zpos");
  //s[2]=s[2].replace(/\$/g,"zdol");
  //s[2]=s[2].replace(/\,/g,"`");
  //s[2] =xreplace(s[2],"\n","linefeed");
 
  //s[3]="A"
  
  //var updateurl = "includes/php/cc_update_updateFoxCom_process_fox.php?mform="; // The server-side script
  
  
  //for(myKey in s)
   //if(s.propertyIsEnumerable(myKey)) {
     //s[myKey]=s[myKey].replace(/\,/g,"`");
     //s[myKey]=s[myKey].replace(/\^/g,"");
     //s[myKey]=s[myKey].replace(/\|/g,"");
     //s[myKey]=s[myKey].replace(/\&/g,"and");     
   //}

  //var usession = getmsession();
 
  //http.open("GET", updateurl + s + "&usession=" +escape(usession), true);
  //http.onreadystatechange = updateFoxComAResponse;
  //http.send(null);

}


function updateFoxComAResponse() {

  if (http.readyState == 4) {
    results = http.responseText;
    updateCustcommL();
  }

}

//address change funtions
function AddrChng() {

if (trim(document.getElementById('mcustid').value) !=""){

  var updateurl = "includes/php/cc_change_addr.php?mform="; // The server-side script
  var checkforErrors=0;


  document.body.style.cursor = "wait";
  showwait();

  checkforErrors=validAddrChng();


if (checkforErrors == 0) {
  s = new Array();

s[0] = trim(document.getElementById('new_conm').value);
s[1] = trim(document.getElementById('new_add1').value);
s[2] = trim(document.getElementById('new_city').value);
s[3] = trim(document.getElementById('new_st').value);
s[4] = trim(document.getElementById('new_zip').value);
s[5] = trim(document.getElementById('new_zip4').value);
s[6] = trim(document.getElementById('new_attn').value);
s[7] = trim(document.getElementById('new_email').value);
s[8] = trim(document.getElementById('new_ldd').value);
s[9] = trim(document.getElementById('new_fldd').value);
s[10] = trim(document.getElementById('new_acl').value);
s[11] = trim(document.getElementById('new_num').value);
s[12] = trim(document.getElementById('new_ext').value);
s[13] = trim(document.getElementById('new_facl').value);
s[14] = trim(document.getElementById('new_fnum').value);
  
  var onetrue=28;
  if (document.getElementById('new_PHYbox').checked == false) {
      s[15]= "N";
      onetrue=(onetrue-1);
  } else {s[15]= "Y"};
  
  if (document.getElementById('new_PRIMbox').checked == false) {
     s[16]= "N";
      onetrue=(onetrue-1);
  } else {s[16]= "Y"};

  if (document.getElementById('new_ACCTbox').checked == false) {
     s[17]= "N";
      onetrue=(onetrue-1);
  } else {s[17]= "Y"};

  if (document.getElementById('new_SHIPbox').checked == false) {
     s[18]= "N";
      onetrue=(onetrue-1);
  } else {s[18]= "Y"};

  if (document.getElementById('new_USERbox').checked == false) {
     s[19]= "N";
      onetrue=(onetrue-1);
  } else {s[19]= "Y"};

  if (document.getElementById('new_PHYnmbox').checked == false) {
     s[20]= "N";
      onetrue=(onetrue-1);
  } else {s[20]= "Y"};	

  if (document.getElementById('new_PRIMnmbox').checked == false) {
     s[21]= "N";
      onetrue=(onetrue-1);
  } else {s[21]= "Y"};

  if (document.getElementById('new_ACCTnmbox').checked == false) {
     s[22]= "N";
      onetrue=(onetrue-1);
  } else {s[22]= "Y"};

  if (document.getElementById('new_SHIPnmbox').checked == false) {
     s[23]= "N";
      onetrue=(onetrue-1);
  } else {s[23]= "Y"};

  if (document.getElementById('new_USERnmbox').checked == false) {
     s[24]= "N";
      onetrue=(onetrue-1);
  } else {s[24]= "Y"};

  if (document.getElementById('new_PRIMcontbox').checked == false) {
     s[25]= "N";
      onetrue=(onetrue-1);
  } else {s[25]= "Y"};

  if (document.getElementById('new_ACCTcontbox').checked == false) {
     s[26]= "N";
      onetrue=(onetrue-1);
  } else {s[26]= "Y"};

  if (document.getElementById('new_SHIPcontbox').checked == false) {
     s[27]= "N";
      onetrue=(onetrue-1);
  } else {s[27]= "Y"};

  if (document.getElementById('new_USERcontbox').checked == false) {
     s[28]= "N";
      onetrue=(onetrue-1);
  } else {s[28]= "Y"};

  if (document.getElementById('new_PRIMphtbox').checked == false) {
     s[29]= "N";
      onetrue=(onetrue-1);
  } else {s[29]= "Y"};

  if (document.getElementById('new_ACCTphbox').checked == false) {
     s[30]= "N";
      onetrue=(onetrue-1);
  } else {s[30]= "Y"};

  if (document.getElementById('new_SHIPphbox').checked == false) {
     s[31]= "N";
      onetrue=(onetrue-1);
  } else {s[31]= "Y"};	

  if (document.getElementById('new_USERphbox').checked == false) {
     s[32]= "N";
      onetrue=(onetrue-1);
  } else {s[32]= "Y"};

  if (document.getElementById('new_PRIMfaxbox').checked == false) {
     s[33]= "N";
      onetrue=(onetrue-1);
  } else {s[33]= "Y"};

  if (document.getElementById('new_ACCTfaxbox').checked == false) {
     s[34]= "N";
      onetrue=(onetrue-1);
  } else {s[34]= "Y"};

  if (document.getElementById('new_SHIPfaxbox').checked == false) {
     s[35]= "N";
      onetrue=(onetrue-1);
  } else {s[35]= "Y"};
  
  if (document.getElementById('new_USERfaxbox').checked == false) {
     s[36]= "N";
      onetrue=(onetrue-1);
  } else {s[36]= "Y"};

  
  if (document.getElementById('new_PRIMemailbox').checked == false) {
     s[37]= "N";
      onetrue=(onetrue-1);
  } else {s[37]= "Y"};

  if (document.getElementById('new_ACCTemailbox').checked == false) {
     s[38]= "N";
      onetrue=(onetrue-1);
  } else {s[38]= "Y"};

  if (document.getElementById('new_SHIPemailbox').checked == false) {
     s[39]= "N";
      onetrue=(onetrue-1);
  } else {s[39]= "Y"};
  
  if (document.getElementById('new_USERemailbox').checked == false) {
     s[40]= "N";
      onetrue=(onetrue-1);
  } else {s[40]= "Y"};

  
  if (document.getElementById('new_INVacctbox').checked == false) {
      s[41]= "N";
      onetrue=(onetrue-1);
  } else {s[41]= "Y"};
 
  
  if (document.getElementById('new_INVshipbox').checked == false) {
      s[42]= "N";
      onetrue=(onetrue-1);
  } else {s[42]= "Y"};

  if (onetrue==0){
	  
	hidewait();
    document.body.style.cursor='auto';
    document.getElementById('errorcnt').innerHTML="You must pick at leat one piece of information to change.";
    showemsg();  
    return null;	  
	  
  }	  
  s[0]=s[0].replace(/\,/g,"zcomma");
  s[0]=s[0].replace(/\'/g,"zpos");
  
  s[1]=s[1].replace(/\,/g,"zcomma");
  s[1]=s[1].replace(/\'/g,"zpos");
  
  s[2]=s[2].replace(/\'/g,"zpos");
  s[2]=s[2].replace(/\,/g,"zcomma");
  
  s[6]=s[6].replace(/\'/g,"zpos");
  s[6]=s[6].replace(/\,/g,"zcomma");
  
  
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g," ");
     s[myKey]=s[myKey].replace(/\^/g," ");
     s[myKey]=s[myKey].replace(/\|/g," ");
     s[myKey]=s[myKey].replace(/\'/g,"''");
    }
    
  //assign cust_id to end of array- I screwed up OK 
  s[43] = trim(document.getElementById('mcustid').value);

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = AddrChngResponse;
  http.send(null);

} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

// this is the end of the check for no custid

} else {

  document.getElementById('confirmtext').innerHTML="No account loaded.";
  showconfirm();
}

// no cust check


}


function AddrChngResponse() {

  if (http.readyState == 4) {
    results = http.responseText.split('^');
    
    //next 4 lns testing
    //alert(http.responseText);
    //hidewait();
    //document.body.style.cursor='auto';
    //return null
    
    
    //address is 8th element of return- 1-6 are which ones/only working with only wkng with phy now
    r1 = results[8].split('|');
    hidewait();
    document.body.style.cursor='auto';
      
    
    //0=return message/ 1=phy 2=prim 3=acct 4=ship 5=ship 6=invoice 7=inv shipping 
    if (trim(r1[0])!=''){document.getElementById('company').value=r1[0]};  
    if (trim(r1[1])!=''){document.getElementById('add1').value=r1[1]}; 
    if (trim(r1[2])!=''){document.getElementById('city').value=r1[2]};
    if (trim(r1[3])!=''){document.getElementById('st').value=r1[3]};
    if (trim(r1[4])!=''){document.getElementById('zip').value=r1[4]};
    if (trim(r1[5])!=''){document.getElementById('zip4').value=r1[5]};
    if (trim(r1[6])!=''){document.getElementById('CONTACTL1').value=r1[6]};
    if (trim(r1[7])!=''){document.getElementById('CL1_EMAIL').value=r1[7]};
      
        
    
    
    document.getElementById('confirmtext').innerHTML=results[0];
    showconfirm();
    
  }

}


function validAddrChng() {

 var numerrors=0;
 document.getElementById('emsg').innerHTML="";
 document.getElementById('errorcnt').innerHTML="";
 numchk="";

 document.getElementById('new_add1').style.color='black';
 //numerrors=numerrors+blankchk('new_add1','New Address');
 
 document.getElementById('new_city').style.color='black';
 //numerrors=numerrors+blankchk('new_city','New City');

 document.getElementById('new_st').style.color='black';
 //numerrors=numerrors+blankchk('new_st','New State');
 
 numerrors=numerrors+checkzip('new_zip','New Zip');
 //numerrors=numerrors+blankchk('new_zip','New Zip');
 
 //numerrors=numerrors+blankchk('new_zip4','Zip plus 4 code');
 numerrors=numerrors+checknumberentry('new_zip4','Zip plus 4 code ',9999);
 
 return numerrors;

}

function addrbindboxes(){
	
//s[7] = trim(document.getElementById('new_email').value);
 
  if (trim(document.getElementById('new_conm').value) !=''){
    document.getElementById('new_PHYnmbox').checked = true;
    document.getElementById('new_PRIMnmbox').checked = true;
    document.getElementById('new_ACCTnmbox').checked = true;
    document.getElementById('new_SHIPnmbox').checked = true;
    document.getElementById('new_USERnmbox').checked = true;
  } else {
	document.getElementById('new_PHYnmbox').checked = false;
    document.getElementById('new_PRIMnmbox').checked = false;
    document.getElementById('new_ACCTnmbox').checked = false;
    document.getElementById('new_SHIPnmbox').checked = false;
    document.getElementById('new_USERnmbox').checked = false;
  }    
  
  if (trim(document.getElementById('new_attn').value)	 !=''){  
    document.getElementById('new_PRIMcontbox').checked = true;
    document.getElementById('new_ACCTcontbox').checked = true;
    document.getElementById('new_SHIPcontbox').checked = true;
    document.getElementById('new_USERcontbox').checked = true;
  } else {
    document.getElementById('new_PRIMcontbox').checked = false;
    document.getElementById('new_ACCTcontbox').checked = false;
    document.getElementById('new_SHIPcontbox').checked = false;
    document.getElementById('new_USERcontbox').checked = false;
  } 
     
  if (trim(document.getElementById('new_num').value) !=''){	    
    document.getElementById('new_PRIMphtbox').checked = true;
    document.getElementById('new_ACCTphbox').checked = true;
    document.getElementById('new_SHIPphbox').checked = true;
    document.getElementById('new_USERphbox').checked = true;
  } else {
	document.getElementById('new_PRIMphtbox').checked = false;
    document.getElementById('new_ACCTphbox').checked = false;
    document.getElementById('new_SHIPphbox').checked = false;
    document.getElementById('new_USERphbox').checked = false;
  }    
	  
  if (trim(document.getElementById('new_fnum').value)  !=''){ 
    document.getElementById('new_PRIMfaxbox').checked = true;
    document.getElementById('new_ACCTfaxbox').checked = true;
    document.getElementById('new_SHIPfaxbox').checked = true;
    document.getElementById('new_USERfaxbox').checked = true;
  } else {
    document.getElementById('new_PRIMfaxbox').checked = false;
    document.getElementById('new_ACCTfaxbox').checked = false;
    document.getElementById('new_SHIPfaxbox').checked = false;
    document.getElementById('new_USERfaxbox').checked = false;
  }	
  
  if (trim(document.getElementById('new_email').value)  !=''){ 	  
    document.getElementById('new_PRIMemailbox').checked = true;
    document.getElementById('new_ACCTemailbox').checked = true;
    document.getElementById('new_SHIPemailbox').checked = true;
    document.getElementById('new_USERemailbox').checked = true;
  } else {
    document.getElementById('new_PRIMemailbox').checked = false;
    document.getElementById('new_ACCTemailbox').checked = false;
    document.getElementById('new_SHIPemailbox').checked = false;
    document.getElementById('new_USERemailbox').checked = false;
  }	
  
 var tempstring="";
 tempstring=trim(document.getElementById('new_add1').value);
 tempstring=tempstring+trim(document.getElementById('new_city').value);
 tempstring=tempstring+trim(document.getElementById('new_st').value);
 tempstring=tempstring+trim(document.getElementById('new_zip').value);
 tempstring=tempstring+trim(document.getElementById('new_zip4').value);
 
  if (trim(tempstring) !=''){ 
	document.getElementById('new_PHYbox').checked = true;  
    document.getElementById('new_PRIMbox').checked = true;
    document.getElementById('new_ACCTbox').checked = true;
    document.getElementById('new_SHIPbox').checked = true;
    document.getElementById('new_USERbox').checked = true;
  } else {
	document.getElementById('new_PHYbox').checked = false;  
    document.getElementById('new_PRIMbox').checked = false;
    document.getElementById('new_ACCTbox').checked = false;
    document.getElementById('new_SHIPbox').checked = false;
    document.getElementById('new_USERbox').checked = false;
  }	
 
   
}	



function initalcust(theid){
	//alert(theid);
	if (trim(theid) != ""){
	  document.getElementById("mid").value=theid;
	  document.forms['custcareform'].mcust.options.length = 0;
	  getCinfo('N');
    } else {
	  hidewait();
      document.body.style.cursor='auto';  
	  return null;    
    }    
}

// the next two functions retrieve the customer information
function getCinfo(lockrecord,lockonly,acctsync) {

//reset this in case it was change during a client pull
document.getElementById('mcust').style.width='286px'; 

  var mlockonly=lockonly;
  var setedit=lockrecord;
  var url = "includes/php/cc_get_custinfo_process.php?mid="; // The server-side script
  document.forms['custcareform'].tkselect.options.length = 0;
  // custid to unlock
  var previd=document.getElementById('mcustid').value;
  var lkuser=document.getElementById('uname').value;
  if (mlockonly != "Y") {clrFields()};
  
  //showcust(1);
  if (document.getElementById('ucoid').value=="CIS"){
    showcust(1);
  } else {
	showcust(5);  
  }	 
  
  shownote(1);
  document.body.style.cursor = "wait";
  showwait();  
  
  var midValue="";
  
  if (acctsync=="YES"){
     var acctngTest=document.getElementById('acctng_mid').value.toUpperCase();
     if (trim(acctngTest) != ""){
   	   midValue = trim(acctngTest); 
     } 	
  } else {	  
	 midValue = document.getElementById("mid").value; 
  }	  
    
  var usession = getmsession();
  http.open("GET", url + escape(midValue) + "&pid=" + escape(previd) + "&mlockonly=" + escape(mlockonly) + "&lku=" + escape(lkuser)+ "&usession=" +escape(usession)+ "&isedit=" +escape(setedit), true);
  http.onreadystatechange = getCustomerInfoResponse;
  http.send(null);

}

function getCustomerInfoResponse() {

  if (http.readyState == 4) {
    
	//test  
	//alert(http.responseText);
    //hidewait();
    //document.body.style.cursor='auto';
    
    //test for fiel update
    var updatetest = http.responseText;
    //alert("in cust responce " +updatetest);
    if (updatetest !="LOCKONLY"){

	    // Split the comma delimited response into an array
	    mainresults = http.responseText.split("^");
	    results= new Array();
	
	    results = mainresults[0].split("|");
	 
	//lets re-input search id in case job_id was used
	if (results[56]) {document.getElementById('mid').value= results[56]};
	
	
	
	
	//Record not found 
	if (results[0].substring(0,10) == 'Record not') {
		
		 hidewait();
         document.body.style.cursor='auto';
	     document.getElementById('company').value =' ';
	     document.getElementById('confirmtext').innerHTML=results[0];   //'not found or locked by another user.';
	     showconfirm();
	     return null;
	} else {
	
	//alert(http.responseText);
	//return null;

	    lockarray= new Array();
	    lockarray = mainresults[1].split("|");
	
	//alert(lockarray[5]);
	if (trim(lockarray[3])=="Y"){
      document.getElementById('flashedscr').style.visibility =  "visible";
      
      //changed 12/04/12 to bring up 3rd map editor
      //if (trim(lockarray[4])=="Y"){
	      //document.getElementById('flash_edbox').checked = true;
      //} else {
	      //document.getElementById('flash_edbox').checked = false; 
      //}  
            
	  if (lockarray[4].substring(0,6) !="Object") {
		  document.getElementById('flash_ed').value = trim(lockarray[4]);
		  document.getElementById('flash_ed_sav').value = trim(lockarray[4]);
	  } else {
		  document.getElementById('flash_ed').value ='';
		  document.getElementById('flash_ed_sav').value ="";
	  }
	      
    } else {
	  document.getElementById('flashedscr').style.visibility =  "hidden";  
    }    	
    
    
    //alow mktng- this is the allowmktng box as it was tacked on to the end of the return string
	if (lockarray[5].substring(0,6) !="Object") {
	    if (lockarray[5].substring(0,1) == 'N') {
	        document.getElementById("allow_mktng").checked = false;
	    } else {document.getElementById('allow_mktng').checked = true};
	
	} else {document.getElementById('allow_mktng').checked = false};

	
     //alow mktng- this is the TREND box as it was tacked on to the end of the return string
	if (lockarray[6].substring(0,6) !="Object") {
	    if (lockarray[6].substring(0,1) == 'N') {
	        document.getElementById("trend_box").checked = false;
	    } else {document.getElementById('trend_box').checked = true};
	
	} else {document.getElementById('trend_box').checked = false};
	
	
	 //alow mktng- this is the PROSPECT box as it was tacked on to the end of the return string
	if (lockarray[7].substring(0,6) !="Object") {
	    if (lockarray[7].substring(0,1) != 'Y') {
	        document.getElementById("PROSPECTbox").checked = false;
	    } else {document.getElementById('PROSPECTbox').checked = true};
	
	} else {document.getElementById('PROSPECTbox').checked = false};
	
	
	if (lockarray[8].substring(0,6) !="Object") {document.getElementById('dun_match').value = lockarray[8];} else {document.getElementById('dun_match').value =''};
	if (lockarray[9].substring(0,6) !="Object") {document.getElementById('duns_nmbr').value = lockarray[9];} else {document.getElementById('duns_nmbr').value =''};
	if (lockarray[10].substring(0,6) !="Object") {document.getElementById('dun_sic').value = lockarray[10];} else {document.getElementById('dun_sic').value =''};
	if (lockarray[11].substring(0,6) !="Object") {document.getElementById('dun_sic_desc').value = lockarray[11];} else {document.getElementById('dun_sic_desc').value =''};
	if (lockarray[12].substring(0,6) !="Object") {document.getElementById('dun_name').value = lockarray[12];} else {document.getElementById('dun_name').value =''};
	if (lockarray[13].substring(0,6) !="Object") {document.getElementById('dun_add1').value = lockarray[13];} else {document.getElementById('dun_add1').value =''};
    if (lockarray[14].substring(0,6) !="Object") {document.getElementById('dun_city').value = lockarray[14];} else {document.getElementById('dun_city').value =''};
	if (lockarray[15].substring(0,6) !="Object") {document.getElementById('dun_st').value = lockarray[15];} else {document.getElementById('dun_st').value =''};
	if (lockarray[16].substring(0,6) !="Object") {document.getElementById('dun_zip').value = lockarray[16];} else {document.getElementById('dun_zip').value =''};
	if (lockarray[17].substring(0,6) !="Object") {document.getElementById('dun_zip4').value = lockarray[17];} else {document.getElementById('dun_zip4').value =''};
	if (lockarray[18].substring(0,6) !="Object") {document.getElementById('dun_trade').value = lockarray[18];} else {document.getElementById('dun_trade').value =''};
	
		
    //lockarray[19] is the added status
	var mz68 = document.forms['custcareform'].thestatus.options.length;
	mz68=mz68-1;
	lockarray[19] = padRight(lockarray[19],' ',18);
	if (lockarray[19].substring(0,6) !="Object"){
	 
	 for (var i = 0; i < document.forms['custcareform'].thestatus.options.length; i++){
	    if ( trim(document.forms['custcareform'].thestatus.options[i].text) == trim(lockarray[19]) )
	    {
	      document.forms['custcareform'].thestatus.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].thestatus.options[mz68].selected = true};
	
	if (trim(lockarray[19]) == "") { document.forms['custcareform'].thestatus.options[mz68].selected = true};
		
	
	
	 //lockarray[20] is the added schema
	var mz69 = document.forms['custcareform'].schemadefine.options.length;
	mz69=mz69-1;
	lockarray[20] = trim(lockarray[20]);
	if (lockarray[20].substring(0,6) !="Object"){
	 
	 for (var i = 0; i < document.forms['custcareform'].schemadefine.options.length; i++){
	    if ( trim(document.forms['custcareform'].schemadefine.options[i].value) == trim(lockarray[20]) )
	    {
	      document.forms['custcareform'].schemadefine.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].schemadefine.options[mz69].selected = true};
	
	if (trim(lockarray[20]) == "") { document.forms['custcareform'].schemadefine.options[mz69].selected = true};
		
	
	//lockarray[21] is the added DAOAbox
	if (lockarray[21].substring(0,6) !="Object") {
	    if (lockarray[21].substring(0,1) == 'Y') {
	        document.getElementById("DSOAbox").checked = true;
	    } else {document.getElementById('DSOAbox').checked = false};
	
	} else {document.getElementById('DSOAbox').checked = false};
		
	
	//alert("status:"+lockarray[19]);
	
	//lockarray[20] is the added survey results
	
	var sresults = lockarray[22].split("~");
    
    var s1= new Array();
    document.forms['custcareform'].surveys.options.length = 0;
    var opnum=0;    
    for (x in sresults){
	        
    s1 = sresults[x].split("`");
     
    if (trim(s1[0]) != ""){
	  if (s1[0] !=null) {
        if (typeof s1[0] != "undefined"){ 
	        
	       if (opnum==0){
		     
		     document.forms['custcareform'].surveys.options[0] = new Option("Select a survey from the list to review.","No Survey",true,false);
		     opnum += 1;
		    
	       }    
		         
           document.forms['custcareform'].surveys.options[opnum] = new Option(s1[1],s1[2],true,false);
           opnum +=1;
           
         }
      }   
         
     }   
     
    }
    
    if (document.forms['custcareform'].surveys.options.length == 0){
       document.forms['custcareform'].surveys.options[0] = new Option("Customer has not been sent any surveys.","No Survey",true,false);
    }   
	
	//alert("surveys:"+lockarray[20]);
		
	
	
	    if (lockarray[0]=="Y"){
	       
	       if (lockarray[1]=="Y"){
	
	           setEditYes();
	
	           //TOOK OUT MESSAGE CONFIRMING LOCK 
	           //document.getElementById('confirmtext').innerHTML="Record is locked for editing";
	           //showconfirm();
	           
	
	       } else {
	
	           setEditNo();
	           
	           //not exiting out because still need to load just no edit
	           //hidewait();
               //document.body.style.cursor='auto';
	           document.getElementById('confirmtext').innerHTML="Unable to lock record, it is currently locked by "+lockarray[2];
	           showconfirm();
	           // return null;
	
	       }

	    } else {
	      setEditNo();
	      //alert("Request was read only.");
	    }
	
	 //set it up
	 resetFieldColors();
	 for (t in results)
	    {
	      results[t]=trim(results[t]);
	    }
	
	
	if (results[0].substring(0,1) == ' ') {
		hidewait();
		
		 document.getElementById('company').value =' ';
	     document.getElementById('confirmtext').innerHTML='No Records Found.';
	     showconfirm();
	     
	}
	
	results[0]=results[0].replace(/\zpos/g,"\'");
	
	if (results[0].substring(0,6) !="Object") {document.getElementById('company').value = results[0];} else {document.getElementById('company').value ='';alert('No Records Found.');};
	if (results[1].substring(0,6) !="Object") {document.getElementById('add1').value = results[1];} else {document.getElementById('add1').value =''};
	if (results[2].substring(0,6) !="Object") {document.getElementById('CITY').value = results[2];} else {document.getElementById('CITY').value =''};
	if (results[3].substring(0,6) !="Object") {document.getElementById('ST').value = results[3];} else {document.getElementById('ST').value =''};
	if (results[4].substring(0,6) !="Object") {document.getElementById('ZIP').value = results[4];} else {document.getElementById('ZIP').value =''};
	if (results[4].substring(0,6) !="Object") {document.getElementById('ZIP4').value = results[5];} else {document.getElementById('ZIP4').value =''};
	
	
	//RESULTS[6] IS SHIPPING FIELD
	var mz3 = document.forms['custcareform'].mship.options.length;
	mz3=mz3-1;
	results[6] = padRight(results[6],' ',15);
	if (results[6].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].mship.options.length; i++) 
	 {
	    if (document.forms['custcareform'].mship.options[i].text.substring(0,15)==results[6].substring(0,15))
	    {
	       document.forms['custcareform'].mship.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].mship.options[mz3].selected = true};
	
	if (results[6].substring(0,1) == " ") {document.forms['custcareform'].mship.options[mz3].selected = true};
	
	
	//document.getElementById('COD').value = results[7];
	
	
	//RESULTS[8] IS terms FIELD
	var mz4 = document.forms['custcareform'].mterms.options.length;
	mz4=mz4-1;
	results[8] = padRight(results[8],' ',11);
	if (results[8].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].mterms.options.length; i++) 
	 {
	    if (document.forms['custcareform'].mterms.options[i].text.substring(0,11)==results[8].substring(0,11))
	    {
	      document.forms['custcareform'].mterms.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].mterms.options[mz4].selected = true};
	
	if (results[8].substring(0,1) ==" ") {document.forms['custcareform'].mterms.options[mz4].selected = true};
	
	// field9" MLRA
	if (results[9].substring(0,6) !="Object") {
	    if (results[9].substring(0,1) == 'Y') {
	        document.getElementById("MLRAbox").checked = true;
	    } else {document.getElementById('MLRAbox').checked = false};
	
	} else {document.getElementById('MLRAbox').checked = false};
	
	// convert yyyymmdd to date display
	if (results[10].length > 6){results[10]=results[10].charAt(4)+results[10].charAt(5)+"/"+results[10].charAt(6)+results[10].charAt(7)+"/"+results[10].charAt(2)+results[10].charAt(3)};
	if (results[10].substring(0,6) !="Object"){
	  if (results[10].substring(0,5) !="12:00"){
	    document.getElementById('MLRA_DATE').value = results[10];
	  } else {document.getElementById('MLRA_DATE').value =''}; 
	} else {document.getElementById('MLRA_DATE').value =''};
	
	//if (results[11].substring(0,6) !="Object") {document.getElementById('LSTCNTPRIM').value = results[11];} else {document.getElementById('LSTCNTPRIM').value =''};
	
	//TAXABLE FIELD
	if (results[12].substring(0,6) !="Object") {
	    if (results[12].substring(0,1) == 'Y') {
	        document.getElementById("TAXABLEbox").checked = true;
	    } else {document.getElementById('TAXABLEbox').checked = false};
	
	} else {document.getElementById('TAXABLEbox').checked = false};
	 
	
	
	// convert yyyymmdd to date display
	if (results[13].length > 6){results[13]=results[13].charAt(4)+results[13].charAt(5)+"/"+results[13].charAt(6)+results[13].charAt(7)+"/"+results[13].charAt(2)+results[13].charAt(3)};
	if (results[13].substring(0,6) !="Object"){
	  if (results[13].substring(0,5) !="12:00"){
	    document.getElementById('RETAILCERT').value = results[13];
	  } else {document.getElementById('RETAILCERT').value =''}; 
	} else {document.getElementById('RETAILCERT').value =''};
	
	// field14 AUTORES
	if (results[14].substring(0,6) !="Object") {
	    if (results[14].substring(0,1) == 'Y') {
	        document.getElementById("AUTORESbox").checked = true;
	    } else {document.getElementById('AUTORESbox').checked = false};
	
	} else {document.getElementById('AUTORESbox').checked = false};
	     
	if (results[15].substring(0,6) !="Object") {document.getElementById('RESPRICE').value = results[15];} else {document.getElementById('RESPRICE').value =''};
	
	// field16 REVCHARGE
	if (results[16].substring(0,6) !="Object") {
	    if (results[16].substring(0,1) == 'Y') {
	        document.getElementById("REVCHARGEbox").checked = true;
	    } else {document.getElementById('REVCHARGEbox').checked = false};
	
	} else {document.getElementById('REVCHARGEbox').checked = false};
	     
	if (results[17].substring(0,6) !="Object") {document.getElementById('DELVREMAIL').value = results[17];} else {document.getElementById('DELVREMAIL').value =''};
	if (results[18].substring(0,6) !="Object") {document.getElementById('UPSNAME').value = results[18];} else {document.getElementById('UPSNAME').value =''};
	
	// field19" UPSRESID
	if (results[19].substring(0,6) !="Object") {
	    if (results[19].substring(0,1) == 'Y') {
	        document.getElementById("UPSRESIDbox").checked = true;
	    } else {document.getElementById('UPSRESIDbox').checked = false};
	
	} else {document.getElementById('UPSRESIDbox').checked = false};
	     
	
	// 20 is y/n for email and 21 is 'email' if 20 'Y'
	if (results[21].substring(0,6) !="Object") {
	    if (results[20].substring(0,1) == 'Y') {
	        document.getElementById("SHIPNOTYP1box").checked = true;
	    } else {document.getElementById('SHIPNOTYP1box').checked = false};
	
	} else {document.getElementById('SHIPNOTYP1box').checked = false};
	     
	
	if (results[22].substring(0,6) !="Object") {document.getElementById('SHIPNOEMA1').value = results[22];} else {document.getElementById('SHIPNOEMA1').value =''};
	if (results[23].substring(0,6) !="Object") {document.getElementById('SHIPPHONE').value = results[23];} else {document.getElementById('SHIPPHONE').value =''};
	
	//if (results[24].substring(0,6) !="Object") {document.getElementById('SRVCTYPE').value = results[24];} else {document.getElementById('SRVCTYPE').value =''};
	// field 24 is UPS service type- select box
	var mz =0
	if (results[24].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].SRVCTYPE.options.length; i++) 
	 {
		 
		if (trim(document.forms['custcareform'].SRVCTYPE.options[i].text)==trim(results[24]))
	    {
	      document.forms['custcareform'].SRVCTYPE.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].SRVCTYPE.options[0].selected = true};
	
	
	if (results[24].substring(0,1) ==" ") {document.forms['custcareform'].SRVCTYPE.options[0].selected = true};
	
	if (document.getElementById('SRVCTYPE').selectedIndex==-1){
	   	document.getElementById('SRVCTYPE').selectedIndex=0;
    }
	
	// field 25 is ARFILETYPE- select box
	var mz = document.forms['custcareform'].filetype.options.length;
	mz=mz-1;
	results[25] = padRight(results[25],' ',30);
	if (results[25].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].filetype.options.length; i++) 
	 {
		 
		// this may be able to be change to trim- when I manually added a type it needed to contain spaces to the end 
		if (document.forms['custcareform'].filetype.options[i].text.substring(0,30)==results[25].substring(0,30))
		//if (trim(document.forms['custcareform'].filetype.options[i].text)==trim(results[25]))
	    {
	      document.forms['custcareform'].filetype.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].filetype.options[mz].selected = true};
	
	if (results[25].substring(0,1) ==" ") {document.forms['custcareform'].filetype.options[mz].selected = true};
	
	
	// 26 is W/R for wholesale or retail
	if (results[26].substring(0,6) !="Object") {
	    if (results[26].substring(0,1) == 'W') {
	        document.getElementById("WHSLRETLbox").checked = true;
	    } else {document.getElementById('WHSLRETLbox').checked = false};
	
	} else {document.getElementById('WHSLRETLbox').checked = false};
	     
	if (results[27].substring(0,6) !="Object") {document.getElementById('MINCHARGE').value = results[27];} else {document.getElementById('MINCHARGE').value =''};
	if (results[28].substring(0,6) !="Object") {document.getElementById('EMAILFTP').value = results[28];} else {document.getElementById('EMAILFTP').value =''};
	if (results[29].substring(0,6) !="Object") {document.getElementById('OCCUCHARGE').value = results[29];} else {document.getElementById('OCCUCHARGE').value =''};
	
	// field30 EXTRACHARG
	if (results[30].substring(0,6) !="Object") {
	    if (results[30].substring(0,1) == 'Y') {
	        document.getElementById("EXTRACHARGbox").checked = true;
	    } else {document.getElementById('EXTRACHARGbox').checked = false};
	
	} else {document.getElementById('EXTRACHARGbox').checked = false};
	     
	
	// field31 NOINVOICE
	if (results[31].substring(0,6) !="Object") {
	    if (results[31].substring(0,1) == 'Y') {
	        document.getElementById("NOINVOICEbox").checked = true;
	    } else {document.getElementById('NOINVOICEbox').checked = false};
	
	} else {document.getElementById('NOINVOICEbox').checked = false};
	
	// field32 AUTOTAG
	if (results[32].substring(0,6) !="Object") {
	    if (results[32].substring(0,1) == 'Y') {
	        document.getElementById("AUTOTAGbox").checked = true;
	    } else {document.getElementById('AUTOTAGbox').checked = false};
	
	} else {document.getElementById('AUTOTAGbox').checked = false};
	
	
	// field 33 is TAGFORMAT- select box
	var mz2 = document.forms['custcareform'].tagformat.options.length;
	mz2=mz2-1;
	results[33] = padRight(results[33],' ',20);
	if (results[33].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].tagformat.options.length; i++) 
	 {
	    if (document.forms['custcareform'].tagformat.options[i].text.substring(0,20)==results[33].substring(0,20))
	    {
	      document.forms['custcareform'].tagformat.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].tagformat.options[mz2].selected = true};
	
	if (results[33].substring(0,1) ==" ") {document.forms['custcareform'].tagformat.options[mz2].selected = true};
	
	// 34 is y/n for TRAILER only
	if (results[34].substring(0,6) !="Object") {
	    if (results[34].substring(0,1) != 'Y') {
	        document.getElementById("TRAILERbox").checked = false;
	    } else {document.getElementById('TRAILERbox').checked = true};
	
	} else {document.getElementById('TRAILERbox').checked = false};
	
	
	// field35 PDFTAGS
	if (results[35].substring(0,6) !="Object") {
	    if (results[35].substring(0,1) == 'Y') {
	        document.getElementById("PDFTAGSbox").checked = true;
	    } else {document.getElementById('PDFTAGSbox').checked = false};
	
	} else {document.getElementById('PDFTAGSbox').checked = false};
	
	
	if (results[36].substring(0,6) !="Object") {document.getElementById('PDFCHARGE').value = results[36];} else {document.getElementById('PDFCHARGE').value =''};
	if (results[37].substring(0,6) !="Object") {document.getElementById('PDFTAGMIN').value = results[37];} else {document.getElementById('PDFTAGMIN').value =''};
	if (results[38].substring(0,6) !="Object") {document.getElementById('CONPRICE').value = results[38];} else {document.getElementById('CONPRICE').value =''};
	if (results[39].substring(0,6) !="Object") {document.getElementById('CONMIN').value = results[39];} else {document.getElementById('CONMIN').value =''};
	if (results[40].substring(0,6) !="Object") {document.getElementById('PLUS3CON').value = results[40];} else {document.getElementById('PLUS3CON').value =''};
	if (results[41].substring(0,6) !="Object") {document.getElementById('PLUSPHNCON').value = results[41];} else {document.getElementById('PLUSPHNCON').value =''};
	
	// field42 AUTOCON
	if (results[42].substring(0,6) !="Object") {
	    if (results[42].substring(0,1) == 'Y') {
	        document.getElementById("AUTOCONbox").checked = true;
	    } else {document.getElementById('AUTOCONbox').checked = false};
	
	} else {document.getElementById('AUTOCONbox').checked = false};
	
	if (results[43].substring(0,6) !="Object") {document.getElementById('MLTIUSECON').value = results[43];} else {document.getElementById('MLTIUSECON').value =''};
	
	// field44 TMTAGS
	if (results[44].substring(0,6) !="Object") {
	    if (results[44].substring(0,1) == 'Y') {
	        document.getElementById("TMTAGSbox").checked = true;
	    } else {document.getElementById('TMTAGSbox').checked = false};
	
	} else {document.getElementById('TMTAGSbox').checked = false};
	
	// 45 is y/n for NOCISDEF
	if (results[45].substring(0,6) !="Object") {
	    if (results[45].substring(0,1) != 'Y') {
	        document.getElementById("NOCISDEFbox").checked = false;
	    } else {document.getElementById('NOCISDEFbox').checked = true};
	
	} else {document.getElementById('NOCISDEFbox').checked = false};
	
	// 46 is y/n for ALLOWNOCIS
	if (results[46].substring(0,6) !="Object") {
	    if (results[46].substring(0,1) != 'Y') {
	        document.getElementById("ALLOWNOCISbox").checked = false;
	    } else {document.getElementById('ALLOWNOCISbox').checked = true};
	
	} else {document.getElementById('ALLOWNOCISbox').checked = false};
	
	if (results[47].substring(0,6) !="Object") {document.getElementById('CREDITLIM').value = results[47];} else {document.getElementById('CREDITLIM').value =''};
	
	// convert yyyymmdd to date display
	if (results[48].length > 6){results[48]=results[48].charAt(4)+results[48].charAt(5)+"/"+results[48].charAt(6)+results[48].charAt(7)+"/"+results[48].charAt(2)+results[48].charAt(3)};
	if (results[48].substring(0,6) !="Object"){
	  if (results[48].substring(0,5) !="12:00"){
	    document.getElementById('CREDITEXP').value = results[48];
	  } else {document.getElementById('CREDITEXP').value =''}; 
	} else {document.getElementById('CREDITEXP').value =''};
	
	
	if (results[49].substring(0,6) !="Object") {document.getElementById('PAFNUM').value = results[49];} else {document.getElementById('PAFNUM').value =''};
	
	// convert yyyymmdd to date display
	if (results[50].length > 6){results[50]=results[50].charAt(4)+results[50].charAt(5)+"/"+results[50].charAt(6)+results[50].charAt(7)+"/"+results[50].charAt(2)+results[50].charAt(3)};
	if (results[50].substring(0,6) !="Object"){
	  if (results[50].substring(0,5) !="12:00"){
	    document.getElementById('PAFEXP').value = results[50];
	  } else {document.getElementById('PAFEXP').value =''}; 
	} else {document.getElementById('PAFEXP').value =''};
	
	
	// 51 is y/n for NCOA only
	if (results[51].substring(0,6) !="Object") {
	    if (results[51].substring(0,1) == 'N') {
	        document.getElementById("NCOAONLYbox").checked = false;
	    } else {document.getElementById('NCOAONLYbox').checked = true};
	
	} else {document.getElementById('NCOAONLYbox').checked = false};
	
	
	if (results[52].substring(0,6) !="Object") {document.getElementById('NCOAEMAIL').value = results[52];} else {document.getElementById('NCOAEMAIL').value =''};
	
	// 53 is y/n for ALLOWNCOA
	if (results[53].substring(0,6) !="Object") {
	    if (results[53].substring(0,1) == 'Y') {
	        document.getElementById("ALLOWNCOAbox").checked = true;
	    } else {document.getElementById('ALLOWNCOAbox').checked = false};
	
	} else {document.getElementById('ALLOWNCOAbox').checked = false};
	
	if (results[54].substring(0,6) !="Object") {document.getElementById('OLD_ID').value = results[54];} else {document.getElementById('OLD_ID').value =''};
	if (results[55].substring(0,6) !="Object") {document.getElementById('SOURCE').value = results[55];} else {document.getElementById('SOURCE').value =''};
	
	//disabled this feature when moved to a tab/ 
	// only display if old_id starts with number
	
	//if (isNumeric(results[54].substring(0,1))) {
	//  document.getElementById('sourceln1').style.visibility =  "visible";
	//  document.getElementById('sourceln2').style.visibility =  "visible";
	//} else {
	//  document.getElementById('sourceln1').style.visibility =  "hidden";
	//  document.getElementById('sourceln2').style.visibility =  "hidden";
	//}
	
	if (results[56].substring(0,6) !="Object") {document.getElementById('mcustid').value = results[56];} else {document.getElementById('mcustid').value =''};
	if (results[57].substring(0,6) !="Object") {document.getElementById('CONTACTL1').value = results[57];} else {document.getElementById('CONTACTL1').value =''};
	if (results[58].substring(0,6) !="Object") {document.getElementById('CL1_EMAIL').value = results[58];} else {document.getElementById('CL1_EMAIL').value =''};
	if (results[59].substring(0,6) !="Object") {document.getElementById('P_LDL1').value = results[59];} else {document.getElementById('P_LDL1').value =''};
	if (results[60].substring(0,6) !="Object") {document.getElementById('P_ACL1').value = results[60];} else {document.getElementById('P_ACL1').value =''};
	if (results[61].substring(0,6) !="Object") {document.getElementById('P_NUMBERL1').value = results[61];} else {document.getElementById('P_NUMBERL1').value =''};
	if (results[62].substring(0,6) !="Object") {document.getElementById('P_EXTL1').value = results[62];} else {document.getElementById('P_EXTL1').value =''};
	if (results[63].substring(0,6) !="Object") {document.getElementById('F_LDL1').value = results[63];} else {document.getElementById('F_LDL1').value =''};
	if (results[64].substring(0,6) !="Object") {document.getElementById('F_ACL1').value = results[64];} else {document.getElementById('F_ACL1').value =''};
	if (results[65].substring(0,6) !="Object") {document.getElementById('F_NUMBERL1').value = results[65];} else {document.getElementById('F_NUMBERL1').value =''};

	//results[66]=results[66].replace(/\"/g,'\"');
	//results[66]=results[66].replace(/\''/g,"\'");
	//results[67]=results[67].replace(/\"/g,'\"');
	//results[67]=results[67].replace(/\''/g,"\'");
	//results[68]=results[68].replace(/\"/g,'\"');
	//results[68]=results[68].replace(/\''/g,"\'");

//alert(results[66].substring(0,2000));
//alert(results[66].substring(2001,4000));
//alert(results[66].substring(4001,6000));

	if (results[66].substring(0,6) !="Object") {document.getElementById('COMMENTL').value = results[66];} else {document.getElementById('COMMENTL').value =''};
	if (results[67].substring(0,6) !="Object") {document.getElementById('COMMENTD').value = results[67];} else {document.getElementById('COMMENTD').value =''};
	if (results[68].substring(0,6) !="Object") {document.getElementById('COMMENTA').value = results[68];} else {document.getElementById('COMMENTA').value =''};
	//alert(results[68]);
        // 69 is y/n for mls_cust
	if (results[69].substring(0,6) !="Object") {
	    if (results[69].substring(0,1) == 'N') {
	        document.getElementById("MLS_CUSTbox").checked = false;
	    } else {document.getElementById('MLS_CUSTbox').checked = true};
	
	} else {document.getElementById('MLS_CUSTbox').checked = false};

	if (results[70].substring(0,6) !="Object") {
	    if (results[70].substring(0,1) == 'N') {
	        document.getElementById("WORLD_MKTbox").checked = false;
	    } else {document.getElementById('WORLD_MKTbox').checked = true};
	
	} else {document.getElementById('WORLD_MKTbox').checked = false};

	
	
	if (results[71].substring(0,6) !="Object") {document.getElementById('PAFNUM2').value = results[71];} else {document.getElementById('PAFNUM2').value =''};
	
	// convert yyyymmdd to date display
	if (results[72].length > 6){results[72]=results[72].charAt(4)+results[72].charAt(5)+"/"+results[72].charAt(6)+results[72].charAt(7)+"/"+results[72].charAt(2)+results[72].charAt(3)};
	if (results[72].substring(0,6) !="Object"){
	  if (results[72].substring(0,5) !="12:00"){
	    document.getElementById('PAFEXP2').value = results[72];
	  } else {document.getElementById('PAFEXP2').value =''}; 
	} else {document.getElementById('PAFEXP2').value =''};
	
	
	shownote(1);
	

        }//end of lock
        
      //alert('just b4 gettm');   
      gettm(); //bottom run there
     } // end of lockonly condition	

    hidewait();
    document.body.style.cursor='auto';
    //alert('made it here 1');
    //hide delete button if no edit
    if (document.getElementById('EditEnabled').value=="N") {
       //alert('in lock conditional N');
       document.getElementById('deletebt').style.visibility = "hidden";
       document.getElementById('unlockbt').style.visibility = "hidden";
       document.getElementById('exportbutton').style.visibility = "hidden";
       document.getElementById('addchngbt').style.visibility = "hidden";
    } else {
       //alert('in lock conditional Y');
       document.getElementById('unlockbt').style.visibility = "visible";
       document.getElementById('deletebt').style.visibility = "visible";
       document.getElementById('exportbutton').style.visibility = "visible";
       document.getElementById('addchngbt').style.visibility = "visible";
    }
	//alert('made it here 2');

  } //end of ready state

}
// end of cust info retrieval
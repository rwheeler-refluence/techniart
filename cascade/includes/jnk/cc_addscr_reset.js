function resetaddscr() {
  if (document.getElementById('lognm').value != 'swhite'){
	document.getElementById('ADD_company').value="";
	document.getElementById('ADD_add1').value="";
	document.getElementById('ADD_CITY').value="";
	document.getElementById('ADD_ST').value="";
	document.getElementById('ADD_ZIP').value="";
	document.getElementById('ADD_ZIP4').value="";
	document.getElementById('ADD_whslretlbox').checked=false;

	document.forms['custcareform'].ADD_mterms.options[8].selected = true;
	document.forms['custcareform'].ADD_PRIMDEPT.options[0].selected = true;   
	document.forms['custcareform'].ADD_PRIMLOCATION.options[0].selected = true;



	document.getElementById('ADD_USERNAME').value="";
	document.getElementById('ADD_PASSWORD').value="";    

	document.getElementById('ADD_MAP_VIEWERbox').checked=true;


	document.getElementById('ADD_MLRAbox').checked=false;
	document.getElementById('ADD_MLRA_DATE').value="";
	document.getElementById('ADD_CREDITLIM').value="0.00";
	document.getElementById('ADD_CREDITEXP').value="";
	document.getElementById('ADD_DELVREMAIL').value="";
	document.getElementById('ADD_EMAILFTP').value="0.00";
	document.getElementById('ADD_RETAILCERT').value="";
	document.getElementById('ADD_primAttn').value="";
	document.getElementById('ADD_primAdd').value="";
	document.getElementById('ADD_primCITY').value="";
	document.getElementById('ADD_primST').value="";
	document.getElementById('ADD_primZIP').value="";
	document.getElementById('ADD_primZIP4').value="";
	document.getElementById('ADD_primEMAIL').value="";
	document.getElementById('ADD_primLDL').value="";
	document.getElementById('ADD_primACL').value="";
	document.getElementById('ADD_primNUMBER').value="";
	document.getElementById('ADD_primEXT').value="";
	document.getElementById('ADD_primFLDL').value="";
	document.getElementById('ADD_primFACL').value="";
	document.getElementById('ADD_primFNUMBER').value="";
	document.getElementById('ADD_acctAttn').value="";
	document.getElementById('ADD_acctAdd').value="";
	document.getElementById('ADD_acctCITY').value="";
	document.getElementById('ADD_acctST').value="";
	document.getElementById('ADD_acctZIP').value="";
	document.getElementById('ADD_acctZIP4').value="";
	document.getElementById('ADD_acctEMAIL').value="";
	document.getElementById('ADD_acctLDL').value="";
	document.getElementById('ADD_acctACL').value="";
	document.getElementById('ADD_acctNUMBER').value="";
	document.getElementById('ADD_acctEXT').value="";
	document.getElementById('ADD_acctFLDL').value="";
	document.getElementById('ADD_acctFACL').value="";
	document.getElementById('ADD_acctFNUMBER').value="";
	
	//document.getElementById('ADD_dun_match').value ="";  
	document.getElementById('ADD_duns_nmbr').value ="";  
	document.getElementById('ADD_dun_sic').value ="";  
	document.getElementById('ADD_dun_sic_desc').value="";  
	document.getElementById('ADD_dun_name').value =""; 
	document.getElementById('ADD_dun_add1').value =""; 
	document.getElementById('ADD_dun_city').value ="";  
	document.getElementById('ADD_dun_st').value ="";
	document.getElementById('ADD_dun_zip').value =""; 
	document.getElementById('ADD_dun_zip4').value ="";
	document.getElementById('ADD_dun_trade').value = "";
	document.getElementById('TMP_dun_sic').value ="";
	document.getElementById('TMP_dun_sic_desc').value ="";
	
	document.getElementById('primuseacctbox').checked=false;
	document.getElementById('primuseshipbox').checked=false;
	document.getElementById('ADD_PROSPECTbox').checked =false;
	document.forms['custcareform'].ADD_mship.options[0].selected = true;
	
	document.getElementById('ADD_SHIPNOTYP1box').checked=false;
	document.getElementById('ADD_UPSNAME').value="";
	document.getElementById('ADD_shipAttn').value="";
	document.getElementById('ADD_shipAdd').value="";
	//document.getElementById('shipusecompanybox').checked=false;   //this one changed to hidden field for now 
	document.getElementById('ADD_shipCITY').value="";
	document.getElementById('ADD_shipST').value="";
	document.getElementById('ADD_shipZIP').value="";
	document.getElementById('ADD_shipZIP4').value="";
	document.getElementById('ADD_UPSRESIDbox').checked=false;
	document.getElementById('ADD_shipEMAIL').value="";
	document.forms['custcareform'].ADD_SRVCTYPE.options[0].selected = true;
	
	document.getElementById('ADD_shipLDL').value="";
	document.getElementById('ADD_shipACL').value="";
	document.getElementById('ADD_shipNUMBER').value="";
	document.getElementById('ADD_shipEXT').value="";
	document.getElementById('ADD_shipFLDL').value="";
	document.getElementById('ADD_shipFACL').value="";
	document.getElementById('ADD_shipFNUMBER').value="";
	document.getElementById('ADD_AUTORESbox').checked=true;
	
	document.forms['custcareform'].ADD_filetype.options[0].selected = true;
	
	document.getElementById('ADD_RESPRICE').value="0.00";
	document.getElementById('ADD_MINCHARGE').value="0.00";
	
	document.getElementById('ADD_EXTRACHARGbox').checked=true;
	document.getElementById('ADD_REVCHARGEbox').checked=true;
	document.getElementById('ADD_AUTOCONbox').checked=false;
	document.getElementById('ADD_CONPRICE').value="0.00";
	document.getElementById('ADD_CONMIN').value="0.00";
	document.getElementById('ADD_PLUS3CON').value="0.00";
	document.getElementById('ADD_PLUSPHNCON').value="0.00";
	document.getElementById('ADD_MLTIUSECON').value="0.00";
	document.getElementById('ADD_TRAILERbox').checked=false;
	document.getElementById('ADD_NOCISDEFbox').checked=false;
	document.getElementById('ADD_ALLOWNOCISBOX').checked=false;
	document.getElementById('ADD_AUTOTAGbox').checked=false;
	document.getElementById('ADD_NOINVOICEbox').checked=false;
	document.getElementById('ADD_TMTAGSbox').checked=false;
	document.getElementById('ADD_PDFTAGSbox').checked=true;
	document.getElementById('ADD_OCCUCHARGE').value="0.00";
	
	document.forms['custcareform'].ADD_tagformat.options[0].selected = true;
	
	document.getElementById('ADD_PDFCHARGE').value="0.00";
	document.getElementById('ADD_PDFTAGMIN').value="0.00";
	document.getElementById('ADD_ALLOWNCOAbox').checked=false;
	document.getElementById('ADD_NCOAONLYbox').checked=false;
	document.getElementById('ADD_NCOAEMAIL').value="";
	document.getElementById('ADD_PAFNUM').value="";
	document.getElementById('ADD_PAFEXP').value="";
	document.getElementById('ADD_PAFNUM2').value="";
	document.getElementById('ADD_PAFEXP2').value="";
	document.getElementById('ADD_COMMENTL').value="";
	document.getElementById('ADD_COMMENTD').value="";
	document.getElementById('ADD_COMMENTA').value="";
	getDefaltPrices();

 } //end of check for swhite	
	
}



function resetaddscrRead() {
 
document.getElementById('ADD_company').readOnly =false;
document.getElementById('ADD_add1').readOnly =false;
document.getElementById('ADD_CITY').readOnly =false;
document.getElementById('ADD_ST').readOnly =false;
document.getElementById('ADD_ZIP').readOnly =false;
document.getElementById('ADD_ZIP4').readOnly =false;
document.getElementById('ADD_MAP_VIEWERbox').readOnly =false;

document.getElementById('ADD_USERNAME').readOnly =false;
document.getElementById('ADD_PASSWORD').readOnly =false;    
 
document.getElementById('ADD_MLRA_DATE').readOnly =false;
document.getElementById('ADD_CREDITLIM').readOnly =false;
document.getElementById('ADD_CREDITEXP').readOnly =false;
document.getElementById('ADD_DELVREMAIL').readOnly =false;
document.getElementById('ADD_EMAILFTP').readOnly =false;
document.getElementById('ADD_RETAILCERT').readOnly =false;
document.getElementById('ADD_primAttn').readOnly =false;
document.getElementById('ADD_primAdd').readOnly =false;
document.getElementById('ADD_primCITY').readOnly =false;
document.getElementById('ADD_primST').readOnly =false;
document.getElementById('ADD_primZIP').readOnly =false;
document.getElementById('ADD_primZIP4').readOnly =false;
document.getElementById('ADD_primEMAIL').readOnly =false;
document.getElementById('ADD_primLDL').readOnly =false;
document.getElementById('ADD_primACL').readOnly =false;
document.getElementById('ADD_primNUMBER').readOnly =false;
document.getElementById('ADD_primEXT').readOnly =false;
document.getElementById('ADD_primFLDL').readOnly =false;
document.getElementById('ADD_primFACL').readOnly =false;
document.getElementById('ADD_primFNUMBER').readOnly =false;
document.getElementById('ADD_acctAttn').readOnly =false;
document.getElementById('ADD_acctAdd').readOnly =false;
document.getElementById('ADD_acctCITY').readOnly =false;
document.getElementById('ADD_acctST').readOnly =false;
document.getElementById('ADD_acctZIP').readOnly =false;
document.getElementById('ADD_acctZIP4').readOnly =false;
document.getElementById('ADD_acctEMAIL').readOnly =false;
document.getElementById('ADD_acctLDL').readOnly =false;
document.getElementById('ADD_acctACL').readOnly =false;
document.getElementById('ADD_acctNUMBER').readOnly =false;
document.getElementById('ADD_acctEXT').readOnly =false;
document.getElementById('ADD_acctFLDL').readOnly =false;
document.getElementById('ADD_acctFACL').readOnly =false;
document.getElementById('ADD_acctFNUMBER').readOnly =false;

document.getElementById('ADD_UPSNAME').readOnly =false;
document.getElementById('ADD_shipAttn').readOnly =false;
document.getElementById('ADD_shipAdd').readOnly =false;
document.getElementById('ADD_shipCITY').readOnly =false;
document.getElementById('ADD_shipST').readOnly =false;
document.getElementById('ADD_shipZIP').readOnly =false;
document.getElementById('ADD_shipZIP4').readOnly =false;

document.getElementById('ADD_shipEMAIL').readOnly =false;

//document.getElementById('ADD_SRVCTYPE').readOnly =false;

document.getElementById('ADD_shipLDL').readOnly =false;
document.getElementById('ADD_shipACL').readOnly =false;
document.getElementById('ADD_shipNUMBER').readOnly =false;
document.getElementById('ADD_shipEXT').readOnly =false;
document.getElementById('ADD_shipFLDL').readOnly =false;
document.getElementById('ADD_shipFACL').readOnly =false;
document.getElementById('ADD_shipFNUMBER').readOnly =false;


document.getElementById('ADD_RESPRICE').readOnly =false;
document.getElementById('ADD_MINCHARGE').readOnly =false;
document.getElementById('ADD_CONPRICE').readOnly =false;
document.getElementById('ADD_CONMIN').readOnly =false;
document.getElementById('ADD_PLUS3CON').readOnly =false;
document.getElementById('ADD_PLUSPHNCON').readOnly =false;
document.getElementById('ADD_MLTIUSECON').readOnly =false;
document.getElementById('ADD_OCCUCHARGE').readOnly =false;


document.getElementById('ADD_PDFCHARGE').readOnly =false;
document.getElementById('ADD_PDFTAGMIN').readOnly =false;
document.getElementById('ADD_NCOAEMAIL').readOnly =false;
document.getElementById('ADD_PAFNUM').readOnly =false;
document.getElementById('ADD_PAFEXP').readOnly =false;
document.getElementById('ADD_PAFNUM2').readOnly =false;
document.getElementById('ADD_PAFEXP2').readOnly =false;
document.getElementById('ADD_COMMENTL').readOnly =false;
document.getElementById('ADD_COMMENTD').readOnly =false;
document.getElementById('ADD_COMMENTA').readOnly =false;


}
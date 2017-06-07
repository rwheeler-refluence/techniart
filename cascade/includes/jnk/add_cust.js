//function for updating an edit

 function addeditcustResponse() {
	 
  if (http.readyState == 4) {
    results = http.responseText;
    
    //hidewait();
    document.body.style.cursor='auto';

    if (results.indexOf("loadedtheaccount") > -1){
  	     alert("This customer info has been saved");
    } else {
	     alert('Error saving information, please try again. If the problem persist please call 1-800-632-1379 for assistance.');   
  	           
    }
        
  }

}

  			  
			  		
function addeditCust() {
  var updateurl = "includes/php/cust_process.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;
  
  var llen = document.getElementById('ADD_COMMENTL').value;
  var dlen = document.getElementById('ADD_COMMENTD').value;
  var alen = document.getElementById('ADD_COMMENTA').value;
 
  var mtext=llen+dlen+alen;
  var txtlen=mtext.length
  
  //alert(txtlen);
  if (txtlen > 512){
	  alert('Please limit the combined total of all comments to under a 500 characters, you can enter as much as needed under edit once account saved.    ');
      return null;
  }
    
  document.body.style.cursor = "wait";
  showwait();

//checkforErrors=validCustADD();

if (checkforErrors == 0) {

	
  var costr=trim(document.getElementById('ADD_company').value);
  costr=costr.replace(/\'/g,"zpos");
  costr=costr.replace(/\,/g,"zcomma");
  var costr2=costr.toUpperCase();
  
    s = new Array();

    //click past the numeric and or / and & signs letters
    var alphanm="";
    var templtr="";
    var x=0;
    var aplachars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for (var i = 0; i < costr2.length; i++) {
	    
       var templtr=costr2.charAt(i);
       
       var goodtogo=aplachars.indexOf(templtr);       
       if (goodtogo !=-1 && trim(templtr) !=""){ 
	     alphanm=alphanm+templtr;
       }
       
       if (alphanm.length==2){
	       break;
       }    
       
	   templtr="";    
        
    }

    
  //alert(alphanm); 
  //return null;
  
    
  s[0] = trim(alphanm);
  s[1] = costr;
  s[2] = document.getElementById('ADD_add1').value;
  s[3] = document.getElementById('ADD_CITY').value;
  s[4] = document.getElementById('ADD_ST').value;
  s[5] = document.getElementById('ADD_ZIP').value;
  s[6] = document.getElementById('ADD_ZIP4').value;

  if (document.getElementById('ADD_WHSLRETLBOX').checked == false) {
      s[7]= "R";
  } else {s[7]= "W"};

  var mindex = document.forms['custcareform'].ADD_mterms.selectedIndex;
  s[8] = document.forms['custcareform'].ADD_mterms.options[mindex].value;

 if (document.getElementById('ADD_MLRAbox').checked == false) {
      s[9]= "N";
  } else {s[9]= "Y"};

  // s[10] is a date and needs date conversion
  tdt=document.getElementById('ADD_MLRA_DATE').value;
  if (tdt.length > 6){
     yearstart="19";
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*");
     yrtst=tdt.charAt(7)+tdt.charAt(8);
     if (yrtst < 80) {yearstart="20"}; 
     s[10]= yearstart+tdt.charAt(6)+tdt.charAt(7)+tdt.charAt(0)+tdt.charAt(1)+tdt.charAt(3)+tdt.charAt(4);
  } else {s[10]= " "};


  s[11] = document.getElementById('ADD_CREDITLIM').value;
  if (s[11].length==0) { s[11]="0" }; 

  // s[12] is a date and needs date conversion
  tdt=document.getElementById('ADD_CREDITEXP').value;
  if (tdt.length > 6){
     var yearstart="19";
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*");
     yrtst=tdt.charAt(7)+tdt.charAt(8);
     if (yrtst < 80) {yearstart="20"}; 
     s[12]= yearstart+tdt.charAt(6)+tdt.charAt(7)+tdt.charAt(0)+tdt.charAt(1)+tdt.charAt(3)+tdt.charAt(4);
  } else {s[12]= " "};

  s[13] = document.getElementById('ADD_DELVREMAIL').value;
  s[14] = document.getElementById('ADD_EMAILFTP').value;

  // s[15] is a date and needs date conversion
  tdt=document.getElementById('ADD_RETAILCERT').value;
  if (tdt.length > 6){
     yearstart="19";
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*");
     yrtst=tdt.charAt(7)+tdt.charAt(8);
     if (yrtst < 80) {yearstart="20"}; 
     s[15]= yearstart+tdt.charAt(6)+tdt.charAt(7)+tdt.charAt(0)+tdt.charAt(1)+tdt.charAt(3)+tdt.charAt(4);
  } else {s[15]= " "};

  s[16] = document.getElementById('ADD_PRIMATTN').value;
  s[17] = document.getElementById('ADD_ACCTATTN').value;
  s[18] = document.getElementById('ADD_PRIMADD').value;
  s[19] = document.getElementById('ADD_ACCTADD').value;
  s[20] = document.getElementById('ADD_PRIMCITY').value;
  s[21] = document.getElementById('ADD_PRIMST').value;
  s[22] = document.getElementById('ADD_PRIMZIP').value;
  s[23] = document.getElementById('ADD_ACCTCITY').value;
  s[24] = document.getElementById('ADD_ACCTST').value;
  s[25] = document.getElementById('ADD_ACCTZIP').value;
  s[26] = document.getElementById('ADD_PRIMEMAIL').value;
  s[27] = document.getElementById('ADD_ACCTEMAIL').value;

  s[28] = document.getElementById('ADD_PRIMLDL').value;
  s[29] = document.getElementById('ADD_PRIMACL').value;
  s[30] = document.getElementById('ADD_PRIMNUMBER').value;
  s[31] = document.getElementById('ADD_PRIMEXT').value;

  s[32] = document.getElementById('ADD_ACCTLDL').value;
  s[33] = document.getElementById('ADD_ACCTACL').value;
  s[34] = document.getElementById('ADD_ACCTNUMBER').value;
  s[35] = document.getElementById('ADD_ACCTEXT').value;

  s[36] = document.getElementById('ADD_PRIMFLDL').value;
  s[37] = document.getElementById('ADD_PRIMFACL').value;
  s[38] = document.getElementById('ADD_PRIMFNUMBER').value;

  s[39] = document.getElementById('ADD_ACCTFLDL').value;
  s[40] = document.getElementById('ADD_ACCTFACL').value;
  s[41] = document.getElementById('ADD_ACCTFNUMBER').value;

  mindex = document.forms['custcareform'].ADD_PRIMDEPT.selectedIndex;
  s[42] = document.forms['custcareform'].ADD_PRIMDEPT.options[mindex].value;
  
  mindex = document.forms['custcareform'].ADD_PRIMLOCATION.selectedIndex;
  s[43] = document.forms['custcareform'].ADD_PRIMLOCATION.options[mindex].value;
  
  if (document.getElementById('primuseacctbox').checked == true ) {

   s[17]=s[16];
   s[19]=s[18];
   s[23]=s[20];
   s[24]=s[21];
   s[25]=s[22];
   s[27]=s[26];

   s[32]=s[28];
   s[33]=s[29];
   s[34]=s[30];
   s[35]=s[31];

   s[39]=s[36];
   s[40]=s[37];
   s[41]=s[38];

  } 
  
  mindex = document.forms['custcareform'].ADD_mship.selectedIndex;
  s[44] = document.forms['custcareform'].ADD_mship.options[mindex].value;

  if (document.getElementById('ADD_SHIPNOTYP1BOX').checked = false) {
      s[45]= "N";
  } else {s[45]= "Y"};

  s[46] = document.getElementById('ADD_UPSNAME').value;

  s[47] = document.getElementById('ADD_SHIPATTN').value;
  s[48] = document.getElementById('ADD_SHIPADD').value;

  s[49]=" ";  // not used right now- bound ship to co instead 

  s[50] = document.getElementById('ADD_SHIPCITY').value;
  s[51] = document.getElementById('ADD_SHIPST').value;
  s[52] = document.getElementById('ADD_SHIPZIP').value;


  if (document.getElementById('ADD_UPSRESIDBOX').checked == false) {
      s[53]= "N";
  } else {s[53]= "Y"};

  s[54] = document.getElementById('ADD_SHIPEMAIL').value;
  
  var mindex = document.forms['custcareform'].ADD_SRVCTYPE.selectedIndex;
  s[55] = document.forms['custcareform'].ADD_SRVCTYPE.options[mindex].value;
  
  s[56] = document.getElementById('ADD_SHIPLDL').value;
  s[57] = document.getElementById('ADD_SHIPACL').value;
  s[58] = document.getElementById('ADD_SHIPNUMBER').value;
  s[59] = document.getElementById('ADD_SHIPEXT').value;

  s[60] = document.getElementById('ADD_SHIPFLDL').value;
  s[61] = document.getElementById('ADD_SHIPFACL').value;
  s[62] = document.getElementById('ADD_SHIPFNUMBER').value;

  if (document.getElementById('primuseshipbox').checked) {
   // change shipping to match primary 
   s[47]=s[16];
   s[48]=s[18];
   s[50]=s[20];
   s[51]=s[21];
   s[52]=s[22];
   s[54]=s[26];

   s[56]=s[28];
   s[57]=s[29];
   s[58]=s[30];
   s[59]=s[31];

   s[60]=s[36];
   s[61]=s[37];
   s[62]=s[38];

  } 

  if (document.getElementById('ADD_AUTORESBOX').checked = false) {
      s[63]= "N";
  } else {s[63]= "Y"};

  mindex = document.forms['custcareform'].ADD_filetype.selectedIndex;
  s[64] = document.forms['custcareform'].ADD_filetype.options[mindex].value;

  s[65] = document.getElementById('ADD_RESPRICE').value;
  s[66] = document.getElementById('ADD_MINCHARGE').value;

  if (document.getElementById('ADD_EXTRACHARGbox').checked == false) {
      s[67]= "N";
  } else {s[67]= "Y"};

  if (document.getElementById('ADD_REVCHARGEbox').checked == false) {
      s[68]= "N";
  } else {s[68]= "Y"};

  if (document.getElementById('ADD_AUTOCONbox').checked == false) {
      s[69]= "N";
  } else {s[69]= "Y"};

  s[70] = document.getElementById('ADD_CONPRICE').value;
  s[71] = document.getElementById('ADD_CONMIN').value;
  s[72] = document.getElementById('ADD_PLUS3CON').value;
  s[73] = document.getElementById('ADD_PLUSPHNCON').value;
  s[74] = document.getElementById('ADD_MLTIUSECON').value;


  if (document.getElementById('ADD_TRAILERbox').checked == false) {
      s[75]= "N";
  } else {s[75]= "N"};


  if (document.getElementById('ADD_NOCISDEFbox').checked == false) {
      s[76]= "N";
  } else {s[76]= "Y"};


  if (document.getElementById('ADD_ALLOWNOCISbox').checked == false) {
      s[77]= "N";
  } else {s[77]= "Y"};

  if (document.getElementById('ADD_AUTOTAGbox').checked == false) {
      s[78]= "N";
  } else {s[78]= "Y"};

  if (document.getElementById('ADD_NOINVOICEbox').checked == false) {
      s[79]= "N";
  } else {s[79]= "Y"};


  if (document.getElementById('ADD_TMTAGSbox').checked == false) {
      s[80]= "N";
  } else {s[80]= "Y"};

  if (document.getElementById('ADD_PDFTAGSbox').checked == false) {
      s[81]= "N";
  } else {s[81]= "Y"};

  s[82] = document.getElementById('ADD_OCCUCHARGE').value;

  mindex = document.forms['custcareform'].ADD_tagformat.selectedIndex;
  s[83] = document.forms['custcareform'].ADD_tagformat.options[mindex].value;
  s[84] = document.getElementById('ADD_PDFCHARGE').value;
  s[85] = document.getElementById('ADD_PDFTAGMIN').value;

  if (document.getElementById('ADD_ALLOWNCOAbox').checked == false) {
      s[86]= "N";
  } else {s[86]= "Y"};

  if (document.getElementById('ADD_NCOAONLYbox').checked == false) {
      s[87]= "N";
  } else {s[87]= "Y"};

  s[88] = document.getElementById('ADD_NCOAEMAIL').value;
  s[89] = document.getElementById('ADD_PAFNUM').value;

  // s[90] is a date and needs date conversion
  tdt=document.getElementById('ADD_PAFEXP').value;
  if (tdt.length > 6){
     var yearstart="19";
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*");
     yrtst=tdt.charAt(7)+tdt.charAt(8);
     if (yrtst < 80) {yearstart="20"}; 
     s[90]= yearstart+tdt.charAt(6)+tdt.charAt(7)+tdt.charAt(0)+tdt.charAt(1)+tdt.charAt(3)+tdt.charAt(4);
  } else {s[90]= " "};

  
    s[106] = document.getElementById('ADD_PAFNUM2').value;

  tdt=document.getElementById('ADD_PAFEXP2').value;
  if (tdt.length > 6){
     var yearstart="19";
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("/","*");
     tdt=tdt.replace("-","*");
     tdt=tdt.replace("-","*");
     yrtst=tdt.charAt(7)+tdt.charAt(8);
     if (yrtst < 80) {yearstart="20"}; 
     s[107]= yearstart+tdt.charAt(6)+tdt.charAt(7)+tdt.charAt(0)+tdt.charAt(1)+tdt.charAt(3)+tdt.charAt(4);
  } else {s[107]= " "};
  
  
  
  s[91] = document.getElementById('ADD_COMMENTL').value;
  s[92] = document.getElementById('ADD_COMMENTD').value;
  s[93] = document.getElementById('ADD_COMMENTA').value;
  
  // escape out ' " & $
  s[91]=s[91].replace(/\"/g,"zdblq");
  s[91]=s[91].replace(/\'/g,"zpos");
  s[91]=s[91].replace(/\$/g,"zdol");

  s[92]=s[92].replace(/\"/g,"zdblq");
  s[92]=s[92].replace(/\'/g,"zpos");
  s[92]=s[92].replace(/\$/g,"zdol");  
  
  s[93]=s[93].replace(/\"/g,"zdblq");
  s[93]=s[93].replace(/\'/g,"zpos");
  s[93]=s[93].replace(/\$/g,"zdol");  
    
  s[16]=s[16].replace(/\"/g,"zdblq");
  s[16]=s[16].replace(/\'/g,"zpos");
  s[16]=s[16].replace(/\$/g,"zdol");

  s[17]=s[17].replace(/\"/g,"zdblq");
  s[17]=s[17].replace(/\'/g,"zpos");
  s[17]=s[17].replace(/\$/g,"zdol");  
  
  s[47]=s[47].replace(/\"/g,"zdblq");
  s[47]=s[47].replace(/\'/g,"zpos");
  s[47]=s[47].replace(/\$/g,"zdol");  
  
  
  
  //LAST TWO FOR ADD

  if (s[8].substring(0,3) == "COD") {
    s[94]="Y";
  } else { 
    s[94]="N";
  }
  
  var statecheck=document.getElementById('ADD_ACCTST').value.toUpperCase();
  if (document.getElementById('ADD_WHSLRETLbox').checked == false && statecheck=="WA") {
      s[95]= "Y";
  } else {s[95]= "N"};

  if (document.getElementById('createlogonbox').checked == false) {
      s[96]= "N";
  } else {s[96]= "Y"};

  s[97] = document.getElementById('ADD_USERNAME').value;
  s[98] = document.getElementById('ADD_PASSWORD').value;  

  if (document.getElementById('ADD_MAP_VIEWERbox').checked == false) {
      s[99]= "N";
  } else {s[99]= "Y"};  
  
  if (document.getElementById('ADD_WORLDMKTbox').checked == false) {
      s[100]= "N";
  } else {s[100]= "Y"}; 

  //added zip4 fields for taxes
  s[102] = document.getElementById('ADD_primZIP4').value;
  s[103] = document.getElementById('ADD_acctZIP4').value;
  s[104] = document.getElementById('ADD_shipZIP4').value;
  

  if (document.getElementById('ADD_PROSPECTbox').checked == false) {
      s[105]= "N";
  } else {s[105]= "Y"}; 
  
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     rkey=/^/gi;
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
     s[myKey]=s[myKey].replace(/\,/g," ");
     s[myKey]=s[myKey].replace(/\"/g,' ');
     s[myKey]=s[myKey].replace(/\'/g,'');
     //s[myKey]=s[myKey].replace(/\&/g,'and');
    }

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = addcustResponse;
  http.send(null);


} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

}

// validation code 
function validCustADD() {

  var numerrors=0;
  document.getElementById('emsg').innerHTML="";
  document.getElementById('errorcnt').innerHTML="";
  numchk="";

  numerrors=numerrors+blankchk('ADD_zip4','Phy Zip4');
  numerrors=numerrors+blankchk('ADD_acctZIP4','Accounting Zip4');
  numerrors=numerrors+blankchk('ADD_primZIP4','Primary Zip4');
  numerrors=numerrors+blankchk('ADD_shipZIP4','Shipping Zip4');
  
  numerrors=numerrors+blankchk('ADD_company','company name');
  numerrors=numerrors+blankchk('ADD_add1','company address');
  numerrors=numerrors+blankchk('ADD_CITY','company city');
  numerrors=numerrors+blankchk('ADD_ST','company state');
  numerrors=numerrors+checkzip('ADD_ZIP','company zip code');
  numerrors=numerrors+checknumberentry('ADD_ZIP4','Zip four digit extention ',9999);
  numerrors=numerrors+checkdatefmt('ADD_MLRA_DATE','MLRA ');
  numerrors=numerrors+checknumberentry('ADD_CREDITLIM','Customer Credit limit ',999999.99);
  numerrors=numerrors+checkdatefmt('ADD_CREDITEXP','credit expiration ');
  numerrors=numerrors+checkemail('ADD_DELVREMAIL','delivery email');
  numerrors=numerrors+checknumberentry('ADD_EMAILFTP','Email/FTP Charge ',99.99);
  numerrors=numerrors+checkdatefmt('ADD_RETAILCERT','retail certificate ');
  numerrors=numerrors+blankchk('ADD_PRIMATTN','primary name');
  numerrors=numerrors+blankchk('ADD_PRIMADD','primary address');
  numerrors=numerrors+blankchk('ADD_PRIMCITY','primary city');
  numerrors=numerrors+blankchk('ADD_PRIMST','primary state');
  numerrors=numerrors+checkemail('ADD_PRIMEMAIL','primary contact email');
  numerrors=numerrors+checkzip('ADD_PRIMZIP','primary zip code');
  numerrors=numerrors+blankchk('ADD_PRIMZIP','primary zip code');
  numerrors=numerrors+blankchk('ADD_ACCTATTN','accounting name');
  numerrors=numerrors+blankchk('ADD_ACCTADD','accounting address');
  numerrors=numerrors+blankchk('ADD_ACCTCITY','accounting city');
  numerrors=numerrors+blankchk('ADD_ACCTST','accounting state');
  numerrors=numerrors+blankchk('ADD_ACCTZIP','accounting zip');
  numerrors=numerrors+checkzip('ADD_ACCTZIP','accounting zip code');
  numerrors=numerrors+checkemail('ADD_ACCTEMAIL','accouting contact email');
  numerrors=numerrors+checknumberentry('ADD_PRIMLDL','Primary Long Distance ',9);
  numerrors=numerrors+checknumberentry('ADD_PRIMACL','Primary Area Code ',999);

//no validation
document.getElementById('ADD_PRIMNUMBER').style.color='black';
document.getElementById('ADD_PRIMEXT').style.color='black';

  numerrors=numerrors+checknumberentry('ADD_ACCTLDL','Accounting Long Distance ',9);
  numerrors=numerrors+checknumberentry('ADD_ACCTACL','Accounting Area Code ',999);

//no validation
document.getElementById('ADD_ACCTNUMBER').style.color='black';
document.getElementById('ADD_ACCTEXT').style.color='black';
document.getElementById('ADD_PRIMFLDL').style.color='black';
document.getElementById('ADD_PRIMFACL').style.color='black';
document.getElementById('ADD_PRIMFNUMBER').style.color='black';
document.getElementById('ADD_ACCTFLDL').style.color='black';
document.getElementById('ADD_ACCTFACL').style.color='black';
document.getElementById('ADD_ACCTFNUMBER').style.color='black';

document.getElementById('ADD_UPSNAME').style.color='black';
  numerrors=numerrors+blankchk('ADD_SHIPATTN','shipping name');
  numerrors=numerrors+blankchk('ADD_SHIPADD','shipping address');
  numerrors=numerrors+blankchk('ADD_SHIPCITY','shipping city');
  numerrors=numerrors+blankchk('ADD_SHIPST','shipping state');
  numerrors=numerrors+blankchk('ADD_SHIPZIP','shipping zip');
  numerrors=numerrors+checkzip('ADD_SHIPZIP','shipping zip code');
  numerrors=numerrors+checkemail('ADD_SHIPEMAIL','shipping contact email');


  numerrors=numerrors+checknumberentry('ADD_SHIPLDL','shipping Long Distance ',9);
  numerrors=numerrors+checknumberentry('ADD_SHIPACL','shipping Area Code ',999);

document.getElementById('ADD_SHIPNUMBER').style.color='black';
document.getElementById('ADD_SHIPEXT').style.color='black';
document.getElementById('ADD_SHIPFLDL').style.color='black';
document.getElementById('ADD_SHIPFACL').style.color='black';
document.getElementById('ADD_SHIPFNUMBER').style.color='black';

  numerrors=numerrors+checknumberentry('ADD_MINCHARGE','Resident Minimum Charge ',999);
  numerrors=numerrors+checknumberentry('ADD_RESPRICE','Resident /M charge ',99.99);
  numerrors=numerrors+checknumberentry('ADD_OCCUCHARGE','Occupant /M Charge ',99.99);
  numerrors=numerrors+checknumberentry('ADD_PDFCHARGE','PDF Charge ',99.99);
  numerrors=numerrors+checknumberentry('ADD_PDFTAGMIN','PDF Tag Minimum ',99.99);
  numerrors=numerrors+checknumberentry('ADD_CONPRICE','Consumer /M Charge ',99.99);
  numerrors=numerrors+checknumberentry('ADD_CONMIN','Consumer Minimum Charge ',999.99);
  numerrors=numerrors+checknumberentry('ADD_PLUS3CON','Plus3 Consumer Charge ',99.99);
  numerrors=numerrors+checknumberentry('ADD_PLUSPHNCON','Plus3 Phone Charge ',99.99);
  numerrors=numerrors+checknumberentry('ADD_MLTIUSECON','Consumer Multiuse Charge ',99.99);

  numerrors=numerrors+checkemail('ADD_NCOAEMAIL','NCOA email');
  document.getElementById('ADD_PAFNUM').style.color='black';
  numerrors=numerrors+checkdatefmt('ADD_PAFEXP','PAF expiration ');

  document.getElementById('ADD_PAFNUM2').style.color='black';
  numerrors=numerrors+checkdatefmt('ADD_PAFEXP2','PAF expiration ');
  
  document.getElementById('ADD_COMMENTL').style.color='black';
  document.getElementById('ADD_COMMENTD').style.color='black';
  document.getElementById('ADD_COMMENTA').style.color='black';
  document.getElementById('ADD_USERNAME').style.color='black';
  document.getElementById('ADD_PASSWORD').style.color='black';  

  // check these dates to make sure they are not past -ADD_PAFEXP,ADD_CREDITEXP,ADD_RETAILCERT,ADD_MLRA_DATE
  numerrors=numerrors+checkdate2('ADD_PAFEXP','PAF expire ');
  numerrors=numerrors+checkdate2('ADD_CREDITEXP','credit expire ');
  numerrors=numerrors+checkdate2('ADD_RETAILCERT','retail cert ');
  numerrors=numerrors+checkdate2('ADD_MLRA_DATE','MLRA expire ');

  
  //added a check to phonenumbers
  numerrors=numerrors+checkph('ADD_PRIMNUMBER','Primary phone number ');
  numerrors=numerrors+checkph('ADD_ACCTNUMBER','Accounting phone number ');
  numerrors=numerrors+checkph('ADD_PRIMFNUMBER','Primary fax number ');
  numerrors=numerrors+checkph('ADD_ACCTFNUMBER','Accounting fax number ');
  numerrors=numerrors+checkph('ADD_SHIPNUMBER','Shipping phone number ');
  numerrors=numerrors+checkph('ADD_SHIPFNUMBER','Shipping fax number ');
  
   
  return numerrors;

}  


 
// the next two functions retrieve the customer information
function veradd(madd,mcity,mstate,mzip,mtype) {
		
  var url = "includes/php/veradd_process.php?mfilter="; // The server-side script
  //alert('Tpye of verify is: '+mtype);
  var maddu=madd.toUpperCase();
  var mcityu=mcity.toUpperCase();	
  var mstateu=mstate.toUpperCase();	
  s = new Array();
  s[0] = trim(maddu);
  s[1] = trim(mcityu);
  s[2] = trim(mstateu);
  s[3] = trim(mzip);
  s[4] = mtype;
  
  
  if ( mtype=='main_phy' && document.getElementById('ZIP4').readOnly==true){
 	alert("You need to load an account in 'EDIT' mode to get zip4 code.      \n\n");	  
    return null;
  }  
  
  if ( mtype=='editcont' && document.getElementById('azip').readOnly==true){
 	alert("You need to load an account in 'EDIT' mode to get zip4 code.      \n\n");	  
    return null;
  }  
  //take this out if we get coldfusion 8 that integrates with javscript.
  if (trim(s[0])=='' || trim(s[1])=='' || trim(s[2])=='' || trim(s[3])==''){
	   alert("The address is incomplete.   \n\nPlease enter an address,city,state & zip to verify.   ");
          
  } else {
     document.body.style.cursor = "wait";
     showwait();

     http.open("GET", url + escape(s), true);
     http.onreadystatechange = veraddResponse;
     http.send(null);

  }
}

function veraddResponse() {

  if (http.readyState == 4) {

    results = http.responseText.split("^");
    //alert(results);
    hidewait();
    document.body.style.cursor='auto';
    
    var mchk1=document.getElementById('add_add1').value+document.getElementById('add_city').value+document.getElementById('add_st').value+document.getElementById('add_zip').value;
	var mchk2=document.getElementById('add_primadd').value+document.getElementById('add_primcity').value+document.getElementById('add_primst').value+document.getElementById('add_primzip').value;
	var mchk3=document.getElementById('add_acctadd').value+document.getElementById('add_acctcity').value+document.getElementById('add_acctst').value+document.getElementById('add_acctzip').value;
	var mchk4=document.getElementById('add_shipadd').value+document.getElementById('add_shipcity').value+document.getElementById('add_shipst').value+document.getElementById('add_shipzip').value;
	 
    if(trim(results[10])==''){
          
	    alert("The address is incorrect, no zip4 returned. \n\nError returned: "+results[3]+"      ");  
	     
    } else {
	    if  (results[0]=='phy'){  
	       document.getElementById('add_zip4').value=results[10];
	   	       
	       if (mchk2==mchk1){
		       document.getElementById('add_primzip4').value=results[10];
           }
           
           if (mchk3==mchk1){
		       document.getElementById('add_acctzip4').value=results[10];
           }
	       
           if (mchk4==mchk1){
		       document.getElementById('add_shipzip4').value=results[10];
           }
	       
        } else if (results[0]=='prim'){ 
	       document.getElementById('add_primzip4').value=results[10];
	       
	       if (mchk1==mchk2){
		       document.getElementById('add_zip4').value=results[10];
           }
           
           if (mchk3==mchk2){
		       document.getElementById('add_acctzip4').value=results[10];
           }
	       
           if (mchk4==mchk2){
		       document.getElementById('add_shipzip4').value=results[10];
           }
	       
	       
	       
	       
	    } else if (results[0]=='acct'){        
	       document.getElementById('add_acctzip4').value=results[10];
	       
	       if (mchk1==mchk3){
		       document.getElementById('add_zip4').value=results[10];
           }
           
           if (mchk2==mchk3){
		       document.getElementById('add_primzip4').value=results[10];
           }
	       
           if (mchk4==mchk3){
		       document.getElementById('add_shipzip4').value=results[10];
           }
	       
	       
	    } else if (results[0]=='ship'){  
		      
	       document.getElementById('add_shipzip4').value=results[10];
	       
	       if (mchk1==mchk4){
		       document.getElementById('add_zip4').value=results[10];
           }
           
           if (mchk2==mchk4){
		       document.getElementById('add_primzip4').value=results[10];
           }
	       
           if (mchk3==mchk4){
		       document.getElementById('add_acctzip4').value=results[10];
           }
	       
	       
	    } else if (results[0]=='main_phy'){ 
		    
		   //main screen  
		   document.getElementById('zip4').value=results[10];
		   
		} else if (results[0]=='addcont'){
		   //adding a contact	
		   document.getElementById('add_azip4').value=results[10]; 
			      
		} else if (results[0]=='editcont'){
		   //editing a contact	     
		   document.getElementById('azip4').value=results[10];
		   
		} else if (results[0]=='newaddr'){
		   //editing a contact	     
		   document.getElementById('new_zip4').value=results[10];
		       
		} else if (results[0]=='binv'){   
		   document.getElementById('binv_shipzip4').value=results[10]; 
		   
	    } else {
		  alert("Error updating zip 4, please try again. \n\nAddress returned: "+trim(results[4])+" "+trim(results[5])+" "+trim(results[6])+","+results[7]+" "+results[8]+" "+results[9]+"-"+results[10]+"      ");
        }
	}        
    
  } //end of ready state

}



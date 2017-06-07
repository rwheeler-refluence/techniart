//function for updating an edit

 function addContactResponse() {

  if (http.readyState == 4) {
    //alert(http.responseText);
    results = http.responseText;
    getAdd();
    hidewait();
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();
    if (results != "Please choose another username and password."){ 
        hideAddContact();
    }    
  }

}


function addContact() {
  var updateurl = "includes/php/cc_add_cust_process.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;
  document.body.style.cursor = "wait";
  showwait();

checkforErrors=validContactADD();

if (checkforErrors == 0) {
  
  s = new Array();

  s[0] = "maddContact";

  s[1] = "";   //userID assigned when added
  s[2] = document.getElementById('ADD_aattn').value;  //ATTN
  s[3] = document.getElementById('ADD_aconm').value;  //COMPANY
  s[4] = document.getElementById('ADD_aadd1').value;  //ADD1
  s[5] = document.getElementById('ADD_acity').value;  //CITY
  s[6] = document.getElementById('ADD_ast').value;    //ST
  s[7] = document.getElementById('ADD_azip').value;   //ZIP
  s[8] = document.getElementById('ADD_aemail').value; //EMAIL
  s[9] = document.getElementById('ADD_aldd').value;   //LDD
  s[10] = document.getElementById('ADD_aacl').value;   //ACL  
  s[11] = document.getElementById('ADD_anum').value;   //NUMBERL
  s[12] = document.getElementById('ADD_aext').value;   //EXTL
  s[13] = document.getElementById('ADD_afldd').value;  //F_LDD
  s[14] = document.getElementById('ADD_afacl').value;  //F_ACL
  s[15] = document.getElementById('ADD_afnum').value;  //NUMBERF
  
  
  //REC_TYPE
  var mindex = document.forms['custcareform'].ADD_arec.selectedIndex;
  s[16] = document.forms['custcareform'].ADD_arec.options[mindex].value;
  
  //LOC_TYPE
  var mindex = document.forms['custcareform'].ADD_aloc.selectedIndex;
  s[17] = document.forms['custcareform'].ADD_aloc.options[mindex].value;
  
  //DEPT
  var mindex = document.forms['custcareform'].ADD_adept.selectedIndex;
  s[18] = document.forms['custcareform'].ADD_adept.options[mindex].value;
 
  if (trim(s[16])==""){s[16]="U"};
  if (trim(s[17])==""){s[17]="H"};
  if (trim(s[18])==""){s[18]="L"};
 
  //alert('here');    
  if (document.getElementById('ADD_aprimbox').checked == false) {
      s[19]= "N";
  } else {s[19]= "Y"};

  s[20] = document.getElementById('company').value;
  s[21] = document.getElementById('mcustid').value;


  if (document.getElementById('createuserbox').checked == false) {
      s[22]= "N";
  } else {s[22]= "Y"};
  
  s[23] = document.getElementById('ADD_aUSERNAME').value;
  s[24] = document.getElementById('ADD_aPASSWORD').value;    
 
  //added zip4
  s[25] = document.getElementById('ADD_azip4').value;   //ZIP
  
  s[3]=s[3].replace(/\'/g,"zpos");
  s[2]=s[2].replace(/\'/g,"zpos");
  
  s[3]=s[3].replace(/\,/g,"zcomma");
  s[2]=s[2].replace(/\,/g,"zcomma");
  
 
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     rkey=/^/gi;
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
    
    }

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = addContactResponse;
  http.send(null);


} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

}


// validation code 
function validContactADD() {

  var numerrors=0;
  document.getElementById('emsg').innerHTML="";
  document.getElementById('errorcnt').innerHTML="";
  numchk="";


  numerrors=numerrors+blankchk('ADD_aattn','attention name');
  numerrors=numerrors+blankchk('ADD_aconm','contact company name');
  numerrors=numerrors+blankchk('ADD_aadd1','contact address');
  numerrors=numerrors+blankchk('ADD_acity','contact city');
  numerrors=numerrors+blankchk('ADD_ast','contact state');
  numerrors=numerrors+checkzip('ADD_azip','contact zip code');
  numerrors=numerrors+blankchk('ADD_azip4','Zip 4 code');
  
  numerrors=numerrors+checkemail('ADD_aemail','contact contact email');
  numerrors=numerrors+checknumberentry('ADD_aldd','contact long distance ',9);
  numerrors=numerrors+checknumberentry('ADD_aacl','contact area code ',999);

  document.getElementById('ADD_anum').style.color='black';   //NUMBERL
  document.getElementById('ADD_aext').style.color='black';   //EXTL
  numerrors=numerrors+checknumberentry('ADD_afldd','contact fax long distance ',9);
  numerrors=numerrors+checknumberentry('ADD_afacl','contact fax area code ',999);
  document.getElementById('ADD_afnum').style.color='black';  //NUMBERF
  

 //added a check to phonenumbers
  numerrors=numerrors+checkph('ADD_anum','phone number ');
  numerrors=numerrors+checkph('ADD_afnum','fax number ');
  
  
  
  
  return numerrors;
}  



function setupcontact() {

  document.getElementById('ADD_aattn').value="";  //ATTN
  document.getElementById('ADD_aconm').value="";  //COMPANY
  document.getElementById('ADD_aadd1').value="";  //ADD1
  document.getElementById('ADD_acity').value="";  //CITY
  document.getElementById('ADD_ast').value="";    //ST
  document.getElementById('ADD_azip').value="";   //ZIP
  document.getElementById('ADD_aemail').value=""; //EMAIL
  document.getElementById('ADD_aldd').value="";   //LDD
  document.getElementById('ADD_aacl').value="";   //ACL  
  document.getElementById('ADD_anum').value="";   //NUMBERL
  document.getElementById('ADD_aext').value="";   //EXTL
  document.getElementById('ADD_afldd').value="";  //F_LDD
  document.getElementById('ADD_afacl').value="";  //F_ACL
  document.getElementById('ADD_afnum').value="";  //NUMBERF
  
  document.getElementById('ADD_aUSERNAME').value="";  //USER NAME
  document.getElementById('ADD_aPASSWORD').value="";  //USER NAME
  
  // populate info
  document.getElementById('ADD_aconm').value=document.getElementById('company').value;  //COMPANY
  document.getElementById('ADD_aadd1').value=document.getElementById('add1').value;  //ADD1
  document.getElementById('ADD_acity').value=document.getElementById('city').value;  //CITY
  document.getElementById('ADD_ast').value=document.getElementById('st').value;    //ST
  document.getElementById('ADD_azip').value=document.getElementById('zip').value;   //ZIP
  

}

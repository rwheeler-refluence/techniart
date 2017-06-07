//function for updating a ticket edit

 function getaddreditResponse() {

  if (http.readyState == 4) {

    results = http.responseText;
    //alert(results);
    
    getAdd();

    if (document.getElementById('aprimbox').checked == true) {

      // routine to uncheck rest is in update       
      document.getElementById('CONTACTL1').value = document.getElementById('aattn').value;
      document.getElementById('CL1_EMAIL').value = document.getElementById('aemail').value;
      document.getElementById('P_LDL1').value = document.getElementById('aldd').value;
      document.getElementById('P_ACL1').value = document.getElementById('aacl').value;
      document.getElementById('P_NUMBERL1').value = document.getElementById('anum').value;
      document.getElementById('P_EXTL1').value = document.getElementById('aext').value;
      document.getElementById('F_LDL1').value = document.getElementById('afldd').value;
      document.getElementById('F_ACL1').value = document.getElementById('afacl').value;
      document.getElementById('F_NUMBERL1').value = document.getElementById('afnum').value;

    } 

    hidewait();
    document.body.style.cursor='auto';
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    //showconfirm();
  }

}

function updateAddr() {
  var updateurl = "includes/php/cc_update_custinfo_process_fox.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;
  document.body.style.cursor = "wait";
  showwait();

  checkforErrors=validStk();

if (checkforErrors == 0) {

  s = new Array();

  s[0] = "maddrscr";


  s[1] = document.getElementById('auid').value;   //userID
  s[2] = document.getElementById('aattn').value;  //ATTN
  s[3] = document.getElementById('aconm').value;  //COMPANY
  s[4] = document.getElementById('aadd1').value;  //ADD1
  s[5] = document.getElementById('acity').value;  //CITY
  s[6] = document.getElementById('ast').value;    //ST
  s[7] = document.getElementById('azip').value;   //ZIP
  s[8] = document.getElementById('aemail').value; //EMAIL
  s[9] = document.getElementById('aldd').value;   //LDD
  s[10] = document.getElementById('aacl').value;   //ACL  
  s[11] = document.getElementById('anum').value;   //NUMBERL
  s[12] = document.getElementById('aext').value;   //EXTL
  s[13] = document.getElementById('afldd').value;  //F_LDD
  s[14] = document.getElementById('afacl').value;  //F_ACL
  s[15] = document.getElementById('afnum').value;  //NUMBERF
  
  
  //REC_TYPE
  var mindex = document.forms['custcareform'].arec.selectedIndex;
  s[16] = document.forms['custcareform'].arec.options[mindex].value;
  
  //LOC_TYPE
  var mindex = document.forms['custcareform'].aloc.selectedIndex;
  s[17] = document.forms['custcareform'].aloc.options[mindex].value;
  
  //DEPT
  var mindex = document.forms['custcareform'].adept.selectedIndex;
  s[18] = document.forms['custcareform'].adept.options[mindex].value;
  
      
  if (document.getElementById('aprimbox').checked == false) {
      s[19]= "N";
  } else {s[19]= "Y"};

  s[20] = document.getElementById('aconm').value;
  s[21] = document.getElementById('mcustid').value;
  
  
  
  //added zip
  s[22] = document.getElementById('azip4').value;   //ZIP
  
 //alert(s[20]);
  
  s[20]=s[20].replace(/\'/g,"zpos");
  s[2]=s[2].replace(/\'/g,"zpos");
  s[3]=s[3].replace(/\'/g,"zpos");
  s[4]=s[4].replace(/\'/g,"zpos");
  
  s[20]=s[20].replace(/\,/g,"zcomma");
  s[2]=s[2].replace(/\,/g,"zcomma");
  s[3]=s[3].replace(/\,/g,"zcomma");
  s[4]=s[4].replace(/\,/g,"zcomma");
  
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     rkey=/^/gi;
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
    
    }

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getaddreditResponse;
  http.send(null);

} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

}



function validStk() {

  var numerrors=0;
  document.getElementById('emsg').innerHTML="";
  document.getElementById('errorcnt').innerHTML="";
  numchk="";

  //document.getElementById('acid').style.color='black';   //CUST_ID
  document.getElementById('aattn').style.color='black';   //ATTN
  document.getElementById('aconm').style.color='black';   //COMPANY
  document.getElementById('aadd1').style.color='black';   //ADD1
  document.getElementById('acity').style.color='black';   //CITY
  document.getElementById('ast').style.color='black';     //ST
  document.getElementById('azip').style.color='black';    //ZIP

  var emailchk=document.getElementById('aemail').value;
  emailchk=trim(emailchk);
  if (emailchk.length > 0){
    if ((emailchk.indexOf('@') > -1) && (emailchk.indexOf('.') > -1)){ 
      document.getElementById('aemail').style.color='black';
    } else { 
      document.getElementById('aemail').style.color='red';
      document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Contact Email Format is missing @ and/or '.' , Please use 'EMAILNAME@ISPNAME.COM'.<br>";
      numerrors=numerrors+1;
    }
  } else {document.getElementById('aemail').style.color='black'};
 

  var numchk=document.getElementById('aldd').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,9)) { 
    document.getElementById('aldd').style.color='black';
  } else { 
    document.getElementById('aldd').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "LD Format is incorrect. Needs to be 1/blank.";
    numerrors=numerrors+1;
  }

  var numchk=document.getElementById('aacl').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,999)) { 
    document.getElementById('aacl').style.color='black';
  } else { 
    document.getElementById('aacl').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Area Code Format is incorrect.";
    numerrors=numerrors+1;
  }

  document.getElementById('anum').style.color='black';   //NUMBERL
  document.getElementById('aext').style.color='black';   //EXTL
numerrors=numerrors+blankchk('azip4','Zip 4 code');
  var numchk=document.getElementById('afldd').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,9)) { 
    document.getElementById('afldd').style.color='black';
  } else { 
    document.getElementById('afldd').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Fax LD Format is incorrect. Needs to be 1/blank.";
    numerrors=numerrors+1;
  }

  var numchk=document.getElementById('afacl').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,999)) { 
    document.getElementById('afacl').style.color='black';
  } else { 
    document.getElementById('afacl').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "Fax Area Code Format is incorrect.";
    numerrors=numerrors+1;
  }

  document.getElementById('afnum').style.color='black';  //NUMBERF
  document.getElementById('arec').style.color='black';   //REC_TYPE
  document.getElementById('aloc').style.color='black';   //LOC_TYPE
  document.getElementById('adept').style.color='black';  //DEPT
 
   
  //added a check to phonenumbers
  numerrors=numerrors+checkph('anum','phone number ');
  numerrors=numerrors+checkph('afnum','fax number ');
 
  
  
  
  return numerrors;
}
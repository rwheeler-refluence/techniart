//function for updating a ticket edit

 function getNCOAeditResponse() {

  if (http.readyState == 4) {

    results = http.responseText;
    getNCOA();
    hidewait();
    document.body.style.cursor='auto';
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();

  }

}


function updateNCOA() {
  var updateurl = "includes/php/cc_update_custinfo_process_fox.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;
  document.body.style.cursor = "wait";
  showwait();

  checkforErrors=validNCOA();

if (checkforErrors == 0) {

  s = new Array();

  s[0] = "NCOAscr";
 
  s[1] = document.getElementById('sncoaPROCESS').value;
  s[2] = document.getElementById('sncoaLESS1MM').value;
  s[3] = document.getElementById('sncoaMM1MM3').value;
  s[4] = document.getElementById('sncoaMM3MM5').value;
  s[5] = document.getElementById('sncoaMM5MORE').value;
  s[6] = document.getElementById('sncoaMINIMUM').value;
  s[7] = document.getElementById('sncoaCUSTTYPE').value;  
  s[8] = document.getElementById('mcustid').value;

  s[1]=s[1].replace(/\+/g,"*");

  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     rkey=/^/gi;
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
    
    }

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getNCOAeditResponse;
  http.send(null);

} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

}


function validNCOA() {

  var numerrors=0;
  document.getElementById('emsg').innerHTML="";
  document.getElementById('errorcnt').innerHTML="";
  numchk="";
  
  document.getElementById('sncoaPROCESS').style.color='black';

  var numchk=document.getElementById('sncoaLESS1MM').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,9.99)) { 
    document.getElementById('sncoaLESS1MM').style.color='black';
  } else { 
    document.getElementById('sncoaLESS1MM').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "NCOA Less than 1 MM Format is incorrect or to high. Please use '###' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  var numchk=document.getElementById('sncoaMM1MM3').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,9.99)) { 
    document.getElementById('sncoaMM1MM3').style.color='black';
  } else { 
    document.getElementById('sncoaMM1MM3').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "NCOA 1-3 MM Format is incorrect or to high. Please use '###' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  var numchk=document.getElementById('sncoaMM3MM5').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,9.99)) { 
    document.getElementById('sncoaMM3MM5').style.color='black';
  } else { 
    document.getElementById('sncoaMM3MM5').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "NCOA 3-5 MM Format is incorrect or to high. Please use '###' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  var numchk=document.getElementById('sncoaMM5MORE').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,9.99)) { 
    document.getElementById('sncoaMM5MORE').style.color='black';
  } else { 
    document.getElementById('sncoaMM5MORE').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "NCOA Over 5 MM Format is incorrect or to high. Please use '###' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }

  document.getElementById('sncoaMINIMUM').style.color='black';
  var numchk=document.getElementById('sncoaMINIMUM').value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,999.99)) { 
    document.getElementById('sncoaMINIMUM').style.color='black';
  } else { 
    document.getElementById('sncoaMINIMUM').style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "NCOA Minimum Format is incorrect or to high. Please use '###' and make sure it is numeric.<br>";
    numerrors=numerrors+1;
  }


  document.getElementById('sncoaCUSTTYPE').style.color='black';  
  

  
  return numerrors;
}
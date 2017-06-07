//function for updating a user edit

 function getusereditResponse() {

  if (http.readyState == 4) {

    results = http.responseText;
    getUsers();
    hidewait();
    document.body.style.cursor='auto';
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();

  }

}


function updateUser() {
  var updateurl = "includes/php/cc_update_custinfo_process_fox.php?mform="; // The server-side script
  var mindex =0;
  var tdt=""; 
  var yrtst = 0;
  var yearstart="19";   
  var checkforErrors=0;
  document.body.style.cursor = "wait";
  showwait();

  checkforErrors=validUser();

if (checkforErrors == 0) {

  s = new Array();

  s[0] = "userscr";

  s[1] = document.getElementById('uid').value; //user_id
  s[2] = document.getElementById('unm').value; //name
  s[3] = document.getElementById('ulevel').value; //userlevel
  s[4] = document.getElementById('uwebnm').value; //username
  s[5] = document.getElementById('uwebpass').value; //password
 
  if (document.getElementById('MAP_VIEWERbox').checked == false) {
      s[6]= "N";
  } else {s[6]= "Y"};

  //add custid for fox update
  s[7] = document.getElementById('mcustid').value; //cust id
  s[8] = document.getElementById('company').value; //company name for fox password dbf
  
  s[8]=s[8].replace(/\'/g,"zpos");
  s[8]=s[8].replace(/\,/g,"zcomma");
  
  s[9] = document.getElementById('oldusernm').value; //username
  s[10] = document.getElementById('oldpasswd').value; //password
  
  //strip apos from userlogon
  s[2] =s[2].replace(/\'/g,"");
  s[4] =s[4].replace(/\'/g,"");
  s[5] =s[5].replace(/\'/g,"");
  
  
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     rkey=/^/gi;
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
    
    }

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);

  http.onreadystatechange = getusereditResponse;

  http.send(null);

} else {

  hidewait();
  document.body.style.cursor='auto';
  document.getElementById('errorcnt').innerHTML=checkforErrors + " Error(s) found.";
  showemsg();

}

}


function validUser() {

  var numerrors=0;
  document.getElementById('emsg').innerHTML="";
  document.getElementById('errorcnt').innerHTML="";
  numchk="";


  //NOTHING CURRENTLY VERIFIED

  document.getElementById('unm').style.color='black'; 
  document.getElementById('ulevel').style.color='black';
  document.getElementById('uwebnm').style.color='black'; 
  document.getElementById('uwebpass').style.color='black'; 
  
  return numerrors;
}


function saveitResponse() {

  if (http.readyState == 4) {
	   
    results = http.responseText.split("^");
 
    if (parseInt(results[1]) < parseInt(results[2]) ){
	    sholding[0]=sholding[0]+results[3];  
	    
	    var mbeg=parseInt(results[1]);
	    var mend=parseInt(results[1])+1000; 
	    //alert(mbeg+"  :   "+mend);
	    saveit(mbeg,mend);
    } else { 
	  sholding[0]=sholding[0]+results[3]; 
	  document.getElementById('testbox').value=sholding[0];
	  sholding[0]=sholding[0].replace(/\&lt;/g,"<");
      sholding[0]=sholding[0].replace(/\&gt;/g,">");
      sholding[0]=sholding[0].replace(/\&quot;/g,'"');
	  sholding[0]=sholding[0].replace(/\&amp;/g,'&');        
      document.getElementById('showme2').innerHTML=sholding[0];
    }
  }

}


function saveit(mstart,mfinish) {
  var updateurl = "includes/php/savit.php?mform="; // The server-side script
 
  s = new Array();
  sblock = new Array();
  
  if (mstart==undefined){
	var mstart=0;
	sholding = new Array();
	sholding[0] ="";
  }
  
  if (mfinish==undefined){
     var mfinish=1000;	  
  } 	  	  
   
  sblock[0] =document.getElementById('myarea').value
  var mlength=sblock[0].length;
  sblock[0]=sblock[0].substring(mstart,mfinish);
  s[0]=mstart;
  s[1]=mfinish;
  s[2]=mlength;
  
  //alert(sblock[0]);
  http.open("GET", updateurl + escape(s)+ "&htmlblock=" +escape(sblock), true);
  http.onreadystatechange = saveitResponse;
  http.send(null);


}

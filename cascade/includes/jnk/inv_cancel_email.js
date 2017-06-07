//function for adding a user edit

 function sendcancelResponse() {

  if (http.readyState == 4) {

    results = http.responseText;
    hidewait();
    hideinvcan();
    var mwhat=""; 
    document.getElementById('invcanmess').value="";
    if (results=="Job Ticket"){
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML="The Cancel/Void request has been sent to Mary and Carol";
      showconfirm();
    } else {
	  document.body.style.cursor='auto';
	  document.getElementById('binvmsgtext').innerHTML="<br><br>The Cancel/Void request has been sent to Mary and Carol.";
      showbinvmsg();
	  
    }      

  }

}

function sendinvcancel() {
	
  if (document.getElementById('binvscreenup').value == "YES"){
  	var mnum=document.getElementById('binv_JOB_ID').value;
   	var mwhat="Invoice";
  } else {
	var mnum=document.getElementById('tk_stkJOB_ID').value;
   	var mwhat="Job Ticket";    
  }     	

  
  var canurl = "includes/php/invcancel_process.php?mess="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();

  s = new Array();
  s[0] = mwhat;
  s[1] = mnum;
  s[2] = document.getElementById('invcanmess').value; 
 
    
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
	 
     s[myKey]=s[myKey].replace(/\,/g," ");
     s[myKey]=s[myKey].replace(/\^/g," ");
     s[myKey]=s[myKey].replace(/\|/g," ");
        
   }

  var usession = getmsession();
  http.open("GET", canurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = sendcancelResponse;

  http.send(null);

}

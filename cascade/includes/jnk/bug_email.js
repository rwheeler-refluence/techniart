//function for adding a user edit

 function sendbugResponse() {

  if (http.readyState == 4) {

    results = http.responseText;
    hidewait();
    hidebug();
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();

  }

}

function sendbug() {

  var bugurl = "includes/php/bug_email_process.php?mess="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();

  s = new Array();
  s[0] = "bugrpt";
  s[1] = document.getElementById('bugmess').value; 
 
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g," ");
     s[myKey]=s[myKey].replace(/\^/g," ");
     s[myKey]=s[myKey].replace(/\|/g," ");
        
   }

  var usession = getmsession();
  http.open("GET", bugurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = sendbugResponse;

  http.send(null);

}

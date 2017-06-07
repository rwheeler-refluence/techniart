//function for removing locks  
//this one is currently only used when switching between companies. 
//The previous lock is removed as new records are pulled up, might 
//want to use this as well at some point if locking becomes a problem


function removetklockResponse() {

  if (http.readyState == 4) {
	  //alert(http.responseText);
     
       results = http.responseText;
       hidewait();
       document.body.style.cursor='auto';
       hidetk_stk();
       
  }

}


function removetklock(jid) {

  var updateurl = "includes/php/tk_removelock_process.php?mid="; // The server-side script
  var mjid=jid;
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(mjid) + "&usession=" +escape(usession), true);
  http.onreadystatechange = removetklockResponse;
  http.send(null);

}


function unlockalltkResponse() {

  if (http.readyState == 4) { 
    results = http.responseText;
    
  }

}




function unlockalltk() {

  var updateurl = "includes/php/tk_unlock_all.php?usession="; // The server-side script
  var usession = getmsession();;
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = unlockallResponse;
  http.send(null);

}

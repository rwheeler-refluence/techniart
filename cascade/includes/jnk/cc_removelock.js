//function for removing locks  
//this one is currently only used when switching between companies. 
//The previous lock is removed as new records are pulled up, might 
//want to use this as well at some point if locking becomes a problem


function removelockResponse() {

  if (http.readyState == 4) {
     
       results = http.responseText;
       //showcust(1);
       if (document.getElementById('ucoid').value=="CIS"){
         showcust(1);
       } else {
	     showcust(5);  
       }	 
       
       hidewait();
       document.body.style.cursor='auto'; 
       getarfiletyp();

  }

}


function removelock(mid) {

  var updateurl = "includes/php/cc_removelock_process.php?mid="; // The server-side script
  var mcid=mid;
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(mcid) + "&usession=" +escape(usession), true);
  http.onreadystatechange = removelockResponse;
  http.send(null);

}


function unlockallResponse() {

  if (http.readyState == 4) { 
    results = http.responseText;
  }

}




function unlockall() {

  var updateurl = "includes/php/cc_unlock_all.php?theuser="; // The server-side script
  var theuser=document.getElementById('uname').value;
  http.open("GET", updateurl + escape(theuser), true);
  http.onreadystatechange = unlockallResponse;
  http.send(null);

}

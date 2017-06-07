function getreccntResponse() {

  if (http.readyState == 4) {
    //results = http.responseText;

    results = http.responseText.split("|");
    var mnum = results[0];
    var oldid = results[1];

    hidewait();
    document.body.style.cursor='auto';
    var msgstr="Using "+document.getElementById('ucoid').value+" data, there are "+mnum+" records currently loaded.";
    showtooltip('Message',msgstr);
    document.getElementById('defaultco').innerHTML="  Current :  "+document.getElementById('ucoid').value+" /"+mnum+" records.";
    document.forms['custcareform'].mcust.options.length = 0;
    document.forms['custcareform'].mcust.options[0] = new Option('Leave search blank for entire list (15 seconds).','true');   
    

//clear the lock
removelock(oldid);

  }
}

 
function getreccnt(mwho,oldid) {
  var userurl = "includes/php/cc_get_reccnt_process.php?mid="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = mwho;
  var moidValue = oldid;
  http.open("GET", userurl + escape(midValue)+ "&oldid=" +escape(moidValue), true);
  http.onreadystatechange = getreccntResponse;
  http.send(null);
}



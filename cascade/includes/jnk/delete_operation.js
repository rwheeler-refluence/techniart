//function for deleting records

 function delrecordResponse() {

  if (http.readyState == 4) {

    results = http.responseText;
//alert(results);
    hidedelbox() 
    document.getElementById('mid').value ='';
    // did multiple so later we can break out actions, such as the final else being a catch all error.
    if (results=="Records have been moved from main database to their respective archives."){

      clrFields();
      hidewait();
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML=results;
 
    } else if (results=="Records have been moved to their respective archives.") {

      getAdd();
      hidewait();
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML=results;
      hidesadd();

   } else if (results=="User record has been moved to it's archive.") {

      getUsers();
      hidewait();
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML=results;
      hidesuser();

    } else if (results=="Password is incorrect, please enter the correct password.") {

      hidewait();
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML=results;

    } else if (results=="You must enter a password to delete records.") {

      hidewait();
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML=results;


    } else if (results=="No record chosen for delete operation.") {

      hidewait();
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML=results;

    } else {

      hidewait();
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML=results; //Error deleting records- can change this to get rid of criptic echo
      
    } 

   showconfirm();

  }

}


function delrecord(deltype) {
  var updateurl = "includes/php/delete_operation_process.php?mform="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();
//alert(document.getElementById('delpass').value);
if (document.getElementById('delpass').value=='froggy'){

  if (deltype == 'main') {

    s = new Array();

    s[0] = "mainrecord";
    s[1] = document.getElementById('delpass').value; 
    s[2] = document.getElementById('mcustid').value;
    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);

    http.onreadystatechange = delrecordResponse;

    http.send(null);

  } else if (deltype == 'contact'){

    s = new Array();

    s[0] = "contact";
    s[1] = document.getElementById('delpass').value; 
    s[2] = document.getElementById('auid').value;
    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);

    http.onreadystatechange = delrecordResponse;

    http.send(null);

  } else if (deltype == 'muser'){

    s = new Array();

    s[0] = "muser";
    s[1] = document.getElementById('delpass').value; 
    s[2] = document.getElementById('uid').value;

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = delrecordResponse;
    http.send(null);


  } else {

    hidewait();
    document.body.style.cursor='auto';

  }


} else {

   hidewait();
   hidedelbox(); 
   document.body.style.cursor='auto';
   document.getElementById('confirmtext').innerHTML="Password is incorrect.";
   showconfirm();

}




}
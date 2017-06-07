//function for adding a user edit

 function getadduserResponse() {

  if (http.readyState == 4) {

    results = http.responseText;
    getSingleAdd();
    hidewait();
    document.body.style.cursor='auto';
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();

  }

}


//function addUser() {

//  document.getElementById('confirmtext').innerHTML="Adding users is temporarily disabled";
//  showconfirm();

//}

function addUser() {

  var updateurl = "includes/php/cc_add_cust_process.php?mform="; // The server-side script
  document.body.style.cursor = "wait";
  showwait();

  s = new Array();
  //s[0] = "adduser";

  s[1] = document.getElementById('auid').value; //userid
  s[2] = document.getElementById('acid').value; //password
  s[3] = document.getElementById('aattn').value; //name
  s[4] = "1" //userlevel
  s[5] = document.getElementById('auid').value;  //username
  s[6] = document.getElementById('auid').value; //password
  s[7] = "adduser";

  //if (document.getElementById('MAP_VIEWERbox').checked == false) {
  //    s[8]= "N";
  //} else {s[8]= "Y"};

  s[8]= "Y";
  
  s[3]=s[3].replace(/\'/g,"zpos");
  s[5]=s[5].replace(/\'/g,"zpos");
  s[6]=s[6].replace(/\'/g,"zpos");
  
  s[3]=s[3].replace(/\,/g,"zcomma");
  s[5]=s[5].replace(/\,/g,"zcomma");
  s[6]=s[6].replace(/\,/g,"zcomma"); 
  
   //add custid for fox update
  s[9] = document.getElementById('mcustid').value; //cust id
  s[10] = document.getElementById('company').value; //company name for fox password dbf
  
  s[10]=s[10].replace(/\'/g,"zpos");
  s[10]=s[10].replace(/\,/g,"zcomma");

  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     rkey=/^/gi;
     s[myKey]=s[myKey].replace(/\^/g,"");
     s[myKey]=s[myKey].replace(/\|/g,"");
    
    }

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getadduserResponse;

  http.send(null);

}

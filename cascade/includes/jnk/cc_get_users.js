

function getUsersResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].userselect.options.length = 0;

    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {

       // pad out the elements if individual elements with 2 extra spaces to make display better
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',10)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',35)};
       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',20)};
       if (r1[3] != undefined){r1[3] = padRight(r1[3],' ',20)};

       document.forms['custcareform'].userselect.options[x] = new Option(r1[0]+r1[1]+r1[2]+r1[3],r1[0],true,false);

      }  

    }

    if (document.forms['custcareform'].userselect.options.length == 0) {
     document.forms['custcareform'].userselect.options[x] = new Option("No users defined for customer.",'true');
    }

hidewait();
document.body.style.cursor='auto';

  }
}

function getUsers() {
  var userurl = "includes/php/cc_get_users_process.php?mid="; // The server-side script
  var mrecord = "";
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = document.getElementById("mcustid").value;
  var usession = getmsession();
  http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getUsersResponse;
  http.send(null);
}


function getSingleUser() {

 if (document.forms['custcareform'].userselect.options[0].text != "No users defined for customer.") {

  var userurl = "includes/php/cc_get_singleuser_process.php?mid="; // The server-side script
  var mindex = document.forms['custcareform'].userselect.selectedIndex;
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = document.forms['custcareform'].userselect.options[mindex].value;
  var usession = getmsession();
  http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getSingleUsersResponse;
  http.send(null);


  } else {
 
    document.getElementById('confirmtext').innerHTML=document.forms['custcareform'].userselect.options[0].text;
    showconfirm();

  }

}

function getSingleUsersResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();

    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {

       // post elements
       document.getElementById('uid').value = r1[0];
       document.getElementById('ucid').value = r1[7];
       document.getElementById('unm').value = r1[1];
       document.getElementById('ulevel').value = r1[2];
       document.getElementById('uwebnm').value = r1[3];
       document.getElementById('uwebpass').value = r1[4];
       //document.getElementById('ulogdt').value = r1[5];
       //document.getElementById('ulogtime').value = r1[6];

       document.getElementById('oldusernm').value = r1[3];
       document.getElementById('oldpasswd').value = r1[4]; 
       
       
       
       if (r1[8]=="Y") {
          document.getElementById('MAP_VIEWERbox').checked=true;
       } else {
          document.getElementById('MAP_VIEWERbox').checked=false;
       }
 
      }  

    }

    if (document.forms['custcareform'].userselect.options.length == 0) {
     document.forms['custcareform'].userselect.options[x] = new Option("No users defined for customer.",'true');
    }

hidewait();
document.body.style.cursor='auto';

  //hide all edit buttons if edit is not enabled
  if (document.getElementById('EditEnabled').value=="N") {
    document.getElementById('usersave').style.visibility = "hidden";
    document.getElementById('userdelete').style.visibility = "hidden";
  } else {
    document.getElementById('usersave').style.visibility = "visible";
    document.getElementById('userdelete').style.visibility = "visible";

  }

showsuser();


  }
}



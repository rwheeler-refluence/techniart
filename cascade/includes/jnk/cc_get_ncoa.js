//function for the ncoa price table

 

function getNCOAResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].ncoaselect.options.length = 0;

    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
       // pad out the elements for table if individual elements not null
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',13)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',21)};
       if (r1[2] != undefined){r1[2] = padBoth(r1[2],' ',14)};
       if (r1[3] != undefined){r1[3] = padBoth(r1[3],' ',12)};
       if (r1[4] != undefined){r1[4] = padBoth(r1[4],' ',12)};
       if (r1[5] != undefined){r1[5] = padBoth(r1[5],' ',11)};
       if (r1[6] != undefined){r1[6] = padBoth(r1[6],' ',10)};
       if (r1[7] != undefined){r1[7] = padRight(r1[7],' ',3)};
    
       document.forms['custcareform'].ncoaselect.options[x] = new Option(r1[0]+r1[1]+r1[2]+r1[3]+r1[4]+r1[5]+r1[6]+r1[7],r1[1],true,false);
      }  

    }

    if (document.forms['custcareform'].ncoaselect.options.length == 0) {
     document.forms['custcareform'].ncoaselect.options[x] = new Option("No NCOA Prices found for customer.",'true');
    }

    checkNCOAstatus();
    hidewait();
    document.body.style.cursor='auto';

  }
}

function getNCOA() {
  var tkurl = "includes/php/cc_get_ncoa_process.php?mid="; // The server-side script
  var mrecord = "";
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = document.getElementById("mcustid").value;
  var usession = getmsession();
  http.open("GET", tkurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getNCOAResponse;
  http.send(null);
}


function getSingleNCOA() {

  if (document.forms['custcareform'].ncoaselect.options[0].text != "No NCOA Prices found for customer.") {

    var userurl = "includes/php/cc_get_singlencoa_process.php?mid="; // The server-side script
    var urlvar2 = "&mproc=";
    var mindex = document.forms['custcareform'].ncoaselect.selectedIndex;
    document.body.style.cursor = "wait";
    showwait();
    var midValue = document.getElementById("mid").value;  
    var midValue2 = document.forms['custcareform'].ncoaselect.options[mindex].value;
    midValue2=midValue2.replace(/\+/g,"*!*");
    var usession = getmsession();
    http.open("GET", userurl + escape(midValue) + urlvar2 + escape(midValue2)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getSinglecNCOAResponse;
    http.send(null);

  } else {
 
    document.getElementById('confirmtext').innerHTML=document.forms['custcareform'].ncoaselect.options[0].text;
    showconfirm();

  }


}

function getSinglecNCOAResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    //alert(http.responseText);

    results = http.responseText.split("^");
    r1= new Array();

    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
   
       // post elements
       document.getElementById('sncoaCUST_ID').value = r1[0];   
       document.getElementById('sncoaPROCESS').value = r1[1];
       document.getElementById('sncoaLESS1MM').value = r1[2];
       document.getElementById('sncoaMM1MM3').value = r1[3];
       document.getElementById('sncoaMM3MM5').value = r1[4];
       document.getElementById('sncoaMM5MORE').value = r1[5];
       document.getElementById('sncoaMINIMUM').value = r1[6];
       document.getElementById('sncoaCUSTTYPE').value = r1[7];          

     }  

    }

 
hidewait();
document.body.style.cursor='auto';

   //hide all edit buttons
  if (document.getElementById('EditEnabled').value=="N") {
    document.getElementById('ncoasave').style.visibility = "hidden";
  } else {
    document.getElementById('ncoasave').style.visibility = "visible";

  }

showsncoa();

  }
}
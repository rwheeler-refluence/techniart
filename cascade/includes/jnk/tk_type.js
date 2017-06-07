
// the next two functions are for getting file type select
function gettktypes() {
  var usession = getmsession();
  var updateurl = "includes/php/tk_type_process.php"; // The server-side script
  http.open("GET", updateurl, true);
  http.onreadystatechange = gettktypesResponse;
  http.send(null);
}

function gettktypesResponse() {
 

  if (http.readyState == 4) {
    // Split the comma delimited response into an array
    
    results = http.responseText.split("^");
    r1= new Array();
    document.forms['ticketform'].tkrptselect.options.length = 0;
    document.forms['ticketform'].tkrptselect.options[0] = new Option("CLICK HERE FOR OPEN TICKET REPORTS","1",true,false);
    var newoption=0;
    results.reverse();
    for (x in results)
    {

         
     r1 = results[x].split("|");

     if (trim(r1[0]) !=""){
      if (typeof r1[0] != "undefined")
      {
       newoption=newoption+1; 
       document.forms['ticketform'].tkrptselect.options[newoption] = new Option(r1[1],r1[0],true,false);
      }
     }   
    
    }

      if (document.forms['ticketform'].tkrptselect.options.length == 0)
       {
          document.forms['ticketform'].tkrptselect.options[x] = new Option("No ticket types defined."," ",true,false);
       }


//var i=document.forms['ticketform'].tkrptselect.options.length;
//do not increase i because the options start with 0;

// call the function in tk_get_tickets_fox.js
tkCTK();
  }
}



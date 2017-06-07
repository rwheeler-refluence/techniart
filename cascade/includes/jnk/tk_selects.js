
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

    //do filter select
    document.forms['ticketform'].tktypefilter.options.length = 0;
    document.forms['ticketform'].tktypefilter.options[0] = new Option("FILTER BY TYPE","1",true,false);
 
    document.forms['ticketform'].addtktypeselect.options.length = 0;
    document.forms['ticketform'].addtktypeselect.options[0] = new Option("TYPE","1",true,false);


    document.forms['ticketform'].tktypeselect.options.length = 0;
    document.forms['ticketform'].tktypeselect.options[0] = new Option("TYPE","1",true,false);


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
       document.forms['ticketform'].tktypefilter.options[newoption] = new Option(r1[1],r1[0],true,false);
       document.forms['ticketform'].addtktypeselect.options[newoption] = new Option(r1[1],r1[0],true,false);
       document.forms['ticketform'].tktypeselect.options[newoption] = new Option(r1[1],r1[0],true,false);

      }
     }   
    
    }

      if (document.forms['ticketform'].tkrptselect.options.length == 0)
       {
          document.forms['ticketform'].tkrptselect.options[x] = new Option("No ticket types defined."," ",true,false);
          document.forms['ticketform'].tktypefilter.options[x] = new Option("No ticket types defined."," ",true,false);
          document.forms['ticketform'].addtktypeselect.options[x] = new Option("None"," ",true,false);
          document.forms['ticketform'].tktypeselect.options[x] = new Option("None"," ",true,false);

       }



//remove the A- ALL OPEN REPORTS from three type picklist
document.forms['ticketform'].addtktypeselect.remove(1);
document.forms['ticketform'].tktypeselect.remove(1);
document.forms['ticketform'].tktypefilter.remove(1);


//get the staff select;
gettkstaff();
//tkCTK();
  }
}

// the next two functions are for getting staff select
function gettkstaff() {
  var usession = getmsession();
  var updateurl = "includes/php/tk_staff_process.php"; // The server-side script
  http.open("GET", updateurl, true);
  http.onreadystatechange = gettkstaffResponse;
  http.send(null);
}

function gettkstaffResponse() {
 
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    //alert(http.responseText);

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['ticketform'].tkwhofilter.options.length = 0;
    document.forms['ticketform'].tkwhofilter.options[0] = new Option("FILTER BY STAFF","1",true,false);

    document.forms['ticketform'].addtkwhoselect.options.length = 0;
    document.forms['ticketform'].addtkwhoselect.options[0] = new Option("STAFF","1",true,false);
 
    document.forms['ticketform'].tkwhoselect.options.length = 0;  
    document.forms['ticketform'].tkwhoselect.options[0] = new Option("STAFF","1",true,false);

    document.forms['ticketform'].addtkcis1select.options.length = 0;
    document.forms['ticketform'].addtkcis1select.options[0] = new Option("ADDITIONAL STAFF 2","1",true,false);
  
    document.forms['ticketform'].tkcis1select.options.length = 0;
    document.forms['ticketform'].tkcis1select.options[0] = new Option("ADDITIONAL STAFF 2","1",true,false);


    var newoption=0;
    results.sort();

    for (x in results)
    {

         
     r1 = results[x].split("|");

     if (trim(r1[0]) !=""){
      if (typeof r1[0] != "undefined")
      {
       newoption=newoption+1; 
       document.forms['ticketform'].tkwhofilter.options[newoption] = new Option(r1[0]+" -"+r1[1],r1[0],true,false);
       document.forms['ticketform'].addtkwhoselect.options[newoption] = new Option(r1[0],r1[0],true,false);
       document.forms['ticketform'].addtkcis1select.options[newoption] = new Option(r1[0],r1[0],true,false);
       document.forms['ticketform'].tkwhoselect.options[newoption] = new Option(r1[0],r1[0],true,false);
       document.forms['ticketform'].tkcis1select.options[newoption] = new Option(r1[0],r1[0],true,false);


      }
     }   
    
    }

      if (document.forms['ticketform'].tkwhofilter.options.length == 0)
       {
          document.forms['ticketform'].tkwhofilter.options[x] = new Option("No Staff defined."," ",true,false);
          document.forms['ticketform'].addtkwhoselect.options[x] = new Option("No Staff defined."," ",true,false);
          document.forms['ticketform'].addtkcis1select.options[x] = new Option("No Staff defined."," ",true,false);
          document.forms['ticketform'].tkwhoselect.options[x] = new Option("No Staff defined."," ",true,false);
          document.forms['ticketform'].tkcis1select.options[x] = new Option("No Staff defined."," ",true,false);

       }

tkCTK();
//gettkclnt(); //this would retrieve the list from xml file
  }
}


// the next two functions are for getting client xml select
function gettkclnt() {
  var usession = getmsession();
  var updateurl = "includes/php/tk_clntxml_process.php"; // The server-side script
  http.open("GET", updateurl, true);
  http.onreadystatechange = gettkclntResponse;
  http.send(null);
}

function gettkclntResponse() {
 
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    //alert(http.responseText);

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['ticketform'].tkclientfilter.options.length = 0;
    document.forms['ticketform'].tkclientfilter.options[0] = new Option("FILTER BY CLIENT","1",true,false);
    var newoption=0;
    results.sort();

    for (x in results)
    {

         
     r1 = results[x].split("|");

     if (trim(r1[0]) !=""){
      if (typeof r1[0] != "undefined")
      {
       newoption=newoption+1; 
       document.forms['ticketform'].tkclientfilter.options[newoption] = new Option(r1[0]+" -"+r1[1],r1[0],true,false);
      }
     }   
    
    }

      if (document.forms['ticketform'].tkclientfilter.options.length == 0)
       {
          document.forms['ticketform'].tkclientfilter.options[x] = new Option("No Clients defined."," ",true,false);
       }

tkCTK();
  }
}


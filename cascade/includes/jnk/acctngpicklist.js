 
// the next three are for the customer search browse 

// this waits fires server side php page
//used the tk_ php lookup script
function acctngpicklist() {
var murl = "includes/php/tk_cust_lookup_process.php?mname="; // The server-side script  
   clearAcctng();
   document.body.style.cursor = "wait";
   showwait();
   var nmValue = document.getElementById("acctng_mid").value;
   var usession = getmsession();
   http.open("GET", murl + escape(nmValue) + "&usession=" +escape(usession), true);   
   http.onreadystatechange = acctngpicklistResponce;
   http.send(null);

}

// this handles the responce from the server side php page and loads the customer list
function acctngpicklistResponce() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['acctngform'].acctngclientfilter.options.length = 0;
 
    //empty tickets on new search	
    document.forms['acctngform'].tkselectAcctng.options.length = 0;
   	document.getElementById('acctngmsgtext').innerHTML='Record not found matching this ID number.';
	 
    
    
    //document.forms['acctngform'].acctngclientfilter.options[0] = new Option("Pick Customer From List.",'true');
    xi=0;         

     for (x in results)
    {
       
    
    r1 = results[x].split("|");
    
      if (typeof r1[0] != "undefined")
      {
         if (xi==0){
           document.forms['acctngform'].acctngclientfilter.options[0] = new Option("Click here to pick customer from list.",'true');
           document.forms['acctngform'].acctngclientfilter.options[1] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+2
         } else { 
           document.forms['acctngform'].acctngclientfilter.options[xi] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+1
         }
      }  
    
    }

      if (document.forms['acctngform'].acctngclientfilter.options.length == 0)
       {
          document.forms['acctngform'].acctngclientfilter.options[xi] = new Option("No Customers Found Matching The Search.",'true');
       }



    // if there is only one cust
    //if (document.forms['acctngform'].acctngclientfilter.options.length==3){
    //   document.forms['acctngform'].acctngclientfilter.selectedIndex=1;
    //   //alert("triggered");  
    //}

    //clear if not found
    if (document.forms['acctngform'].acctngclientfilter.options[1].text ==" - undefined")
    {
	        
	   document.forms['acctngform'].acctngclientfilter.options[1] =null; 
       document.forms['acctngform'].acctngclientfilter.options[0] = new Option("No Customers Found.",'true');
    }

hidewait();
document.body.style.cursor='auto';

  }
}



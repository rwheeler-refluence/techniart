 
// the next three are for the customer search browse 

// this waits fires server side php page

function gettkPickList() {
var murl = "includes/php/tk_cust_lookup_process.php?mname="; // The server-side script  

   document.body.style.cursor = "wait";
   showwait();
   var nmValue = document.getElementById("tk_mid").value;
   var usession = getmsession();
   http.open("GET", murl + escape(nmValue) + "&usession=" +escape(usession), true);   
   http.onreadystatechange = gettkPickListResponce;
   http.send(null);

}

// this handles the responce from the server side php page and loads the customer list
function gettkPickListResponce() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['ticketform'].tkclientfilter.options.length = 0;
 
    //document.forms['ticketform'].tkclientfilter.options[0] = new Option("Pick Customer From List.",'true');
    xi=0;         

     for (x in results)
    {
       
    
    r1 = results[x].split("|");
    
      if (typeof r1[0] != "undefined")
      {
         if (xi==0){
           document.forms['ticketform'].tkclientfilter.options[0] = new Option("Click Here To Pick Customer From List.",'true');
           document.forms['ticketform'].tkclientfilter.options[1] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+2
         } else { 
           document.forms['ticketform'].tkclientfilter.options[xi] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+1
         }
      }  
    
    }

      if (document.forms['ticketform'].tkclientfilter.options.length == 0)
       {
          document.forms['ticketform'].tkclientfilter.options[xi] = new Option("No Customers Found Matching The Search.",'true');
       }



    // if there is only one cust
    if (document.forms['ticketform'].tkclientfilter.options.length==3){
       document.forms['ticketform'].tkclientfilter.selectedIndex=1;
       //alert("triggered");  
    }



hidewait();
document.body.style.cursor='auto';

  }
}


//THIS ONE IS FOR THE ADD TICKET SCREEN
function getADDtkPickList() {
var murl = "includes/php/tk_cust_lookup_process.php?mname="; // The server-side script  

   document.body.style.cursor = "wait";
   showwait();
   var nmValue = document.getElementById("tk_addmid").value;
   var usession = getmsession();
   http.open("GET", murl + escape(nmValue) + "&usession=" +escape(usession), true);   
   http.onreadystatechange = getADDtkPickListResponce;
   http.send(null);

}

// this handles the responce from the server side php page and loads the customer list
function getADDtkPickListResponce() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['ticketform'].tkclientadd.options.length = 0;
 
    //document.forms['ticketform'].tkclientadd.options[0] = new Option("Pick Customer From List.",'true');
    xi=0;         

     for (x in results)
    {
       
    
    r1 = results[x].split("|");
    
      if (typeof r1[0] != "undefined")
      {
         if (xi==0){
           document.forms['ticketform'].tkclientadd.options[0] = new Option("Click Here To Pick Customer From List.",'true');
           document.forms['ticketform'].tkclientadd.options[1] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+2
         } else { 
           document.forms['ticketform'].tkclientadd.options[xi] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+1
         }
      }  
    
    }

      if (document.forms['ticketform'].tkclientadd.options.length == 0)
       {
          document.forms['ticketform'].tkclientadd.options[xi] = new Option("No Customers Found Matching The Search.",'true');
       }

hidewait();
document.body.style.cursor='auto';

  }
}

//THIS ONE IS FOR THE generic lookup screen
function getclntPickList() {
var murl = "includes/php/tk_cust_lookup_process.php?mname="; // The server-side script  

   document.body.style.cursor = "wait";
   showwait();
   var nmValue = document.getElementById("clnt_mid").value;
   var usession = getmsession();
   http.open("GET", murl + escape(nmValue) + "&usession=" +escape(usession), true);   
   http.onreadystatechange = getclntPickListResponce;
   http.send(null);

}

// this handles the responce from the server side php page and loads the customer list
function getclntPickListResponce() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['ticketform'].clientfilter.options.length = 0;
    xi=0;         

     for (x in results)
    {
       
    
    r1 = results[x].split("|");
    
      if (typeof r1[0] != "undefined")
      {
         if (xi==0){
           document.forms['ticketform'].clientfilter.options[0] = new Option("Click Here To Pick Customer From List.",'true');
           document.forms['ticketform'].clientfilter.options[1] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+2
         } else { 
           document.forms['ticketform'].clientfilter.options[xi] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+1
         }
      }  
    
    }

      if (document.forms['ticketform'].clientfilter.options.length == 0)
       {
          document.forms['ticketform'].clientfilter.options[xi] = new Option("No Customers Found Matching The Search.",'true');
       }

hidewait();
document.body.style.cursor='auto';

  }
}

function passID(){
	
  if (document.getElementById('mtksinglescrup').value=='YES') {
     var mselect=document.forms['ticketform'].clientfilter.selectedIndex;
     var mid=document.forms['ticketform'].clientfilter.options[mselect].text;
     document.getElementById('tk_stkNewCUST_ID').value = mid.substring(0,6);
     
  }
  
hideclientfind();
   	
}
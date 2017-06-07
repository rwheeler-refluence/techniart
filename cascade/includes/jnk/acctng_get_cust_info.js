 
// the next two functions retrieve the customer information
function acctng_getCinfo(){
  clearAcctng();
  
  var url = "includes/php/acctng_get_custinfo_process.php?mid="; // The server-side script 
  document.body.style.cursor = "wait";
  showwait();
  var midValue= document.getElementById("acctng_mid").value;
  //alert(midValue);
  var usession = getmsession();
  http.open("GET", url + escape(midValue) + "&usession=" +escape(usession), true);
  http.onreadystatechange = acctng_getCinfoResponse;
  http.send(null);

}

function acctng_getCinfoResponse() {

  if (http.readyState == 4) {

    //test for fiel update
    var updatetest = http.responseText;
    //alert(updatetest);
    
    // Split the comma delimited response into an array
	mainresults = http.responseText.split("^");
	results= new Array();
	
	results = mainresults[0].split("|");
		
	for (t in results){
      results[t]=trim(results[t]);
    }
	
	//for now left the full accounting record return intact in the php but can remove once we get far enough a long
	//that we are sure not needed
	if (trim(results[0]) == 'Record not found matching this ID number.') {
		  //empty tickets on new search	
          //document.forms['acctngform'].tkselectAcctng.options.length = 0;
   	      //document.getElementById('acctngmsgtext').innerHTML='Record not found matching this ID number.';
	      //took out the above
	      //showAcctngmsg();
	      //alert("No records found.");
	} else {
	
		results[0]=results[0].replace(/\zpos/g,"\'");	    
		if (results[0].substring(0,6) !="Object") {document.getElementById('a_company').innerHTML=trim(results[0]+'&nbsp;&nbsp;&nbsp;&nbsp;Customer ID :&nbsp;&nbsp;'+trim(results[15]))} else {document.getElementById('a_company').innerHTML=''};

	} // end of not found condition    	
    hidewait();
    document.body.style.cursor='auto';


  } //end of ready state

}
// end of cust info retrieval

function clearAcctng(){
	
	document.getElementById('a_company').innerHTML='';
	
	document.forms['acctngform'].acctngclientfilter.options.length = 0;
	document.forms['acctngform'].acctngclientfilter[0] = new Option("Type all or part of name or Customer ID above for new search."," ",true,false);

}	
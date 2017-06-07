//function for updating an edit

 function addeditcustResponse() {
	 
  if (http.readyState == 4) {
    results = http.responseText.split('|');
    var mtest=http.responseText;
    
   //alert(mtest)
    
    //hidewait();
    document.body.style.cursor='auto';

    if (results[0].indexOf("Invalid Cascade Member district.") > -1 ){
         
         document.getElementById('themessage').innerHTML="Invald Cascade member district.<br>";
         showSec('messagescr');
         
    } else {

	  //lets tell customer what happened
      if (results[0].indexOf("savedtheaccount") > -1 || results[0].indexOf("addedtheaccount") > -1 ){
	    
	     document.getElementById('themessage').innerHTML="<b>This customer info has been saved.</b><br>";
         showSec('messagescr');
	     //alert("This customer info has been saved");
	     
      } else {
	     document.getElementById('themessage').innerHTML="<b>Error saving information, please try again.</b><br>If the problem persists please call 1-800-632-1379 for assistance.";
         showSec('messagescr');
	     //alert('Error saving information, please try again. If the problem persist please call 1-800-632-1379 for assistance.');   
  	           
      }
    
    }

    //lets set login with new info and save cookie
    acctinfo= eval("(" + results[1] + ")");
    var thelname = acctinfo['fname']; 
      
    //alert(thelname);
    
	if (trim(thelname) !=""){
	
	   document.getElementById('userlbl').innerHTML="Hello "+thelname+"    |";
	   document.getElementById('useracctlbl').style.display = "block";
       document.getElementById("userlbl").style.left="745px"; 
       document.getElementById("cartlbl").style.left="910px";
       
       document.getElementById('j1').value=acctinfo['acct'];    
       document.getElementById('j2').value=acctinfo['pass'];   
       document.getElementById('j3').value="Y";
       
       //var cookievar=acctinfo.toString();
       var cookievar = JSON.stringify(acctinfo);

       //load acctount info to a cookie
       setCookie('cinfo',cookievar,365);
    }
    
    
    //close the edit screen if new
    //if (results[0].indexOf("addedtheaccount") > -1 ){
  	     //showSec('prods'); 
    //}
    
    showSec('prods'); 
    
  }

}

  			  
			  		
function addeditCust() {
  var updateurl = "includes/php/cust_process.php?mform="; // The server-side script
 
  var checkforErrors="";
  
  //alert('in save edit function');
  //document.body.style.cursor = "wait";
  //showwait();

checkforErrors=validCustaddInfo();
//alert(checkforErrors);


if (checkforErrors==""){

    s = new Array();
    
    s[0] = trim(document.getElementById('acct_num').value);
    s[1] = trim(document.getElementById('fname').value);
    s[2] = trim(document.getElementById('lname').value);
    s[3] = trim(document.getElementById('add1').value);
    s[4] = trim(document.getElementById('add2').value);
    s[5] = trim(document.getElementById('city').value);
    s[6] = trim(document.getElementById('state').value);
    s[7] = trim(document.getElementById('zip').value);
    
    var x = document.getElementById("cascade_member").selectedIndex;
    var y = document.getElementById("cascade_member").options;
    //alert("Index: " + y[x].index + " is " + y[x].text);
    
    
    s[8] = trim(y[x].text);
    s[9] = trim(document.getElementById('b_fname').value);
    s[10] = trim(document.getElementById('b_lname').value);
    s[11] = trim(document.getElementById('b_add1').value);
    s[12] = trim(document.getElementById('b_add2').value);
    s[13] = trim(document.getElementById('b_city').value);
    s[14] = trim(document.getElementById('b_state').value);
    s[15] = trim(document.getElementById('b_zip').value);
    s[16] = trim(document.getElementById('email').value);
    s[17] = trim(document.getElementById('phone').value);
    s[18] = trim(document.getElementById('pass').value);
    s[19] = trim(document.getElementById('pass2').value);
 
  for(myKey in s){
  
     s[myKey]=s[myKey].replace(/\'/g,'');
  
  }

  http.open("GET", updateurl + escape(s), true);
  http.onreadystatechange = addeditcustResponse;
  http.send(null);


} else {

  //hidewait();
  //document.body.style.cursor='auto';
  document.getElementById('themessage').innerHTML=checkforErrors;
  showSec('messagescr');
  
  //alert(checkforErrors);
  

}


}


function validCustaddInfo(){

	var checkforErrors="";
	
	if ( trim(document.getElementById('pass').value) != trim(document.getElementById('pass2').value) ) {
	  	checkforErrors = checkforErrors+"Passwords do not match. <br>";
	}
	
	var mlen =0;
	
	
	var skillsSelect = document.getElementById("cascade_member");
    var selectedText = skillsSelect.options[skillsSelect.selectedIndex].text;
	
    if ( trim(selectedText)=="Select a District"){	
	   checkforErrors = checkforErrors+"Please pick your water district from the drop down menu.<br>"; 
	};
    
    
	
	if ( trim(document.getElementById('acct_num').value)=="" ){	mlen++};	
	if ( trim(document.getElementById('fname').value)=="" ){ mlen++};    
	if ( trim(document.getElementById('lname').value)=="" ){ mlen++};    
	if ( trim(document.getElementById('add1').value)=="" ){ mlen++};    
    if ( trim(document.getElementById('city').value)=="" ){ mlen++};
    if ( trim(document.getElementById('state').value)=="" ){ mlen++};
    if ( trim(document.getElementById('zip').value)=="" ){ mlen++};    
    if ( trim(document.getElementById('b_fname').value)=="" ){ mlen++};
    if ( trim(document.getElementById('b_lname').value)=="" ){ mlen++};
    if ( trim(document.getElementById('b_add1').value)=="" ){ mlen++};
    //if ( trim(document.getElementById('b_add2').value)=="" ){ mlen++};
    if ( trim(document.getElementById('b_city').value)=="" ){ mlen++};
    if ( trim(document.getElementById('b_state').value)=="" ){ mlen++};
    if ( trim(document.getElementById('b_zip').value)=="" ){ mlen++};
    if ( trim(document.getElementById('email').value)=="" ){ mlen++};
    if ( trim(document.getElementById('phone').value)=="" ){ mlen++};
    if ( trim(document.getElementById('pass').value)=="" ){ mlen++};
    if ( trim(document.getElementById('pass2').value)=="" ){ mlen++};
	
	if ( mlen > 0){
        checkforErrors = checkforErrors+"You cannot leave any fields other than the 2nd address lines empty. <br>";
	}
	
	
	return checkforErrors;
	
}

 
 function sndpass() {
	 
  var updateurl = "includes/php/pass_process.php?mform="; // The server-side script
 
 

    s = new Array();
    
    s[0] = trim(document.getElementById('theacctnum22').value);
  
  for(myKey in s){
  
     s[myKey]=s[myKey].replace(/\'/g,'');
  
  }

  http.open("GET", updateurl + escape(s), true);
  http.onreadystatechange = sndpassResponse;
  http.send(null);




}

function sndpassResponse() {
	 
  if (http.readyState == 4) {
	  
    results = http.responseText;
      
    //alert(http.responseText);
    
    //hidewait();
    document.body.style.cursor='auto';
    document.getElementById('forgotpass').style.visibility = "hidden";
    
    if (results.indexOf("Invalid Cascade member") > -1 ){
         
         document.getElementById('themessage').innerHTML="Invald Cascade member email.<br>";
         showSec('messagescr');
         
    } else {
   
	     document.getElementById('themessage').innerHTML="An email has been sent to this address with your log-in information.<br>";
         showSec('messagescr');
	     //alert("This customer info has been saved");     
    
    }

  }

}

//function for updating an edit

 function loginResponse() {
	 
  if (http.readyState == 4) {
    
    //alert(http.responseText);
    //return;
    
    //hidewait();
    /*
    $mret = array('cascade_acct' => $cascade_acct,
     'fname' => $fname,
     'lname' => $lname,
     'add1' => $add1,
     'add2' => $add2,
     'city' => $city,
     'zip' => $zip,
     'cascade_member' => $cascade_member,
     'b_fname' => $b_fname,
     'b_lname' => $b_lname,
     'b_add1' => $b_add1,
     'b_add2' => $b_add2,
     'b_city' => $b_city,
     'b_state' => $b_state,
     'b_zip' => $b_zip,
     'email' => $email,
     'phone' => $phone,
     'pass' => $pass );
    */  
    
    var thelname="";
    
    document.body.style.cursor='auto';
    results = http.responseText.split('|');
    
    acctinfo= eval("(" + results[0] + ")");
    var thelname = acctinfo['fname']; 
      
    //alert('login:'+http.responseText);
   
    
     
	if (trim(thelname) !=""){
	
	   document.getElementById('userlbl').innerHTML="Hello "+thelname+"    |";
	   document.getElementById('useracctlbl').style.display = "block";
	   document.getElementById('userlbllout').style.display = "block";
	    document.getElementById("userlbllout").style.left="655px"; 
       document.getElementById("userlbl").style.left="745px"; 
       document.getElementById("cartlbl").style.left="910px";
       
       document.getElementById('j1').value=acctinfo['acct'];    
       document.getElementById('j2').value=acctinfo['pass'];   
       document.getElementById('j3').value="Y";
       
       
       cartinfo= eval("(" + results[1] + ")");
       
       if (cartinfo !=null){
         if (cartinfo['p1'] > 0){
   		    document.getElementById('p1').value=cartinfo['p1'];
		 } 
		 if(cartinfo['p2'] > 0){ 
            document.getElementById('p2').value=cartinfo['p2'];
		 } 
		 if(cartinfo['p3'] > 0){ 
			document.getElementById('p3').value=cartinfo['p3']; 
         } 
         if(cartinfo['p4'] > 0){ 
            document.getElementById('p4').value=cartinfo['p4'];
	     } 
	     if(cartinfo['p5'] > 0){ 
            document.getElementById('p5').value=cartinfo['p5'];
		 } 
		 if(cartinfo['p6'] > 0){ 
            document.getElementById('p6').value=cartinfo['p6'];
		 } 
		 if(cartinfo['p7'] > 0){ 
            document.getElementById('p7').value=cartinfo['p7'];
	     } 
	     if(cartinfo['p8'] > 0){ 
            document.getElementById('p8').value=cartinfo['p8'];
		 } 
		 if(cartinfo['p9'] > 0){ 
            document.getElementById('p9').value=cartinfo['p9'];
		 } 
		 if(cartinfo['p10'] > 0){ 
            document.getElementById('p10').value=cartinfo['p10'];
	     }
       }
       
       //alert('setting cookie');
       
       //var cookievar=acctinfo.toString();
       var cookievar = JSON.stringify(acctinfo);

       //load acctount info to a cookie
       setCookie('cinfo',cookievar,365);
       
       
       //var cookievar=acctinfo.toString();
       var cartvar = JSON.stringify(cartinfo);

       //load acctount info to a cookie
       setCookie('cartinfo',cartvar,365);
       //alert('cookie set');
       
    } else {
	    
	    alert(http.responseText);

	}    
 
   
    //showSec('prods');   
    
  }

}




			  		
function mlogin() {
  var updateurl = "includes/php/login_process.php?mform="; // The server-side script
 
  var checkforErrors="";
  
  //alert('in function');
  //document.body.style.cursor = "wait";
  //showwait();

checkforErrors=validCustInfo();
//alert(checkforErrors);


if (checkforErrors==""){

    s = new Array();
    
    s[0] = trim(document.getElementById('theacctnum').value);
    s[1] = trim(document.getElementById('thepass').value);
   
 
  for(myKey in s){
  
     s[myKey]=s[myKey].replace(/\'/g,'');
  
  }
  
   
  //alert('testing');
  
  hideSec();
  http.open("GET", updateurl + escape(s), true);
  http.onreadystatechange = loginResponse;
  http.send(null);


} else {

  //hidewait();
  //document.body.style.cursor='auto';
  //alert(checkforErrors);
  document.getElementById('themessage').innerHTML=checkforErrors;
  showSec('messagescr');

}


}


function validCustInfo(){

	var checkforErrors="";
	
	var mlen =0;
	
	
 
	if ( trim(document.getElementById('theacctnum').value)=="" ){	mlen++};	
	if ( trim(document.getElementById('thepass').value)=="" ){ mlen++};    
	
	
	if ( mlen > 0){
        checkforErrors = checkforErrors+"You must enter in your account number and password. \n";
	}
	
		
	return checkforErrors;
	
}

 


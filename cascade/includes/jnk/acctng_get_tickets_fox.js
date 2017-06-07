//function for getting tickets for the main ticket section

 

function getacctngrecResponse(){

  if (http.readyState == 4) {

    // Split the delimited response into an array
    //alert(http.responseText);
    results = http.responseText.split("^");
    r1= new Array();
    document.forms['acctngform'].tkselectAcctng.options.length = 0;
    mnumrecs=0;
    for (x in results)
    {
     clearAcctng(); //moved this from get accounting customer and not using cust info for now
     r1 = results[x].split("|");
         if (r1[1] != undefined){
	         
		    if ((trim(r1[26])=="N" && document.getElementById('a_opentkbox').checked == true) || (document.getElementById('a_opentkbox').checked == false)){
	    
		
		     if (trim(r1[32]) !="Y"){  
			   var mall="N";  
	           document.getElementById('acctpickmsg').innerHTML="Single Client Tickets:";
	         
	           if (trim(r1[33]) =="Y"){   
	            document.getElementById('acctpickmsg').innerHTML="Single Client Tickets / No Invoice only."; 
	           }

	         } else {
		       var mall="Y"; 
		       document.getElementById('acctpickmsg').innerHTML="Multiple Client Tickets:";
		         if (trim(r1[33]) =="Y"){   
   	               document.getElementById('acctpickmsg').innerHTML="Multiple Client Tickets / No Invoice only."; 
   	             }
   	   
   	         }
      
      
          
       	    //took the next two SQL out for fox-convert fox converted dates to display
   	        //r1[1]=r1[1].charAt(4)+r1[1].charAt(5)+"/"+r1[1].charAt(6)+r1[1].charAt(7)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
   	        //r1[2]=r1[2].charAt(4)+r1[2].charAt(5)+"/"+r1[2].charAt(6)+r1[2].charAt(7)+"/"+r1[2].charAt(2)+r1[2].charAt(3);

   	        
   	        if (document.getElementById("ucoid").value=='CIS'){    
          		r1[1]=r1[1].charAt(5)+r1[1].charAt(6)+"/"+r1[1].charAt(8)+r1[1].charAt(9)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
          		r1[3]=r1[3].charAt(5)+r1[3].charAt(6)+"/"+r1[3].charAt(8)+r1[3].charAt(9)+"/"+r1[3].charAt(2)+r1[3].charAt(3);
                if (r1[3]=='00/00/00') { r1[3]='//' };
        	} else { 
   	        
	        	//this is for fox	
            	if (r1[1].charAt(1) =="/"){
       	      		if (parseInt(r1[1].charAt(0)) < 10) {r1[1]="0" + r1[1]};
            	}
            	
            	if (r1[3].charAt(1) =="/"){
               		if (parseInt(r1[3].charAt(0)) < 10) {r1[3]="0" + r1[3]};
            	}
 
            	//1 job date
            	if (r1[1].charAt(4) =="/"){
              		if (parseInt(r1[1].charAt(3)) < 10) {r1[1]=r1[1].substring(0,3)+"0" + r1[1].substring(3,9)};
            	}
      
            	//3 is date done
            	if (r1[3].charAt(4) =="/"){
              		if (parseInt(r1[3].charAt(3)) < 10) {r1[3]=r1[3].substring(0,3)+"0" + r1[3].substring(3,9)};
            	}

            	r1[1]=r1[1].substring(0,5)+"/"+r1[1].charAt(8)+r1[1].charAt(9);
            	r1[3]=r1[3].substring(0,5)+"/"+r1[3].charAt(8)+r1[3].charAt(9);

            	// if the value is 12:00  
            	if (r1[3].substring(0,5) =="12:00") { r1[3] = "" };
            }
            
            var isinvoiced="N"
            // check to see if invoiced  
            //if (r1[26].substring(0,5) !="12:00") { isinvoiced = "Y" };
            if (r1[26]=="Y") { isinvoiced = "Y" };
      
            // pad out the elements for table if individual elements not null
            if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',7)};
            if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',9)};
            if (r1[3] != undefined){r1[3] = padRight(r1[3],' ',9)};
            if (r1[6] != undefined){r1[6] = padRight(r1[6],' ',26)};
            if (r1[19] != undefined){r1[19] = padRight(r1[19],' ',7)};
            if (r1[25] != undefined){r1[25] = padRight(r1[25],' ',15)};
            if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',3)};
            if (r1[7] != undefined){r1[7] = padRight(r1[7],' ',17)};
            if (r1[11] != undefined){r1[11] = padRight(r1[11],' ',10)};
            
            document.forms['acctngform'].tkselectAcctng.options[mnumrecs] = new Option(r1[0]+r1[1]+r1[3]+r1[6]+r1[19]+r1[25]+r1[5]+r1[7]+" "+isinvoiced,r1[4]+"|"+r1[8]+"|"+r1[0],true,false);
            mnumrecs=mnumrecs+1;
            } //end of invoice only condition

    
     }// end of defined condition
    } // end of loop

    if (document.forms['acctngform'].tkselectAcctng.options.length == 0) {
       document.forms['acctngform'].tkselectAcctng.options[mnumrecs] = new Option("No orders found.",'true');
       document.getElementById('acctpickmsg').innerHTML="No client tickets loaded."
    }

  mnumrecs=mnumrecs+1;
  hidewait();
  document.body.style.cursor='auto';
  
  if (mall=="N"){  
    minfo = new Array();
    var minfo=document.forms['acctngform'].tkselectAcctng.options[0].value.split("|");
    //alert(minfo);  
    minfo[0]=minfo[0].replace(/\zpos/g,"\'");	    
	if (minfo[0].substring(0,6) !="Object") {
		document.getElementById('a_company').innerHTML=trim(minfo[0])+'&nbsp;&nbsp;&nbsp;&nbsp;Customer ID :&nbsp;&nbsp;'+trim(minfo[1]);
	    document.getElementById('acctng_mid').value=trim(minfo[1]);
	    // this is also under showinvoice.js -acctngcheckforinvoice()
	    
	} else {
		document.getElementById('a_company').innerHTML=''
		
    }
	
  }
  
  
  document.getElementById('numrecfound').innerHTML="Number of tickets found:  "+mnumrecs;
     //acctng_getCinfo();
  }
}

function getacctngrec(ispick){
  var tkurl = "includes/php/acctng_get_tk_process_fox.php?usession="; // The server-side script
  var mrecord = "";

  mf = new Array();
 
  var tmpnum1 = document.forms['acctngform'].acctngclientfilter.selectedIndex;
 
  if (document.getElementById('a_opentkbox').checked == true) {
      mf[0]= "Y";
  } else {
	  mf[0]= "N"
  }

  //alert(mf[0]);  
  
  if (ispick=="Y"){
	  
    mf[1] = document.forms['acctngform'].acctngclientfilter.options[tmpnum1].value.toUpperCase();;
    mf[1] = mf[1].substring(0,6);
    
  } else {
	mf[0]= "N";  
    mf[1] = document.getElementById('acctng_mid').value.toUpperCase();
    
  }	 
  
  document.getElementById('acctng_mid').value=mf[1];
   	  
  if (ispick=="A"){
	 document.forms['acctngform'].acctngclientfilter.selectedIndex=-1;
	 document.getElementById('acctng_mid').value="";
	 mf[1]="";
     mf[2]="A";	  
  }	else {
	 mf[2]="N";	 
  }	    
  
  if (ispick=="C"){
	 if (trim(document.getElementById('acctng_mid').value) !=""){
	    document.forms['acctngform'].acctngclientfilter.selectedIndex=-1;
        mf[1] = document.getElementById('acctng_mid').value.toUpperCase();
        mf[2]="N";	
     } else {
	    mf[1] =""; 
	    mf[2]="A";
     } 
            	
  } 
	  
	  
  
  
  //alert(mf[1]);
  document.body.style.cursor = "wait";
  showwait();  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
  http.onreadystatechange = getacctngrecResponse;
  http.send(null);

}





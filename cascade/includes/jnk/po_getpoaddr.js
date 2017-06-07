//function for getting shipping addresses for invoices
function getpoaddrResponse(){

  if (http.readyState == 4) {

    //alert(http.responseText);
	// Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    
    document.forms['poaddform'].po_vaddrs.options.length = 0;
    
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
          
          // pad out the elements for table if individual elements not null
       
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',31)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',36)};
       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',36)};
       if (r1[3] != undefined){r1[3] = padRight(r1[3],' ',21)};
       if (r1[4] != undefined){r1[4] = padRight(r1[4],' ',3)};
       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',6)};
              
       document.forms['poaddform'].po_vaddrs.options[x] = new Option(r1[0]+r1[1]+r1[2]+r1[3]+r1[4]+r1[5],r1[0]+"|"+r1[1]+"|"+r1[2]+"|"+r1[3]+"|"+r1[4]+"|"+r1[5],true,false);
      }  

    }

    if (document.forms['poaddform'].po_vaddrs.options.length == 0) {
       document.forms['poaddform'].po_vaddrs.options[x] = new Option("No addresses found.",'true');
    }

    hidewait();
    document.body.style.cursor='auto';
    showpovendor();
  }
}

function getpoaddr(){
  var tkurl = "includes/php/po_getvendor_process.php?usession="; // The server-side script
  
  mf = new Array();  
  mf[0] = document.getElementById('binv_cust_id').value.toUpperCase();
    
  document.body.style.cursor = "wait";
  showwait();  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mform=" +escape(mf), true);
  http.onreadystatechange = getpoaddrResponse;
  http.send(null);

}




function putvaddr(){

//assign value from shipping select	
var mnewadd=document.getElementById('po_vaddrs').value;

  // slpit out the record
  var r1=mnewadd.split("|");
  if (document.forms['poaddform'].po_vaddrs.selectedIndex > -1){
     //assign the values to the document
	 document.getElementById('spo_potocont').value=trim(r1[0]);
     document.getElementById('spo_potocomp').value=trim(r1[1]);
     document.getElementById('spo_potoadd1').value=trim(r1[2]);
     document.getElementById('spo_potocity').value=trim(r1[3]);
     document.getElementById('spo_potost').value=trim(r1[4]);
     document.getElementById('spo_potozip').value=trim(r1[5]);
  } else {   
	 //document.getElementById('pomsgtext').innerHTML="Please select a vendor.";
     //showpomsg();
     alert("Please select a vendor.");
      
  }   
	  
  	
}


function delvaddr(){
	
 var tkurl = "includes/php/po_delvendor_process.php?usession="; // The server-side script
  
  mf = new Array();  
  var msel=document.forms['poaddform'].po_vaddrs.selectedIndex;
  mf[0] =  document.forms['poaddform'].po_vaddrs.options[msel].value;
  document.forms['poaddform'].po_vaddrs.options[msel] = null;  
  document.body.style.cursor = "wait";
  showwait();  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mform=" +escape(mf), true);
  http.onreadystatechange = delvaddrResponse;
  http.send(null);
	
	
}

function delvaddrResponse(){

  if (http.readyState == 4) {

    alert(http.responseText);
	// Split the delimited response into an array

    hidewait();
    document.body.style.cursor='auto';
    
  }
}

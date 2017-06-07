//function for getting shipping addresses for invoices
function getshipaddrResponse(){

  if (http.readyState == 4) {

    alert(http.responseText);
	// Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    
    document.forms['shipaddform'].binv_shipaddrs.options.length = 0;
    
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
          
          // pad out the elements for table if individual elements not null
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',7)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',31)};
       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',36)};
       if (r1[3] != undefined){r1[3] = padRight(r1[3],' ',36)};
       if (r1[4] != undefined){r1[4] = padRight(r1[4],' ',21)};
       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',3)};
       if (r1[6] != undefined){r1[6] = padRight(r1[6],' ',6)};
       if (r1[8] != undefined){r1[8] = padRight(r1[8],' ',4)};
   
       
       document.forms['shipaddform'].binv_shipaddrs.options[x] = new Option(r1[0]+r1[1]+r1[2]+r1[3]+r1[4]+r1[5]+r1[6]+r1[8],r1[0]+"|"+r1[1]+"|"+r1[2]+"|"+r1[3]+"|"+r1[4]+"|"+r1[5]+"|"+r1[6]+"|"+r1[7],true,false);
      }  

    }

    if (document.forms['shipaddform'].binv_shipaddrs.options.length == 0) {
       document.forms['shipaddform'].binv_shipaddrs.options[x] = new Option("No addresses found.",'true');
    }

    hidewait();
    document.body.style.cursor='auto';
    showbinvship();
  }
}

function getshipaddr(){
  var tkurl = "includes/php/binv_getship_process.php?usession="; // The server-side script
  
  mf = new Array();  
  mf[0] = document.getElementById('binv_cust_id').value.toUpperCase();
    
  document.body.style.cursor = "wait";
  showwait();  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mform=" +escape(mf), true);
  http.onreadystatechange = getshipaddrResponse;
  http.send(null);

}




function putshipaddr(){

//assign value from shipping select	
var mnewadd=document.getElementById('binv_shipaddrs').value;

  // slpit out the record
  var r1=mnewadd.split("|");

     //assign the values to the document
	 document.getElementById('binv_shipcont').value=r1[1];
     document.getElementById('binv_shipcomp').value=r1[2];
     document.getElementById('binv_shipadd1').value=r1[3];
     document.getElementById('binv_shipcity').value=r1[4];
     document.getElementById('binv_shipst').value=r1[5];
     document.getElementById('binv_shipzip').value=r1[6];
  	 document.getElementById('binv_shipzip4').value=r1[7];
  	 
}



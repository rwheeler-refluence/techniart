function getpos() {
  clearpos();
  //if (document.getElementById('ucoid').value=="CDS"){
  //   alert(document.getElementById('tk_stkJOB_ID').value);	
  //} 
  
  var updateurl = "includes/php/get_po_fox.php?mform="; // The server-side script
  if (trim(document.getElementById('tk_stkJOB_ID').value) != "") {

    s = new Array(); 
    s[0] = document.getElementById('tk_stkJOB_ID').value;
    //document.body.style.cursor = "wait";
    //showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getposResponse;
    http.send(null);

  } else {
   //alert("in here");
    document.getElementById('pomsgtext').innerHTML="Error getting purchase orders.";
    showpomsg();

  }


}

//get po invoice responce
function getposResponse() {

  if (http.readyState == 4) {

     document.getElementById('po_JOB_ID').value=document.getElementById('tk_stkJOB_ID').value;
//if (document.getElementById('ucoid').value=="CDS"){
  //alert(http.responseText);
//} 
     var mtest=http.responseText.split("^");
     rtest = mtest[0].split("|");
     
      //empty out line items
      document.forms['ticketform'].po_sellist.options.length = 0;      

         var mtest=http.responseText;

         if (mtest.substring(0,5) == "Error" || trim(mtest) == '' ){
               document.getElementById('getpobtn').innerHTML="Create PO"; 
               document.getElementById('EDITPOBANNER').innerHTML="Edit Purchace Order";  
         } else if (trim(mtest) == "No Records Found"){
	           document.getElementById('EDITPOBANNER').innerHTML="Edit Purchace Order";
               document.getElementById('getpobtn').innerHTML="Create PO";   
         } else {   

             results = http.responseText.split("^");
             r1= new Array();
             
             //empty out line items
             document.forms['ticketform'].po_sellist.options.length = 0;

             var mtotal=0;
             // this will build out the existing invoice
             for (x in results)
             {

                r1 = results[x].split("|");

                //trim all the fields
                for (t in r1){
                   r1[t]=trim(r1[t]);
                   r1[t]=r1[t].toUpperCase();
                }
                
                   var mresult=trim(results[x]);

                   if (mresult.length > 0) {
                     if (trim(r1[1]) !=''){
                       var mtempnum=eval(r1[4]);
                       mtotal=mtotal+mtempnum; 
                       mtempnum=mtempnum.toFixed(2);
                       mtempnumStr=mtempnum+" ";
                       var moptionnum=document.forms['ticketform'].po_sellist.options.length;
                     
                       //build out detail value with all the pieces for saving in the po detail database
                       var mselectvalue=mtempnum+"|"+trim(r1[1])+"|"+trim(r1[2])+"|"+trim(r1[3]); 
                         
                       //pad out display
                       
                       r1[1]=padRight(r1[1],' ',7); 
                       r1[2]=padRight(r1[2],' ',12);
                       r1[3]=padRight(r1[3],' ',61);
                       
                       mlineitem=r1[1]+r1[2]+r1[3];
                       mlineitem=mlineitem.toUpperCase();
                       
                       //pad out price
                       mtempnumStr=trim(mtempnumStr);
	                   mtempnumStr= padLeft(mtempnumStr,' ',10);
                       mlineitem=mlineitem+mtempnumStr;
                       document.forms['ticketform'].po_sellist.options[moptionnum] = new Option(mlineitem,mselectvalue,true,false); 
                       //document.forms['ticketform'].po_sellist.selectedIndex=moptionnum;
                       document.forms['ticketform'].po_sellist.options[moptionnum].selected = true;
                       
                     }
                   } 
                   
             } //end of loop
  
             //
           
             mtotal=mtotal.toFixed(2);
             mtotStr=mtotal+" ";
             mtotStr= padLeft(mtotStr,' ',10);
             //alert(mtotStr);
             document.getElementById('po_total').value=mtotStr;
             document.getElementById('POBANNER').innerHTML="<b>Manage/Edit Purchase Orders</b>";
             document.getElementById('getpobtn').innerHTML="Edit PO's";
              
         } // end of test for po's test

	 
         hidewait();
         document.body.style.cursor='auto';
         showtk_stk();

  } // end of ready state test

} //end of funtion


//get single PO
function getspo(mclone){
	
  clearpoFields();
  	
  var updateurl = "includes/php/get_singlepo_fox.php?mform="; // The server-side script
  //if (trim(document.getElementById('po_JOB_ID').value) != "") {
  if (document.forms['ticketform'].po_sellist.selectedIndex >-1 || document.forms['ticketform'].po_sellist.options.length == 0){
    s = new Array();
    temps = new Array();
    s[0] = document.getElementById('po_JOB_ID').value;
    //alert(s[0]);
    
    var temps = document.forms['ticketform'].po_sellist.value.split("|");
    s[1] = temps[1];
    //alert(s[1]);
    s[2] = mclone;
    //alert(s[1]);
    
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    //alert(usession[4]);
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getspoResponse;
    http.send(null);

  } else {
    
    document.getElementById('pomsgtext').innerHTML="Plese select a purchase order to edit.";
    showpomsg();

  }
	
}	


function getspoResponse() {

  if (http.readyState == 4) {
     //alert("returned from php file");
     //alert(http.responseText);
     var mwho=document.getElementById('po_JOB_ID').value;
   
   
     var mtest=http.responseText;
     //alert(mtest);
   
       if (mtest.substring(0,5) == "Error" || trim(mtest) == '' ){
   
            hidewait();
            document.body.style.cursor='auto';
            document.getElementById('tkselectAcctng').selectedIndex=-1;
            document.getElementById('pomsgtext').innerHTML="Error getting purchase order.";
            showpomsg();
              
       } else {

            results = http.responseText.split("^");
            r1= new Array();
             
            //empty out line items
            document.forms['poform'].spo_lnitems.options.length = 0;

            // this loop will build out the existing invoice
            for (x in results)
             {

                r1 = results[x].split("|");

                //trim all the fields
                for (t in r1){
                   r1[t]=trim(r1[t]);
                }
                
                
                if (x==0) {

	              
                 if (r1[24]=="N"){
	                document.getElementById('spo_ponumber').value=r1[0]+"-"+r1[1];
	                mwho=r1[0]+"-"+r1[1];
                 } else {
	                document.getElementById('spo_ponumber').value="cloned";
	                mwho=r1[0]+"-"+r1[1]; 
                 }     
	                
	              if (r1[2].substring(0,5) =="12:00"){
           		       r1[2]='';
	              } 
	              document.getElementById('spo_podate').value=r1[2];
                  
                  
                  if (r1[3].substring(0,5) =="12:00"){
           		       r1[3]='';
	              } 
                  document.getElementById('spo_date_done').value=r1[3];
                  
                  document.getElementById('spo_pofromcont').value=r1[4];
                  document.getElementById('spo_pofromcomp').value=r1[5];
                  document.getElementById('spo_pofromadd1').value=r1[6];
                  document.getElementById('spo_pofromcity').value=r1[7];
                  document.getElementById('spo_pofromst').value=r1[8];
                  document.getElementById('spo_pofromzip').value=r1[9];   
	                
	              //r1[10] IS SHIPPING FIELD
	              var mz3 = document.forms['poform'].spo_mship.options.length;
	              mz3=mz3-1;
	              r1[10] = padRight(r1[10],' ',15);
	              if (r1[10].substring(0,6) !="Object") 
	              {
	 
	                 for (var i = 0; i < document.forms['poform'].spo_mship.options.length; i++) 
	                 {
	                   if (document.forms['poform'].spo_mship.options[i].text.substring(0,15)==r1[10].substring(0,15))
	                   {
	                      document.forms['poform'].spo_mship.options[i].selected = true;
	                   }
	                 }
	
	              } else {document.forms['poform'].spo_mship.options[mz3].selected = true};
	
                  if (r1[10].substring(0,1) == " ") {document.forms['poform'].spo_mship.options[mz3].selected = true};
	
              
                  //r1[11] IS terms FIELD
	              var mz4 = document.forms['poform'].spo_mterms.options.length;
	              mz4=mz4-1;
	              r1[11] = padRight(r1[11],' ',11);
	              if (r1[11].substring(0,6) !="Object") 
	              { 
              	     for (var i = 0; i < document.forms['poform'].spo_mterms.options.length; i++) 
	                 {
	                   if (document.forms['poform'].spo_mterms.options[i].text.substring(0,11)==r1[11].substring(0,11))
	                   {
	                     document.forms['poform'].spo_mterms.options[i].selected = true;
	                   }
	                 }
	
                  } else {document.forms['poform'].spo_mterms.options[mz4].selected = true};
	
         	      if (r1[11].substring(0,1) ==" ") {document.forms['poform'].spo_mterms.options[mz4].selected = true};
	  
	               document.getElementById('spo_potocont').value=r1[12];
                   document.getElementById('spo_potocomp').value=r1[13];
                   document.getElementById('spo_potoadd1').value=r1[14];
                   document.getElementById('spo_potocity').value=r1[15];
                   document.getElementById('spo_potost').value=r1[16];
                   document.getElementById('spo_potozip').value=r1[17];
             
                   
                   if (r1[18].substring(0,5) =="12:00"){
           		       r1[18]='';
	               } 
                   document.getElementById('spo_podue').value=r1[18];
                   
                   document.getElementById('spo_desc').value=r1[23];
                   //bottom of PO amount/salestax/amtdue
                   
                   var mnum1=eval(r1[19]); 
                   
                   var mnum2=eval(r1[20]);
                   
                   var mnum3=eval(r1[21]);
                   
                   
                   var mnum4=eval(r1[22]);
                   
                   mnum1=mnum1.toFixed(2);
                   mnum2=mnum2.toFixed(2);
                   mnum3=mnum3.toFixed(2);
                   mnum4=mnum4.toFixed(2);
           
                   //do not do calctotals() as we want to pull whatever is in the file;
	               msubStr=mnum1+" ";
                   msubStr= padLeft(msubStr,' ',10);
                   document.getElementById('spo_subtotal').value=msubStr;

                   mtaxStr=mnum2+" ";
                   mtaxStr= padLeft(mtaxStr,' ',10);
                   document.getElementById('spo_tax').value=mtaxStr;
  
                   mtotalStr=mnum3+" ";
                   mtotalStr= padLeft(mtotalStr,' ',10);
                   document.getElementById('spo_total').value=mtotalStr;
                                  
                             
                } else {

                   var mresult=trim(results[x]);

                   if (mresult.length > 0) {
                     if (trim(r1[1]) !=''){
                       var mtempnum=eval(r1[2]); 
                       mtempnum=mtempnum.toFixed(2);
                       mtempnumStr=mtempnum+" ";
                       var moptionnum=document.forms['poform'].spo_lnitems.options.length;
                     
                       //build out detail value with all the pieces for saving in the detail database
                       //no dept [7]-var mselectvalue=mtempnum+"|"+trim(r1[3])+"|"+trim(r1[4])+"|"+trim(r1[5])+"|"+trim(r1[6])+"|"+trim(r1[7])+"|"+trim(r1[8]);  
                       var mselectvalue=mtempnum+"|"+trim(r1[3])+"|"+trim(r1[4])+"|"+trim(r1[5])+"|"+trim(r1[6])+"|"+trim(r1[8]);  
                       
                       //alert(mselectvalue);
                       if (mtempnum==0){
	                        var mlineitem=r1[1];
                            document.forms['poform'].spo_lnitems.options[moptionnum] = new Option(mlineitem,mselectvalue,true,false); 
                       } else { 
	                        r1[1] =trim(r1[1]);
                            mtempnumStr=trim(mtempnumStr);
	                        r1[1] = padRight(r1[1],' ',76);
	                        mtempnumStr= padLeft(mtempnumStr,' ',10);
                            mlineitem=r1[1]+mtempnumStr;
                            
                            if (trim(r1[8])=="Y"){mlineitem=mlineitem+" Y"};
                            document.forms['poform'].spo_lnitems.options[moptionnum] = new Option(mlineitem,mselectvalue,true,false); 
                       }
                     }
                   } 
                 } // end of condition to check for line item  


             } //end of loop

             document.getElementById('EDITPOBANNER').innerHTML="<b>Edit Purchace Order</b>";
             
             //togglepoPrintSave("P"); looks like crap- while selects load
             
             document.getElementById('current_pdf').value="po";
             document.getElementById('pdfid').value=mwho;
      
             getpopagenum();
             getpounit();  // this needs to be moved to getpodept and commented out here if we add dept back
             //getpodept(); //chain three functiuons together and then show screen- this needs to be uncommented if dept added
             //showspo();  

         } // end of test for po
       
        

  } // end of ready state test

} //end of funtion

function voidpo(){
		
  var updateurl = "includes/php/void_singlepo_fox.php?mform="; // The server-side script
  //if (trim(document.getElementById('po_JOB_ID').value) != "") {
  if (document.forms['ticketform'].po_sellist.selectedIndex >-1 || document.forms['ticketform'].po_sellist.options.length == 0){
    s = new Array();
    temps = new Array();
    s[0] = document.getElementById('po_JOB_ID').value;
    //alert(s[0]);
    
    var temps = document.forms['ticketform'].po_sellist.value.split("|");
    s[1] = temps[1];
    //alert(s[1]);
    
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    //alert(usession[4]);
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = voidpoResponse;
    http.send(null);

  } else {
    
    document.getElementById('pomsgtext').innerHTML="Plese select a purchase order to void.";
    showpomsg();
  }
	
}	

function voidpoResponse() {

  if (http.readyState == 4) {

	 var retmsg=http.responseText;
     if (trim(retmsg) != "PO has been voided."){
	   hidewait();
       document.body.style.cursor='auto';  
	   document.getElementById('pomsgtext').innerHTML="Error voiding PO, please try again.";
       showpomsg();
     } else {
       getpos();
     }    
      
  } // end of ready state test

} //end of funtion



function clearpos(){
   
  document.forms['ticketform'].po_sellist.options.length = 0;
  document.getElementById('po_job_id').value="";
  
}	

function findPOselItem(){
 if (trim(document.getElementById('po_search').value) !=""){
 //alert("in search");
 
    if (document.forms['ticketform'].po_sellist.selectedIndex==-1){
      var xz=0;
    } else {
  	  var xz=document.forms['ticketform'].po_sellist.selectedIndex;
  	  xz =(xz+1);
    }	     		  
    var tempVar="";
    var searchStr=trim(document.getElementById('po_search').value);
  
    searchStr=searchStr.toUpperCase();
  
    while (xz < document.forms['ticketform'].po_sellist.options.length){
    
	    tempVar=document.forms['ticketform'].po_sellist.options[xz].text;
	    var afind = tempVar.indexOf(searchStr);
	    if (afind > -1){
          //alert("Found string at :"+xz);
          document.getElementById('posearchbtn').innerHTML='Continue';
          break;
        }	  
      
        tempVar="";
	       
       xz =(xz+1);
    }
  
    if (xz== document.forms['ticketform'].po_sellist.options.length ){
      
      document.getElementById('posearchbtn').innerHTML='Search'; 	 
      document.forms['ticketform'].po_sellist.selectedIndex=-1;
      
      document.getElementById('pomsgtext').innerHTML="End of search reached.";
      showpomsg();
      
    } else {   
      document.forms['ticketform'].po_sellist.selectedIndex=xz;
    }
   
  } else {
	document.getElementById('pomsgtext').innerHTML="Please enter in a search criteria.";
    showpomsg();  
	
	  
  } //end of blank search check	    	 
}

function resetPOsel(){
	
	document.forms['ticketform'].po_sellist.selectedIndex=-1;
	document.getElementById('posearchbtn').innerHTML='Search';
}	


function showtaxrate() {
 
  if (document.getElementById('spo_taxable').checked == true) {
    document.getElementById('spo_taxratelayer').style.visibility =  "visible";
  } else {   
     document.getElementById('spo_taxratelayer').style.visibility =  "hidden";
  }
   
}

function clearpoFields(){
	
  document.getElementById('spo_taxflag').value="N";
  document.getElementById('input1').value="";  
  document.getElementById('spo_ponumber').value="";
  document.getElementById('spo_podate').value="";
  document.getElementById('spo_num_pages').value="";
  document.getElementById('spo_pofromcont').value="";
  document.getElementById('spo_pofromcomp').value="";
  document.getElementById('spo_pofromadd1').value="";
  document.getElementById('spo_pofromcity').value="";
  document.getElementById('spo_pofromst').value="";
  document.getElementById('spo_pofromzip').value="";
  document.getElementById('spo_potocont').value="";
  document.getElementById('spo_potocomp').value="";
  document.getElementById('spo_potoadd1').value="";
  document.getElementById('spo_potocity').value="";
  document.getElementById('spo_potost').value="";
  document.getElementById('spo_potozip').value="";
  document.getElementById('spo_desc').value="";
  document.getElementById('spo_date_done').value="";
  document.getElementById('spo_podue').value="";
  document.getElementById('spo_catmain').value="";
  document.getElementById('spo_qty').value="          0";
  document.getElementById('spo_cpu').value="     0.00";
  document.getElementById('spo_search').value="";
  document.getElementById('spo_subtotal').value="";
  document.getElementById('spo_tax').value="";
  document.getElementById('spo_total').value="";
   
  //document.forms['poform'].spo_dept.selectedIndex=-1;     
  document.forms['poform'].spo_unit.selectedIndex=-1; 
        
  document.forms['poform'].spo_mship.selectedIndex=-1;
  document.forms['poform'].spo_mterms.selectedIndex=-1;
  document.forms['poform'].spo_lnitems.options.length = 0;
  document.getElementById('spo_taxable').checked=false;
  document.getElementById('spo_taxrate').selectedIndex=0;   

  document.getElementById('EDITPOBANNER').innerHTML="<b>Purchase Orders</b>";
                         	
}	


function getpopagenum(){
    //determine page numbers
    if (document.forms['poform'].spo_lnitems.length > 15){
      var mnumpg=(document.forms['poform'].spo_lnitems.length/15);
      mnumpg=mnumpg.toFixed(2);
      
      //determine if decimal and add back to get a round up effect
      // round will not work because rounding down ** mnumpg=Math.round(mnumpg);
      //convert to string to strip out decimal
      var addnum=mnumpg+' ';
      var aPosition = addnum.indexOf(".");
      addnum=addnum.substring(aPosition,4);
      var addnum2=1.00-parseFloat(addnum);
      
      //add remainder back to page number
      mnumpg=(parseFloat(mnumpg)+parseFloat(addnum2));
      //alert(addnum);
      //alert(addnum2);
      
      document.getElementById('spo_num_pages').value=mnumpg;
    } else {
	  document.getElementById('spo_num_pages').value="1";  
    }        
}


// next four funtions retrieve the selects (same as invoice for now) // terms and shipping are being loaded with the cc_selects
// as usual in a hurry -no time to combine these into one set for both binv & po , this should be done at some point

//removing dept for now
/*
function getpodept() {
  var usession = getmsession();
  var updateurl = "includes/php/binv_deptselect_process.php?usession="; // The server-side script
 
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = getpodeptResponse;
  http.send(null);
}

function getpodeptResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['poform'].spo_dept.options.length = 0;
    document.forms['poform'].spo_dept[0] = new Option(" "," ",true,false);
    for (x in results)
    {
        r1 = results[x].split("|");
        if (trim(r1[0]) !=""){
           if (typeof r1[0] != "undefined"){
	         i=document.forms['poform'].spo_dept.options.length;  
             document.forms['poform'].spo_dept[i] = new Option(r1[0],r1[0],true,false);
           }  
        }
    }
  
    //had to move this to top of chain
    getpounit();
    
  } //end of ready state test
}//end of function
*/

function getpounit() {
  var usession = getmsession();
  var updateurl = "includes/php/binv_unitselect_process.php?usession="; // The server-side script
  document.body.style.cursor = "wait";	
  showwait()
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = getpounitResponse;
  http.send(null);
}

function getpounitResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['poform'].spo_unit.options.length = 0;
    //document.forms['poform'].spo_unit[0] = new Option(" "," ",true,false);
    for (x in results)
    {
        r1 = results[x].split("|");
        if (trim(r1[0]) !=""){
           if (typeof r1[0] != "undefined"){
	         i=document.forms['poform'].spo_unit.options.length;  
             document.forms['poform'].spo_unit[i] = new Option(r1[0],r1[0],true,false);
           }  
        }
    }
  hidewait();
  document.body.style.cursor='auto';
  
  if ( trim(document.getElementById('spo_ponumber').value)=="cloned"){
     setupclonepo();
     mwho=trim(document.getElementById('spo_ponumber').value);
  }
  
  showspo();
  } //end of ready state test
}//end of function

function togglepoPrintSave(mtype) {
	 
	if (mtype=="P"){
	  document.getElementById('sposavebtn').style.visibility =  "hidden";
      document.getElementById('spoprnbtn').style.visibility =  "visible";
    } else {
	  document.getElementById('sposavebtn').style.visibility =  "visible";
      document.getElementById('spoprnbtn').style.visibility =  "hidden";
    }

}


function selposcr(){
	if (document.forms['ticketform'].po_sellist.options.length > 0){
		showpo();
    } else {
	    setupnewpo();    
    }    
	
}	

function getnewponum(){
		
  var xz=document.forms['ticketform'].po_sellist.options.length;

  if (xz > 0){

	 xz=(xz-1);  
     var tempVal="";
     tempVal=document.forms['ticketform'].po_sellist[xz].value;
     s = new Array(); 
     s=tempVal.split("|");
     var mnum=parseInt(s[1]);  
     mnum=(mnum+1);
  } else {
     var mnum=1;
     	      
  }

     
     newnum=mnum+""; 
  
return mnum;
     
}



function setupnewpo(){
	
	
  document.getElementById('spo_taxflag').value="N";
  document.getElementById('input1').value=""; 
  
  
  document.getElementById('spo_ponumber').value=document.getElementById('tk_stkJOB_ID').value+"-"+getnewponum();
  
  var currentTime = new Date();
  var month = currentTime.getMonth() + 1;
  var day = currentTime.getDate();
  var year = currentTime.getFullYear();	     

  document.getElementById('spo_podate').value=month + "/" + day + "/" + year;
  document.getElementById('spo_num_pages').value="1";
  document.getElementById('spo_pofromcont').value="Pat Wiley";
  document.getElementById('spo_pofromcomp').value=document.getElementById('defaultcoNM').value;
  document.getElementById('spo_pofromadd1').value="7120 185th Ave NE";
  document.getElementById('spo_pofromcity').value="Redmond";
  document.getElementById('spo_pofromst').value="WA";
  document.getElementById('spo_pofromzip').value="98052";
  document.getElementById('spo_potocont').value="";
  document.getElementById('spo_potocomp').value="";
  document.getElementById('spo_potoadd1').value="";
  document.getElementById('spo_potocity').value="";
  document.getElementById('spo_potost').value="";
  document.getElementById('spo_potozip').value="";
  document.getElementById('spo_desc').value="";
  document.getElementById('spo_date_done').value="";
  document.getElementById('spo_podue').value="";
  document.getElementById('spo_catmain').value="";
  document.getElementById('spo_qty').value="          0";
  document.getElementById('spo_cpu').value="     0.00";
  document.getElementById('spo_search').value="";
  document.getElementById('spo_subtotal').value="";
  document.getElementById('spo_tax').value="";
  document.getElementById('spo_total').value="";
   
  //document.forms['poform'].spo_dept.selectedIndex=-1;     
  document.forms['poform'].spo_unit.selectedIndex=-1; 
        
  document.forms['poform'].spo_mship.selectedIndex=-1;
  document.forms['poform'].spo_mterms.selectedIndex=-1;
  document.forms['poform'].spo_lnitems.options.length = 0;
  document.getElementById('spo_taxable').checked=false;
  document.getElementById('spo_taxrate').selectedIndex=0;   
  	
//getpodept();	
  getpounit();  // this needs to be moved to getpodept and commented out here if we add dept back
        
}

function setupclonepo(){
	
 
  document.getElementById('spo_ponumber').value=document.getElementById('tk_stkJOB_ID').value+"-"+getnewponum();
  
  var currentTime = new Date();
  var month = currentTime.getMonth() + 1;
  var day = currentTime.getDate();
  var year = currentTime.getFullYear();	     

  document.getElementById('spo_podate').value=month + "/" + day + "/" + year;
  document.forms['poform'].spo_date_done.value="";         
  document.forms['poform'].spo_podue.value="";
  
}


function findspoLnItem(){

  //alert("in search");
 
  if (document.forms['poform'].spo_lnitems.selectedIndex==-1){
    var xz=0;
  } else {
	var xz=document.forms['poform'].spo_lnitems.selectedIndex;
	xz =(xz+1);
  }	     		  
  var tempVar="";
  var searchStr=trim(document.getElementById('spo_search').value);
  
  searchStr=searchStr.toUpperCase();
  
  while (xz < document.forms['poform'].spo_lnitems.options.length){
    
	  tempVar=document.forms['poform'].spo_lnitems.options[xz].text;
	  var afind = tempVar.indexOf(searchStr);
	  if (afind > -1){
        //alert("Found string at :"+xz);
        document.getElementById('sposearchbtn').innerHTML='Continue';
        break;
      }	  
      
      tempVar="";
	       
     xz =(xz+1);
  }
  
   if (xz== document.forms['poform'].spo_lnitems.options.length ){
    
     document.getElementById('sposearchbtn').innerHTML='Search'; 	 
     document.forms['poform'].spo_lnitems.selectedIndex=-1;
     document.getElementById('pomsgtext').innerHTML="End of search reached.";
     showpomsg();  
      
   } else {   
     document.forms['poform'].spo_lnitems.selectedIndex=xz;
   }
   	 
}

function resetspoSearch(){

	document.forms['poform'].spo_lnitems.selectedIndex=-1;
    document.getElementById('sposearchbtn').innerHTML='Search';
}	


function addpocomment(){
 document.body.style.cursor = "wait";
 togglepoPrintSave('S');	
  showwait()
  var checkforErrors="";
 
   if (trim(document.getElementById('spo_catmain').value)==""){
    checkforErrors=checkforErrors+"<br>You must enter a line detail description.";  
  }
  
   if (trim(checkforErrors) !=""){
     hidewait();
     document.body.style.cursor='auto';
     document.getElementById('pomsgtext').innerHTML=checkforErrors+"<br><br>Please correct and try again.";
     showpomsg(); 
     
  } else {

      //add the comment only cat entry to line items
      var i=document.forms['poform'].spo_lnitems.selectedIndex; 

	  var mlineItem="test number :"+document.forms['poform'].spo_lnitems.selectedIndex;
	  mlineItem=trim(document.getElementById('spo_catmain').value);
	  mlineItem=mlineItem.toUpperCase();
	  document.getElementById('cutbuttonsPO').style.visibility =  "visible"; 
      mtempnum=0;
      //build out detail value with all the pieces for saving in the detail database
      // removing dept-var mselectvalue=	mtempnum+"|"+trim(document.getElementById('spo_catmain').value)+"|"+trim(document.getElementById('spo_unit').value)+"|"+trim(document.getElementById('spo_cpu').value)+"|"+trim(document.getElementById('spo_qty').value)+"|"+trim(document.getElementById('spo_dept').value);  
      var mselectvalue=	mtempnum+"|"+trim(document.getElementById('spo_catmain').value)+"|"+trim(document.getElementById('spo_unit').value)+"|"+trim(document.getElementById('spo_cpu').value)+"|"+trim(document.getElementById('spo_qty').value);  

      taxableln='N'; //service or prod empty on comment only
      
      // no need to determine product or service on comment line
      
      mselectvalue=mselectvalue+"|"+taxableln;
      
      
	  if (i==-1){ 
     	  i=document.forms['poform'].spo_lnitems.options.length;  
          document.forms['poform'].spo_lnitems[i] = new Option(mlineItem,mselectvalue,true,false); 
      } else {
	      
          document.forms['poform'].spo_lnitems[i] = new Option(mlineItem,mselectvalue,true,false); 
      }	           	  
 
      
        spoclear();    	  
  
  } // end of error check	  
  
  if (document.forms['poform'].spo_lnitems.options.length==0){document.getElementById('cutbuttonPO').style.visibility =  "hidden"}; 

  getpopagenum()
  hidewait();  
  document.body.style.cursor='auto';  

} //end of comment only
  
function poLnInsert(){
	
var z=document.forms['poform'].spo_lnitems.options.length; 
if (z !=0){
  var mlineItemb=" ";
  var mselectvalueb="0.00| |EA|0|0|0";  
  var msel=document.forms['poform'].spo_lnitems.selectedIndex;
  if ((z-1)==msel){
    document.forms['poform'].spo_lnitems[z] = new Option(document.forms['poform'].spo_lnitems.options[z-1].text,document.forms['poform'].spo_lnitems.options[z-1].value,true,false); 	
    document.forms['poform'].spo_lnitems.options[z-1] = new Option(mlineItemb,mselectvalueb,true,false);
    var newsel=(z-1);
    spoclear();
    document.forms['poform'].spo_lnitems.selectedIndex=newsel; 

  } else {   
    
    while (z > 0){
  	 document.forms['poform'].spo_lnitems[z] = new Option(document.forms['poform'].spo_lnitems.options[z-1].text,document.forms['poform'].spo_lnitems.options[z-1].value,true,false); 	
     document.forms['poform'].spo_lnitems.options[z-1] = new Option(mlineItemb,mselectvalueb,true,false);  
	 //alert((z-1)+" <--loop cnt  --->selected "+msel);
  	 if ((z-1)==msel){
	   var newsel=(z-1);
	    spoclear();
	    document.forms['poform'].spo_lnitems.selectedIndex=newsel; 
	   break;	 
     } else {	 
	   z=(z-1);
     }	        
   }	
  }//end of last select test

  } else {
    document.getElementById('pomsgtext').innerHTML="You cannot insert a line when there are no line items.";
    showpomsg();
	
} //end of test for empty	   	
		

 	
}	

function polnbuild(){
  
  var checkforErrors="";
 
  document.getElementById('spo_catmain').value=document.getElementById('spo_catmain').value.toUpperCase();
 
  //check and make sure the min order charge is not an edit - is allowed on inserted lines
  var noeditminorder =document.getElementById('spo_catmain').value.indexOf("MINIMUM INVOICE");
  if (noeditminorder !=-1){
	 document.getElementById('spo_qty').value="1"; //min order can only times 1 
     var meditline=document.forms['poform'].spo_lnitems.selectedIndex;
     if (meditline > -1){
	    if (trim(document.forms['poform'].spo_lnitems.options[meditline].text) !=''){  
           document.getElementById('pomsgtext').innerHTML=checkforErrors+"<br><br>You cannot edit an existing detail line with a minimum order.<br>Remove this line and then add the minimum order charge amount.";
           showpomsg(); 
           spoclear();
	       return false;
        }    
    }  
  } 
  
  document.body.style.cursor = "wait";	
  showwait()	      
  togglepoPrintSave('S');	      
  //no dept for now
  //if (document.forms['poform'].spo_dept.selectedIndex < 1 || document.forms['poform'].spo_dept.selectedIndex==0){
  //  checkforErrors=checkforErrors+"<br>You must choose a department.";  
  //}
  
  if (trim(document.getElementById('spo_catmain').value)==""){
    checkforErrors=checkforErrors+"<br>You must enter a line detail description.";  
  }
  
  if (trim(document.getElementById('spo_qty').value)=="0" || trim(document.getElementById('spo_qty').value)==""){
	 if (trim(document.getElementById('spo_cpu').value)=="0.00" || trim(document.getElementById('spo_cpu').value)==""){
       checkforErrors=checkforErrors+"<br>You to have a quanity of at least 1 if a CPU is entered.";  
     }  
  }
  
  //if (trim(document.getElementById('spo_cpu').value)=="0.00" || trim(document.getElementById('spo_cpu').value)==""){
  //  checkforErrors=checkforErrors+"<br>You must enter a cost per unit.";  
  //}
  
  //if (document.forms['poform'].spo_unit.selectedIndex==-1 || document.forms['poform'].spo_unit.selectedIndex==0){
  //  checkforErrors=checkforErrors+"<br>You must choose the unit of measurement.";  
  //}
  
  
  if (trim(checkforErrors) !=""){
     hidewait();
     document.body.style.cursor='auto';
     
     document.getElementById('pomsgtext').innerHTML=checkforErrors+"<br><br>Please correct and try again.";
     showpomsg(); 
     
  } else {
      checkforErrors=""; //clear message to use again in min neg check
      //add the line items
      var i=document.forms['poform'].spo_lnitems.selectedIndex; 

	  var mlineItem="test number :"+document.forms['poform'].spo_lnitems.selectedIndex;
	  var mcpuStr=0;
	  
	  var zcpu=document.getElementById('spo_cpu').value;
      var zq=document.getElementById('spo_qty').value;
	  var mincheck1=trim(document.getElementById('spo_catmain').value);
      mincheck1=mincheck1.toUpperCase();
	  var afind = mincheck1.indexOf("MINIMUM INVOICE");
	  if (afind ==-1){
          mcpuStr=(document.getElementById('spo_cpu').value*1);
      } else {
	      mcpuStr=(zq*zcpu)-document.getElementById('spo_subtotal').value;
      } 
	  	  
	  //mcpuStr=(document.getElementById('spo_cpu').value*1); //added above for min order
	  mcpuStr=mcpuStr.toFixed(2);
	  mcpuStr1=mcpuStr+" ";
	  
	  var mqStr=0;
	  mqStr=(document.getElementById('spo_qty').value*1);
	  //mqStr=mqStr.toFixed(2);
	  mqStr1=Comma(mqStr);
	  mlineItem=trim(document.getElementById('spo_catmain').value)+"  "+trim(mqStr1)+" @ "+trim(mcpuStr1);
	  mlineItem=mlineItem.toUpperCase();
	  
	  if (trim(document.getElementById('spo_cpu').value) !="0.00" && trim(document.getElementById('spo_cpu').value) !=""){
        if (trim(document.getElementById('spo_unit').value) !="NONE" && trim(document.getElementById('spo_unit').value) !=""){
	       if (afind ==-1){
              mlineItem=mlineItem+"/"+trim(document.getElementById('spo_unit').value); 
		   } 
	    }            
      }	  
	  document.getElementById('cutbuttonsPO').style.visibility =  "visible"; 

	  //calculate price

      var mcpu=document.getElementById('spo_cpu').value;
      var mq=document.getElementById('spo_qty').value;
 
      if (document.getElementById('spo_unit').selectedIndex==2){
        mcpu=(mcpu/1000);
      }   	
	
      if (document.getElementById('spo_unit').selectedIndex==0){
		  mq=1;
      }	
      
      var mincheck=trim(document.getElementById('spo_catmain').value);
      mincheck=mincheck.toUpperCase();
  	  var afind = mincheck.indexOf("MINIMUM INVOICE");
	  if (afind ==-1){
          var mprice=(mq*mcpu);
      } else {
	      var mprice=(mq*mcpu)-document.getElementById('spo_subtotal').value;
      }    
    
     if (document.getElementById('spo_unit').selectedIndex==0){
        mprice=(1*mcpu); //NONE is the same as flast rate
     }    
      
      
    if (mprice < .00){
        checkforErrors=checkforErrors+"<br>The purchase order is already above minimum invoice charge.";  
    } else { 
      //var mprice=(mq*mcpu); //added above for min order
      var mtempnum=eval(mprice); 
      mtempnum=mtempnum.toFixed(2);
      mtempnumStr=mtempnum+" ";
      mlineItem =trim(mlineItem);
      mtempnumStr=trim(mtempnumStr);
	  mlineItem = padRight(mlineItem,' ',76);
	  mtempnumStr= padLeft(mtempnumStr,' ',10);
      mlineItem=mlineItem+mtempnumStr;
      
      // end of lineitem calulation	  
	  
      //build out detail value with all the pieces for saving in the detail database
      // no dept for now---var mselectvalue=	mtempnum+"|"+trim(document.getElementById('spo_catmain').value)+"|"+trim(document.getElementById('spo_unit').value)+"|"+trim(document.getElementById('spo_cpu').value)+"|"+trim(document.getElementById('spo_qty').value)+"|"+trim(document.getElementById('spo_dept').value);  
      var mselectvalue=	
         mtempnum+"|"+
         trim(document.getElementById('spo_catmain').value)+"|"+
         trim(document.getElementById('spo_unit').value)+"|"+
         trim(document.getElementById('spo_cpu').value)+"|"+
         trim(document.getElementById('spo_qty').value);  
          
      // determine service or product if priced
      var taxableln=" ";
      if (mtempnum > 0) {
        
	      if (document.getElementById('spo_taxable').checked==true){
            taxableln="Y"
          } else {
	        taxableln="N" 
          }      	      
	        	      
      }  //end of amount > 0 check
     
      mselectvalue=mselectvalue+"|"+taxableln;
      
      //comment out next four test lines
      //hidewait();
      //document.body.style.cursor='auto';
      //alert(mlineItem);
      //return null;
       
	  if (i==-1){
	     i=document.forms['poform'].spo_lnitems.options.length;  
         document.forms['poform'].spo_lnitems[i] = new Option(mlineItem,mselectvalue,true,false); 
           
	  } else {
	     document.forms['poform'].spo_lnitems[i] = new Option(mlineItem,mselectvalue,true,false); 
           
      }	   
              	  
      calcpototals();
      spoclear();
      
    }//end of neg min order charge  	  
      
  } //end of error check	  
  
  //put up any build err msgs
  if (trim(checkforErrors) !=""){
     hidewait();
     document.body.style.cursor='auto';
     
     document.getElementById('pomsgtext').innerHTML=checkforErrors+"<br><br>Please correct and try again.";
     showpomsg(); 
     
  }
  
  
  
  if (document.forms['poform'].spo_lnitems.options.length==0){document.getElementById('cutbuttonPO').style.visibility =  "hidden"}; 

 
  hidewait();  
  document.body.style.cursor='auto';  

}	

function spoclear(){
  
  document.forms['poform'].spo_unit.selectedIndex=-1;
  //document.forms['poform'].spo_dept.selectedIndex=-1;
  document.getElementById('spo_qty').value="          0";
  document.getElementById('spo_cpu').value="     0.00";
  document.getElementById('spo_catmain').value="";
  document.forms['poform'].spo_lnitems.selectedIndex=-1;
  document.getElementById('spo_taxable').checked=false;
  document.getElementById('spo_taxrate').selectedIndex=0; 
  showtaxrate();
}	



function calcpototals(){
  //calculate  the subtotal , tax and total
 
  var xz=0;
  var msub=0;
  var mtax=0;
  var mtotal=0;
  var taxRate=0; 	  
  var tempVar="";
  
  while (xz < document.forms['poform'].spo_lnitems.options.length){
    
	  tempVar=document.forms['poform'].spo_lnitems[xz].value;
	  s = new Array(); 
	  s=tempVar.split("|");
	  //alert(tempVar);
	  var taxcheck=document.forms['poform'].spo_lnitems[xz].text;
	  //if taxable (using taxableln field for now, need to talk with randy and change to lntax field name
	  if (s[5]=="Y"){
		  var taxRate=document.getElementById('spo_taxrate').value;
		  var mtaxamt=parseFloat(s[0]);
		  mtax=mtax+mtaxamt;
		  //position 87 is the Y flag for user to see what was taxed, this is to make sure only added once
		  if (taxcheck.substr(87,1) !="Y"){
		     document.forms['poform'].spo_lnitems[xz].text=document.forms['poform'].spo_lnitems[xz].text+" Y";
          }
      }    	  
	  
	  
	  msub=(msub+parseFloat(s[0]));
	  
	  tempVar=tempVar.split("|");
      tempVar="";
	       
     xz =(xz+1);
  }
  
  mtax=(mtax*taxRate);
  mtotal=(msub+mtax);

  msub=msub.toFixed(2);
  msubStr=msub+" ";
  msubStr= padLeft(msubStr,' ',10);
  document.getElementById('spo_subtotal').value=msubStr;

  mtax=mtax.toFixed(2);
  mtaxStr=mtax+" ";
  mtaxStr= padLeft(mtaxStr,' ',10);
  document.getElementById('spo_tax').value=mtaxStr;
  
  mtotal=mtotal.toFixed(2);
  mtotalStr=mtotal+" ";
  mtotalStr= padLeft(mtotalStr,' ',10);
  document.getElementById('spo_total').value=mtotalStr;
  
  getpopagenum();
    
}

function setpoedit(){

	var abc=document.getElementById('spo_lnitems').selectedIndex;
	if (abc > -1){
	    var editstr=document.getElementById('spo_lnitems').options[abc].value;
	    //alert(editstr);
	    medit= new Array();
	
	    medit = editstr.split("|");
	    document.getElementById('spo_catmain').value=medit[1];
	    document.getElementById('spo_cpu').value=medit[3];
	    document.getElementById('spo_qty').value=medit[4];
	    
	    for (var i = 0; i < document.forms['poform'].spo_unit.options.length; i++) 
		 {
		    if (trim(document.forms['poform'].spo_unit.options[i].text)==trim(medit[2]))
		    {
		       document.forms['poform'].spo_unit.options[i].selected = true;
		    }
		 }
		
		if (medit[2].substring(0,1) == " ") {document.forms['poform'].spo_unit.options[0].selected = true};
	    if (medit[5].substr(0,1) == "Y") {
		    document.getElementById('spo_taxable').checked=true;
		} else {
			document.getElementById('spo_taxable').checked=false;
	    }
		 // no dept for now
		 //for (var i = 0; i < document.forms['poform'].spo_dept.options.length; i++) 
		 //{
		 //   if (trim(document.forms['poform'].spo_dept.options[i].text)==trim(medit[5]))
		 //   {
		 //      document.forms['poform'].spo_dept.options[i].selected = true;
		 //   }
		 //}
		
		//if (medit[5].substring(0,1) == " ") {document.forms['poform'].spo_dept.options[0].selected = true};
		showtaxrate();
	    
   }//end of test for selected
} 
   

function podeldet(){
	
var inum = document.forms['poform'].spo_lnitems.selectedIndex;	

  if (inum > -1){
	  
     document.forms['poform'].spo_lnitems.options[inum] = null;
     togglepoPrintSave('S');
     inum=(inum-1);
     if (inum==-1 && document.forms['poform'].spo_lnitems.options.length > 0){
       inum=0;
     }
     
     document.forms['poform'].spo_lnitems.selectedIndex=inum;
          
     if (inum !=-1){
       setpoedit();
     }  
     // don't call clear because we want to just remove the last one
     // spoclear();

  } else {
  
   //document.getElementById('binvmsgtext').innerHTML="<br><br>Please select a line item to delete.";
   //showbinvmsg();
   document.getElementById('pomsgtext').innerHTML="Please select a line item to delete.";
   showpomsg(); 
   
 }	

  if (document.forms['poform'].spo_lnitems.options.length > 0){
	 document.getElementById('cutbuttonsPO').style.visibility =  "visible";
  } else {
	 document.getElementById('cutbuttonsPO').style.visibility =  "hidden";
  }	 	  

calcpototals();
getpopagenum();
} 

 	// acctounting check for invoice
function savePO() {
	
 if(document.forms['poform'].spo_lnitems.length > 0){

    var updateurl = "includes/php/save_po_fox.php?mform="; // The server-side script
        
    //main ticket array 	
    s = new Array();
    
    //line item array
    sI= new Array();
    //line item prices
    sP= new Array();
     
    mytempPO=new Array();
    mytempPO=document.getElementById('spo_ponumber').value.split("-");   
    
    s[0] = mytempPO[0];    
    s[1] = document.getElementById('spo_podate').value;
    s[2] = document.getElementById('spo_date_done').value;
    s[3] = mytempPO[1]; 
   
    s[4] = document.getElementById('spo_desc').value;
    s[5] = document.getElementById('spo_pofromcont').value;
    s[6] = document.getElementById('spo_pofromcomp').value;
    s[7] = document.getElementById('spo_pofromadd1').value;
    s[8] = document.getElementById('spo_pofromcity').value;
    s[9] = document.getElementById('spo_pofromst').value;
    s[10] = document.getElementById('spo_pofromzip').value;	
    s[11] = document.forms['poform'].spo_mship.value;
    s[12] = document.forms['poform'].spo_mterms.value;
    s[13] = document.getElementById('spo_taxflag').value;
    s[14] = document.getElementById('spo_potocont').value;
    s[15] = document.getElementById('spo_potocomp').value;
    s[16] = document.getElementById('spo_potoadd1').value;
    s[17] = document.getElementById('spo_potocity').value;
    s[18] = document.getElementById('spo_potost').value;
    s[19] = document.getElementById('spo_potozip').value;
    s[20] = document.getElementById('spo_subtotal').value;
    s[21] = document.getElementById('spo_tax').value;
    s[22] = document.getElementById('spo_total').value;
    s[23] = document.getElementById('spo_podue').value;
    
    //add to picklist
    //if (document.forms['ticketform'].po_sellist.options.length == 0){
	    
        document.getElementById('po_total').value="";
        var mtotal=0;
        
        document.getElementById('po_JOB_ID').value=s[0]
        var mtempnum=eval(s[22]);
        mtempnum=mtempnum.toFixed(2);
        mtempnumStr=mtempnum+" ";
                 
        //build out detail value with all the pieces for saving in the po detail database
        var mselectvalue=mtempnum+"|"+trim(s[3])+"|"+trim(s[1])+"|"+trim(s[4])+"|"+trim(s[5]); 
                         
        //pad out display
        s[3]=padRight(s[3],' ',7); 
        s[1]=padRight(s[1],' ',12);
        s[4]=padRight(s[4],' ',61);
                  
        mlineitem=s[3]+s[1]+s[4];
        mlineitem=mlineitem.toUpperCase();
        //pad out price
        mtempnumStr=trim(mtempnumStr);
	    mtempnumStr= padLeft(mtempnumStr,' ',10);
        mlineitem=mlineitem+mtempnumStr;
        
        var mfind="N";
        // check for existance of po in select 
        for (var i = 0; i < document.forms['ticketform'].po_sellist.options.length; i++) 
		 {
			scheck = new Array(); 
			var mcheck=document.forms['ticketform'].po_sellist.options[i].value;
			//alert(mcheck);
			scheck=mcheck.split("|");
			//alert(scheck[1]);
			//alert(s[3]);
		    if (trim(scheck[1])==trim(s[3]))
		    {
			   document.forms['ticketform'].po_sellist.options[i].value=mselectvalue; 
			   document.forms['ticketform'].po_sellist.options[i].text=mlineitem; 
		       document.forms['ticketform'].po_sellist.options[i].selected = true;
		       mfind="Y"
		       //alert(mfind);
		    }
		    
		    //get the numbers again before adding 
		    mcheck=document.forms['ticketform'].po_sellist.options[i].value;
			//alert(mcheck);
		    scheck=mcheck.split("|");
		    mtotal=(mtotal+eval(scheck[0]));
		    //alert(mtotal);
		 }
		//add this po to it 
        mtotal=(mtotal+eval(s[22]));

        mtotal=mtotal.toFixed(2);
        mtotal=mtotal+" "; 
        mtotal= padLeft(mtotal,' ',10);
        //alert(mtotal);
		document.getElementById('po_total').value=mtotal;
		//alert(document.getElementById('po_total').value);
		 
		if (mfind=="N"){ //ddd the po to list
		   document.getElementById('POBANNER').innerHTML="<b>Manage/Edit Purchase Orders</b>";
           document.getElementById('getpobtn').innerHTML="Edit PO's"; 
           var moption=document.forms['ticketform'].po_sellist.options.length;
           document.forms['ticketform'].po_sellist.options[moption] = new Option(mlineitem,mselectvalue,true,false);
           document.forms['ticketform'].po_sellist.options[moption].selected = true;
        }
                          
    //} 
    
    
    var mweeknum=getWeekNr();
    s[24] = mweeknum;
    
    
    s[5]=s[5].replace(/\'/g,"zpos");
    s[5]=s[5].replace(/\,/g,"zcomma");
    
    s[6]=s[6].replace(/\'/g,"zpos");
    s[6]=s[6].replace(/\,/g,"zcomma"); 
  
    s[7]=s[7].replace(/\'/g,"zpos");
    s[7]=s[7].replace(/\,/g,"zcomma");

    s[8]=s[8].replace(/\'/g,"zpos");
    s[8]=s[8].replace(/\,/g,"zcomma");
     
    s[14]=s[14].replace(/\'/g,"zpos");
    s[14]=s[14].replace(/\,/g,"zcomma");
    
    s[15]=s[15].replace(/\'/g,"zpos");
    s[15]=s[15].replace(/\,/g,"zcomma"); 
  
    s[16]=s[16].replace(/\'/g,"zpos");
    s[16]=s[16].replace(/\,/g,"zcomma");

    s[17]=s[17].replace(/\'/g,"zpos");
    s[17]=s[17].replace(/\,/g,"zcomma");
    
    
    //get the date information
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1;
    var day = currentTime.getDate();
    var year = currentTime.getFullYear();	  
    s[25] = month+" "+year;
    s[26] = month;
    
    document.body.style.cursor = "wait";
    showwait();
    //alert(s);
    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = savePOResponse;    
    http.send(null);

  } else {
	    
	hidewait();
    document.body.style.cursor='auto';
    
    
    document.getElementById('pomsgtext').innerHTML="You must add invoice detail charges.";
    showpomsg(); 
      
  }	    
    
    
    
}


function savePOResponse() {
 if (http.readyState == 4) {
    var returnText=http.responseText;
    //alert(returnText);
      
    hidewait();
    document.body.style.cursor='auto';
    
    if (returnText =="Purchase order has been saved"){
        
       savePODetail(0);
       
    } else {
	   
       document.getElementById('pomsgtext').innerHTML="There was an error saving PO, please try again.";
       showpomsg(); 
      
    }     
       
       
  } //end of ready state test
 

}


// saving the deatil items one at a time-1024k limit precludes saving as an array (only about 8 or 9 would save
// this way they all save without fail and the vast majority will save in a just a few seconds. 
function savePODetail(dnum) {

  //alert("Detail loop:"+dnum);
  
   var updateurl = "includes/php/save_podetail_fox.php?mform="; // The server-side script
        
    //main ticket array 	
    s = new Array();
    
    dettempPO=new Array();
    dettempPO=document.getElementById('spo_ponumber').value.split("-");   
    
    s[0] = dettempPO[0];     
    s[1] = dnum;
    	
    //save the text from lineitem select- do not save value, that was used to compile sub/tax & total.
    s[2]=trim(document.forms['poform'].spo_lnitems.options[dnum].text);
    
    //comment out next four test lines
    hidewait();
    document.body.style.cursor='auto';
    //alert(s[2]);
    //return null;
    s[3]=document.forms['poform'].spo_lnitems.options[dnum].value; 
    
    s[2]=s[2].replace(/\'/g,"zpos");
    s[2]=s[2].replace(/\,/g,"zcomma");
    
    s[3]=s[3].replace(/\'/g,"zpos");
    s[3]=s[3].replace(/\,/g,"zcomma"); 
    
    
    s[4]=document.forms['poform'].spo_lnitems.length;
    s[5] = dettempPO[1];  //ponumber
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = savePODetailResponse;    
    http.send(null);  
    
}


function savePODetailResponse() {
 if (http.readyState == 4) {
	//alert(http.responseText); 
    var detailVal=parseInt(http.responseText);
    //alert("Returned from PHP save: "+detailVal);
    detailVal=(detailVal+1);
    if(detailVal=="Error saving invoice, please try again."){
	   document.getElementById('pomsgtext').innerHTML="Error saving detail, please report to administration immediately!";
       showpomsg(); 
	    
    } else { 
    
	    if(detailVal == document.forms['poform'].spo_lnitems.length){
	       getspo('N');
	    } else {
		   savePODetail(detailVal);
	    }     
    } //end of error test on detail save loop   
       
  } //end of ready state test
 

}
 

function unvoidpo(){
	
	var xxz=0;
	
	 while (xxz < document.forms['poform'].spo_lnitems.options.length){
	
	    var editstr=document.getElementById('spo_lnitems').options[xxz].value;
	    //alert(editstr);
	    medit= new Array();
	
	    medit = editstr.split("|");
	    document.getElementById('spo_catmain').value=medit[1];
	    document.getElementById('spo_cpu').value=medit[3];
	    document.getElementById('spo_qty').value=medit[4];
	    
	    for (var i = 0; i < document.forms['poform'].spo_unit.options.length; i++) 
		 {
		    if (trim(document.forms['poform'].spo_unit.options[i].text)==trim(medit[2]))
		    {
		       document.forms['poform'].spo_unit.options[i].selected = true;
		    }
		 }
		
		if (medit[2].substring(0,1) == " ") {document.forms['poform'].spo_unit.options[0].selected = true};
	    if (medit[5].substr(0,1) == "Y") {document.getElementById('spo_taxable').checked=true};
	    document.getElementById('spo_lnitems').selectedIndex=xxz;
	  polnbuild();
	  //alert(xxz);  	
	  xxz=(xxz+1);  
   }//end of loop	
	var mdesc=document.getElementById('spo_desc').value;
	mdesc=mdesc.replace(/\VOID-/g,"");
	mdesc=mdesc.replace(/\void/g,"");
	mdesc=mdesc.replace(/\Void/g,"");
	document.getElementById('spo_desc').value=mdesc;
	savePO();
	//document.getElementById('pomsgtext').innerHTML="Change the description and click the save button <br>to complete re-activation of voided PO.";
    //showpomsg(); 
}


function capltrs(){
document.getElementById('spo_catmain').value=document.getElementById('spo_catmain').value.toUpperCase();
}	
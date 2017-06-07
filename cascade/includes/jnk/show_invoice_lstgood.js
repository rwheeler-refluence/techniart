function showInvoice(frmwho) {
  var updateurl = "includes/php/get_invoice_fox.php?mform="; // The server-side script
  if (trim(document.getElementById('stkJOB_ID').value) != "" || trim(document.getElementById('tk_stkJOB_ID').value) != "") {

    s = new Array(); 
    if (frmwho=='TK'){
       s[0] = document.getElementById('tk_stkJOB_ID').value;
    } else {
	   s[0] = document.getElementById('stkJOB_ID').value;     
    }
    
        
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = showInvoiceResponse;
    http.send(null);

  } else {
  
    document.getElementById('confirmtext').innerHTML="Error getting ticket number.";
    showconfirm();

  }


}


//added this to the cuctomer care invoice retrieval, really should have had a non cc file
function showTKInvoice() {
	
 
      if (document.getElementById('tk_hasinvoice').value == "Y") {
        var updateurl = "includes/php/get_invoice_fox.php?mform="; // The server-side script
      } else {
	    var updateurl = "includes/php/build_invoice_fox.php?mform="; // The server-side script  
      }          	
	
  if (trim(document.getElementById('tk_stkJOB_ID').value) != "") {

    s = new Array(); 
    s[0] = document.getElementById('tk_stkJOB_ID').value;
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    //if (document.getElementById('tk_hasinvoice').value == "Y") {
    //  http.onreadystatechange = showInvoiceResponse;
    //} else {
	  http.onreadystatechange = buildInvoiceResponse; 
    //}    
    
    http.send(null);

  } else {
  
    document.getElementById('confirmtext').innerHTML="Error getting ticket number.";
    showconfirm();

  }


}



function showInvoiceResponse() {

  if (http.readyState == 4) {

   hidewait();
   document.body.style.cursor='auto';
//alert('in showinvoiceresponse :'+http.responseText);
   if (document.getElementById('mtktscreenup').value == "YES"){
       var mwho=document.getElementById('tk_stkJOB_ID').value;
   } else {
       var mwho=document.getElementById('stkJOB_ID').value;
   }
   reportArray = new Array();
   reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>Draft Invoice</td></tr></table>";  
   reportArray[1] = "";
   reportArray[2] = "";
   reportArray[3] = "";
   var mtest=http.responseText.split("|");

//alert(mtest[1].substring(0,6));

if (mtest[1].substring(0,6)=="No Inv"){
  
  document.getElementById('confirmtext').innerHTML="No invoice available.";
  showconfirm();
  return null;
  
} else {

   results = http.responseText.split("^");
   r1= new Array();

   // this will build out the columns for the orders and record counts
   for (x in results)
    {

       r1 = results[x].split("|");

       if (x==0) {

           reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
           reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='20%'>Invoice Number: </td><td width='27%' align='left'>"+r1[0]+"</td><td align='left' width='20%'>Date: </td><td width='30%' align='left'>"+r1[1]+"</td></tr></table>"; 
           reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
 
           reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
            
           reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='17%'>Sold To : </td><td width='30%' align='left'></td><td width='20%'>Ship To : </td><td width='30%' align='left'></td></tr></table>";            
           reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='47%' align='left'>"+r1[2]+"</td><td width='50%' align='left'>"+r1[7]+"</td></tr></table>"; 
           reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='47%' align='left'>"+trim(r1[3])+"</td><td width='50%' align='left'>"+trim(r1[8])+"</td></tr></table>"; 
           reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='47%' align='left'>"+r1[4]+"&nbsp;&nbsp;"+r1[5]+"&nbsp;&nbsp;"+r1[6]+"</td><td width='50%' align='left'>"+r1[9]+"&nbsp;&nbsp;"+r1[10]+"&nbsp;&nbsp;"+r1[11]+"</td></tr></table>"; 
           reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";
 
           reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
      
       
           reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='left'>&nbsp</td><td align='left' width='15%'>Ship Via :</td><td width='32%' align='left'>"+r1[12]+"</td><td align='left' width='15%'>Cust ID:</td><td width='35%' align='left'>"+r1[15]+"</td></tr></table>"; 
           reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='left'>&nbsp</td><td align='left' width='15%'>Ship Date:</td><td width='32%' align='left'>"+r1[13]+"</td><td align='left' width='15%'>Terms :</td><td width='35%' align='left'>"+r1[16]+"</td></tr></table>"; 
           reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='left'>&nbsp</td><td align='left' width='15%'>Invoice Due:</td><td width='32%' align='left'>"+r1[14]+"</td><td align='left' width='15%'>PO Number:</td><td width='35%' align='left'>"+r1[17]+"</td></tr></table>"; 
           reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";
 
           reportArray[1] = reportArray[1]+"<table class='bannerline' width='100%' border='0'><tr width='94%' style='font: 11px Arial'><td width='96%' align='left'><b>Line Items</b></td></tr></table>";


           //bottom of reciept amount/salestax/amtdue
           var mnum1=eval(r1[18]);  
           var mnum2=eval(r1[19]); 
           var mnum3=eval(r1[20]); 
           var mnum4=eval(r1[21]); 
           mnum1=mnum1.toFixed(2);
           mnum2=mnum2.toFixed(2);
           mnum3=mnum3.toFixed(2);
           mnum4=mnum4.toFixed(2);
           reportArray[3] = reportArray[3]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
           reportArray[3] = reportArray[3]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='60%'></td><td width='25%' align='right'>Subtotal:</td><td width='10%' align='right'>"+mnum1+"</td><td width='2%' align='right'>&nbsp</td></tr></table>"; 
           reportArray[3] = reportArray[3]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='60%'></td><td width='25%' align='right'>Tax:</td><td width='10%' align='right'>"+mnum2+"</td><td width='2%' align='right'>&nbsp</td></tr></table>"; 
           reportArray[3] = reportArray[3]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='60%'></td><td width='25%' align='right'>Total:</td><td width='10%' align='right'>"+mnum3+"</td><td width='2%' align='right'>&nbsp</td></tr></table>"; 
           reportArray[3] = reportArray[3]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='60%'></td><td width='25%' align='right'>Amount paid:</td><td width='10%' align='right'>"+mnum4+"</td><td width='2%' align='right'>&nbsp</td></tr></table>"; 
           reportArray[3] = reportArray[3]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";
   
       

       } else {
         var mresult=trim(results[x]);


         if (mresult.length > 0) {
           if (trim(r1[1]) !=''){
              var mtempnum=eval(r1[2]); 
              mtempnum=mtempnum.toFixed(2);
              if (r1[1]=='0'){
                reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='85%' align='left'>"+r1[1]+"</td><td width='10%' align='right'></td><td width='2%' align='right'>&nbsp</td></tr></table>"; 
              } else {
                reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr style='font: 11px Arial'><td width='3%' align='right'>&nbsp</td><td width='85%' align='left'>"+r1[1]+"</td><td width='10%' align='right'>"+mtempnum+"</td><td width='2%' align='right'>&nbsp</td></tr></table>"; 
              }
           }
         } 
       }

     }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:8px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=reportArray[0];
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"<br>"+reportArray[3]+"</div>";
    document.getElementById('current_pdf').value="invoice";
    document.getElementById('pdfid').value=mwho;
    showreport("inv");

} // end of error test


  }

}



// this function prints dall invoices in the accoutning
function printcisInvoice() {
  var updateurl = "includes/php/print_cisinv.php?mform="; // The server-side script
  
  s = new Array(); 
  if (trim(document.getElementById('stkJOB_ID').value) != ""){
    s[0] = document.getElementById('stkJOB_ID').value; 
  } else if (trim(document.getElementById('tk_stkJOB_ID').value) != "") {
	s[0] = document.getElementById('tk_stkJOB_ID').value;
  }	else {
	s[0] = document.getElementById('binv_JOB_ID').value;  
  }	  
   
    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = printcisInvoiceResponse;
    http.send(null);
    

}

function printcisInvoiceResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.substring(0,6);
    //alert(results);
   
    if (trim(document.getElementById('binv_JOB_ID').value) !=results){
       document.getElementById('binvmsgtext').innerHTML="<br><br>There was an error printing PDF, please put in edit mode and try again.";
       showbinvmsg();
    }   

    //setTimeout("killacro();",1000);  //ln2220
    acctngInvoice(trim(document.getElementById('binv_JOB_ID').value));        
  } //end of ready state test
}//end of function



// this calls the build invoice screen from acctng
function acctngInvoice(jnumber) {
	
if (jnumber !=null){
	acctngInvSingle(jnumber,"Y","Y");
} else {		

  // this check to see if the selected invoice needs to be built or edited	
  if (document.getElementById('invbuttxt2').innerHTML=='Edit Inv') {
     var updateurl = "includes/php/get_invoice_fox.php?mform="; // The server-side script
  } else {
     var updateurl = "includes/php/build_invoice_fox.php?mform="; // The server-side script  
  } 
  		
  s = new Array(); 	
  
  if (document.forms['acctngform'].tkselectAcctng.options.length > 0 && document.forms['acctngform'].tkselectAcctng.selectedIndex > -1){  
	  var mval= new Array();
      mval = document.getElementById('tkselectAcctng').value.split("|");
      s[0] =  mval[2];
    } else {
	  s[0] = document.getElementById('tk_stkJOB_ID').value;  
  }
        	
  if (trim(s[0])!=''){
   	    
  document.body.style.cursor = "wait";
  showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = buildInvoiceResponse;  
    http.send(null);
  } else {
	//alert('testing 123');
	if (document.forms['acctngform'].tkselectAcctng.options.length){    
       document.getElementById('acctngmsgtext').innerHTML='There is no selected invoice to edit.';
       showAcctngmsg();
    } else {   
      alert("Please select an invoice to edit.");	  
    }  
  }	  
 
}//end of check for jnumber
   
}



//build invoice responce
function buildInvoiceResponse() {

  if (http.readyState == 4) {
	  
//alert('in buildInvoiceResponse :'+http.responseText);	  
	  
      var mposted="N";
      var efind = http.responseText.indexOf("FPDF");
	  if (efind !=-1){
         hidewait();
         document.body.style.cursor='auto';
         //document.getElementById('tkselectAcctng').selectedIndex=-1;
         //document.getElementById('acctngmsgtext').innerHTML='PDF Error, Please try again.';
         //showAcctngmsg();
         alert("Error pulling invoice, Please try again.");
         return null;	  
      } 	  
   //alert(http.responseText)
   hidewait();
   document.body.style.cursor='auto';
   if (document.getElementById('mtktscreenup').value == "YES"){
       var mwho=document.getElementById('tk_stkJOB_ID').value;
   } else {
       var mwho=document.getElementById('stkJOB_ID').value;
   }
  
   //old check var mtest=http.responseText; - "This job already has an invoice"
   
      var mtest=http.responseText.split("^");
      rtest = mtest[0].split("|");
      //alert(rtest); 
      
      if (rtest[25] == "thisjobhasinvoice"){
     
         hidewait();
         
         
         var mtest=http.responseText;
         
         //alert(mtest);
         if (mtest.substring(0,5) == "Error" || trim(mtest) == '' ){
   
            hidewait();
            document.body.style.cursor='auto';
            document.getElementById('tkselectAcctng').selectedIndex=-1;
            document.getElementById('acctngmsgtext').innerHTML='Error getting the invoice. Please try again.';
            showAcctngmsg();

         } else {

             results = http.responseText.split("^");
             r1= new Array();
             
             //empty out line items
             document.forms['invoiceform'].binv_lnitems.options.length = 0;

             // this will build out the existing invoice
             for (x in results)
             {

                r1 = results[x].split("|");

                //trim all the fields
                for (t in r1){
                   r1[t]=trim(r1[t]);
                }
                
                
                
                if (x==0) {

	                
	              //tax is pulled from database and could be different than when job was ordered originally  
	              document.getElementById('binv_taxflag').value=trim(r1[24]);
                  //alert("existing"+r1[24]);
  
	              document.getElementById('binv_job_id').value=r1[0];
	              mwho=r1[0];
	              
	              if (r1[1].substring(0,5) =="12:00"){
           		       r1[1]='';
	              } 
	              document.getElementById('binv_invdate').value=r1[1];
                  
                  
                  if (r1[13].substring(0,5) =="12:00"){
           		       r1[13]='';
	              } 
	              
                  document.getElementById('binv_date_done').value=r1[13];
                  
                  document.getElementById('binv_po').value=r1[17];             
                  document.getElementById('binv_cust_id').value=r1[15];
              
                  document.getElementById('binv_acctcont').value=r1[22];
                  document.getElementById('binv_acctcomp').value=r1[2];
                  document.getElementById('binv_acctadd1').value=r1[3];
                  document.getElementById('binv_acctcity').value=r1[4];
                  document.getElementById('binv_acctst').value=r1[5];
                  document.getElementById('binv_acctzip').value=r1[6];   
	                
	              //r1[12] IS SHIPPING FIELD
	              var mz3 = document.forms['invoiceform'].binv_mship.options.length;
	              mz3=mz3-1;
	              r1[12] = padRight(r1[12],' ',15);
	              if (r1[12].substring(0,6) !="Object") 
	              {
	 
	                 for (var i = 0; i < document.forms['invoiceform'].binv_mship.options.length; i++) 
	                 {
	                   if (document.forms['invoiceform'].binv_mship.options[i].text.substring(0,15)==r1[12].substring(0,15))
	                   {
	                      document.forms['invoiceform'].binv_mship.options[i].selected = true;
	                   }
	                 }
	
	              } else {document.forms['invoiceform'].binv_mship.options[mz3].selected = true};
	
                  if (r1[12].substring(0,1) == " ") {document.forms['invoiceform'].binv_mship.options[mz3].selected = true};
	
              
                  //r1[16] IS terms FIELD
	              var mz4 = document.forms['invoiceform'].binv_mterms.options.length;
	              mz4=mz4-1;
	              r1[16] = padRight(r1[16],' ',11);
	              if (r1[16].substring(0,6) !="Object") 
	              { 
              	     for (var i = 0; i < document.forms['invoiceform'].binv_mterms.options.length; i++) 
	                 {
	                   if (document.forms['invoiceform'].binv_mterms.options[i].text.substring(0,11)==r1[16].substring(0,11))
	                   {
	                     document.forms['invoiceform'].binv_mterms.options[i].selected = true;
	                   }
	                 }
	
                  } else {document.forms['invoiceform'].binv_mterms.options[mz4].selected = true};
	
         	      if (r1[16].substring(0,1) ==" ") {document.forms['invoiceform'].binv_mterms.options[mz4].selected = true};
	  
	               document.getElementById('binv_shipcont').value=r1[23];
                   document.getElementById('binv_shipcomp').value=r1[7];
                   document.getElementById('binv_shipadd1').value=r1[8];
                   document.getElementById('binv_shipcity').value=r1[9];
                   document.getElementById('binv_shipst').value=r1[10];
                   document.getElementById('binv_shipzip').value=r1[11];
                   document.getElementById('binv_shipzip4').value=r1[28];
                   
                   //if any taxes exist
                   if (r1[29] > 0){
                     document.getElementById('binv_taxLocal').value=r1[29];
                     document.getElementById('binv_taxState').value=r1[30];
                     document.getElementById('binv_taxCode').value=r1[31];
                     document.getElementById('binv_taxTotal').value=r1[32];
                     document.getElementById('taxratedisplay').innerHTML="Tax rate is "+(r1[32]*100)+"%";
                   } 
                                      
                   if (r1[14].substring(0,5) =="12:00"){
           		       r1[14]='';
	               } 
                   document.getElementById('binv_invdue').value=r1[14];
                   if (trim(rtest[26])=="Y" || rtest[27].substring(0,5) !="12:00"){ 
	                   mposted="Y";
	               }
                   
                   // the following alerts were for testing the data coming in  
                   /*
                   alert("Invoice Number:"+r1[0]);
                   alert("Invoice Date:"+r1[1]);
         
    
                   alert("Sold To : ");
                   alert(" contact "+r1[2]);
                   alert(" company "+trim(r1[3]));
                   alert(" city, st & zip:"+r1[4]+r1[5]+r1[6]);

                   alert("Ship To :");             
                   alert(" contact "+r1[7]);
                   alert(" company "+trim(r1[8]));
                   alert(" city, st & zip:"+r1[9]+r1[10]+r1[11]);
         
                   alert("Ship Via :"+r1[12]);
                   alert("Cust ID:"+r1[15]);
                   alert("Ship Date:"+r1[13]);
                   alert("Terms : "+r1[16]);
                   alert("Invoice Due: "+r1[14]);
                   alert("PO Number: "+r1[17]);
              
                   alert("sub:"+r1[18]);
                   alert("tax: "+r1[19]);
                   alert("total: "+r1[20]);
                   alert("paid: "+r1[21]);
                   */
                   
                   //bottom of reciept amount/salestax/amtdue
                   
                   var mnum1=eval(r1[18]); 
                   
                   var mnum2=eval(r1[19]);
                   
                   var mnum3=eval(r1[20]);
                   
                   
                   var mnum4=eval(r1[21]);
                   
                   mnum1=mnum1.toFixed(2);
                   mnum2=mnum2.toFixed(2);
                   mnum3=mnum3.toFixed(2);
                   mnum4=mnum4.toFixed(2);
           
                   //do not do calctotals() as we want to pull whatever is in the file;
	               msubStr=mnum1+" ";
                   msubStr= padLeft(msubStr,' ',10);
                   document.getElementById('binv_subtotal').value=msubStr;

                   mtaxStr=mnum2+" ";
                   mtaxStr= padLeft(mtaxStr,' ',10);
                   document.getElementById('binv_tax').value=mtaxStr;
  
                   mtotalStr=mnum3+" ";
                   mtotalStr= padLeft(mtotalStr,' ',10);
                   document.getElementById('binv_total').value=mtotalStr;
                                  
                   //not using amount paid because those cannot be edited.   
                   //alert("Subtotal:"+mnum1); 
                   //alert("Tax:  "+mnum2); 
                   //alert("Total: "+mnum3); 
                   //alert("Amount paid: "+mnum4); 
           
                } else {

                   var mresult=trim(results[x]);

                   if (mresult.length > 0) {
                     if (trim(r1[1]) !=''){
                       var mtempnum=eval(r1[2]); 
                       mtempnum=mtempnum.toFixed(2);
                       mtempnumStr=mtempnum+" ";
                       var moptionnum=document.forms['invoiceform'].binv_lnitems.options.length;
                     
                       //build out detail value with all the pieces for saving in the detail database
                       var mselectvalue=mtempnum+"|"+trim(r1[3])+"|"+trim(r1[4])+"|"+trim(r1[5])+"|"+trim(r1[6])+"|"+trim(r1[7])+"|"+trim(r1[8]);  
                       //alert(mselectvalue);
                       if (mtempnum==0){
	                        var mlineitem=r1[1];
                            document.forms['invoiceform'].binv_lnitems.options[moptionnum] = new Option(mlineitem,mselectvalue,true,false); 
                       } else { 
	                        r1[1] =trim(r1[1]);
                            mtempnumStr=trim(mtempnumStr);
	                        r1[1] = padRight(r1[1],' ',76);
	                        mtempnumStr= padLeft(mtempnumStr,' ',10);
                            mlineitem=r1[1]+mtempnumStr;
                            if (trim(r1[8])=="P" && document.getElementById('binv_taxflag').value=="Y"){mlineitem=mlineitem+" Y"};
                            document.forms['invoiceform'].binv_lnitems.options[moptionnum] = new Option(mlineitem,mselectvalue,true,false); 
                       }
                     }
                   } 
                 } // end of condition to check for line item  


             } //end of loop

             document.getElementById('EDITINVBANNER').innerHTML="<b>Edit Invoice</b>";
             
             togglePrintSave("P");
             

         } // end of has invoice error test

	 
  
	  // the next section is to build an invoice if one does not exist  	     
      } else {

          results = http.responseText.split("^");
          r1= new Array();

          // this will build out the info for building an invoice
          for (x in results){

            r1 = results[x].split("|");
            
            //trim all the fields
            for (t in r1){
              r1[t]=trim(r1[t]);
            }
            
            if (x==0) {
              document.getElementById('binv_job_id').value=r1[0];
              mwho=r1[0];
              //document.getElementById('binv_date_in').value=r1[1];
              
                var invDate = new Date();
                var month = invDate.getMonth() + 1;
                var day = invDate.getDate();
                var year = invDate.getFullYear();	     
                document.getElementById('binv_invdate').value=month + "/" + day + "/" + year;
              
              if (r1[5].substring(0,5) =="12:00" || trim(r1[5].substring(0,5))==''){
                  hidewait();
                  document.body.style.cursor='auto';
                 if (document.getElementById('mtksinglescrup').value=="YES"){
	                hidewait();
                    document.getElementById('confirmtext').innerHTML="This job has not been closed, please close the job before adding an invoice.";
                    showconfirm();
                    
                 } else { 
                    alert("This job has not been closed, please close the job before adding an invoice.");
                 }    
                return null;	  
              } 	  
              
              if (document.getElementById("ucoid").value=='CIS'){    
                    r1[1]=r1[1].charAt(5)+r1[1].charAt(6)+"/"+r1[1].charAt(8)+r1[1].charAt(9)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
                    r1[5]=r1[5].charAt(5)+r1[5].charAt(6)+"/"+r1[5].charAt(8)+r1[5].charAt(9)+"/"+r1[5].charAt(2)+r1[5].charAt(3);
              }    
              
              
              
              
              
              document.getElementById('binv_date_done').value=r1[5];
              
              document.getElementById('binv_po').value=r1[4];
              document.getElementById('binv_cust_id').value=r1[6];
    
              document.getElementById('binv_acctcont').value=r1[9];
              document.getElementById('binv_acctcomp').value=r1[10];
              document.getElementById('binv_acctadd1').value=r1[11];
              document.getElementById('binv_acctcity').value=r1[12];
              document.getElementById('binv_acctst').value=r1[13];
              document.getElementById('binv_acctzip').value=r1[14];
              
              
              //r1[15] IS SHIPPING FIELD
	          var mz3 = document.forms['invoiceform'].binv_mship.options.length;
	          mz3=mz3-1;
	          r1[15] = padRight(r1[15],' ',15);
	          if (r1[15].substring(0,6) !="Object") 
	          {
	 
	             for (var i = 0; i < document.forms['invoiceform'].binv_mship.options.length; i++) 
	             {
	                if (document.forms['invoiceform'].binv_mship.options[i].text.substring(0,15)==r1[15].substring(0,15))
	                {
	                      document.forms['invoiceform'].binv_mship.options[i].selected = true;
	                }
	             }
	
	          } else {document.forms['invoiceform'].binv_mship.options[mz3].selected = true};
	
              if (r1[15].substring(0,1) == " ") {document.forms['invoiceform'].binv_mship.options[mz3].selected = true};
	
              
              //r1[16] IS terms FIELD
	          var mz4 = document.forms['invoiceform'].binv_mterms.options.length;
	          mz4=mz4-1;
	          r1[16] = padRight(r1[16],' ',11);
	          if (r1[16].substring(0,6) !="Object") 
	          {
	 
              	 for (var i = 0; i < document.forms['invoiceform'].binv_mterms.options.length; i++) 
	             {
	                if (document.forms['invoiceform'].binv_mterms.options[i].text.substring(0,11)==r1[16].substring(0,11))
	                {
	                   document.forms['invoiceform'].binv_mterms.options[i].selected = true;
	                }
	             }
	
             } else {document.forms['invoiceform'].binv_mterms.options[mz4].selected = true};
	
         	 if (r1[16].substring(0,1) ==" ") {document.forms['invoiceform'].binv_mterms.options[mz4].selected = true};
	 
	           //check to see if current tax field contains a value  ---added an pad field because I didn't like r1[24]
               //being used to determine existing record and test for value
	           if (r1[17]=="Y") {
		           document.getElementById('binv_taxflag').value="Y";
	           } else {
		           document.getElementById('binv_taxflag').value="N";  
	           }
	           
               
              //alert("new"+r1[17]);  
              
              document.getElementById('binv_shipcont').value=r1[18];
              document.getElementById('binv_shipcomp').value=r1[19];
              document.getElementById('binv_shipadd1').value=r1[20];
              document.getElementById('binv_shipcity').value=r1[21];
              document.getElementById('binv_shipst').value=r1[22];
              document.getElementById('binv_shipzip').value=r1[23];
              document.getElementById('binv_shipzip4').value=r1[24];
              
              //empty out line items
              document.forms['invoiceform'].binv_lnitems.options.length = 0;
              
              // make invoice date right
              recalcidt();
                 
            }
          }
          togglePrintSave("S");
          
          document.getElementById('EDITINVBANNER').innerHTML="<b>Create Invoice</b>";
          hidewait();
          
          document.body.style.cursor='auto';
          //document.getElementById('confirmtext').innerHTML="made it back from build tk php.";
          //showbinv();

      } // end of error test
      
      document.getElementById('current_pdf').value="invoice";
      document.getElementById('pdfid').value=mwho;
      
      getpagenum();
      showbinv();
      
      if (mposted=="Y"){ 
	     document.body.style.cursor='auto';
	     hidewait();
         document.getElementById('binvmsgtext').innerHTML="<br><br>This invoice has been sent to customer, please<br>alert accounting of any changes.";
         showbinvmsg();
      }

  } // end of ready state test

} //end of funtion

function recalcidt(){
  var i=document.forms['invoiceform'].binv_mterms.selectedIndex;
  var currentTime = new Date();
  

     if (document.forms['invoiceform'].binv_mterms.options[i].text.substring(0,6)=="NET 7 ")
     {	  
         currentTime.setDate(currentTime.getDate()+7); 
     } else if (document.forms['invoiceform'].binv_mterms.options[i].text.substring(0,6)=="NET 15"){
	     currentTime.setDate(currentTime.getDate()+15); 
     } else if (document.forms['invoiceform'].binv_mterms.options[i].text.substring(0,6)=="NET 30"){
	     currentTime.setDate(currentTime.getDate()+30); 
     } else if (document.forms['invoiceform'].binv_mterms.options[i].text.substring(0,9)=="NET 15 CC"){
	     currentTime.setDate(currentTime.getDate()+15); 
     } else if (document.forms['invoiceform'].binv_mterms.options[i].text.substring(0,9)=="NET 30 CC"){
	     currentTime.setDate(currentTime.getDate()+30); 
     }      
	
  
var month = currentTime.getMonth() + 1;
var day = currentTime.getDate();
var year = currentTime.getFullYear();	     
document.getElementById('binv_invdue').value=month + "/" + day + "/" + year;   
     
	
}	


function binvclear(){
  
  document.forms['invoiceform'].binv_unit.selectedIndex=-1;
  document.forms['invoiceform'].binv_dept.selectedIndex=-1;
  document.getElementById('binv_qty').value="          0";
  document.getElementById('binv_cpu').value="     0.00";
  document.getElementById('binv_catmain').value="";
  
  document.forms['invoiceform'].binv_category.options.length = 0;
  document.forms['invoiceform'].binv_category[0] = new Option(" "," ",true,false);
  document.forms['invoiceform'].binv_lnitems.selectedIndex=-1;
  getbinvunit();
  
}	


function addcomment(){
 document.body.style.cursor = "wait";
 togglePrintSave('S');	
  showwait()
  var checkforErrors="";
 
   if (trim(document.getElementById('binv_catmain').value)==""){
    checkforErrors=checkforErrors+"<br>You must choose a category or enter a custom entry.";  
  }
  
   if (trim(checkforErrors) !=""){
     hidewait();
     document.body.style.cursor='auto';
     document.getElementById('binvmsgtext').innerHTML=checkforErrors+"<br><br>Please correct and try again.";
     showbinvmsg();
  } else {

      //add the comment only cat entry to line items
      var i=document.forms['invoiceform'].binv_lnitems.selectedIndex; 

	  var mlineItem="test number :"+document.forms['invoiceform'].binv_lnitems.selectedIndex;
	  mlineItem=trim(document.getElementById('binv_catmain').value);
	  mlineItem=mlineItem.toUpperCase();
	  document.getElementById('cutbuttonl').style.visibility =  "visible"; 
      mtempnum=0;
      //build out detail value with all the pieces for saving in the detail database
      var mselectvalue=	mtempnum+"|"+trim(document.getElementById('binv_catmain').value)+"|"+trim(document.getElementById('binv_unit').value)+"|"+trim(document.getElementById('binv_cpu').value)+"|"+trim(document.getElementById('binv_qty').value)+"|"+trim(document.getElementById('binv_dept').value);  

      sop=' '; //service or prod empty on comment only
      
      // no need to determine product or service on comment line
      
      mselectvalue=mselectvalue+"|"+sop;
      
      
	  if (i==-1){ 
     	  i=document.forms['invoiceform'].binv_lnitems.options.length;  
          document.forms['invoiceform'].binv_lnitems[i] = new Option(mlineItem,mselectvalue,true,false); 
      } else {
	      
          document.forms['invoiceform'].binv_lnitems[i] = new Option(mlineItem,mselectvalue,true,false); 
      }	           	  
 
      
        binvclear();    	  
  
  } // end of error check	  
  
  if (document.forms['invoiceform'].binv_lnitems.options.length==0){document.getElementById('cutbuttonl').style.visibility =  "hidden"}; 

  getpagenum()
  hidewait();  
  document.body.style.cursor='auto';  

} //end of comment only
  
function invLnInsert(){
	
	
var z=document.forms['invoiceform'].binv_lnitems.options.length; 
if (z!=0){
	
	var mlineItemb=" ";
	var mselectvalueb="0.00| |EA|0|0|0";  
	var msel=document.forms['invoiceform'].binv_lnitems.selectedIndex;
	if ((z-1)==msel){
	
		document.forms['invoiceform'].binv_lnitems[z] = new Option(document.forms['invoiceform'].binv_lnitems.options[z-1].text,document.forms['invoiceform'].binv_lnitems.options[z-1].value,true,false); 	
	    document.forms['invoiceform'].binv_lnitems.options[z-1] = new Option(mlineItemb,mselectvalueb,true,false);
	    var newsel=(z-1);
	    binvclear();
	    document.forms['invoiceform'].binv_lnitems.selectedIndex=newsel; 
	
	} else {   
	  
	  while (z > 0){
		 document.forms['invoiceform'].binv_lnitems[z] = new Option(document.forms['invoiceform'].binv_lnitems.options[z-1].text,document.forms['invoiceform'].binv_lnitems.options[z-1].value,true,false); 	
	     document.forms['invoiceform'].binv_lnitems.options[z-1] = new Option(mlineItemb,mselectvalueb,true,false);  
		 //alert((z-1)+" <--loop cnt  --->selected "+msel);
		 if ((z-1)==msel){
		   var newsel=(z-1);
		    binvclear();
		    document.forms['invoiceform'].binv_lnitems.selectedIndex=newsel; 
		   break;	 
	     } else {	 
		   z=(z-1);
	     }	        
	   }	
		
	}//end of last select test

} else {
	document.getElementById('binvmsgtext').innerHTML="<br><br>You cannot insert a line when no other<br>invoice line items exist.";
    showbinvmsg();
} // end of check for no detail		 	
}	

  
function binvbuild(){
  
 //lets get the tax rate b4 building anything- do it on all tickets even though there is only tax on WA & Texas now
 //this will keep taxes data driven- just add zip and a zip4 range and state local & tot rate when disticts are added
  var updateurl = "includes/php/get_taxrates_fox.php?mform="; // The server-side script

  if (trim(document.getElementById('binv_taxflag').value) =="Y" && trim(document.getElementById('binv_shipzip4').value)==''){
    hidewait();
    document.body.style.cursor='auto';
    document.getElementById('binvmsgtext').innerHTML="<br><br>Please enter a zip plus 4 code.";
    showbinvmsg();
    return null;
  }
  
  s = new Array(); 
  s[0] = document.getElementById('binv_shipzip').value;
  s[1] = document.getElementById('binv_shipzip4').value;     
  s[2] = trim(document.getElementById('binv_taxflag').value);
            
  document.body.style.cursor = "wait";
  showwait();

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = binvbuildResponse;
  http.send(null);
  
} //end of calling binvoice 


function binvbuildResponse(){
	
  if (http.readyState == 4) {
  
  	var results=http.responseText.split('^');
	var checkforErrors="";
    
    hidewait();
    document.body.style.cursor='auto';
    
    var mlocaltax=eval(results[0]);
    var mstatetax=eval(results[1]);
    var mtotaltax=eval(results[2]);
    
    mlocaltax=mlocaltax.toFixed(4);
    mstatetax=mstatetax.toFixed(4);
    mtotaltax=mtotaltax.toFixed(4);
    
    //alert(' Local: ' + mlocaltax + ' State: ' + mstatetax + ' Total: ' + mtotaltax + ' Code : ' + results[3]);
    //return null;
    
    document.getElementById('binv_taxLocal').value=results[0];
    document.getElementById('binv_taxState').value=results[1];
    document.getElementById('binv_taxTotal').value=results[2];
    document.getElementById('binv_taxCode').value=results[3];
    
    
    //reset if texas
    var tempst=document.getElementById('binv_acctst').value;
	tempst=tempst.toUpperCase();
	  	
	//be sure and change this in move ticket php file - it recalculates texas tax
	if (tempst=="TX"){	
	  document.getElementById('binv_taxLocal').value=".0000";
      document.getElementById('binv_taxState').value=".0825";
      document.getElementById('binv_taxTotal').value=".0825";
      document.getElementById('binv_taxCode').value="9999"; 		  	
  	} 
  	
    //use these in calctotals ln 1360's
    document.getElementById('binv_catmain').value=document.getElementById('binv_catmain').value.toUpperCase();
  
    //check and make sure the min order charge is not an edit - is allowed on inserted lines
    var noeditminorder =document.getElementById('binv_catmain').value.indexOf("MINIMUM INVOICE");
  
    if (noeditminorder !=-1){
	 document.getElementById('binv_qty').value="1"; //min order can only times 1 
     var meditline=document.forms['invoiceform'].binv_lnitems.selectedIndex;
     if (meditline > -1){ 
        if (trim(document.forms['invoiceform'].binv_lnitems.options[meditline].text) !=''){  
          document.getElementById('binvmsgtext').innerHTML=checkforErrors+"<br><br>You cannot edit an existing detail line with a minimum order.<br>Remove this line and then add the minimum order charge amount.";
          showbinvmsg();
          binvclear();
	      return false;
        }    
     }  
    } 
  

    document.body.style.cursor = "wait";	
    showwait();
    togglePrintSave('S');

    if (document.forms['invoiceform'].binv_dept.selectedIndex < 1 || document.forms['invoiceform'].binv_dept.selectedIndex==0){
      checkforErrors=checkforErrors+"<br>You must choose a department.";  
    }
  
    if (trim(document.getElementById('binv_catmain').value)==""){
      checkforErrors=checkforErrors+"<br>You must choose a category.";  
    }
  
    if (trim(document.getElementById('binv_qty').value)=="0" || trim(document.getElementById('binv_qty').value)==""){ 
  	  if (trim(document.getElementById('binv_cpu').value)=="0.00" || trim(document.getElementById('binv_cpu').value)==""){  
        checkforErrors=checkforErrors+"<br>You to have a quanity of at least 1 if a CPU is entered.";  
      }
    }
  
    if (trim(checkforErrors) !=""){
       hidewait();
       document.body.style.cursor='auto';
       document.getElementById('binvmsgtext').innerHTML=checkforErrors+"<br><br>Please correct and try again.";
       showbinvmsg();
    } else {
        checkforErrors=""; //clear message to use again in min neg check
        //add the line items
        var i=document.forms['invoiceform'].binv_lnitems.selectedIndex; 

	    var mlineItem="test number :"+document.forms['invoiceform'].binv_lnitems.selectedIndex;
	    var mcpuStr=0;
	  
	    var zcpu=document.getElementById('binv_cpu').value;
        var zq=document.getElementById('binv_qty').value;
	    var mincheck1=trim(document.getElementById('binv_catmain').value);
        mincheck1=mincheck1.toUpperCase();
	    var afind = mincheck1.indexOf("MINIMUM INVOICE");
	    if (afind ==-1){
            mcpuStr=(document.getElementById('binv_cpu').value*1);
        } else {
	        mcpuStr=(zq*zcpu)-document.getElementById('binv_subtotal').value;
        } 
	      	  
	    mcpuStr=mcpuStr.toFixed(2);
	    mcpuStr1=mcpuStr+" ";
	  
        var mqStr=0;
        mqStr=(document.getElementById('binv_qty').value*1);  
	    //mqStr=mqStr.toFixed(2);
	    mqStr1=Comma(mqStr);
	    mlineItem=trim(document.getElementById('binv_catmain').value)+"  "+trim(mqStr1)+" @ "+trim(mcpuStr1);
	    mlineItem=mlineItem.toUpperCase();
	 
	  
	    if (trim(document.getElementById('binv_cpu').value) !="0.00" && trim(document.getElementById('binv_cpu').value) !=""){
          if (trim(document.getElementById('binv_unit').value) !="NONE" && trim(document.getElementById('binv_unit').value) !=""){
		     if (afind ==-1){
	          mlineItem=mlineItem+"/"+trim(document.getElementById('binv_unit').value);  
             } 
	      }              
        }	  
	    document.getElementById('cutbuttonl').style.visibility =  "visible"; 

  	    //calculate price

        var mcpu=document.getElementById('binv_cpu').value;
        var mq=document.getElementById('binv_qty').value;
 
        if (document.getElementById('binv_unit').selectedIndex==2){
          mcpu=(mcpu/1000);
        }   	
	
        if (document.getElementById('binv_unit').selectedIndex==0){
		  mq=1;
        }
        
        
        var mincheck=trim(document.getElementById('binv_catmain').value);
        mincheck=mincheck.toUpperCase();
  	    var afind = mincheck.indexOf("MINIMUM INVOICE");
	    if (afind ==-1){
            var mprice=(mq*mcpu);
        } else {
	        var mprice=(mq*mcpu)-document.getElementById('binv_subtotal').value;
        } 
         
       //if (mprice < .00){
          //checkforErrors=checkforErrors+"<br>The invoice is already above minimum invoice charge.";  
       //} else {
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
          var mselectvalue=	mtempnum+"|"+trim(document.getElementById('binv_catmain').value)+"|"+trim(document.getElementById('binv_unit').value)+"|"+trim(document.getElementById('binv_cpu').value)+"|"+trim(document.getElementById('binv_qty').value)+"|"+trim(document.getElementById('binv_dept').value);  
            
          // determine service or product if priced
          var sop=" ";
          if (mtempnum > 0) {
             //determine product or service if priced
             var mcompare=trim(document.getElementById('binv_catmain').value);
             for (var zi = 0; zi < document.forms['invoiceform'].binv_category.options.length; zi++) 
  	         {
	  	      
	          if (trim(document.forms['invoiceform'].binv_category.options[zi].text)==trim(mcompare))
	          {
	             tempvalue=document.forms['invoiceform'].binv_category.options[zi].value;
	             valueArray=tempvalue.split("|");
	             sop=valueArray[1];
	          }
	         }
	      
          } //end of amount > 0 check
      
          mselectvalue=mselectvalue+"|"+sop;
          //alert(mselectvalue); 
	      if (i==-1){ 
      	    i=document.forms['invoiceform'].binv_lnitems.options.length;  
            document.forms['invoiceform'].binv_lnitems[i] = new Option(mlineItem,mselectvalue,true,false); 
          } else { 
            document.forms['invoiceform'].binv_lnitems[i] = new Option(mlineItem,mselectvalue,true,false); 
	      }	   
	              	  
	      calctotals();
	      binvclear();
      
	      //alert(mselectvalue);
	      if (trim(sop)=="") {
	        if (mtempnum > 0) {   
	          showprodbox();
	        }  
  	      }

  	   //} // end of neg min invoice check   	  
      
  	} //end of error check	line #890
  
  	// throw err message from build  
  	if (trim(checkforErrors) !=""){
  	   hidewait();
  	   document.body.style.cursor='auto';
  	   document.getElementById('binvmsgtext').innerHTML=checkforErrors+"<br><br>Please correct and try again.";
  	   showbinvmsg();
  	}
  
  	if (document.forms['invoiceform'].binv_lnitems.options.length==0){document.getElementById('cutbuttonl').style.visibility =  "hidden"}; 

  	hidewait();
  	document.body.style.cursor='auto';

  } //end of http return wait

}	


// next six funtions retrieve the invoice selects // terms and shipping are being loaded with the cc_selects
function getbinvdept() {
  var usession = getmsession();
  var updateurl = "includes/php/binv_deptselect_process.php?usession="; // The server-side script
 document.body.style.cursor = "wait";	
  showwait()
  
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = getbinvdeptResponse;
  http.send(null);
}

function getbinvdeptResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['invoiceform'].binv_dept.options.length = 0;
    document.forms['invoiceform'].binv_dept[0] = new Option(" "," ",true,false);
    for (x in results)
    {
        r1 = results[x].split("|");
        if (trim(r1[0]) !=""){
           if (typeof r1[0] != "undefined"){
	         i=document.forms['invoiceform'].binv_dept.options.length;  
             document.forms['invoiceform'].binv_dept[i] = new Option(r1[0],r1[0],true,false);
           }  
        }
    }
  
    hidewait();  
    document.body.style.cursor='auto';  
    getbinvunit();
    
  } //end of ready state test
}//end of function

function getbinvcat() {

  var userurl = "includes/php/binv_catselect_process.php?mid="; // The server-side script
  var mrecord = "";
  document.body.style.cursor = "wait";
  showwait();  
  var inum = document.forms['invoiceform'].binv_dept.selectedIndex;
  var midValue = document.forms['invoiceform'].binv_dept.options[inum].value;
  var usession = getmsession();
  http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getbinvcatResponse;
  http.send(null);
}

function getbinvcatResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['invoiceform'].binv_category.options.length = 0;
    document.forms['invoiceform'].binv_category[0] = new Option(" "," ",true,false);
    for (x in results)
    {
        r1 = results[x].split("|");
        if (trim(r1[0]) !=""){
           if (typeof r1[0] != "undefined"){
	         i=document.forms['invoiceform'].binv_category.options.length;  
             document.forms['invoiceform'].binv_category[i] = new Option(r1[0],r1[1]+"|"+r1[2],true,false);
           }  
        }
    }
  //set category size without triggering hide/show
  setCat("Y");
  
  document.getElementById('binv_catmain').value="";  
  getbinvunit();
  } //end of ready state test
}//end of function



function getbinvunit() {
  var usession = getmsession();
  var updateurl = "includes/php/binv_unitselect_process.php?usession="; // The server-side script
  document.body.style.cursor = "wait";	
  showwait()
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = getbinvunitResponse;
  http.send(null);
}

function getbinvunitResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['invoiceform'].binv_unit.options.length = 0;
    //document.forms['invoiceform'].binv_unit[0] = new Option(" "," ",true,false);
    for (x in results)
    {
        r1 = results[x].split("|");
        if (trim(r1[0]) !=""){
           if (typeof r1[0] != "undefined"){
	         i=document.forms['invoiceform'].binv_unit.options.length;  
             document.forms['invoiceform'].binv_unit[i] = new Option(r1[0],r1[0],true,false);
           }  
        }
    }
  hidewait();
  document.body.style.cursor='auto';
  //showbinvtaxrate();
  } //end of ready state test
}//end of function



function setUnit() {
document.getElementById('binv_lnitems').style.visibility ='visible';	
//document.getElementById('binv_category').style.visibility ='hidden';	
var inum = document.forms['invoiceform'].binv_category.selectedIndex;
var catvalue = document.forms['invoiceform'].binv_category.options[inum].value;	
catValue=catvalue.split("|");
	
var catsel=document.forms['invoiceform'].binv_category.selectedIndex;
	  
    document.getElementById('binv_catmain').value=trim(document.forms['invoiceform'].binv_category.options[catsel].text);
    var numunits=document.forms['invoiceform'].binv_unit.options.length;
    document.forms['invoiceform'].binv_unit.selectedIndex = -1; 
    x=0;
       
    while (x < numunits) {
	    
      if (trim(document.forms['invoiceform'].binv_unit.options[x].value) == trim(catValue[0])){    
         document.forms['invoiceform'].binv_unit.selectedIndex = x;
      }
       
      x=(x+1);
       
    }

    document.forms['invoiceform'].binv_category.selectedIndex=-1;

}//end of function

function binvdeldet(){
	
var inum = document.forms['invoiceform'].binv_lnitems.selectedIndex;	

  if (inum > -1){
	  
     document.forms['invoiceform'].binv_lnitems.options[inum] = null;
     togglePrintSave('S');
     inum=(inum-1);
     if (inum==-1 && document.forms['invoiceform'].binv_lnitems.options.length > 0){
       inum=0;
     }
     
     document.forms['invoiceform'].binv_lnitems.selectedIndex=inum;
          
     if (inum !=-1){
       setedit();
     }  
     // don't call clear because we want to just remove the last one
     // binvclear();

  } else {
  
   document.getElementById('binvmsgtext').innerHTML="<br><br>Please select a line item to delete.";
   showbinvmsg();

 }	

  if (document.forms['invoiceform'].binv_lnitems.options.length > 0){
	 document.getElementById('cutbuttonl').style.visibility =  "visible";
  } else {
	 document.getElementById('cutbuttonl').style.visibility =  "hidden";
  }	 	  

calctotals();
getpagenum();
}


// acctounting check for invoice
function acctngcheckforInvoice() {
	
  var updateurl = "includes/php/get_invoice_fox.php?mform="; // The server-side script
         	
 
  if (document.getElementById('tkselectAcctng').selectedIndex > -1){
    s = new Array();
     
    minfo=new Array();
    var msel=document.forms['acctngform'].tkselectAcctng.selectedIndex;
    var minfo=document.forms['acctngform'].tkselectAcctng.options[msel].value.split("|");
    s[0]=minfo[2];
    
    //s[0] = document.getElementById('tkselectAcctng').value;	
    //alert(s[0]);
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = acctngcheckforInvoiceResponse;    
    http.send(null);

  } else {

    document.getElementById('acctngmsgtext').innerHTML='Please try again.';
    showAcctngmsg();   

  }


}



function acctngcheckforInvoiceResponse() {

  if (http.readyState == 4) {

   hidewait();
   document.body.style.cursor='auto';

   var mtest=http.responseText;
   //alert(mtest);
   var mulog=document.getElementById('loglevel').value;
   
   var afind = mtest.indexOf("thisjobhasinvoice");
   
   if (afind ==-1){
   
	 document.getElementById('invbuttxt2').innerHTML='Build Inv';

     if (mulog > 8){
       document.getElementById('invdelbtn').style.visibility =  "hidden";
     }      
       
   } else {
       document.getElementById('invbuttxt2').innerHTML='Edit Inv';
        if (mulog > 8){
          document.getElementById('invdelbtn').style.visibility =  "visible";
        }
    } // end of error test
    
    
    minfo = new Array();
    
    var msel=document.forms['acctngform'].tkselectAcctng.selectedIndex;
    var minfo=document.forms['acctngform'].tkselectAcctng.options[msel].value.split("|");
    //alert(minfo);
    
    if (msel > -1){
	  document.getElementById('invbutton').style.visibility =  "visible";  
      minfo[0]=minfo[0].replace(/\zpos/g,"\'");	    
	  if (minfo[0].substring(0,6) !="Object") {
		  document.getElementById('a_company').innerHTML=trim(minfo[0]+'&nbsp;&nbsp;&nbsp;&nbsp;Customer ID :&nbsp;&nbsp;'+trim(minfo[1]))
		  document.getElementById('acctng_mid').value=trim(minfo[1]);
	  } else {
		 document.getElementById('a_company').innerHTML=''};
   }
    
    
  } //end of ready state

}


function showbinvtaxrate() {
  //alert(document.getElementById('binv_taxflag').value);
  if (trim(document.getElementById('binv_taxflag').value)=="Y") {
	//alert("tested Y");  
    document.getElementById('binv_taxratelayer').style.visibility =  "visible";
  } else {  
	//alert("tested N");  
	
    document.getElementById('binv_taxratelayer').style.visibility =  "hidden";
  }
   
}




function calctotals(){
  //calculate  the subtotal , tax and total
  var mtaxable=document.getElementById('binv_taxflag').value;
  //built on 874's
  var xz=0;
  var msub=0;
  var mtax=0;
  var mtotal=0;
  var taxRate=0;
  var tempVar="";
  var taxitall="NO";
  
  //these are the tax fields
  //document.getElementById('binv_taxLocal').value=;
  //document.getElementById('binv_taxState').value=;
  //document.getElementById('binv_taxTotal').value=;
  //document.getElementById('binv_taxCode').value=;
  
  // check for tax - we will loop again later 
  if (trim(mtaxable)=="Y"){
	
  	while (xz < document.forms['invoiceform'].binv_lnitems.options.length){
        
	  	tempVar=document.forms['invoiceform'].binv_lnitems[xz].value;
	  	s = new Array(); 
	  	s=tempVar.split("|");
	  
	  	var tempst=document.getElementById('binv_acctst').value;
	  	tempst=tempst.toUpperCase();
	  	
	    if (s[6]=="P" || tempst=="TX"){
		   var taxitall="YES";
		   var taxRate=document.getElementById('binv_taxTotal').value;
		   
		   taxDisplay=taxRate;
		   taxDisplay=(taxDisplay*100);
		   taxDisplay=taxDisplay+'';
           document.getElementById('taxratedisplay').innerHTML="Tax Rate: "+taxDisplay+" %";
		}    	  
      
   	    tempVar="";
	       
       xz =(xz+1);
  	}
  	
  }  // end of checking for tax
  
  
  
  
  xz=0;

  // now actaully change everything to 'P' if anything is taxable
	  
   	 while (xz < document.forms['invoiceform'].binv_lnitems.options.length){
    
	  	tempVar=document.forms['invoiceform'].binv_lnitems[xz].value;
	  	s = new Array(); 
	  	s=tempVar.split("|");
	  	if (taxitall=="YES"){
		  var taxcheck=trim(document.forms['invoiceform'].binv_lnitems[xz].text);
		  if (taxcheck.substr(87,1) !="Y" && trim(taxcheck.substr(79,7)) !=''){
		    document.forms['invoiceform'].binv_lnitems[xz].text=document.forms['invoiceform'].binv_lnitems[xz].text+" Y";
	      }  
    	  s[6]="P"
        }
	    document.forms['invoiceform'].binv_lnitems[xz].value=trim(s[0])+"|"+trim(s[1])+"|"+trim(s[2])+"|"+trim(s[3])+"|"+trim(s[4])+"|"+trim(s[5])+"|"+trim(s[6]);
        tempVar="";
	    msub=(msub+parseFloat(s[0]));  
       xz =(xz+1);
  	}   
  
  //do tax
  if (taxitall=="YES"){
	mtax=(msub*taxRate);		   
  }
  
  mtax=(msub*taxRate);
  mtotal=(msub+mtax);
  
  msub=msub.toFixed(2);
  msubStr=msub+" ";
  msubStr= padLeft(msubStr,' ',10);
  document.getElementById('binv_subtotal').value=msubStr;

  mtax=mtax.toFixed(2);
  mtaxStr=mtax+" ";
  mtaxStr= padLeft(mtaxStr,' ',10);
  document.getElementById('binv_tax').value=mtaxStr;
 
  
  mtotal=mtotal.toFixed(2);
  mtotalStr=mtotal+" ";
  mtotalStr= padLeft(mtotalStr,' ',10);
  document.getElementById('binv_total').value=mtotalStr;
  
  getpagenum();
    
}

function Comma(number) {
number = '' + number;

if (number.length > 3) {
var mod = number.length % 3;
var output = (mod > 0 ? (number.substring(0,mod)) : '');
for (i=0 ; i < Math.floor(number.length / 3); i++) {
if ((mod == 0) && (i == 0))
output += number.substring(mod+ 3 * i, mod + 3 * i + 3);
else
output+= ',' + number.substring(mod + 3 * i, mod + 3 * i + 3);
}
return (output);
}
else return number;
}


function clearInvFields(){
	
  document.getElementById('binv_job_id').value="";    
  document.getElementById('binv_invdate').value="";
  document.getElementById('binv_date_done').value="";
  document.getElementById('binv_po').value="";
  document.getElementById('binv_cust_id').value="";
  document.getElementById('binv_acctcont').value="";
  document.getElementById('binv_acctcomp').value="";
  document.getElementById('binv_acctadd1').value="";
  document.getElementById('binv_acctcity').value="";
  document.getElementById('binv_acctst').value="";
  document.getElementById('binv_acctzip').value="";	
              
  document.forms['invoiceform'].binv_mship.selectedIndex=-1;
  document.forms['invoiceform'].binv_mterms.selectedIndex=-1;
  document.getElementById('binv_taxflag').value="";
  document.getElementById('binv_shipcont').value="";
  document.getElementById('binv_shipcomp').value="";
  document.getElementById('binv_shipadd1').value="";
  document.getElementById('binv_shipcity').value="";
  document.getElementById('binv_shipst').value="";
  document.getElementById('binv_shipzip').value="";
  document.forms['invoiceform'].binv_lnitems.options.length = 0;
  document.getElementById('binv_subtotal').value="";
  document.getElementById('binv_tax').value="";
  document.getElementById('binv_total').value="";
  document.getElementById('binv_invdue').value="";
  document.getElementById('binv_num_pages').value="";
  
  document.getElementById('binv_taxflag').value="N";
  
   document.getElementById('EDITINVBANNER').innerHTML="<b>Invoice</b>";
                         	
}	



function togglePrintSave(mtype) {
	 
    
	if (mtype=="P"){
	  document.getElementById('binvsavebtn').style.visibility =  "hidden";
      document.getElementById('binvprnbtn').style.visibility =  "visible";
    } else {
	  document.getElementById('binvsavebtn').style.visibility =  "visible";
      document.getElementById('binvprnbtn').style.visibility =  "hidden";
    }

}

function getpagenum(){
  //determine page numbers
  if (document.forms['invoiceform'].binv_lnitems.length > 15){
      var mnumpg=(document.forms['invoiceform'].binv_lnitems.length/15);
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
      
      if (mnumpg > 1){
	    document.getElementById('gotopglbl').style.visibility =  "visible";
        document.getElementById('gotopgbtn').style.visibility =  "visible";
      } else {
	    document.getElementById('gotopglbl').style.visibility =  "hidden";
        document.getElementById('gotopgbtn').style.visibility =  "hidden";
      }
      
      document.getElementById('binv_num_pages').value=mnumpg;
      
  } else {
	  document.getElementById('binv_num_pages').value="1";
  }	  
      
}

function gotopage(){

	var numpages=document.getElementById('binv_num_pages').value;
	var numpages=parseInt(numpages);
	
	var mpage=document.getElementById('binv_gopg').value;
	mpage=parseInt(mpage);
	
	//find page
	mpagego=mpage;
	mpagego=(mpagego*15)-14;
	if (mpage <= numpages){
 	    if (mpagego < 16) {
	      document.getElementById('binv_lnitems').selectedIndex=0;
        } else {	  	  	
   	      document.getElementById('binv_lnitems').selectedIndex=(mpagego-1);
	    }  
	    document.getElementById('binv_lnitems').focus()
    } else {
	  document.getElementById('binvmsgtext').innerHTML="<br><br>There are only "+numpages+" pages to this invoice.";
      showbinvmsg();    
    }    

}


function setedit(){

	var abc=document.getElementById('binv_lnitems').selectedIndex;
	if (abc > -1){
	    var editstr=document.getElementById('binv_lnitems').options[abc].value;
	    //alert(editstr);
	    medit= new Array();
	
	    medit = editstr.split("|");
	    document.getElementById('binv_catmain').value=medit[1];
	    document.getElementById('binv_cpu').value=medit[3];
	    document.getElementById('binv_qty').value=medit[4];
	    
	    for (var i = 0; i < document.forms['invoiceform'].binv_unit.options.length; i++) 
		 {
		    if (trim(document.forms['invoiceform'].binv_unit.options[i].text)==trim(medit[2]))
		    {
		       document.forms['invoiceform'].binv_unit.options[i].selected = true;
		    }
		 }
		
		if (medit[2].substring(0,1) == " ") {document.forms['invoiceform'].binv_unit.options[0].selected = true};
	
		 for (var i = 0; i < document.forms['invoiceform'].binv_dept.options.length; i++) 
		 {
		    if (trim(document.forms['invoiceform'].binv_dept.options[i].text)==trim(medit[5]))
		    {
		       document.forms['invoiceform'].binv_dept.options[i].selected = true;
		    }
		 }
		
		if (medit[5].substring(0,1) == " ") {document.forms['invoiceform'].binv_dept.options[0].selected = true};
		
	    getbinvcatED();
   }//end of test for selected
}

//this fills the cat select but does not reset anything
function getbinvcatED() {
  
  var userurl = "includes/php/binv_catselect_process.php?mid="; // The server-side script
  var mrecord = "";
  document.body.style.cursor = "wait";
  showwait();  
  var inum = document.forms['invoiceform'].binv_dept.selectedIndex;
  var midValue = document.forms['invoiceform'].binv_dept.options[inum].value;
  var usession = getmsession();
  http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getbinvcatEDResponse;
  http.send(null);
}

function getbinvcatEDResponse() {
  
	if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['invoiceform'].binv_category.options.length = 0;
    document.forms['invoiceform'].binv_category[0] = new Option(" "," ",true,false);
    for (x in results)
    {
        r1 = results[x].split("|");
        if (trim(r1[0]) !=""){
           if (typeof r1[0] != "undefined"){
	         i=document.forms['invoiceform'].binv_category.options.length;  
             document.forms['invoiceform'].binv_category[i] = new Option(r1[0],r1[1]+"|"+r1[2],true,false);
           }  
        }
    }
    hidewait();
    document.body.style.cursor='auto';
  } //end of ready state test
}//end of function

function setproduct(){
	
	//add the line items
    var i=document.forms['invoiceform'].binv_lnitems.selectedIndex; 
	
     if (i==-1){ 
       var detlen=document.forms['invoiceform'].binv_lnitems.options.length;
       detlen=(detlen-1);  
     } else {
	   var detlen=i;   
     }	   
    
	var selectvalue=trim(document.forms['invoiceform'].binv_lnitems.options[detlen].value);
	   
    if (document.sopform.binv_sopR[0].checked){
            selectvalue=selectvalue+"P";
            //alert("product");
    } else {
            selectvalue=selectvalue+"S";
            //alert("service");
    }

    
    document.forms['invoiceform'].binv_lnitems.options[detlen].value=selectvalue;
    calctotals();
	//alert(document.forms['invoiceform'].binv_lnitems.options[detlen].value);
	
	hideprodbox();

}


	// acctounting check for invoice
function saveInvoice() {

	
//find shipping cost	
var commship=0;

var xvz=0;
   while (xvz < document.forms['invoiceform'].binv_lnitems.options.length){
        
	  	var tempVar=document.forms['invoiceform'].binv_lnitems[xvz].value;
	  	
	  	s = new Array(); 
	  	s=tempVar.split("|");
	  	
	    var tempVar2=document.forms['invoiceform'].binv_lnitems[xvz].text;
	  	var afind1 = tempVar.indexOf("SHIPPING CHARGE");
	  	var afind2 = tempVar.indexOf("E-MAIL DATA");
	  	var afind3 = tempVar.indexOf("FTP DATA");
	  	var afind4 = tempVar.indexOf("BBS DATA");
	  	var afind5 = tempVar.indexOf("EDT DATA");
	  	var afind=(afind1+afind2+afind3+afind4+afind5);
        if (afind >-1){
	       commship=commship+parseFloat(s[3]);
        }			 

      
   	    tempVar="";
	       
       xvz =(xvz+1);
  	}	
commship=commship.toFixed(2);
//alert(commship);
//return null

	
	
//end of find shipping cost	
var errmsg="";

var xyz=document.getElementById('binv_mship').selectedIndex;
var tempVar=document.forms['invoiceform'].binv_mship[xyz].text;
tempVar=tempVar.toUpperCase();
var afind = tempVar.indexOf("NO SHIPPING");

	if (afind !=-1){
		
        errmsg="<br><br>You must choose a shipping method.";
        
    }
    
xyz=document.getElementById('binv_mterms').selectedIndex;
tempVar=document.forms['invoiceform'].binv_mterms[xyz].text;
tempVar=tempVar.toUpperCase();
var afind = tempVar.indexOf("NO TERMS");
   
    
    if (afind !=-1){
		
        errmsg=errmsg+"<br><br>You must choose payment terms.";
        
    }		

    if (trim(document.getElementById('binv_date_done').value)==""){
		
        errmsg=errmsg+"<br><br>You must enter a shipping date.";
        
    }	
    
    if (trim(document.getElementById('binv_invdate').value)==""){
		
        errmsg=errmsg+"<br><br>You must enter an invoice date.";
        
    }	
    
    if (trim(document.getElementById('binv_invdue').value)==""){
		
        errmsg=errmsg+"<br><br>You must enter in an invoice due date.";
        
    }	
    
    
    //do the index of
    var tempDT=trim(document.getElementById('binv_invdate').value);
    var aPosition = tempDT.indexOf("/");
    
    
    var secondPos = tempDT.indexOf("/", aPosition + 1);
    if (aPosition==-1 || secondPos==-1 || tempDT.length < 8){
	    
	  errmsg=errmsg+"<br><br>The invoice date is in the wrong format, use xx/xx/xxxx or xx/xx/xx.";  
	    
    }    
    
    var tempDT=trim(document.getElementById('binv_date_done').value);
    var aPosition = tempDT.indexOf("/");
    var secondPos = tempDT.indexOf("/", aPosition + 1);
    if (aPosition==-1 || secondPos==-1 || tempDT.length < 8){
	    
	  errmsg=errmsg+"<br><br>The shipping date is in the wrong format, use xx/xx/xxxx or xx/xx/xx.";  
	    
    }    
    
    var tempDT=trim(document.getElementById('binv_invdue').value);
    var aPosition = tempDT.indexOf("/");
    var secondPos = tempDT.indexOf("/", aPosition + 1);
    if (aPosition==-1 || secondPos==-1 || tempDT.length < 8){
	    
	  errmsg=errmsg+"<br><br>The Invoice due date is in the wrong format, use xx/xx/xxxx or xx/xx/xx.";  
	    
    }    
    
    if (trim(document.getElementById('binv_shipzip4').value)==""){
		
       errmsg=errmsg+"<br><br>Missing zip extention for shipping, click the arrow to retrieve it.";
        
    }	
    
    
    
    if (trim(errmsg) != ''){
	    hidewait();
        document.body.style.cursor='auto';
        document.getElementById('binvmsgtext').innerHTML=errmsg;
        showbinvmsg();
        return null;  
	    
	    
    }   
	
 if(document.forms['invoiceform'].binv_lnitems.length > 0){

    var updateurl = "includes/php/save_invoice_fox.php?mform="; // The server-side script
        
    //main ticket array 	
    s = new Array();
    
    //line item array
    sI= new Array();
    //line item prices
    sP= new Array();
    
    s[0] = document.getElementById('binv_job_id').value;    
    s[1] = document.getElementById('binv_invdate').value;
    s[2] = document.getElementById('binv_date_done').value;
    s[3] = document.getElementById('binv_po').value;
    s[4] = document.getElementById('binv_cust_id').value;
    s[5] = document.getElementById('binv_acctcont').value;
    s[6] = document.getElementById('binv_acctcomp').value;
    s[7] = document.getElementById('binv_acctadd1').value;
    s[8] = document.getElementById('binv_acctcity').value;
    s[9] = document.getElementById('binv_acctst').value;
    s[10] = document.getElementById('binv_acctzip').value;	
    s[11] = document.forms['invoiceform'].binv_mship.value;
    s[12] = document.forms['invoiceform'].binv_mterms.value;
    s[13] = document.getElementById('binv_taxflag').value;
    s[14] = document.getElementById('binv_shipcont').value;
    s[15] = document.getElementById('binv_shipcomp').value;
    s[16] = document.getElementById('binv_shipadd1').value;
    s[17] = document.getElementById('binv_shipcity').value;
    s[18] = document.getElementById('binv_shipst').value;
    s[19] = document.getElementById('binv_shipzip').value;
    s[20] = document.getElementById('binv_subtotal').value;
    s[21] = document.getElementById('binv_tax').value;
    s[22] = document.getElementById('binv_total').value;
    s[23] = document.getElementById('binv_invdue').value;
    
    var mweeknum=getInvwknumber();
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
    //var currentTime = new Date();
    //var month = currentTime.getMonth() + 1;
    //var day = currentTime.getDate();
    //var year = currentTime.getFullYear();	
    
    
    var tempinvdt=trim(document.getElementById('binv_invdate').value);
    var aPosition = tempinvdt.indexOf("/");
    var secondPos = tempinvdt.indexOf("/", aPosition + 1);
    iMonth=tempinvdt.substring(0,aPosition); 
    iYear=tempinvdt.substring(secondPos+1);	
    //alert("The month/year: "+tempinvdt+"  The Month: "+iMonth+"  The year:  "+iYear);
      
    s[25] = iMonth+" "+iYear;
    if (s[25].substring(0,1)=="0"){ s[25] =s[25].substring(1) };
    
    s[26]= iMonth;
    s[27]=commship;
    s[28]=document.getElementById('binv_shipzip4').value;
    
    //calc the tax breakout
    var mtax=document.getElementById('binv_tax').value;
    var msub=document.getElementById('binv_subtotal').value;
    var mlocrate=0.0000;
    var mstaterate=0.0000;
    var mlocaltax=0.00;
    var mstatetax=0.00;
    
    if (mtax > 0){
      mlocrate=eval(document.getElementById('binv_taxLocal').value);
	  mstaterate=eval(document.getElementById('binv_taxState').value);     
	  mtaxrate=eval(document.getElementById('binv_taxTotal').value);
	  //mlocaltax=(msub*mlocrate);
	  //mstatetax=(msub*mstaterate);
    }    

    
    mlocrate=mlocrate.toFixed(4);
    mstaterate=mstaterate.toFixed(4);
    
    //alert(mlocrate+"  : "+mstaterate);
    //return null;
    s[29]=mlocrate;
    s[30]=mstaterate;
    s[31]=document.getElementById('binv_taxCode').value;
   
    //alert( "Local Tax: "+s[29] + " :  "+s[30]+"  :  "+s[31]);
    //return null;
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = saveInvoiceResponse;    
    http.send(null);

  } else {
	    
	hidewait();
    document.body.style.cursor='auto';
    
    document.getElementById('binvmsgtext').innerHTML="<br><br><br>You must add invoice detail charges.";
    showbinvmsg();
        
  }	    
    
    
    
}


function saveInvoiceResponse() {
 if (http.readyState == 4) {
    var returnText=http.responseText;
    //alert(returnText);
          
    if (returnText =="Invoice has been saved"){
	   document.getElementById('tk_hasinvoice').value ="Y";
	   
	    //hoopla for fox and sql dates- should change all of this crap with single function convert- need to build first
	    var tempinvdt=trim(document.getElementById('binv_invdate').value);
        var aPosition = tempinvdt.indexOf("/");
        var secondPos = tempinvdt.indexOf("/", aPosition + 1);
        iMonth=tempinvdt.substring(0,aPosition); 
        iYear=tempinvdt.substring(secondPos+1);	
        var iDay=tempinvdt.substring((aPosition+1),(aPosition+3));
        if (trim(iDay.substring(1,2))=="/"){
	        iDay="0"+iDay.substring(0,1);
	    }        
	    //alert(iDay);
        if (iMonth.length==1){iMonth="0"+iMonth};
        var newdt= iMonth +"/"+iDay+"/"+iYear; 
          
	    document.getElementById('tk_stkINV_DATE').value =newdt;
	    
	   //tkselectAcctng
	   if (document.getElementById('tkselectAcctng').selectedIndex > -1){ 
		   var theoneselected=document.getElementById('tkselectAcctng').selectedIndex;
           var thetext=trim(document.forms['acctngform'].tkselectAcctng.options[theoneselected].text);
           var newlen=thetext.length;
           newlen=(newlen-1);
           thetext=thetext.substr(0,newlen);
           thetext=thetext+"Y";
           //alert(thetext);
           document.forms['acctngform'].tkselectAcctng.options[theoneselected].text=thetext;
           
       }	   
	   document.getElementById('invbuttxt').innerHTML='Edit Inv'; 
       document.getElementById('invbuttxt2').innerHTML='Edit Inv'; 
       saveInvDetail(0);
    } else {
	   hidewait();
       document.body.style.cursor='auto'; 
	   document.getElementById('binvmsgtext').innerHTML="<br><br>"+returnText;
       showbinvmsg(); 
    }     
       
       
  } //end of ready state test
 

}


// saving the deatil items one at a time-1024k limit precludes saving as an array (only about 8 or 9 would save
// this way they all save without fail and the vast majority will save in a just a few seconds. 
function saveInvDetail(dnum) {

  //alert("Detail loop:"+dnum);

  if(dnum < document.forms['invoiceform'].binv_lnitems.length){
    
    var updateurl = "includes/php/save_invdetail_fox.php?mform="; // The server-side script
        
    //main ticket array 	
    s = new Array();
     
    s[0] = document.getElementById('binv_job_id').value;    
    s[1] = dnum;
    	
    //save the text from lineitem select- do not save value, that was used to compile sub/tax & total.
    s[2]=trim(document.forms['invoiceform'].binv_lnitems.options[dnum].text); 
    s[3]=document.forms['invoiceform'].binv_lnitems.options[dnum].value; 
    
    s[2]=s[2].replace(/\'/g,"zpos");
    s[2]=s[2].replace(/\,/g,"zcomma");
    
    s[3]=s[3].replace(/\'/g,"zpos");
    s[3]=s[3].replace(/\,/g,"zcomma"); 
    
    
    s[4]=document.forms['invoiceform'].binv_lnitems.length;
       
    //document.body.style.cursor = "wait";
    //showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = saveInvDetailResponse;    
    http.send(null);

  } else {
	    
    document.getElementById('invbuttxt2').innerHTML='Edit Inv'; 
    acctngInvoice()

  }	    
    
    
    
}


function saveInvDetailResponse() {
 if (http.readyState == 4) {
    var detailVal=parseInt(http.responseText);
    //alert("Returned from PHP save: "+detailVal);
    detailVal=(detailVal+1);
    if(detailVal=="Error saving invoice, please try again."){
	    
	    hidewait();
        document.body.style.cursor='auto';
	    alert("Error saving detail, please report to administration immediately!");
	    //add error messasge
    } else { 
    
	    if(detailVal == document.forms['invoiceform'].binv_lnitems.length){
	       document.getElementById('invbuttxt2').innerHTML='Edit Inv';
	       //alert("Invoice has been saved.");
	       if (trim(document.getElementById('udept').value)=="D"){
		      //alert("In dallas"); 	       
              printcisInvoice();
           } else {
	          acctngInvoice(trim(document.getElementById('binv_JOB_ID').value));
	          //alert("not dallas");
           } 
           
           //updatejoblog(); //this is not working,using a java console program to do this off of fileserver2   	       
	    } else {
		   saveInvDetail(detailVal);
	    }     
    } //end of error test on detail save loop   
       
  } //end of ready state test
 

}


	// acctounting check for invoice
function deleteInvoice() {

  var updateurl = "includes/php/delete_invoice_fox.php?mform="; // The server-side script
  
  if (document.getElementById('tkselectAcctng').selectedIndex > -1){     
  
	//main ticket array 	
	s = new Array();
	s[0] = document.getElementById('tkselectAcctng').value;    
 
	document.body.style.cursor = "wait";
	showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = deleteInvoiceResponse;    
    http.send(null);

  } else {
	    
	hidewait();
    document.body.style.cursor='auto';
    document.getElementById('acctngmsgtext').innerHTML='There is no selected invoice to delete.';
	showAcctngmsg();
    
        
  }	    
    
    
    
}


function deleteInvoiceResponse() {
 if (http.readyState == 4) {
    var returnText=http.responseText;
    //alert(returnText);
      
    hidewait();
    document.body.style.cursor='auto';
    
    if (returnText =="Invoice sucessfully deleted."){
	   document.forms['acctngform'].tkselectAcctng.selectedIndex=-1; 
	   document.getElementById('acctngmsgtext').innerHTML='Invoice sucessfully deleted.';
	   showAcctngmsg(); 
	    
	    
    } else {
	   document.getElementById('acctngmsgtext').innerHTML='Error deleting selected invoice, please try again.';
	   showAcctngmsg(); 
	   
    }     
       
       
  } //end of ready state test
 

}

function findLnItem(){

  //alert("in search");
 
  if (document.forms['invoiceform'].binv_lnitems.selectedIndex==-1){
    var xz=0;
  } else {
	var xz=document.forms['invoiceform'].binv_lnitems.selectedIndex;
	xz =(xz+1);
  }	     		  
  var tempVar="";
  var searchStr=trim(document.getElementById('binv_search').value);
  
  searchStr=searchStr.toUpperCase();
  
  while (xz < document.forms['invoiceform'].binv_lnitems.options.length){
    
	  tempVar=document.forms['invoiceform'].binv_lnitems.options[xz].text;
	  var afind = tempVar.indexOf(searchStr);
	  if (afind > -1){
        //alert("Found string at :"+xz);
        document.getElementById('dsearchbtn').innerHTML='Continue';
        break;
      }	  
      
      tempVar="";
	       
     xz =(xz+1);
  }
  
   if (xz== document.forms['invoiceform'].binv_lnitems.options.length ){
    
     document.getElementById('dsearchbtn').innerHTML='Search'; 	 
     document.forms['invoiceform'].binv_lnitems.selectedIndex=-1;
     document.getElementById('binvmsgtext').innerHTML="<br><br><br>End of search reached.";
     showbinvmsg();
        
   } else {   
     document.forms['invoiceform'].binv_lnitems.selectedIndex=xz;
   }
   	 
}

function resetSearch(){
	
	document.forms['invoiceform'].binv_lnitems.selectedIndex=-1;
	//document.getElementById('binv_search').value='';
    document.getElementById('dsearchbtn').innerHTML='Search';
}	

function setCat(mvisible){
	
var mcnt=document.getElementById('binv_category').options.length;	
if (mvisible !="Z"){
if (mvisible=="Y"){	
  //if (document.getElementById('binv_category').style.visibility =='hidden' && mcnt > 1){	
     document.getElementById('lnitemsLayer').style.zIndex=5;
     document.getElementById('buildlayer').style.zIndex=10;
     document.getElementById('binv_category').style.visibility ='visible';
     document.getElementById('binv_category').selectedIndex=0;
     document.forms['invoiceform'].binv_category.focus();
  
     
     if (mcnt > 15){
       document.getElementById('binv_category').setAttribute('size',15);	
     } else {
	   document.getElementById('binv_category').setAttribute('size',mcnt);  
     }    
     
  //} else {
  //	 document.getElementById('binv_category').setAttribute('size',5); 
  //	 document.getElementById('binv_category').style.visibility ='hidden';
	 
  //}	     

} else {
	
	 document.getElementById('binv_category').setAttribute('size',5); 
	 document.getElementById('binv_category').style.visibility ='hidden';
	 
}	  
} //not eq z	

if (mvisible=="Z"){
	
   if (document.getElementById('binv_category').style.visibility =='hidden'){	
	 document.getElementById('binv_category').setAttribute('size',mcnt); 
	 document.getElementById('binv_category').style.visibility ='visible';  
     document.forms['invoiceform'].binv_category.focus();
   } else {  
	 document.getElementById('binv_category').setAttribute('size',1); 
	 document.getElementById('binv_category').style.visibility ='hidden';  
	   
   } 	     
     
	
}

if (document.getElementById('binv_category').style.visibility =='hidden'){
  document.getElementById('binv_category').setAttribute('size',0);	
} 	

if (mcnt==0){
  document.getElementById('binvmsgtext').innerHTML="<br><br><br>No categories listed, choose a department to load selections or enter in some text.";
  showbinvmsg();
}




}



function acctnchktk(mnum){
  var updateurl = "includes/php/get_chkinv_fox.php?mform="; // The server-side script
  s = new Array(); 
    
  s[0] = trim(mnum);
  document.body.style.cursor = "wait";
  showwait();

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = acctnchktkResponse;
  http.send(null);

}
	
function acctnchktkResponse() {
  if (http.readyState == 4) {
    
    var results = http.responseText.split("^");
    //alert(http.responseText);
    
    acctngInvSingle(results[0],results[1],results[2]);  
    
          
  } //end of ready state test
 

}

//use this to go directly to an invoice
function acctngInvSingle(jnumber,hasticket,hasinvoice) {
  
  //alert("in acctnginvsingle");
  
  // this check to see if the selected invoice needs to be built or edited	
  if (hasinvoice=='Y') {
     var updateurl = "includes/php/get_invoice_fox.php?mform="; // The server-side script
  } else {
     var updateurl = "includes/php/build_invoice_fox.php?mform="; // The server-side script  
  } 
  		
  s = new Array(); 	
   
  s[0] = jnumber; 
      	
  if (hasticket=='Y'){   	    
    

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = buildInvoiceResponse;  
    http.send(null);

  } else {
    hidewait();
    document.body.style.cursor='auto';
     
	alert('Job ticket not found, please check your number and try again.');  
    //document.getElementById('acctngmsgtext').innerHTML='Job ticket not found, please check your number and try again.';
    //showAcctngmsg();
    
  }	  
  
}
	

function handleCatKeyPress(e)
{
if (!e) e = window.event;
if (e && e.keyCode == 13)
{
  setCat('N');	
  setUnit();
  return false; //here to cancel the event
}
}



// this function prints dall invoices in the accoutning
function killacro() {
  var updateurl = "includes/php/kill_acrobat.php?mform="; // The server-side script
  
  s = new Array(); 
  if (trim(document.getElementById('stkJOB_ID').value) != ""){
    s[0] = document.getElementById('stkJOB_ID').value; 
  } else if (trim(document.getElementById('tk_stkJOB_ID').value) != "") {
	s[0] = document.getElementById('tk_stkJOB_ID').value;
  }	else {
	s[0] = document.getElementById('binv_JOB_ID').value;  
  }	  
   
    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = killacroResponse;
    http.send(null);
    

}

function killacroResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

   var thejobno= trim(document.getElementById('binv_JOB_ID').value);
   setTimeout("acctngInvoice("+thejobno+");",1000);
   //acctngInvoice(thejobno);
        
  } //end of ready state test
}//end of function

function getInvwknumber(){
	
   
    var tempDT=trim(document.getElementById('binv_invdate').value);
    var aPosition = tempDT.indexOf("/");
    var secondPos = tempDT.indexOf("/", aPosition + 1);

    iMonth=tempDT.substring(0,aPosition);
    iDay = tempDT.substring(aPosition+1,secondPos);
    iYear=tempDT.substring(secondPos+1);	
    //alert("The date: "+tempDT+"  The Month: "+iMonth+"  The day: "+iDay+"  The year:  "+iYear);
        
    iMonth= parseInt(iMonth);
    iMonth=(iMonth-1);
    iDay = parseInt(iDay);
    iYear= parseInt(iYear);
    
    var iDate = new Date();
    iDate.setFullYear(iYear,iMonth,iDay);
    
	Year = takeYear(iDate);
	Month = iDate.getMonth();
	Day = iDate.getDate();
	now = Date.UTC(Year,Month,Day+1,0,0,0);
	var Firstday = new Date();
	Firstday.setYear(Year);
	Firstday.setMonth(0);
	Firstday.setDate(1);
	then = Date.UTC(Year,0,1,0,0,0);
	var Compensation = Firstday.getDay();
	if (Compensation > 3) Compensation -= 4;
	else Compensation += 3;
	NumberOfWeek =  Math.round((((now-then)/86400000)+Compensation)/7);
	return NumberOfWeek
		
}	


function updatejoblog() {

    var updateurl = "includes/php/save_jobloginfo_fox.php?mform="; // The server-side script
        
    //main ticket array 	
    s = new Array();
    
    s[0] = trim(document.getElementById('binv_job_id').value);    
    s[1] = trim(document.getElementById('binv_invdate').value);
    
    document.body.style.cursor = "wait";
    showwait();

    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = updatejoblogResponse;    
    http.send(null);
    
}


function updatejoblogResponse() {
 if (http.readyState == 4) {
    var returnText=http.responseText;
    //alert(returnText);
      
    //hidewait();
    //document.body.style.cursor='auto';
    
    if (returnText.indexOf("date has been updated") > -1){
	  if (trim(document.getElementById('udept').value)=="D"){	       
         printcisInvoice();
      } else {
	     acctngInvoice(trim(document.getElementById('binv_JOB_ID').value)); 
      }  
    } else {
	   document.getElementById('binvmsgtext').innerHTML="<br><br>Error updating joblog invoice date, please contact Stephen."+returnText;
       showbinvmsg(); 
    }     
       
       
  } //end of ready state test
 

}

//this is the recalc button

function recalnoln(){
  
 //lets get the tax rate b4 building anything- do it on all tickets even though there is only tax on WA & Texas now
 //this will keep taxes data driven- just add zip and a zip4 range and state local & tot rate when disticts are added
  var updateurl = "includes/php/get_taxrates_fox.php?mform="; // The server-side script

  if (trim(document.getElementById('binv_taxflag').value) =="Y" && trim(document.getElementById('binv_shipzip4').value)==''){
    hidewait();
    document.body.style.cursor='auto';
    document.getElementById('binvmsgtext').innerHTML="<br><br>Please enter a zip plus 4 code.";
    showbinvmsg();
    return null;
  }
  
  s = new Array(); 
  s[0] = document.getElementById('binv_shipzip').value;
  s[1] = document.getElementById('binv_shipzip4').value;     
  s[2] = trim(document.getElementById('binv_taxflag').value);
            
  document.body.style.cursor = "wait";
  showwait();

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = recalnolnResponse;
  http.send(null);
  
} //end of calling binvoice 

function recalnolnResponse() {
 if (http.readyState == 4) {
	 
    //var returnText=http.responseText;
    //alert(returnText);
      
    hidewait();
    document.body.style.cursor='auto';
    
    var results=http.responseText.split('^');
	var checkforErrors="";
    
    hidewait();
    document.body.style.cursor='auto';
    
    var mlocaltax=eval(results[0]);
    var mstatetax=eval(results[1]);
    var mtotaltax=eval(results[2]);
    
    mlocaltax=mlocaltax.toFixed(4);
    mstatetax=mstatetax.toFixed(4);
    mtotaltax=mtotaltax.toFixed(4);
    
    //alert(' Local: ' + mlocaltax + ' State: ' + mstatetax + ' Total: ' + mtotaltax + ' Code : ' + results[3]);
    //return null;
    
    document.getElementById('binv_taxLocal').value=results[0];
    document.getElementById('binv_taxState').value=results[1];
    document.getElementById('binv_taxTotal').value=results[2];
    document.getElementById('binv_taxCode').value=results[3];
    
    
    //reset if texas
    var tempst=document.getElementById('binv_acctst').value;
	tempst=tempst.toUpperCase();
	  	
	if (tempst=="TX"){	
	  document.getElementById('binv_taxLocal').value=".0000";
      document.getElementById('binv_taxState').value=".0825";
      document.getElementById('binv_taxTotal').value=".0825";
      document.getElementById('binv_taxCode').value="9999"; 		  	
  	} 
  	
    
    calctotals();
    
    //if (returnText.indexOf("new tax pulled") > -1){
	
	    
	      
    //} else {
	//   document.getElementById('binvmsgtext').innerHTML="<br><br>Error getting tax infomation, please check your shipping address."+returnText;
    //   showbinvmsg(); 
    //}     
       
       
  } //end of ready state test
 

}
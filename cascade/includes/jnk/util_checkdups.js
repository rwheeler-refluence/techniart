//function for checking for duplicates in all databases  
function chkfordupsResponse() {

  if (http.readyState == 4) {
	  
	   reportArray = new Array();
       reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>Dup ID's</td></tr></table>";  
       reportArray[1] = "";
       reportArray[2] = "";
   
       results = http.responseText.split("^");
       //alert(results.length);
       //for (x in results)
       //{
       // alert(results[x]);
	   //    
       //}    
       r1= new Array();
       
       // this will build out the columns for the orders and record counts
       for (x in results)
       {

          r1 = results[x].split("|");

          if (x==0){
            reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
            reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='center'>Duplicate Customer ID's</td></tr></table>"; 
            reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
            reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
             if (results.length==1) {
               reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='left'>No Duplicate ID''s in SQL CIS/CDS tables.</td></tr></table>"; 
               reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
             }
          } else {  
	                            
            reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='50%' align='left'>"+r1[0]+"</td><td width='50%' align='left'>"+r1[1]+"</td></tr></table>"; 
            reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
          }
      
          
          
          
       }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:1px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=" ";
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"</div>";
    document.getElementById('current_pdf').value="none";
    document.getElementById('pdfid').value='none';
    showreport("iddups");
            
  }

}


function chkfordups() {

  var updateurl = "includes/php/util_checkfordups_process.php?usession="; // The server-side script
  
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = chkfordupsResponse;
  http.send(null);

}

//############### check fox tables

//function for checking for duplicate cust id's in password  
function chkfoxpwfordupsResponse() {

  if (http.readyState == 4) {
	  
	   reportArray = new Array();
       reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>Dup ID's</td></tr></table>";  
       reportArray[1] = "";
       reportArray[2] = "";
      
       results = http.responseText.split("^");
       //alert(http.responseText); 
       r1= new Array();
       
       // this will build out the columns for the orders and record counts
       for (x in results)
       {

          r1 = results[x].split("|");

          if (x==0){
            reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
            reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='center'>Duplicate ID's in FOX Password Database</td></tr></table>"; 
            reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
            reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
             if (results.length==1) {
               reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='left'>No Duplicate ID's in FOX password database.</td></tr></table>"; 
               reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
             }
          } else {  
	                            
            reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='50%' align='left'>"+r1[0]+"</td><td width='50%' align='left'>"+r1[1]+"</td></tr></table>"; 
            reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
          }
      
          
          
          
       }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:1px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=" ";
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"</div>";
    document.getElementById('current_pdf').value="none";
    document.getElementById('pdfid').value='none';
    showreport("pwdups");
            
  }

}


function chkfoxpwfordups() {

  var updateurl = "includes/php/util_chkfoxpwfordups_process.php?usession="; // The server-side script
  
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = chkfoxpwfordupsResponse;
  http.send(null);

}

//##### password for username & password

//function for checking for duplicate user names and passwords in password  
function chkfoxpwlogdupsResponse() {

  if (http.readyState == 4) {
	  
	   reportArray = new Array();
       reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>Dup ID's</td></tr></table>";  
       reportArray[1] = "";
       reportArray[2] = "";
      
       results = http.responseText.split("^");
       //alert(http.responseText); 
       r1= new Array();
       
       // this will build out the columns for the orders and record counts
       for (x in results)
       {

          r1 = results[x].split("|");

          if (x==0){
            reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
            reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='center'>Duplicate USERNAME/PASSWORD in FOX Password Database</td></tr></table>"; 
            reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
            reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
             if (results.length==1) {
               reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='left'>No USERNAME/PASSWORD in FOX password database.</td></tr></table>"; 
               reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
             }
          } else {  
	                            
            reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Courier'><td width='50%' align='left'>"+r1[0]+"</td><td width='50%' align='left'>"+r1[1]+"</td></tr></table>"; 
            reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
          }
      
          
          
          
       }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:1px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=" ";
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"</div>";
    document.getElementById('current_pdf').value="none";
    document.getElementById('pdfid').value='none';
    showreport("pwdups");
            
  }

}


function chkfoxpwlogdups() {

  var updateurl = "includes/php/util_chkfoxpwlogdups_process.php?usession="; // The server-side script
  
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = chkfoxpwlogdupsResponse;
  http.send(null);

}



//##### joblog

//function for checking for duplicate job ids  
function chkjoblogdupsResponse() {

  if (http.readyState == 4) {
	  
	   reportArray = new Array();
       reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>Dup Jobs</td></tr></table>";  
       reportArray[1] = "";
       reportArray[2] = "";
      
       results = http.responseText.split("^");
       //alert(http.responseText); 
       r1= new Array();
       
       // this will build out the columns for the orders and record counts
       for (x in results)
       {

          r1 = results[x].split("|");

          if (x==0){
            reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
            reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='center'>Duplicate Jobs Numbers</td></tr></table>"; 
            reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
            reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
             if (results.length==1) {
               reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='left'>No duplicate jobs numbers.</td></tr></table>"; 
               reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
             }
          } else {  
	                            
            reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='50%' align='left'>"+r1[0]+"</td><td width='50%' align='left'>"+r1[1]+"</td></tr></table>"; 
            reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
          }
      
          
          
          
       }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:1px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=" ";
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"</div>";
    document.getElementById('current_pdf').value="none";
    document.getElementById('pdfid').value='none';
    showreport("pwdups");
            
  }

}


function chkjoblogdups() {

  var updateurl = "includes/php/util_chkjoblogdups_process.php?usession="; // The server-side script
  
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = chkjoblogdupsResponse;
  http.send(null);

}


//#### invoices

//function for checking for dup invoices  
function chkinvdupsResponse() {

  if (http.readyState == 4) {
	  
	   reportArray = new Array();
       reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>Dup Jobs</td></tr></table>";  
       reportArray[1] = "";
       reportArray[2] = "";
      
       results = http.responseText.split("^");
       //alert(http.responseText); 
       r1= new Array();
       
       // this will build out the columns for the orders and record counts
       for (x in results)
       {

          r1 = results[x].split("|");

          if (x==0){
            reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
            reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='center'>Duplicate Invoice Numbers</td></tr></table>"; 
            reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
            reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
             if (results.length==1) {
               reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='left'>No duplicate invoice numbers.</td></tr></table>"; 
               reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
             }
          } else {  
	                            
            reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='50%' align='left'>"+r1[0]+"</td><td width='50%' align='left'>"+r1[1]+"</td></tr></table>"; 
            reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
          }
      
          
          
          
       }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:1px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=" ";
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"</div>";
    document.getElementById('current_pdf').value="none";
    document.getElementById('pdfid').value='none';
    showreport("pwdups");
            
  }

}


function chkinvdups() {

  var updateurl = "includes/php/util_chkinvdups_process.php?usession="; // The server-side script
  
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = chkinvdupsResponse;
  http.send(null);

}

//#### Counts

//function for checking for dup state counts  
function chkctsdupsResponse() {

  if (http.readyState == 4) {
	  
	   reportArray = new Array();
       reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>State Count Numbers</td></tr></table>";  
       reportArray[1] = "";
       reportArray[2] = "";
      
       results = http.responseText.split("^");
       //alert(http.responseText); 
       r1= new Array();
       
       // this will build out the columns for the orders and record counts
       for (x in results)
       {

          r1 = results[x].split("|");

          if (x==0){
            reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
            reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='center'>Duplicate State Count Numbers</td></tr></table>"; 
            reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
            reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
             if (results.length==1) {
               reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='left'>No duplicate state count numbers.</td></tr></table>"; 
               reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
             }
          } else {  
	                            
            reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='50%' align='left'>"+r1[0]+"</td><td width='50%' align='left'>"+r1[1]+"</td></tr></table>"; 
            reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
          }
      
          
          
          
       }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:1px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=" ";
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"</div>";
    document.getElementById('current_pdf').value="none";
    document.getElementById('pdfid').value='none';
    showreport("pwdups");
            
  }

}


function chkctsdups() {

  var updateurl = "includes/php/util_chkctsdups_process.php?usession="; // The server-side script
  
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = chkctsdupsResponse;
  http.send(null);

}


//#### Business List

//function for checking for dup BL info  
function chkbldupsResponse() {

  if (http.readyState == 4) {
	  
	   reportArray = new Array();
       reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>Business Lists Duplicates</td></tr></table>";  
       reportArray[1] = "";
       reportArray[2] = "";
      
       results = http.responseText.split("^");
       //alert(http.responseText); 
       r1= new Array();
       
       // this will build out the columns for the orders and record counts
       for (x in results)
       {

          r1 = results[x].split("|");

          if (x==0){
            reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
            reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='center'>Duplicate Business Lists ID's</td></tr></table>"; 
            reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
            reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
             if (results.length==1) {
               reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='left'>No duplicate business lists ID's.</td></tr></table>"; 
               reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
             }
          } else {  
	                            
            reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='50%' align='left'>"+r1[0]+"</td><td width='50%' align='left'>"+r1[1]+"</td></tr></table>"; 
            reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
          }
      
          
          
          
       }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:1px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=" ";
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"</div>";
    document.getElementById('current_pdf').value="none";
    document.getElementById('pdfid').value='none';
    showreport("pwdups");
            
  }

}


function chkbldups() {

  var updateurl = "includes/php/util_chkbldups_process.php?usession="; // The server-side script
  
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = chkbldupsResponse;
  http.send(null);

}


//chkfoxcustdups()

//#### fox customer tables

//function for checking for dup BL info  
function chkfoxcustdupsResponse() {

  if (http.readyState == 4) {
	  
	   reportArray = new Array();
       reportArray[0] = "<table border='0' width='80%' align='center'><tr width='80%'><td style='text-align:center;font: 12px Arial' width='100%'><b>Fox Customer ID Duplicates</td></tr></table>";  
       reportArray[1] = "";
       reportArray[2] = "";
      
       results = http.responseText.split("^");
       //alert(http.responseText); 
       r1= new Array();
       
       // this will build out the columns for the orders and record counts
       for (x in results)
       {

          r1 = results[x].split("|");

          if (x==0){
            reportArray[1] = reportArray[1]+"<table class='singlelntable><tr class='singlelntable'><td class='singlelntable'></td><tr></table>";   
            reportArray[1] = reportArray[1]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='center'>Duplicate FOX Customer ID's</td></tr></table>"; 
            reportArray[1] = reportArray[1]+"<table class='singlelntable'><tr class='singlelntable' style='font: 11px Arial'><td class='singlelntable'></td><tr></table>";
            reportArray[1] = reportArray[1]+"<table class='bannerline2' width='100%' border='0'><tr width='94%'><td width='96%' align='left'><b></b></td></tr></table>";
             if (results.length==1) {
               reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='100%' align='left'>No duplicate FOX customers ID's.</td></tr></table>"; 
               reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
             }
          } else {  
	                            
            reportArray[2] = reportArray[2]+"<table width='100%' border='0'><tr width='98%' style='font: 11px Arial'><td width='50%' align='left'>"+r1[0]+"</td><td width='50%' align='left'>"+r1[1]+"</td></tr></table>"; 
            reportArray[2] = reportArray[2]+"<table class='singlelntable'><tr class='singlelntable'><td class='singlelntable'></td><tr></table>"; 
          }
      
          
          
          
       }

    hidewait();
    
    var scrplacement="<div id='draftinvoice' style='top:1px;width:625;'>";
    document.body.style.cursor='auto';
    document.getElementById('rpttitle').innerHTML="";
    document.getElementById('rowheader').innerHTML=" ";
    document.getElementById('reportbody').innerHTML=scrplacement+reportArray[1]+"<br>"+reportArray[2]+"</div>";
    document.getElementById('current_pdf').value="none";
    document.getElementById('pdfid').value='none';
    showreport("pwdups");
            
  }

}


function chkfoxcustdups() {

  var updateurl = "includes/php/util_chkfoxcustdups_process.php?usession="; // The server-side script
  
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = chkfoxcustdupsResponse;
  http.send(null);

}






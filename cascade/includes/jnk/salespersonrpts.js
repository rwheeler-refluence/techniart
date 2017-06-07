function tksalesrptPDF(){
	//alert('in tksalesrptPDF');
	//the admin version of this for senior staff is in util_options.js
    //use the same as utility but filter on salesperson  
	var tkurl = "includes/php/utlsalesrptpdf_process.php?usession="; // The server-side script
    var numchk=IsNumeric(trim(document.getElementById('tksls_numrows').value));	

if (numchk==false && trim(document.getElementById('tksls_numrows').value) !=''){
    alert("You must put a number in the number of rows box or leave it blank, please correct and try again.   ");
	return null;	
}	
    
	   
	mf = new Array();
    
    if (document.getElementById('tkslstypeI').checked==true){
       mf[0]="I";
    } else if  (document.getElementById('tkslstypeN').checked==true){
	   mf[0]="N"; 
    } else if  (document.getElementById('tkslstypeST').checked==true){
	   mf[0]="ST"; 
    } else if  (document.getElementById('tkslstypeSLS').checked==true){
	   mf[0]="SLS"; 
    } else if  (document.getElementById('tkslstypeMR').checked==true){
	   mf[0]="MR"; 
    } else if  (document.getElementById('tkslstypeMR2').checked==true){
	   mf[0]="MR2"; 
    } else if  (document.getElementById('tkslstypeMRP').checked==true){
	   mf[0]="MRP"; 
    } else if  (document.getElementById('tkslstypeYTD').checked==true){
	   mf[0]="YTD"; 
    } else if  (document.getElementById('tkslstypeYTD2').checked==true){
	   mf[0]="YTD2"; 
    } else if  (document.getElementById('tkslstypeYTDP').checked==true){
	   mf[0]="YTDP"; 
    } else if  (document.getElementById('tkslstypeP1').checked==true){
	   mf[0]="P1"; 
    } else if  (document.getElementById('tkslstypeP2').checked==true){
	   mf[0]="P2"; 
    } else {
	   mf[0]="P3"; 
    }          
    
    if (document.getElementById('tkslsorderA').checked==true){
       mf[1]="A";    
    } else {
	   mf[1]="D"; 
    }
   
    mf[2]=document.getElementById('loglevel').value;
        
    //check for zero rev
    if (document.getElementById('tkslszerorevbox').checked == false) {
      mf[3]= "N";
    } else {mf[3]= "Y"};
 
    //default
    mf[4]= "N";
        
    mf[5]=trim(document.getElementById('tksls_numrows').value);
   
    
    if (document.getElementById('tkslsQ1').checked==true){
       mf[6]="1";
    } else if (document.getElementById('tkslsQ2').checked==true){
	   mf[6]="2"; 
    } else if  (document.getElementById('tkslsQ3').checked==true){
	   mf[6]="3"; 
    } else if  (document.getElementById('tkslsQ4').checked==true){
	   mf[6]="4"; 
    } else {
	  mf[6]='M';     
    }    
    
    
     if (document.getElementById('Mchoice').checked==true){
	    mf[6]="M";
	    
	   if (document.getElementById('tkslsthirtydaybox').checked == false) {
          mf[4]= "N";
       }  else {mf[4]= "Y"};
    
	    
    } else { 

        if (document.getElementById('tkslsQ1').checked==true){
          mf[6]="1";
        } else if  (document.getElementById('tkslsQ2').checked==true){
	      mf[6]="2"; 
        } else if  (document.getElementById('tkslsQ3').checked==true){
	      mf[6]="3"; 
        } else if  (document.getElementById('tkslsQ4').checked==true){
	      mf[6]="4"; 
        } else {
	      alert('Please choose a quarter.');
	      return null;    
	        
        }          
    } 
      
    
    var Qsel=document.forms['ticketform'].Qyear.selectedIndex;       
    var Qselval=document.forms['ticketform'].Qyear.options[Qsel].value;
   
    if (Qsel > 0){
       mf[7]=Qselval;   
    } else {
	   var d = new Date();
       var myear=d.getYear(); 
       mf[7]=myear;     
    }   
    
     //check for summary page only
    if (document.getElementById('tkslssumpgbox').checked == false) {
      mf[8]= "N";
    } else {mf[8]= "Y"};
 
     
    
    document.body.style.cursor = "wait";
    showwait();
     
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = tksalesrptPDFResponce;
    http.send(null);
 

}

function tksalesrptPDFResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    //alert(mmes);
    document.getElementById('slsXLS2').style.visibility = "visible";
    document.getElementById('slsPDF2').style.visibility = "visible";
   
    document.body.style.cursor='auto';
    
    document.getElementById('genericmsgscr').style.top='130px';
    document.getElementById('genericmsgscr').style.left='280px'; 
    document.getElementById('genericmsgscr').style.height='160px'; 
    document.getElementById('genericmsgscr').style.width='520px';
    document.getElementById('genericmsgtext').innerHTML="Choose the 'PDF' button to view/print or 'Excel' button to download an .xls Excel file."; 
    
    showgenericmsg(); 
    
  }
  
} 


function tkshowslsPDF(){
	document.getElementById('current_pdf').value="slsrpt";
	var tempnm=trim(document.getElementById('uname').value);
    document.getElementById('pdfid').value=tempnm;
   	rpdfopen('popup', 640, 480);	
}	
	

function tkshowslsXLS(){

var url="http://"+document.getElementById('servername').value+"/cc/"+document.getElementById('ucoid').value+"graphs/"+trim(document.getElementById('uname').value)+"_slsrpt.zip";
//alert(url);
win = window.open(url, "new", "toolbar=1,scrollbars=yes,status=yes,resizable=yes")

}

function toggleQ(){

    if (document.getElementById('Mchoice').checked==true){
       document.getElementById('MTHCUTOFF').style.visibility = "visible";
       document.getElementById('m1lbl').innerHTML='Current Month'; 
	   document.getElementById('m2lbl').innerHTML='Month Last Year';  
    } else {
	   document.getElementById('m1lbl').innerHTML='Current Quarter'; 
	   document.getElementById('m2lbl').innerHTML='Quarter Last Year';   
	   document.getElementById('MTHCUTOFF').style.visibility = "hidden"; 
    }    
	   
    if (document.getElementById('Qchoice').checked==true){
	   document.getElementById('QRADIOS').style.visibility = "visible";
	   document.getElementById('QYRSCR').style.visibility = "visible";       
    } else {
       document.getElementById('QYRSCR').style.visibility = "hidden";
       document.getElementById('QRADIOS').style.visibility = "hidden";	    
    }	
	
}	

function UtoggleQ(){

    if (document.getElementById('UMchoice').checked==true){
	   document.getElementById('um1lbl').innerHTML='Current Month'; 
	   document.getElementById('um2lbl').innerHTML='Month Last Year'; 
       document.getElementById('UMTHCUTOFF').style.visibility = "visible";
    } else {
	   document.getElementById('um1lbl').innerHTML='Current Quarter'; 
	   document.getElementById('um2lbl').innerHTML='Quarter Last Year';  
	   document.getElementById('UMTHCUTOFF').style.visibility = "hidden"; 
    }    
	   
    if (document.getElementById('UQchoice').checked==true){
	   document.getElementById('UQRADIOS').style.visibility = "visible";
	   document.getElementById('UQYRSCR').style.visibility = "visible";       
    } else {
       document.getElementById('UQYRSCR').style.visibility = "hidden";
       document.getElementById('UQRADIOS').style.visibility = "hidden";	    
    }	
	
}	

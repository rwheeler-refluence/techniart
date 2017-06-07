function utlprvolcompile(){
      
	var tkurl = "includes/php/utlprvolpdf_process.php?usession="; // The server-side script
       
    mf = new Array();
    
    if (document.getElementById('prtypeI').checked==true){
       mf[0]="I";
    } else if  (document.getElementById('prtypeC').checked==true){
	   mf[0]="C"; 
    } else if  (document.getElementById('prtypeV').checked==true){
	   mf[0]="V"; 
    } else if  (document.getElementById('prtypeR').checked==true){
	   mf[0]="R";  
    } else if  (document.getElementById('prtypeS').checked==true){
	   mf[0]="S"; 
    } else if  (document.getElementById('prtypeY').checked==true){
	   mf[0]="Y"; 
    } else {
	   mf[0]="O"; 
    }          
    
    
    if (document.getElementById('prorderA').checked==true){
       mf[1]="A";    
    } else {
	   mf[1]="D"; 
    }
   
    //check for zero rev
    if (document.getElementById('przerorevbox').checked == false) {
      mf[2]= "N";
    } else {mf[2]= "Y"};
              
    document.body.style.cursor = "wait";
    showwait();
     
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = utlprvolcompileResponce;
    http.send(null);
 

}

function utlprvolcompileResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    
    //alert(mmes);
    document.getElementById('prexcelbtn').style.visibility = "visible";
    document.getElementById('prvolbtn').style.visibility = "visible";
    
    document.body.style.cursor='auto';
    
    document.getElementById('genericmsgscr').style.top='130px';
    document.getElementById('genericmsgscr').style.left='280px'; 
    document.getElementById('genericmsgscr').style.height='160px'; 
    document.getElementById('genericmsgscr').style.width='520px';
    document.getElementById('genericmsgtext').innerHTML="Choose the 'PDF' button to view/print or 'Excel' button to download an .xls Excel file."; 
    showgenericmsg(); 
	   

  }
  
} 

function utlprvolPDFview(){

    document.getElementById('current_pdf').value="prvol";
	var tempnm=trim(document.getElementById('uname').value);
    document.getElementById('pdfid').value=tempnm;
    
    
    document.body.style.cursor='auto';
    rpdfopen('popup', 640, 480);
	
}	

function utlshowprXLS(){

var url="http://"+document.getElementById('servername').value+"/cc/"+document.getElementById('ucoid').value+"graphs/"+trim(document.getElementById('uname').value)+"_prvol.zip";
//alert(url);
win = window.open(url, "new", "toolbar=1,scrollbars=yes,status=yes,resizable=yes")

}


function utlsalesrptPDF(){
    //alert('in utlsalesrptPDF');  
	var tkurl = "includes/php/utlsalesrptpdf_process.php?usession="; // The server-side script
    
var numchk=IsNumeric(trim(document.getElementById('sls_numrows').value));	

if (numchk==false && trim(document.getElementById('sls_numrows').value) !=''){
    alert("You must put a number in the number of rows box or leave it blank, please correct and try again.   ");
	return null;	
}	
    
	   
	mf = new Array();
    
    if (document.getElementById('slstypeI').checked==true){
       mf[0]="I";
    } else if  (document.getElementById('slstypeN').checked==true){
	   mf[0]="N"; 
    } else if  (document.getElementById('slstypeST').checked==true){
	   mf[0]="ST"; 
    } else if  (document.getElementById('slstypeSLS').checked==true){
	   mf[0]="SLS"; 
    } else if  (document.getElementById('slstypeMR').checked==true){
	   mf[0]="MR"; 
    } else if  (document.getElementById('slstypeMR2').checked==true){
	   mf[0]="MR2"; 
    } else if  (document.getElementById('slstypeMRP').checked==true){
	   mf[0]="MRP"; 
    } else if  (document.getElementById('slstypeYTD').checked==true){
	   mf[0]="YTD"; 
    } else if  (document.getElementById('slstypeYTD2').checked==true){
	   mf[0]="YTD2"; 
    } else if  (document.getElementById('slstypeYTDP').checked==true){
	   mf[0]="YTDP"; 
    } else if  (document.getElementById('slstypeP1').checked==true){
	   mf[0]="P1"; 
    } else if  (document.getElementById('slstypeP2').checked==true){
	   mf[0]="P2"; 
    } else {
	   mf[0]="P3"; 
    }          
    
    if (document.getElementById('slsorderA').checked==true){
       mf[1]="A";    
    } else {
	   mf[1]="D"; 
    }
    var salesel=document.forms['utilform'].utilsales2.selectedIndex;       
    var selval=document.forms['utilform'].utilsales2.options[salesel].value;
    //alert(selval);
    //return null;
    if (salesel > 0){
       var msale=selval.split('|');
       mf[2]=trim(msale[0]);   
    } else {
	   mf[2]="none";     
    }    
    
    //by default
    mf[4]= "N";
    
    //check for zero rev
    if (document.getElementById('slszerorevbox').checked == false) {
      mf[3]= "N";
    } else {mf[3]= "Y"};
 
   
    mf[5]=trim(document.getElementById('sls_numrows').value);
    //need to add this to the other excell reports to be able to save xls report  
    //document.getElementById('excelrpt').innerHTML="<font size='2'>Excel File</font>";   
    //document.getElementById('excelrpt').href="http://<?php echo $SERVER_NAME ?>/cc/"+document.getElementById('ucoid').value+"graphs/"+trim(document.getElementById('mcustid').value)+"_orders.xls";
   
    
    if (document.getElementById('UMchoice').checked==true){
	    mf[6]="M";
	    
	   if (document.getElementById('slsthirtydaybox').checked == false) {
          mf[4]= "N";
       }  else {mf[4]= "Y"};
    
	    
    } else { 

        if (document.getElementById('UslsQ1').checked==true){
          mf[6]="1";
        } else if  (document.getElementById('UslsQ2').checked==true){
	      mf[6]="2"; 
        } else if  (document.getElementById('UslsQ3').checked==true){
	      mf[6]="3"; 
        } else if  (document.getElementById('UslsQ4').checked==true){
	      mf[6]="4"; 
        } else {
	      alert('Please choose a quarter.');
	      return null;    
	        
        }          
    } 
    
    
    var Qsel=document.forms['utilform'].UQyear.selectedIndex;       
    var Qselval=document.forms['utilform'].UQyear.options[Qsel].value;
   
    if (Qsel > 0){
       mf[7]=Qselval;   
    } else {
	   var d = new Date();
       var myear=d.getYear(); 
       mf[7]=myear;     
    }    
    
     //check for summary page only
    if (document.getElementById('slssumpgbox').checked == false) {
      mf[8]= "N";
    } else {mf[8]= "Y"};
    
    
    //alert(mf[7]);
    //return null;
    
    document.body.style.cursor = "wait";
    showwait();
     
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = utlsalesrptPDFResponce;
    http.send(null);
 

}

function utlsalesrptPDFResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    //alert(mmes);
    document.getElementById('slsXLS').style.visibility = "visible";
    document.getElementById('slsPDF').style.visibility = "visible";
   
    document.body.style.cursor='auto';
    hidewait();
    
    if (mmes =="back from pdf"){
	    
	  //resetslsrpt();

      document.getElementById('genericmsgscr').style.top='130px';
      document.getElementById('genericmsgscr').style.left='280px'; 
      document.getElementById('genericmsgscr').style.height='160px'; 
      document.getElementById('genericmsgscr').style.width='520px';
      document.getElementById('genericmsgtext').innerHTML="Choose the 'PDF' button to view/print or 'Excel' button to download an .xls Excel file."; 
      showgenericmsg(); 
    
    } else {
	    
	  alert(mmes);  
	    
    }     
  }
  
} 


function utlshowslsPDF(){
	document.getElementById('current_pdf').value="slsrpt";
	var tempnm=trim(document.getElementById('uname').value);
    document.getElementById('pdfid').value=tempnm;
   	rpdfopen('popup', 640, 480);	
}	
	

function utlshowslsXLS(){

var url="http://"+document.getElementById('servername').value+"/cc/"+document.getElementById('ucoid').value+"graphs/"+trim(document.getElementById('uname').value)+"_slsrpt.zip";
//alert(url);
win = window.open(url, "new", "toolbar=1,scrollbars=yes,status=yes,resizable=yes")

}

function resetslsrpt(){
document.getElementById('slstypeI').checked =true;
document.getElementById('slstypeN').checked = false;
document.getElementById('slstypeST').checked = false;
document.getElementById('slstypeSLS').checked = false;
document.getElementById('slstypeMR').checked = false;
document.getElementById('slstypeMR2').checked = false;
document.getElementById('slstypeMRP').checked = false;
document.getElementById('slstypeYTD').checked = false;
document.getElementById('slstypeYTD2').checked = false;
document.getElementById('slstypeYTDP').checked = false;
document.getElementById('slstypeP1').checked = false;
document.getElementById('slstypeP2').checked = false;
document.getElementById('slstypeP3').checked = false;
//document.getElementById('utilsales2').selectedIndex=0;

document.getElementById('UMchoice').checked = true;
document.getElementById('UQchoice').checked = false;
document.getElementById('UslsQ1').checked = false;
document.getElementById('UslsQ2').checked = false;
document.getElementById('UslsQ3').checked = false;
document.getElementById('UslsQ4').checked = false;

document.getElementById('UQyear').selectedIndex=0;

document.getElementById('slsthirtydaybox').checked = false;
document.getElementById('slszerorevbox').checked = false;
document.getElementById('slsorder').checked = false;
document.getElementById('slsorderD').checked = true;

document.getElementById('UMTHCUTOFF').style.visibility = "visible"; 
document.getElementById('UQYRSCR').style.visibility = "hidden";
document.getElementById('UQRADIOS').style.visibility = "hidden";	    


}
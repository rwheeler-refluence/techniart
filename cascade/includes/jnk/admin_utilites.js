
function clearusel(){
  document.forms['utilform'].utilfiletype.selectedIndex=-1;
  document.forms['utilform'].filetype_type.selectedIndex=0;
  document.forms['utilform'].utilmterms.selectedIndex=-1;
  document.forms['utilform'].utilmship.selectedIndex=-1;
  document.forms['utilform'].utiltagformat.selectedIndex=-1;
  document.forms['utilform'].utilsales.selectedIndex=-1;
  
  document.getElementById('NEWFILETYP').value='';
  document.getElementById('NEWARSEGLEN').value='';
  document.getElementById('NEWTERM').value='';
  document.getElementById('NEWTERMNUM').value='';
  document.getElementById('NEWSHIP').value='';
  document.getElementById('NEWTAGFMT').value=''; 
  document.getElementById('NEWSPCODE').value=''; 
  document.getElementById('NEWSALELOGIN').value='';
  document.getElementById('NEWSALEPASS').value='';
  document.getElementById('NEWSALECOMM').value=''; 
}	

function setarfile(){
   var arsel=document.forms['utilform'].utilfiletype.selectedIndex;
   var selval=document.forms['utilform'].utilfiletype.options[arsel].value;
   var marfile=selval.split('|');
   document.getElementById('NEWFILETYP').value=trim(marfile[0]);
   //alert(marfile[1]);
   if (trim(marfile[1])=='I'){
     document.forms['utilform'].filetype_type.selectedIndex=1;
   } else {
     document.forms['utilform'].filetype_type.selectedIndex=2;	
   }
       
   document.getElementById('NEWARSEGLEN').value=trim(marfile[2]);
   
}

function setterm(){
   var arsel=document.forms['utilform'].utilmterms.selectedIndex;
   var selval=document.forms['utilform'].utilmterms.options[arsel].value;
   var marfile=selval.split('|');
   document.getElementById('NEWTERM').value=trim(marfile[0]);
   document.getElementById('NEWTERMNUM').value=trim(marfile[1]);
 
}

function setship(){
   var arsel=document.forms['utilform'].utilmship.selectedIndex;
   var selval=document.forms['utilform'].utilmship.options[arsel].value;
   document.getElementById('NEWSHIP').value=trim(selval);
   
}

function settag(){
   var arsel=document.forms['utilform'].utiltagformat.selectedIndex;
   var selval=document.forms['utilform'].utiltagformat.options[arsel].value;
   document.getElementById('NEWTAGFMT').value=trim(selval);
   
}

function setsales(){
   var salesel=document.forms['utilform'].utilsales.selectedIndex;
   var selval=document.forms['utilform'].utilsales.options[salesel].value;
   var msale=selval.split('|');
   
   document.getElementById('NEWSPCODE').value=trim(msale[0]); 
   document.getElementById('NEWSALELOGIN').value=trim(msale[1]);
   document.getElementById('NEWSALEPASS').value=trim(msale[2]);
   document.getElementById('NEWSALECOMM').value=trim(msale[3]);
   document.getElementById('util_salerecnum').value=trim(msale[4]);
}


function utilproc(mwhat,mtype){
	
  //alert('What File: '+mwhat+' Type of edit: '+mtype);	
  var updateurl = "includes/php/util_selectproc.php?mform="; // The server-side script
  var merr='';

    s = new Array(); 
    s[0] = mwhat; //  AR/TAG/SHIP/TERMS/SALES
    s[1] = mtype  //  EDIT/DELETE/ADD
    
    if (mwhat=='AR'){
	     
       s[2] =document.getElementById('NEWFILETYP').value;
       s[2] = padRight(s[2],' ',30);  
       var msel=document.forms['utilform'].filetype_type.selectedIndex;
       s[3]=document.forms['utilform'].filetype_type.options[msel].value;
       
       msel=document.forms['utilform'].utilfiletype.selectedIndex;
       if (msel > -1){
           var mselval=document.forms['utilform'].utilfiletype.options[msel].value;
           var mfile=mselval.split('|');
           s[4]=mfile[0];
       } else {
	       s[4]='';
       } 
       
       s[5] = document.getElementById('NEWARSEGLEN').value;
       s[5] =trim(s[5]);
       s[5] = padLeft(s[5],' ',2); 
          
       
       if (trim(s[5]) == ''){ merr="You must enter in a segment length."};
       if (s[3] != 'I' && s[3] != 'D'){ merr="You must select a data type."};
       if (msel==-1 && mtype=='DELETE'){ merr="You must select file type to delete."};
       if (msel==-1 && mtype=='EDIT'){ merr="You must select file type to Edit."};
       if (trim(s[2]) == ''){ merr="You must select a file type to work with or input new name & data type to add."};       
      
       if (mtype !='DELETE'){
          //check for duplicate if edit or add
          //searchStr=s[2].toUpperCase();
          //searchStr=trim(searchStr);
          var searchStr=trim(s[2]);
          
          var xz=0;
          while (xz < document.forms['utilform'].utilfiletype.options.length){
    
	         //pull out name and trim and uppercase it for comparison 
	         mselval=document.forms['utilform'].utilfiletype.options[xz].value;
	         mfile=mselval.split('|');
             tempVar=mfile[0];
	         //tempVar=tempVar.toUpperCase();
	         tempVar=trim(tempVar);
	      
	         if (tempVar==searchStr){
                //alert("Found string at :"+xz);
                if (trim(mfile[1])==trim(s[3]) && trim(mfile[2])==trim(s[5])){
	               merr="The file type name,data & seglen type already exist."
                }
             
                if (mtype=='ADD'){    
                   merr="The file type you are trying to add already exist."
                }
                
                break;
             }	  
      
             tempVar="";
	        xz =(xz+1);
          }
       } // end of dup check condition   
       
           
    } else if (mwhat=='TAG'){
	   
	     
       s[2] =document.getElementById('NEWTAGFMT').value; 
       s[2] = padRight(s[2],' ',20); 
       //this is uppercased in data
       s[2] =s[2].toUpperCase();
       
       var msel=document.forms['utilform'].utiltagformat.selectedIndex;
       if (msel > -1){ 
         s[3]=document.forms['utilform'].utiltagformat.options[msel].value;
       } else {
	     s[3]='';       
       }          
       if (msel==-1 && mtype=='DELETE'){ merr="You must select a tag format to delete."};
       if (msel==-1 && mtype=='EDIT'){ merr="You must select a tag format to Edit."};
       if (trim(s[2]) == ''){ merr="You must select a tag format to work with or input new name to add."};       
      
       if (mtype !='DELETE'){
          //check for duplicate if edit or add
          searchStr=s[2].toUpperCase();
          searchStr=trim(searchStr);
       
          var xz=0;
          while (xz < document.forms['utilform'].utiltagformat.options.length){
    
	         //trim and uppercase it for comparison 
	         tempVar=document.forms['utilform'].utiltagformat.options[xz].value;
             tempVar=tempVar.toUpperCase();
	         tempVar=trim(tempVar);
	      
	         if (tempVar==searchStr){
                //alert("Found string at :"+xz);
                merr="The tag format already exist.";
                break;
             }	  
      
             tempVar="";
	        xz =(xz+1);
          }
        } // end of dup check condition       
       
        
    } else if (mwhat=='SHIP'){ 
	    
	    
       s[2] =document.getElementById('NEWSHIP').value;
       s[2] = padRight(s[2],' ',15); 
       //this is uppercased in data
       s[2] =s[2].toUpperCase();
       
       var msel=document.forms['utilform'].utilmship.selectedIndex;
       if (msel > -1){ 
         s[3]=document.forms['utilform'].utilmship.options[msel].value;
       } else {
	     s[3]='';       
       }          
       if (msel==-1 && mtype=='DELETE'){ merr="You must select a shipping method to delete."};
       if (msel==-1 && mtype=='EDIT'){ merr="You must select a shipping method to Edit."};
       if (trim(s[2]) == ''){ merr="You must select a shipping method to work with or input new name to add."};       
      
       if (mtype !='DELETE'){
          //check for duplicate if edit or add
          searchStr=s[2].toUpperCase();
          searchStr=trim(searchStr);
       
          var xz=0;
          while (xz < document.forms['utilform'].utilmship.options.length){
    
	         //trim and uppercase it for comparison 
	         tempVar=document.forms['utilform'].utilmship.options[xz].value;
             //tempVar=tempVar.toUpperCase();
	         tempVar=trim(tempVar);
	      
	         if (tempVar==searchStr){
                //alert("Found string at :"+xz);
                merr="The shipping method already exist.";
                break;
             }	  
      
             tempVar="";
	        xz =(xz+1);
          }
        } // end of dup check condition       
       
     } else if (mwhat=='SALES'){
       
	   s[2]=trim(document.getElementById('NEWSPCODE').value); 
	   s[2]=s[2].toUpperCase();
       s[3]=trim(document.getElementById('NEWSALELOGIN').value);
       s[4]=trim(document.getElementById('NEWSALEPASS').value);
       s[5]=trim(document.getElementById('NEWSALECOMM').value);
       if (mtype =='ADD'){
	       s[6]=document.forms['utilform'].utilsales.options.length+1;
	       document.getElementById('util_salerecnum').value="0";
	   } else {        	     
          s[6]=trim(document.getElementById('util_salerecnum').value);
          s[6]=parseInt(s[6]);
       }
       if (s[2] == ''){ merr="You must enter in a code for the representative.\n"};
       if (s[3] == ''){ merr="You must enter in a login for the representative.\n"};
       if (s[4] == ''){ merr="You must enter in a password for the representative.\n"};
       if (s[5] == ''){ merr="You must enter in a commission for the representative.\n"};
       
       if (mtype !='DELETE'){
          //check for duplicate if edit or add
          //searchStr=s[2].toUpperCase();
          //searchStr=trim(searchStr);
          var searchStr=trim(s[3]);
          
          var xz=0;
          while (xz < document.forms['utilform'].utilsales.options.length){
    
	         //pull out name and trim and uppercase it for comparison 
	         mselval=document.forms['utilform'].utilsales.options[xz].value;
	         //alert(mfile);
	         mfile=mselval.split('|');
             tempVar=mfile[1];
	         //tempVar=tempVar.toUpperCase();
	         tempVar=trim(tempVar);
	      
	         if (tempVar==searchStr){
                //alert("Found string at :"+xz);
                //if ( trim(mfile[1])==trim(s[3]) ){
	            //   merr="The login entered already exist."
                //}
             
                if (mtype=='ADD'){    
                   merr="The login you are trying to add already exist."
                }
                
                break;
             }	  
      
             tempVar="";
	        xz =(xz+1);
          }
          
          
          
          
       } // end of dup check condition   
       
          
    } else {
	    
	     
       s[2] =document.getElementById('NEWTERM').value;
       s[2] = padRight(s[2],' ',11); 
       //this is uppercased in data
       s[2] =s[2].toUpperCase();
       
       s[3] =document.getElementById('NEWTERMNUM').value;
       s[3] = padLeft(s[3],' ',3); 
       var msel=document.forms['utilform'].utilmterms.selectedIndex;
      
       
       msel=document.forms['utilform'].utilmterms.selectedIndex;
       if (msel > -1){
           var mselval=document.forms['utilform'].utilmterms.options[msel].value;
           var mfile=mselval.split('|');
           s[4]=mfile[0];
       } else {
	       s[4]='';
       } 
       
       if (trim(s[3]) == ''){ merr="You must enter a numeric field for payment term."};
       if (msel==-1 && mtype=='DELETE'){ merr="You must select payment term to delete."};
       if (msel==-1 && mtype=='EDIT'){ merr="You must select a payment term to Edit."};
       if (trim(s[2]) == ''){ merr="You must select a payment term to work with or input new name & numeric value to add."};       
      
       if (mtype !='DELETE'){
          //check for duplicate if edit or add
          searchStr=s[2].toUpperCase();
          searchStr=trim(searchStr);
       
          var xz=0;
          while (xz < document.forms['utilform'].utilmterms.options.length){
    
	         //pull out name and trim and uppercase it for comparison 
	         mselval=document.forms['utilform'].utilmterms.options[xz].value;
	         mfile=mselval.split('|');
             tempVar=mfile[0];
	         //tempVar=tempVar.toUpperCase();
	         tempVar=trim(tempVar);
	      
	         if (tempVar==searchStr){
                //alert("Found string at :"+xz);
                if (trim(mfile[1])==trim(s[3])){
	               merr="The payment term & numeric value already exist."
                }
             
                if (mtype=='ADD'){    
                   merr="The payment term you are trying to add already exist."
                }
                
                break;
             }	  
      
             tempVar="";
	        xz =(xz+1);
          }
       } // end of dup check condition   
       
       
         
    }
    
    
   //if an error message exist do not perform the function requested
   if (merr==''){    
     document.body.style.cursor = "wait";
     showwait();
    
     var usession = getmsession();
     http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
     http.onreadystatechange = utilprocResponse;
     http.send(null);

  } else {
    
    //document.getElementById('utilmsgtext').innerHTML="Error processing request, please try again.";
    //showutilmsg();
    alert(merr);
    
  }
	
	
	
	
}

function utilprocResponse() {

  if (http.readyState == 4) {
    
	 var retmsg=http.responseText;
	 document.getElementById('util_salerecnum').value="0";
	 //alert(retmsg);
	 
     if (trim(retmsg) == "ERROR"){
	   hidewait();
       document.body.style.cursor='auto';  
	   //document.getElementById('utilmsgtext').innerHTML="Error processing request, please try again.";
       //showutilmsg();
       alert('PHP Error processing request, please try again.');
       
     } else {
	   clearusel();  
       getarfiletyp();
     }    
      
  } // end of ready state test

} //end of funtion


function rlroyalty(){
   
	var tkurl = "includes/php/util_resipdf_process.php?usession="; // The server-side script
    
    if (document.forms['utilform'].util_mmth.options.length < 1){
	  alert('Please choose a month for the PDF report.');  
	  return null;    
    }     
    
    mf = new Array();
    
    mf[0]=trim(document.getElementById('util_mmth').value);
    mf[1]=trim(document.getElementById('util_yr').value);
    mf[2]=trim(document.getElementById('util_append').value);
         
    document.getElementById('current_pdf').value="rl";
    document.getElementById('pdfid').value=mf[0]+"_royalty";
    
    //alert(mf[0]);
    //return null;
    document.body.style.cursor = "wait";
    showwait();
          
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = rlroyaltyResponce;
    http.send(null);
}	


function rlroyaltyResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    //alert(mmes);
	hidewait();
    document.body.style.cursor='auto';
    rpdfopen('popup', 640, 480);

  }
}	

function salestaxPDF(){
   
	var tkurl = "includes/php/util_staxpdf_process.php?usession="; // The server-side script
    
    if (document.getElementById('util_staxq').selectedIndex == -1 || document.getElementById('util_staxq').value=="0"){
	  alert('Please choose a periode for the sales tax PDF report.');  
	  return null;    
    }  
       
    if (document.getElementById('util_staxyr').selectedIndex == -1 || document.getElementById('util_staxyr').value=="0"){
	  alert('Please choose a year the sales tax PDF report.');  
	  return null;    
    } 
    
    
    mf = new Array();
    
    mf[0]=trim(document.getElementById('util_staxq').value);
    mf[1]=trim(document.getElementById('util_staxyr').value);
   
    if (document.getElementById('sales_markpd').checked==true){
       mf[2]="Y";
    } else {    
	   mf[2]="N"; 
    }
    
    
    if (document.getElementById('sales_incdet').checked==true){
       mf[3]="Y";
    } else {    
	   mf[3]="N"; 
    }
                   
    document.getElementById('current_pdf').value="tax";
    document.getElementById('pdfid').value=mf[0]+"_sales";
    
    //alert(mf[0]);
    //return null;
    document.body.style.cursor = "wait";
    showwait();
          
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = salestaxPDFResponce;
    http.send(null);
}	


function salestaxPDFResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    //rest screenchoices
    document.getElementById('sales_incdet').checked=false;
    document.getElementById('sales_markpd').checked=false;
    document.getElementById('util_staxq').selectedIndex=0;
    document.getElementById('util_staxyr').selectedIndex=0;   

    hidewait();
    document.body.style.cursor='auto';
    showstaxscr();
    rpdfopen('popup', 640, 480);

  }
}	

//reverse paid date
function salestaxREVERSE(){
   
	var tkurl = "includes/php/util_stax_reversepd.php?usession="; // The server-side script
    
    if (document.getElementById('util_staxreverse').selectedIndex ==-1 || document.getElementById('util_staxreverse').value=="0"){
	  alert('Please choose a tax paid date to reverse.');  
	  return null;    
    }   
    
    if (document.getElementById('sales_markpd').checked==true){
      alert('Please uncheck the box to mark as paid.');  
	  return null;  
    }      
    
    if (document.getElementById('util_staxq').selectedIndex !=-1 && document.getElementById('util_staxq').value !="0"){
	  alert('Please do not choose a periode for the sales tax PDF report when reversing charges.');  
	  return null;    
    }     
    
    mf = new Array();
    
    mf[0]=trim(document.getElementById('util_staxreverse').value);
    
   
    document.body.style.cursor = "wait";
    showwait();
          
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = salestaxREVERSEResponce;
    http.send(null);
}	


function salestaxREVERSEResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var dtremoved=http.responseText;
    //alert(dtremoved);
    
    var numunits=document.forms['utilform'].util_staxpdfs.length;
    document.forms['utilform'].util_staxpdfs.selectedIndex = -1; 
    var xt=0;
    var mtxt="";
       
    while (xt < numunits) {
	    
	    mtxt=trim(document.forms['utilform'].util_staxpdfs[xt].text);
	    //alert(mtxt);
	    
	    var afind = mtxt.indexOf(dtremoved); 
        if (afind !=-1){
          document.forms['utilform'].util_staxpdfs.options[xt] = null;
        } 
	    
	         
      xt=(xt+1);
       
    }
   
        
    var msel=document.forms['utilform'].util_staxreverse.selectedIndex;
    document.forms['utilform'].util_staxreverse.options[msel] = null;
    
    hidewait();
    document.body.style.cursor='auto';
    

  }
}	

function getrevdts(){
	var tkurl = "includes/php/util_stax_getrevdts.php?usession="; // The server-side script
 
	mf = new Array();
    
    mf[0]="";
    
    document.body.style.cursor = "wait";
    showwait();
          
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = getrevdtsResponce;
    http.send(null);
	
	
}	

function getrevdtsResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var results=http.responseText.split('^');
    
    var mtest=http.responseText;
    //alert(mtest);
    document.forms['utilform'].util_staxreverse.options.length=0;
    document.forms['utilform'].util_staxreverse.options[0] = new Option("Pick a Date","0",true,false);
    z=0;
    for (x in results)
    {
     if (trim(results[x]) !=""){
       if (typeof results[x] != "undefined")
       {
	    z=z+1;    
        document.forms['utilform'].util_staxreverse.options[z] = new Option(results[x],results[x],true,false);
       }  
     }  
    }
            
	//hidewait();
    //document.body.style.cursor='auto';
    upgetslsDir('pdf');

  }
}	

function valit(mtype){

if (mtype=="detail"){
	
      if (document.getElementById('sales_markpd').checked==true){
         alert('Please uncheck the box to records as paid.'); 
         document.getElementById('sales_incdet').checked=false;
         return null;  
      } 
}

if (mtype=="post"){
	
      if (document.getElementById('sales_incdet').checked==true){
         alert('Please uncheck the box to show detail.'); 
         document.getElementById('sales_markpd').checked=false;
         return null;  
      } 
      
}      
      
}



///// build pdf directory


function upgetslsDirResponse() {

  if (http.readyState == 4) {
  
    // Split the delimited response into an array
    mreturn = http.responseText.split("^");

    //lets go ahead and load the years(going back 5)
    var today = new Date();
	var mYear = takeYear(today);
    document.forms['utilform'].util_staxyr.options.length = 0;
    var xcv=0;
    while (xcv < 5){       
      document.forms['utilform'].util_staxyr.options[xcv] = new Option(mYear,mYear,true,false);
      mYear=(mYear-1);
      xcv=(xcv+1);
    }
    
//util_staxpdfs
//alert(http.responseText);
//return null;

    counts= new Array();
    counts = mreturn[2].split("|");

    var mfiletyp= mreturn[1].toUpperCase();   

    results= new Array();
    results = mreturn[0].split("|");

    document.forms['utilform'].util_staxpdfs.options.length = 0;             
   

    moptionnum=0;
    var nametext=" ";
    var datetext=" ";

    for (x in results){

      if (trim(results[x]) != ""){  

        // spit up the filename and pad it out to 25 characters
        nametext=trim(results[x]);
        datetext=trim(results[x]);
               
        mnum=nametext.indexOf(" -"); 
        nametext=nametext.substring(0,mnum);
        nametext=trim(nametext);
        nametext=padRight(nametext,' ',30);

        mnum=datetext.indexOf("-");
        mnum=(mnum+1);
        datetext=datetext.substring(mnum,50);
        datetext=trim(datetext);
        var nameonly=trim(nametext);
        nametext =nametext+" -"+datetext;
        // put it back into array
        results[x]=nametext;

            mx=results[x].toUpperCase();

            document.forms['utilform'].util_staxpdfs.options[moptionnum] = new Option(results[x],nameonly,true,false);
            moptionnum=(moptionnum+1);

       } // end of test for blank

    } // end of for loop

    if (document.forms['utilform'].util_staxpdfs.options.length == 0) {
           document.forms['utilform'].util_staxpdfs.options[moptionnum] = new Option("No posted sales tax reports.","0",'true');
    }  

    hidewait();
    document.body.style.cursor='auto';
    
  }

}




function upgetslsDir(mtype) {

 var updirurl = "includes/php/util_get_dir_process.php?mid="; // The server-side script
 var newmtype="none^"+mtype;
 //do not show wait for these
 var midValue = document.getElementById("uname").value;
 var usession = getmsession();
 http.open("GET", updirurl + escape(midValue)+ "&usession=" +escape(usession) + "&mtype=" +escape(newmtype), true);
 http.onreadystatechange = upgetslsDirResponse;
 http.send(null);


}


function getslspdf(){

   var mname = document.getElementById("util_staxpdfs").value; 
   
   if (mname !="0"){
     slspdfopen('popup', 640, 480,mname); 
   }
   	
}	
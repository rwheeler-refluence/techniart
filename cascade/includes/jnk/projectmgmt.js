
function getprojrecResponce(){

  if (http.readyState == 4) {

    // Split the delimited response into an array
    //alert(http.responseText);
    results = http.responseText.split("^");
    r1= new Array();
    document.forms['utilform'].projselect.options.length = 0;
    
    var msel = document.forms['utilform'].projwhofilter.selectedIndex; 
    var thewho = document.forms['utilform'].projwhofilter.options[msel].value.toUpperCase();;
    
    mnumrecs=0;
    for (x in results)
    {
    
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
	            
       // pad out the elements for table if individual elements not null
       if (r1[7] != undefined){r1[7] = padRight(r1[7],' ',4)};
       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',42)};
       if (r1[4] != undefined){r1[4] = padRight(r1[4],' ',22)};
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',22)};
       
       mnumrecs=mnumrecs+1;
       
       document.forms['utilform'].projselect.options[x-1] = new Option(r1[7]+r1[5]+r1[4]+r1[0],r1[6]+"|"+thewho,true,false);
      }  

    
      
    } // end of loop

    if (document.forms['utilform'].projselect.options.length == 0) {
       document.forms['utilform'].projselect.options[0] = new Option('No records found.','true');
       hidewait();
       document.body.style.cursor='auto';
       return null;
    }
    
  document.getElementById('proj_numrec').innerHTML="Number of projects found:  "+mnumrecs;
  
  hidewait();
  document.body.style.cursor='auto';
  setTimeout("checktheorder();",100); 

  
  }
}

function checktheorder(){
	
	var xz=0;
	var curnum=0;
	var pnum=1;
	var tempval="";
	if (document.getElementById('proj_showfinishedbox').checked == false) {

		while (xz < document.forms['utilform'].projselect.options.length){
	      
		  tempnum = document.forms['utilform'].projselect.options[xz].text; 
	      var pnumber = tempnum.substring(0,4);
	      
	      pnum=parseInt(pnumber);
	      	 
	       //if not squential reorder the list	  
		  if ((xz+1) != pnum){
			//alert(pnum+"<--P   C-->"+curnum);
			//document.forms['utilform'].projselect.selectedIndex=curnum;
			
	        projneworder(0,100);
	        return null;	  
	      }
      	  
	     curnum++;      
	     xz =(xz+1);
	    }
    } // end of finished
    
}	

function getprojrec(){
  var tkurl = "includes/php/proj_getprojrec_process.php?usession="; // The server-side script
  var mrecord = "";

  mf = new Array();
 
  if (document.getElementById('proj_openbox').checked == true) {
      mf[0]= "Y";
  } else {
	  mf[0]= "N";
  }

  var tmpnum1 = document.forms['utilform'].projwhofilter.selectedIndex; 
  
  mf[1] = document.forms['utilform'].projwhofilter.options[tmpnum1].value.toUpperCase();;
  if (trim(mf[1])=='FILTER BY NAME'){
    mf[1] =document.getElementById('lognm').value;
  }   	  
  
  if (document.getElementById('proj_showfinishedbox').checked == true) {
      mf[2]= "Y";
  } else {
	  mf[2]= "N";
  }
  
  
  document.body.style.cursor = "wait";
  showwait(); 
  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
  http.onreadystatechange = getprojrecResponce;
  http.send(null);

}


//create table project(
//who varchar(20) null,
//pin date null,
//pstarted date null,
//pfinished date null,
//mpriority int null,
//status varchar(1) null,
//mdesc varchar(25),
//detail text)


function projmoveln(mwhere){
if (document.getElementById('proj_openbox').checked == false) {  
 var msel=document.forms['utilform'].projselect.selectedIndex;	
 if (msel > -1){
 
   var mselectvalue=document.forms['utilform'].projselect.options[msel].value;  
   var mselecttext=document.forms['utilform'].projselect.options[msel].text;
   var z=0;

   if (mwhere=='top'){
     document.forms['utilform'].projselect.options[msel] = null;
     z=document.forms['utilform'].projselect.selectedIndex-1;
     
     if (z < 0){
	     z=0;
	 }
     
     projLnInsert(mselecttext,mselectvalue,z);
     document.forms['utilform'].projselect.selectedIndex=0;
     projneworder(0,100);
     return null;
   } else if (mwhere=='up'){
     z=document.forms['utilform'].projselect.selectedIndex-1;
     document.forms['utilform'].projselect.options[msel] = null;
     if (z < 0){
	     z=0;
	 }
     projLnInsert(mselecttext,mselectvalue,z);
     document.forms['utilform'].projselect.selectedIndex=z;
     projneworder(0,100);
     return null;
     
   } else if (mwhere=='down'){
     z=document.forms['utilform'].projselect.selectedIndex+1;
     document.forms['utilform'].projselect.options[msel] = null;
     if (z < 0){
	     z=0;
	 }
     projLnInsert(mselecttext,mselectvalue,z);
     document.forms['utilform'].projselect.selectedIndex=z;
     projneworder(0,100);
     return null;
   } 

   var bottomtest=trim(document.getElementById('proj_moveto').value);
   var gobottom=false;
   bottomtest=parseInt(bottomtest);
   if (bottomtest >= (document.forms['utilform'].projselect.options.length-1)){gobottom=true};
   
   if (mwhere=='bottom' || gobottom==true){
      z=document.forms['utilform'].projselect.options.length; 
      document.forms['utilform'].projselect.options[msel] = null;
      if (document.forms['utilform'].projselect.options.length==0){
	     z=1;
	  }
      document.forms['utilform'].projselect.options[z-1] = new Option(mselecttext,mselectvalue,true,false);  
      document.forms['utilform'].projselect.selectedIndex=z-1;
      projneworder(0,100);
      return null;
    }	

    if (trim(document.getElementById('proj_moveto').value) !='') {
	     if ( IsNumeric(trim(document.getElementById('proj_moveto').value)) == true ){
		     
		      z=trim(document.getElementById('proj_moveto').value);
		      
		      z=parseInt(z);
		      z=(z-1);
		      document.forms['utilform'].projselect.options[msel] = null;
              projLnInsert(mselecttext,mselectvalue,z);
              document.forms['utilform'].projselect.selectedIndex=z;
              document.getElementById('proj_moveto').value="";
              projneworder(0,100);
              return null;
              
	     } else {
		     alert("You must enter a priority number to move this project to."); 
	     }    
    }     	         
    
    
    //document.forms['utilform'].projselect.selectedIndex=-1;
  
 } else {
   alert('No projects selected'); 
 }

} else {
  alert("Please uncheck the 'Scheduled projects only?' checkbox above to re-sort list.  ");	
}
 
 
}



function projLnInsert(mlineItemb,mselectvalueb,msel){
	
var z=document.forms['utilform'].projselect.options.length; 

if (z !=0){
	
  
  if ((z-1)==msel){
    document.forms['utilform'].projselect[z] = new Option(document.forms['utilform'].projselect.options[z-1].text,document.forms['utilform'].projselect.options[z-1].value,true,false); 	
    document.forms['utilform'].projselect.options[z-1] = new Option(mlineItemb,mselectvalueb,true,false);
    var newsel=(z-1);
    document.forms['utilform'].projselect.selectedIndex=newsel; 

  } else {   
    
       while (z > 0){
  	      document.forms['utilform'].projselect[z] = new Option(document.forms['utilform'].projselect.options[z-1].text,document.forms['utilform'].projselect.options[z-1].value,true,false); 	
          document.forms['utilform'].projselect.options[z-1] = new Option(mlineItemb,mselectvalueb,true,false);  
	      
  	      if ((z-1)==msel){
	         var newsel=(z-1);
	         //document.forms['utilform'].projselect.selectedIndex=newsel;
	         break;
	        
          } else {	 
	         z=(z-1);
          }	        
       }	
  }  //end of last select test

} else {

  document.forms['utilform'].projselect.options[0] = new Option(mlineItemb,mselectvalueb,true,false);
  	
		
}	//end of test for empty	   	




		
 return null; 
 	
}//end of function	



function findprojLnItem(){

  
  if (document.forms['utilform'].projselect.selectedIndex==-1){
    var xz=0;
  } else {
	var xz=document.forms['utilform'].projselect.selectedIndex;
	xz =(xz+1);
  }	     		  
  var tempVar="";
  var searchStr=trim(document.getElementById('proj_search').value);
  
  searchStr=searchStr.toUpperCase();
  //alert(searchStr);
  
  while (xz < document.forms['utilform'].projselect.options.length){
    
	  tempVar=document.forms['utilform'].projselect.options[xz].text;
	  tempVar=tempVar.toUpperCase();
	  var afind = tempVar.indexOf(searchStr);
	  if (afind > -1){
        //alert("Found string at :"+xz);
        document.getElementById('projsearchbtn').innerHTML='Continue';
        break;
      }	  
      
      tempVar="";
	       
     xz =(xz+1);
  }
  
  if (xz== document.forms['utilform'].projselect.options.length ){
    
     document.getElementById('projsearchbtn').innerHTML='Search'; 	 
     document.forms['utilform'].projselect.selectedIndex=-1;
     //document.getElementById('projmsgtext').innerHTML="End of search reached.";
     //showpomsg();  
     alert("End of search reached."); 
   } else {   
     document.forms['utilform'].projselect.selectedIndex=xz;
   }
   	 
}

function resetPROJsel(){
	
	document.forms['utilform'].projselect.selectedIndex=-1;
	document.getElementById('projsearchbtn').innerHTML='Search';
}

function projdel(){
	
var msel=document.forms['utilform'].projselect.selectedIndex;

  if (msel > -1){	
    //document.forms['utilform'].projselect.options[msel] = null;
    //document.forms['utilform'].projselect.selectedIndex=msel;	
    alert("To delete a project, edit status to reflect 'cancelled'.");
  } else {
    //alert('No project selected to delete.');
    alert("To delete a project, edit status to reflect 'cancelled'.");
  }
	
}	

function getsprojrec(){
  var tkurl = "includes/php/proj_getsprojrec_process.php?usession="; // The server-side script
  var mrecord = "";
  var tmpnum =document.forms['utilform'].projselect.selectedIndex;   

  if (document.getElementById('proj_reassigned_flag').value=="T")
  {
	document.getElementById('proj_reassigned_flag').value="F" 
    hideprojed(); 
    getprojrec();
    return null;
  }
  
  mf = new Array();
 
  if (tmpnum > -1 && trim(document.forms['utilform'].projselect.options[0].text) !="No records found."){
	  
    tempval = document.forms['utilform'].projselect.options[tmpnum].value;
    r1= new Array(); 
    r1 = tempval.split("|");
    mf[0]= r1[0];
    mf[1]= r1[1];;
   
    document.body.style.cursor = "wait";
    showwait();
    
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
    http.onreadystatechange = getsprojrecResponce;
    http.send(null);
  } else {
	//took this out  
	//if (tmpnum ==-1){  
      //alert("Please choose a project.");
    //} else {
	// alert("This employee has no projects to edit.");  
    // document.forms['utilform'].projselect.selectedIndex=-1;
    //}
    hideprojed(); 
    getprojrec();	  
  }	    
  
}

function getsprojrecResponce(){

  if (http.readyState == 4) {

    // Split the delimited response into an array
    //alert(http.responseText);
    clearpedit();
    results = http.responseText.split("^");
    r1= new Array();
    
    for (x in results)
    {
    
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
	      document.getElementById('proj_who').value=trim(r1[0]);  
	      document.getElementById('proj_dtin').value=trim(r1[1]); 
	      document.getElementById('proj_dtstarted').value=trim(r1[2]);
	      document.getElementById('proj_dtfinished').value=trim(r1[3]); 
	      
          if(trim(r1[4])=="Not Started"){document.getElementById('proj_status').selectedIndex=0};
          if(trim(r1[4])=="In Progress"){document.getElementById('proj_status').selectedIndex=1};
          if(trim(r1[4])=="Waiting on Others"){document.getElementById('proj_status').selectedIndex=2};
          if(trim(r1[4])=="Finished"){document.getElementById('proj_status').selectedIndex=3};
          if(trim(r1[4])=="Canceled"){document.getElementById('proj_status').selectedIndex=4};
          if(trim(r1[4])=="Re-assigned"){document.getElementById('proj_status').selectedIndex=5};
          if(trim(r1[4])=="On Hold"){document.getElementById('proj_status').selectedIndex=6};
          
          document.getElementById('proj_desc').value=trim(r1[5]);
	      document.getElementById('proj_detail').value=trim(r1[6]);
	      document.getElementById('proj_sprecnum').value=trim(r1[7]);
	      document.getElementById('proj_spriority').value=trim(r1[8]);    
          document.getElementById('proj_dttarget').value=trim(r1[9]); 
          if (trim(r1[10])=="//"){
	  	     r1[10]="";  
          }
          
          //reminder section
          document.getElementById('proj_dtremind').value=r1[10];
          
	        if(trim(r1[11])=="0"){document.getElementById('proj_rtype').selectedIndex=0}; 
          	if(trim(r1[11])=="1"){document.getElementById('proj_rtype').selectedIndex=1}; 
          	if(trim(r1[11])=="7"){document.getElementById('proj_rtype').selectedIndex=2}; 
          	if(trim(r1[11])=="30"){document.getElementById('proj_rtype').selectedIndex=3}; 
          	if(trim(r1[11])=="90"){document.getElementById('proj_rtype').selectedIndex=4}; 
          	if(trim(r1[11])=="365"){document.getElementById('proj_rtype').selectedIndex=5}; 
   
          	if(trim(r1[12])=="6"){document.getElementById('proj_rhour').selectedIndex=0}; 
          	if(trim(r1[12])=="7"){document.getElementById('proj_rhour').selectedIndex=1}; 
          	if(trim(r1[12])=="8"){document.getElementById('proj_rhour').selectedIndex=2}; 
          	if(trim(r1[12])=="9"){document.getElementById('proj_rhour').selectedIndex=3}; 
          	if(trim(r1[12])=="10"){document.getElementById('proj_rhour').selectedIndex=4}; 
          	if(trim(r1[12])=="11"){document.getElementById('proj_rhour').selectedIndex=5}; 
          	if(trim(r1[12])=="12"){document.getElementById('proj_rhour').selectedIndex=6}; 
          	if(trim(r1[12])=="13"){document.getElementById('proj_rhour').selectedIndex=7}; 
          	if(trim(r1[12])=="14"){document.getElementById('proj_rhour').selectedIndex=8}; 
          	if(trim(r1[12])=="15"){document.getElementById('proj_rhour').selectedIndex=9}; 
          	if(trim(r1[12])=="16"){document.getElementById('proj_rhour').selectedIndex=10}; 
          	if(trim(r1[12])=="17"){document.getElementById('proj_rhour').selectedIndex=11}; 
          	if(trim(r1[12])=="18"){document.getElementById('proj_rhour').selectedIndex=12}; 
          	if(trim(r1[12])=="19"){document.getElementById('proj_rhour').selectedIndex=13}; 
          	if(trim(r1[12])=="20"){document.getElementById('proj_rhour').selectedIndex=14}; 
          	if(trim(r1[12])=="21"){document.getElementById('proj_rhour').selectedIndex=15};
              
          	if(trim(r1[13])=="0"){document.getElementById('proj_rminute').selectedIndex=0}; 
          	if(trim(r1[13])=="15"){document.getElementById('proj_rminute').selectedIndex=1}; 
          	if(trim(r1[13])=="30"){document.getElementById('proj_rminute').selectedIndex=2}; 
          	if(trim(r1[13])=="45"){document.getElementById('proj_rminute').selectedIndex=3}; 
             
        
          	if(trim(r1[14])=="0"){document.getElementById('proj_rdow').selectedIndex=1};
          	if(trim(r1[14])=="1"){document.getElementById('proj_rdow').selectedIndex=2};
          	if(trim(r1[14])=="2"){document.getElementById('proj_rdow').selectedIndex=3};
          	if(trim(r1[14])=="3"){document.getElementById('proj_rdow').selectedIndex=4};
          	if(trim(r1[14])=="4"){document.getElementById('proj_rdow').selectedIndex=5};
          	if(trim(r1[14])=="5"){document.getElementById('proj_rdow').selectedIndex=6};
          	if(trim(r1[14])=="6"){document.getElementById('proj_rdow').selectedIndex=7};
        
          	document.getElementById('proj_rusers').value=trim(r1[15]); 
            document.getElementById('proj_prioritylbl').innerHTML='Priority: '+trim(r1[8]);    
      	    
          	
          	document.getElementById('proj_prevstatus').value=document.getElementById('proj_status').selectedIndex;
          
      }  

    
      
    } // end of loop
    
    hidewait();
    document.body.style.cursor='auto';
    showprojed();
  }
}


function projneworder(startnum,endnum){
	
	
//do not allow sort on active list		
if (document.getElementById('proj_showfinishedbox').checked == true) {
	return null;
}

	
//do not allow sort on active list		
if (document.getElementById('proj_openbox').checked == false) {

  //alert(document.forms['utilform'].projselect.options.length);
  if(document.forms['utilform'].projselect.options.length !=0 && document.forms['utilform'].projselect.options[0].text !='No records found.'){
    var tkurl = "includes/php/proj_savorder.php?usession="; // The server-side script
    var mrecord = "";
   //alert(startnum+" --  "+endnum);
    mf = new Array();
    startnum=parseInt(startnum);
    endnum=parseInt(endnum);
    
    var xz=startnum;
    if (endnum > (document.forms['utilform'].projselect.options.length-1)){
	    endnum=document.forms['utilform'].projselect.options.length;
	    //alert("in end number conditional");
	}
	
    endnum=parseInt(endnum);
    bx=0;
    while (xz < endnum){
	    
	   mf[bx]=document.forms['utilform'].projselect.options[xz].value+"|"+(xz+1);
	   //alert(mf[bx]);
       xz =(xz+1);
       bx =(bx+1);
    }
    
    document.body.style.cursor = "wait";
    showwait();
    
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + mf + "&mnum=" +endnum, true);
    http.onreadystatechange = projneworderResponce;
    http.send(null);
  } else {
	getprojrec();
    //alert('No records loaded');
  }

} else {
	
alert("Please uncheck the 'Scheduled projects only?' checkbox above to re-sort list.  ");	
}	
	  
  
  
}



function projneworderResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mnum=http.responseText;
    //mnum=parseInt(mnum);
    
    //alert(mnum);
    mnum=parseInt(mnum);
      if (mnum < (document.forms['utilform'].projselect.options.length-1)){
        var endnum=(mnum+100);
        projneworder(mnum,endnum);  
      } else {
	    //alert("Done"); 
	    hidewait();
        document.body.style.cursor='auto';
        getprojrec();
      }
     
  }
}


function projPDF(){
    
	if (trim(document.getElementById('loglevel').value)=='9'){

   	  var muserchk=-1;
	  muserchk=document.getElementById('projwhofilter').selectedIndex;
	  if (muserchk < 1){
		alert('Please select an employee from the list above.');
	    return null;
      }	 
    } //end of test for manager
    
	var tkurl = "includes/php/proj_buildpdf_process.php?usession="; // The server-side script
    var mrecord = "";
    if (trim(mf[0])=='' || document.forms['utilform'].projselect.options.length < 1){
	  alert('There are no projects for a PDF report.');  
	  return null;    
    }     
    
    mf = new Array();
    
    mf[0]=trim(document.getElementById('projwhofilter').value);
     
    if (document.getElementById('proj_openbox').checked == true) {
      mf[1]= "Y";
    } else {
	  mf[1]= "N";
    }
    
    document.getElementById('current_pdf').value="projects";
    document.getElementById('pdfid').value=mf[0]+"_user";
    
    
    //expandpdf
    
    var test1 = document.forms['utilform'].expandpdf[0].checked;
    var test2 = document.forms['utilform'].expandpdf[1].checked;
    //alert("condensed:"+test1+"   Expanded:"+test2);
    //return null;
    if (test2==true){
	  mf[2]="Y"; //expand notes
	  //alert("expand it");   
    } else {
	  mf[2]="N";  
    }
        
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = projPDFResponce;
    http.send(null);
 

}

function projPDFResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    //alert(mmes);
    
	    hidewait();
        document.body.style.cursor='auto';
        rpdfopen('popup', 640, 480);

  }
}

//single


function singlePDF(){
      
	var tkurl = "includes/php/proj_singlepdf_process.php?usession="; // The server-side script
       
    mf = new Array();
    mf[0]=trim(document.getElementById('projwhofilter').value);
    mf[1]=trim(document.getElementById('proj_spriority').value);
         
    document.getElementById('current_pdf').value="projects";
    document.getElementById('pdfid').value=mf[0]+"_"+mf[1];
   
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = singlePDFResponce;
    http.send(null);
 

}

function singlePDFResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    //alert(mmes);
    
	    hidewait();
        document.body.style.cursor='auto';
        rpdfopen('popup', 640, 480);

  }
}

//end of single

function getpusersResponce(){

  if (http.readyState == 4) {

    // Split the delimited response into an array
    //alert(http.responseText);
    results = http.responseText.split("|");
    
    document.forms['utilform'].projwhofilter.options.length = 0;
    document.forms['utilform'].projwhofilter2.options.length = 0;
    //alert(results);
    
    document.forms['utilform'].projwhofilter.options[0] = new Option("Click here to select user","",true,false);
    document.forms['utilform'].projwhofilter2.options[0] = new Option("Choose Name","",true,false);
    var xyz=1;  
    for (x in results)
    {
     //alert(results[x]);
     document.forms['utilform'].projwhofilter.options[xyz] = new Option(results[x],results[x],true,false);
     document.forms['utilform'].projwhofilter2.options[xyz] = new Option(results[x],results[x],true,false);
     if (trim(results[x])==""){
       break;
     } else {        
       xyz=(xyz+1);
     }
    } // end of loop
    
    if (xyz==2){
	  document.forms['utilform'].projwhofilter.options[0] = null;  
	  document.forms['utilform'].projwhofilter.selectedIndex=0;  
      getprojrec();
    } else { 
	  document.forms['utilform'].projwhofilter.options[xyz] = new Option(document.getElementById('uname').value,document.getElementById('uname').value,true,false);  
	  document.forms['utilform'].projwhofilter2.options[xyz] = new Option(document.getElementById('uname').value,document.getElementById('uname').value,true,false);  
 
      hidewait();
      document.body.style.cursor='auto';  
    }  
     
  }
}


function getpusers(){
  var tkurl = "includes/php/proj_getusers_process.php?usession="; // The server-side script
  var mrecord = "";

  mf = new Array();
 
  if (document.getElementById('loglevel').value =='9') {
      mf[0]= "A";
  } else {
	  mf[0]= document.getElementById('uname').value;
  }

  document.body.style.cursor = "wait";
  showwait(); 
  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
  http.onreadystatechange = getpusersResponce;
  http.send(null);

}

function clearpedit(){
document.getElementById('proj_spriority').value="";
document.getElementById('proj_sprecnum').value="";
document.getElementById('proj_who').value="";
document.getElementById('proj_dtin').value="";
document.getElementById('proj_dtstarted').value="";
document.getElementById('proj_dtfinished').value="";
document.getElementById('proj_dttarget').value="";
document.getElementById('proj_desc').value="";
document.getElementById('proj_detail').value=""; 

document.getElementById('proj_status').selectedIndex=0;
document.getElementById('proj_dtremind').value=""; 
document.getElementById('proj_rtype').selectedIndex=0; 
document.getElementById('proj_rhour').selectedIndex=0;
document.getElementById('proj_rminute').selectedIndex=0;
document.getElementById('proj_rdow').selectedIndex=0;
     	
    var today = new Date();
	var Year = takeYear(today);
	var Month = today.getMonth()+1;
	if (Month < 10){Month='0'+Month};
	var Day = today.getDate();
	//now = Date.UTC(Year,Month,Day+1,0,0,0);
	
document.getElementById('proj_dtin').value=Month+'/'+Day+'/'+Year;
document.getElementById('proj_newpriority').value="";

var newnum=document.forms['utilform'].projselect.options.length+1;
newnum=newnum+" ";
document.getElementById('proj_prioritylbl').innerHTML='Priority: '+ newnum;	
//once turned off in a session stays off... uncomment this to change to reset
//document.getElementById('proj_sendemail').checked=true;
} 


function saveproj(numthrough){
//alert(numthrough);	
//need to combine this and the re-assign function, stupid to maintain two-but unto do not forget
//to update the reassign around line 1450

var errmsg="";

//declare it here so it can be used in several places
var today = new Date();
var Year = takeYear(today);
var Month = today.getMonth()+1;
if (Month < 10){Month='0'+Month};
var Day = today.getDate();

var projFinished="N";

//check to see if job needs closed
if (document.getElementById('proj_status').selectedIndex==3){
  projFinished="Y";
	if (trim(document.getElementById('proj_dtin').value)==""){
		errmsg="<br>You must have an date in defined before you can close this project.";
    }
    	
	if (trim(document.getElementById('proj_desc').value)==""){
		errmsg=errmsg+"<br>Please enter a description of the project<br>before you can close this project.<br>";
    }
        
    if (trim(document.getElementById('proj_detail').value)==""){
		errmsg=errmsg+"<br>Please enter a detailed description of the <br>project before you can close this project.<br>";
    }
    
    //alert(errmsg); 
    if (trim(errmsg) !=""){
	   //alert(errmsg); 
	   document.getElementById('projmsgtext').innerHTML=errmsg;
       showprojmsg();  
	   return null;
    }
    
  
	
	if (trim(document.getElementById('proj_dtin').value)==""){document.getElementById('proj_dtin').value=Month+'/'+Day+'/'+Year;};
    if (trim(document.getElementById('proj_dtstarted').value)==""){document.getElementById('proj_dtstarted').value=Month+'/'+Day+'/'+Year;};
    if (trim(document.getElementById('proj_dtfinished').value)==""){document.getElementById('proj_dtfinished').value=Month+'/'+Day+'/'+Year;};
    if (trim(document.getElementById('proj_dttarget').value)==""){document.getElementById('proj_dttarget').value=Month+'/'+Day+'/'+Year;};
    
}    


	
if (numthrough==null){var numthrough="first"};
	
	
	
	if (trim(document.getElementById('proj_dtin').value)==""){
		errmsg="<br>You must have an date in defined.";
    }
    	
	if (trim(document.getElementById('proj_desc').value)==""){
		errmsg=errmsg+"<br>Please enter a description of the project.<br>";
    }
        
    if (trim(document.getElementById('proj_detail').value)==""){
		errmsg=errmsg+"<br>Please enter a detailed description of the project.<br>";
    }
    
          
    if (trim(document.getElementById('proj_status').value)==""){
		errmsg=errmsg+"<br>Please select the status of the project.<br>";
    }
    
    //alert(errmsg); 
    if (trim(errmsg) !=""){
	   //alert(errmsg); 
	   document.getElementById('projmsgtext').innerHTML=errmsg;
       showprojmsg();  
	   return null;
    }
    
    
    var tkurl = "includes/php/proj_addeditrec_process.php?usession="; // The server-side script
 
    mf = new Array();
    
    
   //check to see if this is a finished project being activated 
   //alert(document.getElementById('proj_prevstatus').value);
   var statcheck=document.getElementById('proj_prevstatus').value;
   statcheck=parseInt(statcheck);
   if (statcheck==3){
	   mf[0]='E'; 
	   mf[1]=trim(document.getElementById('proj_sprecnum').value); 
	   mf[16]='Reactivate';
	   
	   //remove from select box
	   var zsel=document.forms['utilform'].projselect.selectedIndex;	
       document.forms['utilform'].projselect.options[zsel] = null;
   } else {	   

    	if (trim(document.getElementById('proj_spriority').value)==""){
	      document.forms['utilform'].projselect.selectedIndex=-1;  	
    	  var tempval = document.forms['utilform'].projselect.options.length;
    	  //check to see if first one
    	  if (trim(document.forms['utilform'].projselect.options[0].text)!="No records found." && trim(document.forms['utilform'].projselect.options[0].text)!=""){
		     tempval=(tempval+1);
    	  } else {
		     tempval=1; 
    	  }       
    	  tempval=tempval+"";
   		  mf[0]='I';
   		  mf[1]=tempval;
   		  //send an email first time through and then pass through afterward
   		  if (numthrough=="first"){
	   		 //alert('in addit b4 email');       	  
   		     projemail('addit');
   		     return null;
	  	  }   
   	     	  
    	} else {
	    	
	       //if (numthrough !="emailsent" && projFinished=="N"){  
		     //alert('in edit b4 mail');   	  
   		     //projemail('edit');
   		     //return null;
	  	   //} else {   
			 mf[0]='E'; 
			 mf[1]=trim(document.getElementById('proj_sprecnum').value);
           //}
           
    	} 
        	
    } //end of re-activate conditional
    
	mf[2]=trim(document.getElementById('projwhofilter').value);
    mf[3]=document.getElementById('proj_dtin').value;
    mf[4]=document.getElementById('proj_dtstarted').value;
    mf[5]=document.getElementById('proj_dtfinished').value;
    mf[6]=document.getElementById('proj_dttarget').value;
       
    mf[7]=document.getElementById('proj_desc').value;
    
     //had to move detail to separate update
     //mf[8]=document.getElementById('proj_detail').value; 
     
    	
     mf[7]=mf[7].replace(/\'/g,"zpos");
     mf[7]=mf[7].replace(/\,/g,"zcomma");
     
     //mf[8]=mf[8].replace(/\,/g,"zcomma");
     //mf[8]=mf[8].replace(/\'/g,"zpos");
     mf[8]=' '; //took out
     
     mf[9]=document.getElementById('proj_status').value; 
     
     
    
    //build SQL date time stamp from fields
     
    var tempDT=trim(document.getElementById('proj_dtremind').value);
    var targetDT=trim(document.getElementById('proj_dttarget').value);
    
    //test for value in remind field, if not there then substitute the target date. If both are empty then put in target
    if (tempDT.length==0 && targetDT.length !=0) {
	    var tgtemp = new Array();
        tgtemp=targetDT.split("/");
        targetDT=tgtemp[0]+'/'+tgtemp[1]+'/'+tgtemp[2];
        var mtodaycheck=Month+'/'+Day+'/'+Year; 
        //alert(targetDT);
        //alert(mtodaycheck);      
        if (targetDT !=mtodaycheck) 
	    {
	      tempDT=targetDT;
        }   
    }
    
    //blank if project is finished
    if (document.getElementById('proj_status').selectedIndex==3){tempDT=''};
    
    if (trim(tempDT) !=''){
//alert(trim(tempDT));
//return null
	  tempdt = new Array();
      tempdt=tempDT.split("/"); 
    	
      if (tempdt[1]==null)
      {
	    tempdt=tempDT.split("-");  
      }    
    
      if(tempdt[0].length==1)
      {
	    tempdt[0]='0'+tempdt[0];
	  }  
    
      if(tempdt[1].length==1)
      {
	    tempdt[1]='0'+tempdt[1];
	  }    
    
	  if(tempdt[2].length==2)
      {
	  	tempdt[2]='20'+tempdt[2];
	  }    
    
	  tempDT=tempdt[0]+"/"+tempdt[1]+"/"+tempdt[2];
	
      var aPosition = tempDT.indexOf("/");
      var secondPos = tempDT.indexOf("/", aPosition + 1);
    
     
    
      if (aPosition==-1 || secondPos==-1 || tempDT.length < 10){ 
  	    errmsg=errmsg+"<br><br>The reminder date is in the wrong format, use xx/xx/xxxx or xx/xx/xx.";  
	    document.getElementById('projmsgtext').innerHTML=errmsg;
        showprojmsg();  
	    return null; 
	    
      } else {
	  
	  	if (tempDT.length == 10){
		  var myear=tempDT.substring((secondPos+1));
    	} else {
		  var myear="20"+tempDT.substring((secondPos+1));
      	}    		  
      
	  	var mmonth=tempDT.substring(0,aPosition);
	  	var mday=tempDT.substring((aPosition+1),5);
	  	var mhour=document.getElementById('proj_rhour').value;
	  	var mminute=document.getElementById('proj_rminute').value;
	  	var endstr=":00.000";
	  	var newreminddt=myear+"-"+mmonth+"-"+mday+" "+mhour+":"+mminute+endstr;
	  	
     	mf[10]=newreminddt; 
     	mf[11]=document.getElementById('proj_rtype').value; 
     	mf[12]=document.getElementById('proj_rhour').value;
     	mf[13]=document.getElementById('proj_rminute').value;
     	mf[14]=document.getElementById('proj_rdow').value;
     
    
     	mf[15]=trim(document.getElementById('proj_rusers').value);
     	//go ahead and change commas to semicolon in case someone used them
     	mf[15]=mf[15].replace(/\,/g,";");
     	//strip last space if it's a semicolon
     	var lastChar=mf[15].length;
     	if (mf[15].substring(lastChar-1,lastChar)==";"){
	     	mf[15]=mf[15].substring(0,lastChar-1);
        } 	
     	
        //place null in empty
        if (mf[15].length==0){mf[15]=""};
        
            	
   	  } //end of error check 
   	        
     } else {
	     
	    mf[10]=" "; 
     	mf[11]="NULL"; 
     	mf[12]="NULL";
     	mf[13]="NULL";
     	mf[14]="NULL";
     	mf[15]=" "; 
	     
     } //end of check for reminder date value    
     
     if  (document.forms['utilform'].projselect.selectedIndex==-1){
	    z=document.forms['utilform'].projselect.options.length; 
        if (z==0){
	       z=0;
	    }
	    
	    //0= 'mwho'
        //1= 'pin'
        //2= 'pstarted'
        //3= 'pfinished' 
        //4= 'status'
        //5= 'mdesc'
        //6= 'precnum'
        //7= 'mpriority'
        //8= 'ptarget'
	 
	      
       // pad out the elements for new select keep in order
       var newpriority='999';
       newpriority=padRight(newpriority,' ',4);
       
       var newdesc=trim(document.getElementById('proj_desc').value)
       newdesc=padRight(newdesc,' ',42);
       
       var newstatus=trim(document.getElementById('proj_status').value);
       newstatus=padRight(newstatus,' ',22);
       
       var newwho=trim(document.getElementById('projwhofilter').value);
       newwho=padRight(newwho,' ',22);
         
	   var newtext=newpriority+newdesc+newstatus+newwho;
	   var newvalue=trim(document.getElementById('proj_sprecnum').value)+"|"+trim(document.getElementById('projwhofilter').value);
       document.forms['utilform'].projselect.options[z] = new Option(mselecttext,newvalue,true,false);  
       document.forms['utilform'].projselect.selectedIndex=z;  

     }	
     
     mf[17]='not used in edit';     
	 mf[18]=trim(document.getElementById('proj_newpriority').value);
      
     if (trim(mf[18]) !=""){
	         
	    var msel=document.forms['utilform'].projselect.selectedIndex;	
        var mselectvalue=document.forms['utilform'].projselect.options[msel].value;  
        var mselecttext=document.forms['utilform'].projselect.options[msel].text;
        var z=0;
        z=trim(document.getElementById('proj_newpriority').value);
        z=parseInt(z);
        z=(z-1);
        document.forms['utilform'].projselect.options[msel] = null;
        projLnInsert(mselecttext,mselectvalue,z);
        document.forms['utilform'].projselect.selectedIndex=z;    
	     
     }    
     //alert('out');     
     
     for(myKey in mf)
       if(mf.propertyIsEnumerable(myKey)) {
       mf[myKey]=mf[myKey].replace(/\,/g," ");
       mf[myKey]=mf[myKey].replace(/\^/g," ");
       mf[myKey]=mf[myKey].replace(/\|/g," ");
       mf[myKey]=mf[myKey].replace(/\'/g,"''");
       }
	
    document.body.style.cursor = "wait";
    showwait(); 
   
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
    http.onreadystatechange = saveprojResponce;
    http.send(null);
    
}

function saveprojResponce(){

  if (http.readyState == 4) {

    // Split the delimited response into an array
    //alert(http.responseText);
    
    results = http.responseText.split("|");
    
    //testing
    //alert(results);
    //hidewait();
    //document.body.style.cursor='auto';
    //return null;
    
    // the following are a check for small comment blocks to stuff into fox-trouble opening comm within miliseconds
    var sizeofdetail=0;
    var tempdetailstr="";  
    tempdetailstr=trim(document.getElementById('proj_detail').value);  
    sizeofdetail=tempdetailstr.length;
    
    
    saveprojdetail(0,sizeofdetail,results[2]);   
    
    //moved these two to saveprojectdetail
    //hideprojed(); 
    //getprojrec();
  }
}


function saveprojdetail(startnum,maxnum,newpnum){     
   var tkurl = "includes/php/proj_savedetail.php?usession="; // The server-side script

   var startblock=parseInt(startnum);
   var maxblock=parseInt(maxnum);
   
   mf = new Array();
   //alert(newpnum);
   //hidewait();
   //document.body.style.cursor='auto';
   //return null
   
   if (newpnum==0 || newpnum==null){
     mf[0]=trim(document.getElementById('proj_sprecnum').value); 
   } else {
	 mf[0]=newpnum;  
   }	   
   mf[0]=parseInt(mf[0]);
           
   if ((maxblock-startblock) > 1001){
	 var nextblock=(startblock+1001);  
     mf[1]=document.getElementById('proj_detail').value.substring(startblock,nextblock);
   } else {
	 mf[1]=document.getElementById('proj_detail').value.substring(startblock);  
   }
   
   mf[1]=mf[1].replace(/\'/g,"zpos");
   mf[1]=mf[1].replace(/\,/g,"zcomma");
   
   mf[2]=startblock;
   mf[3]=maxblock;
   mf[4]=document.getElementById('proj_desc').value; 
   mf[5]=document.getElementById('proj_status').value;
   
   if (document.getElementById('proj_sendemail').checked == false) {
      mf[6]= "N";
   } else {mf[6]= "Y"};
   
  
   
   //alert(mf[6]);
   //return null;
    
       
    //document.body.style.cursor = "wait";
    //showwait(); 
   
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
    http.onreadystatechange = saveprojdetailResponce;
    http.send(null);	
	
	
}

function saveprojdetailResponce(){

  if (http.readyState == 4) {

    results = http.responseText.split("|");
    //alert(http.responseText);
    var begblock=parseInt(results[0]);
    var endblock=parseInt(results[1]);
    if (begblock < endblock){
        saveprojdetail(results[0],results[1],results[2]);    
    } else { 
	   //hidewait();
       //document.body.style.cursor='auto';
       
       //comment to change it to close edit on save
       if (trim(document.getElementById('proj_dtfinished').value)=='' && trim(document.getElementById('proj_sprecnum').value) !='' && trim(document.getElementById('proj_status').value) !='Cancelled'){
          setprojpdf('PDF');
          getsprojrec();    
       } else {
	      hideprojed(); 
          getprojrec();
       }
      
    }   
    
  } //end of responce listener
}

	
function hideshowln(){
	
	if (document.getElementById('proj_openbox').checked == false && document.getElementById('proj_showfinishedbox').checked == false) {	
	  document.getElementById('uplayer').style.visibility = "visible"; 
	  document.getElementById('downlayer').style.visibility = "visible";
	  document.getElementById('toplayer').style.visibility = "visible"; 
	  document.getElementById('bottomlayer').style.visibility = "visible"; 
	  <!--document.getElementById('resortlayer').style.visibility = "visible";-->
	  document.getElementById('movetolayer').style.visibility = "visible"; 
	  document.getElementById('movetolayer2').style.visibility = "visible"; 
	} 
	
    if (document.getElementById('proj_openbox').checked == true || document.getElementById('proj_showfinishedbox').checked == true) {	

	  document.getElementById('uplayer').style.visibility = "hidden"; 
	  document.getElementById('downlayer').style.visibility = "hidden";
	  document.getElementById('toplayer').style.visibility = "hidden"; 
	  document.getElementById('bottomlayer').style.visibility = "hidden"; 
	  <!--document.getElementById('resortlayer').style.visibility = "hidden"; -->
	  document.getElementById('movetolayer').style.visibility = "hidden";
	  document.getElementById('movetolayer2').style.visibility = "hidden"; 
	}	
	
}	


function closeproj(){
  //alert("close the project");
  var errmsg="";
	
	if (trim(document.getElementById('proj_dtin').value)==""){
		errmsg="<br>You must have an date in defined before you can close this project.";
    }
    	
	if (trim(document.getElementById('proj_desc').value)==""){
		errmsg=errmsg+"<br>Please enter a description of the project<br>before you can close this project.<br>";
    }
        
    if (trim(document.getElementById('proj_detail').value)==""){
		errmsg=errmsg+"<br>Please enter a detailed description of the <br>project before you can close this project.<br>";
    }
    
    //alert(errmsg); 
    if (trim(errmsg) !=""){
	   //alert(errmsg); 
	   document.getElementById('projmsgtext').innerHTML=errmsg;
       showprojmsg();  
	   return null;
    }
    
    var today = new Date();
	var Year = takeYear(today);
	var Month = today.getMonth()+1;
	if (Month < 10){Month='0'+Month};
	var Day = today.getDate();
	
	if (trim(document.getElementById('proj_dtin').value)==""){document.getElementById('proj_dtin').value=Month+'/'+Day+'/'+Year;};
    if (trim(document.getElementById('proj_dtstarted').value)==""){document.getElementById('proj_dtstarted').value=Month+'/'+Day+'/'+Year;};
    if (trim(document.getElementById('proj_dtfinished').value)==""){document.getElementById('proj_dtfinished').value=Month+'/'+Day+'/'+Year;};
    if (trim(document.getElementById('proj_dttarget').value)==""){document.getElementById('proj_dttarget').value=Month+'/'+Day+'/'+Year;};
    
    document.getElementById('proj_status').selectedIndex=3;

    //send email 
    projemail('close');
  		
}

function projemail(mtype){

	var tkurl = "includes/php/proj_email_process.php?usession="; // The server-side script
    //alert('in email');
    me = new Array();
   
    me[0]=mtype; //email info
    
     if (trim(document.getElementById('proj_status').value)=='Finished'){
       me[1]=trim(document.getElementById('projwhofilter').value)+" completed project: "+trim(document.getElementById('proj_desc').value);     
       me[2]="This project is completed.";
       
     } else if (mtype=='edit') { 
    
       me[1]=trim(document.getElementById('projwhofilter').value)+" modified existing project: "+trim(document.getElementById('proj_desc').value);     
       me[2]="This project has been modified.";
   
       
     } else {
	     
	   me[1]=trim(document.getElementById('projwhofilter').value)+" added new project: "+trim(document.getElementById('proj_desc').value);      
       me[2]="See project for details.";
	 }    
     
     //me[2]=trim(document.getElementById('proj_detail').value);
     //me[2]=document.getElementById('proj_detail').value.substring(0,1000);
     
     
     me[3]=trim(document.getElementById('projwhofilter').value); 
     
     me[1]=me[1].replace(/\'/g,"zpos");
     me[1]=me[1].replace(/\,/g,"zcomma");
     
     me[2]=me[2].replace(/\,/g,"zcomma");
     me[2]=me[2].replace(/\'/g,"zpos");
     
     for(myKey in mf)
       if(mf.propertyIsEnumerable(myKey)) {
       me[myKey]=me[myKey].replace(/\,/g," ");
       me[myKey]=me[myKey].replace(/\^/g," ");
       me[myKey]=me[myKey].replace(/\|/g," ");
       me[myKey]=me[myKey].replace(/\'/g,"''");
       }
	
    document.body.style.cursor = "wait";
    showwait(); 
   
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(me), true);
    http.onreadystatechange = projemailResponce;
    http.send(null);
    
}

function projemailResponce(){

  if (http.readyState == 4) {

    // Split the delimited response into an array
    results = trim(http.responseText);
    //alert(results);
    
    //could add some error handling here for failed emails-uncomment error trap in php when you do
    hidewait();
    document.body.style.cursor='auto';
    if (results=='close'){
      saveproj();
    } else if (results=='edit'){ 
      saveproj("emailsent"); 
    } else { 
	  saveproj("addit");    
    }        
  }
}


function projmgmtrpt(){

	var tkurl = "includes/php/proj_mgmtpdf.php?usession="; // The server-side script
 
    mpdf = new Array();
   
    mpdf[0]=document.getElementById('uname').value; //manager info
    
    if (document.getElementById('proj_mgmtopenbox').checked == true) {
      mpdf[1]= "N";
    } else {
	  mpdf[1]= "Y";
    }
    
    //mgmtexpand
    var test1 = document.forms['utilform'].mgmtexpand[0].checked;
    var test2 = document.forms['utilform'].mgmtexpand[1].checked;
    
    //alert("condensed:"+test1+"   Expanded:"+test2);
    //return null;
    if (test2==true){
	  mpdf[2]="Y"; //expand notes
	  //alert("expand it");  
    } else {
	  mpdf[2]="N";  
    }
    
    
    document.getElementById('current_pdf').value="projects";
    document.getElementById('pdfid').value=mpdf[0]+"_mgmt";
    
    document.body.style.cursor = "wait";
    showwait(); 
   
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mpdf), true);
    http.onreadystatechange = projmgmtrptResponce;
    http.send(null);
    
}

function projmgmtrptResponce(){

  if (http.readyState == 4) {
    results = http.responseText;
    //alert(results);
    setTimeout("rpdfopen('popup', 640, 480);",600);  
    hidewait();
    document.body.style.cursor='auto';
  }
}

function reassignproj(){
    var tkurl = "includes/php/proj_addeditrec_process.php?usession="; // The server-side script 
    mf = new Array();
 	
	var errmsg="";
	
	if (trim(document.getElementById('proj_dtin').value)==""){
		errmsg="<br>You must have an date in defined.";
    }
    	
	if (trim(document.getElementById('proj_desc').value)==""){
		errmsg=errmsg+"<br>Please enter a description of the project.<br>";
    }
        
    if (trim(document.getElementById('proj_detail').value)==""){
		errmsg=errmsg+"<br>Please enter a detailed description of the project.<br>";
    }
    
          
    if (document.getElementById('projwhofilter2').selectedIndex==0 || document.getElementById('projwhofilter2').selectedIndex==-1){
		errmsg=errmsg+"<br>Please select an employee to re-assign the project to.<br>";
    }
    
    //alert(errmsg); 
    if (trim(errmsg) !=""){
	   //alert(errmsg); 
	   document.getElementById('projmsgtext').innerHTML=errmsg;
       showprojmsg();  
	   return null;
    }
       
    mf[0]='R';
    mf[1]=trim(document.getElementById('proj_sprecnum').value);
    mf[16]=trim(document.getElementById('projwhofilter2').value);
    
    //set reassigned flag so screen will be closed
    if (mf[16].length > 0){document.getElementById('proj_reassigned_flag').value="T"};
    	  
	mf[2]=trim(document.getElementById('projwhofilter').value);
    mf[3]=document.getElementById('proj_dtin').value;
    mf[4]=document.getElementById('proj_dtstarted').value;
    mf[5]=document.getElementById('proj_dtfinished').value;
    mf[6]=document.getElementById('proj_dttarget').value;
       
    mf[7]=document.getElementById('proj_desc').value;
    //mf[8]=document.getElementById('proj_detail').value; 
     
    	
     mf[7]=mf[7].replace(/\'/g,"zpos");
     mf[7]=mf[7].replace(/\,/g,"zcomma");
     
     //mf[8]=mf[8].replace(/\,/g,"zcomma");
     //mf[8]=mf[8].replace(/\'/g,"zpos");
     mf[8]="";
     
     mf[9]=document.getElementById('proj_status').value; 

     
     var today = new Date();
	 var Year = takeYear(today);
	 var Month = today.getMonth()+1;
	 if (Month < 10){Month='0'+Month};
	 var Day = today.getDate();
	
	 mf[17]=Month+'/'+Day+'/'+Year;
   
     var theonemoved=document.forms['utilform'].projselect.selectedIndex;
     document.forms['utilform'].projselect.options[theonemoved] =null; 
     
          
    //build SQL date time stamp from fields
     
    var tempDT=trim(document.getElementById('proj_dtremind').value);
    var targetDT=trim(document.getElementById('proj_dttarget').value);
    
    //test for value in remind field, if not there then substitute the target date. If both are empty then put in target
    if (tempDT.length==0 && targetDT.length != 0) {
	  var tgtemp = new Array();
        tgtemp=targetDT.split("/");
        targetDT=tgtemp[0]+'/'+tgtemp[1]+'/'+tgtemp[2];
        var mtodaycheck=Month+'/'+Day+'/'+Year;       
        if (targetDT !=mtodaycheck) 
	    {  
  	       tempDT=targetDT;
        }
    }
    
    //alert(tempDT.length);
    if (tempDT.length > 0){ 
   	
	    tempdt = new Array();
   	 	tempdt=tempDT.split("/"); 
    
   	 	if (tempdt[1]==null)
    	{
	  		tempdt=tempDT.split("-");  
    	}    
    
    
    	if(tempdt[0].length==1)
    	{
		  tempdt[0]='0'+tempdt[0];
		}  
    
    	if(tempdt[1].length==1)
    	{
		  tempdt[1]='0'+tempdt[1];
		}    
    
		if(tempdt[2].length==2)
    	{
		  tempdt[2]='20'+tempdt[2];
		}    
    
		tempDT=tempdt[0]+"/"+tempdt[1]+"/"+tempdt[2];
	   
    	var aPosition = tempDT.indexOf("/");
    	var secondPos = tempDT.indexOf("/", aPosition + 1);
    
    
        if (aPosition==-1 || secondPos==-1 || tempDT.length < 8){ 
  		    errmsg=errmsg+"<br><br>The reminder date is in the wrong format, use xx/xx/xxxx or xx/xx/xx.";  
		    document.getElementById('projmsgtext').innerHTML=errmsg;
    	    showprojmsg();  
		    return null; 
	    
        } else {
	  
		  	if (tempDT.length == 10){
			  var myear=tempDT.substring((secondPos+1));
    		} else {
			  var myear="20"+tempDT.substring((secondPos+1));
    	  	}    		  
    	  
		  	var mmonth=tempDT.substring(0,aPosition);
		  	var mday=tempDT.substring((aPosition+1),5);
		  	var mhour=document.getElementById('proj_rhour').value;
		  	var mminute=document.getElementById('proj_rminute').value;
		  	var endstr=":00.000";
		  	var newreminddt=myear+"-"+mmonth+"-"+mday+" "+mhour+":"+mminute+endstr;
		  	
    	 	mf[10]=newreminddt; 
    	 	mf[11]=document.getElementById('proj_rtype').value; 
    	 	mf[12]=document.getElementById('proj_rhour').value;
    	 	mf[13]=document.getElementById('proj_rminute').value;
    	 	mf[14]=document.getElementById('proj_rdow').value;
    	 
    
   	  		mf[15]=trim(document.getElementById('proj_rusers').value);
     		//go ahead and change commas to semicolon in case someone used them
     		mf[15]=mf[15].replace(/\,/g,";");
     		//strip last space if it's a semicolon
     		var lastChar=mf[15].length;
     		if (mf[15].substring(lastChar-1,lastChar)==";"){
	     	mf[15]=mf[15].substring(0,lastChar-1);
        	} 	
     	
        	//place null in empty
        	if (mf[15].length==0){mf[15]=""};
        	
            	
   		} //end of error check 
   	    	    
    } else {
	     
	    	mf[10]=" "; 
     		mf[11]="NULL"; 
     		mf[12]="NULL";
     		mf[13]="NULL";
     		mf[14]="NULL";
     		mf[15]=" "; 
	     
    } //end of check for reminder date value    
   
     for(myKey in mf)
       if(mf.propertyIsEnumerable(myKey)) {
       mf[myKey]=mf[myKey].replace(/\,/g," ");
       mf[myKey]=mf[myKey].replace(/\^/g," ");
       mf[myKey]=mf[myKey].replace(/\|/g," ");
       mf[myKey]=mf[myKey].replace(/\'/g,"''");
       }
    //test   
	//alert(mf[0]+"|"+mf[1]+"|"+mf[2]+"|"+mf[3]+"|"+mf[4]+"|"+mf[5]+"|"+mf[6]+"|"+mf[7]+"|"+mf[8]+"|"+mf[9]+"|"+mf[10]+"|"+mf[11]+"|"+mf[12]+"|"+mf[13]+"|"+mf[14]+"|"+mf[15]+"|"+mf[16]);
    document.body.style.cursor = "wait";
    showwait(); 
 
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
    http.onreadystatechange = rprojResponce;
    http.send(null);
    
    
}

function rprojResponce(){

  if (http.readyState == 4) {

    // Split the delimited response into an array
    
    results = http.responseText.split('|');
    
    //alert(results);
    //hidewait();
    //document.body.style.cursor='auto';
    //return null;
    
    var sizeofdetail=0;
    var tempdetailstr="";  
    tempdetailstr=trim(document.getElementById('proj_detail').value);  
    sizeofdetail=tempdetailstr.length;
    
    saveprojdetail(0,sizeofdetail,results[2]);   
    
    
   
  }
}

function setprojpdf(btntoshow){
	
	
	if (btntoshow==="PDF"){
       document.getElementById('projPDFbtn').style.visibility='visible';
       document.getElementById('projsavebtn').style.visibility='hidden';
    } else {
	   document.getElementById('projPDFbtn').style.visibility='hidden';
       document.getElementById('projsavebtn').style.visibility='visible';      
    }
    
    checkreminder(); 
     
}	

function checkreminder(){

	var fieldchk=trim(document.getElementById('proj_rtype').value);
	//stupid popup will not fire this, grrr!-cant's use to hide show all options
	if (fieldchk=="7"){ 
    	document.getElementById('reminddow').style.visibility='visible';
    } else {	   	
	   	document.getElementById('reminddow').selectedIndex=-1;
        document.getElementById('reminddow').style.visibility='hidden';
    }
}	


function getEmailUsers(){
  var tkurl = "includes/php/proj_getemailusers_process.php?usession="; // The server-side script
  var mrecord = "";

  mf = new Array();
  mf[0]= "A";
  
  document.body.style.cursor = "wait";
  showwait(); 
  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
  http.onreadystatechange = getEmailUsersResponce;
  http.send(null);

}

function getEmailUsersResponce(){

  if (http.readyState == 4) {

    // Split the delimited response into an array
    //alert(http.responseText);
    results = http.responseText.split("|");
    
    document.forms['utilform'].proj_rusersel.options.length = 0;
    document.forms['utilform'].proj_rusersel.options[0] = new Option("Select User","",true,false);
    var xy=1;  
    for (x in results)
    {   
     document.forms['utilform'].proj_rusersel.options[xy] = new Option(results[x],results[x],true,false);
     xy=(xy+1);
    } // end of loop
     
    hidewait();
    document.body.style.cursor='auto';
    
    
  }
}


function addEmailUser(){

	var newsel=document.forms['utilform'].proj_rusersel.options.selectedIndex;
	var usershold=document.getElementById('proj_rusers').value;

	if (newsel !=-1){
	    document.getElementById('proj_rusers').value=document.forms['utilform'].proj_rusersel.options[newsel].value+";"+usershold;
	}
	 
	return null
     
}
//function for getting tickets for the main ticket section
function tkCTKResponse() {

  if (http.readyState == 4) {
 
	hidewait();
    document.body.style.cursor='auto';  
    
    // Split the delimited response into an array
    //alert(http.responseText);
    results = http.responseText.split("^");
    var errtest=http.responseText;
    
    if (errtest.indexOf("Fatal error") > -1) {

	   document.forms['ticketform'].tkselectMain.selectedIndex=-1;
       document.getElementById('confirmtext').innerHTML=errtest;
       showconfirm(); 
       //alert("Unable to open joblog, please report immediately, please report immediately.");
       showSec(1);
       
    } 
    
    r1= new Array();
    document.forms['ticketform'].tkselectMain.options.length = 0;
    
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
        if (document.getElementById("ucoid").value=='CIS'){    
          r1[1]=r1[1].charAt(5)+r1[1].charAt(6)+"/"+r1[1].charAt(8)+r1[1].charAt(9)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
          r1[2]=r1[2].charAt(5)+r1[2].charAt(6)+"/"+r1[2].charAt(8)+r1[2].charAt(9)+"/"+r1[2].charAt(2)+r1[2].charAt(3);
        
        } else { 
     
          //this is for fox
          if (r1[1].charAt(1) =="/"){
            if (parseInt(r1[1].charAt(0)) < 10) {r1[1]="0" + r1[1]};
          }
          if (r1[2].charAt(1) =="/"){
            if (parseInt(r1[2].charAt(0)) < 10) {r1[2]="0" + r1[2]};
          }
 
          //this is for fox
          if (r1[1].charAt(4) =="/"){
            if (parseInt(r1[1].charAt(3)) < 10) {r1[1]=r1[1].substring(0,3)+"0" + r1[1].substring(3,9)};
          }
          if (r1[2].charAt(4) =="/"){
            if (parseInt(r1[2].charAt(3)) < 10) {r1[2]=r1[2].substring(0,3)+"0" + r1[2].substring(3,9)};
          }

          r1[1]=r1[1].substring(0,5)+"/"+r1[1].charAt(8)+r1[1].charAt(9);
          r1[2]=r1[2].substring(0,5)+"/"+r1[2].charAt(8)+r1[2].charAt(9);

          // if the value is 12:00  
          if (r1[2].substring(0,5) =="12:00") { r1[2] = "" };

        } //end of cis check  

       // pad out the elements for table if individual elements not null
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',7)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',9)};
       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',9)};
       if (r1[3] != undefined){r1[3] = padRight(r1[3],' ',26)};
       if (r1[4] != undefined){r1[4] = padRight(r1[4],' ',7)};
       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',26)};
       if (r1[6] != undefined){r1[6] = padRight(r1[6],' ',11)};
       if (r1[7] != undefined){r1[7] = padRight(r1[7],' ',9)};
       if (r1[8] != undefined){r1[8] = padRight(r1[8],' ',10)};
       
       document.forms['ticketform'].tkselectMain.options[x] = new Option(r1[0]+r1[1]+r1[2]+r1[3]+r1[5]+r1[7]+r1[8]+r1[4],r1[0],true,false);
      }  

    }

    if (document.forms['ticketform'].tkselectMain.options.length == 0) {
      if (document.getElementById('tkopentkbox').checked == true) {
        document.forms['ticketform'].tkselectMain.options[x] = new Option("No orders found.   NOTE: Open jobs only selection box is checked.",'true');
      } else { 
        document.forms['ticketform'].tkselectMain.options[x] = new Option("No orders found.",'true');
      }
    }

var newnumbertk=(results.length-1);

if (results.length < 1000){
  document.getElementById('opentknum').innerHTML="Search Results-"+newnumbertk;
} else {
  document.getElementById('opentknum').innerHTML="The results exceeded 1000, 1st 999 shown. ";
}

uncheckoth('6');
document.getElementById('tksid').value="";
document.getElementById('tkselectMain').style.visibility =  "visible";

document.getElementById('tkrptselect').style.visibility =  "visible";
document.getElementById('tkwhofilter').style.visibility =  "visible";
document.getElementById('tkclientfilter').style.visibility = "visible";
document.getElementById('tktypefilter').style.visibility =  "visible";


gettodaytkcnt();
 
//hidewait();
//document.body.style.cursor='auto';

    //if there is only one ticket
    //if (newnumbertk==1){
    //   document.forms['ticketform'].tkselectMain.selectedIndex=0;
    //   tkSingleCtk();  
    //}


  }
}

function tkCTK(mtype) {
  var tkurl = "includes/php/tk_get_tk_process_fox.php?usession="; // The server-side script
  var mrecord = "";

  mf = new Array();
 
  var tmpnum1 = document.forms['ticketform'].tkclientfilter.selectedIndex;
  var tmpnum2 = document.forms['ticketform'].tktypefilter.selectedIndex;
  var tmpnum3 = document.forms['ticketform'].tkwhofilter.selectedIndex;

  if (document.getElementById('tkopentkbox').checked == false) {
      mf[0]= "N";
  } else {mf[0]= "Y"};

  if (tmpnum1 > 0) {
    mf[1] = document.forms['ticketform'].tkclientfilter.options[tmpnum1].value;
  } else {
    mf[1] =""; 
  }

  if (tmpnum2 > 0) {
    mf[2] = document.forms['ticketform'].tktypefilter.options[tmpnum2].value;
  } else {
    mf[2] =""; 
  }

  if  (trim(mf[2])=="A") {
    mf[2] ="";
    mf[0]= "Y";
    document.getElementById('tkopentkbox').checked = true;
  } 

  if (tmpnum3 > 0) {
    mf[3] = document.forms['ticketform'].tkwhofilter.options[tmpnum3].value;
  } else {
    mf[3] =""; 
  }
    
  mf[4] = document.getElementById('tkdt1').value;
  mf[5] = document.getElementById('tkdt2').value;
  mf[6] = document.getElementById('tksdesc').value;
  mf[7] = document.getElementById('tksid').value;
  var testnum=isNumeric(mf[7]);
  //alert(mtype);
  if (testnum === null && mtype=='job'){
	 alert('Invalid format, Job number must be numeric.    ');
	 return null; 	  
  }	    


  if (mtype=='po'){
    mf[8] = 'getpo';
  } else {
    mf[8]='';	  
  }	  
  //alert(mf[4]);
  
   // mf[p]=title for pdf
    var tmpnum1 = document.forms['ticketform'].tkclientfilter.selectedIndex;
    var tmpnum2 = document.forms['ticketform'].tktypefilter.selectedIndex;
    var tmpnum3 = document.forms['ticketform'].tkwhofilter.selectedIndex;

    var mtitle="";
    var tcnt=9;
    if (tmpnum1 > 0) {
      mf[tcnt]="Client = "+trim(document.forms['ticketform'].tkclientfilter.options[tmpnum1].text)+"   ";
      tcnt=(tcnt+1);
    }
     
    if (tmpnum2 > 0) {
      mf[tcnt]="Type = "+trim(document.forms['ticketform'].tktypefilter.options[tmpnum2].text)+"   ";
      tcnt=(tcnt+1);
    } 
   
    if (tmpnum3 > 0) {
      mf[tcnt]="Dept = "+trim(document.forms['ticketform'].tkwhofilter.options[tmpnum3].text)+"   ";
      tcnt=(tcnt+1);
    } 
    
    var dt1 = document.getElementById('tkdt1').value;
    var dt2 = document.getElementById('tkdt2').value;
    if  (trim(dt1)!="" && trim(dt2)!="") {
      mf[tcnt]="Dates = "+trim(dt1)+" To "+trim(dt2)+"    ";
      tcnt=(tcnt+1);
    }  
  
    if  (trim(document.getElementById('tksdesc').value)!="") {
      mf[tcnt]="Desc = "+trim(document.getElementById('tksdesc').value)+"    ";
      tcnt=(tcnt+1);
    }   
    
    if (document.getElementById('tkopentkbox').checked != false) {
      mf[tcnt]="Incl Only Open Tickets    ";
      tcnt=(tcnt+1);
    }
     
    //mf[9]=trim(mtitle);
  
  //added this to enable pdf's
  document.getElementById('current_pdf').value="tkscr";
  document.getElementById('pdfid').value=mf[0]+"_user";
  
  document.body.style.cursor = "wait";
  showwait();  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mf), true);
  http.onreadystatechange = tkCTKResponse;
  http.send(null);

}


function tkSingleCtk(movenumber) {
//alert('in single ticket');
//return null;
  var midValue =""; 
  var checkfornumber=document.forms['ticketform'].tkselectMain.options[0].text; 
  checkfornumber=checkfornumber.substring(0,1);


  if (checkfornumber !="N") {
    
    document.getElementById('tk_stkNewCUST_ID').value ='';
    resetTKFieldColors();
    setTKEditNo();
    var userurl = "includes/php/tk_get_singletk_process_fox.php?mid="; // The server-side script
    var mindex = document.forms['ticketform'].tkselectMain.selectedIndex;
    if (movenumber){
	   midValue = trim(document.getElementById('tk_stkJOB_ID').value);
    } else {     
       midValue = document.forms['ticketform'].tkselectMain.options[mindex].text;
    }   
    //alert(midValue);
    midValue=midValue.substring(0,6);
    midValue=trim(midValue);
    //alert(midValue);
    //return null;
    
    document.body.style.cursor = "wait";
    showwait();  
 
    var usession = getmsession();
    http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = tkSinglectkResponse;
    http.send(null);

  } else {
     document.forms['ticketform'].tkselectMain.selectedIndex=-1;
     document.getElementById('confirmtext').innerHTML="No orders found.";
     showconfirm();

  }


}

function tkSinglectkResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array
    //alert(http.responseText);
    results = http.responseText.split("^");
    r1= new Array();
//if (document.getElementById('ucoid').value=="CDS"){
//alert(results);
//}
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
       if (document.getElementById("ucoid").value=='CIS'){    
      
	     //took out the next 4 SQL -fox converted dates to display
         r1[1]=r1[1].charAt(5)+r1[1].charAt(6)+"/"+r1[1].charAt(8)+r1[1].charAt(9)+"/"+r1[1].charAt(2)+r1[1].charAt(3);
         r1[2]=r1[2].charAt(5)+r1[2].charAt(6)+"/"+r1[2].charAt(8)+r1[2].charAt(9)+"/"+r1[2].charAt(2)+r1[2].charAt(3);
         r1[7]=r1[7].charAt(5)+r1[7].charAt(6)+"/"+r1[7].charAt(8)+r1[7].charAt(9)+"/"+r1[7].charAt(2)+r1[7].charAt(3);
         r1[25]=r1[25].charAt(5)+r1[25].charAt(6)+"/"+r1[25].charAt(8)+r1[25].charAt(9)+"/"+r1[25].charAt(2)+r1[25].charAt(3);
  
	    if (trim(r1[1])=='00/00/00'){r1[1]=' '};
        if (trim(r1[2])=='00/00/00'){r1[2]=' '};
	    if (trim(r1[7])=='00/00/00'){r1[7]=' '};  
	    if (trim(r1[25])=='00/00/00'){r1[25]=' '};  
	    if (trim(r1[1])=='//'){r1[1]=' '};
        if (trim(r1[2])=='//'){r1[2]=' '};
	    if (trim(r1[7])=='//'){r1[7]=' '};  
	    if (trim(r1[25])=='//'){r1[25]=' '};  
	       
      	} else { 
	      
     		//this is for fox
      		if (r1[1].charAt(1) =="/"){
      		  if (parseInt(r1[1].charAt(0)) < 10) {r1[1]="0" + r1[1]};
      		}
      		if (r1[2].charAt(1) =="/"){
      		  if (parseInt(r1[2].charAt(0)) < 10) {r1[2]="0" + r1[2]};
      		}
 
      		if (r1[7].charAt(1) =="/"){
      		  if (parseInt(r1[7].charAt(0)) < 10) {r1[7]="0" + r1[7]};
      		}
      		if (r1[25].charAt(1) =="/"){
      		  if (parseInt(r1[25].charAt(0)) < 10) {r1[25]="0" + r1[25]};
      		}
 
	  		if (r1[1].charAt(4) =="/"){
      		  if (parseInt(r1[1].charAt(3)) < 10) {r1[1]=r1[1].substring(0,3)+"0" + r1[1].substring(3,9)};
      		}
      		if (r1[2].charAt(4) =="/"){
       		 if (parseInt(r1[2].charAt(3)) < 10) {r1[2]=r1[2].substring(0,3)+"0" + r1[2].substring(3,9)};
      		}
  	
      		if (r1[7].charAt(4) =="/"){
      		  if (parseInt(r1[7].charAt(3)) < 10) {r1[7]=r1[7].substring(0,3)+"0" + r1[7].substring(3,9)};
      		}
      		if (r1[25].charAt(4) =="/"){
      		  if (parseInt(r1[25].charAt(3)) < 10) {r1[25]=r1[2].substring(0,3)+"0" + r1[25].substring(3,9)};
      		}

      		r1[1]=r1[1].substring(0,5)+"/"+r1[1].charAt(8)+r1[1].charAt(9);
      		r1[2]=r1[2].substring(0,5)+"/"+r1[2].charAt(8)+r1[2].charAt(9);
      		r1[7]=r1[7].substring(0,5)+"/"+r1[7].charAt(8)+r1[7].charAt(9);
      		r1[25]=r1[25].substring(0,5)+"/"+r1[25].charAt(8)+r1[25].charAt(9);
      		
	    }//end of cis check
      
      	
       // post elements
     
      if (r1[0].substring(0,6) !="Object") {document.getElementById('tk_stkJOB_ID').value = trim(r1[0])} else {document.getElementById('tk_stkJOB_ID').value =""};
      if (r1[1].substring(0,6) !="Object") {document.getElementById('tk_stkDATE_IN').value = trim(r1[1])} else {document.getElementById('tk_stkDATE_IN').value =""};
      if (r1[2].substring(0,6) !="Object") {document.getElementById('tk_stkDATE_DUE').value = trim(r1[2])} else {document.getElementById('tk_stkDATE_DUE').value =""};
      if (r1[3].substring(0,6) !="Object") {document.getElementById('tk_stkCUSTOMER').value = trim(r1[3])} else {document.getElementById('tk_stkCUSTOMER').value =""};
    
      //r1[4] IS type field 
      var mz3 = document.forms['ticketform'].tktypeselect.options.length;
      mz3=mz3-1;
      r1[4] = trim(r1[4]);
       if (r1[4] !="Object") 
       {
        for (var i = 0; i < document.forms['ticketform'].tktypeselect.options.length; i++) 
        {

            if (document.forms['ticketform'].tktypeselect.options[i].value==r1[4])
           {
              document.forms['ticketform'].tktypeselect.options[i].selected = true;
           }
        }

       } else {document.forms['ticketform'].tktypeselect.options[mz3].selected = true};

      if (r1[4].substring(0,1) == " ") {document.forms['ticketform'].tktypeselect.options[mz3].selected = true};
      //end of type select


      if (r1[5].substring(0,6) !="Object") {
	      r1[5]=r1[5].toUpperCase(); 
	      document.getElementById('tk_stkORDERDESC').value = trim(r1[5]);
	  } else {
		  document.getElementById('tk_stkORDERDESC').value ="";
	  }
      if (r1[6].substring(0,6) !="Object") {document.getElementById('tk_stkPO').value = trim(r1[6])} else {document.getElementById('tk_stkPO').value=""};
 
      if (r1[7].substring(0,6) !="Object") {document.getElementById('tk_stkDATE_DONE').value = trim(r1[7])} else {document.getElementById('tk_stkDATE_DONE').value =""};
 
      // if the value is 12:00  
      if (r1[7].substring(0,5) =="12:00") {document.getElementById('tk_stkDATE_DONE').value =""};
      if (r1[2].substring(0,5) =="12:00") {document.getElementById('tk_stkDATE_DUE').value =""};
     


      if (r1[8].substring(0,6) !="Object") {document.getElementById('tk_stkCUST_ID').value = trim(r1[8])} else {document.getElementById('tk_stkCUST_ID').value =""};
      //document.getElementById('tk_stkVPID').value = r1[9];
      //document.getElementById('tk_stkOLD_CUST').value = r1[10];
      if (r1[11].substring(0,6) !="Object") {document.getElementById('tk_stkAMOUNT').value = trim(r1[11])} else {document.getElementById('tk_stkAMOUNT').value =""};
      if (r1[12].substring(0,6) !="Object") {document.getElementById('tk_stkSHIPPING').value = trim(r1[12])} else {document.getElementById('tk_stkSHIPPING').value =""};
      //document.getElementById('tk_stkWEEKNO').value = r1[13];
      if (r1[14].substring(0,6) !="Object") {document.getElementById('tk_stkCONTACT').value = trim(r1[14])} else {document.getElementById('tk_stkCONTACT').value =""};

      //r1[15] IS type cis1 
      var mz3 = document.forms['ticketform'].tkcis1select.options.length;
      mz3=mz3-1;
      r1[15] = trim(r1[15]);
       if (r1[15] !="Object") 
       {
        for (var i = 0; i < document.forms['ticketform'].tkcis1select.options.length; i++) 
        {

            if (document.forms['ticketform'].tkcis1select.options[i].value==r1[15])
           {
              document.forms['ticketform'].tkcis1select.options[i].selected = true;
           }
        }

       } else {document.forms['ticketform'].tkcis1select.options[mz3].selected = true};

      if (r1[15].substring(0,1) == " ") {document.forms['ticketform'].tkcis1select.options[mz3].selected = true};
      //end of cis1 select


      //document.getElementById('tk_stkCIS2').value = r1[16];
      //document.getElementById('tk_stkCIS3').value = r1[17];
  
      //r1[18] IS type who 
      var mz3 = document.forms['ticketform'].tkwhoselect.options.length;
      mz3=mz3-1;
      r1[18] = trim(r1[18]);
       if (r1[18] !="Object") 
       {
        for (var i = 0; i < document.forms['ticketform'].tkwhoselect.options.length; i++) 
        {

            if (document.forms['ticketform'].tkwhoselect.options[i].value==r1[18])
           {
              document.forms['ticketform'].tkwhoselect.options[i].selected = true;
           }
        }

       } else {document.forms['ticketform'].tkwhoselect.options[mz3].selected = true};

      if (r1[18].substring(0,1) == " ") {document.forms['ticketform'].tkwhoselect.options[mz3].selected = true};
      //end of who select





//********* important ************
// php adodb lib is dellivering a negative 1 for true and 0 for false, when saved 
// in fox the negative 1 must be saved as a positive 1.

 
       r1[19]=trim(r1[19]);
       // 19 is Y/N for DP
       if (r1[19].substring(0,6) !="Object") {
         if (r1[19] == -1) {
           document.getElementById("tk_stkDPbox").checked = true;
         } else {document.getElementById('tk_stkDPbox').checked = false};

       } else {document.getElementById('tk_stkDPbox').checked = false};
  
       // 20 is Y/N for lasering
       if (r1[20].substring(0,6) !="Object") {
         if (r1[20] == -1) {
           document.getElementById("tk_stkLASERINGbox").checked = true;
         } else {document.getElementById('tk_stkLASERINGbox').checked = false};

       } else {document.getElementById('tk_stkLASERINGbox').checked = false};
      
      // 21 is Y/N for OCCUPANT
       if (r1[21].substring(0,6) !="Object") {
         if (r1[21] == -1) {
           document.getElementById("tk_stkOCCUPANTbox").checked = true;
         } else {document.getElementById('tk_stkOCCUPANTbox').checked = false};

       } else {document.getElementById('tk_stkOCCUPANTbox').checked = false};

      document.getElementById('tk_stkDATA_ENTRYbox').value = r1[22];
      // 22 is Y/N for Data Entry
       if (r1[22].substring(0,6) !="Object") {
         if (r1[22] == -1) {
           document.getElementById("tk_stkDATA_ENTRYbox").checked = true;
         } else {document.getElementById('tk_stkDATA_ENTRYbox').checked = false};

       } else {document.getElementById('tk_stkDATA_ENTRYbox').checked = false};

      // 23 is Y/N for Maps
       if (r1[23].substring(0,6) !="Object") {
         if (r1[23] == -1) {
           document.getElementById("tk_stkMAPSbox").checked = true;
         } else {document.getElementById('tk_stkMAPSbox').checked = false};

       } else {document.getElementById('tk_stkMAPSbox').checked = false};

      if (r1[24].substring(0,6) !="Object") {document.getElementById('tk_stkQUANTITY').value = trim(r1[24])} else {document.getElementById('tk_stkQUANTITY').value =""};


      if (r1[25].substring(0,6) !="Object") {document.getElementById('tk_stkINV_DATE').value = trim(r1[25])} else {document.getElementById('tk_stkINV_DATE').value =""};
      if (r1[25].substring(0,5) =="12:00") {document.getElementById('tk_stkINV_DATE').value =""};
     

      //document.getElementById('tk_stkSALESPER').value = r1[26];
      //document.getElementById('tk_stkSALESPERNO').value = r1[27];
      if (r1[28].substring(0,6) !="Object") { document.getElementById('tk_stkARMS_ORD').value = trim(r1[28])} else {document.getElementById('tk_stkARMS_ORD').value =""};
      if (r1[29].substring(0,6) !="Object") { document.getElementById('tk_stkARMS_JOB').value = trim(r1[29])} else {document.getElementById('tk_stkARMS_JOB').value =""};
      document.getElementById('tk_stknotes').value = trim(r1[30]);

      //invoice status
      document.getElementById('tk_hasinvoice').value = trim(r1[31]);
      document.getElementById('tk_isposted').value = trim(r1[32]);
      if (r1[31] == "N") {
        document.getElementById('invbuttxt').innerHTML ="Build Inv";
      } else {
	    document.getElementById('invbuttxt').innerHTML ="Edit Inv";  
      }          
      
     }  

    }

document.forms['ticketform'].tkselectMain.selectedIndex=-1;
 
//hidewait();
//document.body.style.cursor='auto';
//showtk_stk();

//alert(document.getElementById('tk_stkJOB_ID').value);
//return void
//if this returns error getting po check the invline & invoices for corrupt.

getpos();

  }
}


function gettodaytkcntResponse() {

  if (http.readyState == 4) {

	hidewait();
    document.body.style.cursor='auto';
    
    //alert(http.responseText);
    // Split the delimited response into an array
    results = http.responseText.split("|");
    document.getElementById('tkstats').innerHTML=results[1]+"/"+results[0];


    
    

  }
}



function gettodaytkcnt(){
  var todaytkurl = "includes/php/tk_todaycnt_fox.php?usession="; // The server-side script    
  document.body.style.cursor = "wait";
  showwait();  
  var usession = getmsession();
  http.open("GET", todaytkurl + escape(usession), true);
  http.onreadystatechange = gettodaytkcntResponse;
  http.send(null);

}

function tkscrPDF_notused(){
    
	if (document.forms['ticketform'].tkselectMain.options.length <=1){
   	  alert('There no data for a report, please build a filtered list of more than one ticket to print.   ');
	  return null;
    } else {  
	  document.body.style.cursor = "wait";
      showwait();    
    }    //end of test for tks
    
	var tkurl = "includes/php/tkscr_pdf.php?usession="; // The server-side script
     
    mf = new Array();
    mf[0]=trim(document.getElementById('uname').value);
     
    // mf[1]=title
    var tmpnum1 = document.forms['ticketform'].tkclientfilter.selectedIndex;
    var tmpnum2 = document.forms['ticketform'].tktypefilter.selectedIndex;
    var tmpnum3 = document.forms['ticketform'].tkwhofilter.selectedIndex;

    var mtitle="";
   
    if (tmpnum1 > 0) {
      mtitle=mtitle+"\nClient = "+document.forms['ticketform'].tkclientfilter.options[tmpnum1].text+"   ";
    }
     
    if (tmpnum2 > 0) {
      mtitle=mtitle+"\nType = "+document.forms['ticketform'].tktypefilter.options[tmpnum2].text+"   ";
    } 
   
    if (tmpnum3 > 0) {
      mtitle=mtitle+"\nDept = "+document.forms['ticketform'].tkwhofilter.options[tmpnum3].text+"   ";
    } 
    
    var dt1 = document.getElementById('tkdt1').value;
    var dt2 = document.getElementById('tkdt2').value;
    if  (trim(dt1)!="" && trim(dt2)!="") {
      mtitle=mtitle+"\nDates = "+trim(dt1)+" To "+trim(dt2)+"    ";
    }  
  
    if  (trim(document.getElementById('tksdesc').value)!="") {
      mtitle=mtitle+"\nDesc = "+trim(document.getElementById('tksdesc').value)+"    ";
    }   
    
    if (document.getElementById('tkopentkbox').checked != false) {
      mtitle=mtitle+"\nIncl Only Open Tickets    ";
    }
     
    mf[1]=trim(mtitle);
    
    var zcnt=0;
    var mfcnt=2;
    
    while (zcnt < document.forms['ticketform'].tkselectMain.options.length){
	    
	  mf[mfcnt]=document.forms['ticketform'].tkselectMain.options[zcnt].value;
	      
	  zcnt=(zcnt+1);
	  mfcnt=(mfcnt+1);  
	    
    }    
    
    alert(mf[1]);
    //return null;
    
    document.getElementById('current_pdf').value="tkscr";
    document.getElementById('pdfid').value=mf[0]+"_user";
    
      
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = tkscrPDFResponce;
    http.send(null);
 

}

function tkscrPDFResponce_notused(){

  if (http.readyState == 4) {
	
    var mmes=http.responseText;
    
    //alert(http.responseText);
    
	hidewait();
    document.body.style.cursor='auto';
    rpdfopen('popup', 640, 480);

  }
}

//had to have pdf build with screen because too large to feed without chunking
function tkscrPDF(){
	
   //added this to enable pdf's
   document.getElementById('current_pdf').value="tkscr";
   document.getElementById('pdfid').value=trim(document.getElementById('uname').value)+"_user";
   rpdfopen('popup', 640, 480);

}


function tkchkmove() {
	
  var tkurl = "includes/php/tk_chk_move_process_fox.php?usession="; // The server-side script 
    mf = new Array();
    mf[0]=trim(document.getElementById('tk_stkJOB_ID').value);
    mf[1]=trim(document.getElementById('tk_stkNewCUST_ID').value);
    if (trim(mf[1])==''){
      document.getElementById('errorcnt').innerHTML="<br><br>You must put in a new customer ID number to move the ticket to.";
      showemsg();
      return null;
    }
    
    document.body.style.cursor = "wait";
    showwait();  
 
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mform=" + escape(mf), true);
    http.onreadystatechange = tkchkmoveResponse;
    http.send(null);
  
}

function tkchkmoveResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array
    results = http.responseText;
    //alert(results);
    if (results.indexOf("Error:") > -1){ 
	   
	   alert(results);
	   document.getElementById('tk_stkNewCUST_ID').value ='';
	   hidewait();
       document.body.style.cursor='auto';
	    
    } else {
	  hidewait();
      document.body.style.cursor='auto'; 
	  showpassscr(results,"movetheticket");
	  
    }
    

    
  }
}

function movetheticket(){
	
	hideyesno();
	var tkurl = "includes/php/tk_move_process_fox.php?usession="; // The server-side script 
    mf = new Array();
    mf[0]=trim(document.getElementById('tk_stkJOB_ID').value);
    mf[1]=trim(document.getElementById('tk_stkNewCUST_ID').value);
    mf[2]=trim(document.getElementById('tk_stkCUST_ID').value);
    if (trim(mf[1])==''){
      document.getElementById('errorcnt').innerHTML="<br><br>Error, try again.";
      showemsg();
      return null;
    }
    
    document.body.style.cursor = "wait";
    showwait();  
 
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mform=" + escape(mf), true);
    http.onreadystatechange = movetheticketResponse;
    http.send(null);
  
}

function movetheticketResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array
    results = http.responseText;
    
    if (results.indexOf("Error:") > -1){ 
	   
	   alert(results);
	   document.getElementById('tk_stkNewCUST_ID').value ='';
	   hidewait();
       document.body.style.cursor='auto';
	    
    } else {
	    
	  alert(results); 
	             
      hidewait();
      document.body.style.cursor='auto';
      document.getElementById('tk_stkNewCUST_ID').value ='';
      tkSingleCtk(trim(document.getElementById('tk_stkJOB_ID').value));
    }
    

    
  }
}
	
	
	
function setTKEditNo() {
  document.getElementById('voidbtn').style.visibility = "hidden";		
  document.getElementById('tksavebtn').style.visibility = "hidden";
  document.getElementById('tkinvbtn').style.visibility = "hidden";
  document.getElementById('tkpobtn').style.visibility = "hidden";
  document.getElementById('clsjobbtn').style.visibility = "hidden";
  document.getElementById('tkmoveid').style.visibility = "hidden";
  
  document.getElementById('tkeditbtn').style.visibility = "visible";
  document.getElementById('tkviewinvbtn').style.visibility = "visible";
  
  //set ticket screen as readonly - need to lock all of customers tickets because some of relvant information
  //could be changed and the build etc would creat a bogus record
  document.getElementById('tk_EditEnabled').value="N";
  document.getElementById('tk_stkDPbox').disabled =true;
  document.getElementById('tk_stkLASERINGbox').disabled =true;
  document.getElementById('tk_stkOCCUPANTbox').disabled =true;
  document.getElementById('tk_stkDATA_ENTRYbox').disabled =true;
  document.getElementById('tk_stkMAPSbox').disabled =true;
  
  document.getElementById('tk_stkJOB_ID').readOnly =true; 
  document.getElementById('tk_stkCUSTOMER').readOnly =true;
  document.getElementById('tk_stkCUST_ID').readOnly =true; 
  
  document.getElementById('tk_stkORDERDESC').readOnly =true;
  document.getElementById('tk_stkPO').readOnly =true;
  document.getElementById('tk_stkCONTACT').readOnly =true;
  document.getElementById('tk_stkDATE_IN').readOnly =true;
  document.getElementById('tk_stkDATE_DUE').readOnly =true;
  document.getElementById('tk_stkDATE_DONE').readOnly =true;
  document.getElementById('tk_stkINV_DATE').readOnly =true;
  document.getElementById('tk_stkDATE_IN').readOnly =true;
  document.getElementById('tk_stkDATE_DUE').readOnly =true;
  document.getElementById('tk_stkDATE_DONE').readOnly =true;
  document.getElementById('tk_stkINV_DATE').readOnly =true;
  document.getElementById('tktypeselect').disabled =true;
  document.getElementById('tkwhoselect').disabled =true;
  document.getElementById('tkcis1select').disabled =true;
  document.getElementById('tk_stkARMS_ORD').readOnly =true;
  document.getElementById('tk_stkARMS_JOB').readOnly =true;
  document.getElementById('tk_stkQUANTITY').readOnly =true;
  document.getElementById('tk_stkAMOUNT').readOnly =true;
  document.getElementById('tk_stkSHIPPING').readOnly =true;
  document.getElementById('tk_stknotes').readOnly =true 

}

function setTKEditYes() {
  document.getElementById('voidbtn').style.visibility = "visible";	
  document.getElementById('tksavebtn').style.visibility = "visible";
  document.getElementById('tkinvbtn').style.visibility = "visible";
  document.getElementById('tkpobtn').style.visibility = "visible";
  document.getElementById('tkmoveid').style.visibility = "visible";
  
  document.getElementById('clsjobbtn').style.visibility = "visible";
  
  document.getElementById('tkeditbtn').style.visibility = "hidden";
  document.getElementById('tkviewinvbtn').style.visibility = "hidden";

  //set ticket screen to allow edits - need to lock all of customers tickets because some of relvant information
  //could be changed and the build etc would creat a bogus record
  document.getElementById('tk_EditEnabled').value="Y";
  document.getElementById('tk_stkDPbox').disabled =false;
  document.getElementById('tk_stkLASERINGbox').disabled =false;
  document.getElementById('tk_stkOCCUPANTbox').disabled =false;
  document.getElementById('tk_stkDATA_ENTRYbox').disabled =false;
  document.getElementById('tk_stkMAPSbox').disabled =false;
  
  document.getElementById('tk_stkJOB_ID').readOnly =true; 
  document.getElementById('tk_stkCUSTOMER').readOnly =true;
  document.getElementById('tk_stkCUST_ID').readOnly =true; 
  
  document.getElementById('tk_stkORDERDESC').readOnly =false;
  document.getElementById('tk_stkPO').readOnly =false;
  document.getElementById('tk_stkCONTACT').readOnly =false;
  document.getElementById('tk_stkDATE_IN').readOnly =false;
  document.getElementById('tk_stkDATE_DUE').readOnly =false;
  document.getElementById('tk_stkDATE_DONE').readOnly =false;
  document.getElementById('tk_stkINV_DATE').readOnly =false;
  document.getElementById('tk_stkDATE_IN').readOnly =false;
  document.getElementById('tk_stkDATE_DUE').readOnly =false;
  document.getElementById('tk_stkDATE_DONE').readOnly =false;
  document.getElementById('tk_stkINV_DATE').readOnly =false;
  document.getElementById('tktypeselect').disabled =false;
  document.getElementById('tkwhoselect').disabled =false;
  document.getElementById('tkcis1select').disabled =false;
  document.getElementById('tk_stkARMS_ORD').readOnly =false;
  document.getElementById('tk_stkARMS_JOB').readOnly =false;
  document.getElementById('tk_stkQUANTITY').readOnly =false;
  document.getElementById('tk_stkAMOUNT').readOnly =false;
  document.getElementById('tk_stkSHIPPING').readOnly =false;
  document.getElementById('tk_stknotes').readOnly =false; 

}


function locktk(mid,mcid) {

  var updateurl = "includes/php/tk_setEdit_process.php?mform="; // The server-side script
    
  s = new Array();
  s[0] = mid;
  s[1] = mcid; 
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  http.open("GET", updateurl + escape(s) + "&usession=" +escape(usession), true);
  http.onreadystatechange = locktkResponse;
  http.send(null);

}

function locktkResponse() {

  if (http.readyState == 4) {
     //alert(http.responseText);
     
     results = http.responseText;
     hidewait();
     document.body.style.cursor='auto'; 
     
     if (results.indexOf("lock sucess") !=-1){
        setTKEditYes();
     } else {
	    document.getElementById('confirmtext').innerHTML=results;
        showconfirm(); 
     }       

  }

}
	
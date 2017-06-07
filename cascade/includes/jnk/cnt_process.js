// this function prints dall invoices in the accoutning
function savecnt() {
	
  var updateurl = "includes/php/cnt_addedit.php?mform="; // The server-side script
  document.body.style.cursor = "wait";
  showwait(); 
  
  //end of find shipping cost	
  var errmsg="";
  
   //do the index of
    var tempDT=trim(document.getElementById('cnt_date').value);
    var aPosition = tempDT.indexOf("/");
    
    
    var secondPos = tempDT.indexOf("/", aPosition + 1);
    if (aPosition==-1 || secondPos==-1 || tempDT.length < 8){
	    
	  errmsg=errmsg+"<br><br>The date is in the wrong format, use xx/xx/xxxx or xx/xx/xx.";  
	    
    }    
  
   	if (trim(errmsg) != ''){
	    hidewait();
        document.body.style.cursor='auto';
         
    	document.getElementById('genericmsgtext').innerHTML=errmsg;
		document.getElementById('genericmsgscr').style.left="275px";
    	document.getElementById('genericmsgscr').style.top="200px";
    	document.getElementById('genericmsgscr').style.height="200px";
    	document.getElementById('genericmsgscr').style.width="500px";
     
    	showgenericmsg();  
        return null;  
	    
    }   
    
  s = new Array(); 
  s[0] = "ADD"; 
  
  //if a logout number is loaded in the hidden filed then switch to edit
  if (trim(document.getElementById('cnt_logoutnumber').value) !="ADD"){  
     s[0] = document.getElementById('cnt_logoutnumber').value;
  }  
  
  //alert(s[0]); 
  //return null;
  
	  
	s[1] = trim(document.getElementById('cntconm').innerHTML);
    s[1]=s[1].replace(/\'/g,"zpos");
    s[1]=s[1].replace(/\,/g,"zcomma");
    
	s[2] = trim(document.getElementById('cntcoid').innerHTML);
	s[3] = document.getElementById('cnt_jobnumber').value;
	s[4] = document.getElementById('cnt_al').value; 
	s[5] = document.getElementById('cnt_ak').value; 
	s[6] = document.getElementById('cnt_az').value;
	s[7] = document.getElementById('cnt_ar').value;
	s[8] = document.getElementById('cnt_ca').value;
	s[9] = document.getElementById('cnt_co').value;
	s[10] = document.getElementById('cnt_ct').value;
	s[11] = document.getElementById('cnt_de').value;
	s[12] = document.getElementById('cnt_dc').value;
	s[13] = document.getElementById('cnt_fl').value;
	s[14] = document.getElementById('cnt_ga').value;
	s[15] = document.getElementById('cnt_hi').value;	
	s[16] = document.getElementById('cnt_id').value;
	s[17] = document.getElementById('cnt_il').value;
	s[18] = document.getElementById('cnt_in').value;
	s[19] = document.getElementById('cnt_ia').value;
	s[20] = document.getElementById('cnt_ks').value;
	s[21] = document.getElementById('cnt_ky').value;
	s[22] = document.getElementById('cnt_la').value;
	s[23] = document.getElementById('cnt_me').value;
	s[24] = document.getElementById('cnt_md').value;
	s[25] = document.getElementById('cnt_ma').value;
	s[26] = document.getElementById('cnt_mi').value;
	s[27] = document.getElementById('cnt_mn').value;
	s[28] = document.getElementById('cnt_ms').value;
	s[29] = document.getElementById('cnt_mo').value;
	s[30] = document.getElementById('cnt_mt').value;
	s[31] = document.getElementById('cnt_ne').value;
	s[32] = document.getElementById('cnt_nv').value;
	s[33] = document.getElementById('cnt_nh').value;
	s[34] = document.getElementById('cnt_nj').value;
	s[35] = document.getElementById('cnt_nm').value;
	s[36] = document.getElementById('cnt_ny').value;
	s[37] = document.getElementById('cnt_nc').value;
	s[38] = document.getElementById('cnt_nd').value;
	s[39] = document.getElementById('cnt_oh').value;
	s[40] = document.getElementById('cnt_ok').value;
	s[41] = document.getElementById('cnt_or').value;
	s[42] = document.getElementById('cnt_pa').value;
	s[43] = document.getElementById('cnt_ri').value;
	s[44] = document.getElementById('cnt_sc').value;
	s[45] = document.getElementById('cnt_sd').value;
	s[46] = document.getElementById('cnt_tn').value;
	s[47] = document.getElementById('cnt_tx').value;
	s[48] = document.getElementById('cnt_ut').value;
	s[49] = document.getElementById('cnt_vt').value;
	s[50] = document.getElementById('cnt_va').value;
	s[51] = document.getElementById('cnt_wa').value;
	s[52] = document.getElementById('cnt_wv').value;
	s[53] = document.getElementById('cnt_wi').value; 
	s[54] = document.getElementById('cnt_wy').value;	        
	s[55] = document.getElementById('cnt_other').value;

	//calculate total records
    x=4
    xcnt=0; 
    while (x < 56){
  	 xcnt=xcnt+parseInt(s[x]);
     
  	 x=(x+1);
     
  	}
  	xcnt=xcnt+"";
  		 
	s[56] = xcnt;
  
	if (document.forms['ticketform'].tape[0].checked==true){
      s[57] ="Y";
    } else {
	  s[57] ="N";  
    }      
  
    if (document.forms['ticketform'].reuse[0].checked==true){
      s[58] ="Y";
    } else {
	  s[58] ="N";  
    }  
  
    if (document.forms['ticketform'].lables[0].checked==true){
      s[59] ="Y";
    } else {
	  s[59] ="N";  
    }  
   
    s[60] ="False";
    if (document.forms['ticketform'].ltype[0].checked==true){
      s[60] ="P";
	
    } else if (document.forms['ticketform'].ltype[1].checked==true){
	
	  s[60] ="O";
	
	} else if (document.forms['ticketform'].ltype[2].checked==true){
		
	  s[60] ="B";
	  
	}
    
	if (s[60]=="False"){

	  alert("You must pick a business type!");
	  hidewait();
      document.body.style.cursor='auto';
	  
	  return null;
		
    }		    
    
    s[61] = document.getElementById('cnt_amount').value;
	s[62] = document.getElementById('cnt_shipping').value;
	s[63] = document.getElementById('cnt_misc').value;
	s[64] = document.getElementById('cnt_date').value;
	s[65] = getCntwknumber(); //do not allow edit - must change dateofjob for weeknumber  
	
	//alert(s[61]);
	      
    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = savecntResponse;
    http.send(null);
    

}

function savecntResponse() {
  if (http.readyState == 4) {
    hidewait();
    document.body.style.cursor='auto';
    
    results = http.responseText.split("|");
    var mtest=http.responseText;
    //alert(mtest);
    //return null
    
    document.getElementById('genericmsgtext').innerHTML=results[2];
	document.getElementById('genericmsgscr').style.left="275px";
    document.getElementById('genericmsgscr').style.top="200px";
    document.getElementById('genericmsgscr').style.height="200px";
    document.getElementById('genericmsgscr').style.width="500px";
    //alert(results[0]+"  type:"+results[1]); 
    showgenericmsg();  
    getcnt(results[0],results[1]);
             
  } //end of ready state test
}//end of function




//get count record
function getcnt(mnumber,mtype) {

  var updateurl = "includes/php/cnt_getcnt.php?mform="; // The server-side script
  clearcntscr();
  document.body.style.cursor = "wait";
  showwait(); 
  
  if (trim(document.getElementById('cntlookup').value)==''){
	hidewait();
    document.body.style.cursor='auto';  
	document.getElementById('genericmsgtext').innerHTML='You must enter a job number or logout number to search for.';
	document.getElementById('genericmsgscr').style.left="325px";
    document.getElementById('genericmsgscr').style.top="200px";
    document.getElementById('genericmsgscr').style.height="150px";
    document.getElementById('genericmsgscr').style.width="400px";
     
    showgenericmsg();  
    return null;
  }  	
	
  s = new Array(); 
  s[0] =mnumber;
  
  if (mtype=='job'){
    s[1] ='inv_no'
  } else {
    s[1]= 'rec_no';

  }
    
    var usession = getmsession();
    http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = getcntResponse;
    http.send(null);
    

}

function getcntResponse() {
  if (http.readyState == 4) {
    
    results = http.responseText.split("|");
    //alert(results);

    if (trim(results[0])==''){
	 hidewait();
     document.body.style.cursor='auto';   
	 document.getElementById('genericmsgtext').innerHTML='Could not find record, please check your number and try again.';
     document.getElementById('genericmsgscr').style.left="325px";
     document.getElementById('genericmsgscr').style.top="200px";
     document.getElementById('genericmsgscr').style.height="150px";
     document.getElementById('genericmsgscr').style.width="400px";
     
     showgenericmsg();
    
     return null;
    } else {  	
  
	    if (results[0]=="new count record"){

		      //1=JOB_ID
		      //2=DATE_IN
              //3=CUSTOMER
              //4=DESC
              //5=CUST_ID
              //6=AMOUNT
              //7=SHIPPING
              //8=WEEK
	    
	        document.getElementById('cnt_logoutnumber').value='ADD';
			document.getElementById('cntconm').innerHTML=results[3];
			document.getElementById('cntcoid').innerHTML=results[5];
			document.getElementById('cnt_jobnumber').value=results[1];
			document.getElementById('cntedittype').innerHTML="Adding a count record for job# "+results[1]+"<br>&nbsp;&nbsp;&nbsp;** You must click the save button**<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;to add the record.";
			document.getElementById('cnt_al').value='0';
			document.getElementById('cnt_ak').value='0'; 
			document.getElementById('cnt_az').value='0';
			document.getElementById('cnt_ar').value='0';
			document.getElementById('cnt_ca').value='0';
			document.getElementById('cnt_co').value='0';
			document.getElementById('cnt_ct').value='0';
			document.getElementById('cnt_de').value='0';
			document.getElementById('cnt_dc').value='0';
			document.getElementById('cnt_fl').value='0';
			document.getElementById('cnt_ga').value='0';
			document.getElementById('cnt_hi').value='0';	
			document.getElementById('cnt_id').value='0';
			document.getElementById('cnt_il').value='0';
			document.getElementById('cnt_in').value='0';
			document.getElementById('cnt_ia').value='0';
			document.getElementById('cnt_ks').value='0';
			document.getElementById('cnt_ky').value='0';
			document.getElementById('cnt_la').value='0';
			document.getElementById('cnt_me').value='0';	
			document.getElementById('cnt_md').value='0';
			document.getElementById('cnt_ma').value='0';
	    	document.getElementById('cnt_mi').value='0';
			document.getElementById('cnt_mn').value='0';
			document.getElementById('cnt_ms').value='0';
			document.getElementById('cnt_mo').value='0';
			document.getElementById('cnt_mt').value='0';
			document.getElementById('cnt_ne').value='0';
			document.getElementById('cnt_nv').value='0';
			document.getElementById('cnt_nh').value='0';
			document.getElementById('cnt_nj').value='0';
			document.getElementById('cnt_nm').value='0';
			document.getElementById('cnt_ny').value='0';
			document.getElementById('cnt_nc').value='0';
			document.getElementById('cnt_nd').value='0';
			document.getElementById('cnt_oh').value='0';
			document.getElementById('cnt_ok').value='0';
			document.getElementById('cnt_or').value='0';
			document.getElementById('cnt_pa').value='0';
			document.getElementById('cnt_ri').value='0';
			document.getElementById('cnt_sc').value='0';
			document.getElementById('cnt_sd').value='0';
			document.getElementById('cnt_tn').value='0';
			document.getElementById('cnt_tx').value='0';
			document.getElementById('cnt_ut').value='0';
			document.getElementById('cnt_vt').value='0';
			document.getElementById('cnt_va').value='0';
			document.getElementById('cnt_wa').value='0';
			document.getElementById('cnt_wv').value='0';
			document.getElementById('cnt_wi').value='0'; 
			document.getElementById('cnt_wy').value='0';	        
			document.getElementById('cnt_other').value='0';
		
	  		 
			document.getElementById('cnttotalrec').innerHTML='0';
	  		
			//defaulkt to disk
			document.forms['ticketform'].tape[1].checked=true;
		    //default to no reuse
   		    document.forms['ticketform'].reuse[1].checked=true;
			  
            //default to no lables
   		    document.forms['ticketform'].lables[1].checked=true;
			
   		    //set all three type to false 
	    	document.forms['ticketform'].ltype[0].checked=false;
			document.forms['ticketform'].ltype[1].checked=false;
			document.forms['ticketform'].ltype[2].checked=false;
			
			
			var mamt=results[6];
			mamt=parseFloat(mamt);
			mamt=mamt.toFixed(2)+"";
		
					
			var mship=results[7];
			mship=parseFloat(mship);
			mship=mship.toFixed(2)+"";
			
	    	var mmisc='0.00';
	    	mmisc=parseFloat(mmisc);
	    	mmisc=mmisc.toFixed(2)+"";
	    	
	    	//alert(mamt + "  :  "+mship+ "   :   "+mmisc); 
	    	
	    	document.getElementById('cnt_amount').value=mamt;
			document.getElementById('cnt_shipping').value=mship;
			document.getElementById('cnt_misc').value=mmisc;
			
			//if its CIS format MySQL date
			if (document.getElementById("ucoid").value=='CIS'){    
                results[2]=results[2].charAt(5)+results[2].charAt(6)+"/"+results[2].charAt(8)+results[2].charAt(9)+"/"+results[2].charAt(2)+results[2].charAt(3);
            }
            
			document.getElementById('cnt_date').value=results[2];
			
			
        } else {

	        document.getElementById('cnt_logoutnumber').value=results[0];
			document.getElementById('cntconm').innerHTML=results[1];
			document.getElementById('cntcoid').innerHTML=results[2];
			document.getElementById('cnt_jobnumber').value=results[3];
			document.getElementById('cntedittype').innerHTML="Editing a count record for job# "+results[3]+"<br>The Logout# is "+results[0];
			
			document.getElementById('cnt_al').value=results[4]; 
			document.getElementById('cnt_ak').value=results[5]; 
			document.getElementById('cnt_az').value=results[6];
			document.getElementById('cnt_ar').value=results[7];
			document.getElementById('cnt_ca').value=results[8];
			document.getElementById('cnt_co').value=results[9];
			document.getElementById('cnt_ct').value=results[10];
			document.getElementById('cnt_de').value=results[11];
			document.getElementById('cnt_dc').value=results[12];
			document.getElementById('cnt_fl').value=results[13];
			document.getElementById('cnt_ga').value=results[14];
			document.getElementById('cnt_hi').value=results[15];	
			document.getElementById('cnt_id').value=results[16];
			document.getElementById('cnt_il').value=results[17];
			document.getElementById('cnt_in').value=results[18];
			document.getElementById('cnt_ia').value=results[19];
			document.getElementById('cnt_ks').value=results[20];
			document.getElementById('cnt_ky').value=results[21];
			document.getElementById('cnt_la').value=results[22];
			document.getElementById('cnt_me').value=results[23];	
			document.getElementById('cnt_md').value=results[24];
			document.getElementById('cnt_ma').value=results[25];
	    	document.getElementById('cnt_mi').value=results[26];
			document.getElementById('cnt_mn').value=results[27];
			document.getElementById('cnt_ms').value=results[28];
			document.getElementById('cnt_mo').value=results[29];
			document.getElementById('cnt_mt').value=results[30];
			document.getElementById('cnt_ne').value=results[31];
			document.getElementById('cnt_nv').value=results[32];
			document.getElementById('cnt_nh').value=results[33];
			document.getElementById('cnt_nj').value=results[34];
			document.getElementById('cnt_nm').value=results[35];
			document.getElementById('cnt_ny').value=results[36];
			document.getElementById('cnt_nc').value=results[37];
			document.getElementById('cnt_nd').value=results[38];
			document.getElementById('cnt_oh').value=results[39];
			document.getElementById('cnt_ok').value=results[40];
			document.getElementById('cnt_or').value=results[41];
			document.getElementById('cnt_pa').value=results[42];
			document.getElementById('cnt_ri').value=results[43];
			document.getElementById('cnt_sc').value=results[44];
			document.getElementById('cnt_sd').value=results[45];
			document.getElementById('cnt_tn').value=results[46];
			document.getElementById('cnt_tx').value=results[47];
			document.getElementById('cnt_ut').value=results[48];
			document.getElementById('cnt_vt').value=results[49];
			document.getElementById('cnt_va').value=results[50];
			document.getElementById('cnt_wa').value=results[51];
			document.getElementById('cnt_wv').value=results[52];
			document.getElementById('cnt_wi').value=results[53]; 
			document.getElementById('cnt_wy').value=results[54];	        
			document.getElementById('cnt_other').value=results[55];
		
	  		 
			document.getElementById('cnttotalrec').innerHTML=results[56];
	  		
			if (results[57]=="Y"){
			  document.forms['ticketform'].tape[0].checked=true;
			} else {
			  document.forms['ticketform'].tape[1].checked=true;
			}         
  	
		    if (results[58]=="Y"){
		      document.forms['ticketform'].reuse[0].checked=true;
			} else {
			  document.forms['ticketform'].reuse[1].checked=true;
			}  
  
	    	if (results[59]=="Y"){
	    	  document.forms['ticketform'].lables[0].checked=true;
			} else {
			  document.forms['ticketform'].lables[1].checked=true;
			} 
			 
	    	if (results[60]=="P"){
	      		document.forms['ticketform'].ltype[0].checked=true;
			} else if (results[60]=="O"){
		  		document.forms['ticketform'].ltype[1].checked=true;
			} else if (results[60]=="B"){
			  document.forms['ticketform'].ltype[2].checked=true;
			}
	    
			
			var mamt=results[61];
			mamt=parseFloat(mamt);
			mamt=mamt.toFixed(2)+"";
		
			var mship=results[62];
			mship=parseFloat(mship);
			mship=mship.toFixed(2)+"";
			
	    	var mmisc=results[63];
	    	mmisc=parseFloat(mmisc);
	    	mmisc=mmisc.toFixed(2)+"";
	    	
	    	//alert(mamt + "  :  "+mship+ "   :   "+mmisc); 
	    	
	    	document.getElementById('cnt_amount').value=mamt;
			document.getElementById('cnt_shipping').value=mship;
			document.getElementById('cnt_misc').value=mmisc;
			
			
			//if its CIS format MySQL date
			//if (document.getElementById("ucoid").value=='CIS'){    
                //results[64]=results[64].charAt(5)+results[64].charAt(6)+"/"+results[64].charAt(8)+results[64].charAt(9)+"/"+results[64].charAt(2)+results[64].charAt(3);
            //}
			
			document.getElementById('cnt_date').value=results[64];
			
			
          } // end of check for new count record
      	} //end of check for return	
      	
      	hidewait();
        document.body.style.cursor='auto';
      				  
	  } //end of responce
 
} //end of function



function cntrecalc(){

    stcnt = new Array(); 
  	stcnt[0] = document.getElementById('cnt_al').value; 
	stcnt[1] = document.getElementById('cnt_ak').value; 
	stcnt[2] = document.getElementById('cnt_az').value;
	stcnt[3] = document.getElementById('cnt_ar').value;
	stcnt[4] = document.getElementById('cnt_ca').value;
	stcnt[5] = document.getElementById('cnt_co').value;
	stcnt[6] = document.getElementById('cnt_ct').value;
	stcnt[7] = document.getElementById('cnt_de').value;
	stcnt[8] = document.getElementById('cnt_dc').value;
	stcnt[9] = document.getElementById('cnt_fl').value;
	stcnt[10] = document.getElementById('cnt_ga').value;
	stcnt[11] = document.getElementById('cnt_hi').value;	
	stcnt[12] = document.getElementById('cnt_id').value;
	stcnt[13] = document.getElementById('cnt_il').value;
	stcnt[14] = document.getElementById('cnt_in').value;
	stcnt[15] = document.getElementById('cnt_ia').value;
	stcnt[16] = document.getElementById('cnt_ks').value;
	stcnt[17] = document.getElementById('cnt_ky').value;
	stcnt[18] = document.getElementById('cnt_la').value;
	stcnt[19] = document.getElementById('cnt_me').value;
	stcnt[20] = document.getElementById('cnt_md').value;
	stcnt[21] = document.getElementById('cnt_ma').value;
	stcnt[22] = document.getElementById('cnt_mi').value;
	stcnt[23] = document.getElementById('cnt_mn').value;
	stcnt[24] = document.getElementById('cnt_ms').value;
	stcnt[25] = document.getElementById('cnt_mo').value;
	stcnt[26] = document.getElementById('cnt_mt').value;
	stcnt[27] = document.getElementById('cnt_ne').value;
	stcnt[28] = document.getElementById('cnt_nv').value;
	stcnt[29] = document.getElementById('cnt_nh').value;
	stcnt[30] = document.getElementById('cnt_nj').value;
	stcnt[31] = document.getElementById('cnt_nm').value;
	stcnt[32] = document.getElementById('cnt_ny').value;
	stcnt[33] = document.getElementById('cnt_nc').value;
	stcnt[34] = document.getElementById('cnt_nd').value;
	stcnt[35] = document.getElementById('cnt_oh').value;
	stcnt[36] = document.getElementById('cnt_ok').value;
	stcnt[37] = document.getElementById('cnt_or').value;
	stcnt[38] = document.getElementById('cnt_pa').value;
	stcnt[39] = document.getElementById('cnt_ri').value;
	stcnt[40] = document.getElementById('cnt_sc').value;
	stcnt[41] = document.getElementById('cnt_sd').value;
	stcnt[42] = document.getElementById('cnt_tn').value;
	stcnt[43] = document.getElementById('cnt_tx').value;
	stcnt[44] = document.getElementById('cnt_ut').value;
	stcnt[45] = document.getElementById('cnt_vt').value;
	stcnt[46] = document.getElementById('cnt_va').value;
	stcnt[47] = document.getElementById('cnt_wa').value;
	stcnt[48] = document.getElementById('cnt_wv').value;
	stcnt[49] = document.getElementById('cnt_wi').value; 
	stcnt[50] = document.getElementById('cnt_wy').value;	        
	stcnt[51] = document.getElementById('cnt_other').value;

	//calculate total records
    x=0
    xcnt=0; 
    while (x < 52){
  	 xcnt=xcnt+parseInt(stcnt[x]);
     
  	 x=(x+1);
     
  	}
  	xcnt=xcnt+"";
  	 
	document.getElementById('cnttotalrec').innerHTML=xcnt;
	
	
}//end of function


function handlecntKeyPress(e,nextfield)
{
if (!e) e = window.event;
if ((e && e.keyCode == 13) || (e && e.KeyChar == 9))
{
  //alert("enter pressed");
  cntrecalc();
  
  eval('document.ticketform.' + nextfield + '.focus()');
  eval('document.ticketform.' + nextfield + '.select()');

// handle Enter key
// return false; here to cancel the event
}
}

function clearcntscr(){
	
	        document.getElementById('cnt_logoutnumber').value='';
			document.getElementById('cntconm').innerHTML='Company Name:';
			document.getElementById('cntcoid').innerHTML="Customer ID# ";
			document.getElementById('cnt_jobnumber').value='';
			document.getElementById('cntedittype').innerHTML="No record selected.";
			document.getElementById('cnt_al').value='0';
			document.getElementById('cnt_ak').value='0'; 
			document.getElementById('cnt_az').value='0';
			document.getElementById('cnt_ar').value='0';
			document.getElementById('cnt_ca').value='0';
			document.getElementById('cnt_co').value='0';
			document.getElementById('cnt_ct').value='0';
			document.getElementById('cnt_de').value='0';
			document.getElementById('cnt_dc').value='0';
			document.getElementById('cnt_fl').value='0';
			document.getElementById('cnt_ga').value='0';
			document.getElementById('cnt_hi').value='0';	
			document.getElementById('cnt_id').value='0';
			document.getElementById('cnt_il').value='0';
			document.getElementById('cnt_in').value='0';
			document.getElementById('cnt_ia').value='0';
			document.getElementById('cnt_ks').value='0';
			document.getElementById('cnt_ky').value='0';
			document.getElementById('cnt_la').value='0';
			document.getElementById('cnt_me').value='0';	
			document.getElementById('cnt_md').value='0';
			document.getElementById('cnt_ma').value='0';
	    	document.getElementById('cnt_mi').value='0';
			document.getElementById('cnt_mn').value='0';
			document.getElementById('cnt_ms').value='0';
			document.getElementById('cnt_mo').value='0';
			document.getElementById('cnt_mt').value='0';
			document.getElementById('cnt_ne').value='0';
			document.getElementById('cnt_nv').value='0';
			document.getElementById('cnt_nh').value='0';
			document.getElementById('cnt_nj').value='0';
			document.getElementById('cnt_nm').value='0';
			document.getElementById('cnt_ny').value='0';
			document.getElementById('cnt_nc').value='0';
			document.getElementById('cnt_nd').value='0';
			document.getElementById('cnt_oh').value='0';
			document.getElementById('cnt_ok').value='0';
			document.getElementById('cnt_or').value='0';
			document.getElementById('cnt_pa').value='0';
			document.getElementById('cnt_ri').value='0';
			document.getElementById('cnt_sc').value='0';
			document.getElementById('cnt_sd').value='0';
			document.getElementById('cnt_tn').value='0';
			document.getElementById('cnt_tx').value='0';
			document.getElementById('cnt_ut').value='0';
			document.getElementById('cnt_vt').value='0';
			document.getElementById('cnt_va').value='0';
			document.getElementById('cnt_wa').value='0';
			document.getElementById('cnt_wv').value='0';
			document.getElementById('cnt_wi').value='0'; 
			document.getElementById('cnt_wy').value='0';	        
			document.getElementById('cnt_other').value='0';
		
	  		 
			document.getElementById('cnttotalrec').innerHTML='0';
	  		
			//defaulkt to disk
			document.forms['ticketform'].tape[1].checked=true;
		    //default to no reuse
   		    document.forms['ticketform'].reuse[1].checked=true;
			  
            //default to no lables
   		    document.forms['ticketform'].lables[1].checked=true;
			
   		    //set all three type to false 
	    	document.forms['ticketform'].ltype[0].checked=false;
			document.forms['ticketform'].ltype[1].checked=false;
			document.forms['ticketform'].ltype[2].checked=false;
			
			var mamt=0.00;
			mamt=parseInt(mamt);
			mamt=mamt.toFixed(2)+"";
		
			var mship=0.00;
			mship=parseInt(mship);
			mship=mship.toFixed(2)+"";
			
	    	var mmisc='0.00';
	    	mmisc=parseInt(mmisc);
	    	mmisc=mmisc.toFixed(2)+"";
	    	
	    	
	    	
	    	document.getElementById('cnt_amount').value=mamt;
			document.getElementById('cnt_shipping').value=mship;
			document.getElementById('cnt_misc').value=mmisc;
			
			document.getElementById('cnt_date').value='  /  /  ';
			
	
	
}	


function cntgetwkstats(theweek,theyear,getpdf){
  document.body.style.cursor = "wait";
  showwait(); 
	
  //alert("Week: "+theweek+"  Year: "+theyear+"  PDF? "+getpdf);
  var updateurl = "includes/php/cnt_getcntwkstats.php?mform="; // The server-side script
  
  
  s = new Array(); 
  s[0]=theweek;
  s[1]=theyear;
  s[2]=getpdf;

  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = cntgetwkstatsResponse;
  http.send(null);
    

}

function cntgetwkstatsResponse() {
  if (http.readyState == 4) {
    hidewait();
    document.body.style.cursor='auto';
    results = http.responseText.split("|");
    //alert(results);
    document.getElementById('cntweeknum').innerHTML=results[0];
    document.getElementById('cntnumrecords').innerHTML=results[1];
    document.getElementById('cntamtforweek').innerHTML=results[2];
    
		  
  } //end of responce

} //end of function


function getCntwknumber(){
	
   
    var tempDT=trim(document.getElementById('cnt_date').value);
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


//pdf
function cntPDF(){
    
	var tkurl = "includes/php/cnt_wkpdf.php?usession="; // The server-side script
    if (document.forms['ticketform'].cnt_wkincO.checked==false){
  	   if (document.forms['ticketform'].cnt_wkincP.checked==false){ 
          if (document.forms['ticketform'].cnt_wkincB.checked==false){ 
	   		document.getElementById('genericmsgtext').innerHTML="&nbsp;&nbsp;&nbsp;You must pick at least one list category.";
			document.getElementById('genericmsgscr').style.left="360px";
   			document.getElementById('genericmsgscr').style.top="160px";
    		document.getElementById('genericmsgscr').style.height="125px";
     		document.getElementById('genericmsgscr').style.width="300px";
        	showgenericmsg();
            return null      
      	  }
       } 
	}	
	
    if (document.forms['ticketform'].cnt_weeklyR.checked==false){
       if (document.forms['ticketform'].cnt_salesR.checked==false){
         document.getElementById('genericmsgtext').innerHTML="&nbsp;&nbsp;&nbsp;You must pick at least one type of report.";
		 document.getElementById('genericmsgscr').style.left="360px";
   		 document.getElementById('genericmsgscr').style.top="160px";
    	 document.getElementById('genericmsgscr').style.height="125px";
     	 document.getElementById('genericmsgscr').style.width="300px";
         showgenericmsg();
         return null      
       }
    }
	
	 
	 
	document.body.style.cursor = "wait";
    showwait();
     
    //added a tie to dropdown  
    //var pdfweek=getWeekNr();
    //var today = new Date();
    //var pdfyear=takeYear(today);
    
    mf = new Array();
    mf[0]=document.getElementById('cnt_pdfwk').value;
    mf[1]=document.getElementById('cnt_pdfyear').value;
    
    mf[2]="N";
    mf[3]="N";
    mf[4]="N";
    mf[5]="N";
    mf[6]="N";
   
    if (document.forms['ticketform'].cnt_wkincO.checked==true){mf[2]="Y"};
	if (document.forms['ticketform'].cnt_wkincP.checked==true){mf[3]="Y"};
    if (document.forms['ticketform'].cnt_wkincB.checked==true){mf[4]="Y"};
    
    if (document.forms['ticketform'].cnt_weeklyR.checked==true){mf[5]="Y"};
    if (document.forms['ticketform'].cnt_salesR.checked==true){mf[6]="Y"};
   
    //set up index order
     if (document.forms['ticketform'].itype[0].checked==true){
      mf[7] ="C";
	} else if (document.forms['ticketform'].itype[1].checked==true){
	  mf[7] ="I";
	} else {
	  mf[7] ="D";
	}
    
     
	//to go over 8 this will have to be adjusted to possibly muti-den array passing
	 var scnt=8 //starts at 8- very important that the states be the end of the array
	            //being passed so I can use a loop in the PHP processing file to have 
	            //states expand if they decide to- might want to
	             
	 var xcnt=0 //for looping through state select
	 
     while (xcnt < 51){ 

       //eight states max
       if (document.forms['ticketform'].cntstselect.options[xcnt].selected==true){
          mf[scnt] =document.forms['ticketform'].cntstselect.options[xcnt].value;
          scnt=scnt+1
       } 
       xcnt=xcnt+1
     }
	

    //hidewait();
    //document.body.style.cursor='auto';
    //alert(mf);
    //return null;
    
    
	document.getElementById('current_pdf').value="cnt";
    document.getElementById('pdfid').value=mf[0]+"_"+mf[1];
            
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = cntPDFResponce;
    http.send(null);
 

}

function cntPDFResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    //alert(mmes);
    //hidecntpdfbox();
	hidewait();
    document.body.style.cursor='auto';
    rpdfopen('popup', 640, 480);

  }
}

function updateselcnt(){
	
	var msel=document.getElementById('cntstselect').selectedIndex;
	
	if (msel==51){
        var xcnt=0
	    while (xcnt < 51){ 
          document.forms['ticketform'].cntstselect.options[xcnt].selected=true;             
         xcnt=xcnt+1
    	}
		document.getElementById('statecnt').innerHTML="Selected: 51";
		return null        
    } //end of all
	
	//if not all do get the count
	
	 var xcnt=0
	 var numstates=0;
	 
     while (xcnt < 51){ 

	   
	     
       //eight states max
       if (document.forms['ticketform'].cntstselect.options[xcnt].selected==true){
          numstates=(numstates+1);
       } 
             
       xcnt=xcnt+1
     }
     
     //efectly disabbled
     if (numstates > 999){
	   document.getElementById('genericmsgtext').innerHTML="&nbsp;&nbsp;&nbsp;You can only select 8 states for reports.";
	   document.getElementById('genericmsgscr').style.left="510px";
       document.getElementById('genericmsgscr').style.top="160px";
       document.getElementById('genericmsgscr').style.height="125px";
       document.getElementById('genericmsgscr').style.width="300px";
      showgenericmsg();      
	 }	      
  
	 numstates=numstates+"";      
  document.getElementById('statecnt').innerHTML="Selected: "+numstates;
  
}	
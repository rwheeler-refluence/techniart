// the next two functions retrieve the dun information
function getduninfo(thetype) {
		
  var url = "includes/php/getdun_process.php?mfilter="; // The server-side script
  
  if (thetype=='A'){
    var mconm=document.getElementById('ADD_company').value;
    var madd=document.getElementById('ADD_add1').value;
    var mcity=document.getElementById('ADD_city').value;
    var mstate=document.getElementById('ADD_st').value;
    var mzip=document.getElementById('ADD_zip').value;
    var mzip4=document.getElementById('ADD_zip4').value;
    
  } else {
	  
	 var mconm=document.getElementById('company').value;
     var madd=document.getElementById('add1').value;
     var mcity=document.getElementById('CITY').value;
     var mstate=document.getElementById('ST').value;
     var mzip=document.getElementById('ZIP').value;
     var mzip4=document.getElementById('ZIP4').value;
  }	 
    
    
  mconm=mconm.toUpperCase();
  madd=madd.toUpperCase();
  mcity=mcity.toUpperCase();	
  mstate=mstate.toUpperCase();	
  
  s = new Array();
  s[0] = trim(mconm);
  s[1] = trim(madd);
  s[2] = trim(mcity);
  s[3] = trim(mstate);
  s[4] = trim(mzip);
  s[5] = trim(mzip4);
  
 
  //take this out if we get coldfusion 8 that integrates with javscript.
  if (trim(s[0])=='' || trim(s[1])=='' || trim(s[2])=='' || trim(s[3])=='' || trim(s[4])==''){
	   alert("The company information is incomplete.   \n\nPlease enter an name,address,city,state & zip to search.   "); 
  } else {

	 document.body.style.cursor = "wait";
     showwait();

     http.open("GET", url + escape(s), true);
     http.onreadystatechange = getduninfoResponse;
     http.send(null);

  }
}

function getduninfoResponse() {

  if (http.readyState == 4) {

    tresults = http.responseText.split("^");
  
    //alert(http.responseText);
    results=tresults.sort();
    
    r1= new Array();
    document.forms['dnbform'].dnbresults.options.length = 0;
    var mnumrecs=0;
    var rank="";
    for (x in results)
    {
     
     r1 = results[x].split("|");
         if (r1[1] != undefined){
	           
	        //0 priority 
            //1 duns_nmbr  
            //2 comp_name
            //3 tradestyle
            //4 strt_addr
            //5 city_name
            //6 state_abbr
            //7 zip_code
            //8 zip_4
            //9 mail_addr
            //10 mail_city
            //11 mail_state
            //12 mail_zip
            //13 mail_zip4
            //14 sic1
            //15 sicname
            // pad out the elements for table if individual elements not null
            
            if  (r1[1] != undefined){ r1[1] = padRight(r1[1],' ',10)};
            if  (r1[2] != undefined){ r1[2] = padRight(r1[2],' ',31)};
            if  (r1[3] != undefined){ r1[3] = padRight(r1[3],' ',31)};
            if  (r1[4] != undefined){ r1[4] = padRight(r1[4],' ',41)};
            if  (r1[5] != undefined){ r1[5] = padRight(r1[5],' ',26)};
            if  (r1[6] != undefined){ r1[6] = padRight(r1[6],' ',3)};
            if  (r1[7] != undefined){ r1[7] = padRight(r1[7],' ',6)};
            if  (r1[8] != undefined){ r1[8] = padRight(r1[8],' ',5)};
            if  (r1[9] != undefined){ r1[9] = padRight(r1[9],' ',41)};
            if (r1[10] != undefined){r1[10] = padRight(r1[10],' ',26)};
            if (r1[11] != undefined){r1[11] = padRight(r1[11],' ',3)};
            if (r1[12] != undefined){r1[12] = padRight(r1[12],' ',6)};
            if (r1[13] != undefined){r1[13] = padRight(r1[13],' ',5)};
            if (r1[14] != undefined){r1[14] = padRight(r1[14],' ',9)};
            if (r1[15] != undefined){r1[15] = padRight(r1[15],' ',65)};
            
            if (r1[0]==1){
	           rank="Full Name & Add ";
            } else if (r1[0]==2){     
	           rank="10 Chars & Add ";
            } else if (r1[0]==3){     
	           rank="5 Chars & Add ";
            } else {
	           rank="Address Only ";    
            }           
            
            rank = padRight(rank,' ',16);
            document.forms['dnbform'].dnbresults.options[mnumrecs] = new Option(rank+'  '+r1[2]+'  '+trim(r1[4])+', '+trim(r1[5])+' '+trim(r1[6])+' '+r1[7]+'-'+r1[8],r1[1]+"|"+r1[14]+"|"+r1[15]+"|"+r1[2]+"|"+r1[3]+"|"+r1[4]+"|"+r1[5]+"|"+r1[6]+"|"+r1[7]+"|"+r1[8],true,false);
            mnumrecs=mnumrecs+1; 
            
        }// end of defined condition
    } // end of loop

    if (document.forms['dnbform'].dnbresults.options.length == 0) {
      
	     document.forms['dnbform'].dnbresults.options[mnumrecs] = new Option("No matches found.",'true');
       
    }

  mnumrecs=mnumrecs+1;
  hidewait();
  document.body.style.cursor='auto';
  showDunnLookup(); 	  
   
  } //end of ready state

}


function setdunn(){

 var msel=document.getElementById('dnbresults').selectedIndex;
   
 if (msel == -1) {
	 
   alert("Please choose one of the choices to save.");
   return null;
	 
 } else {
	 
   var mvalue=document.forms['dnbform'].dnbresults.options[msel].value;  
   r1= new Array();
   r1 = mvalue.split("|");        			
   
   if (document.getElementById('maddscreenup').value === "YES") {
	  document.getElementById('ADD_duns_nmbr').value=r1[0];
      document.getElementById('ADD_dun_sic').value=r1[1];
      document.getElementById('ADD_dun_sic_desc').value=trim(r1[2]);
      document.getElementById('ADD_dun_name').value=r1[3];
      document.getElementById('ADD_dun_trade').value=r1[4];
      document.getElementById('ADD_dun_add1').value=r1[5];
      document.getElementById('ADD_dun_city').value=r1[6];
      document.getElementById('ADD_dun_st').value=r1[7];
      document.getElementById('ADD_dun_zip').value=r1[8];
      document.getElementById('ADD_dun_zip4').value=r1[9];
   } else {
	  document.getElementById('duns_nmbr').value=r1[0];
      document.getElementById('dun_sic').value=r1[1];
      document.getElementById('dun_sic_desc').value=trim(r1[2]);
      document.getElementById('dun_name').value=r1[3];
      document.getElementById('dun_trade').value=r1[4];
      document.getElementById('dun_add1').value=r1[5];
      document.getElementById('dun_city').value=r1[6];
      document.getElementById('dun_st').value=r1[7];
      document.getElementById('dun_zip').value=r1[8];
      document.getElementById('dun_zip4').value=r1[9]; 
   }	
hideDunnLookup();	
} //end of selected test
}	



//*********************** since these are fired onload and I don't have a response cach in place 
//*********************** chain filetype,octag,shipping & term function on these
 
// the next two functions are for getting file type select
function getarfiletyp() {
  var usession = getmsession();
  var updateurl = "includes/php/cc_arfile_process.php?usession="; // The server-side script

  document.body.style.cursor = "wait";
  showwait();  

  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = getAutoresFileTypResponse;
  http.send(null);
}



function getAutoresFileTypResponse() {
  if (http.readyState == 4) {
	  
	  
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    
    //alert(http.responseText);
    r1= new Array();
    document.forms['custcareform'].filetype.options.length = 0;
    document.forms['custcareform'].ADD_filetype.options.length = 0;
    
    document.forms['utilform'].utilfiletype.options.length = 0;
    
     for (x in results)
    {
           
    r1 = results[x].split("|");
   
    
    if (trim(r1[0]) !=""){
      if (typeof r1[0] != "undefined")
      { 
       document.forms['custcareform'].filetype.options[x] = new Option(r1[0],r1[0],true,false);
       document.forms['custcareform'].ADD_filetype.options[x] = new Option(r1[0],r1[0],true,false);
        r1[0] = trim(r1[0]);
        r1[1] = trim(r1[1]);
        r1[2] = trim(r1[2]);
          
	    r1[0] = padRight(r1[0],' ',31);
	    r1[1] = padRight(r1[1],' ',2);
	    r1[2] = padLeft(r1[2],' ',2);  
       document.forms['utilform'].utilfiletype.options[x] = new Option(r1[0]+r1[1]+r1[2],r1[0]+'|'+r1[1]+'|'+r1[2],true,false);
      }
     }   
    
    }

      if (document.forms['custcareform'].filetype.options.length == 0)
       {
          document.forms['custcareform'].filetype.options[x] = new Option("No file types defined."," ",true,false);
          document.forms['custcareform'].ADD_filetype.options[x] = new Option("No file types defined."," ",true,false);
          document.forms['utilform'].utilfiletype.options[x] = new Option("No file types defined."," ",true,false);
       }

//Add a select for no file type
var i=document.forms['custcareform'].filetype.options.length;
//do not increase i because the options start with 0;

document.forms['custcareform'].filetype.options[i] = new Option("No File Type Selected"," ",true,false);
document.forms['custcareform'].ADD_filetype.options[i] = new Option("No File Type Selected"," ",true,false);
//document.forms['utilform'].utilfiletype.options[i] = new Option("No File Type Selected"," ",true,false);
getoctag();
  }
}
// end of auto res file type 


// next two funtion retrieve the occupant tag format
function getoctag() {
  var usession = getmsession();
  var updateurl = "includes/php/cc_octag_process.php?usession="; // The server-side script
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = getOccTFmtResponse;
  http.send(null);
}

function getOccTFmtResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].tagformat.options.length = 0;
    document.forms['custcareform'].ADD_tagformat.options.length = 0;
    document.forms['utilform'].utiltagformat.options.length = 0;

     for (x in results)
    {
       
    
    r1 = results[x].split("|");
     if (trim(r1[0]) !=""){
       if (typeof r1[0] != "undefined")
       {
        document.forms['custcareform'].tagformat.options[x] = new Option(r1[0],r1[0],true,false);
        document.forms['custcareform'].ADD_tagformat.options[x] = new Option(r1[0],r1[0],true,false);
        document.forms['utilform'].utiltagformat.options[x] = new Option(r1[0],r1[0],true,false);
       }  
     }  
    }

      if (document.forms['custcareform'].tagformat.options.length == 0)
       {
          document.forms['custcareform'].tagformat.options[x] = new Option("No Tags."," ",true,false);
          document.forms['custcareform'].ADD_tagformat.options[x] = new Option("No tags."," ",true,false);
          document.forms['utilform'].utiltagformat.options[x] = new Option("No Tags."," ",true,false);
       }
//Add a select for no file type
var i=document.forms['custcareform'].tagformat.options.length;

document.forms['custcareform'].tagformat.options[i] = new Option("No Tag"," ",true,false);
document.forms['custcareform'].ADD_tagformat.options[i] = new Option("No Tag"," ",true,false);
//document.forms['utilform'].utiltagformat.options[i] = new Option("No Tag"," ",true,false);

getshipping();
  }
}
// end of occupant tag format 


// added invoice selects because it made sence
// next two funtion retrieve the shipping method
function getshipping() {
  var usession = getmsession();
  var updateurl = "includes/php/cc_shipping_process.php?usession="; // The server-side script
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = getshipResponse;
  http.send(null);
}

function getshipResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].mship.options.length = 0;
    document.forms['custcareform'].ADD_mship.options.length = 0;
    document.forms['invoiceform'].binv_mship.options.length = 0;
    document.forms['poform'].spo_mship.options.length = 0;
    document.forms['utilform'].utilmship.options.length = 0;
     for (x in results)
    {
       
    
    r1 = results[x].split("|");
     if (trim(r1[0]) !=""){
      if (typeof r1[0] != "undefined")
      {
       document.forms['custcareform'].mship.options[x] = new Option(r1[0],r1[0],true,false);
       document.forms['custcareform'].ADD_mship.options[x] = new Option(r1[0],r1[0],true,false);
       document.forms['invoiceform'].binv_mship.options[x] = new Option(r1[0],r1[0],true,false);
       document.forms['poform'].spo_mship.options[x] = new Option(r1[0],r1[0],true,false);
       document.forms['utilform'].utilmship.options[x] = new Option(r1[0],r1[0],true,false);
      }  
     }
    }

      if (document.forms['custcareform'].mship.options.length == 0)
       {
          document.forms['custcareform'].mship.options[x] = new Option("No shipping methods."," ",true,false);
          document.forms['custcareform'].ADD_mship.options[x] = new Option("No shipping methods."," ",true,false);
          document.forms['invoiceform'].binv_mship.options[x] = new Option("No shipping methods."," ",true,false);
          document.forms['poform'].spo_mship.options[x] = new Option("No shipping methods."," ",true,false);
          document.forms['utilform'].utilmship.options[x] = new Option("No shipping methods."," ",true,false);
       }
//Add a select for no file type
//var i=document.forms['custcareform'].mship.options.length;

//removed per carol 8/1/08
//document.forms['custcareform'].mship.options[i] = new Option("No Shipping Method"," ",true,false);
//document.forms['custcareform'].ADD_mship.options[i] = new Option("No Shipping Method"," ",true,false);
//document.forms['invoiceform'].binv_mship[i] = new Option("No Shipping Method"," ",true,false);
//document.forms['poform'].spo_mship[i] = new Option("No Shipping Method"," ",true,false);
//document.forms['utilform'].utilmship[i] = new Option("No Shipping Method"," ",true,false);

getterms();
  }
}
// end of shipping 



// next two funtions retrieve the payment terms
function getterms() {
  var usession = getmsession();
  var updateurl = "includes/php/cc_terms_process.php?usession="; // The server-side script
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = gettermsResponse;
  http.send(null);
  
}

function gettermsResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['custcareform'].mterms.options.length = 0;
    document.forms['custcareform'].ADD_mterms.options.length = 0;
    document.forms['invoiceform'].binv_mterms.options.length = 0;
    document.forms['poform'].spo_mterms.options.length = 0;
    document.forms['utilform'].utilmterms.options.length = 0;
    
     for (x in results)
    {
       
    
    r1 = results[x].split("|");
     if (trim(r1[0]) !=""){
      if (typeof r1[0] != "undefined")
      {
	      
       document.forms['custcareform'].mterms.options[x] = new Option(r1[0],r1[0],true,false);
       document.forms['custcareform'].ADD_mterms.options[x] = new Option(r1[0],r1[0],true,false);
       document.forms['invoiceform'].binv_mterms[x] = new Option(r1[0],r1[0],true,false);
       document.forms['poform'].spo_mterms[x] = new Option(r1[0],r1[0],true,false);
       r1[0] = padRight(r1[0],' ',17);
       document.forms['utilform'].utilmterms.options[x] = new Option(r1[0]+r1[1],r1[0]+'|'+r1[1],true,false);
      }  
     }
    }

      if (document.forms['custcareform'].mterms.options.length == 0)
       {
          document.forms['custcareform'].mterms.options[x] = new Option("No terms."," ",true,false);
          document.forms['custcareform'].ADD_mterms.options[x] = new Option("No terms."," ",true,false);
          document.forms['invoiceform'].binv_mterms[x] = new Option("No terms."," ",true,false);
          document.forms['poform'].spo_mterms[x] = new Option("No terms."," ",true,false);
          document.forms['utilform'].utilmterms.options[x] = new Option("No terms."," ",true,false);
       }
//Add a select for terms
//var i=document.forms['custcareform'].mterms.options.length;
//removed per carol 8/1
//document.forms['custcareform'].mterms.options[i] = new Option("No terms"," ",true,false);
//document.forms['custcareform'].ADD_mterms.options[i] = new Option("No terms"," ",true,false);
//document.forms['invoiceform'].binv_mterms[i] = new Option("No terms"," ",true,false);
//document.forms['poform'].spo_mterms[i] = new Option("No terms"," ",true,false);
//document.forms['utilform'].utilmterms.options[i] = new Option("No terms"," ",true,false);
//restorethisform(1);
utilgetsales();
  }
}
// end of terms 




// this is only called when for pat/randy/chris
// sales commission

// next two funtions retrieve the salesmen
function getsalesperson() {
  var usession = getmsession();
  var mid=trim(document.getElementById('mcustid').value);
  
  var updateurl = "includes/php/cc_getsales_process.php?usession="; // The server-side script
  http.open("GET", updateurl  + escape(usession)+ "&mid=" +escape(mid), true);
  http.onreadystatechange = getsalespersonResponse;
  http.send(null);
}

function getsalespersonResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array
//alert('back from cc_getsales.php');
    var abc=http.responseText;
    //alert(abc);
    
    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].salesperson.options.length = 0;
    document.forms['custcareform'].salesperson.options[0] = new Option("No Salesperson","SZ|0.00|    ",true,false);
    var xcnt=0;
    for (x in results){
	    
	  if (x > 0){
		
          r1 = results[x].split("|");
         //alert(r1[2]);
	       if (trim(r1[2]) !=""){
		     if (r1[2] !=null){  
		      xcnt=(xcnt+1);
	         //pad out the select 
	        
	          r1[0]=trim(r1[0]);
	          r1[1]=trim(r1[1]);
	          r1[2]=trim(r1[2]);
	          
	          var mfirstletter=r1[2].substring(0,1); 
              var mrestofletters=r1[2].substring(1);
	          mfirstletter=mfirstletter.toUpperCase();
	          r1[2]=mfirstletter+mrestofletters;
	          if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',5)};
              if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',12)};  
               document.forms['custcareform'].salesperson.options[xcnt] = new Option(r1[2],trim(r1[0])+"|"+trim(r1[1]),true,false);
             }                         
           } // end of empty test
           
                 
       } //end of skip past 1st record- split the first record and tag with current salesman    
       
       
    } // end of loop

    
    //alert(results[0]);
    //put in loop to select the current one based on results[0]
    comp1= new Array();
    comp2= new Array();
    
    comp1 = results[0].split("|");
    //alert(comp1[0]);
    document.getElementById('mcommrate').value=comp1[1];
    xz=0;
    
    while (xz < document.forms['custcareform'].salesperson.options.length){
    
       var tempVar=document.forms['custcareform'].salesperson.options[xz].value;
       comp2 = tempVar.split("|");
       
       //alert(comp1[0]+" | "+comp2[0]);
       if (comp1[0]==comp2[0]){   
   		 document.forms['custcareform'].salesperson.selectedIndex=xz;
   		 break;
       }   

        tempVar="";
	       
       xz =(xz+1);
    } //end of while loop
  
    
    
    

  } //end of listener responce

}
// end of salesperson  

// next two funtions retrieve the salesmen
function updatesales() {
  var updateurl = "includes/php/cc_updatesales_process.php?usession="; // The server-side script
  var usession = getmsession();
   
  s = new Array();
  sv= new Array();
  
  s[0] = trim(document.getElementById('mcustid').value);
  s[1] = trim(document.getElementById('company').value);
  
  var msel=document.forms['custcareform'].salesperson.selectedIndex;
  var tempVal=document.forms['custcareform'].salesperson.options[msel].value;
  sv = tempVal.split("|");
  s[2]=sv[0]; 

  s[3]=document.getElementById('mcommrate').value;
  s[4]=document.getElementById('OLD_ID').value;
  
  //alert("cust_id: "+s[0]+"  Company: "+s[1]+" Salesperson: "+s[2]+"  Rate: "+s[3]+"  Old ID: "+s[4]);
  
  s[1]=s[1].replace(/\'/g,"zpos");
  s[1]=s[1].replace(/\,/g,"zcomma");
  
  
  http.open("GET", updateurl  + escape(usession)+ "&ms=" +escape(s), true);
  http.onreadystatechange = updatesalesResponse;
  http.send(null);
}

function updatesalesResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    //alert(abc);
    document.getElementById('confirmtext').innerHTML=abc;
    showconfirm();
    
    getsalesperson();
  } //end of listener responce

}
// end of salesperson  




//UTILITY SALES EDITS

// next two funtions retrieve the salesmen
function utilgetsales() {
  var usession = getmsession();
  
  var updateurl = "includes/php/cc_utilsales_process.php?usession="; // The server-side script
  http.open("GET", updateurl  + escape(usession), true);
  http.onreadystatechange = utilgetsalesResponse;
  http.send(null);
}

function utilgetsalesResponse() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    var abc=http.responseText;
    //alert(abc);
    
    results = http.responseText.split("^");
    r1= new Array();
    document.forms['utilform'].utilsales.options.length = 0;
    document.forms['utilform'].utilsales2.options.length = 0;
    document.forms['utilform'].utilsales2.options[0] = new Option('Do not filter on sales.','none',true,false);
          
    var vb=0;
    for (x in results){
	    
	    r1 = results[x].split("|");
        if (trim(r1[0]) !=""){
	        
         if (typeof r1[0] != "undefined"){
	       //pad out the select 
	       r1[0]=trim(r1[0]);
	       r1[1]=trim(r1[1]);
	       r1[2]=trim(r1[2]);
	       r1[3]=trim(r1[3]);
	       vb=(vb+1);
	       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',5)};
           if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',12)};  
           if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',12)};
           if (r1[3] != undefined){r1[3] = padRight(r1[3],' ',12)};
           if (r1[4] != undefined){r1[4] = padRight(r1[4],' ',2)};  
           document.forms['utilform'].utilsales.options[x] = new Option(r1[0]+r1[1]+r1[2]+trim(r1[3])+"%",trim(r1[0])+"|"+trim(r1[1])+"|"+trim(r1[2])+"|"+trim(r1[3])+"|"+trim(r1[4]),true,false);
           document.forms['utilform'].utilsales2.options[vb] = new Option(r1[1],trim(r1[0])+"|"+trim(r1[1]),true,false);
          
         } // end of undefined test
           
        } // end of empty test
       
      
       
    } // end of loop

     
     if (document.forms['utilform'].utilsales.options.length == 0){ 
         document.forms['utilform'].utilsales.options[0] = new Option("No sales representatives found."," ",true,false);
         document.forms['utilform'].utilsales2.options[0] = new Option("No sales representatives found."," ",true,false);

     } 
  
    
    
    //moved from terms for chain
    buildstate();
    //restorethisform(1);
    getstatus();
  } //end of listener responce

}


function setcomm(){
	
	var tempsel=document.forms['custcareform'].salesperson.selectedIndex;
	var tempval=document.forms['custcareform'].salesperson.options[tempsel].value;
    msel= new Array();
    msel = tempval.split("|");
    document.getElementById('mcommrate').value=msel[1];
   	
}	
// end of salesperson  

function buildstate(){
	//no need for a data base for this- just add loops for state boxes as added
	 s = new Array();
	 
  	  s[0]='AL';
	  s[1]='AK';
	  s[2]='AZ';
	  s[3]='AR';
	  s[4]='CA';
	  s[5]='CO';
	  s[6]='CT';
	  s[7]= 'DE';
	  s[8]= 'DC';
	  s[9]= 'FL';
	  s[10]= 'GA';
	  s[11]= 'HI';
	  s[12]= 'ID';
	  s[13]= 'IL';
	  s[14]= 'IND';
	  s[15]= 'IA';
	  s[16]= 'KS';
	  s[17]= 'KY';
	  s[18]= 'LA';
	  s[19]= 'ME';
	  s[20]= 'MD';
	  s[21]= 'MA';
	  s[22]= 'MI';
	  s[23]= 'MN';
	  s[24]= 'MS';
	  s[25]= 'MO';
	  s[26]= 'MT';
	  s[27]= 'NE';
	  s[28]= 'NV';
	  s[29]= 'NH';
	  s[30]= 'NJ';
	  s[31]= 'NM';
	  s[32]= 'NY';
	  s[33]= 'NC';
	  s[34]= 'ND';
	  s[35]= 'OH';
	  s[36]= 'OK';
	  s[37]= 'OR';
	  s[38]= 'PA';
	  s[39]= 'RI';
	  s[40]= 'SC';
	  s[41]= 'SD';
	  s[42]= 'TN';
	  s[43]= 'TX';
	  s[44]= 'UT';
	  s[45]= 'VT';
	  s[46]= 'VA';
	  s[47]= 'WA';
	  s[48]= 'WV';
	  s[49]= 'WI'; 
	  s[50]= 'WY';	      
	
     //do count one first- add one for edits and records adds as well
     document.forms['ticketform'].cntstselect.options.length = 0;
    
     var xcnt=0
     while (xcnt < 51){ 

       document.forms['ticketform'].cntstselect.options[xcnt] = eval('new Option("'+s[xcnt]+'","'+s[xcnt]+'",true,false);');
       //eight default states
       if (xcnt==1 || xcnt==4 || xcnt==12 || xcnt==26 || xcnt==28 || xcnt==37 || xcnt==44 || xcnt==47){
          document.forms['ticketform'].cntstselect.options[xcnt].selected=true;
       }       
       xcnt=xcnt+1
     }    
     
	document.forms['ticketform'].cntstselect.options[xcnt] = new Option("SELECT ALL","All",true,false);
	
}	

function buildslsqyr(){
	var d = new Date();
    var myear=d.getYear();
    
    //do count one first- add one for edits and records adds as well
    document.forms['ticketform'].Qyear.options.length = 0;
    document.forms['utilform'].UQyear.options.length = 0;
    var xcnt=0;
    myearcnt=myear;
    while (xcnt < 6){ 
	    
	   if (xcnt !=0){myearcnt=(myearcnt-1)};
	   
       document.forms['ticketform'].Qyear.options[xcnt] = new Option(myearcnt,myearcnt,true,false);
       document.forms['utilform'].UQyear.options[xcnt] = new Option(myearcnt,myearcnt,true,false);
       xcnt=xcnt+1
    }    
     
   	
}	

// next two funtions retrieve the payment terms
function getstatus() {
  var usession = getmsession();
  var updateurl = "includes/php/cc_status_process.php?usession="; // The server-side script
  http.open("GET", updateurl + escape(usession), true);
  http.onreadystatechange = getstatusResponse;
  http.send(null);
  
}



function getstatusResponse() {
  if (http.readyState == 4) {
    
    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['custcareform'].thestatus.options.length = 0;
    
     for (x in results){
       
       r1 = results[x].split("|");
       if (trim(r1[0]) !=""){
         if (typeof r1[0] != "undefined"){
	       document.forms['custcareform'].thestatus.options[x] = new Option(r1[1],r1[0]+"|"+r1[1],true,false);
         }  
       }
     }

     if (document.forms['custcareform'].thestatus.options.length == 0){
       document.forms['custcareform'].thestatus.options[x] = new Option("No Status."," ",true,false);
     }

     getFOXweek();

  } //end of responce
}
// end of terms 




// next two funtions retrieve the payment terms
function getFOXweek() {
  var updateurl = "includes/php/cc_getfoxweek.php"; // The server-side script
  http.open("GET", updateurl, true);
  http.onreadystatechange = getFOXweekResponse;
  http.send(null);
  
}



function getFOXweekResponse() {
  if (http.readyState == 4) {
	 //alert(http.responseText);
	 document.getElementById('foxweek').value=http.responseText;
	 initalcust(document.getElementById('passedid').value);
     getschemadefine();
  } //end of responce
}
// end of terms 



// next two funtions retrieve the salesmen
function getschemadefine() {
  var usession = getmsession();
  var mid=trim(document.getElementById('mcustid').value);
  
  var updateurl = "includes/php/cc_getschema_define.php?usession="; // The server-side script
  http.open("GET", updateurl  + escape(usession)+ "&mid=" +escape(mid), true);
  http.onreadystatechange = getschemadefineResponse;
  http.send(null);
}

function getschemadefineResponse() {
  if (http.readyState == 4) {
 
    var abc=http.responseText;
    //alert(abc);
    
    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].schemadefine.options.length = 0;
    document.forms['custcareform'].schemadefine.options[0] = new Option("NO SCHEMA SET","NONE",true,false);
    var xcnt=0;
    for (x in results){
	    
	  //if (x > 0){
		
          r1 = results[x].split("|");
         //alert(r1[2]);
	       if (trim(r1[1]) !=""){
		     if (r1[1] !=null){  
		      xcnt=(xcnt+1);
	           document.forms['custcareform'].schemadefine.options[xcnt] = new Option(r1[1],r1[0],true,false);
             }                         
           } // end of empty test
           
                 
      //} //end of skip past 1st record- split the first record and tag with current salesman    
       
       
    } // end of loop
  
    //this needs to be the last
    initalcust(document.getElementById('passedid').value);
    

  } //end of listener responce

}
// end of salesperson  
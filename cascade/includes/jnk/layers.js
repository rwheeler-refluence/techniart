//the next 3 lines are browser detection for user-agent DOMS
ns4 = (document.layers) ? true:false //required for Functions to work
ie4 = (document.all) ? true:false //required for Functions to work
generic = (document.getElementById) ? true:false //required for Functions to work
 

// the next two are for the three department layers
function showSec(n) {
document.getElementById('statblockvalues').style.visibility = "hidden";
hideSec();
hidecust();
hideaddacct();
hideupld();
hideSKUutil();
document.getElementById('bugscr').style.visibility = "hidden";
document.getElementById('invcanscr').style.visibility = "hidden";
document.getElementById('invcanmess').value="";

document.getElementById('projselect').style.visibility = "hidden";
document.getElementById('asignsales').style.visibility ='hidden';
document.getElementById('salesperson').style.visibility ='hidden';	


if (document.getElementById('utilsaleslayer').style.visibility = "visible") {document.getElementById('utilsaleslayer').style.visibility ='hidden'};


if (generic) document.getElementById('sec' + n).style.visibility = "visible";
else if (ns4) document.layers["sec" + n].visibility = "show";
else if (ie4) document.all["sec" + n].style.visibility = "visible";

 if (n==1) {
  
  if (document.getElementById('ucoid').value=="CIS"){
    showcust(1);
  } else {
	showcust(5);  
  }	 	 
  //showcust(1);
  
  document.getElementById('mterms').style.visibility = "visible";
  document.getElementById('mcust').style.visibility = "visible";
 } else {
 document.getElementById('mterms').style.visibility = "hidden";
 document.getElementById('mcust').style.visibility = "hidden";
 
 //document.getElementById('tkselect').style.visibility = "hidden";
 //document.getElementById('userselect').style.visibility = "hidden";
 if (document.getElementById('filetype').style.visibility = "visible") {document.getElementById('filetype').style.visibility = "hidden"};
//SRVCTYPE
 //document.getElementById('tagformat').style.visibility = "hidden";
 //document.getElementById('ncoaselect').style.visibility = "hidden";
 //document.getElementById('mship').style.visibility = "hidden";
 //document.getElementById('addselect').style.visibility = "hidden";
 }

 
  if (n==1) {
    document.getElementById('mcustscreenup').value = "YES";
     
  } else {
    document.getElementById('mcustscreenup').value = "NO"; 
  }

  if (n==2) {
	document.getElementById('sec2').style.zIndex=1000; 
    hidetk_stk();
    hidetk_addstk();
    clrtk_Fields();
    clrtk_addFields();
    
    if (document.getElementById('loglevel').value.substring(0,1)=='S'){
	    document.getElementById('rptbtn').innerHTML='Sales Rpt';
	    document.getElementById('countsbtn').style.visibility = "hidden";
	} else { 
		document.getElementById('rptbtn').innerHTML='Daily Rpt';
		document.getElementById('countsbtn').style.visibility = "visible";
	}
    
    document.getElementById('mtktscreenup').value = "YES";
    document.getElementById('mcust').style.visibility = "hidden";
    document.getElementById('tkselectMain').style.visibility =  "hidden";

    //trying to get this a little smoother
    document.getElementById('tkrptselect').style.visibility =  "hidden";
    document.getElementById('tkwhofilter').style.visibility =  "hidden";
    document.getElementById('tkclientfilter').style.visibility =  "hidden";
    document.getElementById('tktypefilter').style.visibility =  "hidden";
 
    gettktypes();  //calls tk_type.js which then calls tkCTK()

  } else {
    document.getElementById('sec2').style.zIndex=20;
    document.getElementById('mtktscreenup').value = "NO";
    document.getElementById('tkselectMain').style.visibility =  "hidden";
    document.getElementById('tkrptselect').style.visibility =  "hidden";

    document.getElementById('tkwhofilter').style.visibility =  "hidden";
    document.getElementById('tkclientfilter').style.visibility =  "hidden";
    document.getElementById('tktypefilter').style.visibility =  "hidden";
    
    
    document.getElementById('voidbtn').style.visibility = "hidden";
    document.getElementById('tksavebtn').style.visibility = "hidden";
    document.getElementById('tkinvbtn').style.visibility = "hidden";
    document.getElementById('tkpobtn').style.visibility = "hidden";
    document.getElementById('clsjobbtn').style.visibility = "hidden";
    document.getElementById('tkeditbtn').style.visibility = "hidden";
    document.getElementById('tkviewinvbtn').style.visibility = "hidden"; 
    document.getElementById('tkmoveid').style.visibility = "hidden";
    
    hidetk_stk();
    hidetk_addstk();
    clrtk_Fields();
    clrtk_addFields();

  }


  //accouting screen
  if (n==3) {
    document.getElementById('macctscreenup').value = "YES";
    document.getElementById('sec3').style.zIndex=1000;
    
    document.getElementById('tkselectAcctng').style.visibility =  "visible";
    document.getElementById('acctngclientfilter').style.visibility =  "visible";
    document.getElementById('invdelbtn').style.visibility =  "hidden";
    document.getElementById('invbutton').style.visibility =  "hidden";
     //need to make sure this has nothing in it b4 loading- if sync'd needs to stay on
     if (document.forms['acctngform'].tkselectAcctng.options.length == 0){
        document.getElementById('a_opentkbox').checked = true;
        getacctngrec("A");
     }
  } else {
  
    document.getElementById('macctscreenup').value = "NO";
    document.getElementById('sec3').style.zIndex=10;
    document.getElementById('tkselectAcctng').style.visibility =  "hidden";
    document.getElementById('acctngclientfilter').style.visibility =  "hidden";	
    document.getElementById('invdelbtn').style.visibility =  "hidden";
    
  }

  if (n==4) {
	document.getElementById('sec4').style.zIndex=1000;  
    document.getElementById('mmktscreenup').value = "YES";
    getBCM();

  } else {
	document.getElementById('sec4').style.zIndex=10;  
    document.getElementById('mmktscreenup').value = "NO"; 
    document.getElementById('bcmselect').style.visibility = "hidden";
  }


 if (n==5) {
	document.getElementById('sec5').style.zIndex=1000; 
    document.getElementById('upscreenup').value = "YES";
    showupld(1);

  } else {
    document.getElementById('sec5').style.zIndex=10;
    hideupld();
    document.getElementById('upscreenup').value = "NO"; 
    
  }

  
  if (n==6) {
	//alert(n);
	document.getElementById('sec6').style.zIndex=1000;
	document.getElementById('adminmainlayer').style.zIndex=1500;  
    document.getElementById('adminscreenup').value = "YES";
    if (document.getElementById('filetype').style.visibility = "visible") {document.getElementById('filetype').style.visibility = "hidden"};
    document.getElementById('thefilelayer').style.zIndex=1;
    document.getElementById('theprojectlayer').style.zIndex=1;
    document.getElementById('theprojecteditlayer').style.zIndex=1;
    getthesurveys(); //this function is in cc_get_survey.js
  } else {

    document.getElementById('adminscreenup').value = "NO"; 
    document.getElementById('sec6').style.zIndex=10; 
  }
  
  buildslsqyr();
  
  var acctngTest=trim(document.getElementById('acctng_mid').value);
  if (acctngTest !="" && acctngTest !="Enter ID or all/part of name"){
	if (n==1){ 
   	  // alert(acctngTest); 
   	  document.forms['custcareform'].mcust.options.length = 0;
	  getCinfo("N","N","YES"); 
    }  
  }	  

}

function hideSec() {

document.getElementById('unlockbt').style.visibility = "hidden";
document.getElementById('exportbutton').style.visibility = "hidden";
document.getElementById('addchngbt').style.visibility = "hidden";


if (generic) document.getElementById('sec1').style.visibility = "hidden"
else if (ns4) document.sec1.visibility = "hide"
else if (ie4) sec1.style.visibility ="hidden"

if (generic) document.getElementById('sec2').style.visibility = "hidden"
else if (ns4) document.sec2.visibility = "hide"
else if (ie4) sec2.style.visibility ="hidden"

if (generic) document.getElementById('sec3').style.visibility = "hidden"
else if (ns4) document.sec3.visibility = "hide"
else if (ie4) sec3.style.visibility ="hidden"

if (generic) document.getElementById('sec4').style.visibility = "hidden"
else if (ns4) document.sec4.visibility = "hide"
else if (ie4) sec4.style.visibility ="hidden"

if (generic) document.getElementById('sec5').style.visibility = "hidden"
else if (ns4) document.sec5.visibility = "hide"
else if (ie5) sec5.style.visibility ="hidden"

if (generic) document.getElementById('sec6').style.visibility = "hidden"
else if (ns4) document.sec6.visibility = "hide"
else if (ie5) sec6.style.visibility ="hidden"


}



// the next two are for the comment layer on the cust care tab
function shownote(n) {
hidenote();

if (generic) document.getElementById('com' + n).style.visibility = "visible";
else if (ns4) document.layers["com" + n].visibility = "show";
else if (ie4) document.all["com" + n].style.visibility = "visible";

}

function hidenote() {
if (generic) document.getElementById('com1').style.visibility = "hidden"
else if (ns4) document.com1.visibility = "hide"
else if (ie4) com1.style.visibility ="hidden"


if (generic) document.getElementById('com2').style.visibility = "hidden"
else if (ns4) document.com2.visibility = "hide"
else if (ie4) com2.style.visibility ="hidden"

if (generic) document.getElementById('com3').style.visibility = "hidden"
else if (ns4) document.com3.visibility = "hide"
else if (ie4) com3.style.visibility ="hidden"


}

function showutil(un) {
document.getElementById('adminmainlayer').style.zIndex=10;
if (un==1){
  document.getElementById('util1').style.zIndex=1000;
  	
} else {
  document.getElementById('util1').style.zIndex=20; 
}	
 
	
if (un==2){
  document.getElementById('util2').style.zIndex=1000; 	
  document.getElementById('projselect').style.visibility = "visible";
  document.getElementById('projscreenup').value="YES";
  document.getElementById('currentprojsel').value="0";
  hideshowln();
  getpusers();
} else {
	document.getElementById('util2').style.zIndex=20; 
	
}	
 

   
 if (document.getElementById('filetype').style.visibility = "visible") {document.getElementById('filetype').style.visibility = "hidden"};
 if (document.getElementById('mcust').style.visibility = "visible") {document.getElementById('mcust').style.visibility = "hidden"};

if (generic) document.getElementById("util" + un).style.visibility = "visible";
else if (ns4) document.layers["util" + un].visibility = "show";
else if (ie4) document.all["util" + un].style.visibility = "visible";

    //salesman files
	if (un==1){
    	var mnm=document.getElementById('uname').value;
		if (mnm=="PatZ" || mnm=="ChrisZ" || mnm=="RandyZ" || mnm=="RichZ" || mnm=="Stephen" || mnm=="CrisZ"){
		  document.getElementById('utilsaleslayer').style.visibility ='visible';
		  
		  utilgetsales();
		} else {
		  document.getElementById('utilsaleslayer').style.visibility ='hidden';
		  
		}	
	}	

}

function hideutil(un) {
document.getElementById('utilsaleslayer').style.visibility ='hidden';
document.getElementById('util_salerecnum').value=0;
if (un==2){
  document.getElementById('projselect').style.visibility = "hidden";
  document.forms['utilform'].projselect.options.length = 0;
  document.getElementById('projwhofilter').selectedIndex=-1;
  document.getElementById('projscreenup').value="NO";
  
  document.getElementById('uplayer').style.visibility = "hidden"; 
  document.getElementById('downlayer').style.visibility = "hidden";
  document.getElementById('toplayer').style.visibility = "hidden"; 
  document.getElementById('bottomlayer').style.visibility = "hidden"; 
  <!--document.getElementById('resortlayer').style.visibility = "hidden"; -->
  document.getElementById('movetolayer').style.visibility = "hidden";
  document.getElementById('movetolayer2').style.visibility = "hidden"; 
  
}

//if (generic) document.getElementById('util1').style.visibility = "hidden"
//else if (ns4) document.util1.visibility = "hide"
//else if (ie4) util1.style.visibility ="hidden"

if (generic) document.getElementById("util" + un).style.visibility = "hidden";
else if (ns4) document.layers["util" + un].visibility = "hide";
else if (ie4) document.all["util" + un].style.visibility = "hidden";
document.getElementById('adminmainlayer').style.zIndex=1500;
}

// the next two are for the comment layer on account add screen
function showaddnote(n) {
hideaddnote();
if (generic) document.getElementById('addcom' + n).style.visibility = "visible";
else if (ns4) document.layers["addcom" + n].visibility = "show";
else if (ie4) document.all["addcom" + n].style.visibility = "visible";
}

function hideaddnote() {
if (generic) document.getElementById('addcom1').style.visibility = "hidden"
else if (ns4) document.addcom1.visibility = "hide"
else if (ie4) addcom1.style.visibility ="hidden"

if (generic) document.getElementById('addcom2').style.visibility = "hidden"
else if (ns4) document.addcom2.visibility = "hide"
else if (ie4) addcom2.style.visibility ="hidden"

if (generic) document.getElementById('addcom3').style.visibility = "hidden"
else if (ns4) document.addcom3.visibility = "hide"
else if (ie4) addcom3.style.visibility ="hidden"

}



// the next two are for the multiple tabs under custcare
function showcust(n) {
document.getElementById('statblockvalues').style.visibility = "hidden";	
hidecust();


//added this as a start to cleaning up the layers- really need to tear this down and re-do all the layers
//combining many of them into one and getting the hide/show on selects to each screen and stop doing it from around
//the package

if (n==1){
  document.getElementById('filetype').style.visibility = "visible";
    var mnm=document.getElementById('uname').value;
    document.getElementById('asignsales').style.visibility ='visible';
	document.getElementById('salesperson').style.visibility ='visible'; 
	
    if (mnm=="Pat" || mnm=="Chris" || mnm=="Randy" || mnm=="Stephen" || mnm=="Mary" || mnm=="Rich" || mnm=="Cris"){
	  document.getElementById('saleschange').style.visibility ='visible';  	
	  //getsalesperson();
	} else {
	  document.getElementById('saleschange').style.visibility ='hidden'; 	
		
    }		
  
	
	
} else {
  document.getElementById('filetype').style.visibility = "hidden";
  document.getElementById('asignsales').style.visibility ='hidden';
  
  document.getElementById('asignsales').style.visibility ='hidden';
  document.getElementById('salesperson').style.visibility ='hidden'; 
  document.getElementById('saleschange').style.visibility ='hidden';  			
}		

if (n==1){
	document.getElementById('tagformat').style.visibility = "visible";
} else {
	document.getElementById('tagformat').style.visibility = "hidden";
}
	
if (n==3){
	document.getElementById('ncoaselect').style.visibility = "visible";
} else {
	document.getElementById('ncoaselect').style.visibility = "hidden";
}	

if (n==5){
	document.getElementById('userselect').style.visibility = "visible";
} else {
	document.getElementById('userselect').style.visibility = "hidden";
}
	
if (n==6){
	document.getElementById('tkselect').style.visibility = "visible";
} else {
	document.getElementById('tkselect').style.visibility = "hidden";
}	

if (n==7){
	document.getElementById('mship').style.visibility = "visible";
} else {
	document.getElementById('mship').style.visibility = "hidden";
}	

if (n==8){
	document.getElementById('addselect').style.visibility = "visible";
} else {
	document.getElementById('addselect').style.visibility = "hidden";
}	


if (n !=2 || document.getElementById('CIStoggle').checked == true){ 
	
  if (generic) document.getElementById('cust' + n).style.visibility = "visible";
  else if (ns4) document.layers["cust" + n].visibility = "show";
  else if (ie4) document.all["cust" + n].style.visibility = "visible";
} 

if (n ==2 && document.getElementById('CIStoggle').checked != true){ 
  document.getElementById('schematab').style.visibility ='hidden';
	
  if (generic) document.getElementById('noschema').style.visibility = "visible";
  else if (ns4) document.layers["noschema"].visibility = "show";
  else if (ie4) document.all["noschema"].style.visibility = "visible";

}
	

if (n==6) {getCTK()}; //five is the job ticket tab
if (n==4) {
  document.getElementById('tmscreen').style.visibility = "visible";
  document.getElementById('tmoutputtype').style.visibility = "visible"; 
  document.getElementById('tmoutputselect').style.visibility = "visible";
  document.getElementById('tmfiletypeselect').style.visibility = "visible"; 
  document.getElementById('tmlabelselect').style.visibility = "visible"; 
  document.getElementById('tmshipselect').style.visibility = "visible"; 

  
  
  
  
  //gettm();checktmship();
  checktmship();
} else {
  document.getElementById('tmmessagediv').style.visibility = "hidden";
  document.getElementById('tmshipresult').style.visibility = "hidden";
  document.getElementById('tmshipresult1').style.visibility = "hidden";
  document.getElementById('tmshipresult2').style.visibility = "hidden";
  document.getElementById('tmshipresult3').style.visibility = "hidden";
  document.getElementById('tmshipresult4').style.visibility = "hidden";
  document.getElementById('tmscreen').style.visibility = "hidden";
  document.getElementById('tmshipselect').style.visibility = "hidden"; 
  document.getElementById('tmoutputtype').style.visibility = "hidden"; 
  document.getElementById('tmoutputselect').style.visibility = "hidden";
  document.getElementById('tmfiletypeselect').style.visibility = "hidden"; 
  document.getElementById('tmlabelselect').style.visibility = "hidden"; 
}

if (n==5) {getUsers()}; //four is the users

if (n==8) {getAdd()}; //seven is addresses

if (n==2 && document.getElementById('CIStoggle').checked == true) {
	document.getElementById('schematab').style.visibility ='visible';
	getSchema();
	
} //seven is addresses
if (n==3) {getNCOA()}; //three is ncoa price table

if (n==9) {getBLprices()}; //eight is business list prices
if (n==10) {
	document.getElementById('statblockvalues').style.visibility = "hidden";
	getstats();
}; //nine is stats

//12 is d&B
if (n==12){
 if (document.getElementById('EditEnabled').value=="Y"){
    document.getElementById('dunnsearchbtn').style.visibility = "visible"; 
 }	
} else {
  document.getElementById('dunnsearchbtn').style.visibility = "hidden"; 

}	//end of 11


  //file type select playing havoc- turn it on for the tab if it's off
  //work on this when you get time/ only doing this on filetype-others are behaving????
  if (n==1) {
   if (document.getElementById('filetype').style.visibility = "hidden") {document.getElementById('filetype').style.visibility = "visible"};
  } else {
   if (document.getElementById('filetype').style.visibility = "visible") {document.getElementById('filetype').style.visibility = "hidden"};
  }

  //can't do this here since it is one of many first fires
  //currently moved to cc_(get_tm_fox.js) to be last in chain of pulling up customer
  //var mnm=document.getElementById('uname').value;
  //if (mnm=="Pat" || mnm=="Chris" || mnm=="Randy" || mnm=="Stephen"){
  //	  getsalesperson();
  //}	
  
}




function hidecust() {

// hide any showing popups
hidesuser();
hideoverride();
hidesadd();
hidestk();
hidesncoa();

document.getElementById('schematab').style.visibility ='hidden';
document.getElementById('noschema').style.visibility ='hidden';
document.getElementById('asignsales').style.visibility ='hidden';
if (generic) document.getElementById('cust1').style.visibility = "hidden"
else if (ns4) document.cust1.visibility = "hide"
else if (ie4) cust1.style.visibility ="hidden"

if (generic) document.getElementById('cust2').style.visibility = "hidden"
else if (ns4) document.cust2.visibility = "hide"
else if (ie4) cust2.style.visibility ="hidden"

if (generic) document.getElementById('cust3').style.visibility = "hidden"
else if (ns4) document.cust3.visibility = "hide"
else if (ie4) cust3.style.visibility ="hidden"

if (generic) document.getElementById('cust4').style.visibility = "hidden"
else if (ns4) document.cust4.visibility = "hide"
else if (ie4) cust4.style.visibility ="hidden"

if (generic) document.getElementById('cust5').style.visibility = "hidden"
else if (ns4) document.cust5.visibility = "hide"
else if (ie4) cust5.style.visibility ="hidden"

if (generic) document.getElementById('cust6').style.visibility = "hidden"
else if (ns4) document.cust6.visibility = "hide"
else if (ie4) cust6.style.visibility ="hidden"

if (generic) document.getElementById('cust7').style.visibility = "hidden"
else if (ns4) document.cust7.visibility = "hide"
else if (ie4) cust7.style.visibility ="hidden"
document.getElementById('contactadd').style.visibility = "hidden"; 

if (generic) document.getElementById('cust8').style.visibility = "hidden"
else if (ns4) document.cust8.visibility = "hide"
else if (ie4) cust8.style.visibility ="hidden"

if (generic) document.getElementById('cust9').style.visibility = "hidden"
else if (ns4) document.cust9.visibility = "hide"
else if (ie4) cust9.style.visibility ="hidden"

if (generic) document.getElementById('cust10').style.visibility = "hidden"
else if (ns4) document.cust10.visibility = "hide"
else if (ie4) cust10.style.visibility ="hidden"

if (generic) document.getElementById('cust11').style.visibility = "hidden"
else if (ns4) document.cust11.visibility = "hide"
else if (ie4) cust11.style.visibility ="hidden"

if (generic) document.getElementById('cust12').style.visibility = "hidden"
else if (ns4) document.cust12.visibility = "hide"
else if (ie4) cust12.style.visibility ="hidden"

}



// the next two are a center screen please wait message
function showwait() {

 //disable all selects while message up


 document.getElementById('mterms').disabled =true;
 document.getElementById('mcust').disabled = true;
 document.getElementById('tkselect').disabled = true;
 document.getElementById('userselect').disabled = true;
 document.getElementById('filetype').disabled = true;
 document.getElementById('tagformat').disabled = true;
 document.getElementById('ncoaselect').disabled = true;
 document.getElementById('mship').disabled = true;
 document.getElementById('addselect').disabled = true;

 document.getElementById('tmoutputtype').disabled = true; 
 document.getElementById('tmoutputselect').disabled = true;
 document.getElementById('tmfiletypeselect').disabled = true; 
 document.getElementById('tmlabelselect').disabled = true;
 document.getElementById('tmshipselect').disabled = true; 


if (document.getElementById('projscreenup').value=="YES"){
  document.getElementById('projselect').disabled =true;
  document.getElementById('projwhofilter').disabled =true;
  
}


if (document.getElementById('sprojscreenup').value== "YES"){
	document.getElementById('proj_status').disabled =true;
}
  
if (document.getElementById('mtksinglescrup').value == "YES"){
 document.getElementById('tktypeselect').disabled =true;
 document.getElementById('tkwhoselect').disabled =true;
 document.getElementById('tkcis1select').disabled =true;
}


if (document.getElementById('maddtkscrnup').value == "YES"){
 document.getElementById('tkclientadd').disabled =true;
 document.getElementById('addtktypeselect').disabled =true;
 document.getElementById('addtkwhoselect').disabled =true;
 document.getElementById('addtkcis1select').disabled =true;
}


if (document.getElementById('mtktscreenup').value == "YES"){   
 document.getElementById('tkrptselect').disabled =true;
 document.getElementById('tkselectMain').disabled =true;
 document.getElementById('tkwhofilter').disabled =true;
 document.getElementById('tkclientfilter').disabled =true;
 document.getElementById('tktypefilter').disabled =true;
}



if (document.getElementById('binvscreenup').value == "YES"){
 document.getElementById('binv_lnitems').disabled =true;
 document.getElementById('binv_mship').disabled =true;
 document.getElementById('binv_mterms').disabled =true;
 document.getElementById('binv_dept').disabled =true;
 document.getElementById('binv_unit').disabled =true;
  if (document.getElementById('binv_taxratelayer').style.visibility =="visible"){
   document.getElementById('binv_taxrate').disabled =true;
  } 
}
     
if (document.getElementById('sposcreenup').value == "YES"){

   document.getElementById('spo_mship').disabled =true;		
   document.getElementById('spo_mterms').disabled =true; 
   document.getElementById('spo_unit').disabled =true; 
   //document.getElementById('spo_dept').disabled =true;
   document.getElementById('spo_lnitems').disabled =true; 
}  

            

if (document.getElementById('mmktscreenup').value == "YES"){
  document.getElementById('bcmselect').disabled =true;
}

if (document.getElementById('macctscreenup').value == "YES"){
document.getElementById('tkselectAcctng').disabled =true;
document.getElementById('acctngclientfilter').disabled =true;
}

if (document.getElementById('poscreenup').value == "YES"){
 document.getElementById('po_sellist').disabled =true;
 
}

if (document.getElementById('adminscreenup').value == "YES"){
  document.getElementById('filetype_type').disabled = true; 
  document.getElementById('utilfiletype').disabled = true; 
  document.getElementById('utiltagformat').disabled = true;
  document.getElementById('utilmterms').disabled = true; 
  document.getElementById('utilmship').disabled = true;
  if (document.getElementById('utilsaleslayer').style.visibility =="visible"){
    document.getElementById('utilsales').disabled = true;
    document.getElementById('asignsales').style.visibility ='hidden';
  document.getElementById('salesperson').style.visibility ='hidden';
    
  }  
}

if (generic) document.getElementById('pleasewait').style.visibility = "visible";
else if (ns4) document.layers["pleasewait"].visibility = "show";
else if (ie4) document.all["pleasewait"].style.visibility = "visible";
}

function hidewait() {
if (document.getElementById('thefilelayer').style.visibility =='visible'){
  document.getElementById('asignsales').style.visibility ='hidden';
  document.getElementById('salesperson').style.visibility ='hidden';	
}
   //enable selects if edit is on
   if (document.getElementById('EditEnabled').value=="Y") {
     document.getElementById('mterms').disabled = false;
     document.getElementById('filetype').disabled = false;
     document.getElementById('tagformat').disabled = false;
     document.getElementById('mship').disabled = false;

   }
 
  document.getElementById('addselect').disabled = false;
  document.getElementById('ncoaselect').disabled = false;
  document.getElementById('userselect').disabled = false;
  document.getElementById('tkselect').disabled = false;
  document.getElementById('mcust').disabled = false;

  document.getElementById('tmoutputtype').disabled = false; 
  document.getElementById('tmoutputselect').disabled = false;
  document.getElementById('tmfiletypeselect').disabled = false; 
  document.getElementById('tmlabelselect').disabled = false;
  document.getElementById('tmshipselect').disabled = false;

if (document.getElementById('projscreenup').value=="YES"){
  document.getElementById('projselect').disabled =false;
  document.getElementById('projwhofilter').disabled =false;
  document.getElementById('proj_status').disabled =false;
}
 
if (document.getElementById('sprojscreenup').value== "YES"){
	document.getElementById('proj_status').disabled =false;
}

 
if (document.getElementById('adminscreenup').value == "YES"){     
  document.getElementById('mterms').style.visibility = "hidden";
  document.getElementById('filetype').style.visibility = "hidden";
  document.getElementById('tagformat').style.visibility = "hidden";
  document.getElementById('mship').style.visibility = "hidden";
  document.getElementById('addselect').style.visibility = "hidden";
  document.getElementById('ncoaselect').style.visibility = "hidden";
  document.getElementById('userselect').style.visibility = "hidden";
  document.getElementById('tkselect').style.visibility = "hidden";
  document.getElementById('mcust').style.visibility = "hidden";

  document.getElementById('tmoutputtype').style.visibility = "hidden"; 
  document.getElementById('tmoutputselect').style.visibility = "hidden";
  document.getElementById('tmfiletypeselect').style.visibility = "hidden"; 
  document.getElementById('tmlabelselect').style.visibility = "hidden";
  document.getElementById('tmshipselect').style.visibility = "hidden";

  document.getElementById('filetype_type').disabled = false; 
  document.getElementById('utilfiletype').disabled = false; 
  document.getElementById('utiltagformat').disabled = false;
  document.getElementById('utilmterms').disabled = false; 
  document.getElementById('utilmship').disabled = false;
  if (document.getElementById('utilsaleslayer').style.visibility =="visible"){
    document.getElementById('utilsales').disabled = false;
    document.getElementById('asignsales').style.visibility ='hidden';
    document.getElementById('salesperson').style.visibility ='hidden'; 
  } 	
}
	
if (document.getElementById('mtktscreenup').value == "YES"){   
   document.getElementById('tkrptselect').disabled =false;
   document.getElementById('tkselectMain').disabled =false;
   document.getElementById('tkwhofilter').disabled =false;
   document.getElementById('tkclientfilter').disabled =false;
   document.getElementById('tktypefilter').disabled =false;
}

if (document.getElementById('maddtkscrnup').value == "YES"){
   document.getElementById('tkclientadd').disabled =false;
   document.getElementById('addtktypeselect').disabled =false;
   document.getElementById('addtkwhoselect').disabled =false;
   document.getElementById('addtkcis1select').disabled =false;
}

if (document.getElementById('mtksinglescrup').value == "YES"){
   document.getElementById('tktypeselect').disabled =false;
   document.getElementById('tkwhoselect').disabled =false;
   document.getElementById('tkcis1select').disabled =false;
}

if (document.getElementById('mmktscreenup').value == "YES"){
  document.getElementById('bcmselect').disabled =false;
}

if (document.getElementById('macctscreenup').value == "YES"){
document.getElementById('tkselectAcctng').disabled =false;
document.getElementById('acctngclientfilter').disabled =false;
}

if (document.getElementById('binvscreenup').value == "YES"){
 document.getElementById('binv_lnitems').disabled =false;
 document.getElementById('binv_mship').disabled =false;
 document.getElementById('binv_mterms').disabled =false;
 document.getElementById('binv_dept').disabled =false;
 document.getElementById('binv_unit').disabled =false;
 if (document.getElementById('binv_taxratelayer').style.visibility =="visible"){
  document.getElementById('binv_taxrate').disabled =false;
 } 
}

if (document.getElementById('sposcreenup').value == "YES"){

   document.getElementById('spo_mship').disabled =false;		
   document.getElementById('spo_mterms').disabled =false; 
   document.getElementById('spo_unit').disabled =false; 
   //document.getElementById('spo_dept').disabled =false;
   document.getElementById('spo_lnitems').disabled =false;
    
}  


if (document.getElementById('poscreenup').value == "YES"){
 document.getElementById('po_sellist').disabled =false;
 
 
}


if (generic) document.getElementById('pleasewait').style.visibility = "hidden";
else if (ns4) document.layers["pleasewait"].visibility = "hide";
else if (ie4) document.all["pleasewait"].style.visibility = "hidden";



}



// the next two are a center screen showing single user
function showsuser() {
if (generic) document.getElementById('suser').style.visibility = "visible";
else if (ns4) document.layers["suser"].visibility = "show";
else if (ie4) document.all["suser"].style.visibility = "visible";

resetFieldColors();
 
}



function hidesuser() {

document.forms['custcareform'].userselect.selectedIndex=-1;

document.getElementById('usersave').style.visibility = "hidden";
document.getElementById('userdelete').style.visibility = "hidden";

if (generic) document.getElementById('suser').style.visibility = "hidden";
else if (ns4) document.layers["suser"].visibility = "hide";
else if (ie4) document.all["suser"].style.visibility = "hidden";
}


// the next two are a center screen showing single address
function showsadd() {
 //disable selects while message up
 document.getElementById('mcust').style.visibility = "hidden";

if (generic) document.getElementById('sadd').style.visibility = "visible";
else if (ns4) document.layers["sadd"].visibility = "show";
else if (ie4) document.all["sadd"].style.visibility = "visible";

resetFieldColors();

}




function hidesadd() {

document.forms['custcareform'].addselect.selectedIndex=-1;
document.getElementById('mcust').style.visibility =  "visible";
document.getElementById('contactupdate').style.visibility = "hidden";
document.getElementById('contactdelete').style.visibility = "hidden";
document.getElementById('adduserbt').style.visibility = "hidden";

if (generic) document.getElementById('sadd').style.visibility = "hidden";
else if (ns4) document.layers["sadd"].visibility = "hide";
else if (ie4) document.all["sadd"].style.visibility = "hidden";
}


function shownewaddr() {

if (generic) document.getElementById('newaddr').style.visibility = "visible";
else if (ns4) document.layers["newaddr"].visibility = "show";
else if (ie4) document.all["newaddr"].style.visibility = "visible";

}

function hidenewaddr() {

if (generic) document.getElementById('newaddr').style.visibility = "hidden";
else if (ns4) document.layers["newaddr"].visibility = "hide";
else if (ie4) document.all["newaddr"].style.visibility = "hidden";
}


// the next two are a center screen showing single tickets
function showstk() {
 document.getElementById('mcust').style.visibility = "hidden";

if (generic) document.getElementById('stk').style.visibility = "visible";
else if (ns4) document.layers["stk"].visibility = "show";
else if (ie4) document.all["stk"].style.visibility = "visible";

resetFieldColors();

}



function hidestk() {

//do this to hide invscr
document.getElementById('invcanscrup').value = "NO";	
document.getElementById('invcanmess').value="";
document.getElementById('invcanscr').style.visibility = "hidden";
	
document.forms['custcareform'].tkselect.selectedIndex=-1;
document.getElementById('tksave').style.visibility = "hidden";
 document.getElementById('mcust').style.visibility =  "visible";

if (generic) document.getElementById('stk').style.visibility = "hidden";
else if (ns4) document.layers["stk"].visibility = "hide";
else if (ie4) document.all["stk"].style.visibility = "hidden";

}




// the next two are a center screen showing single tickets on main ticket tab
function showtk_stk() {
document.getElementById('mtksinglescrup').value='YES';

document.getElementById('tkselectMain').style.visibility = "hidden";

document.getElementById('tkrptselect').style.visibility =  "hidden";
document.getElementById('tkwhofilter').style.visibility =  "hidden";
document.getElementById('tkclientfilter').style.visibility =  "hidden";
document.getElementById('tktypefilter').style.visibility =  "hidden";       

document.getElementById('tktypeselect').style.visibility =  "visible";
document.getElementById('tkwhoselect').style.visibility =  "visible";
document.getElementById('tkcis1select').style.visibility =  "visible";



if (generic) document.getElementById('tk_stk').style.visibility = "visible";
else if (ns4) document.layers["tk_stk"].visibility = "show";
else if (ie4) document.all["tk_stk"].style.visibility = "visible";

//resetFieldColors();

}

function hidetk_stk() {

//do this to hide invscr
document.getElementById('invcanscrup').value = "NO";	
document.getElementById('invcanmess').value="";
document.getElementById('invcanscr').style.visibility = "hidden";
document.getElementById('tkselectMain').style.visibility =  "visible";

if (generic) document.getElementById('tk_stk').style.visibility = "hidden";
else if (ns4) document.layers["tk_stk"].visibility = "hide";
else if (ie4) document.all["tk_stk"].style.visibility = "hidden";

document.getElementById('tktypeselect').style.visibility =  "hidden";
document.getElementById('tkwhoselect').style.visibility =  "hidden";
document.getElementById('tkcis1select').style.visibility =  "hidden";



//if main ticket is up show them
if (document.getElementById('mtktscreenup').value == "YES"){
	
   document.getElementById('tkrptselect').style.visibility =  "visible";
   document.getElementById('tkwhofilter').style.visibility =  "visible";
   document.getElementById('tkclientfilter').style.visibility =  "visible";
   document.getElementById('tktypefilter').style.visibility =  "visible"; 

   document.getElementById('voidbtn').style.visibility = "hidden";
   document.getElementById('tksavebtn').style.visibility = "hidden";
   document.getElementById('tkinvbtn').style.visibility = "hidden";
   document.getElementById('tkpobtn').style.visibility = "hidden";
   document.getElementById('clsjobbtn').style.visibility = "hidden";
   document.getElementById('tkeditbtn').style.visibility = "hidden";
   document.getElementById('tkviewinvbtn').style.visibility = "hidden";
   document.getElementById('tkmoveid').style.visibility = "hidden";
}



document.forms['ticketform'].tkselectMain.selectedIndex=-1;
document.getElementById('mtksinglescrup').value='NO';
}


// the next two are a center screen for adding single tickets on main ticket tab
function showtk_addstk() {
document.forms['ticketform'].tkclientadd.options.length = 0;
document.forms['ticketform'].tk_addmid.value = '';

document.getElementById('maddtkscrnup').value='YES';

document.getElementById('tkselectMain').style.visibility = "hidden";
document.getElementById('mtktscreenup').value ="YES";

//always hide all main screen selects
document.getElementById('tkrptselect').style.visibility =  "hidden";
document.getElementById('tkwhofilter').style.visibility =  "hidden";
document.getElementById('tkclientfilter').style.visibility =  "hidden";
document.getElementById('tktypefilter').style.visibility =  "hidden";       
 
//show the add selects
document.getElementById('tkclientadd').style.visibility =  "visible";
document.getElementById('addtktypeselect').style.visibility =  "visible";
document.getElementById('addtkwhoselect').style.visibility =  "visible";
document.getElementById('addtkcis1select').style.visibility =  "visible";



if (generic) document.getElementById('tk_addstk').style.visibility = "visible";
else if (ns4) document.layers["tk_addstk"].visibility = "show";
else if (ie4) document.all["tk_addstk"].style.visibility = "visible";

resetTKFieldColors();

}


function hidetk_addstk() {
//alert("called function");
document.getElementById('tkselectMain').style.visibility =  "visible";

//always hide the add ticket selects
document.getElementById('tkclientadd').style.visibility =  "hidden";
document.getElementById('addtktypeselect').style.visibility =  "hidden";
document.getElementById('addtkwhoselect').style.visibility =  "hidden";
document.getElementById('addtkcis1select').style.visibility =  "hidden";

if (generic) document.getElementById('tk_addstk').style.visibility = "hidden";
else if (ns4) document.layers["tk_addstk"].visibility = "hide";
else if (ie4) document.all["tk_addstk"].style.visibility = "hidden";


// show the main tk screen selects if main screen up
if (document.getElementById('mtktscreenup').value == "YES"){
  document.getElementById('tkrptselect').style.visibility =  "visible";
  document.getElementById('tkwhofilter').style.visibility =  "visible"; 
  document.getElementById('tkclientfilter').style.visibility =  "visible"; 
  document.getElementById('tktypefilter').style.visibility =  "visible";  
}



document.getElementById('maddtkscrnup').value='NO';
}



// the next two are a center screen for reporting bugs- same as single tk for background
function showbug() {

document.getElementById('bugscrup').value = "YES";
    
if (document.getElementById('mcustscreenup').value == "YES") {
  document.getElementById('mcust').style.visibility = "hidden";
}

//document.getElementById('mtktscreenup').value = "YES";

if (generic) document.getElementById('bugscr').style.visibility = "visible";
else if (ns4) document.layers["bugscr"].visibility = "show";
else if (ie4) document.all["bugscr"].style.visibility = "visible";

resetFieldColors();

}

function hidebug() {

document.getElementById('bugscrup').value = "NO";

if (document.getElementById('mcustscreenup').value == "YES") {
  document.getElementById('mcust').style.visibility =  "visible";
}

//document.getElementById('mtktscreenup').value = "NO";

if (generic) document.getElementById('bugscr').style.visibility = "hidden";
else if (ns4) document.layers["bugscr"].visibility = "hide";
else if (ie4) document.all["bugscr"].style.visibility = "hidden";

}




// the next two are a center screen changing NCOA prices
function showsncoa() {
if (generic) document.getElementById('sncoa').style.visibility = "visible";
else if (ns4) document.layers["sncoa"].visibility = "show";
else if (ie4) document.all["sncoa"].style.visibility = "visible";

resetFieldColors();

}

function hidesncoa() {
document.getElementById('ncoasave').style.visibility = "hidden";
if (generic) document.getElementById('sncoa').style.visibility = "hidden";
else if (ns4) document.layers["sncoa"].visibility = "hide";
else if (ie4) document.all["sncoa"].style.visibility = "hidden";
}





// the next two are a center screen input error message
function showemsg() {

if (document.getElementById('mcustscreenup').value == "YES") {

  if (document.getElementById('maddscreenup').value === "NO") {

   //disable selects while message up
   document.getElementById('mterms').style.visibility = "hidden";
   document.getElementById('mcust').style.visibility = "hidden";

   } else {

    document.getElementById('ADD_PRIMDEPT').style.visibility = "hidden";
    document.getElementById('ADD_PRIMLOCATION').style.visibility = "hidden"; 
    document.getElementById('ADD_SRVCTYPE').style.visibility = "hidden";
    document.getElementById('ADD_MTERMS').style.visibility = "hidden";
    document.getElementById('ADD_MSHIP').style.visibility = "hidden";
    document.getElementById('ADD_FILETYPE').style.visibility = "hidden";
    document.getElementById('ADD_TAGFORMAT').style.visibility = "hidden";  

   }
	
}

 // check the three states for ticket screens
if (document.getElementById('mtksinglescrup').value=='YES') {
 
     document.getElementById('tktypeselect').style.visibility =  "hidden";
     document.getElementById('tkwhoselect').style.visibility =  "hidden";
     document.getElementById('tkcis1select').style.visibility =  "hidden";


} else if (document.getElementById('maddtkscrnup').value=='YES'){

     document.getElementById('tkclientadd').style.visibility =  "hidden";
     document.getElementById('addtktypeselect').style.visibility =  "hidden";
     document.getElementById('addtkwhoselect').style.visibility =  "hidden";
     document.getElementById('addtkcis1select').style.visibility =  "hidden";

} else if (document.getElementById('mtktscreenup').value == "YES"){
 
     document.getElementById('tkselectMain').style.visibility =  "hidden";
     document.getElementById('tkrptselect').style.visibility =  "hidden";		
     document.getElementById('tkwhofilter').style.visibility =  "hidden"; 
     document.getElementById('tkclientfilter').style.visibility =  "hidden"; 
     document.getElementById('tktypefilter').style.visibility =  "hidden";  
}



if (generic) document.getElementById('emsgscr').style.visibility = "visible";
else if (ns4) document.layers["emsgscr"].visibility = "show";
else if (ie4) document.all["emsgscr"].style.visibility = "visible";



}


function hideemsg() {

if (document.getElementById('mcustscreenup').value == "YES") {

	if (document.getElementById('maddscreenup').value === "NO") {

	   //enable selects 
	   if (document.getElementById('stk').style.visibility == "hidden"){
	     document.getElementById('mterms').style.visibility = "visible";
	   }
	
	   if (document.getElementById('stk').style.visibility == "hidden"){
	     document.getElementById('mcust').style.visibility = "visible";
	   }
	 
	} else {
		
      document.getElementById('ADD_PRIMDEPT').style.visibility = "visible";
      document.getElementById('ADD_PRIMLOCATION').style.visibility = "visible";  
	  document.getElementById('ADD_SRVCTYPE').style.visibility = "visible";
	  document.getElementById('ADD_MTERMS').style.visibility = "visible";
	  document.getElementById('ADD_MSHIP').style.visibility = "visible";
	  document.getElementById('ADD_FILETYPE').style.visibility = "visible";
	  document.getElementById('ADD_TAGFORMAT').style.visibility = "visible";  

	}

} 

if (document.getElementById('mtksinglescrup').value=='YES') {

     document.getElementById('tktypeselect').style.visibility =  "visible";
     document.getElementById('tkwhoselect').style.visibility =  "visible";
     document.getElementById('tkcis1select').style.visibility =  "visible";
     
} else if (document.getElementById('maddtkscrnup').value=='YES'){

     document.getElementById('tkclientadd').style.visibility =  "visible";
     document.getElementById('addtktypeselect').style.visibility =  "visible";
     document.getElementById('addtkwhoselect').style.visibility =  "visible";
     document.getElementById('addtkcis1select').style.visibility =  "visible";

} else if (document.getElementById('mtktscreenup').value == "YES"){

     document.getElementById('tkselectMain').style.visibility =  "visible"; 
     document.getElementById('tkrptselect').style.visibility =  "visible";		
     document.getElementById('tkwhofilter').style.visibility =  "visible"; 
     document.getElementById('tkclientfilter').style.visibility =  "visible"; 
     document.getElementById('tktypefilter').style.visibility =  "visible";  

}



if (generic) document.getElementById('emsgscr').style.visibility = "hidden";
else if (ns4) document.layers["emsgscr"].visibility = "hide";
else if (ie4) document.all["emsgscr"].style.visibility = "hidden";


}





// the next two are a yes no 
function showyesno(mtext,mans) {
//hidetk_stk();
//hidetk_addstk();

document.getElementById('yesnofunction').value=mans;
document.getElementById('yesnotext').innerHTML=mtext;


if (document.getElementById('mcustscreenup').value == "YES") {

   if (document.getElementById('maddscreenup').value === "NO") {

     //disable selects while message up
     document.getElementById('mterms').style.visibility = "hidden";
     document.getElementById('mcust').style.visibility = "hidden";
	 
   } else {

     document.getElementById('ADD_PRIMDEPT').style.visibility = "hidden";
     document.getElementById('ADD_PRIMLOCATION').style.visibility = "hidden";  
	 document.getElementById('ADD_SRVCTYPE').style.visibility = "hidden";
     document.getElementById('ADD_MTERMS').style.visibility = "hidden";
     document.getElementById('ADD_MSHIP').style.visibility = "hidden";
     document.getElementById('ADD_FILETYPE').style.visibility = "hidden";
     document.getElementById('ADD_TAGFORMAT').style.visibility = "hidden";  

   }

}


if (document.getElementById('mtktscreenup').value == "YES"){

    document.getElementById('tktypeselect').style.visibility =  "hidden";
    document.getElementById('tkwhoselect').style.visibility =  "hidden";
    document.getElementById('tkcis1select').style.visibility =  "hidden";

   // check the three states for ticket screens
   if (document.getElementById('mtksinglescrup').value=='YES') {

     document.getElementById('tktypeselect').style.visibility =  "hidden";
     document.getElementById('tkwhoselect').style.visibility =  "hidden";
     document.getElementById('tkcis1select').style.visibility =  "hidden";
     //hidetk_stk();
   } else if (document.getElementById('maddtkscrnup').value=='YES'){

     document.getElementById('tkclientadd').style.visibility =  "hidden";
     document.getElementById('addtktypeselect').style.visibility =  "hidden";
     document.getElementById('addtkwhoselect').style.visibility =  "hidden";
     document.getElementById('addtkcis1select').style.visibility =  "hidden";
     //hidetk_addstk();
   } else if (document.getElementById('mtktscreenup').value=='YES') {
      document.getElementById('tkselectMain').style.visibility =  "hidden";
      document.getElementById('tkrptselect').style.visibility =  "hidden";		
      document.getElementById('tkwhofilter').style.visibility =  "hidden"; 
      document.getElementById('tkclientfilter').style.visibility =  "hidden"; 
      document.getElementById('tktypefilter').style.visibility =  "hidden";  

   }


}


if (document.getElementById('bugscrup').value == "YES"){

document.getElementById('bugscr').style.visibility = "hidden";

}

if (document.getElementById('upscreenup').value =="YES"){

//if it's requested, work out the archive layers 
showSec(1);

//if (document.getElementById('upbcmsel').style.visibility == "visible") {document.getElementById('upbcmsel').style.visibility = "hidden"};
//if (document.getElementById('updocsel').style.visibility == "visible") {document.getElementById('updocsel').style.visibility = "hidden"};
//if (document.getElementById('upmiscsel').style.visibility == "visible") {document.getElementById('upmiscsel').style.visibility = "hidden"};
//if (document.getElementById('upexcelsel').style.visibility == "visible") {document.getElementById('upexcelsel').style.visibility = "hidden"};
//if (document.getElementById('upppsel').style.visibility == "visible") {document.getElementById('upppsel').style.visibility = "hidden"};
//if (document.getElementById('uppdfsel').style.visibility == "visible") {document.getElementById('uppdfsel').style.visibility = "hidden"};
//if (document.getElementById('arc1').style.visibility == "visible"){document.getElementById('arc1').style.visibility = "hidden"};
//if (document.getElementById('arc2').style.visibility == "visible"){document.getElementById('arc2').style.visibility = "hidden"};
//if (document.getElementById('arc3').style.visibility == "visible"){document.getElementById('arc3').style.visibility = "hidden"};
//if (document.getElementById('arc4').style.visibility == "visible"){document.getElementById('arc4').style.visibility = "hidden"};
//if (document.getElementById('arc5').style.visibility == "visible"){document.getElementById('arc5').style.visibility = "hidden"};
//if (document.getElementById('arc6').style.visibility == "visible"){document.getElementById('arc6').style.visibility = "hidden"};
//if (document.getElementById('arc7').style.visibility == "visible"){document.getElementById('arc7').style.visibility = "hidden"};

}


if (generic) document.getElementById('yesnoscr').style.visibility = "visible";
else if (ns4) document.layers["yesnoscr"].visibility = "show";
else if (ie4) document.all["yesnoscr"].style.visibility = "visible";

}



function hideyesno() {

document.getElementById('yesnofunction').value="";
document.getElementById('yesnotext').innerHTML="";

//if ticket screen not up


if (document.getElementById('mcustscreenup').value == "YES") {

  if (document.getElementById('macctscreenup').value != "YES"){

	if (document.getElementById('maddscreenup').value === "NO") {

	   //enable selects 
	   if (document.getElementById('stk').style.visibility == "hidden"){
	     document.getElementById('mterms').style.visibility = "visible";
	   }
	
	   if (document.getElementById('stk').style.visibility == "hidden"){
	     document.getElementById('mcust').style.visibility = "visible";
	   }
	 
	} else {
  
      document.getElementById('ADD_PRIMDEPT').style.visibility = "visible";
      document.getElementById('ADD_PRIMLOCATION').style.visibility = "visible";  
	  document.getElementById('ADD_SRVCTYPE').style.visibility = "visible";
	  document.getElementById('ADD_MTERMS').style.visibility = "visible";
	  document.getElementById('ADD_MSHIP').style.visibility = "visible";
	  document.getElementById('ADD_FILETYPE').style.visibility = "visible";
	  document.getElementById('ADD_TAGFORMAT').style.visibility = "visible";  

	}

   }

}


if (document.getElementById('mtksinglescrup').value=='YES') {

     document.getElementById('tktypeselect').style.visibility =  "visible";
     document.getElementById('tkwhoselect').style.visibility =  "visible";
     document.getElementById('tkcis1select').style.visibility =  "visible";

} else if (document.getElementById('maddtkscrnup').value=='YES'){
     document.getElementById('tkclientadd').style.visibility =  "visible";
     document.getElementById('addtktypeselect').style.visibility =  "visible";
     document.getElementById('addtkwhoselect').style.visibility =  "visible";
     document.getElementById('addtkcis1select').style.visibility =  "visible";

} else if (document.getElementById('mtktscreenup').value=='YES') {

     //hidetk_stk();
     //hidetk_addstk();
     document.getElementById('tkselectMain').style.visibility =  "visible";
     document.getElementById('tkrptselect').style.visibility =  "visible";		
     document.getElementById('tkwhofilter').style.visibility =  "visible"; 
     document.getElementById('tkclientfilter').style.visibility =  "visible"; 
     document.getElementById('tktypefilter').style.visibility =  "visible";  

   }


if (document.getElementById('upscreenup').value =="YES"){


}

if (generic) document.getElementById('yesnoscr').style.visibility = "hidden";
else if (ns4) document.layers["yesnoscr"].visibility = "hide";
else if (ie4) document.all["yesnoscr"].style.visibility = "hidden";
}





// the next two are a center screen confirm
function showconfirm() {

if (document.getElementById('maddtkscrnup').value =="YES"){

   document.getElementById('tkclientadd').style.visibility =  "hidden";
   document.getElementById('addtktypeselect').style.visibility =  "hidden";
   document.getElementById('addtkwhoselect').style.visibility =  "hidden";
   document.getElementById('addtkcis1select').style.visibility =  "hidden";

} else if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "hidden";
   document.getElementById('tkwhoselect').style.visibility =  "hidden";
   document.getElementById('tkcis1select').style.visibility =  "hidden";

} else if (document.getElementById('mtktscreenup').value=='YES') {
      document.getElementById('tkselectMain').style.visibility =  "hidden";
      document.getElementById('tkrptselect').style.visibility =  "hidden";		
      document.getElementById('tkwhofilter').style.visibility =  "hidden"; 
      document.getElementById('tkclientfilter').style.visibility =  "hidden"; 
      document.getElementById('tktypefilter').style.visibility =  "hidden";  

}


if (generic) document.getElementById('confirmscr').style.visibility = "visible";
else if (ns4) document.layers["confirmscr"].visibility = "show";
else if (ie4) document.all["confirmscr"].style.visibility = "visible";
}

function hideconfirm() {

document.getElementById('confirmtext').innerHTML="";

if (document.getElementById('maddtkscrnup').value =="YES"){

   document.getElementById('tkclientadd').style.visibility =  "visible";
   document.getElementById('addtktypeselect').style.visibility =  "visible";
   document.getElementById('addtkwhoselect').style.visibility =  "visible";
   document.getElementById('addtkcis1select').style.visibility =  "visible";
   
} else if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "visible";
   document.getElementById('tkwhoselect').style.visibility =  "visible";
   document.getElementById('tkcis1select').style.visibility =  "visible";
   
} else if (document.getElementById('mtktscreenup').value=='YES') {
      document.getElementById('tkselectMain').style.visibility =  "visible";
      document.getElementById('tkrptselect').style.visibility =  "visible";		
      document.getElementById('tkwhofilter').style.visibility =  "visible"; 
      document.getElementById('tkclientfilter').style.visibility =  "visible"; 
      document.getElementById('tktypefilter').style.visibility =  "visible";  

   }
   
if (generic) document.getElementById('confirmscr').style.visibility = "hidden";
else if (ns4) document.layers["confirmscr"].visibility = "hide";
else if (ie4) document.all["confirmscr"].style.visibility = "hidden";
}

// the next two are tool tip screen
function showtooltip(mtitle,helpstr) {
var zzz=getmsession();

//document.getElementById('toolmsg').innerHTML=helpstr+"<br>"+zzz; ----uncomment this to see the current session var
document.getElementById('toolmsg').innerHTML=helpstr;
document.getElementById('toolheader').innerHTML=mtitle;

if (generic) document.getElementById('tooltip').style.visibility = "visible";
else if (ns4) document.layers["tooltip"].visibility = "show";
else if (ie4) document.all["tooltip"].style.visibility = "visible";
}

function hidetooltip() {
document.getElementById('toolmsg').innerHTML="";
if (generic) document.getElementById('tooltip').style.visibility = "hidden";
else if (ns4) document.layers["tooltip"].visibility = "hide";
else if (ie4) document.all["tooltip"].style.visibility = "hidden";
}

// the next two are delete box
function showdelbox(delstr,mdeltype) {

document.getElementById('deletemsg').innerHTML=delstr;
document.getElementById('delpass').value="";
document.getElementById('deltype').value=mdeltype;

if (generic) document.getElementById('deletebox').style.visibility = "visible";
else if (ns4) document.layers["deletebox"].visibility = "show";
else if (ie4) document.all["deletebox"].style.visibility = "visible";
}

function hidedelbox() {
document.getElementById('deletemsg').innerHTML="";
document.getElementById('delpass').value="";
document.getElementById('deltype').value="";

if (generic) document.getElementById('deletebox').style.visibility = "hidden";
else if (ns4) document.layers["deletebox"].visibility = "hide";
else if (ie4) document.all["deletebox"].style.visibility = "hidden";
}


// the next two are adding an account
function showaddacct(isreset) {
hidecust();
document.getElementById('asignsales').style.visibility ='hidden';
document.getElementById('salesperson').style.visibility ='hidden';	

document.getElementById('mterms').style.visibility = "hidden";
document.getElementById('mcust').style.visibility = "hidden";
document.getElementById('maddscreenup').value = "YES";

  document.getElementById('ADD_PRIMDEPT').style.visibility = "visible";
  document.getElementById('ADD_PRIMLOCATION').style.visibility = "visible";  
  document.getElementById('ADD_SRVCTYPE').style.visibility = "visible";
  document.getElementById('ADD_MTERMS').style.visibility = "visible";
  document.getElementById('ADD_MSHIP').style.visibility = "visible";
  document.getElementById('ADD_FILETYPE').style.visibility = "visible";
  document.getElementById('ADD_TAGFORMAT').style.visibility = "visible"; 


  if (document.getElementById('filetype').style.visibility = "visible") {
    document.getElementById('filetype').style.visibility = "hidden";
    document.getElementById('addhidefiletype').value="YES";
  } else {
    document.getElementById('addhidefiletype').value="NO"; 
  } 

  if ((trim(document.getElementById('add_company').value)=="") && (trim(document.getElementById('add_add1').value)=="") ){
    document.getElementById('ADD_MAP_VIEWERbox').checked=true;
    document.getElementById('ADD_AUTORESbox').checked=true;
    document.getElementById('ADD_PDFTAGSbox').checked=true;
    document.getElementById('ADD_EXTRACHARGbox').checked=true;
    document.getElementById('ADD_REVCHARGEbox').checked=true;
    
     if (isreset=="Y"){
       getDefaltPrices();
     }

  }

 
if (generic) document.getElementById('addacct').style.visibility = "visible";
else if (ns4) document.layers["addacct"].visibility = "show";
else if (ie4) document.all["addacct"].style.visibility = "visible";

//this is in functions.js and was originally put in to try and fix visual fox screwing up input mouseover event
//resetthefields();

}

function hideaddacct() {
document.getElementById('maddscreenup').value = "NO";

 document.getElementById('mterms').style.visibility = "visible";
 document.getElementById('mcust').style.visibility = "visible";

  if (document.getElementById('addhidefiletype').value="YES") {
    document.getElementById('filetype').style.visibility = "visible";
    document.getElementById('addhidefiletype').value="NO";  
  }
	  
  document.getElementById('ADD_PRIMDEPT').style.visibility = "hidden";
  document.getElementById('ADD_PRIMLOCATION').style.visibility = "hidden";  			  
  document.getElementById('ADD_SRVCTYPE').style.visibility = "hidden";
  document.getElementById('ADD_MTERMS').style.visibility = "hidden";
  document.getElementById('ADD_MSHIP').style.visibility = "hidden";
  document.getElementById('ADD_FILETYPE').style.visibility = "hidden";
  document.getElementById('ADD_TAGFORMAT').style.visibility = "hidden"; 


hideaddnote();

 if (document.getElementById('ucoid').value=="CIS"){
    showcust(1);
 } else {
	showcust(5);  
 }	 

if (generic) document.getElementById('addacct').style.visibility = "hidden";
else if (ns4) document.layers["addacct"].visibility = "hide";
else if (ie4) document.all["addacct"].style.visibility = "hidden";
}



// the next two are a center screen adding a contact
function showAddContact() {
if (trim(document.getElementById('mcustid').value) !="") {
 //disable selects while message up
 document.getElementById('mcust').style.visibility = "hidden";

// load info 
setupcontact();
resetFieldColors();  

if (generic) document.getElementById('addcontact').style.visibility = "visible";
else if (ns4) document.layers["addcontact"].visibility = "show";
else if (ie4) document.all["addcontact"].style.visibility = "visible";



} else {

 document.getElementById('confirmtext').innerHTML="No record is currently loaded.";
 showconfirm();
 
}

}


function hideAddContact() {

document.getElementById('mcust').style.visibility =  "visible";
document.getElementById('adduserbt').style.visibility = "hidden";

if (generic) document.getElementById('addcontact').style.visibility = "hidden";
else if (ns4) document.layers["addcontact"].visibility = "hide";
else if (ie4) document.all["addcontact"].style.visibility = "hidden";

}



// the next two are the report screen- pretty much the same as addnewacct

function showreport(mtype) {


document.getElementById('reportscr').style.zIndex=2100; 

if (document.getElementById('sec1').style.visibility == "visible"){
  document.getElementById('tkselect').style.visibility = "hidden";
}

if (document.getElementById('mmktscreenup').value == "YES"){
  document.getElementById('bcmselect').style.visibility = "hidden";
}



if (document.getElementById('maddtkscrnup').value =="YES"){

   document.getElementById('tkclientadd').style.visibility =  "hidden";
   document.getElementById('addtktypeselect').style.visibility =  "hidden";
   document.getElementById('addtkwhoselect').style.visibility =  "hidden";
   document.getElementById('addtkcis1select').style.visibility =  "hidden";

} else if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "hidden";
   document.getElementById('tkwhoselect').style.visibility =  "hidden";
   document.getElementById('tkcis1select').style.visibility =  "hidden";

} else if (document.getElementById('mtktscreenup').value=='YES') {
      document.getElementById('tkselectMain').style.visibility =  "hidden";
      document.getElementById('tkrptselect').style.visibility =  "hidden";		
      document.getElementById('tkwhofilter').style.visibility =  "hidden"; 
      document.getElementById('tkclientfilter').style.visibility =  "hidden"; 
      document.getElementById('tktypefilter').style.visibility =  "hidden";  

}



if (mtype =="inv"){

  document.getElementById('tktypeselect').style.visibility =  "hidden";
  document.getElementById('tkwhoselect').style.visibility =  "hidden";
  document.getElementById('tkcis1select').style.visibility =  "hidden";

  if (generic) document.getElementById('excelbt').style.visibility = "hidden";
  else if (ns4) document.layers["excelbt"].visibility = "hide";
  else if (ie4) document.all["excelbt"].style.visibility = "hidden";

} else {

  if (generic) document.getElementById('excelbt').style.visibility = "visible";
  else if (ns4) document.layers["excelbt"].visibility = "show";
  else if (ie4) document.all["excelbt"].style.visibility = "visible";

}

if (mtype =="iddups" || mtype =="pwdups"){

  
  if (generic) document.getElementById('excelbt').style.visibility = "hidden";
  else if (ns4) document.layers["excelbt"].visibility = "hide";
  else if (ie4) document.all["excelbt"].style.visibility = "hidden";


  if (generic) document.getElementById('pdfbt').style.visibility = "hidden";
  else if (ns4) document.layers["pdfbt"].visibility = "hide";
  else if (ie4) document.all["pdfbt"].style.visibility = "hidden";

}


if (document.getElementById('mcustscreenup').value == "YES"){ 

  hidecust();
  document.getElementById('mterms').style.visibility = "hidden";
  document.getElementById('mcust').style.visibility = "hidden";
  document.getElementById('maddscreenup').value = "YES";
  
  
  
  if (document.getElementById('filetype').style.visibility = "visible") {
    document.getElementById('filetype').style.visibility = "hidden";
    document.getElementById('addhidefiletype').value="YES";
  } else {
    document.getElementById('addhidefiletype').value="NO"; 
  } 


}//end of cc check


if (generic) document.getElementById('reportscr').style.visibility = "visible";
else if (ns4) document.layers["reportscr"].visibility = "show";
else if (ie4) document.all["reportscr"].style.visibility = "visible";

}

function hidereport() {

  
 
if (document.getElementById('maddtkscrnup').value =="YES"){

   document.getElementById('tkclientadd').style.visibility =  "visible";
   document.getElementById('addtktypeselect').style.visibility =  "visible";
   document.getElementById('addtkwhoselect').style.visibility =  "visible";
   document.getElementById('addtkcis1select').style.visibility =  "visible";
   
} else if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "visible";
   document.getElementById('tkwhoselect').style.visibility =  "visible";
   document.getElementById('tkcis1select').style.visibility =  "visible";
   
} else if (document.getElementById('mtktscreenup').value=='YES') {
      document.forms['ticketform'].tkselectMain.selectedIndex=-1;
      document.getElementById('tkselectMain').style.visibility =  "visible";
      document.getElementById('tkrptselect').style.visibility =  "visible";		
      document.getElementById('tkwhofilter').style.visibility =  "visible"; 
      document.getElementById('tkclientfilter').style.visibility =  "visible"; 
      document.getElementById('tktypefilter').style.visibility =  "visible";  

   }



  if (generic) document.getElementById('excelbt').style.visibility = "hidden";
  else if (ns4) document.layers["excelbt"].visibility = "hide";
  else if (ie4) document.all["excelbt"].style.visibility = "hidden";

document.getElementById('maddscreenup').value = "NO";

if (document.getElementById('mmktscreenup').value == "YES"){
  document.getElementById('bcmselect').style.visibility = "visible";
}

if (document.getElementById('mcustscreenup').value == "YES"){ 

  document.getElementById('mterms').style.visibility = "visible";
  document.getElementById('mcust').style.visibility = "visible";

  if (document.getElementById('addhidefiletype').value="YES") {
    document.getElementById('filetype').style.visibility = "visible";
    document.getElementById('addhidefiletype').value="NO";  
  }
  
  if (document.getElementById('sec1').style.visibility == "visible"){
    document.getElementById('tkselect').style.visibility = "visible";
  } 
  
  
  if (document.getElementById('ucoid').value=="CIS"){
    showcust(1);
  } else {
	showcust(5);  
  }	  

}

document.getElementById('reportscr').style.zIndex=1; 
if (generic) document.getElementById('reportscr').style.visibility = "hidden";
else if (ns4) document.layers["reportscr"].visibility = "hide";
else if (ie4) document.all["reportacr"].style.visibility = "hidden";
}


// the next two are for quick stats
function showqstats() {

if (generic) document.getElementById('qstatsscr').style.visibility = "visible";
else if (ns4) document.layers["qstatsscr"].visibility = "show";
else if (ie4) document.all["qstatsscr"].style.visibility = "visible";
}

function hideqstats() {
document.getElementById('qstatsbody').innerHTML="";

if (generic) document.getElementById('qstatsscr').style.visibility = "hidden";
else if (ns4) document.layers["qstatsscr"].visibility = "hide";
else if (ie4) document.all["qstatsscr"].style.visibility = "hidden";

}





//upload tabs

// the next two are for the multiple tabs under custcare
function showupld(nz) {

hideupld();

if (nz==1) {
//document.getElementById('arc5').style.visibility = "hidden"
  document.getElementById("mbcmfilter").value ="";
  document.getElementById('mydwn').innerHTML="A file is currently not selected for viewing or downloading.";
  upgetDir('BCM');
  document.forms['uploadform'].upbcmsel.selectedIndex=0;
  document.getElementById('upbcmsel').style.visibility = "visible";

} 

if (nz==2) {
//document.getElementById('arc5').style.visibility = "hidden"
  document.getElementById("mdocfilter").value ="";
  document.getElementById('mydwn2').innerHTML="A file is currently not selected for viewing or downloading.";
  upgetDir('doc');
  document.forms['uploadform'].updocsel.selectedIndex=0;
  document.getElementById('updocsel').style.visibility = "visible";

} 

if (nz==3) {
//document.getElementById('arc5').style.visibility = "hidden"
  document.getElementById("mpdffilter").value ="";
  document.getElementById('mydwn3').innerHTML="A file is currently not selected for viewing or downloading.";
  upgetDir('pdf');
  document.forms['uploadform'].uppdfsel.selectedIndex=0;
  document.getElementById('uppdfsel').style.visibility = "visible";

} 

if (nz==4) {
//document.getElementById('arc5').style.visibility = "hidden"
  document.getElementById("mexcelfilter").value ="";
  document.getElementById('mydwn4').innerHTML="A file is currently not selected for viewing or downloading.";
  upgetDir('excel');
  document.forms['uploadform'].upexcelsel.selectedIndex=0;
  document.getElementById('upexcelsel').style.visibility = "visible";

}  

if (nz==5) {
//document.getElementById('arc5').style.visibility = "hidden"
  document.getElementById("mppfilter").value ="";
  document.getElementById('mydwn5').innerHTML="A file is currently not selected for viewing or downloading.";
  upgetDir('pp');
  document.forms['uploadform'].upppsel.selectedIndex=0;
  document.getElementById('upppsel').style.visibility = "visible";


}

if (nz==6) {
//document.getElementById('arc5').style.visibility = "hidden"

  document.getElementById("mmiscfilter").value ="";
  document.getElementById('mydwn6').innerHTML="A file is currently not selected for viewing or downloading.";
  upgetDir('misc');
  document.forms['uploadform'].upmiscsel.selectedIndex=0;
  document.getElementById('upmiscsel').style.visibility = "visible";

}

//if (nz==7 && document.forms['uploadform'].uparcsel[0].value != "BCM") {

//    document.getElementById('arc1').style.visibility = "visible"
//    document.getElementById('arc2').style.visibility = "visible"
//    document.getElementById('arc3').style.visibility = "visible"
//    document.getElementById('arc4').style.visibility = "visible"
//    document.getElementById('arc5').style.visibility = "visible"
//    document.getElementById('arc6').style.visibility = "visible"
//    document.getElementById('arc7').style.visibility = "visible"
//} 

if (generic) document.getElementById('upld' + nz).style.visibility = "visible";
else if (ns4) document.layers["upld" + nz].visibility = "show";
else if (ie4) document.all["upld" + nz].style.visibility = "visible";


}


function hideupld() {

//document.getElementById('arc1').style.visibility = "hidden"
//document.getElementById('arc2').style.visibility = "hidden"
//document.getElementById('arc3').style.visibility = "hidden"
//document.getElementById('arc4').style.visibility = "hidden"
//document.getElementById('arc5').style.visibility = "hidden"
//document.getElementById('arc6').style.visibility = "hidden"
//document.getElementById('arc7').style.visibility = "hidden"

document.getElementById('upbcmsel').style.visibility = "hidden";
document.getElementById('updocsel').style.visibility = "hidden";
document.getElementById('upmiscsel').style.visibility = "hidden";
document.getElementById('upexcelsel').style.visibility = "hidden";
document.getElementById('upppsel').style.visibility = "hidden";
document.getElementById('uppdfsel').style.visibility = "hidden";

if (generic) document.getElementById('upld1').style.visibility = "hidden"
else if (ns4) document.upld1.visibility = "hide"
else if (ie4) upld1.style.visibility ="hidden"

if (generic) document.getElementById('upld2').style.visibility = "hidden"
else if (ns4) document.upld2.visibility = "hide"
else if (ie4) upld2.style.visibility ="hidden"

if (generic) document.getElementById('upld3').style.visibility = "hidden"
else if (ns4) document.upld3.visibility = "hide"
else if (ie4) upld3.style.visibility ="hidden"

if (generic) document.getElementById('upld4').style.visibility = "hidden"
else if (ns4) document.upld4.visibility = "hide"
else if (ie4) upld4.style.visibility ="hidden"

if (generic) document.getElementById('upld5').style.visibility = "hidden"
else if (ns4) document.upld5.visibility = "hide"
else if (ie4) upld5.style.visibility ="hidden"

if (generic) document.getElementById('upld6').style.visibility = "hidden"
else if (ns4) document.upld6.visibility = "hide"
else if (ie4) upld6.style.visibility ="hidden"

//if (generic) document.getElementById('upld7').style.visibility = "hidden"
//else if (ns4) document.upld7.visibility = "hide"
//else if (ie4) upld7.style.visibility ="hidden"

}


// the next two are file upload confirm
function showupconfirm() {
if (generic) document.getElementById('upconfirmscr').style.visibility = "visible";
else if (ns4) document.layers["upconfirmscr"].visibility = "show";
else if (ie4) document.all["upconfirmscr"].style.visibility = "visible";
}

function hideupconfirm() {
document.getElementById('upconfirmtext').innerHTML="";


if (generic) document.getElementById('upconfirmscr').style.visibility = "hidden";
else if (ns4) document.layers["upconfirmscr"].visibility = "hide";
else if (ie4) document.all["upconfirmscr"].style.visibility = "hidden";



}


// these are for the invoice builder




// the next two are the binv screen- pretty much the same as addnewacct

function showbinv(mtype) {

binvclear();
document.getElementById('binvscreenup').value='YES';

//document.forms['invoiceform'].binv_lnitems.options.length= 0;
if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "hidden";
   document.getElementById('tkwhoselect').style.visibility =  "hidden";
   document.getElementById('tkcis1select').style.visibility =  "hidden";

} else if (document.getElementById('mtktscreenup').value=='YES') {
      document.getElementById('tkselectMain').style.visibility =  "hidden";
      document.getElementById('tkrptselect').style.visibility =  "hidden";		
      document.getElementById('tkwhofilter').style.visibility =  "hidden"; 
      document.getElementById('tkclientfilter').style.visibility =  "hidden"; 
      document.getElementById('tktypefilter').style.visibility =  "hidden";  

} else if (document.getElementById('macctscreenup').value=='YES') {
      document.getElementById('tkselectAcctng').style.visibility =  "hidden";
      document.getElementById('acctngclientfilter').style.visibility =  "hidden";		
 
}

  document.getElementById('tktypeselect').style.visibility =  "hidden";
  document.getElementById('tkwhoselect').style.visibility =  "hidden";
  document.getElementById('tkcis1select').style.visibility =  "hidden";

  if (generic) document.getElementById('excelbt').style.visibility = "hidden";
  else if (ns4) document.layers["excelbt"].visibility = "hide";
  else if (ie4) document.all["excelbt"].style.visibility = "hidden";

document.getElementById('binv_mship').style.visibility =  "visible";		
document.getElementById('binv_mterms').style.visibility =  "visible"; 
//document.getElementById('binv_category').style.visibility =  "visible";		
document.getElementById('binv_unit').style.visibility =  "visible"; 
document.getElementById('binv_dept').style.visibility =  "visible";
document.getElementById('binv_lnitems').style.visibility =  "visible"; 
       
   if (document.forms['invoiceform'].binv_lnitems.options.length > 0){
       document.getElementById('cutbuttonl').style.visibility =  "visible";
   } else {
       document.getElementById('cutbuttonl').style.visibility =  "hidden";
   }
   
  document.getElementById('binv_category').style.visibility ='hidden';
  
 showbinvtaxrate(); 	
   	
if (generic) document.getElementById('binvscr').style.visibility = "visible";
else if (ns4) document.layers["binvscr"].visibility = "show";
else if (ie4) document.all["binvscr"].style.visibility = "visible";
getbinvdept();
}



function hidebinv() {

//do this to hide invscr
document.getElementById('invcanscrup').value = "NO";		
document.getElementById('invcanmess').value="";
document.getElementById('invcanscr').style.visibility = "hidden";	
	
	
document.getElementById('binvscreenup').value='NO';

if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "visible";
   document.getElementById('tkwhoselect').style.visibility =  "visible";
   document.getElementById('tkcis1select').style.visibility =  "visible";
   
} else if (document.getElementById('mtktscreenup').value=='YES') {
      document.forms['ticketform'].tkselectMain.selectedIndex=-1;
      document.getElementById('tkselectMain').style.visibility =  "visible";
      document.getElementById('tkrptselect').style.visibility =  "visible";		
      document.getElementById('tkwhofilter').style.visibility =  "visible"; 
      document.getElementById('tkclientfilter').style.visibility =  "visible"; 
      document.getElementById('tktypefilter').style.visibility =  "visible";  

} else if (document.getElementById('macctscreenup').value=='YES') {
      //document.forms['acctngform'].tkselectAcctng.selectedIndex=-1;
      document.getElementById('tkselectAcctng').style.visibility =  "visible";
      document.getElementById('acctngclientfilter').style.visibility =  "visible";		
    
}

if (document.getElementById('binv_taxratelayer').style.visibility =="visible"){
  document.getElementById('binv_taxratelayer').style.visibility ="hidden";
  document.getElementById('binv_taxrate').style.visibility =  "hidden";
}

document.getElementById('cutbuttonl').style.visibility =  "hidden";
document.getElementById('binv_mship').style.visibility =  "hidden";		
document.getElementById('binv_mterms').style.visibility =  "hidden"; 
document.getElementById('binv_category').style.visibility =  "hidden";		
document.getElementById('binv_unit').style.visibility =  "hidden"; 
document.getElementById('binv_dept').style.visibility =  "hidden"; 
document.getElementById('binv_lnitems').style.visibility =  "hidden"; 
document.getElementById('binvsavebtn').style.visibility =  "hidden";
document.getElementById('binvprnbtn').style.visibility =  "hidden";
document.getElementById('gotopglbl').style.visibility =  "hidden";
document.getElementById('gotopgbtn').style.visibility =  "hidden";            
clearInvFields();
      
if (generic) document.getElementById('binvscr').style.visibility = "hidden";
else if (ns4) document.layers["binvscr"].visibility = "hide";
else if (ie4) document.all["binvscr"].style.visibility = "hidden";



}

function showbinvmsg() {

      document.getElementById('binv_mship').style.visibility =  "hidden";		
      document.getElementById('binv_mterms').style.visibility =  "hidden"; 
      document.getElementById('binv_category').style.visibility =  "hidden";		
      document.getElementById('binv_unit').style.visibility =  "hidden"; 


if (generic) document.getElementById('binvmsgscr').style.visibility = "visible";
else if (ns4) document.layers["binvmsgscr"].visibility = "show";
else if (ie4) document.all["binvmsgscr"].style.visibility = "visible";
}

function hidebinvmsg(){

document.getElementById('binvmsgtext').innerHTML="";

document.getElementById('binv_mship').style.visibility =  "visible";
document.getElementById('binv_mterms').style.visibility =  "visible";		
//document.getElementById('binv_category').style.visibility =  "visible";
document.getElementById('binv_unit').style.visibility =  "visible";	

	
if (generic) document.getElementById('binvmsgscr').style.visibility = "hidden";
else if (ns4) document.layers["binvmsgscr"].visibility = "hide";
else if (ie4) document.all["binvmsgscr"].style.visibility = "hidden";

}


function showAcctngmsg() {

   document.getElementById('acctngclientfilter').style.visibility =  "hidden";		
     

if (generic) document.getElementById('acctngmsgscr').style.visibility = "visible";
else if (ns4) document.layers["acctngmsgscr"].visibility = "show";
else if (ie4) document.all["acctngmsgscr"].style.visibility = "visible";
}

function hideAcctngmsg(){

document.getElementById('acctngmsgtext').innerHTML="";

document.getElementById('acctngclientfilter').style.visibility =  "visible";

	
if (generic) document.getElementById('acctngmsgscr').style.visibility = "hidden";
else if (ns4) document.layers["acctngmsgscr"].visibility = "hide";
else if (ie4) document.all["acctngmsgscr"].style.visibility = "hidden";

}

function showbinvship() {
//alert("in ship");
	  document.getElementById('binvshipscr').style.zIndex=1100;
      document.getElementById('binv_mship').style.visibility =  "hidden";		
      document.getElementById('binv_mterms').style.visibility =  "hidden"; 
      document.getElementById('binv_category').style.visibility =  "hidden";		
      document.getElementById('binv_unit').style.visibility =  "hidden"; 
      document.getElementById('binv_dept').style.visibility =  "hidden"; 
      document.getElementById('binv_lnitems').style.visibility =  "hidden"; 
//show address select      
document.getElementById('binv_shipaddrs').style.visibility =  "visible"; 

if (generic) document.getElementById('binvshipscr').style.visibility = "visible";
else if (ns4) document.layers["binvshipscr"].visibility = "show";
else if (ie4) document.all["binvshipscr"].style.visibility = "visible";

}

function hidebinvship(){


//hide address select
document.getElementById('binv_shipaddrs').style.visibility =  "hidden"; 
document.getElementById('binv_mship').style.visibility =  "visible";
document.getElementById('binv_mterms').style.visibility =  "visible";		
//document.getElementById('binv_category').style.visibility =  "visible";
document.getElementById('binv_unit').style.visibility =  "visible";	
document.getElementById('binv_dept').style.visibility =  "visible";	
document.getElementById('binv_lnitems').style.visibility =  "visible";	
	
if (generic) document.getElementById('binvshipscr').style.visibility = "hidden";
else if (ns4) document.layers["binvshipscr"].visibility = "hide";
else if (ie4) document.all["binvshipscr"].style.visibility = "hidden";
document.getElementById('binvshipscr').style.zIndex=10;
}

// the next two are delete box
function showprodbox() {

//document.getElementById('prodmsg').innerHTML=question;


document.getElementById('binv_mship').style.visibility =  "hidden";		
document.getElementById('binv_mterms').style.visibility =  "hidden"; 


if (generic) document.getElementById('binvprodbox').style.visibility = "visible";
else if (ns4) document.layers["binvprodbox"].visibility = "show";
else if (ie4) document.all["binvprodbox"].style.visibility = "visible";
}


function hideprodbox() {
//document.getElementById('prodmsg').innerHTML="";


document.getElementById('binv_mship').style.visibility =  "visible";
document.getElementById('binv_mterms').style.visibility =  "visible";		

if (generic) document.getElementById('binvprodbox').style.visibility = "hidden";
else if (ns4) document.layers["binvprodbox"].visibility = "hide";
else if (ie4) document.all["binvprodbox"].style.visibility = "hidden";
}

//po layers

function showpo() {

document.getElementById('poscreenup').value = "YES"; 

if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "hidden";
   document.getElementById('tkwhoselect').style.visibility =  "hidden";
   document.getElementById('tkcis1select').style.visibility =  "hidden";

}
  
   if (document.forms['ticketform'].po_sellist.options.length > 0){
       document.getElementById('voidbuttonPO').style.visibility =  "visible";
   } else {
       document.getElementById('voidbuttonPO').style.visibility =  "hidden";
   }
   
  document.getElementById('clonebuttonPO').style.visibility =  "visible";  
  document.getElementById('po_sellist').style.visibility ="visible"; 
if (generic) document.getElementById('tkposcr').style.visibility = "visible";
else if (ns4) document.layers["tkposcr"].visibility = "show";
else if (ie4) document.all["tkposcr"].style.visibility = "visible";
//getpodetails();
}



function hidepo() {

document.getElementById('poscreenup').value = "NO";
 
if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "visible";
   document.getElementById('tkwhoselect').style.visibility =  "visible";
   document.getElementById('tkcis1select').style.visibility =  "visible";
   
} 

  document.getElementById('clonebuttonPO').style.visibility =  "hidden"; 
  document.getElementById('voidbuttonPO').style.visibility =  "hidden"; 
  document.getElementById('po_sellist').style.visibility =  "hidden";
   
if (generic) document.getElementById('tkposcr').style.visibility = "hidden";
else if (ns4) document.layers["tkposcr"].visibility = "hide";
else if (ie4) document.all["tkposcr"].style.visibility = "hidden";



}

function showspo() {

document.getElementById('sposcreenup').value = "YES"; 

//this screen is actually three layers back
if (document.getElementById('mtksinglescrup').value =="YES"){

   document.getElementById('tktypeselect').style.visibility =  "hidden";
   document.getElementById('tkwhoselect').style.visibility =  "hidden";
   document.getElementById('tkcis1select').style.visibility =  "hidden";

}
   
if (document.getElementById('poscreenup').value =="YES"){
   document.getElementById('po_sellist').style.visibility =  "hidden";
}

   document.getElementById('spo_mship').style.visibility =  "visible";		
   document.getElementById('spo_mterms').style.visibility =  "visible"; 
   document.getElementById('spo_unit').style.visibility =  "visible"; 
   //document.getElementById('spo_dept').style.visibility =  "visible";
   document.getElementById('spo_lnitems').style.visibility =  "visible"; 
     
   if (document.forms['poform'].spo_lnitems.options.length > 0){
       document.getElementById('cutbuttonsPO').style.visibility =  "visible";
       togglepoPrintSave("P");
   } else {
       document.getElementById('cutbuttonsPO').style.visibility =  "hidden";
       togglepoPrintSave("S");
   }
   
   document.getElementById('spo_taxratelayer').style.visibility =  "hidden";
   
 var chkdesc=document.getElementById('spo_desc').value;
 chkdesc=chkdesc.toUpperCase();
 var aPosition = chkdesc.indexOf("VOID");

 if (aPosition > -1){
     document.getElementById('unvoidbtn').style.visibility =  "visible";
 } else {
	 document.getElementById('unvoidbtn').style.visibility =  "hidden";
 }	    
 
              
if (generic) document.getElementById('sposcr').style.visibility = "visible";
else if (ns4) document.layers["sposcr"].visibility = "show";
else if (ie4) document.all["sposcr"].style.visibility = "visible";
//getpodetails();
}



function hidespo() {
hidepovendor();
document.getElementById('sposcreenup').value = "NO";
document.forms['ticketform'].po_sellist.selectedIndex=-1;
  
if (document.getElementById('poscreenup').value =="YES"){
   document.getElementById('po_sellist').style.visibility =  "visible";
}

  document.getElementById('cutbuttonsPO').style.visibility =  "hidden"; 
  document.getElementById('spo_taxratelayer').style.visibility =  "hidden";
  
  document.getElementById('spo_mship').style.visibility =  "hidden";		
  document.getElementById('spo_mterms').style.visibility =  "hidden"; 
  document.getElementById('spo_unit').style.visibility =  "hidden"; 
  //document.getElementById('spo_dept').style.visibility =  "hidden"; 
  document.getElementById('spo_lnitems').style.visibility =  "hidden"; 
  document.getElementById('sposavebtn').style.visibility =  "hidden";
  document.getElementById('spoprnbtn').style.visibility =  "hidden";
  document.getElementById('unvoidbtn').style.visibility =  "hidden";

  clearpoFields();
  
if (generic) document.getElementById('sposcr').style.visibility = "hidden";
else if (ns4) document.layers["sposcr"].visibility = "hide";
else if (ie4) document.all["sposcr"].style.visibility = "hidden";



}

function showpomsg() {
document.getElementById('poscreenup').style.zIndex=1100;
if (document.getElementById('poscreenup').value == "YES" && document.getElementById('sposcreenup').value != "YES"){
  document.getElementById('po_sellist').style.visibility =  "hidden";
}

if (document.getElementById('sposcreenup').value == "YES"){

   document.getElementById('spo_mship').style.visibility =  "hidden";		
   document.getElementById('spo_mterms').style.visibility =  "hidden"; 
   document.getElementById('spo_unit').style.visibility =  "hidden"; 
   //document.getElementById('spo_dept').disabled =true;
   //document.getElementById('spo_lnitems').style.visibility =  "hidden";
    
}     


if (generic) document.getElementById('pomsgscr').style.visibility = "visible";
else if (ns4) document.layers["pomsgscr"].visibility = "show";
else if (ie4) document.all["pomsgscr"].style.visibility = "visible";
}

function hidepomsg(){
document.getElementById('poscreenup').style.zIndex=1000;
document.getElementById('pomsgtext').innerHTML="";

if (document.getElementById('poscreenup').value == "YES" && document.getElementById('sposcreenup').value != "YES"){
document.getElementById('po_sellist').style.visibility =  "visible";  
}

if (document.getElementById('sposcreenup').value == "YES"){

   document.getElementById('spo_mship').style.visibility =  "visible"; 		
   document.getElementById('spo_mterms').style.visibility =  "visible";  
   document.getElementById('spo_unit').style.visibility =  "visible";  
   //document.getElementById('spo_lnitems').style.visibility =  "visible"; 
   //document.getElementById('spo_dept').disabled =true;
}  
	
if (generic) document.getElementById('pomsgscr').style.visibility = "hidden";
else if (ns4) document.layers["pomsgscr"].visibility = "hide";
else if (ie4) document.all["pomsgscr"].style.visibility = "hidden";

}

function showpovendor() {


if (document.getElementById('sposcreenup').value == "YES"){

   document.getElementById('spo_mship').style.visibility =  "hidden";		
   document.getElementById('spo_mterms').style.visibility =  "hidden"; 
   document.getElementById('spo_unit').style.visibility =  "hidden"; 
   document.getElementById('spo_lnitems').style.visibility =  "hidden";
    
}     

if (generic) document.getElementById('povscr').style.visibility = "visible";
else if (ns4) document.layers["povscr"].visibility = "show";
else if (ie4) document.all["povscr"].style.visibility = "visible";
}

function hidepovendor(){

if (document.getElementById('sposcreenup').value == "YES"){

   document.getElementById('spo_mship').style.visibility =  "visible"; 		
   document.getElementById('spo_mterms').style.visibility =  "visible";  
   document.getElementById('spo_unit').style.visibility =  "visible";  
   document.getElementById('spo_lnitems').style.visibility =  "visible"; 
   //document.getElementById('spo_dept').disabled =true;
}  

if (generic) document.getElementById('povscr').style.visibility = "hidden";
else if (ns4) document.layers["povscr"].visibility = "hide";
else if (ie4) document.all["povscr"].style.visibility = "hidden";

}

// end of dynamic layer java functions
function showprojed() {

	if (trim(document.getElementById('loglevel').value)=='9'){

   	  var muserchk=-1;
	  muserchk=document.getElementById('projwhofilter').selectedIndex;
	  if (muserchk < 1){
		alert('Please select an employee from the list above.');
	    return null;
      }	 
    }
 
	
document.getElementById('sprojscreenup').value= "YES";
document.getElementById('projwhofilter').disabled =true;
document.getElementById('proj_showfinishedbox').disabled =true;
document.getElementById('proj_openbox').disabled =true;
document.getElementById('currentprojsel').value=document.getElementById('projselect').selectedIndex;
    
	  if (trim(document.getElementById('loglevel').value)=="9"){
		document.getElementById('projectselect2').style.visibility = 'visible';
        document.getElementById('projwhofilter2').selectedIndex=0;
      } else {
	    document.getElementById('projectselect2').style.visibility = 'hidden';  
      }   
       
setprojpdf('PDF');	  
document.getElementById('proj_status').style.visibility = "visible"; 
document.getElementById('projselect').style.visibility = "hidden";


if (generic) document.getElementById('projed').style.visibility = "visible";
else if (ns4) document.layers["projed"].visibility = "show";
else if (ie4) document.all["projed"].style.visibility = "visible";

getEmailUsers();

}

function hideprojed(){
 document.getElementById('sprojscreenup').value= "NO";
 document.getElementById('proj_status').style.visibility = "hidden"; 
 document.getElementById('projselect').style.visibility = "visible";
 document.getElementById('projwhofilter2').selectedIndex=0;
 document.getElementById('projectselect2').style.visibility = "hidden"; 
 document.getElementById('projwhofilter').disabled =false;
 document.getElementById('proj_showfinishedbox').disabled =false;
 document.getElementById('proj_openbox').disabled =false;

 document.getElementById('projPDFbtn').style.visibility = "hidden"; 
 document.getElementById('projsavebtn').style.visibility = "hidden"; 
 
  	var oldsel=document.getElementById('currentprojsel').value;
	oldsel=parseInt(oldsel);
	document.getElementById('projselect').selectedIndex=oldsel;
	document.getElementById('proj_status').selectedIndex=-1;
	
	document.getElementById('reminddow').style.visibility = "hidden"; 
if (generic) document.getElementById('projed').style.visibility = "hidden";
else if (ns4) document.layers["projed"].visibility = "hide";
else if (ie4) document.all["projed"].style.visibility = "hidden";

projneworder(0,100);

}


//not using this for main proj screen because it looks like crap...
function showprojmsg() {
document.getElementById('projmsgscr').style.zIndex=2000;

document.getElementById('proj_status').style.visibility = "hidden";
if (generic) document.getElementById('projmsgscr').style.visibility = "visible";
else if (ns4) document.layers["projmsgscr"].visibility = "show";
else if (ie4) document.all["projmsgscr"].style.visibility = "visible";
}

function hideprojmsg(){
document.getElementById('projmsgscr').style.zIndex=1;
document.getElementById('projmsgtext').innerHTML="";

	
if (generic) document.getElementById('projmsgscr').style.visibility = "hidden";
else if (ns4) document.layers["projmsgscr"].visibility = "hide";
else if (ie4) document.all["projmsgscr"].style.visibility = "hidden";
document.getElementById('proj_status').style.visibility = "visible";
}

// the next two are a center screen for reporting bugs- same as single tk for background
function showinvcan() {

document.getElementById('invcanscrup').value = "YES";
    

if (document.getElementById('binvscreenup').value == "YES"){
 document.getElementById('binv_lnitems').style.visibility = "hidden";
 document.getElementById('binv_mship').style.visibility = "hidden";
 document.getElementById('binv_mterms').style.visibility = "hidden";
 document.getElementById('binv_dept').style.visibility = "hidden";
 document.getElementById('binv_unit').style.visibility = "hidden";
 

} else {
	
   document.getElementById('tktypeselect').style.visibility =  "hidden";
   document.getElementById('tkwhoselect').style.visibility =  "hidden";
   document.getElementById('tkcis1select').style.visibility =  "hidden";	   
 
}	
	
document.getElementById('invcanmess').value="";
if (generic) document.getElementById('invcanscr').style.visibility = "visible";
else if (ns4) document.layers["invcanscr"].visibility = "show";
else if (ie4) document.all["invcanscr"].style.visibility = "visible";

}


function hideinvcan() {

document.getElementById('invcanscrup').value = "NO";
document.getElementById('invcanmess').value="";

if (document.getElementById('binvscreenup').value == "YES"){
 document.getElementById('binv_lnitems').style.visibility = "visible";
 document.getElementById('binv_mship').style.visibility = "visible";
 document.getElementById('binv_mterms').style.visibility = "visible";
 document.getElementById('binv_dept').style.visibility = "visible";
 document.getElementById('binv_unit').style.visibility = "visible";
 
} else {
	
  document.getElementById('tktypeselect').style.visibility =  "visible";
  document.getElementById('tkwhoselect').style.visibility =  "visible";
  document.getElementById('tkcis1select').style.visibility =  "visible";
}

if (generic) document.getElementById('invcanscr').style.visibility = "hidden";
else if (ns4) document.layers["invcanscr"].visibility = "hide";
else if (ie4) document.all["invcanscr"].style.visibility = "hidden";

}


// counts screen

// the next two are a center screen showing single tickets
function showcounts() {

document.getElementById('cntlookup').value='';

document.getElementById('tkselectMain').style.visibility = "hidden";

document.getElementById('tkrptselect').style.visibility =  "hidden";
document.getElementById('tkwhofilter').style.visibility =  "hidden";
document.getElementById('tkclientfilter').style.visibility =  "hidden";
document.getElementById('tktypefilter').style.visibility =  "hidden";       

        var mnm=document.getElementById('uname').value;

		if (mnm=="Pat" || mnm=="Rich" || mnm=="Randy" || mnm=="Stephen" || mnm=="Cris"){
		  document.getElementById('wkstatlayer').style.visibility ='visible';
		  var theweek=getWeekNr();
          var today = new Date();
          var theyear=takeYear(today);

          cntgetwkstats(theweek,theyear,"N");

		  
		} else {
		  document.getElementById('wkstatlayer').style.visibility ='hidden';
		  
		}	

if (generic) document.getElementById('tk_counts').style.visibility = "visible";
else if (ns4) document.layers["tk_counts"].visibility = "show";
else if (ie4) document.all["tk_counts"].style.visibility = "visible";

}



function hidecounts() {
document.getElementById('cntlookup').value='';	
document.getElementById('tkrptselect').style.visibility ="visible";
document.getElementById('tkwhofilter').style.visibility ="visible";
document.getElementById('tkclientfilter').style.visibility ="visible";
document.getElementById('tktypefilter').style.visibility ="visible";       
	
document.getElementById('tkselectMain').style.visibility ="visible";
document.getElementById('wkstatlayer').style.visibility ='hidden';

if (generic) document.getElementById('tk_counts').style.visibility = "hidden";
else if (ns4) document.layers["tk_counts"].visibility = "hide";
else if (ie4) document.all["tk_counts"].style.visibility = "hidden";

}

// the next two a generic message if nothing has to be hidden
function showgenericmsg() {
document.getElementById('genericmsgscr').style.zIndex=5000;
if (generic) document.getElementById('genericmsgscr').style.visibility = "visible";
else if (ns4) document.layers["genericmsgscr"].visibility = "show";
else if (ie4) document.all["genericmsgscr"].style.visibility = "visible";

}


function hidegenericmsg() {
	
document.getElementById('genericmsgscr').style.zIndex=1;
document.getElementById('genericmsgscr').style.top='95px';
document.getElementById('genericmsgscr').style.left='175px'; 
document.getElementById('genericmsgscr').style.height='360px'; 
document.getElementById('genericmsgscr').style.width='480px';

document.getElementById('genericmsgtext').innerHTML="";
hidewait();
if (generic) document.getElementById('genericmsgscr').style.visibility = "hidden";
else if (ns4) document.layers["genericmsgscr"].visibility = "hide";
else if (ie4) document.all["genericmsgscr"].style.visibility = "hidden";


}

// the next two are delete box
function showcntpdfbox() {

if (generic) document.getElementById('cntprintpdfbox').style.visibility = "visible";
else if (ns4) document.layers["cntprintpdfbox"].visibility = "show";
else if (ie4) document.all["cntprintpdfbox"].style.visibility = "visible";
}


function hidecntpdfbox() {

if (generic) document.getElementById('cntprintpdfbox').style.visibility = "hidden";
else if (ns4) document.layers["cntprintpdfbox"].visibility = "hide";
else if (ie4) document.all["cntprintpdfbox"].style.visibility = "hidden";
}


function showresoccprpdfbox() {
document.getElementById('resoccprPDF').style.zIndex=15000;	

document.getElementById('prexcelbtn').style.visibility = "hidden";
document.getElementById('prvolbtn').style.visibility = "hidden";
if (generic) document.getElementById('resoccprPDF').style.visibility = "visible";
else if (ns4) document.layers["resoccprPDF"].visibility = "show";
else if (ie4) document.all["resoccprPDF"].style.visibility = "visible";
}


function hideresoccprpdfbox() {
document.getElementById('resoccprPDF').style.zIndex=1;	

document.getElementById('prexcelbtn').style.visibility = "hidden";
document.getElementById('prvolbtn').style.visibility = "hidden";
if (generic) document.getElementById('resoccprPDF').style.visibility = "hidden";
else if (ns4) document.layers["resoccprPDF"].visibility = "hide";
else if (ie4) document.all["resoccprPDF"].style.visibility = "hidden";
}

function showsalesrptscr() {
	
document.getElementById('salesrptscr').style.zIndex=15000;	

document.getElementById('slsXLS').style.visibility = "hidden";
document.getElementById('slsPDF').style.visibility = "hidden";
document.getElementById('slscompile').style.visibility = "visible";
buildslsqyr();
UtoggleQ();
resetslsrpt();
if (generic) document.getElementById('salesrptscr').style.visibility = "visible";
else if (ns4) document.layers["salesrptscr"].visibility = "show";
else if (ie4) document.all["salesrptscr"].style.visibility = "visible";



}


function hidesalesrptscr() {
document.getElementById('slsXLS').style.visibility = "hidden";
document.getElementById('slsPDF').style.visibility = "hidden";
document.getElementById('slscompile').style.visibility = "hidden";	
document.getElementById('salesrptscr').style.zIndex=1;	
document.forms['utilform'].utilsales2.selectedIndex=0;

document.getElementById('UMTHCUTOFF').style.visibility = "hidden"; 
document.getElementById('UQYRSCR').style.visibility = "hidden";
document.getElementById('UQRADIOS').style.visibility = "hidden";	    

if (generic) document.getElementById('salesrptscr').style.visibility = "hidden";
else if (ns4) document.layers["salesrptscr"].visibility = "hide";
else if (ie4) document.all["salesrptscr"].style.visibility = "hidden";
}

function showtkslsrptscr() {
	
document.getElementById('salesrptscr2').style.zIndex=15000;	
//this function is in select_boxes
buildslsqyr();
document.getElementById('slsXLS2').style.visibility = "hidden";
document.getElementById('slsPDF2').style.visibility = "hidden";
document.getElementById('slscompile2').style.visibility = "visible";
toggleQ();

if (generic) document.getElementById('salesrptscr2').style.visibility = "visible";
else if (ns4) document.layers["salesrptscr2"].visibility = "show";
else if (ie4) document.all["salesrptscr2"].style.visibility = "visible";



}


function hidetkslsrptscr() {
document.getElementById('slsXLS2').style.visibility = "hidden";
document.getElementById('slsPDF2').style.visibility = "hidden";
document.getElementById('slscompile2').style.visibility = "hidden";	
document.getElementById('salesrptscr2').style.zIndex=1;	

document.getElementById('MTHCUTOFF').style.visibility = "hidden"; 
document.getElementById('QYRSCR').style.visibility = "hidden";
document.getElementById('QRADIOS').style.visibility = "hidden";	 

if (generic) document.getElementById('salesrptscr2').style.visibility = "hidden";
else if (ns4) document.layers["salesrptscr2"].visibility = "hide";
else if (ie4) document.all["salesrptscr2"].style.visibility = "hidden";
}




function showclcomscr() {
document.getElementById('clcomPDF').style.zIndex=15000;	
if (generic) document.getElementById('clcomPDF').style.visibility = "visible";
else if (ns4) document.layers["clcomPDF"].visibility = "show";
else if (ie4) document.all["clcomPDF"].style.visibility = "visible";

 //lets go ahead and load the years(going back 5)
    var today = new Date();
	var mYear = takeYear(today);
    document.forms['utilform'].util_yr.options.length = 0;
    var xcv=0;
    while (xcv < 5){       
      document.forms['utilform'].util_yr.options[xcv] = new Option(mYear,mYear,true,false);
      mYear=(mYear-1);
      xcv=(xcv+1);
    }



}


function hideclcomscr() {
document.getElementById('clcomPDF').style.zIndex=1;		
if (generic) document.getElementById('clcomPDF').style.visibility = "hidden";
else if (ns4) document.layers["clcomPDF"].visibility = "hide";
else if (ie4) document.all["clcomPDF"].style.visibility = "hidden";
}


function showstaxscr() {
document.getElementById('staxPDF').style.zIndex=15000;	
if (generic) document.getElementById('staxPDF').style.visibility = "visible";
else if (ns4) document.layers["staxPDF"].visibility = "show";
else if (ie4) document.all["staxPDF"].style.visibility = "visible";

var mlevel=parseInt(document.getElementById('loglevel').value);
if (mlevel > 7){
	
   document.getElementById('reverse1').style.visibility = "visible";
   document.getElementById('reverse2').style.visibility = "visible";
   document.getElementById('reverse3').style.visibility = "visible";	
   getrevdts();
   
} else {
  
   document.getElementById('reverse1').style.visibility = "hidden";
   document.getElementById('reverse2').style.visibility = "hidden";
   document.getElementById('reverse3').style.visibility = "hidden";	
   upgetslsDir('pdf');
}	
   
   
   
   
}


function hidestaxscr() {
	
 document.getElementById('reverse1').style.visibility = "hidden";
 document.getElementById('reverse2').style.visibility = "hidden";
 document.getElementById('reverse3').style.visibility = "hidden";	
		
	
if (generic) document.getElementById('staxPDF').style.visibility = "hidden";
else if (ns4) document.layers["staxPDF"].visibility = "hide";
else if (ie4) document.all["staxPDF"].style.visibility = "hidden";
}



// the next two are a center screen could combine this into error message
function showclientfind() {

document.getElementById('clientfind').style.zIndex=5000;		
if (document.getElementById('mcustscreenup').value == "YES") {

  if (document.getElementById('maddscreenup').value === "NO") {

   //disable selects while message up
   document.getElementById('mterms').style.visibility = "hidden";
   document.getElementById('mcust').style.visibility = "hidden";

   } else {

    document.getElementById('ADD_PRIMDEPT').style.visibility = "hidden";
    document.getElementById('ADD_PRIMLOCATION').style.visibility = "hidden"; 
    document.getElementById('ADD_SRVCTYPE').style.visibility = "hidden";
    document.getElementById('ADD_MTERMS').style.visibility = "hidden";
    document.getElementById('ADD_MSHIP').style.visibility = "hidden";
    document.getElementById('ADD_FILETYPE').style.visibility = "hidden";
    document.getElementById('ADD_TAGFORMAT').style.visibility = "hidden";  

   }
	
}

 // check the three states for ticket screens
if (document.getElementById('mtksinglescrup').value=='YES') {
 
     document.getElementById('tktypeselect').style.visibility =  "hidden";
     document.getElementById('tkwhoselect').style.visibility =  "hidden";
     document.getElementById('tkcis1select').style.visibility =  "hidden";


} else if (document.getElementById('maddtkscrnup').value=='YES'){

     document.getElementById('tkclientadd').style.visibility =  "hidden";
     document.getElementById('addtktypeselect').style.visibility =  "hidden";
     document.getElementById('addtkwhoselect').style.visibility =  "hidden";
     document.getElementById('addtkcis1select').style.visibility =  "hidden";

} else if (document.getElementById('mtktscreenup').value == "YES"){
 
     document.getElementById('tkselectMain').style.visibility =  "hidden";
     document.getElementById('tkrptselect').style.visibility =  "hidden";		
     document.getElementById('tkwhofilter').style.visibility =  "hidden"; 
     document.getElementById('tkclientfilter').style.visibility =  "hidden"; 
     document.getElementById('tktypefilter').style.visibility =  "hidden";  
}

document.getElementById('clientfilter').style.visibility =  "visible"; 
 

if (generic) document.getElementById('clientfind').style.visibility = "visible";
else if (ns4) document.layers["clientfind"].visibility = "show";
else if (ie4) document.all["clientfind"].style.visibility = "visible";



}

function hideclientfind() {
	
document.getElementById('clnt_mid').value =" Enter all or part of name"
document.forms['ticketform'].clientfilter.options.length = 0;
document.forms['ticketform'].clientfilter.options[0] = new Option("Search Results",'true');

if (document.getElementById('mcustscreenup').value == "YES") {

	if (document.getElementById('maddscreenup').value === "NO") {

	   //enable selects 
	   if (document.getElementById('stk').style.visibility == "hidden"){
	     document.getElementById('mterms').style.visibility = "visible";
	   }
	
	   if (document.getElementById('stk').style.visibility == "hidden"){
	     document.getElementById('mcust').style.visibility = "visible";
	   }
	 
	} else {
		
      document.getElementById('ADD_PRIMDEPT').style.visibility = "visible";
      document.getElementById('ADD_PRIMLOCATION').style.visibility = "visible";  
	  document.getElementById('ADD_SRVCTYPE').style.visibility = "visible";
	  document.getElementById('ADD_MTERMS').style.visibility = "visible";
	  document.getElementById('ADD_MSHIP').style.visibility = "visible";
	  document.getElementById('ADD_FILETYPE').style.visibility = "visible";
	  document.getElementById('ADD_TAGFORMAT').style.visibility = "visible";  

	}

} 

if (document.getElementById('mtksinglescrup').value=='YES') {

     document.getElementById('tktypeselect').style.visibility =  "visible";
     document.getElementById('tkwhoselect').style.visibility =  "visible";
     document.getElementById('tkcis1select').style.visibility =  "visible";
     
} else if (document.getElementById('maddtkscrnup').value=='YES'){

     document.getElementById('tkclientadd').style.visibility =  "visible";
     document.getElementById('addtktypeselect').style.visibility =  "visible";
     document.getElementById('addtkwhoselect').style.visibility =  "visible";
     document.getElementById('addtkcis1select').style.visibility =  "visible";

} else if (document.getElementById('mtktscreenup').value == "YES"){

     document.getElementById('tkselectMain').style.visibility =  "visible"; 
     document.getElementById('tkrptselect').style.visibility =  "visible";		
     document.getElementById('tkwhofilter').style.visibility =  "visible"; 
     document.getElementById('tkclientfilter').style.visibility =  "visible"; 
     document.getElementById('tktypefilter').style.visibility =  "visible";  

}

document.getElementById('clientfilter').style.visibility =  "hidden"; 
 

if (generic) document.getElementById('clientfind').style.visibility = "hidden";
else if (ns4) document.layers["clientfind"].visibility = "hide";
else if (ie4) document.all["clientfind"].style.visibility = "hidden";
document.getElementById('clientfind').style.zIndex=1;

}

// the next two are a center screen could combine this into error message
function showpassscr(mstr,passfunction) {

document.getElementById('passfunction').value=passfunction;
document.getElementById('functionarg').value=mstr;

document.getElementById('passwordscr').style.zIndex=5000;		
if (document.getElementById('mcustscreenup').value == "YES") {

  if (document.getElementById('maddscreenup').value === "NO") {

   //disable selects while message up
   document.getElementById('mterms').style.visibility = "hidden";
   document.getElementById('mcust').style.visibility = "hidden";

   } else {

    document.getElementById('ADD_PRIMDEPT').style.visibility = "hidden";
    document.getElementById('ADD_PRIMLOCATION').style.visibility = "hidden"; 
    document.getElementById('ADD_SRVCTYPE').style.visibility = "hidden";
    document.getElementById('ADD_MTERMS').style.visibility = "hidden";
    document.getElementById('ADD_MSHIP').style.visibility = "hidden";
    document.getElementById('ADD_FILETYPE').style.visibility = "hidden";
    document.getElementById('ADD_TAGFORMAT').style.visibility = "hidden";  

   }
	
}

 // check the three states for ticket screens
if (document.getElementById('mtksinglescrup').value=='YES') {
 
     document.getElementById('tktypeselect').style.visibility =  "hidden";
     document.getElementById('tkwhoselect').style.visibility =  "hidden";
     document.getElementById('tkcis1select').style.visibility =  "hidden";


} else if (document.getElementById('maddtkscrnup').value=='YES'){

     document.getElementById('tkclientadd').style.visibility =  "hidden";
     document.getElementById('addtktypeselect').style.visibility =  "hidden";
     document.getElementById('addtkwhoselect').style.visibility =  "hidden";
     document.getElementById('addtkcis1select').style.visibility =  "hidden";

} else if (document.getElementById('mtktscreenup').value == "YES"){
 
     document.getElementById('tkselectMain').style.visibility =  "hidden";
     document.getElementById('tkrptselect').style.visibility =  "hidden";		
     document.getElementById('tkwhofilter').style.visibility =  "hidden"; 
     document.getElementById('tkclientfilter').style.visibility =  "hidden"; 
     document.getElementById('tktypefilter').style.visibility =  "hidden";  
}


if (generic) document.getElementById('passwordscr').style.visibility = "visible";
else if (ns4) document.layers["passwordscr"].visibility = "show";
else if (ie4) document.all["passwordscr"].style.visibility = "visible";



}

function hidepassscr() {
	
document.getElementById('pass_str').value =" Enter in a password"

if (document.getElementById('mcustscreenup').value == "YES") {

	if (document.getElementById('maddscreenup').value === "NO") {

	   //enable selects 
	   if (document.getElementById('stk').style.visibility == "hidden"){
	     document.getElementById('mterms').style.visibility = "visible";
	   }
	
	   if (document.getElementById('stk').style.visibility == "hidden"){
	     document.getElementById('mcust').style.visibility = "visible";
	   }
	 
	} else {
		
      document.getElementById('ADD_PRIMDEPT').style.visibility = "visible";
      document.getElementById('ADD_PRIMLOCATION').style.visibility = "visible";  
	  document.getElementById('ADD_SRVCTYPE').style.visibility = "visible";
	  document.getElementById('ADD_MTERMS').style.visibility = "visible";
	  document.getElementById('ADD_MSHIP').style.visibility = "visible";
	  document.getElementById('ADD_FILETYPE').style.visibility = "visible";
	  document.getElementById('ADD_TAGFORMAT').style.visibility = "visible";  

	}

} 

if (document.getElementById('mtksinglescrup').value=='YES') {

     document.getElementById('tktypeselect').style.visibility =  "visible";
     document.getElementById('tkwhoselect').style.visibility =  "visible";
     document.getElementById('tkcis1select').style.visibility =  "visible";
     
} else if (document.getElementById('maddtkscrnup').value=='YES'){

     document.getElementById('tkclientadd').style.visibility =  "visible";
     document.getElementById('addtktypeselect').style.visibility =  "visible";
     document.getElementById('addtkwhoselect').style.visibility =  "visible";
     document.getElementById('addtkcis1select').style.visibility =  "visible";

} else if (document.getElementById('mtktscreenup').value == "YES"){

     document.getElementById('tkselectMain').style.visibility =  "visible"; 
     document.getElementById('tkrptselect').style.visibility =  "visible";		
     document.getElementById('tkwhofilter').style.visibility =  "visible"; 
     document.getElementById('tkclientfilter').style.visibility =  "visible"; 
     document.getElementById('tktypefilter').style.visibility =  "visible";  

}
document.getElementById('passfunction').value="";
document.getElementById('functionarg').value="";
document.getElementById('passmsg').value="This process is password protected.";

if (generic) document.getElementById('passwordscr').style.visibility = "hidden";
else if (ns4) document.layers["passwordscr"].visibility = "hide";
else if (ie4) document.all["passwordscr"].style.visibility = "hidden";
document.getElementById('passwordscr').style.zIndex=1;

}



function checkpassword(mstr){
	if (mstr=='digdug'){
		
		   if (document.getElementById('passfunction').value="movetheticket"){
                 
                //this function is located in the functions.js ln 685 
                var mstr=document.getElementById('functionarg').value;
                var rs=mstr.split("|");  
	            var myesno="Are you sure you want to move this ticket to: <br> "+rs[0]+" -"+rs[1]+"?  ";   
	            hidepassscr();
	            showyesno(myesno,"movetk");
                   
           } else {
	           
              alert("Password correct but no function is defined for this screen, please contact administrator.   ");
              
           }
	
	} else {
	  document.getElementById('passmsg').innerHTML = "The password is incorrect, please try again.";
	    
    }    
}	


function showtscreen() {
document.getElementById('tscreen').style.zIndex=15000;	
if (generic) document.getElementById('tscreen').style.visibility = "visible";
else if (ns4) document.layers["tscreen"].visibility = "show";
else if (ie4) document.all["tscreen"].style.visibility = "visible";
}


function hidetscreen() {
document.getElementById('tscreen').style.zIndex=1;		
if (generic) document.getElementById('tscreen').style.visibility = "hidden";
else if (ns4) document.layers["tscreen"].visibility = "hide";
else if (ie4) document.all["tscreen"].style.visibility = "hidden";
}


// the next two are a center screen adding a contact
function showDunnLookup() {
		
 //disable selects while message up


if (generic) document.getElementById('dunlookup').style.visibility = "visible";
else if (ns4) document.layers["dunlookup"].visibility = "show";
else if (ie4) document.all["dunlookup"].style.visibility = "visible";


}


function hideDunnLookup() {

if (generic) document.getElementById('dunlookup').style.visibility = "hidden";
else if (ns4) document.layers["dunlookup"].visibility = "hide";
else if (ie4) document.all["dunlookup"].style.visibility = "hidden";

}

// the next two are a center screen adding a contact
function showSicLookup() {
		
 //disable selects while message up
coll_all();

if (generic) document.getElementById('siclookup').style.visibility = "visible";
else if (ns4) document.layers["siclookup"].visibility = "show";
else if (ie4) document.all["siclookup"].style.visibility = "visible";



//siccodetree

}


function hideSicLookup() {

if (generic) document.getElementById('siclookup').style.visibility = "hidden";
else if (ns4) document.layers["siclookup"].visibility = "hide";
else if (ie4) document.all["siclookup"].style.visibility = "hidden";

}


function showtsurvey() {
document.getElementById('surveyscr').style.zIndex=25000;	
if (generic) document.getElementById('surveyscr').style.visibility = "visible";
else if (ns4) document.layers["surveyscr"].visibility = "show";
else if (ie4) document.all["surveyscr"].style.visibility = "visible";
}


function hidesurvey() {
document.forms['custcareform'].surveys.selectedIndex=0;	
document.getElementById('surveyscr').style.zIndex=1;
document.getElementById('surveytext').innerHTML="";
if (generic) document.getElementById('surveyscr').style.visibility = "hidden";
else if (ns4) document.layers["surveyscr"].visibility = "hide";
else if (ie4) document.all["surveyscr"].style.visibility = "hidden";
}


function showtadmsurvey() {
document.getElementById('admsurveyscr').style.zIndex=25000;	
if (generic) document.getElementById('admsurveyscr').style.visibility = "visible";
else if (ns4) document.layers["admsurveyscr"].visibility = "show";
else if (ie4) document.all["admsurveyscr"].style.visibility = "visible";
}


function hideadmsurvey() {
	
document.forms['utilform'].adm_surveys.selectedIndex=0;	
document.getElementById('admsurveyscr').style.zIndex=1;
document.getElementById('admsurveytext').innerHTML="";
if (generic) document.getElementById('admsurveyscr').style.visibility = "hidden";
else if (ns4) document.layers["admsurveyscr"].visibility = "hide";
else if (ie4) document.all["admsurveyscr"].style.visibility = "hidden";
}


// the next two are a center screen showing single user
function showoverride() {

	document.getElementById('custompr').style.zIndex=30000;	
	
	if (generic) document.getElementById('custompr').style.visibility = "visible";
	else if (ns4) document.layers["custompr"].visibility = "show";
	else if (ie4) document.all["custompr"].style.visibility = "visible";
 
}

function hideoverride() {
 
	document.getElementById('custompr').style.zIndex=1;
	
	
	//document.getElementById('overridesave').style.visibility = "hidden";
	//document.getElementById('overridedelete').style.visibility = "hidden";

	if (generic) document.getElementById('custompr').style.visibility = "hidden";
	else if (ns4) document.layers["custompr"].visibility = "hide";
	else if (ie4) document.all["custompr"].style.visibility = "hidden";

}


// the next two are a center screen showing single user
function showSKUutil() {
	document.getElementById('SKUutilscr').style.zIndex=30000;	
	document.getElementById('pick_schema').style.visibility = "hidden";
	document.getElementById('skuButtons').style.visibility = "hidden";
	document.getElementById('schButtons').style.visibility = "hidden";
	document.getElementById('griddata').innerHTML=""; 
	document.getElementById('gridtitle').innerHTML=""; 
	
	if (generic) document.getElementById('SKUutilscr').style.visibility = "visible";
	else if (ns4) document.layers["SKUutilscr"].visibility = "show";
	else if (ie4) document.all["SKUutilscr"].style.visibility = "visible";
 
}

function hideSKUutil() {
    
	hideschemabox(); 
    hideskusupbox();
    
	document.getElementById('SKUutilscr').style.zIndex=1;
	document.getElementById('pick_schema').style.visibility = "hidden";
	
	//I should change this to one layer and then just close the one on exit
	document.getElementById('skuButtons').style.visibility = "hidden";
	document.getElementById('schButtons').style.visibility = "hidden";
	document.getElementById('prodButtons').style.visibility = "hidden";
	document.getElementById('skusupportup').value="";
	//document.getElementById('overridesave').style.visibility = "hidden";
	//document.getElementById('overridedelete').style.visibility = "hidden";

	if (generic) document.getElementById('SKUutilscr').style.visibility = "hidden";
	else if (ns4) document.layers["SKUutilscr"].visibility = "hide";
	else if (ie4) document.all["SKUutilscr"].style.visibility = "hidden";

}



// the next two are delete box
function showschemabox(mtyp) {

document.getElementById('typeofschema').value=mtyp;

if (generic) document.getElementById('schemabox').style.visibility = "visible";
else if (ns4) document.layers["schemabox"].visibility = "show";
else if (ie4) document.all["schemabox"].style.visibility = "visible";
}


function hideschemabox() {

if (generic) document.getElementById('schemabox').style.visibility = "hidden";
else if (ns4) document.layers["schemabox"].visibility = "hide";
else if (ie4) document.all["schemabox"].style.visibility = "hidden";
}


// the next two are delete box
function showskusupbox(mtyp) {

//document.getElementById('typeofskusup').value=mtyp;

if (generic) document.getElementById('skusupportbox').style.visibility = "visible";
else if (ns4) document.layers["skusupportbox"].visibility = "show";
else if (ie4) document.all["skusupportbox"].style.visibility = "visible";
}


function hideskusupbox() {
	
  document.getElementById('thesupcode').value="";
  document.getElementById('thesupdesc').value="";
  document.getElementById('thesuporder').value="";

if (generic) document.getElementById('skusupportbox').style.visibility = "hidden";
else if (ns4) document.layers["skusupportbox"].visibility = "hide";
else if (ie4) document.all["skusupportbox"].style.visibility = "hidden";
}

function showskuoptions(mskunum,actiontype) {
	
	document.getElementById('theskunum').value=mskunum;
	document.getElementById('actiontype').value=actiontype;	
	
	document.getElementById('SKUoptions').style.zIndex=30000;
	if (generic) document.getElementById('SKUoptions').style.visibility = "visible";
	else if (ns4) document.layers["SKUoptions"].visibility = "show";
	else if (ie4) document.all["SKUoptions"].style.visibility = "visible";

}

function hideskuoptions() {
	
	document.getElementById('theskunum').value="";
	document.getElementById('actiontype').value="";
	document.getElementById('globalPricebox').checked=false;
		
	document.getElementById('SKUoptions').style.zIndex=1;
  
	if (generic) document.getElementById('SKUoptions').style.visibility = "hidden";
	else if (ns4) document.layers["SKUoptions"].visibility = "hide";
	else if (ie4) document.all["SKUoptions"].style.visibility = "hidden";

}

// the next two are delete box
function showpdfbox(mtyp) {

  document.getElementById('skuorschpdf').value=mtyp;
  document.getElementById('SKUSCHpdfscr').style.zIndex=30000;
  
  if (generic) document.getElementById('SKUSCHpdfscr').style.visibility = "visible";
  else if (ns4) document.layers["SKUSCHpdfscr"].visibility = "show";
  else if (ie4) document.all["SKUSCHpdfscr"].style.visibility = "visible";

}


function hidepdfbox() {
	
  document.getElementById('SKUSCHpdfscr').style.zIndex=1;
  document.getElementById('skuorschpdf').value="";

  if (generic) document.getElementById('SKUSCHpdfscr').style.visibility = "hidden";
  else if (ns4) document.layers["SKUSCHpdfscr"].visibility = "hide";
  else if (ie4) document.all["SKUSCHpdfscr"].style.visibility = "hidden";
}
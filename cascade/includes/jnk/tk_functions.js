//function for tickets 

function sorttickets(sortT,mreverse) {

  var msort=sortT;
  var numOpt=0;

    if (msort=='J'){
      uncheckoth('5'); //this is to trigger uncheck for radio- don't ask ;-)
    } else if (msort=='I'){
      uncheckoth('4');
    } else if (msort=='D'){
      uncheckoth('3');
    } else if (msort=='C'){
      uncheckoth('2');
    } else if (msort=='T'){
      uncheckoth('1');
    } else {  
      uncheckoth('6');
    }

  numOpt=document.forms['ticketform'].tkselectMain.options.length;
 
  newopt= new Array();

  for (z=0; z < numOpt; z++) {
 
    var indexid="";
    var indexin="";
    var indexdue="";
    var indexclient="";
    var indextype="";

    nametext=document.forms['ticketform'].tkselectMain[z].text;          
 
    //add the 2 digdit year to the date var for sorting-will strip out later when we put the select back together
    indexid=nametext.substring(0,6);
    indexin=nametext.substring(13,15)+nametext.substring(7,15);
    indexdue=nametext.substring(22,24)+nametext.substring(16,24);
    indexclient=nametext.substring(25,49);
    middlestr=nametext.substring(51,94);
    indextype=nametext.substring(95,102);

   
   // alert("ID-"+indexid+"-In-"+indexin+"-Due-"+indexdue+"-Clnt-"+indexclient+"-Middle-"+middlestr+"-Type-"+indextype);

    if (msort=='J'){
      newopt[z] = indexid+"~1b~~2~"+indexin+"~2b~~3~"+indexdue+"~3b~~4~"+indexclient+"~4b~~5~"+indextype+"~5b~~6~"+middlestr+"~6b~";
    } else if (msort=='I'){
      newopt[z] = indexin+"~2b~~1~"+indexid+"~1b~~3~"+indexdue+"~3b~~4~"+indexclient+"~4b~~5~"+indextype+"~5b~~6~"+middlestr+"~6b~";
    } else if (msort=='D'){
      newopt[z] = indexdue+"~3b~~1~"+indexid+"~1b~~2~"+indexin+"~2b~~4~"+indexclient+"~4b~~5~"+indextype+"~5b~~6~"+middlestr+"~6b~";
    } else if (msort=='C'){
      newopt[z] = indexclient+"~4b~~1~"+indexid+"~1b~~2~"+indexin+"~2b~~3~"+indexdue+"~3b~~5~"+indextype+"~5b~~6~"+middlestr+"~6b~";
    } else if (msort=='T'){
      newopt[z] = indextype+"~5b~~1~"+indexid+"~1b~~2~"+indexin+"~2b~~3~"+indexdue+"~3b~~4~"+indexclient+"~4b~~6~"+middlestr+"~6b~";
    } else {  
      newopt[z] = nametext;
      
    }
 
  } // end of for


//sort it
//if (msort !='A' && msort !='J'){
  newopt=newopt.sort();
//} else {
//  newopt=newopt.reverse();   
//}

 //add in order number for first element
 for (x in newopt){
  if (msort=='J'){
      newopt[x] = "~1~"+newopt[x];
    } else if (msort=='I'){
      newopt[x] = "~2~"+newopt[x];
    } else if (msort=='D'){
      newopt[x] = "~3~"+newopt[x];
    } else if (msort=='C'){
      newopt[x] = "~4~"+newopt[x];
    } else if (msort=='T'){
      newopt[x] = "~5~"+newopt[x];
    } else {
      newopt[x] = newopt[x];
    }
   }

   
  document.forms['ticketform'].tkselectMain.options.length=0;
 
  var str1="";
  var str2="";
  var str3="";
  var str4="";
  var str5="";
  var str6="";
  var onea=0;
  var oneb=0;
  var twoa=0;
  var twob=0;
  var threea=0;
  var threeb=0;
  var foura=0;
  var fourb=0;
  var fivea=0;
  var fiveb=0;
  var sixa=0;
  var sixb=0;    

  var loadstring="";

  for (m in newopt){

   if (msort=='A'){

     loadstring =newopt[m];
     document.forms['ticketform'].tkselectMain.options[m] =new Option(loadstring,loadstring,true,false);        

   } else {

     if (trim(newopt[m]) != ""){ 
       loadstring =newopt[m];
       //alert(loadstring);
       
       var onea=(loadstring.indexOf("~1~")+3);
       var oneb=loadstring.indexOf("~1b~");
       str1=loadstring.substring(onea,oneb);
 
       twoa=(loadstring.indexOf("~2~")+3);
       twob=loadstring.indexOf("~2b~");  
       str2=loadstring.substring(twoa,twob);

       threea=(loadstring.indexOf("~3~")+3);
       threeb=loadstring.indexOf("~3b~");
       str3=loadstring.substring(threea,threeb);

       foura=(loadstring.indexOf("~4~")+3); 
       fourb=loadstring.indexOf("~4b~"); 
       str4=loadstring.substring(foura,fourb);

       fivea=(loadstring.indexOf("~5~")+3);
       fiveb=loadstring.indexOf("~5b~");
       str5=loadstring.substring(fivea,fiveb);

       sixa=(loadstring.indexOf("~6~")+3);
       sixb=loadstring.indexOf("~6b~");
       str6=loadstring.substring(sixa,sixb);
  
       str1 = padRight(str1,' ',6);
       str2 = padRight(str2,' ',10);
       str3 = padRight(str3,' ',10);
       str4 = padRight(str4,' ',25);
       str6 = padRight(str6,' ',30);
       str5 = padRight(str5,' ',5);
       

       //strip out the 2 digit year added to date for sort
       loadstring=str1+" "+str2.substring(2,10)+" "+str3.substring(2,10)+" "+str4+" "+str6+" "+str5;

       document.forms['ticketform'].tkselectMain.options[m] =new Option(loadstring,loadstring,true,false);        

     } // end of no filter check
       

     } // end of blank check  

   } // end of for loop



} // end of function


function checkforfilter(mtype) {

  if (mtype=='po'){	
	
	
	tkCTK('po');
	
	
  } else if (mtype=='job'){	
	
	
	tkCTK('job');
	
	
  } else if (document.getElementById('tkopentkbox').checked == false){

     //check for picklist filter
     var mf1 = document.forms['ticketform'].tkwhofilter.selectedIndex;
     var mf2 = document.forms['ticketform'].tktypefilter.selectedIndex;
     var mf3 = document.forms['ticketform'].tkclientfilter.selectedIndex;

     //check for date filter
     var str1 = document.getElementById("tkdt1").value;
     var str2 = document.getElementById("tkdt2").value;

     str1=trim(str1);
     mf4=str1.length;

     str2=trim(str2);
     mf5=str2.length;

     //check desc filter
     var str3 = document.getElementById("tksdesc").value;
     str3=trim(str3);
     mf6=str3.length;

     var totallen=(mf1+mf2)+(mf3+mf4)+(mf5+mf6);
 
       if (totallen==0){

         alert("This check box can only be unchecked with at least one filter condition set.");
         document.getElementById('tkopentkbox').checked = true
         tkCTK('na');

       } else { 

         tkCTK('na');

       }


  } else { 
 
    tkCTK('na');

 }


}


function resetfilters() {

document.getElementById('tkopentkbox').checked = true
document.getElementById("tksdesc").value="";
document.getElementById("tksid").value=" ";
document.getElementById("tk_mid").value="Enter all or part of name";

document.forms['ticketform'].tkwhofilter.options[0].selected = true;
document.forms['ticketform'].tktypefilter.options[0].selected = true;
document.forms['ticketform'].tkclientfilter.options[0].selected = true;
document.getElementById('tkdt1').value='';
document.getElementById('tkdt2').value='';

tkCTK();

}



function uncheckoth(mnum) {
//used this with radio buttons numbered differently, needed to reset and this worked easy
var thenum=mnum;

document.getElementById('tkrptsort1').checked = false;
document.getElementById('tkrptsort2').checked = false;
document.getElementById('tkrptsort3').checked = false;
document.getElementById('tkrptsort4').checked = false;
document.getElementById('tkrptsort5').checked = false;
document.getElementById('tkrptsort6').checked = false;

document.getElementById('tkrptsort'+thenum).checked = true;


}

function resetTKFieldColors(){
 
 //reset validation to black
  document.getElementById('tk_addstkJOB_ID').style.color='black';
  document.getElementById('tk_addstkDATE_DUE').style.color='black';
  document.getElementById('tk_addstkORDERDESC').style.color='black';
  document.getElementById('tk_addstkPO').style.color='black';
  document.getElementById('tk_addstkDATE_DONE').style.color='black';
  document.getElementById('tk_addstkCUST_ID').style.color='black';
  document.getElementById('tk_addstkAMOUNT').style.color='black';
  document.getElementById('tk_addstkSHIPPING').style.color='black';
  document.getElementById('tk_addstkCONTACT').style.color='black';
  document.getElementById('tk_addstkQUANTITY').style.color='black';
  document.getElementById('tk_addstkINV_DATE').style.color='black';
  document.getElementById('tk_addstkARMS_ORD').style.color='black';
  document.getElementById('tk_addstkARMS_JOB').style.color='black';
  document.getElementById('tk_addstknotes').style.color='black';
  document.forms['ticketform'].addtktypeselect.options[0].selected = true;
  document.forms['ticketform'].addtkwhoselect.options[0].selected = true;
  document.forms['ticketform'].addtkcis1select.options[0].selected = true;
  document.getElementById('tk_addstkDPbox').checked = false;
  document.getElementById('tk_addstkLASERINGbox').checked = false;
  document.getElementById('tk_addstkOCCUPANTbox').checked = false;
  document.getElementById('tk_addstkDATA_ENTRYbox').checked = false;
  document.getElementById('tk_addstkMAPSbox').checked = false;

  document.getElementById('tk_stkJOB_ID').style.color='black';
  document.getElementById('tk_stkDATE_DUE').style.color='black';
  document.getElementById('tk_stkORDERDESC').style.color='black';
  document.getElementById('tk_stkPO').style.color='black';
  document.getElementById('tk_stkDATE_DONE').style.color='black';
  document.getElementById('tk_stkCUST_ID').style.color='black';
  document.getElementById('tk_stkAMOUNT').style.color='black';
  document.getElementById('tk_stkSHIPPING').style.color='black';
  document.getElementById('tk_stkCONTACT').style.color='black';
  document.getElementById('tk_stkQUANTITY').style.color='black';
  document.getElementById('tk_stkINV_DATE').style.color='black';
  document.getElementById('tk_stkARMS_ORD').style.color='black';
  document.getElementById('tk_stkARMS_JOB').style.color='black';
  document.getElementById('tk_stknotes').style.color='black';
  document.forms['ticketform'].tktypeselect.options[0].selected = true;
  document.forms['ticketform'].tkwhoselect.options[0].selected = true;
  document.forms['ticketform'].tkcis1select.options[0].selected = true;
  document.getElementById('tk_stkDPbox').checked = false;
  document.getElementById('tk_stkLASERINGbox').checked = false;
  document.getElementById('tk_stkOCCUPANTbox').checked = false;
  document.getElementById('tk_stkDATA_ENTRYbox').checked = false;
  document.getElementById('tk_stkMAPSbox').checked = false;

} 


function tk_default_add() {

var currentTime = new Date();
var month = currentTime.getMonth() + 1;

var day = currentTime.getDate();
var day2 = currentTime.getDate()+7;
var year = currentTime.getYear();


var defdate = month + "/" + day + "/" + year;
if (month < 10){
  defdate="0"+defdate;
}
if (day < 10){
 defdate= defdate.substring(0,3)+"0"+defdate.substring(3);
}
var defdate= defdate.substring(0,6)+defdate.substring(8,10);


var defdatedue = month + "/" + day2 + "/" + year;
if (month < 10){
  defdatedue="0"+defdatedue;
}
if (day < 10){
 defdatedue= defdatedue.substring(0,3)+"0"+defdatedue.substring(3);
}
var defdatedue= defdatedue.substring(0,6)+defdatedue.substring(8,10);


  document.getElementById('tk_addstkJOB_ID').value = 'To Be Assigned';
  document.getElementById('tk_addstkDATE_IN').value = defdate;
  document.getElementById('tk_addstkDATE_DUE').value = defdatedue;
  //document.getElementById('tk_addstkCUSTOMER').value = '';

  document.forms['ticketform'].addtktypeselect.options[0].selected = true;
  document.forms['ticketform'].addtkwhoselect.options[0].selected = true;
  document.forms['ticketform'].addtkcis1select.options[0].selected = true;


  //document.getElementById('tk_addstkORDERDESC').value = '';
  //document.getElementById('tk_addstkPO').value = '';
  document.getElementById('tk_addstkDATE_DONE').value ='';
  //document.getElementById('tk_addstkCUST_ID').value = '';
  //document.getElementById('tk_addstkVPID').value = '';
  //document.getElementById('tk_addstkOLD_CUST').value = '';
  document.getElementById('tk_addstkAMOUNT').value = '';
  document.getElementById('tk_addstkSHIPPING').value = '';
  //document.getElementById('tk_addstkWEEKNO').value = '';
  //document.getElementById('tk_addstkCONTACT').value = '';
  //document.getElementById('tk_addstkCIS2').value = '';
  //document.getElementById('tk_addstkCIS3').value = '';

  // 19 is Y/N for DP
  document.getElementById('tk_addstkDPbox').checked = false;
  
  // 20 is Y/N for lasering
  document.getElementById('tk_addstkLASERINGbox').checked = false;
      
  // 21 is Y/N for OCCUPANT
  document.getElementById('tk_addstkOCCUPANTbox').checked = false;

  // 22 is Y/N for Data Entry
  document.getElementById('tk_addstkDATA_ENTRYbox').checked = false;

  // 23 is Y/N for Maps
  document.getElementById('tk_addstkMAPSbox').checked = false;

  document.getElementById('tk_addstkQUANTITY').value = '';
  document.getElementById('tk_addstkINV_DATE').value = '';
  //document.getElementById('tk_addstkSALESPER').value = '';
  //document.getElementById('tk_addstkSALESPERNO').value = '';
  document.getElementById('tk_addstkARMS_ORD').value = 'N/A';
  document.getElementById('tk_addstkARMS_JOB').value = 'N/A';
  document.getElementById('tk_addstkNOTES').value = '';

 
 //reset validation to black
  document.getElementById('tk_addstkJOB_ID').style.color='black';
  document.getElementById('tk_addstkDATE_DUE').style.color='black';
  document.getElementById('tk_addstkORDERDESC').style.color='black';
  document.getElementById('tk_addstkPO').style.color='black';
  document.getElementById('tk_addstkDATE_DONE').style.color='black';
  //this is done by picklist document.getElementById('tk_addstkCUST_ID').style.color='black';
  //document.getElementById('tk_addstkVPID').style.color='black';
  //document.getElementById('tk_addstkOLD_CUST').style.color='black';
  document.getElementById('tk_addstkAMOUNT').style.color='black';
  document.getElementById('tk_addstkSHIPPING').style.color='black';
  document.getElementById('tk_addstkCONTACT').style.color='black';
  //document.getElementById('tk_addstkCIS2').style.color='black';
  //document.getElementById('tk_addstkCIS3').style.color='black';
  document.getElementById('tk_addstkQUANTITY').style.color='black';
  document.getElementById('tk_addstkINV_DATE').style.color='black';
  //document.getElementById('tk_addstkSALESPER').style.color='black';
  //document.getElementById('tk_addstkSALESPERNO').style.color='black';
  document.getElementById('tk_addstkARMS_ORD').style.color='black';
  document.getElementById('tk_addstkARMS_JOB').style.color='black';
  document.getElementById('tk_addstknotes').style.color='black';

//not sure why this called the hide screen- commented out
//hidetk_addstk();

//document.getElementById('mtktscreenup').value = "NO"; 
document.getElementById('tkselectMain').style.visibility = "hidden";

}


function populateaddscr() {

  var mindex = document.forms['ticketform'].tkclientadd.selectedIndex;
  var mclntnm = document.forms['ticketform'].tkclientadd.options[mindex].text;
  var mclntID = document.forms['ticketform'].tkclientadd.options[mindex].value;

  //mclntnm=mclntnm.substring(9); 
  document.getElementById('tk_addstkCUSTOMER').value=mclntnm.substring(9);
  document.getElementById('tk_addstkcust_id').value=mclntID;


//alert(mclntnm);


}



function getWeekNr() {
	var today = new Date();
	Year = takeYear(today);
	Month = today.getMonth();
	Day = today.getDate();
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
	//return NumberOfWeek;
	//changed this to match the foxweek not iso week
	//originally used this function and then swtitched to php function and then the below
	return document.getElementById('foxweek').value;
	
	
	
	}

function takeYear(theDate) {
	x = theDate.getYear();
	var y = x % 100;
	y += (y < 38) ? 2000 : 1900;
	return y;
	}

function mod(divisee,base) {
	return Math.round(divisee - (Math.floor(divisee/base)*base));
	}


function closeticket() {

  var today = new Date();
  Year = takeYear(today);
  Month = today.getMonth()+1;
  Day = today.getDate();

myr=String(Year);
myr=trim(myr);
myr=myr.substring(2,4);

mmth=String(Month);
mmth=trim(mmth);
if (mmth.length < 2) {mmth="0"+mmth}; 

mday=String(Day);
mday=trim(mday);
if (mday.length < 2) {mday="0"+mday}; 

//alert(mmth+"/"+mday+"/"+myr);

document.getElementById('tk_stkDATE_DONE').value=mmth+"/"+mday+"/"+myr;
tkmainup();

}



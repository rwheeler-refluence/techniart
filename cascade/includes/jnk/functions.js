function padLeft(_Str,thePad,howLong)
{
    var _temp = ''; thePad=thePad.charAt(0);
    for(var i=0; i< howLong-_Str.length; i++)
	_temp = thePad + _temp;
	return _temp + _Str;
}// example    y =padLeft(x,'|',7) = "||||abc" 
 
function padRight(_Str,thePad,howLong)
{
    var _temp = '';thePad=thePad.charAt(0);
    for(var i=0; i< howLong-_Str.length; i++)
	_temp = thePad + _temp;	
        return _Str + _temp;
}// example    y = padRight(x,'|',5) = "abc||" 
 
function padBoth(_Str,thePad,howLong)
{
    var _temp = '';thePad=thePad.charAt(0);
    for(var i=0; i< howLong-_Str.length; i++)
	_temp = thePad + _temp;	
        var _Str1 = _temp.substring(0,_temp.length/2);
	var _Str2 = _temp.substring(_Str1.length);
	return _Str2 + _Str + _Str1;
} // example   y =padBoth(x,"|",8) = "|||abc||" 


function checkUrl() {
var locvartemp = ( window.location.href.indexOf( "=" ) + 1 ) ? window.location.href.substr( window.location.href.indexOf( "=" ) + 1 ) : "";
document.getElementById('mid').value =locvartemp;
//getCinfo("N","N");

}

function isNumeric(x) {
var RegExp = /^(-)?(\d*)(\.?)(\d*)$/; // allow a decimal & negative 
var result = x.match(RegExp); //1 if number
return result;
}


function isNumericLimit(x,y) {
// this function test for a limit as well
var RegExp = /^(-)?(\d*)(\.?)(\d*)$/; // allow a decimal & negative 
var result = x.match(RegExp); //1 if number

if (result != 0){
 if (x > y){ return 0};
}
return result;

}

function isDateFormat(x) {
if (x.length==0){ return 1}; //empty is ok
if (x.length < 8){ return 0};
x=x.charAt(6)+x.charAt(7)+x.charAt(0)+x.charAt(1)+x.charAt(3)+x.charAt(4);
var RegExp = /^(\d*)$/;  
var result = x.match(RegExp); //1 if number
return result;
}


function removeMChar(input) {

var output = "";

for (var i = 0; i < input.length; i++) {
   if ((input.charCodeAt(i) == 13) && (input.charCodeAt(i + 1) == 10)) {
      i++;
      output += "\n";
   } else {
      output += input.charAt(i);
   }
}

return output;

}

function cleanText(input) {

var output = "";

for (var i = 0; i < input.length; i++) {

   if ((input.charCodeAt(i) > 31) && (input.charCodeAt(i) < 127)) {  
      output += input.charAt(i);
   } else  {
	  i++;
      output += " "; 
   }

}

return output;

}

//String.prototype.fullTrim = function()
//{
//   return this.replace(/\s+/g," ").replace(/^\s*([\s\S]*\S+)\s*$|^\s*$/,"$1");/
//}

function trim(str) {
  if (str != undefined){
     return str.replace(/^\s*|\s*$/g,"");
  }
}

//String.prototype.trim = function() {
//a = this.replace(/^\s+/, '');
//return a.replace(/\s+$/, '');
//};

//next two are for weeknumber
function getWeekNr()
{
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


function takeYear(theDate)
{
	x = theDate.getYear();
	var y = x % 100;
	y += (y < 38) ? 2000 : 1900;
	return y;
}





function tooltip(msg){
//this is not used- would need to be nested as first call then go to layer function
if (msg != "N"){
// we can add a varible pass for left and right
  document.getElementById('tooltip').style.left = "150px";
  document.getElementById('tooltip').style.top = "80px";
  document.getElementById('tooltip').style.width = "400px";
  document.getElementById('tooltip').style.height = "200px";
  document.getElementById('toolmsg').innerHTML=msg;
  showtooltip();
 }
}


function blankchk(midfld,mdesc){

  var mchk=document.getElementById(midfld).value;
  mchk=trim(mchk);
  if (mchk.length > 0) { 
    document.getElementById(midfld).style.color='black';
    merr=0;
  } else {
    document.getElementById(midfld).style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "You cannot leave " + mdesc + " blank.<br>";
    merr=1;
  }

return merr;

}

function checkph(midfld,mdesc){

  var mchk=document.getElementById(midfld).value;
  mchk=trim(mchk);
  if (mchk.length==0 || mchk.length==8) { 
    document.getElementById(midfld).style.color='black';
    merr=0;
  } else {
	    
    document.getElementById(midfld).style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "The " + mdesc + " phone number format is wrong, please use 999-9999.<br>";
    merr=1;
  }

return merr;

}

function checkemail(midfld,mdesc){
  
  var emailchk=document.getElementById(midfld).value;
  emailchk=trim(emailchk);
  if (emailchk.length > 0){

    if ((emailchk.indexOf('@') > -1) && (emailchk.indexOf('.') > -1)){ 
      document.getElementById(midfld).style.color='black';
      merr=0;
    } else { 
      document.getElementById(midfld).style.color='red';
      document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "The " + mdesc + " Format is missing @ and/or '.' , Please use 'EMAILNAME@ISP.COM'.<br>";
      merr=1;
    }

  } else {
     document.getElementById(midfld).style.color='black';
     merr=0;
  } 

return merr;

}

function checkzip(midfld,mdesc){
 var numchk=document.getElementById(midfld).value;
  numchk=trim(numchk);
  if ((isNumeric(numchk)) && ((numchk > 999) || (numchk ==0))){ 
    document.getElementById(midfld).style.color='black';
    merr=0;
  } else {
    document.getElementById(midfld).style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "The " + mdesc + " Format is incorrect. Please use '#####' and make sure it is numeric.<br>";
    merr=1;
  }

return merr;

}


function checkdatefmt(midfld,mdesc){

  tdt=document.getElementById(midfld).value;
  tdt=trim(tdt);
  if (isDateFormat(tdt)) {
       document.getElementById(midfld).style.color='black';
       merr=0;
  } else {
    document.getElementById(midfld).style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "The " + mdesc + " date format incorrect. Please use mm/dd/yy' format.<br>";
    merr=1;
  }

return merr;

}

function checknumberentry(midfld,mdesc,mamtlimit){

var numchk=document.getElementById(midfld).value;
  numchk=trim(numchk);
  if (isNumericLimit(numchk,mamtlimit)) { 
    document.getElementById(midfld).style.color='black';
    merr=0;
  } else { 
    document.getElementById(midfld).style.color='red';
    document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "The " + mdesc + " Format is incorrect or to high. Make sure it is numeric.<br>";
    merr=1;
  }

return merr;

}


function xreplace(string,text,by) {

var strLength = string.length, txtLength = text.length;

if ((strLength == 0) || (txtLength == 0)) {
   return string;
}   

var i = string.indexOf(text);

if ((!i) && (text != string.substring(0,txtLength))) {
   return string;
}

if (i == -1){ 
  return string;
}

var newstr = string.substring(0,i) + by;
if (i+txtLength < strLength){
  newstr += xreplace(string.substring(i+txtLength,strLength),text,by);
  return newstr;
}

}


function zreplace(checkMe,toberep,repwith){

var temp = checkMe;

var i = temp.indexOf(toberep);

while(i > -1)

{

temp = temp.replace(toberep, repwith);

i = temp.indexOf(toberep, i + repwith.length + 1);

}

return temp;

}


function printPage() {

  if (window.print) {
    window.print();
  } else {
      document.body.style.cursor='auto';
      document.getElementById('confirmtext').innerHTML="Sorry, your browser doesn't support this feature."; //Error printing      
      showconfirm();
  } 

}


function printlayer(layer)

{

  var generator=window.open('','name','channelmode = no, directories = no,fullscreen = no ,height = 500,left = 100,location = no,menubar = no,resizable = yes ,scrollbars = yes,status = no,titlebar = yes,toolbar = no,top = 100,width = 500');
  var layertext = document.getElementById(layer);
  generator.document.write(layertext.innerHTML.replace("col1","col5"));
  generator.document.close();
  generator.print();
  generator.close();

}
  

function setCompany(couse,dmess){

  // empty the screen when toggle clicked & dump search id as well

var oldid=document.getElementById('mcustid').value;

  clrFields();
  //does it below on conditional showcust(1);
  shownote(1);
  document.getElementById('mid').value = "Enter ID or all/part of name";
  document.forms['custcareform'].mcust.options.length =0;
  document.forms['custcareform'].mcust.options[0] = new Option("Leave search blank for entire list.",'true');
  unlockall();
  if (couse=="CIS"){
	  
    document.getElementById('defaultcoNM').value="Compact Information Systems";
    
    document.getElementById('CIStoggle').checked = "true";
    document.getElementById('ucoid').value = "CIS";
   
    document.getElementById('ordpdfdir').value="./CISgraphs/";

    document.getElementById('cisradio').style.color='blue';
    document.getElementById('cdsradio').style.color='black';

    document.getElementById('TK_defaultco').style.color='blue';
    document.getElementById('TK_defaultco').innerHTML="&nbsp;&nbsp;Current Data Source: <font size=2>CIS</font>";

    
    document.getElementById('INV_defaultco').style.color='blue';
    document.getElementById('INV_defaultco').innerHTML="<IMG SRC='images/CISLogo.gif' height='39' width='151'>";
   
    
    document.getElementById('PO_defaultco').style.color='blue';
    document.getElementById('PO_defaultco').innerHTML="<IMG SRC='images/CISLogo.gif' height='39' width='151'>";
    
    //getreccnt("CIS",oldid);
    document.getElementById('custtabCIS').style.display="block"; 
    document.getElementById('custtabCDS').style.display="none";
    document.getElementById('cust1').style.display="block"; 
    document.getElementById('cust2').style.display="block"; 
    document.getElementById('cust3').style.display="block"; 
    document.getElementById('cust4').style.display="block"; 
    document.getElementById('cust9').style.display="block"; 
    showcust(1);
    if (dmess !='N'){
       document.getElementById('confirmtext').innerHTML="Data source is now set to CIS.";
       showconfirm();
    }

  } else {
	  
    document.getElementById('defaultcoNM').value="Compact Digital Solutions";
	  
    document.getElementById('CDStoggle').checked = "true";
    document.getElementById('ucoid').value = "CDS";
    document.getElementById('ordpdfdir').value="./CDSgraphs/";

    document.getElementById('cdsradio').style.color='blue';
    document.getElementById('cisradio').style.color='black';

    document.getElementById('TK_defaultco').style.color='blue';
    document.getElementById('TK_defaultco').innerHTML="&nbsp;&nbsp;Current Data Source: <font size=2>CDS</font>";

    document.getElementById('INV_defaultco').style.color='blue';
    document.getElementById('INV_defaultco').innerHTML="<IMG SRC='images/CDSLogo.gif' height='37' width='145'>";
   
    document.getElementById('PO_defaultco').style.color='blue';
    document.getElementById('PO_defaultco').innerHTML="<IMG SRC='images/CDSLogo.gif' height='37' width='145'>";
   
    //getreccnt("CDS",oldid);
    document.getElementById('custtabCDS').style.display="block"; 
    document.getElementById('custtabCIS').style.display="none";
    document.getElementById('cust1').style.display="none"; 
    document.getElementById('cust2').style.display="none"; 
    document.getElementById('cust3').style.display="none"; 
    document.getElementById('cust4').style.display="none"; 
    document.getElementById('cust9').style.display="none"; 
    showcust(5);
    if (dmess !='N'){
       document.getElementById('confirmtext').innerHTML="Data source is now set to CDS.";
       showconfirm();
    }

  }

getarfiletyp();

}

function getmsession() {
 
  var msessionstr="";

  //use these instead of session variables, much easier to pass between JS/PHP/HTML etc... 
  //by passing this string I only have to tack the chance in the DOM then ref it here 

  msessionstr=msessionstr+document.getElementById('lognm').value+"|";
  msessionstr=msessionstr+document.getElementById('upw').value+"|";
  msessionstr=msessionstr+document.getElementById('loglevel').value+"|";
  msessionstr=msessionstr+document.getElementById('udept').value+"|";
  msessionstr=msessionstr+document.getElementById('uname').value+"|";
  msessionstr=msessionstr+document.getElementById('ucoid').value+"|";
  msessionstr=msessionstr+document.getElementById('udomain').value+"|";
  
  // these are the current chart colors
  msessionstr=msessionstr+document.getElementById('chartbg').value+"|";
  msessionstr=msessionstr+document.getElementById('chartshadow').value+"|";
  msessionstr=msessionstr+document.getElementById('chartmargin').value+"|";
  msessionstr=msessionstr+document.getElementById('chartbars').value+"|";
  
  //project emails
  msessionstr=msessionstr+document.getElementById('umanager').value+"|";
  msessionstr=msessionstr+document.getElementById('umanageremail').value+"|";
  msessionstr=msessionstr+document.getElementById('uemail').value;

return msessionstr;

}



function detectKey() {
    if (event.keyCode==13) { alert("Please click the appropriate button or use the tab key.") }
}


function startclock()
{
var thetime=new Date();

var nhours=thetime.getHours();
var nmins=thetime.getMinutes();
var nsecn=thetime.getSeconds();
var nday=thetime.getDay();
var nmonth=thetime.getMonth();
var ntoday=thetime.getDate();
var nyear=thetime.getYear();
var AorP=" ";

if (nhours>=12)
    AorP="P.M.";
else
    AorP="A.M.";

if (nhours>=13)
    nhours-=12;

if (nhours==0)
   nhours=12;

if (nsecn<10)
 nsecn="0"+nsecn;

if (nmins<10)
 nmins="0"+nmins;

if (nday==0)
  nday="Sunday";
if (nday==1)
  nday="Monday";
if (nday==2)
  nday="Tuesday";
if (nday==3)
  nday="Wednesday";
if (nday==4)
  nday="Thursday";
if (nday==5)
  nday="Friday";
if (nday==6)
  nday="Saturday";

nmonth+=1;

if (nyear<=99)
  nyear= "19"+nyear;

if ((nyear>99) && (nyear<2000))
 nyear+=1900;

document.getElementById('clockspot').innerHTML=nhours+": "+nmins+" "+AorP;

// this currently runs every 60 seconds, be careful about running more often
// may cause slow down...

//upgetBCM();


setTimeout('startclock()',60000);

} 



function checkNCOAstatus(){

var testdate=checkDate(document.getElementById('PAFEXP').value);

  if (document.getElementById('ALLOWNCOAbox').checked == true) {

    var mcm="";

    document.getElementById('ncoamessagetext').style.color='red';

    if (document.getElementById('NCOAEMAIL').value ==""){
       mcm=mcm+"<br>** NCOA email is missing **"; 
    }

    if (document.getElementById('PAFNUM').value ==""){
       mcm=mcm+"<br>** NCOA PAF number is missing **"; 
    }


    //check date 
    if (document.getElementById('PAFEXP').value ==""){
       mcm=mcm+"<br>** NCOA expiration date is missing **"; 
    } else if (testdate=="valid30"){
       mcm=mcm+"<br>** NCOA expiration date will expire in less than 30 days **";
    } else if (testdate=="invalid"){ 
       mcm=mcm+"<br>** NCOA expiration date is expired **"; 
    }

    document.getElementById("ncoamessagetext").innerHTML=mcm.substring(4);

  } else {

    document.getElementById('ncoamessagetext').style.color='black';
    document.getElementById("ncoamessagetext").innerHTML=" "; 

  } 

   
}


function checkDate(mdate){

  var tdt=mdate;
  var myDate=new Date();

  var yearstart="19";
  tdt=tdt.replace("/","*");
  tdt=tdt.replace("/","*");
  tdt=tdt.replace("-","*");
  tdt=tdt.replace("-","*");
  var yrtst=tdt.charAt(7)+tdt.charAt(8);
  if (yrtst < 80) {yearstart="20"}; 
  tdt= yearstart+tdt.charAt(6)+tdt.charAt(7)+tdt.charAt(0)+tdt.charAt(1)+tdt.charAt(3)+tdt.charAt(4);
  
  var year1=tdt.charAt(0)+tdt.charAt(1)+tdt.charAt(2)+tdt.charAt(3);
  var month1=tdt.charAt(4)+tdt.charAt(5);
  var day1=tdt.charAt(6)+tdt.charAt(7);

  month1=parseInt(month1)-1;

  myDate.setFullYear(year1,month1,day1);
  var today = new Date();


  if (myDate > today){

    today.setDate(today.getDate()+30);

    if (myDate < today){

      return "valid30";

    } else {

      return "valid";
    }


  } else {

    return "invalid";

  }


}


function checkdate2(midfld,mdesc){

  var mdt=document.getElementById(midfld).value;
  mdt=trim(mdt);
  var mdtlen=mdt.length;

  if (mdtlen < 1){

    merr=0;

  } else {

     var myDate=new Date();
     var yearstart="19";
     mdt=mdt.replace("/","*");
     mdt=mdt.replace("/","*");
     mdt=mdt.replace("-","*");
     mdt=mdt.replace("-","*");
     var yrtst=mdt.charAt(7)+mdt.charAt(8);
     if (yrtst < 80) {yearstart="20"}; 
     mdt= yearstart+mdt.charAt(6)+mdt.charAt(7)+mdt.charAt(0)+mdt.charAt(1)+mdt.charAt(3)+mdt.charAt(4);
  
     var year1=mdt.charAt(0)+mdt.charAt(1)+mdt.charAt(2)+mdt.charAt(3);
     var month1=mdt.charAt(4)+mdt.charAt(5);
     var day1=mdt.charAt(6)+mdt.charAt(7);

     month1=parseInt(month1)-1;

     myDate.setFullYear(year1,month1,day1);
     var today = new Date();

     if (myDate > today){

       today.setDate(today.getDate()+30);

       if (myDate < today){

         document.getElementById(midfld).style.color='black'; 
         merr=0;
 
       } else {

         document.getElementById(midfld).style.color='black';
         merr=0;

       }


     } else {
   
       document.getElementById(midfld).style.color='red';
       document.getElementById('emsg').innerHTML=document.getElementById('emsg').innerHTML + "The " + mdesc + " Date is expired. Please use a future date or blank it out.<br>";
       merr=1;

     }

   } // end of empty check

   return merr;

}


function yesnoanswer() {

   if (document.getElementById('yesnofunction').value=="mclose"){
     document.getElementById('yesnofunction').value="";
     unlockall();
     unlockalltk();
     window.close('appWindow');

   } else if (document.getElementById('yesnofunction').value=="movetk"){
     movetheticket();
     //in tk_get_tickets
     
   } else if (document.getElementById('yesnofunction').value=="voidtk"){
	 hideyesno(); //this really should be at top of this function but no time to test the others right now  
     tkmainup('V');
     //in tk_get_tickets  
   } else {

     alert("no function defined for this screen, please contact administrator.   ");
   }


}


//this is the function for calling the excell window
function cisopen(name, w, h) {

var url="http://www.businesslists.biz?username=cis&password=digdug";
//alert(url);
w += 32;
h += 96;
 var win = window.open(url,
  name, 
  'width=' + w + ', height=' + h + ', ' +
  'location=yes, menubar=yes, ' +
  'status=yes, toolbar=yes, scrollbars=yes, resizable=yes');
 win.resizeTo(w, h);
 win.focus();

}

//this is the function for calling the excell window
function cisopenbiz(name, w, h) {
 
var theid=document.getElementById('mcustid').value;

//var url="http://www.yahoo.com";
var url="http://12.46.52.149/businesslistNEW/login.cfm?id="+theid;
//alert(url);
w += 32;
h += 96;
//var win = window.open(url,name,'width=' + w + ', height=' + h + ', ' + 'location=yes, menubar=yes, ' + 'status=yes, toolbar=yes, scrollbars=yes, resizable=yes');
//win.resizeTo(w, h);
//win.focus();

win = window.open(url, "new", "toolbar=1,scrollbars=yes,status=yes,resizable=yes")




}



//usage
//<a href="page.html" target="popup"
// onClick="wopen('page.html', 'popup', 640, 480); return false;"> Click here to open the page in a new window. 


function resetthefields(){


//this function removes and reloads an element
var p2 = document.getElementById('ADD_primAttn');
p2.parentNode.removeChild(p2); 	
  
  var el = document.createElement("input");
  el.setAttribute("name", "ADD_primAttn");
  el.setAttribute("id", "ADD_primAttn");
  el.setAttribute("type", "text");
  el.setAttribute("value", "Clear");
  el.setAttribute("size", "30");
  el.setAttribute("tabindex", "16");
  el.setAttribute("MAXLENGTH", "16");
  el.setAttribute("class", "inputclass");
  document.getElementById("custcareform").appendChild(el);
  addEvent(el, 'change', function(){ bindName();} );

document.getElementById("testloc").appendChild(el);


var p2 = document.getElementById('ADD_primAdd');
p2.parentNode.removeChild(p2); 	

  
  var el = document.createElement("input");
  el.setAttribute("name", "ADD_primAdd");
  el.setAttribute("id", "ADD_primAdd");
  el.setAttribute("type", "text");
  el.setAttribute("value", "Clear");
  el.setAttribute("size", "30");
  el.setAttribute("tabindex", "16");
  el.setAttribute("MAXLENGTH", "16");
  el.setAttribute("class", "inputclass");
  document.getElementById("custcareform").appendChild(el);
  addEvent(el, 'change', function(){ bindName();} );

document.getElementById("testloc2").appendChild(el);

//el.style.position = "absolute";

//el.style.left = 10;
//el.style.top = 10;

}

function addEvent(elm, strEvent, fnHandler)
{

  return ( elm.addEventListener
  ? elm.addEventListener( strEvent, fnHandler, false)
  : elm.attachEvent( 'on'+strEvent, fnHandler)
  );
}

function saveform(mstart,mfinish) {

   var num_fields = 0; 
   var selindex = 0;
   var selectvalue="";
   var fldname="";
   var fldvalue="";
   var mtype="";
   presave='';

 
   //disable select fields

   document.getElementById('mterms').disabled =true;
   document.getElementById('mcust').disabled = true;
   document.getElementById('tkselect').disabled = true;
   document.getElementById('userselect').disabled = true;
   document.getElementById('filetype').disabled = true;
   document.getElementById('tagformat').disabled = true;
   document.getElementById('ncoaselect').disabled = true;
   document.getElementById('mship').disabled = true;
   document.getElementById('addselect').disabled = true;
   document.getElementById('ADD_MTERMS').disabled = true;
   document.getElementById('ADD_MSHIP').disabled = true;
   document.getElementById('ADD_FILETYPE').disabled = true;
   document.getElementById('ADD_TAGFORMAT').disabled = true;  

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


   if (document.getElementById('mmktscreenup').value == "YES"){
     document.getElementById('bcmselect').disabled =true;
   }


   msave = new Array();

//alert(mstart,mfinish);

   for (var i=0; i < document.forms.custcareform.length; i++) { 

    if ( i >= mstart){
    
      num_fields++;
      mtype=document.forms.custcareform.elements[i].type;
      fldname=document.forms.custcareform.elements[i].id;



      if(mtype == 'radio') { 

         if(document.forms.custcareform.elements[i].checked == true) { 

            fldvalue="Checked";

         } else {
          
            fldvalue="Unchecked";

         }

      } else if (mtype == 'select-one') {

         selindex = document.forms['custcareform'].elements[i].selectedIndex;

         if (selindex > 0){

            fldvalue=String(selindex);

         } else { 
    
            fldvalue="0";
         }

      } else if (mtype == 'checkbox') { 

         if(document.forms.custcareform.elements[i].checked == true) { 

            fldvalue="Checked";

         } else {
          
            fldvalue="Unchecked";

         }

      } else {

        fldvalue=document.forms.custcareform.elements[i].value;

      } 

      //if (trim(mtype) !='' && trim(fldvalue) !='') {




      if (trim(mtype) !=''){   
         presave=mtype+'|'+fldname+'|'+fldvalue+'^';

         //alert(presave+":"+i);

         if (presave.length >=100){
            presave=mtype+'|'+fldname+'|Data block too large to save on refresh.^';
         } 
  
         msave[i]=presave;
     
         presave='';

       } // end of mtype blank chk      


    } //test for mstart

//alert(mfinish);

    // break between chunks
    if (i > mfinish) {
        mstart=mfinish;
        break;
    }

   } // end of loop over custcare

var numarray=msave.length;

saveform2(msave,numarray,mstart);

}


function saveform2Response() {

  if (http.readyState == 4) {

    results = http.responseText;
    
//alert(results);

    var num1=0;
    var num2=0;

    if (results < 380){

      num1= Number(results)+1;
      num2= Number(results)+15;
      saveform(num1,num2);
      
    } else {

hidewait();
document.body.style.cursor='auto';

     var mnumblocks=0;
     //calculate and send first comment block 
     var howlarge=document.getElementById('COMMENTL').value;

     mmaxblocks=(howlarge.length/1000);
     mnumblocks=Math.round(mnumblocks);
     mmaxblocks=Math.round(mmaxblocks);
     mmaxblocks=mmaxblocks+1;
     resetlrgcom(0,mmaxblocks,"L");
     
       // moved the following three lines to comment reset
       //hidewait();
       //document.body.style.cursor='auto';
       //window.location.reload(); 

    }
    

  } //end of ready state

}

function saveform2(msave,numarray,mstart) {

  var expurl = "includes/php/save_form_process.php?msav="; // The server-side script

  // Because passing huge strings is out, the sum total of the form is tucked into a hidden
  // field and then that is stripped out 200 characters at a time and packed off to the sql login database
  // database. When it get to zero the browse reloads.

  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();  
  http.open("GET", expurl + escape(msave) + "&usession=" +escape(usession)+ "&mstart=" +escape(mstart), true);
  http.onreadystatechange = saveform2Response;
  http.send(null);

}

function restoreformResponse() {

  if (http.readyState == 4) {

   var numrestoreblock=0;
//var jnk= http.responseText;
//alert(jnk); 

   // Split the delimited response into an array
   results = http.responseText.split("^");



   r1= new Array();
    
   for (x in results)
   {
     
     //alert(results[x]); 
     r1 = results[x].split("|");

     //alert(results[x]+":"+x); 

     if (x==0){
         numrestoreblock=r1[0];
     } else {
 

        if (r1[1] != undefined)
        {
            //alert(r1[1]); 
            if (r1[0]=='hidden') {document.getElementById(r1[1]).value =r1[2]};
            if (r1[0]=='text' || r1[0]=='textarea') {document.getElementById(r1[1]).value =r1[2]};
            if (r1[0]=='checkbox' || r1[0]=='radio') {
              if (r1[2]=='Checked'){
                 document.getElementById(r1[1]).checked = true;
              } else {
                 document.getElementById(r1[1]).checked = false;
              } 
            }
       
            if (r1[0]=='select-one') {document.getElementById(r1[1]).selectedIndex=r1[2]};

        }  //end of undefined

      } //end of x condition

   } // end of for loop


    if (numrestoreblock < 4){

      if (numrestoreblock==1){
        //alert("Restoring block number: "+numrestoreblock);
        restorethisform(2);
      } else if (numrestoreblock==2){  
        //alert("Restoring block number: "+numrestoreblock);
        restorethisform(3);
      } else if (numrestoreblock==3){  
        //alert("Restoring block number: "+numrestoreblock);
        restorethisform(4);
      }

    

    }  else {


       if (document.getElementById("EditEnabled").value=="Y"){

          //alert("edit enabled");
          getCinfo('Y','Y');
          setEditYes();	

       } else {

          if (document.getElementById("mcustid").value !=""){
             //setEditNo();
             getCinfo('N','N');
             setEditNo();
          }

       }
    
       if (document.getElementById("maddscreenup").value=="YES"){
          resetaddscrRead();
          showaddnote(1);
          showaddacct("N");
       } 
     
     hidewait();
     document.body.style.cursor='auto';
 
   } //end of numrestoreblock

  } // end of readystate

}

function restorethisform(numblock) {

  //alert("restorethisform clicked");
  var expurl = "includes/php/restore_form_process.php?mjnk="; // The server-side script
  var mjnk="";
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();  
  http.open("GET", expurl + escape(mjnk) + "&usession=" +escape(usession) + "&fieldblock=" +escape(numblock), true);
  http.onreadystatechange = restoreformResponse;
  http.send(null);

}


//this is the function for calling label
function prnFile(name, w, h,dnm) {

//could stick these in an array-split out for testing and left it
mvarstr1 = document.getElementById('company').value;
mvarstr1=mvarstr1.replace(/\,/g," ");
mvarstr1=mvarstr1.replace(/\#/g," ");

mvarstr2 = document.getElementById('add1').value;
mvarstr2=mvarstr2.replace(/\,/g," ");
mvarstr2=mvarstr2.replace(/\#/g," ");

mvarstr3 = document.getElementById('CITY').value;
mvarstr3=mvarstr3.replace(/\,/g," ");
mvarstr3=mvarstr3.replace(/\#/g," ");

mvarstr4 = document.getElementById('ST').value;
mvarstr4=mvarstr4.replace(/\,/g," ");
mvarstr4=mvarstr4.replace(/\#/g," ");

mvarstr5 = document.getElementById('ZIP').value;
mvarstr5=mvarstr5.replace(/\,/g," ");
mvarstr5=mvarstr5.replace(/\#/g," ");

mvarstr6 = document.getElementById('ZIP4').value;
mvarstr6=mvarstr6.replace(/\,/g," ");
mvarstr6=mvarstr6.replace(/\#/g," ");

mvarstr7 = document.getElementById('CONTACTL1').value;
mvarstr7=mvarstr7.replace(/\,/g," ");
mvarstr7=mvarstr7.replace(/\#/g," ");

//alert(mvarstr1+mvarstr2+mvarstr3+mvarstr4+mvarstr5+mvarstr6+mvarstr7);  

if (document.getElementById('ucoid').value =="CIS"){
   mvarstr8="Y";
} else {
   mvarstr8="N";
} 

url = "includes/php/cc_label_process.php?mln1="+mvarstr1+"&mln2="+mvarstr2+"&mln3="+mvarstr3+"&mln4="+mvarstr4+"&mln5="+mvarstr5+"&mln6="+mvarstr6+"&mln7="+mvarstr7+"&mln8="+mvarstr8; 
w += 12;
h += 140;
//alert("got here");
 var win = window.open(url,
  name, 
  'width=' + w + ', height=' + h + ', ' +
  'location=no, menubar=no, ' +
  'status=no, toolbar=no, scrollbars=no, resizable=yes');
 win.resizeTo(w,h);
 win.focus();

}


function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;

 
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
   
   }

function testfunction(){
  alert("this is a test");
}	

function nonauth(){

   showwait();
   document.getElementById('genericmsgscr').style.top='150px';
   document.getElementById('genericmsgscr').style.left='260px'; 
   document.getElementById('genericmsgscr').style.height='160px'; 
   document.getElementById('genericmsgscr').style.width='520px';
   document.getElementById('genericmsgtext').innerHTML="You need special authorization to use this option, please see administrator."; 
   showgenericmsg(); 
       
}  

function pause(numberMillis) { 
	var now = new Date(); 
	var exitTime = now.getTime() + numberMillis;  
	while (true) {   
  	  now = new Date();   
	  if (now.getTime() > exitTime){ 
	    return;   
	  }
    }    
}


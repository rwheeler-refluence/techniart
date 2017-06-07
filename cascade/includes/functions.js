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


function trim(str) {
  if (str != undefined){
     return str.replace(/^\s*|\s*$/g,"");
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



function setCookie(cname,cvalue,exdays){

	 var d = new Date();
     d.setTime(d.getTime()+(exdays*24*60*60*1000));
     var expires = "expires="+d.toGMTString();
     document.cookie = cname + "=" + cvalue + "; " + expires;
}   			  

function getCookie(cname)
 {
 var name = cname + "=";
 var ca = document.cookie.split(';');
 for(var i=0; i<ca.length; i++) 
   {
   var c = ca[i].trim();
   if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
 return "";
 } 

function eraseCookie(name) {
	//alert('in');
    setCookie(name,"",-1);
    return;
}
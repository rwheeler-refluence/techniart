 
// the next three are for the customer search browse 

// this waits fires server side php page

function getPickList() {
var murl = "includes/php/cc_cust_lookup_process.php?mname="; // The server-side script  

 var mlentest=document.getElementById("mid").value;
 if (mlentest.length !=0) {
   document.body.style.cursor = "wait";
   showwait();
   var previd=document.getElementById('mcustid').value;  
   var nmValue = document.getElementById("mid").value;
   var usession = getmsession();
   http.open("GET", murl + escape(nmValue) + "&pid=" + escape(previd)+ "&usession=" +escape(usession), true);   
   http.onreadystatechange = getPickListResponce;
   http.send(null);
 
  } else {
 
    document.getElementById('confirmtext').innerHTML="You need to enter at least one letter of the name.";
    showconfirm();

  }


}


function getPickListCont() {
var murl = "includes/php/cc_cust_Contlookup_process.php?mname="; // The server-side script  
var mlentest=document.getElementById("mid").value;

  if (mlentest.length !=0) {
    document.body.style.cursor = "wait";
    showwait();
    var previd=document.getElementById('mcustid').value;  
    var nmValue = document.getElementById("mid").value;
    var usession = getmsession();
    http.open("GET", murl + escape(nmValue) + "&pid=" + escape(previd)+ "&usession=" +escape(usession), true);   
    http.onreadystatechange = getPickListContResponce;
    http.send(null);
  } else {
 
    document.getElementById('confirmtext').innerHTML="You need to enter at least one letter of the name.";
    showconfirm();

  }

}




// this handles the responce from the server side php page and loads the customer list
function getPickListResponce() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    //alert(http.responseText);
    
    r1= new Array();
    document.forms['custcareform'].mcust.options.length = 0;
    //document.forms['custcareform'].mcust.options[0] = new Option("Pick Customer From List.",'true');
    xi=0;         

     for (x in results)
    {
       
    
    r1 = results[x].split("|");
    
      if (typeof r1[0] != "undefined")
      { 
         if (xi==0){
	       if (typeof r1[1] != "undefined"){r1[1]=r1[1].replace(/\zpos/g,"\'")};   
           document.forms['custcareform'].mcust.options[0] = new Option("Click Here To Pick Customer.",'true');
           document.forms['custcareform'].mcust.options[1] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+2
         } else { 
	       if (typeof r1[1] != "undefined"){r1[1]=r1[1].replace(/\zpos/g,"\'")};   
           document.forms['custcareform'].mcust.options[xi] = new Option(r1[0]+' - '+r1[1],r1[0],'true');
           xi=xi+1
         }
      }  
    
    }

      if (document.forms['custcareform'].mcust.options.length == 0)
       {
          document.forms['custcareform'].mcust.options[0] = new Option("No Customers Found.",'true');
       }

clrFields();
hidewait();
document.body.style.cursor='auto';

if (document.forms['custcareform'].mcust.options.length > 3){
  document.getElementById('mcust').style.width='300px'; 
} else {
  document.getElementById('mcust').style.width='286px'; 
}	
    if (document.forms['custcareform'].mcust.options.length == 3){
      document.forms['custcareform'].mcust.selectedIndex=1;
      //alert(document.forms['custcareform'].mcust.options[1].text.substring(0,6));  
      setID();
    }



  }
}

// this sets the user selected customer from the select into the document object/input and fires the server 
// side function to retrieve the individual record
function setID() {

//put the format back like it was b4 changing it foe the picklist per chris	  
document.getElementById('mcust').style.width='286px'; 	
	
  var i = document.forms['custcareform'].mcust.selectedIndex;
  //document.getElementById('mid').value =document.forms['custcareform'].mcust.options[i].text.substring(0,6);
  document.getElementById('mid').value =document.forms['custcareform'].mcust.options[i].value;

  //showcust(1);
  if (document.getElementById('ucoid').value=="CIS"){
    showcust(1);
  } else {
	showcust(5);  
  }	 
  
  hidesuser();
  hidesadd();
  hidestk();
  hidesncoa();
  getCinfo("N","N");
 
}
// end of functions to deal with search picklist




// this handles the responce from the server side php page and loads the customer list
function getPickListContResponce() {
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    
    //alert(http.responseText);
    r1= new Array();
    document.forms['custcareform'].mcust.options.length = 0;
    //document.forms['custcareform'].mcust.options[0] = new Option("Pick Customer From List.",'true');
    xi=0;         
    var dupcheckA="";
    var dupcheckB="";
     for (x in results)
    {
       
      r1 = results[x].split("|");

      
      if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',25)};
      if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',20)};
      
      dupcheckA=r1[2]+': '+r1[1];
      dupcheckA=dupcheckA.toUpperCase(); 
      if (dupcheckA!=dupcheckB)
      {
         if (typeof r1[2] != "undefined")
         {
         
           if (xi==0){
             document.forms['custcareform'].mcust.options[0] = new Option("Click Here To Pick Customer.",'true');
             
             document.forms['custcareform'].mcust.options[1] = new Option(r1[2]+': '+r1[1],r1[0],'true');
             xi=xi+2
           } else { 
             document.forms['custcareform'].mcust.options[xi]= new Option(r1[2]+': '+r1[1],r1[0],'true');
             xi=xi+1
           }

         } 

      }
      dupcheckB=r1[2]+': '+r1[1];    
      dupcheckB=dupcheckB.toUpperCase();
    

    }




      if (document.forms['custcareform'].mcust.options.length == 0)
       {
          document.forms['custcareform'].mcust.options[xi] = new Option("No Customers Found.",'true');
       }


clrFields();
hidewait();
document.body.style.cursor='auto';
//reset this in case it was change during a client pull
document.getElementById('mcust').style.width='286px'; 

    if (document.forms['custcareform'].mcust.options.length == 3){
      document.forms['custcareform'].mcust.selectedIndex=1;
      //alert(document.forms['custcareform'].mcust.options[1].text.substring(0,6));  
      setID();
    }

  }
}
//function for getting customer users

function getAddResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].addselect.options.length = 0;

    var numrecs= -1;
 
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {

       // pad out the elements if individual elements with 1 extra spaces to make display better
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',5)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',5)};
       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',7)};
       if (r1[3] != undefined){r1[3] = padRight(r1[3],' ',37)};
       if (r1[4] != undefined){r1[4] = padRight(r1[4],' ',22)};
       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',4)};
       if (r1[6] != undefined){r1[6] = padRight(r1[6],' ',30)};
     
        //for some reason I had shipping records blocked
        //if (trim(r1[0]) !="S") {
         numrecs=numrecs+1;
         document.forms['custcareform'].addselect.options[numrecs] = new Option(r1[0]+r1[1]+r1[2]+r1[3]+r1[4]+r1[5]+r1[6],r1[7],true,false);
        //}     

      }  //undefined

    } //for

    if (document.forms['custcareform'].addselect.options.length == 0) {
     document.forms['custcareform'].addselect.options[x] = new Option("No addresses defined for customer.",'true');
    }

hidewait();

 //hide add button if edit readonly
  if (document.getElementById('EditEnabled').value=="N") {
    document.getElementById('contactadd').style.visibility = "hidden";  
  } else {
    document.getElementById('contactadd').style.visibility = "visible";
  }


document.body.style.cursor='auto';

  } //4
}

function getAdd(){
  var addurl = "includes/php/cc_get_add_process.php?mid="; // The server-side script
  var mrecord = "";
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = document.getElementById("mcustid").value;

  var usession = getmsession();
  http.open("GET", addurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getAddResponse;
  http.send(null);
}

function getSingleAdd() {

if (document.forms['custcareform'].addselect.options[0].text != "No addresses defined for customer.") {

  var userurl = "includes/php/cc_get_singleadd_process.php?mid="; // The server-side script
  var mindex = document.forms['custcareform'].addselect.selectedIndex;
  document.body.style.cursor = "wait";
  showwait();  
  var midValue = document.forms['custcareform'].addselect.options[mindex].value;

  var usession = getmsession();
  http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getSingleAddResponse;
  http.send(null);

  } else {
 
    document.getElementById('confirmtext').innerHTML=document.forms['custcareform'].addselect.options[0].text;
    showconfirm();

  }

}



function getSingleAddResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();

    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       document.getElementById('acid').value = r1[0];       //CUST_ID
       document.getElementById('aattn').value = r1[1];      //ATTN
       document.getElementById('aconm').value = r1[2];      //COMPANY
       document.getElementById('aadd1').value = r1[3];      //ADD1
       document.getElementById('acity').value = r1[4];      //CITY
       document.getElementById('ast').value = r1[5];        //ST
       document.getElementById('azip').value = r1[6];       //ZIP
       document.getElementById('aemail').value = r1[7];     //EMAIL
       document.getElementById('aldd').value = r1[8];       //LDD
       document.getElementById('aacl').value = r1[9];       //ACL  
       document.getElementById('anum').value = r1[10];      //NUMBERL
       document.getElementById('aext').value = r1[11];      //EXTL
       document.getElementById('afldd').value = r1[12];     //F_LDD
       document.getElementById('afacl').value = r1[13];     //F_ACL
       document.getElementById('afnum').value = r1[14];     //NUMBERF
       
    //document.getElementById('arec').value = r1[15];      //REC_TYPE
    var mz = document.forms['custcareform'].arec.options.length;
	mz=mz-1;
	if (r1[15].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].arec.options.length; i++) 
	 {
		 
		if (trim(document.forms['custcareform'].arec.options[i].value)==trim(r1[15]))
	    {
	      document.forms['custcareform'].arec.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].arec.options[mz].selected = true};
	//alert(r1[15]);
	if (r1[15].substring(0,1) ==" ") {document.forms['custcareform'].arec.options[mz].selected = true};
	
    //document.getElementById('aloc').value = r1[16];      //LOC_TYPE
    var mz = document.forms['custcareform'].aloc.options.length;
	mz=mz-1;
	if (r1[16].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].aloc.options.length; i++) 
	 {
		 
		if (trim(document.forms['custcareform'].aloc.options[i].value)==trim(r1[16]))
	    {
	      document.forms['custcareform'].aloc.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].aloc.options[mz].selected = true};
	//alert(r1[16]);
	if (r1[16].substring(0,1) ==" ") {document.forms['custcareform'].aloc.options[mz].selected = true};
	
    //document.getElementById('adept').value = r1[17];     //DEPT
    var mz = document.forms['custcareform'].adept.options.length;
	mz=mz-1;
	if (r1[17].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].adept.options.length; i++) 
	 {
		 
		if (trim(document.forms['custcareform'].adept.options[i].value)==trim(r1[17]))
	    {
	      document.forms['custcareform'].adept.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].adept.options[mz].selected = true};
	//alert(r1[17]);
	if (r1[17].substring(0,1) ==" ") {document.forms['custcareform'].adept.options[mz].selected = true};
	 
    
    
      
       // 18 is Y/N for primary mailing/contact record
       if (r1[18].substring(0,6) !="Object") {
         if (r1[18].substring(0,1) == 'Y') {
           document.getElementById("aprimbox").checked = true;
         } else {document.getElementById('aprimbox').checked = false};

       } else {document.getElementById('aprimbox').checked = false};

       document.getElementById('azip4').value = r1[19];
       document.getElementById('auid').value = r1[20];      //USERID

       if (r1[21] == r1[20]) {
          document.getElementById('logonmsg').innerHTML = "Logon Set";
          document.getElementById('logonmsg').style.visibility = "visible";
          document.getElementById('adduserbt').style.visibility = "hidden";
       } else {
          document.getElementById('logonmsg').innerHTML = "No Logon";
    
          //only show add user button if editenabled set to Y
          if (document.getElementById('EditEnabled').value=="Y") {
            document.getElementById('logonmsg').style.visibility = "hidden";
            document.getElementById('adduserbt').style.visibility = "visible";
          } 
 
       }
  

      }  

    }
 
hidewait();
document.body.style.cursor='auto';

 //hide all edit buttons based on if is edit
  if (document.getElementById('EditEnabled').value=="N") {
    document.getElementById('contactupdate').style.visibility = "hidden";
    document.getElementById('contactdelete').style.visibility = "hidden";
    //document.getElementById('adduserbt').style.visibility = "hidden";
  } else {
    document.getElementById('contactupdate').style.visibility = "visible";
    document.getElementById('contactdelete').style.visibility = "visible";
    //document.getElementById('adduserbt').style.visibility = "visible";

  }

showsadd();

  }
}


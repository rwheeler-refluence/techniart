//function for saving very large comments to login for reload
//- they have to be chunked in in 1kb blocks so I get a 
//loop going throught the http object and keep chunking until they are all saved. 
//
//The whole point here is to chunk one in and then pass to the next. if you need to add another comment
//block, simply add to elseif and change the confirm to the end (top condition).

 function resetlrgcomResponse() {

  if (http.readyState == 4) {

var testresult=http.responseText;

//on some the last comes back empty - need to research- very busy right now, it does work
if (trim(testresult)==''){

   hidewait();
   document.body.style.cursor='auto';
   window.location.reload(); 

} else {

     var mmaxblocks=0;
     var mnumblocks=0;
     var mmaxblocks=0;
     var tempstr="";

     results = http.responseText.split("~");


	//alert(results[0]+" | "+results[1]+" | "+results[2]);
	
	if (trim(results[3])=='undefined'){
	
	//alert("inside undefined condition");

	     // if it is the last block of the three comment sections
	     if (results[2]=="A"){ 
	        //alert("in mexit");
	        hidewait();
	        document.body.style.cursor='auto';
	
	        window.location.reload(); 
	        
	     } else if (results[2]=="L"){
	        //alert("in list");     
	        tempstr=trim(document.getElementById('COMMENTD').value);
	        tempstr=xreplace(tempstr,"\n","linefeed");
	
	         //calculate and send first comment block for data processing 
	         mmaxblocks=(tempstr.length/1000);
	         mnumblocks=Math.round(mnumblocks);
	         mmaxblocks=Math.round(mmaxblocks);
	         mmaxblocks=mmaxblocks+1;
	         resetlrgcom(0,mmaxblocks,"D");
	     
	     } else {
	
	        //alert("in acct");    
	        tempstr=trim(document.getElementById('COMMENTA').value);
	        tempstr=xreplace(tempstr,"\n","linefeed");
	
	         //calculate and send first comment block for data processing 
	         mmaxblocks=(tempstr.length/1000);
	         mnumblocks=Math.round(mnumblocks);
	         mmaxblocks=Math.round(mmaxblocks);
	         mmaxblocks=mmaxblocks+1;
	         resetlrgcom(0,mmaxblocks,"A");
	
	     }
	
	} else {
	
	   //alert("just b4 save next block");
	   resetlrgcom(results[0],results[1],results[2]); 
	
	}
	  
  } //close test for undefined php return

  } // http responce close

} //function close


function resetlrgcom(znumblocks,zmaxblocks,zcommtype) {


 var updateurl = "includes/php/cc_reset_lrg_coms.php?mform="; // The server-side script
 
 var mblocktype=zcommtype;
 var mnumblocks=znumblocks;
 var mmaxblocks=zmaxblocks;
 var mcommid=document.getElementById('mcustid').value;
 var mtextfield="COMMENT"+mblocktype;

 var holdstr=trim(document.getElementById(mtextfield).value);
 holdstr=xreplace(holdstr,"\n","linefeed");

     var firstchar=0;
     var lastchar=1000;

     if (mmaxblocks < 1){mmaxblocks = 1};

     var s= new Array(mmaxblocks); 
     var y=0; 
     for (y=0; y<mmaxblocks; y++) 
     { 
       s[y]=holdstr.substring(firstchar,lastchar);
       firstchar=(firstchar+1000);
       lastchar=(lastchar+1000);
     } 

     for(myKey in s)
      if(s.propertyIsEnumerable(myKey)) {
       s[myKey]=s[myKey].replace(/\,/g,"`");
       s[myKey]=s[myKey].replace(/\^/g,"");
       s[myKey]=s[myKey].replace(/\|/g,"");
       s[myKey]=s[myKey].replace(/\&/g,"and"); 
     }

       document.body.style.cursor = "wait";
       showwait();

       var usession = getmsession();
       http.open("GET", updateurl + s[mnumblocks] + "&blocktype=" +escape(mblocktype)+ "&numblocks=" +escape(mnumblocks)+ "&maxblocks=" +escape(mmaxblocks)+ "&commid=" +escape(mcommid)+ "&usession=" +escape(usession), true);
       http.onreadystatechange = resetlrgcomResponse;
       http.send(null);
     

}

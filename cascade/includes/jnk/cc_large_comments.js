//function for saving very large comments- they have to be chunked in in 1kb blocks so I get a 
//loop going throught the http object and keep chunking until they are all saved. 
//
//The whole point here is to chunk one in and then pass to the next. if you need to add another comment
//block, simply add to elseif and change the confirm to the end (top condition).

 function savelrgcomResponse() {

  if (http.readyState == 4) {
     var mmaxblocks=0;
     var mnumblocks=0;
     var mmaxblocks=0;
     var tempstr="";

//alert(http.responseText);

     results = http.responseText.split("~");



if (results[3]=='undefined' || results[0]==results[1]){

     // if it is the last block of the three comment sections
     if (results[2]=="D"){ //changed this from A to D and commented out } else { below 

        hidewait();
        document.body.style.cursor='auto';

        //PER RANDY- NO CONFIRM ON SAVE  
        document.getElementById('confirmtext').innerHTML="Customer Info on main tabs saved.";
        removelock(document.getElementById('mcustid').value);
        getCinfo("N");
        showconfirm();
        
     //} else if (results[2]=="L"){
     } else { //take this out and uncomment above        
        tempstr=trim(document.getElementById('COMMENTD').value);
        tempstr=xreplace(tempstr,"\n","linefeed");

         //calculate and send first comment block for data processing 
         mmaxblocks=(tempstr.length/100);
         mnumblocks=Math.round(mnumblocks);
         mmaxblocks=Math.round(mmaxblocks);
         mmaxblocks=mmaxblocks+1;
         savelrgcom(0,mmaxblocks,"D");
     
     } //else {
             
        //tempstr=trim(document.getElementById('COMMENTA').value);
        //tempstr=xreplace(tempstr,"\n","linefeed");

         //calculate and send first comment block for data processing 
         //mmaxblocks=(tempstr.length/100);
         //mnumblocks=Math.round(mnumblocks);
         //mmaxblocks=Math.round(mmaxblocks);
         //mmaxblocks=mmaxblocks+1;
         //savelrgcom(0,mmaxblocks,"A");

     //}

} else {

   //results[3]=trim(results[3]);
   if(trim(http.responseText)!=""){ // && results[3].length > 2){
     savelrgcom(results[0],results[1],results[2]); 
   } else {
	
        hidewait();
        document.body.style.cursor='auto';

        //PER RANDY- NO CONFIRM ON SAVE  
        document.getElementById('confirmtext').innerHTML="Customer Info on main tabs saved.";
        removelock(document.getElementById('mcustid').value);
        getCinfo("N");
        showconfirm();
        
     
   }	   
}
//} //end of trap for exception
  } // http responce close

} //function close


function savelrgcom(znumblocks,zmaxblocks,zcommtype) {
//alert("inside save commends");
 var updateurl = "includes/php/cc_update_lrg_coms.php?mform="; // The server-side script
 
 var mblocktype=zcommtype;
 var mnumblocks=znumblocks;
 var mmaxblocks=zmaxblocks;
 var mcommid=document.getElementById('mcustid').value;
 var mtextfield="COMMENT"+trim(mblocktype);

 var whichblock=mmaxblocks-(mmaxblocks-mnumblocks);
 var firstchar=(whichblock*100);
 var lastchar=firstchar+100;
// alert("before");
 //document.getElementById(mtextfield).value=xreplace(document.getElementById(mtextfield).value,"\n","linefeed");
 var holdstr=document.getElementById(mtextfield).value.substring(firstchar,lastchar);
// alert("after");
 holdstr=holdstr.replace(/\n/g,"linefeed");
 holdstr=holdstr.replace(/\'/g,"zpos");
 holdstr=holdstr.replace(/\"/g,"zdblq");
 holdstr=holdstr.replace(/\,/g,"`");
 holdstr=holdstr.replace(/\^/g,"");
 holdstr=holdstr.replace(/\|/g,"");
 holdstr=holdstr.replace(/\&/g,"and");  
 
// alert(holdstr);

       document.body.style.cursor = "wait";
       showwait();

       var usession = getmsession();
       http.open("GET", updateurl + holdstr + "&blocktype=" +escape(mblocktype)+ "&numblocks=" +escape(mnumblocks)+ "&maxblocks=" +escape(mmaxblocks)+ "&commid=" +escape(mcommid)+ "&usession=" +escape(usession), true);
       http.onreadystatechange = savelrgcomResponse;
       http.send(null);
     

}

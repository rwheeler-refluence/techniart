//function for territory manager
 
function gettm() {

  var tkurl = "includes/php/cc_get_tm_process_fox.php?mid="; // The server-side script
  var mrecord = "";
  var midValue = document.getElementById("mcustid").value;
  
  if (trim(midValue) !="") {

  document.body.style.cursor = "wait";
  showwait();  
  var usession = getmsession();
  http.open("GET", tkurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = gettmResponse;
  http.send(null);

  } else {
 
    document.getElementById('confirmtext').innerHTML="No customer currently selected.";
    showconfirm();

  }

}



function gettmResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    //alert(http.responseText);
    results = http.responseText.split("^");

    r1= new Array();
  
    for (x in results)
    {
     
     r1 = results[x].split("|");
  
      if (r1[1] != undefined)
      {
     
         document.getElementById('TM_VPID').value=r1[0];         //  VPID        Character   6
         document.getElementById('TM_COMPANY').value=r1[1];      //  COMPANY     Character  40
         document.getElementById('TM_RESDN_TAG').value=r1[2];    //  RESDN_TAG   Character  30
         document.getElementById('TM_BUSN_TAG').value=r1[3];     //  BUSN_TAG    Character  30
         document.getElementById('TM_BOX_TAG').value=r1[4];      //  BOX_TAG     Character  30
         document.getElementById('TM_PRN_LINES').value=r1[5];    //  PRN_LINES   Numeric     2
         document.getElementById('TM_BILL_TO').value=r1[6];      //  BILL_TO     Character  40
         document.getElementById('TM_MULTI_USE').value=r1[7];    //  MULTI_USE   Character   1
         document.getElementById('TM_EW').value=r1[8];           //  EW          Character   1
         document.getElementById('TM_MAP_VIEWER').value=r1[9];   //  MAP_VIEWER  Character   1
         document.getElementById('TM_VP').value="Y" //r1[10];          //  VP          Character   1
         document.getElementById('TM_SELECT_NTA').value=r1[11];  //  SELECT_NTA  Character   1
         document.getElementById('TM_SHIP_TYPE').value=r1[12];   //  SHIP_TYPE   Character  12

         if (r1[12].substring(0,3)=="FTP"){

           document.getElementById('TM_SHIP1FTP').value=r1[13];   //  SHIPPING1   Character  30
           document.getElementById('TM_SHIP2FTP').value=r1[14];   //  SHIPPING2   Character  30
           document.getElementById('TM_SHIP3FTP').value=r1[15];   //  SHIPPING3   Character  30
           document.getElementById('TM_SHIP4FTP').value=r1[16];   //  SHIPPING4   Character  30
           document.getElementById('TM_SHIP1BBS').value="Send File to BBS";   //  SHIPPING1   Character  30
           document.getElementById('TM_SHIP2BBS').value="";   //  SHIPPING2   Character  30
           document.getElementById('TM_SHIP3BBS').value="";   //  SHIPPING3   Character  30
           document.getElementById('TM_SHIP4BBS').value="";   //  SHIPPING4   Character  30

         } else {

           document.getElementById('TM_SHIP1FTP').value="Send File to FTP";   //  SHIPPING1   Character  30
           document.getElementById('TM_SHIP2FTP').value="";   //  SHIPPING2   Character  30
           document.getElementById('TM_SHIP3FTP').value="";   //  SHIPPING3   Character  30
           document.getElementById('TM_SHIP4FTP').value="";   //  SHIPPING4   Character  30
           document.getElementById('TM_SHIP1BBS').value=r1[13];   //  SHIPPING1   Character  30
           document.getElementById('TM_SHIP2BBS').value=r1[14];   //  SHIPPING2   Character  30
           document.getElementById('TM_SHIP3BBS').value=r1[15];   //  SHIPPING3   Character  30
           document.getElementById('TM_SHIP4BBS').value=r1[16];   //  SHIPPING4   Character  30

         }


         document.getElementById('TM_LABELS').value=r1[17];      //  LABELS      Character  20
         //document.getElementById('TM_LABEL_BARbox').value=r1[18];   //  LABEL_BAR   Character   1
         document.getElementById('TM_DATAFILE').value=r1[19];    //  DATAFILE    Character  22
         document.getElementById('TM_OUTPUT').value=r1[20];      //  OUTPUT      Character  20
         //document.getElementById('TM_REV_WALKbox').value=r1[21];    //  REV_WALK    Character   1
         document.getElementById('TM_SEASONAL').value=r1[22];    //  SEASONAL    Character   1
         document.getElementById('TM_SEASONBUTN').value=r1[23];  //  SEASONBUTN  Character   1
         document.getElementById('TM_PAPERWORK').value=r1[24];   //  PAPERWORK   Character   1
         document.getElementById('TM_PAPEREMAIL').value=r1[25];  //  PAPEREMAIL  Character  40
         document.getElementById('TM_DROP_GATE').value=r1[26];   //  DROP_GATE   Character   1
         document.getElementById('TM_USE_POP').value=r1[27];     //  USE_POP     Character   1

       //alert(r1[13].substring(0,8));  
      if (trim(r1[12])==''){document.forms['custcareform'].tmshipselect.selectedIndex=0};
      if (r1[12].substring(0,3)=='Non'){document.forms['custcareform'].tmshipselect.selectedIndex=0};
      if (r1[12].substring(0,3)=='Shi'){document.forms['custcareform'].tmshipselect.selectedIndex=1};
      if (r1[12].substring(0,3)=='Wil'){document.forms['custcareform'].tmshipselect.selectedIndex=2};
      if (r1[12].substring(0,3)=='E-M'){document.forms['custcareform'].tmshipselect.selectedIndex=3};
      if (r1[13].substring(0,4)=='Send'){document.forms['custcareform'].tmshipselect.selectedIndex=4};
      if (r1[13].substring(0,7)=='BBS - S'){document.forms['custcareform'].tmshipselect.selectedIndex=5};
      if (r1[13].substring(0,8)=='Get file'){document.forms['custcareform'].tmshipselect.selectedIndex=6};
      if (r1[13].substring(0,9)=='Send file'){document.forms['custcareform'].tmshipselect.selectedIndex=7};
      if (r1[12].substring(0,3)=='CIS'){document.forms['custcareform'].tmshipselect.selectedIndex=8};


      if (trim(r1[20].toUpperCase())=="E-MAIL/BBS/FTP"){
 
         document.forms['custcareform'].tmoutputselect.options.length = 0;
         document.forms['custcareform'].tmoutputselect.options[0] = new Option("E-Mail/BBS/FTP","0",true,false);
         document.forms['custcareform'].tmoutputselect.selectedIndex=0;

      } else { 
     
         document.forms['custcareform'].tmoutputselect.options.length = 0;

         document.forms['custcareform'].tmoutputselect.options[0] = new Option("None Selected","1",true,false);
         document.forms['custcareform'].tmoutputselect.options[1] = new Option("3 1/2 Diskette","1",true,false);
         document.forms['custcareform'].tmoutputselect.options[2] = new Option("ZIP Disk", "2",true,false);
         document.forms['custcareform'].tmoutputselect.options[3] = new Option("ASCII 1600 BPI Tape","3",true,false);
         document.forms['custcareform'].tmoutputselect.options[4] = new Option("ASCII 6250 BPI Tape","4",true,false);
         document.forms['custcareform'].tmoutputselect.options[5] = new Option("EBCDIC 1600 BPI Tape","1",true,false);
         document.forms['custcareform'].tmoutputselect.options[6] = new Option("EBCDIC 6250 BPI Tape","1",true,false);
         if (trim(r1[20].toUpperCase())=="3 1/2 Diskette"){
            document.forms['custcareform'].tmoutputselect.selectedIndex=1;
         } else if (trim(r1[20].toUpperCase())=="ZIP Disk"){
            document.forms['custcareform'].tmoutputselect.selectedIndex=2;
         } else if (trim(r1[20].toUpperCase())=="ASCII 1600 BPI Tape"){
            document.forms['custcareform'].tmoutputselect.selectedIndex=3;
         } else if (trim(r1[20].toUpperCase())=="ASCII 6250 BPI Tape"){
            document.forms['custcareform'].tmoutputselect.selectedIndex=4;
         } else if (trim(r1[20].toUpperCase())=="EBCDIC 1600 BPI Tape"){
            document.forms['custcareform'].tmoutputselect.selectedIndex=5;
         } else if (trim(r1[20].toUpperCase())=="EBCDIC 6250 BPI Tape"){
            document.forms['custcareform'].tmoutputselect.selectedIndex=6;
         } else {
            document.forms['custcareform'].tmoutputselect.selectedIndex=0;
         }



      }

      
      if (trim(r1[17])=="" && trim(r1[19]) !=""){document.forms['custcareform'].tmoutputtype.selectedIndex=1};
      if (trim(r1[19])=="" && trim(r1[17]) !=""){document.forms['custcareform'].tmoutputtype.selectedIndex=2};

      //loop over 
      //tmfiletypeselect
        
	var mz4 = document.forms['custcareform'].tmfiletypeselect.options.length;
	mz4=mz4-1;
	r1[19] = trim(r1[19]);
	if (r1[19].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].tmfiletypeselect.options.length; i++) 
	 {
	    if (document.forms['custcareform'].tmfiletypeselect.options[i].text.toUpperCase()==r1[19].toUpperCase())
	    {
	      document.forms['custcareform'].tmfiletypeselect.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].tmfiletypeselect.options[mz4].selected = true};


        //loop over 
        //tmlabelselect
        
	mz4 = document.forms['custcareform'].tmlabelselect.options.length;
	mz4=mz4-1;
	r1[17] = trim(r1[17]);
	if (r1[17].substring(0,6) !="Object") 
	{
	 
	 for (var i = 0; i < document.forms['custcareform'].tmlabelselect.options.length; i++) 
	 {
	    if (document.forms['custcareform'].tmlabelselect.options[i].text.toUpperCase()==r1[17].toUpperCase())
	    {
	      document.forms['custcareform'].tmlabelselect.options[i].selected = true;
	    }
	 }
	
	} else {document.forms['custcareform'].tmlabelselect.options[mz4].selected = true};

        //now check email   
        misemail=r1[13].indexOf("@"); 
        if (misemail > 0){
          document.getElementById('TM_SHIPEMAIL').value=r1[13];
        } else {
          document.getElementById('TM_SHIPEMAIL').value=document.getElementById('DELVREMAIL').value;
        }

        // r1[18] is for adding bar to label
	if (r1[18].substring(0,6) !="Object") {
	    if (r1[18].substring(0,1) == 'Y') {
	        document.getElementById("TM_LABEL_BARbox").checked = true;
	    } else {document.getElementById('TM_LABEL_BARbox').checked = false};
	
	} else {document.getElementById('TM_LABEL_BARbox').checked = false};


        // r1[21] is for reverse walk sorting
	if (r1[21].substring(0,6) !="Object") {
	    if (r1[21].substring(0,1) == 'Y') {
	        document.getElementById("TM_REV_WALKbox").checked = true;
	    } else {document.getElementById('TM_REV_WALKbox').checked = false};
	
	} else {document.getElementById('TM_REV_WALKbox').checked = false};
   
      }

    }
 
    //test for record found- by change vp to 'Y' it set the condition in checktmshp() to error message 
    //on either not found or vp=Y which is what the fox program did

    if (trim(document.getElementById('TM_VPID').value) !=""){ 
      //alert('cond 1');
      getShipAdd(document.getElementById('TM_VPID').value);
 
    } else {

      document.getElementById('TM_VP').value ='Y';
      //needs to be last in chain
      var mnm2=document.getElementById('uname').value;
      //alert(mnm2);
      //if (mnm2=="Pat" || mnm2=="Chris" || mnm2=="Randy" || mnm2=="Stephen"){
	    getsalesperson();
      //}	
    }

  }
}


function checktmship() {

  document.getElementById('tmshipresult').style.visibility = "hidden";
  document.getElementById('tmshipresult1').style.visibility = "hidden";
  document.getElementById('tmshipresult2').style.visibility = "hidden";
  document.getElementById('tmshipresult3').style.visibility = "hidden";
  document.getElementById('tmshipresult4').style.visibility = "hidden";
  document.getElementById('tmmessagediv').style.visibility = "hidden";

  document.getElementById('tmscreen').style.visibility = "visible";


if (document.getElementById('TM_VP').value !='Y') {         

   //'Output Options Are Available To Territory Manager Users Only.';

   document.getElementById('tmscreen').style.visibility = "hidden";
   document.getElementById('tmlabelselect').style.visibility = "hidden";
   document.getElementById('tmoutputtype').style.visibility = "hidden";
   document.getElementById('tmfiletypeselect').style.visibility = "hidden";
   document.getElementById('tmoutputselect').style.visibility = "hidden";
   document.getElementById('tmshipselect').style.visibility = "hidden";

//display message
document.getElementById('tmmessagediv').style.visibility = "visible";
document.getElementById('TMMESSAGE').innerHTML="<br><br>Output Options Are Available To Territory Manager Users Only.";

} else {

  var mindex= document.forms['custcareform'].tmshipselect.selectedIndex;

  if (mindex==1){

    document.getElementById('tmshipresult1').style.visibility = "visible";

  } else if (mindex==3){

    document.getElementById('tmshipresult2').style.visibility = "visible";
 
  } else if (mindex==5){

    document.getElementById('tmshipresult4').style.visibility = "visible";

  } else if (mindex==7){

    document.getElementById('tmshipresult3').style.visibility = "visible";
  } 


  if (mindex < 3 || mindex==8){ 
    document.forms['custcareform'].tmoutputselect.options.length = 0;
    document.forms['custcareform'].tmoutputselect.options[0] = new Option("Not Selected","1",true,false);
    document.forms['custcareform'].tmoutputselect.options[1] = new Option("3 1/2 Diskette","1",true,false);
    document.forms['custcareform'].tmoutputselect.options[2] = new Option("ZIP Disk", "2",true,false);
    document.forms['custcareform'].tmoutputselect.options[3] = new Option("ASCII 1600 BPI Tape","3",true,false);
    document.forms['custcareform'].tmoutputselect.options[4] = new Option("ASCII 6250 BPI Tape","4",true,false);
    document.forms['custcareform'].tmoutputselect.options[5] = new Option("EBCDIC 1600 BPI Tape","1",true,false);
    document.forms['custcareform'].tmoutputselect.options[6] = new Option("EBCDIC 6250 BPI Tape","1",true,false);

  } else {

    document.forms['custcareform'].tmoutputselect.options.length = 0;
    document.forms['custcareform'].tmoutputselect.options[0] = new Option("E-Mail/BBS/FTP","0",true,false);
    document.forms['custcareform'].tmoutputselect.selectedIndex=0;

  }



  var tmindex= document.forms['custcareform'].tmoutputtype.selectedIndex;
       

   if (tmindex==1) {

     document.getElementById('tmlabelselect').style.visibility = "hidden";  
     document.getElementById('tmoutputselect').style.visibility = "visible";
     document.getElementById('tmfiletypeselect').style.visibility = "visible";

   } else if (tmindex==2)  { 
     
     document.getElementById('tmoutputselect').style.visibility = "hidden";
     document.getElementById('tmfiletypeselect').style.visibility = "hidden";  
     document.getElementById('tmlabelselect').style.visibility = "visible"; 

   } else { 

     document.getElementById('tmoutputselect').style.visibility = "hidden";
     document.getElementById('tmfiletypeselect').style.visibility = "hidden"; 
     document.getElementById('tmlabelselect').style.visibility = "hidden"; 
   }


  //very frustrating but run check here because the 
  if (document.getElementById('EditEnabled').value=="Y"){

    document.getElementById("TM_LABEL_BARbox").disabled =false;
    document.getElementById("TM_REV_WALKbox").disabled =false;
    document.getElementById('TM_SHIP1FTP').readOnly =false;
    document.getElementById('TM_SHIP2FTP').readOnly =false;
    document.getElementById('TM_SHIP3FTP').readOnly =false;
    document.getElementById('TM_SHIP4FTP').readOnly =false;
    document.getElementById('TM_SHIP1BBS').readOnly =false;
    document.getElementById('TM_SHIP2BBS').readOnly =false;
    document.getElementById('TM_SHIP3BBS').readOnly =false;
    document.getElementById('TM_SHIP4BBS').readOnly =false;
    document.getElementById('TM_SHIP1ADD').readOnly =false; 
    document.getElementById('TM_SHIP2ADD').readOnly =false; 
    document.getElementById('TM_SHIP3ADD').readOnly =false;
    document.getElementById('TM_SHIP4ADD').readOnly =false;
    document.getElementById('TM_SHIPEMAIL').readOnly =false;
    document.getElementById('tmoutputtype').disabled =false; 
    document.getElementById('tmoutputselect').disabled =false;
    document.getElementById('tmfiletypeselect').disabled =false; 
    document.getElementById('tmlabelselect').disabled =false;
    document.getElementById('tmshipselect').disabled =false; 
 
  } else {

    document.getElementById("TM_LABEL_BARbox").disabled =true;
    document.getElementById("TM_REV_WALKbox").disabled =true;

    document.getElementById('TM_SHIP1FTP').readOnly =true;
    document.getElementById('TM_SHIP2FTP').readOnly =true;
    document.getElementById('TM_SHIP3FTP').readOnly =true;
    document.getElementById('TM_SHIP4FTP').readOnly =true;
    document.getElementById('TM_SHIP1BBS').readOnly =true;
    document.getElementById('TM_SHIP2BBS').readOnly =true;
    document.getElementById('TM_SHIP3BBS').readOnly =true;
    document.getElementById('TM_SHIP4BBS').readOnly =true;
    document.getElementById('TM_SHIP1ADD').readOnly =true; 
    document.getElementById('TM_SHIP2ADD').readOnly =true; 
    document.getElementById('TM_SHIP3ADD').readOnly =true;
    document.getElementById('TM_SHIP4ADD').readOnly =true;
    document.getElementById('TM_SHIPEMAIL').readOnly =true;
    document.getElementById('tmoutputtype').disabled =true; 
    document.getElementById('tmoutputselect').disabled =true;
    document.getElementById('tmfiletypeselect').disabled =true; 
    document.getElementById('tmlabelselect').disabled =true;
    document.getElementById('tmshipselect').disabled =true; 

  }

} //


}

//includes/php/cc_get_add_process.php?mid="
function getShipAdd(vpcustid) {

  var userurl = "includes/php/cc_get_tm_process_fox.php?mid="; // The server-side script
  var midValue = vpcustid;
  var usession = getmsession();
  http.open("GET", userurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getShipAddResponse;
  http.send(null);

}



function getShipAddResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array

    results = http.responseText.split("^");

    //alert(http.responseText);

    r1= new Array();

    for (x in results)
    {
     
     r1 = results[x].split("|");
 
     
      if (trim(r1[0]) == 'S')
      {

       document.getElementById('TM_SHIP1ADD').value=r1[6]; 
       document.getElementById('TM_SHIP2ADD').value=document.getElementById('COMPANY').value; 
       document.getElementById('TM_SHIP3ADD').value=r1[3];
       document.getElementById('TM_SHIP4ADD').value=trim(r1[4])+"  "+trim(r1[5])+"  "+trim(r1[9]);
       
       // r1[0]= REC_TYPE
       // r1[1]= DEPT
       // r1[2]= MAIN_CONTACT
       // r1[3]= ADD1
       // r1[4]= CITY
       // r1[5]= ST
       // r1[6]= ATTN
       // r1[7]= USERID
       // r1[8]= COMPANY
       // r1[9]= ZIP        

      }  
     
     document.getElementById('TM_SHIP1ADD').value=trim(r1[13]); 
     document.getElementById('TM_SHIP2ADD').value=trim(r1[14]); 
     document.getElementById('TM_SHIP3ADD').value=trim(r1[15]);
     document.getElementById('TM_SHIP4ADD').value=trim(r1[16]);
     break;
    }

    //hide delete button if no edit
    if (document.getElementById('EditEnabled').value=="N") {

       document.getElementById('deletebt').style.visibility = "hidden";
       document.getElementById('unlockbt').style.visibility = "hidden";
       document.getElementById('exportbutton').style.visibility = "hidden";

    } else {

       document.getElementById('unlockbt').style.visibility = "visible";
       document.getElementById('deletebt').style.visibility = "visible";
       document.getElementById('exportbutton').style.visibility = "visible";

    }

hidewait();
document.body.style.cursor='auto';

//last in chain- up in gettmresponce as well
var mnm2=document.getElementById('uname').value;
//if (mnm2=="Pat" || mnm2=="Chris" || mnm2=="Randy" || mnm2=="Stephen"){
	  getsalesperson();
//}	


 //hide all edit buttons based on if is edit
 // if (document.getElementById('EditEnabled').value=="N") {
 //   document.getElementById('contactupdate').style.visibility = "hidden";
 //   document.getElementById('contactdelete').style.visibility = "hidden";
 //   document.getElementById('adduserbt').style.visibility = "hidden";
 // } else {
 //   document.getElementById('contactupdate').style.visibility = "visible";
 //   document.getElementById('contactdelete').style.visibility = "visible";
 //   document.getElementById('adduserbt').style.visibility = "visible";

 // }


  }
}



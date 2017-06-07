//function for getting uploaded files
 

function upgetdirResponse() {

  if (http.readyState == 4) {
  
    // Split the delimited response into an array
    mreturn = http.responseText.split("^");

//alert(mreturn[2]);
    counts= new Array();
    counts = mreturn[2].split("|");

    var mfiletyp= mreturn[1].toUpperCase();   

    results= new Array();
    results = mreturn[0].split("|");

    //alert(mfiletyp); 
    //set which sect to update
    document.getElementById("activefile").value=mfiletyp;
 
    if (mfiletyp=='BCM'){
      document.forms['uploadform'].upbcmsel.options.length = 0;             
    } else if (mfiletyp=='DOC'){
      document.forms['uploadform'].updocsel.options.length = 0;
    } else if (mfiletyp=='MISC'){
      document.forms['uploadform'].upmiscsel.options.length = 0;
    } else if (mfiletyp=='EXCEL'){
      document.forms['uploadform'].upexcelsel.options.length = 0;
    } else if (mfiletyp=='PP'){
      document.forms['uploadform'].upppsel.options.length = 0;
    } else {
      document.forms['uploadform'].uppdfsel.options.length = 0;
    }

    moptionnum=0;
    var nametext=" ";
    var datetext=" ";

    for (x in results){

      if (trim(results[x]) != ""){  

        // spit up the filename and pad it out to 25 characters
        nametext=results[x];
        datetext=results[x];
               
        mnum=nametext.indexOf(" -"); 
        nametext=nametext.substring(0,mnum);
        nametext=nametext.substring(0,30);
        nametext = padRight(nametext,' ',30);

        mnum=datetext.indexOf("-");
        mnum=(mnum+1);
        datetext=datetext.substring(mnum,200);
 
        nametext =nametext+" -"+datetext;
        // put it back into array
        results[x]=nametext;

            mx=results[x].toUpperCase();

               if (mfiletyp=='BCM'){

                  if (trim(document.getElementById("mbcmfilter").value) == ""){
                     document.forms['uploadform'].upbcmsel.options[moptionnum] = new Option(results[x],results[x],true,false);
                     moptionnum=(moptionnum+1);
                  } else {
                    if (mx.indexOf(document.getElementById("mbcmfilter").value.toUpperCase()) !=-1){
                      document.forms['uploadform'].upbcmsel.options[moptionnum] = new Option(results[x],results[x],true,false); 
                      moptionnum=(moptionnum+1);
                    } 

                  }

               } else if (mfiletyp=='DOC'){
    
                  if (trim(document.getElementById("mdocfilter").value) == ""){
                         document.forms['uploadform'].updocsel.options[moptionnum] = new Option(results[x],results[x],true,false);
                         moptionnum=(moptionnum+1); 
                  } else {
                    if (mx.indexOf(document.getElementById("mdocfilter").value.toUpperCase()) !=-1){
                      document.forms['uploadform'].updocsel.options[moptionnum] = new Option(results[x],results[x],true,false); 
                      moptionnum=(moptionnum+1);
                    } 
                  }

               } else if (mfiletyp=='MISC'){

                  if (trim(document.getElementById("mmiscfilter").value) == ""){
                        document.forms['uploadform'].upmiscsel.options[moptionnum] = new Option(results[x],results[x],true,false);
                        moptionnum=(moptionnum+1);
                  } else { 

                    if (mx.indexOf(document.getElementById("mmiscfilter").value.toUpperCase()) !=-1){
                      document.forms['uploadform'].upmiscsel.options[moptionnum] = new Option(results[x],results[x],true,false); 
                      moptionnum=(moptionnum+1);
                    } 
                  }

               } else if (mfiletyp=='EXCEL'){

                  if (trim(document.getElementById("mexcelfilter").value) == ""){
                         document.forms['uploadform'].upexcelsel.options[moptionnum] = new Option(results[x],results[x],true,false);
                         moptionnum=(moptionnum+1);
                  } else {
                  
                    if (mx.indexOf(document.getElementById("mexcelfilter").value.toUpperCase()) !=-1){
                      document.forms['uploadform'].upexcelsel.options[moptionnum] = new Option(results[x],results[x],true,false); 
                      moptionnum=(moptionnum+1);
                    } 
                  } 

               } else if (mfiletyp=='PP'){

                  if (trim(document.getElementById("mppfilter").value) == ""){
                       document.forms['uploadform'].upppsel.options[moptionnum] = new Option(results[x],results[x],true,false);
                       moptionnum=(moptionnum+1);
                  } else {
                    if (mx.indexOf(document.getElementById("mppfilter").value.toUpperCase()) !=-1){
                      document.forms['uploadform'].upppsel.options[moptionnum] = new Option(results[x],results[x],true,false); 
                      moptionnum=(moptionnum+1);
                    } 
                  }

               } else {
                  if (trim(document.getElementById("mpdffilter").value) == ""){
                       document.forms['uploadform'].uppdfsel.options[moptionnum] = new Option(results[x],results[x],true,false);             
                       moptionnum=(moptionnum+1);
                  } else {
                    if (mx.indexOf(document.getElementById("mpdffilter").value.toUpperCase()) !=-1){
                      document.forms['uploadform'].uppdfsel.options[moptionnum] = new Option(results[x],results[x],true,false); 
                      moptionnum=(moptionnum+1);
                    } 
                  }

               }


       } // end of test for blank

    } // end of for loop

  if (mfiletyp=='BCM'){
        if (document.forms['uploadform'].upbcmsel.options.length == 0) {
             document.forms['uploadform'].upbcmsel.options[moptionnum] = new Option("No uploaded outlook xml files found.",'true');
        }  
  } else if (mfiletyp=='DOC'){
        if (document.forms['uploadform'].updocsel.options.length == 0) { 
             document.forms['uploadform'].updocsel.options[moptionnum] = new Option("No uploaded word processing files found.",'true');
        }
  } else if (mfiletyp=='MISC'){
        if (document.forms['uploadform'].upmiscsel.options.length == 0) {   
             document.forms['uploadform'].upmiscsel.options[moptionnum] = new Option("No uploaded misc files found.",'true');
        }
  } else if (mfiletyp=='EXCEL'){
        if (document.forms['uploadform'].upexcelsel.options.length == 0) {
             document.forms['uploadform'].upexcelsel.options[moptionnum] = new Option("No uploaded spreadsheet files found.",'true');
        } 
  } else if (mfiletyp=='PP'){
        if (document.forms['uploadform'].upppsel.options.length == 0) {
             document.forms['uploadform'].upppsel.options[moptionnum] = new Option("No uploaded power point files found.",'true');
        }
  } else {
        if (document.forms['uploadform'].uppdfsel.options.length == 0) {
             document.forms['uploadform'].uppdfsel.options[moptionnum] = new Option("No uploaded pdf files found.",'true');
        }
  }


   
// from php ->$countstring= $bcmcnt  . "|" . $doccnt . "|" . $pdfcnt . "|"  . $excelcnt . "|"  . $ppcnt . "|" . $misccnt;

document.getElementById('bcmcount').innerHTML='Outlook BCM Files:&nbsp;'+counts[0];
document.getElementById('doccount').innerHTML='Word Processing Files:&nbsp;'+counts[1];
document.getElementById('pdfcount').innerHTML='PDF Files:&nbsp;'+counts[2];
document.getElementById('excelcount').innerHTML='Spreadsheet Files:&nbsp;'+counts[3];
document.getElementById('ppcount').innerHTML='Power Point Files:&nbsp;'+counts[4];
document.getElementById('misccount').innerHTML='Misc Files:&nbsp;'+counts[5];

// had this function run in timing routine so it needs to run background 
//document.getElementById('upbcmsel').style.visibility = "visible";
//document.forms['uploadform'].upbcmsel.selectedIndex=0;
//hidewait();
//document.body.style.cursor='auto';

  }

}


//legacy- need to hunt down references and then eliminate
function upgetBCM() {

 var updirurl = "includes/php/up_get_dir_process.php?mid="; // The server-side script
 var newmtype="none^BCM";
 //do not show wait for these
 var midValue = document.getElementById("uname").value;
 var usession = getmsession();
 http.open("GET", updirurl + escape(midValue)+ "&usession=" +escape(usession) + "&mtype=" +escape(newmtype), true);
 http.onreadystatechange = upgetdirResponse;
 http.send(null);


}

function upgetDir(mtype) {

 var updirurl = "includes/php/up_get_dir_process.php?mid="; // The server-side script
 var newmtype="none^"+mtype;
 //do not show wait for these
 var midValue = document.getElementById("uname").value;
 var usession = getmsession();
 http.open("GET", updirurl + escape(midValue)+ "&usession=" +escape(usession) + "&mtype=" +escape(newmtype), true);
 http.onreadystatechange = upgetdirResponse;
 http.send(null);


}



//this is the function for calling fileupload
function getFile(name, w, h,dnm) {
var usession = document.getElementById('ucoid').value;
var unm= document.getElementById('uname').value;
var mdir=dnm;

url = "includes/php/fileup.php?mdir="+dnm+"&mco=" +usession+"&uname=" +unm; 
w += 32;
h += 96;
 var win = window.open(url,
  name, 
  'width=' + w + ', height=' + h + ', ' +
  'location=no, menubar=no, ' +
  'status=no, toolbar=no, scrollbars=no, resizable=yes');
 win.resizeTo(w, h);
 win.focus();

}



function filedwn(type)
{

var mtype=type;

  if (mtype=='BCM'){

    var i = document.forms['uploadform'].upbcmsel.selectedIndex;
    mdwnfilename=document.forms['uploadform'].upbcmsel[i].text;
    dwnid="mydwn";

  } else if (mtype=='DOC'){

    var i = document.forms['uploadform'].updocsel.selectedIndex;
    mdwnfilename=document.forms['uploadform'].updocsel[i].text;
    dwnid="mydwn2";

  } else if (mtype=='PDF'){

    var i = document.forms['uploadform'].uppdfsel.selectedIndex;
    mdwnfilename=document.forms['uploadform'].uppdfsel[i].text;
    dwnid="mydwn3";

  } else if (mtype=='EXCEL'){

    var i = document.forms['uploadform'].upexcelsel.selectedIndex;
    mdwnfilename=document.forms['uploadform'].upexcelsel[i].text;
    dwnid="mydwn4";

  } else if (mtype=='PP'){

    var i = document.forms['uploadform'].upppsel.selectedIndex;
    mdwnfilename=document.forms['uploadform'].upppsel[i].text;
    dwnid="mydwn5";

  } else {

    var i = document.forms['uploadform'].upmiscsel.selectedIndex;
    mdwnfilename=document.forms['uploadform'].upmiscsel[i].text;
    dwnid="mydwn6";


  }

var mnum=mdwnfilename.indexOf(" -");
mdwnfilename=mdwnfilename.substring(0,mnum);

document.getElementById(dwnid).innerHTML="<img border='0' src='images/rarrow.gif'>&nbsp;"+mdwnfilename+"&nbsp;&nbsp;- Click here to open&nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp;Right Click to download.";
document.getElementById(dwnid).href="http://12.46.52.177/cc/"+document.getElementById('ucoid').value+"graphs/files/"+mtype+"/"+mdwnfilename;
document.getElementById(dwnid).target="_blank";

}


function movetoA(type)
{

  var mtype=type;
  var mnum=0;

    if (mtype=='BCM'){
      var i = document.forms['uploadform'].upbcmsel.selectedIndex;
      moveName=document.forms['uploadform'].upbcmsel[i].text;
    } else if (mtype=='DOC'){
      var i = document.forms['uploadform'].updocsel.selectedIndex;
      moveName=document.forms['uploadform'].updocsel[i].text;
    } else if (mtype=='MISC'){
      var i = document.forms['uploadform'].upmiscsel.selectedIndex;
      moveName=document.forms['uploadform'].upmiscsel[i].text;
    } else if (mtype=='EXCEL'){
      var i = document.forms['uploadform'].upexcelsel.selectedIndex;
      moveName=document.forms['uploadform'].upexcelsel[i].text;
    } else if (mtype=='PP'){
      var i = document.forms['uploadform'].upppsel.selectedIndex;
      moveName=document.forms['uploadform'].upppsel[i].text;
    } else {
      var i = document.forms['uploadform'].uppdfsel.selectedIndex;
      moveName=document.forms['uploadform'].uppdfsel[i].text;
    }

  mnum=moveName.indexOf(" -");
  moveName=moveName.substring(0,mnum);

  if (i > -1){

    filetoMove=mtype+","+moveName;
    var arcurl = "includes/php/up_move_archive_process.php?mfile="; // The server-side script
    document.body.style.cursor = "wait";
    showwait();  
    var usession = getmsession();
    http.open("GET", arcurl + escape(filetoMove)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = movetoAResponse;
    http.send(null);

  } else {

    document.getElementById('upconfirmtext').innerHTML="No file selected to archive.";
    showupconfirm();

  }

}


function movefromA()
{

    var mtype=document.getElementById("atype").value;
    var i = document.forms['uploadform'].uparcsel.selectedIndex;
    var mnum=0;

  if (i > -1){

    moveName=document.forms['uploadform'].uparcsel[i].text;
    mnum=moveName.indexOf(" -");
    moveName=moveName.substring(0,mnum);

    filetoMove=mtype+","+moveName;
    var arcurl = "includes/php/up_move_active_process.php?mfile="; // The server-side script
    document.body.style.cursor = "wait";
    showwait();  
    var usession = getmsession();
    http.open("GET", arcurl + escape(filetoMove)+ "&usession=" +escape(usession), true);
    http.onreadystatechange = movefromAResponse;
    http.send(null);

  } else {

    document.getElementById('upconfirmtext').innerHTML="No file selected to move.";
    showupconfirm();

  }

}


function movetoAResponse() {

  if (http.readyState == 4) {

    updir=document.getElementById("activefile").value;

    results = http.responseText;
    hidewait();
    document.body.style.cursor='auto';

    upgetDir(updir);

    if (updir=='BCM'){
      document.forms['uploadform'].upbcmsel.selectedIndex=0;
      document.getElementById('mydwn').innerHTML="A file is currently not selected for viewing or downloading.";

    } else if (updir=='DOC'){
      document.forms['uploadform'].updocsel.selectedIndex=0;
      document.getElementById('mydwn2').innerHTML="A file is currently not selected for viewing or downloading.";

    } else if (updir=='PDF'){
      document.forms['uploadform'].uppdfsel.selectedIndex=0;
      document.getElementById('mydwn3').innerHTML="A file is currently not selected for viewing or downloading.";

    } else if (updir=='EXCEL'){
      document.forms['uploadform'].upexcelsel.selectedIndex=0;
      document.getElementById('mydwn4').innerHTML="A file is currently not selected for viewing or downloading.";

    } else if (updir=='PP'){
      document.forms['uploadform'].upppsel.selectedIndex=0;
      document.getElementById('mydwn5').innerHTML="A file is currently not selected for viewing or downloading.";

    } else {
      document.forms['uploadform'].upmiscsel.selectedIndex=0;
      document.getElementById('mydwn6').innerHTML="A file is currently not selected for viewing or downloading.";

   }

    document.getElementById('upconfirmtext').innerHTML=results;
    showupconfirm();
    
  }

}

function movefromAResponse() {

  if (http.readyState == 4) {
    var arctype=document.getElementById("atype").value;
    results = http.responseText;
    document.forms['uploadform'].upbcmsel.selectedIndex=0;
    hidewait();
    document.body.style.cursor='auto';
    upgetarc(arctype); 
    document.getElementById('arcdwn').innerHTML="A file is currently not selected for viewing or downloading.";
    document.getElementById('upconfirmtext').innerHTML=results;
    showupconfirm();
    
  }

}




function getarc() {

  // this one is different than the individual ones because it passes through three layers to drill down

  var i = document.forms['uploadform'].uparcsel.selectedIndex;

  var mname=document.forms['uploadform'].uparcsel[i].text;
  var marc=document.forms['uploadform'].uparcsel[i].value;

  if (document.forms['uploadform'].uparcsel[i].value == "Root"){

    document.forms['uploadform'].uparcsel.options.length = 0;
    document.forms['uploadform'].uparcsel.options[0] = new Option("Outlook BCM Files","BCM",true,false);
    document.forms['uploadform'].uparcsel.options[1] = new Option("Word Processing Files","DOC",true,false);
    document.forms['uploadform'].uparcsel.options[2] = new Option("MISC Files","Misc",true,false);
    document.forms['uploadform'].uparcsel.options[3] = new Option("Spreadsheet Files","Excel",true,false);
    document.forms['uploadform'].uparcsel.options[4] = new Option("PDF Files","PDF",true,false);
    document.forms['uploadform'].uparcsel.options[5] = new Option("Power Point Files","PP",true,false);

    document.getElementById('arc1').style.visibility = "hidden";
    document.getElementById('arc2').style.visibility = "hidden";
    document.getElementById('arc3').style.visibility = "hidden";
    document.getElementById('arc4').style.visibility = "hidden";
    document.getElementById('arc6').style.visibility = "hidden";
    document.getElementById('arc7').style.visibility = "hidden";
    document.getElementById('arc5').style.visibility = "visible";
    document.getElementById('arc5').style.top = "40px";
    document.getElementById('archead').innerHTML="<b>Archive&nbsp;-&nbsp;Choose a Directory</b>";

  } else {

     if (document.forms['uploadform'].uparcsel[0].text == "Change Directory..."){
      
       //select file to view or download
       arcfiledwn();

     } else {

        // set it up the first time 
        document.getElementById("atype").value =marc;
        document.getElementById("marcfilter").value ="";
        document.getElementById('arcdwn').innerHTML="A file is currently not selected for viewing or downloading.";
       
        document.getElementById('arc1').style.visibility = "visible";
        document.getElementById('arc2').style.visibility = "visible";
        document.getElementById('arc3').style.visibility = "visible";
        document.getElementById('arc4').style.visibility = "visible";
        document.getElementById('arc5').style.visibility = "visible";
        document.getElementById('arc6').style.visibility = "visible";
        document.getElementById('arc7').style.visibility = "visible";
        document.getElementById('arc5').style.top = "10px";

        document.getElementById('archead').innerHTML="<b>Archive&nbsp;-&nbsp;"+document.forms['uploadform'].uparcsel[i].text+"</b>";

        upgetarc(marc);         

     }

  }

}


function arcfiledwn()
{

var mtype=document.getElementById("atype").value;
var i = document.forms['uploadform'].uparcsel.selectedIndex;

mdwnfilename=document.forms['uploadform'].uparcsel[i].text;

if (mdwnfilename !="No archive files found."){

var mnum=mdwnfilename.indexOf(" -");
mdwnfilename=mdwnfilename.substring(0,mnum);

  document.getElementById('arcdwn').innerHTML="<img border='0' src='images/rarrow.gif'>&nbsp;"+mdwnfilename+"&nbsp;&nbsp;- Click here to open&nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp;Right Click to download.";
  document.getElementById('arcdwn').href="http://12.46.52.177/cc/"+document.getElementById('ucoid').value+"graphs/files/Archive/"+mtype+"/"+mdwnfilename;
  document.getElementById('arcdwn').target="_blank";
}

}



function upgetarc(mtype) {

 var upbcmurl = "includes/php/up_get_dir_process.php?mid="; // The server-side script
 var newmtype="arc^"+mtype;
 //alert(mtype); 
 var midValue = document.getElementById("uname").value;
 var usession = getmsession();
 http.open("GET", upbcmurl + escape(midValue)+ "&usession=" +escape(usession) + "&mtype=" +escape(newmtype), true);
 http.onreadystatechange = upgetarcResponse;
 http.send(null);


}


function upgetarcResponse() {

  if (http.readyState == 4) {
  
    // Split the delimited response into an array

    results = http.responseText.split("|");

    document.forms['uploadform'].uparcsel.options.length = 0;
    document.forms['uploadform'].uparcsel.options[0] = new Option("Change Directory...","Root",true,false);
     
    var moptionnum=0;
    nametext="";
    datetext="";

    for (x in results){
         

        // spit up the filename and pad it out to 25 characters
        nametext=results[x];
        datetext=results[x];
               
        mnum=nametext.indexOf(" -"); 
        nametext=nametext.substring(0,mnum);
        nametext=nametext.substring(0,30);
        nametext = padRight(nametext,' ',30);

        mnum=datetext.indexOf("-");
        mnum=(mnum+1);
        datetext=datetext.substring(mnum,200);
 
        nametext =nametext+" -"+datetext;
        // put it back into array
        results[x]=nametext;





         if (trim(document.getElementById("marcfilter").value) == ""){

           if (trim(results[x]) != ""){
              mnum=results[x].indexOf("^arc");
              if (mnum ==-1){   
                moptionnum=(moptionnum+1);    
                document.forms['uploadform'].uparcsel.options[moptionnum] = new Option(results[x],results[x],true,false);
              }
           }  

         } else {

            mx=results[x].toUpperCase();
            if (mx.indexOf(document.getElementById("marcfilter").value.toUpperCase()) !=-1){
               moptionnum=(moptionnum+1);
               document.forms['uploadform'].uparcsel.options[moptionnum] = new Option(results[x],results[x],true,false);
                
            } 

         }  

    }

    if (document.forms['uploadform'].uparcsel.options.length == 1) {
     moptionnum=(moptionnum+1);
     document.forms['uploadform'].uparcsel.options[moptionnum] = new Option("No archive files found.",'true');
    }

  }

}



function sortSelect(mfiletyp,sortT,mreverse) {

  var msort=sortT;
  var numOpt=0;

   if (mfiletyp=='BCM'){
       numOpt=document.forms['uploadform'].upbcmsel.options.length;
   } else if (mfiletyp=='DOC'){
       numOpt=document.forms['uploadform'].updocsel.options.length;
   } else if (mfiletyp=='MISC'){
       numOpt=document.forms['uploadform'].upmiscsel.options.length;
   } else if (mfiletyp=='EXCEL'){
       numOpt=document.forms['uploadform'].upexcelsel.options.length;
   } else if (mfiletyp=='PP'){
       numOpt=document.forms['uploadform'].upppsel.options.length;
   } else if (mfiletyp=='ARC'){
       numOpt=document.forms['uploadform'].uparcsel.options.length;
   } else {
       numOpt=document.forms['uploadform'].uppdfsel.options.length;
   }   
  
  newopt= new Array();

  for (z=0; z < numOpt; z++) {
    var nametext="";
    var datetext="";
    var mnum=0;

      if (mfiletyp=='BCM'){

        nametext=document.forms['uploadform'].upbcmsel[z].text;
        datetext=document.forms['uploadform'].upbcmsel[z].text;

      } else if (mfiletyp=='DOC'){
        nametext=document.forms['uploadform'].updocsel[z].text;
        datetext=document.forms['uploadform'].updocsel[z].text;

      } else if (mfiletyp=='MISC'){
        nametext=document.forms['uploadform'].upmiscsel[z].text;
        datetext=document.forms['uploadform'].upmiscsel[z].text;

      } else if (mfiletyp=='EXCEL'){
        nametext=document.forms['uploadform'].upexcelsel[z].text;
        datetext=document.forms['uploadform'].upexcelsel[z].text;

      } else if (mfiletyp=='PP'){
        nametext=document.forms['uploadform'].upppsel[z].text;
        datetext=document.forms['uploadform'].upppsel[z].text;

      } else if (mfiletyp=='ARC'){
        nametext=document.forms['uploadform'].uparcsel[z].text;
        datetext=document.forms['uploadform'].uparcsel[z].text;

      } else {
        nametext=document.forms['uploadform'].uppdfsel[z].text;
        datetext=document.forms['uploadform'].uppdfsel[z].text;
      }   
              
    mnum=nametext.indexOf(" -");
    nametext=nametext.substring(0,mnum);

    mnum=datetext.indexOf("-");
    mnum=(mnum+1);
    datetext=datetext.substring(mnum,200);
 
    if (msort=='D'){
      newopt[z] =datetext+" -."+nametext;
    } else {
      newopt[z] =nametext+" -"+datetext;
    }
 
  } // end of for


if (mreverse=='R'){
  newopt=newopt.reverse();
} else {
  newopt=newopt.sort();
}

var moptionnum=0;

   if (mfiletyp=='BCM'){
       document.forms['uploadform'].upbcmsel.options.length=0;
   } else if (mfiletyp=='DOC'){
       document.forms['uploadform'].updocsel.options.length=0;
   } else if (mfiletyp=='MISC'){
       document.forms['uploadform'].upmiscsel.options.length=0;
   } else if (mfiletyp=='EXCEL'){
       document.forms['uploadform'].upexcelsel.options.length=0;
   } else if (mfiletyp=='ARC'){

       document.forms['uploadform'].uparcsel.options.length=0;
       document.forms['uploadform'].uparcsel.options[0] = new Option("Change Directory...","Root",true,false);
       moptionnum=(moptionnum+1);

   } else if (mfiletyp=='PP'){
       document.forms['uploadform'].upppsel.options.length=0;
   } else {
       document.forms['uploadform'].uppdfsel.options.length=0;             
   }   

  var loadstring="";

  for (x in newopt){

    if (trim(newopt[x]) != "" && newopt[x].indexOf("Change Directory") ==-1){ 
     //if (trim(newopt[x]) != "")
      //check for the -. if it id there then reverse it back

      if (newopt[x].indexOf("-.") > -1) {    
        var mnum=0;
        var nametext="";
        var datetext="";

        // put back in original order
        nametext=newopt[x];
        datetext=newopt[x];

        mnum=nametext.indexOf("-.");
        mnum=(mnum+2);
        nametext=nametext.substring(mnum,200);

        mnum=datetext.indexOf("-.");
        mnum=(mnum-1);
        datetext=datetext.substring(0,mnum);

        loadstring =nametext+" -"+datetext;
 
       } else {

         loadstring =newopt[x];

       }


      
      if (mfiletyp=='BCM'){
         document.forms['uploadform'].upbcmsel.options[moptionnum] =new Option(loadstring,loadstring,true,false);
      } else if (mfiletyp=='DOC'){
         document.forms['uploadform'].updocsel.options[moptionnum] = new Option(loadstring,loadstring,true,false);
      } else if (mfiletyp=='MISC'){
         document.forms['uploadform'].upmiscsel.options[moptionnum] = new Option(loadstring,loadstring,true,false);
      } else if (mfiletyp=='EXCEL'){
         document.forms['uploadform'].upexcelsel.options[moptionnum] = new Option(loadstring,loadstring,true,false);
      } else if (mfiletyp=='PP'){
         document.forms['uploadform'].upppsel.options[moptionnum] = new Option(loadstring,loadstring,true,false);
      } else if (mfiletyp=='ARC'){
         document.forms['uploadform'].uparcsel.options[moptionnum] = new Option(loadstring,loadstring,true,false);
      } else {
         document.forms['uploadform'].uppdfsel.options[moptionnum] = new Option(loadstring,loadstring,true,false);             
      }

              
     moptionnum=(moptionnum+1);

   } // end of blank check  

 } // end of for loop



} // end of function


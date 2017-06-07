
function bindcotoprim() {
  //bind main address to prim-
  document.getElementById('ADD_primAdd').value=document.getElementById('ADD_ADD1').value;
  document.getElementById('ADD_primCITY').value=document.getElementById('ADD_CITY').value;
  document.getElementById('ADD_primST').value=document.getElementById('ADD_ST').value;
  document.getElementById('ADD_primZIP').value=document.getElementById('ADD_ZIP').value;    
  document.getElementById('ADD_primZIP4').value=document.getElementById('ADD_ZIP4').value; 
  //bind main add to shipping
  document.getElementById('ADD_shipAdd').value=document.getElementById('ADD_ADD1').value;
  document.getElementById('ADD_shipCITY').value=document.getElementById('ADD_CITY').value;
  document.getElementById('ADD_shipST').value=document.getElementById('ADD_ST').value;
  document.getElementById('ADD_shipZIP').value=document.getElementById('ADD_ZIP').value;
  document.getElementById('ADD_shipZIP4').value=document.getElementById('ADD_ZIP4').value;
  //bind main entry to accounting
  document.getElementById('ADD_acctAdd').value=document.getElementById('ADD_ADD1').value;
  document.getElementById('ADD_acctCITY').value=document.getElementById('ADD_CITY').value;
  document.getElementById('ADD_acctST').value=document.getElementById('ADD_ST').value;
  document.getElementById('ADD_acctZIP').value=document.getElementById('ADD_ZIP').value;
  document.getElementById('ADD_acctZIP4').value=document.getElementById('ADD_ZIP4').value;
  
  //-do not bind main entry to accounting
  //document.getElementById('ADD_USERNAME').value=document.getElementById('ADD_COMPANY').value;
  //document.getElementById('ADD_PASSWORD').value=document.getElementById('ADD_COMPANY').value;
}

function bindemails() {
  //bind main address to prim-
  document.getElementById('ADD_primEMAIL').value=document.getElementById('ADD_DELVREMAIL').value;
  document.getElementById('ADD_NCOAEMAIL').value=document.getElementById('ADD_DELVREMAIL').value; 
}

function bindName() {
  //bind main address to prim-
  document.getElementById('ADD_UPSNAME').value=document.getElementById('ADD_primATTN').value;
}

function primtoacct() {

  if (document.getElementById('primuseacctbox').checked){

    document.getElementById('ADD_acctAttn').value=document.getElementById('ADD_primAttn').value;
    document.getElementById('ADD_acctAdd').value=document.getElementById('ADD_primAdd').value;
    document.getElementById('ADD_acctCITY').value=document.getElementById('ADD_primCITY').value;
    document.getElementById('ADD_acctST').value=document.getElementById('ADD_primST').value;
    document.getElementById('ADD_acctZIP').value=document.getElementById('ADD_primZIP').value;
    document.getElementById('ADD_acctEMAIL').value=document.getElementById('ADD_primEMAIL').value;
    document.getElementById('ADD_acctLDL').value=document.getElementById('ADD_primLDL').value;
    document.getElementById('ADD_acctACL').value=document.getElementById('ADD_primACL').value;
    document.getElementById('ADD_acctNUMBER').value=document.getElementById('ADD_primNUMBER').value;
    document.getElementById('ADD_acctEXT').value=document.getElementById('ADD_primEXT').value;
    document.getElementById('ADD_acctFLDL').value=document.getElementById('ADD_primFLDL').value;
    document.getElementById('ADD_acctFACL').value=document.getElementById('ADD_primFacl').value;
    document.getElementById('ADD_acctFNUMBER').value=document.getElementById('ADD_primFnumber').value;   

  } else {

    clearAcct();

  }

}

function primtoship() {

  if (document.getElementById('primuseshipbox').checked){

    document.getElementById('ADD_shipAttn').value=document.getElementById('ADD_primAttn').value;
    document.getElementById('ADD_shipAdd').value=document.getElementById('ADD_primAdd').value;
    document.getElementById('ADD_shipCITY').value=document.getElementById('ADD_primCITY').value;
    document.getElementById('ADD_shipST').value=document.getElementById('ADD_primST').value;
    document.getElementById('ADD_shipZIP').value=document.getElementById('ADD_primZIP').value;
    document.getElementById('ADD_shipEMAIL').value=document.getElementById('ADD_primEMAIL').value;
    document.getElementById('ADD_shipLDL').value=document.getElementById('ADD_primLDL').value;
    document.getElementById('ADD_shipACL').value=document.getElementById('ADD_primACL').value;
    document.getElementById('ADD_shipNUMBER').value=document.getElementById('ADD_primNUMBER').value;
    document.getElementById('ADD_shipEXT').value=document.getElementById('ADD_primEXT').value;
    document.getElementById('ADD_shipFLDL').value=document.getElementById('ADD_primFLDL').value;
    document.getElementById('ADD_shipFACL').value=document.getElementById('ADD_primFacl').value;
    document.getElementById('ADD_shipFNUMBER').value=document.getElementById('ADD_primFnumber').value;

  } else {

    clearShip();
  
  }

}


function clearPrim() {

   document.getElementById('ADD_primAttn').value="";
   document.getElementById('ADD_primAdd').value="";
   document.getElementById('ADD_primCITY').value=""; 
   document.getElementById('ADD_primST').value="";
   document.getElementById('ADD_primZIP').value="";
   document.getElementById('ADD_primEMAIL').value="";         
   document.getElementById('ADD_primLDL').value="";
   document.getElementById('ADD_primACL').value="";
   document.getElementById('ADD_primNUMBER').value="";
   document.getElementById('ADD_primEXT').value="";
   document.getElementById('ADD_primFLDL').value="";
   document.getElementById('ADD_primFacl').value="";
   document.getElementById('ADD_primFnumber').value="";
}

function clearAcct() {

document.getElementById('ADD_acctAttn').value="";
document.getElementById('ADD_acctAdd').value="";
document.getElementById('ADD_acctCITY').value="";
document.getElementById('ADD_acctST').value="";
document.getElementById('ADD_acctZIP').value="";
document.getElementById('ADD_acctEMAIL').value="";
document.getElementById('ADD_acctLDL').value="";
document.getElementById('ADD_acctACL').value="";
document.getElementById('ADD_acctNUMBER').value="";
document.getElementById('ADD_acctEXT').value="";
document.getElementById('ADD_acctFLDL').value="";
document.getElementById('ADD_acctFACL').value="";
document.getElementById('ADD_acctFNUMBER').value="";   
    

}

function clearShip() {

document.getElementById('ADD_shipAttn').value="";
document.getElementById('ADD_shipAdd').value="";
document.getElementById('ADD_shipCITY').value="";
document.getElementById('ADD_shipST').value="";
document.getElementById('ADD_shipZIP').value="";
document.getElementById('ADD_shipEMAIL').value="";
document.getElementById('ADD_shipLDL').value="";
document.getElementById('ADD_shipACL').value="";
document.getElementById('ADD_shipNUMBER').value="";
document.getElementById('ADD_shipEXT').value="";
document.getElementById('ADD_shipFLDL').value="";
document.getElementById('ADD_shipFACL').value="";
document.getElementById('ADD_shipFNUMBER').value="";

}

//function resetaddscr() {

//document.getElementById('ADD_COMPANY').value="";
//document.getElementById('ADD_ADD1').value="";
//document.getElementById('ADD_CITY').value="";
//document.getElementById('ADD_ST').value="";
//document.getElementById('ADD_ZIP').value="";    

//clearPrim();
//clearAcct();
//clearShip();

//}



// the next two functions retrieve the DEFALT PRICE information
function getDefaltPrices() {
  var url = "includes/php/cc_get_defaultprices_process.php?dwhlsret="; // The server-side script
  var mValue = "R";
 if (document.getElementById('ADD_whslretlbox').checked){
    mValue = "WHOLESALEPR";
 } else { 
    mValue = "RETAILPR";
 } 

  var usession = getmsession();
  http.open("GET", url + escape(mValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getDefaltPricesResponse;
  http.send(null);
}

function getDefaltPricesResponse() {

  if (http.readyState == 4) {
    // Split the comma delimited response into an array
    results = http.responseText.split("|");

     if (results[0].substring(0,1) == '') {

       document.getElementById('confirmtext').innerHTML='Error setting defalt prices.';
       showconfirm();
     }

     if (results[0].substring(0,6) !="Object") {document.getElementById('ADD_RESPRICE').value = results[0];} else {document.getElementById('ADD_RESPRICE').value =''};
     if (results[1].substring(0,6) !="Object") {document.getElementById('ADD_MINCHARGE').value = results[1];} else {document.getElementById('ADD_MINCHARGE').value =''};
     if (results[2].substring(0,6) !="Object") {document.getElementById('ADD_EMAILFTP').value = results[2];} else {document.getElementById('ADD_EMAILFTP').value =''};
     if (results[3].substring(0,6) !="Object") {document.getElementById('ADD_OCCUCHARGE').value = results[3];} else {document.getElementById('ADD_OCCUCHARGE').value =''};
     if (results[4].substring(0,6) !="Object") {document.getElementById('ADD_PDFCHARGE').value = results[4];} else {document.getElementById('ADD_PDFCHARGE').value =''};
     if (results[5].substring(0,6) !="Object") {document.getElementById('ADD_PDFTAGMIN').value = results[5];} else {document.getElementById('ADD_PDFTAGMIN').value =''};
     if (results[6].substring(0,6) !="Object") {document.getElementById('ADD_CONPRICE').value = results[6];} else {document.getElementById('ADD_CONPRICE').value =''};
     if (results[7].substring(0,6) !="Object") {document.getElementById('ADD_CONMIN').value = results[7];} else {document.getElementById('ADD_CONMIN').value =''};
     if (results[8].substring(0,6) !="Object") {document.getElementById('ADD_PLUS3CON').value = results[8];} else {document.getElementById('ADD_PLUS3CON').value =''};
     if (results[9].substring(0,6) !="Object") {document.getElementById('ADD_PLUSPHNCON').value = results[9];} else {document.getElementById('ADD_PLUSPHNCON').value =''};
     if (results[10].substring(0,6) !="Object") {document.getElementById('ADD_MLTIUSECON').value = results[10];} else {document.getElementById('ADD_MLTIUSECON').value =''};


//set default to COD
document.forms['custcareform'].ADD_mterms.selectedIndex = 8;

     if (results[11].substring(0,1) == 'W') {
       document.getElementById('confirmtext').innerHTML='Prices are now set to wholesale defaults.';
       showconfirm();
     } else {
       document.getElementById('confirmtext').innerHTML='Prices are now set to retail defaults.';
       showconfirm();
     }

  }

}
// end of defalt price retrieval

// need to design a print layer for a new account
function printNewAcct(layer)

{
  var generator=window.open('','name','channelmode = no, directories = no,fullscreen = no ,height = 500,left = 100,location = no,menubar = no,resizable = yes ,scrollbars = yes,status = no,titlebar = yes,toolbar = no,top = 100,width = 500');
  var layertext = document.getElementById(layer);
  generator.document.write(layertext.innerHTML.replace("Fill In the shipping address or check one of the boxes on the right to use an alternative address.",""));
  generator.document.getElementById('ADD_company').value="Mary Kay Cosmetics";


  generator.document.close();
  generator.print();
  generator.close();


}


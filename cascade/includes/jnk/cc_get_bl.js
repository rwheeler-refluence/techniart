
function getBLpricesResponse() {
  
  if (http.readyState == 4) {
    // Split the comma delimited response into an array

    results = http.responseText.split("^");
    r1= new Array();
   
    for (x in results)
    {
     

    //re-run if new was added
    if (results[x]=="Loaded new record") {getBLprices()};  
 
     r1 = results[x].split("|");
 
     if (r1[0] == "undefined" ) { alert("undefined") };
 
      if (r1[0] != '')
      {
        
        document.getElementById('blcid').value = r1[0];
        document.getElementById('blokamttrigger').value = r1[1];
        document.getElementById('blokvoltrigger').value = r1[2];
        document.getElementById('bloknumorderstrigger').value = r1[3];
        document.getElementById('blpkg1_single').value = r1[4];
        document.getElementById('blpkg1_yr').value = r1[5];
        document.getElementById('blpkg2_yr').value = r1[6];
        document.getElementById('blp1Sd1v').value = r1[7];
        document.getElementById('blp1Sd1a').value = r1[8];
        document.getElementById('blp1Sd2v').value = r1[9];
        document.getElementById('blp1Sd2a').value = r1[10];
        document.getElementById('blp1Yd1v').value = r1[11];
        document.getElementById('blp1Yd1a').value = r1[12];
        document.getElementById('blp1Yd2v').value = r1[13];
        document.getElementById('blp1Yd2a').value = r1[14];
        document.getElementById('blp2Yd1v').value = r1[15];
        document.getElementById('blp2Yd1a').value = r1[16];
        document.getElementById('blp2Yd2v').value = r1[17];
        document.getElementById('blp2Yd2a').value = r1[18];
        document.getElementById('blmin_order').value = r1[19];
        document.getElementById('bloneuplblprice').value = r1[20];
        document.getElementById('blfouruplblprice').value = r1[21];
        document.getElementById('blcdprice').value = r1[22];
        document.getElementById('bldiskprice').value = r1[23];
        document.getElementById('blseq10price').value = r1[24];
        document.getElementById('blseq11price').value = r1[25];
        document.getElementById('bluspdiskprice').value = r1[26];
        document.getElementById('blusplblprice').value = r1[27];
        document.getElementById('blitememphrprice').value = r1[28];
        document.getElementById('blitememptotprice').value = r1[29];
        document.getElementById('blitemownsprice').value = r1[30];
        document.getElementById('blitemsiteprice').value = r1[31];
        document.getElementById('blitemfranprice').value = r1[32];
        document.getElementById('blitemcorpprice').value = r1[33];
        document.getElementById('blitemyrprice').value = r1[34];
        document.getElementById('blitemmanuprice').value = r1[35];
        document.getElementById('blitemtickerprice').value = r1[36];
        document.getElementById('blitempubpriprice').value = r1[37];
        document.getElementById('blitemsalesprice').value = r1[38];
        document.getElementById('blitemsqfootprice').value = r1[39];
        document.getElementById('blitemnumpcprice').value = r1[40];
        document.getElementById('blitemteleprice').value = r1[41];
        document.getElementById('blitemcontactprice').value = r1[42];
        document.getElementById('blemailprice').value = r1[43];
        document.getElementById('blcheshirelblprice').value = r1[44];
      
          }
     }

  }

hidewait();
document.body.style.cursor='auto';

}

function getBLprices() {

  var url = "includes/php/cc_get_bl_process.php?mid="; // The server-side script
  var midValue = document.getElementById("mid").value;
 
  //alert(midValue.substring(0,7));
  if (midValue.substring(0,7) =="Enter I"){  
	 return null;
  }	   
  
  var mcname = document.getElementById('company').value;
  var mindex = document.forms['custcareform'].mterms.selectedIndex;
  var zterms = document.forms['custcareform'].mterms.options[mindex].value;
  if (zterms.substring(0,3) !="COD"){
     var moktobill = "Y";
  } else {
     var moktobill = "Y";
  }

  // could be added for okamttobilllimit-id="CREDITLIM"

  if (document.getElementById('whslretlbox').checked == false) {
      var mwholesale = "N";
  } else {var mwholesale = "Y"};


  showwait();
  var usession = getmsession();
  http.open("GET", url + escape(midValue)+ "&usession=" +escape(usession)+ "&mcname=" +escape(mcname)+ "&mwholesale=" +escape(mwholesale)+ "&mterms=" +escape(zterms)+ "&moktobill=" +escape(moktobill), true);
  http.onreadystatechange = getBLpricesResponse;
  http.send(null);

}
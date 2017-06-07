
//function for the ncoa price table
function getSchema() {
  if (trim(document.getElementById('mcustid').value)=="") {
	document.forms['custcareform'].cust_schema.options.length = 0;
	document.forms['custcareform'].cust_schema.options[0] = new Option("No customer selected.",'true');
	document.forms['custcareform'].cust_override.options.length = 0;  
	
    return null;	
  }	
  
  var tkurl = "includes/php/cc_get_schema_process.php?usession="; // The server-side script
  mvar = new Array();
  
  document.body.style.cursor = "wait";
  showwait();  
 
  var mindex = document.forms['custcareform'].schemadefine.selectedIndex;
  mvar[0] = document.forms['custcareform'].schemadefine.options[mindex].value;
  
  if (document.forms['custcareform'].productdefine.options.length <= 1){    
    mvar[1] =" ";
  } else {	  
    var mindex = document.forms['custcareform'].productdefine.selectedIndex;
    mvar[1] = document.forms['custcareform'].productdefine.options[mindex].value;
  }
  mvar[2] =trim(document.getElementById('mcustid').value);
  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mvar), true);  
  http.onreadystatechange = getSchemaResponse;
  http.send(null);
}

 

function getSchemaResponse() {

  if (http.readyState == 4) {

	  
	
    ret = http.responseText.split("~");

    // Split the delimited response into an array for the schema
    var thePrice=0.00,
    
    results = ret[0].split("^");
    r1= new Array();
    document.forms['custcareform'].cust_schema.options.length = 0;

    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       
       if (document.getElementById('WHSLRETLbox').checked == false) {
          thePrice= r1[3];
       } else {thePrice= r1[4]};

       
       // pad out the elements for table if individual elements not null
       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',4)};
       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',4)};
       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',25)};
       if (thePrice != undefined){thePrice = padLeft(thePrice,' ',7)};
       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',4)};
    
       document.forms['custcareform'].cust_schema.options[x] = new Option(r1[0]+r1[1]+r1[2]+thePrice+" "+r1[5],r1[0],true,false);
      }  

    }

    if (document.forms['custcareform'].cust_schema.options.length == 0) {
     document.forms['custcareform'].cust_schema.options[x] = new Option("No Schema Prices found for customer.",'true');
    }

    
    //now for the override
    // Split the delimited response into an array for the override
    var thePrice=0.00,
    
    //if (trim(ret[1]) !=""){
    
	    results = ret[1].split("^");
	    r1= new Array();
	    document.forms['custcareform'].cust_override.options.length = 0;

	    for (x in results)
	    {
     
	     r1 = results[x].split("|");
	     
	      if (r1[1] != undefined)
	      {
	       
	       if (document.getElementById('WHSLRETLbox').checked == false) {
	          thePrice= r1[3];
	       } else {thePrice= r1[4]};
	
	       
	       // pad out the elements for table if individual elements not null
	       if (r1[0] != undefined){r1[0] = padRight(r1[0],' ',4)};
	       if (r1[1] != undefined){r1[1] = padRight(r1[1],' ',4)};
	       if (r1[2] != undefined){r1[2] = padRight(r1[2],' ',25)};
	       if (thePrice != undefined){thePrice = padLeft(thePrice,' ',7)};
	       if (r1[5] != undefined){r1[5] = padRight(r1[5],' ',4)};
	    
	       document.forms['custcareform'].cust_override.options[x] = new Option(r1[0]+r1[1]+r1[2]+thePrice+" "+r1[5],r1[0],true,false);
	      }  
	
	    }
	
	    if (document.forms['custcareform'].cust_override.options.length == 0) {
	     document.forms['custcareform'].cust_override.options[x] = new Option("No override SKUs found for customer.",'true');	
	    }
      
    //}//end of check for override
       
	//go get products if first time thorugh
	if (document.forms['custcareform'].productdefine.options.length <= 1){
	    getskuProd();
	} else {
	    hidewait();
	    document.body.style.cursor='auto';
    }
    
    
  } //end of responce
}

function getskuProd() {
  if (trim(document.getElementById('mcustid').value)=="") {
	document.forms['custcareform'].product_define.options.length = 0;
	document.forms['custcareform'].product_define.options[0] = new Option("No products.",'true');	
    return null;	
  }	
  
  var tkurl = "includes/php/cc_get_prods_process.php?msch="; // The server-side script
  var mrecord = "";
  document.body.style.cursor = "wait";
  showwait();  
 
  var mindex = document.forms['custcareform'].schemadefine.selectedIndex;
  var midValue = document.forms['custcareform'].schemadefine.options[mindex].value;
      
  var usession = getmsession();
  http.open("GET", tkurl + escape(midValue)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getskuProdResponse;
  http.send(null);
}

 

function getskuProdResponse() {

  if (http.readyState == 4) {
//alert(http.responseText);
    results = http.responseText.split("^");
    r1= new Array();
    document.forms['custcareform'].productdefine.options.length = 0;
    document.forms['custcareform'].productdefine.options[0] = new Option("All Products","ALL",true,false);
    var xct=0;
    for (x in results)
    {
     
     r1 = results[x].split("|");
     
      if (r1[1] != undefined)
      {
       xct=(xct+1);
       document.forms['custcareform'].productdefine.options[xct] = new Option(r1[1],r1[2],true,false);
      }  

    }

    if (document.forms['custcareform'].productdefine.options.length == 0) {
     document.forms['custcareform'].productdefine.options[0] = new Option("No Produsts.",'true');
    } 

    hidewait();
    document.body.style.cursor='auto';

  }
}

function setSkuOverride() {
  if (trim(document.getElementById('mcustid').value)=="") {
	 return null;	
  }	
  
  var tkurl = "includes/php/cc_set_custom_price.php?usession="; // The server-side script
  mvar = new Array();
  
  document.body.style.cursor = "wait";
  showwait();  
 
  var mindex = document.forms['custcareform'].cust_schema.selectedIndex;
  mvar[0] = document.forms['custcareform'].cust_schema.options[mindex].value;

  mvar[1] = trim(document.getElementById('mcustid').value);
  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mvar), true);  
  http.onreadystatechange = setSkuOverrideResponse;
  http.send(null);
}

 

function setSkuOverrideResponse() {

  if (http.readyState == 4) {

	alert(http.responseText);
	getSchema();
    hidewait();
    document.body.style.cursor='auto';

  }
}


function getSingleOverride() {

  if (trim(document.getElementById('mcustid').value)=="") {
	 alert("No customer is selected."); 
	 return null;	
  }	
 
  if (document.forms['custcareform'].cust_override.options[0].text == "No override SKUs found for customer.") {
    alert("There are no overrides currently defined for this customer.\nClick on a SKU from the defined default price schema \non the left to add an override for a particular \nSKU to this table.");
	return null; 
  }
  
  document.body.style.cursor = "wait";
  showwait();  
  //not tied to record lock by clicking edit- could tie this if we want
  //uncomment this and then go to responce below and uncomment the section that handles this as well
  //if (document.getElementById('EditEnabled').value=="N") {
	 //alert("Please click the Edit button before making changes."); 
	 //return null;    
  //}
  	  
  var tkurl = "includes/php/cc_get_single_override.php?usession="; // The server-side script
  mvar = new Array();
  
  //document.body.style.cursor = "wait";
  //showwait();  
 
  var mindex = document.forms['custcareform'].cust_override.selectedIndex;
  mvar[0] = document.forms['custcareform'].cust_override.options[mindex].value;

  mvar[1] = trim(document.getElementById('mcustid').value);
  
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mvar), true);  
  http.onreadystatechange = getSingleOverrideResponse;
  http.send(null);
 

}

function getSingleOverrideResponse() {

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
      	      
       // post elements
       document.getElementById('skuOveride_sku').value = r1[0];
       document.getElementById('skuOveride_product').value = r1[1];
       document.getElementById('skuOveride_descr').value = r1[2];
       document.getElementById('skuOveride_price_retail').value = r1[3];
       document.getElementById('skuOveride_price_wholesale').value = r1[4];
       document.getElementById('skuOveride_unit').value = r1[5];
    
      }  

    }
 
    if (document.getElementById('WHSLRETLbox').checked == false) {
          document.getElementById('skuOveride_TYPE').innerHTML="*** Customer is currently set to RETAIL pricing ***";
    } else {document.getElementById('skuOveride_TYPE').innerHTML="*** Customer is currently set to WHOLESALE pricing ***";};

    if (document.forms['custcareform'].cust_override.options.length == 0) {
     document.forms['custcareform'].cust_override.options[x] = new Option("No price overrides defined for customer.",'true');
    }

	hidewait();
	document.body.style.cursor='auto';

	//hide all edit buttons if edit is not enabled
	/*if (document.getElementById('EditEnabled').value=="N") {
	    document.getElementById('overridesave').style.visibility = "hidden";
	    document.getElementById('overridedelete').style.visibility = "hidden";
	} else {
		document.getElementById('overridesave').style.visibility = "visible";
        document.getElementById('overridedelete').style.visibility = "visible";
    }
    */

showoverride();


  }
}


function editDeleteOverride(theskunum,retval,whlval,mtype) {

	//alert(theskunum +"   :   "+ retval +"   :   "+ whlval);
	//return null;
	
  var tkurl = "includes/php/cc_edit_delete_override.php?usession="; // The server-side script
  mvar = new Array();
  
  document.body.style.cursor = "wait";
  showwait();  
 
  mvar[0] = theskunum;
  mvar[1] = trim(document.getElementById('mcustid').value);
  mvar[2] = retval;
  mvar[3] = whlval;
  mvar[4] = mtype;
    
  var usession = getmsession();
  http.open("GET", tkurl + escape(usession)+ "&mfilter=" +escape(mvar), true);  
  http.onreadystatechange = editDeleteOverrideResponse;
  http.send(null);
 

}

function editDeleteOverrideResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array
    //alert(http.responseText);
    hideoverride();
	getSchema();


  }
}


function getGrid(){

 var mindex = document.forms['utilform'].utilgridchoice.selectedIndex;

 //reset
 document.forms['utilform'].utilgridchoice.selectedIndex=0;
 
 //alert(mindex);
 //return null;
 if (mindex==1){
	document.getElementById('skusupportup').value=""; 
	document.getElementById('pick_schema').style.visibility = "hidden";
	document.getElementById('skuButtons').style.visibility = "visible"; 
	document.getElementById('schButtons').style.visibility = "hidden";
	document.getElementById('prodButtons').style.visibility = "hidden";
	utilGetSKU(); 
 }	   
  
 if (mindex==2){
	document.getElementById('skusupportup').value=""; 
	document.getElementById('skuButtons').style.visibility = "hidden";
	document.getElementById('griddata').innerHTML=""; 
	document.getElementById('gridtitle').innerHTML=""; 
	utilSchemaPick(); 
 }	 
 
 if (mindex==3){
	document.getElementById('skusupportup').value='P';
	document.getElementById('skuButtons').style.visibility = "hidden";
	document.getElementById('schButtons').style.visibility = "hidden"; 
	document.getElementById('prodButtons').style.visibility = "visible";
	document.getElementById('griddata').innerHTML=""; 
	document.getElementById('gridtitle').innerHTML=""; 
	utilGetSupport('P'); 
 }
 	
 if (mindex==4){
	document.getElementById('skusupportup').value='U';
	document.getElementById('skuButtons').style.visibility = "hidden";
	document.getElementById('schButtons').style.visibility = "hidden"; 
	document.getElementById('prodButtons').style.visibility = "visible";
	document.getElementById('griddata').innerHTML=""; 
	document.getElementById('gridtitle').innerHTML=""; 
	utilGetSupport('U'); 
 }
 
 if (mindex==5){
	document.getElementById('skusupportup').value='C';
	document.getElementById('skuButtons').style.visibility = "hidden";
	document.getElementById('schButtons').style.visibility = "hidden"; 
	document.getElementById('prodButtons').style.visibility = "visible";
	document.getElementById('griddata').innerHTML=""; 
	document.getElementById('gridtitle').innerHTML=""; 
	utilGetSupport('C'); 
 }
 
  
}

//*********** these are the utility functions for maintaining the SKU & Schema tables
function utilGetSKU() {
  var theurl = "includes/php/util_getSKU.php?usession="; // The server-side script
  
  s = new Array();
  s[0] = "no parameters for SKU yet- leave in proc though for later"; 
  document.body.style.cursor = "wait";
  showwait();
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mfilter=" +escape(s), true);  
  http.onreadystatechange = utilGetSKUResponse;
  http.send(null);

  
}


function utilGetSKUResponse() {

  if (http.readyState == 4) {
    
    var d=new Date();
    var day=d.getDate();
    var month=d.getMonth()+1;
    var year=d.getFullYear();
    var thenumsku=0;
    hidewait();
    document.body.style.cursor='auto';
    mainresults=http.responseText.split("~");
     
    results=mainresults[0].split("^");
    
    //alert(http.responseText);
    
    var linecolor='ffffff'; 
  
    
    r1= new Array();
    
    //screen header
    reportArray = new Array();
    reportArray[0] = "<center>SKU ADD/EDIT/DELETE</center>";  
    reportArray[1] = ""; 
    reportArray[1] = reportArray[1]+"<div id='rptcoHead'><table>";  
    
       //reportArray[1] = reportArray[1]+"<tr width='870px' style='background:#"+linecolor+"'><td id='labelclass' width='30px'>Del</td>";
       reportArray[1] = reportArray[1]+"<tr width='870px' style='background:#"+linecolor+"'>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='30px'>SKU#</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='65px'>Prod</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='260px'>Description</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='30px'>Whls</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='30px'>Retail</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='92px'>Unit</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='125px'>CAT</td></tr>";
		   
    linecolor='<?=$Lightcolor2?>'; 
    for (x in results) {
      
     r1 = results[x].split("|");
       mnum=x;
         if (r1[1] != undefined){
	        thenumsku=(thenumsku+1); 
  	        //0=sku
            //1=product---> select 
            //2=descr
            //3=whls_default
            //4=retail_default
            //5=unit
            //6=cat_number
    		//HAD THIS FOR A SELECT, NOT SURE WHY--->reportArray[1] = reportArray[1]+"<input type='hidden' value='"+r1[4]+"' id='prodS"+x+"'/>";     
    		
	       reportArray[1] = reportArray[1]+"<tr width='870px' id='detline' style='zIndex:13;background:#"+linecolor+";'>";
	       //reportArray[1] = reportArray[1]+"<td width='30px'><div class='delbutton' style='zIndex:13;margin-top:1px;'><a href=\"#\" title=\"Delete the SKU from the table.\" onClick=\"javascript:showskuoptions('"+r1[0]+"','D');\"></a></div></td>";
 
	       reportArray[1] = reportArray[1]+"<td width='30px'><input type='text' value='"+r1[0]+"' readonly='true' id='skuN"+x+"' size='4' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='65px' align='left' style='zIndex:13;margin-top:-13px;'><SELECT class='selectclass=' id='newprodS"+x+"' style='width:65px;'>";
	       
	       var prodArray=mainresults[1].split("^");  
	       for (xfg in prodArray) {
		      var isselected=" "; 
		       if (trim(r1[1])== prodArray[xfg]){
			      var isselected="SELECTED";
		       }
		        
		       if (prodArray[xfg] !=undefined){
		         if (trim(prodArray[xfg]) !=""){  			          
	              reportArray[1] = reportArray[1]+"<OPTION VALUE='"+prodArray[xfg]+"'"+isselected+" >"+prodArray[xfg]+"</option>";
           	     }
           	   }           	          
           }
              
	       reportArray[1] = reportArray[1]+"</SELECT></TD>";  
	       reportArray[1] = reportArray[1]+"<td width='260px'><input type='text' value='"+r1[2]+"' id='skuD"+x+"' onClick='javascript:this.form.skuD"+x+".focus();this.form.skuD"+x+".select();' onkeypress='return browKeyPress(event,this.id);' size='40' MAXLENGTH='30' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='30px'><input type='text' align='right' value='"+r1[3]+"' id='skuW"+x+"' onClick='javascript:this.form.skuW"+x+".focus();this.form.skuW"+x+".select();' size='5' MAXLENGTH='10' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='30px'><input type='text' align='right' value='"+r1[4]+"' id='skuR"+x+"' onClick='javascript:this.form.skuR"+x+".focus();this.form.skuR"+x+".select();' size='5' MAXLENGTH='10' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='92px' align='left' style='zIndex:13;margin-top:-13px;'><SELECT class='selectclass=' id='newunitS"+x+"' style='width:92px;'>";
	       
	       var unitArray=mainresults[3].split("^");  
	       for (xfg in unitArray) {
		      var isselected=" "; 
		       if (trim(r1[5])== unitArray[xfg]){
			      var isselected="SELECTED";
		       } 
		       
		       if (unitArray[xfg] !=undefined){
		         if (trim(unitArray[xfg]) !=""){  		          
	              reportArray[1] = reportArray[1]+"<OPTION VALUE='"+unitArray[xfg]+"'"+isselected+" >"+unitArray[xfg]+"</option>";
           	     }
           	   }           	          
           }
	       reportArray[1] = reportArray[1]+"</SELECT></TD>";  
	      
	       reportArray[1] = reportArray[1]+"<td width='125px' align='left' style='zIndex:13;margin-top:-13px;'><SELECT class='selectclass=' id='newcatS"+x+"' style='width:125px;'>";
	       
	       var catArray=mainresults[2].split("^");  
	       for (xfg in catArray) {
		      var isselected=" "; 
		      
		      cats=catArray[xfg].split("`");
		      var catnum=r1[6]+0;
		      var tablenum=cats[0]+0;
		      
		       if (catnum==tablenum){
			      var isselected="SELECTED";
		       } 			          
	           if (cats[1] !=undefined){
		         if (trim(cats[1]) !=""){  
		           reportArray[1] = reportArray[1]+"<OPTION VALUE='"+cats[0]+"'"+isselected+" >"+cats[1]+"</option>";
	             }  
               }	           	          
           }
	       reportArray[1] = reportArray[1]+"</SELECT></TD>";  
	       
	       //3 selects hidden for reports
	       reportArray[1] = reportArray[1]+"<input type='hidden' value='"+r1[1]+"' id='prodS"+x+"'/>";  
	       reportArray[1] = reportArray[1]+"<input type='hidden' value='"+r1[5]+"' id='unitS"+x+"'/>";    
	       reportArray[1] = reportArray[1]+"<input type='hidden' value='"+r1[6]+"' id='catS"+x+"'/>";    
	       reportArray[1] = reportArray[1]+"</tr>";
	  
	 
	       if (linecolor=="<?=$Lightcolor2?>"){
		      linecolor='ffffff';
	       } else{
		      linecolor='<?=$Lightcolor2?>';
	       }
	            
         } // end of defined condition
         
     } // end of loop
  
     
     reportArray[1] = reportArray[1]+"</table></div>";
      
     document.getElementById('gridtitle').innerHTML= reportArray[0];  
  	 document.getElementById('griddata').innerHTML= reportArray[1];
  	
  	 
	document.getElementById('numberofskus').value=thenumsku;
	 
    hidewait();
    document.body.style.cursor='auto'; 

	
  } //end of readystate change


}

 
function setGlobal(){
	
	document.body.style.cursor = "wait";
    showwait();
    
    
	var theskunum=document.getElementById('theskunum').value;
    var theaction=document.getElementById('actiontype').value;	
    
 
    if (theaction=="D"){
	   delete_addSKU(theskunum,'D');
    }
    
    if (theaction=="A"){
       delete_addSKU('000','A');	
    }
    
    if (theaction=="U"){
       updateSKU();	
    }
    
    
}	



function delete_addSKU(thesku,mtype) {

  var theurl = "includes/php/util_deleteSKU.php?usession="; // The server-side script
 
  if (mtype !="A"){
    if (document.getElementById('globalPricebox').checked==true){
  	  var changeGolbal="Y";
    } else {
   	  var changeGolbal="N"; 
    }	
  } else {
	 var changeGolbal="Y"; 
  }	   
    
  hideskuoptions(); 
  
  s = new Array();
  s[0] = trim(thesku); 
  s[1] = trim(mtype);
  s[2] = changeGolbal;
  
  //alert(s[0]+"  :  "+s[1]+"  :  "+s[2]);
  //return null;
  
  document.body.style.cursor = "wait";
  showwait();
  
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mfilter=" +escape(s), true);  
  http.onreadystatechange = delete_addSKUResponse;
  http.send(null);

}

function delete_addSKUResponse() {
  if (http.readyState == 4) {
    alert(http.responseText); 
    utilGetSKU();
    
  }
}

//************** THE UPDATE 
function updateSKU(mchunk,mglobal) {

	
  var theurl = "includes/php/updateSKU.php?usession="; // The server-side script
  var thenum=parseFloat(document.getElementById('numberofskus').value);
  var newchunk=0;
  s = new Array();
  
  if (mchunk==null){
	  newchunk=0;
	  s[0]=0;  
  }	else {
	  newchunk=parseFloat(mchunk);
	  s[0]=newchunk; 
  }	

  //alert(isNaN(newchunk)+ "<br />"+isNaN(thenum)+ "<br />");
  if (mglobal==null){
    if (document.getElementById('globalPricebox').checked==true){
	  s[1]="Y"; 
    } else {
	  s[1]="N"; 
    }	 
  } else {
	s[1]= mglobal; 
  }	  
	     
  hideskuoptions(); 
 
  //return null;
 

  var thecnt=newchunk;
  
  var arraynum=2;
  
  while (thecnt < thenum){
   	  
	//add code for all of the fields  
	var sbox='newprodS'+thecnt;  
	var mindex=eval("document.forms['utilform']."+sbox+".selectedIndex"); 	  
	var skuP = eval("document.forms['utilform']."+sbox+".options["+mindex+"].value");  
	
	var sbox='newunitS'+thecnt;  
	var mindex=eval("document.forms['utilform']."+sbox+".selectedIndex"); 	  
	var skuU = eval("document.forms['utilform']."+sbox+".options["+mindex+"].value");  
	
	var sbox='newcatS'+thecnt;  
	var mindex=eval("document.forms['utilform']."+sbox+".selectedIndex"); 	  
	var skuC = eval("document.forms['utilform']."+sbox+".options["+mindex+"].value");  
	
	s[arraynum]=document.getElementById('skuN'+thecnt).value+"|"+document.getElementById('skuD'+thecnt).value+"|"+document.getElementById('skuW'+thecnt).value+"|"+document.getElementById('skuR'+thecnt).value+"|"+skuP+"|"+skuU+"|"+skuC;
    thecnt=thecnt+1;
    arraynum=arraynum+1;
    if (arraynum > 51){
	    break;
    }     
    
  }
  
  document.body.style.cursor = "wait";
  showwait();  
  
  for(myKey in s)
   if (myKey > 1){ 
     if(s.propertyIsEnumerable(myKey)) {
       s[myKey]=s[myKey].replace(/\,/g,"zcoma");
       s[myKey]=s[myKey].replace(/\^/g," ");
       s[myKey]=s[myKey].replace(/\'/g,"''");
     
     }
   }
  
  
  //alert(s[1]);
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mform=" +escape(s), true);  
  http.onreadystatechange = updateSKUResponse;
  http.send(null);

}


function updateSKUResponse() {

  if (http.readyState == 4) {
	
	//alert(http.responseText);
	
	results = http.responseText.split("|");

	var howmany=parseFloat(results[0]);	
	var thenum=parseFloat(document.getElementById('numberofskus').value);
	
	//alert(thenum);
	if (!(howmany > thenum)){
       howmany=(howmany+50);  
	   //alert(howmany+"");  
	   updateSKU(howmany,results[1]);
	   
    } else {	
       alert(results[2]);
       utilGetSKU(); 
    } 
    
  }
}


//###### Schema utilities

//*********** these are the utility functions for maintaining the SKU & Schema tables
function utilSchemaPick() {
  var theurl = "includes/php/util_getSchemaPick.php?usession="; // The server-side script
  
  s = new Array();
  s[0] = "no parameters yet- leave in proc though for later"; 
  document.body.style.cursor = "wait";
  showwait();
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mfilter=" +escape(s), true);  
  http.onreadystatechange = utilSchemaPickResponse;
  http.send(null);
  
}

function utilSchemaPickResponse() {
  if (http.readyState == 4) {
    //alert(http.responseText); 
    
    
    // Split the comma delimited response into an array

    var abc=http.responseText;
    results = http.responseText.split("^");
    r1= new Array();

    document.forms['utilform'].utilschemagrid.options.length = 0;
    document.forms['utilform'].utilschemagrid.options[0] = new Option("Please Choose a Schema"," ",true,false);
    var optcnt=0;
    for (x in results){
	    
       r1 = results[x].split("|");
       if (trim(r1[0]) !=""){
         if (typeof r1[0] != "undefined"){      
            r1[0] = padRight(r1[0],' ',17);
            optcnt=(optcnt+1);
            document.forms['utilform'].utilschemagrid.options[optcnt] = new Option(r1[1],r1[0],true,false);
         }  
       }
    }

    if (document.forms['utilform'].utilschemagrid.options.length == 0){
       document.forms['utilform'].utilschemagrid.options[0] = new Option("No schemas."," ",true,false);
    }
    
    hidewait();
    document.body.style.cursor='auto'; 
    
    //document.getElementById('gridtitle').style.visibility = "hidden";
    document.getElementById('pick_schema').style.visibility = "visible";
  
  }
}


function utilGetSchema(msch) {
  var theurl = "includes/php/util_getSchema.php?usession="; // The server-side script
  
  s = new Array();
  if (msch ==null){
     var mindex = document.forms['utilform'].utilschemagrid.selectedIndex;
     s[0] = document.forms['utilform'].utilschemagrid.options[mindex].value;
  } else {
    s[0]=msch;	  	  
  }	
     
  document.body.style.cursor = "wait";
  showwait();
  
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mfilter=" +escape(s), true);  
  http.onreadystatechange = utilGetSchemaResponse;
  http.send(null);

  
}


function utilGetSchemaResponse() {

  if (http.readyState == 4) {
	  
	document.getElementById('numberofschs').value=0;
    var mindex = document.forms['utilform'].utilschemagrid.selectedIndex;
    var mpick = document.forms['utilform'].utilschemagrid.options[mindex].value;
    var thenumsch=0;   
    var mtest = document.utilform.utilschemagrid.options;
    mpick2 = mpick+" : "+ mtest[mtest.selectedIndex].text;
 
    if (trim(mpick)==""){
	    mpick2 =document.getElementById('selectedschematitle').value;
    }    
    
    
    document.forms['utilform'].utilschemagrid.selectedIndex=0;
    document.getElementById('schButtons').style.visibility = "visible";
  
    var d=new Date();
    var day=d.getDate();
    var month=d.getMonth()+1;
    var year=d.getFullYear();
   
    hidewait();
    document.body.style.cursor='auto';
    
     
    results=http.responseText.split("^");
    
    //alert(http.responseText);
    
    var linecolor='ffffff'; 
  
    
    r1= new Array();
    
    //screen header
    reportArray = new Array();
    reportArray[0] = "<center>Schema "+mpick2+"   - Edit Prices Only</center>";  
    reportArray[1] = ""; 
    reportArray[1] = reportArray[1]+"<div id='rptcoHead'><table>";  
    
       reportArray[1] = reportArray[1]+"<tr width='870px' style='background:#"+linecolor+"'>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='30px'>SKU#</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='45px'>Prod</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='260px'>Description</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='40px'>Whls</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='40px'>Retail</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='40px'>Unit</td>";
	   
		   
    linecolor='<?=$Lightcolor2?>'; 
    for (x in results) {
      
     r1 = results[x].split("|");
       mnum=x;
         if (r1[1] != undefined){
	       thenumsch=(thenumsch+1); 	
	       reportArray[1] = reportArray[1]+"<tr width='870px' id='detline' style='zIndex:13;background:#"+linecolor+";'>";
	       reportArray[1] = reportArray[1]+"<td width='30px'><input type='text' value='"+r1[0]+"' readonly='true' id='schN"+x+"' size='4' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='45px'><input type='text' align='right' value='"+r1[1]+"' readonly='true' id='schP"+x+"' size='25' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='260px'><input type='text' value='"+r1[2]+"' readonly='true' id='schD"+x+"' size='40' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='40px'><input type='text' align='right' value='"+r1[3]+"' id='schW"+x+"' onClick='javascript:this.form.schW"+x+".focus();this.form.schW"+x+".select();' size='7' MAXLENGTH='10' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='40px'><input type='text' align='right' value='"+r1[4]+"' id='schR"+x+"' onClick='javascript:this.form.schR"+x+".focus();this.form.schR"+x+".select();' size='7' MAXLENGTH='10' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='40px'><input type='text' align='right' value='"+r1[5]+"' readonly='true' id='schU"+x+"' size='12' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	    
	       reportArray[1] = reportArray[1]+"</tr>";
	  
	       if (linecolor=="<?=$Lightcolor2?>"){
		      linecolor='ffffff';
	       } else{
		      linecolor='<?=$Lightcolor2?>';
	       }
	            
         } // end of defined condition
         
     } // end of loop
  
     reportArray[1] = reportArray[1]+"<input type='hidden' value='"+mpick+"' id='theselectedschema'/>"; 
     reportArray[1] = reportArray[1]+"<input type='hidden' value='"+mpick2+"' id='selectedschematitle'/>"; 
     reportArray[1] = reportArray[1]+"</table></div>";
      
     document.getElementById('gridtitle').innerHTML= reportArray[0];  
  	 document.getElementById('griddata').innerHTML= reportArray[1];
  	
  	 document.getElementById('numberofschs').value=thenumsch;
	
    hidewait();
    document.body.style.cursor='auto'; 

	
  } //end of readystate change


}



function buildSchema(){
 var newscode=trim(document.getElementById('Ncid').value)+"_"+trim(document.getElementById('Nschcode').value);
 var newsname=document.getElementById('Nschname').value;

 if (trim(newscode)==""){
   alert("Please enter a code & customer ID for the new price schema.");
   return null;
 }
 
 if (newscode.length < 8){
   alert("Please enter a code & the 6 digit customer ID for the new price schema.");
   return null;
 }
 
 if (trim(newsname)==""){
   alert("Please enter a description of the schema.");
   return null;
 }
		
  hideschemabox();	

  //do it 
  var theurl = "includes/php/util_addSchema.php?usession="; // The server-side script
  
  s = new Array();
  
  s[0] = document.getElementById('typeofschema').value; //N or C
  s[1] = document.getElementById('theselectedschema').value;  //6 digit code
   
  s[2] = newscode;
  s[3] = newsname;
  s[4] = trim(document.getElementById('Ncid').value);
  
  document.getElementById('typeofschema').value="";
  document.getElementById('theselectedschema').value="";
  
  document.body.style.cursor = "wait";
  showwait();
  
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mvar=" +escape(s), true);  
  http.onreadystatechange = buildSchemaResponse;
  http.send(null);

}	


function buildSchemaResponse() {
  if (http.readyState == 4) {
	
	r1=http.responseText.split("|"); 
		  
    var newopt=document.forms['utilform'].utilschemagrid.options.length;
    //newopt=(newopt-1);
    if (r1[1] != undefined){
      document.forms['utilform'].utilschemagrid.options[newopt] = new Option(r1[2],r1[1],true,false); 
      document.forms['utilform'].utilschemagrid.selectedIndex=newopt;
      utilGetSchema(r1[1]);
    } else {
	    alert(http.responseText); 
    }
    
    
    hidewait();
    document.body.style.cursor='auto';   
    
        
  }
}


function deleteSchema(){
   //do it 
  var theurl = "includes/php/util_deleteSchema.php?usession="; // The server-side script
  
  s = new Array();
  
  s[0] = document.getElementById('theselectedschema').value;  //6 digit code
  s[0] =trim(s[0]);
    
  document.body.style.cursor = "wait";
  showwait();
  
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mvar=" +escape(s), true);  
  http.onreadystatechange = deleteSchemaResponse;
  http.send(null);

}	


function deleteSchemaResponse() {
  if (http.readyState == 4) {
	
    alert(http.responseText); 
    document.getElementById('utilgridchoice').selectedIndex=2;
    getGrid()
    
    hidewait();
    document.body.style.cursor='auto';   
    
        
  }
}


//************** THE UPDATE 
function updateSchema(mchunk) {

  var theurl = "includes/php/util_editSchema.php?usession="; // The server-side script
  var thenum=parseFloat(document.getElementById('numberofschs').value);
  var theselectedone=trim(document.getElementById('theselectedschema').value);

  //alert(thenum);
  //return null;

  var newchunk=0;
  s = new Array();
  
  if (mchunk==null){
	  newchunk=0;
	  s[0]=0;  
  }	else {
	  newchunk=parseFloat(mchunk);
	  s[0]=newchunk; 
  }	
  
  var thecnt=newchunk;
  var arraynum=1;
  
  while (thecnt < thenum){
	  
	s[arraynum]=theselectedone+"|"+document.getElementById('schN'+thecnt).value+"|"+document.getElementById('schW'+thecnt).value+"|"+document.getElementById('schR'+thecnt).value;
    thecnt=thecnt+1;
    arraynum=arraynum+1;
    if (arraynum > 51){
	    break;
    }     
  }
  
  for(myKey in s)
   if (myKey > 0){ 
    if(s.propertyIsEnumerable(myKey)) {
      s[myKey]=s[myKey].replace(/\,/g,""); 
     }
   } 
   
  document.body.style.cursor = "wait";
  showwait();  
  
  //alert(s[1]);
   var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mvar=" +escape(s), true);  
  http.onreadystatechange = updateSchemaResponse;
  http.send(null);

}

function updateSchemaResponse() {
  if (http.readyState == 4) {
    //alert(http.responseText); 
    var selsch=trim(document.getElementById('theselectedschema').value);
    
	results = http.responseText.split("|");

	var howmany=parseFloat(results[0]);	
	var thenum=parseFloat(document.getElementById('numberofschs').value);
	
	//alert(thenum);
	if (!(howmany > thenum)){
       howmany=(howmany+50);  
	   //alert(howmany+"");  
	   updateSchema(howmany);
	   
    } else {	
       alert(results[1]);
       utilGetSchema(selsch);
    } 
    
    
    
    
    
  }
}



function utilGetSupport(whichone) {
  var theurl = "includes/php/util_getSupport.php?usession="; // The server-side script
  document.getElementById('skusupportup').value=whichone;
  s = new Array();
  s[0] = whichone; 
  document.body.style.cursor = "wait";
  showwait();
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mfilter=" +escape(s), true);  
  http.onreadystatechange = utilGetSupportResponse;
  http.send(null);

  
}


function utilGetSupportResponse() {

  if (http.readyState == 4) {
	//alert(http.responseText);
	  
    var suptitle='Error getting support db';
	if (document.getElementById('skusupportup').value=="P"){
		suptitle='Product';
    }	
		
    if (document.getElementById('skusupportup').value=="C"){
		suptitle='Category';
    }
    
    if (document.getElementById('skusupportup').value=="U"){
		suptitle='Unit';
    }
          
    var d=new Date();
    var day=d.getDate();
    var month=d.getMonth()+1;
    var year=d.getFullYear();
    var thenumsup=0;
    hidewait();
    
    document.body.style.cursor='auto';
    
     
    results=http.responseText.split("^");
    
    
    var linecolor='ffffff'; 
  
    
    r1= new Array();
    
    //screen header
    reportArray = new Array();
    reportArray[0] = "<center>"+suptitle+" Add/Edit/Delete</center>";  
    reportArray[1] = ""; 
    reportArray[1] = reportArray[1]+"<div id='rptcoHead'><table>";  
    
       reportArray[1] = reportArray[1]+"<tr width='870px' style='background:#"+linecolor+"'><td id='labelclass' width='30px'>Delete</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='40px'>Display Order</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='40px'>"+suptitle+"</td>";
	   reportArray[1] = reportArray[1]+"<td id='labelclass' width='260px'>Description</td>";
	
		   
    linecolor='<?=$Lightcolor2?>'; 
    for (x in results) {
      
     r1 = results[x].split("|");
       mnum=x;
         if (r1[1] != undefined){
	       
	       thenumsup=(thenumsup+1); 
  	            
	       myObj = document.getElementById('supO'+x);
           if (myObj!=null){
  	          myObj.parentNode.removeChild(myObj); 
           }
           
     	   myObj = document.getElementById('supN'+x);
           if (myObj!=null){
  	          myObj.parentNode.removeChild(myObj); 
           }
           
           myObj = document.getElementById('supD'+x);
           if (myObj!=null){
  	          myObj.parentNode.removeChild(myObj); 
           }
           
	       reportArray[1] = reportArray[1]+"<tr width='870px' id='detline' style='zIndex:13;background:#"+linecolor+";'>";
	       reportArray[1] = reportArray[1]+"<td width='30px'><div class='delbutton' style='zIndex:13;margin-top:1px;'><a href=\"#\" title=\"Delete the "+suptitle+" from the table.\" onClick=\"javascript:adddelSupport('"+r1[0]+"','D');\"></a></div></td>";
 
	       reportArray[1] = reportArray[1]+"<td width='40px'><input type='text' value='"+r1[1]+"' id='supO"+x+"' onClick='javascript:this.form.supO"+x+".focus();this.form.supO"+x+".select();' size='15' style=\"border:0px;background:#"+linecolor+";\" /></td>";
	       reportArray[1] = reportArray[1]+"<td width='40px'><input type='text' value='"+r1[0]+"' id='supN"+x+"' readonly='true' size='15' style=\"border:0px;background:#"+linecolor+";\" /></td>";
           reportArray[1] = reportArray[1]+"<td width='260px'><input type='text' value='"+r1[2]+"' id='supD"+x+"' onClick='javascript:this.form.supD"+x+".focus();this.form.supD"+x+".select();' size='50' style=\"border:0px;background:#"+linecolor+";\" /></td>";

	       reportArray[1] = reportArray[1]+"</tr>";
	  
	 
	       if (linecolor=="<?=$Lightcolor2?>"){
		      linecolor='ffffff';
	       } else{
		      linecolor='<?=$Lightcolor2?>';
	       }
	            
         } // end of defined condition
         
     } // end of loop
  
     
     reportArray[1] = reportArray[1]+"</table></div>";
      
     //document.getElementById('gridtitle').innerHTML= reportArray[0];  
  	 document.getElementById('griddata').innerHTML= reportArray[1];
  	
  	 
	document.getElementById('numberofsup').value=thenumsup;
	 
    hidewait();
    document.body.style.cursor='auto'; 

	
  } //end of readystate change


}


function adddelSupport(mid,mtype){
	
  var theurl = "includes/php/util_adddelSupport.php?usession="; // The server-side script
  var mdatabase="";
  
  if (document.getElementById('skusupportup').value=="P"){
     mdatabase="SKU_PROD";  
  }
  	    
  if (document.getElementById('skusupportup').value=="C"){
     mdatabase="SKU_CAT";  
  }	
  
  if (document.getElementById('skusupportup').value=="U"){
     mdatabase="UNIT";  
  }	
  
  s = new Array();
  s[0] = mdatabase; 
  s[1] = mid;
  s[2] = mtype;
  
  if (mtype=="A"){
	
	if (trim(document.getElementById('thesupcode').value)==""){
		alert("You must enter a name.");
		return null;
    }	
	  
    s[3] =document.getElementById('thesupcode').value;
    s[4] =document.getElementById('thesupdesc').value;
    s[5] =document.getElementById('thesuporder').value;
  
    document.getElementById('thesupcode').value="";
    document.getElementById('thesupdesc').value="";
    document.getElementById('thesuporder').value="";
  
    hideskusupbox();
  }
  
   
  document.body.style.cursor = "wait";
  showwait();
  
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mfilter=" +escape(s), true);  
  http.onreadystatechange = adddelSupportResponse;
  http.send(null);
	
}	


function adddelSupportResponse() {
  if (http.readyState == 4) {
	//alert(http.responseText); 
	 
	ret= http.responseText.split("|");  
	var selsup=document.getElementById('skusupportup').value;  
    alert(ret[1]);
    hidewait();
    document.body.style.cursor='auto'; 

    utilGetSupport(selsup);
    
       
  }
}


function updateSupport() {

  var theurl = "includes/php/util_editSupport.php?usession="; // The server-side script
  var thenum=document.getElementById('numberofsup').value;
  var thedb=document.getElementById('skusupportup').value;

  s = new Array();
   
  var thecnt=0;
  var arraynum=0;
  
  while (thecnt < thenum){
  	  
	  s[arraynum]=thedb+"|"+document.getElementById('supO'+thecnt).value+"|"+document.getElementById('supN'+thecnt).value+"|"+document.getElementById('supD'+thecnt).value;
      thecnt=thecnt+1;
     arraynum=arraynum+1;
  
  }
  
  for(myKey in s)
   if(s.propertyIsEnumerable(myKey)) {
     s[myKey]=s[myKey].replace(/\,/g,""); 
    }
    
  document.body.style.cursor = "wait";
  showwait();  
  
  //alert(s[0]);
  //return null;
  
  var usession = getmsession();
  http.open("GET", theurl + escape(usession)+ "&mvar=" +escape(s), true);  
  http.onreadystatechange = updateSupportResponse;
  http.send(null);

}

function updateSupportResponse() {
  if (http.readyState == 4) {
    alert(http.responseText); 
    var selsup=document.getElementById('skusupportup').value;
    
      utilGetSupport(selsup);
       
  }
}


function getSKUSCHPDF(){
	
    var tkurl = "includes/php/utls_SKUSCHpdf_process.php?usession="; // The server-side script
    
    mf = new Array();
        
    document.getElementById('pdfid').value=document.getElementById('uname').value;
       
     
    if (document.getElementById('SKUSCHp').checked==true){
	    mf[0]="P"; //in product number order
    } else if (document.getElementById('SKUSCHs').checked==true){
	    mf[0]="S";
	} else if (document.getElementById('SKUSCHd').checked==true){
	    mf[0]="D";
	} else if (document.getElementById('SKUSCHu').checked==true){
	    mf[0]="U";
	} else {
	    mf[0]="C";
    }                                    

    if (document.getElementById('skupdforderD').checked==true){
	    mf[1]="D"; //decending order
    } else {
	    mf[1]="A";
    }       
    
    if (document.getElementById('filtertoprice').checked==false){
        mf[2]="N"; //only include ones with charges
    } else {
	    mf[2]="Y";
    }      
    
    if (document.getElementById('skuorschpdf').value=='sch'){
       mf[3]='sch';// sku or sch
    } else {
	   mf[3]='sku';   
    }       
       
    if (mf[3]=='sch'){
      mf[4] =document.getElementById('theselectedschema').value;
      document.getElementById('current_pdf').value="schemarpt";
    } else {
      mf[4]=" ";
      document.getElementById('current_pdf').value="skurpt"; 	  
    }	
    hidepdfbox();
    
    var usession = getmsession();
    http.open("GET", tkurl + escape(usession)+ "&mfilter=" + escape(mf), true);
    http.onreadystatechange = getSKUSCHPDFResponce;
    http.send(null);
 

}

function getSKUSCHPDFResponce(){

  if (http.readyState == 4) {
    // Split the delimited response into an array
    var mmes=http.responseText;
    
    //alert(mmes);
    
	    hidewait();
        document.body.style.cursor='auto';
        rpdfopen('popup', 640, 480);

  }
}


function browKeyPress(e,mid)
{
if (!e) e = window.event;

//alert(e.keyCode);

 //if (e && e.keyCode == 13){
   //var x=5;
   //document.getElementById("skuD"+x).focus();
   //document.getElementById("skuD"+x).select();
   //alert(mid + " enter pressed");
 //}

//var x=0;
//while (x <= 500){ 
 
 //if (e && e.keyCode == x){
   //alert(mid +" "+x+" key pressed");
 //}
 
 //x=x+1;
 
//}
 
 
 
 
 
}


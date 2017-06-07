//function for deleting records

 function getsurveyResponse() {

  if (http.readyState == 4) {

    hidewait();
    document.body.style.cursor='auto';
    
    //alert(http.responseText);
    
    var results = http.responseText.split("~");
    var bodytext="<table>";
    
    var s1= new Array();
    document.getElementById('surveytext').innerHTML="";
    var mtitle="";
    var mtitle2="";
    var rptTitle ="";
    var mln=1;
    var mstyle="";
        
    for (x in results){
	 
     s1 = results[x].split("|");
     mtitle=s1[3]; 
     
     if (trim(s1[0])!=""){
	      
         if (typeof s1[0] != "undefined"){
	         
	        mstyle= "font: 14px Arial, Helvetica;font-weight: bold; line-height:20px;"; 
		   

			if (mtitle != mtitle2){  
		        bodytext= bodytext + "<table><br><tr><td style='"+ mstyle +"' align='left'>"+ mln + ") " + s1[3] + "</td></tr></table>";
		        mln=mln+1; 
		    } 
		     
		    if (trim(s1[6]) !=''){
			   mstyle= "font: 14px Arial, Helvetica;font-weight: bold; line-height:20px;color: #000000;background-color:#ffffff;";
		    }
		     
			bodytext= bodytext + "<table><tr><td style='"+ mstyle +"' align='left'>&nbsp;&nbsp;&nbsp;" + s1[5] + "&nbsp;</td></tr></table>";
			
			//check for the ones beyone multi-choice
			var theans=trim(s1[6]);
			if (theans.length > 2){
		        bodytext= bodytext + "<table><tr><td style='"+ mstyle +"' align='left'>&nbsp;&nbsp;&nbsp;" + s1[6] + "&nbsp;</td></tr></table>";
			}
			 
		    rptTitle = s1[1];
		  
			    
		                    
		         
         }
      } 
      
      
      mtitle2=s1[3]; 
        
    }//end of for loop
    
    document.getElementById('surveytext').innerHTML="<table><tr><td style='"+ mstyle +"' >" + rptTitle + "</td></tr></table>"+ bodytext+"</table>";
    
    mstyle= "";
    
    showtsurvey();
    
  }//end of responce 

}


function getsurvey(){

  var updateurl = "includes/php/get_survey_process.php?mform="; // The server-side script
   
  s = new Array(); 
  s[0] = document.getElementById('mcustid').value;
  
  var mindex = document.forms['custcareform'].surveys.selectedIndex;
  s[1] = document.forms['custcareform'].surveys.options[mindex].value;
  
  if (trim(s[1])=="No respond"){
	 document.getElementById('confirmtext').innerHTML="The customer has not responded to this survey request.";   //'not found or locked by another user.';
	 document.forms['custcareform'].surveys.selectedIndex=0;	
	 showconfirm(); //alert('The customer has not responded to this survey request.');
	 
	 return null;
  }	 
  
  if (mindex > 0){
	  
	 document.body.style.cursor = "wait";
     showwait(); 
	  
     var usession = getmsession();
     http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
     http.onreadystatechange = getsurveyResponse;
     http.send(null);
  }

  
  
  
}


//admin survey summaries
function getadmsurvey(){
//alert('in function');

  var updateurl = "includes/php/get_admsurvey_process.php?mform="; // The server-side script
   
  s = new Array(); 
  
  var mindex = document.forms['utilform'].adm_surveys.selectedIndex;
  s[0] = document.forms['utilform'].adm_surveys.options[mindex].value;
  
   
  if (mindex >= 0){
	  
	 document.body.style.cursor = "wait";
     showwait(); 
	  
     var usession = getmsession();
     http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
     http.onreadystatechange = getadmsurveyResponse;
     http.send(null);
  }

}

function getadmsurveyResponse() {

  if (http.readyState == 4) {

    hidewait();
    document.body.style.cursor='auto';
    
    //alert(http.responseText);
    
    var results = http.responseText.split("~");
    var bodytext="<table>";
    
    var s1= new Array();
    document.getElementById('admsurveytext').innerHTML="";
    var mtitle="";
    var mtitle2="";
    var rptTitle ="";
    var mln=1;
    var mstyle="";
    var stylenum=1;
        
    for (x in results){
	 
     s1 = results[x].split("|");
     mtitle=s1[1]; 
     
     if (trim(s1[0])!=""){
	      
         if (typeof s1[0] != "undefined"){
	          
	         
	        if (mtitle != mtitle2){ 
				
				bodytext= bodytext + "<tr><td colspan='2' style='font: 14px Arial, Helvetica;font-weight: bold; line-height:20px;' align='left'><br></td></tr>";
				
		        bodytext= bodytext + "<tr><td colspan='2' style='font: 14px Arial, Helvetica;font-weight: bold; line-height:20px;' align='left'>"+ mln + ") " + s1[1] + "</td></tr>";
		        mln=mln+1; 
		         
		    } 
		    
	        if (stylenum==1){  
	           mstyle= "font: 14px Arial, Helvetica;font-weight: bold; line-height:20px;color: #000000;background-color:#eee;"; 
	           stylenum=0;
	        } else {
			   mstyle= "font: 14px Arial, Helvetica;font-weight: bold; line-height:20px;color: #000000;background-color:#ffffff;";
			   stylenum=1;
		    }

			 
		    s1[3]=s1[3]+"";
		    s1[3]=padLeft(s1[3],' ',3);
		     
			bodytext= bodytext + "<tr width='75%' style='"+ mstyle +"'><td width='80%' align='left'>" + s1[2] + "</td><td width='20%' align='right'>" + s1[3] + "&nbsp;</td></tr>";
			
			 
		    rptTitle = s1[0];
		  
			    
		                    
		         
         }
      } 
      
      
      mtitle2=s1[1]; 
        
    }//end of for loop
    
    document.getElementById('admsurveytext').innerHTML="<table><tr><td style='font: 14px Arial, Helvetica;font-weight: bold; line-height:20px;' >" + rptTitle + "</td></tr></table>"+ bodytext+"</table>";
    
    mstyle= "";
    
    showtadmsurvey();
    
  }//end of responce 

}


//admin survey summaries
function getthesurveys(){
//alert('in getthesurveys function');

  var updateurl = "includes/php/adm_survey_select_process.php?mform="; // The server-side script
   
  s = new Array(); 
  s[0] = "no value right now.";
  
  document.body.style.cursor = "wait";
  showwait(); 
 
  var usession = getmsession();
  http.open("GET", updateurl + escape(s)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getthesurveysResponse;
  http.send(null);
 
}

function getthesurveysResponse() {

  if (http.readyState == 4) {

    hidewait();
    document.body.style.cursor='auto';
    
    //alert(http.responseText);
    
    var sresults = http.responseText.split("~");
    //alert(results);
    var s1= new Array();
    document.forms['utilform'].adm_surveys.options.length = 0;
        
    for (x in sresults){
     s1 = sresults[x].split("`");
   
      if (trim(s1[0]) !=""){
	      
         if (typeof s1[0] != "undefined"){ 
	         if (x==0){
		       document.forms['utilform'].adm_surveys.options[0] = new Option("Choose a survey below to view summary infomation.","No Survey",true,false);
		       x += 1;
		       
	         }    
		         
           document.forms['utilform'].adm_surveys.options[x] = new Option(s1[0],s1[1],true,false);
         }
      }   
    }

    if (document.forms['utilform'].adm_surveys.options.length == 0){
       document.forms['utilform'].adm_surveys.options[0] = new Option("There are no surveys loaded.","No Survey",true,false);
    }   
	
	//alert("surveys:"+lockarray[20]);
	
  }//end of responce 

}
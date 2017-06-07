//function for getting stats

 function getstatchartResponse() {

  var chartnm="";

  if (http.readyState == 4) {

//alert(http.responseText);
     
     results = http.responseText.split(",");
     r1= new Array();
     r1 = results[0].split("|");
     setTimeout("pausefunction()",500);
     var mchartdir=document.getElementById('ucoid').value+"graphs/";

     if (trim(r1[0]) != "Done"){ 

       chartnm=mchartdir+document.getElementById('mcustid').value+"R.png";
       
       document['graph1'].src =chartnm; 
       getstatchart(results,'O'); 

     } else {
  

       chartnm=mchartdir+document.getElementById('mcustid').value+"O.png";

       document['graph2'].src =chartnm;

       //three column stat report suspended for now- uncomment here and getstats to put back
       document.getElementById('statText1').style.visibility = "hidden";
       document.getElementById('statText2').style.visibility = "hidden";
       document.getElementById('statText3').style.visibility = "hidden"; 
       hidewait();
       document.body.style.cursor='auto';
       getqstats()
     }
  
  }

}


function getstatchart(results,ctype) {

  var updateurl = "includes/php/cc_barchart.php?mform="; // The server-side script

  var mcid=document.getElementById('mcustid').value;
  var mtype=ctype;
  var usession = getmsession();
  document.body.style.cursor = "wait";
  showwait();
  mcnt=results.length;
  s = new Array();
  s = results;
  
//need to research further- AA0010/DI0105/DI0125 is throwing an errors with orders & AA0711 example is not 1st 12 works for all
z= new Array();
z[0]=s[0];
z[1]=s[1];
z[2]=s[2];
z[3]=s[3];
z[4]=s[4];
z[5]=s[5];
z[6]=s[6];
z[7]=s[7];
z[8]=s[8];
z[9]=s[9];
z[10]=s[10];
z[11]=s[11];
z[12]=s[12];

//alert(z[0]+" : "+z[1]+" : "+z[2]+" : "+z[3]+" : "+z[4]+" : "+z[5]+" : "+z[6]+" : "+z[7]+" : "+z[8]+" : "+z[9]+" : "+z[10]+" : "+z[11]+" : "+z[12]);

//alert(z[0]);
//alert(z[1]);
//alert(z[2]);
//document.getElementById('COMMENTL').value =s; 
//used this to trouble shoot and see what was passing

  http.open("GET", updateurl + escape(z) + "&myid=" +escape(mcid)+ "&ctype=" +escape(mtype)+ "&usession=" +escape(usession), true);
  http.onreadystatechange = getstatchartResponse;
  http.send(null);

//  document.body.style.cursor = "auto";
//  hidewait();

}

function pausefunction() {

  var junk=0;
  junk=1;

}


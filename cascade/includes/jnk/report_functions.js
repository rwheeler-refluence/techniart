function setupReport(){

reportArray = new Array(); 

reportArray[0] = "<center><h3>Title of Report</h3></center><br><br>";
reportArray[1] = "<a>col1	col2	col3</a><br>";
reportArray[2] = "<a>body of report</a><br><br>";

document.getElementById('reportbody').innerHTML=reportArray[0]+reportArray[1]+reportArray[2];
 

return reportArray;

}


function printreport(layer)

{

document.getElementById("rpttitlePRN").innerHTML=document.getElementById("rpttitle").innerHTML;
document.getElementById("rowheaderPRN").innerHTML=document.getElementById("rowheader").innerHTML;
document.getElementById("reportbodyPRN").innerHTML=document.getElementById("reportbody").innerHTML;

  var generator=window.open('','name','channelmode = no, directories = no,fullscreen = no ,height = 500,left = 100,location = no,menubar = no,resizable = yes ,scrollbars = yes,status = no,titlebar = yes,toolbar = no,top = 100,width = 790');
  var layertext = document.getElementById("reportscrPRN");
  var buttonwords = eval("/close|file|print|pdf|excel/ig");
  generator.document.write(layertext.innerHTML.replace(buttonwords, ""));
  generator.document.close();
  generator.print();
  generator.close();



}
 

//this is the function for calling the pdf window
function rpdfopen(name, w, h) {

//alert('made it here');
if (document.getElementById('mmktscreenup').value == "YES"){

   url=document.getElementById('mkt_pdf').value;

} else {
   //this is for the cc reports on individual tickets and reports
   url=document.getElementById('ordpdfdir').value+document.getElementById('pdfid').value+"_"+document.getElementById('current_pdf').value+".pdf";
}

 //alert(url);
 w += 32;
 h += 96;
 var win = window.open(url, name, 'width=' + w + ', height=' + h + ', ' + 'location=no, menubar=no, ' + 'status=no, toolbar=no, scrollbars=no, resizable=yes');
 //win.resizeTo(w, h);
 //win.focus();
//the above is now throwing an error in ie8
}

//this is the function for calling the excell window
function rexcelopen(name, w, h) {

 url=document.getElementById('ordpdfdir').value+document.getElementById('pdfid').value+"_"+document.getElementById('current_pdf').value+".xls";
 //alert(url);
 w += 32;
 h += 96;
 var win = window.open(url, name, 'width=' + w + ', height=' + h + ', ' + 'location=yes, menubar=yes, ' + 'status=yes, toolbar=yes, scrollbars=yes, resizable=yes');
 //win.resizeTo(w, h);
 //win.focus();

}



function getObj(name)
{
  if (document.getElementById)
  {
  	this.obj = document.getElementById(name);
	this.style = document.getElementById(name).style;
  }
  else if (document.all)
  {
	this.obj = document.all[name];
	this.style = document.all[name].style;
  }
  else if (document.layers)
  {
	this.obj = getObjNN4(document,name);
	this.style = this.obj;
  }
}

function getObjNN4(obj,name)
{
	var x = obj.layers;
	var foundLayer;
	for (var i=0;i<x.length;i++)
	{
		if (x[i].id == name)
		 	foundLayer = x[i];
		else if (x[i].layers.length)
			var tmp = getObjNN4(x[i],name);
		if (tmp) foundLayer = tmp;
	}
	return foundLayer;
}


//this is the function for calling the pdf window
function slspdfopen(name, w, h,mname) {

url=document.getElementById('ordpdfdir').value+"sales_tax/"+mname;
//alert(url);
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




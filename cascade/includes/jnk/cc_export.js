function exportrecordtResponse() {

  if (http.readyState == 4) {
    results = http.responseText;
    hidewait();
    document.body.style.cursor='auto';
    document.getElementById('confirmtext').innerHTML=results;
    showconfirm();


  }
}

function exportrecord() {
  var expurl = "includes/php/cc_export_process.php?mid="; // The server-side script
  var midValue = document.getElementById("mid").value;

  if (trim(midValue) != ""){

    var usession = getmsession();
    document.body.style.cursor = "wait";
    showwait();  
    http.open("GET", expurl + escape(midValue) + "&usession=" +escape(usession), true);
    http.onreadystatechange = exportrecordtResponse;
    http.send(null);

  } else {

    document.getElementById('confirmtext').innerHTML="There is no record selected for export.";
    showconfirm();

  }

}





function showgraphsResponse() {

  if (http.readyState == 4) {

    // Split the delimited response into an array
alert(http.responseText);
    results = http.responseText.split("|");
    r1= new Array();

    for (x in results)
    { 
       document.getElementById('confirmtext').innerHTML=document.getElementById('confirmtext').innerHTML+"<br>"+results;
    }

hidewait();
document.body.style.cursor='auto';

  }
}


function showgraphs() {

  var showgrurl = "includes/php/dir_process.php?mid="; // The server-side script
  var midValue = document.getElementById("mid").value;

  if (trim(midValue) != ""){

    var usession = getmsession();
    document.body.style.cursor = "wait";
    showwait();  
    http.open("GET", showgrurl + escape(midValue) + "&usession=" +escape(usession), true);
    http.onreadystatechange = exportrecordtResponse;
    http.send(null);

  } else {

    document.getElementById('confirmtext').innerHTML="There is no record selected for export.";
    showconfirm();

  }

}



function showthegraph(x) {
 alert(x);
}

function trim(str)
{
   return str.replace(/^\s*|\s*$/g,"");
}


function loginprocResponse() {
 
  if (http.readyState == 4) {

    results = http.responseText.split("|");
    document.body.style.cursor='auto';
//alert(results);

    if (results[0] == "Incorrect login, please try again.") {

       alert(results);
     
    } else {

      document.getElementById('ulevel').value=results[2];
      document.getElementById('udept').value=results[3];
      document.getElementById('uname').value=results[4];
      
      if (document.forms['login'].mtheme.options[0].selected == true){
          document.forms['login'].mtheme.options[results[5]].selected = true;
      }  

      document.getElementById('ucoid').value=results[6];
      document.getElementById('scrwidth').value=screen.width;
      document.getElementById('scrheight').value=screen.height;

      document.getElementById('manager').value=results[7];
      document.getElementById('manageremail').value=results[8];
      document.getElementById('email').value=results[9];
      
      window.open('','appWindow','channelmode = no, directories = no,fullscreen = no ,height = 800,left = 1,location = no,menubar = no,resizable = yes ,scrollbars = yes,status = no,titlebar = yes,toolbar = no,top = 1,width = 1024');
      
      //get rid of this one as it opens it full screen
      //window.open("","appWindow","fullscreen=yes");
      document.login.submit(); 
      window.opener='self';
      closeWindow();
      //window.close();

       
    }

  }

}

function loginproc() {
  
  var updateurl = "includes/php/loginproc_process.php?mform="; // The server-side script
  var mindex = document.forms['login'].mtheme.selectedIndex;
  var mthemeValue = document.forms['login'].mtheme.options[mindex].value;
  document.body.style.cursor = "wait";

  s = new Array();

  s[0] = document.getElementById('unm').value;   //userID
  s[1] = document.getElementById('upw').value;  //ATTN

  if (document.getElementById('newtheme').checked == true){
    s[2]=mthemeValue;
  } else {
    s[2]=0;
  }

  http.open("GET", updateurl + escape(s), true);

  http.onreadystatechange = loginprocResponse;

  http.send(null);

}

function loginproc2() {
  
  var updateurl = "includes/php/loginproc_process.php?mform="; // The server-side script
  var mindex = document.forms['login'].mtheme.selectedIndex;
  var mthemeValue = document.forms['login'].mtheme.options[mindex].value;
  document.body.style.cursor = "wait";

  s = new Array();

  //added this for auto login- keep separate because they are definately going to be adding in
  //more startup logins :-)
  
  document.getElementById('unm').value=document.getElementById('theuser').value;   //userID
  document.getElementById('upw').value=document.getElementById('thepw').value;  //ATTN

  s[0] = document.getElementById('unm').value;   //userID
  s[1] = document.getElementById('upw').value;  //ATTN

  if (trim(s[0])==""){
	  return null;
  }
  	  
  if (document.getElementById('newtheme').checked == true){
    s[2]=mthemeValue;
  } else {
    s[2]=0;
  }

  http.open("GET", updateurl + escape(s), true);

  http.onreadystatechange = loginprocResponse;

  http.send(null);

}

function handleKeyPress(e)
{
if (!e) e = window.event;
if (e && e.keyCode == 13)
{
  //alert("enter pressed");
  	loginproc();
// handle Enter key
// return false; here to cancel the event
}
}

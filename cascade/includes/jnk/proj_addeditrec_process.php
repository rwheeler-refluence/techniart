<?PHP
// PREVENT CACHING FIRST BEFORE ANYTHING ELSE!
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
//error_reporting(0);


include("ADODB/adodb.inc.php");

$ms = $_GET['mfilter'];
//die($ms);

$ms = explode(",",$ms);

$ms=str_replace("zcomma",",",$ms);
$ms=str_replace("zpos","''",$ms);

include("functions.php");
$s = trim_array($ms);


//get session vars
$msession = $_GET['usession'];
$msession = explode("|",$msession);

// will try and keep these up-check functions.js for uptodate list
//msession[0]=lognm
//msession[1]=upw
//msession[2]=loglevel
//msession[3]=udept
//msession[4]=uname
//msession[5]=ucoid  //CIS or CDS 
//msession[6]=udomain
//msession[7]=chartbg
//msession[8]=chartshadow
//msession[9]=chartmargin
//msession[10]=chartbars
//

       // go get all records from SQL table- for now leave it split to allow for separate CDS later 
       if ($msession[5]=="CIS") {

          include("mssql_login.con");

       } else {

          include("mssql_login.con");

       }
	
$newpnum=0;          				   
//die($s[15]);
 
    if ($s[0]=="I"){
	    //insert 
		$s[1]=999; 
		
		IF (TRIM($s[10]) !=""){
   		    $sqlquery="insert into project(mpriority,mwho,pin,pstarted,pfinished,ptarget,mdesc,detail,status,nextremind,rtyp,rhour,rminute,rdow,rusers) 
	          VALUES ('$s[1]','$s[2]','$s[3]','$s[4]','$s[5]','$s[6]','$s[7]','$s[8]','$s[9]',CONVERT(datetime,'$s[10]'),$s[11],$s[12],$s[13],$s[14],'$s[15]')";
        } else {

	        $sqlquery="insert into project(mpriority,mwho,pin,pstarted,pfinished,ptarget,mdesc,detail,status,nextremind,rtyp,rhour,rminute,rdow,rusers) 
	          VALUES ('$s[1]','$s[2]','$s[3]','$s[4]','$s[5]','$s[6]','$s[7]','$s[8]','$s[9]',NULL,NULL,NULL,NULL,NULL,NULL)";
        }
	    mssql_query($sqlquery); //or die;   
	    sleep(2);
	  	    
        $sqlquery="select precnum from project order by precnum desc";
        $results= mssql_query($sqlquery) or die("getting data");
        $row=mssql_fetch_array($results);

        $newpnum=$row['precnum'];	       
	    
           
	    
	   
	    
    } else {   
     
	        //sleep(1);
	        
//[11]=proj_rtype 
//[12]=proj_rhour
//[13]=proj_rminute
//[14]=proj_rdow
	        
	        if (trim($s[9])=='Finished' || trim($s[9])=='Cancelled'){
		        // de-activate a project
		        $sqlquery="update project set mwho='$s[2]',
	        		pin='$s[3]',
	        		pstarted='$s[4]',
	        		pfinished='$s[5]',
	        		ptarget='$s[6]',
	        		mdesc='$s[7]',
	        		status='$s[9]',
	        		nextremind=NULL,
	        		rtyp=NULL,
	        		rhour=NULL,
	        		rminute=NULL,
	        		rdow=NULL,
	        		rusers=NULL,  
  	        		mpriority=NULL where mwho='$s[2]' AND precnum=$s[1]"; 
		            //die($sqlquery);
		            
	        } elseif (trim($s[16])=='Reactivate'){
		        //re-activate a project
		        
		        if (trim($s[10]) !=""){
			        
			       //blank reminder 
			       IF (TRIM($s[10]) !=""){
   		 
		            $sqlquery="update project set mwho='$s[2]',
	        		  pin='$s[3]',
	        		  pstarted='',
	        		  pfinished='',
	        		  ptarget='',
	        		  mdesc='$s[7]',
	        		  status='$s[9]',
	        		  nextremind =CONVERT(datetime, '$s[10]'),
	        		  rtyp=$s[11],
	        		  rhour=$s[12],
	        		  rminute=$s[13],
	        		  rdow=$s[14],
	        		  rusers='$s[15]',  
  	        		  mpriority=1 where mwho='$s[2]' AND precnum=$s[1]"; 
	        		} else {
		        		$sqlquery="update project set mwho='$s[2]',
	        			pin='$s[3]',
	        		  	pstarted='',
	        			pfinished='',
	        		  	ptarget='',
	        		  	mdesc='$s[7]',
	        		  	status='$s[9]',
	        		  	nextremind =NULL,
	        		  	rtyp=NULL,
	        		  	rhour=NULL,
	        		  	rminute=NULL,
	        		  	rdow=NULL,
	        		  	rusers=NULL,  
  	        		  	mpriority=1 where mwho='$s[2]' AND precnum=$s[1]"; 
		        		
		            }	
		        		
		        		  
	            } else {
		            
		            $sqlquery="update project set mwho='$s[2]',
	        		pin='$s[3]',
	        		pstarted='',
	        		pfinished='',
	        		ptarget='',
	        		mdesc='$s[7]',
	        		status='$s[9]',
	        		nextremind =NULL,
	        		rtyp=NULL,
	        		rhour=NULL,
	        		rminute=NULL,
	        		rdow=NULL,
	        		rusers=NULL,  
  	        		mpriority=1 where mwho='$s[2]' AND precnum=$s[1]"; 
		              
	             } //end of check for empty remind date    
	        } elseif ($s[0]=="R"){
		         // re-assign to new person 
		         //die("in reassign conditional");
		         if (trim($s[10]) !=""){
		            $sqlquery="update project set mwho='$s[16]',
	        		  pin='$s[17]',
	        		  pstarted='',
	        		  pfinished='',
	        		  ptarget='$s[6]',
	        		  mdesc='$s[7]',
	        		  status='Not Started',
	        		  nextremind =CONVERT(datetime, '$s[10]'),
	        		  rtyp=$s[11],
	        		  rhour=$s[12],
	        		  rminute=$s[13],
	        		  rdow=$s[14],
	        		  rusers='$s[15]',  
  	        		  mpriority=999 where mwho='$s[2]' AND precnum=$s[1]"; 
  	        		  //die($sqlquery);
	             } else {
		             //die($s[16]);
		              $sqlquery="update project set mwho='$s[16]',
	        		    pin='$s[17]',
	        		    pstarted='',
	        		    pfinished='',
	        		    ptarget='$s[6]',
	        		    mdesc='$s[7]',
	        		    status='Not Started',
	        		    nextremind =NULL,
	        		    rtyp=NULL,
	        		    rhour=NULL,
	        		    rminute=NULL,
	        		    rdow=NULL,
	        		    rusers=NULL,  
  	        		    mpriority=999 where mwho='$s[2]' AND precnum=$s[1]"; 
		             
	              } //end of check for empty date   
		             
		             
		           
            } else {
	            
	            if (trim($s[10]) !=""){
		            
	          	    $sqlquery="update project set mwho='$s[2]',
	        		  pin='$s[3]',
	        		  pstarted='$s[4]',
	        		  pfinished='$s[5]',
	        		  ptarget='$s[6]',
	        		  mdesc='$s[7]',
	        		  nextremind =CONVERT(datetime, '$s[10]'),
	        		  rtyp=$s[11],
	        		  rhour=$s[12],
	        		  rminute=$s[13],
	        		  rdow=$s[14],
	        		  rusers='$s[15]',
	        	      status='$s[9]' where mwho='$s[2]' AND precnum=$s[1]"; 
	        	      //die($sqlquery);
                 } else {
	                 
	                $sqlquery="update project set mwho='$s[2]',
	        		  pin='$s[3]',
	        		  pstarted='$s[4]',
	        		  pfinished='$s[5]',
	        		  ptarget='$s[6]',
	        		  mdesc='$s[7]',
	        		  nextremind=NULL,
	        		  rtyp=NULL,
	        		  rhour=NULL,
	        		  rminute=NULL,
	        		  rdow=NULL,
	        		  rusers=NULL,
	        	      status='$s[9]' where mwho='$s[2]' AND precnum=$s[1]"; 
	                  //die($sqlquery);
	                
                 }  //end of check for empty date  
	        	    
	        	      //die($sqlquery); 
           }
	       mssql_query($sqlquery); //or die; 
	       //die($sqlquery);  
	} 
    
	
	//clear out mpriority for finished projects
    $sqlquery="UPDATE PROJECT SET mpriority=NULL where (status='Finished' or status='Cancelled')";
    mssql_query($sqlquery) or die("error 2st load");
	
    mssql_close($sqlconnect);


  
if ($s[0]=="R"){ 
	
	
	include("mssql_login.con");
    $sqlquery="SELECT manager,manageremail,email FROM jointlogin where uname='$s[16]'";

    $results= mssql_query($sqlquery) or die;
    $row = mssql_fetch_array($results);

    $manager=trim($row['manager']);
    $manageremail=trim($row['manageremail']);
    $uemail=trim($row['email']);
    $uemail2='stephen@cisdirect.com';
    
    //die($uemail);
    mssql_close($sqlconnect);  

	   
	require("phpmailer/class.phpmailer.php");

	$mail = new PHPMailer();
	
	$mail->IsSMTP();                                   // send via SMTP
	$mail->Host     = "mail.cisdirect.com"; // SMTP servers
	$mail->Port     = "25";
	$mail->SMTPAuth = false;     // turn on SMTP authentication
	
	$mail->From     = $msession[13];
	$mail->FromName = $msession[4];
	$mail->AddAddress($uemail,$name=""); 
	$mail->AddCC($manageremail,$name="");
	$mail->AddBCC($uemail2,$name=""); 
	$mail->AddReplyTo($msession[13],$msession[4]);		
		
	    
	$mail->WordWrap = 50;                              // set word wrap
	$mail->IsHTML(true);                               // send as HTML
	
	$mail->Subject  = "Project re-assigned from " . $s[2] . " to " . $s[16] . ": " . $s[7];
	$mail->Body =  "<BR>" . "<BR><br><BR>Log Name: " . $msession[0] . "<BR>Login level : " . $msession[2] . "<BR>Department : " . $msession[3] . "<BR>User Name : " . $msession[4] . "<BR>CIS or CDS : " . $msession[5] . "<BR>Udomain : " . $msession[6];
	//took out detail because of long details need more elaborate programming and Randy said to skip it.
	$mail->AltBody  =  "\r\n" . "\r\nLog Name: " . $msession[0] . "\r\nLogin level : " . $msession[2] . "\r\nDepartment : " . $msession[3] . "\r\nUser Name : " . $msession[4] . "\r\nCIS or CDS : " . $msession[5] . "\r\nUdomain : " . $msession[6];
	
	
	if(!$mail->Send())
	{
	   die("Error sending email : " . $mail->ErrorInfo);
	}
    
    echo $s[16] . "|"  . $s[1] . "|" . $newpnum;
    
} else {  
   
echo $s[2] . "|"  . $s[1] . "|" . $newpnum;

}
?>

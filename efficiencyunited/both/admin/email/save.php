<?
include("../database.php");
$date=strtotime($_POST['date']);
$subject=$_POST['subject'];
$emailID=$_POST['emailID'];
$extra=$_POST['FCKeditor1'];
$thought=$_POST['FCKeditor2'];
$stamp=mktime();
if($emailID){
	$sql="update tblEmail set date='$date',subject='$subject',extra='$extra',thought='$thought',stamp='$stamp' where emailID='$emailID'";
}else{
	$sql="insert into tblEmail values ('','$date','$subject','$extra','$thought','$stamp')";
}
$result=db_query($sql);
header("location: ../show_emails.php");
?>
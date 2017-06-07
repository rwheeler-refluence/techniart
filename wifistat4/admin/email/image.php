<?
include("../database.php");
$email=$_GET['email'];
$emailID=$_GET['emailID'];
$type=$_GET['type'];
$im=imagecreate(1,1);
$white=imagecolorallocate($im,255,255,255);
imagesetpixel($im,1,1,$white);
header("content-type:image/jpg");
imagejpeg($im);
imagedestroy($im);

$stamp=mktime();
$sql="insert into tblEmailTrack values ('','$email','$emailID','$stamp','1','$type')";
$result=db_query($sql);

?>
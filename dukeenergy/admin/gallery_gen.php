<? #include("database.php"); ?>
<?
$filename="/home/httpd/vhosts/americanyogini.com/httpdocs/slideshow/images.xml";

$filehead.="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$filehead.="<gallery>\n\n";

$sql="select * from tblGalleryMaster where galleryPub='Yes' order by galleryID asc";
$result=db_query($sql);
while($row=mysql_fetch_array($result)){
	$galleryID=$row['galleryID'];
	$galleryName=$row['galleryName'];
	$galleryLoc=$row['galleryLoc'];
	$galleryPub=$row['galleryPub'];
	$galleryDesc=$row['galleryDesc'];
	$galleryTN=$row['galleryTN'];
	
	$filehead.="<album id=\"".$galleryID."\" title=\"".$galleryName."\" description=\"".$galleryDesc."\" lgPath=\"".$galleryLoc."/large/\" tnPath=\"".$galleryLoc."/thumbs/\" tn=\"".$galleryTN."\">\n";
		#grab images
		$sqlimages="select * from tblGalleryDetail where galleryID='$galleryID'";
		$resultimages=db_query($sqlimages);
		while($rowimages=mysql_fetch_array($resultimages)){
			$imgLoc=$rowimages['imgLoc'];
			$filehead.="<img src=\"".$imgLoc."\" />\n";
		}
	$filehead.="</album>\n\n\n";
}
$filehead.="</gallery>\n";
#write gallery
$towrite = $filehead;
$fh2 = fopen($filename, 'w+');
fwrite($fh2, $towrite);
fclose($fh2);

#echo($filehead);

?>
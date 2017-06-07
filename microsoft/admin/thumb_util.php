<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
include("resize.php");	
		$sql1="select * from tblGalleryMaster";
#print($sql);
		$result1=db_query($sql1);
		while ($row = mysql_fetch_array($result1)){
			$galleryLoc=$row['galleryLoc'];
			$galleryID=$row['galleryID'];
			$path="/home/httpd/vhosts/americanyogini.com/httpdocs/slideshow/".$galleryLoc."";
			$where_to_go="".$path."/large/";
			$thumb_to_go="".$path."/thumbs/";
			$tn_to_go="".$path."/tn/";
print("".$where_to_go."<br>");
print("".$thumb_to_go."<br>");
print("".$tn_to_go."<br>");
			if(!is_dir($where_to_go)){
				mkdir($where_to_go,0777);
			}
			if(!is_dir($thumb_to_go)){
				mkdir($thumb_to_go,0777);
			}
	#		CHMOD($thumb_to_go,0777);

			if(!is_dir($tn_to_go)){
				mkdir($tn_to_go,0777);
			}
	#		CHMOD($tn_to_go,0777);

			$sql2="select * from tblGalleryDetail where galleryID='$galleryID'";
			$result2=db_query($sql2);
			while ($row2=mysql_fetch_array($result2)) {
				$imgLoc=$row2['imgLoc'];
				$imgpath="/home/httpd/vhosts/americanyogini.com/httpdocs/slideshow/".$galleryLoc."/large/".$imgLoc."";
				$where_to_go="".$path."/large/";
						#get current dimensions
						list($width, $height) = getimagesize("".$imgpath."");
							if($height>50){
								$newwidth_divisor=50/$height;
								$height1=round($height*$newwidth_divisor);
								$width1=round($width*$newwidth_divisor);
							}

					#thumbnails
						copy($imgpath,$tn_to_go . $imgLoc);
		#				CHMOD($thumb_to_go . $_FILES['file']['name'][$h1],0777);
						makeimage($imgLoc,$imgLoc,$tn_to_go,$width1, $height1);
			}
		}
?>

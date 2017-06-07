<?
function createImages($firstname, $lastname, $image, $temp_image){	
	$image_path = "/var/www/vhosts/americanyogini.com/httpdocs/pix/";
$rootDir="/var/www/vhosts/americanyogini.com/httpdocs/";
        $image_relative_path = "pix/";
        $imagefilename= "p_" . strtolower($firstname) . strtolower($lastname) . ".jpg";
        $imagethumbfilename = "p_th_" . strtolower($firstname) . strtolower($lastname) . ".jpg";
        $fayImageName=$image_path . $imagefilename;
        $fayRelativeImage=$image_relative_path . $imagefilename;
        $fayThumbImageName=$image_path . $imagethumbfilename;
        $fayRelativeThumb=$image_relative_path . $imagethumbfilename;
        $image_temp = $image_path . $image;
        move_uploaded_file($temp_image, $image_temp);
        $size = GetImageSize("$image_temp");
        $width = $size[0];
        $height = $size[1];

        $target_width = floatval('214');
        $target_thumb_width = floatval('50');
        $target_height = $height * ($target_width/$width);
        $target_thumb_height = $target_height * ($target_thumb_width/$target_width);

        $image_214 = ImageCreateTrueColor($target_width,$target_height);
        $image_50 = ImageCreateTrueColor($target_thumb_width,$target_thumb_height);

        $image_orig = ImageCreateFromJpeg($image_temp);
        ImageCopyResized($image_214,$image_orig,0,0,0,0,$target_width,$target_height,$width,$height);
        ImageCopyResized($image_50,$image_orig,0,0,0,0,$target_thumb_width,$target_thumb_height,$width,$height);
        ImageJpeg($image_214,$fayImageName,100);
        ImageJpeg($image_50,$fayThumbImageName,100);

        ImageDestroy($image_214);
        ImageDestroy($image_50);
        ImageDestroy($image_orig);

	// delete uploaded file 
	unlink($image_temp);

	$images[0] = $fayRelativeImage;
	$images[1] = $fayRelativeThumb;
	return $images;
}

function scaleImage($form_variable,$new_filename,$dest_dir,$_FILES,$size,$wl){
	$new_width = 0;
	$new_length = 0;
	if ($wl=='w'){
		$new_width = $size;
	}
	elseif ($wl=='l'){
		$new_length = $size;
	}
	$tmp_file = $_FILES["$form_variable"]['tmp_name'];
	$new_file = $dest_dir . $_FILES["$form_variable"]['name'];
	move_uploaded_file($tmp_file,$new_file);
	$orig_size = GetImageSize("$new_file");
	$orig_width = $orig_size[0];	
	$orig_height = $orig_size[1];
	if ($new_width==0){
		$new_width = $orig_width * ($new_height/$orig_height);
	}
	elseif ($new_height==0){
		$new_height = $orig_height * ($new_width/$orig_width);
	}	
	$image_canvas = ImageCreateTrueColor($new_width,$new_height);
	$image_orig = ImageCreateFromJpeg($new_file);	
	ImageCopyResized($image_canvas,$image_orig,0,0,0,0,$new_width,$new_height,$orig_width,$orig_height);
	ImageJpeg($image_canvas,$new_filename,100);
	ImageDestroy($image_canvas);		
	ImageDestroy($image_orig);
	
}
?>

<?php
include("database.php");
$sort=$_GET['sort'];
$category=urldecode($_GET['category']);
	$sql="select * from tblSort where category='$category'";
	$result=db_query($sql);
	if(count($result)<1){
		$sql1="insert into tblSort values ('','$category','$sort')";
	}else{
		$sql1 = "UPDATE tblSort SET sort = $sort WHERE sortID = $category";
	}
#	print($sql);
#	mail($to="george@crucialnetworking.com","query",$sql1,"From:webmaster@techniart.com");
	$result1=db_query($sql1);
?>
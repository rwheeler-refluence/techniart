<? include("database.php");?>
<?
$zipcode=$_POST['zipcode'];
$redir=$_POST['redir'];
$redir1=$_POST['redir1'];
$_SESSION['zip']=$zipcode;
$sql="select * from tblTerritory where zip='$zipcode'";
#print("".$sql."<br>");
$result=db_query($sql);
$countzip=mysql_num_rows($result);
if($countzip>0){
	$_SESSION['zip_qualify']=$zipcode;
	while($rowzip=mysql_fetch_array($result)){
		$vendor=$rowzip['vendor'];
#		print("vendor:".$vendor."<br>");
		if($vendor>'9'){
			$_SESSION['st']="alt";
		}else{
			if($vendor=='9'){
				$_SESSION['st']="NJ";
			}else{
				if($vendor=='1'){
					$_SESSION['clp']="yes";
				}else{
					$_SESSION['clp']="no";
				}
				$_SESSION['st']="CT";
			}
		}
	}
}else{
	$_SESSION['zip_qualify']="";
}
#		print("sess:".$_SESSION['st']."<br>");
if($vendor=='30'){header("location:store-cat.php?cat=LED%20Products");}
if($vendor<'1'){header("location:sorry.php");}
?>
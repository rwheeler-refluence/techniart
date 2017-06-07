<? include("database.php"); ?>
<? include("secure.php"); ?>
<?
$ID=$_GET['ID'];
$cat=$_GET['cat'];
if($ID){
	$act=$_GET['act'];
	if($act=='pub'){
		$sql="update tblProducts_entergy set productPub='Yes' where productID='$ID'";
	}else{
		$sql="update tblProducts_entergy set productPub='No' where productID='$ID'";
	}
	$result=db_query($sql);
header("location:show_products.php?cat=".$cat."");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Techniart, Inc.</title>

<link rel="STYLESHEET" type="text/css" href="stylesheet.css">
<SCRIPT LANGUAGE="Javascript">
<!---
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery.tablednd_0_5.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	// Initialise the first table (as before)
//	$("#table-1").tableDnD();


	// Initialise the second table specifying a dragClass and an onDrop function that will display an alert
	$("#table-2").tableDnD({
	// Make a nice striped effect on the table
//	$("#table-2 tr:even').addClass('alt')");
	    onDragClass: "myDragClass",
	    onDrop: function(table, row) {
            var rows = table.tBodies[0].rows;
            var debugStr = "Row dropped was "+row.id+". New order: ";
            for (var i=0; i<rows.length; i++) {
                debugStr += rows[i].id+" ";
				$("#info").load("process-sortable-cats.php?sort="+i+"&category="+rows[i].id);
            }
	        $("#info").html(debugStr);
	    },
		onDragStart: function(table, row) {
			$("#info").html("Started dragging row "+row.id);
		}
	});
});
</script>
</head>

<BODY>

<!-- ------------------------------begin header------------------------------ -->
<? include("header.php"); ?>
<!-- ------------------------------end header------------------------------ -->

<!-- begin navigation/body -->
<? include("body_top.php"); ?>

<table width="671" border="0" cellspacing="0" cellpadding="0"><tr>
<td><span class="title_main_sub">Products:</span>&nbsp;&nbsp;<span class="title_sub_level2">Category Sort</span></td>
<td align="right">&nbsp;</td>
</tr><tr>
<td colspan="2"><img src="pix/pix_6e88a5.gif" alt="" width="671" height="1" border="0"><br>
<img src="pix/pix_trans.gif" alt="" width="1" height="10" border="0"><br>

<!-- BEGIN insert WYSIWYG or all other forms, etc. here -->
<span class="body_content"><i>(To sort, simply click next to a category name in a row, drag, and drop the row where you'd like it to appear - the sort order will update automatically)</i></span>
<?
print("<br>\n");

		$sql="select distinct tblProducts_entergy.category from tblProducts_entergy LEFT OUTER JOIN tblSort on tblProducts_entergy.category=tblSort.category order by tblSort.sort asc";
		$result=db_query($sql);
		$count=mysql_num_rows($result);
		if(!$count){
			print("<span class=\"body_content\">No entries in database<br>\n");
		}else{
		print("<div id=\"info\" style=\"display:none;height:150px;border:1px dotted #000000;\"></div>\n");
		print("<table id=\"table-2\" width=\"99%\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\"><tr valign=\"top\" bgcolor=\"#eaeef4\">");
		print("<td><span class=\"body_content\"><b>Category Name</b></span></td>\n");
		print("</tr>\n");
		$i=1;
		while($row=mysql_fetch_array($result)){
			$category=$row['category'];
			$sql1="select * from tblSort where category='$category'";
		#	print($sql1."<br>");
			$result1=db_query($sql1);
			$cnt=mysql_num_rows($result1);
			if($cnt<1){
				print("Made it<br>");
				$sqllast="select * from tblSort order by sort desc limit 1";
				$resultlast=db_query($sqllast);
				while($rowlast=mysql_fetch_array($resultlast)){
					$last=$rowlast['sort'];
					$lastplus=$last++;
				}
				$sql1a="insert into tblSort values ('','$category','$lastplus')";
				print($sql1a."<br>");
				$result1a=db_query($sql1a);
				$next=mysql_insert_id();
				$sortID=$next;
			}else{
				while($row1=mysql_fetch_array($result1)){
					$sortID=$row1['sortID'];
				}
			}
			print("<tr bgcolor=\"eaeef4\" id=\"".$sortID."\">\n");
			print("<td><span class=\"body_content\">".$category."</span></td>");
			print("</tr>\n");
			$i++;
		}
		print("</table><br>");
}
?><br><!-- END insert WYSIWYG or all other forms, etc. here -->

<? include("body_bot.php"); ?>

</body>
</html>
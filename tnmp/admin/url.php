<? include("database.php"); ?>
<? include("secure.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<script type="text/javascript">
function select_all()
{
var text_val=eval("document.form1.url");
text_val.focus();
text_val.select();
}
</script>
</HEAD>

<BODY topmargin="4" leftmargin="4" marginheight="4" marginwidth="4">
<?
$ID=$_GET['ID'];
$url="http://www.americanyogini.com/minigreenjuicecleanse.php?ref=".$ID."";?>
<form id="form1" name="form1">
<textarea name="url" id="url" rows="2" cols="45" onClick="select_all();"><? echo($url); ?></textarea>
</form>


</BODY>
</HTML>

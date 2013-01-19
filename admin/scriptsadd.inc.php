<script language="JavaScript">
<!--
/*function AddFromSearche(engN, type, file)
{
	var helpWnd=window.open(file+"&engN="+engN+"&type="+type,"Searcher");//,"scrollbars=yes,dependent=yes");
}*/

function calendar(i,field)
{
	cd=window.open("cal.php?m=<?print date("n")?>&y=<?print date("Y")?>&n="+i+"&f="+field,"cd","height=171,width=165,screenX=500,screenY=300,left=500,top=300,toolbar=0,scrollbars=0,menubar=0,resizable=yes");
// debug	cd=window.open("cal.php?m=<?print date("n")?>&y=<?print date("Y")?>&n="+i+"&f="+field,"cd");
}
// -->
</script>

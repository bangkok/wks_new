<?
/**
 * Admin utility appraisal stats viewer
 */

require ("../conf.inc.php");
$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);
authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host']) 
{
	print($ErrorAccessRight);
	exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?print $SystemDataAdministrationConf?> :: <?print $TitleTabStat?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
</head>
<script language="JavaScript">
<!--
/*function AddFromSearche(engN, type, file)
{
	var helpWnd=window.open(file+"&engN="+engN+"&type="+type,"Searcher");//,"scrollbars=yes,dependent=yes");
}*/

function calendar(i,field)
{
	cd=window.open("../cal.php?m=<?print date("n")?>&y=<?print date("Y")?>&n="+i+"&f="+field,"cd","height=171,width=165,screenX=500,screenY=300,left=500,top=300,toolbar=0,scrollbars=0,menubar=0,resizable=yes");
// debug	cd=window.open("cal.php?m=<?print date("n")?>&y=<?print date("Y")?>&n="+i+"&f="+field,"cd");
}
// -->
</script>

<?print $body?>

<?
if($l=="" && $sub=="")
{
?>

<!-- <div align="center"><br />
<?
$query = "SELECT DISTINCT(rsur) FROM mkrs";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
print "<b>���������� �������������:</b><br>";
while($row = mysql_fetch_array($result))
{
	print "<a href=\"appraisal_stats.php?l=".$row[0]."\">".$row[0]."</a><br>";
}
?>
</div> -->
<div align="center"><br /><b>����� �� ������:</b>
<form method="post" action="appraisal_stats.php" name=sendmessage>
<?
$query = "SELECT DISTINCT(rsur) FROM mkrs";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
print "������������: <select name=usr>";
print "<option value=\"---\">���</option>";
while(list($rsur) = mysql_fetch_row($result))
{
		print "<option value=\"$rsur\">$rsur</option>";
}
print "</select>";
?>
	� <input type="text" name="fields[first]" size=10/>&nbsp;<a href="javascript:calendar(2,'first');"><img src="../img/cal.gif" border=0 alt="" align=center></a>
	�� <input type="text" name="fields[second]" size=10/>&nbsp;<a href="javascript:calendar(2,'second');"><img src="../img/cal.gif" border=0 alt="" align=center></a>
	<input type="submit" name=sub value="��������" />
</form>
</div>
<?
}
else if ($sub!="")
{
?>

<div align="center"><br />
<?
if ($usr!='---')
	$query = "SELECT rsur, rsdt, rstxo, rstp, rsip FROM mkrs WHERE rsur='$usr' AND SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]'";
else
	$query = "SELECT rsur, rsdt, rstxo, rstp, rsip FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
print "����� �� ����������� �������� �� ������ � <b>$fields[first]</b> �� <b>$fields[second]</b>:<br /><br />";
print "<table border=0 cellspacing=1 cellpadding=2>";
print "<tr bgcolor=#cccccc>";
print "<td align=center>";
print "<b>�</b>";
print "</td>";
print "<td align=center>";
print "<b>����� ������������</b>";
print "</td>";
print "<td align=center>";
print "<b>���� � ����� �������</b>";
print "</td>";
print "<td align=center>";
print "<b>������� ���-�� �������</b>";
print "</td>";
print "<td align=center>";
print "<b>��� �������</b>";
print "</td>";
print "<td align=center>";
print "<b>IP</b>";
print "</td>";
print "</tr>";
while($row = mysql_fetch_array($result))
{
	$i++;
	if ($i % 2 == 0) 
		$bg='#ffffff';
	else
		$bg='#dddddd';
	print "<tr bgcolor=$bg>";
	print "<td>";
	print $i;
	print "</td>";
	print "<td>";
	print $row[0];
	print "</td>";
	print "<td>";
	print $row[1];
	print "</td>";
	print "<td>";
	print $row[2];
	print "</td>";
	print "<td>";
	print $row[3];
	print "</td>";
	print "<td>";
	print $row[4];
	print "</td>";
	print "</tr>";
}
print "</table>";
?>
</div>

<div align="center"><br />
<?
if ($usr!='---')
	$query = "SELECT DISTINCT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='$usr'";
else
	$query = "SELECT DISTINCT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
print "<table border=0 cellspacing=1 cellpadding=2>";
print "<tr bgcolor=#cccccc>";
print "<td align=center>";
print "<b>�����</b>";
print "</td>";
print "<td align=center>";
print "<b>�������� �� ��.</b>";
print "</td>";
print "<td align=center>";
print "<b>�������� �� ���.</b>";
print "</td>";
print "<td align=center>";
print "<b>�������� �� ���.</b>";
print "</td>";
print "<td align=center>";
print "<b>�������� �� ���. ��.</b>";
print "</td>";
print "<td align=center>";
print "<b>�����</b>";
print "</td>";
print "</tr>";
while($row = mysql_fetch_array($result))
{
	if ($usr!='---')
		$query = "SELECT COUNT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='".$row[0]."' AND rstp='��.' AND rsur='$usr' GROUP BY rsur";
	else
		$query = "SELECT COUNT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='".$row[0]."' AND rstp='��.' GROUP BY rsur";
	$result2 = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
	if($row2 = mysql_fetch_array($result2))
	{
		$r[0] = $row2[0];
	}
	else
	{
		$r[0] = 0;
	}
	if ($usr!='---')
		$query = "SELECT COUNT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='".$row[0]."' AND rstp='���.' AND rsur='$usr' GROUP BY rsur";
	else
		$query = "SELECT COUNT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='".$row[0]."' AND rstp='���.' GROUP BY rsur";
	$result2 = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
	if($row2 = mysql_fetch_array($result2))
	{
		$r[1] = $row2[0];
	}
	else
	{
		$r[1] = 0;
	}
	if ($usr!='---')
		$query = "SELECT COUNT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='".$row[0]."' AND rstp='���.' AND rsur='$usr' GROUP BY rsur";
	else
		$query = "SELECT COUNT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='".$row[0]."' AND rstp='���.' GROUP BY rsur";
	$result2 = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
	if($row2 = mysql_fetch_array($result2))
	{
		$r[2] = $row2[0];
	}
	else
	{
		$r[2] = 0;
	}
	if ($usr!='---')
		$query = "SELECT COUNT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='".$row[0]."' AND rstp='���.' AND rsur='$usr' GROUP BY rsur";
	else
		$query = "SELECT COUNT(rsur) FROM mkrs WHERE SUBSTRING(rsdt,1,10)>='$fields[first]' AND SUBSTRING(rsdt,1,10)<='$fields[second]' AND rsur='".$row[0]."' AND rstp='���.' GROUP BY rsur";
	$result2 = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
	if($row2 = mysql_fetch_array($result2))
	{
		$r[3] = $row2[0];
	}
	else
	{
		$r[3] = 0;
	}
	
	
	$i++;
	if ($i % 2 != 0) 
		$bg='#ffffff';
	else
		$bg='#eeeeee';
	print "<tr bgcolor=$bg>";
	print "<td>";
	print $row[0];
	$s1++;
	print "</td>";
	print "<td>";
	print $r[0];
	$s2 += $r[0];
	print "</td>";
	print "<td>";
	print $r[1];
	$s3 += $r[1];
	print "</td>";
	print "<td>";
	print $r[2];
	$s4 += $r[2];
	print "</td>";
	print "<td>";
	print $r[3];
	$s5 += $r[3];
	print "</td>";
	print "<td>";
	print $r[0] + $r[1] + $r[2] + $r[3]; 
	$s6 += $r[0] + $r[1] + $r[2] + $r[3];
	print "</td>";
	print "</tr>";
}
print "<tr bgcolor=#ffffff>";
print "<td colspan=6 height=5>";
print "</td>";
print "</tr>";

print "<tr bgcolor=#cccccc>";
print "<td><b>";
print $s1;
print "</b></td>";
print "<td><b>";
print $s2;
print "</b></td>";
print "<td><b>";
print $s3;
print "</b></td>";
print "<td><b>";
print $s4;
print "</b></td>";
print "<td><b>";
print $s5;
print "</b></td>";
print "<td><b>";
print $s6;
print "</b></td>";
print "</tr>";
print "</table>";
?>
</div><br />
<hr><font color=black size=1>���� �������� ���������� �� ������ ������ � ����� <a href="http://www.realnest.com.ua/">http://www.realnest.com.ua/</a><br>
���� ���������: <?print date("d.m.Y");?><br /><br />
���������� ������� - (056) 790-02-77</font>
<?
}
?>
</body>
</html>
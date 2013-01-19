<?
/*
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */
 
 
/**
 * Admin utility navigator frame
 */

require ("conf.inc.php");

$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
mysql_select_db($base);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);

authorize('n');
include("header.inc.php");
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host'] && $op!='sv') 
{
	print($ErrorAccessRight);
	exit;
}
include("header.inc.php");
?>
</head>
<?print $body?>
<script language="JavaScript">
<!--
	if (self.parent.frames.length == 0)
		self.parent.location='index.php';
//-->
</script>

<br>
<?/*<div align=center><a href="#" target=_blank><img src="img/logo_nailer.gif" width=100 height=30 border=0 alt="Nailer"></a></div>*/?>

<hr>
<li><font class=b><a href="first.php" target=main><?print $RegulationUseNav?></a></font>
<hr>
<li><font class=b><a href="index.php?del=y" target=_top><?print $ExitNav?></a></font>
<hr>
<?

$query="SELECT adsu FROM nrad WHERE adid='$PHP_AUTH_USER'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
list($adsu) = mysql_fetch_row($result);

if ($adsu=='y')
{
print "<font class=b><b>".$DevelopNav."</b></font><br><br>";
?>
<a href="nr.php?t=nrtb&op=s" target=main><li><font class=b><a href="tools/pg_installer.php" target=main><?print $ModulesNav?></a></font><li><font class=b><a href="tools/table_editor.php" target=main><?print $EditTablesNav?></a></font><li><font class=b><a href="tools/csd.php" target=main><?print $CleanTablesNav?></a></font><li><font class=b><a href="tools/sql_query.php" target=main><?print $SQLQueryNav?></a></font><br><a href="nr.php?t=nrtb&op=s" target=main><img src="img/view_n.gif" width=17 height=15 border=0 alt="<?print $ViewNav?>" align=center></a> <font class=b><a href="nr.php?t=nrtb" target=main><?print $TablesNav?></a></font><br><a href="nr.php?t=nrcf&op=s" target=main><img src="img/view_n.gif" width=17 height=15 border=0 alt="<?print $ViewNav?>" align=center></a> <font class=b><a href="nr.php?t=nrcf" target=main><?print $TablesConfigNav?></a></font><br><a href="nr.php?t=nrfs&op=s" target=main><img src="img/view_n.gif" width=17 height=15 border=0 alt="<?print $ViewNav?>" align=center></a> <font class=b><a href="nr.php?t=nrfs" target=main><?print $RegulationUseNav?></a></font><hr>
<?
}

$query="SELECT COUNT(*) FROM nrnv, nrur WHERE urrl=nvrl AND urad='$PHP_AUTH_USER'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
if(list($cnt) = mysql_fetch_row($result))
{
	if ($cnt>0)
		$query="SELECT nvid, nvrl, nvnm, nvvr, nvtb, nvad FROM nrnv LEFT JOIN nrur ON nvrl=urrl WHERE (nvrl='$PHP_AUTH_ROLE' OR urad='$PHP_AUTH_USER') ORDER BY nvrl, nvid";
	else
		$query="SELECT nvid, nvrl, nvnm, nvvr, nvtb, nvad FROM nrnv WHERE nvrl='' ORDER BY nvid";

	$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
	while(list($nvid, $nvrl, $nvnm, $nvvr, $nvtb, $nvad) = mysql_fetch_row($result))
	{
		if ($nvtb!='nrtb' && $nvtb!='nrcf' && $nvtb!='nrfk' && $nvtb!='nrfs' && $nvtb!='nrln' && $nvad!='tools/csd.php' && $nvad!="tools/pg_installer.php" && $nvad!="tools/sql_query.php")
		{
			if ($nvvr=='t')
			{
				print "<br><a href=\"nr.php?t=$nvtb$nvad&op=s\" target=main><img src=\"img/view_n.gif\" width=17 height=15 border=0 alt=\"��������\" align=center></a> <font class=b><a href=\"nr.php?t=$nvtb$nvad\" target=main>$nvnm</a></font>";
			}
			elseif ($nvvr=='c')
			{
				print "<li><font class=b><a href=\"pg/catalog_$language/nrcl.php?t=$nvtb$nvad\" target=main>$nvnm</a></font>";
			}
			elseif ($nvvr=='l')
			{
				print "<font class=b><b>"."$nvnm"."</b></font><br>";
			}
			elseif ($nvvr=='o')
			{
				print "<li><font class=b><a href=\"$nvad\" target=main>$nvnm</a></font>";
			}
			elseif ($nvvr=='s')
			{
				print "<hr>";
			}
		}
	}
}
?>
<br><br><br><hr>
<?
//include("copy.inc.php");
?>
</body>
</html>
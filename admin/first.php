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
 * Admin utility default page
 */

require ("conf.inc.php");

$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
mysql_select_db($base);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);

authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host']) 
{
	print($ErrorAccessRight);
	exit;
}

$query="DELETE FROM nrlg WHERE (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lgdt))>604800";
@mysql_db_query($base,$query);
?>


<!doctype HTML Public "-//w3c//dtd html 4.0 Transitional//en">
<html>
<head>
<title><?print $SystemDataAdministrationConf?> :: <?print $DescriptionF?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
</head>
<?print $body?>
<div align=center>
<table width=80%>
<tr>
	<td><div align=center><h4><?print $RegulationAdminUse?></h4></div>
<?
$query="SELECT fstx FROM nrfs ORDER BY fsid";
if ($result = mysql_db_query($base,$query))
{
	while(list($fstx) = mysql_fetch_row($result))
	{
		print "<li> $fstx";
		print "<br><br>";
	}
}
?>	
	</td>
</tr>
<tr>
	<td><br><br><div align=center><h4><!-- ������������ ����������. --></h4></div></td>
</tr>
</table>
</div>
</body>
</html>
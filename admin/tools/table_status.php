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
 * Admin utility table sql status viewer
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

<?print $body?>

<div align="center">
<?
$query = "SHOW TABLE STATUS LIKE '$t'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
if($row_ad = mysql_fetch_array($result))
{
	print "<table border=0 cellspacing=1 cellpadding=2>";

	print "<tr bgcolor=$bg3>";
	print "<td>";
	print $TypeTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Type'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg4>";
	print "<td>";
	print $Row_formatTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Row_format'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg3>";
	print "<td>";
	print $RowsTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Rows'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg4>";
	print "<td>";
	print $Avg_row_lengthTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Avg_row_length'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg3>";
	print "<td>";
	print $Data_lengthTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Data_length'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg4>";
	print "<td>";
	print $Max_data_lengthTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Max_data_length'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg3>";
	print "<td>";
	print $Index_lengthTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Index_length'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg4>";
	print "<td>";
	print $Data_freeTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Data_free'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg3>";
	print "<td>";
	print $Auto_incrementTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Auto_increment'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg4>";
	print "<td>";
	print $Create_timeTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Create_time'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg3>";
	print "<td>";
	print $Update_timeTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Update_time'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg4>";
	print "<td>";
	print $Check_timeTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Check_time'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg3>";
	print "<td>";
	print $Create_optionsTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Create_options'];
	print "</td>";
	print "</tr>";

	print "<tr bgcolor=$bg4>";
	print "<td>";
	print $CommentTabStat;
	print "</td>";
	print "<td>";
	print $row_ad['Comment'];
	print "</td>";
	print "</tr>";


	print "</table>";
}
?>
<br>
<?
print "<a href=\"javascript:history.go(-1)\">".$BackTabStat."</a>";
?>
</div>

</body>
</html>
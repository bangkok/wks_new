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
 * Admin utility plagins creator
 */

require ("../conf.inc.php");

$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);
authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host'] && $op!='sv') 
{
	print($ErrorAccessRight);
	exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?print $SystemDataAdministrationConf?> :: <?print $TitlePGInst?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
</head>
<?print $body?>
<script language="JavaScript">
<!--
	if (self.parent.frames.length == 0)
		self.parent.location='index.php';
//-->
</script>
<?
$query="SELECT adsu FROM nrad WHERE adid='$PHP_AUTH_USER'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
list($adsu) = mysql_fetch_row($result);

if ($adsu=='y')
{
	print "� ����������";
}
else
{
	print $AccessDeny;
}
?>
</body>
</html>
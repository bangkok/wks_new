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
 * Admin utility deleter form
 */

require ("../conf.inc.php");
$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);
if (isset($sub) && $sub==$ResetDelFT)
	if ($dl=='on')
		$operation='dt';

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
<title><?print $SystemDataAdministrationConf?> :: <?print $TitleDelFT?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">

<SCRIPT LANGUAGE="JavaScript">
<!--
function cl()
{
	window.close(this);
}
//-->
</SCRIPT>

</head>

<?print $body?>
<div align=center>
<font>
<?
if (!isset($sub) || $sub!=$ResetDelFT)
{
?>
<h3><?print $YouSureDelFT?> &quot;<?print $t?>&quot;?</h3>
<form action="<?print basename($PHP_SELF)?>" method=post>
<?print $YesDelFT?> <input type=checkbox name=dl><br>
<input type=hidden name=t value="<?echo $t?>">
<input type=submit name=sub value="<?print $ResetDelFT?>" class=button>
</form>
<?
}
else
{
	if ($dl=='on')
	{
		$query="DELETE FROM $t";
		mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);

		print "<script language=\"JavaScript\">
		<!--
		cl();
		//-->
		</script>";
		print '<div align=center><a href="#" OnClick="cl();";>'.$CloseWinDelFT.'</a></div>';
	}
}
?>
</font>
</div>
</body>
</html>
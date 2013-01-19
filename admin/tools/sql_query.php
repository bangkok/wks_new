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
 * Admin utility sql query module
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
<title><?print $SystemDataAdministrationConf?> :: <?print $TitleSQLQ?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
</head>
<?print $body?>
<script language="JavaScript">
<!--
	if (self.parent.frames.length == 0)
		self.parent.location='index.php';
//-->
</script><br>
<?
$query="SELECT adsu FROM nrad WHERE adid='$PHP_AUTH_USER'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
list($adsu) = mysql_fetch_row($result);

if ($adsu=='y')
{
?>
<div align="center">
<b><?print $QuerySQLQ?></b><br><br>
<?
if ($ident>0 && isset($query_my) && $query_my!="" && $sub==$ExecuteSQLQ) 
{
	$time=time();
	
	echo $Text1SQLQ.' <b>'.$server.'</b> '.$Text2SQLQ.'<br><br>';
	$query_my = trim(stripslashes($query_my)).";";
	echo '<i>'.$query_my.'<br><br></i>';

	$data = explode(chr(10),$query_my);
	$query_my = "";
	foreach ($data as $line)
	{
		$line = trim($line);
		if ($line!="" && substr($line, 0, 1)!="#")
		{
			$query_my .= $line;
			if (substr($line,-1)==";")
			{
				$query_my = substr($query_my, 0, -1);
				
				if($result = mysql_db_query($base,$query_my))
				{
					$is_select = eregi('^SELECT[[:space:]]+', $query_my);
					$is_show = eregi('^SHOW[[:space:]]+', $query_my);
					$is_explain = eregi('^EXPLAIN[[:space:]]+', $query_my);
					if ($is_select || $is_show || $is_explain)
					{
						$tmp=0;
						echo '<table border=0>';
						$num_fields = mysql_num_fields($result);
				
						print "<tr bgcolor=$bg2>";
						for ($a=0;$a<$num_fields;$a++)
						{
							echo '<td><b>'.mysql_field_name($result, $a).'</b></td>';
						}
						echo '</tr>';

						while($row = mysql_fetch_array($result)) 
						{
							if (($tmp%2)==0)
								print "<tr bgcolor=$bg3>";
							else
								print "<tr bgcolor=$bg4>";
							for ($i=0;$i<$num_fields;$i++)
							{
								  echo '<td>'.$row[$i].'</td>';
							}
							echo '</tr>';
							$tmp++;
						}
						echo '</table>';
					}
					echo "<br>".$Text3SQLQ."<br>";
				}
				else
				{
					echo '<b>'.mysql_errno().' - '.mysql_error().'</b><br>';
					echo $Text4SQLQ."<br>";
				}

				$query_my = "";
			}
		}
	}
	$time=time()-$time;
	echo "<br><br>$Text5SQLQ - ".$time." $Text6SQLQ";
	echo '<hr>';
}
if (!isset($query_my)) $query_my = "";
?>
<form method=post action="sql_query.php">
<textarea name=query_my rows=10 cols=45><?print stripslashes($query_my)?></textarea><br>
<input type=submit name=sub value="<?print $ExecuteSQLQ?>" class=button>&nbsp;<input type=reset value="<?print $ResetSQLQ?>" class=button>
</form>
</div>
<?
}
else
{
	print $AccessDeny;
}
?>
</body>
</html>
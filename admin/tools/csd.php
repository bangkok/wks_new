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
 * Admin utility Clean Sweep Device module
 */

include "../conf.inc.php";
$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);
if (isset($sub) && $sub==$DelCSD)
	$operation='cl';

authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host']) 
{
	print($ErrorAccessRight);
	exit;
}
?>

<html>
<head>
<title><?print $SystemDataAdministrationConf?> :: <?print $TitleCSD?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
</head>
<?print $body?>
<?
$query="SELECT adsu FROM nrad WHERE adid='$PHP_AUTH_USER'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
list($adsu) = mysql_fetch_row($result);

if ($adsu=='y')
{
print "<div align=center><table border=0 cellspacing=0 cellpadding=0 height=100%><tr><td width=700 valign=top>";
?>
<div align=center>
<?
if (isset($sub) && ($sub==$ResetCSD || $sub==$ViewCSD || $sub==$HowMCSD))
{
	$t1=$t1_;
	$t2=$t2_;
	$f2=$f1_;
	$f1=$f2_;
	if ($t1!="" && $t2!="" && $f1!="" && $f2!="")
	{
		if ($sub==$ResetCSD)
		{
			$query="SELECT `$t1`.`$f1` FROM `$t1` LEFT JOIN `$t2` ON `$t1`.`$f1`=`$t2`.`$f2` WHERE `$t2`.`$f2` IS NULL";
			if ($result = mysql_db_query($base,$query))
				while (list($ff) = mysql_fetch_row($result))
				{
					$query="DELETE FROM `$t1` WHERE `$f1`='$ff'";
					mysql_db_query($base,$query);
				}
			$query="OPTIMIZE TABLE `$t1`";
			$result = mysql_db_query($base,$query);
		}
		elseif ($sub==$ViewCSD)
		{
			$query="SELECT `$t1`.`$f1` FROM `$t1` LEFT JOIN `$t2` ON `$t1`.`$f1`=`$t2`.`$f2` WHERE `$t2`.`$f2` IS NULL";
			if ($result = mysql_db_query($base,$query))
			{
				print "<center>";
				while (list($ff) = mysql_fetch_row($result))
				{
					print $ff."<br>";
				}
				print "</center>";
				print "<hr>";
			}
		}
		else
		{
			$query="SELECT count(`$t1`.`$f1`) FROM `$t1` LEFT JOIN `$t2` ON `$t1`.`$f1`=`$t2`.`$f2` WHERE `$t2`.`$f2` IS NULL";
			if ($result = mysql_db_query($base,$query))
			{
				list($f) = mysql_fetch_row($result);
				print "<h4>$Text1CSD ".$t1." $Text2CSD - <b>$f</b> $Text3CSD ".$t2."</h4>";
			}
		}
	}
}
else
{
	$query="SELECT cfen, cftb, cffl, cfenf FROM nrcf WHERE cfen NOT IN ('nrtb', 'nrad', 'nrcf', 'nrfk', 'nrnv', 'nrcr ')";
	$result0 = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
	$i=0;
	while(list($cfen, $cftb, $cffl, $cfenf) = mysql_fetch_row($result0))
	{
		$t1=$cfen;
		$t2=$cftb;
		$f2=$cffl;
		$f1=$cfenf;

		if ($t1!="" && $t2!="" && $f1!="" && $f2!="")
		{
			$query="SELECT count(`$t1`.`$f1`) FROM `$t1` LEFT JOIN `$t2` ON `$t1`.`$f1`=`$t2`.`$f2` WHERE `$t2`.`$f2` IS NULL";
			if ($result = mysql_db_query($base,$query))
			{
				list($f) = mysql_fetch_row($result);
				if ($f!='0')
				{
					print "<br><b>$Text1CSD ".$t1." $Text2CSD - <b>".$f."</b> $Text3CSD ".$t2;
					print " <a href=\"csd.php?t1_=".$t1."&t2_=".$t2."&f1_=".$f1."&f2_=".$f2."&sub=".$ResetCSD."\"><font color=red>".$ResetCSD."</font></a>"."</b>";
				}
			}
		}
	}
}
if (!isset($t1_)) $t1_ = "";
if (!isset($f1_)) $f1_ = "";
if (!isset($t2_)) $t2_ = "";
if (!isset($f2_)) $f2_ = "";
?>
<br><br><form method=post action="csd.php">
<?print $Text4CSD?> <input type=text name=t1 value="<?echo $t1_?>"><br>
<?print $Text5CSD?> <input type=text name=f1 value="<?echo $f1_?>"><br>
<?print $Text6CSD?> <input type=text name=t2 value="<?echo $t2_?>"><br>
<?print $Text7CSD?> <input type=text name=f2 value="<?echo $f2_?>"><br>
<input type=submit value="<?print $HowMCSD?>" name=sub class=button> <input type=submit value="<?print $ViewCSD?>" name=sub class=button> <input type=submit value="<?print $ResetCSD?>" name=sub class=button>
</form>
<?}
else
{
	print $AccessDeny;
}
?>
</body>
</html>
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
 * Admin utility Restore module
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

@set_time_limit($ExecTimeLimit);

$query="SELECT adsu FROM nrad WHERE adid='$PHP_AUTH_USER'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
list($adsu) = mysql_fetch_row($result);

if ($adsu=='y' || 1==1) // need modify
{
	if($sub==$ButtonRest)
	{
		$outBuffer .= "<br><div align=center><b>$RestoreMessageTitleRest</b><br>";
		$error = false;

		if ($backups!="" && $file_name!="")
		{
			$outBuffer .= "<br>$ErrorBothRest";
			$error = true;
		}
		if ($backups=="" && $file_name=="")
		{
			$outBuffer .= "<br>$ErrorNoFileRest";
			$error = true;
		}

		if (!$error)
		{
			@ini_set("memory_limit", $MemoryLimit);
			if ($backups!="")
			{
				$file = "../backups/".$backups;
				$file_name = $backups;
			}

			if (!eregi(".\.sql$",$file_name) && !eregi(".\.bz2$",$file_name) && !eregi(".\.gz$",$file_name))
			{	
				$outBuffer .= "<br>$ErrorInvalidFileExt1Rest <b>($file_name)</b>.<br>$ErrorInvalidFileExt2Rest";
				$error = true;
			}
			
			if (!$error)
			{
				if (substr($file_name, -4) == ".sql")
				{
					$fp = fopen($file,"r");
					if ((!$fp) || filesize($file)==0)
					{
						$outBuffer .= "<br>$ErrorReadingFile1Rest <b>($file_name)</b> $ErrorReadingFile2Rest";
						$error = true;
					}
					else
					{
						$content = fread($fp, filesize($file));
						fclose($fp);
					}
				}
				elseif (substr($file_name, -3)==".gz")
				{
					if (function_exists("gzinflate"))
					{
						$fp = fopen($file,"rb");
						if ((!$fp) || filesize($file)==0)
						{
							$outBuffer .= "<br$ErrorReadingFile1Rest <b>($file_name)</b> $ErrorReadingFile2Rest";
							$error = true;
						}
						else
						{
							$content = fread($fp, filesize($file));
							fclose($fp);
							$content = gzinflate(substr($content,10));
						}
					}
					else
					{
						$outBuffer .= "<br>$ErrorGzRest";
						$error = true;
					}
				}
				elseif (substr($file_name, -4)==".bz2")
				{
					if (function_exists("bzdecompress"))
					{
						$fp = fopen($file,"rb");
						if ((!$fp) || filesize($file)==0)
						{
							$outBuffer .= "<br>$ErrorReadingFile1Rest <b>($file_name)</b> $ErrorReadingFile2Rest";
							$error = true;
						}
						else
						{
							$content = fread($fp, filesize($file));
							fclose($fp);
							$content = bzdecompress($content);
						}
					}
					else
					{
						$outBuffer .= "<br>$ErrorBz2Rest";
						$error = true;
					}
				}
				elseif (substr($file_name, -4)==".zip")
				{
					$outBuffer .= "<br>$ErrorZipRest";
					$error = true;
				}
				else
				{
					$outBuffer .= "<br>$ErrorUnrecognizedRest <b>($file_name)</b>.";
					$error = true;
				}

				if (!$error)
				{
					$data = explode(chr(10),$content);
					$queries=0;
					$query = "";
					foreach ($data as $line)
					{
						$line = trim($line);
						if ($line!="" && substr($line, 0, 1)!="#")
						{
							$query .= $line;
							if (substr($line,-2)==";;")
							{
								$query = substr($query, 0, -2);
								
								if ($merge == "yes" && strtoupper(substr($query,0,6))=="INSERT")
									$query = "REPLACE ".substr($query,7);
								if ($merge == "yes")
								{
									if (!eregi('^(DROP|CREATE|DELETE)[[:space:]]+(.+)', $query))
									{
										mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
										$queries++;
									}
								}
								else
								{
									mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
									$queries++;
								}
								$query = "";
							}
						}
						TimeOutRead();
					}
					$outBuffer .= "<br>".$NAILER['BACKUPSuccessRest1'] .$queries." ".$NAILER['BACKUPSuccessRest2'];
				}
			}
		}
		$outBuffer .= "</div><hr width=400>";
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
</script>
<?print $outBuffer?>
<div align=center>

<br><table border=0 cellpadding=2 cellspacing=0>
<tr><td colspan=3>
<form method=post action="<?print basename($PHP_SELF)?>" enctype="multipart/form-data">
<div align=center>
<b><?print $TitleRest?><br><br>
</div>

<?
$handle=opendir('../backups/');
if ($file = readdir($handle))
{
	print $SelectRest."</td></tr><tr><td width=300>";
	$ext = strtolower(substr($file, strrpos($file, ".")+1));
	$pefix = strtolower(substr($file, 0, 4));
	if ($file!='.' && $file!='..' && ($ext=="sql" || $ext=="gz" || $ext=="bz2" || $ext=="zip") && $pefix=="dump")
	{
		print "<input type=radio name=backups value=\"$file\"> $file : ";
		print "</td><td width=120>";
		print "<div align=right>".filesize("../backups"."/".$file)." byte /";
		print "</td><td width=125>";
		print date("m/d/y H:i:s", filemtime("../backups"."/".$file));
	}
}
while ($file = readdir($handle))
{
	$ext = strtolower(substr($file, strrpos($file, ".")+1));
	$pefix =  strtolower(substr($file, 0, 4));
	if ($file!='.' && $file!='..' && ($ext=="sql" || $ext=="gz" || $ext=="bz2" || $ext=="zip") && $pefix=="dump")
	{
		print "</td></tr><tr><td>";
		print "<input type=radio name=backups value=\"$file\"> <a href=\"../backups/$file\">$file</a> : ";
		print "</td><td width=120>";
		print "<div align=right>".filesize("../backups"."/".$file)." byte /";
		print "</td><td width=125>";
		print date("m/d/y H:i:s", filemtime("../backups"."/".$file));
	}
}
closedir($handle);
?>
</td></tr><tr><td colspan=3><br>
<div align=center><input type=checkbox name=merge value="yes"> <?print $MergerRest?></div>
</td></tr><tr><td colspan=3><br>
<?print $AlternateSelectRest?><br><br>
</td></tr>
</table>
<input type=file name=file><br><br>
<input type=submit name=sub value="<?print $ButtonRest?>" class=button><br><br>
</form>

</div>
<?
}
else
{
	?>
	
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
	<html>
	<head>
	<title><?print $SystemDataAdministrationConf?> :: <?print $TitleSQLQ?></title>
	<meta name="Author" content="ADMIN alternativago@gmail.com">
	<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
	</head>
	<?print $body?>
	<?
	print $AccessDeny;
}
?>
</body>
</html>
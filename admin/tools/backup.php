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
 * Admin utility Backup module
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
	if($sub==$ButtonBack)
	{

		if ($format != "bz2" && $format != "gz" && $format != "zip" && $way != "display") // ���� �� ����� �� ����� ������ � ����, ��� �������� ������
		{
			if ($formatdata == "sql")
			{
				$dump = "dump_";
			}
			elseif ($formatdata == "csv")
			{
				if (COUNT($tables)==1 && $tables[0] != "---all---")
				{
					$dump = "csv_".$tables[0]."_";
					$ext = "csv";
				}
				else
				{
					$dump = "multi_csv_";
					$ext = "csv";
				}
			}
			else
			{
				$dump = $formatdata."_";
			}
			if ($way == "download" || $way == "server")
			{
				if (ereg("Opera(/| )([0-9].[0-9]{1,2})", $HTTP_USER_AGENT))
				{
					$UserAgent = "Opera";
				}
				elseif (ereg("MSIE ([0-9].[0-9]{1,2})", $HTTP_USER_AGENT))
				{
					$UserAgent = "IE";
				}
				else
				{
					$UserAgent = "";
				}

				$filename = $dump.$base."_".date("j-m-Y_H-i-s").".".$formatdata;
				$mime_type = ($UserAgent == "IE" || $UserAgent == "Opera") ? "application/octetstream" : "application/octet-stream";

				if ($way == "download") // ���������
				{
					header("Content-type: $mime_type");
					header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
					if ($UserAgent == "IE")
					{
						header("Content-Disposition: inline; filename=\"$filename\"");
						header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
						header("Pragma: public");
					}
					else
					{
						header("Content-Disposition: attachment; filename=\"$filename\"");
						header("Pragma: no-cache");
					}
				}
				else // ����� � ���� �� �������
				{
					$fp = @fopen("../backups/$filename", "wb");
					if (!$fp)
					{
						$outBuffer .= "<br><div align=center><b>$DumpDatabaseBac $base $RunningOnBack $server</b><br><br>$StoreOnServerError1Back<b>$filename</b> $StoreOnServerError2Back</div>";
						$outBuffer .= "<hr width=400>";
						$error = true;
					}
					else
					{
						$error = false;
					}
				}
			
			}
		}
		else  // ���� ����� �� �������� ������
		{
			@ini_set("memory_limit", $MemoryLimit);
			$error = false;
		}
		
		if (!$error) // �� ������ �������� �����
		{
			if ($tables[0] == "---all---")
			{
				unset($tables);

				$query="SHOW TABLES";
				$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
				$i=0;
				while(list($table) = mysql_fetch_row($result))
				{
					$tables[$i]=$table;
					$i++;
				}
			}

			if ($formatdata == "sql")
			{
				$out = "####################\n";
				$out .= "# ADMIN MySQL-Dump\n";
				$out .= "# version $version\n";
				$out .= "# $nailer_home_page (download page)\n";
				$out .= "#\n";
				$out .= "# Host: $server\n";
				$out .= "# Generation Time: ".date("F d, Y")." at ".date("H:i")."\n";
				$out .= "# Server version: ".mysql_get_server_info()."\n";
				$out .= "# PHP Version: ".phpversion()."\n";
				$out .= "# Database : `$base`\n";
				$out .= "#####################\n\n";
			}
			elseif ($formatdata == "xml")
			{
				$out = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";?><?
				$out .= "<!--\n";
				$out .= "-\n";
				$out .= "- ADMIN XML-Dump\n";
				$out .= "- version $version\n";
				$out .= "- $nailer_home_page (download page)\n";
				$out .= "-\n";
				$out .= "- Host: $server\n";
				$out .= "- Generation Time: ".date("F d, Y")." at ".date("H:i")."\n";
				$out .= "- Server version: ".mysql_get_server_info()."\n";
				$out .= "- PHP Version: ".phpversion()."\n";
				$out .= "- Database : '$base'\n";
				$out .= "-\n";
				$out .= "-->\n";
				$out .= "\n\n";
				$out .= "<$base>\n";
			}

			for ($i=0;$i<COUNT($tables);$i++)
			{
				$t=$tables[$i];

				$access='n';
				$query = "SELECT atac FROM nrat LEFT JOIN nrur ON urrl=atrl WHERE (urad='$PHP_AUTH_USER' OR atrl='$PHP_AUTH_ROLE') AND attb='$t'";
				$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
				while (list($access_tmp) = mysql_fetch_row($result)) // ����� ������� � ��������
				{
					if ($access_tmp=='r')
					{
						$access='r';
					}
					if ($access_tmp=='w')
					{
						$access='w';
						break;
					}
				}
				if ($readonly=='y' && $access!='n') $access='r';
				if ($PHP_SU) $access='w';

				if ($access!='w' && $access!='r') 
				{
					$out .= "\n";
					$out .= "##########\n";
					$out .= "# Dumping table `$t` deny\n";
					$out .= "##########\n";
					$out .= "\n";
				}
				else
				{
					$query = "SHOW TABLE STATUS LIKE '$t'";
					$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
					if($row_ad = mysql_fetch_array($result))
					{
						$Create_time = $row_ad['Create_time'];
						$Update_time = $row_ad['Update_time'];
					}

					$j=0;
					unset($fields);
					$table_def = mysql_db_query($base, "SHOW FIELDS FROM `$t`") or mysql_die($ErrorSelectFieldsTable." <b>$t</b>", false);
					while (list($filed) = mysql_fetch_row($table_def))
					{
						$fields[$j] = $filed;
						$j++;
					}

					$query="SELECT * FROM `$t`";
					$res = mysql_db_query($base, $query) or mysql_die($MySQLError, false);

					if ($formatdata == "sql")
					{
						$dump = "dump_";
						$ext = "sql";
						if ($what == "structure" || $what == "all")
						{
							$out .= "\n";
							$out .= "##########\n";
							$out .= "# Table structure for table `$t`\n";
							$out .= "#\n";
							$out .= "# Creation: ".date("F d, Y", strtotime($Create_time))." at ".date("H:i", strtotime($Create_time))."\n";
							$out .= "# Last update: ".date("F d, Y", strtotime($Update_time))." at ".date("H:i", strtotime($Update_time))."\n";
							$out .= "##########\n";
							$out .= "\n";
							$out .= "DROP TABLE IF EXISTS `$t`;;\n";
							$out .= "\n";
							$result = mysql_db_query($base, "SHOW CREATE TABLE $t") or mysql_die($ErrorSelectStatusFieldsTable." <b>$t</b>", false);
							list($table, $create_tb) = mysql_fetch_row($result);
							$out .= $create_tb;
							$out .= ";;\n";
						}

						if ($what == "data" || $what == "all")
						{
							$out .= "\n";
							$out .= "##########\n";
							$out .= "# Dumping data for table `$t`\n";
							$out .= "##########\n";
							$out .= "\n";

							if ($what == "data")
							{
								$out .= "DELETE FROM `$t`;;\n";
							}
							while ($row = mysql_fetch_array($res))
							{
								$out .= "INSERT INTO `$t` VALUES (";
								for ($j=0; $j<COUNT($fields); $j++)
								{
									if ($j<(COUNT($fields)-1))
										$out .= "'".ereg_replace("'", "\'", $row[$j])."', ";
									else
										$out .= "'".ereg_replace("'", "\'", $row[$j])."'";
								}
								$out .= ");;\n";
								if ($format != "bz2" && $format != "gz" && $format != "zip" && $way != "display")
								{
									TimeOutWrite($out, $way, $fp, false);
									$out = "";
								}
								else
								{
									TimeOutWrite($out, $way, $fp, true);
								}
							}
							$out .= "\n";
						}
					}
					elseif ($formatdata == "csv")
					{
						if (COUNT($tables)==1)
						{
							$dump = "csv_".$tables[0]."_";
							$ext = "csv";
						}
						else
						{
							$dump = "multi_csv_";
							$ext = "csv";
						}
						$first = true;
						while ($row = mysql_fetch_array($res))
						{
							if ($first && COUNT($tables)>1)
							{
								$first = false;
								$out .= "1";
							}
							for ($j=0; $j<COUNT($fields); $j++)
							{
								if ($row[$j] != "")
									$out .= '"'.ereg_replace("\"", "\"\"", $row[$j]).'"';
								$out .= ";";
							}
							if ($format != "bz2" && $format != "gz" && $format != "zip" && $way != "display")
							{
								TimeOutWrite($out, $way, $fp, false);
								$out = "";
							}
							else
							{
								TimeOutWrite($out, $way, $fp, true);
							}
							$out .= "\r\n";
						}
					}
					elseif ($formatdata == "xml")
					{
						$dump = "xml_";
						$ext = "xml";
						$out .= "\t<!-- Table $t -->\n";
						while ($row = mysql_fetch_array($res))
						{
							$out .= "\t\t<$t>\n";
							for ($j=0; $j<COUNT($fields); $j++)
							{
								$out .= "\t\t\t<$fields[$j]>".htmlspecialchars($row[$j])."</$fields[$j]>\n";
							}
							if ($format != "bz2" && $format != "gz" && $format != "zip" && $way != "display")
							{
								TimeOutWrite($out, $way, $fp, false);
								$out = "";
							}
							else
							{
								TimeOutWrite($out, $way, $fp, true);
							}
							$out .= "\t\t</$t>\n";
						}
					}
				}
				
			}

			if ($formatdata == "xml")
			{
				$out .= "</$base>\n";
			}
			
			if ($way == "display")
			{
				$outBuffer .= "<br><div align=center><b>$DumpDatabaseBac $base $RunningOnBack $server</b></div>";
				$outBuffer .= "<pre>".htmlspecialchars($out)."</pre>";
				$outBuffer .= "<hr width=400>";
			}
			elseif ($way == "download" || $way == "server") // ���� ���������� �� ����
			{
				if (ereg("Opera(/| )([0-9].[0-9]{1,2})", $HTTP_USER_AGENT))
				{
					$UserAgent = "Opera";
				}
				elseif (ereg("MSIE ([0-9].[0-9]{1,2})", $HTTP_USER_AGENT))
				{
					$UserAgent = "IE";
				}
				else
				{
					$UserAgent = "";
				}

				if ($format == "bz2")
				{
					$filename = $dump.$base."_".date("j-m-Y_H-i-s").".bz2";
					$mime_type = "application/x-bzip";
					if (function_exists("bzcompress"))
						$out = bzcompress($out, 9);
				}
				elseif ($format == "gz")
				{
					$filename = $dump.$base."_".date("j-m-Y_H-i-s").".gz";
					$mime_type = "application/x-gzip";
					if (function_exists("gzencode"))
						$out = gzencode($out, 9);
				}
				elseif ($format == "zip")
				{
					$filename = $dump.$base."_".date("j-m-Y_H-i-s");
					$mime_type = "application/x-zip";
					if (function_exists("gzcompress"))
					{
						include "zip.lib.php";
						$zipfile = new zipfile();
						$zipfile -> addFile($out, $filename.".".$ext);
						$out = $zipfile->file();
					}
					$filename .= ".zip";
				}


				if ($way == "download")
				{
					print $out;
					exit();
				}
				else
				{
					if ($format == "bz2" || $format == "gz" || $format == "zip")
					{
						$fp = @fopen("../backups/$filename", "wb");
						if (!$fp)
						{
							$outBuffer .= "<br><div align=center><b>$DumpDatabaseBac $base $RunningOnBack $server</b><br><br>$StoreOnServerError1Back<b>$filename</b> $StoreOnServerError2Back</div>";
							$outBuffer .= "<hr width=400>";
						}
						else
						{
							fwrite($fp, $out);
							fclose($fp);

							$outBuffer .= "<br><div align=center><b>$DumpDatabaseBac $base $RunningOnBack $server</b><br><br>$StoredOnServerBack<b>$filename<b></div>";
							$outBuffer .= "<hr width=400>";
						}
					}
					else
					{
						fwrite($fp, $out);
						fclose($fp);

						$outBuffer .= "<br><div align=center><b>$DumpDatabaseBac $base $RunningOnBack $server</b><br><br>$StoredOnServerBack<b>$filename<b></div>";
						$outBuffer .= "<hr width=400>";
					}
				}
			}
		}
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
<br><table width=400 border=0 cellpadding=2 cellspacing=0>
<tr><td>
<form method=post action="<?print basename($PHP_SELF)?>">
<div align=center>
<b><?print $TitleBack?></b><br><br>
</div>
<?print $WhichWayOutBack?>
</td></tr><tr><td>
<br><input type=radio name=way value="display"> <?print $WhichWayOut_Display_Back?>
</td></tr><tr><td>
<input type=radio name=way value="download"> <?print $WhichWayOut_Download_Back?>
</td></tr><tr><td>
<input type=radio name=way value="server" checked> <?print $WhichWayOut_Server_Back?>
</td></tr><tr><td>
<br><?print $FormatOutBack?>
</td></tr><tr><td>
<br><input type=radio name=format value="zip"> <?print $FormatOut_Zip_Back?>
</td></tr><tr><td>
<input type=radio name=format value="gz"> <?print $FormatOut_Gz_Back?>
<?
if (function_exists("bzcompress"))
{?>
</td></tr><tr><td>
<input type=radio name=format value="bz2"> <?print $FormatOut_Bz2_Back?>
<?
}
?>
</td></tr><tr><td>
<input type=radio name=format value="plain" checked> <?print $FormatOut_Plain_Back?>
</td></tr><tr><td>
<br><?print $WhatBack?>
</td></tr><tr><td>
<br><input type=radio name=what value="data"> <?print $WhatSelect_Data_Back?>&nbsp;&nbsp;&nbsp;
<input type=radio name=what value="structure"> <?print $WhatSelect_Structure_Back?>&nbsp;&nbsp;&nbsp;
<input type=radio name=what value="all" checked> <?print $WhatSelect_All_Back?>
</td></tr><tr><td>
<br><?print $FormatOutDataBack?>
</td></tr><tr><td>
<br><input type=radio name=formatdata value="sql" checked> <?print $FormatOutData_Sql_Back?>&nbsp;&nbsp;&nbsp;
<input type=radio name=formatdata value="csv"> <?print $FormatOutData_Csv_Back?>&nbsp;&nbsp;&nbsp;
<input type=radio name=formatdata value="xml"> <?print $FormatOutData_Xml_Back?>
</td></tr><tr><td>
<br><?print $WhichBack?>
</td></tr>
</table>
<br><select name=tables[] multiple>
<option value="---all---" selected><?print $AllBack?></option>
<?
$query="SHOW TABLES";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
while(list($table) = mysql_fetch_row($result))
{
	$query="SELECT tbds FROM nrtb WHERE tbnm='$table'";
	$result2 = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
	list($table_nm) = mysql_fetch_row($result2);
	print "<option value=\"$table\">$table";
	if (isset($table_nm)) print " ($table_nm)";
	print "</option>";
}
?>
</select><br><br>
<input type=submit name=sub value="<?print $ButtonBack?>" class=button>
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
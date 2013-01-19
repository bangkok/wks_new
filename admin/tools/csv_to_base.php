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
 * Admin utility CSV module
 */
require ("../conf.inc.php");

$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);
if ($sub == $NAILER['CSVLoad'])
	$operation='cp';

authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer[host])
{
	print($ErrorAccessRight);
	exit;
}

$query="SELECT adsu FROM nrad WHERE adid='$PHP_AUTH_USER'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
list($adsu) = mysql_fetch_row($result);

if ($adsu=='y' || 1==1) // need modify
{
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?print $SystemDataAdministrationConf?> :: <?print $NAILER['CSVTitle']?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>

<?print $body?>
<div align=center>
<table width=450 border=0 cellpadding=5 cellspacing=0><tr><td align=center>
<br><b><?print $NAILER['CSVTitleText'];?></b>

<?
if ($sub == $NAILER['CSVLoad'])
{
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
			$file = $DOCUMENT_ROOT."/".$path_to_admin."/backups/".$backups;
			$file_name = $backups;
		}

		if (!eregi(".\.csv$",$file_name))
		{	
			$outBuffer .= "<br>".$NAILER['CSVErrorInvalidFileExt1Rest']." <b>($file_name)</b>.<br>".$NAILER['CSVErrorInvalidFileExt2Rest'];
			$error = true;
		}
		
		if (!$error)
		{
			if ($dl!='on')
			{
				$query="DELETE FROM $t";
				mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
			}
			$f = "file";

			if ($load_method == 1 || $load_method == 2)
			{
				$query = "LOAD DATA";
				if ($load_method == 2)
					$query .= " LOCAL";
				$query .= " INFILE '".$$f."'";
				if ($repl == "on")
					$query .= " REPLACE";
				$query .= " INTO TABLE $t FIELDS TERMINATED BY '".$field_sep."'";
				if ($field_in_opt == "on")
					$query .= " OPTIONALLY";

				$query .= " ENCLOSED BY '".$field_in."' ESCAPED BY '".$field_shield."' LINES TERMINATED BY '".$line_sep."'";
				if (trim($field_name) != "")
				{
					$query .= " (";
					$query .= " ".trim($field_name);
					$query .= " )";
				}
				$query = str_replace('\\\r', '\r', $query);
				$query = str_replace('\\\n', '\n', $query);
				$query = str_replace('\"', '"', $query);
				mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
				$outBuffer .= "<h3>".$NAILER['CSVLoadOk']."</h3>";
				$outBuffer .= $NAILER['CSVAddedRows']." ".mysql_affected_rows()."<br><br>";
			}
			else
			{
				$row = 0;
				$fp = fopen($$f,"r");

				if (trim($field_name) != "")
				{
					$query_add = " (";
					$query_add .= " ".trim($field_name);
					$query_add .= " )";
				}

//				while ($data = fgetcsv ($fp, $csv_line_length, $field_sep, $field_in))
				while ($d = fgets ($fp, 24096))
				{
//					print $d."<br><br>";
					$data = explode("^",$d);
//					print_r($data);
//					print "<br><br>";

					$num = count ($data);
					$row++;
					if ($repl == "on")
						$query = "REPLACE INTO `$t` ".$query_add." VALUES (";
					else
						$query = "INSERT INTO `$t` ".$query_add." VALUES (";
					for ($c=0; $c < $num; $c++)
					{
						if (0 != $c)
						{
							$query .= ", ";
						}
						$query .= "'".ereg_replace("'", "\'", $data[$c])."'";
					}
					$query .= ")";
					mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
				}
				fclose ($fp);
				$outBuffer .= "<h3>".$NAILER['CSVLoadOk']."</h3>";
				$outBuffer .= $NAILER['CSVAddedRows']." ".$row."<br><br>";
				$query = "UPDATE rnnd SET ndt2='������' WHERE ndt2='������ (��'";
				mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
				$query = "UPDATE rnnd SET ndzo='�����' WHERE ndzo LIKE '����� -%'";
				mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
				$query = "UPDATE rnnd SET ndad=concat(substring(tmp, 7, 4),\"-\",substring(tmp, 4, 2),\"-\",substring(tmp, 1, 2))";
				mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
				$query = "UPDATE rnnd SET ndso=ndsm WHERE ndt3='�������'";
				mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
			}

//			$outBuffer .= $a_string."<br><br>";

		}
	}
}

print "<br><br>";
print $outBuffer;
print $NAILER['CSVAttention'];?>
</td></tr></table>
<br>
<form action="<?print basename($PHP_SELF)?>" method=post enctype="multipart/form-data">
<table width=450 border=0 cellpadding=5 cellspacing=0><tr><td colspan=3>
<input type=hidden name=t value="<?echo $t?>">
<!-- <input type="hidden" name="fields[flim]" value="$blob$"> -->

<?print $NAILER['CSVTable'].": ";?>
<div align=center>
<br><select name=t>
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
</td></tr>
<tr><td>
<?
$handle=opendir('../backups/');
if ($file = readdir($handle))
{
	print $SelectRest."</td></tr><tr><td width=300>";
	$ext = strtolower(substr($file, strrpos($file, ".")+1));
	$pefix = strtolower(substr($file, 0, 3));
	if ($file!='.' && $file!='..' && ($ext=="csv") && $pefix=="csv")
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
	$pefix =  strtolower(substr($file, 0, 3));
	if ($file!='.' && $file!='..' && ($ext=="csv") && $pefix=="csv")
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
</div>
</td></tr>
</table>

<table width=450 border=0 cellpadding=5 cellspacing=0>
<tr>
<td><br>
<?print $NAILER['CSVWhereTXT'];?>
</td>
</tr>
<tr>
<td align=center>
<input type=file name=file>
</td>
</tr>


<tr>
<td><br>
<table width=400 border=0 cellpadding=2 cellspacing=0>
<tr>
	<td><?print $NAILER['CSVLoadNotClear'];?></td>
	<td><?print $NAILER['CSVReplaceData'];?></td>
</tr>
<tr>
	<td align=center><input type=checkbox name=dl></td>
	<td align=center><input type=checkbox name=repl></td>
</tr>
</table>
</td>
</tr>


<tr>
<td><br>
<table width=400 border=0 cellpadding=5 cellspacing=0>
<tr>
	<td><?print $NAILER['CSVFieldSep'];?></td>
	<td><?print $NAILER['CSVFieldIn'];?></td>
	<td><?print $NAILER['CSVFieldShield'];?></td>
</tr>
<tr>
	<td align=center><input type=text maxlength=2 size=4 name=field_sep value="^"></td>
	<td align=center><input type=text maxlength=1 size=4 name=field_in value='"'>&nbsp;(<input type=checkbox name=field_in_opt><?print "�� ������";?>)</td>
	<td align=center><input type=text maxlength=2 size=4 name=field_shield value="\"></td>
</tr>
</table>
</td>
</tr>

<tr>
<td><br>
<table width=400 border=0 cellpadding=5 cellspacing=0>
<tr>
	<td><?print $NAILER['CSVLineSep'];?></td>
	<td><?print $NAILER['CSVNameCol'];?></td>
</tr>
<tr>
	<td align=center><input type=text maxlength=10 size=12 name=line_sep value="\r\n"></td>
	<td align=center><input type=text size=20 name=field_name value=""></td>
</tr>
</table>
</td>
</tr>

<tr>
<td><br>
<?print $NAILER['CSVMethod'];?>
</td>
</tr>
<tr>
<td align=center>
<input type=radio name=load_method value="1"><?print $NAILER['CSVdt1'];?> <input type=radio checked name=load_method value="2"><?print $NAILER['CSVdt2'];?> <input type=radio name=load_method value="3"><?print $NAILER['CSVdt3'];?>
</td>
</tr>

<tr>
<td align=center><br>
<input type=submit name=sub value="<?print $NAILER['CSVLoad']?>" class=button><br><br>
</td>
</tr>
</table>
</form>

</font>
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
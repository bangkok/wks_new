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
 * Admin utility Archive manager module
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
	if($sub==$NAILER['ARCSub'] && $del=="delete" && $backups!="")
	{
		if (unlink("../backups/$backups"))
			$outBuffer .= "<br><div align=center><b>$FileArchiveClearRest '$backups' $BeDoneClearRest</b></div>";
		else
			$outBuffer .= "<br><div align=center><b>$FileArchiveClearRest '$backups' $BeDontClearRest</b></div>";
		$outBuffer .= "<hr width=400>";
	}
	else if ($sub==$NAILER['ARCUpload'])
	{
		$error = false;

		if ($file_name=="")
		{
			$outBuffer .= "<br>$ErrorNoFileRest";
			$error = true;
		}

		if (!$error)
		{
			$f = "file";
			if (rename($$f, $DOCUMENT_ROOT."/".$path_to_admin."/backups/".$file_name))
				$outBuffer .= "<br><div align=center><b>".$NAILER['ARCUploaded1']." '$file_name' ".$NAILER['ARCUploaded2']."</b></div>";
			else
				$outBuffer .= "<br><div align=center><b>".$NAILER['ARCUploadError1']." '$file_name' ".$NAILER['ARCUploadError2']."</b></div>";
			$outBuffer .= "<hr width=400>";
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?print $SystemDataAdministrationConf?> :: <?print $NAILER['ARCTitle']?></title>
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
<div align=center>

<br><table width=500 border=0 cellpadding=2 cellspacing=0>
<tr><td colspan=3>
<form method=post action="<?print basename($PHP_SELF)?>" enctype="multipart/form-data">
<div align=center>
<b><?print $NAILER['ARCTitle']?><br>
<?print $outBuffer?><br>
</div>


<?
$handle=opendir('../backups/');
if ($file = readdir($handle))
{
	print $SelectRest."</td></tr><tr><td width=300>";
	$ext = strtolower(substr($file, strrpos($file, ".")+1));
	$pefix = strtolower(substr($file, 0, 4));
	if ($file!='.' && $file!='..' && $file!='.svn' && $file!='index.html')
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
	if ($file!='.' && $file!='..' && $file!='.svn' && $file!='index.html')
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
</td></tr>
</table>
<input type=file name=file>&nbsp;<input type=submit name=sub value="<?print $NAILER['ARCUpload']?>" class=button><br><br>
<input type=checkbox name=del value="delete">&nbsp;
<input type=submit name=sub value="<?print $NAILER['ARCSub']?>" class=button><br><br>
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
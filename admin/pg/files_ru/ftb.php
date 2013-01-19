<?

/**
 * Admin utility file to base plagin
 */

require ("../../conf.inc.php");

$ident=@mysql_connect($server,$login,$password) or mysql_die("������ ���������� � MySQL ��������.", true);

authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer[host] && $op!='sv') 
{
	print("������ ������� �������!!!");
	exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>������� ����������������� ����� "<?print $site_name?>".</title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<?print $body?>
<script language="JavaScript">
<!--
	if (self.parent.frames.length == 0)
		self.parent.location='index.php';
//-->
</script>
<?
	if (!file_exists("file_to_base"))
	{
		print "��� ������ ��� �������.<br>�������� ���������� file_to_base (� ���. ��������������)(pg/files_ru/file_to_base) � ��������� ����� ������� �� ������ �������� � �� � ���.";
	}
	else
	{
		$handle=opendir('file_to_base');
		$i=0;
		while ($file = readdir($handle))
		{
			if ($file!='.' && $file!='..' && $file!='CVS')
			{
				$file_ar[$i]=$file;
				$i++;
			}
		}
		closedir($handle);
		chdir('file_to_base');

		if (COUNT($file_ar)==0)
		{
			print "��� ������ ��� �������.<br>��������� ����� ������� �� ������ �������� � �� � ���������� file_to_base ������������ � ����� ��������������.";
		}
		for ($i=0;$i<COUNT($file_ar);$i++)
		{
			$fieldlist = "";
			$valuelist = "";
			$fieldlist .= "flim, ";
			$val = "'".chunk_split(base64_encode(fread(fopen($file_ar[$i], "r"), filesize($file_ar[$i]))))."'";
			$valuelist .= "$val, ";

			$fieldlist .= "flim"."_fnm".", ";
			$valuelist .= "'".$file_ar[$i]."', ";
			$fieldlist .= "flim"."_siz".", ";
			$valuelist .= "'".filesize($file_ar[$i])."', ";
			$fieldlist .= "flex, ";
			$valuelist .= "'180', ";
			$fieldlist .= "flnm, ";
			$valuelist .= "'".substr($file_ar[$i], 0, strrpos($file_ar[$i], "."))."', ";
			$fieldlist .= "ad, ";
			$valuelist .= "now(), ";
			$fieldlist .= "up, ";
			$valuelist .= "now(), ";


			$values_fields = ereg_replace(', $', '', $fieldlist);
			$values = ereg_replace(', $', '', $valuelist);

			$sql_query = "INSERT INTO nrfl ($values_fields) VALUES ($values)";
			$res = mysql_db_query($base, $sql_query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
			print $file_ar[$i]." - done.<br>";
		}
	}
?>

</body>
</html>
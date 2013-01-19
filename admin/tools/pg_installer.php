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
 * Admin utility plagins installer
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
	if (isset($pg))
	{
		if (file_exists("../pg/$pg/readme.txt"))
		{
			$fpr=fopen("../pg/$pg/readme.txt","r");
			while (!feof ($fpr))
			{
				print "&nbsp;&nbsp;&nbsp;".$buffer = fgets($fpr, 4096);
			}
			fclose ($fpr);
		}
		?>
		<br><br><div align=center><form method=post action="<?print basename($PHP_SELF)?>">
		<?print $PrefixPGInst?> <input type=text name=prefix><br><input type=hidden name=pg value="<?print $pg?>">
		<input type=submit name=sub value="<?print $AddPGInst?>" class=button>&nbsp;
		<?
		if (file_exists("../pg/$pg/fo/fo.php"))
		{
		?>
		<input type=submit name=sub value="<?print $FOPGInst?>" class=button>&nbsp;
		<?}?>
		<input type=submit name=sub value="<?print $DelPGInst?>" class=button>
		</form></div>
		<?
		$query = "SELECT MAX(nvid) FROM nrnv";
		$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
		list($this_index) = mysql_fetch_row($result);
		$this_index += 50;
		if (isset($sub) && $sub==$AddPGInst)
		{
			$added_flag = false;
			if (file_exists("../pg/$pg/sql/add"))
			{
				$handle=opendir("../pg/$pg/sql/add");
				$i=0;
				while ($file = readdir($handle))
				{
					if ($file!='.' && $file!='..' && $file!='CVS')
					{
						$file_ar[$i]=substr($file, 0, strrpos($file, "."));
						$i++;
					}
				}
				closedir($handle);

				for ($i=0;$i<COUNT($file_ar);$i++)
				{
					$nr[$file_ar[$i]]=false;
				}
			}

			$i=0;
			$query = "SHOW TABLES";
			$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
			while(list($t) = mysql_fetch_row($result))
			{
				$table[$i]=$t;
				$i++;
			}

			for ($i=0;$i<COUNT($table);$i++)
			{
				for ($j=0; $j<COUNT($file_ar); $j++)
				{
					if ($prefix!='')
					{
						if ($table[$i]==$file_ar[$j]."_".$prefix)
						{
							$nr[$file_ar[$j]]=true;
						}
					}
					else
					{
						if ($table[$i]==$file_ar[$j])
						{
							$nr[$file_ar[$j]]=true;
						}
					}
				}
			}

			for ($i=0; $i<COUNT($file_ar); $i++)
			{
				if (!$nr[$file_ar[$i]])
				{
					$added_flag = true;

					$fpr = fopen("../pg/$pg/sql/add/$file_ar[$i].sql","r");
					$buffer = "";
					while (!feof ($fpr))
					{
						$buffer .= fgets($fpr, 4096);
					}
					fclose ($fpr);
					
					unset($buf_arr);
					$buffer = ereg_replace("\r\n","\n",$buffer);
					$buf_arr = explode(";\n", $buffer);
					for ($j=0; $j<COUNT($buf_arr); $j++)
					{
						if (trim($buf_arr[$j])!='')
						{
							if ($prefix!='')
								$buf_prefix = ereg_replace("%","_".$prefix,$buf_arr[$j]);
							else
								$buf_prefix = ereg_replace("%","",$buf_arr[$j]);
							$this_index++;
							$buf_prefix =  ereg_replace("###","$this_index",$buf_prefix);
							if ($prefix!='')
								$buf_prefix =  ereg_replace("##"," (".$prefix.")",$buf_prefix);
							else
								$buf_prefix =  ereg_replace("##","",$buf_prefix);
							mysql_db_query($base, $buf_prefix) or mysql_die($MySQLError.mysql_error(), false);
						}
					}
					if ($prefix!='')
						print $file_ar[$i]."_".$prefix." - $Text1PGInst<br>";
					else
						print $file_ar[$i]." - $Text1PGInst<br>";
				}
			}
			if ($added_flag)
			{
				print "<br>$Text2PGInst";
			}
		}
		elseif (isset($sub) && $sub==$DelPGInst)
		{
			$added_flag = false;
			if (file_exists("../pg/$pg/sql/del"))
			{
				$handle=opendir("../pg/$pg/sql/del");
				$i=0;
				while ($file = readdir($handle))
				{
					if ($file!='.' && $file!='..' && $file!='CVS')
					{
						$file_ar[$i]=substr($file, 0, strrpos($file, "."));
						$i++;
					}
				}
				closedir($handle);

				for ($i=0;$i<COUNT($file_ar);$i++)
				{
					$nr[$file_ar[$i]]=false;
				}
			}

			$i=0;
			$query = "SHOW TABLES";
			$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
			while(list($t) = mysql_fetch_row($result))
			{
				$table[$i]=$t;
				$i++;
			}

			for ($i=0;$i<COUNT($table);$i++)
			{
				for ($j=0; $j<COUNT($file_ar); $j++)
				{
					if ($prefix!='')
					{
						if ($table[$i]==$file_ar[$j]."_".$prefix)
						{
							$nr[$file_ar[$j]]=true;
						}
					}
					else
					{
						if ($table[$i]==$file_ar[$j])
						{
							$nr[$file_ar[$j]]=true;
						}
					}
				}
			}

			for ($i=0; $i<COUNT($file_ar); $i++)
			{
				if ($nr[$file_ar[$i]])
				{
					$added_flag = true;

					$fpr = fopen("../pg/$pg/sql/del/$file_ar[$i].sql","r");
					$buffer = "";
					while (!feof ($fpr))
					{
						$buffer .= fgets($fpr, 4096);
					}
					fclose ($fpr);
					
					unset($buf_arr);
					$buffer = ereg_replace("\r\n","\n",$buffer);
					$buf_arr = explode(";\n", $buffer);
					for ($j=0; $j<COUNT($buf_arr); $j++)
					{
						if (trim($buf_arr[$j])!='')
						{
							if ($prefix!='')
								$buf_prefix = ereg_replace("%","_".$prefix,$buf_arr[$j]);
							else
								$buf_prefix = ereg_replace("%","",$buf_arr[$j]);
							mysql_db_query($base, $buf_prefix) or mysql_die($MySQLError.mysql_error(), false);
						}
					}
					if ($prefix!='')
						print $file_ar[$i]."_".$prefix." - $Text3PGInst<br>";
					else
						print $file_ar[$i]." - $Text3PGInst.<br>";
				}
			}
			if ($added_flag)
			{
				print "<br>$Text2PGInst";
			}
		}
		elseif (isset($sub) && $sub==$FOPGInst)
		{

			if (file_exists("../pg/$pg/fo/fo.php"))
			{
				$fpr = fopen("../pg/$pg/fo/fo.php","r");
				$buffer = "";
				while (!feof ($fpr))
				{
					$buffer .= fgets($fpr, 4096);
				}
				fclose ($fpr);
				print "<br><div align=center><form method=post action=\"\"><textarea name=fo rows=25 cols=50>".htmlspecialchars($buffer)."</textarea></form></div>";
			}

		}
	}
	else
	{
		if (!file_exists("../pg"))
		{
			print $ModulesNotPGInst;
		}
		else
		{
			$handle=opendir('../pg');
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

			if (COUNT($file_ar)==0)
			{
				print "<br>".$ModulesNotPGInst;
			}
			else
			{
				sort($file_ar);
			}
			for ($i=0;$i<COUNT($file_ar);$i++)
			{
				echo "<ul><li><font class=b><a href=\"pg_installer.php?pg=$file_ar[$i]\">$file_ar[$i]</a></font>";
				if (file_exists("../pg/$file_ar[$i]/readme.txt"))
				{
					$fpr=fopen("../pg/$file_ar[$i]/readme.txt","r");
					print " - ";
					while (!feof ($fpr))
					{
						print $buffer = fgets($fpr, 4096);
					}
					fclose ($fpr);
				}
				echo "</ul>";
			}
		}
	}
}
else
{
	print $AccessDeny;
}
?>
</body>
</html>
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
 * Instalation script
 */

function install($base, $language)
{
	$added_flag = false;

	$i=0;
	$query="SET NAMES cp1251";
	@mysql_db_query($base,$query);
	$query = "SHOW TABLES";
	$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
	while(list($t) = mysql_fetch_row($result))
	{
		$table[$i]=$t;
		$i++;
	}

	if ($i==0)
	{
		$handle=opendir("./sql/".$language."/");
		while ($file = readdir($handle))
		{
			if ($file!='.' && $file!='..' && $file!='CVS' && substr($file,0,6)!='update')
			{
				$added_flag = true;
	
				$fpr = fopen("./sql/".$language."/$file","r");
				$buffer = fread($fpr, filesize("./sql/".$language."/$file"));
				fclose($fpr);

				$data = explode(chr(10),$buffer);
				$query = "";
				foreach ($data as $line)
				{
					$line = trim($line);
					if ($line!="" && substr($line, 0, 1)!="#")
					{
						$query .= $line;
						if (substr($line,-1)==";")
						{
							$query = substr($query, 0, -1);
							
							mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);

							$query = "";
						}
					}
				}
			}
		}
		closedir($handle);
	}

	if ($added_flag)
	{
		print $DBModificatedRefresh;
	}
}
?>

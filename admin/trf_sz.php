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
 * File emulator 
 */

require ("conf.inc.php");

//$referer=parse_url($HTTP_REFERER);
//if ($HTTP_HOST!=$referer[host] && $REMOTE_ADDR!=$SERVER_ADDR)
//{
//	print($ErrorAccessRight);
//	exit;
//} # not worked for https

$ident=@mysql_pconnect($server,$login,$password);
if ($ident<=0)
{
	mysql_die($ErrorConnectionToMySQLServer, true);
	exit();
}

if(!isset($id[0]) || count($id)==0)
{
    echo $NeedID;
	exit;
}
if(!isset($t))
{
    echo $NeedT;
	exit;
}
if(!isset($f))
{
    echo $NeedF;
	exit;
}


$i=0;
$result = mysql_query("SHOW COLUMNS FROM `$t` FROM `$base`",$ident);
while($row = mysql_fetch_array($result))
{
	if ($row[3]=="PRI")
	{
		if ($i==0)
			$pri_key.="`".$row[0]."`='$id[0]'";
		else
			$pri_key.=" AND `".$row[0]."`='$id[0]'";
		$i++;
	}
}

$query="SELECT * FROM `$t` WHERE $pri_key";
$res = mysql_db_query($base, $query) or mysql_die($MySQLError, false);

if(mysql_num_rows($res) == 0)
{
    echo "��� �����!";
}
else
{
    $row = mysql_fetch_array($res);
	{
				
		$fnm=$f."_fnm";
		$ext = substr($row[$fnm], strrpos($row[$fnm], ".")+1);

		{
			header("Content-disposition: filename=$row[$fnm]");
			switch (strtoupper($ext)) 
			{
				case "JPEG":
					header("Content-type: image/jpeg");
					break;
				case "JPG":
					header("Content-type: image/jpeg");
					break;
				case "PNG":
					header("Content-type: image/png");
					break;
				case "GIF":
					header("Content-type: image/gif");
					break;
				case "WBMP":
					header("Content-type: image/vnd.wap.wbmp");
					break;
				default:
					header("Content-type: application/octetstream");
			}
/*
			if (isset($row['flex']))
				Header("Cache-Control: public, must-revalidate, max-age=".$row['flex']);
			else
				Header("Cache-Control: public, must-revalidate, max-age=0");
			Header("Vary: Content-ID");
			Header("Content-ID: ".md5($row[$fnm].$size."-".$xm.$ym));
			if (!isset($row['flex']))
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
*/
			$fs_dir = $_SERVER['DOCUMENT_ROOT'].$path_to_media;
			
			if (isset($row['flex']))
				Header("Cache-Control: public, must-revalidate, max-age=".$row['flex']);
			else
				Header("Cache-Control: public, must-revalidate, max-age=0");
      header('Last-Modified: '.date("r", filemtime($fs_dir.$row['flid'])));
      header("Content-Length: ".filesize($fs_dir.$row['flid']));
      $exp = date("r", mktime()+$row['flex']);
      header("Expires: ".$exp);
      header("Pragma: cache");
			
			echo fread(fopen($fs_dir.$row['flid'], "r"), filesize($fs_dir.$row['flid']));
//			echo base64_decode($row["$f"]);
		}
	}
}

?> 

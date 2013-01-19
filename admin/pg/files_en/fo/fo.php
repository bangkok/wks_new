<?


/**
 * Code file emulator
  */

require ("conf.inc.php");

$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer[host] && $REMOTE_ADDR!=$SERVER_ADDR)
{
	print("Access error!!!");
	exit;
}

$ident=@mysql_pconnect($server,$login,$password);
if ($ident<=0)
{
	mysql_die('Error connecting to MySQL server.', true);
	exit();
}

if(!isset($id[0]) || count($id)==0)
{
    echo "ID is necessary!";
	exit;
}
if(!isset($t))
{
    echo "T is necessary!";
	exit;
}
if(!isset($f))
{
    echo "F is necessary!";
	exit;
}

$i=0;
$result = mysql_query("SHOW COLUMNS FROM $t FROM $base",$ident);
while($row = mysql_fetch_array($result))
{
	if ($row[3]=="PRI")
	{
		if ($i==0)
			$pri_key.=$row[0]."='$id[0]'";
		else
			$pri_key.=" AND ".$row[0]."='$id[0]'";
		$i++;
	}
}

$query="SELECT * FROM $t WHERE $pri_key";
$res = mysql_db_query($base, $query) or mysql_die("Bad MySQL query!", false);

if(mysql_num_rows($res) == 0)
{
    echo "No file!";
}
else
{
    $row = mysql_fetch_array($res);
	{
		$fnm=$f."_fnm";
		$ext = substr($row[$fnm], strrpos($row[$fnm], ".")+1);

		if ((isset($x) || isset($y)))
		{
			header("Content-disposition: filename=$row[$fnm]");
			if ((strtoupper($ext)=="JPEG" || strtoupper($ext)=="JPG") && function_exists("ImageJpeg"))
			{
				$image="http://".$HTTP_HOST.$SCRIPT_NAME."?id[0]=$id[0]&t=$t&f=$f";
				$size = getimagesize ($image);

				if (isset($x) && !isset($y))
				{
					$xm=$x;
					$ym=round($xm*$size[1]/$size[0]);
				}
				elseif (!isset($x) && isset($y))
				{
					$ym=$y;
					$xm=round($ym*$size[0]/$size[1]);
				}
				elseif (isset($x) && isset($y))
				{
					$xm=$x;
					$ym=$y;
				}
				header("Content-type: image/jpeg");
				$im = ImageCreateFromJPEG ($image);
				$im_pr = ImageCreate ($xm, $ym);
				@imagecopyresized ($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);

				header("Pragma: no-cache");
				if (isset($row[$nrfl]))
					header("Expires: $row[$nrfl]");
				else
					header("Expires: 0");
				ImageJpeg ($im_pr);
			}
			elseif (strtoupper($ext)=="PNG" && function_exists("ImagePNG"))
			{
				$image="http://".$HTTP_HOST.$SCRIPT_NAME."?id[0]=$id[0]&t=$t&f=$f";
				$size = getimagesize ($image);

				if (isset($x) && !isset($y))
				{
					$xm=$x;
					$ym=round($xm*$size[1]/$size[0]);
				}
				elseif (!isset($x) && isset($y))
				{
					$ym=$y;
					$xm=round($ym*$size[0]/$size[1]);
				}
				elseif (isset($x) && isset($y))
				{
					$xm=$x;
					$ym=$y;
				}
				header("Content-type: image/png");
				$im = ImageCreateFromPNG ($image);
				$im_pr = ImageCreate ($xm, $ym);
				@imagecopyresized ($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);

				header("Pragma: no-cache");
				if (isset($row[$nrfl]))
					header("Expires: $row[$nrfl]");
				else
					header("Expires: 0");
				ImagePNG ($im_pr);
			}
			elseif (strtoupper($ext)=="PNG" && function_exists("ImageGIF"))
			{
				$image="http://".$HTTP_HOST.$SCRIPT_NAME."?id[0]=$id[0]&t=$t&f=$f";
				$size = getimagesize ($image);

				if (isset($x) && !isset($y))
				{
					$xm=$x;
					$ym=round($xm*$size[1]/$size[0]);
				}
				elseif (!isset($x) && isset($y))
				{
					$ym=$y;
					$xm=round($ym*$size[0]/$size[1]);
				}
				elseif (isset($x) && isset($y))
				{
					$xm=$x;
					$ym=$y;
				}
				header("Content-type: image/png");
				$im = ImageCreateFromGIF ($image);
				$im_pr = ImageCreate ($xm, $ym);
				@imagecopyresized ($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);

				header("Pragma: no-cache");
				if (isset($row[$nrfl]))
					header("Expires: $row[$nrfl]");
				else
					header("Expires: 0");
				ImageGIF ($im_pr);
			}
			elseif (strtoupper($ext)=="WBMP" && function_exists("ImageWBMP"))
			{
				$image="http://".$HTTP_HOST.$SCRIPT_NAME."?id[0]=$id[0]&t=$t&f=$f";
				$size = getimagesize ($image);

				if (isset($x) && !isset($y))
				{
					$xm=$x;
					$ym=round($xm*$size[1]/$size[0]);
				}
				elseif (!isset($x) && isset($y))
				{
					$ym=$y;
					$xm=round($ym*$size[0]/$size[1]);
				}
				elseif (isset($x) && isset($y))
				{
					$xm=$x;
					$ym=$y;
				}
				header("Content-type: image/vnd.wap.wbmp");
				$im = ImageCreateFromWBMP ($image);
				$im_pr = ImageCreate ($xm, $ym);
				@imagecopyresized ($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);

				header("Pragma: no-cache");
				if (isset($row[$nrfl]))
					header("Expires: $row[$nrfl]");
				else
					header("Expires: 0");
				ImageWBMP ($im_pr);
			}
			else
			{
				if (isset($x) && !isset($y))
				{
					$xm=$x;
					$ym=$xm;
				}
				elseif (!isset($x) && isset($y))
				{
					$ym=$y;
					$xm=$ym;
				}
				elseif (isset($x) && isset($y))
				{
					$xm=$x;
					$ym=$y;
				}
				$im_pr = ImageCreate ($xm, $ym) or die ("Cannot Initialize new GD image stream");
				
				$background_color = imagecolorallocate ($im_pr, 255, 255, 255);
				$text_color = imagecolorallocate ($im_pr, 14, 14, 233);
				imagestring ($im_pr, 2, 5, 1, $row[$fnm], $text_color);
				imagestring ($im_pr, 2, 5, 12, ".".$ext, $text_color);

				header("Pragma: no-cache");
				if (isset($row[$nrfl]))
					header("Expires: $row[$nrfl]");
				else
					header("Expires: 0");
				ImagePNG ($im_pr);
				header("Content-type: image/png");
			}

		}
		else
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
			header("Pragma: no-cache");
			if (isset($row[$nrfl]))
				header("Expires: $row[$nrfl]");
			else
				header("Expires: 0");
			echo base64_decode($row["$f"]);
		}
	}
}
?>
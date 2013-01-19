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

/*$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer[host] && $REMOTE_ADDR!=$SERVER_ADDR)
{
	print($ErrorAccessRight);
	exit;
}*/ # not worked for https

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

$fs_dir = $_SERVER['DOCUMENT_ROOT'].$path_to_media;


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

		if (
			(function_exists("ImageJpeg") && (strtoupper($ext)=="JPEG" || strtoupper($ext)=="JPG"))
			|| (strtoupper($ext)=="PNG" && function_exists("ImagePNG"))
			|| (strtoupper($ext)=="GIF" && function_exists("ImageGIF"))
			|| (strtoupper($ext)=="WBMP" && function_exists("ImageWBMP"))
			)
		{
			$image="http://".$HTTP_HOST."/admin/trf_sz.php?id[0]=$id[0]&t=$t&f=$f";
			$size = getimagesize ($image);
			if (!isset($x) && !isset($y))
			{
				$x = $size[0];
				$y = $size[1];
			}
		}
						
		if ((isset($x) || isset($y)) && function_exists("imagecopyresized"))
		{
			header("Content-disposition: filename=$row[$fnm]");
			if ((strtoupper($ext)=="JPEG" || strtoupper($ext)=="JPG") && function_exists("ImageJpeg"))
			{
//				$image="http://".$HTTP_HOST.$PHP_SELF."?id[0]=$id[0]&t=$t&f=$f";
//				$size = getimagesize ($image);

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
				
				//$im_pr = ImageCreate ($xm, $ym);
				//@imagecopyresized ($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);
				
				// Resample
				$im_pr = imagecreatetruecolor($xm, $ym);
				@imagecopyresampled($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);
				
				//watermark($im_pr, $xm, $ym, "ric.ua");				
			
				if (isset($row['flex']))
					Header("Cache-Control: public, must-revalidate, max-age=".$row['flex']);
				else
					Header("Cache-Control: public, must-revalidate, max-age=0");
        header('Last-Modified: '.date("r", filemtime($fs_dir.$row['flid'])));
        header("Content-Length: ".filesize($fs_dir.$row['flid']));
        $exp = date("r", mktime()+$row['flex']);
        header("Expires: ".$exp);
        header("Pragma: cache");					
					
					
/*				Header("Vary: Content-ID");
				Header("Content-ID: ".md5($row[$fnm].$size."-".$xm.$ym));
				if (!isset($row['flex']))
					header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");*/
					
				ImageJpeg ($im_pr);
			}
			elseif (strtoupper($ext)=="PNG" && function_exists("ImagePNG"))
			{
//				$image="http://".$HTTP_HOST.$PHP_SELF."?id[0]=$id[0]&t=$t&f=$f";
//				$size = getimagesize ($image);

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
//				$im_pr = ImageCreate ($xm, $ym);
//				@imagecopyresized ($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);
				$im_pr = imagecreatetruecolor($xm, $ym);
				@imagecopyresampled($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);
				
				//watermark($im_pr, $xm, $ym, "ric.ua");

				if (isset($row['flex']))
					Header("Cache-Control: public, must-revalidate, max-age=".$row['flex']);
				else
					Header("Cache-Control: public, must-revalidate, max-age=0");
        header('Last-Modified: '.date("r", filemtime($fs_dir.$row['flid'])));
        header("Content-Length: ".filesize($fs_dir.$row['flid']));
        $exp = date("r", mktime()+$row['flex']);
        header("Expires: ".$exp);
        header("Pragma: cache");					
/*					
				Header("Vary: Content-ID");
				Header("Content-ID: ".md5($row[$fnm].$size."-".$xm.$ym));
				if (!isset($row['flex']))
					header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
*/					
				ImagePNG ($im_pr);
			}
			elseif (strtoupper($ext)=="GIF" && function_exists("ImageGIF"))
			{
//				$image="http://".$HTTP_HOST.$PHP_SELF."?id[0]=$id[0]&t=$t&f=$f";
//				$size = getimagesize ($image);

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
//				$im_pr = ImageCreate ($xm, $ym);
//				@imagecopyresized ($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);
				$im_pr = imagecreatetruecolor($xm, $ym);
				@imagecopyresampled($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);
				
				//watermark($im_pr, $xm, $ym, "ric.ua");

				if (isset($row['flex']))
					Header("Cache-Control: public, must-revalidate, max-age=".$row['flex']);
				else
					Header("Cache-Control: public, must-revalidate, max-age=0");

        //header("Cache-Control: public, must-revalidate, max-age=3600");
        header('Last-Modified: '.date("r", filemtime($fs_dir.$row['flid'])));
        header("Content-Length: ".filesize($fs_dir.$row['flid']));
        $exp = date("r", mktime()+$row['flex']);
        header("Expires: ".$exp);
        header("Pragma: cache");
/*					
				Header("Vary: Content-ID");
				Header("Content-ID: ".md5($row[$fnm].$size."-".$xm.$ym));
				if (!isset($row['flex']))
					header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
*/					
				ImageGIF ($im_pr);
			}
			elseif (strtoupper($ext)=="WBMP" && function_exists("ImageWBMP"))
			{
//				$image="http://".$HTTP_HOST.$PHP_SELF."?id[0]=$id[0]&t=$t&f=$f";
//				$size = getimagesize ($image);

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
//				$im_pr = ImageCreate ($xm, $ym);
//				@imagecopyresized ($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);
				$im_pr = imagecreatetruecolor($xm, $ym);
				@imagecopyresampled($im_pr, $im, 0, 0, 0, 0, $xm+1, $ym, $size[0], $size[1]);
				
				//watermark($im_pr, $xm, $ym, "ric.ua");

				if (isset($row['flex']))
					Header("Cache-Control: public, must-revalidate, max-age=".$row['flex']);
				else
					Header("Cache-Control: public, must-revalidate, max-age=0");

        //header("Cache-Control: public, must-revalidate, max-age=3600");
        header('Last-Modified: '.date("r", filemtime($fs_dir.$row['flid'])));
        header("Content-Length: ".filesize($fs_dir.$row['flid']));
        $exp = date("r", mktime()+$row['flex']);
        header("Expires: ".$exp);
        header("Pragma: cache");
					
/*					
				Header("Vary: Content-ID");
				Header("Content-ID: ".md5($row[$fnm].$size."-".$xm.$ym));
				if (!isset($row['flex']))
					header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
					
					*/
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

				header("Content-type: image/png");
				
				if (isset($row['flex']))
					Header("Cache-Control: public, must-revalidate, max-age=".$row['flex']);
				else
					Header("Cache-Control: public, must-revalidate, max-age=0");
        header('Last-Modified: '.date("r", filemtime($fs_dir.$row['flid'])));
        header("Content-Length: ".filesize($fs_dir.$row['flid']));
        $exp = date("r", mktime()+$row['flex']);
        header("Expires: ".$exp);
        header("Pragma: cache");
        
        /*				
				Header("Vary: Content-ID");
				Header("Content-ID: ".md5($row[$fnm].$size."-".$xm.$ym));
				if (!isset($row['flex']))
					header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
					*/
					
				ImagePNG ($im_pr);
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
/*
			if (isset($row['flex']))
				Header("Cache-Control: public, must-revalidate, max-age=".$row['flex']);
			else
				Header("Cache-Control: public, must-revalidate, max-age=0");
			Header("Vary: Content-ID");
			Header("Content-ID: ".md5($row[$fnm].$size."-".$xm.$ym));
			if (!isset($row['flex']))
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");*/

      header("Cache-Control: public, must-revalidate, max-age=3600");
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

function watermark($im_pr, $xm, $ym, $text)
{
	global $HTTP_HOST;
	
	if ($xm > 99)
	{
		$white = ImageColorAllocate($im_pr, 255, 255, 255);
		$red = ImageColorAllocate($im_pr, 33, 33, 155);
		if ($HTTP_HOST == 'realnest.loc')
		{
			$fontname = 'D:/Projects/realnest/PHP/img/micross.ttf';
		}
		else
		{
			$fontname = '/var/www/vhosts/realnest/htdocs/img/micross.ttf';
		}
		$size = 10;
		@list($llx, $lly, $lrx, $lry, $urx, $ury, $ulx, $uly) = imageTTFbbox($size, 0, $fontname, $text);
//		imagettftextoutline imagecopyresampled
		imagettftext(
			$im_pr,
			$size,
			0, 
			$xm - abs($urx) - 8,
			$ym - abs($lry) - 7,
			$white,
			$fontname,
			$text);
		imagettftext(
			$im_pr,
			$size,
			0, 
			$xm - abs($urx) - 7,
			$ym - abs($lry) - 8,
			$white,
			$fontname,
			$text);
		imagettftext(
			$im_pr,
			$size,
			0, 
			$xm - abs($urx) - 9,
			$ym - abs($lry) - 8,
			$white,
			$fontname,
			$text);
		imagettftext(
			$im_pr,
			$size,
			0, 
			$xm - abs($urx) - 8,
			$ym - abs($lry) - 9,
			$white,
			$fontname,
			$text);
		imagettftext(
			$im_pr,
			$size,
			0, 
			$xm - abs($urx) - 8,
			$ym - abs($lry) - 8,
			$red,
			$fontname,
			$text);
	}
}

// ����� ������ �� ������
//class ImageText
//{
//    public $text;
//    public $image;
//    public $view_line = false;
//
//    public function toPolyline($coordinates)
//    {
//        $coordinates = unserialize($coordinates);
//
//        $nFont = 5;
//        $x = 500;
//        $y = 500;
//
//        $xFont = imagefontwidth($nFont);
//        $yFont = imagefontheight($nFont);
//        $imgChar = imagecreatetruecolor($xFont, $yFont);
//        $img = imagecreatetruecolor($x,$y);
//
//        $colBG = imagecolorallocate($img, 255, 255, 255);
//        $colBGchar = imagecolorallocate($imgChar, 255, 255, 255);
//        $colFGchar = imagecolorallocate($imgChar, 0, 0, 0);
//
//        imagefilledrectangle($img, 0, 0, $x, $y, $colBG);
//
//        $length = count($coordinates);
//        $length--;
//        for ($i = 0; $i < $length; $i++)
//        {
//            $X1 = $coordinates[$i][0];
//            $Y1 = $coordinates[$i][1];
//
//            $X2 = $coordinates[$i+1][0];
//            $Y2 = $coordinates[$i+1][1];
//
//            $length_segment = floor(sqrt(abs($X1 - $X2) * abs($X1 - $X2) + abs($Y1 - $Y2) * abs($Y1 - $Y2)));
//
//            $count_char = $length_segment / $xFont;
//            if ($count_char < 1)
//            {
//                continue;
//            }
//            else
//            {
//                $count_char = floor($count_char);
//            };
//
//            $imgChar = imagecreatetruecolor($xFont*$count_char, $yFont);
//
//            $alfaRad = atan(abs(($Y1 - $Y2)/($X1 - $X2)));
//            if ($Y1 > $Y2)
//            {
//                $alfaRad = - $alfaRad;
//            };
//            $alfaDeg = rad2deg($alfaRad);
//
//            if ($this->text == '') {break;};
//            $sub_text = substr($this->text,0,$count_char);
//            $this->text = substr_replace($this->text,'',0,$count_char);
//
//            imagefilledrectangle($imgChar, 0, 0, $xFont*$count_char, $yFont, $colBGchar);
//            imagestring($imgChar, $nFont, 0, 0, $sub_text, $colFGchar);
//
//            $imgTemp = imagerotate($imgChar,-$alfaDeg,$colBGchar);
//            $xTemp = imagesx($imgTemp);
//            $yTemp = imagesy($imgTemp);
//
//            $xBase = $X1 + cos($alfaRad) * $xFont;
//            $yBase = $Y1 + sin($alfaRad) * $xFont;
//
//            $Xn = $xBase;
//            $Yn = $yBase - cos($alfaRad)*$yFont;
//
//            imagecopy($img, $imgTemp,$Xn,$Yn,0,0,$xTemp, $yTemp);
//
//            if ($this->view_line)
//            {
//                imageline($img,$X1,$Y1,$X2,$Y2,$colFGchar);
//            };
//        };
//        $this->image = $img;
//        return true;
//    }
//};
//
//$img = new ImageText();
//$arr = Array (
//    Array(0,100),
//    Array(100,120),
//    Array(200,130),
//    Array(500,180)
//);
//
//$arr = 'a:4:{i:0;a:2:{i:0;i:0;i:1;i:100;}i:1;a:2:{i:0;i:100;i:1;i:120;}i:2;a:2:{i:0;i:200;i:1;i:130;}i:3;a:2:{i:0;i:500;i:1;i:180;}}';
//if (isset($_GET['arr']))
//{
//    $arr = $_GET['arr'];
//};
//
//$img->text = 'Text to polyline. Text to polyline. Text to polyline. Text to polyline.';
//$img->view_line = true;
//$img -> toPolyline($arr);
//
//header("Content-type: image/jpeg");
//imagejpeg($img->image);
?> 

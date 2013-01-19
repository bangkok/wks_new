<?ob_start("ob_gzhandler");?>
<?
require_once "../../../system/application/site/libraries/XML_RSS/RSS.php";
require ("../../conf.inc.php");

$ident=@mysql_connect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
mysql_select_db($base);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);

$query = "SELECT linkMan FROM rsschannel WHERE id='$_GET[id]'";
$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
list($link) = mysql_fetch_row($res);
$urls = array($link);

function iconv_my(&$item1, $key)
{
	if (!is_array($item1))
	{
		$item1 = iconv("UTF-8","windows-1251",$item1);
		$item1 = ereg_replace("'","\'",$item1);
	}
}

foreach ($urls as $url)
{

	$rss =& new XML_RSS($url);
	$rss->parse();

	$struct = $rss->getStructure();
	$chi = $rss->getChannelInfo();
	$img = $rss->getImages();
	$txt = $rss->getTextinputs();
	$items = $rss->getItems();

	if (isset($chi))
	{
		array_walk($chi,'iconv_my');

		if (!isset($chi[ttl])) $chi[ttl] = 0;
		if (!isset($chi[skipHours])) $chi[skipHours] = 0;
		if (!isset($chi[skipDays])) $chi[skipDays] = 0;

		$query = "UPDATE rsschannel SET
				title='$chi[title]', description='$chi[description]', link='$chi[link]',  
				category='$chi[category]', language='$chi[language]', copyright='$chi[copyright]',
				ttl=$chi[ttl], skipHours=$chi[skipHours], skipDays=$chi[skipDays]  
			WHERE id='$_GET[id]'";
		mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
	}
	if (isset($img[0]))
	{
		array_walk($img[0],'iconv_my');

		if (!isset($img[0][width])) $img[0][width] = 0;
		if (!isset($img[0][height])) $img[0][height] = 0;

		$query = "DELETE FROM rssimage WHERE idCh='$_GET[id]'";
		mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
		$query = "INSERT INTO rssimage (`idCh`, `title`, `description`, `link`, `url`, `width`, `height`) VALUES
				('$_GET[id]', '".$img[0][title]."', '".$img[0][description]."', '".$img[0][link]."',
	            '".$img[0][url]."', '".$img[0][width]."', '".$img[0][height]."')";
		mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
	}

	$i=0;
	foreach ($items as $item)
	{
		$enclosures = $item[enclosures];
		if (isset($item))
		{
			array_walk($item,'iconv_my');

			$query = "SELECT count(*) AS cnt FROM rssitem_all WHERE idCh='$_GET[id]' AND (pubDate='".date("Y-m-d H:i:s",strtotime($item[pubdate]))."' AND (pubDate<>'1970-01-01 02:00:00' OR link='".$item[link]."'))";
			$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
			list($cnt) = mysql_fetch_row($res);
			if ($cnt == 0)
			{
				$query = "INSERT INTO `rssitem_all` (`idCh` , `link` , `pubDate` )
						VALUES (
						'$_GET[id]' , '$item[link]',
						'".date("Y-m-d H:i:s",strtotime($item[pubdate]))."')";
				mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
				
				$query = "INSERT INTO `rssitem` (`idCh` , `title` , `description` , `link` ,
						`author` , `category` , `comments` , `guid` , `pubDate` )
						VALUES (
						'$_GET[id]' , '$item[title]', '$item[description]', '$item[link]',
						'$item[author]', '$item[category]', '$item[comments]', '$item[guid]', 
						'".date("Y-m-d H:i:s",strtotime($item[pubdate]))."')";
				mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
				$autoID = mysql_insert_id();
				if (is_array($enclosures))
				{
					foreach ($enclosures as $enc)
					{
						if (ereg("image",$enc[type]))
						{
							if (isset($enc))
							{
								array_walk($enc,'iconv_my');
								
								if (!isset($enc[length])) $enc[length] = 0;
								
								$query = "INSERT INTO `rssenclosure`
									( `idItem` , `url` , `length` , `type` ) VALUES 
									( '$autoID', '$enc[url]', '$enc[length]', '$enc[type]')";
								mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
							}
						}
					}
				}
				$i++;
			}
		}
	}

	print "<h2>Добавлено $i новостей.</h2>";
}
?>
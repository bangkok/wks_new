<?
####################################################
# Created 10.08.2001 
# Modify  13.09.2002 
# Admin utility
####################################################
$server='localhost';
$login='mxml';
$password='sdkjfg3';
$base='mxml';

$admin_mail="alternativago@gmail.com";
$site_name="ADMIN";
$email_from="alternativago@gmail.com";

function mysql_die2($st_param, $flag)
{
	GLOBAL $admin_mail, $auth_site, $base, $body;
	GLOBAL $Error;
	$str="MySQL Error: \n";
	$str.=mysql_error()."\n".$st_param;
	echo "<!-- ADMIN alternativago@gmail.com --><!doctype HTML Public \"-//w3c//dtd html 4.0 Transitional//en\"><html><head><title>$Error</title><meta name=\"Author\" content=\"ADMIN alternativago@gmail.com\"></head>$body<div align=center><font>";
	echo $st_param;
	echo "</font></div></body></html>";
	$mail_to=$admin_mail;
	if (!$flag)
	{
		$query = "SELECT adem FROM nrad WHERE ader='y'";
		if ($result = mysql_db_query($base, $query))
			while(list($em) = mysql_fetch_row($result))
			{
				$mail_to.=", $em";
			}
	}
	@mail ($mail_to,convert_cyr_string ("$site_name ($href) Error", 'w', 'k'),convert_cyr_string ($str, 'w', 'k'),"X-Mailer: PHP/".phpversion());
	exit();
}

/***************************************
** Title.........: HTML Mime Mail class
** Version.......: 1.35
** Author........: Richard Heyes <richard.heyes@heyes-computing.net>
** Filename......: html_mime_mail.class
** Last changed..: 13/07/01
** Notes.........: Based upon mime_mail.class
**                 by Tobias Ratschiller <tobias@dnet.it>
**                 and Sascha Schumann <sascha@schumann.cx>.
**                 See http://www.heyes-computing.net/scripts/
**                 for full tar/zip if you haven't got one.
***************************************/

class html_mime_mail
{
	var $mime;
	var $html;
	var $body;
	var $do_html;
	var $multipart;
	var $html_text;
	var $html_images;
	var $headers;
	var $parts;
	var $charset;
	var $charsetlist;

	function html_mime_mail($headers = '')
	{
			$this->html_images = array();
			$this->headers     = array();
			$this->parts       = array();
			$this->charsetlist = array('iso'  => 'us-ascii',
									   'big5' => 'big5',
									   'gb'   => 'gb2312');

			$this->charset     = 'us-ascii';

			if($headers == '') return TRUE;
			if(is_string($headers)) $headers = explode("\n", trim($headers));
			for($i=0; $i<count($headers); $i++)
			{
					if(is_array($headers[$i])) for($j=0; $j<count($headers[$i]); $j++) if($headers[$i][$j] != '') $this->headers[] = $headers[$i][$j];
					if($headers[$i] != '') $this->headers[] = $headers[$i];
			}
	}

	function set_body($text = '')
	{
			if(is_string($text))
			{
					$this->body = $text;
					return TRUE;
			}
			return FALSE;
	}

	function get_mime()
	{
			if(!isset($this->mime)) $this->mime = '';
			return $this->mime;
	}

	function add_header()
	{
			if((int)phpversion() < 4) return FALSE;
			$args = func_get_args();
			for($i=0; $i<count($args); $i++)
			{
					if(is_array($args[$i])) for($j=0; $j<count($args[$i]); $j++) if($args[$i][$j] != '') $this->headers[] = $args[$i][$j];
					if($args[$i] != '') $this->headers[] = $args[$i];
			}
			return TRUE;
	}

	function set_charset($charset = '', $raw = FALSE)
	{

			if($raw == TRUE)
			{
					$this->charset = $charset;
					return TRUE;
			}

			if(is_string($charset))
			{
					while(list($k,$v) = each($this->charsetlist))
					{
							if($k == $charset)
							{
									$this->charset = $v;
									return TRUE;
							}
					}
		}
		return FALSE;
	}

	function add_html($html, $text)
	{
			$this->do_html   = 1;
			$this->html      = $html;
			$this->html_text = $text;
			if(is_array($this->html_images) AND count($this->html_images) > 0)
			{
					for($i=0; $i<count($this->html_images); $i++) $this->html = ereg_replace($this->html_images[$i]['name'], 'cid:'.$this->html_images[$i]['cid'], $this->html);
			}
	}

	function build_html($orig_boundary)
	{
			$sec_boundary = '=_'.md5(uniqid(time()));
			$thr_boundary = '=_'.md5(uniqid(time()));

			if(count($this->html_images) == 0)
			{
					$this->multipart.= '--'.$orig_boundary."\n";
					$this->multipart.= 'Content-Type: multipart/alternative;'.chr(10).chr(9).'boundary="'.$sec_boundary."\"\n\n\n";

					$this->multipart.= '--'.$sec_boundary."\n";
					$this->multipart.= 'Content-Type: text/plain; charset="'.$this->charset.'"'."\n";
					$this->multipart.= 'Content-Transfer-Encoding: base64'."\n\n";
					$this->multipart.= chunk_split(base64_encode($this->html_text))."\n\n";

					$this->multipart.= '--'.$sec_boundary."\n";
					$this->multipart.= 'Content-Type: text/html; charset="'.$this->charset.'"'."\n";
					$this->multipart.= 'Content-Transfer-Encoding: base64'."\n\n";
					$this->multipart.= chunk_split(base64_encode($this->html))."\n\n";
					$this->multipart.= '--'.$sec_boundary."--\n\n";
			}
			else
			{
					$this->multipart.= '--'.$orig_boundary."\n";
					$this->multipart.= 'Content-Type: multipart/related;'.chr(10).chr(9).'boundary="'.$sec_boundary."\"\n\n\n";

					$this->multipart.= '--'.$sec_boundary."\n";
					$this->multipart.= 'Content-Type: multipart/alternative;'.chr(10).chr(9).'boundary="'.$thr_boundary."\"\n\n\n";

					$this->multipart.= '--'.$thr_boundary."\n";
					$this->multipart.= 'Content-Type: text/plain; charset="'.$this->charset.'"'."\n";
					$this->multipart.= 'Content-Transfer-Encoding: base64'."\n\n";
					$this->multipart.= chunk_split(base64_encode($this->html_text))."\n\n";

					$this->multipart.= '--'.$thr_boundary."\n";
					$this->multipart.= 'Content-Type: text/html'."\n";
					$this->multipart.= 'Content-Transfer-Encoding: base64'."\n\n";
					$this->multipart.= chunk_split(base64_encode($this->html))."\n\n";
					$this->multipart.= '--'.$thr_boundary."--\n\n";

					for($i=0; $i<count($this->html_images); $i++)
					{
							$this->multipart.= '--'.$sec_boundary."\n";
							$this->build_html_image($i);
					}

					$this->multipart.= "--".$sec_boundary."--\n\n";
			}
	}

	function add_html_image($file, $name = '', $c_type='application/octet-stream')
	{
			$this->html_images[] = array( 'body'   => $file,
										  'name'   => $name,
										  'c_type' => $c_type,
										  'cid'    => md5(uniqid(time())) );
	}

	function add_attachment($file, $name = '', $c_type='application/octet-stream')
	{
			$this->parts[] = array( 'body'   => $file,
									'name'   => $name,
									'c_type' => $c_type );
	}

	function build_html_image($i)
	{
			$this->multipart.= 'Content-Type: '.$this->html_images[$i]['c_type'];

			if($this->html_images[$i]['name'] != '') $this->multipart .= '; name="'.$this->html_images[$i]['name']."\"\n";
			else $this->multipart .= "\n";

			$this->multipart.= 'Content-Transfer-Encoding: base64'."\n";
			$this->multipart.= 'Content-ID: <'.$this->html_images[$i]['cid'].">\n\n";
			$this->multipart.= chunk_split(base64_encode($this->html_images[$i]['body']))."\n";
	}

	function build_part($i)
	{
			$message_part = '';
			$message_part.= 'Content-Type: '.$this->parts[$i]['c_type'];
			if($this->parts[$i]['name'] != '')
					$message_part .= '; name="'.$this->parts[$i]['name']."\"\n";
			else
					$message_part .= "\n";

			if($this->parts[$i]['c_type'] == 'text/plain')
			{
					$message_part.= 'Content-Transfer-Encoding: base64'."\n\n";
					$message_part.= chunk_split(base64_encode($this->parts[$i]['body']))."\n";
			}
			elseif($this->parts[$i]['c_type'] == 'message/rfc822')
			{
					$message_part.= 'Content-Transfer-Encoding: 7bit'."\n\n";
					$message_part.= $this->parts[$i]['body']."\n";
			}
			else
			{
					$message_part.= 'Content-Transfer-Encoding: base64'."\n";
					$message_part.= 'Content-Disposition: attachment; filename="'.$this->parts[$i]['name']."\"\n\n";
					$message_part.= chunk_split(base64_encode($this->parts[$i]['body']))."\n";
			}

			return $message_part;
	}

	function build_message()
	{
			$boundary = '=_'.md5(uniqid(time()));

			$this->headers[] = 'MIME-Version: 1.0';
			$this->headers[] = 'Content-Type: multipart/mixed;'.chr(10).chr(9).'boundary="'.$boundary.'"';
			$this->multipart = "This is a MIME encoded message.\n\n";

			if(isset($this->do_html) AND $this->do_html == 1) $this->build_html($boundary);
			if(isset($this->body) AND $this->body != '') $this->parts[] = array('body' => $this->body, 'name' => '', 'c_type' => 'text/plain');

			for($i=(count($this->parts)-1); $i>=0; $i--)
			{
					$this->multipart.= '--'.$boundary."\n".$this->build_part($i);
			}

			$this->mime = $this->multipart."--".$boundary."--\n";
	}

	function send($to_name, $to_addr, $from_name, $from_addr, $subject = '', $headers = '')
	{

			if($to_name != '') $to = '"'.$to_name.'" <'.$to_addr.'>';
			else $to = $to_addr;

			if($from_name != '') $from = '"'.$from_name.'" <'.$from_addr.'>';
			else $from = $from_addr;

			if(is_string($headers)) $headers = explode("\n", trim($headers));
			for($i=0; $i<count($headers); $i++)
			{
					if(is_array($headers[$i])) for($j=0; $j<count($headers[$i]); $j++) if($headers[$i][$j] != '') $xtra_headers[] = $headers[$i][$j];
					if($headers[$i] != '') $xtra_headers[] = $headers[$i];
			}
			if(!isset($xtra_headers)) $xtra_headers = array();

			mail($to, $subject, $this->mime, 'From: '.$from."\n".implode("\n", $this->headers)."\n".implode("\n", $xtra_headers));
	}

	function smtp_send($smtp_obj, $from_addr, $to_addr, $subject, $xtra_headers = '')
	{
			global $$smtp_obj;
			$smtp_obj = $$smtp_obj;

			$headers   = $this->headers;
			$headers[] = 'From: '.$from_addr;
			$headers[] = 'Subject: '.$subject;
			if(is_array($xtra_headers)) for(reset($xtra_headers); list(,$header) = each($xtra_headers); ) $headers[] = $header;

			$smtp_obj->sendmessage($from_addr, $to_addr, $headers, $this->mime);
	}

	function get_rfc822($to_name, $to_addr, $from_name, $from_addr, $subject = '', $headers = '')
	{

			$date = 'Date: '.date('D, d M y H:i:s');

			if($to_name != '') $to = 'To: "'.$to_name.'" <'.$to_addr.'>';
			else $to = 'To: '.$to_addr;

			if($from_name != '') $from = 'From: "'.$from_name.'" <'.$from_addr.'>';
			else $from = 'From: '.$from_addr;

			if(is_string($subject)) $subject = 'Subject: '.$subject;

			if(is_string($headers)) $headers = explode("\n", trim($headers));
			for($i=0; $i<count($headers); $i++)
			{
					if(is_array($headers[$i])) for($j=0; $j<count($headers[$i]); $j++) if($headers[$i][$j] != '') $xtra_headers[] = $headers[$i][$j];
					if($headers[$i] != '') $xtra_headers[] = $headers[$i];
			}
			if(!isset($xtra_headers)) $xtra_headers = array();

			return $date."\n".$from."\n".$to."\n".$subject."\n".implode("\n", $this->headers)."\n".implode("\n", $xtra_headers)."\n\n".$this->mime;
	}
}

@mysql_close(); 
$ident=@mysql_connect($server,$login,$password) or mysql_die2("������ ���������� � MySQL ��������.", true);


# ���������� � �������
$query="SELECT mmid, mmmc FROM nrmm WHERE mmnw='n' AND (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(mmds))>=0 AND nrmm.dl='n'"; 
$result = mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
while (list($mail_id, $mmmc) = mysql_fetch_row($result))
{
	$query="INSERT nrmt (mtmm, mtml, mtda) SELECT '$mail_id', mlid, '".date("Y-m-d H:i:s")."' FROM nrml WHERE nrml.dl='n' AND mlcf='r' AND mlmc='$mmmc'"; 
	mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
	$COUNT_mlid = mysql_affected_rows();// $COUNT_mlid = 0; //or mysql_die2("������ MySQL �������! ".mysql_error(), false);

	$query="UPDATE nrmm SET mmnw='y' WHERE mmid='$mail_id'";
	mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);

	$query="SELECT mmds FROM nrmm WHERE mmid='$mail_id'";
	$res = mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
	list($TIME_send) = mysql_fetch_row($res);

	$str_print = "� ������� ���������� - $COUNT_mlid ������(��). ����� ������� - $TIME_send. ($site_name)\n";
	@mail($admin_mail, convert_cyr_string($str_print,'w','k'), convert_cyr_string($str_print,'w','k'), "From: ".$email_from."\n");
	//print convert_cyr_string($str_print,'w','k');
}
$str_print = "";

$query="SELECT moqt, mofq, ((UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(mods))/60) FROM nrmo LIMIT 1"; 
$result = mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
if (list($moqt, $mofq, $mods) = mysql_fetch_row($result))
{
	if ($mofq < $mods)
	{
		$query="UPDATE nrmo SET mods='".date("Y-m-d H:i:s")."'"; 
		mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);

		$query="SELECT COUNT(mlid) FROM nrml, nrmt WHERE mtml=mlid AND nrml.dl='n' AND mlcf='r'"; 
		$result = mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
		if (list($COUNT_mlid) = mysql_fetch_row($result))
		{
			if ($COUNT_mlid > 0)
			{
				$query="SELECT mmid, mmst, mmad, mmfr, mmnm, mmmlt, mmmlh, mmi1, mmi1_fnm, mmi2, mmi2_fnm, mmi3, mmi3_fnm, mmfl, mmfl_fnm, mmds FROM nrmm, nrmt WHERE mtmm=mmid AND (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(mmds))>=0 AND nrmm.dl='n' LIMIT 1"; 
				$result = mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
				if(list($mmid, $site_name, $admin_mail, $email_from, $subj, $text, $html, $image1, $im1_name, $image2, $im2_name, $image3, $im3_name, $attach, $attachment_name, $mmds) = mysql_fetch_row($result))
				{
					$mail = new html_mime_mail('X-Mailer: Html Mime Mail Class for site <'.$site_name.">");

					if ($html!='')
					{
						if ($im1_name!='')
						{
							$image1=base64_decode($image1);
							$ext = substr($im1_name, strrpos($im1_name, ".")+1);
							switch (strtoupper($ext)) 
							{
								case "JPEG":
									$c_type="image/jpeg";
									break;
								case "JPG":
									$c_type="image/jpeg";
									break;
								case "PNG":
									$c_type="image/png";
									break;
								case "GIF":
									$c_type="image/gif";
									break;
								default:
									$c_type="application/octetstream";
							}
							$mail->add_html_image($image1, $im1_name, $c_type);
						}
						if ($im2_name!='')
						{
							$image2=base64_decode($image2);
							$ext = substr($im2_name, strrpos($im2_name, ".")+1);
							switch (strtoupper($ext)) 
							{
								case "JPEG":
									$c_type="image/jpeg";
									break;
								case "JPG":
									$c_type="image/jpeg";
									break;
								case "PNG":
									$c_type="image/png";
									break;
								case "GIF":
									$c_type="image/gif";
									break;
								default:
									$c_type="application/octetstream";
							}
							$mail->add_html_image($image2, $im2_name, $c_type);
						}
						if ($im3_name!='')
						{
							$image3=base64_decode($image3);
							$ext = substr($im3_name, strrpos($im3_name, ".")+1);
							switch (strtoupper($ext)) 
							{
								case "JPEG":
									$c_type="image/jpeg";
									break;
								case "JPG":
									$c_type="image/jpeg";
									break;
								case "PNG":
									$c_type="image/png";
									break;
								case "GIF":
									$c_type="image/gif";
									break;
								default:
									$c_type="application/octetstream";
							}
							$mail->add_html_image($image3, $im3_name, $c_type);
						}
						$mail->add_html(stripslashes(convert_cyr_string($html,'w','k')), stripslashes(convert_cyr_string($text,'w','k')));
					}
					elseif ($text!='')
					{
						$mail->set_body(stripslashes(convert_cyr_string($text,'w','k')));
					}
					if ($attachment_name!='')
					{
						$attach=base64_decode($attach);
						$mail->add_attachment($attach, $attachment_name, 'application/octet-stream');
					}
					$mail->set_charset('koi8-r', TRUE);
					$mail->build_message();
					
					$query="SELECT mlid, mlnm, mlcf, mlcd FROM nrml, nrmt, nrmm WHERE mtml=mlid AND mtmm=mmid AND nrml.dl='n' AND (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(mmds))>=0 AND mlcf='r' ORDER BY mmds LIMIT $moqt"; 
					$result = mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
					while(list($mlid, $mlnm, $mlcf, $mlcd) = mysql_fetch_row($result))
					{
						$mail->send(convert_cyr_string(''.$site_name.'','w','k'), $mlnm, convert_cyr_string(''.$site_name.'','w','k'), $email_from, convert_cyr_string($subj,'w','k'));
						$query="DELETE FROM nrmt WHERE mtml='$mlid'"; 
						mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
					}

					$query="SELECT COUNT(mlid) FROM nrml, nrmt WHERE mtml=mlid AND nrml.dl='n' AND mlcf='r'"; 
					$result = mysql_db_query($base, $query) or mysql_die2("������ MySQL �������! ".mysql_error(), false);
					list($COUNT_mlid) = mysql_fetch_row($result);

					if ($COUNT_mlid==0)
					{
						$str_print = "� ������� �������� - $COUNT_mlid �������. ($site_name)\n";
						@mail($admin_mail, convert_cyr_string($str_print,'w','k'), convert_cyr_string($str_print,'w','k'), "From: ".$email_from."\n");
					}
				}
			}
			else
			{
				$str_print = "������� �����! ($site_name)\n";
			}
		}
		else
		{
			$str_print = "������ ���������� ������! ($site_name)\n";
		}
	}
	else
	{
		$str_print = "�������� ���������� �������! ($site_name)\n";
	}
}
#print convert_cyr_string($str_print,'w','k');
?>
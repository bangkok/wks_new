<?
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
?>
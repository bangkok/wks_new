<?
if ($op=='a')
{
	if ($fields['mmmc']=='') $fields['mmmc']=0;
	print "<hr>";
	include('html_mime_mail_func.inc.php');

	$first=true;
	$table_def = mysql_db_query($base, "SHOW FIELDS FROM $table") or mysql_die("Ошибка счит. полей таблицы <b>$table</b>", false);
	$row_for_searche="*";
	$first=true;
	for($i=0;$i<mysql_num_rows($table_def);$i++)
	{
		if ($inp_text_k[$i]=="y")
		{
			if ($first)
			{
				$where=$inp_text[$i]."='".$id[$i]."'";
				$first=false;
			}
			else
			{
				$where.=" AND ".$inp_text[$i]."='".$id[$i]."'";
			}
		}
	}

	$query="SELECT mmid, mmst, mmad, mmfr, mmnm, mmmlt, mmmlh, mmi1, mmi1_fnm, mmi2, mmi2_fnm, mmi3, mmi3_fnm, mmfl, mmfl_fnm, mmds FROM nrmm WHERE $where AND mmnw='y' AND nrmm.dl='n' AND mmmc='".$fields['mmmc']."' LIMIT 1"; 
	$result = mysql_db_query($base, $query) or mysql_die("Ошибка MySQL запроса! ".mysql_error(), false);

	if (list($mmid, $site_name, $admin_mail, $email_from, $subj, $text, $html, $image1, $im1_name, $image2, $im2_name, $image3, $im3_name, $attach, $attachment_name, $mmds) = mysql_fetch_row($result))
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
//			$mail->add_html(stripslashes(convert_cyr_string($html,'w','k')), stripslashes(convert_cyr_string($text,'w','k')));
			$mail->add_html(stripslashes($html), stripslashes($text));
		}
		elseif ($text!='')
		{
//			$mail->set_body(stripslashes(convert_cyr_string($text,'w','k')));
			$mail->set_body(stripslashes($text));
		}
		if ($attachment_name!='')
		{
			$attach=base64_decode($attach);
			$mail->add_attachment($attach, $attachment_name, 'application/octet-stream');
		}
//		$mail->set_charset('koi8-u', TRUE);
		$mail->set_charset('windows-1251', TRUE);
		$mail->build_message();

		$i=0;
		$query="SELECT mlnm FROM nrml WHERE mlmc='".$fields['mmmc']."' AND mlcf='r' AND dl='n'";
		$result = mysql_db_query($base, $query) or mysql_die("Ошибка MySQL запроса! ".mysql_error(), false);
		while(list($mlnm) = mysql_fetch_row($result))
		{
//			$mail->send(convert_cyr_string(''.$site_name."",'w','k'), $mlnm, convert_cyr_string(''.$site_name.'','w','k'), $email_from, convert_cyr_string($subj,'w','k'));
			$mail->send($site_name, $mlnm, $site_name, $email_from, $subj);
			$i++;
		}
		print "<div align=center>";
		print "Успешно отослано - <b>$i</b> писем.";
		print "</div>";
	}
	else
	{
		print "<div align=center>";
		$query="SELECT COUNT(mlid) FROM nrml WHERE mlmc='".$fields['mmmc']."' AND nrml.dl='n' AND mlcf='r'"; 
		$result = mysql_db_query($base, $query) or mysql_die("Ошибка MySQL запроса! ".mysql_error(), false);
		list($R_mlid) = mysql_fetch_row($result);

		$query="SELECT COUNT(mlid) FROM nrml WHERE mlmc='".$fields['mmmc']."' AND nrml.dl='n' AND mlcf='d'"; 
		$result = mysql_db_query($base, $query) or mysql_die("Ошибка MySQL запроса! ".mysql_error(), false);
		list($D_mlid) = mysql_fetch_row($result);

		$query="SELECT COUNT(mlid) FROM nrml WHERE mlmc='".$fields['mmmc']."' AND nrml.dl='n' AND mlcf='c'"; 
		$result = mysql_db_query($base, $query) or mysql_die("Ошибка MySQL запроса! ".mysql_error(), false);
		list($C_mlid) = mysql_fetch_row($result);

		print "Категория: <b>".$fields['mmmc']."</b><br>";
		print "Зарегестрировано: <b>".($R_mlid+$D_mlid+$C_mlid)."</b><br>";
		print "Подтвержденных: <b>".$R_mlid."</b><br>";
		print "Неподтвержденных: <b>".$C_mlid."</b><br>";
		print "Отписалось: <b>".$D_mlid."</b><hr>";
	}
}
?>
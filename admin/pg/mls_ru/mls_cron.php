#!/usr/local/bin/php
<?
####################################################
# Created 10.08.2001 
# Modify  13.09.2002 
# Admin utility
####################################################
//$HTTP_HOST='nailer.sourceforge.net';
require ("../../conf.inc.php");
include('html_mime_mail_func.inc.php');

$ident=@mysql_connect($server,$login,$password) or mysql_die("������ ���������� � MySQL ��������.", true);

# ���������� � �������
$query="SELECT mmid, mmmc FROM nrmm WHERE mmnw='n' AND (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(mmds))>=0 AND nrmm.dl='n'"; 
$result = mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
while (list($mail_id, $mmmc) = mysql_fetch_row($result))
{
	$query="INSERT nrmt (mtmm, mtml, mtda) SELECT '$mail_id', mlid, '".date("Y-m-d H:i:s")."' FROM nrml WHERE nrml.dl='n' AND mlcf='r' AND mlmc='$mmmc'"; 
	mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
	$COUNT_mlid = mysql_affected_rows();// or mysql_die("������ MySQL �������! ".mysql_error(), false);

	$query="UPDATE nrmm SET mmnw='y' WHERE mmid='$mail_id'";
	mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);

	$query="SELECT mmds FROM nrmm WHERE mmid='$mail_id'";
	$res = mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
	list($TIME_send) = mysql_fetch_row($res);

	$str_print = "� ������� ���������� - $COUNT_mlid ������(��). ����� ������� - $TIME_send. ($site_name)\n";
	@mail($admin_mail, convert_cyr_string($str_print,'w','k'), convert_cyr_string($str_print,'w','k'), "From: ".$email_from."\n");
	print convert_cyr_string($str_print,'w','k');
}
$str_print = "";

$query="SELECT moqt, mofq, ((UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(mods))/60) FROM nrmo LIMIT 1"; 
$result = mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
if (list($moqt, $mofq, $mods) = mysql_fetch_row($result))
{
	if ($mofq < $mods)
	{
		$query="UPDATE nrmo SET mods='".date("Y-m-d H:i:s")."'"; 
		mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);

		$query="SELECT COUNT(mlid) FROM nrml, nrmt WHERE mtml=mlid AND nrml.dl='n' AND mlcf='r'"; 
		$result = mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
		if (list($COUNT_mlid) = mysql_fetch_row($result))
		{
			if ($COUNT_mlid > 0)
			{
				$query="SELECT mmid, mmst, mmad, mmfr, mmnm, mmmlt, mmmlh, mmi1, mmi1_fnm, mmi2, mmi2_fnm, mmi3, mmi3_fnm, mmfl, mmfl_fnm, mmds FROM nrmm, nrmt WHERE mtmm=mmid AND (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(mmds))>=0 AND nrmm.dl='n' LIMIT 1"; 
				$result = mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
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
					$result = mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
					while(list($mlid, $mlnm, $mlcf, $mlcd) = mysql_fetch_row($result))
					{
						$mail->send(convert_cyr_string(''.$site_name.'','w','k'), $mlnm, convert_cyr_string(''.$site_name.'','w','k'), $email_from, convert_cyr_string($subj,'w','k'));
						$query="DELETE FROM nrmt WHERE mtml='$mlid'"; 
						mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
					}

					$query="SELECT COUNT(mlid) FROM nrml, nrmt WHERE mtml=mlid AND nrml.dl='n' AND mlcf='r'"; 
					$result = mysql_db_query($base, $query) or mysql_die("������ MySQL �������! ".mysql_error(), false);
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
print convert_cyr_string($str_print,'w','k');
?>
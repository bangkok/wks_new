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
 * Functions
 */

function mysql_die($st_param, $flag)
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

Function authorize(
	$a	# first login
	)
{
	GLOBAL $base, $PHP_AUTH_USER, $SERVER_PORT, $PHP_AUTH_PW, $HTTP_HOST, $REMOTE_ADDR, $REDIRECT_URL, $REQUEST_URI, $SERVER_ADDR, $HTTP_REFERER, $table, $t, $auth_site, $body, $bg1, $bg2, $bg3, $bg4, $bg5, $bg6, $bg7, $bg8, $bg9, $op, $Search_res, $adsu, $site_name, $admin_mail, $version, $operation, $PHP_AUTH_ROLE, $PHP_SU, $use_cookie, $no_https_adm;
	GLOBAL $SystemDataAdministrationConf, $CharSet, $LoginConf, $PasswordConf, $EnterConf, $TechServiceConf, $VerConf, $AuthRequiredConf, $MySQLError;

	if (!isset($table)) $table=$t;
	$body_="<body bgcolor=#FFFFFF text=#3f6f9f link=#336699 vlink=#996699 alink=#4477aa onLoad=\"self.focus();\"><style type=\"text/css\">
<!--
TD { font-family: Tahoma, sans-serif;
	font-size: 12px;
	font-weight : normal;
}
TD.b { font-family: Tahoma, sans-serif;
	font-size: 12px;
	font-weight : bold;
}
FONT { font-family: Tahoma, sans-serif;
	font-size: 12px;
	font-weight : normal;
}
FONT.b { font-family: Tahoma, sans-serif;
	font-size: 12px;
	font-weight : bold;
}
FONT.copy { font-family: Tahoma Cyr,sans-serif;
	font-size: 10px;
	font-weight : normal;
}
INPUT {
	border : 1px solid;
	font-size: 12px;
	font-family: Courier New, monospace;
	color: #3f6f9f;
	font-weight: normal;
	background-color: #FFFFFF;
	border-color: #333333;
}
.button {
	border : solid;
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #3f6f9f;
	font-weight: bold;
	border-top-width : 1px;
	border-right-width : 1px;
	border-bottom-width : 1px;
	border-left-width : 1px;
	font-style : normal;
}
FORM { margin: 0px;
	padding: 0px;
}
A:link { text-decoration: none; }
A:activ { text-decoration: none; }
A:visited { text-decoration: none; }
A:hover { text-decoration: none; }
-->
</style>";
	$count_login=0;
	$tlim=300;
	$PHP_SU=false;

	$query = "SELECT COUNT(*) FROM nrad";
	$result = mysql_db_query($base, $query) or mysql_die($MySQLError, false);
	list($count_login) = mysql_fetch_row($result);

	if ($count_login>0)
	{
		if (!isset($PHP_AUTH_USER)) 
		{
//			if ($SERVER_PORT=='443' || $HTTP_HOST=='localhost')
			{
				print "<!-- ADMIN alternativago@gmail.com -->";
				print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
				print "<html>";
				print "<head>";
				print "<title>".$SystemDataAdministrationConf."</title>";
				print "<meta name=\"Author\" content=\"ADMIN alternativago@gmail.com\">";
				print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$CharSet."\">";
				print "</head>";
				print $body_;
				print "<br>";
				//print "<div align=center><a href=\"#/\" target=_blank><img src=\"$no_https_adm"."img/logo_nailer.gif\" width=100 height=30 border=0 alt=\"ADMIN\"></a></div>";
				print "<div align=center>";
				print "<form method=post action=\"$REQUEST_URI\">";
				print "<table border=0>";
				print "<tr>";
				print "<td>";
				print $LoginConf." ";
				print "</td>";
				print "<td>";
				print "<input type=text name=PHP_AUTH_USER><br>";
				print "</td>";
				print "</tr>";
				print "<tr>";
				print "<td>";
				print $PasswordConf." ";
				print "</td>";
				print "<td>";
				print "<input type=password name=PHP_AUTH_PW><br>";
				print "</td>";
				print "</tr>";
				print "</table>";
				print "<input type=submit value=\"".$EnterConf."\" class=button>";
				print "</form>";
				print "<br>";
				print "<font class=mini>";
				//print "<a href=\"mailto:$admin_mail\">".$TechServiceConf."</a><br>";
				//print "<a href=\"#/\">&copy;&nbsp;&quot;ADMIN&quot;</a><br>";
				//print $VerConf." $version (SE)";
				print "</font>";
				print "</div>";
				print "</body>";
				print "</html>";
				exit;
			}
/*			else
			{
				header("WWW-Authenticate: Basic realm=\"Authorize for $auth_site\"");
				header("HTTP/1.0 401 Unauthorized");
				print $AuthRequiredConf;
				exit;
			}*/
		} 
		elseif (isset($PHP_AUTH_USER))
		{
			if ($a!='y')
			{
				$query = "SELECT UNIX_TIMESTAMP(lgdt) FROM nrlg WHERE lgid='$PHP_AUTH_USER' ORDER BY lgdt DESC LIMIT 1";
				$result = mysql_db_query($base, $query) or mysql_die($MySQLError, false);
				list($lgdt) = mysql_fetch_row($result);
			}
			else
			{
				$lgdt=time();
			}

			$query = "SELECT adid, adpw, adbc, adsu, adto, adrl, adsu FROM nrad WHERE adid='$PHP_AUTH_USER' AND adpw=OLD_PASSWORD('$PHP_AUTH_PW')";
			$result = mysql_db_query($base, $query) or mysql_die($MySQLError, false);
			list($adid, $adpw, $bgbc, $adsu, $adto, $adrl, $adsu) = mysql_fetch_row($result);
			$PHP_AUTH_ROLE=$adrl;
			if ($adsu=='y')
				$PHP_SU=true; // || $PHP_AUTH_PW != $adpw

			if ($PHP_AUTH_USER != $adid || mysql_num_rows($result)==0 || $lgdt-time()+$adto < 0)
			{
				$query = "INSERT INTO nrlg (lgid, lgtb, lgst, lgip, lgdt) VALUES ('$PHP_AUTH_USER', '$table', 'error', '".$REMOTE_ADDR."', '".date("Y-m-d H:i:s")."')";
				@mysql_db_query($base, $query) or mysql_die($MySQLError, false);
//				if ($SERVER_PORT=='443' || $HTTP_HOST=='localhost')
				{
					if ($use_cookie==true)
					{
						setcookie("PHP_AUTH_USER","");
					}
					else
					{
						session_unregister("PHP_AUTH_USER");
						session_unregister("PHP_AUTH_PW");
					}
					print "<!-- ADMIN alternativago@gmail.com -->";
					print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
					print "<html>";
					print "<head>";
					print "<title>".$SystemDataAdministrationConf."</title>";
					print "<meta name=\"Author\" content=\"ADMIN alternativago@gmail.com\">";
					print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$CharSet."\">";
					print "</head>";
					print $body_;
					print "<br>";
					//print "<div align=center><a href=\"http://nailer.sourceforge.net/\" target=_blank><img src=\"$no_https_adm"."img/logo_nailer.gif\" width=100 height=30 border=0 alt=\"Nailer\"></a></div>";
					print "<div align=center>";
					print "<form method=post action=\"$REQUEST_URI\">";
					print "<table border=0>";
					print "<tr>";
					print "<td>";
					print $LoginConf." ";
					print "</td>";
					print "<td>";
					print "<input type=text name=PHP_AUTH_USER><br>";
					print "</td>";
					print "</tr>";
					print "<tr>";
					print "<td>";
					print $PasswordConf." ";
					print "</td>";
					print "<td>";
					print "<input type=password name=PHP_AUTH_PW><br>";
					print "</td>";
					print "</tr>";
					print "</table>";
					print "<input type=submit value=\"".$EnterConf."\" class=button>";
					print "</form>";
					print "<br>";
					print "<font class=mini>";
					//print "<a href=\"mailto:$admin_mail\">".$TechServiceConf."</a><br>";
					//print "<a href=\"http://nailer.sourceforge.net/\">&copy;&nbsp;&quot;Nailer&quot;</a><br>";
					//print $VerConf." $version (SE)";
					print "</font>";
					print "</div>";
					print "</body>";
					print "</html>";
					exit;
				}
/*				else
				{
					header("WWW-Authenticate: Basic realm=\"Authorize for $auth_site\"");
					header("HTTP/1.0 401 Unauthorized");
					print $AuthRequiredConf;
					exit;
				}*/
			}
			else
			{
//				if ($SERVER_PORT=='443' || $HTTP_HOST=='localhost')
				{
					if ($use_cookie==true)
					{
						setcookie("PHP_AUTH_USER","$PHP_AUTH_USER");
						setcookie("PHP_AUTH_PW","$PHP_AUTH_PW");
					}
					else
					{
						session_register("PHP_AUTH_USER");
						session_register("PHP_AUTH_PW");
					}
				}
				if ($Search_res!='') $op='sh';
				if ($a=='y') $op='lg';
				if (isset($operation) && $operation!='') $op=$operation;
				if ($op=='') $op='vi';
				if ($op!='')
				{
					$query = "INSERT INTO nrlg (lgid, lgtb, lgop, lgst, lgip, lgdt) VALUES ('$PHP_AUTH_USER', '$table', '$op', 'ok', '".$REMOTE_ADDR."', '".date("Y-m-d H:i:s")."')";
					@mysql_db_query($base, $query) or mysql_die($MySQLError, false);
				}
			}
		} 
	}
	else
	{
		$bgbc='��������';
	}

	$query = "SELECT crb1, crb2, crb3, crb4, crb5, crb6, crb7, crb8, crb9 FROM nrcr WHERE crnm='$bgbc'";
	$result = mysql_db_query($base, $query) or mysql_die($MySQLError, false);
	list($bg1, $bg2, $bg3, $bg4, $bg5, $bg6, $bg7, $bg8, $bg9) = mysql_fetch_row($result);
	$body="<body bgcolor=#$bg6 text=#$bg5 link=#$bg7 vlink=#$bg8 alink=#$bg9 onLoad=\"self.focus();\"><style type=\"text/css\">
<!--
BODY { font-family: Tahoma, sans-serif;
	font-size: 12px;
	font-weight : normal;
}
TD { font-family: Tahoma, sans-serif;
	font-size: 12px;
	font-weight : normal;
}
TD.b { font-family: Tahoma, sans-serif;
	font-size: 12px;
	font-weight : bold;
}
FONT { font-family: Arial Cyr,sans-serif;
	font-size: 12px;
	font-weight : normal;
}
FONT.b { font-family: Arial Cyr,sans-serif;
	font-size: 12px;
	font-weight : bold;
}
FONT.copy { font-family: Tahoma Cyr,sans-serif;
	font-size: 10px;
	font-weight : normal;
}
INPUT {	font-size: 12px;
	font-family: Courier New, monospace;
	color: #$bg5;
	font-weight: normal;
	background-color: #$bg6;
	border-color: #$bg6;
	border : 1px solid;
}
SELECT { font-size: 12px;
	font-family: Courier New, monospace;
	color: #$bg5;
	font-weight: normal;
	background-color: #$bg6;
	border-color: #$bg6;
	border : 1px solid #$bg5;
}
TEXTAREA { font-size: 12px;
	font-family: Courier New, monospace;
	color: #$bg5;
	font-weight: normal;
	background-color: #$bg6;
	border-color: #$bg6;
	border : 1px solid #$bg5;
}
.button {
	border : solid;
	border-top-width : 1px;
	border-right-width : 1px;
	border-bottom-width : 1px;
	border-left-width : 1px;
	font-style : normal;
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #$bg5;
	font-weight: bold;
}
FORM { margin: 0px;
	padding: 0px;
}
A:link { text-decoration: none; }
A:activ { text-decoration: none; }
A:visited { text-decoration: none; }
A:hover { text-decoration: none; }
-->
</style>";
}


# ��������� �� ����������
# 11.03.2004

Function Navig(
	$string,	// ��������. (������������)
	$string2,	// ������. (������������)
	$string3,	// ����������� ��.
	$action,	// ������ �� ��� �� ���-�������� �� ��������� ����� ( {} - ������ ����� ������������� ����� ���. )
	$max_count,	// ����� �������
	$amount,	// �� ������� ���������� �� ���.
	$page_n,	// ������� ���.
	$type,		// ��� ���������
	$dispersion	// �� ������� ���. ����������
	)
{
	GLOBAL $bg7;				// only for this admin

	$class_all = "";			# ����� ���� � ��������� ���������
	$class = "b";				# ����� ������� � ���������
	$color_na = "#$bg7";		# ���� ���������� ���������
	$color_a = "#$bg7";			# ���� �������� ���������
	$size_table = "100%";		# ������ ������� (������)
	$align = "left";			# ������������ ���������
	$delim = "<font class=$class>..</font>";			# ������������� �����������
	$delim2 = " || ";			# ����������� ������
	$ll = "<font class=$class>&lt;&lt; </font>";	# �� ���� ������ �����
	$rr = "<font class=$class> &gt;&gt;</font>";	# �� ���� ������ � �����
	$el = "<font class=$class>|&lt; </font>";		# ������ �������
	$er = "<font class=$class> &gt;|</font>";		# �������� ������� 


	$last = $max_count-floor($max_count/$amount)*$amount;	// ��������� �� ��������� ��������
	$max = 0;	// ������ ������� ���.
	$min = 0;	// ��������� ������� ���.

	if ($max_count>$amount && $type==4) // ������� ������ ��� ���
	{
		print "<table border=0 cellspacing=0 cellpadding=0 width=$size_table>";
		print "<tr>";
		print "<td align=$align class=$class_all>";
		print "<div align=$align>";
		print $string." ".$page_n." ".$string3." ".ceil($max_count/$amount).$delim2;

		$first=true;
		
		if ($dispersion==0)
		{
			$max=$max_count/$amount;
			$min=0;
		}
		else
		{
			$min=ceil($page_n/$dispersion)*$dispersion-$dispersion;
			if ((ceil($page_n/$dispersion)*$dispersion)>=$max_count/$amount) 
				$max=$max_count/$amount;
			else
				$max=ceil($page_n/$dispersion)*$dispersion;
		}
		if ($dispersion!=0)
		{
			if ($page_n-$dispersion>0)
			{
				print "<a href='".ereg_replace("{}","1",$action)."' title=\"1-".$amount."\">";
				print $el;
				print "</a>";

				print "<a href='".ereg_replace("{}","".$min,$action)."' title=\"".(($min-1)*$amount+1)."-".(($min-1)*$amount+$amount)."\">";
				print $ll;
				print "</a>";
			}
		}

		for ($a=$min;$a<$max;$a++)
		{
			if ($first)
				$first=false;
			else
				print $delim;

			print "<a href='".ereg_replace("{}","".($a+1),$action)."'>";
			if ($a<=$max-1 || $last==0)
			{
				$last2=$amount;
			}
			else
			{
				$last2=$last;
			}

			if (($a+1)==$page_n) // �������� ������� ���.
			{
				print "<font class=$class color='$color_a'";
			}
			else
			{
				print "<font color='$color_na'";
			}

			if (($a*$amount+$last2) > $max_count)
				$limiter = $max_count;
			else
				$limiter = ($a*$amount+$last2);

			if (($a*$amount+1)==$limiter) // ������ 1 �������
				print " title=\"".($a*$amount+1)."\">".($a+1)."</font>";
			else
				print " title=\"".($a*$amount+1)."-".$limiter."\">".($a+1)."</font>";
			print "</a>";
		}

		if ($dispersion!=0)
		{
			if (ceil($page_n/$dispersion) < ceil(ceil($max_count/$amount)/$dispersion))
			{
				if (ceil(ceil($max_count/$amount)/$dispersion)>$max-1 || $last==0)
				{
					$last = $amount;
				}

				if (($max*$amount+$last) > $max_count)
					$limiter = $max_count;
				else
					$limiter = ($max*$amount+$last);

				if (($max*$amount+1)==$limiter)
					print "<a href='".ereg_replace("{}","".($max+1),$action)."' title=\"".($max*$amount+1)."\">";
				else
					print "<a href='".ereg_replace("{}","".($max+1),$action)."' title=\"".($max*$amount+1)."-".$limiter."\">";
				print $rr;
				print "</a>";


				if (((ceil($max_count/$amount)-1)*$amount+$last) > $max_count)
					$limiter = $max_count;
				else
					$limiter = ((ceil($max_count/$amount)-1)*$amount+$last);

				if (((ceil($max_count/$amount)-1)*$amount+1)==$limiter)
					print "<a href='".ereg_replace("{}","".ceil($max_count/$amount),$action)."' title=\"".((ceil($max_count/$amount)-1)*$amount+1)."\">";
				else
					print "<a href='".ereg_replace("{}","".ceil($max_count/$amount),$action)."' title=\"".((ceil($max_count/$amount)-1)*$amount+1)."-".$limiter."\">";

				print $er;
				print "</a>";
			}
		}

		if ((($page_n-1)*$amount+$amount) > $max_count)
		{
			$tmp = $max_count;
		}
		else
		{
			$tmp = (($page_n-1)*$amount+$amount);
		}
		print $delim2.$string2." ".(($page_n-1)*$amount+1)." - ".$tmp." ".$string3." ".$max_count;
		print "</div>";
		print "</td>";

		print "</tr>";
		print "</table>";
	}
	else if ($max_count>$amount && $type==3) // ����� �� 4 �� � ��������� �������������
	{
		print "<table border=0 cellspacing=0 cellpadding=0 width=$size_table>";
		print "<tr>";
		print "<td align=$align class=$class_all>";
		print "<div align=$align>";
		print $string." ".$page_n." ".$string3." ".ceil($max_count/$amount).$delim2;

		$first=true;
		
		$dispersion = round($dispersion/2)-1;

		if ($dispersion==0)
		{
			$max=($max_count/$amount);
			$min=0;
		}
		else
		{
			if ($page_n+$dispersion>=$max_count/$amount)
			{
				$max=$max_count/$amount;
				$min_tmp=$dispersion - (ceil($max_count/$amount)-$page_n);
			}
			else
				$max=$page_n+$dispersion;
			if ($page_n-$dispersion-1<=0)
			{
				$min=0;
				$max+=$dispersion-$page_n+1;
				if ($max>$max_count/$amount) $max=$max_count/$amount;
			}
			else
			{
				$min=$page_n-$dispersion-1-$min_tmp;
				if ($min<0) $min=0;
			}
		}

		if ($dispersion!=0)
		{
			if ($min>0)
			{
				print "<a href='".ereg_replace("{}","1",$action)."' title=\"1-".$amount."\">";
				print $el;
				print "</a>";
			}
		}

		for ($a=$min;$a<$max;$a++)
		{
			if ($first)
				$first=false;
			else
				print $delim;

			print "<a href='".ereg_replace("{}","".($a+1),$action)."'>";
			if ($a<=$max-1 || $last==0)
			{
				$last2=$amount;
			}
			else
			{
				$last2=$last;
			}

			if (($a+1)==$page_n) // �������� ������� ���.
			{
				print "<font class=$class color='$color_a'";
			}
			else
			{
				print "<font color='$color_na'";
			}

			if (($a*$amount+$last2) > $max_count)
				$limiter = $max_count;
			else
				$limiter = ($a*$amount+$last2);

			if (($a*$amount+1)==$limiter) // ������ 1 �������
				print " title=\"".($a*$amount+1)."\">".($a+1)."</font>";
			else
				print " title=\"".($a*$amount+1)."-".$limiter."\">".($a+1)."</font>";
			print "</a>";
		}

		if ($dispersion!=0)
		{
			if ($max < ($max_count/$amount))
			{
				if (ceil(ceil($max_count/$amount)/$dispersion)>$max-1 || $last==0)
				{
					$last = $amount;
				}

				if (((ceil($max_count/$amount)-1)*$amount+$last) > $max_count)
					$limiter = $max_count;
				else
					$limiter = ((ceil($max_count/$amount)-1)*$amount+$last);

				if (((ceil($max_count/$amount)-1)*$amount+1)==$limiter)
					print "<a href='".ereg_replace("{}","".ceil($max_count/$amount),$action)."' title=\"".((ceil($max_count/$amount)-1)*$amount+1)."\">";
				else
					print "<a href='".ereg_replace("{}","".ceil($max_count/$amount),$action)."' title=\"".((ceil($max_count/$amount)-1)*$amount+1)."-".$limiter."\">";

				print $er;
				print "</a>";
			}
		}

		if ((($page_n-1)*$amount+$amount) > $max_count)
		{
			$tmp = $max_count;
		}
		else
		{
			$tmp = (($page_n-1)*$amount+$amount);
		}
		print $delim2.$string2." ".(($page_n-1)*$amount+1)." - ".$tmp." ".$string3." ".$max_count;
		print "</div>";
		print "</td>";

		print "</tr>";
		print "</table>";
	}
	else if ($max_count>$amount && $type==2)	// ���������, ������� ������ ������� �������
	{
		print "<table border=0 cellspacing=0 cellpadding=0 width=$size_table>";
		print "<tr>";
		print "<td align=center class=$class_all>";
		print "<div align=center>";

		$first=true;
		
		$dispersion = round($dispersion/2)-1;

		if ($dispersion==0)
		{
			$max=($max_count/$amount);
			$min=0;
		}
		else
		{
			if ($page_n+$dispersion>=$max_count/$amount)
			{
				$max=$max_count/$amount;
				$min_tmp=$dispersion - (ceil($max_count/$amount)-$page_n);
			}
			else
				$max=$page_n+$dispersion;
			if ($page_n-$dispersion-1<=0)
			{
				$min=0;
				$max+=$dispersion-$page_n+1;
				if ($max>$max_count/$amount) $max=$max_count/$amount;
			}
			else
			{
				$min=$page_n-$dispersion-1-$min_tmp;
				if ($min<0) $min=0;
			}
		}

		if ($dispersion!=0)
			if ($min>0)
			{
				print $ll;
			}

		for ($a=$min;$a<$max;$a++)
		{
			if ($first)
				$first=false;
			else
				print $delim;

			print "<a href='".ereg_replace("{}","".($a+1),$action)."'>";
			if ($a<=$max-1 || $last==0)
				if (($a+1)==$page_n)
					if (($a*$amount+1)==($a*$amount+$amount))
						print "<font class=$class color='$color_a'>".($a*$amount+1)."</font>";
					else
						print "<font class=$class color='$color_a'>".($a*$amount+1).'-'.($a*$amount+$amount)."</font>";
				else
					if (($a*$amount+1)==($a*$amount+$amount))
						print "<font color='$color_na'>".($a*$amount+1)."</font>";
					else
						print "<font color='$color_na'>".($a*$amount+1).'-'.($a*$amount+$amount)."</font>";
			else
				if (($a+1)==$page_n)
					if (($a*$amount+1)==($a*$amount+$last))
						print "<font class=$class color='$color_a'>".($a*$amount+1)."</font>";
					else
						print "<font class=$class color='$color_a'>".($a*$amount+1).'-'.($a*$amount+$last)."</font>";
				else
					if (($a*$amount+1)==($a*$amount+$last))
						print "<font color='$color_na'>".($a*$amount+1)."</font>";
					else
						print "<font color='$color_na'>".($a*$amount+1).'-'.($a*$amount+$last)."</font>";
			print "</a>";
		}

		if ($dispersion!=0)
			if ($max<$max_count/$amount) 
				print $rr;

		print "</div>";
		print "</td>";

		print "</tr>";
		print "</table>";
	}
	else if ($type==1)	// ���������� ������ (����� ��������)
	{
		print "<table border=0 cellspacing=0 cellpadding=0 width=$size_table>";
		print "<tr>";
		print "<td>";
		print "<form action='$action' method=post>";
		print $add_h;

		if ($max_count>$amount)
		{
			print "<div align=left>";
			print "<font class=$class>".$string."</font>";
			print "<select name='page_n_s'>";
			for ($a=0;$a<($max_count/$amount);$a++) # ��������� ������ ����� ������ �� ��������� ��������
			{
				if ($a<($max_count/$amount)-1 || $last==0)
				{
					if (($a*$amount+1)==($a*$amount+$amount))
					{
						print '<option value="'.($a+1).'" ';
						if (($a+1)==$page_n) 
							print 'selected';
						print '>'.($a*$amount+1);
					}
					else
					{
						print '<option value="'.($a+1).'" ';
						if (($a+1)==$page_n) 
							print 'selected';
						print '>'.($a*$amount+1).'-'.($a*$amount+$amount);
					}
				}
				else
				{
					if (($a*$amount+1)==($a*$amount+$last))
					{
						print '<option value="'.($a+1).'" ';
						if (($a+1)==$page_n) 
							print 'selected';
						print '>'.($a*$amount+1);
					}
					else
					{
						print '<option value="'.($a+1).'" ';
						if (($a+1)==$page_n) 
							print 'selected';
						print '>'.($a*$amount+1).'-'.($a*$amount+$last);
					}
				}
			}
			print "</select>";
//			print '<br><input type=image name="go" src="images/go.gif" alt="�������" border="0"></font>';
			print '<br><input type=submit name="go_x" value="�������" class=normal></font>';
			print "</div>";
		}
		print "</td>";

		print "<td>";
		print "<div align=right>";
		if (($run+($page_n-1)*$amount-$amount)>0)# ���� ������ ������ � ����������� ���
		{
			print '<input type=hidden name="page_n_b" value="'.($page_n-1).'">';
//			print '<input type=image name="back" src="images/prev.gif" alt="�����" border=0>';
			print "<input type=submit name='back_x' value='�����' class=normal>";
		}
		if ($max_count>($amount+($page_n-1)*$amount))# ���� ��� ����� � ������ ���
		{
			print '<input type=hidden name="page_n_n" value="'.($page_n+1).'">';
//			print '<input type=image name="next" src="images/next.gif" alt="�����" border=0>';
			print "<input type=submit name='next_x' value='�����' class=normal>";
		}
		print "</div>";
		print "</form>";
		print "</td>";
		print "</tr>";
		print "</table>";
	}
}
# (end) ��������� �� ����������

function split_string($sql, $delimiter)
{
    $sql = trim($sql);
    $buffer = array();
    $ret = array();
    $in_string = false;

    for($i=0; $i<strlen($sql); $i++)
    {
        if($sql[$i] == $delimiter && !$in_string)
        {
            $ret[] = substr($sql, 0, $i);
            $sql = substr($sql, $i + 1);
            $i = 0;
        }

        if($in_string && ($sql[$i] == $in_string) && $buffer[0] != "\\")
        {
             $in_string = false;
        }
        elseif(!$in_string && ($sql[$i] == "\"" || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\"))
        {
             $in_string = $sql[$i];
        }
        if(isset($buffer[1]))
            $buffer[0] = $buffer[1];
        $buffer[1] = $sql[$i];
     }

    if (!empty($sql))
    {
        $ret[] = $sql;
    }

    return($ret);
}

$time_start = time();
function TimeOutWrite($out, $way, $fp, $compressed)
{
    global $time_start;

	if (!$compressed) // ����� ������� � ����������� ������
	{
		if ($way == "download")
		{
			print $out;
		}
		else
		{
			fwrite($fp, $out);
		}
	}

	$time_now = time();

	if ($time_start + 30 < $time_now)
	{
		$time_start = $time_now;
		header('X-phpPing: go');
	}
}

function TimeOutRead()
{
    global $time_start;

	$time_now = time();

	if ($time_start + 30 < $time_now)
	{
		$time_start = $time_now;
		header('X-phpPing: go');
	}
}

/*Function tree(
	$tree,		# �����������
	$last_f,	# 
	$ran,		#
	$page_n,	# ��������
	$tbl,		#
	$nmfl		#
	)
{	#	������� ������� �� ���� � ����������� �� ����������� ���
	global $master;
	global $base;
	global $HTTP_USER_AGENT;
	global $bg4;

	$query="SELECT fmsb, fmid, fmir, fmnm, fmsu, DATE_FORMAT(ad, '%d-%m-%Y %T') FROM $tbl WHERE fmir=".$last_f." ORDER BY ad ASC";
	if ($result = mysql_db_query($base,$query))
		while(list($fmsb, $fmid, $re, $fmnm, $fmsu, $today) = mysql_fetch_row($result))
		{
			print "<tr bgcolor=$bg4>";
			print "<td>";
			for ($iii=0; $iii<$tree; $iii++) print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			print "<a href=\"$nmfl"."&page_n=$page_n&f=$fmid\">";
			print $fmsb;
			print "</a>";
			print "</td>";
			print "<td>";
			print "<a href=\"$nmfl"."&page_n=$page_n&f=$fmid\">";
			print $fmnm;
			if ($fmsu=='y')
				print " (ADM)";
			print "</a>";
			print "</td>";
			print "<td align=center>";
			print "<font class=copy>".$today."</font>";
			print "</td>";
			print "</tr>";
			$tree++;
			tree ($tree, $fmid, '', $page_n, $tbl, $nmfl);
			$tree--;
		}
}*/

/*function date_trans($w, $d, $m, $y)
{
	switch ($w)
	{
		case 'Monday':
			$str='�����������';
		break;
		case 'Tuesday':
			$str='�������';
		break;
		case 'Wednesday':
			$str='�����';
		break;
		case 'Thursday':
			$str='�������';
		break;
		case 'Friday':
			$str='�������';
		break;
		case 'Saturday':
			$str='�������';
		break;
		case 'Sunday':
			$str='�����������';
		break;
		default:
			$str=$w;
		break;
	}

	$str=$str.", ".$d." ";

	switch ($m)
	{
		case 'January':
			$str=$str.'������';
		break;
		case 'February':
			$str=$str.'�������';
		break;
		case 'March':
			$str=$str.'�����';
		break;
		case 'April':
			$str=$str.'������';
		break;
		case 'May':
			$str=$str.'���';
		break;
		case 'June':
			$str=$str.'����';
		break;
		case 'July':
			$str=$str.'����';
		break;
		case 'August':
			$str=$str.'�������';
		break;
		case 'September':
			$str=$str.'��������';
		break;
		case 'October':
			$str=$str.'�������';
		break;
		case 'November':
			$str=$str.'������';
		break;
		case 'December':
			$str=$str.'�������';
		break;
		default:
			$str=$str.$m;
		break;
	}

	$str=$str.", ".$y." ����, ";

	return $str;
}*/

/*function long_str($str,$max_str_l)
{
	$count=0;
	$str_e='';
	$tmp='';

	for ($i=0; $i<strlen($str); $i++)
	{
		$tmp=substr($str,$i,1);
		if ($tmp!=' ') 
		{
			$count++;
		}
		else
		{
			$count=0;
		}
		if ($count==$max_str_l)
		{
			$str_e=$str_e.' '.$tmp;
			$count=0;
		}
		else
		{
			$str_e=$str_e.$tmp;
		}
	}
	return $str_e;
}*/
?>

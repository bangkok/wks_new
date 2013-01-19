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
 * Admin utility core
 */
ob_start("ob_gzhandler");
//phpinfo();
require ("conf.inc.php");

$ident=@mysql_connect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
mysql_select_db($base);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);

include("configure.inc.php");

if ($access=='n')
{
	include("header.inc.php");
	?>
	</head>
	<?print $body?>
	<div align=center>
	<?print $T16Nr?>
	</div>
	</body>
	</html>
	<?
	exit;
}

if ($access=='r') $op='s';

if ($access=='w' && $op=='or') # ����������
{
	if (isset($id_e[0]))
		$tosearch=false;
	else
		$tosearch=true;

	$query="SELECT cfid FROM nrcf WHERE cfor='y' AND cftb='$table'";
	$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
	list($cfid) = mysql_fetch_row($result);

	$id_idetical_1=true;	# ���� ���� ��������� �� ����� ����� ���� �� ������ ;)
	for($i=0;$i<count($id_e);$i++)
	{
		if ($id[$i]!=$id_e[$i])
		{
			$id_idetical_1=false;
		}
	}

	$id_idetical_2=true;
	for($i=0;$i<count($id_e);$i++)
	{
		if ($id_u[$i]!=$id_e[$i])
		{
			$id_idetical_2=false;
		}
	}

	$first=true;
	for($i=0;$i<mysql_num_rows($table_def);$i++)	# ���. ��� ���
	{
		if ($inp_text_k[$i]=="y")
		{
			if ($first)
			{
				$where1="`".$inp_text_nm[$i]."`='".$id[$i]."'";
				$where2="`".$inp_text_nm[$i]."`='".$id_u[$i]."'";
				$first=false;
			}
			else
			{
				$where1.=" AND `".$inp_text_nm[$i]."`='".$id[$i]."'";
				$where2.=" AND `".$inp_text_nm[$i]."`='".$id_u[$i]."'";
			}
			if ($i==($cfid-1))
			{
				if ($id_idetical_1)
				{
					$id_e[$i]=$id_u[$i];
				}
				if ($id_idetical_2)
				{
					$id_e[$i]=$id[$i];
				}
			}
		}
		if ($rows['order'][$i+1]=='y')
		{
			$query_up_ord_field=$inp_text_nm_all[$i];
		}
	}

	##################
	# ������ ����������
	##################
	# ��� ������ ������ $inp_text_nm_all[($cfid-1)]
	if ($foreign_table[0]!="" && $foreign_field[0]!="" && $foreign_accordingly[0]!="")
	{
		for ($i=0;$i<count($foreign_table);$i++)
		if ($foreign_table[$i]!="" && $foreign_field[$i]!="" && $foreign_accordingly[$i]!="" && $inp_text_nm_all[($cfid-1)]==$foreign_accordingly[$i])
		{
			$query="SELECT `$foreign_accordingly[$i]` FROM `$table` WHERE $where1";
			if ($result = mysql_query($query))
			{
				if (list($foreign_accordingly_found)=mysql_fetch_row($result))
				{
					$found1=false;
					for ($i=0;$i<count($foreign_table);$i++)
					{
						if ($foreign_table[$i]!="" && $foreign_field[$i]!="")
						{
							$query="SELECT * FROM `$foreign_table[$i]` WHERE `$foreign_field[$i]`='$foreign_accordingly_found'";
							if ($result = mysql_query($query))
							{
								if (list()=mysql_fetch_row($result))
								{
									$found1=true;
									$message.=$strErrorSelectForDel." (Table - $foreign_table[$i], field - $foreign_field[$i], accordingly - $foreign_accordingly[$i])&nbsp;";
									$message.="<a href=nr.php?t=$foreign_table[$i]&op=s&se[$foreign_field[$i]]=".$foreign_accordingly_found." target=_blank><img src=img/view.gif border=0 alt=".$T27Nr." align=center></a><br>";
								}
							}
							else
							{
								$message.=$strErrorSelect." (Table - $foreign_table[$i], field - $foreign_field[$i], accordingly - $foreign_accordingly[$i])<br>";
							}
						}
					}

				}
				else
				{
					$message.=$strErrorSelect;
				}
			}
			else
			{
				$message.=$strErrorSelect;
			}
		}
	}
	else
	{
		$found1=false;
	}

	# ��� ������ ������
	if ($foreign_table[0]!="" && $foreign_field[0]!="" && $foreign_accordingly[0]!="")
	{
		for ($i=0;$i<count($foreign_table);$i++)
		if ($foreign_table[$i]!="" && $foreign_field[$i]!="" && $foreign_accordingly[$i]!="" && $inp_text_nm_all[($cfid-1)]==$foreign_accordingly[$i])
		{
			$query="SELECT `$foreign_accordingly[$i]` FROM `$table` WHERE $where2";
			if ($result = mysql_query($query))
			{
				if (list($foreign_accordingly_found)=mysql_fetch_row($result))
				{
					$found2=false;
					for ($i=0;$i<count($foreign_table);$i++)
					{
						if ($foreign_table[$i]!="" && $foreign_field[$i]!="")
						{
							$query="SELECT * FROM `$foreign_table[$i]` WHERE `$foreign_field[$i]`='$foreign_accordingly_found'";
							if ($result = mysql_query($query))
							{
								if (list()=mysql_fetch_row($result))
								{
									$found2=true;
									$message.=$strErrorSelectForDel." (Table - $foreign_table[$i], field - $foreign_field[$i], accordingly - $foreign_accordingly[$i])&nbsp;";
									$message.="<a href=nr.php?t=$foreign_table[$i]&op=s&se[$foreign_field[$i]]=".$foreign_accordingly_found." target=_blank><img src=img/view.gif border=0 alt=".$T27Nr." align=center></a><br>";
								}
							}
							else
							{
								$message.=$strErrorSelect." (Table - $foreign_table[$i], field - $foreign_field[$i], accordingly - $foreign_accordingly[$i])<br>";
							}
						}
					}

				}
				else
				{
					$message.=$strErrorSelect;
				}
			}
			else
			{
				$message.=$strErrorSelect;
			}
		}
	}
	else
	{
		$found2=false;
	}

	$message.="<br>";

	if ($locked_is)
	{
		if ($table=="nrad")
		$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, ur FROM `$table` WHERE $where1";
		else
		$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, $table.ur FROM `$table`, nrad WHERE $where1 AND adid=$table.ur";
		$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
		list($lock_timeout1, $lock_user1) = mysql_fetch_row($res);

		if ($table=="nrad")
		$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, ur FROM `$table` WHERE $where2";
		else
		$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, $table.ur FROM `$table`, nrad WHERE $where2 AND adid=$table.ur";
		$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
		list($lock_timeout2, $lock_user2) = mysql_fetch_row($res);
	}
	if ($right_is)
	{
		if ($table=="nrad")
		$query = "SELECT rt, urr, adrl FROM `$table` WHERE $where1";
		else
		$query = "SELECT $table.rt, $table.urr, adrl FROM `$table`, nrad WHERE $where1 AND adid=$table.urr";
		$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
		list($right_set1, $right_user, $right_role) = mysql_fetch_row($res);
		if ($right_set1=="" || $right_user=="" || $right_user==$PHP_AUTH_USER || $right_set1=="rwrw")
		$right_set1="w";
		if ( ($right_set1=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set1=="rwr-" && $right_role==$PHP_AUTH_ROLE))
		$right_set1="w";
		if ($right_set1=="r-r-" && $right_user==$PHP_AUTH_USER)
		$right_set1="w";
		if ($right_set1!="w")
		{
			$query = "SELECT urrl FROM nrur WHERE urad='$right_user'";
			$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
			while (list($right_role) = mysql_fetch_row($res_rl))
			{
				if ( ($right_set1=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set1=="rwr-" && $right_role==$PHP_AUTH_ROLE))
				{
					$right_set1="w";
					break;
				}
			}
		}

		if ($table=="nrad")
		$query = "SELECT rt, urr, adrl FROM `$table` WHERE $where2";
		else
		$query = "SELECT $table.rt, $table.urr, adrl FROM `$table`, nrad WHERE $where2 AND adid=$table.urr";
		$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
		list($right_set2, $right_user, $right_role) = mysql_fetch_row($res);
		if ($right_set2=="" || $right_user=="" || $right_user==$PHP_AUTH_USER || $right_set2=="rwrw")
		$right_set2="w";
		if ( ($right_set2=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set2=="rwr-" && $right_role==$PHP_AUTH_ROLE))
		$right_set2="w";
		if ($right_set2=="r-r-" && $right_user==$PHP_AUTH_USER)
		$right_set2="w";
		if ($right_set2!="w")
		{
			$query = "SELECT urrl FROM nrur WHERE urad='$right_user'";
			$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
			while (list($right_role) = mysql_fetch_row($res_rl))
			{
				if ( ($right_set2=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set2=="rwr-" && $right_role==$PHP_AUTH_ROLE))
				{
					$right_set2="w";
					break;
				}
			}
		}
	}

	if ($tosearch)
	$op='s';
	if (!$found1 && !$found2)
	{
		if ( (($lock_timeout1 < 0 && $lock_user1!=$PHP_AUTH_USER) || ($lock_timeout2 < 0 && $lock_user2!=$PHP_AUTH_USER) || $right_set2=='r' || $right_set1=='r') && !$PHP_SU)
		{
			$message=$T25Nr;
		}
		else
		{
			$query="SELECT * FROM `$table` WHERE $where2";
			$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
			if ($row = mysql_fetch_array($result))
			{
				$query_up_old=$row[($cfid-1)];
			}

			$query="SELECT * FROM `$table` WHERE $where1";
			$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
			if ($row = mysql_fetch_array($result))
			{
				$query_up_new=$row[($cfid-1)];
				for ($j=0;$j<mysql_num_rows($table_def);$j++)
				{
					if ($j==($cfid-1))
					$query_rep_new.="'".$query_up_old."', ";
					else
					$query_rep_new.="'".$row[$j]."', ";
				}
			}
			$query_rep_new=substr($query_rep_new,0,strlen-2);

			$query_del="DELETE FROM `$table` WHERE $where1";
			$result = mysql_query( $query_del) or mysql_die($MySQLError.mysql_error(), false);
			$query_up="UPDATE `$table` SET `".$query_up_ord_field."`='".$query_up_new."' WHERE $where2";
			$result = mysql_query( $query_up) or mysql_die($MySQLError.mysql_error(), false);
			$query_rep="INSERT INTO `$table` VALUES (".$query_rep_new.")";
			$result = mysql_query( $query_rep) or mysql_die($MySQLError.mysql_error(), false);

			$first=true;
			$param_id_key="";
			for($i=0;$i<count($id_e);$i++)
			{
				if ($first)
				{
					$param_id_key="id[$i]=".urlencode($id_e[$i]);
					$first=false;
				}
				else
				{
					$param_id_key.="&id[$i]=".urlencode($id_e[$i]);
				}
			}

			if (!$tosearch)
			Header("Location: nr.php?t=$table&$param_id_key$my_query_string$my_ss_query_string");
			else
			Header("Location: nr.php?t=$table&op=s$my_query_string");
			exit;
		}
	}
}

if (($op=='s' || $op=='sv') && ($access=='r' || $access=='w'))
{
	include("header.inc.php");
	include("scriptssearch.inc.php");
?>
</head>

<?print $body?>
<?if ($access=='w' && $op!='sv')
{?>
<font>
<br>
<a href="<?print basename($PHP_SELF)."?t=$table$my_query_string"; if ($ce!='') print "&ad[0]=$ce";?>"><img src="img/add.gif" width=31 height=18 border=0 alt="<?print $AddNr?>"></a>
<?
if (isset($ce) && $ce!='' && isset($t2) && $t2!='')
{
	print " <a href=\"pg/catalog/nrcl.php?t=$t1$t2_exist&ce=$ce\"><img src=\"img/bcat.gif\" width=35 height=18 border=0 alt=\"".$T18Nr."\"></a>";
}
if ((/*$csv=='y' || */$basket!=0) && $op!='sv')
{
	/*	if ($csv=='y')
	{
	print " <a href=\"".$no_https_adm."csv.php?t=$table\"><font><img src=\"img/csvto.gif\" width=54 height=18 border=0 alt=\"".$T19Nr."\"></font></a> <a href=\"csv_to_base.php?t=$table\" target=_blank><font><img src=\"img/tocsv.gif\" width=54 height=18 border=0 alt=\"".$T20Nr."\"></font></a>";
	if ($basket!=0)
	print " <a href=\"nr.php?t=$table&op=s&bst=y$my_query_string\"><font><img src=\"img/bas.gif\" width=31 height=18 border=0 alt=\"".$T21Nr."\"></font></a>";
	}
	else*/
	{
		if ($basket!=0)
		{
			print " <a href=\"nr.php?t=$table&op=s&bst=y$my_query_string\"><font><img src=\"img/bas.gif\" width=31 height=18 border=0 alt=\"".$T21Nr."\"></font></a>";
		}
	}
}
if ($PHP_SU)
{
	print " <a href=\"tools/del_f_t.php?t=$table\" target=_blank><font><img src=\"img/dla.gif\" width=24 height=18 border=0 alt=\"".$T22Nr."\"></font></a>";
	print " <a href=\"tools/table_status.php?t=$t\"><img src=\"img/inf.gif\" width=31 height=18 border=0 alt=\"".$T23Nr."\"></a>";
}
?>
</font>
<?
}

# if tree_struct
if ($table_tree_structure) // tree up
{
	$query="SELECT $table_tree_structure_cffl FROM `$table` WHERE $table_tree_structure_cfenf='".$se[$table_tree_structure_cffl]."'";
	$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
	list($table_tree_structure_up) = mysql_fetch_row($result);

	if ($table_tree_structure_up!='')
	{
		$query = "SELECT COUNT(*) FROM `$table` WHERE `$table_tree_structure_cffl`='".$table_tree_structure_up."'";
		$res_tree_up_count = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
		list($tree_up_count)=mysql_fetch_row($res_tree_up_count);

		print "<br><a href=\"nr.php?t=$table$t2_exist";
		if ($engN!='')
		print "&op=sv&engN=$engN&type=$type&context=$context";
		else
		print "&op=s";
		if ($f!='')
		print "&f=$f";
		if ($vf!='')
		print "&vf=$vf";
		print "&se[$table_tree_structure_cffl]=".$table_tree_structure_up."\"><nobr>[tree_up]($tree_up_count)</nobr></a>";
	}
}
?>
<div align=center>
<?
print "<font class=b>$strTitle: </font><br>";
if (isset($message))
print $message;

$first=$first_rs=true;
for($i=0;$i<mysql_num_rows($table_def);$i++)	# ������. ���� �������� � �� ����� ������
{
	if (!$add_order && $ordered)
	{
		$jj=0;
		if ($rows['order'][$i+1]=='y')
		{
			if ($jj==0)
			$order="`".$inp_text[$i]."`";
			else
			$order.=", `".$inp_text[$i]."`";
			$jj++;
		}
	}

	if ((isset($rows['search_view'][$i+1]) && $rows['search_view'][$i+1]=='y') || (isset($inp_text_k[$i]) && $inp_text_k[$i]=='y'))
	{
		if ($first_rs)
		{
			$row_for_searche="`".$inp_text[$i]."`";
			$first_rs=false;
		}
		else
		{
			$row_for_searche.=", `".$inp_text[$i]."`";
		}
		if ($rows['search'][$i+1]=='y')
		{
			if (isset($se[$inp_text_nm_all[$i]]) && $se[$inp_text_nm_all[$i]]!="")
			$se[$i]=$se[$inp_text_nm_all[$i]];
			if (isset($se[$i]) && $se[$i]!="")
			{
				$substring_start = strpos($se[$i],"{");
				$substring_end = strpos($se[$i],"}");
				if ($first)
				{
					if ($substring_start === false || $substring_end === false)
					{
						/*							if ($inp_text_k[$i]=="y") // if PK
						{
						$where=$inp_text[$i]."='".$se[$i]."'";
						}
						else
						{*/
						$where="`".$inp_text[$i]."` LIKE '".$se[$i]."'";
						//							}
					}
					else
					{
						$substring_op = trim(substr($se[$i], ($substring_start+1), ($substring_end-1)));
						$substring_search = substr($se[$i], ($substring_end+1));
						/*							if ($inp_text_k[$i]=="y") // if PK
						{
						if (ereg("=",$substring_op) || ereg("!=",$substring_op) || ereg(">=",$substring_op) || ereg("<=",$substring_op) || ereg("<>",$substring_op) || ereg(">",$substring_op) || ereg("<",$substring_op) || ereg("<=>",$substring_op))
						{
						$where=$inp_text[$i]."$substring_op'".$substring_search."'";
						}
						else
						{
						$where=$inp_text[$i]."='".$se[$i]."'";
						}
						}
						else
						{*/
						if (ereg("=",$substring_op) || ereg("!=",$substring_op) || ereg(">",$substring_op) || ereg("<",$substring_op) || ereg("<=>",$substring_op) || ereg(">=",$substring_op) || ereg("<=",$substring_op) || ereg("<>",$substring_op) || eregi("like",$substring_op) || eregi("not like",$substring_op) || eregi("is null",$substring_op) || eregi("is not null",$substring_op) || eregi("regexp",$substring_op) || eregi("not regexp",$substring_op) || eregi("rlike",$substring_op) || eregi("not rlike",$substring_op))
						{
							$where="`".$inp_text[$i]."` $substring_op '".$substring_search."'";
						}
						else
						{
							$where="`".$inp_text[$i]."` LIKE '".$se[$i]."'";
						}
						//							}
					}
					$first=false;
				}
				else
				{
					if ($substring_start === false || $substring_end === false)
					{
						/*							if ($inp_text_k[$i]=="y") // if PK
						{
						$where.=" AND ".$inp_text[$i]."='".$se[$i]."'";
						}
						else
						{*/
						$where.=" AND `".$inp_text[$i]."` LIKE '".$se[$i]."'";
						//							}
					}
					else
					{
						$substring_op = trim(substr($se[$i], ($substring_start+1), ($substring_end-1)));
						$substring_search = substr($se[$i], ($substring_end+1));
						/*							if ($inp_text_k[$i]=="y") // if PK
						{
						if (ereg("=",$substring_op) || ereg("!=",$substring_op) || ereg(">=",$substring_op) || ereg("<=",$substring_op) || ereg("<>",$substring_op) || ereg(">",$substring_op) || ereg("<",$substring_op) || ereg("<=>",$substring_op))
						{
						$where.=" AND ".$inp_text[$i]."$substring_op'".$substring_search."'";
						}
						else
						{
						$where.=" AND ".$inp_text[$i]."='".$se[$i]."'";
						}
						}
						else
						{*/
						if (ereg("=",$substring_op) || ereg("!=",$substring_op) || ereg(">",$substring_op) || ereg("<",$substring_op) || ereg("<=>",$substring_op) || ereg(">=",$substring_op) || ereg("<=",$substring_op) || ereg("<>",$substring_op) || eregi("like",$substring_op) || eregi("not like",$substring_op) || eregi("is null",$substring_op) || eregi("is not null",$substring_op) || eregi("regexp",$substring_op) || eregi("not regexp",$substring_op) || eregi("rlike",$substring_op) || eregi("not rlike",$substring_op))
						{
							$where.=" AND `".$inp_text[$i]."` $substring_op '".$substring_search."'";
						}
						else
						{
							$where.=" AND `".$inp_text[$i]."` LIKE '".$se[$i]."'";
						}
						//							}
					}
				}
			}
		}
	}
}

for($i=0;$i<mysql_num_rows($table_def);$i++)	# ����. �����.
{
	if ($rows['search_view'][($i+1)]=='y')
	{
		if ($rows['search'][($i+1)]=='y')
		{
			if (!isset($other_param)) $other_param="";
			if (isset($se[$i]) && $se[$i]!="") $other_param .= "&se[".$inp_text_nm_all[$i]."]=".urlencode($se[$inp_text_nm_all[$i]]);
		}
	}
}
if (isset($go_x) && $go_x==1) $other_param_go = "&go_x=1";
if (isset($page_n_s) && $page_n_s!="") $other_param_page = "&page_n_s=$page_n_s";

$query="SELECT COUNT(*) FROM `$table` ";
if (isset($where) && $where!="")
$query.="WHERE $where ";

$result = mysql_query($query);
list($max_count) = mysql_fetch_row($result);

if (isset($other_param))
$sort_param=$other_param;
if (isset($other_param_page))
$sort_param.=$other_param_page;
if (isset($other_param_go))
$sort_param.=$other_param_go;

$edit_param="";
if (isset($sort) && $sort!="")
$edit_param.="&sort=$sort";
if (isset($dir) && $dir!="")
$edit_param.="&dir=DESC";
if (isset($sort_param))
$edit_param.=$sort_param;

if (isset($f))
$navig_param=basename($PHP_SELF)."?t=$table&op=$op&f=$f";
else
$navig_param=basename($PHP_SELF)."?t=$table&op=$op&f=";
if (isset($engN) && $engN!="")
$navig_param.="&engN=$engN&context=$context";
if (isset($type) && $type!='')
$navig_param.="&type=$type";
if (isset($sort) && $sort!="")
$navig_param.="&sort=$sort";
if (isset($dir) && $dir!="")
$navig_param.="&dir=DESC";

if (isset($other_param))
$navig_param.=$other_param;

$query="SELECT $row_for_searche FROM `$table` ";
if (isset($where) && $where!="")
$query.="WHERE $where ";
if (isset($sort))
$query.="ORDER BY `$sort` ";
elseif (isset($order) && $order!='')
{
	$query.="ORDER BY $order ";
}
if (isset($dir))
$query.="DESC ";
if (!$add_order && $ordered && $start!=0)
$query.="LIMIT ".($start-1).','.$amount;
else
$query.="LIMIT ".$start.','.$amount;

//var_dump($dir);

if ($result = mysql_query($query))
{
	//		Navig_adm($RowsNr,$navig_param,'',$max_count,$amount,$page_n,$i,2,5,1);
	Navig($RowsNr,$RowsNr2,$RowsNr3,$navig_param."&page_n_s={}",$max_count,$amount,$page_n,4,15);
	print "<table border=0 cellspacing=1 cellpadding=2>";
	print "<form method=post action=\"".basename($PHP_SELF)."\">";
	print "<input type=hidden name=op value=\"$op\">";
	if (!isset($f))
	print "<input type=hidden name=f value=\"\">";
	else
	print "<input type=hidden name=f value=\"$f\">";
	if (isset($t2) && $t2!="")
	print "<input type=hidden name=t2 value=\"$t2\">";
	if (isset($ce) && $ce!="")
	print "<input type=hidden name=ce value=\"$ce\">";
	if (isset($engN) && $engN!='')
	print "<input type=hidden name=engN value=\"$engN\">";
	if (isset($type) && $type!='')
	print "<input type=hidden name=type value=\"$type\">";
	if (isset($context) && $context!='')
	print "<input type=hidden name=context value=\"$context\">";
	print "<input type=hidden name=t value=\"$table\">";
	print "<tr bgcolor=$bg1>";
	print "<td colspan=3 align=center><input type=submit value=\"".$SearchNr."\" class=button></td>";
	if (!$add_order && $ordered)
	print "<td colspan=2>&nbsp;";
	else
	print "<td>&nbsp;";
	print "</td>";
	$j=0;
	for($i=0;$i<mysql_num_rows($table_def);$i++)
	{
		if ($rows['search_view'][($i+1)]=='y')
		{
			print "<td align=center>";
			$len = @mysql_field_len($result, $j);
			if ($rows['search'][($i+1)]=='y')
			{
				print "<input type=text name=\"se[".$inp_text_nm_all[$i]."]\" value=\"";
				print $se[$inp_text_nm_all[$i]];
				print "\" size='";
				if ($len>9)
				{
					print "9";
				}
				elseif ($len<3)
				{
					print "3";
				}
				else
				{
					print $len;
				}
				print "'>";
			}
			else
			{
				print "&nbsp;";
			}
			$j++;
			print "</td>";
		}
	}
	print "</tr>";
	print "</form>";
	print "<tr bgcolor=$bg2>";
	print "<td colspan=2>&nbsp;</td>";
	if ($access=='w')
	{
		print "<td align=center><form name=searchlist method=post action=\"".basename($PHP_SELF)."?t=$table&$edit_param&op=d$my_add_query_string\">";
		if (mysql_num_rows($result)>0)
		print "<input type=checkbox name=toggleAll title=\"".$T24Nr."\" onclick=\"ToggleAll(this, ".mysql_num_rows($result).");\">";
		print "</td>";
	}
	else
	{
		print "<td align=center>&nbsp;</td>";
	}
	if (!$add_order && $ordered)
	print "<td>&nbsp;</td>";
	print "<td align=center>";
	print "#";
	print "</td>";
	for($i=0;$i<mysql_num_rows($table_def);$i++)
	{
		if ($rows['search_view'][($i+1)]=='y')
		{
			print "<td align=center class=b>";
			if (isset($sort) && isset($inp_text[$i]) && $inp_text[$i]==$sort)
			if ($dir=='DESC')
			{
				print "<img src='img/su.gif'>&nbsp;";
			}
			else
			{
				print "<img src='img/sd.gif'>&nbsp;";
			}
			if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
			{
				if (isset($f))
				print "<a href='".basename($PHP_SELF)."?t=$table&op=$op&f=$f";
				else
				print "<a href='".basename($PHP_SELF)."?t=$table&op=$op&f=";
				if (isset($engN) && $engN!='')
				print "&engN=$engN&type=$type&context=$context";
				print "&sort=".$inp_text[$i]."$other_param$sort_param$my_add_query_string'><i>".$rows['name'][($i+1)]."</i></a>";
			}
			else
			{
				if (isset($f))
				print "<a href='".basename($PHP_SELF)."?t=$table&op=$op&f=$f";
				else
				print "<a href='".basename($PHP_SELF)."?t=$table&op=$op&f=";
				if (isset($engN) && $engN!='')
				print "&engN=$engN&type=$type&context=$context";
				print "&sort=".$inp_text[$i]."$other_param$sort_param$my_add_query_string'>".$rows['name'][($i+1)]."</a>";
			}
			if (isset($inp_text[$i]) && isset($sort) && $inp_text[$i]==$sort)
			if ($dir=='DESC')
			{
				print "&nbsp;<img src='img/su.gif'>";
			}
			else
			{
				print "&nbsp;<img src='img/sd.gif'>";
			}
			print "</td>";
		}
	}
	print "</tr>";
	$tmp=0;
	if (!$add_order && $ordered && $start!=0 && $tmp==0)
	{
		if($row = mysql_fetch_array($result))
		{
			$first=true;
			for($i=0;$i<mysql_num_rows($table_def);$i++)
			{
				if ($inp_text_k[$i]=="y")
				{
					$id_u[$i]=$row[$i];
				}
			}
		}
	}
	while($row = mysql_fetch_array($result))
	{
		if (($tmp%10)==0 && $tmp!=0)
		{
			print "<tr bgcolor=$bg2>";
			print "<td colspan=3>";
			print "<input type=submit name=deleteall value=\"".$DelSelectedNr."\" class=button>";
			print "</td>";
			if (!$add_order && $ordered)
			print "<td>&nbsp;</td>";
			print "<td align=center>";
			print "#";
			print "</td>";
			for($i=0;$i<mysql_num_rows($table_def);$i++)
			{
				if ($rows['search_view'][($i+1)]=='y')
				{
					print "<td align=center class=b>";
					if (isset($inp_text[$i]) && isset($sort) && $inp_text[$i]==$sort)
					if ($dir=='DESC')
					{
						print "<img src='img/su.gif'>&nbsp;";
					}
					else
					{
						print "<img src='img/sd.gif'>&nbsp;";
					}
					print $rows['name'][($i+1)];
					if (isset($inp_text[$i]) && isset($sort) && $inp_text[$i]==$sort)
					if ($dir=='DESC')
					{
						print "&nbsp;<img src='img/su.gif'>";
					}
					else
					{
						print "&nbsp;<img src='img/sd.gif'>";
					}
					print "</td>";
				}
			}
			print "</tr>";
		}
		if (($tmp%2)==0)
		print "<tr bgcolor=$bg3>";
		else
		print "<tr bgcolor=$bg4>";
		if ($op=='sv')
		print "<td colspan=3 align=center>";
		else
		print "<td align=center>";
		if ($op=='sv')
		{
			$param_id_key="";
			for($i=0;$i<mysql_num_rows($table_def);$i++)
			{
				if ($inp_text[$i]==$f)
				{
					print "<a href=\"JavaScript: SelectOne('$row[$i]');\"><img src=\"img/sl.gif\" width=26 height=18 border=0 alt=\"".$ChooseNR."\" align=center></a>";
				}
				if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
				{
					if ($first)
					{
						$param_id_key="id[$i]=".urlencode($row[$i]);
						$first=false;
					}
					else
					{
						$param_id_key.="&id[$i]=".urlencode($row[$i]);
					}
				}
			}
		}
		else
		{
			if ($access=='w')
			{
				$first=true;
				$not_view_i=0;
				$param_id_key="";
				for($i=0;$i<mysql_num_rows($table_def);$i++)
				{
					if (isset($rows['search_view'][$i]) && $rows['search_view'][$i]=='n')
					{
						$not_view_i++;
					}
					if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
					{
						if ($first)
						{
							$param_id_key="id[$i]=".urlencode($row[$i]);
							$first=false;
						}
						else
						{
							$param_id_key.="&id[$i]=".urlencode($row[$i]);
						}
						if ($access=='w')
						{
							print "<input type=hidden name=\"dlk_[$tmp][$i]\" value=\"".htmlspecialchars($row[$i])."\">";
						}
					}
					if ($inp_text_nm_all[$i]=='ur' && $inp_text_nm_all[($i+1)]=='lk' && $locked_is)
					{
						$ur_lock=true;
						$mk_time=mktime (substr($row[($i+1-$not_view_i)],11,2),substr($row[($i+1-$not_view_i)],14,2),substr($row[($i+1-$not_view_i)],17,2),substr($row[($i+1-$not_view_i)],5,2),substr($row[($i+1-$not_view_i)],8,2),substr($row[($i+1-$not_view_i)],0,4));
						if ($row[$i-$not_view_i]!=$PHP_AUTH_USER)
						{
							$query = "SELECT adto FROM nrad WHERE adid='".$row[$i-$not_view_i]."'";
							$res_to = mysql_query($query) or mysql_die($MySQLError, false);
							list($UserTimeOut) = mysql_fetch_row($res_to);
							$mk_time_substract_am = 0-(mktime()-$mk_time-$UserTimeOut);
							if (mktime()-$mk_time-$UserTimeOut > 0)
							$mk_time_substract=true;
							else
							$mk_time_substract=false;
						}
						else
						$mk_time_substract=true;
					}
					if ($inp_text_nm_all[$i]=='urr' && $inp_text_nm_all[($i+1)]=='rt' && $right_is)
					{
						$query = "SELECT adrl FROM nrad WHERE adid='".$row[$i-$not_view_i]."'";
						$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
						list($right_role) = mysql_fetch_row($res_rl);

						$right_set=$row[($i+1-$not_view_i)];
						$right_user=$row[$i-$not_view_i];
						if ($right_set=="" || $right_user=="" || $right_user==$PHP_AUTH_USER || $right_set=="rwrw")
						$right_set="w";
						if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
						$right_set="w";
						if ($right_set=="r-r-" && $right_user==$PHP_AUTH_USER)
						$right_set="w";

						if ($right_set!="w")
						{
							$query = "SELECT urrl FROM nrur WHERE urad='".$row[$i-$not_view_i]."'";
							$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
							while (list($right_role) = mysql_fetch_row($res_rl))
							{
								if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
								{
									$right_set="w";
									break;
								}
							}
						}
					}

				}
				print "<a href='".basename($PHP_SELF)."?t=$table&";
				print "$param_id_key$edit_param$my_add_query_string'><img src=\"img/ed.gif\" width=26 height=18 border=0 alt=\"".$EditNr."\"></a>";
			}
			else
			{
				print "&nbsp;";
			}
			print "</td>";
			print "<td align=center>";
			if ($access=='w')
			{
				//					if ( (((isset($mk_time_substract) && $mk_time_substract) || (isset($locked_is) && !$locked_is)) && (!$right_is || ($right_is && $right_set=='w'))) || $PHP_SU)
				if ( !isset($mk_time_substract)
				|| (isset($mk_time_substract) && $mk_time_substract)
				|| !isset($locked_is)
				|| (isset($locked_is) && !$locked_is)
				|| !isset($right_is)
				|| (isset($right_is) && !$right_is)
				|| (isset($right_is) && $right_is && $right_set=='w')
				|| $PHP_SU)
				{
					print "<a href='".basename($PHP_SELF)."?t=$table&";
					print "$param_id_key$edit_param&op=d$my_add_query_string'><img src=\"img/dl.gif\" width=26 height=18 border=0 alt=\"$DeleteNr\"></a>";
				}
				else
				print $CloseNr;
			}
			else
			{
				print "&nbsp;";
			}
			print "</td>";
			print "<td align=center>";
			if ($access=='w')
			{
				//					if ( (((isset($mk_time_substract) && $mk_time_substract) || (isset($locked_is) && !$locked_is)) && (!$right_is || ($right_is && $right_set=='w'))) || $PHP_SU)
				if ( !isset($mk_time_substract)
				|| (isset($mk_time_substract) && $mk_time_substract)
				|| !isset($locked_is)
				|| (isset($locked_is) && !$locked_is)
				|| !isset($right_is)
				|| (isset($right_is) && !$right_is)
				|| (isset($right_is) && $right_is && $right_set=='w')
				|| $PHP_SU)
				{
					print "<input type=checkbox name=\"dl_[$tmp]\">";
				}
				else
				{
					if ((!$right_is && ($locked_is && $mk_time_substract_am > 0)) || (($right_is && $right_set=='w') && ($locked_is && $mk_time_substract_am > 0)))
					print $mk_time_substract_am." c";
					else
					print "&nbsp;";
				}
			}
			else
			{
				print "&nbsp;";
			}
		}
		print "</td>";
		print "<td align=center>";
		if (!$add_order && $ordered)
		{
			$first=true;
			for($i=0;$i<$num_rows_all;$i++)
			{
				if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
				{
					if (!isset($id_u[$i])) $id_u[$i] = "";
					if ($first)
					{
						$param_id_key_u="id_u[$i]=".urlencode($id_u[$i]);
						$first=false;
					}
					else
					{
						$param_id_key_u.="&id_u[$i]=".urlencode($id_u[$i]);
					}
				}
			}
			$first=true;
			$param_id_key="";
			for($i=0;$i<$num_rows_all;$i++)
			{
				if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
				{
					$id_u[$i]=$row[$i];
					if ($first)
					{
						$param_id_key="id[$i]=".urlencode($row[$i]);
						$first=false;
					}
					else
					{
						$param_id_key.="&id[$i]=".urlencode($row[$i]);
					}
				}
			}
			$first=true;
			if ($tmp!=0 || $start!=0)
			if ((isset($mk_time_substract) && $mk_time_substract) || (isset($locked_is) && !$locked_is))
			{
				print "<a href=\"nr.php?t=$table&op=or&$param_id_key&$param_id_key_u$my_query_string\"><img src=\"img/up.gif\" width=26 height=18 border=0 alt=\"".$SortNr."\"></a></td><td align=center>";
			}
			else
			print "&nbsp;</td><td align=center>";
			else
			print "&nbsp;</td><td align=center>";
			print ($tmp+$amount*($page_n-1)+1);
		}
		else
		print ($tmp+$amount*($page_n-1)+1);
		print "</td>";
		$j=0;
		for($i=0;$i<mysql_num_rows($table_def);$i++)
		{
			if ($rows['search_view'][($i+1)]=='y')
			{
				print "<td>";
				if ($rows['module'][($i+1)]!='' && $row[$j]!="")
				{
					if (strlen($row[$j])>50)
					print htmlspecialchars(substr($row[$j],0,50))." ...";
					else
					print htmlspecialchars($row[$j]);
					print "&nbsp;<a target=_blank href=".$rows['module'][($i+1)].urlencode($row[$j]).">";
					print "<img src=\"img/md.gif\" width=26 height=18 border=0 alt=\"".$ModuleNr."\">";
					print "</a>";
				}
				else
				{
					if(strstr($rows_type[$i], "blob"))
					{
						print "<div align=center>";
						print "<a href='trf.php?$param_id_key&t=$table&f=".$rows_fields[$i]."' target=_blank>";
						print "<img align=center src=\"".$no_https_adm."trf.php?$param_id_key&t=$table&f=".$rows_fields[$i]."&x=100\" border=0 alt=\"\">";
						print "</a></div>";
					}
					else
					{
						if ($row[$j]!="")
						if (strlen($row[$j])>50)
						print htmlspecialchars(substr($row[$j],0,50))." ...";
						else
						print htmlspecialchars($row[$j]);
						else
						print "&nbsp;";
					}
				}

				if ($rows['eng_t'][$i+1]!="" && $rows['eng_f'][$i+1]!="" && $rows['eng_vf'][$i+1]!="")
				{
					$query = "SELECT `".$rows['eng_vf'][$i+1]."` FROM `".$rows['eng_t'][$i+1]."` WHERE `".$rows['eng_f'][$i+1]."`='".$row[$j]."'";
					$res_sub_table = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
					list($eng_vf_)=mysql_fetch_row($res_sub_table);
					if ($eng_vf_!='')
					if (strlen($eng_vf_)>50)
					print " (".htmlspecialchars(substr($eng_vf_,0,50))." ...)";
					else
					print " (".htmlspecialchars($eng_vf_).")";
				}

				if ($table_tree_structure && $inp_text_nm_all[$j]==$table_tree_structure_cfenf) // tree
				{
					$query = "SELECT COUNT(*) FROM `$table` WHERE `$table_tree_structure_cffl`='$row[$j]'";
					$res_tree_in_count = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
					list($tree_in_count)=mysql_fetch_row($res_tree_in_count);
					print "&nbsp;<a href=\"nr.php?t=$table$t2_exist";
					if ($engN!='')
					print "&op=sv&engN=$engN&type=$type&context=$context";
					else
					print "&op=s";
					if ($f!='')
					print "&f=$f";
					if ($vf!='')
					print "&vf=$vf";
					print "&se[".$table_tree_structure_cffl."]=".$row[$j]."\"><nobr>[tree_in]($tree_in_count)</nobr></a>";
				}
				print "</td>";
				$j++;
			}
			elseif (isset($inp_text_k[$i]) && $inp_text_k[$i]=='y')
			{
				$j++;
			}
		}
		print "</tr>";
		$tmp++;
	}


	print "<tr bgcolor=$bg2>";
	print "<td colspan=3>";
	if ($access=='w')
	{
		print "<input type=submit name=deleteall value=\"".$DelSelectedNr."\" class=button>";
	}
	else
	{
		print "&nbsp;";
	}
	print "</td>";
	if (!$add_order && $ordered)
	print "<td>&nbsp;</td>";
	print "<td align=center>";
	print "#";
	print "</td>";
	for($i=0;$i<mysql_num_rows($table_def);$i++)
	{
		if ($rows['search_view'][($i+1)]=='y')
		{
			print "<td align=center class=b>";
			if (isset($inp_text[$i]) && isset($sort) && $inp_text[$i]==$sort)
			if ($dir=='DESC')
			{
				print "<img src='img/su.gif'>&nbsp;";
			}
			else
			{
				print "<img src='img/sd.gif'>&nbsp;";
			}
			if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
			{
				if (isset($f))
				print "<a href='".basename($PHP_SELF)."?t=$table&op=$op&f=$f";
				else
				print "<a href='".basename($PHP_SELF)."?t=$table&op=$op&f=";
				if (isset($engN) && $engN!='')
				print "&engN=$engN&type=$type&context=$context";
				print "&sort=".$inp_text[$i]."&dir=DESC$sort_param$my_add_query_string'><i>".$rows['name'][($i+1)]."</i></a>";
			}
			else
			{
				if (isset($f))
				print "<a href='".basename($PHP_SELF)."?t=$table&op=$op&f=$f";
				else
				print "<a href='".basename($PHP_SELF)."?t=$table&op=$op&f=";
				if (isset($engN) && $engN!='')
				print "&engN=$engN&type=$type&context=$context";
				print "&sort=".$inp_text[$i]."&dir=DESC$sort_param$my_add_query_string'>".$rows['name'][($i+1)]."</a>";
			}
			if (isset($inp_text[$i]) && isset($sort) && $inp_text[$i]==$sort)
			if ($dir=='DESC')
			{
				print "&nbsp;<img src='img/su.gif'>";
			}
			else
			{
				print "&nbsp;<img src='img/sd.gif'>";
			}
			print "</td>";
		}
	}
	print "</tr>";
	print "</table>";
	//		Navig_adm($RowsNr,$navig_param,'',$max_count,$amount,$page_n,$i,2,5,1);
	Navig($RowsNr,$RowsNr2,$RowsNr3,$navig_param."&page_n_s={}",$max_count,$amount,$page_n,4,15);
	print "</form>";
}
else
{
	print $T26Nr.$table."&quot;.";
}
}
elseif ($access=='w')
{
	if ($op=='d') # �������
	{
		if ($deleteall==$DelSelectedNr)
		$max_dlk_=count($dlk_);
		else
		$max_dlk_=1;

		if (isset($id[0]))
		$issetid=true;
		else
		$issetid=false;

		for ($ik=0;$ik<$max_dlk_;$ik++)
		{
			if ($dl_[$ik]=="on" || $issetid)
			{
				if ($dl_[$ik]=="on")
				{
					for ($jk=0;$jk<count($dlk_[$ik]);$jk++)
					{
						$id[$jk]=$dlk_[$ik][$jk];
					}
				}

				$first=true;
				for($i=0;$i<mysql_num_rows($table_def);$i++)
				{
					if ($inp_text_k[$i]=="y")
					{
						if ($first)
						{
							$where="`".$inp_text[$i]."`='".$id[$i]."'";
							$first=false;
						}
						else
						{
							$where.=" AND `".$inp_text[$i]."`='".$id[$i]."'";
						}
					}
				}

				if ($locked_is)
				{
					if ($table=="nrad")
					$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, ur FROM `$table` WHERE $where";
					else
					$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, $table.ur FROM `$table`, nrad WHERE $where AND adid=$table.ur";
					$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
					list($lock_timeout, $lock_user) = mysql_fetch_row($res);

					if ($lock_timeout > 0 || $lock_user==$PHP_AUTH_USER || $lock_user=='')
					{
						$query = "UPDATE `$table` SET lk='".date("Y-m-d H:i:s")."', ur='$PHP_AUTH_USER' WHERE $where";
						mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
					}
				}
				if ($right_is)
				{
					if ($table=="nrad")
					$query = "SELECT rt, urr, adrl FROM `$table` WHERE $where";
					else
					$query = "SELECT $table.rt, $table.urr, adrl FROM `$table`, nrad WHERE $where AND adid=$table.urr";
					$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
					list($right_set, $right_user, $right_role) = mysql_fetch_row($res);
					if ($right_set=="" || $right_user=="" || $right_user==$PHP_AUTH_USER || $right_set=="rwrw")
					$right_set="w";
					if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
					$right_set="w";
					if ($right_set=="r-r-" && $right_user==$PHP_AUTH_USER)
					$right_set="w";

					if ($right_set!="w")
					{
						$query = "SELECT urrl FROM nrur WHERE urad='$right_user'";
						$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
						while (list($right_role) = mysql_fetch_row($res_rl))
						{
							if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
							{
								$right_set="w";
								break;
							}
						}
					}
				}

				if ( (($lock_timeout > 0 || $lock_user==$PHP_AUTH_USER || !$locked_is || $lock_user=='') && (($right_set=="w" && $right_is) || !$right_is)) || $PHP_SU )
				{
					if ($foreign_table[0]!="" && $foreign_field[0]!="" && $foreign_accordingly[0]!="")
					{
						for ($i=0;$i<count($foreign_table);$i++)
						if ($foreign_table[$i]!="" && $foreign_field[$i]!="" && $foreign_accordingly[$i]!="")
						{
							$query="SELECT `$foreign_accordingly[$i]` FROM `$table` WHERE $where";
							if ($result = mysql_query($query))
							{
								if (list($foreign_accordingly_found)=mysql_fetch_row($result))
								{
									$found=false;
									for ($i=0;$i<count($foreign_table);$i++)
									{
										if ($foreign_table[$i]!="" && $foreign_field[$i]!="")
										{
											if ($foreign_multidel[$i]!="y")
											{
												$query="SELECT * FROM `$foreign_table[$i]` WHERE `$foreign_field[$i]`='$foreign_accordingly_found'";
												if ($result = mysql_query($query))
												{
													if (list()=mysql_fetch_row($result))
													{
														$found=true;
														$message.=$strErrorSelectForDel." (Table - $foreign_table[$i], field - $foreign_field[$i], accordingly - $foreign_accordingly[$i])&nbsp;";
														$message.="<a href=nr.php?t=$foreign_table[$i]&op=s&se[$foreign_field[$i]]=".$foreign_accordingly_found." target=_blank><img src=img/view.gif border=0 alt=".$T27Nr." align=center></a><br>";
													}
												}
												else
												{
													$message.=$strErrorSelect." (Table - $foreign_table[$i], field - $foreign_field[$i], accordingly - $foreign_accordingly[$i])<br>";
												}
											}
											else
											{
												$query="DELETE FROM `$foreign_table[$i]` WHERE `$foreign_field[$i]`='$foreign_accordingly_found'";
												if ($result = mysql_query($query))
												{
													$message.="(From Table - $foreign_table[$i] deletet ".mysql_affected_rows()." rows)<br>";
												}
												else
												{
													$found=true;
												}
											}
										}
									}

									if (!$found)
									{
										if ($basket==0)
										{
											$query="DELETE FROM `$table` WHERE $where";
										}
										else
										{
											$query="UPDATE `$table` SET dl='y', up='".date("Y-m-d H:i:s")."' WHERE $where";
										}
										if ($result = mysql_query($query))
										{
											if (mysql_affected_rows()==1)
											{
												if ($basket==0)
												{
													$message.=$strDeleted;
												}
												else
												{
													$message.=$T28Nr." - ".$basket." ".$T29Nr;
												}
											}
											else
											{
												$message.=$strErrorDel;
											}
										}
										else
										{
											$message.=$strErrorDel;
										}
									}
								}
								else
								{
									$message.=$strErrorSelect;
								}
							}
							else
							{
								$message.=$strErrorSelect;
							}
						}
					}
					else
					{
						if ($basket==0)
						{
							$query="DELETE FROM `$table` WHERE $where";
						}
						else
						{
							$query="UPDATE `$table` SET dl='y', up='".date("Y-m-d H:i:s")."' WHERE $where";
						}
						if ($result = mysql_query($query))
						{
							if (mysql_affected_rows()==1)
							{
								if ($basket==0)
								{
									$message.=$strDeleted;
								}
								else
								{
									$message.=$T28Nr." - ".$basket." ".$T29Nr;
								}
							}
							else
							{
								$message.=$strErrorDel;
							}
						}
						else
						{
							$message.=$strErrorDel;
						}
					}
				}
				else
				{
					$message.=$T30Nr;
				}
				$message.="<br>";
			}
			/*	// Location redirect
			if ($lock_timeout > 0 || $lock_user==$PHP_AUTH_USER || !$locked_is || $lock_user=='')
			{
			if ($reverse==1)
			{
			$redir=basename($HTTP_REFERER);
			$redir.="?t=$t1$t2_exist&ce=$ce&message=".urlencode($message);
			}
			else
			{
			$redir=basename($PHP_SELF);
			$redir.="?t=$table&op=s&message=".urlencode($message);
			$redir.="$my_query_string";
			}
			Header("Location: ".$redir);
			exit;
			}
			else
			{
			$redir=basename($PHP_SELF)."?";

			$first=true;
			for($i=0;$i<mysql_num_rows($table_def);$i++)
			{
			if ($inp_text_k[$i]=="y")
			{
			if ($first)
			{
			$redir.="id[$i]=".urlencode($id[$i]);
			$first=false;
			}
			else
			{
			$redir.="&id[$i]=".urlencode($id[$i]);
			}
			}
			}

			$redir.="&t=$table&message=".urlencode($message);
			if ($my_query_string!="")
			$redir.="$my_query_string";
			Header("Location: ".$redir);
			exit;
			}*/
		}

		//		if (!$found)
		{
			if ($reverse==1)
			{
				$redir=basename($HTTP_REFERER);
				$redir.="?t=$t1$t2_exist&op=s&ce=$ce&message=".urlencode($message);
			}
			else
			{
				$redir=basename($PHP_SELF);
				$redir.="?t=$table&op=s&message=".urlencode($message);
				$redir.="$my_query_string";
			}
			Header("Location: ".$redir);
			exit;
		}
	}

	if (isset($op) && ($op=="u" || $op=="a")) # ��������/��������
	{
		$message = ($op=="a") ? $strAdded : $strModifyed;
		$message_error_not_infill=false;

		if ($op=="a")
		{
			$fieldlist = '';
			$valuelist = '';
			$i=0;
			for ($j=0;$j<count($p_k);$j++)
			{
				if ($p_k[$j]=='auto') # autoinkr ����������
				{
					list($key, $val) = each($fields);
					$i++;
				}
			}
			while(list($key, $val) = each($fields))
			{
				if ($rows['infill'][$i+1]=='y' && $val=="" && strtolower($val)!='null' && strtolower($val)!='$blob$')
				{
					$message=$T31Nr;
					$message_error_not_infill=true;
				}
				if ($rows['module_valid'][$i+1]!='' && !$message_error_not_infill)
				{
					$el_in=$val;
					include ($rows['module_valid'][($i+1)]);
					if ($el_out[0]==false)
					{
						$message=$el_out[1];
						$message_error_not_infill=true;
					}
					$val=$el_out[2];
				}
				$e_k[$i]=$key;
				$e_v[$i]=$val;
				if ($inp_text_k[$i]=="y")
				{
					$id[$i]=$val;
				}
				switch (strtolower($val))
				{
					case 'null':
						if (!ereg("_siz",$key))
						{
							$fieldlist .= "`$key`, ";
							$valuelist .= "$val, ";
						}
						break;
					case '$set$':
						$fieldlist .= "`$key`, ";
						$f = "field_$key";
						$val = "'".($$f?implode(',',$$f):'')."'";
						$valuelist .= "$val, ";
						$e_v[$i]=$val;
						break;
					case '$blob$':
//						var_dump($table);
						$f = "field_$key";
						$ff = "field_$key"."_name";
						if (!empty($$f) && $$f != "none")
						{
							if ($table != 'nrfl')
							{
								$fieldlist .= "`$key`, ";
								$val = "'".chunk_split(base64_encode(fread(fopen($$f, "r"), filesize($$f))))."'";
								$valuelist .= "$val, ";
							}
							$fieldlist .= "`$key"."_fnm`".", ";
							$valuelist .= "'".$$ff."', ";
							$fieldlist .= "`$key"."_siz`".", ";
							$valuelist .= "'".filesize($$f)."', ";
						}
						break;
					default:
						if (!ereg("_siz",$key) && $key!="urr")
						{
							$fieldlist .= "`$key`, ";
							if ($fieldsf[$key] != '')
							{
								if ($val != '')
								$val = $fieldsf[$key]."('$val')";
								else
								$val = $fieldsf[$key]."('')";
							}
							else
							{
								$val = "'$val'";
							}
							$valuelist .= "$val, ";
						}
						break;
				}
				$i++;
			}

			if ($loginning=='y')
			{
				$fieldlist .= "ad, ";
				$val = "'".date("Y-m-d H:i:s")."'";
				$valuelist .= "$val, ";
				$fieldlist .= "up, ";
				$val = "'".date("Y-m-d H:i:s")."'";
				$valuelist .= "$val, ";
			}
			if ($right_is)
			{
				$fieldlist .= "urr, ";
				$val = "'".$PHP_AUTH_USER."'";
				$valuelist .= "$val, ";
			}
			if ($locked_is)
			{
				$fieldlist .= "lk, ";
				$val = "'".date("Y-m-d H:i:s")."'";
				$valuelist .= "$val, ";
				$fieldlist .= "ur, ";
				$val = "'".$PHP_AUTH_USER."'";
				$valuelist .= "$val, ";
			}

			$values_fields = ereg_replace(', $', '', $fieldlist);
			$values = ereg_replace(', $', '', $valuelist);

			if (!$message_error_not_infill)
			{
				$sql_query = "INSERT INTO `$table` ($values_fields) VALUES ($values)";
				$res = mysql_query( $sql_query) or mysql_die($MySQLError.mysql_error(), false);
				for ($i=0;$i<=count($p_k);$i++)
				{
					if ($p_k[$i]=='auto')
					{
						$id[$i]=mysql_insert_id();
						
						// FILE save to media dir patch
						$key = 'flim';
//						var_dump($fields, $key);
						if (isset($fields[$key]) && strtolower($fields[$key]) == '$blob$')
						{
							$f = "field_$key";
							$ff = "field_$key"."_name";
							if (!empty($$f) && $$f != "none")
							{
								move_uploaded_file  ( 
									$$f, 
									$_SERVER['DOCUMENT_ROOT'].$path_to_media.$id[$i]  );
							}
						}
						// File save end
					}
				}
			}
		}
		else
		{
			$first=true;
			for($i=0;$i<mysql_num_rows($table_def);$i++)
			{
				if ($inp_text_k[$i]=="y")
				{
					if ($first)
					{
						$where="`".$inp_text[$i]."`='".$id[$i]."'";
						$fs_id = $id[$i]; // Patch file save
						$first=false;
					}
					else
					{
						$where.=" AND `".$inp_text[$i]."`='".$id[$i]."'";
					}
				}
			}
			if ($locked_is)
			{
				if ($table=="nrad")
				$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, ur FROM `$table` WHERE $where";
				else
				$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, $table.ur FROM `$table`, nrad WHERE $where AND adid=$table.ur";
				$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
				list($lock_timeout, $lock_user) = mysql_fetch_row($res);
			}
			if ($right_is)
			{
				if ($table=="nrad")
				$query = "SELECT rt, urr, adrl FROM `$table` WHERE $where";
				else
				$query = "SELECT $table.rt, $table.urr, adrl FROM `$table`, nrad WHERE $where AND adid=$table.urr";
				$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
				list($right_set, $right_user, $right_role) = mysql_fetch_row($res);
				if ($right_set=="" || $right_user=="" || $right_user==$PHP_AUTH_USER || $right_set=="rwrw")
				$right_set="w";
				if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
				$right_set="w";
				if ($right_set=="r-r-" && $right_user==$PHP_AUTH_USER)
				$right_set="w";
				if ($right_set!="w")
				{
					$query = "SELECT urrl FROM nrur WHERE urad='$right_user'";
					$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
					while (list($right_role) = mysql_fetch_row($res_rl))
					{
						if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
						{
							$right_set="w";
							break;
						}
					}
				}
				if ($right_user=="")
				{
					$query = "UPDATE `$table` SET urr='".$PHP_AUTH_USER."' WHERE $where";
					mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
				}
			}

			if ( (($lock_timeout < 0 && $lock_user!=$PHP_AUTH_USER) || $right_set=='r') && !$PHP_SU )
			{
				$message=$T32Nr;
			}
			else
			{
				if ($foreign_table[0]!="" && $foreign_field[0]!="" && $foreign_accordingly[0]!="")
				{
					for ($i=0;$i<count($foreign_table);$i++)
					if ($foreign_table[$i]!="" && $foreign_field[$i]!="" && $foreign_accordingly[$i]!="")
					{
						$query="SELECT `$foreign_accordingly[$i]` FROM `$table` WHERE $where";
						if ($result = mysql_query($query))
						{
							if (list($foreign_accordingly_found)=mysql_fetch_row($result))
							{
								$found=false;
								for ($i=0;$i<count($foreign_table);$i++)
								{
									if ($foreign_table[$i]!="" && $foreign_field[$i]!="")
									{
										$query="SELECT * FROM `$foreign_table[$i]` WHERE `$foreign_field[$i]`='$foreign_accordingly_found'";
										if ($result = mysql_query($query))
										{
											if (list()=mysql_fetch_row($result))
											{
												$found=true;
												$message.="<br>".$strErrorSelectForDel." (Table - $foreign_table[$i], field - $foreign_field[$i], accordingly - $foreign_accordingly[$i])";
												$message.="<a href=nr.php?t=$foreign_table[$i]&op=s&se[$foreign_field[$i]]=".$foreign_accordingly_found." target=_blank><img src=img/view.gif border=0 alt=".$T27Nr." align=center></a>";
											}
										}
										else
										{
											$message.="<br>".$strErrorSelect." (Table - $foreign_table[$i], field - $foreign_field[$i], accordingly - $foreign_accordingly[$i])";
										}
									}
								}

							}
							else
							{
								$message=$strErrorSelect;
							}
						}
						else
						{
							$message=$strErrorSelect;
						}
					}
				}

				$i=0;
				$set = "";
				while(list($key, $val) = each($fields))
				{
					$found_field=false;
					if ($found)
					for ($j=0;$j<count($foreign_accordingly);$j++)
					{
						if ($key == $foreign_accordingly[$j])
						{
							$found_field=true;
							break;
						}
					}
					if (!$found || ($found && !$found_field))
					{
						if ($rows['infill'][$i+1]=='y' && $val=="" && strtolower($val)!='null' && strtolower($val)!='$blob$')
						{
							$message=$T31Nr;
							$message_error_not_infill=true;
						}
						if ($rows['module_valid'][$i+1]!='' && !$message_error_not_infill)
						{
							$el_in=$val;
							include ($rows['module_valid'][($i+1)]);
							if ($el_out[0]==false)
							{
								$message=$el_out[1];
								$message_error_not_infill=true;
							}
							$val=$el_out[2];
						}
						$e_k[$i]=$key;
						$e_v[$i]=$val;
						if ($inp_text_k[$i]=="y")
						{
							$id[$i]=$val;
						}
						switch (strtolower($val))
						{
							case 'null':
								$set .= "`$key` = $val, ";
								break;
							case '$set$':
								$f = "field_$key";
								$val = "'".($$f?implode(',',$$f):'')."'";
								$set .= "`$key` = $val, ";
								$e_v[$i]=$val;
								break;
							case '$blob$':
								$f = "field_$key";
								$ff = "field_$key"."_name";
								if (!empty($$f) && $$f != "none")
								{
									if ($table != 'nrfl')
									{									
										$val = "'".chunk_split(base64_encode(fread(fopen($$f, "r"), filesize($$f))))."'";
										$set .= "`$key` = $val, ";
									}
									
									$set .= "`$key"."_fnm`"." = '".$$ff."', ";
									$set .= "`$key"."_siz`"." = '".filesize($$f)."', ";
								}
								elseif ($$ff == "none")
								{
									$name = "''";
									$val = "''";
									$set .= "`$key` = $val, ";
									$set .= "`$key"."_fnm`"." = '', ";
									$set .= "`$key"."_siz`"." = '0', ";
								}
								break;
							default:
								if (!ereg("_siz",$key))
								{
									if ($rows['security'][$i+1]=='y' && $val=='')
									{
									}
									else
									{
										if ($fieldsf[$key] != '')
										{
											if ($val != '')
											$val = $fieldsf[$key]."('$val')";
											else
											$val = $fieldsf[$key]."()";
										}
										else
										{
											$val = "'$val'";
										}
										$set .= "`$key` = $val, ";
									}
								}
								break;
						}
					}
					$i++;
				}

				if ($loginning=='y')
				{
					$set .= "up = '".date("Y-m-d H:i:s")."', ";
				}
				if ($locked_is)
				{
					$set .= "lk = '".date("Y-m-d H:i:s")."', ";
					$set .= "ur = '".$PHP_USER_AUTH."', ";
				}

				$set = ereg_replace(', $', '', $set);

				if (!$message_error_not_infill)
				{
					$sql_query = "UPDATE `$table` SET $set WHERE ".stripslashes($where);
					$res = mysql_query( $sql_query) or mysql_die($MySQLError.mysql_error(), false);
					if (mysql_affected_rows()==0)
						$message="";
					else 
					{
						// FILE save to media dir patch
						$key = 'flim';
//						var_dump($fields, $key);
						if (isset($fields[$key]) && strtolower($fields[$key]) == '$blob$')
						{
							$f = "field_$key";
							$ff = "field_$key"."_name";
							if (!empty($$f) && $$f != "none")
							{
								move_uploaded_file  ( 
									$$f, 
									$_SERVER['DOCUMENT_ROOT'].$path_to_media.$fs_id  );
							}
						}
						// File save end						
					}
				}

			}
		}
		// For Location redirect
		/*		$redir=basename($PHP_SELF)."?";

		$first=true;
		for($i=0;$i<mysql_num_rows($table_def);$i++)
		{
		if ($inp_text_k[$i]=="y")
		{
		if ($first)
		{
		$redir.="id[$i]=".urlencode($id[$i]);
		$first=false;
		}
		else
		{
		$redir.="&id[$i]=".urlencode($id[$i]);
		}
		}
		}*/
		if ($message_error_not_infill)
		{
			for ($i=0;$i<count($e_k);$i++)
			{
				$e[$e_k[$i]]=$e_v[$i];
			}
		}

		/*		$redir.="&t=$table&message=".urlencode($message)."&message_error_not_infill=$message_error_not_infill";
		if ($my_query_string!="")
		$redir.="$my_query_string";
		Header("Location: ".$redir);
		exit;*/
	}
	include("header.inc.php");
	?>
</head>

<?print $body?>
<br>
<font>
<a href="<?print basename($PHP_SELF)."?t=$table$my_query_string"?>"><img src="img/add.gif" width=31 height=18 border=0 alt="<?print $AddNr?>"></a>
<a href="<?print basename($PHP_SELF)."?t=$table&op=s$my_query_string";?>"><img src="img/se.gif" width=31 height=18 border=0 alt="<?print $FindNr?>"></a>
<?
if (isset($ce) && $ce!='' && $t2!='')
{
	print " <a href=\"pg/catalog/nrcl.php?t=$t1$t2_exist&ce=$ce\"><img src=\"img/bcat.gif\" width=35 height=18 border=0 alt=\"".$T18Nr."\"></a>";
}
if ((/*$csv=='y' || */$basket!=0) && $op!='sv')
{
	/*	if ($csv=='y')
	{
	print " <a href=\"".$no_https_adm."csv.php?t=$table\"><font><img src=\"img/csvto.gif\" width=54 height=18 border=0 alt=\"".$T19Nr."\"></font></a> <a href=\"csv_to_base.php?t=$table\" target=_blank><font><img src=\"img/tocsv.gif\" width=54 height=18 border=0 alt=\"".$T20Nr."\"></font></a>";
	if ($basket!=0)
	print " <a href=\"nr.php?t=$table&op=s&bst=y$my_query_string\"><font><img src=\"img/bas.gif\" width=31 height=18 border=0 alt=\"".$T21Nr."\"></font></a>";
	}
	else*/
	{
		if ($basket!=0)
		{
			print " <a href=\"nr.php?t=$table&op=s&bst=y$my_query_string\"><font><img src=\"img/bas.gif\" width=31 height=18 border=0 alt=\"".$T21Nr."\"></font></a>";
		}
	}
}
if ($PHP_SU)
{
	print " <a href=\"tools/del_f_t.php?t=$table\" target=_blank><font><img src=\"img/dla.gif\" width=24 height=18 border=0 alt=\"".$T22Nr."\"></font></a>";
	print " <a href=\"tools/table_status.php?t=$t\"><img src=\"img/inf.gif\" width=31 height=18 border=0 alt=\"".$T23Nr."\"></a>";
}
?>
</font>
<?
include("scriptsadd.inc.php");
?>
<div align=center>
	<?
	print "<font class=b>$strTitle: </font><br>";
	if (isset($id) && count($id)==count($pri_keys))
	{
		$first=true;
		$table_def = mysql_query( "SHOW FIELDS FROM `$table`") or mysql_die($ErrorSelectFieldsTable." <b>$table</b>", false);
		/*		for($i=0;$i<mysql_num_rows($table_def);$i++) // only showing or PK
		{
		$row_table_def = mysql_fetch_array($table_def);
		if ($rows['show'][$i+1]=='y' || $inp_text_k[$i]=='y')
		{
		if ($first)
		{
		$row_for_searche=$row_table_def["Field"];
		$first=false;
		}
		else
		{
		$row_for_searche.=", ".$row_table_def["Field"];
		}
		}
		}*/
		$row_for_searche="*";
		$first=true;
		for($i=0;$i<mysql_num_rows($table_def);$i++)
		{
			if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
			{
				if ($first)
				{
					$where="`".$inp_text[$i]."`='".$id[$i]."'";
					$first=false;
				}
				else
				{
					$where.=" AND `".$inp_text[$i]."`='".$id[$i]."'";
				}
			}
		}
		if (isset($locked_is) && $locked_is)
		{
			if ($table=="nrad")
			$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, ur FROM `$table` WHERE $where";
			else
			$query = "SELECT (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(lk))-adto, $table.ur FROM `$table`, nrad WHERE $where AND adid=$table.ur";
			$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
			list($lock_timeout, $lock_user) = mysql_fetch_row($res);

			if ($lock_timeout > 0 || $lock_user==$PHP_AUTH_USER || $lock_user=='')
			{
				$query = "UPDATE `$table` SET lk='".date("Y-m-d H:i:s")."', ur='$PHP_AUTH_USER' WHERE $where";
				mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
			}
		}
		if (isset($right_is) && $right_is)
		{
			if ($table=="nrad")
			$query = "SELECT rt, urr, adrl FROM `$table` WHERE $where";
			else
			$query = "SELECT $table.rt, $table.urr, adrl FROM $table, nrad WHERE `$where` AND adid=$table.urr";
			$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
			list($right_set, $right_user, $right_role) = mysql_fetch_row($res);
			if ($right_set=="" || $right_user=="" || $right_user==$PHP_AUTH_USER || $right_set=="rwrw")
			$right_set="w";
			if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
			$right_set="w";
			if ($right_set=="r-r-" && $right_user==$PHP_AUTH_USER)
			$right_set="w";
			if ($right_set!="w")
			{
				$query = "SELECT urrl FROM nrur WHERE urad='$right_user'";
				$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
				while (list($right_role) = mysql_fetch_row($res_rl))
				{
					if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
					{
						$right_set="w";
						break;
					}
				}
			}
		}
		$query = "SELECT $row_for_searche FROM `$table` WHERE $where";
		$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
		$row = mysql_fetch_array($res);

		$not_found = false;
		if (mysql_num_rows($res) == 0 && !$message_error_not_infill)
		{
			print $T34Nr;
			$not_found = true;
		}
	}
	else
	{
		$res = mysql_query( "SELECT * FROM `$table` LIMIT 1") or mysql_die($MySQLError.mysql_error(), false);
	}
	?>
<form action="<?print basename($PHP_SELF)."?$my_query_string$my_ss_query_string"?>" method=post enctype="multipart/form-data" name=sendmessage>
<?
print "<input type=hidden name=t value=\"$table\">";
$first = true;
for($i = 0; $i < mysql_num_rows($table_def); $i++)
{
	if (isset($inp_text_k[$i]) && $inp_text_k[$i] == "y")
	{
		if (!isset($row[$i]))
		$row[$i]="";
		print "<input type=hidden name=id[$i] value=\"".htmlspecialchars($row[$i])."\">";
	}
}
if (isset($message))
print $message."<br><br>";
	?>
<table border=0>
	<?

	$tmp=0;
	$u=0;
	$table_def = mysql_query( "SHOW FIELDS FROM `$table`") or mysql_die($ErrorSelectFieldsTable." <b>$table</b>", false);
	for($i = 0; $i < mysql_num_rows($table_def); $i++)
	{
		$row_table_def = mysql_fetch_array($table_def);
		$field = $row_table_def["Field"];
		print "<input type=hidden name=fieldsf[$field] value=\"".$rows['function'][($i+1)]."\">";
		if ((isset($rows['show'][($i+1)]) && $rows['show'][($i+1)]=='y') || (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y"))
		{
			if(($row_table_def['Type']  == "datetime") && ($row[$field] == "") && $rows['data'][($i+1)]=='')
				$row[$field] = date("Y-m-d H:i:s", time());
			elseif(($row_table_def['Type']  == "date") && ($row[$field] == "") && $rows['data'][($i+1)]=='')
				$row[$field] = date("Y-m-d", time());
			elseif(($row_table_def['Type']  == "time") && ($row[$field] == "") && $rows['data'][($i+1)]=='')
				$row[$field] = date("H:i:s", time());
			elseif(($row_table_def['Type']  == "timestamp(14)") && ($row[$field] == "") && $rows['data'][($i+1)]=='')
				$row[$field] = date("YmdHis", time());
			elseif(($row_table_def['Type']  == "year(4)") && ($row[$field] == "") && $rows['data'][($i+1)]=='')
				$row[$field] = date("Y", time());
			$len = mysql_field_len($res, $i);

			if ((isset($p_k[$i]) && $p_k[$i]=='manual' && isset($inp_text_k[$i]) && $inp_text_k[$i]=="y") || (isset($rows['show'][$i+1]) && $rows['show'][$i+1]=='y'))
			{
				$tmp++;
				$bg = $bg3;
				$tmp % 2 ? 0 : $bg = $bg4;
				print "<tr bgcolor=".$bg.">\n";
				if ($rows['infill'][($i+1)]=='y')
					$infill="* ";
				else
					$infill="";

				if (strstr($row_table_def["Type"], "blob"))
				{
					if (isset($id[0]) && $row[$field]!='')
					{
						print "<td align=right title=\"".$rows['help'][($i+1)]."\">";
						print "<a href='trf.php?id[0]=$id[0]&t=$table&f=$field' target=_blank>";
						print $infill.$rows['name'][($i+1)]."</a></td>\n";
					}
					else
					{
						print "<td align=right title=\"".$rows['help'][($i+1)]."\">";
						print $infill.$rows['name'][($i+1)];
						print "</td>\n";
					}
				}
				else
				{
					print "<td align=right title=\"".$rows['help'][($i+1)]."\">";
					if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
					{
						print "<b>".$infill.$rows['name'][($i+1)]."</b>";
					}
					else
					{
						print $infill.$rows['name'][($i+1)];
					}
					print "</td>\n";
				}
			}

			switch (ereg_replace("\\(.*", "", $row_table_def['Type']))
			{
				case "set":
					$type = "set";
					break;
				case "enum":
					$type = "enum";
					break;
				default:
					$type = $row_table_def['Type'];
					break;
			}
			if(isset($row) && isset($row[$field]))
			{
				$special_chars = htmlspecialchars($row[$field]);
				$data = $row[$field];
			}
			else
			{
				$data = $special_chars = "";
			}
			$ad_master_slave[$tmp] = $data;
			$ad_master_slave_cn[$inp_text_nm_all[$i]] =  $data;

			if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y" && isset($rows['show'][$i+1]) && $rows['show'][$i+1]=='y' && isset($p_k[$i]) && $p_k[$i]=='auto')
			{
				print "<td>";
				if (isset($id[$i]))
				{
					print "<input type=hidden name=fields[$field] value='".htmlspecialchars($id[$i])."'>\n";
					print $id[$i];
				}
				else
				{
					print "<input type=hidden name=fields[$field] value=''>&nbsp;";
				}
				print "</td>\n";
			}
			elseif (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y" && (!isset($rows['show'][$i+1]) || $rows['show'][$i+1]!='y') && isset($p_k[$i]) && $p_k[$i]=='auto')
			{
				if (isset($id[$i]))
				{
					print "<input type=hidden name=fields[$field] value='".htmlspecialchars($id[$i])."'>";
				}
				else
				{
					print "<input type=hidden name=fields[$field] value=''>";
				}
			}
			elseif ($rows['notedit'][($i+1)]=='y')
			{
				print "<td>";
				if (!isset($e[$field]))
				{
					if ($rows['add'][$i+1]=='y')
					{
						if (!isset($row) || !isset($row[$field]))
						$ttmp=$rows['data'][$i+1];
						else
						{
							if ($ad[$u]=='')
							{
								$ttmp=$special_chars;
								$add[$u]=$special_chars;
							}
							else
							{
								$ttmp=$ad[$u];
								$add[$u]=$ad[$u];
							}
						}
						$u++;
					}
					if (!isset($row) || !isset($row[$field]))
					if ($rows['add'][$i+1]=='y' && $ad[($u-1)]!='')
					$special_chars_=$ad[($u-1)];
					else
					$special_chars_=$rows['data'][$i+1];
					else
					$special_chars_=$special_chars;
				}
				else
				$special_chars_=$e[$field];
				print $special_chars_;
				if (isset($id[$i])) # !!!!
				{
					print "<input type=hidden name=fields[$field] value='".htmlspecialchars($id[$i])."'>\n";
				}
				else
				{
					print "<input type=hidden name=fields[$field] value='".htmlspecialchars($special_chars_)."'>\n";
				}
				print "</td>\n";
			}
			else
			{
				if(strstr($row_table_def["Type"], "text"))
				{
					print "<td><textarea name=fields[$field] rows=5 cols=40>";
					if (isset($e[$field]))
					print $e[$field];
					else
					print $special_chars;
					print "</textarea>";
					if ($rows['eng_t'][$i+1]!="")
					{
						$ext = substr(basename($PHP_SELF), strrpos(basename($PHP_SELF), ".")+1);
						print "&nbsp;<a href=\"nr".".".$ext."?op=sv&t=".$rows['eng_t'][$i+1]."&f=".$rows['eng_f'][$i+1]."&context=".urlencode(ereg_replace("&", "{}amp;", $rows['eng_c'][$i+1]))."&vf=".$rows['eng_vf'][$i+1]."&engN=$field&type=1\" target=Searcher>";
						print "<img src=\"img/sl.gif\" width=26 height=18 border=0 alt=\"".$ChooseNr."\" align=center>";# align=middle
						print "</a>";
					}
					print " <a href=\"HTMLEditor.php?f=$field\" target=editor><img src=\"img/sl_editor.gif\" width=28 height=18 border=0 alt=\"".$HTMLEditorNr."\" align=middle></a>";
					print "</td>\n";
				}
				elseif(strstr($row_table_def["Type"], "blob"))
				{
					print "<td><input type=\"hidden\" name=\"fields[$field]\" value=\"\$blob\$\">";
					print "<input type=file name=field_${field}>";
					if (isset($id[0]) && $id[0]!="")// && $row[$field]!='')
					{
						print "<br><div align=center>";
						print "<a href='trf.php?id[0]=$id[0]&t=$table&f=$field' target=_blank>";
						print "<img align=center src=\"".$no_https_adm."trf.php?id[0]=$id[0]&t=$table&f=$field\" border=0 alt=\"\">";
						print "</a></div>";
					}
					print "</td>\n";
				}
				elseif(strstr($row_table_def["Type"], "enum"))
				{
					$set = str_replace("enum(", "", $row_table_def["Type"]);
					$set = ereg_replace("\\)$", "", $set);

					$set = split_string($set, ",");
					print "<td><select name=fields[$field]>\n";
					for($j=0; $j<count($set);$j++)
					{
						print '<option value="'.substr($set[$j], 1, -1).'"';
						if (isset($e[$field]))
						{
							if($e[$field] == substr($set[$j], 1, -1) || ($e[$field] == "" && substr($set[$j], 1, -1) ==	 $row_table_def["Default"]))
							print " selected";
						}
						else
						{
							if($data == substr($set[$j], 1, -1) || ($data == "" && substr($set[$j], 1, -1) ==	 $row_table_def["Default"]))
							print " selected";
						}
						print ">".htmlspecialchars(substr($set[$j], 1, -1))."\n";
					}
					print "</select></td>";
				}
				elseif(strstr($row_table_def["Type"], "set"))
				{
					$set = str_replace("set(", "", $row_table_def["Type"]);
					$set = ereg_replace("\)$", "", $set);

					$set = split_string($set, ",");
					if (isset($e[$field]))
					for($vals = explode(",", substr($e[$field],1,(strlen($e[$field])-2))); list($t, $k) = each($vals);)
					$vset[$k] = 1;
					else
					for($vals = explode(",", $data); list($t, $k) = each($vals);)
					$vset[$k] = 1;
					$size = min(4, count($set));
					print "<td><input type=\"hidden\" name=\"fields[$field]\" value=\"\$set\$\">";
					print "<select name=field_${field}[] size=$size multiple>\n";
					for($j=0; $j<count($set);$j++)
					{
						print '<option value="'.htmlspecialchars(substr($set[$j], 1, -1)).'"';
						if($vset[substr($set[$j], 1, -1)])
						print " selected";
						print ">".htmlspecialchars(substr($set[$j], 1, -1))."\n";
					}
					print "</select></td>";
				}
				else
				{
					if ($rows['security'][$i+1]!='y')
					{
						print "<td><input ";
						if ($len>47)
						print "size=47";
						else
						print "size=$len";
						print " type=text name=fields[$field] value=\"";
						if (isset($e[$field]))
						{
							if ($rows['add'][$i+1]=='y')
							{
								if ($ad[$u]=='')
								{
									$add[$u]=$e[$field];
								}
								else
								{
									$add[$u]=$e[$field];
								}
								$u++;
							}
							print $e[$field];
						}
						else
						{
							if ($rows['add'][$i+1]=='y')
							{
								if (!isset($row) || !isset($row[$field]))
								$ttmp=$rows['data'][$i+1];
								else
								{
									if (!isset($ad[$u]) || $ad[$u]=='')
									{
										$ttmp=$special_chars;
										$add[$u]=$special_chars;
									}
									else
									{
										$ttmp=$ad[$u];
										$add[$u]=$ad[$u];
									}
								}
								$u++;
							}
							if (!isset($row) || !isset($row[$field]))
							{
								if ($rows['add'][$i+1]=='y' && isset($ad[($u-1)]) && $ad[($u-1)]!='')
									$special_chars_=$ad[($u-1)];
								else
									$special_chars_=$rows['data'][$i+1];
							}
							else
							{
								$special_chars_=$special_chars;
							}
							print $special_chars_;
						}
						print "\" maxlength=$len>";
						if(($row_table_def['Type']  == "datetime"))
						print "&nbsp;<a href=\"javascript:calendar(1,'$field');\"><img src=\"img/cal.gif\" border=0 alt=\"".$CalNr."\" align=center></a>";
						elseif(($row_table_def['Type']  == "date"))
						print "&nbsp;<a href=\"javascript:calendar(2,'$field');\"><img src=\"img/cal.gif\" border=0 alt=\"".$CalNr."\" align=center></a>";
						elseif(($row_table_def['Type']  == "timestamp(14)"))
						print "&nbsp;<a href=\"javascript:calendar(4,'$field');\"><img src=\"img/cal.gif\" border=0 alt=\"".$CalNr."\" align=center></a>";
						if ($rows['eng_t'][$i+1]!="")
						{
							$ext = substr(basename($PHP_SELF), strrpos(basename($PHP_SELF), ".")+1);
							print "&nbsp;<a href=\"nr".".".$ext."?op=sv&t=".$rows['eng_t'][$i+1]."&f=".$rows['eng_f'][$i+1]."&vf=".$rows['eng_vf'][$i+1]."&engN=$field&type=0"."&context=".urlencode(ereg_replace("&", "{}amp;", $rows['eng_c'][$i+1]))."\" target=Searcher>";
							print "<img src=\"img/sl.gif\" width=26 height=18 border=0 alt=\"".$ChooseNr."\" align=center>";# align=middle
							print "</a>";
						}
						print "</td>";
						if ($rows['eng_t'][$i+1]!="" && $rows['eng_f'][$i+1]!="" && $rows['eng_vf'][$i+1]!="")
						{
							print "<tr bgcolor=".$bg.">";
							print "<td colspan=2 align=center>";
							$query = "SELECT ".$rows['eng_vf'][$i+1]." FROM ".$rows['eng_t'][$i+1]." WHERE ".$rows['eng_f'][$i+1]."='".$special_chars_."'";
							$res_sub_table = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
							list($eng_vf_)=mysql_fetch_row($res_sub_table);
							if ($eng_vf_!='')
							if (strlen($eng_vf_)>50)
							print " (".htmlspecialchars(substr($eng_vf_,0,50))." ...)";
							else
							print " (".htmlspecialchars($eng_vf_).")";
							print "</td>";
							print "</tr>";
						}
					}
					else
					{
						print "<td><input type=password name=fields[$field] maxlength=$len>";
						if ($rows['eng_t'][$i+1]!="")
						{
							$ext = substr(basename($PHP_SELF), strrpos(basename($PHP_SELF), ".")+1);
							print "<a href=\"nr".".".$ext."?op=sv&t=".$rows['eng_t'][$i+1]."&f=".$rows['eng_f'][$i+1]."&vf=".$rows['eng_vf'][$i+1]."&engN=$field&type=1\" target=Searcher>";
							print $ChooseNr;
							print "</a>";
						}
						print "</td>";
					}
				}
			}
			if ((isset($p_k[$i]) && $p_k[$i]=='manual' && isset($inp_text_k[$i]) && $inp_text_k[$i]=="y") || (isset($rows['show'][$i+1]) && $rows['show'][$i+1]=='y'))
			{
				print "</tr>\n";
			}
		}
		else
		{
			if ($rows['function'][($i+1)]!='')
			{
				print "<input type=hidden name=fields[$field] value=\"\">";
				print "<input type=hidden name=fieldsf[$field] value=\"".$rows['function'][($i+1)]."\">";
			}
		}
	}

	print "</table>";
	if (!isset($lock_timeout)) $lock_timeout = "";
	if ( (($lock_timeout < 0 && $lock_user!=$PHP_AUTH_USER) || (isset($right_is) && $right_is && $right_set!='w')) && !$PHP_SU)
	{
		if ($lock_timeout < 0 && $lock_user!=$PHP_AUTH_USER)
		print $T35Nr."<b>".(0-$lock_timeout)."</b> c.<br><a href=\"".$PHP_SELF."?".$QUERY_STRING."\">".$RefreshNr."</a>";
		if ( ($right_is && $right_set!='w') && !$PHP_SU )
		print "<br>".$T36Nr;
	}
	else
	{
		if ($PHP_SU && ($lock_timeout < 0 && $lock_user!=$PHP_AUTH_USER) )
		{
			print $T35Nr."<b>".(0-$lock_timeout)."</b> c.<br><a href=\"".$PHP_SELF."?".$QUERY_STRING."\">".$RefreshNr."</a>";
		}
		if ( (isset($right_is) && $right_is && $right_set!='w') && $PHP_SU )
		{
			print "<br>".$T36Nr;
		}
	?>
	<p>
	<?if (!isset($id[0]) || (isset($message_error_not_infill) && $message_error_not_infill && $op=="a") || $not_found){?><input type=hidden name=op value="a"><input class=button type=Submit value="<?print $AddNr?>"><?}else{?><input type=Submit class=button value="<?print $UpdateNr?>" name=Submit><input type=Submit class=button value="<?print $DeleteNr?>" name=Submit><?}?>&nbsp;<input type=Reset class=button value="<?print $ResetNr?>"><?}?>
</form><br><?

$query = "SELECT cffl, cftb, cfen, cfenf, tbds FROM nrcf, nrtb WHERE tbnm=cftb AND cfen='$table' AND cfpd='y' ORDER BY cfen";
$res = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
$tmp=0;
$first=true;
$tmp_links=0;
$ad_links_ok=false;
//	$tbds_tmp;
while (list($cffl, $cftb, $cfen, $cfenf, $tbds)=mysql_fetch_row($res)) # ��������� ������
{
	if ($ad_master_slave_cn[$cfenf]!="")
	$ad_links_ok=true;
	if ($cfen_==$cfen || $first)
	{
		$first=false;
		$ad[$tmp]=$cfenf;
		$cfenf_ad.="&ad[$tmp]=".$ad_master_slave_cn[$cfenf];
		$cfenf_se.="&se[$cffl]=".$ad_master_slave_cn[$cfenf];
		$cftb_=$cftb;
		$tmp++;
		$tbds_tmp=$tbds;
	}
	else
	{
		$links_ad_maste_slave[$tmp_links]="<a href=\"nr.php?t=$cftb_$cfenf_ad$t2_exist\" target=_blank><img src=\"img/added_table.gif\" width=50 height=18 border=0 alt=\"".$T37Nr." &quot;$tbds_tmp&quot;\"></a>";
		$links_se_maste_slave[$tmp_links]="<a href=\"nr.php?t=$cftb_$cfenf_se$t2_exist&op=s\" target=_blank><img src=\"img/edited_table.gif\" width=50 height=18 border=0 alt=\"".$T38Nr." &quot;$tbds_tmp&quot;\"></a>";
		$links_se_maste_slave_tables[$tmp_links]=$tbds_tmp;
		$tmp=0;
		$ad[$tmp]=$cfenf;
		$cfenf_ad="&ad[$tmp]=".$ad_master_slave_cn[$cfenf];
		$cfenf_se="&se[$cffl]=".$ad_master_slave_cn[$cfenf];
		$cfen_=$cfen;
		$cftb_=$cftb;
		$tmp++;
		$tmp_links++;
	}
	$tbds_tmp=$tbds;
}
if ($tmp!=0 && $ad_links_ok)
{
	$links_ad_maste_slave[$tmp_links]="<a href=\"nr.php?t=$cftb_$cfenf_ad$t2_exist\" target=_blank><img src=\"img/added_table.gif\" width=50 height=18 border=0 alt=\"".$T37Nr." &quot;$tbds_tmp&quot;\"></a>";
	$links_se_maste_slave[$tmp_links]="<a href=\"nr.php?t=$cftb_$cfenf_se$t2_exist&op=s\" target=_blank><img src=\"img/edited_table.gif\" width=50 height=18 border=0 alt=\"".$T38Nr." &quot;$tbds_tmp&quot;\"></a><br>";
	$links_se_maste_slave_tables[$tmp_links]=$tbds_tmp;

	print "<table border=0 cellspacing=1 cellpadding=2>";
	print "<tr bgcolor=$bg2>";
	print "<td>".$T39Nr."</td>";
	print "";
	print "<td>&nbsp;</td>";
	print "";
	print "<td>&nbsp;</td>";
	print "</tr>";
	for ($tmp_links=0; $tmp_links < count($links_ad_maste_slave); $tmp_links++) # ������� ������
	{
		if (($tmp_links%2)==0)
		print "<tr bgcolor=$bg3>";
		else
		print "<tr bgcolor=$bg4>";
		print "<td>";
		print $links_se_maste_slave_tables[$tmp_links];
		print "</td>";
		print "<td>";
		print $links_ad_maste_slave[$tmp_links];
		print "</td>";
		print "<td>";
		print $links_se_maste_slave[$tmp_links];
		print "</td></tr>";
	}
	print "</table><br>";
}

if (isset($add[0]))	# ��������� �������� �������
{
	print "<a href=\"".basename($PHP_SELF)."?t=$table";
	for ($i=0;count($add)>$i;$i++)
	{
		print '&ad['.$i.']='.htmlspecialchars($add[$i]);
	}
	print "$my_query_string\"><font><img src=\"img/adda.gif\" width=50 height=18 border=0 alt=\"".$AddAgNr."\"></fon></a><br><br>";

	$table_def = mysql_query( "SHOW FIELDS FROM `$table`") or mysql_die($ErrorSelectFieldsTable." <b>$table</b>", false);
	$how_i=0;
	$j=0;
	$jj=0;
	$ordered_table='n';
	while(list($row_ad_field_name[$how_i]) = mysql_fetch_row($table_def))
	{
		$name_rows[$how_i] = $rows['name'][$how_i+1];
		if ($rows['add'][$how_i+1]=='y')
		{
			if ($j==0)
			$where="`".$row_ad_field_name[$how_i]."`='".$add[$j]."'";
			else
			$where.=" AND `".$row_ad_field_name[$how_i]."`='".$add[$j]."'";
			$j++;
		}
		if ($rows['order'][$how_i+1]=='y')
		{
			if ($jj==0)
			$order="ORDER BY `".$row_ad_field_name[$how_i]."`";
			else
			$order.=", `".$row_ad_field_name[$how_i]."`";
			$jj++;
			$ordered_table='y';
		}
		$how_i++;
	}

	$query="SELECT COUNT(*) FROM `$table` WHERE $where";
	$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
	list($max_ord_num)=mysql_fetch_row($result);

	if (!$amount) $amount=$nav_am;
	if (isset($page_n_ss)) $page_n=$page_n_ss;
	if (!isset($page_n_ss)) $page_n=1;
	$start=($page_n-1)*$amount;
	if ($start > $max_ord_num)
	{
		$page_n=1;
		$start=($page_n-1)*$amount;
	}

	for($i=0;$i<mysql_num_rows($table_def);$i++)
	{
		if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
		{
			if (!isset($param_id_key_)) $param_id_key_="";
			$param_id_key_.="&id[$i]=".urlencode($row[$i]);
		}
	}
	//		Navig_adm($RowsNr,basename($PHP_SELF)."?t=$table".$param_id_key_.$my_query_string,'',$max_ord_num,$amount,$page_n,$i,2,5,2);
	Navig($RowsNr, $RowsNr2, $RowsNr3, basename($PHP_SELF)."?t=$table".$param_id_key_.$my_query_string."&page_n_ss={}", $max_ord_num, $amount, $page_n, 4, 15);

	print "<table border=0 cellspacing=1 cellpadding=2><tr bgcolor=$bg2>";
	print "<td colspan=2>&nbsp;</td>";
	if ($ordered_table=='y')
	{
		print "<td>&nbsp;</td>";
	}
	for($j=0;$j<count($name_rows);$j++)
	{
		if ($rows['search_view'][$j+1]=='y' || $inp_text_k[$j]=='y')
		{
			print "<td><b>";
			print $name_rows[$j];
			print "</b></td>";
		}
	}
	print "</tr>";
	$first_rs = true;
	for($i=0;$i<count($name_rows);$i++)	# ������. ���� ��������
	{
		if ($rows['search_view'][$i+1]=='y' || $inp_text_k[$i]=='y')
		{
			if ($first_rs)
			{
				$row_for_searche="`".$inp_text[$i]."`";
				$first_rs=false;
			}
			else
			{
				$row_for_searche.=", `".$inp_text[$i]."`";
			}
		}
	}
	if ($start!=0)
	$query="SELECT $row_for_searche FROM `$table` WHERE $where $order LIMIT ".($start-1).", ".($amount+1);
	else
	$query="SELECT $row_for_searche FROM `$table` WHERE $where $order LIMIT $start, $amount";
	$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
	$tmp=0;
	if ($start!=0)
	{
		if($row_ad = mysql_fetch_array($result))
		{
			$first=true;
			for($i=0;$i<mysql_num_rows($table_def);$i++)
			{
				if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
				{
					$id_u[$i]=$row_ad[$i];
				}
			}
		}
	}
	$tmp=0;
	while($row_ad = mysql_fetch_array($result))
	{
		if (($tmp%2)==0)
		print "<tr bgcolor=$bg3>";
		else
		print "<tr bgcolor=$bg4>";

		if ($access=='w')
		{
			$first=true;
			$not_view_i=0;
			for($i=0;$i<mysql_num_rows($table_def);$i++) # result
			{
				if (isset($rows['search_view'][$i]) && $rows['search_view'][$i]=='n')
				{
					$not_view_i++;
				}
				if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
				{
					if ($first)
					{
						$param_id_key_u="id_u[$i]=".urlencode($id_u[$i]);
						$first=false;
					}
					else
					{
						$param_id_key_u.="&id_u[$i]=".urlencode($id_u[$i]);
					}
				}

				if ($inp_text_nm_all[$i]=='ur' && $inp_text_nm_all[($i+1)]=='lk')
				{
					$ur_lock=true;
					$mk_time=mktime (substr($row_ad[($i+1-$not_view_i)],11,2),substr($row_ad[($i+1-$not_view_i)],14,2),substr($row_ad[($i+1-$not_view_i)],17,2),substr($row_ad[($i+1-$not_view_i)],5,2),substr($row_ad[($i+1-$not_view_i)],8,2),substr($row_ad[($i+1-$not_view_i)],0,4));
					if ($row_ad[$i-$not_view_i]!=$PHP_AUTH_USER)
					{
						$query = "SELECT adto FROM nrad WHERE adid='".$row_ad[$i-$not_view_i]."'";
						$res_to = mysql_query($query) or mysql_die($MySQLError, false);
						list($UserTimeOut) = mysql_fetch_row($res_to);
						$mk_time_substract_am = 0-(mktime()-$mk_time-$UserTimeOut);
						if (mktime()-$mk_time-$UserTimeOut > 0)
						$mk_time_substract=true;
						else
						$mk_time_substract=false;
					}
					else
					$mk_time_substract=true;
				}
				if ($inp_text_nm_all[$i]=='urr' && $inp_text_nm_all[($i+1)]=='rt' && $right_is)
				{
					$query = "SELECT adrl FROM nrad WHERE adid='".$row_ad[$i-$not_view_i]."'";
					$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
					list($right_role) = mysql_fetch_row($res_rl);

					$right_set=$row_ad[($i+1-$not_view_i)];
					$right_user=$row_ad[$i-$not_view_i];
					if ($right_set=="" || $right_user=="" || $right_user==$PHP_AUTH_USER || $right_set=="rwrw")
					$right_set="w";
					if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
					$right_set="w";
					if ($right_set=="r-r-" && $right_user==$PHP_AUTH_USER)
					$right_set="w";

					if ($right_set!="w")
					{
						$query = "SELECT urrl FROM nrur WHERE urad='".$row_ad[$i-$not_view_i]."'";
						$res_rl = mysql_query($query) or mysql_die($MySQLError, false);
						while (list($right_role) = mysql_fetch_row($res_rl))
						{
							if ( ($right_set=="rwr-" && $right_user==$PHP_AUTH_USER) || ($right_set=="rwr-" && $right_role==$PHP_AUTH_ROLE))
							{
								$right_set="w";
								break;
							}
						}
					}
				}
			}
			$param_id_key="";
			$first=true;
			for($i=0;$i<mysql_num_rows($table_def);$i++)
			{
				if (isset($inp_text_k[$i]) && $inp_text_k[$i]=="y")
				{
					$id_u[$i]=$row_ad[$i];
					if ($first)
					{
						$param_id_key="id[$i]=".urlencode($row_ad[$i]);
						$first=false;
					}
					else
					{
						$param_id_key.="&id[$i]=".urlencode($row_ad[$i]);
					}
				}
			}
			$first=true;
			for($i=0;$i<count($id);$i++)
			{
				if ($first)
				{
					$param_id_key_e="id_e[$i]=".urlencode($id[$i]);
					$first=false;
				}
				else
				{
					$param_id_key_e.="&id_e[$i]=".urlencode($id[$i]);
				}
			}
			print "<td align=center>";
			if ($access=='w')
			{
				print "<a href='".basename($PHP_SELF)."?t=$table&";
				print "$param_id_key$my_query_string$my_ss_query_string";
				print "'><img src=\"img/ed.gif\" width=26 height=18 border=0 alt=\"".$EditNr."\"></a>";
			}
			else
			{
				print "&nbsp;";
			}
			print "</td>";
			print "<td align=center>";
			if ($access=='w')
			{
				if ( (((isset($mk_time_substract) && $mk_time_substract) || (isset($locked_is) && !$locked_is)) && ((isset($right_is) && !$right_is) || ((isset($right_is) && $right_is) && $right_set=='w'))) || $PHP_SU)
				{
					print "<a href='".basename($PHP_SELF)."?t=$table&";
					print "$param_id_key&op=d$my_query_string$my_ss_query_string'><img src=\"img/dl.gif\" width=26 height=18 border=0 alt=\"".$DeleteNr."\"></a>";
				}
				else
				{
					print $ClosedNr;
				}
			}
			else
			{
				print "&nbsp;";
			}
			print "</td>";
			if ($ordered_table=='y')
			{
				if (($start+$tmp)!=0)
				{
					if ( (((isset($mk_time_substract) && $mk_time_substract) || (isset($locked_is) && !$locked_is)) && ((isset($right_is) && !$right_is) || ((isset($right_is) && $right_is) && $right_set=='w'))) || $PHP_SU)
					{
						if (!isset($my_ss_query_string)) $my_ss_query_string = "";
						print "<td><a href=\"nr.php?t=$table&op=or&$param_id_key&$param_id_key_u&$param_id_key_e$my_query_string$my_ss_query_string";
						print "\"><img src=\"img/up.gif\" width=26 height=18 border=0 alt=\"".$SortNr."\"></a></td>";
					}
					else
					{
						if ((!$right_is && ($locked_is && $mk_time_substract_am > 0)) || (($right_is && $right_set=='w') && ($locked_is && $mk_time_substract_am > 0)))
						print "<td>$mk_time_substract_am c</td>";
						else
						print "<td></td>";
					}
				}
				else
				print "<td>&nbsp;</td>";
			}
		}
		else
		{
			print "&nbsp;";
		}
		for ($i=0;$how_i>$i;$i++)
		{
			print "<td>";
			if ($row_ad[$i]!="")
			{
				if (strlen($row_ad[$i])>50)
				print htmlspecialchars(substr($row_ad[$i],0,50))." ...";
				else
				print htmlspecialchars($row_ad[$i]);
				if ($rows['eng_t'][$i+1]!="" && $rows['eng_f'][$i+1]!="" && $rows['eng_vf'][$i+1]!="")
				{
					$query = "SELECT `".$rows['eng_vf'][$i+1]."` FROM `".$rows['eng_t'][$i+1]."` WHERE ".$rows['eng_f'][$i+1]."='".$row_ad[$i]."'";
					$res_sub_table = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
					list($eng_vf_)=mysql_fetch_row($res_sub_table);
					if ($eng_vf_!='')
					if (strlen($eng_vf_)>50)
					print " (".htmlspecialchars(substr($eng_vf_,0,50))." ...)";
					else
					print " (".htmlspecialchars($eng_vf_).")";
				}
			}
			else
			print "&nbsp;";
			print "</td>";
		}

		print "</tr>";
		$tmp++;
	}
	print "</table>";
	//		Navig_adm($RowsNr,basename($PHP_SELF)."?t=$table".$param_id_key_.$my_query_string,'',$max_ord_num,$amount,$page_n,$i,2,5,2);
	Navig($RowsNr, $RowsNr2, $RowsNr3, basename($PHP_SELF)."?t=$table".$param_id_key_.$my_query_string."&page_n_ss={}", $max_ord_num, $amount, $page_n, 4, 15);
	print "<br>";
}
}
if ($strAddedText!='') print "<br><hr>".$strAddedText;
?></div>
<?
if ($op=='sv')
{
?>
<hr width=50%>
<?
//include("copy.inc.php");
}
if ($script!='')
{
	include ("$script");
}
?>
<?
//	if ($table_tree_structure)
//		print "Tree structure.";
?>
</body>
</html>

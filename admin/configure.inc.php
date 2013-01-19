<?
if (isset($Submit) && $Submit==$UpdateNr)
	$op='u';
if (isset($Submit) && $Submit==$DeleteNr)
	$op='d';
if (!isset($se)) $se="";

$table=$t;

authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host'] && $op!='sv')
{
	print($ErrorAccessRight);
	exit;
}

if (isset($t2))
	$t2_exist = "&t2=$t2";

$table_tree_structure=false;
$query="SELECT COUNT(*) FROM nrcf WHERE cftb='$table' AND cftb=cfen AND cfenc=''";
$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
if (list($table_tree_structure_count) = mysql_fetch_row($result))
{
	if ($table_tree_structure_count>0)
	{
		$table_tree_structure=true;
		$query="SELECT cffl, cfenf FROM nrcf WHERE cftb='$table' AND cftb=cfen";
		$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
		list($table_tree_structure_cffl, $table_tree_structure_cfenf) = mysql_fetch_row($result);
		if (!isset($se[$table_tree_structure_cffl])) $se[$table_tree_structure_cffl]=$TreeRoot;
	}
	else
	{
		$table_tree_structure=false;
	}
}

$query="SELECT cfme, cftb, cffl, cfenf FROM nrcf WHERE cfen='$table'";
$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
$i=0;
while(list($cfme, $cftb, $cffl, $cfenf) = mysql_fetch_row($result))
{
	# ��� ���������� �������������� ������ �� ����������� ������ �� �������� � �������.
	$foreign_multidel[$i]=$cfme;
	$foreign_table[$i]=$cftb;
	$foreign_field[$i]=$cffl;
	$foreign_accordingly[$i]=$cfenf;
	$i++;
}

$query="SELECT tbds, tbtx, tbnu, tbdl, tbro, tbss FROM nrtb WHERE tbnm='$table'";
$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
if(list($tbds, $tbtx, $tbnu, $tbdl, $tbro, $tbss) = mysql_fetch_row($result))
{
	$nav_am=$tbnu;
	$strTitle = $tbds;
	$strAddedText = $tbtx;
	$basket = $tbdl;
	$readonly = $tbro;
	$script = $tbss;
	$definitely_table=true;
}
else
{
	$nav_am=20;
	$query = "SHOW TABLE STATUS LIKE '$t'";
	$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
	if($row_show_table_status = mysql_fetch_array($result))
	{
		if ($row_show_table_status[Comment]!='')
			$strTitle = $row_show_table_status[Comment];
		else
			$strTitle = $t;
	}
	else
	{
		$strTitle = $t;
	}
	$strAddedText = '';
	$basket = 0;
	$readonly = 'n';
	$script = '';
	$definitely_table=false;
}

$result_fields = mysql_query( "SHOW FIELDS FROM `$table`") or mysql_die($ErrorSelectFieldsTable." <b>$table</b>", false);
for($i=0;$i<mysql_num_rows($result_fields);$i++)
{
	if(list($Field, $Type, $Null, $Key, $Default, $Extra) = mysql_fetch_row($result_fields))
	{
		$rows_fields[$i]=$Field;
		$rows_type[$i]=$Type;
	}
}

$query="SELECT cfid, cftb, cfsw, cfnm, cfsv, cfsr, cfen, cfenf, cfenc, cfdt, cfvf, cfct, cfaa, cfor, cfmd, cffn, cfds, cffe, cffo, cfmv FROM nrcf WHERE cftb='$table'";
$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
$i=0;
$loginning = 'n';
for($ii=0;$ii<mysql_num_rows($result_fields);$ii++)
{
	if(list($cfid, $cftb, $cfsw, $cfnm, $cfsv, $cfsr, $cfen, $cfenf, $cfenc, $cfdt, $cfvf, $cfct, $cfaa, $cfor, $cfmd, $cffn, $cfds, $cffe, $cffo, $cfmv) = mysql_fetch_row($result))
	{
		$rows_['show'][$cfid]=$cfsw;
		$rows_['name'][$cfid]=$cfnm;
		$rows_['help'][$cfid]=$cfds;
		$rows_['search_view'][$cfid]=$cfsv;
		$rows_['search'][$cfid]=$cfsr;
		$rows_['eng_t'][$cfid]=$cfen;
		$rows_['eng_f'][$cfid]=$cfenf;
		$rows_['eng_c'][$cfid]=$cfenc;
		$rows_['data'][$cfid]=$cfdt;
		$rows_['eng_vf'][$cfid]=$cfvf;
		$rows_['security'][$cfid]=$cfct;
		$rows_['add'][$cfid]=$cfaa;
		$rows_['order'][$cfid]=$cfor;
		$rows_['module'][$cfid]=$cfmd;
		$rows_['function'][$cfid]=$cffn;
		$rows_['infill'][$cfid]=$cffe;
		$rows_['notedit'][$cfid]=$cffo;
		$rows_['module_valid'][$cfid]=$cfmv;
	}
}
for($ii=0;$ii<mysql_num_rows($result_fields);$ii++)
{
	$cfid = $ii+1;
	if (isset($rows_['name'][$cfid]))
	{
		$rows['show'][$cfid]=$rows_['show'][$cfid];
		$rows['name'][$cfid]=$rows_['name'][$cfid];
		$rows['help'][$cfid]=$rows_['help'][$cfid];
		$rows['search_view'][$cfid]=$rows_['search_view'][$cfid];
		$rows['search'][$cfid]=$rows_['search'][$cfid];
		$rows['eng_t'][$cfid]=$rows_['eng_t'][$cfid];
		$rows['eng_f'][$cfid]=$rows_['eng_f'][$cfid];
		$rows['eng_c'][$cfid]=$rows_['eng_c'][$cfid];
		$rows['data'][$cfid]=$rows_['data'][$cfid];
		$rows['eng_vf'][$cfid]=$rows_['eng_vf'][$cfid];
		$rows['security'][$cfid]=$rows_['security'][$cfid];
		$rows['add'][$cfid]=$rows_['add'][$cfid];
		$rows['order'][$cfid]=$rows_['order'][$cfid];
		$rows['module'][$cfid]=$rows_['module'][$cfid];
		$rows['function'][$cfid]=$rows_['function'][$cfid];
		$rows['infill'][$cfid]=$rows_['infill'][$cfid];
		$rows['notedit'][$cfid]=$rows_['notedit'][$cfid];
		$rows['module_valid'][$cfid]=$rows_['module_valid'][$cfid];
	}
	else
	{
		if ($rows_fields[$ii]=='dl' && !$definitely_table)
		{
			$basket = 7;
		}
		if ($rows_fields[$ii]=='ur' || $rows_fields[$ii]=='lk') # Lock field where edit
		{
			$locked_is=true;
			$rows['show'][$cfid]='n';
			if ($rows_fields[$ii]=='lk')
			{
				$rows['name'][$cfid]=$T1Nr;
				$rows['help'][$cfid]=$T2Nr;
			}
			else
			{
				$rows['name'][$cfid]=$T3Nr;
				$rows['help'][$cfid]=$T4Nr;
			}
			$rows['search_view'][$cfid]='y';
			$rows['search'][$cfid]='y';
			$rows['eng_t'][$cfid]='';
			$rows['eng_f'][$cfid]='';
			$rows['eng_c'][$cfid]='';
			$rows['data'][$cfid]='';
			$rows['eng_vf'][$cfid]='';
			$rows['security'][$cfid]='n';
			$rows['add'][$cfid]='n';
			$rows['order'][$cfid]='n';
			$rows['module'][$cfid]='';
			$rows['function'][$cfid]='';
			$rows['infill'][$cfid]='n';
			$rows['notedit'][$cfid]='n';
			$rows['module_valid'][$cfid]='';
		}
		elseif ($rows_fields[$ii]=='rt' || $rows_fields[$ii]=='urr') # ����� ������� � ������
		{
			$right_set="w";
			$right_is=true;
			if ($rows_fields[$ii]=='rt')
				$rows['show'][$cfid]='y';
			else
			{
				if ($table=="nrad")
					$rows['show'][$cfid]='y';
				else
					$rows['show'][$cfid]='n';
			}
			if ($rows_fields[$ii]=='rt')
			{
				$rows['name'][$cfid]=$T5Nr;
				$rows['help'][$cfid]=$T6Nr;
			}
			else
			{
				$rows['name'][$cfid]=$T7Nr;
				$rows['help'][$cfid]=$T8Nr;
			}
			$rows['search_view'][$cfid]='y';
			$rows['search'][$cfid]='y';
			$rows['eng_t'][$cfid]='';
			$rows['eng_f'][$cfid]='';
			$rows['eng_c'][$cfid]='';
			if ($rows_fields[$ii]=='rt')
			{
				if ($table=="nrad")
					$rows['data'][$cfid]='r-r-';
				else
					$rows['data'][$cfid]='rwrw';
			}
			else
				$rows['data'][$cfid]='';
			$rows['eng_vf'][$cfid]='';
			$rows['security'][$cfid]='n';
			$rows['add'][$cfid]='n';
			$rows['order'][$cfid]='n';
			$rows['module'][$cfid]='';
			$rows['function'][$cfid]='';
			$rows['infill'][$cfid]='n';
			$rows['notedit'][$cfid]='n';
			$rows['module_valid'][$cfid]='';
		}
		elseif (($rows_fields[$ii]=='up' || $rows_fields[$ii]=='ad'))
		{
			$loginning = 'y';
			$rows['show'][$cfid]='n';
			if ($rows_fields[$ii]=='up')
			{
				$rows['name'][$cfid]=$T9Nr;
				$rows['help'][$cfid]=$T10Nr;
			}
			else
			{
				$rows['name'][$cfid]=$T11Nr;
				$rows['help'][$cfid]=$T12Nr;
			}
			$rows['search_view'][$cfid]='y';
			$rows['search'][$cfid]='y';
			$rows['eng_t'][$cfid]='';
			$rows['eng_f'][$cfid]='';
			$rows['eng_c'][$cfid]='';
			$rows['data'][$cfid]='';
			$rows['eng_vf'][$cfid]='';
			$rows['security'][$cfid]='n';
			$rows['add'][$cfid]='n';
			$rows['order'][$cfid]='n';
			$rows['module'][$cfid]='';
			$rows['function'][$cfid]='';
			$rows['infill'][$cfid]='n';
			$rows['notedit'][$cfid]='n';
			$rows['module_valid'][$cfid]='';
		}
		else
		{
			$rows['show'][$cfid]='y';
			if ($rows_fields[$ii]=='dl' && $definitely_table)
			{
				$rows['name'][$cfid]=$T13Nr;
				$rows['help'][$cfid]=$T14Nr;
			}
			else
			{
				$rows['name'][$cfid]=$rows_fields[$ii];
				$rows['help'][$cfid]="";
			}
			$rows['search_view'][$cfid]='y';
			$rows['search'][$cfid]='y';
			$rows['eng_t'][$cfid]='';
			$rows['eng_f'][$cfid]='';
			$rows['eng_c'][$cfid]='';
			$rows['data'][$cfid]='';
			$rows['eng_vf'][$cfid]='';
			$rows['security'][$cfid]='';
			$rows['add'][$cfid]='n';
			$rows['order'][$cfid]='n';
			$rows['module'][$cfid]='';
			$rows['function'][$cfid]='';
			$rows['infill'][$cfid]='n';
			$rows['notedit'][$cfid]='n';
			$rows['module_valid'][$cfid]='';
		}
	}
}

if ($basket!=0)
{
	if (isset($bst) && $bst=='y')
		$query="DELETE FROM `$table` WHERE dl='y'";
	else
		$query="DELETE FROM `$table` WHERE (UNIX_TIMESTAMP('".date("Y-m-d H:i:s")."')-UNIX_TIMESTAMP(up))>(".($basket*60*60*24).") AND dl='y'";
	$result = @mysql_query($query);

// from db to file convert
/*
		$query = "SELECT flid, flim FROM `$table`";
		$result = @mysql_query($query);
		
		while (list($flid, $flim) = mysql_fetch_row($result))
		{
			$fs_dir = $_SERVER['DOCUMENT_ROOT'].$path_to_media;
			fwrite(fopen($fs_dir.$flid, "w"), base64_decode($flim));
		}
//*/		
// end

	if ($table == 'nrfl' && mysql_affected_rows() > 0)
	{
		$query = "SELECT flid FROM `$table`";
		$result = @mysql_query($query);
		$flids = array();
		
		while (list($flid) = mysql_fetch_row($result))
		{
			$flids[] = $flid;
		}		
		
		$fs_dir = $_SERVER['DOCUMENT_ROOT'].$path_to_media;
//		var_dump($fs_dir);
		if (is_dir($fs_dir)) {
		    if ($dh = opendir($fs_dir)) {
		        while (($file = readdir($dh)) !== false) {
		        	$ext = strtolower(substr($file, strrpos($file, ".")+1));
		        	if ($file != '.' 
		        		&& $file != '..'
		        		&& $file != '.svn'
		        		&& $file != '.htaccess')
		        	{	
						if (!in_array($file,$flids))
						{
//							var_dump($file);
							unlink($fs_dir.$file);
						}
		        	}
		        }
		        closedir($dh);
		    }
		}
		else 
		{
			mkdir($fs_dir);
		}
	}
}

$ordered=false;
for($j=0;$j<$ii;$j++)
{
	if (isset($rows['order'][$j]) && $rows['order'][$j]=='y')
	{
		$ordered=true;
		break;
	}
}
$add_order=false;
for($j=0;$j<$ii;$j++)
{
	if (isset($rows['add'][$j]) && $rows['add'][$j]=='y')
	{
		$add_order=true;
		break;
	}
}

$access='n';
$query = "SELECT atac FROM nrat LEFT JOIN nrur ON urrl=atrl WHERE (urad='$PHP_AUTH_USER' OR atrl='$PHP_AUTH_ROLE') AND attb='$table'";
$result = mysql_query($query) or mysql_die($MySQLError.mysql_error(), false);
while (list($access_tmp) = mysql_fetch_row($result))
{
	if ($access_tmp=='r')
	{
		$access='r';
	}
	if ($access_tmp=='w')
	{
		$access='w';
		break;
	}
}
if ($readonly=='y' && $access!='n') $access='r';
if ($PHP_SU) $access='w';

if (!isset($amount)) $amount=$nav_am;
if (isset($page_n_ss) && $page_n_ss!='')
	$page_n=$page_n_ss;
else
	if (isset($page_n_s) && $op!='' && $op!='a' && $op!='u' && $op!='d')
	{
		$page_n=$page_n_s;
	}
if (!isset($page_n)) $page_n=1;
$start=($page_n-1)*$amount;

$j=0;
$table_def = mysql_query( "SHOW FIELDS FROM `$table`") or mysql_die($ErrorSelectFieldsTable." <b>$table</b>", false);
for($i=0;$i<mysql_num_rows($table_def);$i++)	# ����. ���� �������
{
	$row_table_def = mysql_fetch_array($table_def);
	$inp_text_nm_all[$i]=$row_table_def[0];
	if ($row_table_def[3]=="PRI")
	{
		$pri_keys[$j]=$row_table_def[0];
		$j++;
		if ($row_table_def[5]!='auto_increment')
			$p_k[$i]='manual';
		else
			$p_k[$i]='auto';
		$inp_text_k[$i]="y";
		$inp_text_nm[$i]=$row_table_def[0];
	}
	if ((mysql_num_rows($table_def)-1)==$i && (!isset($inp_text_nm_all[$i]) || !isset($se[$inp_text_nm_all[$i]])) && $basket!=0)
	{
		$se[$inp_text_nm_all[$i]]="n";
	}
	if ((isset($rows['search_view'][($i+1)]) && $rows['search_view'][($i+1)]=='y') || (isset($inp_text_k[$i]) && $inp_text_k[$i]=='y'))
	{
		$inp_text[$i]=$row_table_def[0];
	}
}
$num_rows_all=mysql_num_rows($table_def);

for($i=0;$i<mysql_num_rows($table_def);$i++)
{
	if (isset($se[$inp_text_nm_all[$i]]) && $se[$inp_text_nm_all[$i]]!='')
	{
		if (!isset($my_query_string)) $my_query_string="";
		$my_query_string.="&se[".$inp_text_nm_all[$i]."]=".$se[$inp_text_nm_all[$i]];
	}
}
if (isset($sort) && $sort!='')
	$my_query_string.="&sort=$sort";
if (isset($dir) && $dir!='')
	$my_query_string.="&dir=$dir";
if (isset($page_n_s) && $page_n_s!='')
	$my_query_string.="&page_n_s=$page_n_s";
if (isset($ce) && $ce!='')
{
	$my_add_query_string.="&ce=$ce";
	$se[1]=$ce;
}
if (isset($t2) && $t2!='')
	$my_add_query_string.="$t2_exist";
if (isset($t1) && $t1!='')
	$my_add_query_string.="&t1=$t1";
if (isset($type) && $type!='')
	$my_add_query_string.="&type=$type";

if (isset($page_n_ss) && $page_n_ss!='')
	$my_ss_query_string="&page_n_ss=$page_n_ss";

if (!isset($my_add_query_string))
	$my_add_query_string="";
if (!isset($my_query_string))
	$my_query_string="";

$my_query_string.=$my_add_query_string;
?>

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
 * Admin utility sql table editor module
 */

require ("../conf.inc.php");

$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
mysql_select_db($base);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);
authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host'] && $op!='sv')
{
	print($ErrorAccessRight);
	exit;
}

$ColumnTypes = array(
   'VARCHAR',
   'TINYINT',
   'TEXT',
   'DATE',
   'SMALLINT',
   'MEDIUMINT',
   'INT',
   'BIGINT',
   'FLOAT',
   'DOUBLE',
   'DECIMAL',
   'DATETIME',
   'TIMESTAMP',
   'TIME',
   'YEAR',
   'CHAR',
   'TINYBLOB',
   'TINYTEXT',
   'BLOB',
   'MEDIUMBLOB',
   'MEDIUMTEXT',
   'LONGBLOB',
   'LONGTEXT',
   'ENUM',
   'SET'
);

$AttributeTypes = array(
   '',
   'BINARY',
   'UNSIGNED',
   'UNSIGNED ZEROFILL'
);

if (!isset($nametb)) $nametb = $t;

if ($adsu=='y')
{
	if ($op=='t_df2')
	{
		if ($sub==$YesTabEd)
		{
			$query = "ALTER TABLE `$t` DROP `$f`";
			mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);

			// write data in config table
			$query_conf = "SELECT cfid, cffl, cftb, cfsw, cfnm, cfds, cfsv, cfsr, cfel, cfme, cfen, cfenf, cfenc, cfpd, cfdt, cfvf, cfct, cfaa, cfor, cffe, cffo, cfmd, cfmv, cffn, cfht FROM nrcf WHERE cftb='$t' ORDER BY cfid";
			$result = mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);
			$i=1;
			if (list($cfid, $cffl, $cftb, $cfsw, $cfnm, $cfds, $cfsv, $cfsr, $cfel, $cfme, $cfen, $cfenf, $cfenc, $cfpd, $cfdt, $cfvf, $cfct, $cfaa, $cfor, $cffe, $cffo, $cfmd, $cfmv, $cffn, $cfht) = mysql_fetch_row($result))
			{
				if ($cffl!=$f)
				{
					mysql_query( "DELETE FROM nrcf WHERE cftb='$t'") or mysql_die($MySQLError.mysql_error(), false);
					$query_conf = "INSERT INTO nrcf VALUES ('$i', '$cffl', '$cftb', '$cfsw', '$cfnm', '$cfds', '$cfsv', '$cfsr', '$cfel', '$cfme', '$cfen', '$cfenf', '$cfenc', '$cfpd', '$cfdt', '$cfvf', '$cfct', '$cfaa', '$cfor', '$cffe', '$cffo', '$cfht', '$cfmd', '$cfmv', '$cffn')";
					mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);
					$i++;
				}
			}
			while(list($cfid, $cffl, $cftb, $cfsw, $cfnm, $cfds, $cfsv, $cfsr, $cfel, $cfme, $cfen, $cfenf, $cfenc, $cfpd, $cfdt, $cfvf, $cfct, $cfaa, $cfor, $cffe, $cffo, $cfmd, $cfmv, $cffn, $cfht) = mysql_fetch_row($result))
			{
				if ($cffl!=$f)
				{
					$query_conf = "INSERT INTO nrcf VALUES ('$i', '$cffl', '$cftb', '$cfsw', '$cfnm', '$cfds', '$cfsv', '$cfsr', '$cfel', '$cfme', '$cfen', '$cfenf', '$cfenc', '$cfpd', '$cfdt', '$cfvf', '$cfct', '$cfaa', '$cfor', '$cffe', '$cffo', '$cfht', '$cfmd', '$cfmv', '$cffn')";
					mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);
					$i++;
				}
			}

			Header("Location: table_editor.php?t=$t&op=t_e&message=$OperationSuccessfulTabEd");
			exit;
		}
		else
		{
			Header("Location: table_editor.php?t=$t&op=t_e");
			exit;
		}
	}
	elseif ($op=='t_add_field2')
	{
		// write data in config table
		$query = "SELECT cfid, cffl, cftb, cfsw, cfnm, cfds, cfsv, cfsr, cfel, cfme, cfen, cfenf, cfenc, cfpd, cfdt, cfvf, cfct, cfaa, cfor, cffe, cffo, cfmd, cfmv, cffn, cfht FROM nrcf WHERE cftb='$nametb' ORDER BY cfid";
		$result = mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
		$i=1;
		while (list($cfid, $cffl, $cftb, $cfsw, $cfnm, $cfds, $cfsv, $cfsr, $cfel, $cfme, $cfen, $cfenf, $cfenc, $cfpd, $cfdt, $cfvf, $cfct, $cfaa, $cfor, $cffe, $cffo, $cfmd, $cfmv, $cffn, $cfht) = mysql_fetch_row($result))
		{
			$cfid_[$i]=$cfid;
			$cffl_[$i]=$cffl;
			$cftb_[$i]=$cftb;
			$cfsw_[$i]=$cfsw;
			$cfnm_[$i]=$cfnm;
			$cfds_[$i]=$cfds;
			$cfsv_[$i]=$cfsv;
			$cfsr_[$i]=$cfsr;
			$cfel_[$i]=$cfel;
			$cfme_[$i]=$cfme;
			$cfen_[$i]=$cfen;
			$cfenf_[$i]=$cfenf;
			$cfenc_[$i]=$cfenc;
			$cfpd_[$i]=$cfpd;
			$cfdt_[$i]=$cfdt;
			$cfvf_[$i]=$cfvf;
			$cfct_[$i]=$cfct;
			$cfaa_[$i]=$cfaa;
			$cfor_[$i]=$cfor;
			$cffe_[$i]=$cffe;
			$cffo_[$i]=$cffo;
			$cfmd_[$i]=$cfmd;
			$cfmv_[$i]=$cfmv;
			$cffn_[$i]=$cffn;
			$cfht_[$i]=$cfht;
			$i++;
		}

		$j=1;
		if ($after != "_start_")
		{
			for ($j=1;$j<=COUNT($cffl_);$j++)
			{
				$query_conf[$j] = "INSERT INTO nrcf VALUES ('$j', '$cffl_[$j]', '$cftb_[$j]', '$cfsw_[$j]', '$cfnm_[$j]', '$cfds_[$j]', '$cfsv_[$j]', '$cfsr_[$j]', '$cfel_[$j]', '$cfme_[$j]', '$cfen_[$j]', '$cfenf_[$j]', '$cfenc_[$j]', '$cfpd_[$j]', '$cfdt_[$j]', '$cfvf_[$j]', '$cfct_[$j]', '$cfaa_[$j]', '$cfor_[$j]', '$cffe_[$j]', '$cffo_[$j]', '$cfht_[$j]', '$cfmd_[$j]', '$cfmv_[$j]', '$cffn_[$j]')";
				if ($after==$cffl_[$j])
				{
					$j++;
					break;
				}
			}
		}


		// alter
		$query = "ALTER TABLE `$nametb` ADD ";
		for ($i=0;$i<COUNT($field);$i++)
		{
			if ($i==0)
			{
				$len[$i] = trim(stripslashes($len[$i]));
				$query .= "`$field[$i]` $type[$i]";
				if ($len[$i]!="")
					$query .= "($len[$i])";
				elseif ($len[$i]=="" && ($type[$i]=='VARCHAR' || $type[$i]=='CHAR'))
					$query .= "(1)";
				$query .= " $attr[$i]";
				if ($default[$i]!="")
				{
					$query .= " DEFAULT '$default[$i]'";
				}
				$query .= " $nul[$i] $ext[$i]";
				if ($after=="_start_")
				{
					$query .= " FIRST";
					$after = $field[$i];
				}
				elseif ($after!="_end_")
				{
					$query .= " AFTER `$after`";
					$after = $field[$i];
				}
			}
			else
			{
				$len[$i] = trim(stripslashes($len[$i]));
				$query .= ", ADD `$field[$i]` $type[$i]";
				if ($len[$i]!="") $query .= "($len[$i])";
				$query .= " $attr[$i]";
				if ($default[$i]!="")
				{
					$query .= " DEFAULT '$default[$i]'";
				}
				$query .= " $nul[$i] $ext[$i]";
				if ($after=="_start_")
				{
					$query .= " FIRST";
					$after = $field[$i];
				}
				elseif ($after!="_end_")
				{
					$query .= " AFTER `$after`";
					$after = $field[$i];
				}
			}
			$query_conf[($j+$i)] = "INSERT INTO nrcf (cfid, cffl, cftb, cfsw, cfnm, cfds, cfsv, cfsr, cfel, cfme, cfen, cfenf, cfpd, cfdt, cfvf, cfct, cfaa, cfor, cffe, cffo, cfmd, cfmv, cffn, cfht) VALUES ('".($i+$j)."', '$field[$i]', '$nametb', 'y', '$des[$i]', '', 'y', 'y', 'y', 'n', '', '', 'n', '$default[$i]', '', 'n', 'n', 'n', 'n', 'n', '', '', '', 'n')";
		}

		$ind = $j+$i;
		if ($after!="_end_")
		{
			for ($i=$j;$i<=COUNT($cffl_);$i++)
			{
				$query_conf[$ind] = "INSERT INTO nrcf VALUES ('".$ind."', '".$cffl_[$i]."', '".$cftb_[$i]."', '".$cfsw_[$i]."', '".$cfnm_[$i]."', '".$cfds_[$i]."', '".$cfsv_[$i]."', '".$cfsr_[$i]."', '".$cfel_[$i]."', '".$cfme_[$i]."', '".$cfen_[$i]."', '".$cfenf_[$i]."', '".$cfenc_[$i]."', '".$cfpd_[$i]."', '".$cfdt_[$i]."', '".$cfvf_[$i]."', '".$cfct_[$i]."', '".$cfaa_[$i]."', '".$cfor_[$i]."', '".$cffe_[$i]."', '".$cffo_[$i]."', '".$cfht_[$i]."', '".$cfmd_[$i]."', '".$cfmv_[$i]."', '".$cffn_[$i]."')";
				$ind++;
			}
		}

		mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);

		// write data in config table
		mysql_query( "DELETE FROM nrcf WHERE cftb='$nametb'") or mysql_die($MySQLError.mysql_error(), false);
		for ($i=1;$i<=COUNT($query_conf);$i++)
		{
			mysql_query( $query_conf[$i]) or mysql_die($MySQLError.mysql_error(), false);
		}

		Header("Location: table_editor.php?t=$nametb&op=t_e&message=$OperationSuccessfulTabEd");
		exit;
	}
	elseif ($op=="t_recomment")
	{
		$query = "ALTER TABLE `$t` COMMENT = '$comment'";
		mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
		Header("Location: table_editor.php?t=$t&op=t_e&message=$OperationSuccessfulTabEd");
		exit;
	}
	elseif ($op=='t_rename')
	{
		$query = "RENAME TABLE `$t` to `$t_new`";
		mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);

		// write data in config table
		mysql_query( "UPDATE nrat SET attb='$t_new' WHERE attb='$t'") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "UPDATE nrnv SET nvtb='$t_new' WHERE nvtb='$t'") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "UPDATE nrcf SET cftb='$t_new' WHERE cftb='$t'") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "UPDATE nrtb SET tbnm='$t_new' WHERE tbnm='$t'") or mysql_die($MySQLError.mysql_error(), false);
//		mysql_query( "UPDATE nrcf SET cfen='$t_new' WHERE cfen='$t'") or mysql_die($MySQLError.mysql_error(), false);

		Header("Location: table_editor.php?t=$t_new&op=t_e&message=$OperationSuccessfulTabEd");
		exit;
	}
	elseif ($op=='t_copy')
	{
		$result = mysql_query( "SHOW CREATE TABLE `$t`") or mysql_die($ErrorSelectStatusFieldsTable." <b>$t</b>", false);
		list($table, $create_tb) = mysql_fetch_row($result);
		$query = ereg_replace("CREATE TABLE `$t`","CREATE TABLE `$t_new`",$create_tb);
		mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);

		if ($all=="yes")
		{
			$query = "INSERT INTO `$t_new` SELECT * FROM `$t`";
			mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
		}

		// write data in config table
		mysql_query( "DROP TABLE IF EXISTS `TMP`") or mysql_die($MySQLError.mysql_error(), false);

		mysql_query( "CREATE TABLE `TMP` SELECT * FROM nrat") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "INSERT INTO nrat SELECT atrl, '$t_new', atac, ad, up FROM `TMP` WHERE attb='$t'") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "DROP TABLE `TMP`") or mysql_die($MySQLError.mysql_error(), false);

		mysql_query( "CREATE TABLE `TMP` SELECT * FROM nrnv") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "INSERT INTO nrnv (nvrl, nvnm, nvvr, nvtb, nvad) SELECT nvrl, nvnm, nvvr, '$t_new', nvad FROM `TMP` WHERE nvtb='$t'") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "DROP TABLE `TMP`") or mysql_die($MySQLError.mysql_error(), false);

		mysql_query( "CREATE TABLE `TMP` SELECT * FROM nrcf") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "INSERT INTO nrcf SELECT cfid, cffl, '$t_new', cfsw, cfnm, cfds, cfsv, cfsr, cfel, cfme, cfen, cfenf, cfenc, cfpd, cfdt, cfvf, cfct, cfaa, cfor, cffe, cffo, cfmd, cfmv, cffn FROM `TMP` WHERE cftb='$t'") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "DROP TABLE `TMP`") or mysql_die($MySQLError.mysql_error(), false);

		mysql_query( "CREATE TABLE `TMP` SELECT * FROM nrtb") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "INSERT INTO nrtb SELECT '$t_new', tbds, tbtx, tbnu, tbdl, tbro, tbss FROM `TMP` WHERE tbnm='$t'") or mysql_die($MySQLError.mysql_error(), false);
		mysql_query( "DROP TABLE `TMP`") or mysql_die($MySQLError.mysql_error(), false);

		Header("Location: table_editor.php?t=$t_new&op=t_e&message=$OperationSuccessfulTabEd");
		exit;
	}
	elseif ($op=='t_create2')
	{
		$query = "CREATE TABLE `$nametb` (";
		for ($i=0;$i<COUNT($field);$i++)
		{
			if ($i==0)
			{
				$len[$i] = trim(stripslashes($len[$i]));
				$query .= "`$field[$i]` $type[$i]";
				if ($len[$i]!="") $query .= "($len[$i])";
				$query .= " $attr[$i]";
				if ($default[$i]!="")
				{
					$query .= " DEFAULT '$default[$i]'";
				}
				$query .= " $nul[$i] $ext[$i]";
			}
			else
			{
				$len[$i] = trim(stripslashes($len[$i]));
				$query .= ", `$field[$i]` $type[$i]";
				if ($len[$i]!="") $query .= "($len[$i])";
				$query .= " $attr[$i]";
				if ($default[$i]!="")
				{
					$query .= " DEFAULT '$default[$i]'";
				}
				$query .= " $nul[$i] $ext[$i]";
			}

			// write data in config table
//			$query_conf="INSERT INTO nrcf (cfid, cffl, cftb, cfsw, cfnm, cfds, cfsv, cfsr, cfel, cfme, cfen, cfenf, cfpd, cfdt, cfvf, cfct, cfaa, cfor, cffe, cffo, cfmd, cfmv, cffn) VALUES ('".($i+1)."', '$field[$i]', '$nametb', 'y', '$des[$i]', '', 'y', 'y', 'y', 'n', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '')";
//			mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);
		}
		$sta = true;
		for ($i=0;$i<COUNT($field);$i++)
		{
			if ($pk[$i]=="on")
			{
				if ($sta)
				{
					$query .= ", PRIMARY KEY (`$field[$i]`";
					$sta = false;
				}
				else
				{
					$query .= ",`$field[$i]`";
				}
			}
			if ($i==(COUNT($field)-1))
			{
				$query .= ")";
			}
		}
		if ($type_tb!='Default')
			$query .= ") TYPE = $type_tb COMMENT = '$comment'";
		else
			$query .= ") COMMENT = '$comment'";
		mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);

		for ($i=0;$i<COUNT($field);$i++)
		{
			// write data in config table
			$query_conf="INSERT INTO nrcf (cfid, cffl, cftb, cfsw, cfnm, cfds, cfsv, cfsr, cfel, cfme, cfen, cfenf, cfpd, cfdt, cfvf, cfct, cfaa, cfor, cffe, cffo, cfmd, cfmv, cffn, cfht) VALUES ('".($i+1)."', '$field[$i]', '$nametb', 'y', '$des[$i]', '', 'y', 'y', 'y', 'n', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '', 'n')";
			mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);
		}

		// write data in config table
		$query_conf="INSERT INTO nrtb (tbnm, tbds, tbtx, tbnu, tbdl, tbro, tbss) VALUES ('$nametb', '$comment', '', '20', '0', 'n', '')";
		mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);
		$query_conf="INSERT INTO nrat VALUES ('Operator', '$nametb', 'w', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
		mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);
		$query_conf="INSERT INTO nrnv (nvnm, nvvr, nvtb) VALUES ('$comment', 't', '$nametb')";
		mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);

		Header("Location: table_editor.php?t=$nametb&op=t_e&message=$OperationSuccessfulTabEd");
		exit;
	}
	elseif ($op=='t_retype')
	{
		$query = "ALTER TABLE `$t` TYPE = $type_tb";
		mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
		Header("Location: table_editor.php?t=$t&op=t_e&message=$OperationSuccessfulTabEd");
		exit;
	}
	elseif ($op=='t_d2')
	{
		if ($sub==$YesTabEd)
		{
			mysql_query( "DROP TABLE `$nametb`") or mysql_die($MySQLError.mysql_error(), false);

			// write data in config table
			mysql_query( "DELETE FROM nrat WHERE attb='$nametb'") or mysql_die($MySQLError.mysql_error(), false);
			mysql_query( "DELETE FROM nrnv WHERE nvtb='$nametb'") or mysql_die($MySQLError.mysql_error(), false);
			mysql_query( "DELETE FROM nrcf WHERE cftb='$nametb'") or mysql_die($MySQLError.mysql_error(), false);
			mysql_query( "DELETE FROM nrtb WHERE tbnm='$nametb'") or mysql_die($MySQLError.mysql_error(), false);

			Header("Location: table_editor.php?message=$OperationSuccessfulTabEd");
			exit;
		}
		else
		{
			Header("Location: table_editor.php");
			exit;
		}
	}
	elseif ($op=='t_ef2')
	{
		$query = "ALTER TABLE `$nametb` CHANGE `$f_prev` `$field`";
		$query .= " $type";
		$len = trim(stripslashes($len));
		if ($len!="") $query .= "($len)";
		$query .= " $attr";
		if ($default!="")
		{
			$query .= " DEFAULT '$default'";
		}
		$query .= " $nul $ext";
		mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);

		$query_conf = "UPDATE nrcf SET cfnm='$des', cffl='$field' WHERE cftb='$nametb' AND cffl='$f_prev'";
		$result = mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);

		Header("Location: table_editor.php?t=$nametb&op=t_e&message=$OperationSuccessfulTabEd");
		exit;
	}
	elseif ($op=='t_index')
	{
		if ($sub == "[Primary]")
		{
			$first=true;
			$query = "ALTER TABLE `$t` DROP PRIMARY KEY, ADD PRIMARY KEY (";
			for ($i=0;$i<$cnt;$i++)
			{
				if ($f[$i]!='')
				{
					if ($first)
					{
						$query .= "`$f[$i]`";
						$first=false;
					}
					else
					{
						$query .= ", `$f[$i]`";
					}
				}
			}
			$query .= ")";
			mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
			Header("Location: table_editor.php?t=$t&op=t_e&message=$OperationSuccessfulTabEd");
			exit;
		}
		elseif ($sub == "[Index]")
		{
			$first=true;
			$query = "ALTER TABLE `$t` ADD INDEX (";
			for ($i=0;$i<$cnt;$i++)
			{
				if ($f[$i]!='')
				{
					if ($first)
					{
						$query .= "`$f[$i]`";
						$first=false;
					}
					else
					{
						$query .= ", `$f[$i]`";
					}
				}
			}
			$query .= ")";
			mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
			Header("Location: table_editor.php?t=$t&op=t_e&message=$OperationSuccessfulTabEd");
			exit;
		}
		elseif ($sub == "[Unique]")
		{
			$first=true;
			$query = "ALTER TABLE `$t` ADD UNIQUE (";
			for ($i=0;$i<$cnt;$i++)
			{
				if ($f[$i]!='')
				{
					if ($first)
					{
						$query .= "`$f[$i]`";
						$first=false;
					}
					else
					{
						$query .= ", `$f[$i]`";
					}
				}
			}
			$query .= ")";
			mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
			Header("Location: table_editor.php?t=$t&op=t_e&message=$OperationSuccessfulTabEd");
			exit;
		}
		elseif ($sub == "[Full Text]")
		{
			$first=true;
			$query = "ALTER TABLE `$t` ADD FULLTEXT (";
			for ($i=0;$i<$cnt;$i++)
			{
				if ($f[$i]!='')
				{
					if ($first)
					{
						$query .= "`$f[$i]`";
						$first=false;
					}
					else
					{
						$query .= ", `$f[$i]`";
					}
				}
			}
			$query .= ")";
			mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
			Header("Location: table_editor.php?t=$t&op=t_e&message=$OperationSuccessfulTabEd");
			exit;
		}
	}
	elseif ($op=="t_di")
	{
		$first=true;
		$query = "ALTER TABLE `$t` DROP INDEX ";
		$query .= "`$f`";
		mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
		Header("Location: table_editor.php?t=$t&op=t_e&message=$OperationSuccessfulTabEd");
		exit;
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?print $SystemDataAdministrationConf?> :: <?print $TitleTabEd?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
</head>
<?print $body?>
<script language="JavaScript">
<!--
	if (self.parent.frames.length == 0)
		self.parent.location='index.php';
//-->
</script><br>
<?

$query="SELECT adsu FROM nrad WHERE adid='$PHP_AUTH_USER'";
$result = mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
list($adsu) = mysql_fetch_row($result);

if ($adsu=='y')
{
?>
<div align=center>
<b><?print $TitleCrEdTabEd?></b><br>
	<?if (isset($message) && $message!='') print "<br>".$message."<br>";?>
<!-- </div>
<a href="table_editor.php">[Oaaeeou]</a>
<div align=center> -->
<?
	if ($op=='t_create')
	{
		print "<br><b>$TTTabEd $nametb.</b><br>";
		print "<form method=post action=\"table_editor.php\">";
		print "<table border=0>";
		print "<tr bgcolor=$bg2>";
		print '<td align=center><b>'.$FieldTabEd.'</b></td>';
		print '<td align=center><b>'.$TypeTabEd.'</b></td>';
		print '<td align=center><b>'.$LenghtTabEd.'</b></td>';
		print '<td align=center><b>'.$AtrTabEd.'</b></td>';
		print '<td align=center><b>'.$NullTabEd.'</b></td>';
		print '<td align=center><b>'.$DefTabEd.'</b></td>';
		print '<td align=center><b>'.$ExtraTabEd.'</b></td>';
		print '<td align=center><b>'.$NameTabEd.'</b></td>';
		print '<td align=center><b>'.$PKTabEd.'</b></td>';
		print '</tr>';

		for ($i=0;$i<$fieldnumtb;$i++)
		{

			if (($i%2)==0)
				print "<tr bgcolor=$bg3>";
			else
				print "<tr bgcolor=$bg4>";
			print "<td>";
			print "<input type=text name=field[$i] size=10 maxlength=16>";
			print "</td>";
			print "<td>";
			print "<select name=\"type[$i]\">";
			for ($j=0;$j<count($ColumnTypes);$j++)
			{
				print "<option value=\"$ColumnTypes[$j]\"";
				if ($j==0)
					print " selected";
				print ">$ColumnTypes[$j]</option>";
			}
			print "</select>";
			print "</td>";
			print "<td>";
			print "<input type=text name=len[$i] size=8>";
			print "</td>";
			print "<td>";
			print "<select name=attr[$i]>";
			for ($j=0;$j<count($AttributeTypes);$j++)
			{
				print "<option value=\"$AttributeTypes[$j]\"";
				if ($j==0)
					print " selected";
				print ">$AttributeTypes[$j]</option>";
			}
			print "</select>";
			print "</td>";
			print "<td>";
			print "<select name=nul[$i]><option value=\"NOT NULL\" selected>not null</option><option value=\"\">null</option></select>";
			print "</td>";
			print "<td>";
			print "<input type=text name=default[$i] size=8>";
			print "</td>";
			print "<td>";
			print "<select name=ext[$i]><option value=\"\"></option><option value=\"AUTO_INCREMENT\">auto_increment</option></select>";
			print "</td>";
			print "<td>";
			print "<input type=text name=des[$i] size=10>";
			print "</td>";
			print "<td>";
			print "<input type=checkbox name=pk[$i] size=10>";
			print "</td>";
			print "</tr>";
		}
		print "<tr bgcolor=$bg3>";
		print "<td colspan=9>";
		print $Text1TabEd." <input type=text name=comment maxlength=255>&nbsp;&nbsp;&nbsp;";
		print $Text2TabEd." <select name=type_tb>
			<option value=\"Default\">$DefTabEd</option>
			<option value=\"MYISAM\">MyISAM</option>
			<option value=\"HEAP\">Heap</option>
			<option value=\"MERGE\">Merge</option>
			<option value=\"ISAM\">ISAM</option>
			<option value=\"BDB\">Berkeley DB</option>
			<option value=\"GEMINI\">Gemini</option>
			<option value=\"INNODB\">INNO DB</option>
		</select>";
		print "</td>";
		print "</tr>";
		?>
		</table>
		<input type=hidden name=op value="t_create2">
		<input type=hidden name=nametb value="<?print $nametb?>">
		<input type=submit name=sub value="<?print $CreateTabEd?>" class=button>
	<?
	}
	elseif ($op=='t_e')
	{
		$query="SELECT tbds, tbnm FROM nrtb WHERE tbnm='$table'";
		$result = mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
		list($table_nm, $table) = mysql_fetch_row($result);
		print "<br><b>$table_nm ($table)</b><br>";
		print '<table border=0>';
		print "<tr bgcolor=$bg2>";
		print '<td>&nbsp;</td>';
		print '<td><b>Field</b></td>';
		print '<td><b>Type</b></td>';
		print '<td><b>Null</b></td>';
		print '<td><b>Key</b></td>';
		print '<td><b>Default</b></td>';
		print '<td><b>Extra</b></td>';
		print '<td colspan=3><div align=center><b>'.$OperationTabEd.'</b></div></td>';
		print '</tr>';
		print "<form method=post action=\"table_editor.php\">";
		$i=0;
		$result = mysql_query( "SHOW FIELDS FROM $t") or mysql_die($ErrorSelectFieldsTable." <b>$t</b>", false);
		while(list($Field, $Type, $Null, $Key, $Default, $Extra) = mysql_fetch_row($result))	# n?eo. eiai eieiiie
		{
			if (($i%2)==0)
				print "<tr bgcolor=$bg3>";
			else
				print "<tr bgcolor=$bg4>";
			$query="SELECT cfnm FROM nrcf WHERE cftb='$t' AND cffl='$Field'";
			$result2 = mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
			list($cfnm) = mysql_fetch_row($result2);
			print "<td><input type=checkbox name=f[$i] value='".$Field."'></td>";
			print "<td title=\"$cfnm\">".$Field."</td>";
			print '<td>'.$Type.'</td>';
			print '<td>'.$Null.'</td>';
			print '<td>'.$Key.'</td>';
			print '<td>'.$Default.'</td>';
			print '<td>'.$Extra.'</td>';
			print "<td><a href=\"table_editor.php?t=$table&f=$Field&op=t_ef\"><img src=\"../img/ed.gif\" width=26 height=18 border=0 alt=\"".$EditTabEd."\"></a></td><td><a href=\"table_editor.php?t=$table&f=$Field&op=t_df\"><img src=\"../img/dl.gif\" width=26 height=18 border=0 alt=\"".$DeleteTabEd."\"></a></td><td><a href=\"../nr.php?t=nrcf&id[0]=".($i+1)."&id[1]=$Field&id[2]=$t\"><img src=\"../img/ed_fld.gif\" width=26 height=18 border=0 alt=\"".$EditFieldTabEd."\"></a></td>";
			print '</tr>';
			$i++;
		}?>
		</table>
		<input type=hidden name=t value="<?print $t?>">
		<input type=hidden name=op value="t_index">
		<input type=hidden name=cnt value="<?print $i?>">
		<input type=submit name=sub value="[Primary]" class=button>
		<input type=submit name=sub value="[Index]" class=button>
		<input type=submit name=sub value="[Unique]" class=button>
		<input type=submit name=sub value="[Full Text]" class=button>
		</form>
		<?
		print '<br><b>'.$IndexsTabEd.'</b><br>';
		print '<table border=0>';
		print "<tr bgcolor=$bg2>";
		print '<td><b>'.$KeyNameTabEd.'</b></td>';
		print '<td><b>'.$TypeTabEd.'</b></td>';
		print '<td><b>'.$NumElTabEd.'</b></td>';
		print '<td><b>'.$FieldTabEd.'</b></td>';
		print '<td><b>'.$OperationTabEd.'</b></td>';
		print '</tr>';
		$i=0;
		$result = mysql_query( "SHOW INDEX FROM $t") or mysql_die($ErrorSelectFieldsTable." <b>$t</b>", false);
		while($rows = mysql_fetch_array($result))	# n?eo. eiai eieiiie
		{
			//	$Table, $Non_unique, $Key_name, $Seq_in_index, $Column_name, $Collation, $Cardinality, $Sub_part, $Packed, $Comment
			$row[$i]=$rows;
			$i++;
		}

		for ($i=0;$i<count($row);$i++)
		{
			if (($i%2)==0)
				print "<tr bgcolor=$bg3>";
			else
				print "<tr bgcolor=$bg4>";
			print "<td>".$row[$i]['Key_name']."</td>";
			if ($row[$i]['Key_name']=='PRIMARY')
				print "<td>PRIMARY</td>";
			elseif ($row[$i]['Non_unique']=='0')
				print "<td>UNIQUE</td>";
			elseif ($row[$i]['Comment']=='FULLTEXT')
				print "<td>FULLTEXT</td>";
			else
				print "<td>INDEX</td>";
			if ($row[$i]['Cardinality']=='')
				print "<td>".$NoTabEd."</td>";
			else
				print "<td>".$row[$i]['Cardinality']."</td>";
			print "<td>".$row[$i]['Column_name']."</td>";
			print "<td align=center><a href=\"table_editor.php?t=$table&f=".$row[$i]['Key_name']."&op=t_di\"><img src=\"../img/dl.gif\" width=26 height=18 border=0 alt=\"".$DeleteTabEd."\"></a></td>";
			print '</tr>';
		}
		print "</table>";
		?>
		<br>
		<b><?print $Text3TabEd?></b><br>
		<form method=post action="table_editor.php">
		<table border=0>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td>
		&nbsp;<?print $Text4TabEd?> </td><td><select name=field_nm>
		<?
		print "<option value=_start_>$StartTabEd</option>";
		$result = mysql_query( "SHOW FIELDS FROM $t") or mysql_die($ErrorSelectFieldsTable." <b>$t</b>", false);
		for($i=0;$i<mysql_num_rows($result);$i++)	# n?eo. eiai eieiiie
		{
			list($Field, $Type, $Null, $Key, $Default, $Extra) = mysql_fetch_row($result);
			print "<option value=$Field>$BehindTabEd $Field</option>";
		}
		print "<option value=_end_ selected>$EndTabEd</option>";
		?>
		</select>
		</td>
		<?print "<tr bgcolor=".$bg4.">";?>
		<td>
		&nbsp;<?print $Text5TabEd?> </td><td><input type=text name=field_am value="" size=4 maxlength=3>
		</td>
		</tr>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td align=center colspan=2>
		<input type=hidden name=t value="<?print $t?>">
		<input type=hidden name=op value="t_add_field">
		<input type=submit name=sub value="<?print $AddTabEd?>" class=button>
		</td>
		</tr>
		</table>
		</form><br>
		<?
		$result = mysql_query( "SHOW TABLE STATUS LIKE '$t'") or mysql_die($ErrorSelectStatusFieldsTable." <b>$t</b>", false);
		$table_status = mysql_fetch_array($result);
		$type_tb = $table_status['Type'];
		$comment_tb = $table_status['Comment'];
		?>
		<b><?print $Text6TabEd?></b><br>
		<form method=post action="table_editor.php">
		<table border=0>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td>
		&nbsp;<?print $Text7TabEd?> </td><td><input type=text name=comment value="<?print$comment_tb?>">
		</td>
		</tr>
		<?print "<tr bgcolor=".$bg4.">";?>
		<td align=center colspan=2>
		<input type=hidden name=t value="<?print $t?>">
		<input type=hidden name=op value="t_recomment">
		<input type=submit name=sub value="<?print $ChangeTabEd?>" class=button>
		</td>
		</tr>
		</table>
		</form><br>
		<b><?print $Text8TabEd?></b><br>
		<form method=post action="table_editor.php">
		<table border=0>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td>
		&nbsp;<?print $Text9TabEd?> </td><td><input type=text name=t_new value="<?print$t?>">
		</td>
		</tr>
		<?print "<tr bgcolor=".$bg4.">";?>
		<td align=center colspan=2>
		<input type=hidden name=t value="<?print $t?>">
		<input type=hidden name=op value="t_rename">
		<input type=submit name=sub value="<?print $RenameTabEd?>" class=button>
		</td>
		</tr>
		</table>
		</form><br>
		<b><?print $Text10TabEd?></b><br>
		<form method=post action="table_editor.php">
		<table border=0>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td>
		&nbsp;<?print $Text10TabEd?>: </td><td>
		<?
		print "<select name=type_tb>";
		?>
		<option value="MYISAM"<?if ($type_tb=="MYISAM") print "selected"?>>MyISAM</option>
		<option value="HEAP"<?if ($type_tb=="HEAP") print "selected"?>>Heap</option>
		<option value="MERGE"<?if ($type_tb=="MRG_MYISAM") print "selected"?>>Merge</option>
		<option value="ISAM"<?if ($type_tb=="ISAM") print "selected"?>>ISAM</option>
		<option value="BDB"<?if ($type_tb=="BERKELEYDB") print "selected"?>>Berkeley DB</option>
		<option value="GEMINI"<?if ($type_tb=="GEMINI") print "selected"?>>Gemini</option>
		<option value="INNODB"<?if ($type_tb=="INNODB") print "selected"?>>INNO DB</option>
		<?
		print "</select>";
		?>
		</td>
		</tr>
		<?print "<tr bgcolor=".$bg4.">";?>
		<td align=center colspan=2>
		<input type=hidden name=t value="<?print $t?>">
		<input type=hidden name=op value="t_retype">
		<input type=submit name=sub value="<?print $ChangeTabEd?>" class=button>
		</td>
		</tr>
		</table>
		</form><br>
		<b><?print $Text11TabEd?></b><br>
		<form method=post action="table_editor.php">
		<table border=0>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td>
		&nbsp;<?print $Text12TabEd?> </td><td><input type=text name=t_new value="<?print$t?>">
		</td>
		</tr>
		<?print "<tr bgcolor=".$bg4.">";?>
		<td>
		&nbsp;<?print $Text13TabEd?> </td><td><input type=checkbox name=all value="yes">
		</td>
		</tr>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td align=center colspan=2>
		<input type=hidden name=t value="<?print $t?>">
		<input type=hidden name=op value="t_copy">
		<input type=submit name=sub value="<?print $CopyTabEd?>" class=button>
		</td>
		</tr>
		</table>
		</form><br>
		<?
	}
	elseif ($op=='t_d')
	{
		print "<br><b>".$Text14TabEd." $a.</b><br>";
		print "<form method=post action=\"table_editor.php\">";
		print "<input type=hidden name=op value=\"t_d2\">";
		print "<input type=hidden name=nametb value=\"$t\">";
		print "<input type=submit name=sub value=\"".$YesTabEd."\" class=button>&nbsp;<input type=submit name=sub value=\"".$NoTabEd."\" class=button>";
	}
	elseif ($op=='t_ef')
	{
		$result = mysql_query( "SHOW FIELDS FROM $t") or mysql_die($ErrorSelectFieldsTable." <b>$t</b>", false);
		while(list($Field, $Type, $Null, $Key, $Default, $Extra) = mysql_fetch_row($result))	# n?eo. eiai eieiiie
		{
			if ($Field==$f)
			{
				$TypeT = $Type;
				$end_type = strpos($Type, "(");
				if ($end_type)
				{
					$TypeT = substr($Type, 0, $end_type);
					$TypeL = substr($Type, ($end_type+1), (strpos($Type, ")")-$end_type-1));
				}
				$end_len = strpos($Type, " ");
				if ($end_len)
				{
					$Attr = substr($Type, ($end_len+1), (strlen($Type)-$end_len-1));
				}
				break;
			}
		}
		print "<br><b>".$Text15TabEd." $nametb.</b><br>";
		print "<form method=post action=\"table_editor.php\">";
		print "<table border=0>";
		print "<tr bgcolor=$bg2>";
		print '<td align=center><b>'.$FieldTabEd.'</b></td>';
		print '<td align=center><b>'.$TypeTabEd.'</b></td>';
		print '<td align=center><b>'.$LenghtTabEd.'</b></td>';
		print '<td align=center><b>'.$AtrTabEd.'</b></td>';
		print '<td align=center><b>'.$NullTabEd.'</b></td>';
		print '<td align=center><b>'.$DefTabEd.'</b></td>';
		print '<td align=center><b>'.$ExtraTabEd.'</b></td>';
		print '<td align=center><b>'.$NameTabEd.'</b></td>';
		print '</tr>';

		print "<tr bgcolor=$bg3>";
		print "<td>";
		print "<input type=text name=field size=10 maxlength=16 value=\"$Field\">";
		print "</td>";
		print "<td>";
//		var_dump($ColumnTypes);
		print "<select name=type>";
		for ($i=0;$i<count($ColumnTypes);$i++)
		{
			print "<option value=\"$ColumnTypes[$i]\"";
			if ($TypeT==strtolower($ColumnTypes[$i]))
				print " selected";
			print ">$ColumnTypes[$i]</option>";
		}
		print "</select>";
		print "</td>";
		print "<td>";
		print "<input type=text name=len size=8 value=\"$TypeL\">";
		print "</td>";
		print "<td>";
		print "<select name=attr>";
		for ($i=0;$i<count($AttributeTypes);$i++)
		{
			print "<option value=\"$AttributeTypes[$i]\"";
			if (isset($Attr) && $Attr==strtolower($AttributeTypes[$i]))
				print " selected";
			print ">$AttributeTypes[$i]</option>";
		}
		print "</select>";
		print "</td>";
		print "<td>";
		print "<select name=nul><option value=\"NOT NULL\"";
		if ($Null=="")
			print " selected";
		print ">not null</option><option value=\"\"";
		if ($Null=="YES")
			print " selected";
		print ">null</option></select>";
		print "</td>";
		print "<td>";
		print "<input type=text name=default size=8 value=\"$Default\">";
		print "</td>";
		print "<td>";
		print "<select name=ext><option value=\"\"";
		if ($Extra=="")
			print " selected";
		print "></option><option value=\"AUTO_INCREMENT\"";
		if ($Extra=="auto_increment")
			print " selected";
		print ">auto_increment</option></select>";
		print "</td>";
		print "<td>";
		$query_conf = "SELECT cfnm FROM nrcf WHERE cftb='$t' AND cffl='$f'";
		$result = mysql_query( $query_conf) or mysql_die($MySQLError.mysql_error(), false);
		list($cfnm) = mysql_fetch_row($result);

		print "<input type=text name=des size=10 value=\"$cfnm\">";
		print "</td>";
		print "</tr>";
		?>
		</table>
		<input type=hidden name=op value="t_ef2">
		<input type=hidden name=f_prev value="<?print $f?>">
		<input type=hidden name=nametb value="<?print $t?>">
		<input type=submit name=sub value="<?print $ChangeTabEd?>" class=button>
	<?
	}
	elseif ($op=='t_df')
	{
		print "<br><b>".$Text16TabEd." $f ".$Text17TabEd." $t.</b><br>";
		print "<form method=post action=\"table_editor.php\">";
		print "<input type=hidden name=op value=\"t_df2\">";
		print "<input type=hidden name=t value=\"$t\">";
		print "<input type=hidden name=f value=\"$f\">";
		print "<input type=submit name=sub value=\"".$YesTabEd."\" class=button>&nbsp;<input type=submit name=sub value=\"".$NoTabEd."\" class=button>";
	}
	elseif ($op=='t_add_field')
	{
		print "<br><b>".$Text18TabEd." $nametb.</b><br>";
		print "<form method=post action=\"table_editor.php\">";
		print "<table border=0>";
		print "<tr bgcolor=$bg2>";
		print '<td align=center><b>'.$FieldTabEd.'</b></td>';
		print '<td align=center><b>'.$TypeTabEd.'</b></td>';
		print '<td align=center><b>'.$LenghtTabEd.'</b></td>';
		print '<td align=center><b>'.$AtrTabEd.'</b></td>';
		print '<td align=center><b>'.$NullTabEd.'</b></td>';
		print '<td align=center><b>'.$DefTabEd.'</b></td>';
		print '<td align=center><b>'.$ExtraTabEd.'</b></td>';
		print '<td align=center><b>'.$NameTabEd.'</b></td>';
		print '</tr>';

		for ($i=0;$i<$field_am;$i++)
		{

			if (($i%2)==0)
				print "<tr bgcolor=$bg3>";
			else
				print "<tr bgcolor=$bg4>";
			print "<td>";
			print "<input type=text name=field[$i] size=10 maxlength=16>";
			print "</td>";
			print "<td>";
			print "<select name=\"type[$i]\">";
			for ($j=0;$j<count($ColumnTypes);$j++)
			{
				print "<option value=\"$ColumnTypes[$j]\"";
				if ($j==0)
					print " selected";
				print ">$ColumnTypes[$j]</option>";
			}
			print "</select>";
			print "</td>";
			print "<td>";
			print "<input type=text name=len[$i] size=8>";
			print "</td>";
			print "<td>";
			print "<select name=attr[$i]>";
			for ($j=0;$j<count($AttributeTypes);$j++)
			{
				print "<option value=\"$AttributeTypes[$j]\"";
				if ($j==0)
					print " selected";
				print ">$AttributeTypes[$j]</option>";
			}
			print "</select>";
			print "</td>";
			print "<td>";
			print "<select name=nul[$i]><option value=\"NOT NULL\" selected>not null</option><option value=\"\">null</option></select>";
			print "</td>";
			print "<td>";
			print "<input type=text name=default[$i] size=8>";
			print "</td>";
			print "<td>";
			print "<select name=ext[$i]><option value=\"\"></option><option value=\"AUTO_INCREMENT\">auto_increment</option></select>";
			print "</td>";
			print "<td>";
			print "<input type=text name=des[$i] size=10>";
			print "</td>";
			print "</tr>";
		}
		print "<tr bgcolor=$bg3>";
		print "</tr>";
		?>
		</table>
		<input type=hidden name=op value="t_add_field2">
		<input type=hidden name=after value="<?print $field_nm?>">
		<input type=hidden name=nametb value="<?print $t?>">
		<input type=submit name=sub value="<?print $AddTabEd?>" class=button>
	<?
	}
	else
	{ # first form

		print "<br><table border=0 cellspacing=1 cellpadding=2>";
		print "<tr bgcolor=$bg2>";
		print "<td><b>".$Text19TabEd."</b>";
		print "</td>";
		print "<td colspan=4 align=center><b>".$OperationTabEd."</b>";
		print "</td>";
		print "</tr>";
		$tmp=0;
		$query="SHOW TABLES";
		$result = mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
		while(list($table) = mysql_fetch_row($result))
		{
			if (($tmp%2)==0)
				print "<tr bgcolor=$bg3>";
			else
				print "<tr bgcolor=$bg4>";
			$query="SELECT tbds FROM nrtb WHERE tbnm='$table'";
			$result2 = mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
			list($table_nm) = mysql_fetch_row($result2);

			if (!isset($table_nm) && substr($table, 0, 6) != "phpbb_") // write data in config table
			{
				$query = "SHOW TABLE STATUS LIKE '$table'";
				$result3 = mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
				if($row_ad = mysql_fetch_array($result3))
				{
					$table_nm = $row_ad['Comment'];
				}

				if ($table_nm=="") $table_nm=$table;
				$query="INSERT INTO nrtb (tbnm, tbds, tbtx, tbnu, tbdl, tbro, tbss) VALUES ('$table', '$table_nm', '', '20', '0', 'n', '')";
				mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
				$query="INSERT INTO nrat VALUES ('Operator', '$table', 'w', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
				mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);

				$query="SHOW FIELDS FROM $table";
				$result3 = mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
				$i=1;
				while(list($Field, $Type, $Null, $Key, $Default, $Extra) = mysql_fetch_row($result3))
				{
					$query="INSERT INTO nrcf (cfid, cffl, cftb, cfsw, cfnm, cfds, cfsv, cfsr, cfel, cfme, cfen, cfenf, cfpd, cfdt, cfvf, cfct, cfaa, cfor, cffe, cffo, cfmd, cfmv, cffn) VALUES ('$i', '$Field', '$table', 'y', '$Field', '', 'y', 'y', 'y', 'n', '', '', 'n', '', '', 'n', 'n', 'n', 'n', 'n', '', '', '')";
					mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
					$i++;
				}

				$query="INSERT INTO nrnv (nvnm, nvvr, nvtb) VALUES ('$table_nm', 't', '$table')";
				mysql_query( $query) or mysql_die($MySQLError.mysql_error(), false);
			}

			print "<td title=\"$table_nm\">$table</td><td><a href=\"table_editor.php?t=$table&op=t_e\"><img src=\"../img/ed.gif\" width=26 height=18 border=0 alt=\"".$EditTabEd."\"></a></td><td><a href=\"table_editor.php?t=$table&op=t_d\"><img src=\"../img/dl.gif\" width=26 height=18 border=0 alt=\"".$DeleteTabEd."\"></a></td>";
			print "<td><a href=\"table_status.php?t=$table\" target=_blank><img src=\"../img/inf.gif\" width=31 height=18 border=0 alt=\"".$StatusTabEd."\"></a></td>";
			print "<td><a href=\"del_f_t.php?t=$table\" target=_blank><font><img src=\"../img/dla.gif\" width=24 height=18 border=0 alt=\"".$DeleteAllTabEd."\"></font></a></td>";
			print "</tr>";
			$tmp++;
		}
		print "</table>";
		?>
		<hr>
		<b><?print $Text20TabEd?></b><br><br>
		<form method=post action="table_editor.php">
		<table border=0>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td>
		&nbsp;<?print $Text21TabEd?> </td><td><input type=text name=nametb size=16 maxlength=16>
		</td>
		</tr>
		<?print "<tr bgcolor=".$bg4.">";?>
		<td>
		&nbsp;<?print $Text22TabEd?> </td><td><input type=text name=fieldnumtb size=3 maxlength=3>
		</td>
		</tr>
		<?print "<tr bgcolor=".$bg3.">";?>
		<td align=center colspan=2>
		<input type=hidden name=op value="t_create">
		<input type=submit name=sub value="<?print $CreateTabEd?>" class=button>
		</td>
		</tr>
		</table>
		</form>
		</div>
	<?
	}
}
else
{
	print $AccessDeny;
}
?>
</body>
</html>

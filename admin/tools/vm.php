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
 * Admin utility mail validator
 */

require ("../conf.inc.php");

function ValMail($Email, $flag)
{
	global $HTTP_HOST;
	$result = array();

	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $Email))
	{ 
		$result[0]=false; 
		$result[1]="<b>$Email</b> ".$ErrorFormatVm;
		return $result;
	} 

	list ( $Username, $Domain ) = split ("@",$Email); 

	if (getmxrr($Domain, $MXHost))
	{
		$ConnectAddress = $MXHost[0]; 
	}
	else
	{ 
		$ConnectAddress = $Domain; 
	}

	echo "<br>".$DomainVm." - $Domain<br>".$ConnectAddressVm." - $ConnectAddress<br>";

	if ($flag==true)
	{
		$Connect = fsockopen ( $ConnectAddress, 25 ); 

		if ($Connect)
		{
			if (ereg("^220", $Out = fgets($Connect, 1024)))
			{
				fputs ($Connect, "HELO $HTTP_HOST\r\n"); 
				$Out = fgets ( $Connect, 1024 ); 
				fputs ($Connect, "MAIL FROM: <{$Email}>\r\n"); 
				$From = fgets ( $Connect, 1024 ); 
				fputs ($Connect, "RCPT TO: <{$Email}>\r\n"); 
				$To = fgets ($Connect, 1024); 
				fputs ($Connect, "QUIT\r\n"); 
				fclose($Connect); 
				if (!ereg ("^250", $From) || !ereg ( "^250", $To ))
				{
					$result[0] = false; 
					$result[1] = $AddresNotFoundOnServerVm;
					return $result; 
				}
			}
			else
			{
				$result[0] = false; 
				$result[1] = $ServerNotAnswerVm;
				return $result; 
			}
		}
		else
		{
			$result[0] = false; 
			$result[1] = $ServerNotConnectedVm; 
			return $result; 
		}
	}

	$result[0]=true; 
	$result[1]="<b>$Email</b> ".$AddressExistVm; 
	return $result; 
} // end of function

$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
$query="SET NAMES cp1251";
@mysql_db_query($base,$query);
authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host']) 
{
	print($ErrorAccessRight);
	exit;
}

/*$query = "SELECT nvtb FROM nrnv WHERE nvad='%tools/vm.php?l=%'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
list($t) = mysql_fetch_row($result);
$access='n';
$query = "SELECT atac FROM nrat LEFT JOIN nrur ON urrl=atrl WHERE (urad='$PHP_AUTH_USER' OR atrl='$PHP_AUTH_ROLE') AND attb='$t'";
$result = mysql_db_query($base, $query) or mysql_die($MySQLError.mysql_error(), false);
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

if ($access!='w' && $access!='r') 
{
	print($ErrorAccessRight);
	exit;
}
*/ # ������ ������� ��� ����������� ������� � �������
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?print $SystemDataAdministrationConf?> :: <?print $TitleVm?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
</head>

<?print $body?>

<div align="center">
<form action="vm.php" method=post>
<?
if (isset($email))
{
	$val=ValMail($email,true);
	print $val[1];
}
?>
<table>
<tr><td><font class=times><?print $EmailVm?>&nbsp;</font></td><td><input type=text name=email size=35></td></tr>
</table>
<input type=submit value="<?print $VerifyVm?>" name=sendit class=button>
</form>
</div>

</body>
</html>
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
 * Admin utility index file
 */

require ("conf.inc.php");
$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);
$count_login=0;

if (isset($del) && $del=='y')
{
	if ($SERVER_PORT=='443')
	{
		if ($use_cookie==false)
		{
			session_unregister("PHP_AUTH_USER");
			session_unregister("PHP_AUTH_PW");
		}
		else
		{
			setcookie("PHP_AUTH_USER","");
			setcookie("PHP_AUTH_PW","");
		}
	}
	header('Location: ../');		
	exit;
}

require ("install.inc.php");
install($base, $language);

authorize('y');

?>
<!-- ADMIN alternativago@gmail.com -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>&quot;ADMIN&quot;. <?print $SystemDataAdministration?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">
</head>

<frameset cols="200,*" framespacing=0  border=0 frameborder=0>
	<frame name=navig src="navig.php" marginwidth=4 marginheight=0 scrolling=auto frameborder=0 noresize>
	<frame name=main src="first.php" marginwidth=4 marginheight=0 scrolling=auto frameborder=0 noresize>
</frameset>
<noframes>
<body>
<div align=center>
<h2><?print $Sorry?></h2>
<p>
<b><i>ADMIN</i> <?print $Requires?></b><br>
</div>
</body>
</noframes>
</HTML>
<?php
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
 * Configuration file
 */

# Setup you configuration #############################################################################



if (substr($_SERVER['HTTP_HOST'], -3, 3) == '.ll')
{
	$server='localhost';
	$login='root';
	$password='vertrigo';
	$base="wks";
	$use_cookie=true;	
}
else
{
	$subdomen = str_replace("wks.com.ua","", $_SERVER['HTTP_HOST']);
	$subdomen = str_replace("www.","", $subdomen);
	$subdomen = str_replace(".","", $subdomen);

	$server='localhost';
	$login='bangkok_wks';
	$password='ghjuekrf';
	$base='bangkok_wks';
	if($subdomen != "") $base='bangkok_wks-'.$subdomen;
	$use_cookie=false;	
}


$version='2.64'; //2.64 - blob from nrfl out from DB
$href="http://".$HTTP_HOST;					# website URL
$path_to_admin = "/admin/";						# path to https analog website
$path_to_media = $path_to_admin.'media/';
$no_https_adm = $href.$path_to_admin;
$email_from="info@alternatives.com.ua";		# email From
$admin_mail="info@alternatives.com.ua";		# Admin email
$nailer_home_page="";

$site_name="ADMIN";						# Title
$auth_site="ADMIN";						# Authorization title

$use_cookie=false;							# if true cookie, else sessions

$language="ru";								# ru, en

$TreeRoot = "0";							# root for tree structures

$ExecTimeLimit = 300;						# for backup
$MemoryLimit = '120M';						# for backup (only if compressed)
$csv_line_length = 15000;					# line length for load CSV

##############################################################################
if ($use_cookie==false)
{
	session_start();
}

#$dmy = gmdate('D, d M Y H:i:s').' GMT';
#header('Expires: 0');
#header('Last-Modified: '.$dmy);
#header('Cache-Control: no-store, no-cache, must-revalidate');
#header('Cache-Control: pre-check=0, post-check=0, max-age=0');
#header('Pragma: no-cache');

include ("lang/en.inc.php");				# if not all data in language file used english
@include ("lang/".$language.".inc.php");
include ("functions.inc.php");
?>

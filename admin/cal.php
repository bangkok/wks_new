<?
/* 
 *
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
 * Admin utility calendar module
 */

require ("conf.inc.php");
?>
<html>
<head>
	<title><?print $SystemDataAdministrationConf?> :: <?print $Calendar?></title>
<body bgcolor=#ffffff leftmargin=0 marginwidth=0 marginheight=4 topmargin=4>
<div align=center>
<script language = "JavaScript">

function changer_dates(d,m,y,h,i,s,selection)  {  
	if (selection==1)
	{
		AddSearche(y+"-"+m+"-"+d+" "+h+":"+i+":"+s,'<?print $f?>');
		window.close();
	}
	if (selection==2)
	{
		AddSearche(y+"-"+m+"-"+d,'<?print $f?>');
		window.close();
	}
	if (selection==3)
	{
		AddSearche(h+":"+i+":"+s,'<?print $f?>');
		window.close();
	}
	if (selection==4)
	{
		AddSearche(y+m+d+h+i+s,'<?print $f?>');
		window.close();
	}
	if (selection==5)
	{
		AddSearche(y,'<?print $f?>');
		window.close();
	}
}

function AddSearche(msg, i)
{
	with(opener.document.sendmessage)
	{
		if (msg!="") 
		{
			opener.document.sendmessage.elements["fields["+i+"]"].value=msg;
			//IE support
			if (opener.document.selection) {
				opener.document.sendmessage.elements["fields["+i+"]"].focus();
				sel = opener.document.selection.createRange();
			}
		}
	}
}
</script>

<?
if (!isset($y) || $y=='')
{
	$y=date("Y");
}
if (!isset($m) || $m=='')
{
	$m=date("m");
}
if (!isset($d) || $d=='')
{
	$d="1";
}
$max_day=date("t", mktime (0,0,0,$m,$d,$y));
$first_day=date("w", mktime (0,0,0,$m,1,$y));
if ($first_day==0) $first_day=7;
$first_day=$first_day-1;

print "<table border=1 cellpadding=1 cellspacing=0>";
print "<tr>";
print "<td bgcolor=#f0f0f0>";

print "<a href=\"".basename($PHP_SELF)."?";
//print "d=".date("j", mktime (0,0,0,$m,$d,$y));
print "m=".(date("n", mktime (0,0,0,$m-1,$d,$y)));
if ($m==1)
	print "&y=".date("Y", mktime (0,0,0,$m,$d,$y-1));
else
	print "&y=".date("Y", mktime (0,0,0,$m,$d,$y));
print "&n=$n&f=$f";
print "\">";
print "&lt;&lt;";
print "</a>";

print "</td>";
print "<td bgcolor=#f0f0f0 colspan=5 align=center>";

print "<a href=\"javascript:changer_dates(";
if ($max_day>date("j")  && $m==date("n") && $y==date("Y"))
	$this_day=date("j");
else
	$this_day=$max_day;
print "'01', '".date("m", mktime (0,0,0,$m,$d,$y))."', '".date("Y", mktime (0,0,0,$m,$d,$y))."', '00', '00', '00', $n";
print ");\">";
print date("F - Y", mktime (0,0,0,$m,$d,$y));
print "</a>";

print "</td>";
print "<td bgcolor=#f0f0f0>";

print "<a href=\"".basename($PHP_SELF)."?";
print "m=".(date("n", mktime (0,0,0,$m+1,$d,$y)));
if ($m==12)
	print "&y=".date("Y", mktime (0,0,0,$m,$d,$y+1));
else
	print "&y=".date("Y", mktime (0,0,0,$m,$d,$y));
print "&n=$n&f=$f";
print "\">";
print "&gt;&gt;";
print "</a>";

print "</td>";
print "</tr>";

print "<tr>";
print "<td bgcolor=#fdfdfd  valign=middle align=center>";
print "��";
print "</td>";
print "<td bgcolor=#fdfdfd  valign=middle align=center>";
print "��";
print "</td>";
print "<td bgcolor=#fdfdfd  valign=middle align=center>";
print "��";
print "</td>";
print "<td bgcolor=#fdfdfd  valign=middle align=center>";
print "��";
print "</td>";
print "<td bgcolor=#fdfdfd  valign=middle align=center>";
print "��";
print "</td>";
print "<td bgcolor=#fdfdfd  valign=middle align=center>";
print "<font color=#FF0099>��</font>";
print "</td>";
print "<td bgcolor=#fdfdfd  valign=middle align=center>";
print "<font color=#FF0099>��</font>";
print "</td>";
print "</tr>";

for ($i=0;$i<($first_day+$max_day)/7;$i++)
{
	print "<tr>";
	for ($j=1;$j<=7;$j++)
	{
		print "<td align=center valign=middle bgcolor=#ffffff>";
		if ($first_day-($i*7+$j)>=0 || ($i*7+$j)-$first_day-$max_day>0)
		{
			print "&nbsp;";
		}
		else
		{
			print "<a href=\"javascript:changer_dates(";
			if ((($i*7+$j)-$first_day) < 10)
				print "'0".(($i*7+$j)-$first_day)."'";
			else
				print "'".(($i*7+$j)-$first_day)."'";
			print ",'".date("m", mktime (0,0,0,$m,$d,$y))."','".date("Y", mktime (0,0,0,$m,$d,$y))."','00','00','00',$n);\">";
			print ($i*7+$j)-$first_day;
			print "</a>";
		}
		print "</td>";
	}
	print "</tr>";
}

print "</table>";
?>
</body>
</html>
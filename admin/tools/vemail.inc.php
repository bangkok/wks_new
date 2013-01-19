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
 * Admin utility mail format validator
 */

if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $el_in) && $el_in!='')
{ 
	$el_out[0]=false; 
	$el_out[1]="<b>$el_in</b> ".$ErrorFormatVemail;
	$el_out[2]="$el_in";
}
else
{
	$el_out[0]=true; 
	$el_out[1]="<b>$el_in</b> ".$NotErrorFormatVemail;
	$el_out[2]="$el_in";
}
?>
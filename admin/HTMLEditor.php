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
 * Admin utility visual editor
 */

require ("conf.inc.php");

$ident=@mysql_pconnect($server,$login,$password) or mysql_die($ErrorConnectionToMySQLServer, true);

authorize('n');
$referer=parse_url($HTTP_REFERER);
if ($HTTP_HOST!=$referer['host'] && $op!='sv') 
{
	print($ErrorAccessRight);
	exit;
}
$CharSet = 'utf-8';
?>
<!-- ADMIN alternativago@gmail.com -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?=$SystemDataAdministrationConf//print iconv("cp1251", "UTF-8", $SystemDataAdministrationConf)?> :: <?=$TitleTabToMenu//print iconv("cp1251", "UTF-8", $TitleTabToMenu)?></title>
<meta name="Author" content="ADMIN alternativago@gmail.com">
<meta http-equiv="Content-Type" content="text/html; charset=<?print $CharSet?>">

<script language=JavaScript>
<!--

// Function  execute format commandes.
function SetStyle (newStyle)
{ 
	frames ['editorFrame'].focus();
	var selection = frames['editorFrame'].document.selection.createRange();

	if  ((newStyle=="H1") || (newStyle=="H2") || (newStyle=="H3") || (newStyle=="H4"))
	{
		selection.pasteHTML("<"+newStyle+">"+selection.text+"</"+newStyle+">")
	}
	else
	{
		selection.execCommand(newStyle);
	}
	frames ['editorFrame'].focus();
}

//-->
</script>
</head>



<!-- TinyMCE -->
<script language="javascript" type="text/javascript" src="tinymce3/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
/*	tinyMCE_GZ.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,|,code",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "/css/style.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
		media_external_list_url : "example_media_list.js",
		template_external_list_url : "example_template_list.js",
		theme_advanced_resize_horizontal : true,
		theme_advanced_resizing : true,
		nonbreaking_force_tab : true,
		apply_source_formatting : true,
		language : "ru",
		template_replace_values : {
			username : "Jack Black",
			staffid : "991234"
		}

	});*/
</script>
<!-- Needs to be seperate script tags! -->
<script type="text/javascript">
/*	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,|,code",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "/css/style.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
		media_external_list_url : "example_media_list.js",
		template_external_list_url : "example_template_list.js",
		theme_advanced_resize_horizontal : true,
		theme_advanced_resizing : true,
		nonbreaking_force_tab : true,
		apply_source_formatting : true,
		language : "ru",
		template_replace_values : {
			username : "Jack Black",
			staffid : "991234"
		}

	});	*/
	/*
	tinyMCE_GZ.init({
		// General options
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
    language : "ru",
    disk_cache : true,
    debug : false    
	});*/		
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
	//	content_css : "/css/style.css",

		// Drop lists for link/image/media/template dialogs
//		template_external_list_url : "lists/template_list.js",
//		external_link_list_url : "lists/link_list.js",
//		external_image_list_url : "lists/image_list.js",
//		media_external_list_url : "lists/media_list.js",

    language : "ru",
    relative_urls : false, // Default value
    document_base_url : '/',
      
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});	

	

	function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Example of filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
	}
	
	function sa()
	{//alert('111111');
		opener.document.sendmessage.elements["fields[<?print $f?>]"].value = document.getElementById("elm1").value; 
		opener.document.sendmessage.elements["fields[<?print $f?>]"].focus();	
		window.close();		
	}
	
	function initEditor()
	{   
		document.getElementById("elm1").value = opener.document.sendmessage.elements["fields[<?print $f?>]"].value;
		//editor.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"../style.css\">" + opener.document.sendmessage.elements["fields[<?//print $f?>]"].value);
	}
	
</script>
<!-- /TinyMCE -->

<form method="post" action="#" onsubmit='sa();return false;'>
	<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 100%">

	</textarea>
	<br />
</form>

<script language="javascript" type="text/javascript">
	initEditor();
</script>

</body>
</html>

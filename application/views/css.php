<?php
//$this->load->helper('file');
//echo read_file('css/style.css');
//$this->load->view($_path['css'].'/style.css');

$CSS = array();

$CSS['style'] = 'style.css';
$CSS['style1'] = 'style1.css';
$CSS['page'] = 'page.css';

$CSS['UI'] = 'UI/jquery-ui-1.8.17.custom.css';
$CSS['blocks'] = '
<style type="text/css">
	div.block{
		margin: 10px 10px 10px 0;
		box-shadow: 8px 0 10px rgba(0, 0, 0, 0.3);
		border-radius: 0 8px 0 30px;
	}
	div.block div.content{
		margin-bottom: 10px;
	}
	div.block div.content div.text{
		padding-left: 10px
	}
	div.block div.scroll{
		margin-top: 5px;
	}
	div.block div.naw div{
		padding: 0 10px;
	}
</style>';

$CSS['home'] = '
<link rel="stylesheet" href="/css/accordion.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/css/roundedcorners.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/css/home.css" type="text/css" media="screen" />';

$CSS['button'] = 'button.css';
$CSS['buttons'] = 'buttons.css';
$CSS['style_WKS_house']= 'style_WKS_house.css';
$CSS['colorbox']= 'colorbox/colorbox.css';
$CSS['galleriffic-4']= 'galleriffic-4.css';






foreach ( $_style as $name ) {
	if ( !empty($CSS[$name]) ) {
		foreach ( explode('|', $CSS[$name]) as $item ) {
			if ( substr(($item = trim($item)), 0, 1) == '<' ) {
				echo $item . "\n";
			} else {
				@list($file_name, $media_type) = array_map('trim', explode(':', $item));
				$file_name = $item;
				if ( substr($file_name, 0, 7) != 'http://' ) {
					$file_name = '/' . $_path['css'] . '/' . $file_name;
				}
?><link href="<?=$file_name?>" media="<?=$media_type?$media_type:'screen'?>" rel="stylesheet" type="text/css" />
<?php
			}
		}
	}
}
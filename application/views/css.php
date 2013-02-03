<?php
//$this->load->helper('file');
//echo read_file('css/style.css');
//$this->load->view($_path['css'].'/style.css');

$CSS = array();

$CSS['style'] = 'style.css';

foreach($_style as $name){
	if ( !empty($CSS[$name]) ) {
		if ( substr((trim($CSS[$name])), 0, 1) == '<' ) {
			echo $CSS[$name];
		} else {
			@list($file_name, $media_type) = array_map('trim', explode('|', $CSS[$name]));
?>
<link href="<?=$_path['css'].'/'.$file_name?>" media="<?=$media_type?$media_type:'screen'?>" rel="stylesheet" type="text/css" >
<?php
		}
	}
}
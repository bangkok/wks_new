<?php
//$this->load->helper('file');
$JS = array();

$JS['core'] = 'core.js';
$JS['script']=	'script.js';
$JS['jquery-1.4.2']='jquery-1.4.2.min.js';
$JS['jquery-1.6.1']='jquery-1.6.1.min.js';
$JS['jquery-1.7.1']='jquery-1.7.1.min.js';
$JS['jquery-1.8.3']='jquery-1.8.3.min.js';
$JS['jquery'] = $JS['jquery-1.7.1'];

$JS['UI']='<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js" type="text/javascript"></script>';
$JS['blocks']='blocks.js';
$Js['gaq']= 'gaq.js';

foreach ( $_js as $name ) {
	if ( !empty($JS[$name]) ) {
		if ( substr((trim($JS[$name])), 0, 1) == '<' ) {
			echo $JS[$name];
		} else {
			$file_name = trim($JS[$name]);
			if ( substr($file_name, 0, 7) != 'http://' ) {
				$file_name = '/' . $_path['js'] . '/' . $file_name;
			}
?>
<script src="<?=$file_name?>" type="text/javascript"></script>
<?php
		}
	}
}
<?php
//$this->load->helper('file');
$JS = array();

$JS['core'] = 'core.js';

foreach($_js as $name){
	if ( !empty($JS[$name]) ) {
		if ( substr((trim($JS[$name])), 0, 1) == '<' ) {
			echo $JS[$name];
		} else {
			$file_name = $JS[$name];
?>
<script src="<?=$_path['js'].'/'.$file_name?>" type="text/javascript"></script>
<?php
		}
	}
}
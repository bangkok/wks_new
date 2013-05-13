<?php
//$this->load->helper('file');
$JS = array();

$JS['core'] = 'core.js';
$JS['script']= 'script.js';
$JS['jquery-1.4.2']='jquery-1.4.2.min.js';
$JS['jquery-1.6.1']='jquery-1.6.1.min.js';
$JS['jquery-1.7.1']='jquery-1.7.1.min.js';
$JS['jquery-1.8.3']='jquery-1.8.3.min.js';
$JS['jquery'] = $JS['jquery-1.7.1'];

//$JS['jquery.cycle']= 'jquery.cycle.all.2.74.js';
//$JS['accordian'] = 'accordian.pack.js';
//$JS['UI']='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js';

$JS['jquery.galleriffic']= 'jquery.galleriffic.js';
$JS['jquery.opacityrollover']= 'jquery.opacityrollover.js';


$JS['cycle']= 'jquery.cycle.all.2.74.js | <script type="text/javascript">
$.fn.cycle.defaults.speed   = 1500;
$.fn.cycle.defaults.timeout = 6000;
$(document).ready(function(){
	if ($(".Panorama").children().length > 1) {
		$(".Panorama").cycle({fx:\'fade\',delay:-4000});
	}
});
</script>';

$JS['accordian'] = 'accordian.pack.js | <script type="text/javascript">
$(document).ready(function(){
	Accordian("basic-accordian",1,"header_highlight");
});
</script>';

$JS['colorbox']= 'jquery.colorbox.js | <script type="text/javascript">
$(document).ready(function(){
	$(".group1").colorbox({rel:"group1"});
	$(".calc").colorbox({inline:true});
});
</script>
';

$JS['buttons'] = 'buttons.js';
$JS['function'] = 'function.js';
$JS['blocks']='jquery-ui.min.js | blocks.js';
$JS['gaq']= 'gaq.js';

foreach ( $_js as $name ) {
	if ( !empty($JS[$name]) ) {
		foreach ( explode('|', $JS[$name]) as $item ) {
			if ( substr(($item = trim($item)), 0, 1) == '<' ) {
				echo $item . "\n";
			} else {
				$file_name = $item;
				if ( substr($file_name, 0, 7) != 'http://' ) {
					$file_name = '/' . $_path['js'] . '/' . $file_name;
				}
?><script src="<?=$file_name?>" type="text/javascript"></script>
<?php
			}
		}
	}
}
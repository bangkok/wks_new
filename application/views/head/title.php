<?php
$title = array_shift($path);
if ( !empty($path) ) {
	$title .= ' | ' . join(' &raquo; ', $path);
}
echo trim($title, "| \t\n\r");
?>
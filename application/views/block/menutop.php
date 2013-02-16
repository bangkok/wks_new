<?
$menu = '';
foreach ($Menu as $item) {

	$menu .= "\n".'<li><a href="'.$item['link'].'">'.$item['name'].'</a></li>';
}
echo '<ul class="menu"> '.$menu." </ul>";
?>

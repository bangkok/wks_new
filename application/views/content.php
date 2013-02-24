<div id="content_block">
	<div id="navpanel">
		<?//$NAV PANEL$?>
	</div>

	<div id="content">
		<div id="right-image"></div>

		<? if ( !empty($title) ) : ?>
			<div id="header_content"><h3><?=$title?></h3></div>
		<? endif; ?>

		<? if ( !empty($_path->content['text']) ) :?>

			<?php $this->load->view($_path->content['text']);?>

		<? elseif ( !empty($text) ) :?>

			<?=$text?>

		<? endif; ?>

	</div><!--content-->
	<div id="bottom-image"></div>

</div><!--content_block-->
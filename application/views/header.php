<div id="header">
	<?//<div id="leng">$LENG$</div>?>
	<div id="auth"><?php $this->load->view($_path->block['auth']);?></div>
	<?//<div id="buttons">$BUTTONS$</div>?>

	<a href="/"><div id="logo"><div id="afc"></div></div></a>

	<div id="navigation">
		<?php $this->load->view($_path->block['menu']);?>
	</div>
</div>
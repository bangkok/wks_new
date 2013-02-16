<div id="main">
	<div id="top_line"></div>
	<div id="container">
		<?php $this->load->view($_path['header'], $header);?>
		<?php $this->load->view($_path['content'], $content);?>
	</div><!--container-->
<?php $this->load->view($_path['footer'], $footer);?>

</div>
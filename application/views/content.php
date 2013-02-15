<? if ( !empty($text) ) : ?>

<div id="content_block">
	<!--<div id="navpanel">
		$NAV PANEL$
	</div>-->

	<div id="content">
		<div id="right-image"></div>
		<div id="header_content"><h3>$HEADER$</h3></div>

		<?=$text?>

	</div><!--content-->
	<div id="bottom-image"></div>

</div><!--content_block-->

<? else: ?>
	<div id="container">
		<a href="/">Домой</a>
		<h1>Welcome to CodeIgniter!</h1>

		<div id="body">
			<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

			<p>If you would like to edit this page you'll find it located at:</p>
			<code>application/views/welcome_message.php</code>

			<p>The corresponding controller for this page is found at:</p>
			<code>application/controllers/welcome.php</code>

			<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
<?endif?>
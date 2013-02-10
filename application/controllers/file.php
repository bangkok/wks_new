<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends Base_Controller {


function index()
{
	$this->load->helper('file');

	$path_file = substr($this -> uri -> uri_string, 5);

	if ( !$file = read_file($path_file) ) {

		$url_file = 'http://wks.com.ua/' . $path_file;

		$Headers = @get_headers($url_file);

		if ( strpos($Headers[0], '200') ) {

			$file = file_get_contents($url_file);

			if ( !is_dir(dirname($path_file)) ) {
				mkdir(dirname($path_file), 0755, TRUE);
			}

			write_file($path_file, $file);

		} else {

			echo $path_file;

			return 0;

		}

	}

	header("Content-type: image/jpeg");

	echo $file;

}

function trf()
{
	$t = $this->uri->segment(3);
	$f = $this->uri->segment(4);
	$id = $this->uri->segment(5);
	$x = $this->uri->segment(6);
	$y = $this->uri->segment(7);

	$this->load->plugin('trf');

	create_image_resized($t, $f, $id, $x, $y, $this);
}


}

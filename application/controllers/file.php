<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends Base_Controller {

protected $_domen  = 'wks.com.ua';

function index()
{
	$this->load->helper('file');

	$path_file = substr(
		$this -> uri -> uri_string,
		strlen(reset($this -> uri -> segment_array())) + 1
	);

	$url_file = 'http://' . $this -> _domen . '/' . $path_file;

	$Headers = @get_headers($url_file, 1);

	if ( strpos($Headers[0], '200') ) {

		$file = file_get_contents($url_file);

		if ( !is_dir(dirname($path_file)) ) {
			mkdir(dirname($path_file), 0755, TRUE);
		}

		write_file($path_file, $file);

		ini_set('error_log', APPPATH . 'logs\error.log');

		error_log($path_file ."\n". print_r($Headers, 1));

		header("Content-type: ". $Headers['Content-Type']);

		header("Content-Length: ". $Headers['Content-Length']);

		echo $file;

	} else {

		echo $path_file ."\n<br>\n". print_r($Headers, 1);

	}

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

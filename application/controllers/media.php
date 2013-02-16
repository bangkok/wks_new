<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends HTTP_Controller {

function index()
{
	if('media'== $this->uri->uri_string())
	header("Location: /media/video");

	parent::index();
}

protected function _fillViewData()
{
	parent::_fillViewData();

	$this->load->model('text_model');

	$this -> _view_data['content']['text'] = $this -> text_model -> getText($this -> node -> id);

}

}
?>
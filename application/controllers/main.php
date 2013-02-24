<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends HTTP_Controller {

protected function _fillViewData()
{
	parent::_fillViewData();

	$this->load->model('text_model');

	$this -> _view_data['content']['text'] =
		$this -> text_model -> getText($this -> node -> id);

	$this -> _addStyles('home | UI | blocks');
	$this -> _addJs('blocks | cycle | accordian');

}

}

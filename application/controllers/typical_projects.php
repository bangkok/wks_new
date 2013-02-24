<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Typical_projects extends HTTP_Controller {


function index($house_type=0)
{
	$this -> _fillViewData();

	if ( !empty($house_type) ) {

		$this->load->model('catalog_model');

		$this -> _view_data['content']['Houses'] =
			$this-> catalog_model -> getHousesByType($house_type);

		$this -> _addStyles('button');

		$this -> _path -> content['text'] = 'catalog';

	} else {

		$this ->load->model('text_model');

		$this -> _addStyles('home');

		$this -> _view_data['content']['text'] =
			$this -> text_model -> getText($this -> node -> id);

	}

	$this -> _view();

}

}

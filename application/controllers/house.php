<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class House extends HTTP_Controller {

protected $_house;

function index($house)
{
	if ( !$house ) { header("Location: {$this -> node -> parent['link']}"); return 0;}

	$this->load->model('catalog_model');

	if ('test' == $house) {
		$house = 11;
		$test = TRUE;
	}

	$this -> _house = $this -> catalog_model -> getHouse($house);

	$this -> _fillViewData();

	$this -> _view_data['content'] = $this -> _house;

	$this -> _path -> content['text'] = 'house';

	if ( !empty($test) ) {
		$this -> _path -> block['calc'] = 'calc';
		$this -> _addJs('function');
	}

	$this -> _addStyles('style_WKS_house | colorbox | home | buttons');

	$this -> _addJs('colorbox | buttons');

	$this -> _view();

}

function show($house)
{

	if ( !is_numeric($house) ) { header("Location: {$this -> node -> parent['link']}"); return 0;}

	$this->load->model('catalog_model');

	$this -> _house = $this -> catalog_model -> getHouse($house);

	$this -> _fillViewData();

	$this -> _view_data['content'] = $this -> _house;

	$this -> _path -> content['text'] = 'house-gallery.php';

	$this -> _addStyles('galleriffic-4');
	$this -> _addJs('jquery.galleriffic | jquery.opacityrollover');

	$this -> _view();

}

protected function _getHeadPath()
{
	return array_merge(
		parent::_getHeadPath(),
		array($this -> _house -> title)
	);

}

}
?>
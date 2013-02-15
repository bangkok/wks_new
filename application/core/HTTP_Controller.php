<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HTTP_Controller extends Base_Controller {

protected $_view_data = array(
	'_controller' => NULL,
	'_path' => array(),
	'_head' => array(
		'_style' => array(),
		'_js' => array()
	)
);

protected $_folder = array(
	'view'	=> '',
	'tpl'	=> 'tpl/',
	'block'	=> 'block/'
);

protected $_path = array(
	'view'	=> array(),
	'tpl'	=> array(),
	'block'	=> array(),
);

public $node;

function __construct()
{
	parent::__construct();

	$this->load->model('config_model');
	$this->load->model('menu_model');

	$this -> _fillNode();

	$this -> _initPath();

}


public function index()
{
	$this -> _fillViewData();

	$this -> _view();
}

protected function _fillNode()
{
	$this -> node = $this -> router -> getNode();
}

protected function _getContent()
{
	return (array)$this -> node;
}

protected function _fillViewData()
{
	//$this -> _view_data['_controller'] = &$this;

	$this -> _setStyles('style | page | blocks');
	$this -> _setJs('');

	$this -> _view_data['content'] = $this -> _getContent();

}

protected function _view()
{
	$this -> _view_data['_path'] = $this -> _path;

	$this -> load -> view($this -> _path['page'], $this -> _view_data);
}


protected function _initPath()
{
	$this -> _path = new Path('');
	$this -> _path['view'] = '';
	$this -> _path['page']		= 'page';
	$this -> _path['head']		= 'head';
	$this -> _path -> head['title'] = 'title';
	$this -> _path['body']		= 'body';
	$this -> _path['header']	= 'header';
	$this -> _path['footer']	= 'footer';
	$this -> _path['content']	= 'content';

	$this -> _path['block']		= 'block';
	$this -> _path -> block['auth'] = 'auth';

	$this -> _path['tpl']		= 'tpl';

	$this -> _path -> css = new Path('css');
	$this -> _path -> js = new Path('js');
}


protected function _setStyles($styleString, $style = array())
{
	$this -> _view_data['_head']['_style'] = array_unique(array_merge(
			$style,
			array_map('trim', explode('|', $styleString))
		));
}
protected function _setJs($jsString, $js = array())
{
	$this -> _view_data['_head']['_js'] = array_unique(array_merge(
			$js,
			array_map('trim', explode('|', $jsString))
		));
}
protected function _addStyles($styleString)
{
	$this -> _setStyles($styleString, $this -> _view_data['_head']['_style']);
}
protected function _addJs($jsString)
{
	$this -> _setJs($jsString, $this -> _view_data['_head']['_js']);
}

}
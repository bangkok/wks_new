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


function __construct()
{
	parent::__construct();

	//$this -> _view_data['_controller'] = &$this;

	$this -> _initPath();

	$this -> setStyles('style | page | blocks');
	$this -> setJs('');
}


public function index()
{
	$this -> _view();
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
	$this -> _path['body']		= 'body';
	$this -> _path['header']	= 'header';
	$this -> _path['footer']	= 'footer';
	$this -> _path['content']	= 'content';

	$this -> _path -> tpl = new Path('tpl', $this -> _path);

	$this -> _path -> block = new Path('block', $this -> _path);
	$this -> _path -> block['auth'] = $this -> _folder['block'] . 'auth';

	$this -> _path -> css = new Path('css');
	$this -> _path -> js = new Path('js');
}


function setStyles($styleString, $style = array())
{
	$this -> _view_data['_head']['_style'] = array_merge(
			$style,
			array_map('trim', explode('|', $styleString))
		);
}
function setJs($jsString, $js = array())
{
	$this -> _view_data['_head']['_js'] = array_merge(
			$js,
			array_map('trim', explode('|', $jsString))
		);
}
function addStyles($styleString)
{
	$this -> setStyles($styleString, $this -> _view_data['_head']['_style']);
}
function addJs($jsString)
{
	$this -> setJs($jsString, $this -> _view_data['_head']['_js']);
}

}
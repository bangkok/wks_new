<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends CI_Controller {

function _remap()
{
	if ($link = $this -> uri -> segment(2)
		and $this -> _is_view_method($link)
	) {
		$this -> $link($this -> uri -> segment(3));
	} else {
		$this->index();
	}
}

protected function _is_view_method($method_name)
{
	return method_exists($this, $method_name)
		and $method = new ReflectionMethod($this, $method_name)
		and $method -> isPublic();
}

}
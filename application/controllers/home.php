<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends HTTP_Controller {

function index()
{
	$this -> _view_data['_head']['title'] = 'Welcome to CodeIgniter';

	$this -> addStyles('style');
	$this -> addJs('core');

	parent::index();
}

}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends HTTP_Controller {

function index()
{
	$this -> _view_data['_head']['title'] = 'Welcome to CodeIgniter';

	$this -> _addStyles('home');
	$this -> _addJs('core');

	parent::index();
}

}

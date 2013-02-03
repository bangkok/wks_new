<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(BASEPATH . 'database/DB' . EXT);

class MY_Router extends CI_Router
{

protected function _getAdditionRoute(){

	if ( !$mdb = DB('', TRUE) ) return array();

	$route = array();
	$parent_id = 1;
	$uri = array_filter(explode('/', $_SERVER["REQUEST_URI"]));

	$query = $mdb -> where_in('link', $uri ? $uri : '/')
		-> where('visible' , 'y')
		//-> where('sitemap' , 'y')
		-> order_by('map.upId' , 'asc')
		-> get('map');

	if ( $row = $query -> row() and $row -> link == reset($uri) and $row -> upId == $parent_id ) {
		$resource = $row -> resource;
		$path = $row -> link;
		$parent_id = $row -> id;

		while ( $row = $query -> next_row() and $row -> link == next($uri) and $row -> upId == $parent_id ) {
			$resource = $row -> resource;
			$path .= '/'.$row -> link;
			$parent_id = $row -> id;
		}

		$route[$path] = $resource;
	}

	return $route;

}

}
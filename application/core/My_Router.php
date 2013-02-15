<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(BASEPATH . 'database/DB' . EXT);

class MY_Router extends CI_Router
{

protected $_node;

protected function _getAdditionRoute(){

	if ( !$mdb = DB('', TRUE) ) return array();

	$route = $map = $path = array();

	$parent_id = 1;

	$uri = array_filter(explode('/', $_SERVER["REQUEST_URI"]));

	$query = $mdb -> where_in('link', $uri ? $uri : '/')
		-> where('visible' , 'y')
		//-> where('sitemap' , 'y')
		-> order_by('upId' , 'asc')
		-> get('map');

	foreach ( $query -> result() as $node ) {

		$map[$node->upId][$node->link] = $node;

	}

	if ( isset($map[$parent_id][reset($uri)]) ) {

		do {

			$node = $map[$parent_id][current($uri)];

			$resource = $node -> resource;

			$path[] = $node -> link;

			$parent_id = $node -> id;

		} while ( isset($map[$parent_id][next($uri)]) );

		if( join('/', $path) != join('/', $uri) ) {

			$path[] = '(:any)';

		}

		$route[join('/', $path)] = $resource;

		$this -> _node = $node;

	}

	return $route;

}

function getNode()
{
	return $this -> _node;
}

}
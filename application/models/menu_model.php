<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model
{

public $TMap;

public $TMenu;

public $table = 'map';

protected $_link_field_name = 'link';

function __construct()
{

	parent::__construct();

	$this -> _init();

}

protected function _init()
{

	$this -> TMap = $this -> _getMap();

	$this -> TMenu = $this -> _getMenu();

}

protected function _getQueryResult($auth = 'y', $sitemap = FALSE, $visible = FALSE)
{
	$table = $this -> table;

	$group = 'guest';

	if ( $auth == 'y' and !empty($this -> data) and !empty($this -> data['auth']['userData']['login']) ) {

		$this -> db -> where('login ', $this -> data['auth']['userData']['login']);

		$query = $this -> db -> get('user_groups');

		if ( $row = $query -> row() ) {

			$group = $row -> group;

		}

	}

	if ( $auth == 'y' ) {

		$this -> db -> join('acl', "acl.resource = $table.resource");

		if ( $group == 'member' ) {

			$this -> db -> where("(acl.group = 'guest' OR acl.group = 'member')");

		} else {

			$this -> db -> where("acl.group", 'guest');
		}
	}

	$visible || $this -> db -> where("$table.visible" , 'y');
	$sitemap || $this -> db -> where("$table.sitemap" , 'y');

	$result = $this -> db -> from($table)
		-> order_by("$table.upId" , 'asc')
		-> order_by("$table.sort" , 'asc')
		-> get() -> result();

	return $result;

}

protected function _getTree($query_result)
{

	foreach ($query_result as $row){

		$Tree['upId'][$row -> id] = $row -> upId;

	}

	foreach ($query_result as $row) {

		$item = &$Tree[$row -> upId][$row -> id];

		$item['child'] = &$Tree[$row->id];

		$item['dom'] = &$Tree[$row->upId];

		if ( isset($Tree['upId'][$row->upId]) ) {

			$item['parent'] = &$Tree[$Tree['upId'][$row->upId]] [$row->upId];

		}

		$this -> _fillTreeItem($item, $row);

	}

	return array_filter($Tree);

}
protected function _fillTreeItem(&$item, $row)
{

	$item['id'] = $row -> id;
	$item['upId'] = $row -> upId;
	$item['name'] = $row -> title;
	$item['resource'] = $row -> resource;
	$item['link'] = '/' . trim($row -> link, '/');
	empty($item['parent']) || $item['link'] = $item['parent']['link'] . $item['link'];
	$item['level'] = !empty($item['parent']) ? $item['parent']['level'] + 1 : 1;

}


protected function _getMap($auth = 'y')
{

	return $this -> _getTree($this -> _getQueryResult($auth, TRUE));

}

protected function _getMenu($id = 0, $auth = 'y')
{

	$TMenu = $this -> _getTree($this -> _getQueryResult($auth));

	return $id ? $TMenu[$id] : $TMenu;

}

function getNodeById($id)
{
	if ( isset($this -> TMap['upId'][$id] ) ) {

		return $this -> TMap [$this -> TMap['upId'][$id]] [$id];
	}

	return NULL;
}

function getNode()
{
	return $this ->  getNodeById($this -> router -> getNode() -> id);
}

function getMenuByParentId($id = 1)
{
	return $this -> TMenu[$id];
}

function getLinePath($name, $id = NULL)
{
	$node = $this -> getNodeById($id ? $id : $this->node->id);

	do {

		$path[] = $node[$name];

	} while ( isset($node['parent']) and $node = $node['parent'] );

	return $path;
}

function getTitlePath()
{
	return array_map('strip_tags', $this -> getLinePath('name'));
}

}
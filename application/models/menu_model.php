<?
class Menu_model extends CI_Model
{

public $TMap;

function __construct()
{
	parent::__construct();

	$this -> TMap = $this -> getMap();

}

function getMap($id = 0, $auth = 'y')
{
	$group = 'guest';

	if ( $auth == 'y' and !empty($this -> data) and !empty($this -> data['auth']['userData']['login']) ) {

		$this -> db -> where('login ', $this -> data['auth']['userData']['login']);

		$query = $this -> db -> get('user_groups');

		if ( $row = $query -> row() ) {

			$group = $row -> group;

		}

	}

	if ( $auth == 'y' ) {

		$this -> db -> join('acl', 'acl.resource = map.resource');

		if ( $group == 'member' ) {

			$this -> db -> where("(acl.group = 'guest' OR acl.group = 'member')");

		} else {

			$this -> db -> where("acl.group", 'guest');
		}
	}

	$result = $this -> db -> from('map')
		-> where("map.visible" , 'y')
		-> where("map.sitemap" , 'y')
		-> order_by("map.upId" , 'asc')
		-> order_by("map.sort" , 'asc')
		-> get() -> result();

	foreach ($result as $row){

		$TMap['upId'][$row -> id] = $row -> upId;

	}

	foreach ($result as $row) {

		$item = &$TMap[$row -> upId][$row -> id];

		$item['id'] = $row -> id;
		$item['upId'] = $row -> upId;
		$item['name'] = $row -> title;
		$item['resource'] = $row -> resource;
		$item['link'] = $row -> link;

		$TMap[$item['upId']][$item['id']] = &$item;

		$item['child'] = &$TMap[$item['id']];

		$item['dom'] = &$TMap[$item['upId']];

		if ( isset($TMap['upId'][$item['upId']]) ) {

			$item['parent'] = &$TMap[$TMap['upId'][$item['upId']]][$item['upId']];

			if ( $item['parent']['link'] != '/' and $item['link'] != '/' ) {

				$item['link'] = $item['parent']['link'] . '/' . $item['link'];

			}

		}

	}

	$TMap = array_filter($TMap);	// Удалить все пустые(NULL) элементы

	return $id ? $TMap[$id] : $TMap;

}

function getNodeById($id)
{
	if ( isset($this -> TMap['upId'][$id] ) ) {

		return $this -> TMap [$this -> TMap['upId'][$id]] [$id];
	}

	return NULL;
}

function getTitlePath()
{
	$node = $this -> getNodeById($this->node->id);

	do {

		$path[] = strip_tags($node['name']);

	} while ( isset($node['parent']) and $node = $node['parent'] );

	return $path;
}

}
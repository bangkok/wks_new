<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH."models/menu_model.php");

class Catalog_model extends Menu_model
{

public $Houses;

public $table = 'houses';


protected function _init()
{

	$this -> Houses = $this -> _getHouses();

}

function getHousesByType($type)
{
	return $this -> Houses[$type];
	//return $result = $this -> _getHouseQueryResult($type);
}


function getHouse($id)
{

	return $this -> Houses[$this -> Houses['upId'][$id]] [$id];

}

protected function _getHouseQueryResult($type)
{
	$result = $this->db-> from($this -> table)
		-> select('houses.*, catalog.title as type, catalog.id as upId, catalog.link')
		-> join('catalog', 'catalog.id = houses.typeId', 'left')
		-> where('catalog.visible', 'y')
		-> where('houses.sleep', 'y')
		//-> where('houses.typeId', $type)
		-> order_by('houses.typeId', 'asc')
		-> get() -> result();

	return $result;

}

protected function _fillTreeItem(&$item, $row)
{
	$item += (array) $row;

	$item = (object) $item;
}


protected function _getHouses()
{

	return  $this -> _getTree($this -> _getHouseQueryResult(0));

}

}
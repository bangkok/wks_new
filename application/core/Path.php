<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Path implements /*Iterator*/  ArrayAccess{

protected $_parent = NULL;

protected $_children = array();

protected $_path = '';


function __construct($path='', Path $parent = NULL)
{
//	if( !empty($parent) and empty($path) ){
//		throw new Exception('error $path = ""');
//	}

	$this -> _parent = $parent;

	$this -> _path = $path;
}


function offsetExists($offset)
{
	return isset($this -> _children[$offset]);
}

function offsetGet($offset)
{
	return strval($this -> _children[$offset]);
}

function offsetSet($offset, $value)
{
	$this -> _children[$offset] = new Path(strval($value), $this);
}

public function offsetUnset($offset)
{
	unset($this -> _children[$offset]);
}


function __get($name)
{
	return $this -> _children[$name];
}

function __set($name, Path $value)
{
	$this -> _children[$name] = $value;
}

function __toString()
{
	return (strval($this -> _parent) ? strval($this -> _parent). '/' : '')
		. strval($this -> _path);
}

function addFolder($name, Path $parent)
{

}

}
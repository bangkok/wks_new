<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Text_model extends CI_Model
{

protected $_text_field = 'text';

function setTextField($text_field)
{
	if ( empty($_text_field) or !is_string($text_field) ) {
		throw new Exception("Could not set value \"$text_field\" in _text_field!");
	}
	$this -> _text_field = $text_field;
}

function getText($id, $table = 'text')
{
	$map_row = $this->db-> from('map')
		-> where('id', $id)
		-> get() -> row();

	$text_row = $this->db-> from($table)
		-> where('link', $map_row -> link)
		-> get() -> row();

	$this -> _fillMapIdByTextRecord($text_row, $table);

	return $text_row -> {$this->_text_field};
}

function getTextByLink($link, $table='text')
{
	$text_row = $this->db-> from($table)
		-> where('link', $link)
		-> get() -> row();

	$this -> _fillMapIdByTextRecord($text_row, $table);

	return $text_row -> {$this->_text_field};
}

protected function _fillMapIdByTextRecord($text_row, $table='text')
{
	if ( $this->db-> field_exists('map_id', $table)
		and !$text_row -> map_id
	) {
		$map_row = $this->db-> from('map')
			-> where('link', $text_row -> link)
			-> where('id', '')
			-> get() -> row();

		if ( $map_row ) {

			$this -> db
				-> where('id', $text_row -> id)
				-> where('map_id', '')
				-> update($table, array('map_id', $map_row->id));
		}

	}
}


}
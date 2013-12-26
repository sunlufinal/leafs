<?php
class Card_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	  *@description get record with ID
	  *@param $id
	  *@return non-empty array if exists, empty array if not exist
	*/
	public function get_with_id($id)
	{
		$query=$this->db->get_where('card',array('id'=>$id,'visibility'=>'1'));
		return $query->row_array();
	}

	/**
	  *@description get information except content with ID
	  *@param $id
	  *@return non-empty array if exists, empty array if not exist
	*/
	public function get_except_content_with_id($id)
	{
		$fields=$this->db->list_fields('card');
		$key=array_search('content',$fields);
		unset($fields[$key]);
		$this->db->select($fields);
		$query=$this->db->get_where('card',array('id'=>$id,'visibility'=>'1'));
		return $query->row_array();
	}

	/**
	  *@description add record
	  *@param $data
	  *@return none
	*/
	public function add($data)
	{
		$this->db->insert('card',$data);
	}
}
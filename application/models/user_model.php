<?php
class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	  *@description check does the record exist with MAC
	  *@param $MAC
	  *@return non-empty array if exists, empty array if not exist
	*/
	public function get_id_with_MAC($MAC)
	{
		$this->db->select(array('id'));
		$query=$this->db->get_where('user',array('MAC'=>$MAC));
		return $query->row_array();
	}

	/**
	  *@description add a record
	  *@param $MAC
	  *@return none
	*/
	public function add($MAC)
	{
		$this->db->insert('user',array('MAC'=>$MAC));
	}

	/**
	  *@description add a record
	  *@param $id, $data
	  *@return none
	*/
	public function update($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('user',$data);
	}
}
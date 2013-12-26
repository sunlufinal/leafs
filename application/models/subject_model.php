<?php
class Subject_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	  *@description get the information of a single subject with respect to the id
	  *@param $id
	  *@return non-empty array if exists, empty array if not exist
	*/
	public function get_with_id($id)
	{
		$query=$this->db->get_where('subject',array('id'=>$id));
		return $query->row_array();
	}

	/**
	  *@description add record
	  *@param $data
	  *@return none
	*/
	public function add($data)
	{
		$this->db->insert('subject',$data);
	}

}
?>
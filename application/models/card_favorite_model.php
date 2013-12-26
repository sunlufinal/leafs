<?php
class Card_favorite_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	  *@description add record
	  *@param $data
	  *@return none
	*/
	public function add($card_id,$user_id)
	{
		$this->db->insert('card_favorite',array('card_id'=>$card_id,'user_id'=>$user_id));
	}

	/**
	  *@description check if a record exists, provided with card_id and user_id
	  *@param $card_id, $user_id
	  *@return true if exists, false if not exist
	*/
	public function does_exist_with_card_id_and_user_id($card_id,$user_id)
	{
		$query=$this->db->get_where('card_favorite',array('card_id'=>$card_id,'user_id'=>$user_id));
		if($query->num_rows()>0)
		{
			return true;
		}
		else{
			return false;
		}
	}
}
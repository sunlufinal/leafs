<?php
class Card_browse_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	  *@description add record
	  *@param $card_id, $user_id
	  *@return none
	*/
	public function add($card_id,$user_id)
	{
		$this->db->insert('card_browse', array('card_id'=>$card_id,'user_id'=>$user_id));
	}

}
<?php
class Card_like extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('card_like_model');
	}

	/**
	  *@description like a card
	  *@param
	  *@return 0 if succeeded
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	  *		  3 for 'already liked'
	*/
	public function like()
	{
		if(!access_control())
			return 2;

		$data = array(
			'card_id' => $this->input->post('card_id'),
			'user_id' => $this->session->userdata('user_id')
		);

		$keys=array_keys($data);
		foreach($keys as $key)
		{
			if($data[$key]===false)
				unset($data[$key]);
		}

		if(count($data)===0){
			return 1;	//no valid data in POST
		}

		$result=$this->card_like_model->does_exist_with_card_id_and_user_id($data['card_id'],$data['user_id']);
		if($result)
			return 3;
		
		$this->card_like_model->add($data['card_id'],$data['user_id']);
		return 0;
	}

	/**
	  *@description unlike a card
	  *@param
	  *@return 0 if succeeded
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	  *		  3 for 'has not liked'
	*/
	public function unlike()
	{
		if(!access_control())
			return 2;

		$data = array(
			'card_id' => $this->input->post('card_id'),
			'user_id' => $this->session->userdata('user_id')
		);

		$keys=array_keys($data);
		foreach($keys as $key)
		{
			if($data[$key]===false)
				unset($data[$key]);
		}

		if(count($data)===0){
			return 1;	//no valid data in POST
		}

		$result=$this->card_like_model->does_exist_with_card_id_and_user_id($data['card_id'],$data['user_id']);
		if(!$result)
			return 3;
		
		$this->card_like_model->delete_logically_with_card_id_and_user_id($data['card_id'],$data['user_id']);
		return 0;
	}

}

?>
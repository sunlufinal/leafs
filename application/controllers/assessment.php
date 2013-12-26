<?php
class Assessment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('assessment_model');
	}

	/**
	  *@description assess a card
	  *@param
	  *@return 0 if succeeded
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	  *		  3 for 'already assessed'
	*/
	public function assess()
	{
		if(!access_control())
			return 2;

		$data = array(
			'score' => $this->input->post('score'),
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

		$result=$this->assessment_model->does_exist_with_card_id_and_user_id($data['card_id'],$data['user_id']);
		if($result)
			return 3;
		
		$this->assessment_model->add($data['score'],$data['card_id'],$data['user_id']);
		return 0;
	}

}

?>
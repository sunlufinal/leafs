<?php
class Card extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('card_model');
	}

	/**
	  *@description get the article information
	  *@param
	  *@return non-empty array if exists, empty array if not exist
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	*/
	public function get_article()
	{
		if(!access_control())
			return 2;

		$data = array(
			'id' => $this->input->post('id')
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

		return $this->card_model->get_with_id($data['id']);
	}

	/**
	  *@description get the article information except the content
	  *@param
	  *@return non-empty array if exists, empty array if not exist
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	*/
	public function get_article_brief()
	{
		if(!access_control())
			return 2;

		$data = array(
			'id' => $this->input->post('id')
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

		return $this->card_model->get_except_content_with_id($data['id']);
	}

	/**
	  *@description add article
	  *@param
	  *@return 0 if succeeded
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	*/
	public function add_article()
	{
		if(!access_control())
			return 2;

		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'add_user_id' => $this->session->userdata('user_id'),
			'format' => $this->input->post('format'),
			'size' => $this->input->post('size'),
			'num_of_words' => $this->input->post('num_of_words'),
			'original_url' => $this->input->post('original_url')
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
		
		$this->card_model->add($data);
		return 0;
	}
	
}
?>
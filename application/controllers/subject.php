<?php
class Subject extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('subject_model');
	}

	/**
	  *@description get the subject information
	  *@param
	  *@return non-empty array if exists, empty array if not exist
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	*/
	public function get_subject()
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

		return $this->subject_model->get_with_id($data['id']);
	}

	/**
	  *@description add subject
	  *@param
	  *@return 0 if succeeded
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	*/
	public function add_subject()
	{
		if(!access_control())
			return 2;

		$data = array(
			'title' => $this->input->post('title'),
			'subject_word' => $this->input->post('subject_word'),
			'description' => $this->input->post('description'),
			'subject_tag_id' => $this->input->post('subject_tag_id'),
			'direct_tag_id' => $this->input->post('direct_tag_id')
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
		
		$this->subject_model->add($data);
		return 0;
	}

}
?>
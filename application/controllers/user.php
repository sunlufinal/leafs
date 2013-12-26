<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	/**
	  *@description update user information
	  *@param
	  *@return 0 if succeeded
	  *@error 1 for 'POST error'
	  *		  2 for 'access error'
	*/
	public function update()
	{
		if(!access_control())
			return 2;

		$data = array(
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email')
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
		
		$user_id=$this->session->userdata('user_id');

		$this->user_model->update($user_id,$data);
		return 0;
	}

}
?>
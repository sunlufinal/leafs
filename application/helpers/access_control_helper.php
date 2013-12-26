<?php

function is_logged_in()
{
	$CI=&get_instance();
	$user_id=$CI->session->userdata('user_id');
	if($user_id===false)
		return false;
	else
		return true;
}

function login($MAC)
{
	$CI=&get_instance();
	$CI->load->model('user_model');
	$result=$CI->user_model->get_id_with_MAC($MAC);
	if(count($result)>0){
		$CI->session->set_userdata('user_id',$result['id']);
		//$CI->user_model->update($result['id'],array('last_login_time'=>"time()"));
		return true;
	}else{
		return false;
	}
}

function register($MAC)
{
	$CI=&get_instance();
	$CI->load->model('user_model');
	$CI->user_model->add($MAC);
}

function access_control()
{
	if(is_logged_in())
		return true;

	$CI=&get_instance();
	$MAC=$CI->input->post('MAC');
	if($MAC===false)
		return false;

	$result=login($MAC);
	if($result===true)
		return true;

	register($MAC);
	login($MAC);
	return true;
}

?>
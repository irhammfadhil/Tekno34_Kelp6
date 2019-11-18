<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->API="http://127.0.0.1/tekno/api_ereport/api"; //local
		// $this->API="http://10.10.122.94/api_ereport/api"; //DELL
		$this->load->library('session');
		$this->load->library('curl');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('V_login');
	}

	public function doLogin()
	{
		$url = current_url();
		$user_email = $this->input->post('user_email');
		$user_password = md5($this->input->post('user_password'));
		$data = array(
			'user_email' 		=> $user_email,
			'user_password'		=> $user_password
		);
		$query = json_decode($this->curl->simple_post($this->API . '/login/userLogin', $data, array(CURLOPT_BUFFERSIZE => 10)));
		if($query->code == "200"){
			//print_r($query->data[0]->user_name);
			$this->session->set_userdata(array(
				'id_user' 		=> $query->data[0]->id_user,
				'user_email' 	=> $query->data[0]->user_email,
				'user_nik' 		=> $query->data[0]->user_nik,
				'user_name' 	=> $query->data[0]->user_name,
				'user_phone' 	=> $query->data[0]->user_phone,
				'id_profile' 	=> $query->data[0]->id_profile,
				'profile_name' 	=> $query->data[0]->profile_name,
				'logged' 		=> TRUE
			));
			redirect('Home');
			$this->session->set_flashdata('pesan', $query->message);

		}
		else{
			$this->session->set_flashdata('pesan', $query->message);
			redirect('Login');
		}
	}

	public function forgotpassword()
	{
		$this->load->view('V_forgotpassword');
	}

	public function doForgot(){
		date_default_timezone_set("Asia/Jakarta");
		$user_email = $this->input->post('user_email');
		$encrypt_newpass = $this->input->post('user_password');

		$data = array(
			'user_email' 		=> $user_email,
			'user_password' 	=> md5($encrypt_newpass),
			'user_modify' 		=> 0,
			'modify_date' 		=> date('Y-m-d H:i:s'),
		);

		//print_r($data);

		$update =  json_decode($this->curl->simple_post($this->API.'/Login/changePassword', $data, array(CURLOPT_BUFFERSIZE => 10)));

		if($update->code == '200'){
			$this->session->set_flashdata('pesan', "<div style='color:green;'>Your password has been successfully changed<div>");
			redirect('Login');
		}else{
			$this->session->set_flashdata('pesan', $update->message);
			redirect('Login/forgotpassword');
		}
	}

	public function logout(){
		//$this->M_login->logout_token($this->session->userdata('id_emp'));
		$this->session->sess_destroy();
		redirect('Login');
	}

}
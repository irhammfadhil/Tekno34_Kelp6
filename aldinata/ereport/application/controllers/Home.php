<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		
		if ($this->session->userdata['logged'] == FALSE){
			redirect('Login');
		}
	}

	public function index()
	{
		$this->load->view('V_header');
		$this->load->view('V_home');
		$this->load->view('V_footer');
	}

}
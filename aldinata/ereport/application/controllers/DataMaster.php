<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMaster extends CI_Controller {

	var $API ="";

	function __construct(){
		parent::__construct();
		$this->API="http://127.0.0.1/tekno/api_ereport/api"; //local
		// $this->API="http://10.10.122.94/api_ereport/api"; //DELL
		$this->load->library('session');
		$this->load->library('curl');
		$this->load->helper('form');
		$this->load->helper('url');
		
		if ($this->session->userdata['logged'] == FALSE){
			redirect('Login');
		}
	}

//checkpass
	public function checkpass(){
		$pass       	= $this->input->post('pass');
		$password   	= md5($pass);

		$id			= $this->input->post('id');
		$check     	= $this->UserModel->checkpass($password, $id);
		if($check > 0){
			echo 'same';
		} else {
			echo 'diff';
		}
	}
//end checkpass

//start Users
	public function DataMasterUsers()
	{
		$data['list_user'] 	= json_decode($this->curl->simple_get($this->API.'/User/listuser'));
		$this->load->view('V_header');
		$this->load->view('V_data_master_users', $data);
		$this->load->view('V_footer');
	}


	public function AddUser()
	{
		$data['list_profile'] = json_decode($this->curl->simple_get($this->API.'/User/listprofile'));
		$this->load->view('V_header');
		$this->load->view('V_data_master_users_add',$data);
		$this->load->view('V_footer');
	}

	public function addedUser()
	{
		$data = array(
			'user_name' 		=> addslashes($this->input->post('user_name')),
			'user_email' 		=> addslashes($this->input->post('user_email')),
			'user_nik' 			=> addslashes($this->input->post('user_nik')),
			'user_phone'		=> addslashes($this->input->post('user_phone')),
			'user_password' 	=> addslashes($this->input->post('user_password')),
			'id_profile' 		=> addslashes($this->input->post('id_profile')),
			'user_created' 		=> addslashes($this->input->post('user_created')),
		);
		$insert =  $this->curl->simple_post($this->API.'/User/addUser', $data); 
		$a = json_decode($insert);
		if($a->code == "400"){
			$this->session->set_flashdata('pesan', $a->message);
			redirect('DataMaster/DataMasterUsers');
		}
		else{
			$this->session->set_flashdata('pesan', $a->message);
			redirect('DataMaster/DataMasterUsers');
		}
	}

	public function editUser()
	{
		$id_user = $this->uri->segment(3);
		$data['user'] 	= json_decode($this->curl->simple_get($this->API.'/User/listuser?id_user='.$id_user.''));
		$data['list_profile'] = json_decode($this->curl->simple_get($this->API.'/User/listprofile'));
		$this->load->view('V_header');
		$this->load->view('V_data_master_users_edit', $data);
		$this->load->view('V_footer');
	}

	function editedUser(){
		date_default_timezone_set("Asia/Jakarta");
		$id_user = $this->input->post('id_user');
		$checkpass = $this->input->post('checkchange');
		$encrypt_newpass = $this->input->post('user_password');

		if ($checkpass == 1) {
			$data = array(
				'id_user'			=> $id_user,
				'user_name' 		=> addslashes($this->input->post('user_name')),
				'user_email' 		=> addslashes($this->input->post('user_email')),
				'user_nik' 			=> addslashes($this->input->post('user_nik')),
				'user_phone'		=> addslashes($this->input->post('user_phone')),			
				'id_profile' 		=> addslashes($this->input->post('id_profile')),
				'user_modify' 		=> addslashes($this->input->post('user_modify')),
				'modify_date' 		=> date('Y-m-d H:i:s'),
				'user_password' 	=> md5($encrypt_newpass),	
			);
		}else {
			$data = array(
				'id_user'			=> $id_user,
				'user_name' 		=> addslashes($this->input->post('user_name')),
				'user_email' 		=> addslashes($this->input->post('user_email')),
				'user_nik' 			=> addslashes($this->input->post('user_nik')),
				'user_phone'		=> addslashes($this->input->post('user_phone')),			
				'id_profile' 		=> addslashes($this->input->post('id_profile')),
				'user_modify' 		=> addslashes($this->input->post('user_modify')),
				'modify_date' 		=> date('Y-m-d H:i:s'),
				'user_password' 	=> addslashes($this->input->post('user_password_old')),	
			);
		}


		$update =  json_decode($this->curl->simple_post($this->API.'/User/edituser', $data, array(CURLOPT_BUFFERSIZE => 10)));
		if($update->code == '200'){
			$this->session->set_flashdata('pesan', $update->message);
			redirect('DataMaster/DataMasterUsers');
		}else{
			$this->session->set_flashdata('pesan', $update->message);
			redirect('DataMaster/DataMasterUsers');
		}
	}


	public function delUser()
	{
		$url = current_url();
		$id = $this->input->post('id_user');
		$data = array(
			'id_user' 		=> $id,

		);
		$query = json_decode($this->curl->simple_post($this->API . '/User/deleteUser', $data, array(CURLOPT_BUFFERSIZE => 10)));
		if($query->code == "200"){
			$this->session->set_flashdata('pesan', $query->message);
			redirect('DataMaster/DataMasterUsers');
		}
		else{
			$this->session->set_flashdata('pesan', $query->message);
			redirect('DataMaster/DataMasterUsers');
		}
	}

//End Users
//Start Role
	// public function DataMasterRole()
	// {
	// 	$this->load->view('V_header');
	// 	$this->load->view('V_data_master_role');
	// 	$this->load->view('V_footer');
	//}
//End Role
//Start Customers
	public function DataMasterCustomers()
	{
		$data['list_cust'] 	= json_decode($this->curl->simple_get($this->API.'/Customer/listcustomer'));
		$this->load->view('V_header');
		$this->load->view('V_data_master_customers', $data);
		$this->load->view('V_footer');
	}

	public function AddCustomers()
	{
		$this->load->view('V_header');
		$this->load->view('V_data_master_customers_add');
		$this->load->view('V_footer');
	}


	public function addedCustomers()
	{
		if(!empty($_FILES['customer_logo']['name'])){	
			$config['upload_path'] = realpath(APPPATH . '../assets/customer');
			$config['allowed_types'] 	= 'jpg|png|JPG|PNG|jpeg|JPEG';
			$config['remove_spaces'] 	= TRUE;
			$config['max_size']             = 10265;
			$config['encrypt_name']			= TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('customer_logo')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('failed', 'Failed upload');
				redirect('DataMaster/DataMasterCustomers');
			}else{
				$upload_data = $this->upload->data();
				$filename = $upload_data['raw_name'].$upload_data['file_ext'];
				$data = array(
					'customer_name' 		=> addslashes($this->input->post('customer_name')),
					'customer_email' 		=> addslashes($this->input->post('customer_email')),
					'customer_phone'		=> addslashes($this->input->post('customer_phone')),
					'customer_fax' 			=> addslashes($this->input->post('customer_fax')),
					'customer_addr' 		=> addslashes($this->input->post('customer_addr')),
					'customer_logo' 		=> $filename,
				);
				$insert =  $this->curl->simple_post($this->API.'/Customer/addcustomer', $data); 
				$a = json_decode($insert);
				if($a->code == "200"){
					$this->session->set_flashdata('pesan', $a->message);
					redirect('DataMaster/DataMasterCustomers');
				}
				else{
					$this->session->set_flashdata('failed', $a->message);
					redirect('DataMaster/DataMasterCustomers');
				}
			}
		}else{
			$data = array(
				'customer_name' 		=> addslashes($this->input->post('customer_name')),
				'customer_email' 		=> addslashes($this->input->post('customer_email')),
				'customer_phone'		=> addslashes($this->input->post('customer_phone')),
				'customer_fax' 			=> addslashes($this->input->post('customer_fax')),
				'customer_addr' 		=> addslashes($this->input->post('customer_addr')),
				'customer_logo' 		=> 'noimage.png',
			);
			$insert =  $this->curl->simple_post($this->API.'/Customer/addcustomer', $data); 
			$a = json_decode($insert);
			if($a->code == "400"){
				$this->session->set_flashdata('pesan', $a->message);
				redirect('DataMaster/DataMasterCustomers');
			}
			else{
				$this->session->set_flashdata('failed', $a->message);
				redirect('DataMaster/DataMasterCustomers');
			}
		}
	}


	public function delCustomer()
	{
		$url = current_url();
		$id = $this->input->post('id_customer');
		$data = array(
			'id_customer' 		=> $id,

		);
		$query = json_decode($this->curl->simple_post($this->API . '/customer/deleteCustomer', $data, array(CURLOPT_BUFFERSIZE => 10)));
		if($query->code == "200"){
			$this->session->set_flashdata('pesan', $query->message);
			redirect('DataMaster/DataMasterCustomers');
		}
		else{
			$this->session->set_flashdata('pesan', $query->message);
			redirect('DataMaster/DataMasterCustomers');
		}
	}

	public function editCustomer()
	{
		$id_customer = $this->uri->segment(3);
		$data['customer'] 	= json_decode($this->curl->simple_get($this->API.'/Customer/listcustomer?id_customer='.$id_customer.''));
		$this->load->view('V_header');
		$this->load->view('V_data_master_customers_edit', $data);
		$this->load->view('V_footer');
		// print_r($data);
	}


	function editedCustomers(){
		$id_customer = $this->input->post('id_customer');
		if(!empty($_FILES['customer_logo']['name'])){	
			$this->load->library('upload');
			$config['upload_path'] = realpath(APPPATH . '../assets/customer');
			$config['allowed_types'] 	= 'jpg|png|JPG|PNG|jpeg|JPEG';
			$config['remove_spaces'] 	= TRUE;
			$config['max_size']             = 10265;
			$config['encrypt_name']			= TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('customer_logo')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('hasil', 'Gagal Upload');
				redirect('Transaksi/biaya');
			}else{
				if (!$this->upload->do_upload('customer_logo')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('failed', 'Failed upload');
					redirect('DataMaster/DataMasterCustomers');
				}else{
					$upload_data = $this->upload->data();
					$filename = $upload_data['raw_name'].$upload_data['file_ext'];
					$data = array(
						'id_customer'			=> $id_customer,
						'customer_name' 		=> addslashes($this->input->post('customer_name')),
						'customer_email' 		=> addslashes($this->input->post('customer_email')),
						'customer_phone'		=> addslashes($this->input->post('customer_phone')),
						'customer_fax' 			=> addslashes($this->input->post('customer_fax')),
						'customer_addr' 		=> addslashes($this->input->post('customer_addr')),
						'customer_logo' 		=> $filename,
					);
					$update =  json_decode($this->curl->simple_post($this->API.'/customer/editcustomer', $data, array(CURLOPT_BUFFERSIZE => 10)));
					if($update->code == '200'){
						$this->session->set_flashdata('pesan', $update->message);
						redirect('DataMaster/DataMasterCustomers');
					}else{
						$this->session->set_flashdata('pesan', $update->message);
						redirect('DataMaster/DataMasterCustomers');
					}
				}
			}
		}else{
			$data = array(
				'id_customer'			=> $id_customer,
				'customer_name' 		=> addslashes($this->input->post('customer_name')),
				'customer_email' 		=> addslashes($this->input->post('customer_email')),
				'customer_phone'		=> addslashes($this->input->post('customer_phone')),
				'customer_fax' 			=> addslashes($this->input->post('customer_fax')),
				'customer_addr' 		=> addslashes($this->input->post('customer_addr')),

			);
			$update =  json_decode($this->curl->simple_post($this->API.'/customer/editcustomer', $data, array(CURLOPT_BUFFERSIZE => 10)));
			if($update->code == '200'){
				$this->session->set_flashdata('pesan', $update->message);
				redirect('DataMaster/DataMasterCustomers');
			}else{
				$this->session->set_flashdata('pesan', $update->message);
				redirect('DataMaster/DataMasterCustomers');
			}
		}
	}

}
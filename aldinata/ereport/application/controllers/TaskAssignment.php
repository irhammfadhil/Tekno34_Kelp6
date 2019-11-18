<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskAssignment extends CI_Controller {

	var $API ="";

	function __construct(){
		parent::__construct();
		$this->API="http://127.0.0.1/tekno/api_ereport/api"; //local
		// $this->API="http://10.10.122.94/api_ereport/api"; //DELL
		//$this->API="http://localhost:8012/api_ereport/api";
		$this->load->library('session');
		$this->load->library('curl');
		$this->load->helper('form');
		$this->load->helper('url');
		
		if ($this->session->userdata['logged'] == FALSE){
			redirect('Login');
		}
		
	}

	public function index()
	{
		$data['list_assignment'] 	= json_decode($this->curl->simple_get($this->API.'/Task/listTask'));
		$this->load->view('V_header');
		$this->load->view('V_task_assignment', $data);
		$this->load->view('V_footer');
	}


	public function TaskAssignmentAdd()
	{
		$data['list_customer'] 	= json_decode($this->curl->simple_get($this->API.'/Task/listCustomer'));
		$data['list_user'] 		= json_decode($this->curl->simple_get($this->API.'/Task/listUser'));
		$this->load->view('V_header');
		$this->load->view('V_task_assignment_add', $data);
		$this->load->view('V_footer');
		//print_r($data);
	}
	
	public function addedTask()
	{
		$data = array(
			'id_customer' 		=> addslashes($this->input->post('id_customer')),
			'id_user'			=> addslashes($this->input->post('id_user')),
			'due_date'			=> addslashes($this->input->post('due_date')),
		);
		$insert =  $this->curl->simple_post($this->API.'/Task/addTask', $data); 
		$a = json_decode($insert);
		if($a->code == "400"){
			$this->session->set_flashdata('pesan', $a->message);
			redirect('TaskAssignment');
		}
		else{
			$this->session->set_flashdata('pesan', $a->message);
			redirect('TaskAssignment');
		}
	}

	public function editTask()
	{
		$id_assignment = $this->uri->segment(3);
		$data['assignment'] 	= json_decode($this->curl->simple_get($this->API.'/Task/listTask?id_task='.$id_assignment.''));
		$data['list_customer'] 	= json_decode($this->curl->simple_get($this->API.'/Task/listCustomer'));
		$data['list_user'] 		= json_decode($this->curl->simple_get($this->API.'/Task/listUser'));
		$this->load->view('V_header');
		$this->load->view('V_task_assignment_edit', $data);
		$this->load->view('V_footer');
		//print_r($data['list_user']);
	}

	function editedTask(){
		$id_assignment = $this->input->post('id_assignment');

		$data = array(
			'id_assignment'			=> $id_assignment,
			'id_customer' 			=> addslashes($this->input->post('id_customer')),
			'id_user' 				=> addslashes($this->input->post('id_user')),
			'due_date'				=> addslashes($this->input->post('due_date')),
		);
		$update =  json_decode($this->curl->simple_post($this->API.'/Task/editTask', $data, array(CURLOPT_BUFFERSIZE => 10)));
		if($update->code == '200'){
			$this->session->set_flashdata('pesan', $update->message);
			redirect('TaskAssignment');
		}else{
			$this->session->set_flashdata('pesan', $update->message);
			redirect('TaskAssignment');
		}
	}


	public function delAssignment()
	{
		$url = current_url();
		$id = $this->input->post('id_assignment');
		$data = array(
			'id_assignment' 		=> $id,

		);
		$query = json_decode($this->curl->simple_post($this->API . '/Task/deleteTask', $data, array(CURLOPT_BUFFERSIZE => 10)));
		if($query->code == "200"){
			$this->session->set_flashdata('pesan', $query->message);
			redirect('TaskAssignment');
		}
		else{
			$this->session->set_flashdata('pesan', $query->message);
			redirect('TaskAssignment');
		}
	}

	public function UploadExcel($value='')
	{

		$path = 'assets/uploadtask/';
		require_once APPPATH . "/third_party/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls';
		$config['remove_spaces'] = TRUE;
		$config['max_size']             = 10265;
		$config['encrypt_name']			= TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('uploadFile')) {
			$error = array('error' => $this->upload->display_errors());

			$this->session->set_flashdata('pesan', $this->upload->display_errors());
			redirect('TaskAssignment');

		} else {
			$data = array('upload_data' => $this->upload->data());
		}

		if(empty($error)){

			if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
			} else {
				$import_xls_file = 0;
			}
			$inputFileName = $path . $import_xls_file;

			try {
				$inputFileType 	= PHPExcel_IOFactory::identify($inputFileName);
				$objReader 			= PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel 		= $objReader->load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$flag 					= true;
				// $i							= 2;
				$rowerr 	= '';


				if ($allDataInSheet[1]['A'] == 'Customer Name ') {

					for ($i=2; $i < (count($allDataInSheet)+1); $i++) {

						$date 					= str_replace('/', '-', $allDataInSheet[$i]['C']);
						$inserdata[$i]['due_date'] = date('Y-m-d', strtotime($date));


						$getcustomer = $this->db->query("
							SELECT * FROM `p_customer` WHERE `customer_name` = '".$allDataInSheet[$i]['A']."' AND `is_active` = 1")->row();



						$getuser = $this->db->query("
							SELECT * FROM p_user WHERE `user_name` = '".$allDataInSheet[$i]['B']."' AND id_profile = 3 AND `is_active` = 1")->row();

						if ($getuser == null || $getcustomer == null) {

							$hasil = 0;

							$rowerr .="<p class='text-danger'>No Data on Row number  ".($i-1)."</p>";	

						}else{

							 $hasil = 1;
							$data   = array(
								'id_customer' 		=> $getcustomer->id_customer,
								'id_user'			=> $getuser->id_user,
								'due_date'			=> $inserdata[$i]['due_date'],

							);

							$insert =  $this->curl->simple_post($this->API.'/Task/addTask', $data); 
							$a = json_decode($insert);

							if ($a->code == "400") {
								$rowerr .="<p class='text-danger'>Duplicated Data on Row number  ".($i-1)."</p>";
							}else if ($a->code == "500") {
								$rowerr .="<p class='text-danger'>Row number ".($i-1)." not inserted</p>";
							}
						}

					}

					if($hasil != 0){
						$this->session->set_flashdata('pesan', "Data Uploaded" . $rowerr );
						redirect('TaskAssignment');
					}
					else{
						$this->session->set_flashdata('pesan', 'Data Uploaded' . $rowerr);
						redirect('TaskAssignment');
					}
				}else{
					$this->session->set_flashdata('pesan', 'Wrong Template');
					redirect('TaskAssignment');
				}

				
			}
			catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' .$e->getMessage());
			}
		}
	}

}
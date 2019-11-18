<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Template extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: token, X-Auth-Token, User-ID, Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Content-Type:application/json");
		header("Accept:application/json");

		$method = $_SERVER['REQUEST_METHOD'];
		if ($method == "OPTIONS") {
			die();
		}

		$this->load->model('Template_Model','model_template');
	}
	
	public function getTemplate_get() {
		$id_template = $this->get('id_template', TRUE);

		if ($id_template != '') {
			$rows = $this->model_template->get_template($id_template);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data template';
				$data['data'] = $rows->result();
				$this->response($data, 200);
			}else {
				$data['code'] = 404;
				$data['message'] = 'Data not found';
				$data['data'] = null;
				$this->response($data, 200);
			}

		}else{
			$id_template = '';
			$rows = $this->model_template->get_template($id_template);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'List template';
				$data['data'] = $rows->result();
				$this->response($data, 200);
			}else {
				$data['code'] = 404;
				$data['message'] = 'Empty template';
				$data['data'] = null;
				$this->response($data, 200);
			}

		}

	}

	public function addreporttest_post($value='')
	{	
		$id_report = $this->post('id_report', TRUE);
		$id_temp_menu =array();
		$id_temp_menu = $this->post('id_temp_menu', TRUE);
		$insight = array();
		$insight = $this->post('insight', TRUE);

		// print_r($insight);

		for ($i=0; $i < count($id_temp_menu); $i++) { 
			$dataPost2 = array(
				'id_report' => $id_report,
				'id_temp_menu' => $id_temp_menu[$i],
				'insight' => $insight[$i]
			);

			if ($insight[$i] != '') {
				print_r($dataPost2);
			}

			
		}
	}

	public function addReport_post()
	{
		$id_assignment = $this->post('id_assignment');
		$id_template = $this->post('id_template');
		$report_title = $this->post('report_title');
		$report_number = $this->post('report_number');
		$agreement_number = $this->post('agreement_number');
		$subject = $this->post('subject');
		$report_periode = $this->post('report_periode');
		// $created_date = $this->post('created_date', TRUE);
		$id_temp_menu =array();
		$id_temp_menu = $this->post('id_temp_menu');
		$insight = array();
		$insight = $this->post('insight');

		$dataPost = array(
			'id_assignment' => $id_assignment,
			'id_template' => $id_template,
			'report_title' => $report_title,
			'report_number' => $report_number,
			'agreement_number' => $agreement_number,
			'subject' => $subject,
			'report_periode' => $report_periode,
			// 'created_date' => $created_date
		);

		// print_r($dataPost);
		
		$result = $this->model_template->saveTemplate($dataPost);
		
		$dataPost1 = array(
			'id_assignmentstatus' => '2'	
		);

		$updateres = $this->model_template->update_assignment($id_assignment, $dataPost1);

		// // $res_report = $this->model_template->get_idreport($id_assignment);
		// // $row = $res_report->result();
		// // $id_report = $row[0]->id_report;
		// // $dataPost2 = array(
		// // 	'id_report' => $id_report,
		// // 	'id_temp_menu' => $id_temp_menu,
		// // 	'insight' => $insight
		// // );
		
		// // $updatedetail = $this->model_template->save_detail($dataPost2);

		for ($ii=0; $ii < count($id_temp_menu); $ii++) { 

			// echo $i;
			$dataPost2 = array(
				'id_report' => $result,
				'id_temp_menu' => '100',
				'insight' => $insight[$ii]
			);

			//print_r($dataPost2);

			// // if ($insight[$i] != '') {
			//print_r($dataPost2);
			$this->db->insert('t_report_detail', $dataPost2);

				// $updatedetail = $this->model_template->save_detail($dataPost2);
			// }
			
		}


		
		// if ($result && $updateres && $updatedetail) {
			// $data['code'] = 200;
			// $data['message'] = 'Success';
			// $this->response($dataPost, 200);
		// }
		// else {
		// 	$data['code'] = 500;
		// 	$data['message'] = 'Failed';
		// 	$this->response($data, 200);
		// }
	}

	public function addReportnew_post($value='')
	{
		$id_assignment 		= $this->post('id_assignment');
		$id_template 		= $this->post('id_template');
		$report_title 		= $this->post('report_title');
		$report_number 		= $this->post('report_number');
		$agreement_number 	= $this->post('agreement_number');
		$subject 			= $this->post('subject');
		$report_periode 	= $this->post('report_periode');
		// $created_date = $this->post('created_date', TRUE);
		$id_menu 		= array();
		$id_menu 		= $this->post('id_menu');

		$insight 			= array();
		$insight 			= $this->post('insight');

		$dataPost = array(
			'id_assignment' 	=> $id_assignment,
			'id_template' 		=> $id_template,
			'report_title' 		=> $report_title,
			'report_number' 	=> $report_number,
			'agreement_number' 	=> $agreement_number,
			'subject' 			=> $subject,
			'report_periode' 	=> $report_periode,
			// 'created_date' => $created_date
		);

		// print_r($dataPost);
		
		$result 	= $this->model_template->saveTemplate($dataPost);
		
		$dataPost1 	= array(
			'id_assignmentstatus' => '2'	
		);

		$updateres = $this->model_template->update_assignment($id_assignment, $dataPost1);

		// // $res_report = $this->model_template->get_idreport($id_assignment);
		// // $row = $res_report->result();
		// // $id_report = $row[0]->id_report;
		// // $dataPost2 = array(
		// // 	'id_report' => $id_report,
		// // 	'id_temp_menu' => $id_temp_menu,
		// // 	'insight' => $insight
		// // );
		
		// // $updatedetail = $this->model_template->save_detail($dataPost2);

		for ($i=0; $i < count($id_menu); $i++) { 

			// echo $i;
			$dataPost2 = array(
				'id_report' 	=> $result,
				'id_menu' 		=> $id_menu[$i],
				'insight'		=> $insight[$i]
			);



			// if ($insight[$i] != '') {

				$this->db->insert('t_report_detail', $dataPost2);
				$updatedetail = $this->db->insert_id();
			//}


			if ($result && $updateres) {
				$data['code'] = 200;
				$data['message'] = 'Success';
				$data['id_report'] = $result;
				$this->response($data, 200);
			}
			else {
				$data['code'] = 500;
				$data['message'] = 'Failed';
				$this->response($data, 200);
			}
			
		}
	}
	

	public function showMenu_get() {
		$id_template = $this->get('id_template', TRUE);
		$id_menu = $this->get('id_menu', TRUE);
		$id_menuparent = $this->get('id_menuparent', TRUE);

		if ($id_template != '') {
			if ($id_menuparent != '') {
				if ($id_menu != '') {
					$rows = $this->model_template->get_menu($id_template,$id_menu,$id_menuparent);
					if ($rows->num_rows() > 0) {
						$data['code'] = 200;
						$data['message'] = 'Data Menu';
						$data['data'] = $rows->result();
						$this->response($data, 200);
					}else {
						$data['code'] = 404;
						$data['message'] = 'Data not found';
						$data['data'] = null;
						$this->response($data, 200);
					}
				}else{
					$id_menu = '';
					$rows = $this->model_template->get_menu($id_template,$id_menu,$id_menuparent);
					if ($rows->num_rows() > 0) {
						$data['code'] = 200;
						$data['message'] = 'Data Menu';
						$data['data'] = $rows->result();
						$this->response($data, 200);
					}else {
						$data['code'] = 404;
						$data['message'] = 'Data not found';
						$data['data'] = null;
						$this->response($data, 200);
					}
				}
			}else{
				$id_menu = '';
				$id_menuparent = '';
				$rows = $this->model_template->get_menu($id_template,$id_menu,$id_menuparent);
				if ($rows->num_rows() > 0) {
					$data['code'] = 200;
					$data['message'] = 'Data Menu';
					$data['data'] = $rows->result();
					$this->response($data, 200);
				}else {
					$data['code'] = 404;
					$data['message'] = 'Data not found';
					$data['data'] = null;
					$this->response($data, 200);
				}

			}
		}else{
			$id_template = '';
			$id_menu = '';
			$id_menuparent = '';
			$rows = $this->model_template->get_menu($id_template,$id_menu,$id_menuparent);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'List Menu';
				$data['data'] = $rows->result();
				$this->response($data, 200);
			}else {
				$data['code'] = 404;
				$data['message'] = 'Empty Menu';
				$data['data'] = null;
				$this->response($data, 200);
			}

		}

	}

	
	public function showAttr_get()
	{
		$id_assignment = $this->get('id_assignment', TRUE);
		$id_menu = $this->get('id_menu', TRUE);

		if ($id_menu != '') {
			$rows = $this->model_template->show_attr($id_assignment,$id_menu);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Request';
				$data['data'] = $rows->result();
				$this->response($data, 200);
			}
			else {
				$data['code'] = 404;
				$data['message'] = 'Data not found';
				$data['data'] = null;
				$this->response($data, 200);
			}
		}else{
			$id_menu = '';
			$rows = $this->model_template->show_attr($id_assignment,$id_menu);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Request';
				$data['data'] = $rows->result();
				$this->response($data, 200);
			}
			else {
				$data['code'] = 404;
				$data['message'] = 'Data not found';
				$data['data'] = null;
				$this->response($data, 200);
			}
		}
	}
	
	public function getMenuin_get()
	{
		$id_assignment = $this->get('id_assignment', TRUE);
		$rows = $this->model_template->get_menuin($id_assignment);
		if ($rows->num_rows() > 0) {
			$data['code'] = 200;
			$data['message'] = 'Data Request';
			$data['data'] = $rows->result();
			$this->response($data, 200);
		}
		else {
			$data['code'] = 404;
			$data['message'] = 'Data not found';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}

	public function getMenu_get($value='')
	{
		$id_template = $this->get('id_template');
		$tempalte =  $this->db->query("SELECT * FROM `p_template` WHERE `id_template` = '".$id_template."'")->result_array();

		// print_r($menuparent);
		$rows = $this->model_template->checkTemplate($id_template);
		if ($rows->num_rows() > 0) {
			for ($i=0; $i < count($tempalte); $i++) { 
				$id_template = $tempalte[$i]['id_template'];
				$template_name = $tempalte[$i]['template_name'];

				$menuparent =  $this->db->query("SELECT id_menu, menu_name FROM v_menuparent WHERE `id_template` = '".$id_template."'")->result_array();


				for ($o=0; $o < count($menuparent); $o++) { 


					$menuparent2 =  
					$this->db->query(
						"SELECT id_menu, menu_name FROM p_menu WHERE `id_menuparent` = '".$menuparent[$o]['id_menu']."'")
					->result_array();


					for ($j=0; $j < count($menuparent2); $j++) { 

						$menuparent3 =  
						$this->db->query(
							"SELECT id_menu, menu_name FROM p_menu WHERE `id_menuparent` = '".$menuparent2[$j]['id_menu']."'")
						->result_array();

						for ($k=0; $k < count($menuparent3); $k++) { 

							$menuparent4 =  
							$this->db->query(
								"SELECT id_menu, menu_name FROM p_menu WHERE `id_menuparent` = '".$menuparent3[$k]['id_menu']."'")
							->result_array();

							$menuparent3[$k]['menu_child'] = $menuparent4;
						}

						$menuparent2[$j]['menu_child'] = $menuparent3;


					}

					$menu1[$o] = array(
						'id_menu' 		=> $menuparent[$o]['id_menu'],
						'menu_name' 	=> $menuparent[$o]['menu_name'],
						'menu_child' 	=> $menuparent2

					);


				}


				$parent = array(
					"id_template"   => $id_template,
					"template_name"	=> $template_name,
					"menu"     		=> $menu1,
				);



			}

			$detail = array($parent);

			$data['code']=200;
			$data['message']='Data Menu Template';
			$data['data']=$detail;
			$this->response($data, 200);   
		}else{
			$data['code'] = 404;
			$data['message'] = 'Data not found';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}

	public function Addfile_post($value='')
	{
		$id_report 		= $this->post('id_report');
		$file_name 		= $this->post('file_name');
		
		$dataPost = array(
			'id_report' 	=> $id_report,
			'file_name' 	=> $file_name,
		);

		$insert = $this->model_template->save_file($dataPost);

		if ($insert) {
			$data['code'] = 200;
			$data['message'] = 'Success';
			$this->response($data, 200);
		}else {
			$data['code'] = 500;
			$data['message'] = 'Failed';
			$this->response($data, 200);
		}
		
	}
	
}
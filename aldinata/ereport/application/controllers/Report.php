<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/autoload.php';
// use PhpOffice\PhpWord\IOFactory;
// use PhpOffice\PhpWord\Settings;
use \ConvertApi\ConvertApi;
require_once APPPATH.'views/classes/CreateDocx.php';


class Report extends CI_Controller {
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

	 public function index()
	 {
	 	$data['list_assignment'] 	= json_decode($this->curl->simple_get($this->API.'/Task/listTaskDone'));
	 	$this->load->view('V_header');
	 	$this->load->view('V_report_list', $data);
	 	$this->load->view('V_footer');
	 }

	 public function TemplateReport()
	 {
	 	$data['list_template'] 	= json_decode($this->curl->simple_get($this->API.'/Template/gettemplate'));
	 	$this->load->view('V_header');
	 	$this->load->view('V_template_report', $data);
	 	$this->load->view('V_footer');
	 }


	 public function Generate()
	 {
	 	$data['list_template'] 	= json_decode($this->curl->simple_get($this->API.'/Template/gettemplate'));
		// $data['list_menu'] 	= json_decode($this->curl->simple_get($this->API.'/Template/showmenu?id_template=1'));
	 	$this->load->view('V_header');
	 	$this->load->view('V_generate_report', $data);
	 	$this->load->view('V_footer');
	 }

	 public function GenMenu($id_customer,$month=null,$year=null) {
	 	$id_template = $this->input->post('id_template');
	 	$data['id_template'] = $id_template;

	 	$data['list_menu'] 		= json_decode($this->curl->simple_get($this->API.'/Template/getMenu?id_template='.$id_template));
	 	$data['humidity'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getslah?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['incident'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getIncident?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['request'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getRequest?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['movement'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getMovement?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['maintenance'] 	= json_decode($this->curl->simple_get($this->API.'/Generate/getMaintenance?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['cm'] 			= json_decode($this->curl->simple_get($this->API.'/Generate/getCM?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['ups_load'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getUpsKva?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['poweravail'] 	= json_decode($this->curl->simple_get($this->API.'/Generate/getpowerav?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['powercon'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getpowercon?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['upstime'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getupstime?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['loglobby'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getloglobby?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['logdacen'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getlogdacen?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['realtemp'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/gettemperature?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['summary']		= json_decode($this->curl->simple_get($this->API.'/Generate/exsummary?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['realhuman'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/gethumidity?id_customer='.$id_customer.'&month='.$month.'&year='.$year));
	 	$data['security'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getsecurity?id_customer='.$id_customer.'&month='.$month.'&year='.$year));

	// ada datanya
	// $data['list_menu'] 	= json_decode($this->curl->simple_get($this->API.'/Template/getMenu?id_template='.$id_template));
	// $data['humidity'] 	= json_decode($this->curl->simple_get($this->API.'/Generate/getslah?id_customer='.$id_customer));
	// $data['incident'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getIncident?id_customer=11'));
	// $data['request'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getRequest?id_customer=23'));
	// $data['movement'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getMovement?id_customer=72'));
	// $data['maintenance'] 	= json_decode($this->curl->simple_get($this->API.'/Generate/getMaintenance?id_customer=49'));
	// $data['cm'] 			= json_decode($this->curl->simple_get($this->API.'/Generate/getCM?id_customer=8'));
	// $data['ups'] 			= json_decode($this->curl->simple_get($this->API.'/Generate/getups?id_customer=5'));
	// $data['poweravail'] 	= json_decode($this->curl->simple_get($this->API.'/Generate/getpowerav?id_customer=49'));
	// $data['powercon'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getpowercon?id_customer=25'));
	// $data['upstime'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getupstime?id_customer=49'));
	// $data['loglobby'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getloglobby?id_customer=18'));
	// $data['logdacen'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getlogdacen?id_customer=18'));
	// $data['realtemp'] 		= json_decode($this->curl->simple_get($this->API.'/Generate/getrealt?id_customer=102'));
	// $data['realhuman'] 		 = json_decode($this->curl->simple_get($this->API.'/Generate/getrealh?id_customer=102'));
	 	$this->load->view('V_genreport',$data);

	 }

	 public function GenMenua($id_customer)
	 {
	 	$id_template = $this->input->post('id_template');

	 	$data['list_menu'] 	= json_decode($this->curl->simple_get($this->API.'/Template/getMenu?id_template='.$id_template));
	 	$data['humidity'] 	= json_decode($this->curl->simple_get($this->API.'/Generate/getslah?id_customer='.$id_customer));

	 	$t = 1;
	 	$a = 1;
	 	$p = 1;
	 	$i = 1;
	 	if ($data['list_menu']->code != 404 ) {
	 		foreach ($data['list_menu']->data as $menu){
	 			foreach ($menu->menu as $child) {
	 				echo '<div class="card">
	 				<div class="card-header" id="heading'.$p++.'">
	 				<h2 class="mb-0">
	 				<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$t++.'" aria-expanded="true" aria-controls="collapseOne">
	 				'.$child->menu_name.'
	 				</button>
	 				</h2>
	 				</div>
	 				<div id="collapse'.$a++.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
	 				<div class="card-body">
	 				<div class="row justify-content-left">
	 				<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
	 				<div class="col-sm-8">
	 				<textarea class="form-control" rows="5" name="insight'.$i++.'"></textarea>
	 				</div>
	 				</div>
	 				<div>
	 				</div>
	 				<br>
	 				<hr>';
	 				foreach ($child->menu_child as $mc ) {
	 					echo '
	 					<div class="card-header" id="heading'.$p++.'">
	 					<h2 class="mb-0">
	 					<button class="btn" type="button" aria-controls="collapseOne" style="color:#007bff;background-color:transparent">
	 					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>'.$mc->menu_name.'</u>
	 					</button>
	 					</h2>
	 					</div>
	 					<div class="row justify-content-left">
	 					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
	 					<div class="col-sm-8">
	 					<br>
	 					<textarea class="form-control" rows="5" name="insight'.$i++.'"></textarea>';
	 					echo $this->table(1);
	 					echo '
	 					</div>
	 					</div>
	 					<br>
	 					<hr>
	 					';
	 					foreach ($mc->menu_child as $mcc ) {
	 						echo '
	 						<div class="card-header" id="heading'.$p++.'">
	 						<h2 class="mb-0">
	 						<button class="btn" type="button" aria-controls="collapseOne" style="color:#007bff;background-color:transparent">
	 						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>'.$mcc->menu_name.'</u>
	 						</button>
	 						</h2>
	 						</div>
	 						<div class="row justify-content-left">
	 						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
	 						<div class="col-sm-8">
	 						<br>
	 						<textarea class="form-control" rows="5" name="insight'.$i++.'"></textarea>';
	 						echo $this->table(2);
						// if ($mcc->id_menu ==61) {
						// 	echo 'haha';
						// };
	 						echo '
	 						</div>
	 						</div>
	 						<br>
	 						<hr>
	 						';
	 					}
	 				}
	 				echo 
	 				'</div>
	 				</div>
	 				</div>
	 				<br>';
	 			}

	 		}
	 	} else {
	 		echo "No Data Avalaible";
	 	}
	// echo json_encode($data);
	 }

// public function table($id) {
// 	$this->load->view('V_table61')
// }

	 public function ReportGenerate()
	 {
	 	$id_assignment = $this->uri->segment(3);
	 	$monthyear = $this->input->post('report_periode');
	 	$report_periode = date('Y/m/d', strtotime($monthyear));

	 	$dataa = array(
	 		'id_assignment'			=> $id_assignment,
	 		'id_template'			=> 1,
	 		'report_title' 			=> addslashes($this->input->post('report_title')),
	 		'report_number' 		=> addslashes($this->input->post('report_number')),
	 		'agreement_number'		=> addslashes($this->input->post('agreement_number')),
	 		'subject'				=> addslashes($this->input->post('subject')),
	 		'report_periode'		=> $report_periode,
	 		'id_menu'				=> $this->input->post('id_menu[]'),
	 		'insight'				=> $this->input->post('insight[]'),
			// 'created_date'			=> date("Y-m-d H:i:s")
	 	);

	 	$update =  json_decode($this->curl->simple_post($this->API.'/Template/addReportnew', $dataa, array(CURLOPT_BUFFERSIZE => 10)));

		//generate report
	 	$data1['data_task'] = json_decode($this->curl->simple_get($this->API.'/Task/listTask?id_task='.$id_assignment.''));
	 	$id_customer = $data1['data_task']->data[0]->id_customer;
	 	$data['report_title'] = $dataa['report_title'];
	 	$data['report_number'] = $dataa['report_number'];
	 	$data['agreement_number'] = $dataa['agreement_number'];
	 	$data['subject'] = $dataa['subject'];
	 	$data['data_temp'] = json_decode($this->curl->simple_get($this->API.'/Generate/gettemperature?id_customer='.$id_customer.'&report_period='.$dataa['report_periode'].''));
	 	$data['data_hum'] = json_decode($this->curl->simple_get($this->API.'/Generate/gethumidity?id_customer='.$id_customer.'&report_period='.$dataa['report_periode'].''));

	 	if($update->code == '200'){
	 		$this->session->set_flashdata('pesan', $update->message);

	 		$a  = array(
	 			'id_template'			=> 1,
	 			'report_periode'		=> addslashes($this->input->post('report_periode')),
	 			'id_report' 			=> $update->id_report,
	 		);

	 		$this->GenerateWord($a);
			// redirect('Report/PreviewReport/'. $id_assignment);
	 	}else{
	 		$this->session->set_flashdata('pesan', $update->message);
	 		redirect('TaskAssignment');
	 	}
	 }

	 public function PreviewReport()
	 {
	 	$id_report = $this->uri->segment(3);
	 	$data['report'] = $this->db->query("SELECT * FROM `p_file` WHERE `id_report` = ".$id_report." AND `is_active` = 1")->result_array();
	 	$this->load->view('V_header');
	 	$this->load->view('V_preview_report', $data);
	 	$this->load->view('V_footer');
	 }

	 public function GenerateWord($a)
	 {
	 	$id_assignment 			= $this->uri->segment(3);
	 	$id_customer 			= $this->uri->segment(4);
	 	$data['cust']       	= json_decode($this->curl->simple_get($this->API.'/Customer/listcustomer?id_customer='.$id_customer));
	 	$data['detail']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment));
	 	$data['menu']       	= json_decode($this->curl->simple_get($this->API.'/Template/getMenu?id_template=1'));
	 	$data['insight1']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=1'));
	 	$data['insight61']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=61'));
	 	$data['insight62']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=62'));
	 	$data['insight63']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=63'));
	 	$data['insight64']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=64'));
	 	$data['insight40']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=40'));
	 	$data['insight41']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=41'));
	 	$data['insight5']    	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=5'));
	 	$data['insight42']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=42'));
	 	$data['insight43']    	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=43'));
	 	$data['insight44']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=44'));
	 	$data['insight7']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=7'));
	 	$data['insight8']     	= json_decode($this->curl->simple_get($this->API.'/Template/showattr?id_assignment='.$id_assignment.'&id_menu=8'));
	 	$month           		= date("F",strtotime($a['report_periode']));
	 	$monthnum         		= date("m",strtotime($a['report_periode']));
	 	$year            		= date("Y",strtotime($a['report_periode']));
	 	$customername       	= str_replace(" ", "", $data['cust']->data[0]->customer_name);
	 	$templatename      	 	= str_replace(" ", "", $data['detail']->data[0]->template_name);
		//menu1
	 	$data['esummary']     	= json_decode($this->curl->simple_get($this->API.'/Generate/exsummary?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['movement']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getmachinem?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['cm']       		= json_decode($this->curl->simple_get($this->API.'/Generate/getCM?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['incident']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getIncident?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['request']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getRequest?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
		//menu2
	 	$data['temperatur']   	= json_decode($this->curl->simple_get($this->API.'/Generate/gettemperature?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['humidity']     	= json_decode($this->curl->simple_get($this->API.'/Generate/gethumidity?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['security']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getsecurity'));
	 	$data['realT']       	= json_decode($this->curl->simple_get($this->API.'/Generate/getrealt?id_customer='.$id_customer));
	 	$data['realH']      	= json_decode($this->curl->simple_get($this->API.'/Generate/getrealh?id_customer='.$id_customer));
	 	$data['slaT']       	= json_decode($this->curl->simple_get($this->API.'/Generate/getslat?id_customer='.$id_customer));
	 	$data['slalH']       	= json_decode($this->curl->simple_get($this->API.'/Generate/getslah?id_customer='.$id_customer));
	 	$data['maintenance']   	= json_decode($this->curl->simple_get($this->API.'/Generate/getMaintenance?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['visitL']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getloglobby?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['visitD']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getlogdacen?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
		//menu3
	 	$data['PowerA']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getpowerav?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['PowerCon']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getpowercon?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['UPSLoad']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getUpsKva?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$data['UPSTime']     	= json_decode($this->curl->simple_get($this->API.'/Generate/getupstime?id_customer='.$id_customer.'&month='.$monthnum.'&year='.$year));
	 	$docx = new CreateDocx();
	 	print_r('OKE<br>');
		// print_r($data['detail']->data[0]->report_number);
	 	print_r('OKE<br>');
	 	// print_r($data['movement']->data);
		// die;

		//CONVERT ROMAN
	 	function integerToRoman($integer){
	 		$integer = intval($integer);
	 		$result = '';
	 		$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 
	 			'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9,
	 			'V' => 5, 'IV' => 4, 'I' => 1
	 		);
	 		foreach($lookup as $roman => $value){
	 			$matches = intval($integer/$value);
	 			$result .= str_repeat($roman,$matches);
	 			$integer = $integer % $value;
	 		}
	 		return $result;
	 	}

		//CONVERT NUM TO MONTH
	 	function numToMonth($integer){
	 		if($integer == 1) return 'January';
	 		if($integer == 2) return 'February';
	 		if($integer == 3) return 'March';
	 		if($integer == 4) return 'April';
	 		if($integer == 5) return 'May';
	 		if($integer == 6) return 'June';
	 		if($integer == 7) return 'July';
	 		if($integer == 8) return 'August';
	 		if($integer == 9) return 'September';
	 		if($integer == 10) return 'October';
	 		if($integer == 11) return 'November';
	 		if($integer == 12) return 'December';
	 	}

		//STYLE
	 	$coverTitle = array(
	 		'textAlign' => 'left',
	 		'fontSize' => 26,
	 		'bold' => true,
	 		'spacingBottom' => 0,
	 		'font' => 'Cambira'
	 	);
	 	$coverReportNumber = array(
	 		'color' => '0000ff',
	 		'textAlign' => 'left',
	 		'fontSize' => 16,
	 		'bold' => true,
	 		'font' => 'Cambira'
	 	);
	 	$coverSubject = array(
	 		'textAlign' => 'left',
	 		'fontSize' => 16,
	 		'spacingBottom' => 0,
	 		'font' => 'Cambira'
	 	);
	 	$coverPeriod = array(
	 		'textAlign' => 'right',
	 		'fontSize' => 24,
	 		'bold' => true,
	 		'position'=> -350,
	 		'font' => 'Cambira' 
	 	);
	 	$coverFooter = array(
	 		'textAlign' => 'center',
	 		'fontSize' => 11,
	 		'spacingBottom' => 0,
	 		'font' => 'Cambira'
	 	);
	 	$headingBAB = array(
	 		'bold' => true,
	 		'fontSize' => 16,
	 		'textAlign' => 'center',
	 		'font' => 'Cambira'
	 	);
	 	$headingSub1BAB = array(
	 		'textAlign' => 'left',
	 		'fontSize' => 14,
	 		'font' => 'Cambira'
	 	);
	 	$headingSub2BAB = array(
	 		'textAlign' => 'left',
	 		'fontSize' => 12,
	 		'bold' => true,
	 		'font' => 'Cambira'
	 	);
	 	$commonText = array(
	 		'textAlign' => 'left',
	 		'fontSize' => 12,
	 		'spacingBottom' => 0,
	 		'font' => 'Cambira'
	 	);
	 	$break = new WordFragment($docx);
	 	$break->addBreak();
	 	$space_5='     ';
		//END STYLE

		//COVER
		////use html, berfungsi
	 	$imgLogo = '<img src="http://10.10.122.94/ereport/assets/img/logo2-color.png" width="280" style="float: left; display: block;"> <br>'; //Dell
	 	// $imgLogo = '<img src="http://118.97.82.223:8181/ereport/assets/img/logo2-color.png" width="280" style="float: left; display: block;"> <br>'; //public
	 	$docx->embedHTML($imgLogo);
	 	$docx->addBreak(array('type' => 'line'));
	 	////use phpdocx, berfungsi
	 	// $imgLogo = array(
	 	// 	'src' => $_SERVER['DOCUMENT_ROOT'].'/ereport/assets/img/logo2-color.png',
	 	// 	'imageAlign' => 'left',
	 	// 	'scaling' => 30,
	 	// 	'textWrap' => 0,
	 	// 	'spacingTop' => 0,
	 	// 	'spacingBottom' => 0
	 	// );
	 	// $docx->addImage($imgLogo);
	 	$docx->addText($data['detail']->data[0]->report_title, $coverTitle);
	 	$docx->addText('No. : '.$data['detail']->data[0]->report_number, $coverReportNumber);
	 	$options = array(
	 		'from' => '0,0',
	 		'to' => '550,0',
	 		'strokecolor' => '#000000',
	 		'strokeweight' => '4',
	 		'position' => 'relative',
	 		'margin-top' => 0,
	 		'margin-bottom' => 0
	 	);
	 	$docx->addShape('line', $options);
	 	$docx->addText('Agreement Number : '.$data['detail']->data[0]->agreement_number, $coverSubject);
	 	$docx->addText('Subject : '.$data['detail']->data[0]->subject, $coverSubject);
	 	$docx->addText('Period : '.$month.', '.$year, $coverPeriod);
	 	////use html, berfungsi
	 	$imgCover = '<img src="http://10.10.122.94/ereport/assets/img/telkomsigma.png" width="300" style="float: right;">'; //Dell
	 	// $imgCover = '<img src="http://118.97.82.223:8181/ereport/assets/img/telkomsigma.png" width="300" style="float: right;">'; //public
	 	$docx->embedHTML($imgCover);
	 	////use phpdocx, berfungsi
	 	// $imgCover = array(\
	 	// 	'src' => $_SERVER['DOCUMENT_ROOT'].'/ereport/assets/img/telkomsigma.png',
	 	// 	'imageAlign' => 'right',
	 	// 	'scaling' => 20,
	 	// 	'textWrap' => 0,
	 	// 	'spacingTop' => 0,
	 	// 	'spacingBottom' => 0
	 	// );
	 	// $docx->addImage($imgCover);
	 	$docx->addBreak(array('type' => 'page'));
		//END COVER

		//HEADER
	 	$textHeader = array(
	 		'fontSize' => 14,
	 		'bold' => true,
	 		'textAlign' => 'right',
	 		'font' => 'Cambira'
	 	);
	 	$headerImage = new WordFragment($docx, 'defaultHeader');
	 	////use html, berfungsi
	 	$imageHeader = '<img src="http://10.10.122.94/ereport/assets/img/telkomsigma.png" width="200" style="float: left;">'; //Dell
	 	// $imageHeader = '<img src="http://118.97.82.223:8181/ereport/assets/img/telkomsigma.png" width="200" style="float: left;">'; //public
	 	$headerImage->embedHTML($imageHeader);
	 	////use phpdocx, berfungsi
	 	// $imageHeader = array (
	 	// 	'src' => $_SERVER['DOCUMENT_ROOT'].'/ereport/assets/img/telkomsigma.png',
	 	// 	'scaling' => 15
	 	// );
	 	// $headerImage->addImage($imageHeader);
	 	$headerText = new WordFragment($docx, 'defaultHeader');
	 	$forHeader = array();
	 	$forHeader[] = array('text' => "Monthly Performance Report");
	 	$forHeader[] = $break;
	 	$forHeader[] = array('text' => $month.', '.$year);
	 	$headerText->addText($forHeader, $textHeader);
	 	$valuesTable = array(
	 		array(
	 			$headerImage,
	 			$headerText
	 		)
	 	);
	 	$paramsTable = array(
	 		'border' => 'nil',
	 		'columnWidths' => array(1000,2500),
	 		'vAlign' => 'center'
	 	);
	 	$headerTable = new WordFragment($docx, 'defaultHeader');
	 	$headerTable->addTable($valuesTable, $paramsTable);
	 	$headerTable->addBreak();
	 	$firstHead = new WordFragment($docx, 'firstHeader');
	 	$docx->addHeader(array('first' => $firstHead, 'default' => $headerTable));
		//END HEADER

		//PAGING
	 	$numbering = new WordFragment($docx, 'defaultFooter');
	 	$textPaging = array(
	 		'textAlign' => 'right',
	 		'bold' => true,
	 		'fontSize' => 12,
	 		'font' => 'Cambira'
	 	);
	 	$numbering->addPageNumber('numerical', $textPaging);
	 	$firstPage = new WordFragment($docx, 'firstFooter');
	 	$firstPage->addText("© 2019 PT Sigma Cipta Caraka.", $coverFooter);
	 	$firstPage->addText("This document is classified as confidential, could be copied for internal purpose only.", $coverFooter);
	 	$docx->addFooter(array('first' => $firstPage, 'default' => $numbering));
		//END PAGING

		//TABLE OF CONTENT
	 	$docx->addText('Daftar Isi', $headingBAB);
	 	$legend = array(
	 		'text' => 'Click here to update the TOC', 
	 		'bold' => true, 
	 		'fontSize' => 12,
	 		'font' => 'Cambira'
	 	);
	 	$docx->addTableContents(array('autoUpdate' => true, 'displayLevels' => '1-6'), $legend);
		//END TABLE OF CONTENT

		//// try for each
	 	$idBAB = 1;
	 	foreach ($data['menu']->data as $themenu) {
	 		foreach ($themenu->menu as $menu1) {
	 			$docx->addBreak(array('type' => 'page'));
	 			$romanIdBAB = integerToRoman($idBAB++);
	 			$docx->addHeading($romanIdBAB.'.   '.$menu1->menu_name, 1, $headingBAB);
    			//eSummary
	 			if ($menu1->id_menu == 1) {
	 				$text = $data['insight1']->data[0]->insight;
 					$docx->addText($text, $commonText);
	 				if ($data['esummary']->code == '200') {
	 					$environmentSummary[] = array();
	 					$environmentSummary[] = array('text'=>'Environment:', 'fontSize'=>12);
	 					$ES_standard[] = array();
	 					$ES_standard[] = array('text'=>'', 'fontSize'=>12);
	 					$ES_thisMonth[] = array();
	 					$ES_thisMonth[] = array('text'=>'', 'fontSize'=>12);
	 					foreach($data['esummary']->Environment as $content){
	 						$environmentSummary[] = $break;
	 						$environmentSummary[] = array('text'=>$space_5.$content->Menu, 'fontSize'=>12);
	 						$ES_standard[] = $break;
	 						$ES_standard[] = array('text'=>$content->Data_Standard, 'fontSize'=>12);
	 						$ES_thisMonth[] = $break;
	 						$ES_thisMonth[] = array('text'=>$content->Performance, 'fontSize'=>12);
	 					}
	 					$securitySummary[] = array();
	 					$securitySummary[] = array('text'=>'Security Device Availability:', 'fontSize'=>12);
	 					$SS_standard[] = array();
	 					$SS_standard[] = array('text'=>'', 'fontSize'=>12);
	 					$SS_thisMonth[] = array();
	 					$SS_thisMonth[] = array('text'=>'', 'fontSize'=>12);
	 					foreach($data['esummary']->Security_Device_Availability as $content){
	 						$securitySummary[] = $break;
	 						$securitySummary[] = array('text'=>$space_5.$content->Menu, 'fontSize'=>12);
	 						$SS_standard[] = $break;
	 						$SS_standard[] = array('text'=>$content->Data_Standard, 'fontSize'=>12);
	 						$SS_thisMonth[] = $break;
	 						$SS_thisMonth[] = array('text'=>$content->Performance, 'fontSize'=>12);
	 					}
	 					$environmentSummary[] = $break;
	 					$securitySummary[] = $break;
	 					$number1 = array(); $number1[] = array('text'=>'1', 'b'=>'on', 'fontSize'=>12);
	 					$number2 = array(); $number2[] = array('text'=>'2', 'b'=>'on', 'fontSize'=>12);
	 					$table11 = new WordFragment($docx); $table11->addText($environmentSummary);
	 					$table12 = new WordFragment($docx); $table12->addText($ES_standard);
	 					$table13 = new WordFragment($docx); $table13->addText($ES_thisMonth);
	 					$table21 = new WordFragment($docx); $table21->addText($securitySummary);
	 					$table22 = new WordFragment($docx); $table22->addText($SS_standard);
	 					$table23 = new WordFragment($docx); $table23->addText($SS_thisMonth);
	 					$headerTableExSum = array(
	 											array('value'=>'No.', 'vAlign'=>center),
	 											array('value'=>'Service Item', 'vAlign'=>center),
	 											array('value'=>'Standard', 'vAlign'=>center),
	 											array('value'=>'This Month Performance', 'vAlign'=>center)
	 										);
	 					$valueRow1ExSum = array(array('value'=>$number1), $table11, $table12, $table13);
	 					$valueRow2ExSum = array(array('value'=>$number2), $table21, $table22, $table23);
	 					$valuesTable = array($headerTableExSum, $valueRow1ExSum, $valueRow2ExSum);
	 					$tableExcutiveSummary = array(
	 						'tableStyle' => 'MediumGrid3-accent5PHPDOCX',
	 						'tableAlign' => 'center',
	 						'tableLayout'=> 'fixed',
	 						'columnWidths' => array(20, 900, 700, 700),
	 						'tableWidth' => array('type' =>'pct', 'value' => 100),
	 						'textProperties' => array('bold' => true, 'fontSize' => 14, 'textAlign' => 'center', 'color' => '000000')
						); //LightListAccent1PHPDOCX, MediumGrid3-accent5PHPDOCX
	 					$docx->addTable($valuesTable, $tableExcutiveSummary);
	 				}
	 			}
    			//machine movement
	 			if ($menu1->id_menu == 5) {
	 				$text = $data['insight5']->data[0]->insight;
 					$docx->addText($text, $commonText);
	 				if ($data['movement']->data != NULL) {
	 					$text1 = array(); $text1[] = array('text'=>'No', 'b'=>'on', 'fontSize'=>8);
	 					$text2 = array(); $text2[] = array('text'=>'Tanggal', 'b'=>'on', 'fontSize'=>8);
	 					$text3 = array(); $text3[] = array('text'=>'Description', 'b'=>'on', 'fontSize'=>8);
	 					$text4 = array(); $text4[] = array('text'=>'S/N', 'b'=>'on', 'fontSize'=>8);
	 					$text5 = array(); $text5[] = array('text'=>'Qty', 'b'=>'on', 'fontSize'=>8);
	 					$text6 = array(); $text6[] = array('text'=>'No.Rack', 'b'=>'on', 'fontSize'=>8);
	 					$text7 = array(); $text7[] = array('text'=>'Power', 'b'=>'on', 'fontSize'=>8);
	 					$text8 = array(); $text8[] = array('text'=>'PIC', 'b'=>'on', 'fontSize'=>8);
	 					$text9 = array(); $text9[] = array('text'=>'Time', 'b'=>'on', 'fontSize'=>8);
	 					$text10 = array(); $text10[] = array('text'=>'Remark', 'b'=>'on', 'fontSize'=>8);
	 					$text11 = array(); $text11[] = array('text'=>'Room', 'b'=>'on', 'fontSize'=>8);
	 					$text12 = array(); $text12[] = array('text'=>'No.Ticket', 'b'=>'on', 'fontSize'=>8);
	 					$data_val = array();
	 					$data_val[] = array(
	 						array('value'=>$text1, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text3, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text4, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text5, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text6, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text7, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text8, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text9, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text10, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text11, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text12, 'backgroundColor'=>'cccccc', 'vAlign'=>'center')
	 					);
	 					$indexNo = 1;
	 					foreach($data['movement']->data as $index => $row){
	 						$data_val[] = array(
	 							array('value'=>$indexNo++, 'vAlign'=>'center'),
	 							array('value'=>date("d-m-Y", strtotime($row->data_date)), 'vAlign'=>'center'),
	 							array('value'=>$row->data_value, 'vAlign'=>'center'),
	 							array('value'=>$row->movement_serialnumber, 'vAlign'=>'center'),
	 							array('value'=>$row->movement_qty, 'vAlign'=>'center'),
	 							array('value'=>$row->movement_rack, 'vAlign'=>'center'),
	 							array('value'=>$row->movement_power, 'vAlign'=>'center'),
	 							array('value'=>$row->movement_pic, 'vAlign'=>'center'),
	 							array('value'=>date("H:i", strtotime($row->movement_time)), 'vAlign'=>'center'),
	 							array('value'=>$row->data_remark, 'vAlign'=>'center'),
	 							array('value'=>$row->movement_room, 'vAlign'=>'center'),
	 							array('value'=>$row->movement_tiket, 'vAlign'=>'center')
	 						);
	 					}
	 					$tableMachineMovement = array(
	 						'tableStyle' => 'TableGridPHPDOCX',
	 						'tableAlign' => 'center',
	 						'tableLayout'=> 'fixed',
	 						'columnWidths' => array(80,260,500,340,100,200,160,260,140,200,340,240),
	 						'tableWidth' => array('type' =>'pct', 'value' => 120),
	 						'textProperties' => array('fontSize' => 8, 'textAlign' => 'center', 'color' => '000000'),
	 						'cellMargin' => 20 
	 					);
	 					$docx->addTable($data_val, $tableMachineMovement);
	 				}
	 				else{
	 					$text = 'Selama Bulan '.$month.' '.$year.', tidak ada machine movement.';
	 					$docx->addText($text, $commonText);
	 				}
	 			}
    			//change management
	 			if ($menu1->id_menu == 7) {
	 				$text = $data['insight7']->data[0]->insight;
 					$docx->addText($text, $commonText);
	 				if ($data['cm']->data != NULL) {
	 					$text1 = array(); $text1[] = array('text'=>'Change ID', 'b'=>'on', 'fontSize'=>10);
	 					$text2 = array(); $text2[] = array('text'=>'Summary', 'b'=>'on', 'fontSize'=>10);
	 					// $text3 = array(); $text3[] = array('text'=>'Class', 'b'=>'on', 'fontSize'=>8);
	 					// $text4 = array(); $text4[] = array('text'=>'Priority', 'b'=>'on', 'fontSize'=>8);
	 					$text5 = array(); $text5[] = array('text'=>'Request Start Date', 'b'=>'on', 'fontSize'=>10);
	 					$text6 = array(); $text6[] = array('text'=>'Request End Date', 'b'=>'on', 'fontSize'=>10);
	 					// $text7 = array(); $text7[] = array('text'=>'Risk Level', 'b'=>'on', 'fontSize'=>8);
	 					// $text8 = array(); $text8[] = array('text'=>'Status', 'b'=>'on', 'fontSize'=>8);
	 					$data_val = array();
	 					$data_val[] = array(
	 						array('value'=>$text1, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						// array('value'=>$text3, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						// array('value'=>$text4, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text5, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text6, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						// array('value'=>$text7, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						// array('value'=>$text8, 'backgroundColor'=>'cccccc', 'vAlign'=>'center')
	 					);
	 					$indexNo = 1;
	 					foreach($data['cm']->data as $index => $row){
	 						$data_val[] = array(
	 							array('value'=>$row->cm_id, 'vAlign'=>'center'),
	 							array('value'=>$row->cm_summary, 'vAlign'=>'center'),
	 							// array('value'=>$row->cm_class, 'vAlign'=>'center'),
	 							// array('value'=>$row->cm_priority, 'vAlign'=>'center'),
	 							array('value'=>date("d-m-Y  H:i:s", strtotime($row->cm_startdate)), 'vAlign'=>'center'),
	 							array('value'=>date("d-m-Y  H:i:s", strtotime($row->cm_enddate)), 'vAlign'=>'center'),
	 							// array('value'=>$row->cm_risklevel, 'vAlign'=>'center'),
	 							// array('value'=>$row->cm_status, 'vAlign'=>'center')
	 						);
	 					}
	 					$tableChangeManagement = array(
	 						'tableStyle' => 'TableGridPHPDOCX',
	 						'tableAlign' => 'center',
	 						'tableLayout'=> 'fixed',
	 						'columnWidths' => array(200,400,200,200), //sesuaikan isi tabelnya
	 						'tableWidth' => array('type' =>'pct', 'value' => 110),
	 						'textProperties' => array('fontSize' => 10, 'textAlign' => 'center', 'color' => '000000'),
	 						'cellMargin' => 50 
	 					);
	 					$docx->addTable($data_val, $tableChangeManagement);
	 				}
	 				else{
	 					$text = 'Selama Bulan '.$month.' '.$year.', tidak ada change management.';
	 					$docx->addText($text, $commonText);
	 				}
	 			}
    			//incident&request
	 			if ($menu1->id_menu == 8) {
	 				$text = $data['insight8']->data[0]->insight;
 					$docx->addText($text, $commonText);
	 				//incident log
	 				$text = 'A.  Incident Log';
 					$docx->addText($text, $headingSub2BAB);
	 				if ($data['incident']->data != NULL) {
	 					$text0 = array(); $text0[] = array('text'=>'No.', 'b'=>'on', 'fontSize'=>8);
	 					$text1 = array(); $text1[] = array('text'=>'Incident ID', 'b'=>'on', 'fontSize'=>8);
	 					$text2 = array(); $text2[] = array('text'=>'Summary', 'b'=>'on', 'fontSize'=>8);
	 					$text3 = array(); $text3[] = array('text'=>'Submit Date', 'b'=>'on', 'fontSize'=>8);
	 					$text4 = array(); $text4[] = array('text'=>'Resolved Date', 'b'=>'on', 'fontSize'=>8);
	 					$text5 = array(); $text5[] = array('text'=>'Duration', 'b'=>'on', 'fontSize'=>8);
	 					$text6 = array(); $text6[] = array('text'=>'Resolution', 'b'=>'on', 'fontSize'=>8);
	 					$text7 = array(); $text7[] = array('text'=>'Status', 'b'=>'on', 'fontSize'=>8);
	 					$text8 = array(); $text8[] = array('text'=>'PIC', 'b'=>'on', 'fontSize'=>8);
	 					$data_val = array();
	 					$data_val[] = array(
	 						array('value'=>$text0, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text1, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text3, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text4, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text5, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text6, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text7, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text8, 'backgroundColor'=>'cccccc', 'vAlign'=>'center')
	 					);
	 					$indexNo = 1;
	 					foreach($data['incident']->data as $index => $row){
	 						$data_val[] = array(
	 							array('value'=>$indexNo++, 'vAlign'=>'center'),
	 							array('value'=>$row->associated_request_id, 'vAlign'=>'center'),
	 							array('value'=>$row->log_summary, 'vAlign'=>'center'),
	 							array('value'=>date("d-m-Y  H:i:s", strtotime($row->submit_date)), 'vAlign'=>'center'),
	 							array('value'=>date("d-m-Y  H:i:s", strtotime($row->resolved_date)), 'vAlign'=>'center'),
	 							array('value'=>$row->duration, 'vAlign'=>'center'),
	 							array('value'=>$row->log_resolution, 'vAlign'=>'center'),
	 							array('value'=>$row->log_status, 'vAlign'=>'center'),
	 							array('value'=>$row->log_pic, 'vAlign'=>'center')
	 						);
	 					}
	 					$tableIncident = array(
	 						'tableStyle' => 'TableGridPHPDOCX',
	 						'tableAlign' => 'center',
	 						'tableLayout'=> 'fixed',
	 						'columnWidths' => array(20,280,400,220,220,180,400,140,180),
	 						'tableWidth' => array('type' =>'pct', 'value' => 120),
	 						'textProperties' => array('fontSize' => 8, 'textAlign' => 'center', 'color' => '000000'),
	 						'cellMargin' => 30 
	 					);
	 					$docx->addTable($data_val, $tableIncident);
	 				}
	 				else{
	 					$text = 'Selama Bulan '.$month.' '.$year.', tidak ada incident Log.';
	 					$docx->addText($text, $commonText);
	 				}
	 				//request log
	 				$docx->addBreak(array('type' => 'line'));
 					$text = 'B.  Request Log';
 					$docx->addText($text, $headingSub2BAB);
	 				if ($data['request']->data != NULL) {
	 					$text0 = array(); $text0[] = array('text'=>'No.', 'b'=>'on', 'fontSize'=>8);
	 					$text1 = array(); $text1[] = array('text'=>'Request ID', 'b'=>'on', 'fontSize'=>8);
	 					$text2 = array(); $text2[] = array('text'=>'Summary', 'b'=>'on', 'fontSize'=>8);
	 					$text3 = array(); $text3[] = array('text'=>'Submit Date', 'b'=>'on', 'fontSize'=>8);
	 					$text4 = array(); $text4[] = array('text'=>'Resolved Date', 'b'=>'on', 'fontSize'=>8);
	 					$text5 = array(); $text5[] = array('text'=>'Duration', 'b'=>'on', 'fontSize'=>8);
	 					$text6 = array(); $text6[] = array('text'=>'Resolution', 'b'=>'on', 'fontSize'=>8);
	 					$text7 = array(); $text7[] = array('text'=>'Status', 'b'=>'on', 'fontSize'=>8);
	 					$text8 = array(); $text8[] = array('text'=>'PIC', 'b'=>'on', 'fontSize'=>8);
	 					$data_val = array();
	 					$data_val[] = array(
	 						array('value'=>$text0, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text1, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text3, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text4, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text5, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text6, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text7, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 						array('value'=>$text8, 'backgroundColor'=>'cccccc', 'vAlign'=>'center')
	 					);
	 					$indexNo = 1;
	 					foreach($data['request']->data as $index => $row){
	 						$data_val[] = array(
	 							array('value'=>$indexNo++, 'vAlign'=>'center'),
	 							array('value'=>$row->associated_request_id, 'vAlign'=>'center'),
	 							array('value'=>$row->log_summary, 'vAlign'=>'center'),
	 							array('value'=>date("d-m-Y  H:i:s", strtotime($row->submit_date)), 'vAlign'=>'center'),
	 							array('value'=>date("d-m-Y  H:i:s", strtotime($row->resolved_date)), 'vAlign'=>'center'),
	 							array('value'=>$row->duration, 'vAlign'=>'center'),
	 							array('value'=>$row->log_resolution, 'vAlign'=>'center'),
	 							array('value'=>$row->log_status, 'vAlign'=>'center'),
	 							array('value'=>$row->log_pic, 'vAlign'=>'center')
	 						);
	 					}
	 					$tableRequest = array(
	 						'tableStyle' => 'TableGridPHPDOCX',
	 						'tableAlign' => 'center',
	 						'tableLayout'=> 'fixed',
	 						'columnWidths' => array(20,280,400,220,220,180,400,140,180),
	 						'tableWidth' => array('type' =>'pct', 'value' => 120),
	 						'textProperties' => array('fontSize' => 8, 'textAlign' => 'center', 'color' => '000000'),
	 						'cellMargin' => 30 
	 					);
	 					$docx->addTable($data_val, $tableRequest);
	 				}
	 				else{
	 					$text = 'Selama Bulan '.$month.' '.$year.', tidak ada request Log.';
	 					$docx->addText($text, $commonText);
	 				}
	 			}
    			//MENU CHILD
	 			if ($menu1->menu_child != NULL) {
	 				$idSub1BAB=1;
	 				foreach ($menu1->menu_child as $menu2) {
	 					if ($menu2->id_menu != 39 && $menu2->id_menu != 42) $docx->addBreak(array('type' => 'page'));
	 					$docx->addHeading($idSub1BAB.'.   '.$menu2->menu_name, 3, $headingSub1BAB);
	 					$idSub1BAB++;
            			//tempperature & humidity
	 					if ($menu2->id_menu == 40) {
	 						$text = $data['insight40']->data[0]->insight;
 							$docx->addText($text, $commonText);
	 						//temperature
	 						if ($data['temperatur']->data != NULL) {
	 							$data_val = array();
	 							$thedata = array();
	 							foreach($data['temperatur']->data as $index => $row){
	 								$date = date('d-F-Y', strtotime($row->data_date));
	 								$data_val[] = array(
	 									'name' => $date,
	 									'values' => array($row->data_value, ($row->min_value-$row->max_value), ($row->min_value+$row->max_value))
	 								);
	 								array_push($thedata, $data_val[$index]);
	 							}
	 							$temp_data = array(
	 								'legend' => array('Temperature','Min_Temp','Max_Temp'),
	 								'data' => $thedata
	 							);
	 							$paramsChart = array(
	 								'title' => 'Tempertaure/Date on '.$month.' '.$year,
									'data' => $temp_data,
									'type' => 'lineChart',
									'border' => '2',
									'chartAlign' => 'center',
									'color' => 2,
									'font' => 'Times New Roman',
									'sizeX' => 17,
									'sizeY' => 12,

									'formatCode'=>'#,##0',
									// 'formatDataLabels'=>array('rotation'=>45, 'position'=>'center'),
									'haxLabel'=>'Date',
									'haxLabelDisplay'=>'horizontal',
									'vaxLabel'=> 'Temperature in ᵒC',
									'vaxLabelDisplay'=>'rotated',
									'hgrid' => '1',
									'vgrid' => '0',
									'majorUnit'=>1.0,
									// 'minorUnit'=>0.5,
									'scalingMax'=>30.0,
									'scalingMin'=>15.0,
									// 'stylesTitle'=>array('bold'=>true, 'color'=>'cccccc', 'font'=>'Cambira', 'fontSize'=>1420, 'italic'=>true),

									'legendOverlay' => false,
									'legendPos' => 'b',
									// 'showCategory' => true,
									// 'showLegendKey' => true,
									// 'showPercent' => true,
									// 'showSeries' => true,
									// 'showValue' => true,
									'showTable' => false,

									// 'smooth'=>true,
									'symbol'=>'diamond',
									'symbolSize'=>6
	 							);
	 							$docx->addChart($paramsChart);
                    			//
	 							$text1 = array(); $text1[] = array('text'=>'Min and Max Temperature', 'b'=>'on', 'fontSize'=>14);
	 							$text2 = array(); $text2[] = array('text'=>'Remarks', 'b'=>'on', 'fontSize'=>14);
	 							$text3 = array(); $text3[] = array('text'=>'Period', 'b'=>'on', 'fontSize'=>14);
	 							$text4 = array(); $text4[] = array('text'=>'Min', 'b'=>'on', 'fontSize'=>14);
	 							$text5 = array(); $text5[] = array('text'=>'Max', 'b'=>'on', 'fontSize'=>14);
	 							$cell_1_1 = array(
	 								'colspan' => 3,
	 								'value' => $text1,
	 								'backgroundColor' => 'cccccc',
	 								'vAlign' => 'center'
	 							);
	 							$cell_1_4 = array(
	 								'rowspan' => 2,
	 								'value' => $text2,
	 								'backgroundColor' => 'cccccc',
	 								'vAlign' => 'center'
	 							);
	 							$data_val = array();
	 							$data_val[] = array($cell_1_1, $cell_1_4);
	 							$data_val[] = array(
	 								array('value' => $text3, 'backgroundColor' => 'cccccc'),
	 								array('value' => $text4, 'backgroundColor' => 'cccccc'),
	 								array('value' => $text5, 'backgroundColor' => 'cccccc')
	 							);
	 							foreach($data['temperatur']->table as $index => $row){
	 								$data_val[] = array($row->Periode, $row->min, $row->max, $row->data_remark);
	 							}
	 							$tableTemp = array(
	 								'tableStyle' => 'TableGridPHPDOCX',
	 								'tableAlign' => 'center',
	 								'tableLayout'=> 'autofit',
	 								'tableWidth' => array('type' =>'pct', 'value' => 80),
	 								'textProperties' => array('fontSize' => 12, 'textAlign' => 'center', 'color' => '000000')
	 							);
	 							$docx->addTable($data_val, $tableTemp);
	 						}
	 						//humidity
	 						if ($data['humidity']->data != NULL) {
	 							$data_val = array();
	 							$thedata = array();
	 							foreach($data['humidity']->data as $index => $row){
	 								$date = date('d-F-Y', strtotime($row->data_date));
	 								$data_val[] = array(
	 									'name' => $date,
	 									'values' => array($row->data_value, ($row->min_value-$row->max_value), ($row->min_value+$row->max_value))
	 								);
	 								array_push($thedata, $data_val[$index]);
	 							}
	 							$hum_data = array(
	 								'legend' => array('Humidity','Min_Hum','Max_Hum'),
	 								'data' => $thedata
	 							);
	 							$paramsChart = array(
	 								'title' => 'Humidity/Date on '.$month.' '.$year,
									'data' => $hum_data,
									'type' => 'lineChart',
									'border' => '2',
									'chartAlign' => 'center',
									'color' => 2,
									'font' => 'Times New Roman',
									'sizeX' => 17,
									'sizeY' => 12,

									'formatCode'=>'#,##0',
									// 'formatDataLabels'=>array('rotation'=>45, 'position'=>'center'),
									'haxLabel'=>'Date',
									'haxLabelDisplay'=>'horizontal',
									'vaxLabel'=> 'Humidity in %RH',
									'vaxLabelDisplay'=>'rotated',
									'hgrid' => '1',
									'vgrid' => '0',
									'majorUnit'=>5.0,
									// 'minorUnit'=>0.5,
									'scalingMax'=>70.0,
									'scalingMin'=>30.0,
									// 'stylesTitle'=>array('bold'=>true, 'color'=>'cccccc', 'font'=>'Cambira', 'fontSize'=>1420, 'italic'=>true),

									'legendOverlay' => false,
									'legendPos' => 'b',
									// 'showCategory' => true,
									// 'showLegendKey' => true,
									// 'showPercent' => true,
									// 'showSeries' => true,
									// 'showValue' => true,
									'showTable' => false,

									// 'smooth'=>true,
									'symbol'=>'diamond',
									'symbolSize'=>6
	 							);
	 							$docx->addChart($paramsChart);
                    			//
	 							$text1 = array(); $text1[] = array('text'=>'Min and Max Humidity', 'b'=>'on', 'fontSize'=>14);
	 							$text2 = array(); $text2[] = array('text'=>'Remarks', 'b'=>'on', 'fontSize'=>14);
	 							$text3 = array(); $text3[] = array('text'=>'Period', 'b'=>'on', 'fontSize'=>14);
	 							$text4 = array(); $text4[] = array('text'=>'Min', 'b'=>'on', 'fontSize'=>14);
	 							$text5 = array(); $text5[] = array('text'=>'Max', 'b'=>'on', 'fontSize'=>14);
	 							$cell_1_1 = array(
	 								'colspan' => 3,
	 								'value' => $text1,
	 								'backgroundColor' => 'cccccc',
	 								'vAlign' => 'center'
	 							);
	 							$cell_1_4 = array(
	 								'rowspan' => 2,
	 								'value' => $text2,
	 								'backgroundColor' => 'cccccc',
	 								'vAlign' => 'center'
	 							);
	 							$data_val = array();
	 							$data_val[] = array($cell_1_1, $cell_1_4);
	 							$data_val[] = array(
	 								array('value' => $text3, 'backgroundColor' => 'cccccc'),
	 								array('value' => $text4, 'backgroundColor' => 'cccccc'),
	 								array('value' => $text5, 'backgroundColor' => 'cccccc')
	 							);
	 							foreach($data['humidity']->table as $index => $row){
	 								$data_val[] = array($row->Periode, $row->min, $row->max, $row->data_remark);
	 							}
	 							$tableHum = array(
	 								'tableStyle' => 'TableGridPHPDOCX',
	 								'tableAlign' => 'center',
	 								'tableLayout'=> 'autofit',
	 								'tableWidth' => array('type' =>'pct', 'value' => 80),
	 								'textProperties' => array('fontSize' => 12, 'textAlign' => 'center', 'color' => '000000')
	 							);
	 							$docx->addTable($data_val, $tableHum);
	 						}
	 						if ($data['temperatur']->data == NULL && $data['humidity']->data == NULL) {
	 							$text = 'Selama Bulan '.$month.' '.$year.', tidak ada temperature & humidity.';
	 							$docx->addText($text, $commonText);
	 						}
	 					}
            			//main sch of DC facilities & 
	 					if ($menu2->id_menu == 41) {
	 						$text = $data['insight41']->data[0]->insight;
 							$docx->addText($text, $commonText);
	 						if ($data['maintenance']->data != NULL) {
	 							$month1 = numToMonth($monthnum-1);
	 							$month2 = numToMonth($monthnum);
	 							$month3 = numToMonth($monthnum+1);
	 							$text1 = array(); $text1[] = array('text'=>'No', 'b'=>'on', 'fontSize'=>11);
	 							$text2 = array(); $text2[] = array('text'=>'Vendor', 'b'=>'on', 'fontSize'=>11);
	 							$text3 = array(); $text3[] = array('text'=>'Perangkat', 'b'=>'on', 'fontSize'=>11);
	 							$text4 = array(); $text4[] = array('text'=>'Bulan', 'b'=>'on', 'fontSize'=>11);
	 							$text5 = array(); $text5[] = array('text'=>$month1, 'b'=>'on', 'fontSize'=>11);
	 							$text6 = array(); $text6[] = array('text'=>$month2, 'b'=>'on', 'fontSize'=>11);
	 							$text7 = array(); $text7[] = array('text'=>$month3, 'b'=>'on', 'fontSize'=>11);
	 							$data_val = array();
	 							$data_val[] = array(
	 								array('value'=>$text1, 'rowspan'=>2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text2, 'rowspan'=>2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text3, 'rowspan'=>2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text4, 'colspan'=>3, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 							);
	 							$data_val[] = array(
	 								array('value'=>$text5, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text6, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text7, 'backgroundColor'=>'cccccc', 'vAlign'=>'center')
	 							);
	 							$indexNo = 1;
	 							foreach($data['maintenance']->data as $index => $row){
	 								$data_val[] = array(
	 									array('value'=>$indexNo++, 'vAlign'=>'center'),
	 									array('value'=>$row->maintenance_vendor, 'vAlign'=>'center'),
	 									array('value'=>$row->maintenance_device, 'vAlign'=>'center'),
	 									array('value'=>$row->monthsprev, 'vAlign'=>'center'),
	 									array('value'=>$row->months, 'vAlign'=>'center'),
	 									array('value'=>$row->monthsnext, 'vAlign'=>'center')
	 								);
	 							}
	 							$tableMaintenance = array(
	 								'tableStyle' => 'TableGridPHPDOCX',
	 								'tableAlign' => 'center',
	 								'tableLayout'=> 'fixed',
	 								'columnWidths' => array(80,800,600,600,600,600),
	 								'textProperties' => array('fontSize' => 9, 'textAlign' => 'center', 'color' => '000000')
	 							);
	 							$docx->addTable($data_val, $tableMaintenance);
	 						}
	 						else{
	 							$text = 'Selama Bulan '.$month.' '.$year.', tidak ada maintenance schedule of data center facilities & infrastructures.';
	 							$docx->addText($text, $commonText);
	 						}
	 					}
            			//Security Device Avaibility
	 					if ($menu2->id_menu == 42) {
	 						$text = $data['insight42']->data[0]->insight;
 							$docx->addText($text, $commonText);
	 						if ($data['security']->data != NULL) {
	 							$text1 = array(); $text1[] = array('text'=>'Device', 'b'=>'on', 'fontSize'=>14);
	 							$text2 = array(); $text2[] = array('text'=>'Availability', 'b'=>'on', 'fontSize'=>14);
	 							$text3 = array(); $text3[] = array('text'=>'Remarks', 'b'=>'on', 'fontSize'=>14);
	 							$data_val = array();
	 							$data_val[] = array(
	 								array('value' => $text1, 'backgroundColor' => 'cccccc'),
	 								array('value' => $text2, 'backgroundColor' => 'cccccc'),
	 								array('value' => $text3, 'backgroundColor' => 'cccccc')
	 							);
	 							foreach($data['security']->data as $index => $row){
	 								$data_val[] = array(
	 									array('value'=>$row->data_name, 'vAlign'=>'center'),
	 									array('value'=>$row->data_value, 'vAlign'=>'center'),
	 									array('value'=>$row->data_remark, 'vAlign'=>'center')
	 								);
	 							}
	 							$tableSecurityDeviceAvail = array(
	 								'tableStyle' => 'TableGridPHPDOCX',
	 								'tableAlign' => 'center',
	 								'tableLayout'=> 'autofit',
	 								'tableWidth' => array('type' =>'pct', 'value' => 75),
	 								'textProperties' => array('fontSize' => 12, 'textAlign' => 'center', 'color' => '000000')
	 							);
	 							$docx->addTable($data_val, $tableSecurityDeviceAvail);
	 						}
	 						else{
	 							$text = 'Selama Bulan '.$month.' '.$year.', tidak ada security device avaibility.';
	 							$docx->addText($text, $commonText);
	 						}
	 					}
            			//visitor log
	 					if ($menu2->id_menu == 43) {
	 						$text = $data['insight43']->data[0]->insight;
 							$docx->addText($text, $commonText);
	 						//visitor log lobby
	 						if ($data['visitL']->data != NULL) {
	 							$text0 = array(); $text0[] = array('text'=>'VISITOR LOG - LOBBY', 'b'=>'on', 'fontSize'=>10);
	 							$text1 = array(); $text1[] = array('text'=>'No', 'b'=>'on', 'fontSize'=>8);
	 							$text2 = array(); $text2[] = array('text'=>'Nama Pengunjung', 'b'=>'on', 'fontSize'=>8);
	 							$text3 = array(); $text3[] = array('text'=>'Perusahaan Asal', 'b'=>'on', 'fontSize'=>8);
	 							$text4 = array(); $text4[] = array('text'=>'Perusahaan Tujuan', 'b'=>'on', 'fontSize'=>8);
	 							$text5 = array(); $text5[] = array('text'=>'Tujuan', 'b'=>'on', 'fontSize'=>8);
	 							$text6 = array(); $text6[] = array('text'=>'Kategori', 'b'=>'on', 'fontSize'=>8);
	 							$text7 = array(); $text7[] = array('text'=>'Pendamping', 'b'=>'on', 'fontSize'=>8);
	 							$text8 = array(); $text8[] = array('text'=>'Lokasi', 'b'=>'on', 'fontSize'=>8);
	 							$text9 = array(); $text9[] = array('text'=>'Waktu Check IN', 'b'=>'on', 'fontSize'=>8);
	 							$text10 = array(); $text10[] = array('text'=>'Waktu Check OUT', 'b'=>'on', 'fontSize'=>8);
	 							$cell_1_1 = array(
	 								'colspan' => 10,
	 								'value' => $text0,
	 								'backgroundColor' => 'cccccc',
	 								'vAlign' => 'center'
	 							);
	 							$data_val = array();
	 							$data_val[] = array($cell_1_1);
	 							$data_val[] = array(
	 								array('value'=>$text1, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text3, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text4, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text5, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text6, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text7, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text8, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text9, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text10, 'backgroundColor'=>'cccccc', 'vAlign'=>'center')
	 							);
	 							$indexNo = 1;
	 							foreach($data['visitL']->data as $index => $row){
	 								$data_val[] = array(
	 									array('value'=>$indexNo++, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_name, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_company, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_to, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_purpose, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_category, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_companion, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_room, 'vAlign'=>'center'),
	 									array('value'=>date("d-m-Y  H:i:s", strtotime($row->visit_checkindate)), 'vAlign'=>'center'),
	 									array('value'=>date("d-m-Y  H:i:s", strtotime($row->visit_checkoutdate)), 'vAlign'=>'center')
	 								);
	 							}
	 							$tableVisitorLogLobby = array(
	 								'tableStyle' => 'TableGridPHPDOCX',
	 								'tableAlign' => 'center',
	 								'tableLayout'=> 'fixed',
	 								'columnWidths' => array(80,300,300,300,460,240,240,240,200,200),
	 								'tableWidth' => array('type' =>'pct', 'value' => 120),
	 								'textProperties' => array('fontSize' => 8, 'textAlign' => 'center', 'color' => '000000'),
	 								'cellMargin' => 20 
	 							);
	 							$docx->addTable($data_val, $tableVisitorLogLobby);
	 						}
	 						//visitor log data center
	 						if ($data['visitD']->data != NULL) {
	 							$text0 = array(); $text0[] = array('text'=>'VISITOR LOG - DATA CENTER', 'b'=>'on', 'fontSize'=>10);
	 							$text1 = array(); $text1[] = array('text'=>'No', 'b'=>'on', 'fontSize'=>8);
	 							$text2 = array(); $text2[] = array('text'=>'Nama Pengunjung', 'b'=>'on', 'fontSize'=>8);
	 							$text3 = array(); $text3[] = array('text'=>'Perusahaan Asal', 'b'=>'on', 'fontSize'=>8);
	 							$text4 = array(); $text4[] = array('text'=>'Perusahaan Tujuan', 'b'=>'on', 'fontSize'=>8);
	 							$text5 = array(); $text5[] = array('text'=>'Tujuan', 'b'=>'on', 'fontSize'=>8);
	 							$text6 = array(); $text6[] = array('text'=>'Kategori', 'b'=>'on', 'fontSize'=>8);
	 							$text7 = array(); $text7[] = array('text'=>'Pendamping', 'b'=>'on', 'fontSize'=>8);
	 							$text8 = array(); $text8[] = array('text'=>'Lokasi', 'b'=>'on', 'fontSize'=>8);
	 							$text9 = array(); $text9[] = array('text'=>'Waktu Check IN', 'b'=>'on', 'fontSize'=>8);
	 							$text10 = array(); $text10[] = array('text'=>'Waktu Check OUT', 'b'=>'on', 'fontSize'=>8);
	 							$cell_1_1 = array(
	 								'colspan' => 10,
	 								'value' => $text0,
	 								'backgroundColor' => 'cccccc',
	 								'vAlign' => 'center'
	 							);
	 							$data_val = array();
	 							$data_val[] = array($cell_1_1);
	 							$data_val[] = array(
	 								array('value'=>$text1, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text2, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text3, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text4, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text5, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text6, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text7, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text8, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text9, 'backgroundColor'=>'cccccc', 'vAlign'=>'center'),
	 								array('value'=>$text10, 'backgroundColor'=>'cccccc', 'vAlign'=>'center')
	 							);
	 							$indexNo = 1;
	 							foreach($data['visitD']->data as $index => $row){
	 								$data_val[] = array(
	 									array('value'=>$indexNo++, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_name, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_company, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_to, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_purpose, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_category, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_companion, 'vAlign'=>'center'),
	 									array('value'=>$row->visit_room, 'vAlign'=>'center'),
	 									array('value'=>date("d-m-Y  H:i:s", strtotime($row->visit_checkindate)), 'vAlign'=>'center'),
	 									array('value'=>date("d-m-Y  H:i:s", strtotime($row->visit_checkoutdate)), 'vAlign'=>'center')
	 								);
	 							}
	 							$tableVisitorLogDacen = array(
	 								'tableStyle' => 'TableGridPHPDOCX',
	 								'tableAlign' => 'center',
	 								'tableLayout'=> 'fixed',
	 								'columnWidths' => array(80,300,300,300,460,240,240,240,200,200),
	 								'tableWidth' => array('type' =>'pct', 'value' => 120),
	 								'textProperties' => array('fontSize' => 8, 'textAlign' => 'center', 'color' => '000000'),
	 								'cellMargin' => 20 
	 							);
	 							$docx->addTable($data_val, $tableVisitorLogDacen);
	 						}
	 						if($data['visitL']->data == NULL && $data['visitD']->data == NULL){
	 							$text = 'Selama Bulan '.$month.' '.$year.', tidak ada visitor log.';
	 							$docx->addText($text, $commonText);
	 						}
	 					}
            			//log access
	 					if ($menu2->id_menu == 44) {
	 						$text = $data['insight44']->data[0]->insight;
 							$docx->addText($text, $commonText);
	 						if (0) {
	 							//belum dapat raw datanya
	 						}
	 						else{
	 							$text = 'Selama Bulan '.$month.' '.$year.', tidak ada log access.';
	 							$docx->addText($text, $commonText);
	 						}
	 					}
            			//MENU CHILD 2
	 					if ($menu2->menu_child != NULL) {
	 						$idSub2BAB=65;
	 						foreach ($menu2->menu_child as $menu3) {
	 							if ($menu3->id_menu != 61) $docx->addBreak(array('type' => 'page'));
	 							$charIdSub2BAB = chr($idSub2BAB);
	 							$docx->addHeading($charIdSub2BAB.'.   '.$menu3->menu_name, 5, $headingSub2BAB);
	 							$idSub2BAB++;
                    			//power availability
	 							if ($menu3->id_menu == 61) {
	 								$text = $data['insight61']->data[0]->insight;
	 								$docx->addText($text, $commonText);
	 								if ($data['PowerA']->data != NULL) {
	 									foreach ($data['PowerA']->data as $index => $row) {
	 										if($row->data_name == 'Description') $Description = $row;
	 										if($row->data_name == 'Downtime') $Downtime = $row;
	 										if($row->data_name == 'Downtime Power This Period (%)') $Downtime_ThisPeriod = $row;
	 										if($row->data_name == 'Duration') $Duration = $row;
	 										if($row->data_name == 'off') $Off = $row;
	 										if($row->data_name == 'on') $On = $row;
	 										if($row->data_name == 'Power Availability 1 Period Before (%)') $PA_1PeriodBefore = $row;
	 										if($row->data_name == 'Power Availability 2 Periods Before (%)') $PA_2PeriodBefore = $row;
	 										if($row->data_name == 'Power Availability This Period (%)') $PA_ThisPeriod = $row;
	 									}//test foreach
	 									$PA_data = array(
	 										'legend' => array('SLA', 'Achievement'),
	 										'data' => array(
	 											array(
	 												'name' => '2 Periods Before',
	 												'values' => array($PA_2PeriodBefore->sla/100, $PA_2PeriodBefore->data_value/100),
	 											),
	 											array(
	 												'name' => '1 Period Before',
	 												'values' => array($PA_1PeriodBefore->sla/100, $PA_1PeriodBefore->data_value/100),
	 											),
	 											array(
	 												'name' => 'This Period',
	 												'values' => array($PA_ThisPeriod->sla/100, $PA_ThisPeriod->data_value/100),
	 											)
	 										)
	 									);
	 									$paramsChart = array(
	 										'title' => 'Power Availability '.$month.' '.$year,
	 										'data' => $PA_data,
	 										'type' => 'lineChart',
	 										'border' => '2',
	 										'chartAlign' => 'center',
	 										'color' => 2,
	 										'font' => 'Times New Roman',
	 										'sizeX' => 15,
	 										'sizeY' => 10,

	 										'formatCode'=>'0.00%',
	 										'formatDataLabels'=>array('rotation'=>2, 'position'=>'insideBase'),
	 										// 'haxLabel'=>'horizontal axis',
	 										// 'haxLabelDisplay'=>'horizontal',
	 										// 'vaxLabel'=>'vertical axis',
	 										// 'vaxLabelDisplay'=>'rotated',
	 										'hgrid' => '1',
	 										'vgrid' => '1',
	 										'majorUnit'=>0.0010,
	 										'minorUnit'=>0.0002,
	 										'scalingMax'=>1.0000,
	 										'scalingMin'=>0.9890,
	 										// 'stylesTitle'=>array('bold'=>true, 'color'=>'cccccc', 'font'=>'Cambira', 'fontSize'=>1420, 'italic'=>true),

	 										'legendOverlay' => false,
	 										'legendPos' => 'b',
	 										// 'showCategory' => true,
	 										// 'showLegendKey' => true,
	 										// 'showPercent' => true,
	 										// 'showSeries' => true,
	 										// 'showValue' => true,
	 										'showTable' => false,

	 										// 'smooth'=>true,
	 										'symbol'=>'circle',
	 										'symbolSize'=>7
	 									);
	 									$docx->addChart($paramsChart);
	 									$cell_1_1 = array(
	 										'colspan' => 4,
	 										'value' => 'Recap of PLN Off & Other Electricity Incidents', 
	 										'backgroundColor' => 'cccccc',
	 										'vAlign' => 'center'
	 									);
	 									$cell_1_5 = array(
	 										'rowspan' => 2,
	 										'value' => 'Description', 
	 										'backgroundColor' => 'cccccc', 
	 										'vAlign' => 'center'
	 									);
	 									$durationHeader = array();
	 									$durationHeader[] = array('text'=>'Duration'); $durationHeader[] = $break;
	 									$durationHeader[] = array('text'=>'(hh:mm:ss)');
	 									$tableDuration = new WordFragment($docx); $tableDuration->addText($durationHeader, array('bold' => true, 'fontSize' => 11, 'textAlign' => 'center', 'color' => '000000'));
	 									$valuesTable = array(
	 										array($cell_1_1, $cell_1_5),
	 										array(
	 											array('value' => 'Off', 'backgroundColor' => 'cccccc', 'vAlign' => 'center'),
	 											array('value' => 'On', 'backgroundColor' => 'cccccc', 'vAlign' => 'center'), 
	 											array('value' => $tableDuration, 'backgroundColor' => 'cccccc', 'vAlign' => 'center'),
	 											array('value' => 'Downtime?', 'backgroundColor' => 'cccccc', 'vAlign' => 'center')
	 										),
	 										array(
	 											$Off->data_value, $On->data_value, $Duration->data_value, $Downtime->data_value, $Description->data_remark
	 										),
	 										array(
	 											array('colspan' => 4, 'value' => $Downtime_ThisPeriod->data_name, 'vAlign' => 'center'),
	 											$Downtime_ThisPeriod->data_value.'%'
	 										),
	 										array(
	 											array('colspan' => 4, 'value' => $PA_ThisPeriod->data_name, 'vAlign' => 'center'),
	 											$PA_ThisPeriod->data_value.'%'
	 										),
	 										array(
	 											array('colspan' => 4, 'value' => $PA_1PeriodBefore->data_name, 'vAlign' => 'center'),
	 											$PA_1PeriodBefore->data_value.'%'
	 										),
	 										array(
	 											array('colspan' => 4, 'value' => $PA_2PeriodBefore->data_name, 'vAlign' => 'center'),
	 											$PA_2PeriodBefore->data_value.'%'
	 										)
	 									);
	 									$tablePowerAvailability = array(
	 										'tableStyle' => 'TableGridPHPDOCX',
	 										'tableAlign' => 'center',
	 										'tableLayout'=> 'autofit',
	 										'textProperties' => array('bold' => true, 'fontSize' => 11, 'textAlign' => 'center', 'color' => '000000')
		                                );//LightListAccent1PHPDOCX, MediumGrid3-accent5PHPDOCX
	 									$docx->addTable($valuesTable, $tablePowerAvailability);
	 								}
	 								else{
	 									$text = 'Selama Bulan '.$month.' '.$year.', tidak ada power availability.';
	 									$docx->addText($text, $commonText);
	 								}
	 							}
                    			//Power Cons
	 							if ($menu3->id_menu == 62) {
	 								$text = $data['insight62']->data[0]->insight;
 									$docx->addText($text, $commonText);
	 								if ($data['PowerCon']->data != NULL) {
	 									$month1 = numToMonth($monthnum-2);
			 							$month2 = numToMonth($monthnum-1);
			 							$month3 = numToMonth($monthnum);
	 									foreach ($data['PowerCon']->data as $index => $row) {
	 										if($row->data_name == 'Max Power Consumption'){
	 											if(date('F', strtotime($row->data_date))==$month1) $month1_PCMax = $row;
	 											if(date('F', strtotime($row->data_date))==$month2) $month2_PCMax = $row;
	 											if(date('F', strtotime($row->data_date))==$month3) $month3_PCMax = $row;
	 										}
	 										if($row->data_name == 'Power Consumption') {
	 											if(date('F', strtotime($row->data_date))==$month1) $month1_PC = $row;
	 											if(date('F', strtotime($row->data_date))==$month2) $month2_PC = $row;
	 											if(date('F', strtotime($row->data_date))==$month3) $month3_PC = $row;
	 										}
	 									}//test foreach
	 									$PC_data = array(
	 										'legend' => array('Max Power Consumption', 'Power Consumption'),
	 										'data' => array(
	 											array(
	 												'name' => $month1,
	 												'values' => array($month1_PCMax->data_value, $month1_PC->data_value) 
	 											),
	 											array(
	 												'name' => $month2,
	 												'values' => array($month2_PCMax->data_value, $month2_PC->data_value) 
	 											),
	 											array(
	 												'name' => $month3,
	 												'values' => array($month3_PCMax->data_value, $month3_PC->data_value) 
	 											)
	 										)
	 									);
	 									$paramsChart = array(
	 										'title' => 'Power Consumption '.$month.' '.$year,
	 										'data' => $PC_data,
	 										'type' => 'lineChart',
	 										'border' => '2',
	 										'chartAlign' => 'center',
	 										'color' => 2,
	 										'font' => 'Times New Roman',
	 										'sizeX' => 15,
	 										'sizeY' => 10,

	 										'formatCode'=>'#,##0',
	 										'formatDataLabels'=>array('rotation'=>0, 'position'=>'center'),
	 										// 'haxLabel'=>'horizontal axis',
	 										// 'haxLabelDisplay'=>'horizontal',
	 										'vaxLabel'=> 'KVA',
	 										'vaxLabelDisplay'=>'rotated',
	 										'hgrid' => '1',
	 										'vgrid' => '1',
	 										'majorUnit'=>5.0,
	 										'minorUnit'=>1.0,
	 										'scalingMax'=>50.0,
	 										'scalingMin'=>0.0,
	 										// 'stylesTitle'=>array('bold'=>true, 'color'=>'cccccc', 'font'=>'Cambira', 'fontSize'=>1420, 'italic'=>true),

	 										'legendOverlay' => false,
	 										'legendPos' => 'b',
	 										// 'showCategory' => true,
	 										// 'showLegendKey' => true,
	 										// 'showPercent' => true,
	 										// 'showSeries' => true,
	 										'showValue' => true,
	 										'showTable' => false,

	 										// 'smooth'=>true,
	 										'symbol'=>'circle',
	 										'symbolSize'=>18
	 									);
	 									$docx->addChart($paramsChart);
	 								}
	 								else{
	 									$text = 'Selama Bulan '.$month.' '.$year.', tidak ada power consumption.';
	 									$docx->addText($text, $commonText);
	 								}
	 							}
                    			//UPS Load
	 							if ($menu3->id_menu == 63) {
	 								$text = $data['insight63']->data[0]->insight;
 									$docx->addText($text, $commonText);
	 								if ($data['UPSLoad']->code == '200') {
	 									$data_val = array();
	 									$thedata = array();
	 									foreach($data['UPSLoad']->ups as $index => $row){
	 										$date = date('d-F-Y', strtotime($row->data_date));
	 										$sysUPS = $row->data_value;
	 										$data_val[] = array(
	 											'name' => $date,
	 											'values' => array($sysUPS, $data['UPSLoad']->kva[$index]->data_value)
	 										);
	 										array_push($thedata, $data_val[$index]);
	 									}
	 									$UPSLoad_data = array(
	 										'legend' => array('System UPS','KVA % Max'),
	 										'data' => $thedata
	 									);
	 									$paramsChart = array(
	 										'title' => 'Performance of UPS Load '.$month.' '.$year,
	 										'data' => $UPSLoad_data,
	 										'type' => 'lineChart',
	 										'border' => '2',
	 										'chartAlign' => 'center',
	 										'color' => 2,
	 										'font' => 'Times New Roman',
	 										'sizeX' => 17,
	 										'sizeY' => 15,

	 										'formatCode'=>'0.00%',
	 										// 'formatDataLabels'=>array('rotation'=>45, 'position'=>'center'),
	 										'haxLabel'=>'Date',
	 										'haxLabelDisplay'=>'horizontal',
	 										'vaxLabel'=> 'Percentage',
	 										'vaxLabelDisplay'=>'rotated',
	 										'hgrid' => '1',
	 										'vgrid' => '0',
	 										'majorUnit'=>0.0500,
	 										'minorUnit'=>0.0010,
	 										'scalingMax'=>1.0000,
	 										'scalingMin'=>0.0000,
	 										// 'stylesTitle'=>array('bold'=>true, 'color'=>'cccccc', 'font'=>'Cambira', 'fontSize'=>1420, 'italic'=>true),

	 										'legendOverlay' => false,
	 										'legendPos' => 'b',
	 										// 'showCategory' => true,
	 										// 'showLegendKey' => true,
	 										// 'showPercent' => true,
	 										// 'showSeries' => true,
	 										// 'showValue' => true,
	 										'showTable' => false,

	 										// 'smooth'=>true,
	 										'symbol'=>'diamond',
	 										'symbolSize'=>6
	 									);
	 									$docx->addChart($paramsChart);
	 								}
	 								else{
	 									$text = 'Selama Bulan '.$month.' '.$year.', tidak ada UPS Load.';
	 									$docx->addText($text, $commonText);
	 								}
	 							}
                    			//UPS Backup Time
	 							if ($menu3->id_menu == 64) {
	 								$text = $data['insight64']->data[0]->insight;
 									$docx->addText($text, $commonText);
	 								if ($data['UPSTime']->data != NULL) {
	 									$data_val = array();
	 									$thedata = array();
	 									foreach($data['UPSTime']->data as $index => $row){
	 										$month = date('F', strtotime($row->data_date));
	 										$hours = date("H", strtotime($row->data_value));
	 										$minute = date("i", strtotime($row->data_value));
	 										// $duration = $hours/24 + $minute/60/24;
	 										$duration = date("H.i", strtotime($row->data_value));
	 										$data_val[] = array(
	 											'name' => $month,
	 											'values' => array($duration)
	 										);
	 										array_push($thedata, $data_val[$index]);
	 									}
	 									$UPSTime_data = array(
	 										'legend' => array('Duration in Hour'),
	 										'data' => $thedata
	 									);
	 									$paramsChart = array(
	 										'title' => 'Performance of UPS Backup Time '.$month.' '.$year,
	 										'data' => $UPSTime_data,
	 										'type' => 'lineChart',
	 										'border' => '2',
	 										'chartAlign' => 'center',
	 										'color' => 2,
	 										'font' => 'Times New Roman',
	 										'sizeX' => 13.5,
	 										'sizeY' => 10,

	 										'formatCode'=>'#,##0.00',
	 										'formatDataLabels'=>array('rotation'=>0, 'position'=>'center'),
	 										// 'haxLabel'=>'Date',
	 										// 'haxLabelDisplay'=>'horizontal',
	 										// 'vaxLabel'=> 'Percentage',
	 										// 'vaxLabelDisplay'=>'rotated',
	 										'hgrid' => '1',
	 										'vgrid' => '1',
	 										'majorUnit'=>'1.0',
	 										// 'minorUnit'=>0.15,
	 										'scalingMax'=>'3.0',
	 										'scalingMin'=>'0.0',
	 										// 'stylesTitle'=>array('bold'=>true, 'color'=>'cccccc', 'font'=>'Cambira', 'fontSize'=>1420, 'italic'=>true),

	 										'legendOverlay' => false,
	 										'legendPos' => 'b',
	 										// 'showCategory' => true,
	 										// 'showLegendKey' => true,
	 										// 'showPercent' => true,
	 										// 'showSeries' => true,
	 										'showValue' => true,
	 										'showTable' => false,

	 										// 'smooth'=>true,
	 										'symbol'=>'circle',
	 										'symbolSize'=>18
	 									);
	 									$docx->addChart($paramsChart);
	 								}
	 								else{
	 									$text = 'Selama Bulan '.$month.' '.$year.', tidak ada UPS Backup Time.';
	 									$docx->addText($text, $commonText);
	 								}
	 							}
	 							// $docx->addBreak();
	 						}
	 					}
	 					// $docx->addBreak();
	 				}
	 			}
	 		}
	 	}
		//// end try for each

	 	$SERVERFILEPATH2 = $_SERVER['DOCUMENT_ROOT'].'/ereport/assets/report/';
	 	$docx->createDocx($SERVERFILEPATH2.$customername.'_'.$templatename.'_'.$month.$year);
	 	$insertfile = array(
	 		'id_report' => $a['id_report'], 
	 		'file_name' => $customername."_".$templatename."_".$month.$year.".docx"
	 	);

	 	$insert =  json_decode($this->curl->simple_post($this->API.'/Template/Addfile', $insertfile, array(CURLOPT_BUFFERSIZE => 10)));

	 	if ($insert->code == 200) {
	 		$this->convertPdf($insertfile);
	 		redirect('Report/PreviewReport/'. $a['id_report']);
	 	}else{
	 		redirect('TaskAssignment');
	 	}
	 }

	 public function convertPdf($insertfile)
	 {
	 	// print_r($insertfile['file_name']);
	 	// $SERVERFILEPATH2 = $_SERVER['DOCUMENT_ROOT'].'/ereport/assets/report/';
	 	// $objReader= \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
	 	// $contents=$objReader->load($SERVERFILEPATH2."KOMINFO_CollocationService_May2019.docx");

	 	// $rendername= \PhpOffice\PhpWord\Settings::PDF_RENDERER_DOMPDF;

	 	// $renderLibrary= $_SERVER['DOCUMENT_ROOT']."/ereport/vendor/dompdf";
	 	// $renderLibraryPath=''.$renderLibrary;
	 	// if(!\PhpOffice\PhpWord\Settings::setPdfRenderer($rendername,$renderLibrary)){
	 	// 	die("Provide Render Library And Path");
	 	// }
	 	// $renderLibraryPath=''.$renderLibrary;
	 	// $objWriter= \PhpOffice\PhpWord\IOFactory::createWriter($contents,'PDF');
	 	// $objWriter->save("KOMINFO_CollocationService_May2019.pdf");
	 	$SERVERFILEPATH2 = $_SERVER['DOCUMENT_ROOT'].'/ereport/assets/report/';
	 	ConvertApi::setApiSecret('TqodCu3sPjG4Cyoq');

	 	$result = ConvertApi::convert('pdf', ['File' => $SERVERFILEPATH2.$insertfile['file_name']]);
	 	$filename = substr($insertfile['file_name'],0,-5);
	 	//print_r($filename);
		# save to file
	 	$result->getFile()->save($SERVERFILEPATH2.$filename.'.pdf');
	 }
	}
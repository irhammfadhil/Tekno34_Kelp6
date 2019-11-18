<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Generate extends REST_Controller {

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

        $this->load->model('Generator_Model', 'model_generator');
    }
	
	public function getTemperature_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_temp($id_customer, $month, $year);
			$rows2 = $this->model_generator->get_tabletemp($id_customer, $month, $year);
			if ($rows->num_rows() > 0 or $rows2->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Temperature';
				$data['data'] = $rows->result();
				$data['table'] = $rows2->result();
				$this->response($data, 200);
			}
			else {
				$data['code'] = 404;
				$data['message'] = 'Data not found';
				$data['data'] = null;
				$this->response($data, 200);
			}
		}else{
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}

	
	public function getHumidity_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_hum($id_customer, $month, $year);
			$rows2 = $this->model_generator->get_tablehum($id_customer, $month, $year);
			if ($rows->num_rows() > 0 or $rows2->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Humidity';
				$data['data'] = $rows->result();
				$data['table'] = $rows2->result();
				$this->response($data, 200);
			}
			else {
				$data['code'] = 404;
				$data['message'] = 'Data not found';
				$data['data'] = null;
				$this->response($data, 200);
			}
		}else{
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}

	
	public function getIncident_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_incident($id_customer, $month, $year);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Incident';
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);		
		}
	}
	
	public function getRequest_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_request($id_customer, $month, $year);
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}
	
	
	public function getMovement_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$rows = $this->model_generator->get_movement($id_customer);
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
	
	public function getMaintenance_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_maintenance($id_customer, $month, $year);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Maintenance';
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}

	
	public function getCM_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->change_management($id_customer, $month, $year);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Change Management';
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}

	public function getUpsKva_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_ups($id_customer, $month, $year);
			$rows2 = $this->model_generator->get_kva($id_customer, $month, $year);
			if ($rows->num_rows() > 0 or $rows2->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data UPS KVA';
				$data['ups'] = $rows->result();
				$data['kva'] = $rows2->result();
				$this->response($data, 200);
			}
			else {
				$data['code'] = 404;
				$data['message'] = 'Data not found';
				$data['data'] = null;
				$this->response($data, 200);
			}
		}else{
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}
	
	public function getUps_get()
	{
		$id_customer = $this->get('id_customer', TRUE);
		$rows = $this->model_generator->get_ups();
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
	
	public function getKva_get()
	{
		$rows = $this->model_generator->get_kva();
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


	
	public function getMachinem_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_machinem($id_customer, $month, $year);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Machine Movement';
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}
	
	public function getPowerav_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_powerav($id_customer, $month, $year);
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
		
	}
	
	public function getPowercon_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_powercon($id_customer, $month, $year);
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}
	
	public function getUpstime_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_upstime($id_customer, $month, $year);
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}
	
	public function getLoglobby_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_loglobby($id_customer, $month, $year);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Visit Lobby';
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);	
		}
	}
	
	public function getLogdacen_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_logdacen($id_customer, $month, $year);
			if ($rows->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Visit Dacen';
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
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);
		}
	}
	
	public function getRealt_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$rows = $this->model_generator->get_realt($id_customer);
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
	
	public function getRealh_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$rows = $this->model_generator->get_realh($id_customer);
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
	
	public function getSLAt_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$rows = $this->model_generator->get_slat($id_customer);
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
	
	public function getSLAh_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$rows = $this->model_generator->get_slah($id_customer);
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
	
	public function getSLAPower_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$rows = $this->model_generator->get_slapower($id_customer);
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

	// 	public function esummary_get()
	// {
	// 	$id_customer=$this->get('id_customer', TRUE);
	// 	$rows = $this->model_generator->get_esummary($id_customer);
	// 	if ($rows->num_rows() > 0) {
	// 		$data['code'] = 200;
	// 		$data['message'] = 'Data Request';
	// 		$data['data'] = $rows->result();
	// 		$this->response($data, 200);
	// 	}
	// 	else {
	// 		$data['code'] = 404;
	// 		$data['message'] = 'Data not found';
	// 		$data['data'] = null;
	// 		$this->response($data, 200);
	// 	}
	// }

	

	public function exsummary_get()
	{
		$id_customer=$this->get('id_customer', TRUE);
		$month=$this->get('month', TRUE);
		$year=$this->get('year', TRUE);

		if ($id_customer != '' AND $month != '' AND $year != '' ) {
			$rows = $this->model_generator->get_exsummary($id_customer, $month, $year);
			$rows2 = $this->model_generator->get_exsumsecurity();
			if ($rows->num_rows() > 0 or $rows2->num_rows() > 0) {
				$data['code'] = 200;
				$data['message'] = 'Data Executive Summary';
				$data['Environment'] = $rows->result();
				$data['Security_Device_Availability'] = $rows2->result();
				$this->response($data, 200);
			}
			else {
				$data['code'] = 404;
				$data['message'] = 'Data not found';
				$data['data'] = null;
				$this->response($data, 200);
			}
		}else{
			$data['code'] = 404;
			$data['message'] = 'ID Customer or Month or Year can not be empty';
			$data['data'] = null;
			$this->response($data, 200);	
		}
		
	}
	
	public function getSecurity_get()
	{
		$rows = $this->model_generator->get_security();
		if ($rows->num_rows() > 0) {
			$data['code'] = 200;
			$data['message'] = 'Data Security Device';
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
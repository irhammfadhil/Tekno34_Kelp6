<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Task extends REST_Controller {

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

        $this->load->model('Task_Model', 'model_task');
    }

    public function listTask_get() {
        $id_task = $this->get('id_task', TRUE);
        $id_profile = $this->get('id_profile', TRUE);
        $id_user = $this->get('id_user', TRUE);

        if ($id_task != '') {
            $rows = $this->model_task->getTask($id_task,$id_profile,$id_user);
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'Data task';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Data not found';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }else{
            $rows = $this->model_task->getTask($id_task,$id_profile,$id_user);
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'List data task';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Empty list data task';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }
        
    }
	

    public function listCustomer_get() {
        $id_customer = $this->get('id_customer', TRUE);

        if ($id_customer != '') {
            $rows = $this->model_task->getCustomer();
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'Data customer';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Data not found';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }else{
            $rows = $this->model_task->getCustomer();
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'List data customer';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Empty list data customer';
                $data['data'] = null;
                $this->response($data, 200);
            }
        }   
    }


    public function listUser_get() {
        $id_user = $this->get('id_user', TRUE);

        if ($id_user != '') {
            $rows = $this->model_task->getUser();
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'Data user';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Data not found';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }else{
            $rows = $this->model_task->getUser();
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'List data user';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Empty list data user';
                $data['data'] = null;
                $this->response($data, 200);
            }
        }   
    }


    public function addTask_post() {
        $id_customer = $this->post('id_customer', TRUE);
        $id_user = $this->post('id_user', TRUE);
        $due_date = $this->post('due_date', TRUE);
        $id_assignmentstatus = $this->post('id_assignmentstatus', TRUE);

        if ($id_customer != '' && $id_user != '' && $due_date != '' ) {

            $checktask = $this->model_task->checkTask($id_customer, $id_user, $due_date)->num_rows();
            if ($checktask > 0) {
                $data['code'] = 400;
                $data['message'] = 'Data already exists';
                $this->response($data, 200);
            }else{
                $dataPost = array(
                    'id_customer' => $id_customer,
                    'id_user' => $id_user,
                    'due_date' => $due_date,
                    'id_assignmentstatus' => '1'
                );

                $result = $this->model_task->saveTask($dataPost);
                if ($result) {
                    $data['code'] = 200;
                    $data['message'] = 'Success saved data task';
                    $this->response($data, 200);
                }else{
                    $data['code'] = 500;
                    $data['message'] = 'Failed saved data task';
                    $this->response($data, 200);
                }
            }

        }else{
            $data['code'] = 404;
            $data['message'] = 'Customer or User can not empty';
            $this->response($data, 200);
        }
    }

    public function editTask_post() {
        $id_assignment = $this->post('id_assignment', TRUE);
        $id_customer = $this->post('id_customer', TRUE);
        $id_user = $this->post('id_user', TRUE);
        $due_date = $this->post('due_date', TRUE);

        if ($id_customer != '' && $id_user != '' && $due_date != '') {

            $checktask = $this->model_task->checkTask($id_customer, $id_user, $due_date)->num_rows();
            if ($checktask > 0) {
                $data['code'] = 400;
                $data['message'] = 'Data already exists';
                $this->response($data, 200);
            }else{

                $dataPost = array(
                    'id_customer' => $id_customer,
                    'id_user' => $id_user,
                    'due_date' => $due_date,
                );

                $result = $this->model_task->updateTask($id_assignment, $dataPost);
                if ($result) {
                    $data['code'] = 200;
                    $data['message'] = 'Success updated data assignment';
                    $this->response($data, 200);
                }else{
                    $data['code'] = 500;
                    $data['message'] = 'Failed updated data assignment';
                    $this->response($data, 200);
                }
            }

        }else{
            $data['code'] = 404;
            $data['message'] = 'Data can not empty';
            $this->response($data, 200);
        }
    }

    public function deleteTask_post() {
        $id_assignment = $this->post('id_assignment', TRUE);

        if ($id_assignment != '') {

            if ($this->model_task->cek_task($id_assignment)->num_rows() > 0) {
                $dataPost = array(
                    'is_active' => '0'
                );

                $result = $this->model_task->updateTask($id_assignment, $dataPost);
                if ($result) {
                    $data['code'] = 200;
                    $data['message'] = 'Success deleted data assignment';
                    $this->response($data, 200);
                }else{
                    $data['code'] = 500;
                    $data['message'] = 'Failed deleted data assignment';
                    $this->response($data, 200);
                }
            }else{
                $data['code'] = 404;
                $data['message'] = 'Data Not Found / Is not Active';
                $this->response($data, 404);
            }

        }else{
            $data['code'] = 404;
            $data['message'] = 'Required Data';
            $this->response($data, 404);
        }                
    }


    public function listTaskDone_get() {
        $id_task = $this->get('id_task', TRUE);
        $id_profile = $this->get('id_profile', TRUE);
        $id_user = $this->get('id_user', TRUE);

        if ($id_task != '') {
            $rows = $this->model_task->getTaskDone($id_task,$id_profile,$id_user);
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'Data task';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Data not found';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }else{
            $rows = $this->model_task->getTaskDone($id_task,$id_profile,$id_user);
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'List data task';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Empty list data task';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }
        
    }
    
}
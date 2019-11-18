<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

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

        $this->load->model('User_Model', 'model_user');
    }

    public function listUser_get() {
        $id_user = $this->get('id_user', TRUE);

        if ($id_user != '') {
            $rows = $this->model_user->getUser($id_user);
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'Data User';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Data not found';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }else{
            $rows = $this->model_user->getUser($id_user);
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

    public function listProfile_get() {
        $id_profile = $this->get('id_profile', TRUE);

        if ($id_profile != '') {
            $rows = $this->model_user->getProfile();
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'Data Profile';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Data not found';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }else{
            $rows = $this->model_user->getProfile();
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'List data profile';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['message'] = 'Empty list data profile';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }
        
    }


    public function addUser_post() {
        $user_email = $this->post('user_email', TRUE);
        $user_nik = $this->post('user_nik', TRUE);
        $user_name = $this->post('user_name', TRUE);
        $user_password = $this->post('user_password', TRUE);
        $user_password = md5($user_password);
        $user_phone = $this->post('user_phone', TRUE);
        $id_profile = $this->post('id_profile', TRUE);
        $user_created = $this->post('user_created', TRUE);

        if ($user_email != '') {

            $checkuser = $this->model_user->checkUser($user_email)->num_rows();
            if ($checkuser > 0) {
                $data['code'] = 400;
                $data['message'] = 'User already exists';
                $this->response($data, 200);
            }else{
                $dataPost = array(
                    'user_email' => $user_email,
                    'user_nik' => $user_nik,
                    'user_name' => $user_name,
                    'user_password' => $user_password,
                    'user_phone' => $user_phone,
                    'id_profile' => $id_profile,
                    'user_created' => $user_created
                );

                $result = $this->model_user->saveUser($dataPost);
                if ($result) {
                    $data['code'] = 200;
                    $data['message'] = 'Success saved data user';
                    $this->response($data, 200);
                }else{
                    $data['code'] = 500;
                    $data['message'] = 'Failed saved data user';
                    $this->response($data, 200);
                }
            }

        }else{
            $data['code'] = 404;
            $data['message'] = 'User email can not empty';
            $this->response($data, 200);
        }
    }

    public function editUser_post() {
        $id_user = $this->post('id_user', TRUE);
        $user_email = $this->post('user_email', TRUE);
        $user_nik = $this->post('user_nik', TRUE);
        $user_name = $this->post('user_name', TRUE);
        $user_password = $this->post('user_password', TRUE);
        $user_phone = $this->post('user_phone', TRUE);
        $modify_date = $this->post('modify_date', TRUE);
        $user_modify = $this->post('user_modify', TRUE);

        if ($user_email != '') {

            $dataPost = array(
                'user_nik' => $user_nik,
                'user_name' => $user_name,
                'user_password' => $user_password,
                'user_phone' => $user_phone,
                'modify_date' => $modify_date,
                'user_modify' => $user_modify
            );

            $result = $this->model_user->updateUser($id_user, $dataPost);
            if ($result) {
                $data['code'] = 200;
                $data['message'] = 'Success updated data user';
                $this->response($data, 200);
            }else{
                $data['code'] = 500;
                $data['message'] = 'Failed updated data user';
                $this->response($data, 200);
            }

        }else{
            $data['code'] = 404;
            $data['message'] = 'User email can not empty';
            $this->response($data, 200);
        }
    }

    public function deleteUser_post() {
        $id_user = $this->post('id_user', TRUE);

        if ($id_user != '') {

            if ($this->model_user->cek_user($id_user)->num_rows() > 0) {
                $dataPost = array(
                    'is_active' => '0'
                );

                $result = $this->model_user->updateUser($id_user, $dataPost);
                if ($result) {
                    $data['code'] = 200;
                    $data['message'] = 'Success deleted data user';
                    $this->response($data, 200);
                }else{
                    $data['code'] = 500;
                    $data['message'] = 'Failed deleted data user';
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
    
}
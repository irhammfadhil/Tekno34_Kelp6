<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {

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

        $this->load->model('Login_Model', 'model_login');
    }
    
    public function userLogin_post($value='') {
        $user_email = $this->post('user_email', TRUE);
        $user_password = $this->post('user_password', TRUE);

        if ($user_email != '' || $user_password != '' ) {
            $rows = $this->model_login->getLogin($user_email , $user_password);
            if ($rows->num_rows() > 0) {
                $data['code'] = 200;
                $data['message'] = 'Successfully Login';
                $data['data'] = $rows->result();
                $this->response($data, 200);
            }else {
                $data['code'] = 404;
                $data['status']= 'Unsuccessful Login';
                $data['message'] = 'Username or Password is incorrect';
                $data['data'] = null;
                $this->response($data, 200);
            }

        }else{
            $data['code']=502;
            $data['status']= 'Unsuccessful Login';
            $data['message']='One or more mandatory fields are empty';
            $data['data'] = array('username_is_empty'=>!isset($user_email),'password_is_empty'=>!isset($user_password));
            $this->response($data, 200);
        }
        
    }

    public function changePassword_post() {
        $user_email = $this->post('user_email', TRUE);
        $user_password = $this->post('user_password', TRUE);
        $modify_date = $this->post('modify_date', TRUE);
        $user_modify = $this->post('user_modify', TRUE);

        if ($user_email != '') {

            $dataPost = array(
                'user_password' => $user_password,
                'modify_date' => $modify_date,
                'user_modify' => $user_modify
            );

            $result = $this->model_login->updatePass($user_email, $dataPost);
            if ($result) {
                $data['code'] = 200;
                $data['message'] = 'Your password has been successfully changed';
                $this->response($data, 200);
            }else{
                $data['code'] = 500;
                $data['message'] = 'Reset password failed';
                $this->response($data, 200);
            }

        }else{
            $data['code'] = 404;
            $data['message'] = 'User email can not empty';
            $this->response($data, 200);
        }
    }  

}
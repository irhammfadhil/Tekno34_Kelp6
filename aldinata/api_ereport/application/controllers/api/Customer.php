<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Customer extends REST_Controller {

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

        $this->load->model('Customer_Model', 'model_customer');
    }

    public function listCustomer_get() {
        $id_customer = $this->get('id_customer', TRUE);

        if ($id_customer != '') {
            $rows = $this->model_customer->getCustomer($id_customer);
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
            $rows = $this->model_customer->getCustomer($id_customer);
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

    public function addCustomer_post() {
        $customer_name = $this->post('customer_name', TRUE);
        $customer_email = $this->post('customer_email', TRUE);
        $customer_phone = $this->post('customer_phone', TRUE);
        $customer_fax = $this->post('customer_fax', TRUE);
        $customer_addr = $this->post('customer_addr', TRUE);
        $customer_logo = $this->post('customer_logo', TRUE);

        if ($customer_name != '') {

            $checkcustomer = $this->model_customer->checkCustomer($customer_name)->num_rows();
            if ($checkcustomer > 0) {
                $data['code'] = 400;
                $data['message'] = 'Customer already exists';
                $this->response($data, 200);
            }else{
                $dataPost = array(
                    'customer_name' => $customer_name,
                    'customer_email' => $customer_email,
                    'customer_phone' => $customer_phone,
                    'customer_fax' => $customer_fax,
                    'customer_addr' => $customer_addr,
                    'customer_logo' => $customer_logo
                );

                $result = $this->model_customer->saveCustomer($dataPost);
                if ($result) {
                    $data['code'] = 200;
                    $data['message'] = 'Success saved data customer';
                    $this->response($data, 200);
                }else{
                    $data['code'] = 500;
                    $data['message'] = 'Failed saved data customer';
                    $this->response($data, 200);
                }
            }

        }else{
            $data['code'] = 404;
            $data['message'] = 'Customer name can not empty';
            $this->response($data, 200);
        }
    }

    public function editCustomer_post() {
        $id_customer = $this->post('id_customer', TRUE);
        $customer_name = $this->post('customer_name', TRUE);
        $customer_email = $this->post('customer_email', TRUE);
        $customer_phone = $this->post('customer_phone', TRUE);
        $customer_fax = $this->post('customer_fax', TRUE);
        $customer_addr = $this->post('customer_addr', TRUE);
        $customer_logo = $this->post('customer_logo', TRUE);

        if ($customer_name != '') {

            $dataPost = array(
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_phone' => $customer_phone,
                'customer_fax' => $customer_fax,
                'customer_addr' => $customer_addr,
                'customer_logo' => $customer_logo
            );

            $result = $this->model_customer->updateCustomer($id_customer, $dataPost);
            if ($result) {
                $data['code'] = 200;
                $data['message'] = 'Success updated data customer';
                $this->response($data, 200);
            }else{
                $data['code'] = 500;
                $data['message'] = 'Failed updated data customer';
                $this->response($data, 200);
            }

        }else{
            $data['code'] = 404;
            $data['message'] = 'Customer name can not empty';
            $this->response($data, 200);
        }
    }

    public function deleteCustomer_post() {
        $id_customer = $this->post('id_customer', TRUE);

        if ($id_customer != '') {
            
            if ($this->model_customer->cek_customer($id_customer)->num_rows() > 0) {
                
                $dataPost = array(
                    'is_active' => '0'
                );

                $result = $this->model_customer->updateCustomer($id_customer, $dataPost);
                if ($result) {
                    $data['code'] = 200;
                    $data['message'] = 'Success deleted data customer';
                    $this->response($data, 200);
                }else{
                    
                    $data['code'] = 500;
                    $data['message'] = 'Failed deleted data customer';
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
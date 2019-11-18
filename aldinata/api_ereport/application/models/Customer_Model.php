<?php

class Customer_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function getCustomer($id_customer) {
        if ($id_customer != '') {
            $query = "SELECT *
            FROM p_customer WHERE is_active=1 AND id_customer = '".$id_customer."'";    
        }else {
            $query = "SELECT *
            FROM p_customer WHERE is_active=1";    
        }
        
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        }else {
            return 0;
        }
    }

    public function checkCustomer($customer) {
        $query = "SELECT * FROM p_customer WHERE customer_name = '".$customer."' AND is_active = '1'";
        return $this->db->query($query);
    }

    public function saveCustomer($data) {
        $result = $this->db->insert('p_customer', $data);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }

    function cek_customer($id_customer)
    {
        $query = "
        SELECT * FROM p_customer WHERE id_customer = '".$id_customer."' AND is_active = '1'
        ";
        return $this->db->query($query);
    }

    public function updateCustomer($id_customer, $data) {
        $this->db->where('id_customer', $id_customer);
        $result = $this->db->update('p_customer', $data);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }
    


}
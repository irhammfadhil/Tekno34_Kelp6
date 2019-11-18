<?php

class Login_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();

        $this->load->database();
    }

    public function getLogin($user_email, $user_password) {
        if ($user_email != '' || $user_password != '') {
            $query = "SELECT * FROM p_user u
            LEFT JOIN  p_profile p on u.id_profile = p.id_profile
            WHERE  u.is_active = 1 AND u.user_email = '".$user_email."' AND u.user_password = '".$user_password."'";    
        }
        
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        }else {
            return 0;
        }
    }

    public function updatePass($user_email, $data) {
        $this->db->where('user_email', $user_email);
        $this->db->where('is_active', '1');
        $result = $this->db->update('p_user', $data);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }
    
}
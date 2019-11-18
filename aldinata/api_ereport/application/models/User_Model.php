<?php

class User_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function checkpass($pass, $id) {
        $query = 'SELECT * FROM p_user WHERE id_user = '.$id.' AND user_password="'.$pass.'" AND is_active=1';    
        
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        }else {
            return 0;
        }
    }

    public function getUser($id_user) {
        if ($id_user != '') {
            $query = "SELECT *
            FROM p_user u
            LEFT JOIN p_profile p on u.id_profile = p.id_profile
            WHERE u.is_active=1 AND u.id_user = '".$id_user."'";    
        }else {
            $query = "SELECT *
            FROM p_user u
            LEFT JOIN p_profile p on u.id_profile = p.id_profile
            WHERE u.is_active=1";    
        }
        
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        }else {
            return 0;
        }
    }

    public function getProfile() {
        $query = "SELECT * from p_profile where is_active = 1";
        
        return $this->db->query($query);
    }

    public function checkUser($user) {
        $query = "SELECT * FROM p_user WHERE user_email = '".$user."' AND is_active = '1'";
        return $this->db->query($query);
    }

    public function saveUser($data) {
        $result = $this->db->insert('p_user', $data);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }

    function cek_user($id_user)
    {
        $query = "
        SELECT * FROM p_user WHERE id_user = '".$id_user."' AND is_active = '1'
        ";
        return $this->db->query($query);
    }

    public function updateUser($id_user, $data) {
        $this->db->where('id_user', $id_user);
        $result = $this->db->update('p_user', $data);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }
    


}
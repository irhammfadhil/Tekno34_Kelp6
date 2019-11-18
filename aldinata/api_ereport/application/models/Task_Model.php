<?php

class Task_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }


    public function getTask($id_task,$id_profile,$id_user) {
        if ($id_task != '') {
            $query = "SELECT *
             FROM t_assignment a
             LEFT JOIN p_user u on a.id_user = u.id_user
             LEFT JOIN p_customer c on a.id_customer = c.id_customer
             LEFT JOIN p_assignmentstatus s on a.id_assignmentstatus = s.id_assignmentstatus
             WHERE a.is_active=1 AND a.id_assignment = '".$id_task."'
             ORDER BY a.id_assignmentstatus , a.due_date DESC";    
        }else{
            if ($id_profile == 3) {
                $query = "SELECT *
                 FROM t_assignment a
                 LEFT JOIN p_user u on a.id_user = u.id_user
                 LEFT JOIN p_customer c on a.id_customer = c.id_customer
                 LEFT JOIN p_assignmentstatus s on a.id_assignmentstatus = s.id_assignmentstatus
                 WHERE a.is_active=1 AND a.id_user='".$id_user."'
                 ORDER BY a.id_assignmentstatus , a.due_date DESC";
            }else{
                $query = "SELECT *
                 FROM t_assignment a
                 LEFT JOIN p_user u on a.id_user = u.id_user
                 LEFT JOIN p_customer c on a.id_customer = c.id_customer
                 LEFT JOIN p_assignmentstatus s on a.id_assignmentstatus = s.id_assignmentstatus
                 WHERE a.is_active=1 ORDER BY a.id_assignmentstatus , a.due_date DESC"; 
            }
               
        }
        
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        }else {
            return 0;
        }
    }
	
	public function checkTask($id_customer, $id_user, $due_date)
	{
		$query = $this->db->query("SELECT * 
									FROM t_assignment
									WHERE id_customer = '".$id_customer."' AND id_user = '".$id_user."' AND due_date = '".$due_date."' AND is_active = 1");
		return $query;
	}
	
	public function saveTask($data) 
	{
		$res = $this->db->insert('t_assignment', $data);
		if ($res) {
			return true;
		}
		else {
			return false;
		}
	}

    public function getCustomer() {
        $query = "SELECT * from p_customer where is_active = 1";
        
        return $this->db->query($query);
    }

    public function getUser() {
        $query = "SELECT * from p_user u
            LEFT JOIN p_profile p on u.id_profile = p.id_profile
            where u.is_active = 1 AND p.id_profile=3";
        
        return $this->db->query($query);
    }


    function cek_task($id_assignment)
    {
        $query = "
            SELECT * FROM t_assignment WHERE id_assignment = '".$id_assignment."' AND is_active = '1'
        ";
        return $this->db->query($query);
    }

    public function updateTask($id_assignment, $data) {
        $this->db->where('id_assignment', $id_assignment);
        $result = $this->db->update('t_assignment', $data);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }


    public function getTaskDone($id_task,$id_profile,$id_user) {
        if ($id_task != '') {
            $query = "SELECT *
             FROM t_assignment a
             LEFT JOIN p_user u on a.id_user = u.id_user
             LEFT JOIN p_customer c on a.id_customer = c.id_customer
             LEFT JOIN p_assignmentstatus s on a.id_assignmentstatus = s.id_assignmentstatus
             LEFT JOIN (select id_assignment , r.id_report , file_name from t_report r left join p_file f on r.id_report = f.id_report group by 1) f on a.id_assignment = f.id_assignment
             WHERE a.id_assignmentstatus = 2 AND a.is_active=1 AND a.id_assignment = '".$id_task."'
             ORDER BY a.id_assignmentstatus, a.due_date DESC";    
        }else{
            if ($id_profile == 3) {
                $query = "SELECT *
                 FROM t_assignment a
                 LEFT JOIN p_user u on a.id_user = u.id_user
                 LEFT JOIN p_customer c on a.id_customer = c.id_customer
                 LEFT JOIN p_assignmentstatus s on a.id_assignmentstatus = s.id_assignmentstatus
                 LEFT JOIN (select id_assignment , r.id_report , file_name from t_report r left join p_file f on r.id_report = f.id_report group by 1) f on a.id_assignment = f.id_assignment
                 WHERE a.id_assignmentstatus = 2 AND a.is_active=1 AND a.id_user='".$id_user."'
                 ORDER BY a.id_assignmentstatus, a.due_date DESC";
            }else{
                $query = "SELECT *
                 FROM t_assignment a
                 LEFT JOIN p_user u on a.id_user = u.id_user
                 LEFT JOIN p_customer c on a.id_customer = c.id_customer
                 LEFT JOIN p_assignmentstatus s on a.id_assignmentstatus = s.id_assignmentstatus
                 LEFT JOIN (select id_assignment , r.id_report , file_name from t_report r left join p_file f on r.id_report = f.id_report group by 1) f on a.id_assignment = f.id_assignment
                 WHERE a.id_assignmentstatus = 2 AND a.is_active=1
                 ORDER BY a.id_assignmentstatus, a.due_date DESC"; 
            }
               
        }
        
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        }else {
            return 0;
        }
    }
    


}
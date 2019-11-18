<?php

class Template_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
	
	public function checkTemplate($id_template)
	{
		$query = $this->db->query("SELECT * FROM p_template WHERE id_template='".$id_template."'");
		return $query;
	}

	public function saveTemplate($data) {
        $result = $this->db->insert('t_report', $data);
        if ($result) {
            // return true;
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	
	public function get_template($id_template) {
		if ($id_template != '') {
			$query = $this->db->query("SELECT *
									FROM p_template
									WHERE is_active=1 AND id_template = '".$id_template."'");	
		}else{
			$query = $this->db->query("SELECT *
									FROM p_template 
									WHERE is_active=1");
		}
		
		return $query;
	}
	

	public function get_menu($id_template,$id_menu,$id_menuparent) {
		if ($id_template != '') {
			if($id_menuparent != ''){
				if ($id_menu != '') {
					$query = $this->db->query("SELECT t.* , tm.id_temp_menu, tm.id_menu, m.id_menuparent , m.menu_name 
									FROM p_template t
									LEFT JOIN p_temp_menu tm ON t.id_template = tm.id_template
									LEFT JOIN p_menu m ON tm.id_menu = m.id_menu
									WHERE t.is_active=1  AND t.is_active=1 AND m.is_active=1 AND t.id_template = '".$id_template."' AND tm.id_menu='".$id_menu."' AND m.id_menuparent='".$id_menuparent."' ");
				}else{
					$query = $this->db->query("SELECT t.* , tm.id_temp_menu, tm.id_menu, m.id_menuparent , m.menu_name 
									FROM p_template t
									LEFT JOIN p_temp_menu tm ON t.id_template = tm.id_template
									LEFT JOIN p_menu m ON tm.id_menu = m.id_menu
									WHERE t.is_active=1  AND t.is_active=1 AND m.is_active=1 AND t.id_template = '".$id_template."' AND m.id_menuparent='".$id_menuparent."'");
				}
			}else{
				$query = $this->db->query("SELECT t.* , tm.id_temp_menu, tm.id_menu, m.id_menuparent , m.menu_name 
									FROM p_template t
									LEFT JOIN p_temp_menu tm ON t.id_template = tm.id_template
									LEFT JOIN p_menu m ON tm.id_menu = m.id_menu
									WHERE t.is_active=1  AND t.is_active=1 AND m.is_active=1 AND t.id_template = '".$id_template."'");
			}	
		}else{
			$query = $this->db->query("SELECT t.* , tm.id_temp_menu, tm.id_menu, m.id_menuparent , m.menu_name 
									FROM p_template t
									LEFT JOIN p_temp_menu tm ON t.id_template = tm.id_template
									LEFT JOIN p_menu m ON tm.id_menu = m.id_menu
									WHERE t.is_active=1  AND t.is_active=1 AND m.is_active=1");
		}
		
		return $query;
	}


	public function get_parentmenu($id_template) {
		if ($id_template != '') {
			$query = $this->db->query("SELECT *
								FROM p_menu m
								LEFT JOIN p_temp_menu tm on m.id_menu = tm.id_menu
								WHERE m.is_active=1 AND m.id_menuparent=0 AND tm.id_template = '".$id_template."'");
		}else{
			$query = $this->db->query("SELECT *
								FROM p_menu m
								LEFT JOIN p_temp_menu tm on m.id_menu = tm.id_menu
								WHERE m.is_active=1 AND m.id_menuparent=0");
		}
		
		return $query;
	}

	public function get_menu2($id_template, $id_menuparent) {
		if ($id_template != '' AND $id_menuparent != '' ) {
			$query = $this->db->query("SELECT *
								FROM p_menu m
								LEFT JOIN p_temp_menu tm on m.id_menu = tm.id_menu
								WHERE m.is_active=1 AND m.id_menuparent='".$id_menuparent."' AND tm.id_template = '".$id_template."'");
		}else{
			$query = $this->db->query("SELECT *
								FROM p_menu m
								LEFT JOIN p_temp_menu tm on m.id_menu = tm.id_menu
								WHERE m.is_active=1");
		}
		
		return $query;
	}


	public function get_templatemenu($id_template) {
		if ($id_template != '') {
			$query = $this->db->query("SELECT t.* , tm.id_temp_menu, tm.id_menu, m.id_menuparent , m.menu_name 
								FROM p_template t
								LEFT JOIN p_temp_menu tm ON t.id_template = tm.id_template
								LEFT JOIN p_menu m ON tm.id_menu = m.id_menu
								WHERE t.is_active=1  AND t.is_active=1 AND m.is_active=1 AND t.id_template = '".$id_template."'");
		}else{
			$query = $this->db->query("SELECT t.* , tm.id_temp_menu, tm.id_menu, m.id_menuparent , m.menu_name 
									FROM p_template t
									LEFT JOIN p_temp_menu tm ON t.id_template = tm.id_template
									LEFT JOIN p_menu m ON tm.id_menu = m.id_menu
									WHERE t.is_active=1  AND t.is_active=1 AND m.is_active=1");
		}
		
		return $query;
	}


	
	public function update_assignment($id_assignment,$data)
	{
		$this->db->where('id_assignment', $id_assignment);
        $result = $this->db->update('t_assignment', $data);
        if ($result) {
            return true;
        }else{
            return false;
        }
	}
	
	public function get_idreport($id_assignment)
	{
		$query = $this->db->query("SELECT tr.id_report AS id_report
									FROM t_report tr, t_assignment ta
									WHERE ta.id_assignment = '".$id_assignment."' AND ta.id_assignment = tr.id_assignment");
		return $query;
	}
	
	public function save_detail($data) {
        $result = $this->db->insert('t_report_detail', $data);
        // if ($result) {
        //     return true;
        // }else{
        //     return false;
        // }
    }

    public function save_file($data) {
        $result = $this->db->insert('p_file', $data);
        if ($result) {
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
	
	public function show_attr($id_assignment, $id_menu)
	{
		if ($id_menu != '') {
			$query = $this->db->query("SELECT * FROM t_report r 
				LEFT JOIN t_report_detail rd on r.id_report = rd.id_report 
				LEFT JOIN t_assignment a on r.id_assignment = a.id_assignment
				LEFT JOIN p_template t on r.id_template = t.id_template
				WHERE a.id_assignment = '".$id_assignment."'  AND rd.id_menu='".$id_menu."'
				ORDER BY r.id_report DESC");
		}else{
			$query = $this->db->query("SELECT * FROM t_report r 
				LEFT JOIN t_report_detail rd on r.id_report = rd.id_report 
				LEFT JOIN t_assignment a on r.id_assignment = a.id_assignment
				LEFT JOIN p_template t on r.id_template = t.id_template
				WHERE a.id_assignment = '".$id_assignment."' 
				ORDER BY r.id_report DESC");
		}
		
		return $query;
	}
	
	public function get_menuin($id_assignment)
	{
		$query = $this->db->query("select vt.id_template, vt.id_menu, vt.id_menuparent, vt.id_temp_menu, vt.menu_name , aa.id_customer, aa.id_report ,aa.insight  from v_template vt
									left join (
									select a.*,rr.id_report, rr.id_template, rr.report_title, rr.report_number, rr.agreement_number, rr.subject, rr.report_periode, rr.id_temp_menu, rr.insight from t_assignment a
									left join 
									(select r.*, rd.id_temp_menu, rd.insight from t_report r
									left join t_report_detail rd on r.id_report = rd.id_report
									where r.is_active=1) rr on a.id_assignment = rr.id_assignment
									where a.is_active=1 and a.id_assignment = '".$id_assignment."'
									) aa on vt.id_temp_menu = aa.id_temp_menu and vt.id_template = aa.id_template");
		return $query;
	}
	
}
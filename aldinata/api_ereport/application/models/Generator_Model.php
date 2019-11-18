<?php

class Generator_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();

        $this->load->database();
    }

    public function get_temp($id_customer, $month, $year)
	{
		
		$query = $this->db->query("SELECT p_data.*, sla.min_value, sla.max_value FROM p_data
							left join (select max(id_sla) id_sla, id_customer, id_menu,min_value, max_value from p_sla where id_menu=40 and id_customer='".$id_customer."' and sla_name like '%temp%') sla on p_data.id_menu = sla.id_menu and p_data.id_customer = sla.id_customer
							WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."' and upload_date= (select max(upload_date)from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."')
							order by p_data.data_date ASC");

		return $query;
	}

	public function get_tabletemp($id_customer, $month, $year)
	{
		$monthp1 = ($month-1);
		$monthp2 = ($month-2);
		
		$query = $this->db->query("SELECT 'This Month' Periode, coalesce(min(data_value),'-') min, coalesce(max(data_value),'-') max, data_remark FROM p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."' and upload_date = (select max(upload_date) from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."') 
		UNION
		SELECT '1st Previous Month' Periode, coalesce(min(data_value),'-') min, coalesce(max(data_value),'-') max, data_remark FROM p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$monthp1."' and year(p_data.data_date) ='".$year."' and upload_date = (select max(upload_date)from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$monthp1."' and year(p_data.data_date) ='".$year."')
		UNION
		SELECT '2st Previous Month' Periode, coalesce(min(data_value),'-') min, coalesce(max(data_value),'-') max, data_remark FROM p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$monthp2."' and year(p_data.data_date) ='".$year."' and upload_date = (select max(upload_date)from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$monthp2."' and year(p_data.data_date) ='".$year."')");

		return $query;
	}
	
	public function get_hum($id_customer, $month, $year)
	{
		
		$query = $this->db->query("SELECT p_data.*, sla.min_value, sla.max_value FROM p_data
							left join (select max(id_sla) id_sla, id_customer, id_menu,min_value, max_value from p_sla where id_menu=40 and id_customer='".$id_customer."' and sla_name like '%hum%') sla on p_data.id_menu = sla.id_menu and p_data.id_customer = sla.id_customer
							WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."' and upload_date = (select max(upload_date) from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."')
							order by p_data.data_date ASC");
		
		return $query;
	}

	public function get_tablehum($id_customer, $month, $year)
	{
		
		$monthp1 = ($month-1);
		$monthp2 = ($month-2);
		
		$query = $this->db->query("SELECT 'This Month' Periode, coalesce(min(data_value),'-') min, coalesce(max(data_value),'-') max, data_remark FROM p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."' and upload_date = (select max(upload_date)from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."') 
		UNION
		SELECT '1st Previous Month' Periode, coalesce(min(data_value),'-') min, coalesce(max(data_value),'-') max, data_remark FROM p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$monthp1."' and year(p_data.data_date) ='".$year."' and upload_date= (select max(upload_date) from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$monthp1."' and year(p_data.data_date) ='".$year."')
		UNION
		SELECT '2st Previous Month' Periode, coalesce(min(data_value),'-') min, coalesce(max(data_value),'-') max, data_remark FROM p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$monthp2."' and year(p_data.data_date) ='".$year."' and upload_date = (select max(upload_date)from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$monthp2."' and year(p_data.data_date) ='".$year."')");
		
		return $query;
	}
	
	public function get_incident($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT associated_request_id, log_summary, submit_date, resolved_date, duration, log_pic, log_resolution, log_status   from p_data d
			left join p_data_log l on d.id_data = l.id_data
			where d.id_menu= 8 and d.id_customer='".$id_customer."' and month(submit_date)='".$month."' and year(submit_date)='".$year."' and id_logtype=1 and upload_date = (select max(upload_date) from p_data left join p_data_log on p_data.id_data = p_data_log.id_data where d.id_menu= 8 and d.id_customer='".$id_customer."' and month(submit_date)='".$month."' and year(submit_date)='".$year."' and id_logtype=1)");

		return $query;
	}
	
	public function get_request($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT associated_request_id, log_summary, submit_date, resolved_date, duration, log_pic, log_resolution, log_status   from p_data d
			left join p_data_log l on d.id_data = l.id_data
			where d.id_menu= 8 and d.id_customer='".$id_customer."' and month(submit_date)='".$month."' and year(submit_date)='".$year."' and id_logtype=2 and upload_date = (select max(upload_date) from p_data left join p_data_log on p_data.id_data = p_data_log.id_data where d.id_menu= 8 and d.id_customer='".$id_customer."' and month(submit_date)='".$month."' and year(submit_date)='".$year."' and id_logtype=2)");

		return $query;
	}
	
	public function get_movement($id_customer)
	{
		$query = $this->db->query("SELECT pd.*,pdm.*
									FROM p_data pd,p_customer pc,p_data_movement pdm
									WHERE pc.id_customer = '".$id_customer."' AND pc.id_customer = pd.id_customer AND pd.id_data = pdm.id_data AND pdm.is_active = 1");
		return $query;
	}
	
	public function get_maintenance($id_customer, $month, $year)
	{
		$monthp1 = ($month-1);
		$monthp2 = ($month+1);

		$query = $this->db->query("SELECT pdm.maintenance_vendor, pdm.maintenance_device ,  m1.maintenance_remark monthsprev ,pdm.maintenance_remark months , m2.maintenance_remark monthsnext from p_data pd left join p_data_maintenance pdm on pd.id_data=pdm.id_data 
			left join
			(SELECT pdm.maintenance_vendor, pdm.maintenance_device, pdm.maintenance_remark from p_data pd left join p_data_maintenance pdm on pd.id_data=pdm.id_data where pd.id_menu=41 and pd.id_customer='".$id_customer."' and pdm.id_month='".$monthp1."' and year='".$year."' and upload_date = (SELECT max(upload_date) from p_data left join p_data_maintenance on p_data.id_data=p_data_maintenance.id_data where id_menu=41 and id_customer='".$id_customer."' and id_month='".$monthp1."' and year='".$year."')) m1 on pdm.maintenance_vendor = m1.maintenance_vendor and pdm.maintenance_device=m1.maintenance_device
			left join 
			(select pdm.maintenance_vendor, pdm.maintenance_device, pdm.maintenance_remark from p_data pd left join p_data_maintenance pdm on pd.id_data=pdm.id_data  where pd.id_menu=41 and pd.id_customer='".$id_customer."' and pdm.id_month='".$monthp2."' and year='".$year."' and upload_date = (select max(upload_date) from p_data left join p_data_maintenance on p_data.id_data=p_data_maintenance.id_data where id_menu=41 and id_customer='".$id_customer."' and id_month='".$monthp2."' and year='".$year."')) m2 on pdm.maintenance_vendor = m1.maintenance_vendor and pdm.maintenance_device=m1.maintenance_device 
			where pd.id_menu=41 and pd.id_customer='".$id_customer."' and pdm.id_month='".$month."' and year='".$year."' and upload_date = (select max(upload_date) from p_data left join p_data_maintenance on p_data.id_data=p_data_maintenance.id_data where id_menu=41 and id_customer='".$id_customer."' and id_month='".$month."' and year='".$year."') group by 1,2");

		return $query;
	}
	
	public function change_management($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT cm_id, cm_summary, cm_class, cm_priority, cm_startdate, cm_enddate, cm_risklevel, cm_status from p_data d
			left join p_data_cm cm on d.id_data=cm.id_data
			where d.id_menu = 7 and d.id_customer='".$id_customer."' and month(cm_startdate)='".$month."' and year(cm_startdate)='".$year."' and upload_date = (select max(upload_date) from p_data left join p_data_cm on p_data.id_data=p_data_cm.id_data where p_data.id_menu = 7 and p_data.id_customer='".$id_customer."' and month(cm_startdate)='".$month."' and year(cm_startdate)='".$year."')");

		return $query;
	}
	
	public function get_ups($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT * FROM p_data WHERE id_menu = 63 and id_customer = '".$id_customer."' and month(data_date) = '".$month."' and year(data_date) ='".$year."' AND data_name like '%ups%'
			and upload_date = (select max(upload_date) from p_data WHERE id_menu = 63 and id_customer = '".$id_customer."' and month(data_date) = '".$month."' and year(data_date) ='".$year."' AND data_name like '%ups%')");
		return $query;
	}
	
	public function get_kva($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT * FROM p_data WHERE id_menu = 63 and id_customer = '".$id_customer."' and month(data_date) = '".$month."' and year(data_date) ='".$year."' AND data_name like '%kva%' 
			and upload_date = (select max(upload_date) from p_data WHERE id_menu = 63 and id_customer = '".$id_customer."' and month(data_date) = '".$month."' and year(data_date) ='".$year."' AND data_name like '%kva%')");

		return $query;
	}

	public function get_upskva($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT * FROM p_data WHERE id_menu = 63 and id_customer = '".$id_customer."' and month(data_date) = '".$month."' and year(data_date) ='".$year."' AND data_name like '%kva%' 
			and upload_date = (select max(upload_date) from p_data WHERE id_menu = 63 and id_customer = '".$id_customer."' and month(data_date) = '".$month."' and year(data_date) ='".$year."' AND data_name like '%kva%')
			union
			SELECT * FROM p_data WHERE id_menu = 63 and id_customer = '".$id_customer."' and month(data_date) = '".$month."' and year(data_date) ='".$year."' AND data_name like '%ups%'
			and upload_date = (select max(upload_date) from p_data WHERE id_menu = 63 and id_customer = '".$id_customer."' and month(data_date) = '".$month."' and year(data_date) ='".$year."' AND data_name like '%ups%')");

		return $query;
	}
	
	public function get_machinem($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT d.data_date, d.data_value, movement_serialnumber, movement_qty, movement_rack , movement_power, movement_pic, movement_time, data_remark, movement_room, movement_tiket from p_data d
			left join p_data_movement m on d.id_data = m.id_data
			where d.id_menu = 5 and d.id_customer='".$id_customer."' and month(d.data_date) = '".$month."' and year(d.data_date) ='".$year."' and upload_date = (select max(upload_date) from p_data left join p_data_movement on p_data.id_data = p_data_movement.id_data where p_data.id_menu = 5 and p_data.id_customer='".$id_customer."' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."')");

		return $query;
	}
	
	public function get_powerav($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT p_data.* , sla.min_value sla FROM p_data
								left join (select max(id_sla), id_customer, id_menu,min_value from p_sla where id_menu=61 and id_customer='".$id_customer."') sla on p_data.id_menu = sla.id_menu and p_data.id_customer = sla.id_customer
								WHERE p_data.id_customer = '".$id_customer."' AND month(p_data.data_date) = '".$month."' AND year(p_data.data_date) ='".$year."' AND p_data.id_menu = 61 and upload_date = (select max(upload_date) from p_data WHERE p_data.id_customer = '".$id_customer."' AND month(p_data.data_date) = '".$month."' AND year(p_data.data_date) ='".$year."' AND p_data.id_menu = 61) group by data_name,data_date");
		return $query;
	}
	
	public function get_powercon($id_customer, $month, $year)
	{
		$monthp1 = ($month-1);
		$monthp2 = ($month-2);

		$query = $this->db->query("SELECT * FROM p_data WHERE id_customer = '".$id_customer."' AND id_menu = 62 and month(data_date) = '".$monthp2."' and year(data_date) ='".$year."' and upload_date = (select max(upload_date) from p_data WHERE id_customer = '".$id_customer."' AND id_menu = 62 and month(data_date) = '".$monthp2."' and year(data_date) ='".$year."') group by data_name
			union
			SELECT * FROM p_data WHERE id_customer = '".$id_customer."' AND id_menu = 62 and month(data_date) = '".$monthp1."' and year(data_date) ='".$year."' and upload_date =(select max(upload_date) from p_data WHERE id_customer = '".$id_customer."' AND id_menu = 62 and month(data_date) = '".$monthp1."' and year(data_date) ='".$year."') group by data_name
			union
			SELECT * FROM p_data WHERE id_customer = '".$id_customer."' AND id_menu = 62 and month(data_date) = '".$month."' and year(data_date) ='".$year."' and upload_date =(select max(upload_date) from p_data WHERE id_customer = '".$id_customer."' AND id_menu = 62 and month(data_date) = '".$month."' and year(data_date) ='".$year."') group by data_name");

		return $query;
	}
	
	public function get_upstime($id_customer, $month, $year)
	{
		$monthp1 = ($month-1);
		$monthp2 = ($month-2);

		$query = $this->db->query("SELECT * FROM p_data WHERE id_customer = '".$id_customer."' AND id_menu = 64 and month(data_date) = '".$monthp2."' and year(data_date) ='".$year."' and upload_date =(select max(upload_date) from p_data WHERE id_customer = '".$id_customer."' AND id_menu = 64 and month(data_date) = '".$monthp2."' and year(data_date) ='".$year."')
			union
			SELECT * FROM p_data WHERE id_customer = '".$id_customer."' AND id_menu = 64 and month(data_date) = '".$monthp1."' and year(data_date) ='".$year."' and upload_date =(select max(upload_date) from p_data WHERE id_customer = '".$id_customer."' AND id_menu = 64 and month(data_date) = '".$monthp1."' and year(data_date) ='".$year."')
			union
			SELECT * FROM p_data WHERE id_customer = '".$id_customer."' AND id_menu = 64 and month(data_date) = '".$month."' and year(data_date) ='".$year."' and upload_date =(select max(upload_date) from p_data WHERE id_customer = '".$id_customer."' AND id_menu = 64 and month(data_date) = '".$month."' and year(data_date) ='".$year."')");

		return $query;
	}
	
	public function get_loglobby($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT DISTINCT visit_id, visit_date, visit_name, visit_company, visit_to, visit_purpose, visit_category, visit_companion , visit_room, visit_checkindate, visit_checkoutdate  from p_data d
			left join p_data_visit v on d.id_data = v.id_data
			where d.id_customer='".$id_customer."' and d.id_menu = 43 and month(visit_date) = '".$month."' and year(visit_date) ='".$year."' and id_visittype=2 and upload_date = (select max(upload_date) from p_data left join p_data_visit  on p_data.id_data = p_data_visit.id_data where p_data.id_customer='".$id_customer."' and p_data.id_menu = 43 and month(p_data_visit.visit_date) = '".$month."' and year(p_data_visit.visit_date) ='".$year."' and p_data_visit.id_visittype=2)");

		return $query;	
	}
	
	public function get_logdacen($id_customer, $month, $year)
	{
		$query = $this->db->query("SELECT DISTINCT visit_id, visit_date, visit_name, visit_company, visit_to, visit_purpose, visit_category, visit_companion ,visit_room, visit_checkindate, visit_checkoutdate  from p_data d
			left join p_data_visit v on d.id_data = v.id_data
			where d.id_customer='".$id_customer."' and d.id_menu = 43 and month(visit_date) = '".$month."' and year(visit_date) ='".$year."' and id_visittype=1 and upload_date = (select max(upload_date) from p_data left join p_data_visit  on p_data.id_data = p_data_visit.id_data where p_data.id_customer='".$id_customer."' and p_data.id_menu = 43 and month(p_data_visit.visit_date) = '".$month."' and year(p_data_visit.visit_date) ='".$year."' and p_data_visit.id_visittype=1)");

		return $query;	
	}
	
	public function get_realt($id_customer)
	{
		$query = $this->db->query("SELECT id_menu,min(data_value) AS min_val,max(data_value) AS max_val
									FROM p_data
									WHERE id_customer = '".$id_customer."' AND id_menu = 40 AND data_name = 'temp'");
		return $query;
	}
	
	public function get_realh($id_customer)
	{
		$query = $this->db->query("SELECT id_menu,min(data_value) AS min_val,max(data_value) AS max_val
									FROM p_data
									WHERE id_customer = '".$id_customer."' AND id_menu = 40 AND data_name = 'Hum'");
		return $query;
	}
	
	public function get_slat($id_customer)
	{
		$query = $this->db->query("SELECT id_menu,min_value,max_value
									FROM p_sla
									WHERE id_customer = '".$id_customer."' AND sla_name = 'temperature'");
		return $query;
	}
	
	public function get_slah($id_customer)
	{
		$query = $this->db->query("SELECT id_menu,min_value,max_value
									FROM p_sla
									WHERE id_customer = '".$id_customer."' AND sla_name = 'humidity'");
		return $query;
	}
	
	public function get_slapower($id_customer)
	{
		$query = $this->db->query("SELECT DISTINCT id_menu,min_value,max_value
									FROM p_sla
									WHERE id_customer = '".$id_customer."' AND sla_name = 'power'");
		return $query;
	}


	
	public function get_esummary($id_customer)
	{
		$query = $this->db->query("SELECT DISTINCT ps.sla_name AS Menu, min_value AS data_standard, (SELECT MIN(data_value) FROM p_data WHERE id_customer = '".$id_customer."' AND data_name = 'temp') AS Performance
									FROM p_sla ps, p_data pd
									WHERE ps.id_customer = '".$id_customer."' AND ps.sla_name = 'temperature'
									UNION
									SELECT DISTINCT ps.sla_name, MAX_VALUE, (SELECT MAX(data_value) FROM p_data WHERE id_customer = '".$id_customer."' AND data_name = 'temp')
									FROM p_sla ps, p_data pd
									WHERE ps.id_customer = '".$id_customer."' AND ps.sla_name = 'temperature'
									UNION
									SELECT DISTINCT ps.sla_name, min_value, (SELECT MIN(data_value) FROM p_data WHERE id_customer = '".$id_customer."' AND data_name = 'hum')
									FROM p_sla ps, p_data pd
									WHERE ps.id_customer = '".$id_customer."' AND ps.sla_name = 'humidity'
									UNION
									SELECT DISTINCT ps.sla_name, MAX_VALUE, (SELECT MAX(data_value) FROM p_data WHERE id_customer = '".$id_customer."' AND data_name = 'hum')
									FROM p_sla ps, p_data pd
									WHERE ps.id_customer = '".$id_customer."' AND ps.sla_name = 'humidity'
									UNION
									SELECT DISTINCT sla_name,min_value, (SELECT data_value FROM p_data WHERE id_customer = '".$id_customer."' AND data_name = 'Power Availability This Period (%)')
									FROM p_sla 
									WHERE id_customer = '".$id_customer."' AND sla_name = 'power availability'
									UNION
									SELECT sla_name,min_value,(SELECT data_value FROM p_data WHERE data_name = 'cctv') FROM p_sla WHERE sla_name = 'cctv'
									UNION
									SELECT sla_name,min_value,(SELECT data_value FROM p_data WHERE data_name = 'access door') FROM p_sla WHERE sla_name = 'access door'
									UNION
									SELECT sla_name,min_value,(SELECT data_value FROM p_data WHERE data_name = 'fire system') FROM p_sla WHERE sla_name = 'fire system'");
		return $query;
	}

	public function get_exsummary($id_customer, $month, $year)
	{
		$query = "SELECT 'Temperature' as Menu,  concat(sla.min_value,' C-', sla.max_value, ' C') as Data_Standard , concat(min(p_data.data_value),' C-', max(p_data.data_value),' C') AS Performance FROM p_data left join (select max(id_sla) id_sla, id_customer, id_menu,min_value, max_value from p_sla where id_menu=40 and id_customer='".$id_customer."' and sla_name like '%temp%') sla on p_data.id_menu = sla.id_menu and p_data.id_customer = sla.id_customer WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."' and p_data.upload_date= (select max(p_data.upload_date)from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%temp%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."') GROUP BY 1,2
									UNION
			SELECT 'Humidity' as Menu,  concat('(',sla.min_value,' +-', sla.max_value, ')% RH') as Data_Standard , concat('(',min(p_data.data_value),' - ', max(p_data.data_value),')% RH') AS Performance FROM p_data left join (select max(id_sla) id_sla, id_customer, id_menu,min_value, max_value from p_sla where id_menu=40 and id_customer='".$id_customer."' and sla_name like '%hum%') sla on p_data.id_menu = sla.id_menu and p_data.id_customer = sla.id_customer WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."' and p_data.upload_date = (select max(p_data.upload_date)from p_data WHERE p_data.id_menu = 40 AND p_data.id_customer = '".$id_customer."' and p_data.data_name like '%hum%' and month(p_data.data_date) = '".$month."' and year(p_data.data_date) ='".$year."') GROUP BY 1,2
									UNION
			SELECT 'Power Availability' as Menu, concat( sla.min_value,' %') as Data_Standard , concat(data_value,' %') as Performance FROM p_data left join (select max(id_sla), id_customer, id_menu,min_value from p_sla where id_menu=61 and id_customer='".$id_customer."') sla on p_data.id_menu = sla.id_menu and p_data.id_customer = sla.id_customer WHERE p_data.id_customer = '".$id_customer."' AND month(p_data.data_date) = '".$month."' AND year(p_data.data_date) ='".$year."' AND p_data.id_menu = 61 and p_data.upload_date = (select max(p_data.upload_date) from p_data WHERE p_data.id_customer = '".$id_customer."' AND month(p_data.data_date) = '".$month."' AND year(p_data.data_date) ='".$year."' AND p_data.id_menu = 61) and p_data.data_name like '%Power Availability This Period%'";
			
		
		$result = $this->db->query($query);
		
        if ($result) {
            return $result;
        }else {
            return 0;
        }
	}

	public function get_exsumsecurity()
	{
		$query = $this->db->query("SELECT p_data.data_name as Menu, concat(p_sla.min_value,' %') as Data_Standard , concat(p_data.data_value,' %') AS Performance FROM p_data left join p_sla on p_data.id_menu= p_sla.id_menu and p_data.data_name=p_sla.sla_name WHERE p_data.id_menu=42 and p_data.upload_date = (select max(p_data.upload_date) FROM p_data left join p_sla on p_data.id_menu= p_sla.id_menu and p_data.data_name=p_sla.sla_name WHERE p_data.id_menu=42) group by 1");

		return $query;
	}
	
	public function get_security()
	{
		$query = $this->db->query("SELECT data_name,data_value , coalesce(data_remark,'-') data_remark FROM p_data WHERE id_menu=42 and upload_date=(select max(upload_date) from p_data where id_menu=42) group by 1");
		return $query;
	}
	
}
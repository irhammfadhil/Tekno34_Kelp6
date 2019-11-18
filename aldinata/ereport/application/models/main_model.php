<?php

class Main_model extends CI_Model
{
	function test_main()
	{
		echo "this is model function";
	}
	
	function fetch_data()
	{
		$query = $this->db->query("SELECT * FROM p_data WHERE id_menu = 40 AND id_customer = 1 AND MONTH(data_date) = 5 AND data_name = 'TEMP'");
		return $query;
	}
	
	function fetch_data1()
	{
		$query1 = $this->db->query("SELECT * FROM p_data WHERE id_menu = 40");
		return $query1;
	}
}

?>
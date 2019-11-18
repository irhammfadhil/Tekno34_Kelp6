<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {
  public function view(){
    return $this->db->get('p_user')->result(); // Tampilkan semua data yang ada di tabel cs
  }
  function checkpass($pass, $id){
		$query 	= $this->db->query('SELECT * FROM p_user WHERE id_user = '.$id.' AND user_password="'.$pass.'" AND is_active=1 ');
		return $query->num_rows();
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerModel extends CI_Model {
  public function view(){
    return $this->db->get('p_customer')->result(); // Tampilkan semua data yang ada di tabel cs
  }
}

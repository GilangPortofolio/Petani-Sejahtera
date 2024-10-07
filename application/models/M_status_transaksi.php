<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_status_transaksi extends CI_Model {
	public function select_all(){
        $this->db->select("*");
        $this->db->from('status_transaksi');
        return $this->db->get()->result();
    }
}
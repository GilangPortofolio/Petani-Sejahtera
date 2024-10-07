<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_level extends CI_Model {
	public function select_all(){
        $this->db->select("*");
        $this->db->from('level_admin');
        return $this->db->get()->result();
    }
}
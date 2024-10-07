<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_desa extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('desa');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}


	public function select_by_id($id) {
		$sql = "SELECT * FROM desa WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	//detail
	public function select_by_user($id) {
		$sql = " SELECT user.id AS id, user.NIK AS NIK, user.nama AS user, user.telp AS telp, desa.nama AS desa 
		FROM user, desa 
		WHERE user.id_desa = desa.id AND user.id_desa={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO desa VALUES('','" .$data['desa'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('desa', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE desa SET nama='" .$data['desa'] ."' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM desa WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('desa');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('desa');

		return $data->num_rows();
	}
}

/* End of file M_desa.php */
/* Location: ./application/models/M_desa.php */
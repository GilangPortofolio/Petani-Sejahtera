<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	public function update($data, $id) {
		$this->db->where("id", $id);
		$this->db->update("admin", $data);

		return $this->db->affected_rows();
	}

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('id', $id);
		}

		$data = $this->db->get('admin');

		return $data->row();
	}

	public function insert($data) {
		$insert_data['username'] = $data['username'];
		$insert_data['password'] = md5($data['password']);
		$insert_data['nama'] = $data['nama'];
		$insert_data['foto'] = 'profil1.jpg';
		$insert_data['level'] = $data['level'];

		$query = $this->db->insert('admin', $insert_data);
	}

	public function select_all() {
		$this->db->select('admin.id, admin.*, level_admin.id as id_level, level_admin.nama as level');
		$this->db->from('admin');
		$this->db->join('level_admin', 'level_admin.id = admin.level');
		$this->db->order_by('id', 'asc');

		$query = $this->db->get();
		return $query->result();
	}

	public function delete($id) {
		$sql = "DELETE FROM admin WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}


	public function update_admin($data) {
		$data['password'] = md5($data['password']);
		$sql = " UPDATE admin SET username='" .$data['username'] ."',password='" .$data['password'] ."',level='" .$data['level'] ."' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM admin WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}
	
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */
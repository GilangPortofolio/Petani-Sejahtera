<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mitra extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('mitra');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}


	public function select_by_id($id) {
		$sql = "SELECT * FROM mitra WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	//detail
	public function select_by_kurir($id) {
		$sql = " SELECT kurir.id AS id, kurir.nama AS kurir, kurir.jenis_kendaraan AS kendaraan, kurir.plat_no AS plat, kurir.telp AS telp, mitra.nama AS mitra  
		FROM kurir, mitra 
		WHERE kurir.id_mitra = mitra.id AND kurir.id_mitra={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$data['kode'] = strtoupper($data['kode']);
		$sql = "INSERT INTO mitra VALUES('','" .$data['nama'] ."','" .$data['kode'] ."','" .$data['telp'] ."','" .$data['alamat'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}


	public function update($data) {
		$data['kode'] = strtoupper($data['kode']);
		$sql = "UPDATE mitra SET nama='" .$data['nama'] ."', kode='" .$data['kode'] ."', telp='" .$data['telp'] ."', alamat='" .$data['alamat'] ."' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM mitra WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function total_rows() {
		$data = $this->db->get('mitra');

		return $data->num_rows();
	}
}


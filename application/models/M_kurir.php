<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kurir extends CI_Model {
	
	public function select_all() {
		$this->db->select('kurir.*, kurir.id, user.id_kurir, user.nik as nik, mitra.nama as mitra');
		$this->db->from('kurir');
		$this->db->join('user', 'user.id_kurir = kurir.id', 'left');
		$this->db->join('mitra', 'mitra.id = kurir.id_mitra');
		$this->db->order_by('id', 'desc');
		$data = $this->db->get();

		return $data->result();
	}


	public function select_by_id($id) {
		$sql = "SELECT * FROM kurir WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	//detail
	public function select_by_transaksi($id) {
		$sql = " SELECT transaksi.id AS id, transaksi.no_resi, transaksi.tanggal_pengambilan, transaksi.tanggal_diambil, transaksi.id_kurir, transaksi.id_user, transaksi.id_produk, transaksi.id_status_transaksi, kurir.nama AS kurir, user.nama AS user, transaksi.tanggal_sampai, transaksi.biaya_angkut, status_transaksi.nama AS status_transaksi_nama 
		FROM transaksi, kurir, user,  produk, status_transaksi  
		WHERE transaksi.id_kurir = kurir.id AND transaksi.id_user = user.id AND transaksi.id_produk = produk.id AND transaksi.id_status_transaksi = status_transaksi.id AND transaksi.id_kurir={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}


	public function insert($data) {
		$sql = "INSERT INTO kurir VALUES('','" .$data['nama'] ."','" .$data['jenis_kendaraan'] ."','" .$data['plat_no'] ."','" .$data['no_telp'] ."','" .$data['created_at'] ."','')";
		$this->db->query($sql);
		$id_kurir = $this->db->insert_id();
        $data['user_password'] = md5($data['user_password']);
        $sql = "INSERT INTO user VALUES('', " .$data['user_nik']. ", '" .$data['user_password']. "', '" .$data['nama']. "', '" .$data['no_telp']. "', '" .$data['id_desa']. "','','','','$id_kurir','')";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('kurir', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$data['plat_no'] = strtoupper($data['plat_no']);
		$sql = " UPDATE kurir SET nama='" .$data['nama'] ."',jenis_kendaraan='" .$data['jenis_kendaraan'] ."',plat_no='" .$data['plat_no'] ."',no_telp='" .$data['no_telp'] ."',id_mitra='" .$data['id_mitra'] ."' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}


	public function delete($id) {
		$this->db->delete('kurir', array('id' => $id)); 
		$this->db->delete('user', array('id_kurir' => $id));

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('kurir');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('kurir');

		return $data->num_rows();
	}


	function create_kurir($data){
		$insert_kurir['nama'] = $data['nama'];
		$insert_kurir['id_mitra'] = $data['id_mitra'];
		$insert_kurir['jenis_kendaraan'] = $data['jenis_kendaraan'];
		$insert_kurir['plat_no'] = strtoupper($data['plat_no']);
		$insert_kurir['no_telp'] = $data['no_telp'];
		$query = $this->db->insert('kurir', $insert_kurir);

		$id_kurir = $this->db->insert_id();
		$insert_user['password'] = md5($data['password']);
		$insert_user['nik'] = $data['nik'];
		$insert_user['nama'] = $data['nama'];
		$insert_user['telp'] = $data['no_telp'];
		$insert_user['id_kurir'] = $id_kurir;
		$query = $this->db->insert('user', $insert_user);


	}
}

/* End of file M_kurir.php */
/* Location: ./application/models/M_kurir.php */
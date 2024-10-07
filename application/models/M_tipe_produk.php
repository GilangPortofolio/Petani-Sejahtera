<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tipe_produk extends CI_Model {
	// protected $deletedField  = 'deleted_at';
	
	public function select_all() {
		$this->db->select('*');
		$this->db->from('tipe_produk');
		$this->db->order_by('id', 'desc');
		$this->db->order_by('parent_id','desc');
		$this->db->where('deleted_at is NULL',NULL);
		$this->db->where('terbaru',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function select_all_history(){
		$this->db->select("*");
		$this->db->from('tipe_produk')->order_by('parent_id','desc')->where('terbaru',0);
		$query = $this->db->get();
		return $query->result();
	}

	public function select_all_tipe_produk() {
		$this->db->select('tipe_produk.id, tipe_produk.nama, tipe_produk.harga, tipe_produk.tanggal');
		$this->db->from('tipe_produk');
		$this->db->order_by('id', 'desc');
		$this->db->where('terbaru', '1');
		$query = $this->db->get();
		return $query->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tipe_produk WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_nama($nama) {
		$sql = "SELECT * FROM tipe_produk WHERE nama = '{$nama}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	//detail
	 public function select_by_produk($id) {
	 	$sql = " SELECT produk.id AS id, produk.id_user, user.nik AS user_nik, user.nama AS user_nama, produk.tgl_tanam, produk.tgl_panen, produk.berat_panen, produk.luas_lahan, produk.id_tipe_produk, tipe_produk.nama AS tipe_produk, produk.alamat, produk.id_status_produk, status_produk.nama AS status_produk_nama 
	 	FROM produk, user, status_produk, tipe_produk  
	 	WHERE produk.id_user = user.id AND produk.id_tipe_produk = tipe_produk.id AND produk.id_status_produk = status_produk.id AND produk.id_tipe_produk = {$id}";

	 	$data = $this->db->query($sql);

	 	return $data->result();
	 }


	public function update($data) {
		//get related row
		$currentData = $this->db->from('tipe_produk')->where('id',$data['id'])->get()->row();
		//check that it is a master data (master data parent_id == null)
		$parent_id = NULL;
		if($currentData->parent_id == NULL){
			//he is master data
			$parent_id = $currentData->id;
		}else{
			$parent_id = $currentData->parent_id;
		}
		//update old data deleted_at.
		$this->db->from('tipe_produk');
		$this->db->where('id',$data['id']);
		$this->db->set('deleted_at','NOW()',FALSE);
		$this->db->set('terbaru',0);
		$this->db->update('tipe_produk');
		//create another row based on that master.
		//create duplicate row
		$this->db->set('tanggal','NOW()',FALSE);
		$this->db->insert('tipe_produk',array(
			'foto' => $currentData->foto,
			'nama' => $currentData->nama,
			'harga' => $data['harga'],
			'terbaru' => 1,
			'parent_id' => $parent_id
		));

		return $this->db->affected_rows();
	}
	//update to soft delete
	public function delete($id) {
		// $sql = "DELETE FROM tipe_produk WHERE id='" .$id ."'";
		$this->db->from('tipe_produk');
		$this->db->where('id',$id);
		$this->db->set('deleted_at','NOW()',FALSE);
		$this->db->update('tipe_produk');

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('tipe_produk');

		return $data->num_rows();
	}

	public function total_rows() {
		$this->db->select('*');
		$this->db->from('tipe_produk');
		$this->db->where('deleted_at is NULL',NULL);
		$this->db->where('terbaru', '1');
		$data = $this->db->get('');

		return $data->num_rows();
	}

	function create_product($data){
		$insert_data['nama'] = $data['nama'];
		$insert_data['harga'] = $data['harga'];
		$insert_data['foto'] = $data['foto'];
		$insert_data['terbaru'] = 1;

		$query = $this->db->insert('tipe_produk', $insert_data);
	}

}

/* End of file M_tipe_produk.php */
/* Location: ./application/models/M_tipe_produk.php */
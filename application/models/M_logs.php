<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_logs extends CI_Model {

    //on Harga Produk ------
    public $UPDATE_PRODUK = "operasi_update_data_harga_produk";
    public $HAPUS_PRODUK = "operasi_hapus_data_harga_produk";
    public $ADD_PRODUK = "operasi_tambah_data_harga_produk";

    //on Petani -----------
    public $UPDATE_PETANI = "operasi_update_data_petani";//
    public $HAPUS_PETANI = "operasi_hapus_data_petani";//


    //on Mitra ---------
    public $UPDATE_MITRA = "operasi_update_data_mitra";
    public $HAPUS_MITRA = "operasi_hapus_data_mitra";//
    public $ADD_MITRA = "operasi_tambah_data_mitra";//


    //on Kurir ---------------
    public $UPDATE_KURIR = "operasi_update_data_kurir";
    public $HAPUS_KURIR = "operasi_hapus_data_kurir";//
    public $ADD_KURIR = "operasi_tambah_data_kurir";//

    //on Admin ---------------
    public $HAPUS_ADMIN = "operasi_hapus_data_admin";//
    public $ADD_ADMIN = "operasi_tambah_data_admin";//
    public $UPDATE_ADMIN = "operasi_update_profil_admin";//
    public $UBAH_ADMIN = "operasi_update_data_admin";

    //on Dusun ----------
    public $UPDATE_DUSUN = "operasi_update_data_dusun";
    public $HAPUS_DUSUN = "operasi_hapus_data_dusun";//
    public $ADD_DUSUN = "operasi_tambah_data_dusun";//


    //on Produk -------
    public $JEMPUT_KURIR = "operasi_jemput_kurir";

    //on Transaksi -----------
    public $BATAL_TRANSAKSI = "operasi_batal_transaksi";
    public $KONFIRMASI_TRANSAKSI = "operasi_konfirmasi_transaksi";

    
	public function create($nama,$deskripsi) {
		$this->db->insert('logs',[
            "nama"=>$nama,
            "deskripsi" => $deskripsi
        ]);
	}

    public function select_all() {
		$this->db->select('*');
		$this->db->from('logs');
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
}
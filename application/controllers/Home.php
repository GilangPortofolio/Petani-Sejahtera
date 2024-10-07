<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends AUTH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_produk');
		$this->load->model('M_desa');
		$this->load->model('M_tipe_produk');
		$this->load->model('M_kurir');
		$this->load->model('M_transaksi');
		$this->load->model('M_mitra');
	}

	public function index()
	{

		$tipe_produk_nama = $this->input->get('tipe_produk_nama');
		if(empty($tipe_produk_nama)){
			$data['dataProduk'] = $this->M_produk->select_all();
			$data['dataSum'] = $this->M_produk->sum_produk();
			$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
			$data['label']  = 'Semua Jenis Produk';

		}else{
			$data['dataProduk'] = $this->M_produk->select_all_tipe_produk($tipe_produk_nama);
			$data['dataSum'] = $this->M_produk->sum_tipe($tipe_produk_nama);
			$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
			$data['label']  = $tipe_produk_nama;

		}



	
		$data['jml_user'] 	= $this->M_user->total_rows();
		$data['jml_produk'] 	= $this->M_produk->total_rows();
		$data['jml_tipe_produk'] 	= $this->M_tipe_produk->total_rows();
		$data['jml_desa'] 	= $this->M_desa->total_rows();
		$data['jml_kurir'] 	= $this->M_kurir->total_rows();
		$data['jml_transaksi'] 	= $this->M_transaksi->total_rows();
		$data['jml_mitra'] 	= $this->M_mitra->total_rows();


		$data['userdata'] 		= $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'f', 'g', 'h');



		//diagram desa
		$desa 				= $this->M_desa->select_all();
		$index = 0;
		foreach ($desa as $value) {
			$color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

			$user_by_desa = $this->M_user->select_by_desa($value->id);

			$data_desa[$index]['value'] = $user_by_desa->jml;
			$data_desa[$index]['color'] = $color;
			$data_desa[$index]['highlight'] = $color;
			$data_desa[$index]['label'] = $value->nama;

			$index++;
		}

		//diagram tipe_produk
		$tipe_produk 				= $this->M_tipe_produk->select_all();
		$index = 0;
		foreach ($tipe_produk as $value) {
			$color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

			$produk_by_tipe_produk = $this->M_produk->select_by_tipe_produk($value->id);

			$data_tipe_produk[$index]['value'] = $produk_by_tipe_produk->jml;
			$data_tipe_produk[$index]['color'] = $color;
			$data_tipe_produk[$index]['highlight'] = $color;
			$data_tipe_produk[$index]['label'] = $value->nama;

			$index++;
		}

		//diagram transaksi
		$produk 				= $this->M_produk->select_all();
		$index = 0;
		foreach ($produk as $value) {
			$color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

			$transaksi_by_produk = $this->M_transaksi->select_by_produk($value->id);

			$data_produk[$index]['value'] = $transaksi_by_produk->jml;
			$data_produk[$index]['color'] = $color;
			$data_produk[$index]['highlight'] = $color;
			$data_produk[$index]['label'] = $value->tipe_produk_nama;

			$index++;
		}

		$data['data_desa'] = json_encode($data_desa);
		$data['data_tipe_produk'] = json_encode($data_tipe_produk);
		$data['data_produk'] = json_encode($data_produk);


		$data['page'] 			= "home";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "Manage Data";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_logs');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataLogs'] 	= $this->M_logs->select_all();

		$data['page'] 		= "Logs";
		$data['judul'] 		= "Data Riwayat";
		$data['deskripsi'] 	= "View Data Riwayat";

		$this->template->views('logs/home', $data);
	}

	public function tampil() {
		$data['dataLogs'] = $this->M_logs->select_all();
		$this->load->view('logs/list_data', $data);
	}



}

/* End of file Desa.php */
/* Location: ./application/controllers/Desa.php */
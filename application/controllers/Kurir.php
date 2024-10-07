<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurir extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kurir');
		$this->load->model('M_desa');
		$this->load->model('M_mitra');
		$this->load->model('M_logs');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataKurir'] 	= $this->M_kurir->select_all();
		$data['dataDesa'] 	= $this->M_desa->select_all();
		$data['dataMitra'] 	= $this->M_mitra->select_all();

		$data['page'] 		= "Kurir";
		$data['judul'] 		= "Data Kurir";
		$data['deskripsi'] 	= "Manage Data Kurir";

		$data['modal_tambah_kurir'] = show_my_modal('modals/modal_tambah_kurir', 'tambah-kurir', $data);

		$this->template->views('kurir/home', $data);
	}

	public function tampil() {
		$data['dataKurir'] = $this->M_kurir->select_all();
		$this->load->view('kurir/list_data', $data);
	}

	// public function prosesTambah() {
	// 	$this->form_validation->set_rules('user_nik', 'NIK Kurir', 'trim|required');
	// 	$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
	// 	$this->form_validation->set_rules('id_desa', 'Dusun', 'trim|required');
	// 	$this->form_validation->set_rules('nama', 'Nama Kurir', 'trim|required');
	// 	$this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'trim|required');
	// 	$this->form_validation->set_rules('plat_no', 'Plat Nomor Kendaraan', 'trim|required');
	// 	$this->form_validation->set_rules('no_telp', 'No.Telp Kurir', 'trim|required|numeric');
	// 	$this->form_validation->set_rules('created_at', 'Tanggal Pembuatan Data', 'trim|required');
	// 	$data 	= $this->input->post();
	// 	if ($this->form_validation->run() == TRUE) {
	// 		$result = $this->M_kurir->insert($data);

	// 		if ($result > 0) {
	// 			$out['status'] = '';
	// 			$out['msg'] = show_succ_msg('Data Kurir Berhasil ditambahkan', '20px');
	// 		} else {
	// 			$out['status'] = '';
	// 			$out['msg'] = show_err_msg('Data Kurir Gagal ditambahkan', '20px');
	// 		}
	// 	} else {
	// 		$out['status'] = 'form';
	// 		$out['msg'] = show_err_msg(validation_errors());
	// 	}

	// 	echo json_encode($out);
	// }
	function kapital ($plat_no) {
		$hasil = strtoupper($plat_no);
		return $hasil;
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nik', 'NIK Kurir', 'trim|required|numeric|min_length[16]|max_length[16]|is_unique[user.nik]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('id_mitra', 'Mitra', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Kurir', 'trim|required');
		$this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'trim|required');
		$this->form_validation->set_rules('plat_no', 'Plat Nomor Kendaraan', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'No.Telp Kurir', 'trim|required|numeric|min_length[10]|max_length[15]');


		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$data['nik'] = $this->input->post('nik');
			$data['password'] = $this->input->post('password');
			$data['id_desa'] = $this->input->post('id_desa');
			$data['id_mitra'] = $this->input->post('id_mitra');
			$data['nama'] = $this->input->post('nama');
			$data['jenis_kendaraan'] = $this->input->post('jenis_kendaraan');
			$data['plat_no'] = $this->input->post('plat_no');
			$data['no_telp'] = $this->input->post('no_telp');

			$result = $this->M_kurir->create_kurir($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Kurir Gagal ditambahkan', '20px');
			} else {
				$this->M_logs->create($this->M_logs->ADD_KURIR,"1 Data Kurir Telah diTambahkan oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kurir Berhasil ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;
		$id 				= trim($_POST['id']);
		$data['dataKurir'] 	= $this->M_kurir->select_by_id($id);
		$data['dataMitra'] 	= $this->M_mitra->select_all();

		echo show_my_modal('modals/modal_update_kurir', 'update-kurir', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nama', 'Nama Kurir', 'trim|required');
		$this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'trim|required');
		$this->form_validation->set_rules('plat_no', 'Plat Nomor Kendaraan', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'No.Telp Kurir', 'trim|required|numeric|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('id_mitra', 'Nama Mitra', 'trim|required');
	    // $this->form_validation->set_rules('updated_at', 'Tanggal Update Data', 'trim|required');
		$id 				= trim($_POST['id']);

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_kurir->update($data);

			if ($result > 0) {
				$kurir = $this->M_kurir->select_by_id($id);
				$this->M_logs->create($this->M_logs->UPDATE_KURIR,"Data Kurir dengan ID:{$kurir->id} diUpdate oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kurir Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kurir Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_kurir->delete($id);
		
		if ($result > 0) {
			$this->M_logs->create($this->M_logs->HAPUS_KURIR,"1 Data Kurir Telah diHapus oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
			echo show_succ_msg('Data Kurir Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Kurir Gagal dihapus', '20px');
		}
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['kurir'] = $this->M_kurir->select_by_id($id);
		$data['jumlahKurir'] = $this->M_kurir->total_rows();
		$data['dataKurir'] = $this->M_kurir->select_by_transaksi($id);

		echo show_my_modal('modals/modal_detail_kurir', 'detail-kurir', $data, 'lg');
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_kurir->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nama kurir");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data kurir.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data kurir.xlsx', NULL);
	}

}

/* End of file kurir.php */
/* Location: ./application/controllers/kurir.php */
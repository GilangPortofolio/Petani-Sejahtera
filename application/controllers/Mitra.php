<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_mitra');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataMitra'] 	= $this->M_mitra->select_all();

		$data['page'] 		= "Mitra";
		$data['judul'] 		= "Data Mitra";
		$data['deskripsi'] 	= "Manage Data Mitra";

		$data['modal_tambah_mitra'] = show_my_modal('modals/modal_tambah_mitra', 'tambah-mitra', $data);

		$this->template->views('mitra/home', $data);
	}

	public function tampil() {
		$data['dataMitra'] = $this->M_mitra->select_all();
		$this->load->view('mitra/list_data', $data);
	}

	function kapital ($kode) {
		$hasil = strtoupper($kode);
		return $hasil;
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nama', 'Nama Mitra', 'trim|required');
		$this->form_validation->set_rules('kode', 'Kode Mitra', 'trim|required');
		$this->form_validation->set_rules('telp', 'No. Telp', 'trim|required|numeric|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		
		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_mitra->insert($data);
			$this->load->model('M_logs');

			if ($result > 0) {
				$this->M_logs->create($this->M_logs->ADD_MITRA,"1 Data Mitra diTambahkan oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Mitra Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Mitra Gagal ditambahkan', '20px');
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
		$data['dataMitra'] 	= $this->M_mitra->select_by_id($id);
		echo show_my_modal('modals/modal_update_mitra', 'update-mitra', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nama', 'Nama Mitra', 'trim|required');
		$this->form_validation->set_rules('kode', 'Kode Mitra', 'trim|required');
		$this->form_validation->set_rules('telp', 'No. Telp', 'trim|required|numeric|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

		$id 				= trim($_POST['id']);
		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_mitra->update($data);
			$this->load->model('M_logs');

			if ($result > 0) {
				$mitra = $this->M_mitra->select_by_id($id);
				$this->M_logs->create($this->M_logs->UPDATE_MITRA,"Data Mitra dengan ID:{$mitra->id} diUpdate oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Mitra Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Mitra Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id 				= trim($_POST['id']);
		$result = $this->M_mitra->delete($id);
		$this->load->model('M_logs');

		if ($result > 0) {
			$mitra = $this->M_mitra->select_by_id($id);
			$this->M_logs->create($this->M_logs->HAPUS_MITRA,"Data Mitra Telah diHapus oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
			echo show_succ_msg('Data Mitra Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Mitra Gagal dihapus', '20px');
		}
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['mitra'] = $this->M_mitra->select_by_id($id);
		$data['jumlahMitra'] = $this->M_mitra->total_rows();
		$data['dataMitra'] = $this->M_mitra->select_by_kurir($id);

		echo show_my_modal('modals/modal_detail_mitra', 'detail-mitra', $data, 'lg');
	}


}

/* End of file Mitra.php */
/* Location: ./application/controllers/Mitra.php */
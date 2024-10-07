<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_logs');
		$this->load->model('M_level');
	}
	
	public function index() {
        $data['userdata'] 	= $this->userdata;
		$data['dataAdmin'] 	= $this->M_admin->select_all();
		$data['dataLevel'] 	= $this->M_level->select_all();


		$data['page'] 		= "Admin";
		$data['judul'] 		= "Data Admin";
		$data['deskripsi'] 	= "Manage Data Admin";

		$data['modal_tambah_admin'] = show_my_modal('modals/modal_tambah_admin', 'tambah-admin', $data);

		$this->template->views('admin/home', $data);
	}

	public function tampil() {
		$data['dataAdmin'] = $this->M_admin->select_all();
		$this->load->view('admin/list_data', $data);
	}


	public function prosesTambah(){
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
			$this->form_validation->set_rules('level', 'Level', 'trim|required');

			
			$data 	= $this->input->post();
			if ($this->form_validation->run() == TRUE) {
				$data['username'] = $this->input->post('username');
				$data['password'] = $this->input->post('password');
				$data['nama'] = $this->input->post('nama');
				$data['level'] = $this->input->post('level');

				$result = $this->M_admin->insert($data);
	
				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Data Admin Gagal ditambahkan', '20px');
				} else {
					$out['status'] = '';
					$this->M_logs->create($this->M_logs->ADD_ADMIN,"1 Data Admin Telah diTambahkan oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
					$out['msg'] = show_succ_msg('Data Admin Berhasil ditambahkan', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}
	
			echo json_encode($out);
		}

		public function delete() {
			$id = $_POST['id'];
			$result = $this->M_admin->delete($id);
			
			if ($result > 0) {
				$this->M_logs->create($this->M_logs->HAPUS_ADMIN,"1 Data Admin Telah diHapus oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				echo show_succ_msg('Data Admin Berhasil dihapus', '20px');
			} else {
				echo show_err_msg('Data Admin Gagal dihapus', '20px');
			}
		}

		public function update() {
			$data['userdata'] 	= $this->userdata;
			$id 				= trim($_POST['id']);
			$data['dataAdmin'] 	= $this->M_admin->select_by_id($id);
			$data['dataLevel'] 	= $this->M_level->select_all();
	
			echo show_my_modal('modals/modal_update_admin', 'update-admin', $data);
		}
	
		public function prosesUpdate() {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('level', 'Level', 'trim|required');

			$id 				= trim($_POST['id']);
	
			$data 	= $this->input->post();
			if ($this->form_validation->run() == TRUE) {
				$result = $this->M_admin->update_admin($data);
	
				if ($result > 0) {
					$admin = $this->M_admin->select_by_id($id);
					$this->M_logs->create($this->M_logs->UBAH_ADMIN,"Data Admin dengan ID:{$admin->id} diUpdate oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Admin Berhasil diupdate', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Admin Gagal diupdate', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}
	
			echo json_encode($out);
		}
	
	}


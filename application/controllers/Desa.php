<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_desa');
		$this->load->model('M_logs');

	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataDesa'] 	= $this->M_desa->select_all();

		$data['page'] 		= "Desa";
		$data['judul'] 		= "Data Dusun";
		$data['deskripsi'] 	= "Manage Data Dusun";

		$data['modal_tambah_desa'] = show_my_modal('modals/modal_tambah_desa', 'tambah-desa', $data);

		$this->template->views('desa/home', $data);
	}

	public function tampil() {
		$data['dataDesa'] = $this->M_desa->select_all();
		$this->load->view('desa/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('desa', 'desa', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_desa->insert($data);

			if ($result > 0) {
				$this->M_logs->create($this->M_logs->ADD_DUSUN,"1 Data Dusun diTambahkan oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Dusun Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Dusun Gagal ditambahkan', '20px');
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
		$data['dataDesa'] 	= $this->M_desa->select_by_id($id);
		echo show_my_modal('modals/modal_update_desa', 'update-desa', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('desa', 'desa', 'trim|required');

		$id 				= trim($_POST['id']);
		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_desa->update($data);

			if ($result > 0) {
				$desa = $this->M_desa->select_by_id($id);
				$this->M_logs->create($this->M_logs->UPDATE_DUSUN,"Dusun dengan ID:{$desa->id} diUpdate oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Dusun Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Dusun Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_desa->delete($id);

		if ($result > 0) {
			$desa = $this->M_desa->select_by_id($id);
			$this->M_logs->create($this->M_logs->HAPUS_DUSUN,"1 Data Dusun Telah diHapus oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
			echo show_succ_msg('Data Dusun Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Dusun Gagal dihapus', '20px');
		}
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['desa'] = $this->M_desa->select_by_id($id);
		$data['jumlahDesa'] = $this->M_desa->total_rows();
		$data['dataDesa'] = $this->M_desa->select_by_user($id);

		echo show_my_modal('modals/modal_detail_desa', 'detail-desa', $data, 'lg');
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_desa->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nama Desa");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Desa.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Desa.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$check = $this->M_desa->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_desa->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data desa Berhasil diimport ke database'));
						redirect('Desa');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Desa Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Desa');
				}

			}
		}
	}
}

/* End of file Desa.php */
/* Location: ./application/controllers/Desa.php */
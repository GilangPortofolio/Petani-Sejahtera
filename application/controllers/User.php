<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_desa');
		$this->load->model('M_logs');

	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataUser'] = $this->M_user->select_all();
		$data['dataDesa'] = $this->M_desa->select_all();
		$data['page'] = "User";
		$data['judul'] = "Data Petani";
		$data['deskripsi'] = "Manage Data Petani";


		$this->template->views('user/home', $data);
	}

	public function tampil() {
		$data['dataUser'] = $this->M_user->select_all();
		$this->load->view('user/list_data', $data);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataUser'] = $this->M_user->select_by_id($id);
		$data['dataDesa'] = $this->M_desa->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_user', 'update-user', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nik', 'NIK Petani', 'trim|required|numeric|min_length[16]|max_length[16]');
		$this->form_validation->set_rules('nama', 'Nama Petani', 'trim|required');
		$this->form_validation->set_rules('id_desa', 'Asal Dusun', 'trim|required');
		$this->form_validation->set_rules('telp', 'No.Telp Petani', 'trim|required');

		$id 				= trim($_POST['id']);
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_user->update($data);

			if ($result > 0) {
				
				$out['status'] = '';
				$this->M_logs->create($this->M_logs->UPDATE_PETANI,"Data Petani Telah diUpdate oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['msg'] = show_succ_msg('Data Petani Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Petani Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}


	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['user'] = $this->M_user->select_by_id($id);
		$data['jumlahUser'] = $this->M_user->total_rows();
		$data['dataUser'] = $this->M_user->select_by_produk($id);

		echo show_my_modal('modals/modal_detail_user', 'detail-user', $data, 'lg');
	}


	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_user->delete($id);

		if ($result > 0) {
			$this->M_logs->create($this->M_logs->HAPUS_PETANI,"Data Petani Telah diHapus oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
			echo show_succ_msg('Data Petani Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Petani Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_user->select_all_user();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; //judul
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "No.");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "NIK");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Nama Petani");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "No.Telp");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "ID Desa");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Luas Lahan");
		$rowCount++;

		$column = 2;//untuk kolom start
		foreach($data as $value){
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$column, ($column-1));
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$column, $value->id); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$column, $value->nik, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$column, $value->nama); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$column, $value->telp, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$column, $value->desa_nama); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$column, $value->total_luas_lahan);  
		    $column++; 
		} 

		//set autosize
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

		//style
		$stil=array(
            'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => '000000')
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '36FF94')
			  )

        );
		$stay=array(
		'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN,
			  'color' => array('rgb' => '000000')
			  
			)
			));
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($stil);
		$objPHPExcel->getActiveSheet()->getStyle('A1:G'.($column-1))->applyFromArray($stay);

		
		//save as .xlsx
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data User.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data User.xlsx', NULL);
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
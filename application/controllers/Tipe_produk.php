<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe_produk extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_tipe_produk');
		$this->load->model('M_logs');
		
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();

		$data['page'] 		= "Tipe Produk";
		$data['judul'] 		= "Data Harga Produk";
		$data['deskripsi'] 	= "Manage Data Harga Produk";

		$data['modal_tambah_tipe_produk'] = show_my_modal('modals/modal_tambah_tipe_produk', 'tambah-tipe_produk', $data);

		$this->template->views('tipe_produk/home', $data);
	}

	public function tampil() {
		$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
		$data['dataHistoryProduk'] = $this->M_tipe_produk->select_all_history();
		$this->load->view('tipe_produk/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nama', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga Produk', 'trim|required|numeric');
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$data['nama'] = $this->input->post('nama', TRUE);
			$data['harga'] = $this->input->post('harga', TRUE);
			$data['terbaru'] = $this->input->post('terbaru', TRUE);

			$config['upload_path']          = './assets/thumbnail/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['encrypt_name'] 		= TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
			}else{
				$data_foto = $this->upload->data();
				$data['foto'] = $data_foto['file_name'];
			}
			$result = $this->M_tipe_produk->create_product($data);
			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Harga Produk Gagal dibuat', '20px');
			} else {
				
				$out['status'] = '';
				$this->M_logs->create($this->M_logs->ADD_PRODUK,"1 Data Harga Produk Telah diTambahkan oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['msg'] = show_succ_msg('Data Harga Produk Berhasil dibuat', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}


// 	public function Tambah() {
// 		$this->form_validation->set_rules('nama', 'Nama Produk', 'required');
// 		$this->form_validation->set_rules('harga', 'Harga Produk', 'required');

// 		$data = $this->input->post();
// 		if ($this->form_validation->run() == TRUE) {
// 			$data['nama'] = $this->input->post('nama', TRUE);
// 			$data['harga'] = $this->input->post('harga', TRUE);
// 			$data['terbaru'] = $this->input->post('terbaru', TRUE);

			

// 			$config['upload_path']          = './assets/thumbnail/';
// 			$config['allowed_types']        = 'jpg|png';
// 			$config['encrypt_name'] 		= TRUE;

// 			$this->load->library('upload', $config);

// 			if ( ! $this->upload->do_upload('foto')){
// 				$error = array('error' => $this->upload->display_errors());
// 			}else{
// 				$data_foto = $this->upload->data();
// 				$data['foto'] = $data_foto['file_name'];
// 				// $this->M_tipe_produk->store_pic_data($data);
// 				// redirect('tipe_produk');
// 			}
// 			$result = $this->M_tipe_produk->store_pic_data($data);
// 			if ($result < 0) {
// 				$this->session->set_flashdata('msg', show_err_msg('Data Harga Produk Gagal ditambahkan'));
// 				redirect('tipe_produk');
// 			} else {
// 				$this->session->set_flashdata('msg', show_succ_msg('Data Harga Produk Berhasil ditambahkan'));
// 				redirect('tipe_produk');
// 			}
// 		}else {
// 			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
// 			redirect('tipe_produk');
// 	}

// }


	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dataTipe_produk'] = $this->M_tipe_produk->select_by_id($id);

		echo show_my_modal('modals/modal_update_tipe_produk', 'update-tipe_produk', $data);
	}

	public function prosesUpdate() {
		// $this->form_validation->set_rules('foto', 'foto', 'trim');
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		

		$nama 				= trim($_POST['nama']);
		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_tipe_produk->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$tipe_produk = $this->M_tipe_produk->select_by_nama($nama);
				$this->M_logs->create($this->M_logs->UPDATE_PRODUK,"Data Harga Produk Jenis:{$tipe_produk->nama} diUpdate oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
				$out['msg'] = show_succ_msg('Data Harga Produk Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Harga Produk Gagal diupdate', '20px');
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
		$data['tipe_produk'] = $this->M_tipe_produk->select_by_id($id);
		$data['jumlahTipe_produk'] = $this->M_tipe_produk->total_rows();
		$data['dataTipe_produk'] = $this->M_tipe_produk->select_by_produk($id);

		echo show_my_modal('modals/modal_detail_tipe_produk', 'detail-tipe_produk', $data, 'lg');
	}




	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_tipe_produk->delete($id);

		if ($result > 0) {
			$tipe_produk = $this->M_tipe_produk->select_by_id($id);
			$this->M_logs->create($this->M_logs->HAPUS_PRODUK,"Data Harga Produk dengan ID:{$tipe_produk->id} diHapus oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
			echo show_succ_msg('Data Harga Produk Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Harga Produk Gagal dihapus', '20px');
		}
	}


	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_tipe_produk->select_all_tipe_produk();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; //judul
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "No.");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Nama Produk");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Harga");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Tanggal Di Tetapkan");
		$rowCount++;

		$column = 2;//untuk kolom start
		foreach($data as $value){
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$column, ($column-1));
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$column, $value->id); 
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$column, $value->nama); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$column, $value->harga, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->setCellValue('E'.$column, $value->tanggal);    
		    $column++; 
		} 

		//set autosize
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);


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
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($stil);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E'.($column-1))->applyFromArray($stay);

		
		//save as .xlsx
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Harga Produk.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Harga Produk.xlsx', NULL);
	}
}

/* End of file Tipe_produk.php */
/* Location: ./application/controllers/Tipe_produk.php */
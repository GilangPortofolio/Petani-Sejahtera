<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_produk');
		$this->load->model('M_user');
		$this->load->model('M_tipe_produk');
		$this->load->model('M_kurir');
		$this->load->model('M_status_produk');
		$this->load->model('M_transaksi');
		$this->load->model('M_logs');

	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataProduk'] = $this->M_produk->select_all();
		$data['dataUser'] = $this->M_user->select_all();
		$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
		$data['dataStatus_produk'] = $this->M_status_produk->select_all();
		$data['page'] = "Produk";
		$data['judul'] = "Data E-Commodity";
		$data['deskripsi'] = "Manage Data E-Commodity";
		$data["alamat"] = "Alamat";

		$this->template->views('produk/home', $data);
	}



	public function tampil() {
		$data['dataProduk'] = $this->M_produk->select_all();
		$data['dataTransaksi'] = $this->M_transaksi->select_all_transaksi();

		$this->load->view('produk/list_data', $data);
	}


	public function update() {
		$id = trim($_POST['id']);

		$data['dataProduk'] = $this->M_produk->select_by_id($id);
		$data['dataUser'] = $this->M_user->select_all();
		$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
		$data['dataStatus_produk'] = $this->M_status_produk->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_produk', 'update-produk', $data);
	}

	public function penjemputan(){
		$data['userdata'] = $this->userdata;
		$id 			  = trim($_POST['id']);
		$produk = $this->M_produk->select_by_id($id);
		$data['dataProduk'] = $produk;
		$data['dataUser'] = $this->M_user->select_by_id($produk->id_user);
		$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
		$data['dataKurir'] = $this->M_kurir->select_all();
		$data['dataStatus_produk'] = $this->M_status_produk->select_all();


		echo show_my_modal('modals/modal_penjemputan', 'penjemputan', $data);
	}

	public function prosesPenjemputan() {
		$this->form_validation->set_rules('id', 'Nama User', 'trim|required');
		$this->form_validation->set_rules('id_kurir', 'Id Kurir', 'trim|required');
		$this->form_validation->set_rules('date','Tanggal Penjemputan','trim|required');
		$this->form_validation->set_rules('harga','Harga','trim|required|numeric');
		$this->form_validation->set_rules('jam_penjemputan','Jam Penjemputan', 'trim|required');
		//min today
		$date = new DateTime($this->input->post('date'));
		$today = new DateTime();
		if($date < $today){
			$out['status'] = 'form';
			$out['msg'] = show_err_msg('Tanggal harus lebih besar dari sekarang');
			echo json_encode($out);
		}else{
			
			$data = $this->input->post();
			if ($this->form_validation->run() == TRUE) {
				$id_produk = $this->input->post('id');
				$produk = $this->M_produk->select_by_id($id_produk);
				$tanggalPanen = new DateTime($produk->tgl_panen);
				
				if($date < $tanggalPanen){
					$out['status'] = 'form';
					$out['msg'] = show_err_msg('Tanggal harus lebih besar besar dari tanggal panen\n Tanggal panen adalah '.$tanggalPanen->format('Y-m-d H:i:s').'');
				}else{
					
					$id_kurir = $this->input->post('id_kurir');
					$date = $this->input->post('date');
					$jam = $this->input->post('jam_penjemputan');
					$harga = $this->input->post('harga');
					$transaction_id = $this->M_transaksi->create_transaction($id_produk,$id_kurir,$date,$jam,$harga);
					
					if ($transaction_id > 0) {
						//create notification
						$this->load->model('M_notifications');
						$user_kurir_id = $this->M_user->get_user_id_by_kurir_id($id_kurir);
						$this->load->model('M_notifications');
						$this->M_notifications->create($transaction_id,$user_kurir_id, 1, 'Terdapat 1 tugas baru');
						$this->M_notifications->create($transaction_id,$produk->id_user, 8, 'Kadin sudah menugaskan penjemputan panenmu');
						$this->M_notifications->sendNotificationsToUser($user_kurir_id,"Ada order baru dari KADIN");
						$this->m_notifications->sendNotificationsToUser($produk->id_user,"Kadin sudah menjadwalkan penjemputan!");

						//logs admin
						$this->M_logs->create($this->M_logs->JEMPUT_KURIR,"Data E-Commodity dengan ID:{$produk->id_produk} diJemput oleh Kurir dengan ID:{$id_kurir}, dan diKonfirmasi oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data E-Commodity Berhasil diJemput', '20px');
					} else {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data E-Commodity Gagal diJemput', '20px');
					}
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}
			
			echo json_encode($out);
		}
	}


	  public function detail() {
	  	$data['userdata'] 	= $this->userdata;

	  	$id 				= trim($_POST['id']);
	  	$data['produk'] = $this->M_produk->select_by_id($id);
		  var_dump($data['produk']);
	  	echo show_my_modal('modals/modal_detail_produk', 'detail-produk', $data, 'lg');
	  }



	public function prosesUpdate() {
		$this->form_validation->set_rules('id_user', 'Nama User', 'trim|required');
		$this->form_validation->set_rules('berat_panen', 'Berat Panen', 'trim|required');
		$this->form_validation->set_rules('luas_lahan', 'Luas Lahan', 'trim|required');
		$this->form_validation->set_rules('id_tipe_produk', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('id_status_produk', 'Status', 'trim|required');	
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');


		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_produk->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data E-Commodity Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data E-Commodity Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}


	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_produk->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data E-Commodity Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data E-Commodity Gagal dihapus', '20px');
		}
	}


	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_produk->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 


		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "No.");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "NIK");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Nama Petani");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Nama produk");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Tanggal Tanam");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Tanggal Panen");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Berat Panen (/kg)");
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "Luas Lahan (m2)");
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "Alamat");
		$rowCount++;


		$column = 2;
		foreach($data as $value){
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$column, ($column-1));
		    $objPHPExcel->getActiveSheet()->SetCellValueExplicit('B'.$column, $value->user_nik, PHPExcel_Cell_DataType::TYPE_STRING); 
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$column, $value->user_nama); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$column, $value->tipe_produk_nama); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$column, $value->tgl_tanam); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$column, $value->tgl_panen); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$column, $value->berat_panen); 
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$column, $value->luas_lahan); 
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$column, $value->alamat); 
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

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
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($stil);
		$objPHPExcel->getActiveSheet()->getStyle('A1:I'.($column-1))->applyFromArray($stay);
 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data E-Commodity.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data E-Commodity.xlsx', NULL);
	}

	public function load_status(){
	  $status_produk = $_GET['id_status_produk'];
	  if (empty($status_produk)) {
		$data = $this->M_produk->select_all();
	  }
	  else
	  {
		$data = $this->M_produk->select_by_status($status_produk);
	  }
	  if (!empty($data)) 
	  {
		function rupiah ($harga) {
			$hasil = 'Rp ' . number_format($harga, 2, ",", ".");
			return $hasil;
		}
	  foreach ($data as $row) {
		?>
    <tr>
      <td><?php echo $row->user_nik; ?></td>
      <td><?php echo $row->user_nama; ?></td>
      <td><?php echo $row->tipe_produk_nama; ?></td>
      <td><?php echo $row->tgl_tanam; ?></td>
      <td><?php echo $row->tgl_panen; ?></td>
      <td><?php echo $row->berat_panen; ?> kg</td>
      <td><?php echo $row->berat_asli; ?> kg</td>
      <td><?php echo rupiah ($row->tipe_produk_harga); ?></td>
      <td><?php echo $row->luas_lahan; ?> m<sup>2</sup></td>
      <td><?php echo $row->alamat; ?></td>

      <?php if($this->session->userdata('level') != 3) { ?>
      <td><?php echo $row->status_produk_nama; ?></td>
      <td class="text-center" style="min-width:110px;">

      <button class="btn btn-info detail-dataProduk" data-id="<?php echo $row->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> </button>
      <!-- <button class="btn btn-warning update-dataProduk" data-id="<?php echo $row->id; ?>"><i class="glyphicon glyphicon-edit"></i></button> -->
      <?php  if($row->status_produk_id == 3)
      {
        ?>
         <button class="btn btn-success penjemputan" data-id="<?php echo $row->id; ?>"><i class="glyphicon glyphicon-plane"></i></button>
        <?php
      }
      ?>

      </td>
      <?php } ?>
    </tr>
 <?php
	  
	}
}else    {
	?>
	  <tr><td align="center">Tidak ada data</td></tr>
	<?php
  }
}
}
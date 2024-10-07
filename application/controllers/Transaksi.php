<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_transaksi');
		$this->load->model('M_kurir');
		$this->load->model('M_user');
		$this->load->model('M_produk');
		$this->load->model('M_status_transaksi');
		$this->load->model('M_logs');
		$this->load->model('M_tipe_produk');

	}

	public function index() {
		$tgl_awal = $this->input->get('tgl_awal'); 
        $tgl_akhir = $this->input->get('tgl_akhir');
		
		// if(!empty($tgl_awal) or !empty($tgl_akhir) or !empty($nama_produk)){
		// 	$data['dataTransaksi'] = $this->M_transaksi->view_by_all($tgl_awal, $tgl_akhir, $nama_produk);
		// 	$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
        //     $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
        //     $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); 
        //     $data['label'] = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
		// 	$data['label1']  = $nama_produk;
		// 	$data['url_cetak']  = $data['url_cetak'] = 'transaksi/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&nama_produk='.$nama_produk;


		// }elseif(empty($tgl_awal) and empty($tgl_akhir) and !empty($nama_produk)){
		// 	$data['dataTransaksi'] = $this->M_transaksi->view_by_produk($nama_produk);
		// 	$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
        //     $data['label'] = 'Semua Periode';
		// 	$data['label1']  = $nama_produk;
		// 	$data['url_cetak']  = $data['url_cetak'] = 'transaksi/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&nama_produk='.$nama_produk;


		// }elseif(!empty($tgl_awal) and !empty($tgl_akhir) and empty($nama_produk)) {
		// 	$data['dataTransaksi'] = $this->M_transaksi->view_by_date($tgl_awal, $tgl_akhir);
		// 	$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
        //     $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
        //     $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); 
        //     $data['label'] = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
		// 	$data['label1']  = 'Semua Jenis Produk';
		// 	$data['url_cetak']  = $data['url_cetak'] = 'transaksi/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&nama_produk='.$nama_produk;

	
		// }elseif(empty($tgl_awal) or empty($tgl_akhir) and empty($nama_produk)){
        //     $data['dataTransaksi'] = $this->M_transaksi->select_all(); 
		// 	$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
        //     $data['label']  = 'Semua Periode';
		// 	$data['label1']  = 'Semua Jenis Produk';
		// 	$data['url_cetak']  = $data['url_cetak'] = 'transaksi/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&nama_produk='.$nama_produk;

		// }else{			
		// 	echo "data tidak ada";
		// }
		
		

		
        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $data['dataTransaksi'] = $this->M_transaksi->select_all();  // Panggil fungsi select_all yang ada di M_transaksi
			$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
            $data['url_cetak']  = 'transaksi/cetak';
            $data['label']  = 'Semua Periode';
		}else{			
			$data['dataTransaksi'] = $this->M_transaksi->view_by_date($tgl_awal, $tgl_akhir);
			$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
			$data['url_cetak'] = 'transaksi/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $data['label'] = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			// $data['label1']  = $nama_produk;

		}


		// $data['dataTransaksi'] 	= $this->M_transaksi->select_all();
	    // $data['dataKurir'] 	= $this->M_kurir->select_all();
		// $data['dataUser'] 	= $this->M_user->select_all();
	    // $data['dataProduk'] 	= $this->M_produk->select_all();
		// $data['dataStatus_transaksi'] 	= $this->M_status_transaksi->select_all();
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "Transaksi";
		$data['judul'] 		= "Data transaksi";
		$data['deskripsi'] 	= "Manage Data transaksi";

		$data['modal_tambah_transaksi'] = show_my_modal('modals/modal_tambah_transaksi', 'tambah-transaksi', $data);

		$this->template->views('transaksi/home', $data);
	}

	public function cetak(){
		$tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
		// $nama_produk = $this->input->get('nama_produk'); 

        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $data['dataTransaksi']  = $this->M_transaksi->select_all();  // Panggil fungsi select_all yang ada di M_transaksi
            $label = 'Semua Periode';

        }else{ // Jika terisi
            $data['dataTransaksi']  = $this->M_transaksi->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di M_transaksi
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
        }

		// if(empty($tgl_awal) or empty($tgl_akhir) and empty($nama_produk)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
        //     $data['dataTransaksi'] = $this->M_transaksi->select_all();  // Panggil fungsi select_all yang ada di M_transaksi
		// 	$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
        //     $data['url_cetak']  = 'transaksi/cetak';
        //     $data['label']  = 'Semua Periode';
		// 	$data['label1']  = 'Semua Jenis Produk';
		// }else{			
		// 	$data['dataTransaksi'] = $this->M_transaksi->view_by_all($tgl_awal, $tgl_akhir, $nama_produk);
		// 	$data['dataTipe_produk'] = $this->M_tipe_produk->select_all();
		// 	$data['url_cetak'] = 'transaksi/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir.'&nama_produk='.$nama_produk;
        //     $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
        //     $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
        //     $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
		// 	$label1  = $nama_produk;

		// }

        $data['label'] = $label;
		// $data['label1'] = $label1;


		ob_start();
		$this->load->view('print', $data);
		$html = ob_get_contents();
        ob_end_clean();

		require './assets/html2pdf/autoload.php'; // Load plugin html2pdfnya

		$pdf = new Spipu\Html2Pdf\Html2Pdf('L','A3','en');  // Settingan PDFnya
		$pdf->WriteHTML($html);
		$pdf->Output('Data Transaksi.pdf', 'D');
	}

	public function tampil() {
		$data['dataTransaksi'] = $this->M_transaksi->select_all();
		$this->load->view('transaksi/list_data', $data);
	}


	public function prosesTambah() {
		$this->form_validation->set_rules('no_resi', 'Nomor Resi', 'trim|required');
		$this->form_validation->set_rules('tanggal_pengambilan', 'Tanggal Pengambilan', 'trim|required');
		$this->form_validation->set_rules('tanggal_diambil', 'Tanggal Diambil', 'trim|required');
		 $this->form_validation->set_rules('id_kurir', 'Kurir', 'trim|required');		
		 $this->form_validation->set_rules('id_user', 'Petani', 'trim|required');	
		$this->form_validation->set_rules('id_produk', 'Produk', 'trim|required');
		$this->form_validation->set_rules('tanggal_sampai', 'Tanggal Sampai', 'trim|required');
		$this->form_validation->set_rules('biaya_angkut', 'Jumlah Biaya Angkut', 'trim|required|numeric');
		$this->form_validation->set_rules('id_status_transaksi', 'Status Transaksi', 'trim|required');
		$this->form_validation->set_rules('created_at', 'Tanggal Data Dibuat', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_transaksi->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data transaksi Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data transaksi Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataTransaksi'] = $this->M_transaksi->select_by_id($id);
		$data['dataUser'] = $this->M_user->select_all();
		$data['dataProduk'] = $this->M_produk->select_all();
		$data['dataStatus_transaksi'] = $this->M_status_transaksi->select_all();
		$data['dataKurir'] = $this->M_kurir->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_transaksi', 'update-transaksi', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('no_resi', 'Nomor Resi', 'trim|required');
		// $this->form_validation->set_rules('tanggal_pengambilan', 'Tanggal Pengambilan', 'trim|required');
		// $this->form_validation->set_rules('tanggal_diambil', 'Tanggal Diambil', 'trim|required');
		$this->form_validation->set_rules('id_kurir', 'Kurir', 'trim|required');		
		$this->form_validation->set_rules('id_user', 'User', 'trim|required');	
		// $this->form_validation->set_rules('id_produk', 'Produk', 'trim|required');	
		$this->form_validation->set_rules('tanggal_sampai', 'Tanggal Sampai', 'trim|required');
		$this->form_validation->set_rules('biaya_angkut', 'Jumlah Biaya Angkut', 'trim|required|numeric');
		$this->form_validation->set_rules('id_status_transaksi', 'Status Transaksi', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_transaksi->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Transaksi Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Transaksi Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];

		$hasil = $this->M_transaksi->batal_transaksi($id); 
		
		if ($hasil == 'success') {
			$this->load->model('M_notifications');
			$transaksi = $this->M_transaksi->select_by_id($id);
			$user_id_kurir = $this->M_user->get_user_id_by_kurir_id($transaksi->id_kurir);
			$this->M_notifications->create($this->userdata->id,$user_id_kurir,3,"Transaksi {$transaksi->no_resi} dibatalkan oleh kurir");
			$this->M_logs->create($this->M_logs->BATAL_TRANSAKSI,"Transaksi dengan No Resi:{$transaksi->no_resi} diBatalkan oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
			echo show_succ_msg('Data transaksi Berhasil dibatalkan', '20px');
		} else {
			echo show_err_msg('Data transaksi Gagal dibatalkan', '20px');
		}
	}

	public function konfirmasi() {
		$id = $_POST['id'];

		$result = $this->M_transaksi->konfirmasi_transaksi($id); 

		if ($result == 'success') {
			$transaksi = $this->M_transaksi->select_by_id($id);
			$this->M_logs->create($this->M_logs->KONFIRMASI_TRANSAKSI,"Transaksi dengan No Resi:{$transaksi->no_resi} diKonfirmasi oleh Admin:{$this->userdata->id}, Nama:{$this->userdata->nama}");
			echo show_succ_msg('Data Transaksi Berhasil dikonfirmasi', '20px');
		} else {
			echo show_err_msg('Data Transaksi Gagal dikonfirmasi', '20px');
		}
	}


	public function load_status(){
		$tipe_produk = $_GET['nama_produk'];
		if (empty($tipe_produk)) {
		  $data = $this->M_transaksi->select_all();
		}
		else
		{
		  $data = $this->M_transaksi->select_by_tipe($tipe_produk);
		}
		if (!empty($data)) 
		{
			$no = 1;

			function rupiah($harga)
			{
			  $hasil = 'Rp ' . number_format($harga, 2, ",", ".");
			  return $hasil;
			}
			foreach ($data as $transaksi) {
			?>
			  <tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $transaksi->no_resi; ?></td>
				<td><?php echo $transaksi->tanggal_pengambilan; ?></td>
				<td><?php echo $transaksi->tanggal_diambil; ?></td>
				<td><?php echo $transaksi->nama_kurir; ?></td>
				<td><?php echo $transaksi->nama_user; ?></td>
				<td><?php echo $transaksi->nama_produk; ?></td>
				<td><?php echo $transaksi->id_produk; ?></td>
				<td><?php echo $transaksi->tanggal_sampai; ?></td>
				<td><?php echo rupiah($transaksi->biaya_angkut); ?></td>
  
				<?php if ($this->session->userdata('level') != 3) { ?>
				  <td><?php echo $transaksi->nama_status; ?></td>
				  <td class="text-center" style="min-width:100px;">
					<!-- <a href="transaksi/cethak" data-id="<?php echo $transaksi->id; ?>" ><button class="btn btn-secondary"><i class="fa fa-file-pdf-o"></i></button></a> -->
  
					<!-- <button class="btn btn-warning update-dataTransaksi" data-id="<?php echo $transaksi->id; ?>"><i class="glyphicon glyphicon-edit"></i> </button> -->
					<?php
					if ($transaksi->id_status_transaksi != 3 and $transaksi->id_status_transaksi != 4) {
					?>
					  <button class="btn btn-danger konfirmasiHapus-transaksi" data-id="<?php echo $transaksi->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-ban-circle"></i> </button>
					<?php
					}
					?>
  
					<?php
					if ($transaksi->status_produk_id == 4 and $transaksi->id_status_transaksi == 2 and $transaksi->sudah_dikonfirmasi_petani == 1) {
					?>
					  <button class="btn btn-secondary konfirmasi-transaksi" data-id="<?php echo $transaksi->id; ?>" data-toggle="modal" data-target="#konfirmasiTransaksi"><i class="glyphicon glyphicon-ok"></i> </button>
					<?php
					}
					?>
  
  
					<!-- <button class="btn btn-info detail-dataDesa" data-id="<?php echo $transaksi->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button> -->
				  </td>
				<?php } ?>
			  </tr>
			<?php
			  $no++;
			}
  }else{
	?>
	  <tr><td align="center">Tidak ada data</td></tr>
	<?php
  }
  }

}

/* End of file transaksi.php */
/* Location: ./application/controllers/transaksi.php */
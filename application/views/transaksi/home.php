<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<?php if ($this->session->userdata('level') != 3) { ?>

<div class="box">

  <div class="box-header">
    <form method="get" action="<?php echo base_url('transaksi') ?>">
      <div class="row">
        <div class="col-sm-6 col-md-5">
          <div class="form-group">
            <label>Cetak Laporan :</label> <?php echo $label ?>

            <div class="input-group">
              <input type="text" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
              <span class="input-group-addon">s/d</span>
              <input type="text" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_awal" placeholder="Tanggal Akhir" autocomplete="off">
              <!-- <span class="input-group-addon">Jenis</span> -->
              <!-- <select name="nama_produk" value="<?= @$_GET['nama_produk'] ?>" class="form-control nama_produk">
              <option value="">-Pilih Jenis-</option>
        <?php
        foreach ($dataTipe_produk as $tipe) {
        ?>
          <option value="<?php echo $tipe->nama; ?>">
            <?php echo $tipe->nama; ?>
          </option>
          <?php
        }
          ?>
        </select> -->
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-2" style="margin-top: 25px;">
          <button type="submit" name="filter" value="true" class="btn-sm btn-primary">SET PERIODE</button>
          <?php
          if (isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
            echo '<a href="' . base_url('transaksi') . '" class="btn-sm btn-default">RESET</a>';
          ?>
        </div>

        <div class="col-sm-6 col-md-2">
        <tr>
          <td>
            <label><b>Select Tipe Produk</b></label>
            <select name="nama_produk" class="form-control" id="nama_produk">
              <option value="">Show All</option>
              <?php
              foreach ($dataTipe_produk as $tipe) {
              ?>
                <option value="<?php echo $tipe->nama; ?>">
                  <?php echo $tipe->nama; ?>
                </option>
              <?php
              }
              ?>

            </select>
          </td>
        </tr>
      </div>
      </div>
      <a href="<?php echo $url_cetak ?>" class="btn-sm btn-danger">CETAK PDF<i class="fa fa-file-pdf-o"></i></a>





  </div>

  </form>





  <!-- /.box-header -->
  <div class="box-body table-responsive p-0">
    <table id="list-data" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nomor Resi</th>
          <th>Tanggal Pengambilan</th>
          <th>Tanggal Diambil</th>
          <th>Nama Kurir</th>
          <th>Nama Petani</th>
          <th>Nama Produk</th>
          <th>ID Produk</th>
          <th>Tanggal Sampai</th>
          <th>Biaya Angkut</th>

          <?php if ($this->session->userdata('level') != 3) { ?>
            <th>Status</th>
            <th style="text-align: center;">Action</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody id="data-transaksii">
        <?php
        $no = 1;

        function rupiah($harga)
        {
          $hasil = 'Rp ' . number_format($harga, 2, ",", ".");
          return $hasil;
        }
        foreach ($dataTransaksi as $transaksi) {
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
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>


<?php echo $modal_tambah_transaksi; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataTransaksi', 'Batalkan Transaksi Ini?', 'Ya, Batalkan Transaksi Ini'); ?>
<?php show_my_confirm('konfirmasiTransaksi', 'konfirmasi-dataTransaksi', 'Konfirmasi Transaksi Ini?', 'Ya, Konfirmasi Transaksi Ini'); ?>

<?php
$data['judul'] = 'Transaksi';
$data['url'] = 'Transaksi/import';
echo show_my_modal('modals/modal_import', 'import-transaksi', $data);
?>


<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
  $(document).ready(function() {
    //jika data sudah siap maka akan dijalangkan
    status();
    $("#nama_produk").change(function() {
      // ini dijalankan ketika ada event dari combo box
      status();
    });
  });

  function status() {
    var tipe_produk = $("#nama_produk").val();
    $.ajax({
      url: "<?= base_url('Transaksi/load_status') ?>",
      data: "nama_produk=" + tipe_produk,
      success: function(data) {
        $("#data-transaksii").html(data);
        refresh();
      }
    });
  }
</script>


<!-- Include File JS Custom (untuk fungsi Datepicker) -->
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script>
  $(document).ready(function() {
    setDateRangePicker(".tgl_awal", ".tgl_akhir")
  })
</script>
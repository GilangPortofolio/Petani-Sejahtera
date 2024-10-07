<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<?php if($this->session->userdata('level') != 2) { ?>
<div class="box">
  <div class="box-header">
    <div class="col-md-2" style="padding: 0;">
    <?php if($this->session->userdata('level') == 1) { ?>
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-desa"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
      <?php } ?>
      </div>
    <!-- <div class="col-md-6">
        <a href="<?php echo base_url('Desa/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Export Data Excel</a>
    </div> -->
 </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive p-0">
    <table id="list-data" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Dusun</th>
          <?php if($this->session->userdata('level') == 1) { ?>
          <th style="text-align: center;">Action</th>
      <?php } ?>
        </tr>
      </thead>
      <tbody id="data-desa">

      </tbody>
    </table>
  </div>
</div>
<?php } ?>

<?php echo $modal_tambah_desa; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataDesa', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Desa';
  $data['url'] = 'Desa/import';
  echo show_my_modal('modals/modal_import', 'import-desa', $data);
?>
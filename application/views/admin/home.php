<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<?php if($this->session->userdata('level') == 1) { ?>

<div class="box">
  <div class="box-header">
    <div class="col-md-2" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-admin"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Admin</button>
      </div>

  </div>

  <!-- /.box-header -->
  <div class="box-body table-responsive p-0">
    <table id="list-data" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th style="width:10px">ID</th>
          <th style="width:80px">Foto</th>
          <th>Username</th>
          <th>Nama</th>
          <th style="width:60px">Level</th>
          <?php if($this->session->userdata('level') == 1) { ?>
          <th style="text-align: center;">Action</th>
      <?php } ?>
        </tr>
      </thead>
      <tbody id="data-admin">

      </tbody>
    </table>
  </div>
</div>

<?php } ?>


<?php echo $modal_tambah_admin; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataAdmin', 'Hapus Admin Ini?', 'Ya, Hapus Admin Ini'); ?>
<?php
  $data['judul'] = 'Admin';

?>
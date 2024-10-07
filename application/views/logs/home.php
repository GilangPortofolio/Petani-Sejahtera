
<?php if($this->session->userdata('level') != 3) { ?>

<div class="box">
  <div class="box-header">
 </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive p-0">
    <table id="list-data" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th style='width: 30px;'>No</th>
          <th style='width: 170px;'>Penggunaan Operasi</th>
          <th>Deskripsi</th>
          <th style='width: 50px;'>Pada Tanggal</th>
        </tr>
      </thead>
      <tbody id="data-logs">

      </tbody>
    </table>
  </div>
</div>
<?php } ?>
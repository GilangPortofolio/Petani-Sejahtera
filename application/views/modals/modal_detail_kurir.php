<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-car"></i> List Transaksi Yang Memakai Kurir <b><?php echo $kurir->nama; ?></b></h3>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>No. Resi</th>
            <th>Tanggal Pengambilan</th>
            <th>Tanggal Diambil</th>
            <th>Nama Petani</th>        
            <th>Tanggal Sampai</th>
            <th>Biaya Angkut</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="data-transaksi">
          <?php
              $no = 1;
            foreach ($dataKurir as $transaksi) {
              ?>
              <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $transaksi->no_resi; ?></td>
              <td><?php echo $transaksi->tanggal_pengambilan; ?></td>
              <td><?php echo $transaksi->tanggal_diambil; ?></td>
              <td><?php echo $transaksi->user; ?></td>
              <td><?php echo $transaksi->tanggal_sampai; ?></td>
              <td>Rp. <?php echo $transaksi->biaya_angkut; ?>,-</td>
              <td><?php echo $transaksi->status_transaksi_nama; ?></td>

              </tr>
              <?php
               $no++;
            }
          ?>
        </tbody>
      </table>
  </div>

  <!-- <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div> -->
</div>
<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-user"></i> List Produk Yang Didaftarkan Oleh <b><?php echo $user->nama; ?></b></h3>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Jenis Produk</th>
            <th>Tanggal Tanam</th>
            <th>Tanggal Panen</th>
            <th>Berat Panen</th>
            <th>Luas Lahan</th>
            <th>Alamat</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="data-produk">
          <?php
            $no = 1;
            foreach ($dataUser as $produk) {
              ?>
              <tr>
                
              <td><?php echo $no; ?></td>
                <td><?php echo $produk->tipe_produk_nama; ?></td>
                <td><?php echo $produk->tgl_tanam; ?></td>
                <td><?php echo $produk->tgl_panen; ?></td>
                <td><?php echo $produk->berat_panen; ?>kg</td>
                <td><?php echo $produk->luas_lahan; ?>m2</td>
                <td><?php echo $produk->alamat; ?></td>
                <td><?php echo $produk->status_produk_nama; ?></td>

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
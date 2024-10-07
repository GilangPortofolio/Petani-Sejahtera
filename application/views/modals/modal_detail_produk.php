<div class="col-sm-6 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-leaf"></i> Data Produk <b>
    <?php echo $produk->id_produk; ?></b></h3><hr>


<div class="modal-body table-responsive">
  <table class="table table-bordered no-margin">
    <tbody>
      <tr>
        <th>Nama Petani</th>
        <td><span><?php echo $produk->user; ?></span></td>
      </tr>

      <tr>
        <th>Nama Produk</th>
        <td><span><?php echo $produk->tipe_produk; ?></span></td>
      </tr>

      <tr>
        <th>Tanggal Tanam</th>
        <td><span><?php echo $produk->tgl_tanam; ?></span></td>
      </tr>

      <tr>
        <th>Tanggal Panen</th>
        <td><span><?php echo $produk->tgl_panen; ?></span></td>
      </tr>

      <tr>
        <th>Berat Panen</th>
        <td><span><?php echo $produk->berat_panen; ?> kg</span></td>
      </tr>

      <tr>
        <th>Berat Asli</th>
        <td><span><?php echo $produk->berat_asli; ?> kg</span></td>
      </tr>

      <tr>
        <th>Luas Lahan</th>
        <td><span><?php echo $produk->luas_lahan; ?> m2</span></td>
      </tr>

      <tr>
       <th>Alamat</th>
       <td><span><?php echo $produk->alamat; ?></span></td>
      </tr>

      <tr>
        <th>Status Produk Saat Ini</th>
        <td><span><?php echo $produk->status_produk; ?></span></td>
      </tr>

      <?php  if($produk->id_status_produk == 5)
      {
        ?>
      <tr>
        <th>Produk Diambil Pada</th>
        <td><span><?php echo $produk->transaksi_tanggal_pengambilan; ?></span></td>
      </tr> <?php
      }
        ?>
    </tbody>
</table>
              
        
</div>



  <!-- <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div> -->
</div>


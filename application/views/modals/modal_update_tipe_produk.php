<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Harga Produk</h3>

  <form id="form-update-tipe_produk" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataTipe_produk->id; ?>">
    <!-- <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-grain"></i>
      </span>
      <input type="file" class="form-control" placeholder="Foto Produk" name="foto" aria-describedby="sizing-addon2" value="<?php echo $dataTipe_produk->foto; ?>">
    </div> -->
    <label>Nama Produk*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-grain"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Produk" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataTipe_produk->nama; ?>" readonly>
    </div>

    <label>Harga Produk*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-shopping-cart"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Harga per Ton" name="harga" aria-describedby="sizing-addon2" value="<?php echo $dataTipe_produk->harga; ?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
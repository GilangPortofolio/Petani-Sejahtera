<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Transaksi</h3>

  <form id="form-update-transaksi" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataTransaksi->id_transaksi; ?>">

    <label>Nomor Resi*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-list-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nomor Resi" name="no_resi" aria-describedby="sizing-addon2" value="<?php echo $dataTransaksi->no_resi; ?>">
    </div>

    <!-- <label>Tanggal Pengambilan*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="datetime-local" class="form-control" placeholder="Tanggal Pengambilan" name="tanggal_pengambilan" aria-describedby="sizing-addon2" value="<?php echo $dataTransaksi->tanggal_pengambilan; ?>">
    </div>

    <label>Tanggal Diambil*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="datetime-local" class="form-control" placeholder="Tanggal Diambil" name="tanggal_diambil" aria-describedby="sizing-addon2" value="<?php echo $dataTransaksi->tanggal_diambil; ?>">
    </div> -->
    <label>Nama Kurir*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <select name="id_kurir" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataKurir as $kurir) {
              ?>
              <option value="<?php echo $kurir->id; ?>" <?php if($kurir->id == $dataTransaksi->id_kurir){echo "selected='selected'";} ?>><?php echo $kurir->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div>

        <label>Nama Petani*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <select name="id_user" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataUser as $user) {
              ?>
              <option value="<?php echo $user->id; ?>" <?php if($user->id == $dataTransaksi->id_user){echo "selected='selected'";} ?>><?php echo $user->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div>

    <!-- <label>ID Produk*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-grain"></i>
      </span>
      <input type="number" class="form-control" placeholder="Produk" name="id_produk" aria-describedby="sizing-addon2" value="<?php echo $dataTransaksi->id_produk; ?>">
    </div> -->

    <label>Tanggal Sampai*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="datetime-local" class="form-control" placeholder="Tanggal Sampai" name="tanggal_sampai" aria-describedby="sizing-addon2" value="<?php echo $dataTransaksi->tanggal_sampai; ?>">
    </div>

    <label>Biaya Angkut*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-usd"></i>
      </span>
      <input type="text" class="form-control" placeholder="Jumlah Biaya Angkut" name="biaya_angkut" aria-describedby="sizing-addon2" value="<?php echo $dataTransaksi->biaya_angkut; ?>">
    </div>

    <!-- <label>Status Transaksi*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-tags"></i>
          </span>
          <select name="id_status_transaksi" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataStatus_transaksi as $status_transaksi) {
              ?>
              <option value="<?php echo $status_transaksi->id; ?>" <?php if($status_transaksi->id == $dataTransaksi->id_status_transaksi){echo "selected='selected'";} ?>><?php echo $status_transaksi->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div> -->
        <label>Status Transaksi*</label>
        <div class="input-group form-group" style="display: inline-block;">
          <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-record"></i>
          </span>
          <span class="input-group-addon">
              <input type="radio" name="id_status_transaksi" value="1" id="menunggu" class="minimal" <?php if($dataTransaksi->id_status_transaksi == 1){echo "checked='checked'";} ?>>
          <label for="menunggu">Menunggu</label>
            </span>
            <span class="input-group-addon">
              <input type="radio" name="id_status_transaksi" value="2" id="berlangsung" class="minimal" <?php if($dataTransaksi->id_status_transaksi == 2){echo "checked='checked'";} ?>> 
          <label for="berlangsung">Berlangsung</label>
            </span>
            <span class="input-group-addon">
              <input type="radio" name="id_status_transaksi" value="3" id="batal" class="minimal" <?php if($dataTransaksi->id_status_transaksi == 3){echo "checked='checked'";} ?>> 
          <label for="batal">Batal</label>
            </span>
            <span class="input-group-addon">
              <input type="radio" name="id_status_transaksi" value="4" id="selesai" class="minimal" <?php if($dataTransaksi->id_status_transaksi == 4){echo "checked='checked'";} ?>> 
          <label for="selesai">Selesai</label>
            </span>
        </div>

    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
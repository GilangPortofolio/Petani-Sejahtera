<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Mitra</h3>

  <form id="form-update-kurir" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataKurir->id; ?>">


    <label>Nama Kurir*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Kurir " name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataKurir->nama; ?>">
    </div>

    <label>Jenis Kendaraan*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-plane"></i>
      </span>
      <input type="text" class="form-control" placeholder="Jenis Kendaraan " name="jenis_kendaraan" aria-describedby="sizing-addon2" value="<?php echo $dataKurir->jenis_kendaraan; ?>">
    </div>

    <label>Plat Nomor Kendaraan*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-road"></i>
      </span>
      <input type="text" class="form-control" placeholder="Plat Nomor Kendaraan" name="plat_no" aria-describedby="sizing-addon2" value="<?php echo $dataKurir->plat_no; ?>">
    </div>

    <label>No.Telp Kurir*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone"></i>
      </span>
      <input type="text" class="form-control" placeholder="No.Telp Kurir" name="no_telp" aria-describedby="sizing-addon2" value="<?php echo $dataKurir->no_telp; ?>">
    </div>

    <label>Mitra*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-tags"></i>
          </span>
          <select name="id_mitra" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataMitra as $mitra) {
              ?>
              <option value="<?php echo $mitra->id; ?>" <?php if($mitra->id == $dataKurir->id_mitra){echo "selected='selected'";} ?>><?php echo $mitra->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div>

    <!-- <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-"></i>
      </span>
      <input type="datetime-local" class="form-control" placeholder="Masukkan Tanggal Data di Update " name="updated_at" aria-describedby="sizing-addon2" value="<?php echo $dataKurir->updated_at; ?>">
    </div> -->

    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
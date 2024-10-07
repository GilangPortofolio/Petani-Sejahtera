<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Kurir</h3>

  <form id="form-tambah-kurir" method="POST">

  <label>NIK Kurir*</label>
   <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="number" class="form-control" placeholder="Masukkan NIK Kurir" name="nik" aria-describedby="sizing-addon2">
    </div>

    <label>Password*</label>
   <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Password " name="password" aria-describedby="sizing-addon2">
    </div>


    <label>Mitra*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-briefcase"></i>
      </span>
      <select name="id_mitra" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataMitra as $mitra) {
          ?>
          <option value="<?php echo $mitra->id; ?>">
            <?php echo $mitra->nama; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    
  <label>Nama Kurir*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Nama Kurir" name="nama" aria-describedby="sizing-addon2">
    </div>

    <label>Jenis Kendaraan*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-plane"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Jenis Kendaraan" name="jenis_kendaraan" aria-describedby="sizing-addon2">
    </div>

    <label>Plat Nomor Kendaraan*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-road"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Plat Nomor Kendaraan" name="plat_no" aria-describedby="sizing-addon2">
    </div>

    <label>No.Telp Kurir*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone"></i>
      </span>
      <input type="number" class="form-control" placeholder="Masukkan No.Telp Kurir" name="no_telp" aria-describedby="sizing-addon2">
    </div>
    

    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>
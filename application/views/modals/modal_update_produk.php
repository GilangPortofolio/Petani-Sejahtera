<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data E-Commodity</h3>
      <form method="POST" id="form-update-produk">
        <input type="hidden" name="id" value="<?php echo $dataProduk->id_produk; ?>">

        <!-- <label>Nama Produk*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="-" name="id_user" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->id_user; ?>">
        </div> -->
        <label>Nama Petani*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <select name="id_user" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataUser as $user) {
              ?>
              <option value="<?php echo $user->id; ?>" <?php if($user->id == $dataProduk->id_user){echo "selected='selected'";} ?>><?php echo $user->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div>

      <!-- <label>Nama Produk*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="-" name="id_tipe_produk" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->id_tipe_produk; ?>">
        </div> -->
        <label>Nama Produk*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-leaf"></i>
          </span>
          <select name="id_tipe_produk" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataTipe_produk as $tipe_produk) {
              ?>
              <option value="<?php echo $tipe_produk->id; ?>" <?php if($tipe_produk->id == $dataProduk->id_tipe_produk){echo "selected='selected'";} ?>><?php echo "$tipe_produk->nama - $tipe_produk->harga"  ?></option>
              <?php
            }
            ?>
          </select>
        </div>

        <label>Berat Panen*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-grain"></i>
          </span>
          <input type="number" class="form-control" placeholder="-" name="berat_panen" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->berat_panen; ?>">
        </div>

        <label>Luas Lahan*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-tree-deciduous"></i>
          </span>
          <input type="number" class="form-control" placeholder="-" name="luas_lahan" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->luas_lahan; ?>">
        </div>



        <!-- <label>Status*</label>
        <div class="input-group form-group" style="display: inline-block;">
          <span class="input-group-addon" id="sizing-addon2">
          <i class="glyphicon glyphicon-record"></i>
          </span>
          <span class="input-group-addon">
              <input type="radio" name="id_status_produk" value="1" id="proses_tanam" class="minimal" <?php if($dataProduk->id_status_produk == 1){echo "checked='checked'";} ?>>
          <label for="proses_tanam">Ditanam</label>
            </span>
            <span class="input-group-addon">
              <input type="radio" name="id_status_produk" value="2" id="panen" class="minimal" <?php if($dataProduk->id_status_produk == 2){echo "checked='checked'";} ?>> 
          <label for="panen">Dipanen</label>
            </span>
            <span class="input-group-addon">
              <input type="radio" name="id_status_produk" value="3" id="siap_diambil" class="minimal" <?php if($dataProduk->id_status_produk == 3){echo "checked='checked'";} ?>> 
          <label for="siap_diambil">Siap Diambil</label>
            </span>
            <span class="input-group-addon">
              <input type="radio" name="id_status_produk" value="5" id="siap_diambil" class="minimal" <?php if($dataProduk->id_status_produk == 5){echo "checked='checked'";} ?>> 
          <label for="siap_diambil">Sedang Diambil</label>
            </span>
            <span class="input-group-addon">
              <input type="radio" name="id_status_produk" value="4" id="selesai_diambil" class="minimal" <?php if($dataProduk->id_status_produk == 4){echo "checked='checked'";} ?>> 
          <label for="selesai_diambil">Selesai</label>
            </span>
        </div> -->

        <label>Status*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-tags"></i>
          </span>
          <select name="id_status_produk" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataStatus_produk as $status_produk) {
              ?>
              <option value="<?php echo $status_produk->id; ?>" <?php if($status_produk->id == $dataProduk->id_status_produk){echo "selected='selected'";} ?>><?php echo $status_produk->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div>

        <label>Alamat*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-home"></i>
          </span>
          <input type="text" class="form-control" placeholder="-" name="alamat" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->alamat; ?>">
        </div>

        
        <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
          </div>
        </div>
      </form>
</div>

<!-- <script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script> -->
<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Petani</h3>
      <form method="POST" id="form-update-user">
        <input type="hidden" name="id" value="<?php echo $dataUser->id_user; ?>">

        <label>NIK Petani*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="-" name="nik" aria-describedby="sizing-addon2" value="<?php echo $dataUser->nik; ?>">
        </div>

        <label>Nama Petani*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="-" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataUser->nama; ?>">
        </div>

        <label>Asal Dusun*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-home"></i>
          </span>
          <select name="id_desa" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataDesa as $desa) {
              ?>
              <option value="<?php echo $desa->id; ?>" <?php if($desa->id == $dataUser->id_desa){echo "selected='selected'";} ?>><?php echo $desa->nama; ?></option>
              <?php
            }
            ?>
          </select>
        </div>

        <label>No.Telp Petani*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-phone"></i>
          </span>
          <input type="number" class="form-control" placeholder="-" name="telp" aria-describedby="sizing-addon2" value="<?php echo $dataUser->telp; ?>">
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
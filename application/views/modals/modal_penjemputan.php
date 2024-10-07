<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
  <h3 style="display:block; text-align:center;">Data penjemputan</h3>
      <form method="POST" id="form-penjemputan" >

      <h5>Data Penjemput</h5>
        <label>Kurir*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <select name="id_kurir" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
            foreach ($dataKurir as $kurir) {
              ?>
              <option value="<?php echo $kurir->id; ?>"><?php echo "$kurir->nama - $kurir->jenis_kendaraan - $kurir->plat_no"; ?></option>
              <?php
            }
            ?>
          </select>
        </div>

        
      <label>Jam Penjemputan (hh:mm)*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-time"></i>
          </span>
          <input type="time" class="form-control" name="jam_penjemputan" aria-describedby="sizing-addon2" placeholder="hh:mm">
        </div>
        <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="date">Tanggal Penjemputan*</label>
        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
      </div>
      <label>Harga Penjemputan*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-usd"></i>
          </span>
          <input type="number" class="form-control" placeholder="-" name="harga" aria-describedby="sizing-addon2" value="" placeholder="0">
        </div>
      <hr>
      
      <h5>Data Produk Petani</h5>
        <input type="hidden" name="id" value="<?php echo $dataProduk->id_produk; ?>">
        <label>Nama Petani*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-grain"></i>
          </span>
          <input type="text" class="form-control" placeholder="-" name="nama_user" aria-describedby="sizing-addon2" value="<?php echo $dataUser->nama; ?>" readonly>
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
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="-" name="nama_produk" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->tipe_produk; ?>" readonly>
        </div>

        <label>Berat Panen (kg)*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-grain"></i>
          </span>
          <input type="number" class="form-control" placeholder="-" name="berat_panen" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->berat_panen; ?>" readonly>
        </div>

        <label>Berat Asli (kg)*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-grain"></i>
          </span>
          <input type="number" class="form-control" placeholder="-" name="berat_panen" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->berat_asli; ?>" readonly>
        </div>

        <label>Luas Lahan (m2)*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-tree-deciduous"></i>
          </span>
          <input type="number" class="form-control" placeholder="-" name="luas_lahan" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->luas_lahan; ?>" readonly>
        </div>


        <label>Alamat*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-home"></i>
          </span>
          <input type="text" class="form-control" placeholder="-" name="alamat" aria-describedby="sizing-addon2" value="<?php echo $dataProduk->alamat; ?>" readonly>
        </div>

        <hr>
        
          <div class="form-msg"></div>
        
        <div class="form-group" >
          <div class="col-md-12">
              <button id="submit-button" class="form-control btn btn-primary" style="display:block"> <i class="glyphicon glyphicon-ok"></i> Lakukan Penjemputan</button>
              <div id="loading-text" style="display:none">
                Mohon Tunggu
              </div>
          </div>
        </div>
       
      </form>
</div>

<script>
$(document).ready(function(){
  var d = new Date('<?php echo $dataProduk->tgl_panen;?>');
  d.setDate(d.getDate() - 3);
  console.log('<?php echo $dataProduk->tgl_panen;?>');
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: new Date
        })
    })

</script>

<!-- <script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script> -->
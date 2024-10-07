<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Mitra</h3>

  <form id="form-update-mitra" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataMitra->id; ?>">

    <label>Nama Mitra*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Nama Mitra" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataMitra->nama; ?>">
    </div>

    <label>Kode Mitra*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-barcode"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Kode Mitra" name="kode" aria-describedby="sizing-addon2" value="<?php echo $dataMitra->kode; ?>">
    </div>

    <label>No. Telp*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone"></i>
      </span>
      <input type="number" class="form-control" placeholder="Masukkan No. Telp Mitra" name="telp" aria-describedby="sizing-addon2" value="<?php echo $dataMitra->telp; ?>">
    </div>

    <label>Alamat*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-home"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Alamat Mitra" name="alamat" aria-describedby="sizing-addon2" value="<?php echo $dataMitra->alamat; ?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
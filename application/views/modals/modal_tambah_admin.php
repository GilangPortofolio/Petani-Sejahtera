<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Admin</h3>
  <form id="form-tambah-admin" method="POST">

  <label>Nama Admin*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Nama Admin" name="nama" aria-describedby="sizing-addon2">
    </div>

    <label>Username*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-barcode"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Username" name="username" aria-describedby="sizing-addon2">
    </div>

    <label>Password*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-barcode"></i>
      </span>
      <input type="text" class="form-control" placeholder="Masukkan Password" name="password" aria-describedby="sizing-addon2">
    </div>

    <label>Level*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-list"></i>
      </span>
      <select name="level" class="form-control select2" aria-describedby="sizing-addon2">
      <option value="" readonly>--- Pilih Level ---</option>
      <option value="2">Operator</option>
      <option value="3">Guest</option>
      </select>
    </div>

    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Admin</button>
      </div>
    </div>
  </form>
</div>
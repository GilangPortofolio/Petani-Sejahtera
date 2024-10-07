<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Admin</h3>

  <form id="form-update-admin" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataAdmin->id; ?>">


    <label>Nama Admin*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Admin" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataAdmin->nama; ?>" readonly>
    </div>

    <label>Username*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-barcode"></i>
      </span>
      <input type="text" class="form-control" placeholder="Username" name="username" aria-describedby="sizing-addon2" value="<?php echo $dataAdmin->username; ?>">
    </div>

    <label>Password*</label>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-barcode"></i>
      </span>
      <input type="text" class="form-control" placeholder="Password" name="password" aria-describedby="sizing-addon2" value="<?php echo $dataAdmin->password; ?>">
    </div>

    <label>Level*</label>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-list"></i>
          </span>
          <select name="level" class="form-control select2"  aria-describedby="sizing-addon2">
          <option value="">- Pilih Level -</option>
          <option value="2">Operator</option>
          <option value="3">Guest</option>
          </select>
        </div>

    <!-- <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-"></i>
      </span>
      <input type="datetime-local" class="form-control" placeholder="Masukkan Tanggal Data di Update " name="updated_at" aria-describedby="sizing-addon2" value="<?php echo $dataAdmin->updated_at; ?>">
    </div> -->

    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
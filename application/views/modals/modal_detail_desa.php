<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> List Petani Yang Berasal Dari Desa <b><?php echo $desa->nama; ?></b></h3>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Nama Petani</th>
            <th>No Telp</th>
          </tr>
        </thead>
        <tbody id="data-user">
          <?php
            $no = 1;
            foreach ($dataDesa as $user) {
              ?>
              <tr>
                
              <td><?php echo $no; ?></td>
              <td><?php echo $user->NIK; ?></td>
              <td><?php echo $user->user; ?></td>
              <td><?php echo $user->telp; ?></td>

              </tr>
              <?php
                  $no++;
            }
          ?>
        </tbody>
      </table>
  </div>

  <!-- <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div> -->
</div>
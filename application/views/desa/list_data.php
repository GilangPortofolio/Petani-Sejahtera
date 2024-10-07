<?php
  $no = 1;
  foreach ($dataDesa as $desa) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $desa->nama; ?></td>
      <?php if($this->session->userdata('level') == 1) { ?>
      <td class="text-center" style="min-width:100px;">
          <button class="btn btn-info detail-dataDesa" data-id="<?php echo $desa->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> </button>
          <button class="btn btn-warning update-dataDesa" data-id="<?php echo $desa->id; ?>"><i class="glyphicon glyphicon-edit"></i> </button>
          <button class="btn btn-danger konfirmasiHapus-desa" data-id="<?php echo $desa->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> </button>
          
      </td>
      <?php } ?>
    </tr>
    <?php
    $no++;
  }
?>
<?php
  $no = 1;
  foreach ($dataUser as $user) {
    ?>
    <tr>
      <td><?php echo $user->nik; ?></td>
      <td><?php echo $user->nama; ?></td>
      <td><a href="<?php base_url().'https://sidutama.web.id/administrator/assets/app_photo/'.$user->foto;?>" target="_blank" width="60px" height="60px"><img src="<?=base_url().'assets/app_photo/'.$user->foto;?>" width="60px" height="60px""></a></td>
      <td><?php echo $user->telp; ?></td>
      <td><?php echo $user->desa_nama; ?></td>
      <td><?php echo $user->total_luas_lahan; ?> m<sup>2</sup></td>     

      <?php if($this->session->userdata('level') == 1) { ?>
      <td class="text-center" style="min-width:150px;">
      <button class="btn btn-info detail-dataUser" data-id="<?php echo $user->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> </button>
      <button class="btn btn-warning update-dataUser" data-id="<?php echo $user->id; ?>"><i class="glyphicon glyphicon-edit"></i></button>
        <button class="btn btn-danger konfirmasiHapus-user" data-id="<?php echo $user->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus">
        <i class="glyphicon glyphicon-trash"></i>
      </button>
      </td>
      <?php } ?>
    </tr>
    <?php
        $no++;
  }
?>
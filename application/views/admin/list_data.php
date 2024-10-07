<?php
  foreach ($dataAdmin as $admin) {
    ?>
    <tr>
      <td><?php echo $admin->id; ?></td>
      <td><a href="<?php base_url().'https://sidutama.web.id/administrator/assets/img/'.$admin->foto;?>" target="_blank" width="60px" height="60px"><img src="<?=base_url().'assets/img/'.$admin->foto;?>" width="60px" height="60px"></a></td>
      <td><?php echo $admin->username; ?></td>
      <td><?php echo $admin->nama; ?></td>
      <td><?php echo strtoupper($admin->level); ?></td>

      <?php if($this->session->userdata('level') == 1) { ?>
      <td class="text-center" style="min-width:100px;">

          <button class="btn btn-warning update-dataAdmin" data-id="<?php echo $admin->id; ?>"><i class="glyphicon glyphicon-edit"></i> </button>

          <button class="btn btn-danger konfirmasiHapus-admin" data-id="<?php echo $admin->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> </button>
          
      </td>
      <?php } ?>
    </tr>
    <?php
  }
?>
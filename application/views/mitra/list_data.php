<?php
  $no = 1;
  function kapital ($kode) {
		$hasil = strtoupper($kode);
		return $hasil;
	}
  foreach ($dataMitra as $mitra) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo strtoupper($mitra->kode); ?></td>
      <td><?php echo $mitra->nama; ?></td>
      <td><?php echo $mitra->telp; ?></td>
      <td><?php echo $mitra->alamat; ?></td>

      <?php if($this->session->userdata('level') == 1) { ?>
      <td class="text-center" style="min-width:100px;">
          <!-- <button class="btn btn-info detail-dataMitra" data-id="<?php echo $mitra->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> </button> -->
          <button class="btn btn-warning update-dataMitra" data-id="<?php echo $mitra->id; ?>"><i class="glyphicon glyphicon-edit"></i> </button>
          <button class="btn btn-danger konfirmasiHapus-mitra" data-id="<?php echo $mitra->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> </button>
          
      </td>
      <?php } ?>
    </tr>
    <?php
    $no++;
  }
?>
<?php
  $no = 1;
  function kapital ($plat_no) {
		$hasil = strtoupper($plat_no);
		return $hasil;
	}
  foreach ($dataKurir as $kurir) {
    ?>
    <tr>
      <td><?php echo $kurir->nik; ?></td>
      <td><?php echo $kurir->nama; ?></td>
      <td><?php echo $kurir->mitra; ?></td>
      <td><?php echo $kurir->jenis_kendaraan; ?></td>
      <td><?php echo strtoupper($kurir->plat_no); ?></td>
      <td><?php echo $kurir->no_telp; ?></td>
      <?php if($this->session->userdata('level') == 1) { ?>
      <td class="text-center" style="min-width:100px;">
          <button class="btn btn-info detail-dataKurir" data-id="<?php echo $kurir->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> </button>
          <button class="btn btn-warning update-dataKurir" data-id="<?php echo $kurir->id; ?>"><i class="glyphicon glyphicon-edit"></i> </button>
          <button class="btn btn-danger konfirmasiHapus-kurir" data-id="<?php echo $kurir->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> </button>
      </td>
      <?php } ?>
    </tr>
    <?php
    $no++;
  }
?>
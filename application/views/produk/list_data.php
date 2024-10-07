<?php

  function rupiah ($harga) {
		$hasil = 'Rp ' . number_format($harga, 2, ",", ".");
		return $hasil;
	}
  foreach ($dataProduk as $row) {
    ?>
    <tr>
      <td><?php echo $row->user_nik; ?></td>
      <td><?php echo $row->user_nama; ?></td>
      <td><?php echo $row->tipe_produk_nama; ?></td>
      <td><?php echo $row->tgl_tanam; ?></td>
      <td><?php echo $row->tgl_panen; ?></td>
      <td><?php echo $row->berat_panen; ?> kg</td>
      <td><?php echo $row->berat_asli; ?> kg</td>
      <td><?php echo rupiah ($row->tipe_produk_harga); ?></td>
      <td><?php echo $row->luas_lahan; ?> m<sup>2</sup></td>
      <td><?php echo $row->alamat; ?></td>

      <?php if($this->session->userdata('level') != 3) { ?>
      <td><?php echo $row->status_produk_nama; ?></td>
      <td class="text-center" style="min-width:110px;">

      <button class="btn btn-info detail-dataProduk" data-id="<?php echo $row->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> </button>
      <!-- <button class="btn btn-warning update-dataProduk" data-id="<?php echo $row->id; ?>"><i class="glyphicon glyphicon-edit"></i></button> -->
      <?php  if($row->status_produk_id == 3)
      {
        ?>
         <button class="btn btn-success penjemputan" data-id="<?php echo $row->id; ?>"><i class="glyphicon glyphicon-plane"></i></button>
        <?php
      }
      ?>

      </td>
      <?php } ?>
    </tr>
    <?php
  }
?>


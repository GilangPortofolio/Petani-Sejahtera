<?php
  $no = 1;
  function rupiah ($harga) {
		$hasil = 'Rp ' . number_format($harga, 2, ",", ".");
		return $hasil;
	}
  foreach ($dataTipe_produk as $tipe_produk) {
    ?>
    <tr>
      <td style="text-align: center;"><?php echo $no; ?></td>
      <!-- <td><img src="assets/thumbnail/<?php echo $tipe_produk->foto; ?>" width="150px" height="100px"></td>    -->
      <td><a href="<?php base_url().'https://sidutama.web.id/administrator/assets/thumbnail/'.$tipe_produk->foto;?>" target="_blank"><img src="<?=base_url().'assets/thumbnail/'.$tipe_produk->foto;?>" width="150px" height="100px"></a></td>
   
      <td><?php echo $tipe_produk->nama; ?></td>
      
    <td>
    <?php echo rupiah ($tipe_produk->harga); ?>
      <?php
      foreach($dataHistoryProduk as $historyProduk){
        //
        $show = false;
        $realIdMasterRow = null;
        $realIdHistoryRow = null;
        //check if history is master data
        if($historyProduk->parent_id == NULL){
          $realIdHistoryRow = $historyProduk->id;
        }else{
          $realIdHistoryRow = $historyProduk->parent_id;
        }
        if($tipe_produk->parent_id == NULL){
          $realIdMasterRow = $tipe_produk->id;
        }else{
          $realIdMasterRow = $tipe_produk->parent_id;
        }
        if($realIdHistoryRow == $realIdMasterRow){
      ?>
        <br/><?php echo rupiah ($historyProduk->harga); ?>
      <?php
        }
      }
      ?>
    
    </td>
      
      
      
      <td><?php echo $tipe_produk->tanggal; ?>
      <?php
      foreach($dataHistoryProduk as $historyProduk){
        //
        $show = false;
        $realIdMasterRow = null;
        $realIdHistoryRow = null;
        //check if history is master data
        if($historyProduk->parent_id == NULL){
          $realIdHistoryRow = $historyProduk->id;
        }else{
          $realIdHistoryRow = $historyProduk->parent_id;
        }
        if($tipe_produk->parent_id == NULL){
          $realIdMasterRow = $tipe_produk->id;
        }else{
          $realIdMasterRow = $tipe_produk->parent_id;
        }
        if($realIdHistoryRow == $realIdMasterRow){
      ?>
        <br/><?php echo $historyProduk->tanggal ?>
      <?php
        }
      }
      ?>
    
    </td>

    <?php if($this->session->userdata('level') == 1) { ?>
      <td class="text-center" style="min-width:150px;">
          <!-- <button class="btn btn-info detail-dataTipe_produk" data-id="<?php echo $tipe_produk->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> </button> -->
          <button class="btn btn-warning update-dataTipe_produk" data-id="<?php echo $tipe_produk->id; ?>"><i class="glyphicon glyphicon-edit"></i></button>
          <button class="btn btn-danger konfirmasiHapus-tipe_produk" data-id="<?php echo $tipe_produk->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i></button>
      </td>
      <?php } ?>
    </tr>
    <?php
    $no++;
  }
?>
<?php
          $no = 1;

          function rupiah($harga)
          {
            $hasil = 'Rp ' . number_format($harga, 2, ",", ".");
            return $hasil;
          }
          foreach ($dataTransaksi as $transaksi) {
          ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $transaksi->no_resi; ?></td>
              <td><?php echo $transaksi->tanggal_pengambilan; ?></td>
              <td><?php echo $transaksi->tanggal_diambil; ?></td>
              <td><?php echo $transaksi->nama_kurir; ?></td>
              <td><?php echo $transaksi->nama_user; ?></td>
              <td><?php echo $transaksi->nama_produk; ?></td>
              <td><?php echo $transaksi->id_produk; ?></td>
              <td><?php echo $transaksi->tanggal_sampai; ?></td>
              <td><?php echo rupiah($transaksi->biaya_angkut); ?></td>

              <?php if ($this->session->userdata('level') != 3) { ?>
                <td><?php echo $transaksi->nama_status; ?></td>
                <td class="text-center" style="min-width:100px;">
                  <!-- <a href="transaksi/cethak" data-id="<?php echo $transaksi->id; ?>" ><button class="btn btn-secondary"><i class="fa fa-file-pdf-o"></i></button></a> -->

                  <!-- <button class="btn btn-warning update-dataTransaksi" data-id="<?php echo $transaksi->id; ?>"><i class="glyphicon glyphicon-edit"></i> </button> -->
                  <?php
                  if ($transaksi->id_status_transaksi != 3 and $transaksi->id_status_transaksi != 4) {
                  ?>
                    <button class="btn btn-danger konfirmasiHapus-transaksi" data-id="<?php echo $transaksi->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-ban-circle"></i> </button>
                  <?php
                  }
                  ?>

                  <?php
                  if ($transaksi->status_produk_id == 4 and $transaksi->id_status_transaksi == 2 and $transaksi->sudah_dikonfirmasi_petani == 1) {
                  ?>
                    <button class="btn btn-secondary konfirmasi-transaksi" data-id="<?php echo $transaksi->id; ?>" data-toggle="modal" data-target="#konfirmasiTransaksi"><i class="glyphicon glyphicon-ok"></i> </button>
                  <?php
                  }
                  ?>


                  <!-- <button class="btn btn-info detail-dataDesa" data-id="<?php echo $transaksi->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button> -->
                </td>
              <?php } ?>
            </tr>
          <?php
            $no++;
          }
          ?>
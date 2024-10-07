<html>
<head>
    <title>Cetak PDF</title>
    <style>
    .table {
        border-collapse:collapse;
        table-layout:fixed;
    }
    .table th {
        padding: 5px;
    }
    .table td {
        word-wrap:break-word;
        width: 20%;
        padding: 5px;
    }
  </style>
</head>
<body>
<h4 style="margin-bottom: 20px;">Laporan Data Transaksi</h4>
<?php echo $label ?><br />

<table class="table" border="1" style="width:100%; margin-top: 10px;">
<tr>
          <th>Nomor Resi</th>
          <th>Tgl Pengambilan</th>
          <th>Tgl Diambil</th>
          <th>Nama Kurir</th>
          <th>Nama Petani</th>
          <th>Produk</th>
          <th>Tgl Sampai</th>
          <th>Total Biaya</th>
</tr>
<?php
function rupiah ($harga) {
    $hasil = 'Rp ' . number_format($harga, 2, ",", ".");
    return $hasil;
}
if(empty($dataTransaksi)){ // Jika data tidak ada
  echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
}else{
foreach ($dataTransaksi as $transaksi) {
    $tanggal_pengambilan = date('d-m-Y', strtotime($transaksi->tanggal_pengambilan));
    $tanggal_diambil = date('d-m-Y', strtotime($transaksi->tanggal_diambil));
    $tanggal_sampai = date('d-m-Y', strtotime($transaksi->tanggal_sampai));
    ?>
    <tr>
      <td style='width: 200px;'><?php echo $transaksi->no_resi; ?></td>
      <td style='width: 70px;'><?php echo $transaksi->tanggal_pengambilan; ?></td>
      <td style='width: 70px;'><?php echo $transaksi->tanggal_diambil; ?></td>
      <td style='width: 120px;'><?php echo $transaksi->nama_kurir; ?></td>
      <td style='width: 120px;'><?php echo $transaksi->nama_user; ?></td>
      <td style='width: 30px; text-align:center;'><?php echo $transaksi->id_produk; ?></td>
      <td style='width: 70px;'><?php echo $transaksi->tanggal_sampai; ?></td>
      <td style='width: 150px;'><?php echo rupiah ($transaksi->biaya_angkut); ?></td>
    </tr>
    <?php
  }
}
?>
</table>
</body>
</html>

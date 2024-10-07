<div class="row">
  <!-- tampilan admin -->
  <?php if ($this->session->userdata('level') == 1) { ?>
    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $jml_user; ?></h3>
          <p>Data Petani</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-contact"></i>
        </div>
        <a href="<?php echo base_url('User') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $jml_produk; ?></h3>
          <p>Data E-Commodity</p>
        </div>
        <div class="icon">
          <i class="ion ion-leaf"></i>
        </div>
        <a href="<?php echo base_url('Produk') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $jml_tipe_produk; ?></h3>
          <p>Data Harga Produk</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-pricetags"></i>
        </div>
        <a href="<?php echo base_url('Tipe_produk') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?php echo $jml_desa; ?></h3>
          <p>Data Dusun</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-navigate-outline"></i>
        </div>
        <a href="<?php echo base_url('Desa') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $jml_kurir; ?></h3>
          <p>Data Kurir</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-car"></i>
        </div>
        <a href="<?php echo base_url('Kurir') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-gray">
        <div class="inner">
          <h3><?php echo $jml_mitra; ?></h3>
          <p>Data Mitra</p>
        </div>
        <div class="icon">
          <i class="ion ion-briefcase"></i>
        </div>
        <a href="<?php echo base_url('Mitra') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3><?php echo $jml_transaksi; ?></h3>
          <p>Data Transaksi</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-cart"></i>
        </div>
        <a href="<?php echo base_url('Transaksi') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  <?php } ?>


 <!-- tampilan operator -->
 <?php if ($this->session->userdata('level') == 2) { ?>

    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $jml_produk; ?></h3>
          <p>Data E-Commodity</p>
        </div>
        <div class="icon">
          <i class="ion ion-leaf"></i>
        </div>
        <a href="<?php echo base_url('Produk') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>


    <div class="col-lg-4 col-xs-4">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3><?php echo $jml_transaksi; ?></h3>
          <p>Data Transaksi</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-cart"></i>
        </div>
        <a href="<?php echo base_url('Transaksi') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  <?php } ?>


  <!-- tampilan guest -->
  <?php if ($this->session->userdata('level') == 3) { ?>
    <div class="col-lg-6 col-xs-4">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $jml_user; ?></h3>
          <p>Data Petani</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-contact"></i>
        </div>
        <a href="<?php echo base_url('User') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-6 col-xs-4">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $jml_produk; ?></h3>
          <p>Data E-Commodity</p>
        </div>
        <div class="icon">
          <i class="ion ion-leaf"></i>
        </div>
        <a href="<?php echo base_url('Produk') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-6 col-xs-4">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $jml_tipe_produk; ?></h3>
          <p>Data Harga Produk</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-pricetags"></i>
        </div>
        <a href="<?php echo base_url('Tipe_produk') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-6 col-xs-4">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?php echo $jml_desa; ?></h3>
          <p>Data Dusun</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-navigate-outline"></i>
        </div>
        <a href="<?php echo base_url('Desa') ?>" class="small-box-footer">List Data <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  <?php } ?>
</div>

<div class="row">
  <!-- diagram desa -->
  <div class="col-lg-6 col-xs-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <i class="fa fa-location-arrow"></i>
        <h3 class="box-title">Statistik Dusun Petani<small> (Data Dusun)</small></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="data-desa"></canvas>
      </div>
    </div>
  </div>

  <!-- diagram produk -->
  <div class="col-lg-6 col-xs-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <i class="fa fa-leaf"></i>
        <h3 class="box-title">Statistik Produk Yang Terdaftar<small> (Data E-Commodity)</small></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="data-tipe_produk"></canvas>
      </div>
    </div>
  </div>

    <!-- diagram transaksi -->
    <div class="col-lg-6 col-xs-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Statistik Produk Yang Terjual<small> (Data Transaksi)</small></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="data-produk"></canvas>
      </div>
    </div>
  </div>

  <!-- jumlah produk -->
  <div class="col-lg-6 col-xs-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <i class="fa fa-leaf"></i>
        <h3 class="box-title">Hasil & Lahan Produk yang Terdaftar<small> (Data E-Commodity)</small></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="row">
      <form method="get" action="<?php echo base_url('home') ?>">
  <div class="col-sm-6 col-md-6">

    <select type="text" name="tipe_produk_nama" value="<?= @$_GET['tipe_produk_nama'] ?>" class="form-control tipe_produk_nama">
              <option value="">-Pilih Jenis-</option>
        <?php
        foreach ($dataTipe_produk as $tipe) {
          ?>
          <option value="<?php echo $tipe->nama; ?>">
            <?php echo $tipe->nama; ?>
          </option>
          <?php
        }
        ?>
        </select>
        <label style="margin-left: 5px">Jenis Dipilih :</label> <?php echo $label ?> 
  </div>
        <div style="margin-top: 0px;">
          <button type="submit" name="filter" value="true" class="btn-sm btn-primary">SET FILTER</button>
          <?php
          if (isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
            echo '<a href="' . base_url('home') . '" class="btn-sm btn-default">RESET</a>';
          ?>
        </div>
        </div>
      </form>

      <div class="box-body table-responsive p-0">
      <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Petani</th>
              <th>Jenis Produk</th>
              <th>Berat Panen</th>
              <th>Luas Lahan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataProduk as $row) {
            ?>
              <tr>
                <td><?php echo $row->user_nama;?></td>
                <td><?php echo $row->tipe_produk_nama; ?></td>
                <td><?php echo $row->berat_panen; ?> kg</td>
                <td><?php echo $row->luas_lahan; ?> m<sup>2</sup></td>
              </tr>
            <?php
            }
            ?>
          </tbody>

          <tr style="font-weight:bold;">
            <td colspan='2'>Jumlah :</td>
            <td><?php echo $dataSum->jumlah_berat; ?> kg</td>
            <td><?php echo $dataSum->jumlah_lahan; ?> m<sup>2</sup></td>
          </tr>

        </table>
      </div>
    </div>
  </div>

</div>


<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
<script>
  //data desa
  var pieChartCanvas = $("#data-desa").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_desa; ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);


  //data tipe produk
  var pieChartCanvas = $("#data-tipe_produk").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_tipe_produk; ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);


  var pieChartCanvas = $("#data-produk").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_produk; ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);
</script>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        <!-- Status -->
        <a href="<?php echo base_url(); ?>assets/#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- ADMIN SIDEBAR -->
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">LIST MENU</li>
        <!-- Optionally, you can add icons to the links -->

        <li <?php if ($page == 'home') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Home'); ?>">
            <i class="fa fa-home"></i>
            <span>Home</span>
          </a>
        </li>

        <?php if ($this->session->userdata('level') != 2) { ?>
        <li <?php if ($page == 'User') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('User'); ?>">
            <i class="fa fa-user"></i>
            <span>Data Petani</span>
          </a>
        </li>
      <?php  } ?>

        <li <?php if ($page == 'Produk') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Produk'); ?>">
            <i class="fa fa-leaf"></i>
            <span>Data E-Commodity</span>
          </a>
        </li>

        <?php if ($this->session->userdata('level') != 2) { ?>
        <li <?php if ($page == 'Tipe Produk') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Tipe_produk'); ?>">
            <i class="fa fa-tags"></i>
            <span>Data Harga Produk</span>
          </a>
        </li>
      <?php  } ?>

      <?php if ($this->session->userdata('level') != 2) { ?>
        <li <?php if ($page == 'Desa') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Desa'); ?>">
            <i class="fa fa-location-arrow"></i>
            <span>Data Dusun</span>
          </a>
        </li>
      <?php  } ?>

      <?php if ($this->session->userdata('level') == 1) { ?>
        <li <?php if ($page == 'Kurir') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Kurir'); ?>">
            <i class="fa fa-car"></i>
            <span>Data Kurir</span>
          </a>
        </li>
      <?php  } ?>

      <?php if ($this->session->userdata('level') == 1) { ?>
        <li <?php if ($page == 'Mitra') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Mitra'); ?>">
            <i class="fa fa-briefcase"></i>
            <span>Data Mitra</span>
          </a>
        </li>
      <?php  } ?>

      <?php if ($this->session->userdata('level') != 3) { ?>
        <li <?php if ($page == 'Transaksi') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Transaksi'); ?>">
            <i class="fa fa-shopping-cart"></i>
            <span>Data Transaksi</span>
          </a>
        </li>
      <?php  } ?>

        <br>
        <?php if ($this->session->userdata('level') == 1) { ?>
        <li <?php if ($page == 'Admin') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Admin'); ?>">
            <i class="fa fa-group"></i>
            <span>Data Admin</span>
          </a>
        </li>
      <?php  } ?>

      <?php if ($this->session->userdata('level') != 3) { ?>
        <li <?php if ($page == 'Logs') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('Logs'); ?>">
            <i class="fa fa-history"></i>
            <span>Data Riwayat Admin</span>
          </a>
        </li>
      <?php  } ?>

        <li <?php if ($page == 'logout') {
              echo 'class="active"';
            } ?>>
          <a href="<?php echo base_url('auth/logout'); ?>">
            <i class="glyphicon glyphicon-log-out"></i>
            <span>Log Out</span>
          </a>
        </li>
      </ul>


  </section>
  <!-- /.sidebar -->
</aside>
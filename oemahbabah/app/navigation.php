<?php 
$username=$_SESSION['user'];
$userlevel=userLevel($username);
//echo 'level barang: '.getAkses('barang',$userlevel);
?>  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
	<!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
		<li class="header" style="display:none">
		<a href="#" > </a>
		</a>
		</li>
        <li class="treeview">
          <a href="#" onclick="loadPage('dashboard')">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview" <?php displayAkses('master',$userlevel);?>>
          <a href="#">
            <i class="fa fa-desktop"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php displayAkses('barang',$userlevel);?>><a href="#bahan" onclick="loadPage('bahan')"> <i class="fa fa-fw fa-database"></i> Bahan</a></li>
            <li <?php displayAkses('barang',$userlevel);?>><a href="#barang" onclick="loadPage('barang')"> <i class="fa fa-fw fa-cubes"></i> Produk</a></li>
            <li <?php displayAkses('barcode',$userlevel);?>><a href="#barcode" onclick="loadPage('barcode')"> <i class="fa fa-fw fa-barcode"></i> Barcode</a></li>
            <li <?php displayAkses('supplier',$userlevel);?>><a href="#supplier" onclick="loadPage('supplier')"> <i class="fa fa-fw fa-address-card"></i> Supplier</a></li>
            <li <?php displayAkses('pelanggan',$userlevel);?>><a href="#pelanggan" onclick="loadPage('pelanggan')"> <i class="fa fa-fw fa-address-book"></i> Pelanggan</a></li>
            <li <?php displayAkses('stok_opname',$userlevel);?>><a href="#stok_opname" onclick="loadPage('stok_opname')"> <i class="fa fa-fw fa-cube"></i> Stok Opname</a></li>

          </ul>
        </li>
        <li <?php displayAkses('kasir',$userlevel);?> class="treeview">
          <a href="#kasir" onclick="loadPage('kasir')">
            <i class="fa fa-th"></i> <span>Kasir</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#dapur" onclick="loadPage('dapur')">
            <i class="fa  fa-cart-plus"></i> <span>Dapur</span>
          </a>
        </li>
        <li class="treeview" <?php displayAkses('transaksi',$userlevel);?>>
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li <?php displayAkses('transaksi_penjualan',$userlevel);?>><a href="#transaksi_penjualan" onclick="loadPage('penjualan')"> <i class="fa fa-fw fa-shopping-bag"></i> Penjualan</a></li>
            <li <?php displayAkses('transaksi_pembelian',$userlevel);?>><a href="#transaksi_pembelian" onclick="loadPage('pembelian')"> <i class="fa fa-fw fa-shopping-basket"></i> Pembelian</a></li>
            <li <?php displayAkses('transaksi_piutang',$userlevel);?>><a href="#transaksi_piutang" onclick="loadPage('piutang')"> <i class="fa fa-fw fa-calendar"></i> Piutang</a></li>
            <li <?php displayAkses('transaksi_hutang',$userlevel);?>><a href="#transaksi_hutang" onclick="loadPage('hutang')"> <i class="fa fa-fw fa-calendar-o"></i> Hutang</a></li>
             <li class="treeview" <?php displayAkses('transaksi_return',$userlevel);?>><a href="#" > <i class="fa fa-fw fa-sticky-note"></i> Return 
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
			 </a>
			 <ul class="treeview-menu">
                    <li <?php displayAkses('transaksi_return_penjualan',$userlevel);?>><a href="#transaksi_return_penjualan" onclick="loadPage('return_penjualan')"><i class="fa fa-circle"></i> Penjualan</a></li>
                    <li <?php displayAkses('transaksi_return_pembelian',$userlevel);?>><a href="#transaksi_return_pembelian" onclick="loadPage('return_pembelian')"><i class="fa fa-circle"></i> Pembelian</a></li>
                  </ul>
			 </li>

          </ul>
        </li>
        <li class="treeview" <?php displayAkses('laporan',$userlevel);?>>
          <a href="#">
            <i class="fa fa-calculator"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li <?php displayAkses('laporan_kas',$userlevel);?>><a href="#laporan_kas" onclick="loadPage('cashflow')"><i class="fa fa-calculator"></i> <span>Kas</span></a></li>
			<li <?php displayAkses('laporan_laba_rugi',$userlevel);?>><a href="#laporan_laba_rugi" onclick="loadPage('laba_rugi')"><i class="fa fa-line-chart"></i> <span>Laba Rugi</span></a></li>
			<li <?php displayAkses('laporan_grafik',$userlevel);?>><a href="#laporan_grafik" onclick="loadPage('grafik')"><i class="fa fa-bar-chart"></i> <span>Grafik</span></a></li>
			<li ><a href="#cetak_laporan" onclick="loadPage('cetak')"><i class="fa fa-print"></i> <span>Cetak</span></a></li>

          </ul>
        </li>
        <li <?php displayAkses('pengguna',$userlevel);?> class="treeview">
          <a href="#pengguna" onclick="loadPage('pengguna')">
            <i class="fa fa-user-o"></i> <span>Pengguna</span>
          </a>
        </li>
        <li <?php displayAkses('pengaturan',$userlevel);?> class="treeview">
          <a href="#pengaturan" onclick="loadPage('pengaturan')">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
          </a>
        </li>
        <li <?php displayAkses('hak_akses',$userlevel);?>>
          <a href="#hak_akses" onclick="loadPage('hak_akses')" class="treeview">
            <i class="fa fa-lock"></i> <span>Hak Akses</span>
          </a>
        </li>
        <li >
          <a href="#aktivasi" onclick="loadPage('aktivasi')" class="treeview">
            <span <?php //xAktivasi();?>><i class="fa fa-plug"></i> <span>Aktivasi </span></span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
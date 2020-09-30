    <link rel="stylesheet" href="<?php echo $CORE_URL;?>/assets/plugins/editor/jquery.cleditor.css" />
    <script src="<?php echo $CORE_URL;?>/assets/plugins/editor/jquery.min.js"></script>
    <script src="<?php echo $CORE_URL;?>/assets/plugins/editor/jquery.cleditor.min.js"></script>
   <script>
        $(document).ready(function() {
            $("#alamat").cleditor({
                width: 500, // width not including margins, borders or padding
                height: 100, // height not including margins, borders or padding
                controls: // controls to add to the toolbar
                    ""
            });
        });
    </script>
	
	<div class="col-md-8">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th-list"></i> Pengaturan</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
	<table class="table">
	<tr><td style="width:150px">Nama Toko</td><td>:</td><td><input class="form-control" id="nama_toko" value="<?php echo getPengaturan('nama_toko');?>">	</td></tr>
	<tr><td>Alamat</td><td>:</td><td><textarea class="form-control" id="alamat" ><?php echo getPengaturan('alamat');?></textarea>	</td></tr>
	<tr><td>No Telp/HP</td><td>:</td><td><input class="form-control" id="no_hp" value="<?php echo getPengaturan('no_hp');?>">	</td></tr>
	<tr><td>Email</td><td>:</td><td><input class="form-control" id="email" value="<?php echo getPengaturan('email');?>">	</td></tr>
	<tr><td>Website</td><td>:</td><td><input class="form-control" id="website" value="<?php echo getPengaturan('website');?>">	</td></tr>
	</table>  
	<button id="SaveInput" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-save"></i> Simpan</button>
	</div>
	</div>	
	



<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="fa fa-download"></i> Backup Database</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<p><a href="db/database.db" class="btn btn-primary">Backup Database SQLITE3</a> 
<?php if($database_engine=='mysql'){?>
<a href="page.php?page=backup" class="btn btn-success">Backup Database MySQL</a>
<?php }?>
</p>
<p>Backup Database MySQL Terakhir : <?php echo getPengaturan('backup');?></p>

</div>
</div>	

<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="fa fa-cloud-upload"></i> Restore Database</h3>
</div>
<div class="box-body">
<div id="loadUploaderRestore"></div>
<p>Restore Database Untuk SQLITE3</p>

  
</div>
</div>	


<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th-list"></i> Hapus Database</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<div class="alert alert-warning alert-dismissible">
<i class="icon fa fa-warning"></i> Sebelum menghapus database, sebaiknya Anda melakukan backup database
</div>
<p><button class="btn btn-danger" id="delBarang">Hapus Semua Data Barang</button></p>
<p><button class="btn btn-danger" id="delTransaksi">Hapus Semua Data Transaksi</button></p>
<p><button class="btn btn-danger" id="delSupplier">Hapus Semua Data Supplier</button></p>
<p><button class="btn btn-danger" id="delPelanggan">Hapus Semua Data Pelanggan</button></p>
<p><button class="btn btn-danger" id="resetTerjual">Reset Jumlah Barang Terjual</button></p>
<p><button class="btn btn-danger" id="resetTStok">Reset Stok Barang</button></p>
</div>
</div>	
  </div>
  <div class="col-md-4">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th-list"></i> Modul</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<form id="formModul">
<table class="table">
<tr><td style="width:30px"><input <?php setModul('voucher');?> type="checkbox" name="voucher" id="voucher" value="1"></td><td>Voucher <br><small>Aktifkan Voucher saat penjualan, centang untuk mengaktifkan</small></td></tr>
<tr><td style="width:30px"><input  <?php setModul('pajak');?>  type="checkbox" name="pajak"  id="pajak"  value="1"></td><td>Pajak <br><small>Aktifkan Pajak saat penjualan, centang untuk mengaktifkan</small></td></tr>
<tr><td ><input  <?php setModul('ongkir');?> type="checkbox" name="ongkir" id="ongkir"  value="1"></td><td>Ongkir <br><small>Aktifkan ongkos kirim saat penjualan, centang untuk mengaktifkan</small></td></tr>
</table>  
</form>
<button id="SaveModul" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-save"></i> Simpan</button>
</div>
</div>
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th-list"></i> Background</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<div id="loadUploader"></div>
</div>
</div>

<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th-list"></i> Tampilan Dashboard</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<form id="formDashboard">

<table class="table">
<tr><td style="width:30px"><input <?php setDashboard('total_barang');?> type="checkbox" name="total_barang" id="total_barang" value="1"></td><td>Total Barang</td></tr>
<tr><td style="width:30px"><input <?php setDashboard('total_pelanggan');?> type="checkbox" name="total_pelanggan" id="total_pelanggan" value="1"></td><td>Total Pelanggan</td></tr>
<tr><td style="width:30px"><input <?php setDashboard('omset');?> type="checkbox" name="omset" id="omset" value="1"></td><td>Omset Bulan Ini</td></tr>
<tr><td style="width:30px"><input <?php setDashboard('laba');?> type="checkbox" name="laba" id="laba" value="1"></td><td>Laba Bulan Ini</td></tr>
<tr><td style="width:30px"><input <?php setDashboard('grafik');?> type="checkbox" name="grafik" id="grafik" value="1"></td><td>Grafik</td></tr>
<tr><td style="width:30px"><input <?php setDashboard('barang_terlaris');?> type="checkbox" name="barang_terlaris" id="barang_terlaris" value="1"></td><td>Barang Terlaris</td></tr>
<tr><td style="width:30px"><input <?php setDashboard('barang_expired');?> type="checkbox" name="barang_expired" id="barang_expired" value="1"></td><td>Barang Expired</td></tr>
<tr><td style="width:30px"><input <?php setDashboard('barang_limit');?> type="checkbox" name="barang_limit" id="barang_limit" value="1"></td><td> Barang Stok Limit</td></tr>
</table>
</form>

<button id="saveDashboard" class="btn btn-primary btn-sm pull-right"><i class="fa fa-fw fa-save"></i> Simpan</button>
</div>
</div>	

</div>



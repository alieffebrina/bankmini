<?php 
$date=date("Y-m-d");
$barang= countData('daftar_barang',"");
$pelanggan= countData('pelanggan',"");
$penjualan= sumData("faktur",'pemasukan',"WHERE mode='penjualan' AND bulan='".date('m')."' AND tahun='".date('Y')."' AND status='tunai'");
$hpp= sumData("faktur",'total_hpp',"WHERE mode='penjualan' AND bulan='".date('m')."' AND tahun='".date('Y')."' AND status='tunai'");
$labarugi= sumData("faktur",'laba_rugi',"WHERE mode='penjualan' AND bulan='".date('m')."' AND tahun='".date('Y')."' AND status='tunai'");
$pembelian= sumData("faktur",'pengeluaran',"WHERE mode='pembelian' AND bulan='".date('m')."' AND tahun='".date('Y')."' AND status='tunai'");
$ongkir= sumData("faktur",'ongkir',"WHERE mode='penjualan' AND bulan='".date('m')."' AND tahun='".date('Y')."' ");
$pajak= sumData("faktur",'pajak',"WHERE mode='penjualan' AND bulan='".date('m')."' AND tahun='".date('Y')."' ");
$saldo= $penjualan-$hpp;
$items=doTableArray("daftar_barang",array("nama_barang","terjual"),"ORDER BY terjual DESC LIMIT 30");
$limit=doTableArray("daftar_barang",array("nama_barang","stok"),"WHERE stok<=stok_minimal ORDER BY stok");
$expired=doTableArray("daftar_barang",array("nama_barang","expired"),"WHERE expiredDate!='' AND expired!='' AND expiredDate<='".$date."' ORDER BY id_barang DESC LIMIT 10");

?>

<div class="col-lg-12">
<div class="row">
<div class="col-lg-3 col-xs-6" <?php echo displayDashboard('total_barang');?>>
  <!-- small box -->
  <div class="small-box bg-aqua">
	<div class="inner">
	  <h3><?php echo angka($barang);?></h3>

	  <p>Total Barang</p>
	</div>
	<div class="icon">
	  <i class="ion ion-bag"></i>
	</div>
	<a href="#" class="small-box-footer"> &nbsp;</a>
  </div>
</div>
 <!-- ./col -->
<div class="col-lg-3 col-xs-6"  <?php echo displayDashboard('total_pelanggan');?>>
  <!-- small box -->
  <div class="small-box bg-yellow">
	<div class="inner">
	  <h3><?php echo angka($pelanggan);?></h3>

	  <p>Total Pelanggan</p>
	</div>
	<div class="icon">
	  <i class="ion ion-person-add"></i>
	</div>
	<a href="#" class="small-box-footer"> &nbsp;</a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6"  <?php echo displayDashboard('omset');?>>
  <!-- small box -->
  <div class="small-box bg-green">
	<div class="inner">
	  <h3><?php echo angka($penjualan);?></h3>

	  <p>Omset Bulan ini</p>
	</div>
	<div class="icon">
	  <i class="ion ion-stats-bars"></i>
	</div>
	<a href="#" class="small-box-footer"> &nbsp;</a>
  </div>
</div>

<!-- ./col -->
<div class="col-lg-3 col-xs-6"  <?php echo displayDashboard('laba');?>>
  <!-- small box -->
  <div class="small-box bg-red">
	<div class="inner">
	  <h3><?php echo angka($saldo);?></h3>

	  <p>Laba Bulan Ini</p>
	</div>
	<div class="icon">
	  <i class="ion ion-pie-graph"></i>
	</div>
	<a href="#" class="small-box-footer"> &nbsp;</a>
  </div>
</div>
<!-- ./col -->
</div>
</div>
<div class="col-lg-12">

<div class="row">
<!-- /.col (LEFT) -->
<div class="col-md-8"  >
  <!-- BAR CHART -->
  <div class="box box-success" <?php echo displayDashboard('grafik');?>>
	<div class="box-header with-border">
	  <h3 class="box-title">Grafik Transaksi Tahun <?php echo date('Y'); ?></h3>

	</div>
	<div class="box-body chart-responsive">
	<div class="chart" id="bar-chart" style="height: 300px;"></div>
	<p><div style="background:#00a65a;height:15px;width:30px;float:left ;margin-right:5px;"></div> penjualan</p>
	<p><div style="background:#6080f2;height:15px;width:30px;float:left ;margin-right:5px;"></div> laba/rugi</p>
	</div><!-- /.box-body -->
	<!-- /.box-body -->
	
  </div>
  <div class="box box-success" <?php echo displayDashboard('barang_terlaris');?>>
	<div class="box-header with-border">
	  <h3 class="box-title">Barang Terlaris</h3>
	</div>
	<div class="box-body">
	<div style="overflow-y: auto; height:230px; ">
	<table class="table">
	<thead>
	<th>Barang</th>
	<th>Terjual</th>
	</thead>
	<tbody>
	<?php
	$i=1;
	foreach($items as $row){
	  echo '<tr>';
	  echo '<td>'.$row[0].'</td>';
	  echo '<td>'. angka($row[1]).'</td>';
	  echo '</tr>';
	  $i++; 	  
	}   
	?>
	</tbody>
	  </table>
	</div>
  </div>
  </div>
</div>
<div class="col-md-4"  >

  <div class="box box-warning  box-solid" <?php echo displayDashboard('barang_expired');?>>
	<div class="box-header with-border">
	  <h3 class="box-title">Barang Expired</h3>
	</div>
	<div class="box-body">
	<div style="overflow-y: auto; height:300px; ">
	<table class="table">
	<thead>
	<th>Barang</th>
	<th>Expired</th>
	</thead>
	<tbody>
	<?php
	$i=1;
	foreach($expired as $row){
	  echo '<tr>';
	  echo '<td>'.$row[0].'</td>';
	  echo '<td>'. $row[1].'</td>';
	  echo '</tr>';
	  $i++; 	  
	}   
	?>
	</tbody>
	  </table>
	</div>
  </div>
  </div>
  <div class="box box-danger box-solid" <?php echo displayDashboard('barang_limit');?>>
	<div class="box-header with-border">
	  <h3 class="box-title">Barang Stok Limit</h3>
	</div>
	<div class="box-body">
	<div style="overflow-y: auto; height:300px; ">
	<table class="table">
	<thead>
	<th>Barang</th>
	<th>Stok</th>
	</thead>
	<tbody>
	<?php
	$i=1;
	foreach($limit as $row){
	  echo '<tr>';
	  echo '<td>'.$row[0].'</td>';
	  echo '<td>'. angka($row[1]).'</td>';
	  echo '</tr>';
	  $i++; 	  
	}   
	?>
	</tbody>
	  </table>
	</div>
  </div>
  </div>

</div>
<!-- /.col (RIGHT) -->
</div>
</div>
<!-- /.row -->

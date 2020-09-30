<div class="col-md-12">
<div class="box">
<div class="box-body">
<div class="col-md-6">

<table class="table">
<tr>
<td>
<select id="user_id" class="form-control">
<option value="">-Semua Sales-</option>
<?php 
$userList=doTableArray("user",array("id","username"));
foreach( $userList as $list){
?>
<option value="<?php echo $list[0];?>"><?php echo $list[1];?></option>
<?php
}
?>
</select>
</td>
<td>
<select id="pelanggan_id" class="form-control">
<option value="">-Semua Pelanggan-</option>
<?php 
$userList=doTableArray("pelanggan",array("id","nama_pelanggan"));
foreach( $userList as $list){
?>
<option value="<?php echo $list[0];?>"><?php echo $list[1];?></option>
<?php
}
?>
</select>
</td>
<td>
<a href="#" class='btn btn-success' style="width:100%" id="filter1"><i class='fa fa-search'></i> Filter</a>
</td>
</tr>
<tr>
<td>Tanggal Awal</td>
<td>
<input title="tanggal transaksi" class="form-control datepicker-here" type="text" id="startDate" data-language="en"  value="<?php echo date("d/m/Y");?>">
</td>
<td>
<select id="status" class="form-control">
<option value="">Semua Transaksi</option>
<option value="tunai">Tunai</option>
<option value="kredit">Non Tunai</option>
</select>
</td>
</tr>
<tr>
<td>Tanggal Akhir</td>
<td>
<input title="tanggal transaksi" class="form-control datepicker-here" type="text" id="endDate" data-language="en"  value="<?php echo date("d/m/Y");?>" >
</td>
<td>

</td>
</tr>

</table>
</div>

<div class="col-md-6">

<div id="totalPenjualan"></div>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th"></i> Penjualan</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
	  <div class="table-responsive">
	<table class="table table-bordered table-hover " id="dataTable" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Tanggal</th>
			  <th>Faktur</th>
			  <th>Pemasukan</th>
			  <th>Pembayaran</th>
			  <th>Pelanggan</th>
			  <th>Sales</th>
			  <th style="width:30px"></th>
			</tr>
		  </thead>
		  <tfoot>
			<tr>
			  <th style="width:50px"></th>
			  <th>Total</th>
			  <th></th>
			  <th>Pemasukan</th>
			  <th></th>
			  <th></th>
			  <th></th>
			  <th style="width:30px"></th>
			</tr>
		  </tfoot>
		</table>
	  </div>
	</div>
  </div>
</div>



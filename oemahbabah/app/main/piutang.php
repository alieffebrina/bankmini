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
<select style="display:none" id="status" class="form-control">
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

<div id="totalPiutang"></div>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th"></i> Piutang</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<p>
<a href="#" class='btn btn-warning btn-sm' id='refresh'><i class='fa fa-refresh'></i> Refresh</a>
<a href="#" class='btn btn-success btn-sm' id='lunas'><i class='fa fa-check-square'></i> Lunas</a>
<a href="#" class='btn btn-warning btn-sm' id='belum_lunas'><i class='fa fa-window-close'></i> Belum Lunas</a>
<a href="#" class='btn btn-danger btn-sm' id='belum_dibayar'><i class='fa fa-remove'></i> Belum Dibayar</a>
</p>
	  <div class="table-responsive">
	<table class="table table-bordered table-hover " id="dataTable" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Tanggal</th>
			  <th>Faktur</th>
			  <th>Piutang</th>
			  <th>Piutang Dibayar</th>
			  <th>Piutang Sisa</th>
			  <th>Tempo</th>
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
			  <th>Piutang</th>
			  <th>Piutang Dibayar</th>
			  <th>Piutang Sisa</th>
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



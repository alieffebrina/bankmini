<form name="frm-barang" id="frm-barang">
<div class="col-md-12">

<div class="row">
<div class="col-md-6">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th"></i> Barcode</h3>
</div>
<div class="box-body">
	  <div class="table-responsive">
		<table class="table table-bordered table-hover " id="tableBarang" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:30px">ID</th>
			  <th>Kode</th>
			  <th>Nama Barang</th>
			  <th>Harga_Jual</th>
			</tr>
		  </thead>
		</table>
	  </div>	
<button type="submit" class="btn btn-primary btn-sm pull-right">Pilih Barang <span id="countBarcode"></span></button>

</div>
</div>
</div>
<div class="col-md-6">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="fa fa-print"></i> Cetak Barcode</h3>
</div>
<div class="box-body">

<p style="display:none">
<b>Selected rows data:</b><br>
<input id="barang-console-rows">
</p>
<div id="loadBarcode"></div>
</div>
</div>
</div>
</div>
</div>
</form>







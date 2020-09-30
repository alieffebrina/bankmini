<div class="col-md-12">
<div class="alert alert-warning">
<i class="fa fa-warning"></i> Untuk sementara fitur edit kasir ini belum bisa digunakan
</div>
</div>


<div class="col-md-4">
<div class="box">
<!-- /.box-header -->
<div class="box-body">
<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" >Kode Barang  </button></span>
<input class="form-control" type="text" id="kodeBarang" autofocus  title="kode barang" ><span class="input-group-btn">
<button class="btn " type="button"  id="showBarang" title="cari barang atau tekan F1"><i class="fa  fa-search" aria-hidden="true"  ></i> [F1]</button>
</span>
</div>
<input style="display:none;margin-top:5px" class="form-control" type="text" id="idBarang">
<input style="display:block;margin-top:5px" class="form-control" type="text" id="namaBarang" readonly placeholder="Nama Barang">
<input style="display:block;margin-top:5px" class="form-control" type="text" id="hargaJual" readonly placeholder="Harga">
<input style="display:block;margin-top:5px;display:none" class="form-control" type="text" id="stokBarang" readonly placeholder="Stok">
<div class="input-group" style="margin-top:5px">
<span class="input-group-btn"><button class="btn " type="button" style="width:111px">Jumlah  </button></span>
<input style="text-align:center" id="qty" name="" type="number" value="1" class="form-control "  title="jumlah barang" > 
<span class="input-group-btn"><button class="btn btn-warning" type="button"  id="addCart"><i class="fa  fa-check-square-o" aria-hidden="true"></i> Tambah</button></span>
</div>
<div>
<a href="#" class='btn btn-primary btn-lg' id='bayarKasir' style="margin-top:10px;width:100%"><i class='fa fa-print'></i> Selesai </a>
</div>
<a href="#" class="btn btn-default btn-xs" id="back" style="margin-top:10px;"><i class='fa fa-caret-left'></i> Kembali ke Transaksi Penjualan</a>

</div>
</div>
</div>
<div class="col-md-8">
<div class="box">
<div class="box-body">
<span id="totalSum"></span>
<span id="totalSumBayar" style="display:none"></span>
</div>
</div>
<div class="box">
<!-- /.box-header -->
<div class="box-body">
	  <div class="table-responsive">
		<table class="table table-bordered table-hover " id="dataTable" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:20px">ID</th>
			  <th>Kode</th>
			  <th>Nama Barang</th>
			  <th>Harga </th>
			  <th style="width:80px">Qty</th>
			  <th>Sub Total</th>

			  <th style="width:50px">Action</th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>
</div>

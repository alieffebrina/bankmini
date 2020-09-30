<!-- table kasir Penjualan -->

<div class="modal fade" id="modalReturnJual" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<h5 class="modal-title" id="EditPostLabel">Return Penjualan</h5>
</div>
<div class="modal-body"  >
<table class="table table-bordered"><tr>

<td style="width:400px">
<div id="loadFaktur"></div>
<input title="userID" class="form-control" type="text" id="user_id" value="<?php echo userID($_SESSION['user']);?>" style="display:none">
<div class="input-group" style="margin-top:4px">
<span class="input-group-btn"><button class="btn " type="button" >Faktur Penjualan  </button></span>
<input  class="form-control" type="text" id="fakturPenjualan" value=""  title="fakturPenjualan" >
<span class="input-group-btn"><button class="btn " type="button" id="showFaktur"  title="cari faktur" ><i class='fa fa-search'></i></button></span>
</div>
<small><i>Cari faktur penjualan untuk menampilkan barang</i></small>
</td>
<td>
<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" >Tanggal  </button></span>
<input  class="form-control datepicker-here" type="text" data-language="en"  type="text" id="date"  value="<?php echo date("d/m/Y");?>"   title="tanggal transaksi" >
</div>
<div style="margin-top:4px;">
<span id="totalSum"></span>
<span id="totalSumBayar" style="display:none"></span>
</div>
</td>
</tr>
</table>
<div style="overflow-y: auto; height:180px; ">
	  <div class="table-responsive">
		<table class="table table-bordered " id="tableFakturBarang" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Faktur</th>
			  <th>Tgl</th>
			  <th>Kode</th>
			  <th>Nama Barang</th>
			  <th>Harga</th>
			  <th>Qty</th>
			  <th>Total</th>
			  <th style="width:20px">#</th>
			</tr>
		  </thead>
		</table>
	  </div>
	  </div>
<table style="background:#ccc;padding:5px;width:100%">
<tr><td>
<div class="input-group" >
<input id="qtyBarang" type="hidden">
<span class="input-group-btn"><button class="btn " type="button" >Kode Barang Return </button></span>
<input  class="form-control" type="text" id="kodeBarang" value=""  title="kode barang" >

<span class="input-group-btn"><button class="btn " type="button" >Nama Barang </button></span>
<input  class="form-control" type="text" id="namaBarang" value=""  title="nama barang" >
<span class="input-group-btn"><button class="btn " type="button" >Qty</button></span>
<input  style="text-align:center" class="form-control" type="number" style="width:50px" id="qty" value="1"  title="jumlah barang" >
<span class="input-group-btn"><button class="btn btn-primary" type="button" id="addCart"><i class='fa fa-check-square-o'></i> Tambah</button></span>
</div>
</td></tr>
</table>
<div style="overflow-y: auto; height:180px; ">

	  <div class="table-responsive">
		<table class="table table-bordered " id="tableRtnPenjualan" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:20px">ID</th>
			  <th>Kode</th>
			  <th>Nama Barang</th>
			  <th>Harga </th>
			  <th>Qty</th>
			  <th>Sub Total</th>
			  <th ></th>
			</tr>
		  </thead>
		</table>
	  </div>
	  
</div>
</div>
<div class="modal-footer">
<a class="btn btn-primary" href="#" id="inputRtnPenjualan"><i class="fa fa-check-square-o" aria-hidden="true"></i> Simpan</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>
</div>
</div>
</div>
<!-- edit cart-->
<div class="modal fade" id="EditCart" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<h5 class="modal-title" id="EditPostLabel">Data Penjualan</h5>
</div>
<div class="modal-body">
<h4 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i>  Data Barang</h4>
<span style="display:none"><input  class="form-control" type="text" id="idCart"></span>
<table class="table">
<tr>
<td style="width:120px">Kode Barang</td><td style="width:10px">:</td><td>
<input  class="form-control" type="text" id="kode_barang" readonly>	</td></tr>
<tr><td>Nama Barang</td><td>:</td><td><input class="form-control" id="nama_barang" readonly>	</td></tr>
<tr><td>Harga</td><td>:</td><td><input class="form-control" id="hargaCart" readonly>	</td></tr>
<tr><td>Qty</td><td>:</td><td><input style="width:100px" type="number" class="form-control" id="qtyCart" onkeyup="reformatText(this)" >	</td></tr>
<tr><td>Stok Tersedia</td><td>:</td><td><div id="stokCart"></div></td></tr>
</table>  
</div>
<div class="modal-footer">
<a class="btn btn-primary" href="#" id="SaveCart"><i class="fa fa-check-square-o" aria-hidden="true"></i> Update</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Cancel</button>
</div>
</div>
</div>
</div>
<!-- Barang -->

<div class="modal fade" id="doFaktur" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content" >
<div class="modal-header" >
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button><h5 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i> Transaksi Penjualan</h5>

</div>
<div class="modal-body">
	  <div class="table-responsive">
	<table class="table table-bordered table-hover " id="tableFakturPenjualan" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Tanggal</th>
			  <th>Faktur</th>
			  <th>Penjualan</th>
			  <th>Pembayaran</th>
			  <th>Pelanggan</th>
			  <th style="width:30px"></th>
			</tr>
		  </thead>
		</table>
	  </div>	  
</div>
</div>
</div>
</div>

<!--- modal data pembelian -->
<div class="modal fade" id="modalRtnPenjualan" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<h5 class="modal-title" id="EditPostLabel">Transaksi Penjualan</h5>
</div>
<div class="modal-body" >
<hr>
<div id="showTableRtnPenjualan"></div>
</div>
<div class="modal-footer">
<a class="btn btn-primary"  href="#" id="hapusTransaksi"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
<a class="btn btn-primary" onclick="jQuery('#printArea').print()" href="#" id="printPenjualan"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>
</div>
</div>
</div>


<!-- table kasir pembelian -->

<div class="modal fade" id="modalPengadaanStok" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" style="display:block">
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>

<h5 class="modal-title" id="EditPostLabel">Transaksi Pembelian</h5>
</div>
<div class="modal-body"  >
<div class="row">
<div class="col-md-6">
<input style="display:none" class="form-control" type="text" id="idBarang">
<input style="display:none" class="form-control" type="text" id="namaBarang">
<input style="display:none" class="form-control" type="text" id="hargaJual">
<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" >Tanggal  </button></span>
<input  class="form-control datepicker-here" type="text" data-language="en"  type="text" id="date"  value="<?php echo date("d/m/Y");?>" data-zdp_readonly_element="false"   title="tanggal transaksi" >
</div>
<div id="loadFaktur"></div>
<div class="input-group" style="margin-top:4px">
<span class="input-group-btn"><button class="btn " type="button" >Supplier  </button></span>
<input  style="display:none" class="form-control" type="text" id="idSupplier" value=""  title="supplier ID" >
<input  class="form-control" type="text" id="namaSupplier" value=""  title="supplier" readonly>
<span class="input-group-btn"><button class="btn " type="button" id="showSupplier"  title="cari supplier" ><i class='fa fa-search'></i></button></span>
<input title="userID" class="form-control" type="text" id="user_id" value="<?php echo userID($_SESSION['user']);?>" style="display:none">

</div>
<form id="formKasir">
<span class="radio">
Metode Pembayaran : 
<label>
<input type="radio" name="metode" id="metode1" value="tunai" checked>
Tunai
</label>

<label>
<input type="radio" name="metode" id="metode2" value="kredit">
Non Tunai
</label>
</span>
</form>
<div class="input-group" id="showTempo">
<span class="input-group-btn"><button class="btn " type="button" >Jatuh Tempo  </button></span>
<input title="tanggal transaksi" class="form-control datepicker-here" type="text" id="tempo" data-language="en"  value="" >
</div>
</div>
<div class="col-md-6">

<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" >Kode Barang</button></span>
<input  class="form-control" type="text" id="kodeBarang" value=""  title="kode barang" >
<span class="input-group-btn"><button class="btn " type="button" id="showBarang"  title="cari barang" ><i class='fa fa-search'></i> [F1]</button></span>
</div>
<div class="input-group" style="margin-top:4px">
<span class="input-group-btn"><button class="btn " type="button" style="padding-right:50px">Jumlah</button></span>
<input  style="text-align:center" class="form-control" type="number" id="qty" value="1"  title="jumlah barang" >
<span class="input-group-btn"><button class="btn btn-warning" type="button" id="addCart"><i class='fa fa-check-square-o'></i> Tambah</button></span>
</div>
<div style="margin-top:4px;">
<span id="totalSum"></span>
<span id="totalSumBayar" style="display:none"></span>
</div>
</div>
<div class="col-lg-12">

	  <div class="table-responsive">
		<table class="table table-bordered " id="tablePembelian" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:20px">ID</th>
			  <th>Kode</th>
			  <th>Nama Barang</th>
			  <th>Harga </th>
			  <th>Qty</th>
			  <th>Sub Total</th>

			  <th style="width:50px">Action</th>
			</tr>
		  </thead>
		</table>
	  </div>
</div>
</div>
</div>
<div class="modal-footer">
<a class="btn btn-primary" href="#" id="inputBayar"><i class="fa fa-check-square-o" aria-hidden="true"></i> Simpan</a>
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
<h5 class="modal-title" id="EditPostLabel">Data Barang</h5>
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

<div class="modal fade" id="doBarang" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content" >
<div class="modal-header" >
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>
<h5 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i> Data Barang</h5>

</div>
<div class="modal-body">
	  <div class="table-responsive">
		<table class="table table-bordered table-hover " id="tableBarang" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Kode</th>
			  <th>Nama Barang</th>
			  <th>Harga Beli</th>
			  <th>Stok</th>
			  <th style="width:20px">#</th>
			</tr>
		  </thead>
		</table>
	  </div>	  
</div>
</div>
</div>
</div>

<!-- supplier -->

<div class="modal fade" id="doSupplier" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" >
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>
<h5 class="modal-title" id="EditPostLabel"><i class="fa fa-address-card-o " aria-hidden="true"></i> Data Supplier</h5>

</div>
<div class="modal-body">
<div class="table-responsive">
<table class="table">
<tr style="background:#eee;padding:3px">
<td>Tambah Supplier</td>
<td><input class="form-control " placeholder="Nama Supplier" id="nama_supplier"></td>
<td><input class="form-control" placeholder="Alamat" id="alamat"></td>
<td><input class="form-control" placeholder="No Telp/HP" id="no_hp"></td>
<td><button class="btn btn-primary" id="insertSupplier"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah </button></td>
</tr>
</table>
<hr><table class="table table-bordered table-hover " id="tableSupplier" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Nama Supplier</th>
			  <th>Alamat</th>
			  <th>Kota</th>
			  <th>No HP</th>
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
<div class="modal fade" id="modalPembelian" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<h5 class="modal-title" id="EditPostLabel">Transaksi Penjualan</h5>
</div>
<div class="modal-body" >
<hr>
<div id="showTablePembelian"></div>
</div>
<div class="modal-footer">
<a class="btn btn-primary"  href="#" id="hapusTransaksi"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>

<a class="btn btn-primary" onclick="jQuery('#printArea').print()" href="#" id="printPenjualan"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>
</div>
</div>
</div>


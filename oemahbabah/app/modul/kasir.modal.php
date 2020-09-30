
<div class="modal " id="EditCart" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<h5 class="modal-title" id="EditPostLabel">Data Produk</h5>
</div>
<div class="modal-body">
<h4 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i>  Data Produk</h4>
<span style="display:none"><input  class="form-control" type="text" id="idCart"></span>
<table class="table">
<tr>
<td style="width:120px">Kode Produk</td><td style="width:10px">:</td><td>
<input  class="form-control" type="text" id="kode_barang" readonly>	</td></tr>
<tr><td>Nama Produk</td><td>:</td><td><input class="form-control" id="nama_barang" readonly>	</td></tr>
<tr><td>Harga</td><td>:</td><td><input class="form-control" id="hargaCart" readonly>	</td></tr>
<tr><td>Qty</td><td>:</td><td><input style="width:100px" type="number" class="form-control" id="qtyCart"  >	</td></tr>
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

<!-- Produk -->

<div class="modal " id="doBarang" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" >
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<h5 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i> Data Produk</h5>
</div>
<div class="modal-body">
<!--	  <div class="table-responsive">
		<table class="table table-bordered table-hover " id="tableBarang" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Kode</th>
			  <th>Nama Produk</th>
			  <th>Harga Jual</th>
			  <th>Stok</th>
			  <th style="width:20px">#</th>
			</tr>
		  </thead>
		</table>
	  </div>
-->	  
</div>
</div>
</div>
</div>

<!-- KASIR -->

<div class="modal " id="doBayarKasir" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content ">
<div class="modal-header modal-header-primary">
<h5 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i> Bayar</h5>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-5">

<table class="table">
<tr>
<td colspan=2>
<div class="input-group" style="width:100%;margin-top:5px">
<span class="input-group-btn"><button class="btn " type="button" >Kasir &nbsp;&nbsp;&nbsp;&nbsp;</button></span>
<input title="user" class="form-control" type="text" id="userLogin" value="<?php echo $_SESSION['user'];?>" readonly>
<input title="userID" class="form-control" type="text" id="user_id" value="<?php echo userID($_SESSION['user']);?>" style="display:none">
</div>

<div class="input-group" style="width:100%;margin-top:5px">
<span class="input-group-btn"><button class="btn " type="button" >Tanggal  </button></span>
<input title="tanggal transaksi" class="form-control datepicker-here" type="text" id="date" data-language="en"   value="<?php echo date("d/m/Y");?>" >
<span class="input-group-btn"><span class="btn btn-default " type="button"readonly><i class="fa  fa-calendar"></i> </span></span>
</div>
<div id="_loadFaktur"></div>

<div class="input-group" style="width:100%;margin-top:5px">
<span class="input-group-btn"><button class="btn " type="button" >Pelanggan  </button></span>
<input style="display:none" class="form-control"  type="text" name="idPelanggan" id="idPelanggan" />
<input class="form-control"  type="text" name="namaPelanggan" id="namaPelanggan" readonly />
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="showPelanggan"><i class='fa fa-search'></i> Cari</button></span>
</div>
</td></tr>
<tr><td style="width:100px">Metode Pembayaran</td><td>
<form id="formKasir">
<div class="radio">
<label>
<input type="radio" name="metode" id="metode1" value="tunai" checked>
Tunai
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="metode" id="metode2" value="kredit">
Non Tunai / Kredit
</label>
</div>
</form>
<div class="input-group" id="showTempo">
<span class="input-group-btn"><button class="btn " type="button" >Jatuh Tempo  </button></span>
<input title="tanggal transaksi" class="form-control datepicker-here" type="text" id="tempo" data-language="en"  value="" >
</div>
</td></tr>
<?php if(getModul('ongkir')!=1){$displayOngkir= ' style="display:none" ';}else{$displayOngkir= '';}?>

<tr <?php echo $displayOngkir;?>><td colspan=2 style="background:#eee"><b>Pengiriman</b></td></tr>
<tr <?php echo $displayOngkir;?>><td>Ekspedisi</td><td>
<select class="form-control select2" id="ekspedisi" style="width: 100%;">
<option value="">--pilih--</option>
<?php
$expedisi=doTableArray("ekspedisi",array("ekspedisi"),"");
foreach($expedisi as $data){
	
	echo'<option>'.$data[0].'</option>';
}
?>
</select>
</td></tr>
<tr <?php echo $displayOngkir;?>><td>Ongkir</td><td><input  class="form-control"  style="text-align:right" type="text" name="ongkir" id="ongkir" value="" onkeyup="formatValue(this)" /></td></tr>
</table>
</div>
<div class="col-md-7">

<table class="table">
<tr><td style="width:150px">Total</td><td>
<div class="input-group">
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="">Rp.</button></span><input class="form-control"  type="text" name="modalGrandKasir" id="modalGrandKasir" />
</div>
<input class="form-control" style="display:none"  type="text" name="num2" id="num1" />
</td></tr>
<?php if(getModul('voucher')!=1){$displayVoucher= ' style="display:none" ';}else{$displayVoucher='';}?>
<tr <?php echo $displayVoucher;?>><td>Voucher</td><td>
<div class="input-group">
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="">Rp.</button></span>
<input class="form-control"  type="text" name="voucher" id="voucher" onkeyup="formatValue(this)" />
</div>
</td></tr>
<tr><td>Diskon</td><td>
<div class="input-group" style="width:100px">
<input  class="form-control"  style="text-align:right" type="text" name="diskon" id="diskon" value="" placeholder="0"  onkeyup="formatValue(this)" />
<span class="input-group-btn">
<button class="btn btn-default" type="button"  >%</button></span>
</div>
</td></tr>
<?php if(getModul('pajak')!=1){$displayPajak= ' style="display:none" ';}else{$displayPajak='';}?>
<tr <?php echo $displayPajak;?>><td>Pajak</td><td>
<div class="input-group" style="width:100px">
<input  class="form-control"  style="text-align:right" type="text" name="pajak" id="pajak" value="" placeholder="0"  onkeyup="formatValue(this)" />
<span class="input-group-btn">
<button class="btn btn-default" type="button"  >%</button></span>
</div>
</td></tr>
<style>
.grandTotal{background:#f7f0b7;font-size:24px}
</style>
<tr class="grandTotal"><td class="grandTotal">Grand Total</td><td class="grandTotal"><div id="hitungTotal" ></div></td></tr>

<tr><td>Dibayar</td><td>
<div class="input-group">
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="">Rp.</button></span>
<input class="form-control"  type="text" name="num2" id="num2" onkeyup="formatValue(this)" />
</div>
</td></tr>
<tr style="display:none"><td>Kembali</td><td><input class="form-control" type="text" name="subt" id="subt" readonly  /></td></tr>
<tr style="background:#eee"><td>Kembali</td><td><div id="subt2" ></div></td></tr>


</table>
</div>
</div>
</div>
<div class="modal-footer">
<a class="btn btn-primary" href="#" id="inputBayar"><i class="fa fa-check-square-o" aria-hidden="true"></i> Simpan & Cetak</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Batal</button>
</div>
</div>
</div>
</div>


<!-- Pelanggan -->


<div class="modal " id="doPelanggan" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" >
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>
<h5 class="modal-title" id="EditPostLabel"><i class="fa fa-address-card-o " aria-hidden="true"></i> Data Pelanggan</h5>

</div>
<div class="modal-body">
<div class="table-responsive">
<table class="table">
<tr style="background:#eee;padding:3px">
<td>Tambah Pelanggan</td>
<td><input class="form-control " placeholder="Nama Pelanggan" id="nama_pelanggan"></td>
<td><input class="form-control" placeholder="Alamat" id="alamat"></td>
<td><input class="form-control" placeholder="No Telp/HP" id="no_hp"></td>
<td><button class="btn btn-primary" id="addPelanggan"><i class="fa fa-plus" aria-hidden="true"></i> Tambah </button></td>
</tr>
</table>
<hr><table class="table table-bordered table-hover " id="tablePelanggan" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Nama Pelanggan</th>
			  <th>Alamat</th>
			  <th>Kota</th>
			  <th>No HP</th>
			  <th style="width:20px">#</th>
			</tr>
		  </thead>
		</table>
	  </div>	  
</div>
</div>
</div>
</div>


<!--- PRINT -->
<div class="modal " id="modalPrint" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header modal-header-primary">
<h5 class="modal-title" id="EditPostLabel"><i class="fa fa-address-card-o " aria-hidden="true"></i> Transaksi Selesai</h5>
</div>
<div class="modal-body">
	<div style="overflow-y: auto; height:350px; ">
	<div id="dataPrint"></div>
	     <iframe id="frame" src="" width="100%" height="300" style="border:none"> </iframe>
	</div>

	<center>
	<div class="well well-sm" style="display:block">
	Ukuran Kertas <select id="ukuran">
	<option value="58">58 mm</option>	
	<option value="80">80 mm</option>	
	</select> 
	<div style="display:none">
	Font <select id="font_family">
	<option>Arial</option>
	<option>Verdana</option>
	<option>Tahoma</option>
	<option>Courier</option>
	<option>Trebuchet MS</option>
	</select>  
	<select id="font_size">
	<option>8</option>
	<option>9</option>
	<option>10</option>
	<option selected>11</option>
	<option>12</option>
	<option>13</option>
	<option>14</option>
	<option>15</option>
	</select> 
	</div>
	</div>
	<a class="btn btn-primary btn-sm" href="#" id="printKasir" ><i class="fa fa-print" aria-hidden="true"></i> Cetak Struk</a>
	<a class="btn btn-primary btn-sm" href="#" id="newKasir"><i class="fa fa-check" aria-hidden="true"></i> Selesai</a>
	</center>
<div style="display:none">
<iframe src="#" name="frame" id="printFrame"></iframe>
</div>
	
</div>
</div>
</div>
</div>
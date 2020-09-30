<div class="modal fade" id="editKas" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header moda-header-primary" style="display:">
<h3 class="modal-title" id="EditPostLabel">Tambah Kas</h3>
</div>
<div class="modal-body" >

<table class="table">
<tr><td style="width:200px">Tanggal</td><td>:</td><td><input id="date" class="form-control datepicker-here" data-language="en"  value="<?php echo date("d/m/Y");?>">	</td></tr>
<tr><td>Faktur Kas</td><td>:</td><td><div id="loadFaktur"></div>	</td></tr>
<tr><td>Tipe</td><td>:</td><td>

<select id="tipe" class="form-control">
<option value="">--pilih--</option>
<option value="pemasukan">pemasukan</option>
<option value="pengeluaran">pengeluaran</option>
</select>
</td></tr>
<tr ><td>Pemasukan</td><td> : </td><td><input placeholder="0" id="pemasukan" name="pemasukan" placeholder="" class="form-control" onkeyup="reformatText(this)"></td></tr>
<tr  ><td>Pengeluaran</td><td> : </td><td><input  placeholder="0" id="pengeluaran" name="pengeluaran"  placeholder="" class="form-control" onkeyup="reformatText(this)"></td></tr>
<tr id="mode_pemasukan"><td>Jenis Pemasukan</td><td>:</td><td>
<select id="jenis_pemasukan" class="form-control">
<option value="">--pilih--</option>
<option >kas awal</option>
<option >pemasukan lain</option>
</select>
</td></tr>
<tr id="mode_pengeluaran"><td>Jenis Pengeluaran</td><td>:</td><td>
<select id="jenis_pengeluaran" class="form-control">
<option value="">--pilih--</option>
<option >kas akhir</option>
<option >pengeluaran lain</option>
<option >biaya</option>
</select>
</td></tr>
<tr><td>Keterangan</td><td>:</td><td><input class="form-control" id="keterangan">	</td></tr>
<input title="userID" class="form-control" type="text" id="user_id" value="<?php echo userID($_SESSION['user']);?>" style="display:none">


</table>
</div>
<div class="modal-footer">
<a class="btn btn-primary" href="#" id="inputCashflow"><i class="fa fa-save" aria-hidden="true"></i> Simpan</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modalCashflow" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<h5 class="modal-title" id="EditPostLabel">Data Transaksi</h5>
</div>
<div class="modal-body" >
<h3>Transaksi </h3>
<hr>
<div id="showCashflowDetail"></div>
</div>
<div class="modal-footer">
<a class="btn btn-primary" onclick="jQuery('#printArea').print()" href="#" id="printPenjualan"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>
</div>
</div>
</div>


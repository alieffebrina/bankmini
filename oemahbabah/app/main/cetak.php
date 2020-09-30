<div class="col-md-8">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th-list"></i> Cetak Laporan</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<form action="page.php" target="_BLANK">
<input name="token" value="<?php echo md5(time());?>" type="hidden">
<input name="page" value="cetak.laporan" type="hidden">
<div class="well">
<table><tr>
<td>
<select name="modeCetak" class="form-control" style="width:180px;" id="mode">
<option value="">Pilih Laporan</option>
<option value="" disabled style="color:blue">Laporan Barang</option>
<option value="cetakStok">- Stok barang</option>
<option value="cetakStokLimit">- Stok limit</option>
<option value="cetakStokExpired">- Barang expired</option>
<option value="cetakKatalog">- Katalog Barang</option>
<option value="" disabled style="color:blue">Laporan Penjualan</option>
<option value="cetakPenjualan">- Penjualan</option>
<option value="cetakPenjualanTunai">- Penjualan tunai</option>
<option value="cetakPenjualanKredit">- Penjualan kredit</option>
<option value="" disabled style="color:blue">Laporan Pembelian</option>
<option value="cetakPembelian">- Pembelian</option>
<option value="cetakPembelianTunai">- Pembelian Tunai</option>
<option value="cetakPembelianKredit">- Pembelian Kredit</option>
<option value="cetakHutang">Laporan Hutang</option>
<option value="cetakPiutang">Laporan Piutang</option>
<option value="cetakKas">Kas</option>
<option value="cetakLaba">Laba/Rugi</option>

</select>
</td>
<td style="padding-left:5px;padding-right:5px;font-weight:bold">Tanggal</td>
<td>
<input title="tanggal transaksi" class="form-control datepicker-here" type="text" name="startDate" id="startDate" data-language="en"  value="<?php echo date("d/m/Y");?>">
</td>
<td style="padding-left:5px;padding-right:5px;font-weight:bold">s/d</td>
<td>
<input title="tanggal transaksi" class="form-control datepicker-here" type="text" name="endDate" id="endDate" data-language="en"  value="<?php echo date("d/m/Y");?>">
</td>
</tr>
</table>
<br>
<button class="btn btn-primary btn-sm btn-flat" value="Cetak" id="cetak"><i class="fa fa-print"></i> Cetak </button>
</div>
</form>

	</div>
	</div>	
	
  </div>

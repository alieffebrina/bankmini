<?php 

function formHakAkses($tab,$level,$hakAkses){
if($level=='master'){
$disabled='disabled';
$active='active';
}else{
	$disabled='';
	$active='';
}
?>

<div class="tab-pane <?php echo $active;?>" id="<?php echo $tab;?>">
<div class="well well-sm"><b>Pengaturan Hak Akses <?php echo $hakAkses;?></b></div>
<form id="form<?php echo $hakAkses;?>">
<div class="table-responsive">

<table class="table">
<tr><td>
<div class="checkbox checkbox-header"><label><input type="checkbox"   name="master" value="1" <?php setAkses('master',$level);?>>Master</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox"  name="barang" value="1" <?php setAkses('barang',$level);?> >Barang</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="barang_tambah" value="1" <?php setAkses('barang_tambah',$level);?>>Tambah</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="barang_import" value="1" <?php setAkses('barang_import',$level);?>>Import</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="barang_edit" value="1" <?php setAkses('barang_edit',$level);?>>Edit</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="barang_hapus" value="1" <?php setAkses('barang_hapus',$level);?>>Hapus</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="barcode" value="1" <?php setAkses('barcode',$level);?>>Barcode</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="supplier" value="1" <?php setAkses('supplier',$level);?>>Supplier</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="supplier_tambah" value="1" <?php setAkses('supplier_tambah',$level);?>>Tambah</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="supplier_import" value="1" <?php setAkses('supplier_import',$level);?>>Import</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="supplier_edit" value="1" <?php setAkses('supplier_edit',$level);?>>Edit</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="supplier_hapus" value="1" <?php setAkses('supplier_hapus',$level);?>>Hapus</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="pelanggan" value="1" <?php setAkses('pelanggan',$level);?>>Pelanggan</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="pelanggan_tambah" value="1" <?php setAkses('pelanggan_tambah',$level);?>>Tambah</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="pelanggan_import" value="1" <?php setAkses('pelanggan_import',$level);?>>Import</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="pelanggan_edit" value="1" <?php setAkses('pelanggan_edit',$level);?>>Edit</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="pelanggan_hapus" value="1" <?php setAkses('pelanggan_hapus',$level);?>>Hapus</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="stok_opname" value="1" <?php setAkses('stok_opname',$level);?>>Stok Opname</label></div>
</td>
<td>
<div class="checkbox checkbox-header"><label><input type="checkbox" name="kasir" value="1" <?php setAkses('kasir',$level);?>>Kasir</label></div>
<div class="checkbox  checkbox-header"><label><input type="checkbox" name="transaksi" value="1" <?php setAkses('transaksi',$level);?>>Transaksi</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="transaksi_penjualan" value="1" <?php setAkses('transaksi_penjualan',$level);?>>Penjualan</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="transaksi_pembelian" value="1" <?php setAkses('transaksi_pembelian',$level);?>>Pembelian</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="transaksi_piutang" value="1" <?php setAkses('transaksi_piutang',$level);?>>Piutang</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="transaksi_hutang" value="1" <?php setAkses('transaksi_hutang',$level);?>>Hutang</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="transaksi_return" value="1" <?php setAkses('transaksi_return',$level);?>>Return</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="transaksi_return_penjualan" value="1" <?php setAkses('transaksi_return_penjualan',$level);?>>Return Penjualan</label></div>
<div class="checkbox checkbox-sub2"><label><input type="checkbox" name="transaksi_return_pembelian" value="1" <?php setAkses('transaksi_return_pembelian',$level);?>>Return Pembelian</label></div>
</td>
<td>
<div class="checkbox checkbox-header"><label><input type="checkbox" name="laporan" value="1" <?php setAkses('laporan',$level);?>>Laporan</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="laporan_kas" value="1" <?php setAkses('laporan_kas',$level);?>>Kas</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="laporan_laba_rugi" value="1" <?php setAkses('laporan_laba_rugi',$level);?>>Laba Rugi</label></div>
<div class="checkbox checkbox-sub"><label><input type="checkbox" name="laporan_grafik" value="1" <?php setAkses('laporan_grafik',$level);?>>Grafik</label></div>
</td>
<td>
<div class="checkbox checkbox-header"><label><input <?php echo $disabled;?> type="checkbox" name="pengguna" value="1" <?php setAkses('pengguna',$level);?>>Pengguna</label></div>
<div class="checkbox checkbox-header"><label><input <?php echo $disabled;?> type="checkbox" name="pengaturan" value="1" <?php setAkses('pengaturan',$level);?>>Pengaturan</label></div>
<div class="checkbox checkbox-header"><label><input <?php echo $disabled;?> type="checkbox" name="hak_akses" value="1" <?php setAkses('hak_akses',$level);?>>Hak Akses</label></div>
</td>
</tr>
</table>
</div>
</form>
<button class="btn btn-primary" name="save<?php echo $hakAkses;?>" id="save<?php echo $hakAkses;?>">Simpan</button>
</div>

<?php
}
?>
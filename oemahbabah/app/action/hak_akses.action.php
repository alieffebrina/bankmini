<?php 

function simpanHakAkses($level){

	if($_GET['master']!=1){$master=0;}else{$master=1;}
	if($_GET['barang']!=1){$barang=0;}else{$barang=1;}
	if($_GET['barcode']!=1){$barcode=0;}else{$barcode=1;}
	if($_GET['barang_tambah']!=1){$barang_tambah=0;}else{$barang_tambah=1;}
	if($_GET['barang_import']!=1){$barang_import=0;}else{$barang_import=1;}
	if($_GET['barang_edit']!=1){$barang_edit=0;}else{$barang_edit=1;}
	if($_GET['barang_hapus']!=1){$barang_hapus=0;}else{$barang_hapus=1;}
	if($_GET['pelanggan']!=1){$pelanggan=0;}else{$pelanggan=1;}
	if($_GET['pelanggan_tambah']!=1){$pelanggan_tambah=0;}else{$pelanggan_tambah=1;}
	if($_GET['pelanggan_import']!=1){$pelanggan_import=0;}else{$pelanggan_import=1;}
	if($_GET['pelanggan_edit']!=1){$pelanggan_edit=0;}else{$pelanggan_edit=1;}
	if($_GET['pelanggan_hapus']!=1){$pelanggan_hapus=0;}else{$pelanggan_hapus=1;}
	if($_GET['supplier']!=1){$supplier=0;}else{$supplier=1;}
	if($_GET['supplier_tambah']!=1){$supplier_tambah=0;}else{$supplier_tambah=1;}
	if($_GET['supplier_import']!=1){$supplier_import=0;}else{$supplier_import=1;}
	if($_GET['supplier_edit']!=1){$supplier_edit=0;}else{$supplier_edit=1;}
	if($_GET['supplier_hapus']!=1){$supplier_hapus=0;}else{$supplier_hapus=1;}
	if($_GET['transaksi']!=1){$transaksi=0;}else{$transaksi=1;}
	if($_GET['transaksi_penjualan']!=1){$transaksi_penjualan=0;}else{$transaksi_penjualan=1;}
	if($_GET['transaksi_pembelian']!=1){$transaksi_pembelian=0;}else{$transaksi_pembelian=1;}
	if($_GET['transaksi_piutang']!=1){$transaksi_piutang=0;}else{$transaksi_piutang=1;}
	if($_GET['transaksi_hutang']!=1){$transaksi_hutang=0;}else{$transaksi_hutang=1;}
	if($_GET['transaksi_return']!=1){$transaksi_return=0;}else{$transaksi_return=1;}
	if($_GET['transaksi_return_penjualan']!=1){$transaksi_return_penjualan=0;}else{$transaksi_return_penjualan=1;}
	if($_GET['transaksi_return_pembelian']!=1){$transaksi_return_pembelian=0;}else{$transaksi_return_pembelian=1;}
	if($_GET['kasir']!=1){$kasir=0;}else{$kasir=1;}
	if($_GET['laporan']!=1){$laporan=0;}else{$laporan=1;}
	if($_GET['laporan_kas']!=1){$laporan_kas=0;}else{$laporan_kas=1;}
	if($_GET['laporan_laba_rugi']!=1){$laporan_laba_rugi=0;}else{$laporan_laba_rugi=1;}
	if($_GET['laporan_grafik']!=1){$laporan_grafik=0;}else{$laporan_grafik=1;}
	if($_GET['pengguna']!=1){$pengguna=0;}else{$pengguna=1;}
	if($_GET['pengaturan']!=1){$pengaturan=0;}else{$pengaturan=1;}
	if($_GET['hak_akses']!=1){$hak_akses=0;}else{$hak_akses=1;}
	if($_GET['stok_opname']!=1){$stok_opname=0;}else{$stok_opname=1;}

			
	doUpdate('akses',
	"
	master='".$master."',
	barcode='".$barcode."',
	barang='".$barang."',
	barang_tambah='".$barang_tambah."',
	barang_import='".$barang_import."',
	barang_edit='".$barang_edit."',
	barang_hapus='".$barang_hapus."',
	pelanggan='".$pelanggan."',
	pelanggan_tambah='".$pelanggan_tambah."',
	pelanggan_import='".$pelanggan_import."',
	pelanggan_edit='".$pelanggan_edit."',
	pelanggan_hapus='".$pelanggan_hapus."',
	supplier='".$supplier."',
	supplier_tambah='".$supplier_tambah."',
	supplier_import='".$supplier_import."',
	supplier_edit='".$supplier_edit."',
	supplier_hapus='".$supplier_hapus."',
	transaksi='".$transaksi."',
	transaksi_penjualan='".$transaksi_penjualan."',
	transaksi_pembelian='".$transaksi_pembelian."',
	transaksi_piutang='".$transaksi_piutang."',
	transaksi_hutang='".$transaksi_hutang."',
	transaksi_return='".$transaksi_return."',
	transaksi_return_penjualan='".$transaksi_return_penjualan."',
	transaksi_return_pembelian='".$transaksi_return_pembelian."',
	kasir='".$kasir."',
	laporan='".$laporan."',
	laporan_kas='".$laporan_kas."',
	laporan_laba_rugi='".$laporan_laba_rugi."',
	laporan_grafik='".$laporan_grafik."',
	pengguna='".$pengguna."',
	pengaturan='".$pengaturan."',
	stok_opname='".$stok_opname."',
	hak_akses='".$hak_akses."'"
	,"WHERE level='".$level."'");
}


if(isset($_GET['inputAksesMaster'])){
simpanHakAkses('master');
echo 'master';
}
elseif(isset($_GET['inputAksesMarketing'])){
simpanHakAkses('marketing');

}elseif(isset($_GET['inputAksesKasir'])){
simpanHakAkses('kasir');

}elseif(isset($_GET['inputAksesOperator'])){
simpanHakAkses('operator');
}
elseif(isset($_GET['inputAksesSales'])){
simpanHakAkses('sales');
}
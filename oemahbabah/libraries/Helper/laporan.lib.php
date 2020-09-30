<?php 
/* APLIKASI PENJUALAN DPOS PRO
 *
 * Framework DPOS BISNIS berbasis PHP
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal
 * @copyright	Copyright (c) 2008 Djavasoft. (https://djavasoft.com/)
 *
 *
*/

function cetakStok(){
?>
<b style="font-size:16px">LAPORAN STOK Barang</b>
<br>
<?php
	$items=doTableArray("daftar_barang",array("kode_barang","nama_barang","harga_beli","harga_jual","stok"),"");
	$i=1;
	echo '<table class="table table-striped table-bordered">';
	echo '<thead>';
	echo '<tr style="background:#eee;font-weight:bold">';
	echo '<td style="width:40px">No</td><td style="width:50px">Kode</td><td style="width:300px">Nama Barang</td><td >Hrg Beli</td><td >Hrg Jual</td><td>Stok</td>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	foreach($items as $row){
	echo '<tr>';
	echo '<td class="name">'.$i.'</td>';
	echo '<td class="name">'.$row[0].'</td>';
	echo '<td class="name">'.$row[1].'</td>';
	echo '<td class="name">Rp.'.angka($row[2]).'</td>';
	echo '<td class="name">Rp.'.angka($row[3]).'</td>';
	echo '<td class="name">'.$row[4].'</td>';
	echo '</tr>';
	$i++; 	  
	}
	echo '</tbody>';
	echo '</table>';


}
function cetakStokLimit(){
?>
<b style="font-size:16px">LAPORAN BARANG DIBAWAH STOK MINIMUM</b>
<br>
<?php
	$items=doTableArray("daftar_barang",array("kode_barang","nama_barang","harga_beli","harga_jual","stok"),"WHERE stok <= stok_minimal");
	$i=1;
	echo '<table class="table table-striped table-bordered">';
	echo '<thead>';
	echo '<tr style="background:#eee;font-weight:bold">';
	echo '<td style="width:40px">No</td><td style="width:50px">Kode</td><td style="width:300px">Nama Barang</td><td >Hrg Beli</td><td >Hrg Jual</td><td>Stok</td>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	foreach($items as $row){
	echo '<tr>';
	echo '<td class="name">'.$i.'</td>';
	echo '<td class="name">'.$row[0].'</td>';
	echo '<td class="name">'.$row[1].'</td>';
	echo '<td class="name">Rp.'.angka($row[2]).'</td>';
	echo '<td class="name">Rp.'.angka($row[3]).'</td>';
	echo '<td class="name">'.$row[4].'</td>';
	echo '</tr>';
	$i++; 	  
	}
	echo '</tbody>';
	echo '</table>';


}function cetakStokExpired(){
	$date=date('Y-m-d');
?>
<b style="font-size:16px">LAPORAN BARANG Expired</b>
<br>
<?php
	$items=doTableArray("daftar_barang",array("kode_barang","nama_barang","harga_beli","harga_jual","expired"),"WHERE expiredDate!='' AND expiredDate<='".$date."' AND expired!=''  ");
	$i=1;
	echo '<table class="table table-striped table-bordered">';
	echo '<thead>';
	echo '<tr style="background:#eee;font-weight:bold">';
	echo '<td style="width:40px">No</td><td style="width:50px">Kode</td><td style="width:300px">Nama Barang</td><td >Hrg Beli</td><td >Hrg Jual</td><td>Expired</td>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	foreach($items as $row){
	echo '<tr>';
	echo '<td class="name">'.$i.'</td>';
	echo '<td class="name">'.$row[0].'</td>';
	echo '<td class="name">'.$row[1].'</td>';
	echo '<td class="name">Rp.'.angka($row[2]).'</td>';
	echo '<td class="name">Rp.'.angka($row[3]).'</td>';
	echo '<td class="name">'.tDate($row[4]).'</td>';
	echo '</tr>';
	$i++; 	  
	}
	echo '</tbody>';
	echo '</table>';


}
function cetakKatalog(){
	$date=date('Y-m-d');
?>
<b style="font-size:16px">Katalog Barang</b>
<br>
<br>
<?php
	$items=doTableArray("daftar_barang",array("kode_barang","nama_barang","harga_beli","harga_jual","expired"),"");
	

	$i=1;
	echo '<table class="table table-striped table-bordered">';
	echo '<thead>';
	echo '<tr style="background:#eee;font-weight:bold">';
	echo '<td style="width:40px">No</td><td style="max-width:200px">Gambar</td><td >Barang</td>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	foreach($items as $row){
	if(file_exists('images/barang/'.$row[0].'.jpg')){
		$img='images/barang/'.$row[0].'.jpg';
	}else{
		$img='images/system/noimage.jpg';

	}
	echo '<tr>';
	echo '<td class="name">'.$i.'</td>';
	echo '<td class="name"><img src="'.$img.'" style="max-width:200px;height:150px"></td>';
	echo '<td class="name">
	'.$row[1].'<br>
	Kode : '.$row[0].'<br>
	Harga : Rp.'.angka($row[3]).',00</td>';
	echo '</tr>';
	$i++; 	  
	}
	echo '</tbody>';
	echo '</table>';


}
function cetakKas(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);

$pemasukan=sumData('faktur','pemasukan',"WHERE pemasukan!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai'  ");
$pengeluaran=sumData('faktur','pengeluaran',"WHERE pengeluaran!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai'  ");
$saldo=$pemasukan-$pengeluaran;

?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN KAS</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PENDAPATAN</b></td><td>:</td><td>Rp.<?php echo angka($pemasukan);?></td></tr>
<tr><td><b >TOTAL PENGELUARAN</b></td><td>:</td><td>Rp.<?php echo angka($pengeluaran);?></td></tr>
<tr><td><b >SALDO </b></td><td>:</td><td>Rp.<?php echo angka($saldo);?></td></tr>
</table>
<?php
$items=doTableArray("faktur",array(
"id",
"date",
"faktur",
"mode",
"pemasukan",
"pengeluaran",
"ongkir",
"pajak",
"keterangan"),
"WHERE  date>='".$startDate."' AND date<='".$endDate."' AND status='tunai' ORDER by date ASC");
$i=1;
echo '<table class="table table-striped table-bordered">';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >Jenis</td>
<td >Pendapatan</td>
<td >Pengeluaran</td>
<td>Keterangan</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">'.$row[3].'</td>';
echo '<td class="name">Rp.'.angka($row[4]).'</td>';
echo '<td class="name">Rp.'.angka($row[5]).'</td>';
echo '<td class="name">'.$row[8].'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ><b>Rp.'. angka($pemasukan).'</b></td>
<td ><b>Rp.'. angka($pengeluaran).'</b></td>
<td></td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';

}
function cetakLaba(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);
$pemasukan=sumData('faktur','pemasukan',"WHERE pemasukan!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai'  ");
$total_hpp=sumData('faktur','total_hpp',"WHERE pemasukan!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai'  ");
$labarugi=$pemasukan-$total_hpp;
	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN LABA RUGI</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PENJUALAN</b></td><td>:</td><td>Rp.<?php echo angka($pemasukan);?></td></tr>
<tr><td><b >TOTAL HPP</b></td><td>:</td><td>Rp.<?php echo angka($total_hpp);?></td></tr>
<tr><td><b >LABA </b></td><td>:</td><td>Rp.<?php echo angka($labarugi);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id",
"date",
"faktur",
"mode",
"pemasukan",
"total_hpp",
"laba_rugi",
"grand_total"
),"WHERE  date>='".$startDate."' AND date<='".$endDate."' AND status='tunai' AND mode='penjualan'");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >Jenis</td>
<td >Penjualan</td>
<td >HPP</td>
<td>Laba Rugi</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">'.$row[3].'</td>';
echo '<td class="name">Rp.'.angka($row[4]).'</td>';
echo '<td class="name">Rp.'.angka($row[5]).'</td>';
echo '<td class="name">Rp.'.angka($row[6]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ><b>Rp.'. angka($pemasukan).'</b></td>
<td ><b>Rp.'. angka($total_hpp).'</b></td>
<td ><b>Rp.'. angka($labarugi).'</b></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
/*------------------------ CETAK PEMBELIAN ------------------------*/

function cetakPenjualan(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);
$penjualan=sumData('faktur','grand_total',"WHERE mode='penjualan'  AND date>='".$startDate."' AND date<='".$endDate."'  ");
$tunai=sumData('faktur','grand_total',"WHERE mode='penjualan' AND status='tunai' AND date>='".$startDate."' AND date<='".$endDate."'  ");
$kredit=sumData('faktur','grand_total',"WHERE  mode='penjualan' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."'  ");
	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN PENJUALAN</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PENJUALAN</b></td><td>:</td><td>Rp.<?php echo angka($penjualan);?></td></tr>
<tr><td><b >TOTAL PENJUALAN TUNAI</b></td><td>:</td><td>Rp.<?php echo angka($tunai);?></td></tr>
<tr><td><b >TOTAL PENJUALAN KREDIT</b></td><td>:</td><td>Rp.<?php echo angka($kredit);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id",
"date",
"faktur",
"pemasukan",
"status",
"pelanggan_id",
"total",
"grand_total"
),"WHERE mode='penjualan' AND date>='".$startDate."' AND date<='".$endDate."'  ");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >Penjualan</td>
<td >Pembayaran</td>
<td>Pelanggan</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">Rp.'.angka($row[3]).'</td>';
echo '<td class="name">'.$row[4].'</td>';
echo '<td class="name">'.getNamaPelanggan($row[5]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ><b>Rp.'. angka($penjualan).'</b></td>
<td ></td>
<td ></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
function cetakPenjualanTunai(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);
$tunai=sumData('faktur','grand_total',"WHERE mode='penjualan' AND status='tunai' AND date>='".$startDate."' AND date<='".$endDate."' ");
	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN PENJUALAN TUNAI</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PENJUALAN</b></td><td>:</td><td>Rp.<?php echo angka($tunai);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id",
"date",
"faktur",
"pemasukan",
"status",
"pelanggan_id",
"total",
"grand_total"
),"WHERE mode='penjualan' AND date>='".$startDate."' AND date<='".$endDate."'  AND status='tunai'");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >Penjualan</td>
<td >Pembayaran</td>
<td>Pelanggan</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">Rp.'.angka($row[3]).'</td>';
echo '<td class="name">'.$row[4].'</td>';
echo '<td class="name">'.getNamaPelanggan($row[5]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ><b>Rp.'. angka($tunai).'</b></td>
<td ></td>
<td ></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
function cetakPenjualanKredit(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);

$kredit=sumData('faktur','grand_total',"WHERE  mode='penjualan' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."'");
	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN PENJUALAN KREDIT</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PENJUALAN</b></td><td>:</td><td>Rp.<?php echo angka($kredit);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id",
"date",
"faktur",
"pemasukan",
"status",
"pelanggan_id",
"total",
"grand_total"
),"WHERE mode='penjualan' AND date>='".$startDate."' AND date<='".$endDate."'  AND status='kredit'");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >Penjualan</td>
<td >Pembayaran</td>
<td>Pelanggan</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">Rp.'.angka($row[3]).'</td>';
echo '<td class="name">'.$row[4].'</td>';
echo '<td class="name">'.getNamaPelanggan($row[5]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ><b>Rp.'. angka($kredit).'</b></td>
<td ></td>
<td ></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
/*------------------------ CETAK PEMBELIAN ------------------------*/

function cetakPembelian(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);
$pembelian=sumData('faktur','grand_total',"WHERE mode='pembelian'  AND date>='".$startDate."' AND date<='".$endDate."'  ");
$tunai=sumData('faktur','grand_total',"WHERE mode='pembelian' AND status='tunai' AND date>='".$startDate."' AND date<='".$endDate."'  ");
$kredit=sumData('faktur','grand_total',"WHERE  mode='pembelian' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."'  ");
	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN PEMBELIAN</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PEMBELIAN</b></td><td>:</td><td>Rp.<?php echo angka($pembelian);?></td></tr>
<tr><td><b >TOTAL PEMBELIAN TUNAI</b></td><td>:</td><td>Rp.<?php echo angka($tunai);?></td></tr>
<tr><td><b >TOTAL PEMBELIAN KREDIT</b></td><td>:</td><td>Rp.<?php echo angka($kredit);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id",
"date",
"faktur",
"pengeluaran",
"status",
"supplier_id",
"total",
"grand_total"
),"WHERE mode='pembelian' AND date>='".$startDate."' AND date<='".$endDate."'  ");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >Pembelian</td>
<td >Pembayaran</td>
<td>Pelanggan</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">Rp.'.angka($row[3]).'</td>';
echo '<td class="name">'.$row[4].'</td>';
echo '<td class="name">'.getNamaSupplier($row[5]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ><b>Rp.'. angka($pembelian).'</b></td>
<td ></td>
<td ></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
function cetakPembelianTunai(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);
$tunai=sumData('faktur','grand_total',"WHERE mode='pembelian' AND status='tunai' AND date>='".$startDate."' AND date<='".$endDate."' ");
	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN PEMBELIAN TUNAI</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PEMBELIAN</b></td><td>:</td><td>Rp.<?php echo angka($tunai);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id",
"date",
"faktur",
"pengeluaran",
"status",
"supplier_id",
"total",
"grand_total"
),"WHERE mode='pembelian' AND date>='".$startDate."' AND date<='".$endDate."'  AND status='tunai'");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >pembelian</td>
<td >Pembayaran</td>
<td>Pelanggan</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">Rp.'.angka($row[3]).'</td>';
echo '<td class="name">'.$row[4].'</td>';
echo '<td class="name">'.getNamaSupplier($row[5]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ><b>Rp.'. angka($tunai).'</b></td>
<td ></td>
<td ></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
function cetakPembelianKredit(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);

$kredit=sumData('faktur','grand_total',"WHERE  mode='pembelian' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."'");
	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN PEMBELIAN KREDIT</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PEMBELIAN</b></td><td>:</td><td>Rp.<?php echo angka($kredit);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id",
"date",
"faktur",
"pengeluaran",
"status",
"supplier_id",
"total",
"grand_total"
),"WHERE mode='pembelian' AND date>='".$startDate."' AND date<='".$endDate."'  AND status='kredit'");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >pembelian</td>
<td >Pembayaran</td>
<td>Pelanggan</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">Rp.'.angka($row[3]).'</td>';
echo '<td class="name">'.$row[4].'</td>';
echo '<td class="name">'.getNamaSupplier($row[5]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ><b>Rp.'. angka($kredit).'</b></td>
<td ></td>
<td ></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
function cetakHutang(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);

$kredit=sumData('faktur','grand_total',"WHERE  mode='pembelian' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."'  ");
	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN HUTANG</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PEMBELIAN</b></td><td>:</td><td>Rp.<?php echo angka($kredit);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id", //0
"date", //1
"faktur", //2
"hutang", //3
"hutang_dibayar", //4
"hutang_sisa", //5
"tempo", //6
"supplier_id", //7
"total", //8
"grand_total" //0
),"WHERE mode='pembelian' AND date>='".$startDate."' AND date<='".$endDate."' AND status='kredit' ");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >Hutang</td>
<td >Hutang Dibayar</td>
<td >Hutang Sisa</td>
<td >Tempo</td>
<td>Supplier</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">Rp.'.angka($row[3]).'</td>';
echo '<td class="name">'.angka($row[4]).'</td>';
echo '<td class="name">'.angka($row[5]).'</td>';
echo '<td class="name">'.$row[6].'</td>';
echo '<td class="name">'.getNamaSupplier($row[7]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}

function cetakPiutang(){
$startDate=oDate($_GET['startDate']);
$endDate=oDate($_GET['endDate']);
$kredit=sumData('faktur','hutang_sisa',"WHERE  mode='penjualan' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."'  ");

	?>
<table class="table" style="width:400px">
<tr><td  style="font-size:16px" colspan=3><b >LAPORAN PIUTANG</b></td></tr>
<tr><td><b>PERIODE</b></td><td style="width:15px">:</td><td><?php echo $_GET['startDate'];?> s/d <?php echo $_GET['endDate'];?></td></tr>
<tr><td><b >TOTAL PEMBELIAN</b></td><td>:</td><td>Rp.<?php echo angka($kredit);?></td></tr>
</table>
	<?php

$items=doTableArray('faktur',array(
"id", //0
"date", //1
"faktur", //2
"hutang", //3
"hutang_dibayar", //4
"hutang_sisa", //5
"tempo", //6
"pelanggan_id", //7
"total", //8
"grand_total" //0
),"WHERE mode='penjualan' AND date>='".$startDate."' AND date<='".$endDate."' AND status='kredit' ");
$i=1;
echo '<table class="table table-striped table-bordered" >';
echo '<thead>';
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td style="width:40px">No</td>
<td style="width:100px">Tanggal</td>
<td style="width:200px">Faktur</td>
<td >Piutang</td>
<td >Piutang Dibayar</td>
<td >Piutang Sisa</td>
<td >Tempo</td>
<td>Supplier</td>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($items as $row){
echo '<tr>';
echo '<td class="name">'.$i.'</td>';
echo '<td class="name">'.nDate($row[1]).'</td>';
echo '<td class="name">'.$row[2].'</td>';
echo '<td class="name">Rp.'.angka($row[3]).'</td>';
echo '<td class="name">'.angka($row[4]).'</td>';
echo '<td class="name">'.angka($row[5]).'</td>';
echo '<td class="name">'.$row[6].'</td>';
echo '<td class="name">'.getNamaPelanggan($row[7]).'</td>';
echo '</tr>';
$i++; 	  
}
echo '<tr style="background:#eee;font-weight:bold">';
echo '<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}